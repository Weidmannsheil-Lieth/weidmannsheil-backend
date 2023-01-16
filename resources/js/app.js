import Vue from 'vue';
import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';
import '@fortawesome/fontawesome-free/css/all.css';
import VueTheMask from 'vue-the-mask'
import Dates from './mixins/Dates';
import axios from './plugins/axios';
import vuetify from "./plugins/vuetify";
import store from './plugins/store';
import router from './plugins/router';
import App from './App.vue';

let app = null;

Vue.mixin(Dates);

Chartkick.options = {
    colors: [
        '#002a68',
        '#00b1eb',
        '#f4741f',
        '#ffbb00',
        '#50af47',
        '#afca0b',
        '#5a328a',
        '#e72582',
    ]
};

Vue.use(Chartkick.use(Chart));
Vue.use(VueTheMask);

if (store.getters['auth/isAuth'] && !store.getters['auth/user']) {
    Promise.all([
        store.dispatch('auth/getAuth'),
    ]).finally(() => mountApp());
} else {
    mountApp();
}

function mountApp() {
    app = new Vue({
        router,
        axios,
        vuetify,
        store,
        render: h => h (App),
    }).$mount('#app');
}

export default app;
