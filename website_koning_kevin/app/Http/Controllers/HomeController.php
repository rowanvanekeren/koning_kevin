<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //except => name_function  voor uitzonderingen
        $this->middleware('is_active',['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inactive_users = User::where('is_active', 0)->get();
        
        return view('dashboard', ['inactive_users' => $inactive_users]);
    }
    
    public function profile_info($id = null)
    {
        if(!$id) {
            $id = Auth::user()->id;
        }
        
        $user = User::find($id);
        return view('profile_info', ['user' => $user]);
    }
}
