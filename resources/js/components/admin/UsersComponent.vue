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
                                                <!--<button class="nav-link btn btn-primary txt_blanco" type="button" title="Insertar registro" data-toggle="modal" data-target="#regInsEditModal"><i class="fa fa-user-plus"></i> Nuevo</button>-->
                                                <button class="nav-link btn btn-primary txt_blanco" type="button" title="Insertar registro" @click="regInsModal"><i class="fa fa-user-plus"></i> Nuevo</button>
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
                                                    <td class="lista_indice text-center">
                                                        <span v-if="user.deleted_at == null" class="reg-activo">{{ users.length - index }}</span>
                                                        <span v-else class="reg-trashed">{{ users.length - index }}</span>
                                                    </td>
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
                                                    <td><small :title="user.created_at">{{ user.created_at }}</small></td>
                                                    <td class="text-center">
                                                        <a href="javascript: void(0);" @click="regEditModal(user)" class="text-primary" :title="'Editar registro [' + user.id + ']'">
                                                            <i class="fas fa-edit"></i>
                                                        </a> <a v-if="user.deleted_at == null" href="javascript: void(0);" @click.prevent="trashDeleteUser(user.id)" class="text-danger" :title="'A papelera / Borrar registro [' + user.id + ']'">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a><a v-else href="javascript: void(0);" @click.prevent="restoreDeleteUser(user.id)" class="text-warning-trash" :title="'Restaurar / Borrar registro [' + user.id + ']'">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </a> <router-link :to="{ name: 'user_profile', params: {id: user.id} }" class="text-success" :title="'Perfil completo [' + user.id + ']'">
                                                            <i class="fas fa-user-circle"></i>
                                                        </router-link>
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

                <!-- Modal-inserto-edición :: ini -->
                <user-ins-edit-component @insModifUserEvent="getUsers"></user-ins-edit-component>

        <!-- CONTENIDO a Mostrar :: fin -->

    </div>
</template>

<script>
    export default {
        created() {
            //console.log('Component mounted.')

            //para cargar el listado de usuarios al llegar al componente
            this.getUsers();
            //para volverlo a cargar en cada intervalo de X tiempo
            //aunque esta forma de recarga va en contra del rendimiento
            ////setInterval(() => this.getUsers(), 3000);
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
             * Abriendo ventana modal para crear registro
            */
            regInsModal() {
                //Emitiendo evento global para cargar, en el componente hijo,
                //la ventana de edición
                //  >> con el objeto pasado
                //  >> deshabilitando el insMode
                BusEvent.$emit('insModeChangeEvent', true);

                //Abriendo modal para la creación de registro
                $('#regInsEditModal').modal('show');
            },

            /**
             * Abriendo ventana modal para editar registro
            */
            regEditModal(reg) {
                console.log('Abriendo MODAL para editar registro [' + reg + ', ' + false + '].');

                //Emitiendo evento global para cargar, en el componente hijo,
                //la ventana de edición
                //  >> con el objeto pasado
                //  >> deshabilitando el insMode
                BusEvent.$emit('fillFormEvent', reg, false);

                //Abriendo modal con los datos cargados para su edición
                $('#regInsEditModal').modal('show');
            },

            /**
             * Editando registro
            */
            editUser(user) {
                //
            },

            /**
             * Mandar a papelera / Borrado definitivo del registro
            */
            trashDeleteUser(id) {
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
                    title: 'Elección de Borrado',
                    text: 'El ELIMINAR no es reversible',
                    ////type: 'warning',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#f6993f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'A papelera',
                    cancelButtonText: 'Eliminar'
                }).then((result) => {

                    if (result.value) {

                        /**/
                        console.log('Se efectuará un Soft Delete...');
                        //URL hacia la ruta de borrado temporal de registro
                        let url = '/api/users/' + id;
                        //Empleado el método DELETE de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.delete(url)
                        .then(response => {       //SI TODO OK
                            //tras borrado temporal, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getUsers();
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

                    } else {

                        //Borrado definitivo del registro
                        this.deleteTotalUser(id);

                    }
                })
            },

            /**
             * Restaurar / Borrado definitivo del registro
            */
            restoreDeleteUser(id) {
                /* BORRADO CON CONFIRMACIÓN */
                /**/
                Swal.fire({
                    title: 'Restaurar o Eliminar',
                    text: 'El ELIMINAR no es reversible',
                    type: 'question',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Restaurar',
                    cancelButtonText: 'Eliminar'
                }).then((result) => {

                    if (result.value) {

                        /**/
                        //URL hacia la ruta de restaurar de la papelera el registro
                        let url = '/api/users/restore-delete/' + id;
                        //Empleado el método GET de Axios, el cliente AJAX,
                        //que es el método referido a la ruta llamada
                        axios.get(url)
                        .then(response => {       //SI TODO OK
                            //tras restaurar de la papelera, si todo OK, se muestra
                            //el listado tras recargarlo
                            this.getUsers();
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

                    } else {

                        //Borrado definitivo del registro
                        this.deleteTotalUser(id);

                    }
                })
            },

            /**
             * Borrado definitivo del registro
            */
            deleteTotalUser(id) {

                //URL hacia la ruta de borrado definitivo de registro
                let url = '/api/users/force-delete/' + id;
                //Empleado el método GET de Axios, el cliente AJAX,
                //que es el método referido a la ruta llamada
                axios.get(url)
                .then(response => {       //SI TODO OK
                    //tras borrado definitivo, si todo OK, se muestra
                    //el listado tras recargarlo
                    this.getUsers();
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

        },
    }
</script>
