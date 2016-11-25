<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
Use App\Category;
Use App\Role;
Use App\Tag;
use Auth;


class Api_file_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin',['only' => 'delete_file']);
//        ['except' => 'get_all_files']
    }

    public function get_all_files()
    {
        $file = [];
        $get_all_categories = Category::all();
        foreach ($get_all_categories as $key => $category) {
            $files = $category->documents()->get();
            if (count($files)) {
                $file[$key]['category'] = $category;
                $file[$key]['files']['all'] = $files;
//                foreach ($files as $index => $value) {
//                    $file[$key]['files']['roles'] = $value->roles()->get();
//                    $file[$key]['files']['tags'] = $value->tags()->get();
//                }
            }
        }
        return $file;
    }


    public function delete_file(Request $request)
    {
        if (Document::find($request->id)->delete()) {
            return array('success' => "Document gewist");
        };
        return array('error' => "Er ging iets fout, probeer later nog eens");
    }

    public function file_info($id)
    {
        if (Document::find($id)) {
            $file = [];
            $find_file = Document::find($id);
            $file['file'] = $find_file;
            $file['categories'] = $find_file->categories()->get();
            $file['roles'] = $find_file->roles()->get();
            $file['tags'] = $find_file->tags()->get();
            return $file;
        } else {
            array('error' => "Er ging iets fout, probeer later nog eens");
        }
    }

    public function get_all_files_search()
    {
        return Document::with('categories', 'roles', 'tags')->get();
    }

    public function get_files_belongs_to_user()
    {
        $files=[];
        $get_roles = Auth::user()->roles()->get();
        foreach($get_roles as $key=>$value){
               $files[$key]['files']=$value->documents()->get() ;
               $files[$key]['role']=$value;
        }
        return $files;
    }

}
