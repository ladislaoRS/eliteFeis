<script>
    export default {
        props: ['attributes'],
        
        data () {
            return {
                editing: false,
                body: this.attributes.body
            };
        },
        
        methods: {
            update () {
                axios.patch('/posts/' + this.attributes.id, {
                    body: this.body
                });
                this.editing = false;
                
                flash("Post has been updated!")
            },
            
            destroy () {
                axios.delete('/posts/' + this.attributes.tag+ "/" + this.attributes.id);
                
                window.location.href = "/posts";
                
                $(this.$el).fadeOut(300, () => {
                   flash('Post has been deleted!'); 
                });
            }
        }
    }
</script>