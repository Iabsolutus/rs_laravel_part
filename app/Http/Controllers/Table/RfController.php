<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Rf;
use DB;

class RfController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables.rf', [
            'table' => Rf::orderBy('Name')->get(),
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
        Rf::create($request->all());

        return redirect('Tables/rf');
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
        return Rf::where('id', $id)->update([$request->field => urldecode($request->value)]);

        //return redirect('Tables/rf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rf::destroy($id);

        return redirect('Tables/rf');
    }
}
