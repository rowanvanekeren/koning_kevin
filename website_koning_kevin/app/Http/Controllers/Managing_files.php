<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Managing_files extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_active');
        $this->middleware('is_admin',['except'=>'show_file']);
    }
    public  function show_file(){
        return view('managing_files/show_file');
    }
    public function add_file(){
        return view('managing_files/add_file');
    }
}
