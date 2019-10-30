@extends('Message.layouts.body')

@section('navigation')
    @include('Message.layouts.navigation')
@endsection

@section('content')
    <form class="form_send" name="forma" method="POST" action="/Message/send">
        {{ csrf_field() }}
        <textarea class="textarea_text_sms" type="text" name="smstext" onkeyup="count(forma)" onchange="count(forma)" placeholder="Enter the text of sms message here..."></textarea>
        <div class="counter">Symbols: <span id="counter">0</span></div>
        <button id="send" class="button_send" type="submit" disabled="disabled">Send <span id="quantity_sms">1</span> SMS</button>
    </form>
    <script language="JavaScript">
        function count(forma) {
            inputStr = forma.smstext.value;
            send = forma.send;
            strlength= inputStr.length;
            lat = inputStr.search(/^[\x20-\x7f\x0a\x0d\u20AC\u00D6\u00A3\u00A5\u00E8\u00E9\u00F9\u00EC\u00F2\u00C7\u00D8\u00F8\u00C5\u00E5\u0394\u0394\u03A6\u0393\u039B\u03A9\u03A0\u03A8\u03A3\u0398\u00C6\u039E\u00E6\u00DF\u00C9\u00A4\u00C4\u00D6\u00D1\u00DC\u00A7\u00BF\u00E4\u00F6\u00F1\u00FC\u00E0]*$/);
            var sbc=0; var ss=0;
            var smscnt=1;
            while (inputStr.indexOf("\x0d\x0A", ss)>-1) { sbc++; ss=1+inputStr.indexOf("\x0d\x0A", ss); }
            if (lat==0)
            {
                var twobyte=new Array('^','{','}','_','\\',
                    '[','~',']','|',"\u20AC",
                    "\u00D6","\u00A3","\u00A5",
                    "\u00E8","\u00E9","\u00F9",
                    "\u00EC","\u00F2","\u00C7",
                    "\u00D8","\u00F8","\u00C5",
                    "\u00E5","\u0394","\u03A6",
                    "\u0393","\u039B","\u03A9",
                    "\u03A0","\u03A8","\u03A3",
                    "\u0398","\u039E","\u00C6",
                    "\u00E6","\u00DF","\u00C9",
                    "\u00A4","\u00C4","\u00D6",
                    "\u00D1","\u00DC","\u00A7",
                    "\u00BF","\u00E4","\u00F6",
                    "\u00F1","\u00FC","\u00E0"
                );

                var tbc=0;
                for (i=0; i<twobyte.length; i++)
                {
                    var sc=twobyte[i];
                    var ss=0;
                    while (inputStr.indexOf(sc, ss)>-1) { tbc++; ss=1+inputStr.indexOf(sc, ss); }
                }
                len = strlength + tbc - sbc;
                if (len>160) {smscnt=Math.ceil(len/153);}
            }
            else
            {
                len = strlength - sbc;
                if (len>70) {smscnt=Math.ceil(len/67);}
            }
            if(len>0){
                send.disabled = false;
            }
            else{
                send.disabled = true;
            }
            document.getElementById('quantity_sms').innerHTML = smscnt;
            document.getElementById('counter').innerHTML = len;
        }
    </script>
@endsection