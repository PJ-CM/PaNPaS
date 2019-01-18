<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Receta;
use App\User;
class UserPanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($username = null)
    {
        if (Auth::user()->perfil_id != 1){
            return view('users.dashboard');
        } else
            return redirect('admin.dashboard');

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function listaRecetas(){
        $recetas = new Receta;
        $recetas = $recetas->orderBy('created_at', 'desc')->get();

        return view('users.recetas', ['recetas'=>$recetas]);
    }

    public function perfil($username){
        $user = new User();
        $var = $user->where('username', $username)->get();
        $user = $var[0];

        if ($user->id == Auth::user()->id){
            return view('users.perfilPrivado', ['user'=>$user]);
        } else
            return view('users.perfilPublico', ['user'=>$user]);

    }

    public function seguidos(){
        $user = new User();
        $user = $user->find(Auth::user()->id);
        $follows = $user->follows;
        return view('users.seguidos', ['follows'=>$follows]);
    }

    public function seguidores(){
        $user = new User();
        $user = $user->find(Auth::user()->id);


        return view('users.seguidores', ['user'=>$user]);
    }

    public function usuarios($columna = 'username', $orden = 'asc'){
        $users = new User();
        //Solo usuarios de perfil USUARIO (perfil_id >> [2])
        $perfil_id_usuario = 2;
        $users = User::orderBy($columna, $orden)
                    ->where('perfil_id', $perfil_id_usuario)
                    ->get();

        return view('users.usuarios', ['users'=>$users, 'columna' => $columna, 'orden' => $orden]);
    }

}
