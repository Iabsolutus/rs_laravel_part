var test;

$(document).ready(function(){

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
                url:"/Tables/"+table+"/"+arr[2],
                //создаём строку для отправки запроса
                //value = введенное значение
                //id = номер строки
                //field = название столбца
                //table = собственно название таблицы
                data: {value: encodeURIComponent($('.ajax input').val()), field: arr[1], _token: csrfToken, _method: "PATCH"},
                //при удачном выполнении скрипта, производим действия
                success: function(data){
                    test = data;
                    //находим input внутри элемента с классом ajax и вставляем вместо input его значение
                    $('.ajax').html($('.ajax input').val());
                    //удаялем класс ajax
                    $('.ajax').removeClass('ajax');
                }});
        }});


    //убирают наш input при нажатии вне поля ввода
    $(document).on('blur', '#editbox', function(){
        $('.ajax').html($('.ajax input').val());
        $('.ajax').removeClass('ajax');
    });

});