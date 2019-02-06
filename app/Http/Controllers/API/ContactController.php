<?php

namespace App\Http\Controllers\API;

use App\Contacto;
use Illuminate\Http\Request;
use App\Mail\ContactoResponseEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Enviar respuesta a mensajes de contacto
     *
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendContactResponse(Request $request, $id)
    {
        //validar que se mandó TXT de respuesta...

        $contacto = Contacto::findOrFail($id);

        $objResponseData = new \stdClass();
        $objResponseData->to_nombre = $contacto->nombre;
        $objResponseData->to_fecha = $contacto->created_at;
        $objResponseData->respuesta = $request->respuesta;
        ////$objResponseData->from_nombre = 'PaNPaS';
        $objResponseData->from_nombre = env('APP_NAME', 'PaNPaS');
        $objResponseData->from_email = env('MAIL_FROM_ADDRESS', 'panpas.zm@gmail.com');

        ////Mail::to($contacto->correo)->send(new ContactoResponseEmail($objResponseData));

        //Devolver una respuesta de que se envió el correo o NO
        try {
            Mail::to($contacto->correo)->send(new ContactoResponseEmail($objResponseData));
            $msg = 'Email de respuesta enviado ... OK';
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }
}
