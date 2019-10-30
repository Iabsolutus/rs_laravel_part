<?php


namespace App\Repositories;

use DB;
use App\Resourse;
use Carbon\Carbon;
use App\Addres;



class DsRepository
{
    public function countds($location)
    {

        // вывод количества обращений на инженере за блежайшее 3 дня
        $locationSQL = ($location == 'all')? '' : 'AND r.`City` = :location';
        $dsCountds = collect(DB::select("SELECT r.`Name`, ds.`ФИО`, COUNT(  ds.`ФИО` ) AS `countName`,
            (SELECT COUNT(ds.`ФИО`)
              FROM `DSinWorks` ds
              WHERE TO_DAYS(ds.`ЦВЗ`) <= TO_DAYS(NOW())
                  AND r.`Name` = ds.`ФИО`) AS c1,
            (SELECT COUNT(ds1.`ФИО`)
              FROM `DSinWorks` ds1
              WHERE TO_DAYS(ds1.`ЦВЗ`) = TO_DAYS(NOW()) + 1
                  AND r.`Name` = ds1.`ФИО`) AS c2,
            (SELECT COUNT(ds1.`ФИО`)
              FROM `DSinWorks` ds1
              WHERE TO_DAYS(ds1.`ЦВЗ`) = TO_DAYS(NOW()) + 2
                  AND r.`Name` = ds1.`ФИО`) AS c3,
            (SELECT COUNT(ds1.`ФИО`)
              FROM `DSinWorks` ds1
              WHERE TO_DAYS(ds1.`ЦВЗ`) = TO_DAYS(NOW()) + 3
                  AND r.`Name` = ds1.`ФИО`) AS c4,
            (SELECT COUNT(ds1.`ФИО`)
              FROM `DSinWorks` ds1
              WHERE TO_DAYS(ds1.`ЦВЗ`) > TO_DAYS(NOW()) + 3
                  AND r.`Name` = ds1.`ФИО`) AS c5
            FROM `resourses` r
            LEFT JOIN `DSinWorks` AS ds
            ON r.`Name` = ds.`ФИО`
            WHERE r.`Name` NOT IN (SELECT `FIO` FROM `vacations` WHERE `vacation_with` <= '" . date('Y-m-d') . "' AND `vacation_to` >= '" . date('Y-m-d') . "')
            " . $locationSQL . "
            GROUP BY r.`Name`
            ORDER BY r.`Name`", ['location' => $location]));

        //Пересоздаем масив чтобы ключ был именем
        return $dsCountds->keyBy('Name');
    }

    public function vacation()
    {
        //вывод период отсутствия
        return Resourse::select(DB::raw('`resourses`.`Name`, `vacations`.`vacation_with`, `vacations`.`vacation_to`,
        `vacations`.`comment`, `vacations`.`active`'))
            ->leftJoin('vacations', 'resourses.Name', '=', 'vacations.FIO')
            ->where('vacations.vacation_to', '>=', date('Y-m-d'))
            ->groupBy('vacations.FIO', 'vacations.vacation_with', 'vacations.vacation_to')
            ->orderBy('vacations.FIO', 'asc')
            ->orderBy('vacations.vacation_with')
            ->get();
    }

    public function inWork($location)
    {
        //В отпуске
        $nameInVacation = $this->vacation()->reject( function ($vacationOne) {
            return (($vacationOne->vacation_with <= date('Y-m-d'))
                && ($vacationOne->vacation_to >= date('Y-m-d'))) == false;
        });

        //На другом проекте
        $nameInProject = $this->vacation()->reject( function ($vacationOne) {
            return (($vacationOne->vacation_with <= date('Y-m-d'))
                && ($vacationOne->vacation_to >= date('Y-m-d'))
                && ($vacationOne->active == '1')) == false;
        });

        //Ского выходит с отпуска
        $nameIn3daysVacation = $this->vacation()->reject( function ($vacationOne) {
            return (($vacationOne->vacation_with <= date('Y-m-d'))
                && ($vacationOne->vacation_to >= date('Y-m-d'))
                && Carbon::createFromFormat('Y-m-d', $vacationOne->vacation_to)->subDay(3) <= Carbon::now()
            ) == false;
        });

        // выводт таблицу ДС в работе и доступными инженерами
         $location = ($location == 'All')? '%' : $location ;
         $inWorks = Resourse::select(DB::raw('`dsinworks`.`Филиал`, `dsinworks`.`Сервис`, `dsinworks`.`Полный_номер_ДС`,
            `dsinworks`.`ЦВЗ`, `dsinworks`.`Заголовок`, `resourses`.`Name`, `resourses`.`City`, `resourses`.`Coment`'))
            ->leftJoin('dsinworks', 'resourses.Name', '=', 'dsinworks.ФИО')
             ->where('resourses.City', 'like', $location)
             //->whereNotNull('dsinworks.Полный_номер_ДС') // не отображаются инженеры без ДС
            ->orderBy('Name')
            ->orderBy('ЦВЗ')
            ->get();

        $allDS = [
            'dsNoInVacation' => [],
            'dsInProject' => [],
            'dsIn3daysVacation' => [],
            'dsInVacation' => [],
        ];

        foreach($inWorks as $inWork)
        {
            if(!$nameInVacation->contains('Name', $inWork->Name)){
                $allDS['dsNoInVacation'][] = $inWork;
            } elseif($nameInProject->contains('Name', $inWork->Name)){
                $allDS['dsInProject'][] = $inWork;
            } elseif($nameIn3daysVacation->contains('Name', $inWork->Name)){
                $allDS['dsIn3daysVacation'][] = $inWork;
            } elseif($nameInVacation->contains('Name', $inWork->Name)){
                $allDS['dsInVacation'][] = $inWork;
            }
        }

        return $allDS;

    }


    
    
}