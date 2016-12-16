<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\AdministrativeDetail;
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
        //dd($user->administrative_details);
        return view('profile_info', ['user' => $user]);
    }
    
    public function edit_profile(Request $request) {
        dd($request);
        $user = User::find($request->user_id);
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->birth_date = $request->birth_date;
        $user->birth_place = $request->birth_place;
        $user->job = $request->job;
        $user->job_function = $request->job_function;
        
        $user->administrative_details->bank_account_number = $request->bank_account;
        $user->administrative_details->national_insurance_number = $request->national_insurance;
        $user->administrative_details->identity_number = $request->identity;
        
        
    }
}
