require('./bootstrap');
window.Vue = require('vue');

Vue.component('notification', require('./components/notification.vue'));

const app = new Vue({
    el: '#app',
    data: {
        notifications: '',
    },
    created() {
        console.log(window.Laravel.user.id);
        if (window.Laravel.user.id) {
            axios.post('notifications').then(response => {
                this.notifications = response.data;
            });
            Echo.private('App.user.' + window.Laravel.user.id).notification((response) => {
                data = {"data": response};
                this.notifications.push(data);
            });
        }
    }
});
