require('./bootstrap');

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'
import { useLoading } from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import CryptoJS from 'crypto-js'
import swal from 'sweetalert2'
import moment from 'moment'

import routes from './routes.js';
import App from './app.vue'

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
app.config.globalProperties.$CryptoJS = CryptoJS;
app.config.globalProperties.$swal = swal;
app.config.globalProperties.$moment = moment;
app.config.globalProperties.$userId = document.querySelector("meta[name='user_id']").getAttribute('content');
app.config.globalProperties.$cId = document.querySelector("meta[name='c_id']").getAttribute('content');
app.config.globalProperties.$username = document.querySelector("meta[name='username']").getAttribute('content');
app.config.globalProperties.$company = document.querySelector("meta[name='company']").getAttribute('content');

app.mount('#app');