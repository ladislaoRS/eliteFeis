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
                axios.patch('/posts/' + this.data.tag.slug + '/' + this.data.slug, {
                    body: this.body
                });
                this.editing = false;
                
                flash("Post has been updated!")
            },
            
            destroy () {
                axios.delete('/posts/' + this.data.tag.slug + '/' + this.data.slug);
                
                window.location.href = "/";
                
                $(this.$el).fadeOut(300, () => {
                   flash('Post has been deleted!'); 
                });
            }
        }
    }
</script>