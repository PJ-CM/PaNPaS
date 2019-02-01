<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
class PruebaController extends Controller
{
    public function usuarios()
    {
    	return view ('grafico', ['users'=>User::all()]); 
    }
}
