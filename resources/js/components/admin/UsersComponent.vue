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
                                                <button class="nav-link btn btn-primary txt_blanco" type="button" title="Insertar registro" data-toggle="modal" data-target="#regInsModal"><i class="fa fa-user-plus"></i> Nuevo</button>
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
                                                    <!-- ORDEN ASC -->
                                                    <!--<td class="lista_indice text-center" v-if="(index + 1) < 10">{{ '0' + (index + 1) }}</td>
                                                    <td class="lista_indice text-center" v-else v-text="index + 1"></td>-->
                                                    <!-- ORDEN DESC -->
                                                    <td class="lista_indice text-center">{{ users.length - index }}</td>
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
                <user-create-component @storeUser="getUsers"></user-create-component>
                <!-- Modal-inserto :: ini -->

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
                //////variable para almacenar los datos del registro a almacenar
                ////newUser: {
                ////    'name': '',
                ////    'lastname': '',
                ////    'username': '',
                ////    'email': '',
                ////    'password': '',
                ////    'password_confirmation': '',
                ////    'perfil_id': '',
                ////    'avatar': '',
                ////},
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
                let url = '/api/users';
                //Se emplea el método GET de Axios, el cliente AJAX
                //pues es el método referido a la ruta a la que se
                //llama.
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                axios.get(url).then( response => {
                    ////console.log(response.data)
                    this.users = response.data
                });
            },

            /**
             * Almacenando nuevo registro
            */
            ////storeUser() {
            ////    console.log('Registrando nuevo registro...');
            ////},

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
