<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.browser_partials.htmlheader')
    @section('scripts')
        @include('layouts.browser_partials.scripts')
    @show
@show

<body data-spy="scroll" data-offset="0" data-target="#navigation">
@section('navbar')
    @include('layouts.browser_partials.navbar')
@show

@section('label')
    @include('layouts.browser_partials.content.label')
@show

@section('abstract')
    @include('layouts.browser_partials.content.abstract')
@show

@section('type')
    @include('layouts.browser_partials.content.type')
@show

@section('external')
    @include('layouts.browser_partials.content.external')
@show

@section('dumps')
    @include('layouts.browser_partials.content.dumps')
@show

@section('footer')
    @include('layouts.browser_partials.footer')
@show

<script>
    $(document).on('click','.navbar-collapse.in',function(e) {

    if( $(e.target).is('a') && ( $(e.target).attr('class') != 'dropdown-toggle' ) ) {
        $(this).collapse('hide');
    }

});
</script>

</body>
</html>
