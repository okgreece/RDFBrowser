@extends('layouts.landing')

@section('title', $label)

@section('content')
    @include('layouts.browser_partials.content.literals', ["rewrite" => $rewrite])
    @include('layouts.browser_partials.content.resources', ["rewrite" => $rewrite])
    @include('layouts.browser_partials.content.reverseResources', ["rewrite" => $rewrite])
@endsection


@section('dumps')
    @include('layouts.browser_partials.content.dumps')
    @include('layouts.browser_partials.footer')
@endsection