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
                                <a href="#" class="btn btn-primary btn-block mb-3 disabled">Redactar</a>

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
                                            <li class="nav-item active">
                                                <a href="#" class="nav-link">
                                                    <i class="fas fa-inbox"></i> Bandeja de entrada
                                                    <span v-if="elems_no_papelera_leido_no_tot > 0" class="badge bg-primary float-right" title="Mensaje(s) sin leer">{{ elems_no_papelera_leido_no_tot }}</span>
                                                </a>
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
                            <!-- /.col -->

                            <div class="col-md-9">
                                <div class="card card-primary card-outline borde-inf-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Bandeja de entrada</h3>

                                        <div class="card-tools">
                                            <form @submit.prevent="search()" class="form-inline ml-5" method="post">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" v-model="term" class="form-control" placeholder="Buscar mensajes">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i title="Buscar" class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="mailbox-controls">
                                            <router-link to="/admin/contacts" class="btn btn-default btn-sm" title="Actualizar lista"><i class="fas fa-sync-alt"></i></router-link>
                                            <div class="float-right">
                                                <i class="fas fa-envelope"></i> {{ elems_no_papelera_tot }} disponible(s)
                                            </div>
                                        </div>
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr v-for="(elem, index) in elems" :key="index">
                                                        <td>
                                                            <a v-if="elem.leido" href="javascript: void(0);" @click="updateField(elem.id, 'leido', 0)" class="text-primary" title="Leido - Marcar como NO LEIDO">
                                                                <i class="fas fa-circle i_mens_contacto_leidoOK"></i>
                                                            </a>
                                                            <a v-else href="javascript: void(0);" @click="updateField(elem.id, 'leido', 1)" class="text-primary" title="Sin leer - Marcar como LEIDO">
                                                                <i class="fas fa-circle i_mens_contacto_leidoNOK"></i>
                                                            </a>
                                                        </td>
                                                        <td class="mailbox-name"><a :href="'/admin/contacts/' + elem.id" :title="'Ver mensaje de ' + elem.correo">{{ elem.nombre }}</a></td>
                                                        <td class="mailbox-subject"><strong>{{ elem.asunto }}</strong><br>{{ elem.mensaje | resumenTxt }}</td>
                                                        <td class="mailbox-date">{{ elem.created_at | formatFHHaceTanto }}</td>
                                                        <td class="mailbox-attachment">
                                                            <a v-if="elem.deleted_at == null" href="javascript: void(0);" @click.prevent="trashDeleteElem(elem.id)" class="text-danger" :title="'A papelera / Borrar registro [' + elem.id + ']'">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a><a v-else href="javascript: void(0);" @click.prevent="restoreDeleteElem(elem.id)" class="text-warning-trash" :title="'Restaurar / Borrar registro [' + elem.id + ']'">
                                                                <i class="fas fa-trash-restore-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- /.table -->
                                        </div>
                                        <!-- /.mail-box-messages -->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer p-0">
                                        <div class="mailbox-controls">
                                            <!-- Controles pie -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /. box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>

        <!-- CONTENIDO a Mostrar :: fin -->

    </div>
</template>

