<!DOCTYPE html>
<html lang="{{Cookie::get('locale')}}">
    <?php App::setLocale(Cookie::get('locale')); ?>
    @section('htmlheader')
    @include('layouts.browser_partials.htmlheader')
    @section('scripts')
    @include('layouts.browser_partials.scripts')
    @show

    <body data-spy="scroll" data-offset="0" data-target="#navigation">
        @section('navbar')
        @include('layouts.browser_partials.navbar')
        @show

        @include('layouts.browser_partials.header')

        @include('layouts.browser_partials.content.literals')

        @include('layouts.browser_partials.content.resources')

        @include('layouts.browser_partials.content.reverseResources')

        @section('dumps')
        @include('layouts.browser_partials.content.dumps')
        @show

        @section('footer')
        @include('layouts.browser_partials.footer')
        @show

        <script>
            $(document).on('click', '.navbar-collapse.in', function (e) {

                if ($(e.target).is('a') && ($(e.target).attr('class') != 'dropdown-toggle')) {
                    $(this).collapse('hide');
                }

            });
        </script>
        @if(!empty(config('app.google_analytics')))
            @include('layouts.browser_partials.google_analytics')
            @show
        @endif

    </body>
</html>
