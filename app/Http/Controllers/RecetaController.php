<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receta;
use App\Comentario;

class RecetaController extends Controller
{
    
	public function mostrar() {

		$id = 2;

		$receta = new Receta();
		$comentarios = new Comentario();

		$receta = $receta->find($id);

		$comentarios = $comentarios->get()->where('receta_id', $id);

		return view ('receta/receta', ['receta'=>$receta, 'comentarios' => $comentarios, 'time'=>time()]);
	}

	public function getRecetasRanking() {

		$recetas = new Receta;
		$recetas = Receta::orderBy('votos', 'DESC')->take(6)->get();

		return view('index', ['recetas'=>$recetas]);
	}

}
