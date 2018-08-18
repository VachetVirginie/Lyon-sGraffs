<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Where are the graffs') }}</title>
        <link rel="icon" href="{!! asset('/images/lyon.png') !!}"/>
        <link href="{{ asset('css/location.css') }}" rel="stylesheet">
        @yield('css')
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>
    <body>
    @extends('layouts.app')
  
    
    @if (session('ok'))
        <div class="container">
            <div class="alert alert-dismissible alert-success fade show" role="alert">
                {{ session('ok') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    @yield('content')

@extends('layout')


@section('content')

<div class="container center">

@if(Session::has('success'))

    <div class="alert alert-success">{{Session::get('success')}}</div>

@endif
@extends('layout')


@section('content')

<div class="container center">

<div id="map"></div>

  <!-- @if(isset($points))
    @foreach($points as $point)
         <p><strong>{{$point->name}}</strong> : {{$point->address}} 
         <img  style="width:20px;height:20px;"src="{{ asset('thumbs/' . $point->image->name) }}">
         
         </p> 
         
    @endforeach
@endif   -->

</div>

@stop
</body>
</html>