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

import routes from './routes.js';
import App from './app.vue'


/*createApp(App).use(router).mount('#app');*/

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App).use(router).mount('#app');

/*const vm = Vue.createApp({
    router,
    components: { App }
});

vm.use(VueRouter);
vm.mount('#app');*/