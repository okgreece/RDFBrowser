@extends('layouts.landing')



@section('content')

    @if(\Illuminate\Support\Facades\Route::currentRouteName() === "browse")
        <div class="paginator-browser">
            <button class="btn-landing" onclick="location.href='{{env("APP_URL")}}'">Back to Landing</button>
            {{$paginator->render()}}
        </div>
    @endif
    @foreach($classes as $class)
        @include('landing.thumbnail', [$class])
    @endforeach
    @if(\Illuminate\Support\Facades\Route::currentRouteName() === "browse")
        <div class="paginator-browser">
            <button class="btn-landing" onclick="location.href='{{env("APP_URL")}}'">Back to Landing</button>
            {{$paginator->render()}}
        </div>
    @endif
@endsection

@section('navbar')
    @include('layouts.browser_partials.navbar')
@endsection