<a class="create" href="/Message/create"></a>
<a class="workers" href="/Message/workers"></a>
<a class="statistic" href="/Message/statistic"></a>
<form action="/Message/logout" method="POST">
    {{ csrf_field() }}
    <button class="logout" type="submit"></button>
</form>