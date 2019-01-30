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
    	return User::all();
    }

    public function getUsuarioFollows($username){
    	
    	$user = new User();
    	$user = $user->find($username);
    	return $user;
    	return $user->follows();
    }
}
