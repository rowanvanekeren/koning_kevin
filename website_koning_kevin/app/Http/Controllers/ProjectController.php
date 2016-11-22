<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['except' => 'test']);
    }
    
    public function test() {
        dd("Deze functie kan ook opgeroepen worden door niet admins :)");
    }
    
    
    public function show_add_project()
    {
        return view('projects/add_project');
    }
    
    
    public function add_project(Request $request) {
        
        
        if($request->active == "on") {
            $active = 1;
        }
        else {
            $active = 0;
        }
        
        $this->validate($request, [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'image' => 'required|max:1000|mimes:jpeg,bmp,png',
                'startdate' => 'required|date|after:today',
                'enddate' => 'required|date|after:startdate',
            ]);
        
            
        $new_file_name = time() . $request->image->getClientOriginalName();
        $request->image->move(base_path() . '/public/images/project_pictures/', $new_file_name);
        
        
        $project = new Project([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $new_file_name,
            'start' => $request->startdate,
            'end' => $request->enddate,
            'active' => $active
        ]);

        $project->save();
        
        return redirect('/dashboard');
    }
    
}
