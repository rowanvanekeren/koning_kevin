<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
Use App\Document;
Use App\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Tag;
use Response;
use App\Project;
use App\ProjectDocument;
use App\Readme;


class Managing_files extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin', ['except' => ['show_file','download']]);
    }

    public function add_unique_file()
    {
        return 'okey';
    }

    public function delete_file($project_id, $file_id)
    {
        $project = Project::find($project_id);
        $project->documents()->detach($file_id);

        return redirect('/edit_project/' . $project_id);
    }

    public function delete_extra_file($project_id, $file_id)
    {
        ProjectDocument::find($file_id)->delete();

        return redirect('/edit_project/' . $project_id);
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

//        return Category::all()->pluck('type');
        return view('managing_files/show_file')->with('roles', Role::all()->pluck('type'))->with('categories', Category::all()->pluck('type'));
    }

    public function edit_file(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'file' => 'required|max:60000|mimes:pdf',
            'role' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'tags' => 'max:255',
        ]);

        $document = Document::find($id);



        if ($request->file) {
            $new_file_name = time() . $request->file->getClientOriginalName();
            $destinationPath = base_path() . '/public/files'; // upload path
            $request->file->move($destinationPath, $new_file_name); // uploading file to given path
            $request->url = '/download/' . $new_file_name;

        } else {

            $request->url = $document->url;
        }


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


        $document->title = $request->title;
        $document->description = $request->description;
        $document->url = $request->url;
        $document->priority = $request->priority;

     
        $document->save();
//        $document->update([
//            'title' => $request->title,
//            'description' => $request->description,
//            'url' => $request->url,
//            'priority' => $request->$request->priority
//        ]);


        $request->category= Category::where('type',$request->category)->first()->id;

        $request->role=Role::where('type',$request->role)->first()->id;
        $document->categories()->sync([$request->category]);
        $document->roles()->sync([$request->role]);
        $document->tags()->sync($indexs_of_tags);

        //ton dat bestand is goed opgeload!
        Session::flash('success', 'Server bestand is bijgewerkt!');
        //keer terug naar file add pagina om nieuw bestand te laden


        return redirect('/edit_file/' . $id);
    }

    public function show_edit_file($id)
    {
        $document = Document::with('categories', 'roles', 'tags')->where('id', $id)->first();
        $all_categorys = Category::all();
        foreach ($all_categorys as $key => $category) {
            $put_categories[$category->type] = $category->type;
        }
        $put_roles = [];
        $all_roles = Role::all();
        foreach ($all_roles as $key => $role) {
            $put_roles[$role->type] = $role->type;
        }
        $tags = "";
        foreach ($document->tags as $key => $tag) {
            if ($key != count($document->tags) - 1) {
                $tags = $tags . $tag->type . ', ';
            }

        }

        return view('managing_files/edit/edit_file', ['file' => $document,
            'roles' => $put_roles, 'categories' => $put_categories, 'tags' => $tags]);
    }

    public function add_file(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'file' => 'required|max:60000|mimes:pdf',
            //'file' => 'required|mimes:application/pdf,application/msword,application/zip',
            'role' => 'required',
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
    public function show_registration_file(){
        
        return view('managing_files/registrationFile');
    }
    public function add_registration_file(Request $request){

        $this->validate($request,[
            'file'=>'required|max:60000|mimes:pdf',
        ]);

        $new_file_name = time() . $request->file->getClientOriginalName();
        $destinationPath = base_path() . '/public/files/readme'; // upload path
        $request->file->move($destinationPath, $new_file_name); // uploading file to given path


        $file = new Readme;
        $file->url =$new_file_name;
        $file->save();
        Session::flash('success', 'Server bestand is bijgewerkt!');
        return redirect('/registratiebestand');
    }
}
