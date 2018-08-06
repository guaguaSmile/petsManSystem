import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';
import jQuery from 'jquery';
import {routes} from "./router/routes";
// import Index from './components/Index.vue';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter, Axios);

jQuery.extend(true, jQuery.fn.datetimepicker, {
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times-circle'
    }
});
const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.component('index', require('./components/Index.vue'));
Vue.component('headcom', require('./components/common/HeadCom.vue'));
Vue.component('footerCom', require('./components/common/FooterCom.vue'));
Vue.component('page', require('./components/common/PageNavigation.vue'));
Vue.component('siderBar', require('./components/common/SiderBar.vue'));
// Vue.component('category', require('./components/common/SiderBar.vue'));

const app = new Vue({
    el: '#app',
    router
       /* component: {
            Index
        }*/
});
