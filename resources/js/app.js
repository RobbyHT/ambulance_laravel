/*require('./bootstrap');

window.Vue = require('vue').default;
const swal = (window.swal = require("sweetalert2"));


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('home', require('./components/home.vue').default);


const app = new Vue({
    el: '#app',
});*/

require('./bootstrap');

/*import Vue from 'vue'
import VueRouter from 'vue-router';

import router from './router/index';
import App from './app.vue'*/

/*const app = new Vue({
    el: '#app',
    router,
    components: { App }
});*/


import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'
//import VueRouter from 'vue-router';
import { useLoading } from 'vue3-loading-overlay';
import 'vue3-loading-overlay/dist/vue3-loading-overlay.css';

import routes from './routes.js';
import App from './app.vue'

/*createApp(App).use(router).mount('#app');*/

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App).use(router)
app.config.globalProperties.$loader = useLoading({
    canCancel: false,
    color: '#000000',
    loader: 'dots', //spinner/dots/bars
    width: 50,
    height: 50,
    backgroundColor: '#ffffff',
    opacity: 0.8
});
app.config.globalProperties.$userId = document.querySelector("meta[name='user_id']").getAttribute('content');
app.mount('#app');

/*const vm = Vue.createApp({
    router,
    components: { App }
});

vm.use(VueRouter);
vm.mount('#app');*/