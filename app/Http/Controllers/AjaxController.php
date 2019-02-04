<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
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

    public function follow($id){

        $follower = Auth::user();

        DB::table('user_user')->insert([
            'follower' => $follower->id,
            'followed' => $id
        ]);
        return Auth::user()->follows;
    }



        public function unfollow($id){

            $follower = Auth::user();
            $followed = new User;
            $followed = $followed->find($id);

            $misfollows = $follower->follows;

            foreach ($misfollows as $follow) {
                if ($id == $follow->id) {
                    DB::table('user_user')->where('follower', $follower->id)->where('followed', $followed->id)->delete();
                }
            }
            return Auth::user()->follows;
        }

}