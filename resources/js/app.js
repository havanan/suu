
import Vue from 'vue';
// import Router from 'vue-router';
import App from './components/AppComponent';
// import routes from './router/routes';
import TableComponent from "./components/TableComponent";
import Notifications from 'vue-notification';
import ProductList from "./components/Product/ProductList";
import FromProduct from "./components/Product/FromProduct";
import vSelect from 'vue-select'
import store from './store'
require('./bootstrap');

window.Vue = require('vue').default;

// Vue.use(Router);
Vue.use(Notifications);
Vue.component('v-select', vSelect)
Vue.component('TableComponent',TableComponent);
Vue.component('ProductList',ProductList);
Vue.component('FromProduct',FromProduct);

// axios.defaults.withCredentials = true
// axios.defaults.baseURL = process.env.APP_URL + '/api/v1/manager/'

// const router = new Router({
//     routes,
//     mode: 'history'
// });
const app = new Vue({
    el: '#app',

    // render: h => h(App),
    // router,
    // store
});
