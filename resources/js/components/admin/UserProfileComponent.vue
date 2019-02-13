<template>
    <div>

        <!-- CONTENIDO a Mostrar :: ini -->

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <!-- PARÁMETRO PASADO por ROUTER-LINK {{ $route.params.id }} -->
                                <h1 class="m-0 text-dark">Perfil de usuario</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><router-link to="/admin/dashboard" title="Ir al Dashboard">Dashboard</router-link></li>
                                    <li class="breadcrumb-item"><router-link to="/admin/users" title="Volver a Usuarios">Usuarios</router-link></li>
                                    <li class="breadcrumb-item active">Perfil</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- PANELES Resumen -->
                        <div class="row">
                            <div class="col-md-3">
                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <!-- Nombre completo - Username - Totales -->
                                    <user-prof-tots-component></user-prof-tots-component>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <!-- Tab(s) Cabecera -->
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividad</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Editar Perfil</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->

                                    <!-- Tab(s) Contenido -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <!-- Tab Actividad - Últimos -->
                                            <user-prof-activ-component></user-prof-activ-component>
                                            <!-- /.tab-pane -->

                                            <!-- Tab Editar Perfil -->
                                            <user-prof-edit-component></user-prof-edit-component>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->

        <!-- CONTENIDO a Mostrar :: fin -->

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');

            //para cargar un listado de usuarios conectados actualizado
            BusEvent.$emit('notifCargaUsersOnlineEvent');

            //llamar a almacenar el parámetro recibido
            this.getParam();
            //carga de datos en los paneles
            this.cargaPaneles();
        },

        //datos devueltos por el componente:
        data() {
            return {
                user_id: '',  //variable contenedora del registro a detallar
            }
        },

        methods: {

            /**
             * Obteniendo listado de registros
            */
            getParam() {
                this.user_id = this.$route.params.id;
            },

            /**
             * Petición de Carga:
             *  >> en panel datos resumen
             *  >> en panel de actividad
             *  >> en panel de edición
            */
           cargaPaneles() {
                console.log('Carga de datos resumen del registro [' + this.user_id + '].');

                BusEvent.$emit('fillProfDataResumEvent', this.user_id);
                BusEvent.$emit('fillProfActivEvent', this.user_id);
                BusEvent.$emit('fillProfEditFormEvent', this.user_id);
           },

        },
    }
</script>
