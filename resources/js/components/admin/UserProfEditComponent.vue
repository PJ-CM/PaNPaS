<template>
    <div class="tab-pane" id="settings">
        <form @submit.prevent="updateReg()" class="form-horizontal" novalidate>
            <div class="d-flex justify-content-around">
                <div class="p-2 mb-3">
                    <small><strong>Cuenta creada:</strong> {{ objReg.created_at }}</small>
                </div>
                <div class="p-2 mb-3">
                    <small><strong>Editada:</strong> {{ objReg.updated_at }}</small>
                </div>
                <div class="p-2 mb-3">
                    <small v-if="objReg.last_access_at !== null"><strong>Último acceso:</strong> {{ objReg.last_access_at }}</small>
                    <small v-else><strong>Último acceso:</strong> Ningún acceso aún</small>
                </div>
            </div>
            <div v-if="objReg.deleted_at !== null" class="d-flex justify-content-center">
                <div class="p-2 mb-3">
                    <small><strong>Cuenta desactivada:</strong> {{ objReg.deleted_at }}</small>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="name-id" class="control-label p-2">Nombre</label>

                    <input v-model="objReg.name" type="text" class="form-control" :class="{ 'is-invalid': errors.has('name') }" name="name" id="name-id" placeholder="Nombre">
                    <span v-if="errors.has('name')" class="block text-sm text-danger mt-2">{{ errors.get('name') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname-id" class="control-label p-2">Apellido</label>

                    <input v-model="objReg.lastname" type="text" class="form-control" :class="{ 'is-invalid': errors.has('lastname') }" name="lastname" id="lastname-id" placeholder="Apellido">
                    <span v-if="errors.has('lastname')" class="block text-sm text-danger mt-2">{{ errors.get('lastname') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label for="email-id" class="control-label p-2">Email*</label>

                    <input v-model="objReg.email" type="text" class="form-control" :class="{ 'is-invalid': errors.has('email') }" name="email" id="email-id" placeholder="Email" required>
                    <span v-if="errors.has('email')" class="block text-sm text-danger mt-2">{{ errors.get('email') }}</span>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="username-id" class="control-label p-2">Nick*</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupUserN">@</span>
                        </div>
                        <input v-model="objReg.username" type="text" class="form-control" :class="[{ 'is-invalid': errors.has('username') }, { 'borde_redondeo_lateral_dcho': errors.has('username') }]" name="username" id="username-id" placeholder="Nick" aria-describedby="inputGroupUserN" required>
                        <span v-if="errors.has('username')" class="block text-sm text-danger mt-2">{{ errors.get('username') }}</span>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="perfil-id" class="control-label p-2">Perfil*</label>

                   <select v-model="objReg.perfil_id" name="perfil_id" id="perfil-id" class="custom-select" :class="{ 'is-invalid': errors.has('perfil_id') }" required>
                        <option value="">Seleccionar un perfil</option>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                    <span v-if="errors.has('perfil_id')" class="block text-sm text-danger mt-2">{{ errors.get('perfil_id') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="pass_id" class="control-label p-2">Contraseña <small>(solo para modificarla)</small></label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPass">&bull;</span>
                        </div>
                        <input v-model="objReg.password" type="password" class="form-control" :class="[{ 'is-invalid': errors.has('password') }, { 'borde_redondeo_lateral_dcho': errors.has('password') }]" name="password" id="pass_id" placeholder="Contraseña" aria-describedby="inputGroupPass">
                        <span v-if="errors.has('password')" class="block text-sm text-danger mt-2">{{ errors.get('password') }}</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pass_confirm_id" class="control-label p-2">Confirmar <small>(si especificada una nueva)</small></label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPassConf">&bull;</span>
                        </div>
                        <input v-model="objReg.password_confirmation" type="password" class="form-control" name="password_confirmation" id="pass_confirm_id" placeholder="Confirmar contraseña" aria-describedby="inputGroupPassConf">
                    </div>
                </div>
            </div>
            <!--<div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox"> Acepto los <a href="#">términos y condiciones</a>
                        </label>
                    </div>
                </div>
            </div>-->
            <div class="form-row">
                <div class="col-md-12 col-sm-offset-2 col-sm-10 text-right">
                    <button type="submit" class="btn btn-success" title="Actualizar registro">Actualizar</button>
                    <button v-if="objReg.deleted_at == null" type="button" @click="trashRestoreReg('trash')" class="btn btn-papelera-restaurar" title="Mandar a la papelera">A papelera</button>
                    <button v-else type="button" @click.prevent="trashRestoreReg('restore')" class="btn btn-papelera-restaurar" title="Restaurar registro">Restaurar</button>
                    <button type="button" @click.prevent="deleteReg()" class="btn btn-danger" title="Eliminar registro">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    //librería para tratar los errores capturados en el servidor
    import { Errors } from '../../libs/errors';
    export default {
        mounted() {
            console.log('Component mounted.');

            //Recibiendo evento(s) si emitido(s) (en este caso, desde su componente Padre)
            BusEvent.$on('fillProfEditFormEvent', (regID) => {
                this.fillEditFormReg(regID);
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable que guarda el archivo seleccionado
                avatarSelecc: null,
                //variable para almacenar los datos del registro a almacenar
                objReg: {},
                //posibles errores
                errors: new Errors(),
                //opciones de texto para las acciones de Trash/Restore registro
                trashRestoreOpc: {
                    'trash': {
                        'notifConfirmTit': 'A la papelera',
                        'notifConfirmText': '¿Desactivar este registro temporalmente?',
                        'notifConfirmType': 'question',
                        'confirmButtonColor': '#6c757d',
                        'cancelButtonColor': '#f6993f',
                        'confirmButtonText': 'Cancelar',
                        'cancelButtonText': 'A papelera',
                        'urlBase': '/api/users/',
                        'notifOkTit': '¡A la papelera!',
                        'notifOkMsgFin': ' fue mandado a la papelera correctamente.',
                        'notifOkType': 'success',
                        'notifErrorTitIni': 'ERROR al querer mandar a la papelera ',
                        'notifErrorType': 'warning',
                    },
                    'restore': {
                        'notifConfirmTit': 'Restaurar',
                        'notifConfirmText': '¿Restaurar este registro desactivado temporalmente?',
                        'notifConfirmType': 'question',
                        'confirmButtonColor': '#6c757d',
                        'cancelButtonColor': '#f6993f',
                        'confirmButtonText': 'Cancelar',
                        'cancelButtonText': 'Restaurar',
                        'urlBase': '/api/users/restore-delete/',
                        'notifOkTit': '¡Activado!',
                        'notifOkMsgFin': ' fue restaurado de la papelera correctamente.',
                        'notifOkType': 'success',
                        'notifErrorTitIni': 'ERROR al querer restaurar de la papelera ',
                        'notifErrorType': 'warning',
                    },
                },
            }
        },

        methods: {

            /**
             * Mostrando registro para editar
            */
            fillEditFormReg(regID) {
                //Cargando datos del registro correspondiente
                //URL hacia la ruta de obtener datos del registro
                let url = '/api/users/' + regID;
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
             * Actualizando registro
            */
            updateReg() {
                console.log('Actualizando registro... [' + this.objReg.id + ']');
                let url = '/api/users/' + this.objReg.id;
                axios.put(url, this.objReg)
                .then((response) => {       //SI TODO OK

                    //vaciando los posibles errores que se produjeron
                    this.errors.clear();

                    //Emitiendo evento global para recargar
                    //en el  panel izquierdo de datos resumen
                    //  >> con el ID pasado
                    BusEvent.$emit('fillProfDataResumEvent', this.objReg.id);

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'Registro actualizado'
                    });
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //registrando los errores recibidos
                    this.errors.record(error.response.data.errors);
                });/**/
            },

            /**
             * Según la acción recibida:
             *  >> Mandando registro a la papelera
             *  >> Restaurando registro
            */
            trashRestoreReg(accion) {
                /* BORRADO-TEMPORAL/RESTAURANDO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: this.trashRestoreOpc[accion].notifConfirmTit,
                    text: this.trashRestoreOpc[accion].notifConfirmText,
                    type: this.trashRestoreOpc[accion].notifConfirmType,
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: this.trashRestoreOpc[accion].confirmButtonColor,
                    cancelButtonColor: this.trashRestoreOpc[accion].cancelButtonColor,
                    confirmButtonText: this.trashRestoreOpc[accion].confirmButtonText,
                    cancelButtonText: this.trashRestoreOpc[accion].cancelButtonText,
                }).then((result) => {

                    //Pulsando el botón equivalente a CONFIRMAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        /**/
                        console.log('Se efectuará un Soft Delete...');
                        //URL hacia la ruta de borrado temporal de registro
                        let url = this.trashRestoreOpc[accion].urlBase + this.objReg.id;
                        //Según la acción a aplicar:
                        //Empleado el método DELETE/GET de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada

                        if(accion == 'trash')
                        {

                            axios.delete(url)
                            .then(response => {       //SI TODO OK
                                //tras borrado temporal, si todo OK,
                                //se recarga la ficha y se notifica la acción
                                this.fillEditFormReg(this.objReg.id);
                                let server_msg_del = response.data.message;
                                console.log(server_msg_del);

                                //Lanzando notificación satisfactoria
                                Swal.fire(
                                    this.trashRestoreOpc[accion].notifOkTit,
                                    'El registro con ID [' + this.objReg.id + ']' + this.trashRestoreOpc[accion].notifOkMsgFin,
                                    this.trashRestoreOpc[accion].notifOkType,
                                )
                            })
                            .catch(error => {           //SI HAY ALGÚN ERROR
                                //Lanzando notificación errónea
                                toast({
                                    type: this.trashRestoreOpc[accion].notifErrorType,
                                    title: this.trashRestoreOpc[accion].notifErrorTitIni + 'el registro con ID [' + this.objReg.id + ']',
                                });
                            });

                        }//trash

                        else if(accion == 'restore')
                        {
                            axios.get(url)
                            .then(response => {       //SI TODO OK
                                //tras borrado temporal, si todo OK,
                                //se recarga la ficha y se notifica la acción
                                this.fillEditFormReg(this.objReg.id);
                                let server_msg_del = response.data.message;
                                console.log(server_msg_del);

                                //Lanzando notificación satisfactoria
                                Swal.fire(
                                    this.trashRestoreOpc[accion].notifOkTit,
                                    'El registro con ID [' + this.objReg.id + ']' + this.trashRestoreOpc[accion].notifOkMsgFin,
                                    this.trashRestoreOpc[accion].notifOkType,
                                )
                            })
                            .catch(error => {           //SI HAY ALGÚN ERROR
                                //Lanzando notificación errónea
                                toast({
                                    type: this.trashRestoreOpc[accion].notifErrorType,
                                    title: this.trashRestoreOpc[accion].notifErrorTitIni + 'el registro con ID [' + this.objReg.id + ']',
                                });
                            });
                        }//restore

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })
            },

            /**
             * Eliminando registro
            */
            deleteReg() {
                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Eliminar',
                    text: 'El ELIMINAR no es reversible',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Cancelar',
                    cancelButtonText: 'Eliminar',
                }).then((result) => {

                    //Pulsando el botón equivalente a CONFIRMAR la acción
                    if ( result.dismiss === Swal.DismissReason.cancel ) {

                        //Borrado definitivo del registro
                        //URL hacia la ruta de borrado definitivo de registro
                        let url = '/api/users/force-delete/' + this.objReg.id;
                        //Empleado el método GET de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.get(url)
                        .then(response => {       //SI TODO OK
                            //Emitiendo evento global para cargar notificación de borrado total
                            //en el componente de listado
                            //  >> con el ID pasado
                            //Y volviendo al listado
                            BusEvent.$emit('notifDelRegEvent', this.objReg.id);
                            this.$router.push('/admin/users');
                        })
                        .catch(error => {           //SI HAY ALGÚN ERROR
                            console.log(error.response.data.errors);
                            //Lanzando notificación errónea
                            toast({
                                type: 'warning',
                                title: 'ERROR al querer eliminar totalmente el registro con ID [' + this.objReg.id + ']'
                            });
                        });

                    //Pulsando cualquier otra equivalencia (ESC, fuera de la ventana,...)
                    } else {
                        console.log('Acción cancelada');
                    }
                })
            },

        },
    }
</script>
