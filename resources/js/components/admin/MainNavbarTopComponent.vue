<template>
            <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <router-link to="/admin/dashboard" class="nav-link" title="Ir al Dashboard">Dashboard</router-link>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> -->
                </ul>

                <!-- SEARCH FORM
                <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form> -->

                <!-- Right navbar links -->
                <ul id="icos-alerts" class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" title="Mensaje(s) sin leer">
                            <i id="ico_msg" class="fas fa-comments"></i>
                            <span v-if="elemsTop_no_papelera_leido_no_tot > 0" class="badge badge-primary navbar-badge">{{ elemsTop_no_papelera_leido_no_tot }}</span>
                        </a>
                        <div v-if="elems_Top3LeidoNo.length == 0" id="dropdown-menu-top3-lno" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <router-link to="/admin/contacts" class="dropdown-item dropdown-footer text-center" title="Ir a Mensajes">
                                Ver Todos los Mensajes
                            </router-link>
                        </div>
                        <div v-else id="dropdown-menu-top3-lno" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- Message Start -->
                            <div v-for="(elem_Top3LNo, index) in elems_Top3LeidoNo" :key="index">
                                <router-link :to="{ name: 'contact_msg', params: {id: elem_Top3LNo.id} }" :title="'Ver mensaje de ' + elem_Top3LNo.correo" class="dropdown-item">
                                    <div class="media">
                                        <img src="/admin/images/user_icon_gnral.png" alt="Avatar de usuario no registrado" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                {{ elem_Top3LNo.nombre }}
                                            </h3>
                                            <p class="text-sm">{{ elem_Top3LNo.asunto | resumenTxt_Top3LNo }}</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ elem_Top3LNo.created_at | formatFHHaceTanto }}</p>
                                        </div>
                                    </div>
                                </router-link>
                                <!-- Message End -->
                                <div class="dropdown-divider"></div>
                            </div>

                            <router-link to="/admin/contacts" class="dropdown-item dropdown-footer text-center" title="Ir a Mensajes">
                                Ver Todos los Mensajes
                            </router-link>
                        </div>
                    </li>

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" title="Usuario(s) conectado(s)">
                            <i id="ico_notif" class="fas fa-bell"></i>
                            <span v-if="elems_users_online.length > 0" class="badge badge-success navbar-badge">{{ elems_users_online.length }}</span>
                        </a>
                        <div v-if="elems_users_online.length == 0" id="dropdown-menu-top3-online" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Ningún Usuario Conectado</span>
                            <div class="dropdown-divider"></div>
                            <router-link :to="{ name: 'users_list' }" class="dropdown-item dropdown-footer text-center" title="Ir a Usuarios">
                                Ir al Apartado de Usuarios
                            </router-link>
                        </div>
                        <div v-else id="dropdown-menu-top3-online" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">Top3 Últimos Conectados</span>
                            <div class="dropdown-divider"></div>
                            <div v-for="(elem_Top3Onl, index) in elems_users_online.slice(0, listLimit)" :key="index">
                                <router-link :to="{ name: 'user_profile', params: {id: elem_Top3Onl.id} }" :title="'Ver perfil de ' + elem_Top3Onl.name + ' ' + elem_Top3Onl.lastname" class="dropdown-item">
                                    <img :src="elem_Top3Onl.avatar" alt="Avatar del usuario" class="img-size-50 mr-3 img-circle" style="border: green 2px solid;"> {{ '@' + elem_Top3Onl.username }}
                                    <span class="float-right text-muted text-sm">{{ elem_Top3Onl.last_access_at | formatFHHaceTanto }}</span>
                                </router-link>
                                <div class="dropdown-divider"></div>
                            </div>
                            <a href="#" class="dropdown-item dropdown-footer text-center" data-widget="control-sidebar" data-slide="true" title="Ver Usuarios Conectados">
                                Ver Lista Completa
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
</template>

