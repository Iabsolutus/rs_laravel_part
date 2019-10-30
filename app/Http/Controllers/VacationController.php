<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Resourse;
use App\Vacation;
use DB;


class VacationController extends MainController
{

    public function management (Request $request)
    {
        return view('vacation.management', [
            'table' => $this->ds->vacation(),
            'items' => $this->menu,
            'name' => Resourse::select(DB::raw('Name'))->orderBy('Name')->get(),
        ]);
    }

    public function add (Request $request)
    {
        Vacation::create($request->all());
        
        return redirect('/Vacation/Management')->withInput()->with('add', 1);
    }

    public function edit (Request $request)
    {
        Vacation::finder($request)->update([$request->field => $request->value]);

        return redirect('/Vacation/Management')->withInput();
    }

    public function delete (Request $request)
    {
        Vacation::finder($request)->delete();

        return redirect('/Vacation/Management')->withInput()->with('del', 1);
    }

    public function addTable (Request $request)
    {
        $this->vacations->addToTables($request);

        return redirect('/Vacation/Management');

    }
}
