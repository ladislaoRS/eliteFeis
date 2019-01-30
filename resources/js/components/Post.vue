<script>
    import Replies from './Replies.vue';
    import NewReply from './NewReply.vue';

    export default {
        components: { 
            Replies,
            NewReply
        },
        
        props: ['data', 'initialRepliesCount'],
        
        data () {
            return {
                editing: false,
                body: this.data.body,
                repliesCount: this.initialRepliesCount
            };
        },
        
        methods: {
            update () {
                axios.patch('/posts/' + this.data.id, {
                    body: this.body
                });
                this.editing = false;
                
                flash("Post has been updated!")
            },
            
            destroy () {
                axios.delete('/posts/' + this.data.tag+ "/" + this.data.id);
                
                window.location.href = "/posts";
                
                $(this.$el).fadeOut(300, () => {
                   flash('Post has been deleted!'); 
                });
            }
        }
    }
</script>