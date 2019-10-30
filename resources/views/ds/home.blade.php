@extends('layouts.app')

@include('menu.default')

@section('content')



    <div class="homeSityMenu">
        <div class="cityColumn centerWidth" >

            @foreach ($menu['City'] as $item)
                <div>
                    <a href="{{url('sity/'. $item->City)}}">
                        <div>{{ $item->City }}</div>
                        <div>{{ $item->city_count }}</div>
                    </a>
                </div>
            @endforeach

            @foreach ($menu['Project'] as $item)
                <div>
                    <a href="{{url('sity/'. $item->City)}}">
                        <div>{{ $item->City }}</div>
                        <div>{{ $item->city_count }}</div>
                    </a>
                </div>
            @endforeach



            <div><a href="{{url('sity/All')}}"> Все <div></div></a></div>
        </div>
    </div>

    <script> setTimeout(function() { location.reload(true) },120000); </script>

    {{--<script>--}}
        {{--var allCity;--}}
        {{--var countCityInColumn = 0;--}}

        {{--$(document).ready(function() {--}}
            {{--allCity = $(".homeSityMenu .centerWidth > div");--}}

            {{--countCityInColumn = allCity.length / 3;--}}

            {{--var n = 0;--}}
            {{--var z = Math.ceil(countCityInColumn);--}}

            {{--for(var column = 0; column < 3; column++){--}}

                {{--var cityColumn = $('<div class="cityColumn"></div>');--}}

                {{--for(var i = n ; i < z; i++){--}}
                    {{--allCity.eq(i).appendTo(cityColumn);--}}
                {{--};--}}

                {{--n = z;--}}
                {{--z =  Math.ceil(countCityInColumn * (column + 2));--}}

                {{--cityColumn.appendTo(".homeSityMenu .centerWidth");--}}
            {{--};--}}
        {{--});--}}
        {{--$(".homeSityMenu .centerWidth").css("display", "block");--}}

    {{--</script>--}}

@endsection