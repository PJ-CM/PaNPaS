<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receta;
use App\Comentario;
use Auth;

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

	public function insertarComentario(Request $request) {

		$id = $_POST['id'];
		$receta = new Receta();
		$receta = $receta->find($id);
		$com = new Comentario();

		$com->mensaje = $_POST['mensaje'];
		$com->user_id = Auth::user()->id;
		$com->receta_id = $id;
		$com->time = time();

		$com->save();

		return redirect('receta/'.$receta->titulo);
		
	}

}
