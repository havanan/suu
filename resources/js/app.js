
import Vue from 'vue';
// import Notifications from 'vue-notification';
import ProductList from "./components/Product/ProductList";
import FromProduct from "./components/Product/FromProduct";
import UnitList from "./components/Product/Unit/UnitList";
import StockList from "./components/Stock/StockList";
import CategoryList from "./components/Product/Category/CategoryList";
import vue2Dropzone from 'vue2-dropzone';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VSelect from 'vue-select';
// import VueToastr from "vue-toastr";

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

require('./bootstrap');
window.Vue = require('vue').default;
// Vue.use(Notifications);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
// Vue.use(VueToastr, {
//     /* OverWrite Plugin Options if you need */
// });
//product
Vue.component('ProductList',ProductList);
Vue.component('FromProduct',FromProduct);
//category
Vue.component('CategoryList',CategoryList);
//unit
Vue.component('UnitList',UnitList);
//stock
Vue.component('StockList',StockList);

Vue.component('VSelect',VSelect);
Vue.component('vueDropzone',vue2Dropzone);

const app = new Vue({
    el: '#app',
});
