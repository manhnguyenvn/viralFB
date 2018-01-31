<script src="{{ URL::asset('admin/js/simplecolorsform.js') }}"></script>
{!! Form::open(['url' => 'changecolors', 'id' => 'schimbareculori']) !!}
<div class="form-group">
    {!! Form::label('maincolor', 'Main Site Color'); !!}
    <div id="cp1" class="input-group colorpicker-component">
        {!! Form::text('maincolor',  $colors['headerbar'], ['class' => 'form-control', 'name' =>'maincolor']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp1').colorpicker();
        });
    </script>
</div>
<div class="form-group">
    {!! Form::label('containercolor', 'App Container Color'); !!}
    <div id="cp2" class="input-group colorpicker-component">
        {!! Form::text('containercolor', $colors['containercolor'], ['class' => 'form-control', 'name' =>'containercolor']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp2').colorpicker();
        });
    </script>
</div>
<div class="form-group">
    {!! Form::label('pagebackground', 'Page Background Color'); !!}
    <div id="cp3" class="input-group colorpicker-component">
        {!! Form::text('pagebackground',  $colors['pagebackground'], ['class' => 'form-control', 'name' =>'pagebackground']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp3').colorpicker();
        });
    </script>
</div>

{!! Form::submit('Save color scheme', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
{!! Form::close() !!}
<br>
<div id="mesaj"></div>
