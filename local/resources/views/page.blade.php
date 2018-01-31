@extends('layouts.basic.master')
@section('title')
    {{ $page->title }}@stop
@section('content')
    <div class="container">
        <div class="pages-title"><span style="font-family: 'Permanent Marker', cursive;">{{ $page->title }}</span></div>
        <br>
        {{--*/ $content = $page->content;  /*--}}
        {!! $content  !!}

    </div>
@stop


@section('header-content')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'header' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('footer-content')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'footer' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop