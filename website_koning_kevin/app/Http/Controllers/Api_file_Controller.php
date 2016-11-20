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

    public function get_all_files()
    {
        $file = [];
        $get_all_categories = Category::all();
        foreach ($get_all_categories as $key => $category) {
            $files = $category->documents()->get();
            if (count($files)) {
                $file[$key]['category'] = $category;
                $file[$key]['files']['all'] = $files;
                foreach ($files as $index => $value) {
                    $file[$key]['files']['roles'] = $value->roles()->get();
                    $file[$key]['files']['tags'] = $value->tags()->get();
                }
            }
        }
        return $file;
    }
    
}