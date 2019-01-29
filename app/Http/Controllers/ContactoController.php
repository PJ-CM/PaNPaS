<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contacto;

use Route;

class ContactoController extends Controller
{
    protected $valores_tipo = 'contacto';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'nombre' => 'required|string|max:50',
            'correo' => 'required|string|email|max:100',
            'mensaje' => 'required|string|max:250',
            //'leido' => 'required|in:0,1',
        ];
        //Validando petición
        $request->validate($reglas);

        //Insertando nuevo registro y recuperando el ID
        //------------------------------------------------
        $dato = Contacto::create($request->all());
        if(empty($dato->id)) {
            //Log::error('Failed to insert row into database.');
            dd('ERROR al insertar en la tabla ['.$this->valores_tipo.'s'.'] de la base de datos. ['. $dato->id.']');
        } else {
            //dd('Inserto efectuado. ['. $dato->id.']');

            //Redirigiendo a Inicio
            //==========================================
            //  -> Redirigiendo hacia nombre de Ruta
            ////return redirect()->route('index');
            $accion = 'insertar_'.$dato->id;
            ////return redirect()->route('index', ['accion' => $accion]);
            //Como es petición AJAX, se deja el RETURN vacío
            return;
        }
    }
}
