require('./bootstrap');
window.Vue = require('vue');
Vue.component('notification', require('./components/notification.vue'));
const app = new Vue({
    el: '#app',
    data: {
        notifications: '',
    },
    created() {
        if (window.Laravel.user.id != null) {
            axios.post('notifications').then(response => {
                this.notifications = response.data;
            });
            Echo.private('App.User.' + window.Laravel.user.id).notification((response) => {
                data = {"data": response};
                this.notifications.push(data);
            });
        }
    }
});
