<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdministrativeDetail extends Model
{
    //
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['bank_account_number', 'national_insurance_number', 'identity_number', 'user_id', 'created_at', 'updated_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
