<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
        
        //geen redirect, want dit is gewoon iets dat uitgevoerd moet worden op de achtergrond
        return response()->json(['status' => "success"]);
        
    }
    
    
    
    
}
