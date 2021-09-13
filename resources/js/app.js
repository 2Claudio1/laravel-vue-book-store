require('./bootstrap')

window.Vue = require('vue').default

import store from "./stores/global-store"

import App from './App.vue'
import HomeComponent from './components/home'
import LoginComponent from './components/login'

import Toasted from 'vue-toasted'

Vue.use(Toasted, {
    position: 'top-center',
    duration: 5000,
    type: 'info',
})

import VueRouter from 'vue-router'
Vue.use(VueRouter)

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', component: HomeComponent },
    { path: '/login', component: LoginComponent },
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
    }
}).$mount('#app')