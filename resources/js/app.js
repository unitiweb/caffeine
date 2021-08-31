require('@/bootstrap');

window.Vue = require('vue');
import App from '@/App.vue'
import store from '@/store'
import router from '@/router'

// Tailwind Settings
import VueTailwind from 'vue-tailwind'
import VueTailwindTheme from '@/theme'
window.Vue.use(VueTailwind, VueTailwindTheme)

import Http from '@/scripts/http'
window.Vue.use(Http)

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
})
