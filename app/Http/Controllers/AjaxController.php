<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class AjaxController extends Controller
{
    public function updateUsers(Request $request) //listado de todos los usuarios registrados
    {
    	$users = new User;
        $users = $users->all();

        return count($users);
    }

    public function getUsuarios(){
    	
    	$users = User::with('follows')->with('followers')->get();

			return (json_encode($users));
    }

    public function getSearchUsuarios($termino){

       $users = User::orderBy('username', 'asc')
                    ->where('username', 'LIKE', "%{$termino}%")
                    ->with('follows')
                    ->with('followers')
                    ->get();


            return (json_encode($users));
    }


}
