require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import HighchartsVue from 'highcharts-vue'; // <--- Nambah ini
import moment from 'moment'; // <---- Nambah Ini

import App from './App.vue';
Vue.use(VueAxios, axios);
Vue.use(HighchartsVue) // <--- Plugin Highchart untuk vue;
Vue.prototype.moment = moment // <--- Plugin Moment, untuk format tanggal bentukan dari internetnya gini;

// Sebelum Pake Plugin diatas install plugin nya dulu lewat npm (console)
// npm install highcharts-vue --save
// nmp install moment --save

import HomeComponent from './components/HomeComponent.vue';
import CreateComponent from './components/CreateComponent.vue';
import IndexComponent from './components/IndexComponent.vue';
import EditComponent from './components/EditComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import Header from './components/Header.vue';


const routes = [
  {
      name: 'home',
      path: '/home',
      component: HomeComponent
  },
  {
      name: 'create',
      path: '/create',
      component: CreateComponent
  },
  {
      name: 'posts',
      path: '/posts',
      component: IndexComponent
  },
  {
      name: 'edit',
      path: '/edit/:id_data',
      component: EditComponent
  },
  {
    name: 'login',
    path: '/',
    component: LoginComponent
  }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');