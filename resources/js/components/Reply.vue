<template>
    <div :id="'reply-'+id">
        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
                <div class="thumb">
                    <img :src="data.owner.avatar_path" alt="Profile" width="60" height="60">
                </div>
                <div class="desc">
                    <h5><a :href="'/profiles/' + data.owner.name" v-text="'@' + data.owner.name"></a></h5>
                    <p class="date" v-text="ago"></p>
                    <div v-if="editing">
                        <form @submit.prevent="update">
                            <div class="form-group">
                                <wysiwyg v-model="body"></wysiwyg>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Update</button>
                            <button @click="doNothing" type="button" class="btn btn-outline-secondary btn-sm" title="Cancel">Cancel</button>
                        </form>
                    </div>
                    <p v-else v-html="body"></p>
                </div>
            </div>
            
            <div class="reply-btn" v-if="canUpdate">
                  <a href="javascript:void(0)" class="btn-reply text-uppercase" title="Edit" @click="editing = true" v-if="! editing">Edit</a> 
            </div>
        </div>
        <template v-if="signedIn">
            <favorite :reply="data"></favorite>
        </template>
        <template v-if="canUpdate">
            <!--Ajaxifying delete button-->
            <button class="btn btn-link pt-2 pl-0 pb-0" title="Delete" @click="destroy">
                <span class="text-danger"><i class="fa fa-trash-alt"></i></span>
            </button>
        </template>
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
            },
            
            doNothing () {
                this.editing = false;
            }
            
        }
    }
</script>