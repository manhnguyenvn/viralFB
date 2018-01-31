@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>

@stop
@section('content')
    <div class="admin-container">
        <div class="panel panel-primary">
            <div class="panel-heading panou-titlu">
                <i class="fa fa-globe" aria-hidden="true"></i> Languages
            </div>
            <div class="panel-body">
                <button id="addlang" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add new
                    language
                </button>

                <br><br>

                <div id="accordion-lang">

                    <div class="acc">English</div>
                    <div>
                        <div id="language1" class="language">
                            <br>

                            <div class="row" style="pointer-events: none">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Language name') !!}
                                        {!! Form::text('name', isset($english['name']) ? $english['name'] : 'English', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('code', 'Language code') !!}
                                        {!! Form::text('code', isset($english['code']) ? $english['code'] : 'en', ['class' => 'form-control', 'id' => 'code']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                {!! Form::label('login', '"FB Login" button - start generation of result') !!}
                                {!! Form::text('login', isset($english['login']) ? $english['login'] : 'Login with FB & see your result', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('share', '"Share on Facebook" button - after generation of result') !!}
                                {!! Form::text('share', isset($english['share']) ? $english['share'] : 'Share on Facebook', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tryagain', '"Try again" button - after generation of result') !!}
                                {!! Form::text('tryagain', isset($english['tryagain']) ? $english['tryagain'] : 'Try again', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('findmedia', '"Find out your result" button - in shared pages') !!}
                                {!! Form::text('findmedia', isset($english['findmedia']) ? $english['findmedia'] : 'Find out your result', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('latestapp', '"Latest app" text - in homepage') !!}
                                {!! Form::text('latestapp', isset($english['latestapp']) ? $english['latestapp'] : 'Latest app', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('letsdoit', '"Let\'s do it! " button - in homepage & new apps') !!}
                                {!! Form::text('letsdoit', isset($english['letsdoit']) ? $english['letsdoit'] : 'Let\'s do it!', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('generating', '"Generating result" - text') !!}
                                {!! Form::text('generating', isset($english['generating']) ? $english['generating'] : 'Generating result..', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('moreapps', '"Loading more apps" - text') !!}
                                {!! Form::text('moreapps', isset($english['moreapps']) ? $english['moreapps'] : 'Loading more apps..', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('backtop', '"Back to top" - in footer bar') !!}
                                {!! Form::text('backtop', isset($english['backtop']) ? $english['backtop'] : 'Back to top', ['class' => 'form-control']) !!}
                            </div>

                            <button class="save-new-lang btn btn-success pull-left"><b>Save language</b></button>
                        </div>
                    </div>

                    <div id="new-lang" style="display: none">
                        <div class="new-lang-name acc"><span>New Language</span></div>
                        <div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Language name (eg: English, French ...)') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('code', 'Language code (eg: en, fr ...)') !!}
                                        {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                {!! Form::label('login', '"FB Login" button - start generation of result') !!}
                                {!! Form::text('login', 'Login with FB & see your result', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('share', '"Share on Facebook" button - after generation of result') !!}
                                {!! Form::text('share', 'Share on Facebook', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tryagain', '"Try again" button - after generation of result') !!}
                                {!! Form::text('tryagain', 'Try again', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('findmedia', '"Find out your result" button - in shared pages') !!}
                                {!! Form::text('findmedia', 'Find out your result', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('latestapp', '"Latest app" text - in homepage') !!}
                                {!! Form::text('latestapp', 'Latest app', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('letsdoit', '"Let\'s do it! " button - in homepage & new apps') !!}
                                {!! Form::text('letsdoit', 'Let\'s do it!', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('generating', '"Generating result" - text') !!}
                                {!! Form::text('generating', 'Generating result..', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('moreapps', '"Load more apps" - text') !!}
                                {!! Form::text('moreapps', 'Load more apps..', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('backtop', '"Back to top" - in footer bar') !!}
                                {!! Form::text('backtop', 'Back to top', ['class' => 'form-control']) !!}
                            </div>

                            <div class="new-lang-buttons"></div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="alert alert-success">
                    <h4><b>Currently used language: <i><span id="active-name">{{ $activename }}</span></i></b></h4>
                    {!! Form::open(['id' => 'active-language']) !!}
                    <div class="form-group">
                        {!! Form::label('active-lang', 'Change site language:') !!}
                        {!! Form::select('active-lang', array('en' => 'English'), isset($active) ? $active : 'en', array('class' => 'form-control', 'id' => 'active-lang')) !!}
                    </div>
                    {!! Form::hidden('allvalues', null) !!}
                    {!! Form::close() !!}

                </div>


                <button id="savelang" class="btn-lg btn-success"><b><i class="fa fa-floppy-o"
                                                                       aria-hidden="true"></i> Save settings</b>
                </button>
                <div id="mesaj"></div>

                <div id="arata"></div>

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Languages saved</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Languages settings saved successfully!</b>
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
    <div id="script-adaugat"></div>


    <script>
        $(function () {
            @foreach($languages as $language)
                   var option = $('<option value="{{ $language['code'] }}">{{ $language['name'] }}</option>');
            $('#active-lang').append(option);
            @endforeach
            $('#active-lang').val('{{ $active }}');


            $("#accordion-lang").accordion({
                heightStyle: "content",
                header: ".acc"
            });
            var newlang = $("#new-lang").html(),
                accordionlang = $('#accordion-lang');


         @foreach($languages as $language)
            var length = $('.language').length;
            var i = length + 1;
            accordionlang.append('<div id="language' + i + '" class="language new-lang">' + newlang + '</div>');
            $('#language'+ i +' .new-lang-buttons').append('<button class="save-new-lang btn btn-success pull-left"><b>Save language</b></button><button id="delete'+ i +'" class="delete-lang btn btn-danger pull-right"><b><i class="fa fa-trash-o" aria-hidden="true"></i> Delete language</b></button>');

            $('#language'+ i +' span').html('{{ $language['name'] }}');
            $('#language'+ i +' [name="name"]').val($("<div>").html("{{ $language['name'] }}").text());
            $('#language'+ i +' [name="code"]').val($("<div>").html("{{ $language['code'] }}").text());
            $('#language'+ i +' [name="login"]').val($("<div>").html("{{ $language['login'] }}").text());
            $('#language'+ i +' [name="share"]').val($("<div>").html("{{ $language['share'] }}").text());
            $('#language'+ i +' [name="tryagain"]').val($("<div>").html("{{ $language['tryagain'] }}").text());
            $('#language'+ i +' [name="latestapp"]').val($("<div>").html("{{ $language['latestapp'] }}").text());
            $('#language'+ i +' [name="letsdoit"]').val($("<div>").html("{{ $language['letsdoit'] }}").text());
            $('#language'+ i +' [name="generating"]').val($("<div>").html("{{ $language['generating'] }}").text());
            $('#language'+ i +' [name="moreapps"]').val($("<div>").html("{{ $language['moreapps'] }}").text());
            $('#language'+ i +' [name="findmedia"]').val($("<div>").html("{{ $language['findmedia'] }}").text());
            $('#language'+ i +' [name="backtop"]').val($("<div>").html("{{ $language['backtop'] }}").text());

            accordionlang.accordion("refresh");
            accordionlang.accordion({active: i});

            if( $('#script-adaugat').is(':empty') ) {
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.src = "{{ URL::asset('admin/js/languages.js') }}";
                $("#script-adaugat").html(s);
            }

            @endforeach
         });
    </script>

    <script src="{{ URL::asset('admin/js/languages-data.js') }}"></script>

@stop