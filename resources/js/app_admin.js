
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap_admin');

window.Vue = require('vue');
//Tratamiento de rutas en VueJS a través de VueRouter
//  >> Importando Vue Router
import VueRouter from 'vue-router';
//  >> Indicando a Vue que utilice VueRouter
Vue.use(VueRouter);

//Registro de RUTAS
// ----------------------------------------------------
let patron = '/admin';
//Forma 1d2 :. en dos pasos
//////Definición de componentes
////const Dashboard = require('./components/Dashboard.vue');
////const Profile = require('./components/Profile.vue');
////let routes = [
////    { path: '/dashboard', component: Dashboard },
////    { path: '/profile', component: Profile },
////]
// ----------------------------------------------------
//Forma 2d2 :. en un solo paso
let routes = [
    { path: patron + '/dashboard', component: require('./components/DashboardAdmin.vue').default },
    //{ path: patron + '/profile', component: require('./components/Profile.vue') },
    { path: patron + '/users', component: require('./components/UsersAdmin.vue').default },
]

//Instancia de VueRouter y asignación de rutas
const router = new VueRouter({
    //para que las URL sean referidas al componente a cargar
    //y no a la vista que lo contiene
    mode: 'history',

    routes // forma corta cuando coinciden tanto el nombre del par de variables,  " routes: routes "
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    //pasando el " router " a la instancia de Vue
    router
});
