@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $title ?? '' }}</h1>
@stop

@section('content')   
    @yield('main')
@stop

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
    @yield('chart')
@stop
