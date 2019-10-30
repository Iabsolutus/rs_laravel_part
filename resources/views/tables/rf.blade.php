@extends('layouts.app')

@include('menu.default')

@section('content')

    <table class="center table table-bordered table-striped" id="rf" style="max-width: 850px;" >
        <colgroup>
            <col width="200px" align="left" valign="middle">
            <col width="80px" align="left" valign="middle">
            <col width="80px" align="center" valign="middle">
            <col width="100%" align="center" valign="middle">
            <col width="80px" align="left" valign="middle">
        </colgroup>
        <thead>
        <tr>
            <th>
                ФИО
            </th>
            <th>
                Всего
            </th>
            <th>
                Осталось
            </th>
            <th>
                Комментарий
            </th>
            <th>
                Del/Add
            </th>

        </tr>
        </thead>

        @foreach ($table as $row)
        <tr class="newrap">
            <td class="edit Name {{ $row->id }}"><b>{{ $row->Name }}</b></td>
            <td class="edit Total {{ $row->id }}"><b>{{ $row->Total }}</b></td>
            <td class="edit Remain {{ $row->id }}">{{ $row->Remain }}</td>
            <td class="edit Comment {{ $row->id }}">{{ $row->Comment }}</td>
            <td class="{{ $row->id }}">
                <form action="{{ route('Tables.rf.destroy', ['id' => $row->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input class="delId" type="submit" value="Удалить">
                </form>
            </td>
        </tr>
        @endforeach

        <tr class="newId newrap"><form action="{{ route('Tables.rf.store') }}" method="post">
                {{ csrf_field() }}
                <td><input type="text" name="Name"  ></td>
                <td><input type="text" name="Total"  ></td>
                <td><input type="text" name="Remain" ></td>
                <td><input type="text" name="Comment" ></td>
                <td><input class="addId" type="submit" value="Добавить"></td>

            </form>

        </tr>
    </table>


    <script src="/assets/js/tables.js" type="text/javascript"></script>

@endsection