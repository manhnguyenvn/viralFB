@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('/admin/theme/bower_components/colorbox/example4/colorbox.css') }}" rel="stylesheet">
    <script type="text/javascript"
            src="{{ URL::asset('/admin/theme/bower_components/colorbox/jquery.colorbox-min.js') }}"></script>
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>

    <link href="{{ URL::asset('admin/form-validation/parsley.css') }}" type="text/css" rel="stylesheet"/>

@stop
@section('content')
    <div class="admin-container">
    <div class="panel panel-primary">
        <div class="panel-heading panou-titlu">
            @if(!empty(Input::get('editid')))
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit App
                @else
                <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create New App
                @endif
        </div>
        <div class="panel-body">

                <ul class="nav nav-tabs">
                    <li id="btndetalies" class="active" role="presentation" data-toggle="tab"><a
                                href="{{ URL::to('dashboard/apps/create/detalies') }}">Basic App Details &nbsp;<span id="sdetalies" class="label label-danger">Incomplete</span></a></li>
                    <li id="btnresults" class="disabled" role="presentation" style="pointer-events: none;"><a href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/results?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/results') }}@endif">Results &nbsp;<span id="sresults" class="label label-default">Incomplete</span></a>
                    </li>
                    <li id="btnappset" class="disabled" role="presentation" style="pointer-events: none;"><a
                                href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/appset?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/appset') }}@endif">Final settings &nbsp;@if(!empty(Input::get('editid')))<span  class="label label-success">Completed </span> @else <span id="sappset" class="label label-default">Incomplete </span>@endif</a>
                    </li>
                </ul>
                <div class="panel panel-info">
                    <div class="panel-body">
                    <div class="admin-container">
                        {!! Form::open(['id' => 'createappdetalies', 'data-parsley-validate' => '']) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'App Title'); !!}
                            {!! Form::text('title', isset($newapptitle) ? $newapptitle : '' , ['class' => 'form-control', 'required' => '']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'App Description'); !!}
                            {!! Form::textarea('description', isset($newappdescription) ? $newappdescription : '', ['class' => 'form-control', 'style' => 'height:80px', 'required' => '']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('img', 'App Image (App presentation image)'); !!}

                            <div id="chooseimage"></div>
                            <div id="noimagealert"></div>

                            <div class="form-inline" style="display: none">
                                {!! Form::text('img', isset($newappimage) ? $newappimage : '', ['class' => 'form-control', 'id' => 'img', 'name' => 'img']) !!}
                                <button class="btn btn-primary popup_selector" data-inputid="img">
                                    <i class="glyphicon glyphicon-picture glyphicon-white"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn-lg btn-success"><b><i class="fa fa-floppy-o"
                                                                                       aria-hidden="true"></i> Save App Details</b>
                                </button>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-6">
                                <button id="nextstepbtn"
                                        onclick="nextStep(event)"
                                        class="btn-lg btn-warning pull-right" style="display: none"><i
                                            class="glyphicon glyphicon-forward"></i>Go to
                                    next step
                                </button>
                            </div>
                        </div>


                        <br>

                        <div id="mesaj"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

@stop
@section('foot')
    @parent
    <script src="{{ URL::asset('admin/js/createappdetalies.js') }}"></script>
    <script src="{{ URL::asset('admin/form-validation/parlsey.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}"></script>
    <script>
        function CheckIfChanged() {
            var inputvar = $('#img').val();
            if (inputvar === '') {
                inputvar = 'images/choose-image.jpg';
            }
            $('#chooseimage').html('<img class="thumbnail popup_selector" data-inputid="img" src="{{ URL::asset('/') }}' + inputvar + '" style="width:200px; cursor:pointer;" >');
        }
        setInterval(function () {
            CheckIfChanged();
        }, 1000);

        @if ( !empty ( $nrresults ) )
            $(function(){
            var nrres = {{ $nrresults }};
           if(nrres >= 2){
               $('#btnappset').removeClass('disabled');
               $('#btnappset').css('pointer-events', 'auto');
               var sresults = $('#sresults');
               sresults.removeClass('label-danger');
               sresults.addClass('label-success');
               sresults.html('Completed');
               var sappset = $('#sappset');
               sappset.removeClass('label-defatlt');
               sappset.addClass('label-danger');
           }
        });
            @endif

        @if ( !empty ( $newapptitle ) )
            $(function(){
                $('#nextstepbtn').show();
            });
            @endif

        @if(!empty(Input::get('editid')))
       $('body').data('editid', '{{ Input::get('editid') }}');
        @endif

        function nextStep(event){
            event.preventDefault();
            window.location.href='@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/results?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/results') }}@endif';
        }
    </script>
@stop
