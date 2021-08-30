import $store from '@/store'
import { $http } from '@/scripts/http'

/**
 * This middleware checks that the user is authenticated.
 * If the user is not authenticated we will redirect to the login page
 *
 * @param to The to route
 * @param from The from route
 * @param next The callback to move on
 */
export default async (to, from, next) => {
    if (to.matched.some(record => record.meta.privateAccess)) {
        // If appLoaded is false then we need to refresh the login
        if ($store.getters.appLoaded === false) {
            try {
                const token = localStorage.getItem('CAFFEINE_API_TOKEN')
                if (token) {
                    await $store.dispatch('login', token)
                } else {
                    await $store.dispatch('logout')
                    next({ name: 'logout' })
                }
            } catch (error) {
                await $store.dispatch('logout')
                next({ name: 'logout' })
            }
        }
    }
    next()
}
