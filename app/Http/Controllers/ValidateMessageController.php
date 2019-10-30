<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Worker;

class ValidateMessageController extends Controller
{
    public function val_mob_number($mob_number){
        if(strlen($mob_number) == 13 && substr($mob_number, 0, 4) == '+380' && preg_match_all('/[0-9]/',
                substr($mob_number, 4, 9),
                $out, PREG_PATTERN_ORDER) == 9 && !count(\App\Worker::where('mobile_number', '=', $mob_number)->get())){
            return true;
        }
        else{
            return false;
        }
    }
    public function val_first_name($first_name){
        if(strlen($first_name) > 0 && strlen($first_name) == preg_match_all('/[A-Za-z]/',
                $first_name, $out, PREG_PATTERN_ORDER)){
            return true;
        }
        else{
            return false;
        }
    }
    public function val_last_name($last_name){
        if(strlen($last_name) > 0 && strlen($last_name) == preg_match_all('/[A-Za-z]/',
                $last_name, $out, PREG_PATTERN_ORDER)){
            return true;
        }
        else{
            return false;
        }
    }
}
