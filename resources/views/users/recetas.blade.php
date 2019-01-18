@extends('layouts.public')

@section('head_content')
		<meta name="description" content="Gestiona tus datos, tus recetas y otras opciones.">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				var addid = 0;
				$("#añadirCampoElaboracion").click(function(){
					var addList = document.getElementById('elaboracion');
					    var docstyle = addList.style.display;
					    if (docstyle == 'none') addList.style.display = '';

					    addid++;

					    var text = document.createElement('div');
					    text.id = 'elaboracion' + addid;
					    text.innerHTML = "<label><h4>Paso " + addid + "</h4></label><input required type='text' value='' class='paso w3-input' name='elaboracion' id=elaboracion" + addid + ">";

					    addList.appendChild(text);
				});


				var addiding = 0;
				$("#añadirCampoIngrediente").click(function(){
					var addListIng = document.getElementById('ingrediente');
					    var docstyle = addListIng.style.display;
					    if (docstyle == 'none') addListIng.style.display = '';

					    addiding++;

					    var text = document.createElement('div');
					    text.id = 'ingrediente' + addiding;
					    text.innerHTML = "<label><h4>Ingrediente " + addiding + "</h4></label><input required type='text' value='' class='ingrediente w3-input' id=ingrediente name='ingrediente'" + addiding+ ">";

					    addListIng.appendChild(text);
				});
				

			});
		</script>

		<title>{{ config('app.name', 'PaNPaS') }} - Mi cuenta</title>
@endsection

@section('content')

		@include('layouts.public-navbar-auth')

		{{-- Panel-de-Usuario --}}

		 <section id="user_panel">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Usuarios <a href="/insertarReceta" class="btn btn-primary right" data-toggle="modal" data-target="#modalInsertar">Nueva Receta</a> </div>

                            <div class="card-body">
                                
                            	{{-- Ranking Grid --}}

								        <section class="bg-light" id="ranking">
								            <div class="container">
								                <div class="row">
								                	@foreach($recetas as $receta)
								                    	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ranking-item">
									                        <a class="ranking-link" data-toggle="modal" href="/receta/{{$receta->titulo}}">
									                            <div class="ranking-hover" title="Preparar {{$receta->titulo}}">
									                                <div class="ranking-hover-content">
									                                    <i class="fas fa-plus fa-3x"></i>
									                                </div>
									                            </div>
									                            <img class="img-fluid" src="{{$receta->imagen}}" title="Bollos Suizos">
									                        </a>
									                        <div class="ranking-caption">
									                            <h4 title="{{$receta->titulo}}">{{$receta->titulo}}</h4>
									                            <p class="text-muted">por <a href="/{{$receta->user->username}}" title="Ver perfil de {{$receta->user->username}}" class="link-marco">{{$receta->user->username}}</a></p>

									                            

									                            <h5 class="stars-votos" title="{{$receta->titulo}} tiene {{$receta->votos}} votos">
									                            	@if (Auth::user()->username != $receta->user->username)
									                                	<a href="#"><i class="fas fa-star fa-lg" title="Votar"></i> </a>
									                                	@else
									                                		<i class="fas fa-star fa-lg" title="No puedes votar una receta tuya"></i>
									                                @endif
									                                {{$receta->votos}}
									                            </h5>

									                            
									                        </div>
								                    	</div>
								                    @endforeach
								        </section>


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
		<script src="js/agency.js"></script>
@endsection




{{-- MODAL INSERTAR --}}

<!-- Modal -->
  <div class="modal fade" id="modalInsertar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<h4 class="modal-title">Insertar Receta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         

            <form action="/insertarReceta" method="post" enctype="multipart/form-data">
	            <p class="col-lg-12">
	                <label>Título</label>   			<input type="text" name="titulo" class="w3-input" required="">
	            </p>
	            <p class="col-lg-12">
	                <label>Descripción</label>     		<input type="text" name="descripcion" class="w3-input" required="">
	            </p>
	            <p class="col-lg-12">
	             <label>Imagen</label>               	<input type="text" name="imagen" class="w3-input" value="https://lorempixel.com/640/480/?14725" required="">
	            </p>
	            <p class="col-lg-12" id="elaboracion">
	                <label>Elaboración:  </label><span style="font-size: 15px" id="añadirCampoElaboracion" class="btn btn-primary">+</span>
	            </p>
	           	<p class="col-lg-12" id="ingrediente">
	                <label>Ingredientes:</label>      <span style="font-size: 15px" id="añadirCampoIngrediente" class="btn btn-primary">+</span> 
	            </p>
	            <input type="submit" name="sub_avatar", value="Actualizar" class="btn btn-primary right">
        	</form>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>





