import Vuex from 'vuex'
import Vue from 'vue'
// import config from '@/config'
// import moment from 'moment'
// import { updateObject } from '@/scripts/helpers/utils'
// import budgetTasks from '@/scripts/budgetTasks'
// import { $http } from '@/scripts/http'

// Add Vuex to the Vue instance
Vue.use(Vuex)

// Define the store
export default new Vuex.Store({
    state: {
        apiToken: null,
        appLoaded: false
    },
    getters: {
        apiToken: state => {
            const token = localStorage.getItem('CAFFEINE_API_TOKEN')
            state.apiToken = token
            return token
        },
        appLoaded: state => state.appLoaded
    },
    mutations: {
        apiToken (state, token) {
            if (!token) {
                localStorage.removeItem('CAFFEINE_API_TOKEN')
                state.appToken = null
                state.appLoaded = false
            } else {
                localStorage.setItem('CAFFEINE_API_TOKEN', token)
                state.appToken = token
                state.appLoaded = true
            }
        },
        logout (state) {
            localStorage.removeItem('CAFFEINE_API_TOKEN')
            state.apiToken = null
            state.appLoaded = false
        }
    },
    actions: {
        login ({ commit }, token) {
            commit('apiToken', token)
        },
        logout ({ commit }) {
            commit('logout')
        }
    }
})
