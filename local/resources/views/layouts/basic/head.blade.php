@section('main_head')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @yield('metatags')
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Pacifico" rel="stylesheet">
    <link rel="icon" href="{{ URL::asset('/') }}{{ $json_cu_variabile['favicon'] }}" type="image/gif" sizes="16x16">

    <!-- Bootstrap 3  -->
    <link href="{{ URL::asset('components/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('/') }}css/style.php?{{ http_build_query($colors) }}" rel="stylesheet">
    <link href="{{ URL::asset('css/single-style.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/26b0070cc9.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <link href="{{ URL::asset('css/ie.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/html5shiv.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/respond.min.js') }}" type="text/javascript"></script>
    <![endif]-->

    <!-- Facebook like button -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId={{ $json_cu_variabile['fbappid'] }}";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    {!! $json_cu_variabile['headcode'] !!}
    @show
</head>