<?php


namespace App\Repositories;

use DB;
use App\Vacationname;
use App\Vacation;



class VacationRepository
{
    
    public function addToTables($request)
    {
        $theDate = explode("\n", trim($request->tableForArr)); // Обрезаем и создает масив по переносу строки
        $count = count($theDate); // получаем количество значениий в масиве
        $vacationname = Vacationname::all(); // получаем все записи с таблицы Vacationname
        $info = $name = [];

        // первая строчка в масив $name, вторая в $info
        for($i = 0; $i < $count; $i++){

            $info[] = explode("\t", $theDate[$i]);

//            if(($i % 2) == 0){
//                $name[] = trim($theDate[$i]);
//            } else {
//                $info[] = explode("\t", $theDate[$i]);
//            }
        }

        $count = count($info);
        for( $i = 0; $i < $count; $i++){

            $originator = $vacationname->where('Originator', $info[$i][0])->first();

            if(!!$originator)
            {
                $originator = $originator->Name; // получаем правельное имя для таблицы vacations
            } else {
                return redirect('/Vacation/Management')->with('noName', $info[$i][0]); // при отсутствии имени в таблице Ресурсов отправляем ошибку
            };

            Vacation::create([
                'FIO' => $originator,
                'vacation_with' => date('Y-m-d', strtotime($info[$i][2])),
                'vacation_to' => date('Y-m-d', strtotime($info[$i][3])),
            ]);

        }

    }

    
}