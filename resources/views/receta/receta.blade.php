@extends('layouts.public')

@section('head_content')
        <meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>


<script type="text/javascript">
	$(document).ready(function(){
		alertify.set('notifier','position', 'top-right');
			@if (isset($toast) != null)
				@if ($toast == 'recetaInsertada')
					alertify.notify('Comentario Insertado', 'success');
					@else
					alertify.notify('Campo Vacío', 'error');
				@endif
			@endif
		});
</script>

        <title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>



		<style type="text/css">

			.icono{
				color: white;
				font-size: 5em;
			}
			.img-receta{
				max-width: 640px;
				max-height: 480px;
				width: 640px;
				height: 480px;

				border-radius: 30px 100px;
				box-shadow: black 10px 7px 50px;
			}



		</style>

@endsection

@section('content')

        @include('layouts.public-navbar-auth')



        {{-- Panel-de-Usuario --}}
        <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header" style="text-align: center; padding: 50px;">
                                <h1 class="frijole">
                                    {{$receta->titulo}}
                                    <sub>
                                        <a href="/{{$receta->user->username}}">{{$receta->user->username}}</a>
                                    </sub>
                                    <a href="#comentarios"><div class="btn btn-primary right">Comentarios</div></a>
                                </h1>
                                <img src="{{$receta->imagen}}" alt="{{$receta->titulo}}" class="img-receta">
							<p style="text-align: center; margin-top: 50px;">{{$receta->descripcion}}</p>
                            </div>

                            <div class="card-body">

<div class="col-md-12" style="margin-top: 0px;">
<div class="container">

  <div class="row row-receta">
    <div class="col-md-5" style="background-color: lightblue; padding: 30px;">
      <h2 class="frijole"> Ingredientes: </h2>
      <ul>
	      @foreach ($ingredientes as $ingrediente)
	      		<li class="list-group-item d-flex justify-content-between align-items-center">
					<input type="checkbox" name="ingrediente">{{$ingrediente[0]}}
				    <span class="badge badge-primary badge-pill">{{$ingrediente[1]}}</span>
				</li>
	      @endforeach
  		</ul>


    </div>

    <div class="col-md-7 vertical-line" style="background-color: lightblue; padding: 30px;">
      <h2 class="frijole"> Preparación </h2>

        <div style="text-align: justify;"> {!!$receta->elaboracion!!} </div>

    <!--<img src="{{$receta->imagen}}" class="img-receta"> -->
    </div>
</div>
<!-- FIN RECETA -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<hr>

        {{-- Panel-de-Comentarios --}}
        <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header" id="comentarios"><h1 class="frijole">Comentarios</h1> <div class="insertar-comentario-container">
											<form action="/insertarComentario" method="post">
												<input type="hidden" name="id" value="{{$receta->id}}">
												<textarea name="mensaje"></textarea>

												<input type="submit" name="enviarComentario" class="btn btn-primary">
											</form>

										</div></div>

                            <div class="card-body">

                            	<!-- COMENTARIOS -->
									<!-- Contenedor Principal -->
								<div class="comments-container">

									<ul id="comments-list" class="comments-list">


										@for ($i = count($receta->comentarios) - 1; $i >= 0; $i--)
											@php $comentario = $receta->comentarios[$i]; @endphp
											<li>
												<div class="comment-main-level">
													<!-- Avatar -->
													<div class="comment-avatar"><img src="{{ $comentario->user->avatar }}" alt=""></div>
													<!-- Contenedor del Comentario -->
													<div class="comment-box">
														<div class="comment-head">
															<h6 class="comment-name @if ($comentario->user_id == $receta->user_id) by-author @endif"><a href="/{{$comentario->user->username}}">{{$comentario->user->username}}</a></h6>
															<span> hace {{ intval(($time - $comentario->time) / 60) }} minutos</span>
															{{--<i class="fa fa-reply"></i>
															<i class="fa fa-heart"></i>--}}
														</div>
														<div class="comment-content">
															{{$comentario->mensaje}}
													</div>
												</div>
											</li>
										@endfor


										<!-- Formulario para insertar comentario en la receta -->



									</ul>
								</div>
							<!-- FIN COMENTARIOS -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

{{-- ============================================================================ --}}
{{-- ============================================================================ --}}

@section('footer_scripts_content')
        {{-- jQuery, Bootstrap, jQuery Easing --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Otros --}}
        <script src="{{ asset('js/agency.js') }}"></script>
@endsection
