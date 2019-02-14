<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Receta;
use App\Contacto;
use App\Comentario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Exigiendo: autenticarse, verificar-email-registro
        ////$this->middleware('auth:api');
        ////$this->middleware('verified');
        //----------------------------------------------------------
        //  >> Desactivado mientras se desarrolla
        $this->middleware(['auth:api', 'verified']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            //'username'  => 'required|string|max:69|unique:users',
            'username' => 'required|string|max:255|unique:users,username,' . $data->id,
            //'email'     => 'required|string|email|max:100|unique:users',
            'email' => 'required|string|email|max:255|unique:users,email,' . $data->id,
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'perfil_id' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////return User::all();
        //  >> Empleo de with() para obtener datos del perfil de cada registro
        //  a través de la relación perfil() del modelo
        //      -> recogiendo, solamente, las columnas de ID y el NOMBRE de "perfiles"
        //Sin orden establecido
        ////return User::with('perfil:id,nombre')->get();
        //En orden DESC
        ////return User::with('perfil:id,nombre')->orderBy('id', 'desc')->get();
        //  >>CON Soft Delete activado
        //      -> incluyendo los registros en papelera
        return User::withTrashed()->with('perfil:id,nombre')
                    ->orderBy('id', 'desc')->get()
                    ->map(function ($user) {//Registrando si el usuario recorrido está conectado
                        $user->isOnline = $user->isOnline();
                        return $user;
                    });
    }

    /**
     * Listar usuarios conectados
     *
     * @return \Illuminate\Http\Response
     */
    public function onlineList()
    {
        return User::select ('id', 'username', 'name', 'lastname', 'avatar', 'last_access_at')
                    ->orderBy('last_access_at', 'desc')->get()
                    ->map(function ($user) {//Registrando si el usuario recorrido está conectado
                        $user->isOnline = $user->isOnline();
                        return $user;
                    });
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
        return User::withTrashed()
                ->with('perfil:id,nombre')
                //para Caso SENSITIVO a Mayúsculas
                //  >> sacando solo resultados que coincidan exactamente
                ////->where('name', 'LIKE', "%{$termino}%")
                ////->orWhere('lastname', 'LIKE', "%{$termino}%")
                ////->orWhere('username', 'LIKE', "%{$termino}%")
                ////->orWhere('email', 'LIKE', "%{$termino}%")
                //para Caso INSENSITIVO a Mayúsculas
                //  >> sacando resultados que coincidan
                //  ya sea en mayúsc. o minúsculas
                ->where('name', 'ilike', "%{$termino}%")
                ->orWhere('lastname', 'ilike', "%{$termino}%")
                ->orWhere('username', 'ilike', "%{$termino}%")
                ->orWhere('email', 'ilike', "%{$termino}%")
                ->orderBy('id', 'desc')->get()
                ->map(function ($user) {//Registrando si el usuario recorrido está conectado
                    $user->isOnline = $user->isOnline();
                    return $user;
                });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //if($request->avatar == '')
            //$request->avatar = 'sin-avatar';
        //if(!$request->input('avatar'))
        //    $request->request->add(['avatar' => 'sin-avatar']);
        //dd($request);
        ////User::create($request->all());
        //----------------------------------------------------
        //En este caso, como se tiene que tratar el campo de PASSWORD de forma especial
        //no se puede hacer el registro con el CREATE, por eso, se emplea el SAVE
        //Lo mismo pasará en el UPDATE si se incluye, también, en este método el PASSWORD
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->perfil_id = $request->perfil_id;
        $user->save();

        //Simplemente, se hace un RETURN vacío pues JS se encargará de avisar
        //del OK del proceso, a no ser que se quiera enviar, por ejemplo,
        //enviar un mensaje informativo para verlo por consola
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::withTrashed()->findOrFail($id);
    }

    /**
     * Devolviendo datos de resumen del registro consultado
     *
     * @param [type] $id
     * @return void
     */
    public function profileDataResume($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $_arr_detalle = [];

        $_arr_detalle['name'] = $user->name;
        $_arr_detalle['lastname'] = $user->lastname;
        $_arr_detalle['username'] = $user->username;
        $_arr_detalle['avatar'] = $user->avatar;
        //Verificando si está conectado
        $_arr_detalle['isOnline'] = $user->isOnline();

        $user_recetas               = Receta::where('user_id', $id)->get();
        $user_comentarios_count     = Comentario::where(['user_id' => $id])->count();
        $user_mens_contacto_count   = Contacto::where(['correo' => $user->email])->count();
        $user_seguidores_count      = count($user->followers);
        $user_seguidos_count        = count($user->follows);

        $_arr_detalle['user_recetas_tot'] = count($user_recetas);
        $_arr_detalle['user_comentarios_tot'] = $user_comentarios_count;
        $_arr_detalle['user_mens_contacto_tot'] = $user_mens_contacto_count;
        $_arr_detalle['user_seguidores_tot'] = $user_seguidores_count;
        $_arr_detalle['user_seguidos_tot'] = $user_seguidos_count;

        return $_arr_detalle;
    }

    /**
     * Devolviendo actividad del registro consultado
     *
     * @param [type] $id
     * @return void
     */
    public function profileActivity($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $_arr_detalle = [];

        $ultim_recetas = Receta::where('user_id', $id)
                            ->with('comentarios')
                            ->orderBy('created_at', 'DESC')//primero, por fecha DESC
                            ->orderBy('id', 'DESC')//segundo, por ID DESC
                            ->take(3)->get();

        $ultim_comentarios = Comentario::where('user_id', $id)
                            ->with('user')
                            ->with('receta:id,titulo')
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->take(3)->get();

        $ultim_mens_contacto = Contacto::where('correo', $user->email)
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->take(3)->get();

        $_arr_detalle['user'] = $user;
        $_arr_detalle['ultim_recetas'] = $ultim_recetas;
        $_arr_detalle['ultim_comentarios'] = $ultim_comentarios;
        $_arr_detalle['ultim_mens_contacto'] = $ultim_mens_contacto;

        return $_arr_detalle;
    }

    /**
     * Update the specified resource in storage.
     *
     * A continuación, forma larga de validar los campos a actualizar
     *
     * Finalmente, aplicará la forma de validar a través de un FormRequest
     * (ver en el bloque siguiente sin comentar, el /app/Http/Requests/UserUpdateRequest)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        ////$validator = $this->validatorUpdate($request->all());
        //////Si la validación falla
        ////if ($validator->fails()) {
        ////    $errors = $validator->errors();
        ////    return $errors;
        ////}
        ////User::findOrFail($id)->update($request->all());
        //////Estando activado el Soft Delete
        ////User::withTrashed()->findOrFail($id)->update($request->all());

        ////$this->validate($request, [
        ////    //'username'  => 'required|string|max:69|unique:users',
        ////    'username' => 'required|string|max:255|unique:users,username,' . $request->id,
        ////    //'email'     => 'required|string|email|max:100|unique:users',
        ////    'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
        ////    //'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ////    //'password'  => ['sometimes', 'string', 'min:6', 'confirmed'],
        ////    'perfil_id' => 'required',
        ////]);
        //************************************************
        //Validación
        //Estableciendo reglas de validación
        $reglas = [
            'username' => 'required|string|max:255|unique:users,username,' . $request->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'perfil_id' => 'required',
        ];
        //Validando petición
        $request->validate($reglas);

        //$user = User::findOrFail($id)->update($request->all());
        //Estando activado el Soft Delete
        $user = User::withTrashed()->findOrFail($id)->update($request->all());

        return ['message' => 'Actualizando el registro con ID => [' . $id . ']'];
    }*/
    //Forma más corta empleando el FormRequest
    public function update(UserUpdateRequest $request, $id) {
        //Lo mismo que en el STORE, siempre que se tenga que tratar el PASSWORD,
        //se empleará el SAVE en vez del UPDATE
        //  >> Estando activado el Soft Delete para este Modelo
        $user = User::withTrashed()->findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        //Si no es NULO
        if( !is_null($request->password) ) {
            $user->password = Hash::make($request->password);
        }
        $user->perfil_id = $request->perfil_id;
        $user->save();

        return ['message' => 'Actualizando el registro con ID => [' . $id . ']'];
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
            $user = User::findOrFail($id);

            $user->delete();
            //SIN Soft Delete
            ////$msg = 'Usuario borrado definitivamente ... OK';
            //CON Soft Delete
            $msg = 'Usuario mandado a la papelera ... OK';

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
            $user = User::withTrashed()->findOrFail($id);

            $user->forceDelete();
            $msg = 'Usuario borrado definitivamente ... OK';
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
            $user = User::onlyTrashed()->findOrFail($id);

            $user->restore();
            $msg = 'Usuario restaurado de la papelera ... OK';
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }

    //********************************************************************************
    //********************************************************************************

    /**
     * Filtrar altas de recetas por un rango de fechas
     *
     * @param Request $request
     * @return void
     */
    public function searchXDateRange(Request $request)
    {
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;
        return Receta::where('created_at', 'LIKE', "%{$termino}%")
                ->orWhere('lastname', 'LIKE', "%{$termino}%")
                ->orWhere('username', 'LIKE', "%{$termino}%")
                ->orWhere('email', 'LIKE', "%{$termino}%")
                ->orderBy('created_at', 'asc')->get();
    }
}
