<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function index($username)
    {
        return view('users.dashboard');
    }
}
