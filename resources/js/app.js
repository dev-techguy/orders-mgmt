window.Vue = require('vue');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('orders-app', require('./components/OrdersApp.vue').default);

const app = new Vue({
    el: '#app'
});