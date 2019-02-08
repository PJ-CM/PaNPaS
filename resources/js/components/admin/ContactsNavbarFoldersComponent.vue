<template>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-primary btn-block mb-3 disabled">Redactar</a>

                                <div id="contacts-folders" class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Carpetas</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="nav nav-pills flex-column">
                                            <li v-if="$route.name == 'contacts_list'" class="nav-item active">
                                                <div class="nav-link text-info">
                                                    <i class="fas fa-inbox"></i> Bandeja de entrada
                                                    <span v-if="elems_no_papelera_leido_no_tot > 0" class="badge bg-primary float-right" title="Mensaje(s) sin leer">{{ elems_no_papelera_leido_no_tot }}</span>
                                                </div>
                                            </li>
                                            <li v-else class="nav-item">
                                                <div class="nav-link">
                                                    <router-link :to="{ name: 'contacts_list' }" title="Abrir la Bandeja de entrada" class="nav-link">
                                                        <i class="fas fa-inbox"></i> Bandeja de entrada
                                                        <span v-if="elems_no_papelera_leido_no_tot > 0" class="badge bg-primary float-right" title="Mensaje(s) sin leer">{{ elems_no_papelera_leido_no_tot }}</span>
                                                    </router-link>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-envelope"></i> Enviados
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-trash-alt"></i> Papelera
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /. box -->
                            </div>
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
                elems_no_papelera_leido_no_tot: 0,
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
                    this.elems_no_papelera_leido_no_tot = response.data.elems_no_papelera_leido_no_tot
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
