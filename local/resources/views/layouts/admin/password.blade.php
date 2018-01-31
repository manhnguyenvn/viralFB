@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
@stop

@section('content')
    <div class="admin-container">
        <div class="panel panel-primary">
            <div class="panel-heading panou-titlu">
                <i class="fa fa-fw fa-key"></i> Change Admin Username/Password
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => 'dashboard/password/save']) !!}
                <div class="form-group">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('passwordrepeat', 'Repeat Password') !!}
                    {!! Form::password('passwordrepeat', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Save settings', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
                {!! Form::close() !!}
                @if(session()->has('message'))
                    <br>
                    <div class="alert alert-success">
                        <b>{{ session()->get('message') }}</b>
                    </div>
                @endif
                @if ($errors->has())
                    <br>
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                           <b> {{ $error }}</b><br>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
    @stop