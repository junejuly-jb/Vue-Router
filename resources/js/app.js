require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform' 

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form = Form


Vue.use(VueRouter)


let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default},
    { path: '/items', component: require('./components/Items.vue').default},
    { path: '/profile', component: require('./components/Profile.vue').default}
]
  
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
