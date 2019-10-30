<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Log::info('Log HomeController '.'toUrl '. urldecode($_SERVER['HTTP_REFERER']).urldecode($_SERVER['REQUEST_URI']).' ip '.$_SERVER['REMOTE_ADDR']);

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
