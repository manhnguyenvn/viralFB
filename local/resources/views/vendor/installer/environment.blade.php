@extends('vendor.installer.layouts.master')
@if (session('dberror'))
@section('head')
    @parent
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@stop
@endif

@section('title', trans('messages.environment.title'))
@section('container')
    @if (session('dberror'))
        <div class="card blue-grey darken-1" style="height: 50%; background-color: #fff !important;">
            <br><br><br>
                <div class="alert alert-danger text-center">
                    <h2>DB Connection Error</h2>
                    <h3>Database details are incorrect</h3>

                    <br>
                    <a href="{{ route('environment') }}"><button class="btn btn-default">Go back</button></a>
                </div>
        </div>

    @else
        <div class="card blue-grey darken-1">
            <form method="post" action="{{ route('environmentSave') }}">
                <div class="card-content white-text">
                    <p class="card-title center-align">Database setting</p>

                    <p class="center-align">Please enter your database details</p>
                    <hr>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="input-field">
                        <i class="material-icons prefix">settings</i>
                        <input type="text" id="dbname" name="dbname" value="{{ $database }}" required>
                        <label for="dbname">Database name (where you want your application to be)</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">perm_identity</i>
                        <input type="text" id="username" name="username" value="{{ $username }}" required>
                        <label for="username">Username (Your database login)</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">vpn_key</i>
                        <input type="text" id="password" name="password" value="{{ $password }}">
                        <label for="password">Password (Your database password)</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">language</i>
                        <input type="text" id="host" name="host" value="{{ $host }}" required>
                        <label for="host">Host name (Get this info from your web host)</label>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn waves-effect waves-light" type="submit">
                        Save and continue
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    @endif
@stop
