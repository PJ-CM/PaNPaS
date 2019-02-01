
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap_admin');

window.Vue = require('vue');

//Importando Sistema de alertas
import Swal from 'sweetalert2'
//y pasando variable a global para que sea accesible en toda la aplicación
window.Swal = Swal;
//  >> Registrando modo de alerta simple (notificaciones esquina superior)
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
//y pasando variable a global
window.toast = toast;

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
    { path: patron + '/dashboard', name: 'dashboard', component: require('./components' + patron + '/DashboardComponent.vue').default },
    { path: patron + '/users', name: 'users_list', component: require('./components' + patron + '/UsersComponent.vue').default },
    //{ path: patron + '/profile', name: 'profile', component: require('./components' + patron + '/ProfileComponent.vue').default },
    //Ruta dinámica pasándole un parámetro ID
    { path: patron + '/users/:id', name: 'user_profile', component: require('./components' + patron + '/UserProfileComponent.vue').default },
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
Vue.component('user-ins-edit-component', require('./components' + patron + '/UserInsEditComponent.vue').default);
Vue.component('user-prof-tots-component', require('./components' + patron + '/UserProfTotsComponent.vue').default);
Vue.component('user-prof-activ-component', require('./components' + patron + '/UserProfActivComponent.vue').default);
Vue.component('user-prof-edit-component', require('./components' + patron + '/UserProfEditComponent.vue').default);

//Instancia de Vue para emplear como Bus de eventos
//para la emisión/recepción de los mismos de forma global
//  >> Forma larga de declarar variable y registrarla globalmente en el objeto WINDOW
////let BusEvent = new Vue();
////window.BusEvent = BusEvent;
//  >> Forma corta de hacer lo mismo
window.BusEvent = new Vue();

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
