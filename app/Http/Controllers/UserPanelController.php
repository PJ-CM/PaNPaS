<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserPanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($username = null)
    {
        if (Auth::user()->perfil_id != 1){
            return view('users.dashboard');
        } else 
            return redirect('admin/dashboard');          
        
    }

    public function logout(){
        Auth::logout();
        return redirect("/");
    }
}
