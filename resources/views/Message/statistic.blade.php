@extends('Message.layouts.body')

@section('navigation')
    @include('Message.layouts.navigation')
@endsection

@section('content')

    <table class="table_statistic">
        <tr>
            <td class="header_t mobile_number">Mobile number</td>
            <td class="header_t status">Status</td>
            <td class="header_t created_at">Date</td>
            <td class="header_t text_sms">Text</td>
        </tr>
        <?php if (count($statistic)) {
        foreach ($statistic as $s) { ?>
        <tr>
            <td class="mobile_number">{{ $s->mobile_number }}</td>
            <td class="status">{{ $s->status }}</td>
            <td class="created_at">{{ $s->created_at }}</td>
            <td class="text_sms">{{ $s->text }}</td>
        </tr>
        <?php } ?>
    </table>
    <?php }
        echo $statistic->render();
    ?>
@endsection