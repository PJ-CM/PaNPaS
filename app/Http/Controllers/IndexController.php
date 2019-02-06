<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Obteniendo Top3 de Recetas para mostrar en el index
     */
    public function getRecetasRanking() {
        $recetas_podium = Receta::orderBy('votos', 'DESC')->take(3)->get();


        return view('index')->with([
            'recetas_podium' => $recetas_podium,
            'totalRecetas' => count(Receta::get()),
        ]);
    }
}
