<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\RoleUser;
use App\Project;

class ApiController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin');
    }
    
    public function get_inactive_users() {
        $inactive_users = User::where('is_active', 0)->get();
        return response()->json($inactive_users);
    }
    
    
    public function activate_user(Request $request) {
        
        $user = User::find($request->id);
        $user->is_active = 1;
        $user->save();
        
        //return response succesfull
        return response()->json(['status' => "success", 'user_id' => $user->id]);
        
    }
    
    public function add_role_to_user(Request $request) {
        
        $role_user = new RoleUser([
            'role_id' => $request->role_id,
            'user_id' => $request->id
        ]);
        $role_user->save();
        return response()->json(['status' => "success"]);
        
    }
    
    
    public function decline_user(Request $request) {
        $user = User::find($request->id);
        //set user is_active to 2 which means declined
        $user->is_active = 2;
        $user->save();
        //return response succesfull
        return response()->json(['status' => "success", 'user_id' => $user->id]);
    }
    
    public function delete_user(Request $request) {
        $user = User::find($request->id);
        $user->delete();
        $user->roles()->detach();
        $user->projects()->detach();
        //return response succesfull
        return response()->json(['status' => "success", 'user_id' => $user->id]);
    }


    //edit_project
    public function get_accepted_and_applied_volunteers(Request $request) {
        //
        //$id = 1;
        $project = Project::find($request->project_id);
        $accepted_volunteers = $project->users_accepted()->with('roles')->get();
        $applied_volunteers = $project->accepting_users()->with('roles')->get();
        //dd($accepted_volunteers, $applied_volunteers);
        
        return response()->json(['status' => "success", 'accepted_volunteers' => $accepted_volunteers, 'applied_volunteers' => $applied_volunteers]);
    }
    
    
    public function accept_user_for_project(Request $request) {

        $project = Project::find($request->project_id);
        $user = $project->users()->where('users.id', $request->user_id)->first();
        $user->pivot->is_accepted = 1;
        $user->pivot->role_id = $request->role_id;
        $user->pivot->save();
        
        return response()->json(['status' => "success", 'user_id' => $request->user_id, 'project_id' => $request->project_id, 'role_id' => $request->role_id]);
    }

    public function add_user_to_project(Request $request) {
        $user = User::find($request->user_id);
        $user->projects()->attach($request->project_id);

        $project = Project::find($request->project_id);
        $user_with_pivot = $project->users()->where('users.id', $request->user_id)->first();

        $user_with_pivot->pivot->is_accepted = 1;
        $user_with_pivot->pivot->role_id = $request->role_id;
        $user_with_pivot->pivot->save();
        return response()->json(['status' => "success", 'user_id' => $request->user_id, 'project_id' => $request->project_id, 'role_id' => $request->role_id]);
    }
    
    //get_all_users for manual adding
    public function get_all_volunteers() {
        $volunteers = User::where('is_active', 1)->orderBy('last_name')->with('roles')->get();
        //dd($volunteers[0]->roles);
        return response()->json(['status' => "success", 'volunteers' => $volunteers]);
    }

    public function get_searched_volunteers(Request $request) {

        $volunteers = User::
            where('is_active', 1)
            ->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->searchword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->searchword . '%');
            })
            ->orderBy('last_name')
            ->with('roles')
            ->get();
        //dd($volunteers);
        return response()->json(['status' => "success", 'volunteers' => $volunteers]);
    }


}
