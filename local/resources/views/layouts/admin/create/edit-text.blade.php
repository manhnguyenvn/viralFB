@section('main_head')
    @parent
    <link href="{{ URL::asset('admin/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"
          rel="stylesheet">
    <style id="font-face"></style>
    <style>
        @font-face {
            font-family: "Chewy";
            src: url("../../../admin/fontsttf/Chewy.ttf");
        }
    </style>
@stop

<center>
    <b>Add text with FB user name</b>
    <br>
    <button id="addtext" class="btn btn-info">Add Text Layer</button>

</center>
<div id="text-editor"></div>

<div id="text-edit-template" style="display: none">
    <hr class="style-two">
    <center>
        <div class="form-group">
            {!! Form::label('text', 'Text:') !!}
            {!! Form::textarea('text', null, ['id' => 'text-input', 'class' => 'text-input form-control', 'style' => 'height:80px']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('font', 'Font:') !!}
            <?php
            $directory = 'admin/fontsttf';
            $stack = array();
            foreach (glob($directory . '/*.*') as $file) {
                $text = "$file";
                $deinlocuit = ['admin/fontsttf/', '.ttf'];
                $inlocuitcu = ['', ''];
                $ttf = str_replace($deinlocuit, $inlocuitcu, $text);
                $stack[$ttf] = $ttf;
            }
            ?>
            {!! Form::select('font', $stack, 'Default', array('id' => 'font-input', 'class' => 'font-input form-control input-sm')) !!}
        </div>
    </center>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('color', 'Color:'); !!}
                <div id="cp1" class="input-group colorpicker-component">
                    {!! Form::text('color', '#000000', ['id' => 'color-input', 'class' => 'color-input form-control input-sm', 'name' =>'color']) !!}
                    <span class="input-group-addon"><i></i></span>
                </div>
                <script>
                    $(function () {
                        $('#cp1').colorpicker({
                            //   color: '#000000',
                            format: 'rgba'
                        });
                    });
                </script>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('fontsize', 'Fontsize:') !!}
                {!! Form::select('fontsize', array('5' => ' 5 ','10' => '10', '15' => '15', '20' => '20', '25' => '25','30' => '30', '35' => '35', '40' => '40','45' => '45', '50' => '50', '55' => '55', '60' => '60', '65' => '65', '70' => '70', '75' => '75', '80' => '80', '85' => '85','90' => '90', '95' => '95', '100' => '100'), '30', array('id' => 'fontsize-input', 'class' => 'fontsize-input form-control input-sm')) !!}
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="text-center">
    <small>
        <i><b style="color: #007cff">Shortcodes: </b></i>
        <br>
        <b>[first-name]</b> - For FB user first name
        <br>
        <b>[last-name]</b> - For FB user last name
        <br>
        <b>[full-name]</b> - For FB user full name
            
    </small>
</div>
@section('foot')
    @parent
    <div id="script-adaugat"></div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('admin/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>
    <script>
        $(function () {
            var i = 0;

            $('#addtext').click(function (e) {
                e.preventDefault();
                i++;

                var last = i - 1,
                    lastText = $('#text-input' + last ).val(),
                    emptyLastText = null;
                    if(lastText != null){
                     var lastTextLength = lastText.length;
                        if(lastTextLength == 1){
                            emptyLastText = true;
                        }
                    }

                if(emptyLastText == true){
                    $('#text-input' + last ).val('Edit this text');

                    var child = $('.added-text' + last);

                    var text = $('#text-input' + last).val(),
                        color = $('#color-input' + last).val(),
                        font = $('#font-input' + last).val(),
                        fontsize = $('#fontsize-input' + last).val(),
                        size = $('#fontsize-input' + last).val(),
                        style = "font-family:" + font + "; color:" + color + "; font-size:" + fontsize + "px;";

                    child.html(text).attr('style', style);

                    newText(child, last);

                } else {

                // var numarDeLayere = $('#layers .sort').length + 1;
                var body = $('body'),
                        numarDeLayereTotal = body.data('numarDeLayere'),
                        numarDeLayere = numarDeLayereTotal + 1;
                body.data('numarDeLayere', numarDeLayere);

                $(".main").append("<div id='added-text" + i + "' index='" + i + "'  class='layer" + numarDeLayere + " draggable appended-text' style='position: absolute; top:40%; left:30%; cursor: move; white-space: nowrap;'><div class='added-text" + i + "'>Text Layer " + i + "</div></div> ");

                $("#nothing").remove();
                $("#layers").prepend("<div id='layertext" + i + "' idtotal='layer" + numarDeLayere + "' class='sort alert alert-info' style='margin-top:-8px;'><b>Text Layer " + i + "<b><button id='delete" + i + "' class='pull-right btn-xs btn-danger'><i class='glyphicon glyphicon-trash'></i> Delete</button><br></div>");

                var a = i;
                $("#delete" + i).click(function () {
                    $("#layertext" + a).remove();
                    $("#added-text" + a).remove();
                    //change layers display order after delete
                    $($("#layers .sort").get().reverse()).each(function (index) {
                        var id = $(this).attr("idtotal");
                        $(".main").find('.' + id).css('z-index', index);
                    });
                });


                $('.text-input').attr('id', 'text-input' + a);
                $('.font-input').attr('id', 'font-input' + a);
                $('.color-input').attr('id', 'color-input' + a);
                $('.fontsize-input').attr('id', 'fontsize-input' + a);
                var template = $('#text-edit-template').html();
                $('#text-editor').empty().html(template);

                $('#text-input' + a).val('Text layer ' + a);
                $('#font-input' + a).val('Chewy');
                $('#color-input' + a).val('#000');
                $('#fontsize-input' + a).val('35');


                var child = $('.added-text' + a);

                var text = $('#text-input' + a).val(),
                        color = $('#color-input' + a).val(),
                        font = $('#font-input' + a).val(),
                        fontsize = $('#fontsize-input' + a).val(),
                        size = $('#fontsize-input' + a).val(),
                        style = "font-family:" + font + "; color:" + color + "; font-size:" + fontsize + "px;";

                child.html(text).attr('style', style);


                $('head').append('<style id="font-face' + a + '"></style>');

                var s = document.createElement("script");
                s.type = "text/javascript";
                s.src = "{{ URL::asset('admin/js/resulteditor.js') }}";
                $("#script-adaugat").html(s);

                newText(child, a);
                }

            });
        });
    </script>
@stop