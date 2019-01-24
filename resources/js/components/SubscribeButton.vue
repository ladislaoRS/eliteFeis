<template>
    <button :class="isActive ? 'btn btn-success btn-sm': 'btn btn-outline-success btn-sm'" 
        @click="subscribe" 
        v-text="isActive ? 'Subscribed' : 'Subscribe'">
    </button>
</template>

<script>
    export default {
        props: ["active"],
    
        data() {
            return {
                isActive: this.active
            };
        },
    
        methods: {
            subscribe() {
                axios[this.isActive ? "delete" : "post"](
                    location.pathname + "/subscriptions"
                );
    
                this.isActive = !this.isActive;
    
                if (this.isActive) {
                    flash("Okay, we'll notify you when this post is updated!");
                }
            }
        }
    };
</script>