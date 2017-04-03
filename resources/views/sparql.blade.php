@extends('layouts.landing')

@section('navbar')
    @include('layouts.browser_partials.navbar')
@endsection

@section('content')
    @include('endpoint.sparql_form')
@endsection


