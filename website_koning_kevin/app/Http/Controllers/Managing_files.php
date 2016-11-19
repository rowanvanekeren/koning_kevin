<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
Use App\Document;
Use App\Role;
use Illuminate\Support\Facades\Session;
use App\Tag;


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


        $request->tags = explode(',', $request->tags);
        //controlle op url of file upload
        if (isset($request->url) && strlen($request->url) != "") {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'url' => 'required|max:1000',
                'roles' => 'required|max:6',
                'tags' => 'required',
                'categories' => 'required|max:6',
                'priority' => 'required|max:1',
            ]);

        } else {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'file' => 'required|max:1000|mimes:doc,pdf,zip,docx',
                //'file' => 'required|mimes:application/pdf,application/msword,application/zip',
                'roles' => 'required|max:6',
                'tags' => 'required',
                'categories' => 'required|max:6',
                'priority' => 'required|max:1',
            ]);
            $new_file_name = time() . $request->file->getClientOriginalName();
            $destinationPath = base_path() . '/public/files'; // upload path
            $request->file->move($destinationPath, $new_file_name); // uploading file to given path
            $request->url = $destinationPath . $new_file_name;
        }


        $indexs_of_tags = [];
        foreach ($request->tags as $tag) {


            if (sizeof(Tag::where('type', $tag)->get())) {
                array_push($indexs_of_tags, Tag::where('type', 'anton')->first()->id);
            } else {
                $tag_row = new Tag;
                $tag_row->type = $tag;
                $tag_row->save();
                array_push($indexs_of_tags, $tag_row->id);

            }
        }


        $document = new Document();
        $document->title = $request->title;
        $document->description = $request->description;
        $document->url = $request->url;
        $document->priority = $request->priority;
        $document->save();
        $document->roles()->sync($request->roles);
        $document->tags()->sync($indexs_of_tags);
        $document->categories()->sync(($request->categories));

        //ton dat bestand is goed opgeload!
        Session::flash('success', 'Bestand is opgeslagen, voeg nog een toe als je dat wenst!');

        //keer terug naar file add pagina om nieuw bestand te laden
        return redirect('/add_file');


    }
}
