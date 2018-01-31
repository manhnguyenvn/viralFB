@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ URL::asset('/admin/theme/bower_components/colorbox/example4/colorbox.css') }}" rel="stylesheet">
    <script type="text/javascript"
            src="{{ URL::asset('/admin/theme/bower_components/colorbox/jquery.colorbox-min.js') }}"></script>
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ URL::asset('admin/css/resulteditor.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="{{ URL::asset('admin/pixlr-editor/js/pixlr.js') }}"></script>
    <script type="text/javascript">
        pixlr.settings.target = '{{ URL::to('dashboard/apps/create/results/pixlr-save') }}';
        pixlr.settings.exit = '{{ Request::url() }}';
        pixlr.settings.method = 'GET';
        pixlr.settings.redirect = false;
        pixlr.settings.locktype = 'png';
    </script>
@stop
@section('content')
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
                <li id="btndetalies" role="presentation"><a href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/detalies?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/detalies') }}@endif">Basic App Details &nbsp;<span class="label label-success">Completed</span></a></li>
                <li id="btnresults" class="active" role="presentation" data-toggle="tab"><a
                            href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/results?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/results') }}@endif">Results &nbsp;<span id="sresults" class="label label-danger">Incomplete</span></a>
                </li>
                <li id="btnappset" class="disabled" role="presentation" style="pointer-events: none;"><a
                            href="@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/appset?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/appset') }}@endif">Final settings&nbsp; @if(!empty(Input::get('editid')))<span  class="label label-success">Completed </span> @else <span id="sappset" class="label label-default">Incomplete </span>@endif</a>
                </li>
            </ul>
            <div class="panel panel-info">
                <div class="panel-body">
                     <div class="addandmsg">
                      <div class="row">
                          <button id="add-result" class=" btn-lg btn-primary pull-left"><i class="glyphicon glyphicon-plus"></i> Add
                              result <span>1</span></button>
                          <div id="alertsmg" class="pull-right" style="margin-top: -10px"></div>

                      </div>
                     </div>
                    <br>
                    <div id="accordionn">

                    </div>
                    <br>

                    <div class="panel panel-primary">
                        <div class="panel-heading fb-editor-heading">
                            <i class="fa fa-pencil"></i> <b>FB Editor</b>
                            <button id="display-pixlr" class="btn-sm btn-warning pull-right" style="display: none"><i class="glyphicon glyphicon-eye-open"></i> <b>Display Pixlr Editor</b></button>
                        </div>
                    </div>

                    <div class="fbeditor">
                        @include('layouts.admin.create.edit')
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
                    <h4 class="modal-title">Result deleted</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Result was deleted!</b>
                        </h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <!-- delete confirm -->
    <div id="dialog-confirm" title="Delete result?" style="display: none">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This result will be permanently deleted and cannot be recovered. Are you sure?</p>
    </div>

@stop

@section('foot')
    @parent
    <script type="text/javascript" src="{{ URL::asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}"></script>
    <script src="{{ URL::asset('admin/js/resulteditor.js') }}"></script>
    <script src="{{ URL::asset('admin/js/result-editor-actions.js') }}"></script>
    <script src="{{ URL::asset('admin/js/delete-result.js') }}"></script>
    <script src="{{ URL::asset('admin/responsivetext/flowtype.js') }}"></script>

    @include('layouts.admin.create.combinedScript')
@stop