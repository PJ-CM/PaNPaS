<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use URL;

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
    	return view ('layouts/user/perfilPrivado');
    }

    public function guardarFotoPerfil(Request $request)
  {
   
      $image = $request->file('newAvatar');

      $image->storeAs('public/avatar', Auth::user()->username);

      $user = Auth::user();

      $url = URL::asset("storage/avatar/".Auth::user()->username);

      $user->avatar = $url;

      $user->save();
      Auth::login($user);



		return redirect(route('user_perfil', Auth::user()->username));
      //return view('layouts/user/perfilprivado');

  }

  public function actualizarDatos(Request $request)
  {
   
      $input = $request->all();

      $user = Auth::user();

      $user->username = $input['username'];
      $user->name = $input['name'];
      $user->lastname = $input['lastname'];
      $user->email = $input['email'];

      $user->save();

      Auth::login($user);

    return redirect(route('user_perfil', Auth::user()->username));

  }

      public function prueba ($image)
  {

      return view('user/prueba', ['image'=> $image->getClientOriginalname()]);
  }

}
