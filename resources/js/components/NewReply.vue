<template>
    <div>
        <div v-if="signedIn">
            <form @submit.prevent="addReply">
            <div class="form-group">
                <textarea name="body"
                          id="body"
                          class="form-control mb-3"
                          placeholder="Have something to say?"
                          rows="5"
                          v-model="body"
                          required>
                </textarea>
                <button type="submit"
                    class="btn btn-outline-primary btn-sm">
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
                body: ''
            };
        },
        mounted() {
            $('#body').atwho({
                at: "@",
                suffix: ', ',
                delay: 750,
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
                        flash('Your reply has been posted.');
                        this.$emit('created', data);
                    });
            }
        }
    }
</script>