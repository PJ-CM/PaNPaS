<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Receta;
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

         public function getRecetas(){
        
         $recetas = Receta::with('user')->with('users')->get();

            return (json_encode($recetas));
    }

    public function getSearchRecetas($termino){

       $recetas = Receta::orderBy('created_at', 'desc')
                    ->where('titulo', 'LIKE', "%{$termino}%")
                    ->with('user')
                    ->with('users')
                    ->get();


            return (json_encode($recetas));
    }


    public function fav($id){

        DB::table('receta_user')->insert([
            'user_id' => Auth::user()->id,
            'receta_id' => $id
        ]);

        $receta = Receta::find($id);
        $receta->votos = $receta->votos + 1;
        $receta->save();


        return Auth::user()->favoritos;
    }



        public function unfav($id){

            $misFavs = Auth::user()->favoritos;

            foreach ($misFavs as $fav) {
                if ($fav->pivot->receta_id == $id) {
                    DB::table('receta_user')->where('user_id', Auth::user()->id)->where('receta_id', $id)->delete();
                }
            }

            $receta = Receta::find($id);
            $receta->votos = $receta->votos - 1;
            $receta->save();

            return Auth::user()->favoritos;
        }

}