<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Document;
use App\ProjectDocument;
use Image;


class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['except' => 'test']);
    }

    
    public function test() {
        //dd("Deze functie kan ook opgeroepen worden door niet admins :)");
        $project = Project::find(1);
        //$project->users()->wherePivot('user_id', 5)->updateExistingPivot($roleId, $attributes)
        
        $project = Project::find(1);
        $user = $project->users()->where('users.id',5)->first();
        //$user->pivot->role_id = 5;
        //$user->pivot->save();
        
        dd($user->pivot->role_id);
    }


    public function show_add_project()
    {
        return view('projects/add_project');
    }


    public function add_project(Request $request)
    {
        if ($request->active == "on") {
            $active = 1;
        } 
        else {
            $active = 0;
        }

        //get day before startdate, in order to check whether the enddate is equal to or after startdate
        $startdate = strtotime($request->startdate);
        $day_before_start = strtotime("yesterday", $startdate);
        $formatted_day_before = date('Y-m-d', $day_before_start);

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'image' => 'required|max:1000|mimes:jpeg,bmp,png',
            'startdate' => 'required|date|after:today',
            'enddate' => 'required|date|after:'.$formatted_day_before,
            'starttime' => 'required',
            'endtime' => 'required',
        ]);

        $start = $request->startdate . " " . $request->starttime;
        $end = $request->enddate . " " . $request->endtime;

        $new_file_name = time() . $request->image->getClientOriginalName();
        $request->image->move(base_path() . '/public/images/project_pictures/', $new_file_name);


        $destinationPath = base_path() .'/public/images/project_pictures/'. $new_file_name;


        $dimension = getimagesize($destinationPath);

        $max_width = "500";
        $max_height = "500";
        if ($dimension[0] > $max_width) {
            $save_percent = round(100/$dimension[0]*$max_width)/100;
            $max_height =round($save_percent*$dimension[1]);
            Image::make($destinationPath)
                ->resize($max_width, $max_height)->save($destinationPath);
        }
        if($dimension[1] > $max_height){
            $save_percent = round(100/$dimension[1]*$max_height)/100;
            $max_width =round($save_percent*$dimension[0]);
            Image::make($destinationPath)
                ->resize($max_width, $max_height)->save($destinationPath);
        }


        $project = new Project([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $new_file_name,
            'start' => $start,
            'end' => $end,
            'active' => $active
        ]);

        $project->save();

        if ($request->selected_file) {
            $project->documents()->sync($request->selected_file);
        }

        return redirect('/edit_project/' . $project->id)->with("success_message", 'Project werd succesvol aangemaakt!');
    }


    public function show_edit_project($id)
    {
        $project = Project::where('id', $id)->first();
        return view('projects/edit_project', ['project' => $project]);
    }


    public function edit_project($id, Request $request)
    {

        $project = Project::find($id);
        
        if ($request->active == "on") {
            $active = 1;
        } 
        else {
            $active = 0;
        }
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'image' => 'max:1000|mimes:jpeg,bmp,png',
            'startdate' => 'required|date|after:today',
            'enddate' => 'required|date|after:startdate',
            'starttime' => 'required',
            'endtime' => 'required',
        ]);

        if ($request->file || $request->file_title){
            $this->validate($request, [
                'file_title' => 'required|max:255',
                'file' => 'required|max:8000|mimes:pdf'
            ]);

            $new_file_name = time() . $request->file->getClientOriginalName();
            $destinationPath = base_path() . '/public/files'; // upload path
            $request->file->move($destinationPath, $new_file_name); // uploading file to given path
            $url = '/download/' . $new_file_name;

            $document = new ProjectDocument;
            $document->title = $request->file_title;
            $document->url = $url;
            $project->extra_documents()->save($document);
        }
        
        $allowed_extensions = ["jpeg", "png"];
        if (isset($request['image'])) {
            if (in_array($request['image']->guessClientExtension(), $allowed_extensions)) {

                //create new file name
                $new_file_name = time() . $request->image->getClientOriginalName();
                $request->image->move(base_path() . '/public/images/project_pictures/', $new_file_name);
                $project->image = $new_file_name;


                $destinationPath = base_path() .'/public/images/project_pictures/'. $new_file_name;
                $dimension = getimagesize($destinationPath);

                $max_width = "500";
                $max_height = "500";
                if ($dimension[0] > $max_width) {
                    $save_percent = round(100/$dimension[0]*$max_width)/100;
                    $max_height =round($save_percent*$dimension[1]);
                    Image::make($destinationPath)
                        ->resize($max_width, $max_height)->save($destinationPath);
                }
                if($dimension[1] > $max_height){
                    $save_percent = round(100/$dimension[1]*$max_height)/100;
                    $max_width =round($save_percent*$dimension[0]);
                    Image::make($destinationPath)
                        ->resize($max_width, $max_height)->save($destinationPath);
                }

            }
        }


        $start = $request->startdate . " " . $request->starttime;
        $end = $request->enddate . " " . $request->endtime;

        $project->name = $request->name;
        $project->description = $request->description;
        $project->address = $request->address;
        $project->city = $request->city;
        $project->country = $request->country;
        $project->start = $start;
        $project->end = $end;
        $project->active = $active;

        $project->save();
        if ($request->selected_file) {
            $project->documents()->sync($request->selected_file);
        }

        return redirect('/edit_project/' . $id)->with("success_message", 'Project werd succesvol geüpdatet!');;
    }
    
    public function delete_project(Request $request) {
        //dd($id);
        //return response()->json(['status' => "success", 'project_id' => $request->id]);

        //soft_delete the project
        $project = Project::find($request->id);
        $project->delete();
        //all related models should be deleted as well
        //users
        $project->users()->detach();
        //documents
        $project->documents()->detach();

        return response()->json(['status' => "success", 'project_id' => $request->id]);
    }

}


