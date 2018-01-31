@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('admin/css/lumino.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@stop

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading panou-titlu">
            <i class="fa fa-plug"></i> Plugins
        </div>
        <div class="panel-body">

        <!-- Comment for demo -->
        <div class="alert-info" style="color:black;font-size:16px;margin-bottom: 10px;padding: 10px;">
           <b>Please Read Before Activate MultiPle Friends Plugin</b><br>
           -----------------------------------------------------<br>
           <span style="color:red;font-size:16px;">*Required</span><br>
           1.*First you will need to grant premission from developer console <br> 
            &nbsp;&nbsp;one of those or both for maximum results: <b>user_photos(*Required),user_posts(Optional)</b><br>
           2.*After you have the premissions approved from facebook please set your secret app key from your developer app console<br>
            &nbsp;&nbsp; and paste it inside the required field in the <a href="{{ URL::to('dashboard/configuration') }}">configuration</a> page.<br>
           3.<b>Now you can activate MultiPle Friends Plugin</b><br>&nbsp;&nbsp;2-Easy steps and you done! enjoy top multiple friends and go even more SUPER viral :)
         </div> 
    <div class="panel panel-primary">
                <div class="panel-heading" style="background:#5cb85c;"><b><i class="fa fa-plug"></i> Plugins</div>
                  <div class="panel-body dgreybg">
                    <div class="">
                        
                    </div>
                  </div>
            </div>
   
        </div>
    </div>
 <!-- Modal -->


@stop
@section('foot')
    @parent
    <script type="text/javascript" src="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin/js/activateapp.js') }}"></script>
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