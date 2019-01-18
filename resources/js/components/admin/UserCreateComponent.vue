<template>
    <div class="modal fade" id="regInsModal" tabindex="-1" role="dialog" aria-labelledby="regInsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form @submit.prevent="storeUser">

                <div class="modal-header">
                    <h5 class="modal-title" id="regInsModalLabel">Insertar registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name-id">Nombre</label>
                            <input v-model="newUser.name" type="text" class="form-control" name="name" id="name-id" placeholder="Nombre">
                            <span v-if="errors.has('name')" class="block text-sm text-danger mt-2">{{ errors.get('name') }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastname-id">Apellido</label>
                            <input v-model="newUser.lastname" type="text" class="form-control" name="lastname" id="lastname-id" placeholder="Apellido">
                            <span v-if="errors.has('lastname')" class="block text-sm text-danger mt-2">{{ errors.get('lastname') }}</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="email-id">Email*</label>
                            <input v-model="newUser.email" type="text" class="form-control" name="email" id="email-id" placeholder="Email" required>
                            <span v-if="errors.has('email')" class="block text-sm text-danger mt-2">{{ errors.get('email') }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username-id">Nick*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupUserN">@</span>
                                </div>
                                <input v-model="newUser.username" type="text" class="form-control" name="username" id="username-id" placeholder="Nick" aria-describedby="inputGroupUserN" required>
                                <span v-if="errors.has('username')" class="block text-sm text-danger mt-2">{{ errors.get('username') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="pass_id">Contraseña*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPass">&bull;</span>
                                </div>
                                <input v-model="newUser.password" type="password" class="form-control" name="password" id="pass_id" placeholder="Contraseña" aria-describedby="inputGroupPass" required>
                                <span v-if="errors.has('password')" class="block text-sm text-danger mt-2">{{ errors.get('password') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pass_confirm_id">Confirmar contraseña*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPassConf">&bull;</span>
                                </div>
                                <input v-model="newUser.password_confirmation" type="password" class="form-control" name="password_confirmation" id="pass_confirm_id" placeholder="Confirmar contraseña" aria-describedby="inputGroupPassConf" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="perfil-id">Perfil*</label>
                            <select v-model="newUser.perfil_id" name="perfil_id" id="perfil-id" class="custom-select" required>
                                <option value="">Seleccionar un perfil</option>
                                <option value="1">Administrador</option>
                                <option value="2">Usuario</option>
                            </select>
                            <span v-if="errors.has('perfil_id')" class="block text-sm text-danger mt-2">{{ errors.get('perfil_id') }}</span>
                        </div>
                        <!--<div class="col-md-8 mb-3">
                            <label for="avatar-id">Avatar</label>
                            <input @change="onAvatarSelecc" type="file" class="form-control" name="avatar" id="avatar-id" placeholder="Avatar">
                             <div class="valid-feedback">
                                ¡OK!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, escoge un AVATAR.
                            </div>
                        </div> -->
                    </div>

                    <!-- Sacando panel de errores - todos juntos -->
                    <!--<div class="col-xs|sm|md|lg|xl-1-12">
                        <div v-if="errors_length > 0" class="alert alert-danger">
                            <ul>
                                <li v-for="(error, index) in errors" :key="index">{{ error[0] }}</li>
                            </ul>
                        </div>
                    </div>-->
                </div>

                <div class="modal-footer">
                    <div><small class="text-white bg-danger">(*) campo requerido</small></div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit" title="Insertar registro">Insertar</button>
                    </div>
                </div>

                </form>

            </div>
        </div>
    </div>
</template>

<script>
    //librería para tratar los errores capturados en el servidor
    import { Errors } from '../../libs/errors';// '../../libs/errors.js';
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable que guarda el archivo seleccionado
                avatarSelecc: null,
                //variable para almacenar los datos del registro a almacenar
                newUser: {
                    'name': '',
                    'lastname': '',
                    'username': '',
                    'email': '',
                    'password': '',
                    'password_confirmation': '',
                    'perfil_id': '',
                    'avatar': '',
                },
                //posibles errores
                errors: new Errors(),
            }
        },

        methods: {

            /**
             * En el evento de seleccionar archivo, se captura el archivo elegido
             * guardándolo en la variable correspondiente
            */
            onAvatarSelecc(evento) {
                console.log(evento);
                ////this.avatarSelecc = evento.target.files[0];
                //this.newUser.avatar = evento.target.files[0];
            },

            /**
             * Almacenando nuevo registro
            */
            storeUser() {
                console.log('Registrando nuevo registro...');
                let url = '/api/users';
                axios.post(url, this.newUser)
                .then((response) => {       //SI TODO OK
                    ////document.location = '/';

                    //reseteando a vacío la variable de datos
                    this.newUser = {
                        'name': '',
                        'lastname': '',
                        'username': '',
                        'email': '',
                        'password': '',
                        'password_confirmation': '',
                        'perfil_id': '',
                        'avatar': '',
                    };
                    //vaciando los posibles errores que se produjeron
                    this.errors.clear();



                    toast({
                        type: 'success',
                        title: 'Nuevo registro creado'
                    })

                    //ocultando la ventana modal de creación de registro
                    $('#regInsModal').modal('hide');

                    //Emitiendo solicitud de recarga del listado
                    this.$emit('storeUser');
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    //registrando los errores recibidos
                    this.errors.record(error.response.data.errors);
                });
            },

        },
    }
</script>
