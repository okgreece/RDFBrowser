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

@if(!empty($types))
@section('type')
    @include('layouts.browser_partials.content.type')
@show
@endif

@if(!empty($abstract))
@section('abstract')
    @include('layouts.browser_partials.content.abstract')
@show
@endif

</section>