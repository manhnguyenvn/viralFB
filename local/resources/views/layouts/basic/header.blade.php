<div class="blog-masthead">
    <div class="container">
        <div class="pull-left">
            @if($json_cu_variabile['logo'] !== '')
                <img onclick="window.location='{{ url() }}'"
                     src="{{ URL::asset('/') }}{{ $json_cu_variabile['logo'] }}">
            @else
                <h2 onclick="window.location='{{ url() }}'">{{ $json_cu_variabile['sitename'] }}
                    - {{ $json_cu_variabile['sitemetaname'] }}
                </h2>
            @endif

        </div>
         <div class="pull-right">
            @if (!empty($json_cu_variabile['fburl']))
               <div class="fb-like" data-href="{{ $json_cu_variabile['fburl'] }}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
            @endif
         </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @yield('header-content')
            </ul>
        </div>
    </div>
</div>
<br>