<!DOCTYPE html>
<html lang="en">
    <?php 
        $resource = $label;
        $label = trans('theme/browser/header.noResource.header');
        $images = [asset('browser_assets/img/uknown.jpg')];
        $abstract = trans('theme/browser/header.noResource.abstract', ['resource'=> $resource]);
    ?>
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

    </body>
</html>
