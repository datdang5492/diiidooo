require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueResource from 'vue-resource';
import VeeValidate from 'vee-validate';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// routing
import VueRouter from 'vue-router';
import Routes from './routes'


// shards
// https://designrevision.com/docs/shards-vue/getting-started
import ShardsVue from 'shards-vue'
import 'shards-ui/dist/css/shards.css'
import 'shards-ui/dist/css/shards-extras.min.css'

// font awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fab } from '@fortawesome/free-brands-svg-icons'

library.add(fab)
library.add(faCoffee)
Vue.component('fa', FontAwesomeIcon)



Vue.use(BootstrapVue);
Vue.use(ShardsVue);
Vue.use(VeeValidate);
Vue.use(VueResource);
Vue.config.productionTip = false;
Vue.use(VueRouter);


const router = new VueRouter({
    mode: 'history',
    routes: Routes
});

export const bus = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(App),
    router: router
});
