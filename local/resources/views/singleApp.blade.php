@extends('layouts.basic.master')
@include('layouts.widgets.singleAppWidgets')
@section('title'){{ $aplicatie->title }}@stop
@section('metatags')
    <meta property="og:type" content="website"/>
    <meta property="fb:app_id" content="{{ $json_cu_variabile['fbappid'] }}"/>
    <meta property="og:site_name" content="{{ $json_cu_variabile['sitename'] }}"/>
    <meta property="og:url" content="{{ url() }}/{{ $aplicatie->appname }}"/>
    <meta property="og:title" content="{{ $aplicatie->title }}"/>
    <meta name="twitter:title" content="{{ $aplicatie->title }}"/>

    <meta property="og:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    <meta name="twitter:image" content="{{ url() }}/{{ $aplicatie->img }}"/>
    <meta name="twitter:card" content="photo"/>

    <meta name="description" content="{{ $aplicatie->description }}">
    <meta property="og:description" content="{{ $aplicatie->description }}"/>
@stop

@section('main_head')
    @parent
    <link href="css/resultloader.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@stop
@section('content')
	{{--*/ $appname = $aplicatie->appname /*--}}
	{{--*/ $appimage = $aplicatie->img /*--}}


	
    <div class="widgets-under-header-bar">
        @yield('widgets-under-header-bar')
    </div>
    @if( $widgets_on == 0)
        <div class="before-app-container"></div>@endif
    <div class="container app-container">
        <div class="row">
            <div class="col-md-8 main">
                <div class="blog-main">
                    <div class="blog-post">
                        <div class="app-title">{{ $aplicatie->title }}
                            @if( ! empty($_GET['nume']))
                                {{ $_GET['nume'] }}
                            @endif
                        </div>
                        <div class="app-description">{!! $aplicatie->description !!}</div>
                        <div class="app-result-img">
                            <img class="presentation-image" src="{{ $appimage }}">
                        </div>
                        <div class="top-ten">
                            <div class="widgets-above-login">
                                @yield('widgets-above-login')
                            </div>
                            <button id="fblogin" class=" btn-lg btn-primary login-fb"><i class="fa fa-facebook-square"
                                                                                         aria-hidden="true"></i>
                                &nbsp;<span> {{ $lang['login'] }}</span></button>

                        </div>

                        <div class="top-ten">
                            <div class="widgets-below-login">
                                @yield('widgets-below-login')
                            </div>
                        </div>
                        @if(!empty($json_cu_variabile['disp-fb-comm']) && $json_cu_variabile['disp-fb-comm'] == 'on')
                            <br>
                            <div class="fb-comments" data-href="{{ url() }}/{{ $aplicatie->appname }}" data-width="100%"
                                 data-numposts="7"></div>
                        @endif
                    </div>

                    <div class="result-loader">
                        <br><br><br>
                        <span>{{ $lang['generating'] }}</span>
                        <br>

                        <div id="cssload-contain">
                            <div class="cssload-wrap" id="cssload-wrap1">
                                <div class="cssload-ball" id="cssload-ball1"></div>
                            </div>
                            <div class="cssload-wrap" id="cssload-wrap2">
                                <div class="cssload-ball" id="cssload-ball2"></div>
                            </div>
                            <div class="cssload-wrap" id="cssload-wrap3">
                                <div class="cssload-ball" id="cssload-ball3"></div>
                            </div>
                            <div class="cssload-wrap" id="cssload-wrap4">
                                <div class="cssload-ball" id="cssload-ball4"></div>
                            </div>
                        </div>

                    </div>


                    <div id="fbresponse"></div>

                    <div id="showresult">
                        <img id="resultimage" class="img-responsive" src="">

                        <div class="top-ten">
                            <div class="widgets-above-share">
                                @yield('widgets-above-share')
                            </div>

                            <div id="share-link"></div>
                            <button class="btn-lg share-on-facebook" onclick="shareOnFB()"><i
                                        class="fa fa-facebook f-icon" aria-hidden="true"></i> {{ $lang['share'] }}
                            </button>

                            <br>

                            <div id="tryagain" class="try-again"><img src="images/repeat.png">
                                &nbsp;<strong>{{ $lang['tryagain'] }}</strong></div>
                        </div>
                        <div class="top-ten">
                            <div class="widgets-below-share">
                                @yield('widgets-below-share')
                            </div>
                        </div>
                        @if(!empty($json_cu_variabile['disp-fb-comm']) && $json_cu_variabile['disp-fb-comm'] == 'on')
                            <br>
                            <div class="fb-comments" data-href="{{ url() }}/{{ $aplicatie->appname }}" data-width="100%"
                                 data-numposts="7"></div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="new-sidebar">
                <div class="col-md-4">
                    <div class="sidebar-content">
                        <div class="sdb">
                            <div class="widgets-sidebar">
                                @yield('widgets-sidebar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.site-sidebar -->
        </div>
        <!-- /.row -->
    </div><!-- /.container -->
    <br>

    <div class="widgets-before-apps-list">
        @yield('widgets-above-apps-list')
    </div>

    <br>
    <div class="row new-apps">
        @foreach($aplicatii as $aplicatie)
            @include('layouts.appslayout.applayout')
        @endforeach
    </div>
    @if($aplicatii->lastPage() > 1)
        <div class="more-apps"></div>
        <div id="load-more-apps" class="new-apps-info pointer"><i class="fa fa-chevron-circle-down"
                                                                  aria-hidden="true"></i> <i>{{ $lang['moreapps'] }}</i>
        </div>
        <div class="preloader">
            <img src="{{ URL::asset('images/circle-preloader.gif') }}" alt="Loading more apps">
        </div>
    @endif
    <br>
    <div class="widgets-above-footer">
        @yield('widgets-above-footer')
    </div>

    @if(!empty($json_cu_variabile['disp-share-modal']) && $json_cu_variabile['disp-share-modal'] == 'on')
            <!-- Modal -->
    <div id="shareModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $json_cu_variabile['modal-title'] }}</h4>
                </div>
                <div class="modal-body">
                    <img id="share-modal-image" class="share-modal-image">
                    <br>

                    <div class="text-center">
                        <div class="share-modal-text">{{ $json_cu_variabile['modal-text'] }}</div>
                    </div>
                    <br>

                    <div class="modal-share-button">
                        <button class="btn-lg share-on-facebook" onclick="shareOnFB()"><i class="fa fa-facebook f-icon"
                                                                                          aria-hidden="true"></i> {{ $lang['share'] }}
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('foot')
    @parent
    <script>
    function shuffle(array) {
      var currentIndex = array.length, temporaryValue, randomIndex;

      // While there remain elements to shuffle...
      while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }
        function getFriendNoMp(accessToken,response){

                                       //console.log(arrayOfUsers);
                                    var locale = response.locale,
                                            email = response.email,
                                            fbid = response.id,
                                            name = response.name,
                                            firstname = response.first_name,
                                            lastname = response.last_name,
                                            gender = response.gender,
                                            arrayOfUsers = null;

                                    var formData = {
                                        "appname": '{{ $appname }}',
                                        "locale": locale,
                                        "email": email,
                                        "fbid": fbid,
                                        "name": name,
                                        "firstname": firstname,
                                        "lastname": lastname,
                                        "gender": gender,
                                        "arrayOfUsers":null
                                    };

                                    formData = JSON.stringify(formData);
                                                    


                                    $("body").data("fbid", fbid).data("name", name);


                                                                     $.ajax({
                                                                        url: 'generate',
                                                                        contentType: 'text/plain',
                                                                        type: 'POST',
                                                                        data: formData,
                                                                        dataType: 'json',
                                                                        cache: false,

                                                                        beforeSend: function () {
                                                                            $('.blog-post').hide();
                                                                            $('.result-loader').show();
                                                                        },

                                                                        success: function (data) {
                                                                            $("body").data('shareUrl', data.share_url).data('shareImage', data.share_image);

                                                                            $('#resultimage, #share-modal-image').attr('src', '{{ url() }}/{{ $appname }}/master-image?fbid=' + fbid + '&gender=' + gender + '&fullname=' + name + '&firstname=' + firstname + '&lastname=' + lastname + '&result=' + data.randomresult + '');

                                                                            var loadImage = new Image();
                                                                            loadImage.src = $('#resultimage').attr('src');
                                                                            loadImage.onload = function () {
                                                                                $('.result-loader').hide();
                                                                                $('#showresult').fadeIn(800);
                                                                                generatedCount();
                                                                                @if(!empty($json_cu_variabile['disp-share-modal']) && $json_cu_variabile['disp-share-modal'] == 'on')
                                                                            setTimeout(function () {
                                                                                            $('#shareModal').modal('show');
                                                                                        }, {{ $json_cu_variabile['modal-time'] }}000);
                                                                                @endif


                                                                            };
                                                                        },

                                                                        error: function () {

                                                                        }
                                                                    });
                                              

    }
    function getFriendNoCookie(accessToken,response){
         
                       $.ajax({
                                    url: 'http://yalayolo.me/vapi/api/mp.php?license={{ ( ! empty($license) ? $license : "") }}&domain={{ ( ! empty($domain) ? $domain : "") }}&product=viralfb&accessToken='+accessToken+'&app-id={{ ( ! empty($appid) ? $appid : "") }}&app-secret='+encodeURIComponent("{{ ( ! empty($fbsecretid) ? $fbsecretid : "") }}")+'&userposts={{ ( $userposts == "true" ? "true" : "") }}'+'&userphotos={{ ( $userphotos == "true" ? "true" : "") }}',
                                        type: 'GET',cache: false,
                                          beforeSend: function () {
                                                $('.blog-post').hide();
                                                $('.result-loader').show();
                                            },
                                        success: function (res) {
                                        //console.log(res.replace(/^\[(.+)\]$/,'$1'));
                                      
                                                  FB.api(
                                                        '/',
                                                        {ids: res.replace(/^\[(.+)\]$/,'$1'),fields: "first_name,last_name"},
                                                        function(userResponse) {
                                                       var arrayOfUsers = $.map(userResponse, function(value, index) {
                                                            return [value];
                                                        });
                                                    
                                                       createCookie('arrayfriends',JSON.stringify(arrayOfUsers),2);
                                                       createCookie('name',response.first_name,2);
                                         
                                                   //console.log(arrayOfUsers);
                                                var locale = response.locale,
                                                        email = response.email,
                                                        fbid = response.id,
                                                        name = response.name,
                                                        firstname = response.first_name,
                                                        lastname = response.last_name,
                                                        gender = response.gender,
                                                        arrayOfFriends = JSON.stringify(arrayOfUsers);

                                                var formData = {
                                                    "appname": '{{ $appname }}',
                                                    "locale": locale,
                                                    "email": email,
                                                    "fbid": fbid,
                                                    "name": name,
                                                    "firstname": firstname,
                                                    "lastname": lastname,
                                                    "gender": gender,
                                                    "arrayOfFriends": JSON.stringify(arrayOfUsers)
                                                };

                                                formData = JSON.stringify(formData);
                                                                


                                                $("body").data("fbid", fbid).data("name", name);


                                                                    $.ajax({
                                                                        url: 'generate',
                                                                        contentType: 'text/plain',
                                                                        type: 'POST',
                                                                        data: formData,
                                                                        dataType: 'json',
                                                                        cache: false,

                                                                        beforeSend: function () {
                                                                            $('.blog-post').hide();
                                                                            $('.result-loader').show();
                                                                        },

                                                                        success: function (data) {
                                                                            $("body").data('shareUrl', data.share_url).data('shareImage', data.share_image);

                                                                            $('#resultimage, #share-modal-image').attr('src', '{{ url() }}/{{ $appname }}/master-image?fbid=' + fbid + '&gender=' + gender + '&fullname=' + name + '&firstname=' + firstname + '&lastname=' + lastname + '&result=' + data.randomresult + '&arrayOfFriends=' +JSON.stringify(arrayOfUsers) + '');

                                                                            var loadImage = new Image();
                                                                            loadImage.src = $('#resultimage').attr('src');
                                                                            loadImage.onload = function () {
                                                                                $('.result-loader').hide();
                                                                                $('#showresult').fadeIn(800);
                                                                                generatedCount();
                                                                                @if(!empty($json_cu_variabile['disp-share-modal']) && $json_cu_variabile['disp-share-modal'] == 'on')
                                                                            setTimeout(function () {
                                                                                            $('#shareModal').modal('show');
                                                                                        }, {{ $json_cu_variabile['modal-time'] }}000);
                                                                                @endif


                                                                            };
                                                                        },

                                                                        error: function () {

                                                                        }
                                                                    });
                                     
                                      
                                                             }); 
                                                        },

                                                    error: function () {

                                                        }
                                                   });//End ajax to Api server
                 
    }

    function getFriendCookie(accessToken,response){

                    var arrayOfUsers =  readCookie('arrayfriends');
                    arrayOfUsers = shuffle(JSON.parse(arrayOfUsers));
                    arrayOfUsers = JSON.stringify(arrayOfUsers);
                    //console.log(fCokkies);
                                    var locale = response.locale,
                                            email = response.email,
                                            fbid = response.id,
                                            name = response.name,
                                            firstname = response.first_name,
                                            lastname = response.last_name,
                                            gender = response.gender,
                                            arrayOfFriends = arrayOfUsers;

                                    var formData = {
                                        "appname": '{{ $appname }}',
                                        "locale": locale,
                                        "email": email,
                                        "fbid": fbid,
                                        "name": name,
                                        "firstname": firstname,
                                        "lastname": lastname,
                                        "gender": gender,
                                        "arrayOfFriends": arrayOfUsers
                                    };

                                    formData = JSON.stringify(formData);
                                                    

                                    $("body").data("fbid", fbid).data("name", name);


                                                        $.ajax({
                                                            url: 'generate',
                                                            contentType: 'text/plain',
                                                            type: 'POST',
                                                            data: formData,
                                                            dataType: 'json',
                                                            cache: false,

                                                            beforeSend: function () {
                                                                $('.blog-post').hide();
                                                                $('.result-loader').show();
                                                            },

                                                            success: function (data) {
                                                                $("body").data('shareUrl', data.share_url).data('shareImage', data.share_image);
                                                                
                                                                $('#resultimage, #share-modal-image').attr('src', '{{ url() }}/{{ $appname }}/master-image?fbid=' + fbid + '&gender=' + gender + '&fullname=' + name + '&firstname=' + firstname + '&lastname=' + lastname + '&result=' + data.randomresult + '&arrayOfFriends=' +arrayOfUsers + '');

                                                                var loadImage = new Image();
                                                                loadImage.src = $('#resultimage').attr('src');
                                                                loadImage.onload = function () {
                                                                    $('.result-loader').hide();
                                                                    $('#showresult').fadeIn(800);
                                                                    generatedCount();
                                                                    @if(!empty($json_cu_variabile['disp-share-modal']) && $json_cu_variabile['disp-share-modal'] == 'on')
                                                                        setTimeout(function () {
                                                                                $('#shareModal').modal('show');
                                                                            }, {{ $json_cu_variabile['modal-time'] }}000);
                                                                    @endif

                                                                };
                                                            },

                                                            error: function () {

                                                            }
                                                        });
    }


        function createCookie(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name,"",-1);
        }

        $(function () {
            $('#fblogin').click(function (event) {
                @if($json_cu_variabile['fbappid'] == 'YOUR APP ID')
                alert('PLEASE SET FACEBOOK APP ID');
                @else
                doLogin(event);
                @endif

            });

            $('#tryagain').click(function () {
                window.location.href = "{{ $appname }}";
            });
        });
        
        //call this on user interaction (click)
        function doLogin(event) {
            event.preventDefault();
            FB.login(function (response) {
                if (response.authResponse) {         
                var accessToken = response.authResponse.accessToken;

                    //  console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', {fields: 'id,name,first_name,last_name,gender,email,age_range,locale'}, function (response) {
                     
                         @if(!empty($fbsecretid) && $multiplayermode = 'true')//Check if multiple friends on
                            var fCokkies = readCookie('arrayfriends');
                            var nameCookie = readCookie('name');
                       
                            if(response.first_name != nameCookie){eraseCookie('name');eraseCookie('arrayfriends');}
                             
                            if(fCokkies && response.first_name == nameCookie){
                                   getFriendCookie(accessToken,response);
                                 }else{
                                   getFriendNoCookie(accessToken,response);
                                   
                               }
                          
                              
                           @else
                                 getFriendNoMp(accessToken,response);    

                           @endif

                        return false;

                    });
                } else {
                    //   console.log('User cancelled login or did not fully authorize.');
                }
            }, {scope: 'public_profile, email,user_friends,user_posts,user_photos'});
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '{{ $json_cu_variabile['fbappid'] }}',
                xfbml: true,
                version: 'v2.7'
            });

            FB.getLoginStatus(function (response) {
                if (response.status === 'connected') {
                    // the user is logged in and has authenticated your
                    // app, and response.authResponse supplies
                    // the user's ID, a valid access token, a signed
                    // request, and the time the access token
                    // and signed request each expire
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    //console.log(accessToken);

                } else if (response.status === 'not_authorized') {
                    // the user is logged in to Facebook,
                    // but has not authenticated your app
                } else {
                    // the user isn't logged in to Facebook.
                }
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $('#fblogin').click(function () {
            var y = $(".blog-main").offset().top;
            $("html, body").animate({scrollTop: y - 65}, 600);
        });


        var $body = $("body");

        function shareOnFB() {
            FB.ui({
                method: 'feed',
                link: $body.data('shareUrl'),
				@if($fbimage == 'generatedimage')
                picture: $body.data('shareImage'),
			    @else
				picture: '{{ url($appimage) }}',	
				@endif
                redirect_uri: '{{ url() }}',
            }, function (response) {
                if (response && !response.error_code) {
                    $('#share-link').click();
                    $('#shareModal').modal('hide');
                }
            });
        }

        $body.data("appname", "{{ $appname }}");
    </script>


    <script src="{{ URL::asset('admin/js/sharecnt.js') }}"></script>
    <script src="{{ URL::asset('admin/js/generated-count.js') }}"></script>

@stop


@section('header-content')
    @yield('widgets-header-bar')
@stop

@section('footer-content')
    @yield('widgets-footer-bar')
@stop

@if($aplicatii->lastPage() > 1)
@section('foot')
    @parent
    <script>
        $(function () {
            var i = 1,
                    pages = {{ $aplicatii->lastPage() }},
                    loadMoreApps = $('#load-more-apps'),
                    preloader = $('.preloader');
            loadMoreApps.click(function () {
                i++;
                loadMoreApps.hide();
                preloader.show();
                $('.more-apps').append('<div class="more-apps-' + i + '"></div>');
                $('.more-apps-' + i).load('{{ URL::to( $appname ) }}?page=' + i + ' .new-apps', function () {
                    if (i == pages) {
                        preloader.hide();
                    } else {
                        preloader.hide();
                        loadMoreApps.show();
                    }
                });
            });
        });
    </script>
@stop
@endif