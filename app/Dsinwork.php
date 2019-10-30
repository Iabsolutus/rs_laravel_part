<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dsinwork extends Model
{
    protected $guarded = ['id'];

    public function scopeCreateAll($dsinwork, $querys)
    {
        foreach ($querys as $query)
        {
            Dsinwork::create($query);
        }
    }
}
