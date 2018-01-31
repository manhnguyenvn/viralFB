@extends('vendor.installer.layouts.master')

@section('title')
    {{ trans('messages.welcome.title') }}
    <br>
    <h3 style="color: #fff;">ViralFB - v2.0</h3>
    @stop
@section('container')
    <p class="paragraph">{{ trans('messages.welcome.message') }}</p>
    <div class="buttons">
        <a href="{{ route('environment') }}" class="button">{{ trans('messages.next') }}</a>
    </div>
@stop
