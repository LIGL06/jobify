require('./bootstrap');
window.Vue = require('vue');
Vue.component('notification', require('./components/notification.vue'));
const app = new Vue({
    el: '#app',
    data: {
        notifications: '',
        loading: false,
    },
    created() {
        if (window.Laravel.user.id != null) {
            loading = true;
            axios.post(process.env.MIX_APP_URL + 'notifications').then(response => {
                this.notifications = response.data;
                loading = false;
            });
            Echo.private('App.User.' + window.Laravel.user.id).notification((response) => {
                data = {"data": response};
                this.notifications.push(data);
            });
        }
    },
    methods: {

    }
});
