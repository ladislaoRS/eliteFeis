<template>
    <div :id="'reply-'+id" class="card my-4 border-0 shadow-sm">
        <div class="card-body">
            <div class="media text-muted">
                <img class="mr-2 rounded-circle" :src="data.owner.avatar_path" alt="Profile" width="35" height="35">
                <div class="media-body">
                    <h6 class="mt-0"><a :href="'/profiles/' + data.owner.name" v-text="'@' + data.owner.name"><span>@</span></a>
                    <span class="d-block text-gray-dark pt-1" v-text="ago"></span>
                    </h6>
                </div>
            </div>
            <div v-if="editing">
                <form @submit.prevent="update">
                    <div class="form-group">
                        <textarea class="form-control mb-2" rows="4" v-model="body" required></textarea>
                    </div>
                    <button class="btn btn-outline-primary btn-sm">Update</button>
                    <button @click="editing = false" type="button" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
                </form>
            </div>
            <div v-else v-html="body" style="font-size: .9rem"></div>
         
            <template v-if="signedIn">
                <favorite :reply="data"></favorite>
            </template>
        

            <template v-if="canUpdate">
                <!--Editing reply-->
                <button class="btn btn-link pt-4 pl-0 pb-0" title="Edit" @click="editing = true">
                    <span class=""><i class="far fa-edit"></i> Edit</span>
                </button>
                
                <!--Ajaxifying delete button-->
                <button class="btn btn-link pt-4 pl-0 pb-0" title="Delete" @click="destroy">
                    <span class="text-danger"><i class="far fa-trash-alt"></i> Delete</span>
                </button>
            </template>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    import Favorite from './Favorite.vue';
    
    export default {
        components: { 
            Favorite
        },
        
        props: ['data'],
        
        data () {
            return {
                editing: false,
                body: this.data.body,
                id: this.data.id,
            };
        },
        
        computed: {
             ago() {
                return moment(this.data.created_at).fromNow() + '...';
            },
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },
        
        methods: {
            update () {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });
                this.editing = false;
                
                flash("Reply has been updated!")
            },
            
            destroy () {
                axios.delete('/replies/' + this.data.id);
                
                $(this.$el).fadeOut(300, () => {
                   flash('Reply has been deleted!'); 
                });
                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>