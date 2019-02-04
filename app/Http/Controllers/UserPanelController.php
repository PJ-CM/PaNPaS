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
        //  >> Desactivarlo mientras se desarrolla
        $this->middleware(['auth', 'verified']);
    }

    protected $_arr_categoria = ['panadería', 'pastelería'];

    public function index($username = null)
    {
        if (Auth::user()->perfil_id != 1) {
            return view('users.dashboard');

        } else {
            return redirect('admin/dashboard');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function listaRecetas($toast=null) {
        $recetas = new Receta;
        $recetas = $recetas->orderBy('created_at', 'desc')->get();

        return view('users.recetas', [
            'recetas' => $recetas,
            'toast' => $toast,
            '_arr_categoria' => $this->_arr_categoria,
        ]);
    }

    public function perfil($username) {
        $user = new User();
        $var = $user->where('username', $username)->get();
        $user = $var[0];

        if ($user->id == Auth::user()->id) {
            return view('users.perfilPrivado', [ 'user' => $user ]);
        } else {
            return view('users.perfilPublico', [ 'user' => $user ]);
        }
    }

    public function seguidos() {
        $user = new User();
        $user = $user->find(Auth::user()->id);
        $follows = $user->follows;
        return view('users.seguidos', [ 'follows' => $follows ]);
    }

    public function seguidores() {
        $user = new User();
        $user = $user->find(Auth::user()->id);

        return view('users.seguidores', [ 'user' => $user ]);
    }

    public function usuarios($columna = 'username', $orden = 'asc'){
        $users = new User();
        //Solo usuarios de perfil USUARIO (perfil_id >> [2])
        $perfil_id_usuario = 2;
        $users = User::orderBy($columna, $orden)
                    ->where('perfil_id', $perfil_id_usuario)
                    ->get();

        return view('users.usuarios', [
            'users' => $users,
            'columna' => $columna,
            'orden' => $orden,
        ]);
    }

    public function buscarUsuario($columna = 'username', $orden = 'asc') {

        $buscar = $_POST['buscador'];

        $users = new User();
        //Solo usuarios de perfil USUARIO (perfil_id >> [2])
        $perfil_id_usuario = 2;
        $users = User::orderBy($columna, $orden)
                    ->where('perfil_id', $perfil_id_usuario)
                    ->where('username', 'LIKE', "%{$buscar}%")
                    ->get();

        if ($buscar == "") {
            return view('users.usuarios', [
                'users' => $users,
                'columna' => $columna,
                'orden' => $orden,
            ]);
        } else {
            return view('users.usuarios', [
                'users' => $users,
                'columna' => $columna,
                'orden' => $orden,
                'busqueda' => $buscar
            ]);
        }

    }

    public function buscarReceta($columna = 'titulo', $orden = 'asc') {

        $buscar = $_POST['buscador'];

        $recetas = Receta::orderBy($columna, $orden)
                    ->where('titulo', 'LIKE', "%{$buscar}%")
                    ->get();

        if ($buscar == ""){
            return view('users.recetas', [
                'recetas' => $recetas,
                'columna' => $columna,
                'orden' => $orden,
                '_arr_categoria' => $this->_arr_categoria,
            ]);
        } else {
            return view('users.recetas', [
                'tot_resultados' => count($recetas),
                'recetas' => $recetas,
                'columna' => $columna,
                'orden' => $orden,
                'busqueda'=>$buscar,
                '_arr_categoria' => $this->_arr_categoria,
            ]);
        }
    }

}
