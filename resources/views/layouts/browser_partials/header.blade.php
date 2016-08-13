<section id="headerwrap" name="headerwrap">
@section('label')
    @include('layouts.browser_partials.content.label')
@show
@if(!empty($images))
@section('images')
    @include('layouts.browser_partials.content.images')
@show
@endif

@if(!empty($map))
@section('map')
    @include('layouts.browser_partials.content.map')
@show
@endif

@section('type')
    @include('layouts.browser_partials.content.type')
@show

@section('abstract')
    @include('layouts.browser_partials.content.abstract')
@show

</section>