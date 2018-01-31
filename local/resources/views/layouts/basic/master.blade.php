@include('layouts.basic.head')

<body>
<div id="fb-root"></div>
<div class="site-content">
    @include('layouts.basic.header')
    <div class="below-header">
        @yield('content')
        @include('layouts.basic.footer')
        @include('layouts.basic.foot')
    </div>
</div>
</body>
</html>