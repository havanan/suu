
import Vue from 'vue';
import Router from 'vue-router';
import App from './components/AppComponent';
import routes from './router/routes';
import Notifications from 'vue-notification';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(Router);
Vue.use(Notifications);

const router = new Router({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
