@extends('layouts.landing')

@section('content')
    @include('layouts.browser_partials.header')
    @include('layouts.browser_partials.content.literals', ["rewrite" => $rewrite])
    @include('layouts.browser_partials.content.resources', ["rewrite" => $rewrite])
    @include('layouts.browser_partials.content.reverseResources', ["rewrite" => $rewrite])
@endsection


@section('dumps')
    @include('layouts.browser_partials.content.dumps')
@endsection