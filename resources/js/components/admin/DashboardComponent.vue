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
                                <div class="small-box bg-tot_users">
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
                                <div class="small-box bg-tot_recetas">
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
                                <div class="small-box bg-tot_comentarios">
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
                                <div class="small-box bg-tot_mens_contacto">
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
                                    <router-link to="/admin/contacts" class="small-box-footer" title="Ir a Mensajes">Más info <i class="fa fa-arrow-circle-right"></i></router-link>
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
                                        <h5 class="m-0">Gráfica de alta de Recetas</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                Fecha inicial
                                                <date-picker v-model="date_ini" :config="options_date_ini"></date-picker>
                                            </div>
                                            <div class="col-5">
                                                Fecha final
                                                <date-picker v-model="date_fin" :config="options_date_fin"></date-picker>
                                            </div>
                                            <div class="col-2">
                                                <button class="nav-link btn btn-primary txt_blanco" type="button" title="Cargar gráfica" @click="chartRecetasAltaXFechas"><i class="far fa-chart-bar"></i> Cargar</button>
                                            </div>
                                        </div>
                                        <GChart
                                            type="ColumnChart"
                                            :data="chartData"
                                            :options="chartOptions"
                                        />
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
    import datePicker from 'vue-bootstrap-datetimepicker';
    import { GChart } from 'vue-google-charts';
    export default {
        mounted() {
            console.log('Component mounted.');

            //para cargar un listado de usuarios conectados actualizado
            BusEvent.$emit('notifCargaUsersOnlineEvent');

            //para cargar total de recursos al llegar al componente
            this.getTotRecursos();
        },

        components: {
            GChart
        },

        //datos devueltos por el componente:
        data() {
            return {
                //variable para almacenar los datos del registro a almacenar
                objTotRecursos: {},

                //Opciones para DatetimePicker
                //  >> Rellenando con la fecha actual
                ////date_ini: new Date(),
                //  >> Rellenando con una fecha fija
                date_ini: '01/02/2019',
                options_date_ini: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                },

                //Opciones para DatetimePicker
                date_fin: new Date(),
                options_date_fin: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                },

                // Array will be automatically processed with visualization.arrayToDataTable function
                chartData: [
                    ['Día', 'Recetas'],
                    ['01/02/2019', 1000,],
                    ['02/02/2019', 1170,],
                    ['03/02/2019', 660,],
                    ['04/02/2019', 1030,],
                ],
                chartOptions: {
                    chart: {
                        title: 'Alta de Recetas en rango de Fechas',
                        subtitle: 'Recetas registradas en un rango',
                    },
                    colors: ['#fed136'],
                },
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

            /**
             * Carga de gráfica de Altas de Recetas
             * dentro de un rango de fechas dado
            */
            chartRecetasAltaXFechas() {
                //
                alert(':: Se cargará la gráfica según el rango de fechas seleccionado ::');
            },

        },
    }
</script>
