<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{

    protected $fillable = ['name', 'description', 'address', 'city', 'country', 'start', 'end', 'image', 'active', 'created_at', 'updated_at'];
    
    public function documents()
    {
        return $this->belongsToMany('App\Document');
    }

    
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('is_accepted', 'role_id');
    }
    public function accepted_users()
    {
        return $this->belongsToMany('App\User')->withPivot('is_accepted', 'role_id')->wherePivot('is_accepted', 1);;
    }
    
    public function extra_documents(){
        return $this->hasMany('App\ProjectDocument');
    }
}
