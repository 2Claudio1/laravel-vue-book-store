import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        cart: [],
    },
    mutations: {
        clearUser(state) {
            state.user = null
            state.cart = []
            localStorage.removeItem('cart')
        },
        setUser(state, user) {
            state.user = user
        },
        clearCart(state) {
            state.cart = []
            localStorage.removeItem('cart')
        },
        setCart(state, cart) {
            state.cart = cart
            localStorage.setItem('cart', state.cart)
        },
        addItemToCart(state, item) {
            const record = state.cart.find(p => p.item.id === item.id)

            if (!record) {
                state.cart.push({
                    item,
                    quantity: 1
                })
            } else {
                record.quantity++
            }
            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
        incrementItemNumber(state, item) {

            const record = state.cart.find(p => p.item.id === item.id)

            record.quantity++;

            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
        decrementItemNumber(state, item) {

            const record = state.cart.find(p => p.item.id === item.id)
            if (record.quantity > 1) {
                record.quantity--
            }

            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
        removeItem(state, item) {
            const itemToDelete = state.cart.find(p => p.item.id === item.id)
            state.cart = state.cart.filter(function(elements) { return elements.item.id != itemToDelete.item.id; });
            localStorage.setItem('cart', JSON.stringify(state.cart))
        },
    },
    actions: {
        loadUserLogged(context) {
            axios.get('/api/users/me')
                .then(response => {
                    context.commit('setUser', response.data)
                })
                .catch(error => {
                    context.commit('clearUser')
                })
        },
        rebuildCartFromStorage(context) {
            if (localStorage.getItem('cart') === null) {
                context.commit('clearCart')
            } else {
                context.commit('setCart', JSON.parse(localStorage.getItem('cart')))
            }
        },
        incrementItem: ({ commit }, payload) => {
            commit('incrementItemNumber', payload)
        },
        decrementItem: ({ commit }, payload) => {
            commit('decrementItemNumber', payload)
        },
        removeItemFromCart: ({ commit }, payload) => {
            commit('removeItem', payload)
        },
    }
})