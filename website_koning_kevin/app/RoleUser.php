<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = "role_user";
    
    protected $fillable = ['role_id', 'user_id', 'created_at', 'updated_at'];
    
    public function documents()
    {
        return $this->belongsToMany('App\Role');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
