@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="{{ URL::asset('admin/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"
          rel="stylesheet">

    <script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('admin/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>

    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>

@stop
@section('content')
    <div class="admin-container">
        <div class="admin-container">
            <div class="panel panel-primary">
                <div class="panel-heading panou-titlu">
                    <i class="fa fa-eye" aria-hidden="true"></i> Website color scheme
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li id="btnsimple" role="presentation"><a href="#">Simple Colors Editor</a></li>
                        <li id="btnadvanced" role="presentation"><a href="#">Advanced Colors Editor</a></li>
                    </ul>
                    <div class="panel panel-info">
                        <div class="panel-body greybg">
                            <div id="simple"></div>
                            <div id="advanced"></div>
                            <div id="loader"><br>Loading <i class="fa fa-spinner fa-spin"></i></div>
                        </div>
                    </div>
                    </br>
                </div>
            </div>

        </div>
    </div>

@stop


@section('foot')
 @parent
 <script>
     $(document).ready(function () {
         $("#simple").load("{{URL::to("dashboard/changecolors/simple")}}", function () {
             $('#advanced').empty();
             $("#btnsimple").addClass("active");
             $("#loader").fadeOut("fast");
         });
         $("#btnadvanced").click(function () {
             $("#advanced").load("{{URL::to("dashboard/changecolors/advanced")}}", function () {
                 $('#simple').empty();
                 $("#btnadvanced").addClass("active");
                 $("#btnsimple").removeClass("active");
                 $("#loader").fadeOut("fast");
             });
         });
         $("#btnsimple").click(function () {
             $("#simple").load("{{URL::to("dashboard/changecolors/simple")}}", function () {
                 $('#advanced').empty();
                 $("#btnsimple").addClass("active");
                 $("#btnadvanced").removeClass("active");
                 $("#loader").fadeOut("fast");
             });
         });
     });
 </script>
@stop