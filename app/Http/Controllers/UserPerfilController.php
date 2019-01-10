<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Storage;

class UserPerfilController extends Controller
{
	 public function index(Request $request){ //página principal del usuario logeado
	 	return view ('/layouts/user/index');
    }

    public function mostrarPerfilPublico(Request $request){
    	$user = new User();
    	$user = $user->find(($request->route('id')));
    	return $user;
    }

    public function mostrarPerfilPrivado () {
    	return view ('layouts/user/perfilprivado');
    }

    public function guardarFotoPerfil(Request $request)
  {
   
      $image = $request->file('file');
      $input['imagename'] = $image->getClientOriginalname();

      $request->file('file')->storeAs('public/avatar', $input['imagename']);


		return $this->prueba($image);
      //return view('layouts/user/perfilprivado');

  }

      public function prueba ($image)
  {

      return view('user/prueba', ['image'=> $image->getClientOriginalname()]);
  }

}
