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
                                            <i class="fas fa-users mr-1"></i>
                                            <!--
                                            //>> SIN Paginación
                                            Usuarios [<strong>{{ $valoresTOT }}</strong> disponible(s)]
                                            //>> CON Paginación
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
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>NICK</th>
                                                    <th>Email</th>
                                                    <th>Fecha Registro</th>
                                                    <th>Activo</th>
                                                    <th>Modificar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <!--
                                                <?php //var_dump($valores);
                                                //>> SIN Paginación
                                                ////$contador = 0;
                                                //>> CON Paginación
                                                //      => Orden ASC
                                                ////$contador = ($valores->perPage() * ($valores->currentPage() - 1));
                                                //      => Orden DESC
                                                $contador = ($valores->total() - ($valores->perPage() * ($valores->currentPage() - 1))); ?>
                                                @forelse ($valores as $valor)
                                                    {{-- SIN o CON Paginación [ASC] --}}
                                                    {{--@php
                                                        $contador++;
                                                    @endphp--}}

                                                @include('inc.modal_confirm_del', [
                                                    'modal_id' => 'confirmModal_' . $valor->id,
                                                    'ruta_nom' => 'users_borrar',
                                                ])
                                                -->

                                                <!--
                                                <tr>
                                                    <td class="lista_indice">{{ $contador < 10 ? '0'.$contador : $contador }}</td>
                                                    <td><a href="{{ url('/'.$valores_tipo.'s/detalle/'.$valor->id) }}" title="Ir al detalle" class="negrita{{ $valor->activo == 0 ? ' registro_activo_no' : ' registro_activo_si' }}">{{ $valor->name }}</a></td>
                                                    <td>{{ $valor->username }}</td>
                                                    <td>{{ $valor->email }}</td>
                                                    <td>{{ $valor->created_at }}</td>

                                                    @php
                                                        $valor_activo_tit = '';
                                                        $valor_activo_nuevo = '';
                                                        if($valor->activo == 0) {
                                                            $valor_activo_tit = 'Clic para activar';
                                                            $valor_activo_nuevo = 1;
                                                        } else {
                                                            $valor_activo_tit = 'Clic para desactivar';
                                                            $valor_activo_nuevo = 0;
                                                        }
                                                    @endphp

                                                    <td><form action="{{ route('users_editar_campo', ['id' => $valor->id, 'campo' => 'activo', 'valor' => $valor_activo_nuevo]) }}" method="get"><input type="checkbox"{{ $valor->activo == 1 ? ' checked' : '' }} onchange="this.form.submit();" title="{{ $valor_activo_tit }}"></form></td>
                                                    <td><a href="{{ route('users_detalle', ['id' => $valor->id]) }}" class="text-primary" title="Editar este registro"><i class="fas fa-pencil-alt"></i></a> <a href="javascript: void(0);" class="text-danger" title="Borrar este registro" data-toggle="modal" data-target="#confirmModal_{{ $valor->id }}"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>
                                                -->

                                                <tr>
                                                    <td class="lista_indice">01</td>
                                                    <td><a href="admin/users/detalle/1" title="Ir al detalle" class="negrita">Pepito Pérez</a></td>
                                                    <td>elPep</td>
                                                    <td>elpep@per.es</td>
                                                    <td>2018/01/25 00:12:59</td>
                                                    <!--
                                                    @php
                                                        $valor_activo_tit = '';
                                                        $valor_activo_nuevo = '';
                                                        if($valor->activo == 0) {
                                                            $valor_activo_tit = 'Clic para activar';
                                                            $valor_activo_nuevo = 1;
                                                        } else {
                                                            $valor_activo_tit = 'Clic para desactivar';
                                                            $valor_activo_nuevo = 0;
                                                        }
                                                    @endphp
                                                    -->
                                                    <td><form action="activar_registro" method="get"><input type="checkbox" checked onchange="this.form.submit();" title="Clic para desactivar"></form></td>
                                                    <td><a href="#editar_registro" class="text-primary" title="Editar este registro"><i class="fas fa-edit"></i></a> / <a href="javascript: void(0);" class="text-danger" title="Borrar este registro" data-toggle="modal" data-target="#confirmModal_1"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>

                                                    <!--
                                                    {{-- CON Paginación [DESC] --}}
                                                    @php
                                                        $contador--;
                                                    @endphp
                                                    -->

                                                <!--
                                                @empty

                                                <tr>
                                                    <td colspan="7">:: No existen registros en este momento ::<td>
                                                </tr>

                                                @endforelse
                                                -->
                                            </tbody>
                                        </table>

                                        <!--
                                        {{--PAGINACIÓN::Enlaces--}}
                                        {{ $valores->links() }}
                                        -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </section>
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
        created() {
            //console.log('Component mounted.')

            //para cargar el listado de usuarios
            this.getUsers();
        },

        //datos devueltos por el componente:
        data() {
            return {
                //Puede ser también     >>      users: [],
                users: {},  //variable contenedora de los registros a mostrar
            }
        },

        methods: {
            getUsers() {
                //Obteniendo registros de usuarios
                //URL hacia la ruta del listado de registros
                //  >> SIN paginación
                let urlUsers = '/api/users';
                //Se emplea el método GET de Axios, el cliente AJAX
                //pues es el método referido a la ruta a la que se
                //llama.
                //  -> Si es correcto, se recogen los datos
                //  dentro del contenedor definido
                //axios.get(urlUsers).then( ({ data }) => (
                axios.get(urlUsers).then(  data  => (
                    this.users = data.data
                ));
            },

            getUsersOK() {
                let urlUsers = '/api/users';
                axios.get(urlUsers).then(response => {
                    ////console.log(response.data)
                    this.users = response.data;
                });
            }
        },
    }
</script>
