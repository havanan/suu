
import Vue from 'vue';
import Notifications from 'vue-notification';
import ProductList from "./components/Product/ProductList";
import FromProduct from "./components/Product/FromProduct";
import UnitList from "./components/Product/Unit/UnitList";
import vue2Dropzone from 'vue2-dropzone';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VSelect from 'vue-select';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

require('./bootstrap');
window.Vue = require('vue').default;
Vue.use(Notifications);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.component('ProductList',ProductList);
Vue.component('FromProduct',FromProduct);
Vue.component('UnitList',UnitList);
Vue.component('VSelect',VSelect);
Vue.component('vueDropzone',vue2Dropzone);

const app = new Vue({
    el: '#app',
});
