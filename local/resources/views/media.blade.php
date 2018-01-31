@extends('layouts.basic.master')
@include('layouts.widgets.singleAppWidgets')
@section('title') {{ $aplicatie->title }} @stop
@section('metatags')
    <meta name="description" content="{{ $appset['fbdescription'] }}">

    <meta property="fb:app_id" content="{{ $json_cu_variabile['fbappid'] }}" />
    <meta property="og:site_name" content="{{ $json_cu_variabile['sitename'] }}">
    <meta property="og:description" content="{{ $appset['fbdescription'] }}">
    <meta property="og:title" content="{{ $appset['fbtitle'] }}">
    <meta property="og:url" content="{{ url() }}/{{ $aplicatie->appname }}/media/{{ $input['id'] }}-{{ $input['result'] }}">
    @if($appset['fbimage'] == 'mainimage')
        <meta property="og:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    @else
        <meta property="og:image" content="{{ url() }}/{{ $aplicatie->appname }}/media-image/{{ $input['fbid'] }}-{{ $input['gender'] }}-{{ urlencode($input['fullname']) }}-{{ urlencode($input['firstname']) }}-{{ urlencode($input['lastname']) }}-{{ $input['result'] }}.jpg"/>
    @endif
    <meta property="og:image:height" content="446">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="850">
    <meta property="og:image:type" content="image/jpeg">

    <meta property="twitter:meta_title" content="{{ $appset['fbtitle'] }}">
    <meta property="twitter:description" content="{{ $appset['fbdescription'] }}">
    @if($appset['fbimage'] == 'mainimage')
        <meta name="twitter:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    @else
        <meta name="twitter:image" content="{{ url() }}/{{ $aplicatie->appname }}/media-image/{{ $input['fbid'] }}-{{ $input['gender'] }}-{{ urlencode($input['fullname']) }}-{{ urlencode($input['firstname']) }}-{{ urlencode($input['lastname']) }}-{{ $input['result'] }}.jpg"/>
    @endif
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image:height" content="446">
    <meta property="twitter:image:width" content="850">
@stop

@section('content')
    <?php $appname = $aplicatie->appname ?>
    <div class="widgets-under-header-bar">
        @yield('widgets-under-header-bar')
    </div>
    @if( $widgets_on == 0)<div class="before-app-container"></div>@endif
    <div class="container app-container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-main">
                    <div class="blog-post">

                        <img src="{{ url() }}/{{ $aplicatie->appname }}/media-image/{{ $input['fbid'] }}-{{ $input['gender'] }}-{{ urlencode($input['fullname']) }}-{{ urlencode($input['firstname']) }}-{{ urlencode($input['lastname']) }}-{{ $input['result'] }}.jpg">
                        <div class="text-center mediatext">{{ $appset['mediatext'] }}</div>
                        
                        <div class="widgets-above-login">
                            @yield('widgets-above-login')
                        </div>
                        <a href="{{ URL::to($aplicatie->appname) }}">
                            <button class="btn-lg btn-primary find-media-btn"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ $lang['findmedia'] }}</button>
                        </a>
                        <div class="top-ten">
                            <div class="widgets-below-login">
                                @yield('widgets-below-login')
                            </div>
                        </div>
                        @if(!empty($json_cu_variabile['disp-fb-comm']) && $json_cu_variabile['disp-fb-comm'] == 'on')
                            <br>
                            <div class="fb-comments" data-href="{{ url() }}/{{ $aplicatie->appname }}" data-width="100%"
                                 data-numposts="7"></div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="new-sidebar">
                <div class="col-md-4">
                    <div class="sidebar-content">
                        <div class="sdb">
                            {{--<div class="sidebar-module ">  </div>--}}
                            <div class="widgets-sidebar">
                                @yield('widgets-sidebar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>  <!-- /.site-sidebar -->
        </div> <!-- /.row -->
    </div><!-- /.container -->
    <br>
    <div class="widgets-before-apps-list">
        @yield('widgets-above-apps-list')
    </div>

    <br>
    <div class="row new-apps">
        @foreach($aplicatii as $aplicatie)
            @include('layouts.appslayout.applayout')
        @endforeach
    </div>
    @if($aplicatii->lastPage() > 1)
        <div class="more-apps"></div>
        <div id="load-more-apps" class="new-apps-info pointer"><i class="fa fa-chevron-circle-down"
                                                                  aria-hidden="true"></i> <i>{{ $lang['moreapps'] }}</i></div>
        <div class="preloader">
            <img src="{{ URL::asset('images/circle-preloader.gif') }}" alt="Loading more apps">
        </div>
    @endif

    <br>
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
                $('.more-apps-' + i).load('{{ URL::to( $appname ) }}/media/{{ $input['id'] }}-{{ $input['result'] }}?page=' + i + ' .new-apps', function () {
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

@section('foot')
    @parent
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v2.7&appId={{ $json_cu_variabile['fbappid'] }}";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    @stop
