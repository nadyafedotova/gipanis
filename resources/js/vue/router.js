import Vue from 'vue'

import VueRouter from 'vue-router'

import Login from './components/Login.vue'

var routes = [{
    mode: 'history',
    path: '/',
    name: 'root',
    redirect: '/dashboard',
    children: [
        {
            name: 'login',
            path: '/login',
            component: Login,
            meta: {
                title: "Login",
                breadcrumb: ``,
                auth: false
            }
        }
    ]
// routes: [
//     // {path: '/', component: Search},
//
//     {path: '*', redirect: '/'}
// ]
}];

Vue.use(VueRouter)

const router = new VueRouter({
    // mode: 'history',
    routes: routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'active--exact'
});

export default router