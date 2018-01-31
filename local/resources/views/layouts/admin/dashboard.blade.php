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
            <i class="fa fa-tachometer"></i> Dashboard
        </div>
        <div class="panel-body">
            <div class="panel panel-primary">
                <div class="panel-heading" ><b><i class="fa fa-bullhorn"></i> News from ViralFB</b></div>
                <div class="panel-body dgreybg">
            
                  <div class="col-xs-12 col-md-12 col-lg-12">
                         <div class="alert alert-info" style="font-weight: bold;font-size:16px;color:black;">
                           {{ $news }}
                        </div>
                  </div>
               
      

                </div>
            </div>
    <div class="panel panel-primary" id="useractivation">
                <div class="panel-heading" style="@if ( empty($secretkeyapp) )background:red;@else background:green; @endif"><b><i class="glyphicon glyphicon-user"></i>@if ( empty($secretkeyapp) ) First use,please activate the app using your purchase code from codecanyon/ffscripts(if you stuck please contact <a href="https://codecanyon.net/user/ffscripts" target="_blank">support</a>):@else License key is activated @endif</b></div>
                <div class="panel-body dgreybg">
                @if ( !empty($secretkeyapp) )
                  <div class="col-xs-12 col-md-12 col-lg-12">
                         <div class="alert alert-success" style="font-weight: bold;font-size:16px;color:black;">
                         Thanks you! the license key: "{{ $secretkeyapp }}" is activated.
                         (key can be activated only once if you want to change domain please contact at yaleyolosup@gmail.com. soon will be update to allow change keys.)
                        </div>
                  </div>
                @else

                 <div class="col-xs-12 col-md-6 col-lg-6">
                   <h3>Please note if you purchased from FFscripts.com you not need token only license.</h3>
                    How to get token & activate app? <b>(2 minutes)</b>
                    <br>
                    1.Go to this link to create token: <a href="https://build.envato.com/create-token/" target="_blank">Click Here</a><br>
                    2.Login to your envato account <b>if needed</b> and under the ‘Permissions Needed’ section, make sure the following checkboxes are checked:<br>
                    <div>
                    <img data-toggle="modal" data-target="#imagepopup" id="openimg" src="{{ URL::asset('files/v5_personaltoken_checkbox.jpg') }}" style="max-width:100px;cursor: pointer;"/>
                    (Click on image for bigger image)
                    </div>
                    3.Check the ‘Terms and Conditions’ checkbox, then click ‘Create Token’. You’ll now see the ‘Success!’ page with your Personal Token displayed.
                    <br>
                    4.Copy and save your Personal Token to a safe place and copy and paste the Personal Token into the provided field named Token*. <br>
                    5.Click activate app and Done! <br>
                    <b>If everything correct this box will be hided and you will have full updates and latest version.</b>
                  </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                           
                                {!! Form::open(['id' => 'activateapp']) !!}
                                         
                                                {!! Form::label('secretkeyapp', 'Your purchase code*(Get from codecanyon/ffscripts):') !!}
                                                {!! Form::text('secretkeyapp', $secretkeyapp, ['class' => 'form-control', 'id' => 'secretkeyapp',
                                                'name' => 'secretkeyapp']) !!}
                                                {!! Form::label('tokenapp', 'Personal Token(Only if you bought from codecanyon):') !!}
                                                {!! Form::text('tokenapp', $tokenapp, ['class' => 'form-control', 'id' => 'tokenapp',
                                                'name' => 'tokenapp']) !!}

                                               <br>
                                              {!! Form::submit('Activate APP', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
                                               {!! Form::close() !!}
                      <br>
                       <div class="alert alert-danger" style="display:none;">
                        </div>
                         <div class="alert alert-success" style="display:none;">
                        </div>
                                           
                    </div>

                @endif
      

                </div>
            </div>

    <div class="panel panel-primary">
                <div class="panel-heading" style="background:#5cb85c;"><b><i class="glyphicon glyphicon-home"></i> Installed version:{{ $version['version-name'] }} - Latest version:ViralFB v{{ $latestversion }}</b></div>
                <div class="panel-body dgreybg">

                    <div class="col-xs-12 col-md-6 col-lg-6">
                     <a href="http://yalayolo.me/documentation/docs.html" target="_blank">
                        <div class="dpanel dpanel-blue dpanel-widget brd brd-blue">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-book"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">Documentation</div>
                                    <div class="text-muted">Please read!</div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <a href="https://codecanyon.net/user/ffscripts" target="_blank">
                        <div class="dpanel dpanel-orange dpanel-widget brd brd-orange">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-exclamation-sign"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">Support</div>
                                    <div class="text-muted">Upto 1 bussines day (yaleyolosup@gmail.com)</div>
                                </div>
                            </div>
                        </div>
                       </a>
                    </div>


                </div>
            </div>
            <!-- General stats -->
            <div class="panel panel-primary">
                <div class="panel-heading transp-blue"><b><i class="glyphicon glyphicon-equalizer"></i> General
                        stats</b></div>
                <div class="panel-body dgreybg">

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-blue dpanel-widget brd brd-blue">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-user"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $total_fb_users }}</div>
                                    <div class="text-muted">Total Users</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-orange dpanel-widget brd brd-orange">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-th-large"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $total_apps }}</div>
                                    <div class="text-muted">Total Apps</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-teal dpanel-widget brd brd-teal">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-expand"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $generated_total }}</div>
                                    <div class="text-muted generated-text">Generated results</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-red dpanel-widget brd brd-red">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-send"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $total_shares }}</div>
                                    <div class="text-muted">FB Shares</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Today stats -->
            <div class="panel panel-primary">
                <div class="panel-heading transp-blue"><b><i class="glyphicon glyphicon-equalizer"></i> Today's
                        stats</b></div>
                <div class="panel-body dgreybg">

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-blue dpanel-widget brd brd-blue">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-user"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $today_fb_users }}</div>
                                    <div class="text-muted">New Users</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-orange dpanel-widget brd brd-orange">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-th-large"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $today_apps }}</div>
                                    <div class="text-muted">New Apps</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-teal dpanel-widget brd brd-teal">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-expand"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $generated_today }}</div>
                                    <div class="text-muted generated-text">Generated results</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <div class="dpanel dpanel-red dpanel-widget brd brd-red">
                            <div class="row no-padding">
                                <div class="col-sm-3 col-lg-5 widget-left">
                                    <div class="picon"><i class="glyphicon glyphicon-send"></i></div>
                                </div>
                                <div class="col-sm-9 col-lg-7 widget-right">
                                    <div class="large">{{ $today_shares }}</div>
                                    <div class="text-muted">FB Shares</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <!--Application shares -->
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading transp-blue"><i class="glyphicon glyphicon-send"></i><b> Application
                                FB Shares</b></div>
                        <div class="panel-body">
                            @if($total_shares == 0)
                                <div class="alert alert-danger"><b>No shares registered</b></div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Application</th>
                                            <th>Shares</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($shares as $share)
                                            @if(!empty($share['title']))
                                                <tr class="active">
                                                    <td><img src="{{ $share['img'] }}" width="80" height="50"></td>
                                                    <td>
                                                        <div class="shares-title"><a href="{{ url($share['name']) }}"
                                                                                     target="_blank"><b>{{ $share['title'] }}</b></a>
                                                        </div>
                                                    </td>
                                                    <td><b>{{ $share['shares'] }}</b> <i style="color: #3B5998"
                                                                                         class="glyphicon glyphicon-send"></i>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pull-right">{!! str_replace('/?', '?', $shares_data->render()) !!}</div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Recent activity -->
                    <div class="panel panel-primary">
                        <div class="panel-heading transp-blue"><b><i class="glyphicon glyphicon-time"></i> Recent
                                activity</b></div>
                        <div class="panel-body">
                            <div class="activity">
                                @if(count($activities) == 0)
                                    <div class="alert alert-danger"><b>No recent activity</b></div>
                                @else
                                    @foreach($activities as $activity)
                                        @if(!empty($activity['img']))
                                            <div class="row activity-layer">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <a href="http://facebook.com/{{ $activity['fbid'] }}"
                                                               target="_blank"><img class="fb-round"
                                                                                    src="http://graph.facebook.com/{{ $activity['fbid'] }}/picture?width=900"
                                                                                    width="60" height="60"></a>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <b>{{ $activity['name'] }}</b>
                                                            <br>
                                                            @if($activity['action'] == 'share')
                                                                <div class="shared-bg"> Shared app <i
                                                                            class="glyphicon glyphicon-send"></i></div>
                                                            @elseif($activity['action'] == 'tried')
                                                                <div class="tried-bg"> Tried app <i
                                                                            class="glyphicon glyphicon-ok"></i></div>
                                                            @endif
                                                            <br>

                                                            <div class="activity-date"><i>on {{ $activity['date'] }}</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ url( $activity['appname'] ) }}" target="_blank"><img
                                                                src="{{ $activity['img'] }}" width="120"
                                                                height="70"></a>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Facebook users -->
            <div class="panel panel-primary">
                <div class="panel-heading transp-blue">
                    <b><i class="glyphicon glyphicon-user"></i> Facebook users</b>

                    <div class="pull-right">Total: {{ $total_fb_users }}</div>
                </div>
                <div class="panel-body">
                    @if(count($fbusers) == 0)
                        <div class="alert alert-danger"><b>No facebook users registered</b></div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                <tr>
                                    <th>Profile Pic</th>
                                    <th>Full user name</th>
                                    <th>Email</th>
                                    <th>Facebook ID</th>
                                    <th>Gender</th>
                                    <th>Registered on</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fbusers as $fbuser)
                                    <tr class="active">
                                        <td class="col-md-1"><a href="http://facebook.com/{{ $fbuser->fbid }}"
                                                                target="_blank"><img class="fb-round"
                                                                                     src="http://graph.facebook.com/{{ $fbuser->fbid }}/picture?width=900"
                                                                                     width="50" height="50"></a></td>
                                        <td><a href="http://facebook.com/{{ $fbuser->fbid }}"
                                               target="_blank"><b>{{ $fbuser->fullname }}</b></a></td>
                                        <td>{{ $fbuser->email }}</td>
                                        <td>{{ $fbuser->fbid }}</td>
                                        <td>{{ $fbuser->gender }}</td>
                                        <td>{{ $fbuser->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{ URL::to('dashboard/export-emails') }}">
                                <button class="btn btn-warning"><b>Download Emails List (.csv)</b></button>
                            </a>

                            <div class="pagination pull-right">{!! str_replace('/?', '?', $fbusers->render()) !!}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
 <!-- Modal -->

    <div id="imagepopup" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Follow this image</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                       <img src="{{ URL::asset('files/v5_personaltoken_checkbox.jpg') }}" />
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