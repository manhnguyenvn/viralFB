<div class="row editor-elements">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading"><b> Actions</b></div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-9">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default image">Image</button>
                            <button type="button" class="btn btn-default fbimage">FB Image</button>
                            @if($multiplayermode == 'true' && !empty($fbsecret))  
                            <button type="button" class="btn btn-default fbfriendimage">FB Friend Pic</button>
                            @endif
                            <button type="button" class="btn btn-default text">Text</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left:-20px; background-color: #AC3C3D" type="button"
                                class="btn btn-danger layers-btn"><b>Layers</b></button>
                    </div>
                </div>
                <br>

                <div class="add-image" style="display: none">
                    <center><b>Upload an Image</b><br>

                        <div id="add-image">
                            {!! Form::open(['id' => 'image-upload', 'files' => true]) !!}
                            <img id="urca" class="pointer" style="width: 90px; height: 90px; border-radius: 10px;"
                                 src="{{ URL::asset('images/add-image-plus.png') }}"/>
                            <input type="file" name="image" id="image" style="display: none;"/>
                            {!! Form::close() !!}

                            <div id="status" style="display:none"><b><i>Uploading file</i> <i class="fa fa-spinner fa-spin"></i></b><br><br></div>
                        </div>

                    </center>
                    <center>
                        <div class="pix-bt">
                            or <br>
                        <b>Open Pixlr Editor</b><br>
                            @if(strpos(url(), 'localhost') !== false)
                                <a href="javascript:pixlr.overlay.show({image:'http://i1.imgbus.com/doimg/fcom1mon6d10028.png', type:'png', title:'App Result'});"><img
                                            class="open-pixlr pointer" style="width: 90px; height: 90px; border-radius: 10px;"
                                            src="{{ URL::asset('images/add-pixlr.jpg') }}"></a>
                                @else
                                <a href="javascript:pixlr.overlay.show({image:'{{ URL::asset('images/blank.png') }}', type:'png', title:'App Result'});"><img
                                            class="open-pixlr pointer" style="width: 90px; height: 90px; border-radius: 10px;"
                                            src="{{ URL::asset('images/add-pixlr.jpg') }}"></a>
                                @endif

                        </div>
                    </center>

                </div>
 
                <div class="add-facebook-profile" style="display: none">
                    <center><b>Add User FB Profile Picture</b><br>

                        <div><img id="fb-profile" class="pointer"
                                                  style="width:120px; height: 120px; border-radius: 10px; "
                                                  src="{{ URL::asset('images/fb-profile.jpg') }}"></div>
                        <br><br>
                        <i><b style="color: #007cff">Info: </b></i>
                        <small>
                            Fb profile picture added here will be replaced with the real Facebook profile picture of users who try app.
                        </small>
                    </center>
                </div>
                <!-- If multiple mod friends enabled & Ready -->               
                 @if($multiplayermode == 'true' && !empty($fbsecret))  
                  <div class="add-facebook-friend-profile" style="display: none">
                    <center><b>Add User Friend FB Profile Picture</b><br>

                        <div><img id="fb-friend-profile" class="pointer"
                                                  style="width:120px; height: 120px; border-radius: 10px; "
                                                  src="{{ URL::asset('images/fb-friend-profile.jpg') }}"></div>
                        <br><br>
                        <i><b style="color: #007cff">Info: </b></i>
                        <small>
                            Fb Friend profile picture added here will be replaced with the real Facebook profile picture of users who try app.
                        </small>
                         <span style="color: red;display:block;font-size: 16px;">
                            *You can maximum up to top 9 friends!
                        </span>
                    </center>
                </div>
                @endif
                <div class="add-text" style="display: none">
                    @include('layouts.admin.create.edit-text')
                </div>

                <div class="layers" style="display: none">
                    <div class="text-center"><b>Layers</b></div>
                    <div id="layers" style=" max-height:250px; overflow-y:scroll;">
                        <div id="nothing" class="alert alert-danger" style="padding: 5px;">No layers added.</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="wrapper">
            <div class="main">
                <div id="basic-image">

                    <div class="nolayers">
                        <h2>No layers added</h2>
                        @if(strpos(url(), 'localhost') !== false)
                              <a href="javascript:pixlr.overlay.show({image:'http://i1.imgbus.com/doimg/fcom1mon6d10028.png', type:'png', title:'App Result'});">
                            @else
                              <a href="javascript:pixlr.overlay.show({image:'{{ URL::asset('images/blank.png') }}', type:'png', title:'App Result'});">
                            @endif
                            <button class="open-pixlr btn-lg btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Open Pixlr Editor
                                to create design
                            </button>
                        </a>
                        <br>
                        or
                        <br>
                        Simply add Images/FB user profile picture/Text with FB user name using the left 'Actions' panel
                    </div>

                </div>
            </div>
        </div>

        <div class="clearfix"><b>Current result will be available for: &nbsp;&nbsp;</b>
            <label class="radio-inline">
                <input type="checkbox" name="male" checked><b> Male</b>
            </label>
            <label class="radio-inline">
                <input type="checkbox" name="female" checked><b> Female</b>
            </label>
        </div>

        <button id="store" result="1" class="btn-lg btn-success pull-right"><i class="fa fa-floppy-o"
                                                                               aria-hidden="true"></i> &nbsp;<b>Save as
                result <span>1</span></b></button>
        {!! Form::open(['id' => 'create-image']) !!}
        <input type="text" name="sizes" id="sizes" class="hiddenfield" value="" style="display: none;"/>
        {!! Form::close() !!}


        <div id="result"></div>
        <div id="response"></div>

        <br><br><br>

        <div class="nextstep">
            <hr class="style-two">
            <button onclick="nextStep(event)"
                    class="btn-lg btn-warning pull-right"><i class="glyphicon glyphicon-forward"></i>Go to
                next step
            </button>

        </div>

    </div>
</div>


