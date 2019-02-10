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
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i id="ico_msg" class="fas fa-comments"></i>
                            <span v-if="elemsTop_no_papelera_leido_no_tot > 0" class="badge badge-primary navbar-badge" title="Mensaje(s) sin leer">{{ elemsTop_no_papelera_leido_no_tot }}</span>
                        </a>
                        <div id="dropdown-menu-top3-lno" v-if="elems_Top3LeidoNo.length == 0" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <router-link to="/admin/contacts" class="dropdown-item dropdown-footer text-center" title="Ir a Mensajes">
                                Ver Todos los Mensajes
                            </router-link>
                        </div>
                        <div id="dropdown-menu-top3-lno" v-else class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- Message Start -->
                            <div v-for="(elem_Top3LNo, index) in elems_Top3LeidoNo" :key="index">
                                <router-link :to="{ name: 'contact_msg', params: {id: elem_Top3LNo.id} }" :title="'Ver mensaje de ' + elem_Top3LNo.correo" class="dropdown-item">
                                    <div class="media">
                                        <img src="images/user_icon_gnral.png" alt="Avatar de usuario no registrado" class="img-size-50 mr-3 img-circle">
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
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i id="ico_notif" class="fas fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
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

            //Recibiendo notificación de todo evento que cambie el total de correos no leidos
            BusEvent.$on('notifRecargaLeidosNoTotEvent', () => {
                this.notifRecargaLeidosNoTot();
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                urlBase: '/api/contacts',
                elemsTop_no_papelera_leido_no_tot: 0,
                //Puede ser también     >>      elemsTop3_LeidoNo: [],
                elems_Top3LeidoNo: {},  //variable contenedora de los registros a listar
            }
        },

        methods: {

            /**
             * Obteniendo TOT de los no leidos
            */
            getElemsTotNoLeidos() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBase + '/no-readed/tot';
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
                let url = this.urlBase + '/no-readed/top3';
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