<script>
    export default {
        mounted() {//o created()
            console.log('Component mounted.')

            //para cargar el listado de registros no leidos al llegar al componente
            this.getElemsTotNoLeidos();

            //para cargar el listado de usuarios conectados al llegar al componente
            ////this.getElemsList();
            //Recibiendo notificación desde cada cambio de apartado
            //para cargar un listado de usuarios conectados actualizado
            BusEvent.$on('notifCargaUsersOnlineEvent', () => {
                //reiniciando cada vez para evitar repeticiones
                this.elems_users_online = [];
                this.getElemsList();
            });

            //Recibiendo notificación de todo evento que cambie el total de correos no leidos
            BusEvent.$on('notifRecargaLeidosNoTotEvent', () => {
                this.notifRecargaLeidosNoTot();
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                urlBaseContacts: '/api/contacts',
                urlBaseUsers: '/api/users',
                elemsTop_no_papelera_leido_no_tot: 0,
                //Puede ser también     >>      elemsTop3_LeidoNo: [],
                elems_Top3LeidoNo: {},  //variable contenedora de los registros a listar
                elems_users: {},
                //elems_users_online: {},
                elems_users_online: [],
                listLimit: 3,
            }
        },

        methods: {

            /**
             * Obteniendo TOT de los no leidos
            */
            getElemsTotNoLeidos() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBaseContacts + '/no-readed/tot';
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    ////console.log(response.data)
                    this.elemsTop_no_papelera_leido_no_tot = response.data
                    //Habiendo algún mensaje no leido fuera de la papelera...
                    if(this.elemsTop_no_papelera_leido_no_tot > 0) {
                        this.getElemsTop3NoLeidos();
                    }
                });
            },

            /**
             * Obteniendo TOP3 de los no leidos
            */
            getElemsTop3NoLeidos() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBaseContacts + '/no-readed/top3';
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    ////console.log(response.data)
                    this.elems_Top3LeidoNo = response.data
                });
            },

            /**
             * Obteniendo lista
            */
            getElemsList() {
                //1: se obtienen todos los usuarios
                //----------------------------------------------------
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBaseUsers + '/online/list';
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    console.log('Usuarios a evaluar si están conectados:', response.data)
                    this.elems_users = response.data
                    //////Habiendo algún mensaje no leido fuera de la papelera...
                    ////if(this.elemsTop_no_papelera_leido_no_tot > 0) {
                    ////    this.getElemsTop3NoLeidos();
                    ////}
                    //Filtrando solamente los conectados
                    this.getElemsListOnline();
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

            /**
             * Filtrando los usuarios que están conectados
             * necesario para calcular el total de los mismos
            */
            getElemsListOnline() {
                //2: Recuperando solo los conectados
                //----------------------------------------------------------

                /**
                 * Sin saber el POR QUé, aunque en otras pruebas de ARRAY de Objetos
                 * esta forma de recorrer y rellenar otro array con los objetos recorridos
                 * funciona, en este caso, da este ERROR:
                 *      Uncaught (in promise) TypeError: Cannot read property 'data' of undefined
                 *      >> el ERROR se refleja cuando se llega a esta línea, en el momento
                 *      que se quiere añadir un element
                 *          this.elems_users_online.push(elem_usu);
                 *
                 * Cualquiera de las otras dos si funcionan
                 */

                //CON Error
                //--------------------------------------------------------------------------

                /*let index = 0;
                let elem_usu;
                this.elems_users.forEach(function(elem_usu) {
                    elem_usu = this.elems_users[index];
                    console.log('El valor de conectado es [' + elem_usu.isOnline + ']');

                    if(elem_usu.isOnline) {
                        console.log('El ID = [' + elem_usu.id + '] está conectado');
                        //se añade a la lista
                        //this.elems_users_online.push(elem_usu);
                        //this.elems_users_online[0] = 'elem_usu';
                        //---------------------------------------------
                        this.elems_users_online.push('elem_usu');
                    } else {
                        console.log('[' + elem_usu.id + '] No conectado');
                    }
                    index++;
                })*/

                //SIN Error (cualquiera de las dos siguentes funcionan)
                //--------------------------------------------------------------------------
                //  En ambos casos, la variable "elems_users_online" debe ser de tipo ARRAY
                //  para poder añadirle elementos con push():
                //      elems_users_online: []

                /*let i, elem_usu;
                for(i = 0; i < this.elems_users.length; i++) {
                    elem_usu = this.elems_users[i];

                    if(elem_usu.isOnline) {
                        console.log('El ID = [' + elem_usu.id + '] está conectado');
                        //se añade a la lista
                        this.elems_users_online.push(elem_usu);
                    } else {
                        console.log('[' + elem_usu.id + '] No conectado');
                    }
                }*/

                /**
                 * Se obtiene cada dimensión del array "elemKey" gracias al cuál
                 * se pueden examinar los valores del cada uno de los objetos "elem_usu"
                 * recorridos en el bucle
                 */
                let elem_usu;
                Object.keys(this.elems_users).forEach((elemKey) => {
                    elem_usu = this.elems_users[elemKey];

                    if(elem_usu.isOnline) {
                        //se añade a la lista de los conectados
                        this.elems_users_online.push(elem_usu);
                    }
                })/**/

                console.log('Cantidad de conectados: [' + this.elems_users_online.length + ']');
                //Mandando lista al panel derecho emergente
                BusEvent.$emit('notifRecargaOnLineListEvent', this.elems_users_online);
            },

            /**
             * Recarga de:
             *      >> total de mensajes no leidos
             *          => top3 de mensajes no leidos
            */
            notifRecargaLeidosNoTot() {
                this.getElemsTotNoLeidos();
            },

        }
    }
</script>
