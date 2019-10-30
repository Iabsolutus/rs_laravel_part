@extends('layouts.app')

@include('menu.default')

@section('content')

    <table class="center table table-bordered table-striped" id="vc" >
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
            <col width="80px" align="left" valign="middle">
        </colgroup>
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                January
            </th>
            <th>
                February
            </th>
            <th>
                March
            </th>
            <th>
                April
            </th>
            <th>
                May
            </th>
            <th>
                June
            </th>
            <th>
                July
            </th>
            <th>
                August
            </th>
            <th>
                September
            </th>
            <th>
                October
            </th>
            <th>
                November
            </th>
            <th>
                December
            </th>
            <th>
                Del/Add
            </th>

        </tr>
        </thead>

        @foreach ($table as $row)
            <tr class="newrap tdB">
                <td class="edit Name {{ $row->id }}">{{ $row->Name }}</td>
                <td class="edit January {{ $row->id }}">{{ $row->January }}</td>
                <td class="edit February {{ $row->id }}">{{ $row->February }}</td>
                <td class="edit March {{ $row->id }}">{{ $row->March }}</td>
                <td class="edit April {{ $row->id }}">{{ $row->April }}</td>
                <td class="edit May {{ $row->id }}">{{ $row->May }}</td>
                <td class="edit June {{ $row->id }}">{{ $row->June }}</td>
                <td class="edit July {{ $row->id }}">{{ $row->July }}</td>
                <td class="edit August {{ $row->id }}">{{ $row->August }}</td>
                <td class="edit September {{ $row->id }}">{{ $row->September }}</td>
                <td class="edit October {{ $row->id }}">{{ $row->October }}</td>
                <td class="edit November {{ $row->id }}">{{ $row->November }}</td>
                <td class="edit December {{ $row->id }}">{{ $row->December }}</td>

                <td class="{{ $row->id }}">
                    <form action="{{ route('Tables.vc.destroy', ['id' => $row->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input class="delId" type="submit" value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach

        <tr class="newId newrap"><form action="{{ route('Tables.vc.store') }}" method="post">
                {{ csrf_field() }}
                <td><input type="text" name="Name"  ></td>
                <td><input type="text" name="January"  ></td>
                <td><input type="text" name="February"  ></td>
                <td><input type="text" name="March"  ></td>
                <td><input type="text" name="April"  ></td>
                <td><input type="text" name="May"  ></td>
                <td><input type="text" name="June"  ></td>
                <td><input type="text" name="July"  ></td>
                <td><input type="text" name="August"  ></td>
                <td><input type="text" name="September"  ></td>
                <td><input type="text" name="October"  ></td>
                <td><input type="text" name="November"  ></td>
                <td><input type="text" name="December"  ></td>

                <td><input class="addId" type="submit" value="Добавить"></td>

            </form>

        </tr>
    </table>


    <script src="/assets/js/tables.js" type="text/javascript"></script>


@endsection