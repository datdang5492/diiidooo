require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueResource from 'vue-resource';
import VeeValidate from 'vee-validate';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// vue bootstrap datepicker
// https://www.npmjs.com/package/vue-bootstrap-datetimepicker
import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

Vue.use(datePicker);

// routing
import VueRouter from 'vue-router';
import Routes from './routes'

// font awesome
import {library} from '@fortawesome/fontawesome-svg-core';
import {faCoffee} from '@fortawesome/free-solid-svg-icons';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {fab} from '@fortawesome/free-brands-svg-icons';

library.add(fab);
library.add(faCoffee);
Vue.component('fa', FontAwesomeIcon);

Vue.use(VeeValidate, {
    // validity: true
});

Vue.use(BootstrapVue);
Vue.use(VueResource);
Vue.use(VueRouter);

Vue.config.productionTip = false;
Vue.http.options.emulateJSON = true;

Vue.http.options.root = 'http://localhost:8080';

// datetime converter
Vue.use(require('vue-moment'))

const router = new VueRouter({
    mode: 'history',
    routes: Routes
});

Vue.http.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');

Vue.prototype.$authStatus =
    document.querySelector('input[name="login-status"]').getAttribute('data-login-status');

// export const bus = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(App),
    router: router,
});
