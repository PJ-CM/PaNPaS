<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\User;
use Auth;
use DB;

class FollowController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  >> Desactivarlo mientras se desarrolla
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Dejar de seguir al usuario con id
     *
     * @param [type] $id
     * @return void
     */
    public function unfollow($id)
    {
        $follower = Auth::user();
        $followed = new User;
        $followed = $followed->find($id);

        $misfollows = $follower->follows;

        foreach ($misfollows as $follow) {
            if ($id == $follow->id) {
                DB::table('user_user')->where('follower', $follower->id)->where('followed', $followed->id)->delete();
            }
        }

        return Redirect::back();
    }

    /**
     * Seguir al usuario con id
     *
     * @param [type] $id
     * @return void
     */
    public function follow($id)
    {
        $follower = Auth::user();

        DB::table('user_user')->insert([
            'follower' => $follower->id,
            'followed' => $id
        ]);

        return Redirect::back();
    }
}
