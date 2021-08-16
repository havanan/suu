
import Vue from 'vue';
import ProductList from "./components/Product/ProductList";
import FromProduct from "./components/Product/FromProduct";
import UnitList from "./components/Product/Unit/UnitList";
import StockList from "./components/Stock/StockList";
import CategoryList from "./components/Product/Category/CategoryList";
import vue2Dropzone from 'vue2-dropzone';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VSelect from 'vue-select';
import VueToast from 'vue-toast-notification';
import {myMixin} from './mixin';


Vue.mixin(myMixin);

require('./bootstrap');
window.Vue = require('vue').default;
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueToast);

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
