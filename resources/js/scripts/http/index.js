/**
 * Gather all the requests files
 */

import { request } from '@/scripts/http/utils';

const context = {
    // Log in the user and get back the access and refresh tokens along with the user details
    login: (email, password) => {
        // password = sha256(password)
        return request('post', ['auth', 'login'], { email, password })
    },

    getDrinks: () => {
        return request('get', ['drinks'])
    },

    populateDrinks() {
        return request('post', ['drinks', 'populate']);
    },

    getConsumed: () => {
        return request('get', ['consumed'])
    },

    addConsumed: (drinkId, amount) => {
        return request('post', ['consumed'], { drinkId, amount })
    },

    updateConsumed: (id, drinkId, amount) => {
        return request('put', ['consumed', id], { drinkId, amount })
    },

    removeConsumed: (id) => {
        return request('delete', ['consumed', id])
    }
}

export const $http = context

export default {
    install(Vue, options) {
        Vue.prototype.$http = context
    }
}
