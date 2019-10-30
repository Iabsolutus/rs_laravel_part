
//Определение начальных параметров карты
function init () {
    
    // Получаем город страницы с URL
    var cityURL = decodeURI(window.location.pathname).match( /([a-zа-я,\-\s+]+)/gi );
    if (cityURL !== null){
        var urlSity = cityURL[1];
    } else {
        var urlSity;
    };

    //отправляем город и получаем коорденаты
    $.ajax({
        type: "GET",
        url: "/Map/ThisSity/",
        dataType: 'json',
        data: {'sity':urlSity},
        success: function(data){
            if (data[0] !== undefined){
                var myMap = new ymaps.Map("map", {
                    // Вновим коорденаты
                    center: [data[0].lat, data[0].lon],
                    zoom: 12,
                    // Включим поведения по умолчанию (default)
                    // и добавим масштабирование колесом мыши.
                    behaviors:['default', 'dblClickZoom']
                }, {
                    balloonMaxWidth: 600
                });
                // на 1/2 уровня масштабирования в секунду.
                myMap.options.set('scrollZoomSpeed', 5.5);

                //Добавляем элементы управления
                myMap.controls
                    .add('zoomControl')
                    .add('typeSelector')
                    .add('mapTools')
                    .add('searchControl');

                //Запрос данных и вывод маркеров на карту
                $.getJSON("/Map/Points/",
                    function(json){
                        for (i = 0; i < json.markers.length; i++) {

                            var myPlacemark = new ymaps.Placemark([json.markers[i].lat,json.markers[i].lon], {
                                // Свойства
                                iconContent: json.markers[i].icontext,
                                hintContent: json.markers[i].hinttext,
                                balloonContentBody: json.markers[i].cvz + '<br>' + json.markers[i].balloontext
                                + '<br>' + json.markers[i].name + '<br>' + json.markers[i].servis
                            }, {
                                // Опции
                                preset: json.markers[i].styleplacemark
                            });

                            // Добавляем метку на карту
                            myMap.geoObjects.add(myPlacemark);
                        }

                    });
            }

            }
    });

}
