{{-- обнуляем щетчики --}}
<?php $nomerds = $fio = $cvz = '0' ?>

@foreach ($allDS as $ds)

<tr class="nowrap">

{{-- столбик 1 ФИО --}}
<td bgcolor="{{ $color }}">{{-- виводить имя только первий раз --}}
    @if ($ds->Name != $fio)
        <?php $fio = $ds->Name ?>
        <b>{{ $ds->Name }}</b>{{-- вывод Имя (количество ДС) --}}
@if(isset($dsCountds[$ds->Name])){{-- проверяем есть ли инженер в первой таблице --}}
 ({{ $dsCountds[$ds->Name]->countName }})<font color="#0000ff"> {{ $ds->Coment }} </font></b>{{-- вывод возможности привлечения к инкасации --}}
@endif
@foreach ($vacations->where('Name', $ds->Name) as $vacation){{-- вывод отпуска если есть --}}
<br><b>{{ $vacation->comment ? $vacation->comment : 'Отпуск' }} c: {{ $vacation->vacation_with }} по: {{ $vacation->vacation_to }}</b>
@endforeach
        <?php $cvz = '0' ?>
    @endif
</td>

{{-- вывод инженеров без ДС --}}
@if (empty($ds->ЦВЗ))

{{-- столбик 2 ЦВЗ --}}
        <td>НЕТ ДС</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    @else

        {{-- Закрашывает красным просроченые ЦВЗ --}}
        @if (date("YmdHi", strtotime($ds->ЦВЗ)) < date("YmdHi"))
            <td bgcolor="#ff0000"> {{ date("d.m.Y H:i", strtotime($ds->ЦВЗ)) }} </td><td>
        @else

            {{-- проверка на совпадение ЦВЗ с ячейкой выше --}}
            @if (date("d.m.Y H:i", strtotime($ds->ЦВЗ)) != $cvz)
                <?php $cvz = date("d.m.Y H:i", strtotime($ds->ЦВЗ)) ?>
                <td> {{ date("d.m.Y H:i", strtotime($ds->ЦВЗ)) }} </td><td>
            @else
                <td>^</td><td>
            @endif
        @endif
        {{ $ds->Полный_номер_ДС }}</td><td>{{-- столбик 3 № ДС --}}
        {{ $ds->Филиал }}</td><td> {{-- столбик 4 Филиал --}}
        {{ $ds->Сервис }}</td><td class=\"title\"> {{-- столбик 5 Сервис --}}
        {{ $ds->Заголовок }}</td></tr> {{-- столбик 6 Заголовок --}}
    @endif
@endforeach