@section('main_head')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VF Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ URL::asset('admin/theme/css/charisma-app.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/26b0070cc9.js"></script>

    <!-- jQuery -->
    <script src="{{ URL::asset('admin/theme/bower_components/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <link href="{{ URL::asset('components/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/html5shiv.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/respond.min.js') }}" type="text/javascript"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="icon" href="{{ URL::asset('/') }}{{ $json_cu_variabile['favicon'] }}" type="image/gif" sizes="16x16">

    <meta name="robots" content="noindex">
@show
</head>

<body>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('dashboard') }}">
             <img src="{{ URL::asset('/files/logoforsite-white.png') }}"></a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button onclick="window.location.href='{{ URL::route('logout') }}'"  class="btn btn-default">
                <i class="glyphicon glyphicon-off"></i>  Log out

            </button>

        </div>
        <!-- user dropdown ends -->
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            <li><a href="{{ URL::to('/') }}" target="_blank" style="padding:0;"><button class="btn btn-success" style="margin-top:8px;"><i class="glyphicon glyphicon-home"></i> &nbsp;<b>Front Site</b></button></a></li>
        </ul>


    </div>
</div>
<!-- topbar ends -->
<div class="ch-container">
    <div class="row">

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Administration</li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i><span> Dashboard</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/configuration') }}"><i class="glyphicon glyphicon-wrench"></i><span> Configuration</span></a>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-th-large"></i><span> Apps </span> <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a class="ajax-link" href="{{ URL::to('dashboard/apps/list') }}"><i class="glyphicon glyphicon-eye-open"></i><span>
                                    Apps List</span></a>
                                </li>
                                <li><a class="ajax-link" href="{{ URL::to('dashboard/apps/create/detalies') }}"><i class="glyphicon glyphicon-plus"></i><span>
                                    Create New App</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/widgets') }}"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><span>
                                    Widgets</span></a>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i><span> Pages </span> <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a class="ajax-link" href="{{ URL::to('dashboard/pages/list') }}"><i class="glyphicon glyphicon-eye-open"></i><span>
                                    Pages List</span></a>
                                </li>
                                <li><a class="ajax-link" href="{{ URL::to('dashboard/pages/add') }}"><i class="glyphicon glyphicon-plus"></i><span>
                                    Add New Page</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/languages') }}"><i class="fa fa-globe" aria-hidden="true"></i><span>
                                    Languages</span></a>
                        </li>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/password') }}"><i class="fa fa-user" aria-hidden="true"></i><span> Admin config</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/changecolors') }}"><i class="glyphicon glyphicon-eye-open"></i><span> Themes/Color Scheme</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/plugins') }}" ><i class="fa fa-plug" aria-hidden="true"></i><span> Plugins</span><span style="color: red;font-size: 12px;vertical-align: top;margin-left: 5px;">NEW!</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('dashboard/update') }}" ><i class="fa fa-wrench" aria-hidden="true"></i><span> Update</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
          @yield('content')
            <!-- content ends -->
        </div><!--/#content.col-md-0-->

    </div><!--/fluid-row-->
</div><!--/.fluid-container-->
<div class="ch-container">
<div class="row">
    <div class="col-md-12 nogutter"><div class="copyInner">All rights reserved to <a href="http://#" target="_blank">ViralFB</a></div></div>
</div>
</div><!--/.fluid-container-->
<!-- external javascript -->
@section('foot')
<script src="{{ URL::asset('admin/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.cookie.js') }}"></script>
<script src='{{ URL::asset('admin/theme/bower_components/moment/min/moment.min.js') }}'></script>
<script src='{{ URL::asset('admin/theme/bower_components/fullcalendar/dist/fullcalendar.min.js') }}'></script>
<script src='{{ URL::asset('admin/theme/js/jquery.dataTables.min.js') }}'></script>
<script src="{{ URL::asset('admin/theme/bower_components/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/bower_components/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.noty.js') }}"></script>
<script src="{{ URL::asset('admin/theme/bower_components/responsive-tables/responsive-tables.js') }}"></script>
<script src="{{ URL::asset('admin/theme/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.raty.min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.iphone.toggle.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.autogrow-textarea.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.uploadify-3.1.min.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/jquery.history.js') }}"></script>
<script src="{{ URL::asset('admin/theme/js/charisma.js') }}"></script>
@show
</body>
</html>

