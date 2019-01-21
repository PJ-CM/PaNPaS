<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
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
        return User::with('perfil:id,nombre')->orderBy('id', 'desc')->get();
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
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->perfil_id = $request->perfil_id;
        $user->save();

        //simplemente, se hace un RETURN vacío pues JS se encargará de avisar
        //del OK del proceso
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
        try {
            $user = User::findOrFail($id);

            $user->delete();
            $msg = 'Usuario borrado definitivamente ... OK';

        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return [
            'message' => $msg,
        ];
    }
}
