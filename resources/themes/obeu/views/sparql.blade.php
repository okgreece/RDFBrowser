@extends('layouts.landing')

@section('title', 'OpenBudgets.eu SPARQL Endpoint')

@section('subtitle', 'Explore our data using the SPARQL query language!')

@section('content')
    @include('endpoint.sparql_form')
    @include('layouts.browser_partials.footer')
@endsection


