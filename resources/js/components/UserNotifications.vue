<template>
    <li class="nav-link dropdown" v-if="notifications.length">
        <span class="badge rounded-circle badge-danger" style="float:right; position:relative; margin-top:-2px; margin-left:-8px; font-size: 60%">{{ notifications.length }}</span>
        <a href="#" class="text-secondary" data-toggle="dropdown">
            <span class="fas fa-bell fa-lg"></span>
        </a>
        
        <div class="dropdown-menu pt-0 border-0 pb-0 bg-transparent" style="min-width: 20rem;">
            <div class="p-3 mb-2 shadow-sm border border-light rounded bg-white" role="alert" v-for="notification in notifications">
                <a :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)"
                   class="text-info"
                ></a>
            </div>
        </div>
    </li>
    <li class="nav-link dropdown" v-else>
        <span class="badge rounded-circle badge-danger"></span>
        <a href="#" class="text-secondary">
            <span class="far fa-bell"></span>
        </a>
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