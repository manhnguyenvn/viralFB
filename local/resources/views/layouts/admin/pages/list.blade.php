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
            <div class="panel-heading panou-titlu"><i class="glyphicon glyphicon-eye-open"></i> Pages list</div>
            <div class="panel-body">
               <button onclick="window.location.href='{{ URL::to('dashboard/pages/add') }}'" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus"></i> Add new page</button>
                <br>
                <br>
                @if($totalpages != 0)
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6"><b>&nbsp;&nbsp;Page title</b></div>
                            <div class="col-md-6"><b>&nbsp;Page URL</b></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pull-right"><b>Actions&nbsp;&nbsp;</b></div>
                    </div>
                </div>
                <hr class="style-two">

            @foreach($pages as $page)
                    <div id="page{{ $page->id }}" class="alert alert-info pad4">
                       <div class="row">
                           <div class="col-md-8">
                               <div class="row">
                                   <div class="col-md-6"><b><a href="{{ URL::to('pages') }}/{{ $page->url }}" target="_blank">{{ $page->title }}</a></b></div>
                                   <div class="col-md-6"><i><a href="{{ URL::to('pages') }}/{{ $page->url }}" target="_blank">{{ url('pages/' . $page->url) }}</a></i></div>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="pull-right">
                                   <button onclick="window.location.href='{{ URL::to('dashboard/pages/add') }}?pageid={{ $page->id }}&scope=edit'" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                   <button onclick="deletepage('{{ $page->id }}', event)" class="btn btn-danger"><i class="fa fa-trash-o"
                                                                                                                    aria-hidden="true"></i> Delete</button>
                               </div>
                           </div>
                       </div>

                    </div>
                    @endforeach
                    @else
                <div class="alert alert-danger">Sorry! No pages added. To create one, click on <b>+ Add new page</b></div>
                @endif

            </div>
        </div>


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Page deleted</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <h4>
                                <b>Page was deleted!</b>
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
        <div id="dialog-confirm" title="Delete page?" style="display: none">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This page will be permanently deleted and cannot be recovered. Are you sure?</p>
        </div>

@stop

@section('foot')
    @parent
    <script src="{{ URL::asset('admin/js/page.js') }}"></script>
    @stop