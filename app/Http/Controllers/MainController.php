<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use App\Resourse;
use App\Repositories\DsRepository;
use App\Repositories\MapRepository;
use App\Repositories\VacationRepository;


class MainController extends Controller
{
    protected $menu = [];
    protected $ds;
    protected $map;
    protected $vacations;

    /**
     * @param DsRepository $ds
     * @param MapRepository $map
     * @param VacationRepository $vacations
     */
    public function __construct(DsRepository $ds, MapRepository $map, VacationRepository $vacations)
    {
        //Записываем лог. Можно посмотресь http://localhost/logs
        Log::info('ControllerLog: '.
            (!isset($_SERVER['HTTP_REFERER'])?:'toUrl '.urldecode($_SERVER['HTTP_REFERER'])).
            (!isset($_SERVER['REQUEST_URI'])?:'; '.urldecode($_SERVER['REQUEST_URI'])).
                (!isset($_SERVER['REQUEST_METHOD'])?:'; '.urldecode($_SERVER['REQUEST_METHOD'])).
                    (!isset($_SERVER['SERVER_NAME'])?:'; '.urldecode($_SERVER['SERVER_NAME'])).
                        (!isset($_SERVER['REMOTE_ADDR'])?:'; ip '.$_SERVER['REMOTE_ADDR']));


        $this->ds = $ds;
        $this->map = $map;
        $this->vacations = $vacations;

        // вывод городов для меню
        $project = Resourse::groupBy('City')->having('Allocation', '=', 'Project')->get();
        $city = Resourse::groupBy('City')->having('Allocation', '<>', 'Project')->get();

        $this->menu['Project'] = $project;
        $this->menu['City'] = $city;


    }
}
