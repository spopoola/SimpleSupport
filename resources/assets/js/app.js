import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import NProgress from 'vue-nprogress'
import { sync } from 'vuex-router-sync'
import router from './router'
import store from './store'
import * as filters from './filters'
import { TOGGLE_SIDEBAR } from './store/mutation-types'
import './components/core/'

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import VTooltip from 'v-tooltip'
Vue.use(VTooltip)

import PortalVue from 'portal-vue'
Vue.use(PortalVue)

Vue.router = router
Vue.use(VueAxios, axios)
Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    loginData: { url: '/api/login', fetchUser: false },
    refreshData: { enabled: false },
    authRedirect: { path: '/login' },
    fetchData: { url: 'api/me', method: 'GET', enabled: true },
})

Vue.use(NProgress)

// Enable devtools
Vue.config.devtools = true

sync(store, router)

const nprogress = new NProgress({ parent: '.nprogress-container' })

const { state } = store
router.beforeEach((route, redirect, next) => {
    if (state.app.device.isMobile && state.app.sidebar.opened) {
        store.commit(TOGGLE_SIDEBAR, { opened: false })
    }
    next()
})

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key])
})

window.Events = new Vue()

Vue.component('login', require('./Login.vue'))
Vue.component('app', require('./App.vue'))

const app = new Vue({
    el: '#app',
    router,
    store,
    nprogress,
})

export { app, router, store }
