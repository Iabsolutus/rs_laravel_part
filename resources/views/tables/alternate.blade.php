@extends('layouts.app')

@include('menu.default')

@section('content')

    <table class="center table table-bordered table-striped" id="Alternate" >
        <colgroup>
            <col width="200px" align="left" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="80px" align="left" valign="middle">

        </colgroup>
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                ВТБ
            </th>
            <th>
                ВТБ_АТМ
            </th>
            <th>
                ВТБ_Печатка
            </th>
            <th>
                IBM
            </th>
            <th>
                DOW
            </th>
            <th>
                USB
            </th>
            <th>
                UkrGaz
            </th>
            <th>
                BAT
            </th>
            <th>
                Kredo
            </th>
            <th>
                PUMB
            </th>
            <th>
                KC
            </th>
            <th>
                INPAS
            </th>
            <th>
                ITO
            </th>
            <th>
                TEST
            </th>
            <th>
                Del/Add
            </th>

            <!--   ID; Name; ВТБ; ВТБ_АТМ; ВТБ_Печатка; PIB_Регион; PIB_ГО; PIB_Печатка; IBM; DOW; USB; BAT; FC_Печатка; Kredo; PUMB; KC; INPAS; ITO; TEST    -->
        </tr>
        </thead>

        @foreach ($table as $row)
            <tr class="nowsrap tdB">
                <td class="edit Name {{ $row->id }}" >{{ $row->Name }}</td>
                <td class="edit ВТБ {{ $row->id }}" >{{ $row->ВТБ }}</td>
                <td class="edit ВТБ_АТМ {{ $row->id }}" >{{ $row->ВТБ_АТМ }}</td>
                <td class="edit ВТБ_Печатка {{ $row->id }}" >{{ $row->ВТБ_Печатка }}</td>
                <td class="edit IBM {{ $row->id }}" >{{ $row->IBM }}</td>
                <td class="edit DOW {{ $row->id }}" >{{ $row->DOW }}</td>
                <td class="edit USB {{ $row->id }}" >{{ $row->USB }}</td>
                <td class="edit UkrGaz {{ $row->id }}" >{{ $row->UkrGaz }}</td>
                <td class="edit BAT {{ $row->id }}" >{{ $row->BAT }}</td>
                <td class="edit Kredo {{ $row->id }}" >{{ $row->Kredo }}</td>
                <td class="edit PUMB {{ $row->id }}" >{{ $row->PUMB }}</td>
                <td class="edit KC {{ $row->id }}" >{{ $row->KC }}</td>
                <td class="edit INPAS {{ $row->id }}" >{{ $row->INPAS }}</td>
                <td class="edit ITO {{ $row->id }}" >{{ $row->ITO }}</td>
                <td class="edit TEST {{ $row->id }}" >{{ $row->TEST }}</td>

                <td class="{{ $row->id }}" >
                    <form action="{{ route('Tables.Alternate.destroy', ['id' => $row->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input class="delId" type="submit"  value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach


        <tr class="newId nowsrap">
            {!! Form::open(['route' => 'Tables.Alternate.store']) !!}
            {!! Form::token() !!}
            <td>{!! Form::text('Name') !!}
            <td>{!! Form::text('ВТБ') !!}
            <td>{!! Form::text('ВТБ_АТМ') !!}
            <td>{!! Form::text('ВТБ_Печатка') !!}
            <td>{!! Form::text('IBM') !!}
            <td>{!! Form::text('DOW') !!}
            <td>{!! Form::text('USB') !!}
            <td>{!! Form::text('UkrGaz') !!}
            <td>{!! Form::text('BAT') !!}
            <td>{!! Form::text('Kredo') !!}
            <td>{!! Form::text('PUMB') !!}
            <td>{!! Form::text('KC') !!}
            <td>{!! Form::text('INPAS') !!}
            <td>{!! Form::text('ITO') !!}
            <td>{!! Form::text('TEST') !!}
            <td>{!! Form::submit('Добавить', ['class' => 'addId']) !!}

            {!! Form::close() !!}

        </tr>
    </table>


    <script>
        $(document).ready(function() {
            for (var i = 0; i < $("td").length; i++) {
                if ($("td").eq(i).text().trim() == '(+)') $("td").eq(i).css("color", "red");
            }

            for (var i = 0; i < $("td").length; i++) {
                if ($("td").eq(i).text().trim() == 'Б') $("td").eq(i).css("color", "blue");
            }

            $("#backup tbody tr td").each(function (indx, element) {
                element.setAttribute("title", element.textContent);
            })
        });
    </script>
    <script src="/assets/js/tables.js" type="text/javascript"></script>



@endsection