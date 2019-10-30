@extends('layouts.app')

@include('menu.default')

@section('content')

    {{-- Таблица 1 --}}
    <table class="center table table-bordered table-striped" id="DsCounts">
        <thead>
        <tr>
            <th>
                ФИО
            </th>
            <th>
                ДС на {{$today->format('d.m.Y')}}
            </th>
            <th>
                {{$today->addDay(1)->format('d.m.Y')}}
            </th>
            <th>
                {{$today->addDay(1)->format('d.m.Y')}}
            </th>
            <th>
                {{$today->addDay(1)->format('d.m.Y')}}
            </th>
            <th>
                {{$today->addDay(1)->format('d.m.Y')}}...
            </th>
        </tr>
        </thead>

        @foreach ($dsCountds as $dsCountd)
            <tr>
                <td>
                    <b>{{ $dsCountd->Name }}</b> ({{ $dsCountd->countName }})
                </td>
                <td>
                    {{ $dsCountd->c1 }}
                </td>
                <td>
                    {{ $dsCountd->c2 }}
                </td>
                <td>
                    {{ $dsCountd->c3 }}
                </td>
                <td>
                    {{ $dsCountd->c4 }}
                </td>
                <td>
                    {{ $dsCountd->c5 }}
                </td>
            </tr>
        @endforeach

    </table>

    <br>
    <br>


    {{-- Таблица 2 --}}

    <table class="center table table-bordered table-striped" id="DS">
        <colgroup>
            <col width="240px" align="left" valign="middle">
            <col width="115px" align="center" valign="middle">
            <col width="190px" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
        </colgroup>
        <thead>
        <tr>
            <th>
                ФИО
            </th>
            <th>
                ЦВЗ
            </th>
            <th>
                № ДС
            </th>
            <th>
                Филиал
            </th>
            <th>
                Сервис
            </th>
            <th>
                Заголовок
            </th>
        </tr>
        </thead>


            {{-- ----------------- БЕЛЫЙ -------------------------- --}}
            {{-- выводим ДС только если не в отпуске --}}
        @include('ds.sityColor', ['color' => '', 'allDS' => $allDS['dsNoInVacation']])

        {{-- ----------------- ЖЕЛТЫЙ -------------------------- --}}
        {{-- выводим ДС только если заняты на другом проекте --}}
        @include('ds.sityColor', ['color' => '#FFFF00', 'allDS' => $allDS['dsInProject']])

        {{-- ----------------- ЗЕЛЁНЫЙ -------------------------- --}}
        {{-- выводим ДС только если будут доступны в тичении трех дней --}}
        @include('ds.sityColor', ['color' => '#00FF00', 'allDS' => $allDS['dsIn3daysVacation']])

        {{-- ----------------- КРАСНЫЙ -------------------------- --}}
        {{-- выводим ДС только если находятся в отпуске --}}
        @include('ds.sityColor', ['color' => '#ff0000', 'allDS' => $allDS['dsInVacation']])

    </table>


    {{-- переформатыруем таблицу 2 --}}
    <script>
        // Получаем город страницы с URL
        var urlSity = "{{ $location }}";
        document.title = urlSity;


        var elementUp;
        var n = 2;
        $(document).ready(function(){
            $("#DS tbody tr td").each(function(indx, element){
                element.innerHTML = element.innerHTML.trim(); {{-- убераем лишние пробелы --}}
                element.setAttribute("title", element.textContent); {{-- создаем васплывающие подсказки --}}
            })

            $("#DS tbody tr td:first-child").each(function(indx, element){

                if (element.textContent == "") {
                    elementUp.rowSpan = n;
                    element.parentNode.removeChild(element);
                    n += 1;
                } else {
                    element.parentNode.style.borderTop="3px ridge black";
                    element.style.borderLeft="1px ridge black";
                    element.style.borderRight="1px ridge black";

                    elementUp = element;
                    n = 2;
                }
            })
        });
    </script>

    {{-- выпадающая КАРТА --}}
    <div id="borderOpenActualRSSList" align="center" onmousedown="facechange($('#hidenBlock.hidenMap'))">
        <div id="buttonOpenActualRSSList" class="" ><span class="glyphicon glyphicon-plus-sign"></span><span> <b>Карта</b></span></div>
    </div>
    <div id="hidenBlock" class="center hidenMap ResoursIframe" style="display: none">
        <div id="map" ></div>
    </div>
    <br>
    <br>


    {{-- скрипт для выпадающей карты --}}
    {{--<script>--}}
        {{--function facechange (objName) {--}}
            {{--if ( $(objName).css('display') == 'none' ) {--}}
                {{-- Добавляем JS api-maps.yandex на страницу --}}
                {{--var jsYMap = document.createElement('script');--}}
                {{--jsYMap.src = "http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU";--}}

                {{--jsYMap.type = "text/javascript";--}}
                {{--jsYMap.onload = init();--}}
                {{--$("head").append(jsYMap);--}}
                {{-- запускаем карту с файла map.js --}}
                {{-- init(); --}}
                {{-- роскрываем карту --}}
                {{--$(objName).animate({height: 'show'}, 400);--}}
                {{--$('.glyphicon-plus-sign').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');--}}


            {{--} else {--}}
                {{-- сварачиваем карту --}}
                {{--$(objName).animate({height: 'hide'}, 200);--}}
                {{--$('.glyphicon-minus-sign').removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');--}}
            {{--}--}}
        {{--};--}}
    {{--</script>--}}


@endsection