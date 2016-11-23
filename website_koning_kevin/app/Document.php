<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{

    use SoftDeletes;

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

    protected $dates = ['deleted_at'];
}
