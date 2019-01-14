<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contacto;

use Route;

class ContactoController extends Controller
{
    public function guardarDatos(){


    	$nombre = $_POST['name'];
    	$correo = $_POST['email'];
    	$mensaje = $_POST['message'];

    	$contacto = new Contacto;

    	$contacto->nombre = $nombre;
    	$contacto->correo = $correo;
    	$contacto->mensaje = $mensaje;

    	$contacto->save();

    	return view('index');

    }
}
