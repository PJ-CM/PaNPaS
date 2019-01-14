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
            return redirect('admin/dashboard');          
        
    }

    public function logout(){
        Auth::logout();
        return redirect("/");
    }

    public function listaRecetas(){
        $recetas = new Receta;
        $recetas = $recetas->all();

        return view('/users/recetas', ['recetas'=>$recetas]);
    }

    public function perfilPublico($username){
        $user = new User();
        $var = $user->where('username', $username)->get();
        $user = $var[0];
     

        return view('users/perfilPublico', ['user'=>$user]);
    }

    public function seguidos(){
        $user = new User();
        $user = $user->find(Auth::user()->id);
     

        return view('users/seguidos', ['user'=>$user]);
    }

    public function seguidores(){
        $user = new User();
        $user = $user->find(Auth::user()->id);
     

        return view('users/seguidores', ['user'=>$user]);
    }


}
