<template>
    <div>
        <div v-if="signedIn">
            <form @submit.prevent="addReply">
            <div class="form-group">
                <wysiwyg name="body" v-model="body" placeholder="Have something to say?" :shouldClear="completed"></wysiwyg>
                <button type="submit"
                    class="btn btn-outline-primary btn-sm mt-3">
                    <span class=""><i class="fas fa-reply"></i> Reply</span>
                </button>
            </div>
            </form>
        </div>
        <p class="text-center" v-else>
            Please <a href="/login">sign in</a> to participate in this
            discussion.
        </p>
    </div>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';
    
    export default {
        data() {
            return {
                body: '',
                completed: false
            };
        },
        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                suffix: ', ',
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });
                    }
                }
            });
        },
        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },
        methods: {
            addReply() {
                 axios.post(location.pathname + '/replies', { body: this.body })
                    .then(({data}) => {
                        this.body = '';
                        this.completed = true;
                        flash('Your reply has been posted.');
                        this.$emit('created', data);
                    });
            }
        }
    }
</script>