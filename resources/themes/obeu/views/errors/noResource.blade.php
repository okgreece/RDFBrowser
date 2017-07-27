@extends('layouts.landing')
<?php 
        $resource = $label;
        $label = trans('theme/browser/header.noResource.header');
        $images = [asset('browser_assets/img/uknown.jpg')];
        $abstract = trans('theme/browser/header.noResource.abstract', ['resource'=> $resource]);
?>
@section('navbar')
    @include('layouts.browser_partials.navbar')
@endsection

@section('content')
    @include('layouts.browser_partials.header')
    
@endsection