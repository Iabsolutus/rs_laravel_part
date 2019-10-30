<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vacationcoordinator;
use DB;

class VcController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.vc', [
            'table' => Vacationcoordinator::orderBy('Name')->get(),
            'items' => $this->menu,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vacationcoordinator::create($request->all());

        return redirect('Tables/vc');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        return Vacationcoordinator::where('id', $id)->update([$request->field => urldecode($request->value)]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vacationcoordinator::destroy($id);

        return redirect('Tables/vc');
    }
}
