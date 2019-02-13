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
                            <!-- Barra de Carpetas -->
                            <contacts-navbar-folders-component :elems_no_papelera_leido_no_tot="elems_no_papelera_leido_no_tot_var"></contacts-navbar-folders-component>
                            <!-- /.col -->

                            <div class="col-md-9">
                                <div class="card card-primary card-outline borde-inf-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Mensaje</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="mailbox-read-info">
                                            <h5 :title="objReg.asunto"><strong>{{ objReg.asunto | resumenTxt }}</strong></h5>
                                            <span v-if="objReg.respuestas_count > 0" class="badge bg-primary" title="Cantidad de respuestas">{{ objReg.respuestas_count }}</span>
                                            <h6>de: {{ objReg.nombre }} &lt;{{ objReg.correo }}&gt;
                                            <span class="mailbox-read-time float-right">{{ objReg.created_at | formatFechaHoraTxt }}</span></h6>
                                        </div>
                                        <!-- /.mailbox-read-info -->
                                        <div class="mailbox-controls with-border text-center">
                                            <div class="btn-group">
                                                <button type="button" @click="trashElem()" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Mandar a la papelera">
                                                <i class="fas fa-trash-alt"></i></button>
                                                <!-- Temporalmente, solo se deja responder al mensaje original -->
                                                <a v-if="objReg.msg_origen == 0" href="#txt-msg-resp" data-toggle="collapse" class="btn btn-default btn-sm" data-container="body" title="Responder">
                                                <i class="fa fa-reply"></i></a>
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
                                        <div v-if="objReg.msg_origen != 0" class="float-right">
                                            <a href="javascript: void(0);" @click="fillEditFormReg(objReg.msg_origen)" class="btn btn-default" title="Ver conversación">
                                                <i class="fas fa-mail-bulk"></i> Ver conversación
                                            </a>
                                            <!-- <router-link :to="'/admin/contacts/' + objReg.msg_origen" class="btn btn-default" title="Ver conversación">
                                                <i class="fas fa-mail-bulk"></i> Ver conversación
                                            </router-link> -->
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <!-- LISTADO DE POSIBLE(S) RESPUESTA(S) YA EXISTENTE(S) -->
                                    <div v-for="(elemResp, indexResp) in objReg.respuestas" :key="indexResp" class="card-body p-0">
                                        <a :href="'#txt-msg-resps-' + elemResp.id" data-toggle="collapse">
                                        <div class="mailbox-read-info">
                                            <h5><strong>{{ elemResp.asunto | resumenTxt }}</strong></h5>
                                            <h6>de: {{ elemResp.nombre }} &lt;{{ elemResp.correo }}&gt;
                                            <span class="mailbox-read-time float-right">{{ elemResp.created_at | formatFechaHoraTxt }}</span></h6>
                                        </div>
                                        </a>
                                        <!-- /.mailbox-read-info -->
                                        <div :id="'txt-msg-resps-' + elemResp.id" class="mailbox-read-message collapse">
                                            <textarea class="col-12" disabled v-model="elemResp.mensaje"></textarea>
                                        </div>
                                        <!-- /.mailbox-read-message -->
                                    </div>
                                    <!-- /.card-body -->
                                    <!-- LISTADO DE POSIBLE(S) RESPUESTA(S) YA EXISTENTE(S) -->

                                    <!--
                                        Temporalmente, solo se deja responder al mensaje original, por ello la disposición de los botones
                                        depende de este condicional
                                    -->
                                    <div v-if="objReg.msg_origen == 0" id="accordion-msg-resp">
                                        <div class="callout callout-primary ml-2 mr-2 p-0">
                                            <div id="txt-msg-resp" class="collapse" data-parent="#accordion-msg-resp">
                                                <h6>Respuesta:</h6>
                                                <form @submit.prevent="sendResponse()" class="form-horizontal" novalidate>
                                                <textarea class="col-12" v-model="objRegResp.msg_respuesta"></textarea>
                                                <span v-if="errors.has('msg_respuesta')" class="block text-sm text-danger mt-2">{{ errors.get('msg_respuesta') }}</span>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary float-right m-2" title="Enviar respuesta">Enviar</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="objReg.msg_origen == 0" class="card-footer">
                                        <div class="float-right">
                                            <a href="#txt-msg-resp" data-toggle="collapse" class="btn btn-default"><i class="fa fa-reply"></i> Responder</a>
                                            <!--<button type="button" class="btn btn-default"><i class="fa fa-share"></i> Reenviar</button>-->
                                        </div>
                                        <button type="button" @click="trashElem()" class="btn btn-default" title="Mandar a la papelera"><i class="fas fa-trash-alt"></i> A papelera</button>
                                        <!--<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>-->
                                    </div>
                                    <div v-else class="card-footer text-center">
                                        <button type="button" @click="trashElem()" class="btn btn-default" title="Mandar a la papelera"><i class="fas fa-trash-alt"></i> A papelera</button>
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

            //para cargar un listado de usuarios conectados actualizado
            BusEvent.$emit('notifCargaUsersOnlineEvent');

            //llamar a almacenar el parámetro recibido
            this.getParam();
            //carga de datos
            this.fillEditFormReg(this.elem_id);
        },

        //datos devueltos por el componente:
        data() {
            return {
                //ID del registro
                elem_id: '',  //variable contenedora del registro a detallar
                urlBase: '/api/contacts',
                //variable para almacenar los datos del registro a mostrar
                objReg: {},
                //variable para almacenar los datos del correo de respuesta a enviar
                objRegResp: {},
                //variable para registrar la respuesta enviada
                objNewElem: {},
                //posibles errores
                errors: new Errors(),
                //valor mandado al componente hijo ContactsNavbarFoldersComponent
                elems_no_papelera_leido_no_tot_var: 0,
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

                //Emitiendo evento de recarga de total
                BusEvent.$emit('notifRecargaLeidosNoTotEvent');

                //Cargando datos del registro correspondiente
                //URL hacia la ruta de obtener datos del registro
                let url = this.urlBase + '/' + regID;
                //Empleado el método GET de Axios, el cliente AJAX,
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
                    this.elems_no_papelera_leido_no_tot_var = response.data
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
                    this.getElemsTotNoLeidos();

                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });/**/
            },

            /**
             * Mandando registro a la papelera
            */
            trashElem() {
                /* BORRADO-TEMPORAL CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'A la papelera',
                    text: '¿Mandar el mensaje a la papelera?',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#f6993f',
                    confirmButtonText: 'Cancelar',
                    cancelButtonText: 'A papelera',
                }).then((result) => {

                    //Pulsando el botón equivalente a CANCELAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        /**/
                        console.log('Se efectuará un Soft Delete...');
                        //URL hacia la ruta de borrado temporal de registro
                        let url = this.urlBase + '/' + this.objReg.id;
                        //Empleado el método DELETE de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.delete(url)
                        .then(response => {       //SI TODO OK
                            //Emitiendo evento global para cargar notificación de mandar a papelera
                            //en el componente de listado
                            //  >> con el ID pasado
                            //Y volviendo al listado
                            BusEvent.$emit('notifContactDelRegEvent', this.objReg.id);
                            //Emitiendo evento de recarga de total
                            BusEvent.$emit('notifRecargaLeidosNoTotEvent');

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
                })//fin confirmación
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

                    //vaciando los posibles errores que se produjeron
                    this.errors.clear();

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'Enviada respuesta'
                    });

                    //registro de envío de respuesta...
                    this.objNewElem = {
                        //-----------------------------------------------------
                        'nombre': 'PaNPaS',
                        'correo': 'panpas.zm@gmail.com',
                        //-----------------------------------------------------
                        'asunto': 'Respuesta a - ' + this.objReg.asunto,
                        'mensaje': this.objRegResp.msg_respuesta,
                        'msg_origen': this.objReg.id,
                    };
                    this.storeResponse(this.objNewElem);

                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //registrando los errores recibidos
                    this.errors.record(error.response.data.errors);
                });
            },

            /**
             * Enviar correo de respuesta
            */
            storeResponse(objNewElem) {
                console.log('Registrando nuevo registro...');
                let url = this.urlBase;
                console.log('URL: ' + url);
                console.log('objNewElem: ' + objNewElem);/**/

                axios.post(url, objNewElem)
                .then((response) => {       //SI TODO OK
                    ////document.location = '/';

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'La respuesta quedó almacenada'
                    });
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //registrando los errores recibidos
                    console.log(error.response.data.errors);
                    //Lanzando notificación errónea
                    toast({
                        type: 'warning',
                        title: 'ERROR al querer registrar la respuesta enviada'
                    });
                });
            }

        },
    }
</script>
