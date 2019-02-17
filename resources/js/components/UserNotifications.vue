<template>
    <li class="nav-link dropdown" v-if="notifications.length">
        <span class="badge rounded-circle badge-danger" style="float:right; position:relative; margin-top:-2px; margin-left:-8px; font-size: 60%">{{ notifications.length }}</span>
        <a href="#" class="text-secondary" data-toggle="dropdown">
            <span class="fas fa-bell fa-lg"></span>
        </a>
        
        <div class="dropdown-menu pt-0 border pb-0 bg-white" style="min-width: 20rem;">
            <div class="py-2 toast-header bg-light text-dark">
                    <strong class="mr-auto">NOTIFICATIONS</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="border-bottom" role="alert" v-for="notification in notifications">
                <div class="toast-body pb-1">
                    <a :href="notification.data.link"
                       v-text="notification.data.message"
                       @click="markAsRead(notification)"
                       class="text-info"
                    ></a> 
                    <div class="text-muted text-right" v-text="ago(notification)"></div>
                </div>
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
    import moment from 'moment';
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
            },
            ago(notification) {
                return moment(notification.created_at).fromNow();
            },
        }
    }
</script>