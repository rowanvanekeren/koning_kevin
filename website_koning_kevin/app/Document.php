<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{



    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
