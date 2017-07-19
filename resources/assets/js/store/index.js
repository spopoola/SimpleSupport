import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import * as getters from './getters'

import app from './modules/app'
import menu from './modules/menu'
import users from './modules/users'
import tickets from './modules/tickets'

Vue.use(Vuex)

const store = new Vuex.Store({
    strict: true,  // process.env.NODE_ENV !== 'production',
    actions,
    getters,
    modules: {
        app,
        menu,
        users,
        tickets,
    }
})

export default store
