<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class FollowController extends Controller
{
    public function unfollow($id){ //dejar de seguir al usuario con id

    	$follower = Auth::user();
    	$followed = new User;
    	$followed = $followed->find($id);

    	$misfollows = $follower->follows;

    	foreach ($misfollows as $follow) {
    		if ($id == $follow->id) {
    			DB::table('user_user')->where('follower',$follower->id)->where('followed', $followed->id)->delete();
    		}
    	}

    	return redirect('seguidos');
    }
}
