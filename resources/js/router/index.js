/**
 * Load the required imports
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueRouterPrefetch from 'vue-router-prefetch'

/**
 * Load the layout components
 */
import BaseLayout from '@/components/layouts/BaseLayout';
import AuthLayout from "@/components/layouts/AuthLayout";
import DashboardLayout from "@/components/layouts/DashboardLayout";

/**
 * Page components
 */
import Login from '@/views/auth/Login';
import Logout from '@/views/auth/Logout';
import Dashboard from "@/views/Dashboard";

/**
 * Middleware
 */
import Authentication from '@/router/middleware/authentication'

/**
 * Add the plugins to the Vue instance
 */
Vue.use(VueRouter)
Vue.use(VueRouterPrefetch)

/**
 * Define the routes
 *
 * @type {{path: string, component: {}, name: string}[]}
 */
const routes = [
    {
        path: '/',
        name: 'Home',
        component: BaseLayout,
        redirect: { name: 'login' },
        children: [
            {
                path: '/auth',
                name: 'auth',
                component: AuthLayout,
                children: [
                    {
                        path: 'login',
                        name: 'login',
                        component: Login
                    }, {
                        path: 'logout',
                        name: 'logout',
                        component: Logout
                    },
                ]
            }, {
                path: 'dashboard',
                name: 'dashboard',
                component: DashboardLayout,
                meta: { privateAccess: true },
                redirect: { name: 'consumed'},
                children: [
                    {
                        path: 'consumed',
                        name: 'consumed',
                        component: Dashboard
                    },
                ]
            }
        ]
    }
]

/**
 * Create the vue router
 *
 * @type {VueRouter}
 */
const router = new VueRouter({
    mode: 'history',
    hash: false,
    routes,
    linkActiveClass: 'active'
})

router.beforeEach(Authentication)

/**
 * Export the vue router
 */
export default router
