<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Document;
use App\ProjectDocument;


class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['except' => 'test']);
    }

    public function test()
    {
        dd("Deze functie kan ook opgeroepen worden door niet admins :)");
    }


    public function show_add_project()
    {
        return view('projects/add_project');
    }


    public function add_project(Request $request)
    {

        if ($request->active == "on") {
            $active = 1;
        } else {
            $active = 0;
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'image' => 'required|max:1000|mimes:jpeg,bmp,png',
            /*  'startdate' => 'required|date|after:today',
              'enddate' => 'required|date|after:startdate',
              'starttime' => 'required',
              'endtime' => 'required',*/
        ]);

        $start = $request->startdate . " " . $request->starttime;
        $end = $request->enddate . " " . $request->endtime;

        $new_file_name = time() . $request->image->getClientOriginalName();
        $request->image->move(base_path() . '/public/images/project_pictures/', $new_file_name);


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

        return redirect('/dashboard');
    }


    public function show_edit_project($id)
    {
        $project = Project::where('id', $id)->first();
        return view('projects/edit_project', ['project' => $project]);
    }


    public function edit_project($id, Request $request)
    {

        $project = Project::find($id);

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
                //$request->image->move(base_path() . '/public/images/project_pictures/', $new_file_name);
                $project->image = $new_file_name;
            }
        }
        $start = $request->startdate . " " . $request->starttime;
        $end = $request->enddate . " " . $request->endtime;

        if ($request->active == "on") {
            $active = 1;
        } else {
            $active = 0;
        }

        $project->name = $request->name;
        $project->description = $request->description;
        $project->address = $request->address;
        $project->city = $request->city;
        $project->country = $request->country;
        $project->start = $start;
        $project->end = $end;
        $project->active = $active;

        //dd($project);

        $project->save();
        if ($request->selected_file) {
            $project->documents()->sync($request->selected_file);
        }

        return redirect('/edit_project/' . $id);
    }


}








