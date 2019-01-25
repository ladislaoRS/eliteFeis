<template>
    <li class="nav-link dropdown" v-if="notifications.length">
        <a href="#" class="" data-toggle="dropdown">
            <span class="fas fa-bell"></span>
        </a>
        
        <div class="dropdown-menu pt-0 border-0" style="min-width: 20rem;">
            <div class="alert alert-light alert-dismissible border-1 border-info fade show p-3 mb-2" role="alert" v-for="notification in notifications">
                <a :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)"
                   class="text-info"
                ></a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return { notifications: false }
        },
        created() {
            axios.get('/profiles/' + window.App.user.name + '/notifications')
                .then(response => this.notifications = response.data);
        },
        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>