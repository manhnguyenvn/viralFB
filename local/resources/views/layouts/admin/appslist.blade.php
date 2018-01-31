@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@stop

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading panou-titlu"><i class="glyphicon glyphicon-eye-open"></i> Apps list</div>
        <div class="panel-body">
            <button onclick="window.location.href='{{ URL::to('dashboard/apps/create/detalies') }}'"
                    class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus"></i> Add new app
            </button>
            <div class="pull-right"><b>Total: {{ $totalapps }} Apps</b></div>
            <br>
            <br>

            <!-- Apps table -->
            @if($totalapps != 0)
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>App Title</th>
                        <th>App Url</th>
                        <th>Created at</th>
                        <th>
                            <div class="text-center"> Actions</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($apps as $app)
                        <tr id="page{{ $app->id }}" class="active">
                            <td class="col-md-2"><a href="{{ URL::to( $app->appname ) }}" target="_blank"><img
                                            src="{{ URL::asset( $app->img ) }}" width="160" height="80"></a></td>
                            <td class="col-md-4"><a href="{{ URL::to( $app->appname ) }}"
                                                    target="_blank"><b>{{ $app->title }}</b></a></td>
                            <td class="col-md-2"><i>{{ url($app->appname) }}</i></td>
                            <td class="col-md-1">{{ $app->created_at }}</td>
                            <td class="col-md-3">
                                <div class="pull-right">
                                    <button onclick="window.location.href='{{ URL::to( $app->appname ) }}'"
                                            class="btn btn-success">Visit App
                                    </button>
                                    <button onclick="window.location.href='{{ URL::to('dashboard/apps/create/detalies') }}?editid={{ $app->id }}'"
                                            class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                    </button>
                                    <button onclick="deleteapp('{{ $app->id }}', event)" class="btn btn-danger"><i
                                                class="fa fa-trash-o"
                                                aria-hidden="true"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination pull-right">{!! $apps->render() !!}</div>
            </div>
           @else
                <div class="alert alert-danger">Sorry! No apps added. To create one, click on <b>+ Add new app</b></div>
            @endif

        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">App deleted</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>App was deleted!</b>
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
    <div id="dialog-confirm" title="Delete app?" style="display: none">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This app will be
            permanently deleted and cannot be recovered. Are you sure?</p>
    </div>

@stop

@section('foot')
    @parent
    <script src="{{ URL::asset('admin/js/delete-app.js') }}"></script>
@stop