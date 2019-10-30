<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resourse extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'id'];
    
    public function dsinwork()
    {
        return $this->hasOne('App\Dsinwork', 'ФИО', 'Name');
    }
}
