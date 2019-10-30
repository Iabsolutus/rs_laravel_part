@extends('Message.layouts.body')

@section('navigation')
    @include('Message.layouts.navigation')
@endsection

@section('content')
    <table class="table_workers">
        <tr>
            <form class="form_add" method="POST" action="/Message/add">
                {{ csrf_field() }}
                <td class="first_name"><input onkeyup="val_form()" onchange="val_form()" id="first_name" class="input_first_name" type="text" name="first_name" placeholder="First name"></td>
                <td class="last_name"><input onkeyup="val_form()" onchange="val_form()" id="last_name" class="input_last_name" type="text" name="last_name" placeholder="Last name"></td>
                <td class="mobile_number"><input onkeyup="val_form()" onchange="val_form()" id="mobile_number" class="input_mobile_number" type="text" name="mobile_number" placeholder="Mobile number"></td>
                <td class="button"><button id="add" class="add" type="submit" disabled="disabled"></button></td>
            </form>
        </tr>
        <?php if (count($workers)) {
        foreach ($workers as $worker) { ?>
        <tr>
            <td class="first_name">{{ $worker->first_name }}</td>
            <td class="last_name">{{ $worker->last_name }}</td>
            <td class="mobile_number">{{ $worker->mobile_number }}</td>
            <form action="/Message/delete" method="POST">
                {{ csrf_field() }}
                <td class="button">
                    <button class="delete" name="delete" value="{{ $worker->id }}" type="submit"></button>
                </td>
            </form>

        </tr>
        <?php } } ?>
    </table>
    <script language="JavaScript">
        function val_first_name() {
            var first_name= document.getElementById('first_name');
            var first_name_array = first_name.value.match(/[a-zA-Z]/g);
            if(first_name.value.match(/[a-zA-Z]/g) && first_name.value.length >= 0 && first_name.value.length <= 15 && first_name_array.length == first_name.value.length) {
                return true;
            }
            else{
                return false;
            }
        }
        function val_last_name() {
            var last_name= document.getElementById('last_name');
            var last_name_array = last_name.value.match(/[a-zA-Z]/g);
            if(last_name.value.match(/[a-zA-Z]/g) && last_name.value.length >= 0 && last_name.value.length <= 15 && last_name_array.length == last_name.value.length) {
                return true;
            }
            else{
                return false;
            }
        }
        function val_mobile_number() {
            var mobile_number = document.getElementById('mobile_number');
            var mobile_number_array = mobile_number.value.match(/[0-9]/g);
            if(mobile_number.value.length == 13 && mobile_number_array && mobile_number_array.length == 12 && mobile_number.value.indexOf('+380') == 0) {
                return true;
            }
            else{
                return false;
            }
        }
        function val_form() {
            if(val_mobile_number() && val_first_name() && val_last_name()){
                var arr = [mobile_number.style.color = 'black', first_name.style.color = 'black', last_name.style.color = 'black', add.disabled = false];
                return arr;
            }
            else if(val_first_name() && val_last_name() && val_mobile_number() == false){
                var arr = [mobile_number.style.color = 'red', first_name.style.color = 'black', last_name.style.color = 'black', add.disabled = true];
                return arr;
            }
            else if(val_first_name() && val_last_name() == false && val_mobile_number()){
                var arr = [mobile_number.style.color = 'black', first_name.style.color = 'black', last_name.style.color = 'red', add.disabled = true];
                return arr;
            }
            else if(val_first_name() == false && val_last_name() && val_mobile_number()){
                var arr = [mobile_number.style.color = 'black', first_name.style.color = 'red', last_name.style.color = 'black', add.disabled = true];
                return arr;
            }
            else if(val_first_name() && val_last_name() == false && val_mobile_number() == false){
                var arr = [mobile_number.style.color = 'red', first_name.style.color = 'black', last_name.style.color = 'red', add.disabled = true];
                return arr;
            }
            else if(val_first_name() == false && val_last_name() == false && val_mobile_number()){
                var arr = [mobile_number.style.color = 'black', first_name.style.color = 'red', last_name.style.color = 'red', add.disabled = true];
                return arr;
            }
            else if(val_first_name() == false && val_last_name() && val_mobile_number() == false){
                var arr = [mobile_number.style.color = 'red', first_name.style.color = 'red', last_name.style.color = 'black', add.disabled = true];
                return arr;
            }
            else{
                var arr = [mobile_number.style.color = 'red', first_name.style.color = 'red', last_name.style.color = 'red', add.disabled = true];
                return arr;
            }

        }
    </script>
@endsection