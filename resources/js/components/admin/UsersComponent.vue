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
                                                <tr class="lista-usuarios" v-for="(user, index) in users" :key="user.id" style="vertical-align: middle;">
                                                    <!-- ORDEN ASC -->
                                                    <!--<td class="lista_indice text-center" v-if="(index + 1) < 10">{{ '0' + (index + 1) }}</td>
                                                    <td class="lista_indice text-center" v-else v-text="index + 1"></td>-->
                                                    <!-- ORDEN DESC -->
                                                    <td class="lista_indice text-center"><span>{{ users.length - index }}</span></td>
                                                    <td class="text-center"><a :href="'admin/users/detalle/' + user.id" title="Ir al detalle" class="negrita"><img class="avatar" :src="user.avatar" alt="Avatar del usuario"></a></td>
                                                    <td v-if="user.name == ''"><small>Sin detallar</small></td>
                                                    <td v-else-if="user.name == null"><small>Sin detallar</small></td>
                                                    <td v-else v-text="user.name"></td>
                                                    <td v-if="user.lastname == ''"><small>Sin detallar</small></td>
                                                    <td v-else-if="user.lastname == null"><small>Sin detallar</small></td>
                                                    <td v-else v-text="user.lastname"></td>
                                                    <td>{{ user.username }}</td>
                                                    <td>{{ user.email }}</td>
                                                    <td>{{ user.perfil.nombre }}</td>
                                                    <td>{{ user.created_at }}</td>
                                                    <td class="text-center">
                                                        <a href="javascript: void(0);" v-on:click.prevent="editUser(user)" class="text-primary" title="Editar registro">
                                                            <i class="fas fa-edit"></i>
                                                        </a> <a href="javascript: void(0);" @click.prevent="deleteUser(user.id)" class="text-danger" title="Borrar registro">
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
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
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
             * Borrado definitivo del registro
            */
            deleteUser(id) {
                /* BORRADO SIN CONFIRMACIÓN */
                /*
                //URL hacia la ruta de borrado de registro
                var url = '/api/users/' + id;
                //Empleado el método DELETE de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.delete(url).then(response => {
                    //tras borrado, si todo OK, se muestra el listado tras recargarlo
                    this.getUsers();

                    //Lanzando notificación satisfactoria
                    toast({
                        type: 'success',
                        title: 'Eliminado, correctamente, registro con ID [' + id + ']'
                    });
                });*/

                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'La operación no es reversible',
                    ////type: 'warning',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.value) {

                        /**/
                        //URL hacia la ruta de borrado de registro
                        let url = '/api/users/' + id;
                        //Empleado el método DELETE de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.delete(url)
                        .then(response => {       //SI TODO OK
                            //tras borrado, si todo OK, se muestra el listado tras recargarlo
                            this.getUsers();
                            let server_msg_del = response.data.message;
                            alert(server_msg_del);

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

                    }
                })
            },

        },
    }
</script>
