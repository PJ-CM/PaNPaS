<template>
    <div>

        <!-- CONTENIDO a Mostrar :: ini -->

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Dashboard</li>
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
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ objTotRecursos.tot_users }}</h3>

                                    <p>Usuarios</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="ion ion-bag"></i> -->
                                    <i class="fa fa-users fa-1x"></i>
                                </div>
                                <router-link to="/admin/users" class="small-box-footer" title="Ir a Usuarios">Más info <i class="fa fa-arrow-circle-right"></i></router-link>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ objTotRecursos.tot_recetas }}</h3>

                                    <p>Recetas</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="ion ion-stats-bars"></i> -->
                                    <i class="fas fa-book-open fa-1x"></i>
                                </div>
                                <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ objTotRecursos.tot_comentarios }}</h3>

                                    <p>Comentarios</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="ion ion-person-add"></i> -->
                                    <i class="fa fa-comments fa-1x"></i>
                                </div>
                                <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ objTotRecursos.tot_mens_contacto }}</h3>

                                    <p>Mensajes</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="ion ion-pie-graph"></i>
                                    <i class="fa fa-support fa-1x"></i>
                                    <i class="fas fa-question-circle fa-1x"></i> -->
                                    <i class="fas fa-envelope fa-1x"></i>
                                </div>
                                <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>

                        <!-- Otros apartados -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>

                                        <p class="card-text">
                                            Kesi KEsi Kesito
                                        </p>

                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div>

                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>

                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of the card's content.
                                        </p>
                                        <a href="#" class="card-link">Card link</a>
                                        <a href="#" class="card-link">Another link</a>
                                    </div>
                                </div><!-- /.card -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="m-0">Featured</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Special title treatment</h6>

                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>

                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="m-0">Featured</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Special title treatment</h6>

                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
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

            //para cargar total de recursos al llegar al componente
            this.getTotRecursos();
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable para almacenar los datos del registro a almacenar
                objTotRecursos: {},
            }
        },

        methods: {

            /**
             * Cargando datos de resumen
            */
            getTotRecursos() {
                console.log('Cargando totales de los recursos disponibles');
                //Haciendo la petición de datos
                let url = '/admin/dashboard/get-tots';
                axios.get(url)
                .then( response => {       //SI TODO OK
                    console.log(response.data)
                    this.objTotRecursos = response.data
                })
                .catch(error => {           //SI HAY ALGÚN ERROR
                    console.log(error.response.data.errors);
                });
            },

        },
    }
</script>
