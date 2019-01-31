<?php

namespace App\Http\Controllers\API;

use App\User;
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
        ////$this->middleware('auth');
        ////$this->middleware('verified');
        //----------------------------------------------------------
        //  >> Desactivado mientras se desarrolla
        ////$this->middleware(['auth', 'verified']);
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
        return User::withTrashed()->with('perfil:id,nombre')->orderBy('id', 'desc')->get();
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
     * Update the specified resource in storage.
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

        $user = User::findOrFail($id)->update($request->all());

        return ['message' => 'Actualizando el registro con ID => [' . $id . ']'];
    }*/
    //Forma más corta empleando el FormRequest
    public function update(UserUpdateRequest $request, $id) {
        $user = User::findOrFail($id)->update($request->all());
        //Lo mismo que en el STORE, siempre que se tenga que tratar el PASSWORD,
        //se empleará el SAVE en vez del UPDATE
        $user = User::findOrFail($id);
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
     *          -> el DELETE() pasa mandar el registro
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
}
