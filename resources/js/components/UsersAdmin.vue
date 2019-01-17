<template>
    <div>

        <!-- CONTENIDO a Mostrar :: ini -->

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Usuarios</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><router-link to="/admin/dashboard" title="Ir al Dashboard">Dashboard</router-link></li>
                                    <li class="breadcrumb-item active">Usuarios</li>
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
                            <section class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3">
                                            <i class="fas fa-users mr-1" title="Icono de usuarios"></i>
                                            <!-- >> SIN Paginación-->
                                            [<strong>{{ users.length }}</strong> disponible(s)]
                                            <!-- >> CON Paginación
                                            Usuarios [<strong>{{ $valores->total() }}</strong> disponible(s)]-->
                                        </h3>
                                        <!--De este UL, se ha eliminado el CLASS de nav-pills para que el color
                                        del texto del botón salga en blanco por defecto-->
                                        <ul class="nav ml-auto p-2">
                                            <li class="nav-item">
                                                <button class="nav-link btn btn-primary txt_blanco" type="button" title="Insertar registro" data-toggle="modal" data-target="#regInsModal">Nuevo</button>
                                            </li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Avatar</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>NICK</th>
                                                    <th>Email</th>
                                                    <th>Perfil</th>
                                                    <th>Registro</th>
                                                    <th class="text-center">Modificar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="lista-usuarios" v-for="(user, index) in users" :key="user.id">
                                                    <td class="lista_indice text-center" v-if="(index + 1) < 10">{{ '0' + (index + 1) }}</td>
                                                    <td class="lista_indice text-center" v-else v-text="index + 1"></td>
                                                    <td class="text-center"><a :href="'admin/users/detalle/' + user.id" title="Ir al detalle" class="negrita"><img class="avatar" :src="user.avatar" alt="Avatar del usuario"></a></td>
                                                    <td v-text="user.name"></td>
                                                    <td v-text="user.lastname"></td>
                                                    <td>{{ user.username }}</td>
                                                    <td>{{ user.email }}</td>
                                                    <td>{{ user.perfil.nombre }}</td>
                                                    <td>{{ user.created_at }}</td>
                                                    <td class="text-center">
                                                        <a href="javascript: void(0);" v-on:click.prevent="editUser(user)" class="text-primary" title="Editar registro">
                                                            <i class="fas fa-edit"></i>
                                                        </a> / <a href="javascript: void(0);" v-on:click.prevent="deleteUser(user)" class="text-danger" title="Borrar registro">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </section>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->

                <!-- MODALES :: ini -->

                <!-- Modal-inserto :: ini -->
                <div class="modal fade" id="regInsModal" tabindex="-1" role="dialog" aria-labelledby="regInsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <form @submit.prevent="createUser" class="needs-validation" novalidate>

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
                                        <div class="valid-feedback">
                                            ¡OK!
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor, teclea un NOMBRE.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastname-id">Apellido</label>
                                        <input v-model="newUser.lastname" type="text" class="form-control" name="lastname" id="lastname-id" placeholder="Apellido">
                                        <div class="valid-feedback">
                                            ¡OK!
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor, teclea un APELLIDO.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email-id">Email</label>
                                        <input v-model="newUser.email" type="text" class="form-control" name="email" id="email-id" placeholder="Email" required>
                                        <div class="valid-feedback">
                                            ¡OK!
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor, teclea un EMAIL.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="username-id">Nick</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupUserN">@</span>
                                            </div>
                                            <input v-model="newUser.username" type="text" class="form-control" name="username" id="username-id" placeholder="Nick" aria-describedby="inputGroupUserN" required>
                                            <div class="valid-feedback">
                                                ¡OK!
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor, teclea un NICK.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pass_id">Contraseña</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPass">&bull;</span>
                                            </div>
                                            <input v-model="newUser.password" type="password" class="form-control" name="password" id="pass_id" placeholder="Contraseña" aria-describedby="inputGroupPass" required>
                                            <div class="valid-feedback">
                                                ¡OK!
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor, teclea una CONTRASEÑA.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pass_confirm_id">Confirmar contraseña</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPassConf">&bull;</span>
                                            </div>
                                            <input v-model="newUser.password_confirmation" type="password" class="form-control" name="password_confirmation" id="pass_confirm_id" placeholder="Confirmar contraseña" aria-describedby="inputGroupPassConf" required>
                                            <div class="valid-feedback">
                                                ¡OK!
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor, confirma la CONTRASEÑA.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="perfil-id">Perfil</label>
                                        <select v-model="newUser.perfil_id" name="perfil_id" id="perfil-id" class="custom-select">
                                            <option value="">Seleccionar un perfil</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario</option>
                                        </select>
                                        <div class="valid-feedback">¡OK!</div>
                                        <div class="invalid-feedback">Elegir una de las opciones</div>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="avatar-id">Avatar</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar-id" placeholder="Avatar">
                                        <div class="valid-feedback">
                                            ¡OK!
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor, escoge un AVATAR.
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-xs|sm|md|lg|xl-1-12">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>-->
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="modalIns" value="regInsModal">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary" type="submit" title="Insertar registro">Insertar</button>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>
                <!-- Modal-inserto :: fin -->

                <!-- MODALES :: fin -->

        <!-- CONTENIDO a Mostrar :: fin -->

    </div>
</template>

<script>
    export default {
        created() {
            //console.log('Component mounted.')

            //para cargar el listado de usuarios
            this.getUsers();
        },

        //datos devueltos por el componente:
        data() {
            return {
                //Puede ser también     >>      users: [],
                users: {},  //variable contenedora de los registros a listar
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
            getUsers() {
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let urlUsers = '/api/users';
                //Se emplea el método GET de Axios, el cliente AJAX
                //pues es el método referido a la ruta a la que se
                //llama.
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(urlUsers).then( response => {
                    ////console.log(response.data)
                    this.users = response.data
                });
            },

            /**
             * Creando nuevo registro
            */
            createUser() {
                console.log('Registrando nuevo registro...');
            },

            /**
             * Editando registro
            */
            editUser(user) {
                //
            },

            /**
             * Actualizando registro
            */
            updateUser(id) {
                //
            },

            /**
             * Actualizando registro
            */
            deleteUser(user) {
                //
            },
        },
    }
</script>
