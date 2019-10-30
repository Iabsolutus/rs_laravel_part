@extends('layouts.app')

@include('menu.default')

@section('content')

    {{-- выводим информацию если было добавление или удаление --}}
    @if (session('del'))
        <div class="center vacationForm">
            Удалено: Инженер - <b>{{ old('FIO') }}</b>.<br>
            Отсутствие: c - {{ old('vacation_with') }}, по - {{ old('vacation_to') }}.
        </div>
    @elseif (session('add'))
        <div class="center vacationForm">
            Добавлено: Инженер - <b>{{ old('FIO') }}</b>.<br>
            Отсутствие: c - {{ old('vacation_with') }}, по - {{ old('vacation_to') }}<br>
            Комментарий: {{ old('comment') }}.
        </div>
    @elseif (session('noName'))
        <div class="center vacationForm">
            <h4>Ошибка!</h4>
            Originator <strong>{{ session('noName') }}</strong> отсутствует в <a href="{{url('Engineers')}}">Таблице инженеров</a><br>
        </div>
    @endif


    <script src="/assets/js/calendar_kdg.js" type="text/javascript"></script>

    <table class="center table table-bordered table-striped" id="vacationTab">
        <colgroup>
            <col width="150px" align="left" valign="middle">
            <col width="80px" align="center" valign="middle">
            <col width="80px" align="center" valign="middle">
            <col width="100px" align="center" valign="middle">
            <col width="30px" align="center" valign="middle">
        </colgroup>
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Начало
            </th>
            <th>
                Окончание
            </th>
            <th>
                Комментарий
            </th>
            <th>
                Удалить
            </th>

        </tr>
        </thead>
        <tbody>


        <tr class="newId nowrap">
            <form action="{{ url('Vacation/Add') }}" method="post" id="formAddNameVacation">
                {{ csrf_field() }}

                <td>
                    <select name="FIO" form="formAddNameVacation">
                        @foreach ($name as $item)
                            <option>{{ $item->Name }}</option>
                        @endforeach
                    </select></td>
                <td>
                    <input type="text" form="formAddNameVacation" name="vacation_with" value="{{ date("Y-m-d") }}"
                           onfocus="this.select();_Calendar.lcs(this)" onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)">
                </td>
                <td>
                    <input type="text" form="formAddNameVacation" name="vacation_to" value="дд.мм.гггг"
                           onfocus="this.select();_Calendar.lcs(this)" onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)">
                </td>
                <td>
                    <input type="text" form="formAddNameVacation" name="comment" placeholder="Отпуск">
                    Проект <input type="radio" name="active" value="1" >
                    Отпуск <input type="radio" name="active" value="0" checked>
                </td>
                <td>
                    <input class="addId" type="submit" form="formAddNameVacation" value="Добавить">
                </td>
            </form>

        </tr>
        <tr>
            <?php $fio = 'no'; ?>
            @foreach ($table as $table)

                    <td class="edit FIO"><b>
                            @if ($table->Name != $fio)
                                {{ $table->Name }}
                            @else
                                ^
                            @endif
                            <?php $fio = $table->Name; ?>
                        </b>
                    </td>
                    <td class="edit vacation_with"> {{ $table->vacation_with }} </td>
                    <td class="edit vacation_to"> {{ $table->vacation_to }} </td>
                    <td class="edit comment">
                        @if(empty($table->comment)) Отпуск @else {{ $table->comment }} @endif
                    </td>
                    <td id="vacation">
                        <form action="{{ url('Vacation') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="FIO" value="{{ $table->Name }}">
                            <input type="hidden" name="vacation_with" value="{{ $table->vacation_with }}">
                            <input type="hidden" name="vacation_to" value="{{ $table->vacation_to }}">
                            <input class="delId" type="submit" value="Удалить">
                        </form>
                    </td>
                </tr>


            @endforeach
        </tbody>
    </table>

    <script>
        var test = '';
        $(document).ready(function(){

            $("#vacationTab tbody tr td").each(function(indx, element){

                if (indx != 0 && element.textContent != '^'){
                    {{--element.innerHTML = element.textContent.trim(); --}}{{-- убераем лишние пробелы --}}
                    element.setAttribute("title", element.textContent.trim()); {{-- создаем васплывающие подсказки --}}
                }
            });

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
                var arr = $(this).parent().children();
                var elemId = $(this).attr('class').split( " " );
                //проверяем какая была нажата клавиша и если была нажата клавиша Enter (код 13)
                if(event.which == 13)
                {
                    //получаем наименование таблицы, в которую будем вносить изменения
                    var table = $('table').attr('id');
                    //выполняем ajax запрос методом POST
                    $.ajax({ type: "GET",
                        //в файл update_cell.php
                        url:"/Vacation/Edit",
                        //создаём строку для отправки запроса
                        //value = введенное значение
                        //id = номер строки
                        //field = название столбца
                        //table = собственно название таблицы
                        data: "value="+$('.ajax input').val()+"&FIO="+arr.eq(0).attr("title").trim()+"&vacation_with="+arr.eq(1).attr("title").trim()+"&vacation_to="+arr.eq(2).attr("title").trim()+"&field="+elemId[1],
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



    <br>
    <br>

    <div class="center vacationFormTexterea">
        <form action="{{ url('Vacation/AddTable') }}" method="post" id="formAddTabVacation">
            {{ csrf_field() }}
            <textarea id="vacationTexterea" name="tableForArr" placeholder="Скопируйте таблицу из письма"></textarea>
            <input class="addId" type="submit" name="Add" value="Добавить">
        </form>
    </div>






@endsection