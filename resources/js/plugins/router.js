import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('./../components/home/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/aktuelles',
        name: 'aktuelles',
        component: () => import('./../components/aktuelles/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/hinweise',
        name: 'hinweise',
        component: () => import('./../components/hinweise/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/ergebnisse',
        name: 'ergebnisse',
        component: () => import('./../components/ergebnisse/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/galerie',
        name: 'galerie',
        component: () => import('./../components/galerie/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/konigsgespanne',
        name: 'königsgespanne',
        component: () => import('./../components/konigsgespanne/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/leitung',
        name: 'leitung',
        component: () => import('./../components/leitung/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/mail',
        name: 'mail',
        component: () => import('./../components/mail/index.vue'),
        meta: {auth: true}
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./../components/login/index.vue'),
        meta: {auth: false}
    },
    {
        path: '/not-found',
        name: 'not-found',
        component: () => import('./../components/static/not-found/index.vue'),
        meta: {auth: false}
    }
];

const router =  new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    const auth = store.getters['auth/isAuth'];
    if (to.meta.auth && !auth) {
        return next({name: 'login'});
    } else {
        return next();
    }
});

router.afterEach(() => {
    window.scrollTo(0, 0);
})

Vue.use(VueRouter);

export default router;
