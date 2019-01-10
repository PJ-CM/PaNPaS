<!DOCTYPE html>
<html>
<head>
	<title>Receta</title>

	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">


<style type="text/css">
	#myCarousel{
		width: 100vw;
		height: 90vh;
		margin-bottom: 100px;

	}
	.carousel-inner{
		width: 100%;
		height: 100%;
	}
	#myCarousel > button {
		margin: 50px;
	}
	.icono{
		color: white;
		font-size: 5em;
	}
</style>

</head>
<body>
<!-- navbar -->

	@include('layouts.public-navbar-auth')
<!-- /navbar -->
<!-- RECETA -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



	<div id="myCarousel" class="carousel slide" data-ride="carousel"> <!-- INICIO CARROUSEL -->
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	   	<a href="#titulo"><span class="glyphicon glyphicon-circle-arrow-down icono"></span></a>
	  </ol>


	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div class="item active">
	      <img src="http://www.viajejet.com/wp-content/viajes/Quesadillas.jpg" alt="Los Angeles">
	    </div>

	    <div class="item">
	      <img src="http://www.viajejet.com/wp-content/viajes/Quesadillas.jpg" alt="Chicago">
	    </div>

	    <div class="item">
	      <img src="http://www.viajejet.com/wp-content/viajes/Quesadillas.jpg" alt="New York">
	    </div>

	  </div>

	  <!-- Left and right controls -->
	  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	    <span class="sr-only">Next</span>
	  </a>

	</div> <!-- FIN CARROUSEL -->



<div class="col-md-12" style="margin-top: 0px;">
<div class="container receta"> 
  <div class="row row-receta">
    <h1 id="titulo" class="titulo frijole"> {{$receta->titulo}}  </h1> 
    <a href="/user/perfil/{{$receta->user->id}}">{{$receta->user->nick}}</a>
  </div>

  <div class="row row-receta">
    <div class="col-md-6">
      <h2 class="frijole"> Ingredientes: </h2>
      <ul>
	      @foreach ($receta->ingredientes as $ingrediente)
	      		<li><span class="frijole">o </span><input type="checkbox"> {{$ingrediente->nombre}}</li>
	      @endforeach
  		</ul>

      
    </div>

    <div class="col-md-6 vertical-line">
      <h2 class="frijole"> Preparación </h2>
      
        <p> <input type="checkbox"><span class="frijole"> 1.</span> Precalienta el horno a 180°C </p>
        <p> <input type="checkbox"><span class="frijole"> 2.</span> Corta la pasta de hojaldre en cuadros del mismo               tamaño, espolvorealos con azúcar glass y perforalos                 con un tenedor. Hórnealos hasta que estén dorados. </p>
        <p> <input type="checkbox"><span class="frijole"> 3.</span> En una olla, coloca la crema la mantequilla y la             mitad del azúcar. Abrir la vaina de vainilla y poner                 las semillas en la preparación. Tenerla a fuego                     medio hasta que comience a hervir. </p>
        <p> <input type="checkbox"><span class="frijole"> 4.</span> En un bowl mezcla el restante del azúcar, las yemas,         el harina de maíz y la leche. Mezclando                             perfectamente todo. </p>
        <p> <input type="checkbox"><span class="frijole"> 5.</span> Precalienta el horno a 180°C </p>
      
    <img src="http://www.viajejet.com/wp-content/viajes/Quesadillas.jpg" class="img-receta">
    </div>
</div>
<!-- FIN RECETA -->

	<hr>











	<!-- COMENTARIOS -->
		<!-- Contenedor Principal -->
	<div class="comments-container">
		<h1 class="frijole">Comentarios</h1>

		<ul id="comments-list" class="comments-list">


			@foreach($comentarios as $comentario)
				<li>
					<div class="comment-main-level">
						<!-- Avatar -->
						<div class="comment-avatar"><img src="{{ $comentario->user->avatar }}" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name @if ($comentario->user_id == $receta->user_id) by-author @endif"><a href="http://creaticode.com/blog">{{$comentario->user->nick}}</a></h6>
								<span> hace {{ intval(($time - $comentario->time) / 60) }} minutos</span>
								<i class="fa fa-reply"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								{{$comentario->mensaje}}
						</div>
					</div>
				</li>
			@endforeach
			
			<!-- Formulario para insertar comentario en la receta -->
			<div class="insertar-comentario-container">
				<form>
					<textarea>hola</textarea><input type="submit" name="enviarComentario">
				</form>
				
			</div>


		</ul>
	</div>
<!-- FIN COMENTARIOS -->

























</body>
</html>
















@php /*

	<!-- COMENTARIOS -->
		<!-- Contenedor Principal -->
	<div class="comments-container">
		<h1 class="frijole">Comentarios</h1>

		<ul id="comments-list" class="comments-list">
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Eneko Vázquez</a></h6>
							<span>hace 20 minutos</span>
							<i class="fa fa-reply"></i>
							<i class="fa fa-heart"></i>
						</div>
						<div class="comment-content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
						</div>
						<div class="right"><i class="far fa-star"></i></div>
					</div>
				</div>
				<!-- Respuestas de los comentarios -->
				<ul class="comments-list reply-list">
					<li>
						<!-- Avatar -->
						<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name"><a href="http://creaticode.com/blog">Pedro José</a></h6>
								<span>hace 10 minutos</span>
								<i class="fa fa-reply"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
							</div>
							<div class="right"><i class="far fa-star"></i></div>
						</div>
					</li>

					<li>
						<!-- Avatar -->
						<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Eneko Vázquez</a></h6>
								<span>hace 10 minutos</span>
								<i class="fa fa-reply"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
							</div>
							<div class="right"><i class="far fa-star"></i></div>
						</div>
					</li>




				</ul>
			</li>

			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name"><a href="http://creaticode.com/blog">Pedro José</a></h6>
							<span>hace 10 minutos</span>
							<i class="fa fa-reply"></i>
							<i class="fa fa-heart"></i>
						</div>
						<div class="comment-content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
<!-- FIN COMENTARIOS -->

@endphp