@section('widgets-before-apps-list')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'before-apps-list' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-header-bar')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'header' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                <li class="nav-widget">{!! $widget['wcontent'] !!}</li>
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-footer-bar')
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

@section('widgets-above-footer')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'above-footer' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-under-header-bar')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'under-header' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
                <br>
            @endif
        @endforeach
    @endforeach
@stop