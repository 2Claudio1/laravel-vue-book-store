import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
    },
    mutations: {
        clearUser(state) {
            state.user = null
        },
        setUser(state, user) {
            state.user = user
        },
    },
})