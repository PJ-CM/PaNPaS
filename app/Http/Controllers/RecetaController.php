<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receta;
use App\Comentario;

class RecetaController extends Controller
{
    
	public function mostrar($titulo) {

		$receta = new Receta();

		$receta = $receta->where('titulo', $titulo)->get();
		$receta = $receta[0];

		return view ('receta/receta', ['receta'=>$receta, 'time'=>time()]);
	}

	public function getRecetasRanking() {

		$recetas = new Receta;
		$recetas = Receta::orderBy('votos', 'DESC')->take(3)->get();

		return view('index', ['recetas'=>$recetas]);
	}

}
