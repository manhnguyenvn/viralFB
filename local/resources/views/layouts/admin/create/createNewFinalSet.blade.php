@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('admin/form-validation/parsley.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="admin-container">
        <div class="panel panel-primary">
            <div class="panel-heading panou-titlu">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create New App
            </div>
            <div class="panel-body">

                <ul class="nav nav-tabs">
                    <li id="btndetalies" role="presentation"><a
                                href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/detalies?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/detalies') }}@endif">Basic App Details &nbsp;<span class="label label-success">Complete</span></a></li>
                    <li id="btnresults" role="presentation"><a
                                href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/results?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/results') }}@endif">Results
                            &nbsp;<span class="label label-success">Complete</span></a>
                    </li>
                    <li id="btnappset" class="active" role="presentation" data-toggle="tab"><a
                                href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/appset?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/appset') }}@endif">Final
                            settings</a>
                    </li>
                </ul>
                <div class="panel panel-info">
                    <div class="panel-body">
                        {!! Form::open(['id' => 'createappset', 'data-parsley-validate' => '']) !!}
                        <div class="panel panel-primary">
                            <div class="panel-heading">Open graph</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    {!! Form::label('fbtitle', 'FB App Title'); !!}
                                    <br>
                                    <small>(Title displayed on facebook shared link)</small>
                                    {!! Form::text('fbtitle', isset($fbtitle) ? $fbtitle : '' , ['class' => 'form-control', 'id' => 'fbtitle', 'required' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('fbdescription', 'FB App Description'); !!}
                                    <br>
                                    <small>(Description displayed on facebook shared link)</small>
                                    {!! Form::text('fbdescription', isset($fbdescription) ? $fbdescription : '' , ['class' => 'form-control', 'id' => 'fbdescription', 'required' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('fbimage', 'FB App Image'); !!}
                                    <br>
                                    <small>(Image displayed on facebook shared link)</small>
                                    {!! Form::select('fbimage', array('mainimage' => 'Default App Image',
                                    'generatedimage' => 'Random genetared image with user profile picture'), isset($fbimage) ? $fbimage : 'generatedimage', array('class' => 'form-control', 'id' => 'fbimage')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">Media page</div>
                            <div class="panel-body">
                                <small><b>What is media page?</b>  It's a page which displays the result of the user who shared the link which the user who wants to try the app found it on Facebook News Feed.</small>
                                <br>
                                <b>Display Media Page: </b>
                                <input id="disp-media" name="disp-media" type="checkbox"
                                       @if(!empty($disp_media) && $disp_media == 'on')checked @endif
                                       @if(empty($disp_media)) checked @endif
                                       data-toggle="toggle" data-on="YES"
                                       data-off="NO" data-onstyle="success" data-offstyle="danger"
                                       data-style="ios">
                                <br><br>
                                {!! Form::label('mediatext', 'Text to be displayed in media page, below the result image (Optional)'); !!}
                                {!! Form::text('mediatext', isset($mediatext) ? $mediatext : '' , ['class' => 'form-control', 'id' => 'mediatext']) !!}

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <i class="green"> All inputs here can contain the Facebook user name </i> <br>
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                <i class="green">How to use?</i> <br>
                                <b>[first-name]</b> - <i>For facebook user firstname</i> <br>
                                <b>[last-name</b> - <i>For facebook user lastname</i> <br>
                                <b>[full-name]</b> - <i>For facebook user fullname</i>
<!--                                 @if($multiplayermode == 'true' && !empty($fbsecret))  <br>
                                <b>[friend-1-first-name]</b> - <i>For facebook friend user firstname</i> <br>
                                <b>[friend-1-last-name</b> - <i>For facebook friend user lastname</i> <br>
                                <b>[friend-1-full-name]</b> - <i>For facebook friend user fullname</i><br>
                                <b>You can use also for example:[friend-2-full-name] <br>You can use the numbers of the friends you used in the editor.<br>Just change the number after friend- to the number you want to show.</b>
                                <span style="color: red;display:block;font-size: 16px;">
                                    *You can maximum up to top 9 friends!
                                </span>
                                @endif -->
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="save btn-lg btn-success pull-right"><i
                                            class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;<b>Save final
                                        settings</b></button>
                                <br><br><br>

                                <div id="mesaj" class="pull-right"></div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <div class="publish" style="display: none">
                            <hr class="style-two">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3><b>Your App is ready to be published! <br>
                                                To make the app available to users, click Publish App!</b></h3>
                                    </div>
                                    <div class="col-md-6">
                                        <br><br>
                                        <button id="publish"
                                                class="publish btn-lg btn-danger pull-right"><i class="fa fa-users"
                                                                                                aria-hidden="true"></i>
                                            <b>Publish App</b>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">App Published</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Successfully published app!</b> <br> App is now available to users!
                        </h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


@stop

@section('foot')
    @parent
    <script src="{{ URL::asset('admin/js/createappset.js') }}"></script>
    <script src="{{ URL::asset('admin/form-validation/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>


    @if(!empty(Input::get('editid')))
        <script>
            $('body').data('editid', '{{ Input::get('editid') }}');
        </script>
    @endif

    @if(empty(Input::get('editid')))
        @if ( !empty ( $fbtitle ) )
            <script>
                $('.publish').show();
                $('html, body').animate({
                    scrollTop: $(".save").offset().top
                }, 1000);
            </script>
        @endif
    @endif
@stop

