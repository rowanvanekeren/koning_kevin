<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Role;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','address','city',
        'country','job','job_function',
        'email','gender','is_active','birth_date','birth_place', 'url',
        'password','is_admin','administrative_details_id','readme',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    
    public function current_role($role_id)
    {
        return Role::where('id', $role_id)->first();
    }
    
    public function administrative_details() {
        return $this->hasOne('App\AdministrativeDetail');
    }
    
    public function projects() {
        return $this->belongsToMany('App\Project')->withPivot('is_accepted', 'role_id');
    }
    public function accepted_projects() {
        return $this->belongsToMany('App\Project')->withPivot('is_accepted', 'role_id')->wherePivot('is_accepted', 1);;
    }
    
}











