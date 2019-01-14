<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Perfil;
use App\Receta;
use App\Ingrediente;
use App\Panaderia;

class ApiController extends Controller
{
    public function getUsuarios(){
    	$users = new User();

    	$users = $users->all();

    	return $users;
    }

        public function getPerfiles(){
    	$perfiles = new Perfil();

    	$perfiles = $perfiles->all();

    	return $perfiles;
    }


    public function getRecetas(){
        $recetas = new Receta();

        $recetas = $recetas->all();

        return $recetas;
    }

    public function getIngredientes(){
        $ingredientes = new Ingrediente();

        $ingredientes = $ingredientes->all();

        return $ingredientes;
    }

    public function getPanaderias(){
        $panaderias = new Panaderia();

        $panaderias = $panaderias->all();

        return $panaderias;
    }
}
