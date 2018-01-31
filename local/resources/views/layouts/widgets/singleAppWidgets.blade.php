@section('widgets-under-header-bar')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'under-header' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
                <br>
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-sidebar')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'sidebar' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                <div style="clear: both"></div>
                <div class="sidebar-section">
                    {!! $widget['wcontent'] !!}
                </div>
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-header-bar')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'header' && $widget['activeapps'] == 'on')
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
            @if($position == 'footer' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-above-login')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'above-login-share' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                <div style="margin-bottom: 10px">{!! $widget['wcontent'] !!}</div>
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-below-login')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'below-login-share' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-above-share')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'above-login-share' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-below-share')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'below-login-share' && $widget['activehome'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop

@section('widgets-above-apps-list')
    @foreach(array_keys($allwidgets) as $position)
        @foreach(array_keys($allwidgets[$position]) as $widgetkey)
            {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
            @if($position == 'before-apps-list' && $widget['activeapps'] == 'on')
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
            @if($position == 'above-footer' && $widget['activeapps'] == 'on')
                @if($widget['wtitledisplay'] == 'on')
                    <div style="text-align: center; font-weight: bold;"> {{ $widget['wtitle'] }}</div>
                @endif
                {!! $widget['wcontent'] !!}
            @endif
        @endforeach
    @endforeach
@stop
