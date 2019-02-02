<?php

namespace App\Http\Controllers;

use App\User;
use App\Receta;
use App\Contacto;
use App\Comentario;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
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

    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Obtener totales de los recursos disponibles
     *
     * @return void
     */
    public function getTots()
    {
        $_arr_detalle = [];

        $tot_users          = User::withTrashed()->count();
        $tot_recetas        = Receta::count();
        $tot_comentarios    = Comentario::count();
        $tot_mens_contacto  = Contacto::count();

        $_arr_detalle['tot_users']          = $tot_users;
        $_arr_detalle['tot_recetas']        = $tot_recetas;
        $_arr_detalle['tot_comentarios']    = $tot_comentarios;
        $_arr_detalle['tot_mens_contacto']  = $tot_mens_contacto;

        return $_arr_detalle;
    }
}
