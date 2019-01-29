<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use URL;

use Illuminate\Support\Facades\Storage;

class UserPerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  >> Desactivarlo mientras se desarrolla
        $this->middleware(['auth', 'verified']);
    }

    /**
     * página principal del usuario logueado
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return view ('/layouts/user/index');
    }

    public function mostrarPerfilPublico(Request $request)
    {
        $user = new User();
        $user = $user->find(($request->route('id')));
        return $user;
    }

    public function mostrarPerfilPrivado ()
    {
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
