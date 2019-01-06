require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueResource from 'vue-resource';
import VeeValidate from 'vee-validate';
import VueRouter from 'vue-router';
import Routes from './routes';

// shards
// https://designrevision.com/docs/shards-vue/getting-started
import ShardsVue from 'shards-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'shards-ui/dist/css/shards.css'
import 'shards-ui/dist/css/shards-extras.min.css'


import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faCoffee)
Vue.component('fa', FontAwesomeIcon)

Vue.use(ShardsVue);
Vue.use(VeeValidate);
Vue.use(VueResource);
Vue.use(VueRouter);
Vue.config.productionTip = false;

export const bus = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(App)
});