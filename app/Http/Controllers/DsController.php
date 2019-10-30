<?php

namespace App\Http\Controllers;


use App\Resourse;
use App\Dsinwork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Repositories\OdbcRepository;

/**
 * Контроллер мониторинга запросов в службу поддержки
 * Class DsController
 * @package App\Http\Controllers
 */
class DsController extends MainController
{

    /**
     * Центральная страница отображения сортируемой таблицы обращений
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {

        $menu = [];

        // запрос в sql для вывода городов и количества обращений
        $menu['City'] = Resourse::leftJoin('dsinworks', 'dsinworks.ФИО', '=', 'resourses.Name')
            ->select(DB::raw('count(Город) as city_count, City, resourses.Allocation'))
            ->groupBy('City')
            ->where('resourses.Allocation', '<>', 'Project')
            ->get();
        // запрос в sql для вывода запросов по проектах
        $menu['Project'] = Resourse::leftJoin('dsinworks', 'dsinworks.ФИО', '=', 'resourses.Name')
            ->select(DB::raw('count(Город) as city_count, City, resourses.Allocation'))
            ->groupBy('City')
            ->where('resourses.Allocation', 'Project')
            ->get();


        return view('ds.home', [
            'items' => $this->menu, //парамет для построения динамического меню
            'menu' => $menu,
        ]);
    }

    /**
     * страница отобращающая количество запросов по городам
     * @param $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sity($location)
    {
        return view('ds.sity', [
            'today' => Carbon::now(), // количество обращений за сегодня
            'dsCountds' => $this->ds->countds($location), // количество обращений
            'vacations' => $this->ds->vacation(), // отпуска исполнителей
            'allDS' => $this->ds->inWork($location), // обращения по всем типам
            'items' => $this->menu, // парамет для построения динамического меню
            'location' => $location, // города
        ]);

    }

    /**
     * Построение визуального отображения запросов на карте
     * @param Request $request
     * @param $action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function map(Request $request, $action)
    {
        $points = false;

        if($action == 'ThisSity'){
            // событие в городе
            $points = $this->map->thisSity(urldecode($request->input('sity')));

        } elseif ($action == 'Points') {
            // событие по коорденатам
            $points = $this->map->points();
        }

        return view('map.points', ['points' => $points]);

    }

    /**
     * Зпрос информации с внешних БД
     * @return \Illuminate\Http\RedirectResponse
     */
    static public function update()
    {

        //получить информацию
        $result = OdbcRepository::getDS();

        //удаление всей информации с локальной таблицы и запись таблицы ДС с CRM в локальную таблицу
        Dsinwork::truncate()->createAll($result);

        return redirect()->back();
    }


}

