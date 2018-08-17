
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import DisableAutocomplete from 'vue-disable-autocomplete';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(DisableAutocomplete);
Vue.component('create-truck-load-component', require('./components/CreateTruckLoadComponent.vue'));
Vue.component('index-truck-load-component', require('./components/IndexTruckLoadComponent.vue'));
Vue.component('show-truck-load-component', require('./components/ShowTruckLoadComponent.vue'));
Vue.component('create-purchase-order-component', require('./components/CreatePurchaseOrderComponent.vue'));
Vue.component('index-purchase-order-component', require('./components/IndexPurchaseOrderComponent.vue'));
Vue.component('show-purchase-order-component', require('./components/ShowPurchaseOrderComponent.vue'));

const app = new Vue({
    el: '#app'
});
