
import Vue from 'vue';
import Notifications from 'vue-notification';
import ProductList from "./components/Product/ProductList";
import FromProduct from "./components/Product/FromProduct";
import UnitList from "./components/Product/Unit/UnitList";

require('./bootstrap');
window.Vue = require('vue').default;
Vue.use(Notifications);
Vue.component('ProductList',ProductList);
Vue.component('FromProduct',FromProduct);
Vue.component('UnitList',UnitList);


const app = new Vue({
    el: '#app',
});
