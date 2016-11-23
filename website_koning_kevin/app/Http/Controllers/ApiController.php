<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\RoleUser;

class ApiController extends Controller
{
    //
    
    
    
    public function test() {
        return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        //Response::json($result)->setCallback(Input::get('callback'));
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
    
    
    
}