<script>
    export default {
        created() {
            //console.log('Component mounted.')

            //para cargar el listado de usuarios al llegar al componente
            this.getElems();
            //para volverlo a cargar en cada intervalo de X tiempo
            //aunque esta forma de recarga va en contra del rendimiento
            ////setInterval(() => this.getElems(), 3000);

            //Lanzando notificación de borrado emitida por ContactDetailComponent
            BusEvent.$on('notifContactDelRegEvent', (elemDelID) => {
                this.notifDelReg(elemDelID);
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                urlBase: '/api/contacts',
                //Puede ser también     >>      elems: [],
                elems: {},  //variable contenedora de los registros a listar
                elems_no_papelera_tot: 0,
                elems_no_papelera_leido_no_tot: 0,
                term: '',   //término por el que filtrar resultados
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
                    this.elems = response.data.elems_no_papelera
                    this.elems_no_papelera_tot = this.elems.length
                    this.elems_no_papelera_leido_no_tot = response.data.elems_no_papelera_leido_no_tot
                });
            },

            /**
             * Obteniendo listado de registros filtrados por término de búsqueda
            */
            search() {
                console.log('Enviando filtrado de búsqueda...por [' + this.term + ']');
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBase + '/search';
                //Empleado el método POST de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                //  -> IMPORTANTE
                //  Todo lo que se manda como parámetro debe ser dentro de un OBJETO
                //  El término de búsqueda se debe mandar dentro de un objeto
                axios.post(url, {
                    term: this.term
                }).then( response => {  //SI TODO OK
                    ////console.log(response.data)
                    this.elems = response.data
                    this.elems_no_papelera_tot = this.elems.length
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

            /**
             * Actualizando registro
            */
            updateField(id, field, newValue) {
                let msg_success = 'Mensaje marcado como ';
                if(newValue == 0)
                    msg_success += 'NO LEIDO'
                else
                    msg_success += 'LEIDO'

                console.log('Actualizando campo del registro... [' + id + ']');
                let url = this.urlBase + '/editar/' + id + '/' + field + '/' + newValue;
                axios.get(url)
                .then((response) => {       //SI TODO OK

                    //refrescando listado
                    this.getElems();

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: msg_success
                    });
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });/**/
            },

            /**
             * Mandar a papelera / Borrado definitivo del registro
            */
            trashDeleteElem(id) {
                /* BORRADO SIN CONFIRMACIÓN */
                /*
                //URL hacia la ruta de borrado de registro
                var url = this.urlBase + '/' + id;
                //Empleado el método DELETE de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.delete(url).then(response => {
                    //tras borrado, si todo OK, se muestra el listado tras recargarlo
                    this.getElems();

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'Eliminado, correctamente, registro con ID [' + id + ']'
                    });
                });*/

                /*
                    ¡¡ATENCIÓN!!
                    Es preciso capturar el elemento pulsado, si se quiere asociar alguna
                    acción al CancelButton diferente de la predeterminada de cerrar la
                    ventana.
                    Si no es así, y se considera todo lo que no sea ConfirmButton, en el
                    mismo ELSE, entonces, todo ello se vinculará a lo que se asocie al
                    CancelButton.
                    De asociar la acción de eliminar registro a todo el ELSE, incluso,
                    cancelando la acción, pulsando en el icono de cerrar, pulsando en ESC
                    o fuera de la ventana, el registro terminará siendo eliminado aunque
                    no sea la acción que se eligió.
                    Para evitar esto, se captura uno de los posibles eventos de dissMissals
                    de esta librería.
                    En estos casos, se emplea la captura de pulsar el CancelButton:
                        result.dismiss === Swal.DismissReason.cancel
                */

                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Elección de Borrado',
                    text: 'El ELIMINAR no es reversible',
                    ////type: 'warning',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#f6993f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'A papelera',
                    cancelButtonText: 'Eliminar',
                }).then((result) => {

                    //Pulsando el botón equivalente a CONFIRMAR la acción
                    if (result.value) {

                        /**/
                        console.log('Se efectuará un Soft Delete...');
                        //URL hacia la ruta de borrado temporal de registro
                        let url = this.urlBase + '/' + id;
                        //Empleado el método DELETE de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.delete(url)
                        .then(response => {       //SI TODO OK
                            //tras borrado temporal, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getElems();
                            let server_msg_del = response.data.message;
                            console.log(server_msg_del);

                            //Lanzando notificación satisfactoria
                            Swal.fire(
                                '¡A la papelera!',
                                'El registro con ID [' + id + '] fue mandado a la papelera correctamente.',
                                'success'
                            )
                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer mandar a la papelera el registro con ID [' + id + ']'
                            });
                        });

                    //Pulsando el botón equivalente a CANCELAR la acción
                    } else if ( result.dismiss === Swal.DismissReason.cancel ) {

                        //Borrado definitivo del registro
                        this.deleteTotalElem(id);

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })
            },

            /**
             * Restaurar / Borrado definitivo del registro
            */
            restoreDeleteElem(id) {
                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Eliminar o Restaurar',
                    text: 'El ELIMINAR no es reversible',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Restaurar',
                    cancelButtonText: 'Eliminar',
                }).then((result) => {

                    //Pulsando el botón equivalente a CONFIRMAR la acción
                    if (result.value) {

                        /**/
                        //URL hacia la ruta de restaurar de la papelera el registro
                        let url = this.urlBase + '/restore-delete/' + id;
                        //Empleado el método GET de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.get(url)
                        .then(response => {       //SI TODO OK
                            //tras restaurar de la papelera, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getElems();
                            let server_msg_del = response.data.message;
                            console.log(server_msg_del);

                            //Lanzando notificación satisfactoria
                            Swal.fire(
                                '¡Activado!',
                                'El registro con ID [' + id + '] fue restaurado de la papelera correctamente.',
                                'success'
                            )
                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer restaurar de la papelera el registro con ID [' + id + ']'
                            });
                        });

                    //Pulsando el botón equivalente a CANCELAR la acción
                    } else if ( result.dismiss === Swal.DismissReason.cancel ) {

                        //Borrado definitivo del registro
                        this.deleteTotalElem(id);

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })
            },

            /**
             * Borrado definitivo del registro
            */
            deleteTotalElem(id) {

                //URL hacia la ruta de borrado definitivo de registro
                let url = this.urlBase + '/force-delete/' + id;
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.get(url)
                .then(response => {       //SI TODO OK
                    //tras borrado definitivo, si todo OK, se muestra
                    //el listado tras recargarlo
                    this.getElems();
                    let server_msg_del = response.data.message;
                    console.log(server_msg_del);

                    //Lanzando notificación satisfactoria
                    Swal.fire(
                        '¡Borrado!',
                        'El registro con ID [' + id + '] fue eliminado correctamente.',
                        'success'
                    )
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //Lanzando notificación errónea
                    toast({
                        type: 'warning',
                        title: 'ERROR al querer eliminar totalmente el registro con ID [' + id + ']'
                    });
                });

            },

            /**
             * Notificando borrado definitivo desde la ficha de detalle
            */
            notifDelReg(id) {
                //Lanzando notificación satisfactoria
                Swal.fire(
                    '¡Borrado!',
                    'El registro con ID [' + id + '] fue eliminado correctamente.',
                    'success'
                )
            }

        },
    }
</script>
