<template>
    <div class="tab-pane" id="settings">
        <form class="form-horizontal" novalidate>
            <div class="d-flex justify-content-around">
                <div class="p-2 mb-3">
                    <small><strong>Cuenta creada:</strong> {{ objUser.created_at }}</small>
                </div>
                <div class="p-2 mb-3">
                    <small><strong>Editada:</strong> {{ objUser.updated_at }}</small>
                </div>
                <div class="p-2 mb-3">
                    <small v-if="objUser.last_access_at !== null"><strong>Último acceso:</strong> {{ objUser.last_access_at }}</small>
                    <small v-else><strong>Último acceso:</strong> Ningún acceso aún</small>
                </div>
            </div>
            <div v-if="objUser.deleted_at !== null" class="d-flex justify-content-center">
                <div class="p-2 mb-3">
                    <small><strong>Cuenta desactivada:</strong> {{ objUser.deleted_at }}</small>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="name-id" class="control-label p-2">Nombre</label>

                    <input v-model="objUser.name" type="text" class="form-control" :class="{ 'is-invalid': errors.has('name') }" name="name" id="name-id" placeholder="Nombre">
                    <span v-if="errors.has('name')" class="block text-sm text-danger mt-2">{{ errors.get('name') }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname-id" class="control-label p-2">Apellido</label>

                    <input v-model="objUser.lastname" type="text" class="form-control" :class="{ 'is-invalid': errors.has('lastname') }" name="lastname" id="lastname-id" placeholder="Apellido">
                    <span v-if="errors.has('lastname')" class="block text-sm text-danger mt-2">{{ errors.get('lastname') }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label for="email-id" class="control-label p-2">Email*</label>

                    <input v-model="objUser.email" type="text" class="form-control" :class="{ 'is-invalid': errors.has('email') }" name="email" id="email-id" placeholder="Email" required>
                    <span v-if="errors.has('email')" class="block text-sm text-danger mt-2">{{ errors.get('email') }}</span>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="username-id" class="control-label p-2">Nick*</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupUserN">@</span>
                        </div>
                        <input v-model="objUser.username" type="text" class="form-control" :class="[{ 'is-invalid': errors.has('username') }, { 'borde_redondeo_lateral_dcho': errors.has('username') }]" name="username" id="username-id" placeholder="Nick" aria-describedby="inputGroupUserN" required>
                        <span v-if="errors.has('username')" class="block text-sm text-danger mt-2">{{ errors.get('username') }}</span>
                    </div>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="perfil-id" class="control-label p-2">Perfil*</label>

                   <select v-model="objUser.perfil_id" name="perfil_id" id="perfil-id" class="custom-select" :class="{ 'is-invalid': errors.has('perfil_id') }" required>
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
                        <input v-model="objUser.password" type="password" class="form-control" :class="[{ 'is-invalid': errors.has('password') }, { 'borde_redondeo_lateral_dcho': errors.has('password') }]" name="password" id="pass_id" placeholder="Contraseña" aria-describedby="inputGroupPass">
                        <span v-if="errors.has('password')" class="block text-sm text-danger mt-2">{{ errors.get('password') }}</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pass_confirm_id" class="control-label p-2">Confirmar <small>(si especificada una nueva)</small></label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPassConf">&bull;</span>
                        </div>
                        <input v-model="objUser.password_confirmation" type="password" class="form-control" name="password_confirmation" id="pass_confirm_id" placeholder="Confirmar contraseña" aria-describedby="inputGroupPassConf">
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
                    <button type="submit" @submit.prevent="updateUser()" class="btn btn-success" title="Actualizar registro">Actualizar</button>
                    <button v-if="objUser.deleted_at == null" type="button" @click="trashUser()" class="btn btn-papelera-restaurar" title="Mandar a la papelera">A papelera</button>
                    <button v-else type="button" @click.prevent="restoreUser()" class="btn btn-papelera-restaurar" title="Restaurar registro">Restaurar</button>
                    <button type="button" @click.prevent="deleteUser()" class="btn btn-danger" title="Eliminar registro">Eliminar</button>
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
            BusEvent.$on('fillFormProfEvent', (userID) => {
                this.fillEditUser(userID);
            });
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable que guarda el archivo seleccionado
                avatarSelecc: null,
                //variable para almacenar los datos del registro a almacenar
                objUser: {
                    'name': '',
                    'lastname': '',
                    'username': '',
                    'email': '',
                    'password': '',
                    'password_confirmation': '',
                    'perfil_id': '',
                    'avatar': '',
                    'deleted_at': '',
                    'created_at': '',
                    'updated_at': '',
                    'last_access_at': '',
                    //para la edición
                    'id': '',
                },
                //posibles errores
                errors: new Errors(),
            }
        },

        methods: {

            /**
             * Mostrando registro para editar
            */
            fillEditUser(userID) {
                //cargando datos del registro correspondiente
                this.objUser.id = userID;
                //URL hacia la ruta de obtener datos del registro
                let url = '/api/users/' + userID;
                //Empleado el método DELETE de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.get(url)
                .then(response => {       //SI TODO OK

                    //rellenando la variable de datos para la edición
                    ////this.objUser = {
                    ////    'name': user.name,
                    ////    'lastname': user.lastname,
                    ////    'username': user.username,
                    ////    'email': user.email,
                    ////    'password': user.password,
                    ////    //'password_confirmation': '',
                    ////    'perfil_id': user.perfil_id,
                    ////    //'avatar': '',
                    ////    //para la edición
                    ////    'id': user.id,
                    ////};

                    console.log(response.data)
                    this.objUser = response.data
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

            /**
             * Actualizando registro
            */
            updateUser() {
                console.log('Actualizando registro... [' + this.objUser.id + ']');
                let url = '/api/users/' + this.objUser.id;
                axios.put(url, this.objUser)
                .then((response) => {       //SI TODO OK

                    //vaciando los posibles errores que se produjeron
                    this.errors.clear();

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
             * Mandando registro a la papelera
            */
            trashUser() {
            },

            /**
             * Restaurando registro
            */
            restoreUser() {
            },

            /**
             * Eliminando registro
            */
            deleteUser() {
                //Emitiendo evento global para cargar notificación de borrado total
                //en el componente de listado
                //  >> con el ID pasado
                BusEvent.$emit('notifDelUserEvent', this.objUser.id);
                this.$router.push('/admin/users');
            },

        },
    }
</script>
