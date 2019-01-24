<template>
    <div class="alert alert-success alert-flash" role="alert" v-show="show">
        {{ body }}
  </button>
</div>
</template>

<script>
    export default {
       props: ['message'],
       
       data() {
           return {
               body: '',
               show: false
           }
       },
       
       created() {
           if (this.message) {
               this.flash(this.message);
           }
           
           window.events.$on('flash', message => this.flash(message));
       },
       
       methods: {
           flash(message) {
             this.body = message; 
             this.show = true;
             
             this.hide();
           },
           
           hide() {
               setTimeout (() => {
                   this.show = false;
               }, 3000);
           }
       }
    }
</script>
<style type="text/css">
    .alert-flash {
        position: fixed;
        right: 1.5rem;
        bottom: 1rem;
        padding: 1rem;
    }
    @media (max-width: 576px) { 
        .alert-flash {
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 0.1rem;
        }
    }

</style>