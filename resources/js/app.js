
require('./bootstrap');
import swal from 'sweetalert';

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import routes from './routes';
const router = new VueRouter({
    routes
});

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('add-task', require('./components/AddTask.vue').default);
Vue.component('edit-task', require('./components/EditTask.vue').default);


import navbar from './components/navbar';
import task from './components/Task';


const app = new Vue({
    el: '#app',
    router,
    components: {
        navbar,
        task,
    },
});
