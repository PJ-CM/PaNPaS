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
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- Message Start -->
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="images/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>
                            <!-- Message End -->
                            <div class="dropdown-divider"></div>
                            <!-- Message Start -->
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="images/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>
                            <!-- Message End -->
                            <div class="dropdown-divider"></div>
                            <!-- Message Start -->
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="images/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>
                            <!-- Message End -->
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
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

            //para cargar el listado de registros al llegar al componente
            this.getElems();

            //Recibiendo notificación de todo evento que cambie el total de correos no leidos
            BusEvent.$on('notifRecargaLeidosNoTotEvent', () => {
                this.notifRecargaLeidosNoTot();
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                urlBase: '/api/contacts',
                //Puede ser también     >>      elems: [],
                elemsTop: {},  //variable contenedora de los registros a listar
                elemsTop_no_papelera_leido_no_tot: 0,
            }
        },

        methods: {

            /**
             * Obteniendo listado de registros
             * para contar los no leidos
            */
            getElems() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBase;
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    ////console.log(response.data)
                    this.elemsTop_no_papelera_leido_no_tot = response.data.elems_no_papelera_leido_no_tot
                });
            },

            /**
             * Recarga de total de mensajes no leidos
            */
            notifRecargaLeidosNoTot() {
                this.getElems();
            },

        }
    }
</script>
