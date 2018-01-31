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
            <i class="fa fa-wrench"></i> Update
        </div>
        <div class="panel-body">
        <div class="alert-danger" style="color:black;font-size:16px;margin-bottom: 10px;padding: 10px;">
           <b>Please make a backup before do automatic update!</b><br>For manually backup please visit:<a href="http://yalayolo.me/documentation/docs.html#multiple">Manuall Backup Guide</a>.<br>
           <hr>
           <h3>First Step:</h3>
           Please first upload the files from the ViralFB Update Folder to the destintions:<br>
                css\sitestyle.css - For theme<br>
                local\resources\views\singleApp.blade.php<br>
                local\resources\views\layouts\admin\configuration.blade.php<br>
                local\resources\views\layouts\admin\boradtemplate.blade.php<br>
                local\resources\views\layouts\admin\dashbaord.blade.php<br>
                local\resources\views\layouts\admin\plugins.blade.php<br>
                local\resources\views\layouts\admin\update.blade.php<br>
                local\resources\views\layouts\admin\create\combinedScript.blade.php<br>
                local\resources\views\layouts\admin\create\edit-text.blade.php<br>
                local\app\Http\Controllers\imageController.php<br>
                local\app\Http\Controllers\AdminController.php<br>
                local\app\Http\Controllers\AppControiller.php<br>
                local\app\Http\routes.php<br>
                local\app\SaferCrypto.php - Upload this file<br>
                admin\js\results-editor-action.js<br>
                admin\js\createappset.js<br>
                admin\js\update.js<br>
         </div>
          <div class="panel panel-primary">
                <div class="panel-heading" ><b><i class="glyphicon glyphicon-home"></i> Installed version:{{ $version['version-name'] }}</div>
                <div class="panel-body greybg" >
                <h3>Second Step:</h3>
                 After uploaded the above files,click on "Do Update" Button.
              
                  {!! Form::open(['id' => 'doUpdate']) !!}
                  {!! Form::submit('Do Update', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
                  {!! Form::close() !!}
               
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
                    <h4 class="modal-title">Updated successfully</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Updated successfully!</b>
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
    <script type="text/javascript" src="{{ URL::asset('admin/js/update.js') }}"></script>
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