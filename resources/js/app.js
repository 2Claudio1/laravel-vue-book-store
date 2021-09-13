require('./bootstrap')

window.Vue = require('vue').default

import store from "./stores/global-store"

import App from './App.vue'
import HomeComponent from './components/home'
import LoginComponent from './components/login'
import passwordComponent from './components/changePassword'
import catalogComponent from './components/catalog'
import cartComponent from './components/cart'
import purchasesComponent from './components/purchases'

import Toasted from 'vue-toasted'

Vue.use(Toasted, {
    position: 'top-center',
    duration: 5000,
    type: 'info',
})

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
    { path: '/', redirect: '/books' },
    //    { path: '/home', component: HomeComponent },
    { path: '/home', redirect: '/books' },
    { path: '/login', component: LoginComponent },
    { path: '/password', component: passwordComponent },
    { path: '/books', component: catalogComponent },
    { path: '/mypurchases', component: purchasesComponent },
    { path: '/pendingpurchases', component: purchasesComponent },
    { path: '/cart', component: cartComponent },
]

const router = new VueRouter({
    routes: routes
})

new Vue({
    render: h => h(App),
    router,
    store,
    created() {
        this.$store.dispatch('loadUserLogged')
        this.$store.dispatch('rebuildCartFromStorage')
    }
}).$mount('#app')