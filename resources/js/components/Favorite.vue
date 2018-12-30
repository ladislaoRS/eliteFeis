<template>
    <button @click.prevent="toggle" type="submit" title="Favorite" class="btn btn-link pt-4 pl-0 pb-0">
        <span class=""><i :class="classes"></i></span>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return [
                    this.active ? 'fas fa-heart fa-lg' : 'far fa-heart fa-lg'
                ];
            },
            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },
            
            create() {
                axios.post(this.endpoint);

                this.active = true;
                this.count++;
            },

            destroy() {
                axios.delete(this.endpoint);

                this.active = false;
                this.count--;
            }
        }
    }

</script>