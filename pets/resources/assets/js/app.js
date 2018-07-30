
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('header-cop', require('./components/common/HeaderCop.vue'));
Vue.component('siderbar', require('./components/common/SiderBar.vue'));
Vue.component('footer-cop', require('./components/common/Footer.vue'));
Vue.component('page', require('./components/common/PageNavigation.vue'));
Vue.component('pets-index', require('./components/pets/index.vue'));
Vue.component('user-info', require('./components/user/Index.vue'));
Vue.component('category', require('./components/category/Index.vue'));

const app = new Vue({
    el: '#app'
});
