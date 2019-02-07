<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Contacto;
use Illuminate\Http\Request;
use App\Mail\ContactoResponseEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Exigiendo: autenticarse
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  >>CON Soft Delete activado
        //      -> pero los registros en papelera se mostrarán en otra vista
        $elems_no_papelera = Contacto::where('correo', '!=', Auth::user()->email)
                        ->orderBy('created_at', 'desc')->get();

        $elems_no_papelera_leido_no_tot = $this->getTotLeidoNo();

        $_arr_detalle = [];

        $_arr_detalle['elems_no_papelera'] = $elems_no_papelera;
        $_arr_detalle['elems_no_papelera_leido_no_tot'] = $elems_no_papelera_leido_no_tot;

        return $_arr_detalle;
    }

    /**
     * Tot no leido(s) fuena de la papelera.
     *
     * @return int
     */
    public function getTotLeidoNo()
    {
        return Contacto::where('correo', '!=', Auth::user()->email)
                        ->where('leido', 0)
                        ->count();
    }

    /**
     * Filtrar resultados del listado por el término enviado
     *
     * $termino => buscando por nombre, apellido, username, email
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $termino = $request->term;
        return Contacto::withTrashed()
                ->where('nombre', 'LIKE', "%{$termino}%")
                ->orWhere('correo', 'LIKE', "%{$termino}%")
                ->orWhere('asunto', 'LIKE', "%{$termino}%")
                ->orWhere('mensaje', 'LIKE', "%{$termino}%")
                ->orderBy('created_at', 'desc')->get();
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
        return Contacto::withTrashed()->findOrFail($id);
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
     * Editing the field of an specified register.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    ////public function update_campo(User $user)
    public function update_campo($id, $campo, $valor)
    {
        Contacto::where('id', $id)
                ->update([
                    $campo => $valor,
                ]);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *      >> Teniendo Soft Delete activado
     *          -> el DELETE() pasa a mandar el registro
     *          a la papelera
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $elem = Contacto::findOrFail($id);

            $elem->delete();
            //SIN Soft Delete
            ////$msg = 'Registro borrado definitivamente ... OK';
            //CON Soft Delete
            $msg = 'Registro mandado a la papelera ... OK';

        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }

    /**
     * Forcing remove the specified resource.
     *      >> Teniendo Soft Delete activado
     *          -> es necesario forzar el DELETE()
     *          para eliminar el registro totalmente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        try {
            //  >>CON Soft Delete activado
            //      -> incluyendo los registros en papelera
            $elem = Contacto::withTrashed()->findOrFail($id);

            $elem->forceDelete();
            $msg = 'Registro borrado definitivamente ... OK';
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }

    /**
     * Restore form trash the specified resource.
     *      >> Teniendo Soft Delete activado
     *          -> se restaura el registro desactivado
     *          por encontrarse en la papelera
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreDelete($id)
    {
        try {
            $elem = Contacto::onlyTrashed()->findOrFail($id);

            $elem->restore();
            $msg = 'Registro restaurado de la papelera ... OK';
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }

    /**
     * Enviar respuesta a mensajes de contacto
     *
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendContactResponse(Request $request)
    {
        //validar que se mandó TXT de respuesta...
        $reglas = [
            'mensaje' => 'required|string|max:400',
        ];
        //Validando petición
        $request->validate($reglas);

        $contacto = Contacto::findOrFail($request->id);

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
