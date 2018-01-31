@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('/admin/theme/bower_components/colorbox/example4/colorbox.css') }}" rel="stylesheet">
    <script type="text/javascript"
            src="{{ URL::asset('/admin/theme/bower_components/colorbox/jquery.colorbox-min.js') }}"></script>
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">

@stop
@section('content')
<style>
    
   .multiplayermode{display:none;}
   
</style>
    <div class="admin-container">
        <div class="panel panel-primary">
            <div class="panel-heading panou-titlu">
                <i class="glyphicon glyphicon-wrench"></i> Main configuration
            </div>
            <div class="panel-body">
                {!! Form::open(['id' => 'site-main-configuration']) !!}
                {!! Form::text('multiplayermode', (!empty($json_cu_variabile['fbsecretid'])?'true':''), ['class' => 'multiplayermode']) !!}
                <div class="form-group">
                    {!! Form::label('sitename', 'Site name') !!}
                    {!! Form::text('sitename', $json_cu_variabile['sitename'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sitemetaname', 'Site Title') !!}
                    {!! Form::text('sitemetaname', $json_cu_variabile['sitemetaname'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sitedescription', 'Site Description') !!}
                    {!! Form::text('sitedescription', $json_cu_variabile['sitedescription'], ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('logo', 'Site Logo'); !!}
                            <div id="chooselogo"></div>
                            <div class="form-inline">
                                {!! Form::text('logo', $json_cu_variabile['logo'], ['class' => 'form-control', 'id' => 'logo', 'name' => 'logo']) !!}
                                <button class="btn btn-primary popup_selector" data-inputid="logo">
                                    <i class="glyphicon glyphicon-picture glyphicon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('favicon', 'Site Favicon'); !!}
                            <div id="choosefavicon"></div>
                            <div class="form-inline">
                                {!! Form::text('favicon', $json_cu_variabile['favicon'], ['class' => 'form-control', 'id' => 'favicon', 'name' => 'favicon']) !!}
                                <button class="btn btn-primary popup_selector" data-inputid="favicon">
                                    <i class="glyphicon glyphicon-picture glyphicon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Facebook FanPage For Header(Optional,if empty will no output like button)</b>
                    </div>
                    <div class="panel-body greybg">
                        {!! Form::label('fburl', 'Facebook Fan Page URL') !!}
                        {!! Form::text('fburl', $json_cu_variabile['fburl'], ['class' => 'form-control', 'id' => 'fburl',
                        'name' => 'fburl']) !!}
                    </div>

                </div>
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Facebook app id(Must needed)</b>
                    </div>
                    <div class="panel-body greybg">
                        {!! Form::label('fbappid', 'Facebook App ID') !!}
                        {!! Form::text('fbappid', $json_cu_variabile['fbappid'], ['class' => 'form-control', 'id' => 'fbappid',
                        'name' => 'fbappid']) !!}
                    </div>

                </div>
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Facebook App Secret ID - (For multiple friends Plugin)</b>
                    </div>
                    <div class="panel-body greybg">
                        {!! Form::label('fbsecretid', 'Facebook Secret ID') !!}
                        {!! Form::text('fbsecretid', $json_cu_variabile['fbsecretid'], ['class' => 'form-control', 'id' => 'fbsecretid',
                        'name' => 'fbsecretid']) !!}
                        <br>-----<br>
                        <h3>WARNING - Please read before enter App Secret ID!</h3>
                        <span style="color:red;font-weight: bold;">(App Secret ID is Optional - Its only needed for multiple friends! and make sure you activate the mutliple friends plugin before at the plugins page!<br>*Please leave this field empty if you didn't activate the Multiple Friends Plugin and or you don't have user_photos premission from facebook api console - <span style="font-size: 17px">Else you will receive error and ViralFB won't work!</span>)</span>
                    </div>

                </div>
                 <br>
                 <div class="row">
                 <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <b>*Required - Facebook user_photos premission - (For multiple friends Plugin)</b>
                        </div>
                        <div class="panel-body greybg">
                            {!! Form::label('userphotos', 'Facebook user_photos premission write true/false to enable(And Save)') !!}
                            {!! Form::text('userphotos', $json_cu_variabile['userphotos'], ['class' => 'form-control', 'id' => 'userphotos',
                            'name' => 'userphotos']) !!}
                            <br>-----<br>
                            <h3>WARNING - Please read before writing TRUE</h3>
                            <span style="color: #e82b4d;font-weight: bold;font-size: 19px;">When writing "true" you agree and have user_photos premission approved from facebook developer app console for your application - Most needed for run multiple friends plugin - by default its False</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <b>*Optional - Facebook user_posts premission - (For multiple friends Plugin)</b>
                        </div>
                        <div class="panel-body greybg">
                            {!! Form::label('userposts', 'Facebook user_posts premission write true/false to enable(And Save)') !!}
                            {!! Form::text('userposts', $json_cu_variabile['userposts'], ['class' => 'form-control', 'id' => 'userposts',
                            'name' => 'userposts']) !!}
                            <br>-----<br>
                             <h3>WARNING - Please read before writing TRUE</h3>
                              <span style="color: #e82b4d;font-weight: bold;font-size: 19px;">This is Optional,its just help to increase top friends quality.<br>------<br>
                              When writing "true" you agree and have user_posts premission approved from facebook developer app console for your application - Most needed for run multiple friends plugin - by default its False</span>
                        </div>

                    </div>
                </div>
                </div>
                <br>

                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Visibility of some elements</b></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Display latest app section: </b>
                                <input name="disp-latest-app" type="checkbox"
                                       @if(!empty($json_cu_variabile['disp-latest-app']) && $json_cu_variabile['disp-latest-app'] == 'on')checked
                                       @endif
                                       data-toggle="toggle" data-on="YES"
                                       data-off="NO" data-onstyle="success" data-offstyle="danger"
                                       data-style="ios">
                            </div>
                            <div class="col-md-6">
                                <b> Display FB Comments: </b>
                                <input name="disp-fb-comm" type="checkbox"
                                       @if(!empty($json_cu_variabile['disp-fb-comm']) && $json_cu_variabile['disp-fb-comm'] == 'on')
                                       checked
                                       @endif
                                       data-toggle="toggle" data-on="YES"
                                       data-off="NO" data-onstyle="success" data-offstyle="danger"
                                       data-style="ios">
                            </div>
                        </div>
                        <br>

                        <div class="panel panel-primary">
                            <div class="panel-heading">Share Modal</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Display FB Share Modal </b>
                                        <input name="disp-share-modal" type="checkbox"
                                               @if(!empty($json_cu_variabile['disp-share-modal']) && $json_cu_variabile['disp-share-modal'] == 'on')checked
                                               @endif
                                               data-toggle="toggle" data-on="YES"
                                               data-off="NO" data-onstyle="success" data-offstyle="danger"
                                               data-style="ios">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div style="margin-top: 7px">
                                                    {!! Form::label('modal-time', 'Show FB Share Modal after X sec:') !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                {!! Form::text('modal-time', $json_cu_variabile['modal-time'], ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    {!! Form::label('modal-title', 'Modal title') !!}
                                    {!! Form::text('modal-title', $json_cu_variabile['modal-title'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('modal-text', 'Modal text') !!}
                                    {!! Form::textarea('modal-text', $json_cu_variabile['modal-text'], ['class' => 'form-control', 'style' => 'height:80px']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Open graph configuration</b></h3>
                    </div>
                    <div class="panel-body greybg">
                        <div class="form-group">
                            {!! Form::label('graphtitle', 'Home Page - open graph title') !!}
                            {!! Form::text('graphtitle', $json_cu_variabile['graphtitle'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('graphdescription', 'Home Page - open graph description') !!}
                            {!! Form::text('graphdescription', $json_cu_variabile['graphdescription'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('graphimg', 'Home Page - open graph image'); !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-inline">
                                        {!! Form::text('graphimg', $json_cu_variabile['graphimg'], ['class' => 'form-control', 'id' => 'graphimg', 'name' => 'graphimg']) !!}
                                        <button class="btn btn-primary popup_selector" data-inputid="graphimg">
                                            <i class="glyphicon glyphicon-picture glyphicon-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="choosegraphimg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Custom code</b>
                    </div>
                    <div class="panel-body greybg">
                        {!! Form::label('headcode', 'Header section code') !!}
                        {!! Form::textarea('headcode', $json_cu_variabile['headcode'], ['class' => 'form-control', 'style' => 'height:130px;', 'id' => 'headcode', 'name' => 'headcode']) !!}
                        <b><i><span style="color:#d01006">Do not insert html code to be displayed to users!</span> The
                                code inserted here will be included inside &lt;head&gt; &lt;/head&gt; tags. Here you can
                                insert code for Meta tags, CSS/JS files. Eq.: Google analytics code, Google webmaster
                                verification code, etc.</i></b>
                        <br><br>
                        {!! Form::label('bodycode', 'Footer section code') !!}
                        {!! Form::textarea('bodycode', $json_cu_variabile['bodycode'], ['class' => 'form-control', 'style' => 'height:130px;', 'id' => 'bodycode', 'name' => 'bodycode']) !!}
                        <b><i>Code to be included just before the closing &lt;/body&gt; tag.</i></b>
                    </div>
                </div>
                <hr>
                {!! Form::submit('Save configuration', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    </div>

    <br><br><br>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Configuration saved</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Configuration saved successfully!</b>
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
    <script type="text/javascript" src="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/js/configuration.js') }}"></script>
    <script>
        function CheckIfChanged() {
            var inputvar = $('#logo').val();
            if (inputvar === '') {
                inputvar = 'images/choose-image.jpg';
            }
            $('#chooselogo').html('<img class="thumbnail popup_selector" data-inputid="logo" src="{{ URL::asset('/') }}' + inputvar + '" style="width:200px; cursor:pointer;" >');
        }
        setInterval(function () {
            CheckIfChanged();
        }, 1000);

        function CheckIfChangedfavicon() {
            var inputvarfavicon = $('#favicon').val();
            if (inputvarfavicon === '') {
                inputvarfavicon = 'images/choose-image.jpg';
            }
            $('#choosefavicon').html('<img class="thumbnail popup_selector" data-inputid="favicon" src="{{ URL::asset('/') }}' + inputvarfavicon + '" style="width:50px; cursor:pointer;" >');
        }
        setInterval(function () {
            CheckIfChangedfavicon();
        }, 1000);

        function CheckIfChangedGraphImg() {
            var inputvarGraphImg = $('#graphimg').val();
            if (inputvarGraphImg === '') {
                inputvarGraphImg = 'images/choose-image.jpg';
            }
            $('#choosegraphimg').html('<img class="thumbnail popup_selector" data-inputid="graphimg" src="{{ URL::asset('/') }}' + inputvarGraphImg + '" style="width:200px; cursor:pointer;" >');
        }
        setInterval(function () {
            CheckIfChangedGraphImg();
        }, 1000);

        @if(session()->has('message'))
            $('#myModal').modal('show');
        setTimeout(function () {
            $('#myModal').modal('hide');
        }, 3000);
        @endif
    </script>
@stop