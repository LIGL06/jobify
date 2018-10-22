<template>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
           data-toggle="dropdown"
           aria-expanded="false"><i class="fa fa-globe"></i> Notifications <span
                class="badge badge-danger"
                id="count-notification">
                                 {{notifications.length}}<span
                class="caret"></span></span>
        </a>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-for="notification in notifications" v-on:click="MarkAsRead(notification)">
                {{notification.data['message']}}
            </a>
            <a href="#" class="dropdown-item" v-if="notifications.length == 0">
                No notification
            </a>
        </div>
    </li>
</template>
<script>
    export default {
        props: ['notifications'],
        methods: {
            MarkAsRead: function (notification) {
                var data = {
                    not_id: notification.id,
                    notification_id: notification.data.notification.id,
                };
                alert(data.not_id);
            },
        }
    }
</script>