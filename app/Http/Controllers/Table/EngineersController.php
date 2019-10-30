<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vacationname;
use App\Resourse;
use DB;

class EngineersController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Resourse::select(DB::raw('`resourses`.`ID` AS id, `vacationnames`.`id` AS Nom, `resourses`.`Name`, `vacationnames`.`Originator`,
                    `resourses`.`FTE`, `resourses`.`Mobil_Phone`, `resourses`.`Аltern_phone_number`, `resourses`.`City`,
                    `resourses`.`Coment`, `resourses`.`Allocation`, `resourses`.`Region`, `resourses`.`Hire_Date`,
                    `resourses`.`Position`, `resourses`.`OS`, `resourses`.`Equipment`'))
            ->leftJoin('vacationnames', 'resourses.Name', '=', 'vacationnames.Name')
            ->orderBy('City', 'Name')
            ->get();

        return view('tables.engineers', [
            'table' => $table,
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
        Resourse::create([
            'Name' => $request->Name,
            'FTE' => $request->FTE,
            'Mobil_Phone' => $request->Mobil_Phone,
            'Аltern_phone_number' => $request->Аltern_phone_number,
            'City' => $request->City,
            'Coment' => $request->Coment,
            'Allocation' => $request->Allocation,
            'Region' => $request->Region,
            'Hire_Date' => $request->Hire_Date,
            'OS' => $request->OS,
            'Equipment' => $request->Equipment,
        ]);

        Vacationname::create([
            'Name' => $request->Name,
            'Originator' => $request->Originator,
        ]);


        return redirect('Tables/engineers');
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

        if ($request->field == 'Originator') { // Если редактируем поле Originator
            if($id == 'noNom'){ // Если в базе нет ID
                // Создаем нового инженера
                Vacationname::create([
                    $request->field => $request->value,
                    $request->vField => $request->vName,
                ]);
            } else { //Если есть ID
                // Изминяем значение
                Vacationname::where($request->vField, $request->vName)->update([$request->field => urldecode($request->value)]);
            }
        } else { //Если редактируем ячейку ресурсов
            // Изминяем значение
            Resourse::where('id', $request->id)->update([$request->field => urldecode($request->value)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->delId) Resourse::destroy($request->delId);
        if($request->delNom) Vacationname::destroy($request->delNom);

        return redirect('Tables/engineers');
    }
}
