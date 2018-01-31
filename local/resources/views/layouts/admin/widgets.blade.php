@extends('layouts.admin.boardTemplate')
@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/css/admin.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <style>
        .sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .sortable li {
            margin-top: 10px;
            border-radius: 5px;
        }

        .sortable .wtitle {
            padding: 0.4em;
            padding-left: 1.5em;
            font-size: 1.4em;
            height: 50px;
            cursor: move;
        }

        .sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }

        .wcontent {
            background-color: #fff;
            border-top: 1px solid #a3a3a3;
        }

        .wbtn {
            margin: 10px;
        }

        .active-btn {
            margin-left: 10px;
            margin-bottom: 10px;;
        }

        .widget-title {
            padding: 10px;
        }

        .active-buttons {
            padding-left: 10px;
            padding-right: 10px;;
        }

        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }
    </style>
@stop
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading panou-titlu"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Widgets</div>
        <div class="panel-body">

            <div class="header-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Header bar widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('header')" class="btn btn-warning"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Add new widget
                                </button>
                                <br>
                                <ul id="sortable-header" class="wpos sortable" wpos="header">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/header-widget.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="under-header-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Below the header bar widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('under-header')" class="btn btn-warning"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Add new widget
                                </button>
                                <br>
                                <ul id="sortable-under-header" class="wpos sortable" wpos="under-header">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/below-header.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="sidebar-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Sidebar widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('sidebar')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                     aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-sidebar" class="wpos sortable" wpos="sidebar">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/sidebar-widget.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="above-login-share-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Above the login/share button widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('above-login-share')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                               aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-above-login-share" class="wpos sortable" wpos="above-login-share">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/above-login-button.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="below-login-share-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Below the login/share button widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('below-login-share')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                               aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-below-login-share" class="wpos sortable" wpos="below-login-share">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/below-login-button.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="before-apps-list-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Above the apps list widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('before-apps-list')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                              aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-before-apps-list" class="wpos sortable" wpos="before-apps-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/above-apps-list.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="above-footer-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Above the footer bar widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('above-footer')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                          aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-above-footer" class="wpos sortable" wpos="above-footer">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/above-footer-bar.jpg') }}">
                    </div>
                </div>
            </div>

            <hr class="style-two">

            <div class="footer-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Footer bar widgets</b></div>
                            <div class="panel-body">
                                <button onclick="appendWidget('footer')" class="btn btn-warning"><i class="fa fa-plus"
                                                                                                          aria-hidden="true"></i>
                                    Add new widget
                                </button>
                                <br>
                                <ul id="sortable-footer" class="wpos sortable" wpos="footer">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center"><b>Widget will be here:</b></div>
                        <img class="img-responsive" src="{{ URL::asset('images/widgets-images/footer-bar.jpg') }}">
                    </div>
                </div>
            </div>


            <hr class="style-two">

            <button id="save-all" class="btn-lg btn-success">Save widgets settings</button>

        </div>
    </div>

    <!-- Widget template -->
    <div id="wtemplate" style="display: none">

        <div class="wtitle">
            <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><b class="widgettitle"></b>
            <button class="wedit btn btn-default pull-right"><i class="fa fa-pencil"
                                                                aria-hidden="true"></i> Edit
            </button>
        </div>
        <div class="wcontent" style="display: none;">
            <div class="widget-title form-group">
                {!! Form::label('widgettitle', 'Widget Title'); !!}
                {!! Form::text('widgettitle', null , ['class' => ' form-control']) !!}
                <small>By default widget title is not displayed to users ( it's only for
                    identification).
                    <br>
                    If you want to display widget title in site, switch "Display title" to
                    ON.
                </small>
                <div class="pull-right">
                    <b>Display title:</b>
                    <input class="disp-title" type="checkbox" data-toggle="toggle">
                </div>
            </div>

            <p><b>&nbsp;&nbsp; Content</b></p>
            <textarea id="wtext" class="tinyMCE"></textarea>
            <br>


            <div class="active-buttons row">
                <div class="col-md-6">
                    <div class="active-app-pages-btn">
                        <b class="active-apps-txt">Active on App pages:</b>
                        <input class="active-apps-imp" type="checkbox" checked data-toggle="toggle" data-on="YES"
                               data-off="NO" data-onstyle="info" data-offstyle="danger"
                               data-style="ios">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="active-home-page-btn">
                        <b class="active-home-txt">Active on Homepage:</b>
                        <input class="active-home-imp" type="checkbox" data-toggle="toggle" data-on="YES"
                               data-off="NO" data-onstyle="info" data-offstyle="danger"
                               data-style="ios">
                    </div>
                </div>
            </div>
            <br>


            <button class="wsave wbtn btn btn-success" onclick="saveWidget()"><i class="fa fa-hdd-o"
                                                          aria-hidden="true"></i> Save
                widget
            </button>
            <button class="wdelete wbtn btn btn-danger"><i class="fa fa-trash-o"
                                                           aria-hidden="true"></i> Delete
            </button>
            <button class="wexit wbtn btn btn-default pull-right"><i
                        class="fa fa-times" aria-hidden="true"></i> Exit
            </button>
            <br>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Widgets saved</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <h4>
                            <b>Widgets settings saved successfully!</b>
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
    <link href="{{ URL::asset('admin/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('admin/js/save-widgets.js') }}"></script>
    <script src="{{ URL::asset('admin/tinymce/tinymce.min.js') }}"></script>
    <div id="tinymce"></div>
    <div id="script-adaugat"></div>
    <div id="boostrap-toogle"></div>

    <script>
        //tinymce
        function addTinymce(taid) {
            tinymce.init({
                mode: "none",
                force_br_newlines: false,
                force_p_newlines: false,
                forced_root_block: '',
                menubar: false,
                selector: '#textarea' + taid,
                height: 300,
                theme: 'modern',
                cleanup : false,
                verify_html : false,



                relative_urls : false,
                remove_script_host : true,
                convert_urls : false,
                document_base_url : "{{ url() }}/",

                remove_trailing_brs: false,
                plugins: [
                    'advlist autolink lists link image charmap preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools toc'
                ],
                toolbar1: 'undo redo | insert | formatselect | fontselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | code ',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                file_browser_callback : elFinderBrowser

            });

        }


        function elFinderBrowser (field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '<?= route('elfinder.tinymce4') ?>',
                title: 'Choose an image',
                width: 900,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
        }

        var wtemplate = $('#wtemplate').html();
        var i = 0;
        function appendWidget(wselector) {
            i++;
            $('#sortable-' + wselector).append('<li id="widget' + i + '" wposition="' + wselector + '" class="widget widget-' + wselector + ' ui-state-default">' + wtemplate + '</li>');
            var widgetnr = '#widget' + i;
            $(widgetnr + ' .widgettitle').html('New widget ');
            $(widgetnr + ' textarea').attr('id', 'textarea' + i).addClass('textarea' + i);
            if (wselector == 'sidebar') {
                $(widgetnr + ' .active-home-page-btn').hide();
                // $(widgetnr +' .active-buttons').removeClass('row');
            }
            if(wselector == 'above-login-share'){
                $(widgetnr + ' .active-home-txt').html('Active above Share button:');
                $(widgetnr + ' .active-apps-txt').html('Active above Login button:');
            }
            if(wselector == 'below-login-share'){
                $(widgetnr + ' .active-home-txt').html('Active below Share button:');
                $(widgetnr + ' .active-apps-txt').html('Active below Login button:');
            }

            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "{{ URL::asset('admin/js/widget.js') }}";
            $("#script-adaugat").html(s);

            $(widgetnr + ' .wedit').click();
            addTinymce(i);
        }

        function saveWidget(){
            $('#save-all').click();
        }

        //add widgets from db
        $(function () {
            @foreach(array_keys($allwidgets) as $position)
               @foreach(array_keys($allwidgets[$position]) as $widgetkey)
               {{--*/ $widget = $allwidgets[$position][$widgetkey]; /*--}}
               i++;
            addTinymce(i);

            $('#sortable-' + '{{ $position }}').append('<li id="widget' + i + '" wposition="{{ $position }}" class="widget widget-{{ $position }} ui-state-default">' + wtemplate + '</li>');
            $('#widget' + i + ' .widgettitle').html('{{ $widget['wtitle'] }}');

            {{--*/ $content = json_encode($widget['wcontent']);  /*--}}
            var wcontent = {!! $content !!};

            $('#widget' + i + ' textarea').attr('id', 'textarea' + i).addClass('textarea' + i).text(wcontent);
            if ('{{ $position }}' == 'sidebar') {
                $('#widget' + i + ' .active-home-page-btn').hide();
            }
            if('{{ $position }}' == 'above-login-share'){
                $('#widget' + i + ' .active-home-txt').html('Active above Share button:');
                $('#widget' + i + ' .active-apps-txt').html('Active above Login button:');
            }
            if('{{ $position }}' == 'below-login-share'){
                $('#widget' + i + ' .active-home-txt').html('Active below Share button:');
                $('#widget' + i + ' .active-apps-txt').html('Active below Login button:');
            }

            $('#widget' + i + ' #widgettitle').val($("<div>").html("{{ $widget['wtitle'] }}").text());

            var wtitledisplay = '{{ $widget['wtitledisplay'] }}';
            if (wtitledisplay == 'on') {
                $('#widget' + i + ' .disp-title').attr('checked', '');
            } else {
                $('#widget' + i + ' .disp-title').removeAttr('checked');
            }
            var activeapps = '{{ $widget['activeapps'] }}';
            if (activeapps == 'on') {
                $('#widget' + i + ' .active-apps-imp').attr('checked', '');
            } else {
                $('#widget' + i + ' .active-apps-imp').removeAttr('checked');
            }
            var activehome = '{{ $widget['activehome'] }}';
            if (activehome == 'on') {
                $('#widget' + i + ' .active-home-imp').attr('checked', '');
            } else {
                $('#widget' + i + ' .active-home-imp').removeAttr('checked');
            }


                    @endforeach
               @endforeach

            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "{{ URL::asset('admin/js/widget.js') }}";
            $("#script-adaugat").html(s);

        });
    </script>


@stop