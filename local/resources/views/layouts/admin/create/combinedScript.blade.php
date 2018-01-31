
<script>
  var assetsUrl = "<?php echo URL::asset('images/'); ?>";
 
    $(function () {
        var i = 0;
        var b = 0;
        var cnt = 0;
        $('body').data('numarDeLayere', 0);

        $("#fb-profile").click(function () {
            i++;
           // var numarDeLayere = $('#layers .sort').length + 1;
            var body = $('body'),
                    numarDeLayereTotal = body.data('numarDeLayere'),
                    numarDeLayere = numarDeLayereTotal + 1;
            body.data('numarDeLayere', numarDeLayere);

            $(".main").append("<div id='added-fb" + i + "' class='layer" + numarDeLayere +" resizable draggable' style='position: absolute; top:10%; left:10%; width:30%; height:55%;'><img class='appended' style='width:100%; height:100%;' src='{{ URL::asset('images/rsz_fb-profile.jpg') }}'></div> ");

            $("#nothing").remove();
            $("#layers").prepend("<div id='layer" + i + "' idtotal='layer" + numarDeLayere +"' class='sort alert alert-info' style='margin-top:-8px; cursor: move;'><b>Facebook Pic " + i + "<b><button id='delete" + i + "' class='pull-right btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i> Delete</button><br></div>");

            var a = i;
            $("#delete" + i).click(function () {
                $("#layer" + a).remove();
                $("#added-fb" + a).remove();
                //change layers display order after delete
                $($("#layers .sort").get().reverse()).each(function (index) {
                    var id = $(this).attr("idtotal");
                    $(".main").find('.' + id).css('z-index', index);
                });
            });


            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "{{ URL::asset('admin/js/resulteditor.js') }}";
            $("body").append(s);


        }); // finish fb profile function
             
                            
                            
                            $("#fb-friend-profile").click(function () {
                                b++;
                                
                                //console.log(cnt);
                               // var numarDeLayere = $('#layers .sort').length + 1;
                               if(cnt>=9){$('#response').html('<b style="color:red;font-size:16px;">Maximum 9 friends please!</b>');setTimeout(function(){$('#response').html("");},3000);}else{
                                cnt++;
                                var body = $('body'),
                                        numarDeLayereTotal = body.data('numarDeLayere'),
                                        numarDeLayere = numarDeLayereTotal + 1;
                                        
                                body.data('numarDeLayere', numarDeLayere);
                                
                                $(".main").append("<div id='added-friend-fb" + b + "' class='layer" + numarDeLayere +" resizable draggable' style='position: absolute; top:10%; left:10%; width:30%; height:55%;'><img class='appended' style='width:100%; height:100%;' src='"+assetsUrl+'/rsz_fb-friend-profile'+cnt+".jpg'></div> ");
                                $('<span class="friend-'+cnt+'-first-name" style="display: block;"><b>[friend-'+cnt+'-first-name]</b> - For FB Friend '+cnt+',user first name</span>').appendTo('.add-text small');
                                $('<span class="friend-'+cnt+'-last-name" style="display: block;"><b>[friend-'+cnt+'-last-name]</b> - For FB Friend '+cnt+',user last name</span>').appendTo('.add-text small');
                                $('<span class="friend-'+cnt+'-full-name" style="display: block;"><b>[friend-'+cnt+'-full-name]</b> - For FB Friend '+cnt+',user full name</span>').appendTo('.add-text small');
                                $("#nothing").remove();
                                $("#layers").prepend("<div id='layerfriend" + b + "' idtotal='layer" + numarDeLayere +"' class='sort alert alert-info' style='margin-top:-8px; cursor: move;'><b>Facebook Friend Pic " + b + "<b><button id='deletefriend" + b + "' class='pull-right btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i> Delete</button><br></div>");
                                 }
                                var a = b;
                               
                                $("#deletefriend" + b).click(function () {
                                    $("#layerfriend" + a).remove();
                                    $("#added-friend-fb" + a).remove();
                                     $(".friend-"+a+"-first-name").remove();
                                     $(".friend-"+a+"-last-name").remove();
                                     $(".friend-"+a+"-full-name").remove();
                                   
                                    //change layers display order after delete
                                    $($("#layers .sort").get().reverse()).each(function (index) {
                                        var id = $(this).attr("idtotal");
                                        $(".main").find('.' + id).css('z-index', index);
                                    });
                                    cnt--;
                                });

                               if(cnt>9){}else{
                                var s = document.createElement("script");
                                s.type = "text/javascript";
                                s.src = "{{ URL::asset('admin/js/resulteditor.js') }}";
                                $("body").append(s);
                                
                                }

                            }); // finish fb profile function
        
                 


        $("#urca").click(function () {
            $("input[id='image']").click();
        });
        $("input[id='image']").on('change', function () {
            $("#status").show();
            $('#image-upload').submit();
        });

        var j = 0;
        $('#image-upload').on('submit', function (event) {
            event.preventDefault();
            j++;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            window.setTimeout(function() {
            $.ajax({
                url: 'results/image-upload',
                data: new FormData($("#image-upload")[0]),
                dataType: 'json',
                async: false,
                type: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    var body = $('body'),
                            numarDeLayereTotal = body.data('numarDeLayere'),
                            numarDeLayere = numarDeLayereTotal + 1;
                    body.data('numarDeLayere', numarDeLayere);

                    $(".main").append("<div id='added-image" + j + "' class='layer"+ numarDeLayere +" resizable draggable' style='position: absolute; top:15%; left:30%; width:40%; height:65%;'><img class='appended' style='width:100%; height:100%;' src='{{ URL::asset('images/results-uploaded') }}/" + data['imagename'] + "'></div> ");

                    $("#nothing").remove();
                    $("#layers").prepend("<div id='layer-image" + j + "' idtotal='layer"+ numarDeLayere +"' class='sort alert alert-info' style='margin-top:-8px;'><b>Image  " + j + "<b><button id='delete-image" + j + "' class='pull-right btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i> Delete</button><br></div>");

                    var b = j;
                    $("#delete-image" + j).click(function () {
                        $("#layer-image" + b).remove();
                        $("#added-image" + b).remove();
                        //change layers display order after delete
                        $($("#layers .sort").get().reverse()).each(function (index) {
                            var id = $(this).attr("idtotal");
                            $(".main").find('.' + id).css('z-index', index);
                        });
                    });

                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src = "{{ URL::asset('admin/js/resulteditor.js') }}";
                    $("body").append(s);

                }, //succes function

                complete: function () {
                    $("#status").hide();
                }
            });
            }, 0);

        });


        //send layers sises & crate image results

        $("#store").click(function () {
            $('#create-image').submit();
        });

        $('#create-image').on('submit', function (e) {
            e.preventDefault();

            var gender = '',
             maleinput = $('input[name="male"]:checked').val(),
             femaleinput = $('input[name="female"]:checked').val();

            if( maleinput == null && femaleinput == null){
                gender = 'both';
            } else {
                if ( maleinput == 'on' && femaleinput == 'on'){
                    gender = 'both';
                } else if (femaleinput == 'on'){
                    gender = 'female';
                } else if (maleinput == 'on'){
                    gender = 'male';
                }
            }

            var formData = {
                @if(!empty(Input::get('editid')))
                "editid":"{{ Input::get('editid') }}",
                @endif
                "gender": gender,
                "sizes": $("#sizes").val(),
                "result": $("#store").attr('result')
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $.ajax({
                type: "POST",
                url: 'results/create-image',
                data: formData,
                beforeSend: function () {
                    console.log(formData);
                    $("#response").html('<b>Saving result <i class="fa fa-spinner fa-spin"></i></b>');
                },

                success: function (data) {
                     var numar = $('#accordionn .acc').length;
                     var numarr = numar + 1;

                    var edited = $('#result' + numar).attr('edited');
                    var d = new Date();
                    if(edited == 'no'){
                        $('#result' + numar).html('<div class=acc>Result '+ numar +'</div><div><div class=resultcontent><div class=col-md-8><img class="fbeditorbtn img-responsive imgedited resultlistimg"src="' + data.imgurl +'?' + d.getTime() +'"></div><div class=col-md-4><div class=buttonsresult><div class=butoaneresult><button onclick=\'deleteResult("'+ numar +'", "{{ $appname }}", event)\' class="btn-danger btn-lg"><i class="glyphicon glyphicon-trash"></i> Delete Result</button></div></div></div></div></div>');
                        $('#result' + numar).attr('edited', 'yes');

                        $('#add-result span').html(numar + 1);
                        $('#store span').html(numar + 1);
                        $('#store').attr('result', numar + 1);
                        $( "#accordionn" ).accordion( "refresh" );
                        $( "#accordionn" ).accordion({
                            active: numar - 1
                        });

                    } else {
                        $('#accordionn').append('<div id="result' + numarr +'" edited="yes"><div class=acc>Result '+ numarr +'</div><div><div class=resultcontent><div class=col-md-8><img class="fbeditorbtn img-responsive imgedited resultlistimg" src="' + data.imgurl +'?' + d.getTime() +'"></div><div class=col-md-4><div class=buttonsresult><div class=butoaneresult><button onclick=\'deleteResult("'+ numarr +'", "{{ $appname }}", event)\' class="btn-danger btn-lg"><i class="glyphicon glyphicon-trash"></i> Delete Result</button></div></div></div></div></div></div>');

                        $('#add-result span').html(numar + 2);
                        $('#store span').html(numar + 2);
                        $('#store').attr('result', numar + 2);
                        $( "#accordionn" ).accordion( "refresh" );
                        $( "#accordionn" ).accordion({
                            active: numar
                        });

                    }

                    //add gender image
                    $('#result' + data.resultnr + ' .resultcontent .col-md-4').append('<img class="img-gender" src="../../../images/genders/'+ data.gender +'.png">');

                    //show message succes
                    $("#response").html("<div id='succesmsg' class='alert alert-success response-msg'>" + data.msg + "</div>");

                    setTimeout(function () {
                        $('#succesmsg').fadeOut('slow', function () {
                            $('#succesmsg').remove();
                        });

                    }, 2000);

                }, // end succes function
                complete: function () {
                    $("#status").empty();
                },
                error: function () {

                }
            });
            return false;
        });


        //add result button top
        $("#add-result").click(function() {
            var numar = $('#accordionn .acc').length;
            var numarr = numar + 1;

            var edited = $('#result' + numar).attr('edited');

            if(edited == 'no'){
                $('#alertsmg').html('<div id="amsg" class="alert alert-danger" style="margin: 7px"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Result '+ numar +' must be edited to add another result</div>');
                setTimeout(function () {
                    $('#amsg').fadeOut('slow', function () {
                        $('#amsg').empty();
                    });

                }, 2000);

            }else{

            $('#accordionn').append('<div id="result' + numarr +'" edited="no"><div class="acc">Result ' + numarr  + '</div><div><div class="resultcontent"><div class="col-md-8"><img class="fbeditorbtn'+ numarr +' img-responsive resultlistimg" src="../../../images/addcontent.jpg"></div><div class=col-md-4><div class=buttonsresult><div class=butoaneresult><button class="btn-lg btn-info fbeditorbtn'+ numarr +'"><i class="fa fa-pencil" aria-hidden="true"></i> Go to FB editor</button></div></div></div></div></div></div>');

            $(".fbeditorbtn" + numarr).click(function (){
                $('html, body').animate({
                    scrollTop: $(".fbeditor").offset().top
                }, 1000);
            });

            $('#add-result span').html(numar + 2);
            $('#store span').html(numar + 1);
            $('#store').attr('result', numar + 1);
            $( "#accordionn" ).accordion( "refresh" );
            $( "#accordionn" ).accordion({
                active: numar
            });
            } // if statement
        });

        $('#open-pixlr-buton-link').click(function(){
            alert('apasat pixlrrr');
        });

    }); //documengt ready


    //show saved results
    @if( $nrresults > 0)

    $(function(){
        for (var i = 0; i < {{ $nrresults }}; i++) {
            var numar = i;
            var numarr = numar + 1;
            var edited = $('#result' + numar).attr('edited');

            $('#accordionn').append('<div id="result' + numarr + '" edited="yes"><div class=acc>Result ' + numarr + '</div><div><div class=resultcontent><div class=col-md-8><img class="fbeditorbtn img-responsive imgedited resultlistimg"src="{{ URL::asset('appsresults/'.$appname.'/result') }}'+ numarr +'.jpg"></div><div class=col-md-4><div class=buttonsresult><div class=butoaneresult><button onclick=\'deleteResult("'+ numarr +'", "{{ $appname }}", event)\' class="btn-danger btn-lg"><i class="glyphicon glyphicon-trash"></i> Delete Result</button></div></div></div></div></div></div>');

            $('#add-result span').html(numar + 2);
            $('#store span').html(numar + 2);
            $('#store').attr('result', numar + 2);
            $("#accordionn").accordion("refresh");
            $("#accordionn").accordion({
                active: numar
            });
        }
    });

@endif
@if( $nrresults < 2)
        $('.nextstep').hide();
    @endif


    $(function (){
        var num = $('#accordionn .acc').length;
        if (num >= 2) {
            $('.nextstep').show();
            $('#btnappset').removeClass('disabled');
            $('#btnappset').css('pointer-events', 'auto');

            var sresults = $('#sresults');
            sresults.removeClass('label-danger');
            sresults.addClass('label-success');
            sresults.html('Completed');
            $('#sappset').addClass('label-danger');
        }
    });

    function nextStep(event){
        event.preventDefault();
        window.location.href='@if(!empty(Input::get('editid'))){{ URL::to('dashboard/apps/create/appset?editid=' .Input::get('editid') .'') }}@else{{ URL::to('dashboard/apps/create/appset') }}@endif';
    }

    @if(!empty(Input::get('editid')))
        $('body').data('editid', '{{ Input::get('editid') }}');
        @endif

      @if(!empty($genders))
      $(function(){
       @foreach($genders as $key => $gender)
              var key = {{ $key }} + 1;
         $('#result' + key + ' .resultcontent .col-md-4').append('<img class="img-gender" src="{{ URL::asset('images/genders/'. $gender .'.png') }}">');
         @endforeach
       });
      @endif
</script>
