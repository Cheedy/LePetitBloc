require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);

Vue.component('pagination',require('laravel-vue-pagination')); // Initie le code de pagination au tag <pagination>
Vue.component('add-task', require('./components/AddTaskComponent.vue').default); // Initie le code du modal ajout de tâche au tag <add-task>
Vue.component('edit-task', require('./components/EditTaskComponent.vue').default); // Initie le modal d'édition au tag <edit-task>

import Home from './components/HomeComponent.vue';
import Task from './components/TaskComponent.vue';

const routes = 
[
    {
        path: '/',
    },
    {
        path: '/tasks',
        component: Task
    }
];

const router = new VueRouter({routes});

const app = new Vue({
    el: '#app',
    router: router
});
