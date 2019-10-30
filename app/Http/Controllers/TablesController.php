<?php

namespace App\Http\Controllers;

use App\Alternate;
use App\Rf;
use App\Vacationname;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Resourse;
use App\Vacationcoordinator;
use DB;


class TablesController extends MainController
{
//
//    public function engineers (Request $request)
//    {
//
//        // запрос в sql для вывода городов и количества обращений
//        $table = Resourse::select(DB::raw('`resourses`.`ID`, `vacationnames`.`id` AS Nom, `resourses`.`Name`, `vacationnames`.`Originator`,
//                    `resourses`.`FTE`, `resourses`.`Mobil_Phone`, `resourses`.`Аltern_phone_number`, `resourses`.`City`,
//                    `resourses`.`Coment`, `resourses`.`Allocation`, `resourses`.`Region`, `resourses`.`Hire_Date`,
//                    `resourses`.`Position`, `resourses`.`OS`, `resourses`.`Equipment`'))
//            ->leftJoin('vacationnames', 'resourses.Name', '=', 'vacationnames.Name')
//            ->orderBy('City', 'Name')
//            ->get();
//
//        return view('tables.engineers', [
//            'table' => $table,
//            'items' => $this->menu,
//        ]);
//
//    }
//
//    public function engineersAdd (Request $request)
//    {
//        Resourse::create([
//            'Name' => $request->Name,
//            'FTE' => $request->FTE,
//            'Mobil_Phone' => $request->Mobil,
//            'Аltern_phone_number' => $request->Аltern,
//            'City' => $request->City,
//            'Coment' => $request->Coment,
//            'Allocation' => $request->Allocation,
//            'Region' => $request->Region,
//            'Hire_Date' => $request->Hire,
//            'OS' => $request->OS,
//            'Equipment' => $request->Equipment,
//        ]);
//
//        Vacationname::create([
//            'Name' => $request->Name,
//            'Originator' => $request->Originator,
//        ]);
//
//        return redirect('Engineers');
//    }
//
//    public function engineersDelete (Request $request)
//    {
//
//        if($request->delId) Resourse::where('id', '=', $request->delId)->delete();
//        if($request->delNom) Vacationname::where('id', '=', $request->delNom)->delete();
//
//        return redirect('Engineers');
//
//    }
//
//    public function engineersEdit (Request $request)
//    {
//
//        if ($request->field == 'Originator') {
//
//            if(empty($request->id)){
//                Vacationname::create([
//                    $request->field => $request->Name,
//                    $request->vField => $request->vName,
//                ]);
//            } else {
//                Vacationname::where($request->field, $request->title)->update([$request->field => $request->value]);
//            }
//
//        } else {
//            Resourse::where('id', $request->id)->update([$request->field => $request->value]);
//        }
//
//        return redirect('Engineers');
//    }
//


//
//
//    public function rf (Request $request)
//    {
//
//        $table = Rf::orderBy('Name')->get(); // запрос в sql для вывода таблицы резервного фонда
//
//        return view('tables.rf', [
//            'table' => $table,
//            'items' => $this->menu,
//        ]);
//
//    }
//
//    public function rfAdd (Request $request)
//    {
//
//        Rf::create([
//            'Name' => $request->Name,
//            'Total' => $request->Total,
//            'Remain' => $request->Remain,
//            'Comment' => $request->Comment,
//        ]);
//
//        return redirect('RF');
//    }
//
//    public function rfDelete (Request $request)
//    {
//
//        Rf::where('id', '=', $request->delId)->delete();
//
//        return redirect('RF');
//    }
//
//    public function rfEdit (Request $request)
//    {
//
//        Rf::where('id', $request->id)->update([$request->field => $request->value]);
//
//        return redirect('RF');
//    }




//    public function vc (Request $request)
//    {
//
//        $table = Vacationcoordinator::orderBy('Name')->get(); // запрос в sql для вывода отпусков коорденаторов
//
//        $items = Resourse::select(DB::raw('City'))->groupBy('City')->get(); // вывод городов для меню
//
//        return view('tables.vc', [
//            'table' => $table,
//            'items' => $items,
//        ]);
//
//    }
//
//    public function vcAdd (Request $request)
//    {
//
//        Vacationcoordinator::create([
//            'Name' => $request->Name,
//            'January' => $request->January,
//            'February' => $request->February,
//            'March' => $request->March,
//            'April' => $request->April,
//            'May' => $request->May,
//            'June' => $request->June,
//            'July' => $request->July,
//            'August' => $request->August,
//            'September' => $request->September,
//            'October' => $request->October,
//            'November' => $request->November,
//            'December' => $request->December,
//        ]);
//
//        return redirect('Tables/vc');
//    }
//
//    public function vcDelete (Request $request)
//    {
//
//        Vacationcoordinator::where('id', $request->delId)->delete();
//
//        return redirect('Tables/vc');
//    }
//
//    public function vcEdit (Request $request)
//    {
//
//        Vacationcoordinator::where('id', $request->id)->update([$request->field => $request->value]);
//
//        return redirect('Tables/vc');
//    }


//    public function alternate (Request $request)
//    {
//
//        $table = Alternate::orderBy('Name')->get(); // запрос в sql для вывода отпусков коорденаторов
//
//        $items = Resourse::select(DB::raw('City'))->groupBy('City')->get(); // вывод городов для меню
//
//        return view('tables.alternate', [
//            'table' => $table,
//            'items' => $items,
//        ]);
//
//    }
//
//    public function alternateAdd (Request $request)
//    {
////        Alternate::create([
////            'Name' => $request->Name,
////            'ВТБ' => $request->ВТБ,
////            'ВТБ_АТМ' => $request->ВТБ_АТМ,
////            'ВТБ_Печатка' => $request->ВТБ_Печатка,
////            'PIB_Регион' => $request->PIB_Регион,
////            'PIB_ГО' => $request->PIB_ГО,
////            'PIB_Печатка' => $request->PIB_Печатка,
////            'IBM' => $request->IBM,
////            'DOW' => $request->DOW,
////            'USB' => $request->USB,
////            'BAT' => $request->BAT,
////            'FC_Печатка' => $request->FC_Печатка,
////            'Kredo' => $request->Kredo,
////            'PUMB' => $request->PUMB,
////            'KC' => $request->KC,
////            'INPAS' => $request->INPAS,
////            'ITO' => $request->ITO,
////            'TEST' => $request->TEST,
////        ]);
//
//        Alternate::create($request->all());
//
//        return redirect('Tables/Alternate');
//    }
//
//    public function alternateDelete (Request $request)
//    {
//
//        Alternate::where('id', $request->delId)->delete();
//
//        return redirect('Tables/Alternate');
//    }
//
//    public function alternateEdit (Request $request)
//    {
//
//        Alternate::where('id', $request->id)->update([$request->field => $request->value]);
//
//        return redirect('Tables/Alternate');
//    }


}
