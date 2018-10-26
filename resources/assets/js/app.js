// app.js


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import ImageComponent from './components/ImageuploadComponent.vue';
import CompaniesIndex from './components/companies/CompaniesIndex.vue';
import ImagesIndex from './components/images/ImagesIndex.vue';
import ImageEdit from './components/images/ImageEdit.vue';

window.Vue.use(VueRouter);

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

const routes = [
    { path: '/foo', component: Foo },
    { path: '/bar', component: Bar },
    { path: '/uploadImage', component: ImageComponent, name: ImageComponent},
    { path: '/companiesIndex', component: CompaniesIndex},
    { path: '/imagesIndex', component: ImagesIndex},
    { path: '/imageEdit', component: ImageEdit},
]

const router = new VueRouter({
    routes // short for `routes: routes`
})

const app = new Vue({
    router
}).$mount('#app')


