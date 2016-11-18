<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
Use App\Document;
Use App\Role;


class Managing_files extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['except' => 'show_file']);
    }

    public function show_add_file()
    {
        return view('managing_files/add_file', ['roles' => Category::all(), 'categories' => Role::all()]);
    }

    public function show_file()
    {
        return view('managing_files/show_file');
    }

    public function add_file(Request $request)
    {




        if (isset($request->url)&& strlen($request->url)!="") {

            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'url' => 'required|max:1000',
                'priority' => 'required|max:1',
            ]);
            return 'url';
        }else {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'file' => 'required|mimes:doc,pdf,zip,docx',
                //'file' => 'required|mimes:application/pdf,application/msword,application/zip',
                'priority' => 'required|max:1',
            ]);
        }

        return "success";

        $new_file_name = time() . $request->file->getClientOriginalName();
        $destinationPath = base_path() . '/public/files'; // upload path
        $request->file->move($destinationPath, $new_file_name); // uploading file to given path

        //Session::flash('success', 'Upload successfully');


        $document = new Document();
        $document->title = $request->title;
        $document->description = $request->description;
        $document->url = $request->url;
        $document->priority = $request->priority;
        $document->save();


        $document->roles()->sync($request->roles);
        $document->categories()->sync(($request->categories));

        return 'succes';


    }
}
