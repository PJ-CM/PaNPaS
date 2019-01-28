<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function getRecetasRanking() {
        $recetas_podium = Receta::orderBy('votos', 'DESC')->take(3)->get();

        return view('index')->with([
            'recetas_podium' => $recetas_podium,
            'totalRecetas' => count(Receta::get()),
        ]);
    }
}
