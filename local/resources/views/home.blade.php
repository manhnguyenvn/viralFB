@extends('layouts.basic.master')
@include('layouts.widgets.homeWidgets')
@section('title'){{ $json_cu_variabile['sitename'] }} - {{ $json_cu_variabile['sitemetaname'] }}@stop
@section('metatags')
    <meta property="og:site_name" content="{{ $json_cu_variabile['sitename'] }} - {{ $json_cu_variabile['sitemetaname'] }}"/>

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $json_cu_variabile['graphtitle'] }}"/>
    <meta name="twitter:title" content="{{ $json_cu_variabile['graphtitle'] }}"/>

    <meta property="og:image" content="{{ URL::asset('/') }}{{ $json_cu_variabile['graphimg'] }}"/>
    <meta name="twitter:image" content="{{ URL::asset('/') }}{{ $json_cu_variabile['graphimg'] }}"/>
    <meta name="twitter:card" content="photo"/>

    <meta name="description" content="{{ $json_cu_variabile['sitedescription'] }}">
    <meta property="og:description" content="{{ $json_cu_variabile['graphdescription'] }}"/>
@stop
@section('content')
    <div class="widgets-under-header-bar">
        @yield('widgets-under-header-bar')
    </div>
    <br>
    <div class="continut">
        @if(!empty($json_cu_variabile['disp-latest-app']) && $json_cu_variabile['disp-latest-app'] == 'on')
        @include('layouts.appslayout.lastapp')
        @endif
        <div class="widgets-before-apps-list">
            @yield('widgets-before-apps-list')
        </div>
        <br>
        <div class="row new-apps">
            @foreach($aplicatii as $aplicatie)
                @include('layouts.appslayout.applayout')
            @endforeach
        </div>

        @if($aplicatii->lastPage() > 1)
        <div class="more-apps"></div>
            <div id="load-more-apps" class="new-apps-info pointer"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> <i>{{ $lang['moreapps'] }}</i></div>
        <div class="preloader">
            <img src="{{ URL::asset('images/circle-preloader.gif') }}" alt="Loading more apps">
        </div>
        @endif

    </div>

    
    <div class="widgets-above-footer">
       @yield('widgets-above-footer')
    </div>

@stop


@section('header-content')
    @yield('widgets-header-bar')
@stop

@section('footer-content')
    @yield('widgets-footer-bar')
@stop

@if($aplicatii->lastPage() > 1)
@section('foot')
    @parent
    <script>
        $(function () {
                var i = 1,
                    pages = {{ $aplicatii->lastPage() }},
                    loadMoreApps = $('#load-more-apps'),
                    preloader = $('.preloader');
                loadMoreApps.click(function () {
                i++;
                loadMoreApps.hide();
                preloader.show();
                $('.more-apps').append('<div class="more-apps-' + i + '"></div>');
                $('.more-apps-' + i).load('{{ URL::to('/') }}?page=' + i + ' .new-apps', function () {
                    if (i == pages) {
                        preloader.hide();
                    } else {
                        preloader.hide();
                        loadMoreApps.show();
                    }
                });
            });
        });
    </script>
    @stop
@endif