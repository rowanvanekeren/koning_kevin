<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Project;
use App\Role;


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
        $this->middleware('is_active', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $projects = Project::where('active', 1)->get();
        $inactive_users = User::where('is_active', 0)->get();
        $roles = Role::all();
        return view('dashboard', ['projects' => $projects, 'inactive_users' => $inactive_users, 'roles' => $roles]);
    }

    public function profile_info($id = null)
    {
        if (!$id) {
            $id = Auth::user()->id;
        }
        $user = User::find($id);
        return view('profile_info', ['user' => $user]);
    }
}
