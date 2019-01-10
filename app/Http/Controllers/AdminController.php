<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Receta;
use App\Ingrediente;
use App\Panaderia;


class AdminController extends Controller
{
    
	//prepara los datos de la página y muestra la pantalla principal del admin 
	public function index () {

		$usuarios 		= new User;
		$recetas 		= new Receta;
		$ingredientes 	= new Ingrediente;
		$panaderias 	= new Panaderia;


		//Recoge los datos de los usuarios
		$usuarios 		= $usuarios->get();
		$recetas 		= $recetas->get();
		$ingredientes 	= $ingredientes->get();
		$panaderias 	= $panaderias->get();

		//Devuelve una vista y le manda los datos recogidos
		return view('admin.index', [
			'usuarios' 		=> $usuarios,
			'recetas' 		=> $recetas,
			'ingredientes' 	=> $ingredientes,
			'panaderias' 	=> $panaderias
		]);
	}


}
