// require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform' 
import Swal from 'sweetalert2'
import Axios from 'axios'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.axios = Axios
window.Form = Form
window.swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    // timerProgressBar: true,
})

window.toast = Toast
Vue.use(VueRouter)


let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default},
    { path: '/items', component: require('./components/Items.vue').default},
    { path: '/profile', component: require('./components/Profile.vue').default}
]
  
const router = new VueRouter({
    mode: 'history',
    routes
  })


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
