
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

//Importando Vue-Google.Charts
import VueGoogleCharts from 'vue-google-charts'
//  >> Indicando a Vue que utilice VueGoogleCharts
Vue.use(VueGoogleCharts);

//Importando Moment
import moment from 'moment';

//Importando DatetimePicker
import datePicker from 'vue-bootstrap-datetimepicker';
//  >> Indicando a Vue que utilice DatetimePicker
Vue.use(datePicker);

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
    //  =>> :: DASHBOARD ::
    { path: patron + '/dashboard', name: 'dashboard', component: require('./components' + patron + '/DashboardComponent.vue').default },
    // ----------------------------------------------------
    //  =>> :: USUARIOS ::
    { path: patron + '/users', name: 'users_list', component: require('./components' + patron + '/UsersComponent.vue').default },
    //{ path: patron + '/profile', name: 'profile', component: require('./components' + patron + '/ProfileComponent.vue').default },
    //Ruta dinámica pasándole un parámetro ID
    { path: patron + '/users/:id', name: 'user_profile', component: require('./components' + patron + '/UserProfileComponent.vue').default },
    // ----------------------------------------------------
    //  =>> :: CONTACTOS ::
    { path: patron + '/contacts', name: 'contacts_list', component: require('./components' + patron + '/ContactsComponent.vue').default },
    { path: patron + '/contacts/sended', name: 'contacts_sended_list', component: require('./components' + patron + '/ContactsSendedComponent.vue').default },
    { path: patron + '/contacts/trashed', name: 'contacts_trashed_list', component: require('./components' + patron + '/ContactsTrashedComponent.vue').default },
    { path: patron + '/contacts/:id', name: 'contact_msg', component: require('./components' + patron + '/ContactMsgComponent.vue').default },
    { path: patron + '/contacts/search/:term', name: 'contacts_search', component: require('./components' + patron + '/ContactsSearchComponent.vue').default },
]

//Instancia de VueRouter y asignación de rutas
const router = new VueRouter({
    //para que las URL sean referidas al componente a cargar
    //y no a la vista que lo contiene
    mode: 'history',

    routes // forma corta cuando coinciden tanto el nombre del par de variables,  " routes: routes "
})

//Filtros de Vue
//----------------------------------------------------------
//Para resumir textos largos
Vue.filter('resumenTxt', function (value) {
    if (!value) return '-'
    let maxChar = 50;
    if(value.length > maxChar) {
        value = value.substring(0, maxChar).trim() + '...';
    }
    return value;
})
//Para resumir textos largos en Top3 - Barra Superior
Vue.filter('resumenTxt_Top3LNo', function (value) {
    if (!value) return '-'
    let maxChar = 25;
    if(value.length > maxChar) {
        value = value.substring(0, maxChar).trim() + '...';
    }
    return value;
})

//Para formatear fecha/hora en formato "hace tanto-tiempo"
Vue.filter('formatFHHaceTanto', function (value) {
    if (!value) return '-'
    //para definir el idioma del formateo
    moment.locale('es');
    //return moment(value).format('MMMM Do YYYY, hh:mm:ss a');
    return moment(value).fromNow();
})

//Para formatear fecha/hora
//moment().format('MMMM Do YYYY, hh:mm:ss a'); // December 20th 2018, 01:00:59 am
Vue.filter('formatFechaHoraTxt', function (value) {
    if (!value) return '-'
    //para definir el idioma del formateo
    moment.locale('es');
    return moment(value).format('DD MMMM YYYY, hh:mm:ss a');
})
//----------------------------------------------------------


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
Vue.component('main-navbar-top-component', require('./components' + patron + '/MainNavbarTopComponent.vue').default);
Vue.component('aside-right-panel-content-component', require('./components' + patron + '/AsideRightPnlContentComponent.vue').default);
Vue.component('user-ins-edit-component', require('./components' + patron + '/UserInsEditComponent.vue').default);
Vue.component('user-prof-tots-component', require('./components' + patron + '/UserProfTotsComponent.vue').default);
Vue.component('user-prof-activ-component', require('./components' + patron + '/UserProfActivComponent.vue').default);
Vue.component('user-prof-edit-component', require('./components' + patron + '/UserProfEditComponent.vue').default);
Vue.component('contacts-navbar-folders-component', require('./components' + patron + '/ContactsNavbarFoldersComponent.vue').default);

//Vue-infinite-loading :: Paginado Infinito
//  >> Registro del componente
//      ==> dándole un nombre personal con el que manejarlo
//      ==> indicando el nombre real del componente (se puede ver dentro de package.json)
Vue.component('InfiniteLoading', require('vue-infinite-loading'));

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
