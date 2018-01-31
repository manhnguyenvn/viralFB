<script src="{{ URL::asset('admin/js/advancedcolorsform.js') }}"></script>
    {!! Form::open(['url' => 'changecolors', 'id' => 'schimbareculori']) !!}
<div class="form-group">
    {!! Form::label('pagebackground', 'Page Background Color'); !!}
    <div id="cp11" class="input-group colorpicker-component">
        {!! Form::text('pagebackground',  $colors['pagebackground'], ['class' => 'form-control', 'name' =>'pagebackground']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp11').colorpicker();
        });
    </script>
</div>

    <div class="form-group">
        {!! Form::label('headerbar', 'Header Bar Color'); !!}
        <div id="cp10" class="input-group colorpicker-component">
            {!! Form::text('headerbar',  $colors['headerbar'], ['class' => 'form-control', 'name' =>'headerbar']) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
        <script>
            $(function () {
                $('#cp10').colorpicker();
            });
        </script>
    </div>
    <div class="form-group">
        {!! Form::label('latestapptext', 'Latest App Text Color'); !!}
        <div id="cp3" class="input-group colorpicker-component">
            {!! Form::text('latestapptext', $colors['latestapptext'], ['class' => 'form-control', 'name' =>'latestapptext']) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
        <script>
            $(function () {
                $('#cp3').colorpicker();
            });
        </script>
    </div>
    <div class="form-group">
        {!! Form::label('lastappbtn', 'Latest App Button Color'); !!}
        <div id="cp4" class="input-group colorpicker-component">
            {!! Form::text('lastappbtn', $colors['lastappbtn'], ['class' => 'form-control', 'name' =>'lastappbtn']) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
        <script>
            $(function () {
                $('#cp4').colorpicker();
            });
        </script>
    </div>
    <div class="form-group">
        {!! Form::label('newappborder', 'New Apps Border Color'); !!}
        <div id="cp5" class="input-group colorpicker-component">
            {!! Form::text('newappborder', $colors['newappborder'], ['class' => 'form-control', 'name' =>'newappborder']) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
        <script>
            $(function () {
                $('#cp5').colorpicker();
            });
        </script>
    </div>
    <div class="form-group">
        {!! Form::label('newappbtn', 'New Apps "Let\' s do it" Button Color'); !!}
        <div id="cp6" class="input-group colorpicker-component">
            {!! Form::text('newappbtn', $colors['newappbtn'], ['class' => 'form-control', 'name' =>'newappbtn']) !!}
            <span class="input-group-addon"><i></i></span>
        </div>
        <script>
            $(function () {
                $('#cp6').colorpicker();
            });
        </script>
    </div>
<div class="form-group">
    {!! Form::label('footercolor', 'Footer Bar Color'); !!}
    <div id="cp" class="input-group colorpicker-component">
        {!! Form::text('footercolor', $colors['footercolor'], ['class' => 'form-control', 'name' =>'footercolor']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp').colorpicker();
        });
    </script>
</div>
<div class="form-group">
    {!! Form::label('containerinside', 'App Container Color'); !!}
    <div id="cp7" class="input-group colorpicker-component">
        {!! Form::text('containerinside', $colors['containerinside'], ['class' => 'form-control', 'name' =>'containerinside']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp7').colorpicker();
        });
    </script>
</div>
<div class="form-group">
    {!! Form::label('containercolor', 'App Container Border Color'); !!}
    <div id="cp8" class="input-group colorpicker-component">
        {!! Form::text('containercolor', $colors['containercolor'], ['class' => 'form-control', 'name' =>'containercolor']) !!}
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function () {
            $('#cp8').colorpicker();
        });
    </script>
</div>
    {!! Form::submit('Save color scheme', ['class' => 'form-control btn btn-primary send-form-btn']) !!}
    {!! Form::close() !!}
<br>
<div id="mess"></div>
