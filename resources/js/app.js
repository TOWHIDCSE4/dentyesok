require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import * as filters from './filters';
Vue.use(VueRouter);
Vue.use(ElementUI);

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

import routers from './routes';

const router = new VueRouter({
    mode: 'history',
    routes: routers
})

const app = new Vue({
    el: '#app',
    router
});
