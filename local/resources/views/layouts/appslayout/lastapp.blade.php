@section('main_head')
    @parent
    <style>body {
            background-color: {{ $colors['pagebackground'] }} !important;
        }</style>
@stop
<div class="container ultima-aplicatie latestappcontainer">
    <div class="col-md-7">
        <h4><i class="fa fa-bolt" aria-hidden="true"></i> <b>{{ $lang['latestapp'] }}:</b></h4>
        <h1>{{  $ultimaaplicatie->title }}</h1>
        <div onclick="window.location='{{ url("/$ultimaaplicatie->appname") }}'" class="ultima-aplicatie-btn">
            <div class="move">{{ $lang['letsdoit'] }} &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <img onclick="window.location='{{ url("/$ultimaaplicatie->appname") }}'"
             src="{{ $ultimaaplicatie->img }}"
             alt="Latest app">

    </div>
</div>
<br>
<br>
