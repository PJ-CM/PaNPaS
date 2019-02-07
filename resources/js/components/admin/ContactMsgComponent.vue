<template>
    <div>

        <!-- CONTENIDO a Mostrar :: ini -->

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Contactos</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><router-link to="/admin/dashboard" title="Ir al Dashboard">Dashboard</router-link></li>
                                    <li class="breadcrumb-item active">Contactos</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <router-link :to="{ name: 'contacts_list' }" title="Volver a la Bandeja de entrada" class="btn btn-primary btn-block mb-3">
                                    Volver a la Bandeja de entrada
                                </router-link>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Carpetas</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="nav nav-pills flex-column">
                                            <li class="nav-item">
                                                <router-link :to="{ name: 'contacts_list' }" title="Abrir la Bandeja de entrada" class="nav-link">
                                                    <i class="fas fa-inbox"></i> Bandeja de entrada
                                                    <span v-if="elems_no_papelera_leido_no_tot > 0" class="badge bg-primary float-right" title="Mensaje(s) sin leer">{{ elems_no_papelera_leido_no_tot }}</span>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link disabled">
                                                    <i class="far fa-envelope"></i> Enviados
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link disabled">
                                                    <i class="far fa-trash-alt"></i> Papelera
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /. box -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-9">
                                <div class="card card-primary card-outline borde-inf-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Mensaje</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="mailbox-read-info">
                                            <h5><strong>{{ objReg.asunto }}</strong></h5>
                                            <h6>de: {{ objReg.nombre }} &lt;{{ objReg.correo }}&gt;
                                            <span class="mailbox-read-time float-right">{{ objReg.created_at | formatFechaHoraTxt }}</span></h6>
                                        </div>
                                        <!-- /.mailbox-read-info -->
                                        <div class="mailbox-controls with-border text-center">
                                            <div class="btn-group">
                                                <button type="button" @click="trashReg()" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Mandar a la papelera">
                                                <i class="fas fa-trash-alt"></i></button>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Responder">
                                                <i class="fa fa-reply"></i></button>
                                                <!--<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reenviar">
                                                <i class="fa fa-share"></i></button>-->
                                            </div>
                                            <!-- /.btn-group -->
                                            <!--<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir">
                                            <i class="fa fa-print"></i></button>-->
                                        </div>
                                        <!-- /.mailbox-controls -->
                                        <div class="mailbox-read-message">
                                            <textarea class="col-12" disabled v-model="objReg.mensaje"></textarea>
                                        </div>
                                        <!-- /.mailbox-read-message -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div id="accordion-msg-resp">
                                        <div class="callout callout-primary ml-2 mr-2 p-0">
                                            <div id="txt-msg-resp" class="collapse" data-parent="#accordion-msg-resp">
                                                <form @submit.prevent="sendResponse()" class="form-horizontal" novalidate>
                                                <textarea class="col-12" v-model="objRegResp.mensaje"></textarea>
                                                <span v-if="errors.has('mensaje')" class="block text-sm text-danger mt-2">{{ errors.get('mensaje') }}</span>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary float-right m-2" title="Enviar respuesta">Enviar</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <a href="#txt-msg-resp" data-toggle="collapse" class="btn btn-default"><i class="fa fa-reply"></i> Responder</a>
                                            <!--<button type="button" class="btn btn-default"><i class="fa fa-share"></i> Reenviar</button>-->
                                        </div>
                                        <button type="button" @click="trashReg()" class="btn btn-default" title="Mandar a la papelera"><i class="fas fa-trash-alt"></i> A papelera</button>
                                        <!--<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>-->
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!-- /. box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container -->
                </div>
                <!-- /.content -->

        <!-- CONTENIDO a Mostrar :: fin -->

    </div>
</template>

<script>
    //librería para tratar los errores capturados en el servidor
    import { Errors } from '../../libs/errors';
    export default {
        created() {
            //console.log('Component mounted.')

            //llamar a almacenar el parámetro recibido
            this.getParam();
            //carga de datos
            this.fillEditFormReg(this.elem_id);
            //para cargar el listado de registros y obtener el total de no leidos
            this.getElems();
        },

        //datos devueltos por el componente:
        data() {
            return {
                //ID del registro
                elem_id: '',  //variable contenedora del registro a detallar
                urlBase: '/api/contacts',
                //variable para almacenar los datos del registro a mostrar
                objReg: {},
                //variable para almacenar los datos del correo a enviar
                objRegResp: {},
                //posibles errores
                errors: new Errors(),
                elems_no_papelera_leido_no_tot: 0,
            }
        },

        //propiedades computadas
        /**
         * Servirán para establecer el estilo adecuado:
         *    => cuando se esté o no en la página actual.
         *    => a las diferentes opciones de paginado:
         *      >> números, siguiente, anterior, ...
        */
        computed: {
            //
        },

        methods: {

            /**
             * Obteniendo listado de registros
            */
            getParam() {
                this.elem_id = this.$route.params.id;
            },

            /**
             * Mostrando registro para editar
            */
            fillEditFormReg(regID) {
                //Marcar como leido el mensaje mostrado...
                this.updateFieldALeido(regID, 'leido', 1);

                //Cargando datos del registro correspondiente
                //URL hacia la ruta de obtener datos del registro
                let url = this.urlBase + '/' + regID;
                //Empleado el método DELETE de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.get(url)
                .then(response => {       //SI TODO OK
                    console.log(response.data)
                    this.objReg = response.data
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

            /**
             * Actualizando campo
            */
            updateFieldALeido(id, field, newValue) {
                let msg_success = 'Mensaje marcado como LEIDO';

                let url = this.urlBase + '/editar/' + id + '/' + field + '/' + newValue;
                axios.get(url)
                .then((response) => {       //SI TODO OK

                    console.log(msg_success);

                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });/**/
            },

            /**
             * Obteniendo listado de registros
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
            },/**/

            /**
             * Mandando registro a la papelera
            */
            trashReg() {
                /* BORRADO-TEMPORAL CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'A la papelera',
                    text: '¿Mandar este mensaje a la papelera?',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#f6993f',
                    confirmButtonText: 'Cancelar',
                    cancelButtonText: 'A papelera',
                }).then((result) => {

                    //Pulsando el botón equivalente a CONFIRMAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        /**/
                        console.log('Se efectuará un Soft Delete...');
                        //URL hacia la ruta de borrado temporal de registro
                        let url = this.urlBase + '/' + this.objReg.id;
                        //Según la acción a aplicar:
                        //Empleado el método DELETE/GET de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada

                        axios.delete(url)
                        .then(response => {       //SI TODO OK
                            //Emitiendo evento global para cargar notificación de mandar a papelera
                            //en el componente de listado
                            //  >> con el ID pasado
                            //Y volviendo al listado
                            BusEvent.$emit('notifContactDelRegEvent', this.objReg.id);
                            this.$router.push('/admin/contacts');
                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            console.log(error.response.data.errors);
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer mandar a la papelera el registro con ID [' + this.objReg.id + ']'
                            });
                        });

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })//fin cnfirmación
            },

            /**
             * Enviar correo de respuesta
            */
            sendResponse() {
                console.log('Se va a enviar la respuesta...');
                let url = this.urlBase + '/send-response';
                this.objRegResp.id = this.elem_id;
                axios.post(url, this.objRegResp)
                .then((response) => {       //SI TODO OK

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'Enviada respuesta'
                    });

                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //registrando los errores recibidos
                    this.errors.record(error.response.data.errors);
                });
            },

        },
    }
</script>
