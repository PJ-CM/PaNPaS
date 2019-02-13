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
                                        <h3 class="card-title">Papelera</h3>

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
                                            <button @click="recargaPag" class="btn btn-default btn-sm" title="Actualizar lista">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <button @click="restoreAll" class="btn btn-default btn-sm" title="Restaurar todos">
                                                <i class="fas fa-trash-restore-alt"></i>
                                            </button>
                                            <button @click="forceDeleteAll" class="btn btn-default btn-sm" title="Vaciar papelera">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <div class="float-right">
                                                <i class="fas fa-envelope"></i> {{ elems_en_papelera_tot }} disponible(s)
                                            </div>
                                        </div>
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody v-if="elems.length == 0">
                                                    <tr>
                                                        <td class="text-muted text-center">Papelera vacía actualmente</td>
                                                    </tr>
                                                </tbody>
                                                <tbody v-else>
                                                    <tr v-for="(elem, index) in elems" :key="index">
                                                        <td>
                                                            <a v-if="elem.leido" href="javascript: void(0);" @click="updateField(elem.id, 'leido', 0)" class="text-primary" title="Leido - Marcar como NO LEIDO">
                                                                <i class="fas fa-circle i_mens_contacto_leidoOK"></i>
                                                            </a>
                                                            <a v-else href="javascript: void(0);" @click="updateField(elem.id, 'leido', 1)" class="text-primary" title="Sin leer - Marcar como LEIDO">
                                                                <i class="fas fa-circle i_mens_contacto_leidoNOK"></i>
                                                            </a>
                                                        </td>
                                                        <td class="mailbox-name">
                                                            <router-link :to="{ name: 'contact_msg', params: {id: elem.id} }" :title="'Ver mensaje de ' + elem.correo">
                                                                {{ elem.nombre }}
                                                            </router-link>
                                                        </td>
                                                        <td class="mailbox-subject"><strong>{{ elem.asunto }}</strong><br>{{ elem.mensaje | resumenTxt }}</td>
                                                        <td class="mailbox-date">{{ elem.created_at | formatFHHaceTanto }}</td>
                                                        <td class="mailbox-attachment">
                                                            <a href="javascript: void(0);" @click.prevent="restoreDeleteElem(elem.id)" class="text-warning-trash" :title="'Restaurar / Borrar registro [' + elem.id + ']'">
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

            //para cargar un listado de usuarios conectados actualizado
            BusEvent.$emit('notifCargaUsersOnlineEvent');

            //para cargar el listado de registros al llegar al componente
            this.getElems();
        },

        //datos devueltos por el componente:
        data() {
            return {
                urlBase: '/api/contacts',
                //Puede ser también     >>      elems: [],
                elems: {},  //variable contenedora de los registros a listar
                elems_en_papelera_tot: 0,
                //valor mandado al componente hijo ContactsNavbarFoldersComponent
                elems_no_papelera_leido_no_tot_var: 0,
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
             * Recargando página
            */
            recargaPag() {
                this.$router.go(this.$router.currentRoute)
            },

            /**
             * Obteniendo listado de registros
            */
            getElems() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let url = this.urlBase + '/trashed/list';
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    ////console.log(response.data)
                    ////console.log(response.data.message)
                    /**/
                    this.elems = response.data.elems_en_papelera
                    this.elems_en_papelera_tot = this.elems.length
                    this.elems_no_papelera_leido_no_tot_var = response.data.elems_no_papelera_leido_no_tot
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

            /**
             * Enviando término de búsqueda para filtrar registros
            */
            search() {
                console.log('Enviando filtrado de búsqueda...por [' + this.term + ']');
                this.$router.push({
                    name: 'contacts_search',
                    params: { term: this.term }
                });
            },

            /**
             * Actualizando campo
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

                    //Emitiendo evento de recarga de total
                    BusEvent.$emit('notifRecargaLeidosNoTotEvent');

                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });/**/
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
                            let server_msg = response.data.message;
                            console.log(server_msg);

                            //Lanzando notificación satisfactoria
                            Swal.fire(
                                '¡Activado!',
                                'El registro con ID [' + id + '] fue restaurado de la papelera correctamente.',
                                'success'
                            )

                            //Emitiendo evento de recarga de total
                            BusEvent.$emit('notifRecargaLeidosNoTotEvent');
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
             * Restaurar todos los registros de la papelera
            */
            restoreAll() {
                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Restaurar',
                    text: '¿Restaurar todos los mensajes?',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#3490dc',
                    confirmButtonText: 'Cancelar',
                    cancelButtonText: 'Restaurar',
                }).then((result) => {

                    //Pulsando el botón equivalente a CANCELAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        /**/
                        console.log('Se efectuará una Restauración total...');
                        let url = this.urlBase + '/restore-delete/all';
                        axios.get(url)
                        .then(response => {       //SI TODO OK
                            //tras restauración total, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getElems();
                            let server_msg = response.data.message;
                            console.log(server_msg);

                            //Lanzando notificación satisfactoria
                            Swal.fire(
                                'Restaurar',
                                'Todos los registros de la papelera fueron restaurados correctamente.',
                                'success'
                            )

                            //Emitiendo evento de recarga de total
                            BusEvent.$emit('notifRecargaLeidosNoTotEvent');

                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            console.log(error.response.data.errors);
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer restaurar todos los registros'
                            });
                        });

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })//fin confirmación
            },

            /**
             * Vaciar la papelera - Forzar el borrado de todos los registros de la papelera
            */
            forceDeleteAll() {
                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Borrado Total',
                    text: 'Eliminar definitivamente todos los mensajes?',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cancelar',
                    cancelButtonText: 'Eliminar',
                }).then((result) => {

                    //Pulsando el botón equivalente a CANCELAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        /**/
                        console.log('Se efectuará un Borrado total...');
                        let url = this.urlBase + '/force-delete/all';
                        axios.get(url)
                        .then(response => {       //SI TODO OK
                            //tras borrado total, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getElems();
                            let server_msg = response.data.message;
                            console.log(server_msg);

                            //Lanzando notificación satisfactoria
                            Swal.fire(
                                'Eliminar',
                                'Todos los registros de la papelera fueron eliminados correctamente.',
                                'success'
                            )

                            //Emitiendo evento de recarga de total
                            BusEvent.$emit('notifRecargaLeidosNoTotEvent');

                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            console.log(error.response.data.errors);
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer eliminar todos los registros'
                            });
                        });

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })//fin confirmación
            },

        },
    }
</script>
