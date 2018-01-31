@section('footer')
    <br>
    <footer class="site-footer">
        <div class="row">
            <div class="col-md-8">
                <div class="footer-content pull-left">@yield('footer-content')</div>
            </div>
            <div class="col-md-3">
                <div class="back-top pull-right">
                    {{ $lang['backtop'] }} &nbsp; <button id="back-to-top" class="btn btn-default"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </footer>
@show
