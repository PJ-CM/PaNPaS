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
}
