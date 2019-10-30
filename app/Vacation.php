<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vacation extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'id'];


    public function scopeFinder($query, $request)
    {
        $query->where([
            ['FIO', '=', $request->FIO],
            ['vacation_with', '=', $request->vacation_with],
            ['vacation_to', '=', $request->vacation_to],
        ]);
    }
}
