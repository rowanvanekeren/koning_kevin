<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
Use App\Document;
Use App\Role;
use Illuminate\Support\Facades\Session;
use App\Tag;
use Response;


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
        $put_categories = [];
        $all_categorys = Category::all();
        foreach ($all_categorys as $key => $category) {
            $put_categories[$category->id] = $category->type;
        }
        $put_roles = [];
        $all_roles = Role::all();
        foreach ($all_roles as $key => $role) {
            $put_roles[$role->id] = $role->type;

        }
        return view('managing_files/add_file', ['roles' => $put_roles, 'categories' => $put_categories]);
    }


    public function show_file()
    {
        return view('managing_files/show_file');
    }

    public function add_file(Request $request)
    {


        //controlle op url of file upload
//        if (isset($request->url) && strlen($request->url) != "") {
//            $this->validate($request, [
//                'title' => 'required|max:255',
//                'description' => 'required|max:255',
//                'url' => 'required|max:1000',
//                'roles' => 'required|max:6',
//                'tags' => 'max:255',
//                'categories' => 'required|max:6',
//                'priority' => 'required|max:1',
//            ]);
//
//        } else {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'file' => 'required|max:1000|mimes:pdf',
            //'file' => 'required|mimes:application/pdf,application/msword,application/zip',
            'role' => 'required|max:6',
            'category' => 'required',
            'priority' => 'required',
            'tags' => 'max:255',
        ]);
        $new_file_name = time() . $request->file->getClientOriginalName();
        $destinationPath = base_path() . '/public/files'; // upload path
        $request->file->move($destinationPath, $new_file_name); // uploading file to given path
        $request->url = '/download/' . $new_file_name;
//        }
        $request->tags = explode(',', $request->tags);

        $indexs_of_tags = [];
        foreach ($request->tags as $tag) {


            if (sizeof(Tag::where('type', $tag)->get())) {
                array_push($indexs_of_tags, Tag::where('type', $tag)->first()->id);
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


        $document->categories()->sync([$request->category]);
        $document->roles()->sync([$request->role]);
        $document->tags()->sync($indexs_of_tags);

        //ton dat bestand is goed opgeload!
        Session::flash('success', 'Bestand is opgeslagen, voeg nog een toe als je dat wenst!');
        //keer terug naar file add pagina om nieuw bestand te laden
        return redirect('/add_file');
    }

    public function download($file_name)
    {
        $filename = $file_name;
        $path = base_path() . '/public/files/' . $filename;
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
//        $base_path = base_path();
//        $full_patch_and_name = $base_path.'/public/files/'.$file_name;
//        return response()->download($full_patch_and_name);
    }
}
