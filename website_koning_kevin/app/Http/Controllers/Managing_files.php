<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Managing_files extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    public function add_file(){
        return view('managing_files/add_file');
    }
}
