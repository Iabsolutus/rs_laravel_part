@extends('layouts.app')

@include('menu.default')

@section('content')

    <table class="center table table-bordered table-striped table-editing-default" id="engineers">
        <colgroup>
            <col width="150px" align="left" valign="middle">
            <col width="150px" align="left" valign="middle">
            <col width="40px" align="center" valign="middle">
            <col width="90px" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="left" valign="middle">
            <col width="80px" align="left" valign="middle">
        </colgroup>
        <thead>
        <tr>
            <th>
                DS Name
            </th>
            <th>
                Vacation Originator
            </th>
            <th>
                FTE
            </th>
            <th>
                Mobil Phone
            </th>
            <th>
                Аltern. phone number
            </th>
            <th>
                City
            </th>
            <th>
                Coment
            </th>
            <th>
                Allocation
            </th>
            <th>
                Region
            </th>
            <th>
                Hire Date
            </th>
            <th>
                OS
            </th>
            <th>
                Equipment
            </th>
            <th>
                Del/Add
            </th>
        </tr>
        </thead>

        @foreach ($table as $row)
        <tr class="nowrap">
            <td class="edit Name {{ $row->id }}"><b>{{ $row->Name }}</b></td>
            <td class="edit Originator {{ $row->Nom or 'noNom' }}"><b>{{ $row->Originator }}</b></td>
            <td class="edit FTE {{ $row->id }}">{{ $row->FTE }}</td>
            <td class="edit Mobil_Phone {{ $row->id }}">{{ $row->Mobil_Phone }}</td>
            <td class="edit Аltern_phone_number {{ $row->id }}">{{ $row->Аltern_phone_number }}</td>
            <td class="edit City {{ $row->id }}"><a href="{{url('sity/'.$row->City)}}">{{ $row->City }}</a></td>
            <td class="edit Coment {{ $row->id }}">{{ $row->Coment }}</td>
            <td class="edit Allocation {{ $row->id }}">{{ $row->Allocation }}</td>
            <td class="edit Region {{ $row->id }}">{{ $row->Region }}</td>
            <td class="edit Hire_Date {{ $row->id }}">{{ $row->Hire_Date }}</td>
            <td class="edit OS {{ $row->id }}">{{ $row->OS }} </td>
            <td class="edit Equipment {{ $row->id }}">{{ $row->Equipment }}</td>
            <td class="{{ $row->id }}">
                <form action="{{ route('Tables.engineers.destroy', ['id' => $row->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="delId" value="{{ $row->id }}">
                    <input type="hidden" name="delNom" value="{{ $row->Nom }}">
                    <input class="delId" type="submit" name="del" value="Удалить">
                </form>
            </td>
        </tr>
        @endforeach

        <tr class="newId nowrap"><form action="{{ route('Tables.engineers.store') }}" method="post">
                {{ csrf_field() }}
                <td><input type="text" name="Name"  ></td>
                <td><input type="text" name="Originator"  ></td>
                <td><input type="text" name="FTE" ></td>
                <td><input type="text" name="Mobil_Phone" ></td>
                <td><input type="text" name="Аltern_phone_number" ></td>
                <td><input type="text" name="City" ></td>
                <td><input type="text" name="Coment" ></td>
                <td><input type="text" name="Allocation" ></td>
                <td><input type="text" name="Region" ></td>
                <td><input type="text" name="Hire_Date" ></td>
                <td><input type="text" name="OS" ></td>
                <td><input type="text" name="Equipment" ></td>
                <td><input class="addId" type="submit" value="Добавить"></td>

            </form>



        </tr>
    </table>


    <div id="borderOpenActualRSSList" align="center" onmousedown="facechange($('#hidenBlock.monitoring'))">
        <div id="buttonOpenActualRSSList" class="" ><span class="glyphicon glyphicon-plus-sign"></span><span> <b>Страница IncidentShortListNotStartByClientsRep</b></span></div>
        <div id="hidenBlock" class="center monitoring ResoursIframe" style="display: none">
            <iframe src="https://cdev.crm.com/IncidentsClient/Incident/IncidentShortListNotStartByClientsRep" scrolling="auto" width="100%" height="1800px" align="middle">
                Ваш браузер не поддерживает плавающие фреймы!
            </iframe>
        </div>
    </div>

    <div style="height: 50px" ></div>

    <script>
        var test;

        function facechange (objName) {
            if ( $(objName).css('display') == 'none' ) {
                $(objName).animate({height: 'show'}, 400);
                $('.glyphicon-plus-sign').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
            } else {
                $(objName).animate({height: 'hide'}, 200);
                $('.glyphicon-minus-sign').removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');
            }
        };

        $(document).ready(function(){
            $("#engineers tbody tr td").each(function(indx, element){
                element.setAttribute("title", element.textContent);
            })

            //при нажатии на ячейку таблицы с классом edit
            $('td.edit').dblclick(function(){
                $('.ajax').html($('.ajax input').attr("title")); //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                $('.ajax').removeClass('ajax'); //удаляем все классы ajax
                $(this).addClass('ajax'); //Нажатой ячейке присваиваем класс ajax
                $(this).html('<input id="editbox" size="'+ $(this).text().length+'" type="text" value="' + $(this).text() + '" />'); //внутри ячейки создаём input и вставляем текст из ячейки в него
                $('#editbox').focus(); //устанавливаем фокус на созданном элементе
            });

            //определяем нажатие кнопки на клавиатуре
            $('td.edit').keydown(function(event){
                //получаем значение класса и разбиваем на массив
                //в итоге получаем такой массив - arr[0] = edit, arr[1] = наименование столбца, arr[2] = id строки
                arr = $(this).attr('class').split( " " );
                var title = $(this).attr("title").trim();


                var vName, vField;
                if (arr[1] == 'Originator'){
                    vName = $(this).prev().text();
                    vField = 'Name';
                } else if  (arr[1] == 'Name'){
                    vName = $(this).next().text();
                    vField = 'Originator';
                }

                //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
                if(event.which == 13)
                {
                    //получаем наименование таблицы, в которую будем вносить изменения
                    var table = $('table').attr('id');
                    //получаем токин
                    var csrfToken = document.getElementsByTagName("meta")["_token"].getAttribute("content");
                    //выполняем ajax запрос методом POST
                    $.ajax({ type: "POST",
                        //в файл update_cell.php
                        url:"/Tables/engineers/"+arr[2],
                        //создаём строку для отправки запроса
                        //value = введенное значение
                        //id = номер строки
                        //field = название столбца
                        //table = собственно название таблицы
                        data: {value: encodeURIComponent($('.ajax input').val()), id: arr[2], field: arr[1], title: title, vName: vName, vField: vField, _token: csrfToken, _method: "PATCH"},
                        //при удачном выполнении скрипта, производим действия
                        success: function(data){
                            //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                            $('.ajax').html($('.ajax input').val());
                            //удаялем класс ajax
                            $('.ajax').removeClass('ajax');
                            test = data;
                        }});
                }});


            //убирают наш input при нажатии вне поля ввода
            $(document).on('blur', '#editbox', function(){
                $('.ajax').html($('.ajax input').val());
                $('.ajax').removeClass('ajax');
            });

        });


    </script>



@endsection