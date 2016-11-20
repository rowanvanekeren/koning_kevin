<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
Use App\Category;
Use App\Role;
Use App\Tag;


class Api_file_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin');
//        ['except' => 'get_all_files']
    }

    public function get_all_files(){
        $file =[];

        foreach (Document::all() as $key=>$document){
            $file[$key]['file']=$document;
            $file[$key]['categories']=$document->categories()->get();
            $file[$key]['roles']=$document->roles()->get();
            $file[$key]['tags']=$document->tags()->get();
        }
        return $file;
        return 'succes';
    }
}
