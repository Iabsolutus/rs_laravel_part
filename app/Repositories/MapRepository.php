<?php


namespace App\Repositories;

use DB;
use App\Resourse;
use Carbon\Carbon;
use App\Addres;



class MapRepository
{
    
    public function thisSity($sity)
    {
        $sity = urldecode($sity) == 'All' ? 'Киев' : $sity;
        
        return Addres::select(DB::raw('lat, lon'))
            ->where([
                ['name', $sity],
                ['address', $sity]
            ])
            ->get(); // получаем информацию c sql c коорденатами города
    }
    
    protected function ds()
    {
        return DB::select("SELECT `d`.`ID`, `d`.`ФИО`, `d`.`Город`, `d`.`Филиал`, `d`.`Сервис`,
              `d`.`Полный_номер_ДС`, `d`.`ЦВЗ`, `d`.`Заголовок`, `r`.`Name`, `r`.`City`,
              (SELECT `address`.`lat` FROM `address` WHERE `address`.`name` = `d`.`Филиал`) AS `lat`,
              (SELECT `address`.`lon` FROM `address` WHERE `address`.`name` = `d`.`Филиал`) AS `lon`,
              (SELECT `address`.`styleplacemark` FROM `address` WHERE `address`.`name` = `d`.`Филиал`) AS `styleplacemark`
              FROM `resourses` AS r
              LEFT OUTER JOIN `dsinworks` AS d
              ON `r`.`Name` = `d`.`ФИО`
              WHERE `r`.`Name`
              NOT IN (SELECT `FIO`
              FROM `vacations`
              WHERE `vacation_with` <='" . date('Y-m-d') . "' AND `vacation_to` >='" . date('Y-m-d') . "') AND `d`.`ФИО` IS NOT NULL
              order by `r`.`Name`, `d`.`ЦВЗ`");
        
    }
    
    protected function home()
    {
        return DB::select("SELECT `rs`.`ФИО`, `rs`.`Филиал`, `rs`.`lat`, `rs`.`lon`, `rs`.`styleplacemark`, `r`.`Name`
              FROM `resourses` AS r
              JOIN `vacationnames` AS v
              ON `r`.`Name` = `v`.`Name`
              JOIN `rss_adress` AS rs
              ON `v`.`Originator` = `rs`.`ФИО`
              WHERE `r`.`Name`
              NOT IN (SELECT `FIO`
              FROM `vacations`
              WHERE `vacation_with` <='" . date('Y-m-d') . "' AND `vacation_to` >='" . date('Y-m-d') . "') AND `rs`.`ФИО` IS NOT NULL
              order by `rs`.`ФИО`");
        
    }
    
    public function points()
    {
        $markers = [];
        foreach ($this->home() as $mar) {
            $markers[] = ['name' => ' ', 'hinttext' => $mar->Филиал, 'balloontext' => $mar->ФИО, 'styleplacemark' => $mar->styleplacemark,
                'icontext' => $mar->ФИО, 'lat' => $mar->lat, 'lon' => $mar->lon, 'cvz' => ' ', 'servis' => ' '];
        }
        foreach ($this->ds() as $mar) {
            $markers[] = ['name' => $mar->Заголовок, 'hinttext' => $mar->Филиал, 'balloontext' => $mar->Полный_номер_ДС, 'styleplacemark' => $mar->styleplacemark,
                'icontext' => $mar->ФИО, 'lat' => $mar->lat, 'lon' => $mar->lon, 'cvz' => $mar->ЦВЗ, 'servis' => $mar->Сервис];
        }
        return $points = ['markers' => $markers];
        
    }


    
}