<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Administration Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The styles -->
    <link id="bs-css" href="{{ URL::asset('admin/theme/css/bootstrap-cerulean.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/theme/css/charisma-app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="{{ URL::asset('admin/theme/img/favicon.ico') }}">

    <meta name="robots" content="noindex">

    <style>
        body
        {
            background-color: #fcfcfc;
        }

    </style>
</head>
<body>

<div class="row">
    <div class="col-md-12 center login-header">
        <h2 style="color: #383838"> {{ $json_cu_variabile['sitename'] }} - Admin panel</h2>
    </div>
    <!--/span-->
</div><!--/row-->

<div class="row">
    <div class="well col-md-5 center login-box">
        <div class="alert alert-info">
            Please login with your Username and Password.
        </div>
        @if(session()->has('error'))
            <div class="alert alert-danger">
                <b>{{ session()->get('error') }}</b>
            </div>
        @endif

        {!! Form::open(['route' => 'handleLogin']) !!}
        <fieldset>
            <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}

            </div>
            <div class="clearfix"></div>
            <br>

            <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); !!}
            </div>
            <div class="clearfix"></div>

            <p class="center col-md-5">
                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

            </p>
        </fieldset>
        {!! Form::close() !!}
        @if(session()->has('message'))
            <div class="alert alert-success">
               <h4><b>{{ session()->get('message') }}</b></h4>
            </div>
        @endif

    </div>
    <!--/span-->
</div><!--/row-->
</body>
</html>