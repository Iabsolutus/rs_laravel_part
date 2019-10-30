@section('menu')

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Открыть меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse" id="responsive-menu">
                <ul class="nav navbar-nav">

                    <li id="home"><a href='{{url('/')}}' class="Home">Главная</a>

                        <div class="emergingcity">


                            @foreach ($items['City'] as $item)
                                <div>
                                    <a href="{{url('sity/'.$item->City)}}"><b>{{ $item->City }}</b></a>
                                </div>
                            @endforeach

                            @foreach ($items['Project'] as $item)
                                <div>
                                    <a href="{{url('sity/'.$item->City)}}"><b>{{ $item->City }}</b></a>
                                </div>
                            @endforeach


                            <div><a href="{{url('sity/All')}}"><b> Все </b></a></div>
                        </div>

                    </li>
                    <li id="tableMenu"><a href='' class="tableMenu">Таблицы</a>
                        <div class="emergingcity">

                            <div><a href='{{url('Vacation/Management')}}'><b>Отпуска</b></a></div>
                            <div><a href='{{url('Tables/engineers')}}'><b>Таблица инженеров</b></a></div>
                            <div><a href='{{url('Tables/rf')}}'><b>Резервный фонд</b></a></div>
                            <div><a href='{{url('Tables/vc')}}'><b>Отпуска координаторов</b></a></div>
                            <div><a href='{{url('Tables/Alternate')}}'><b>Бэкапы по проектам</b></a></div>

                        </div>

                    </li>
                    <li><a href='{{url('Ds/update')}}' class="services" title="Обновить ДС"><span class="glyphicon glyphicon-refresh"></span></a></li>

                    <li><a href='{{ url('/logout') }}'>Выход</a>


                </ul>
            </div>
        </div>
    </div>


@endsection

