<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

    @section('htmlheader')
    @include('layouts.partials.htmlheader')
    @section('scripts')
    @include('layouts.partials.scripts')
    @show
    @show

    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="skin-red sidebar-mini sidebar-collapse">
        <div class="wrapper">

            @include('layouts.partials.mainheader')

            @include('layouts.partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper watermark">

                
                <!-- Main content -->
                <section class="content">
                    @if(Session::has('flash_message'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                        {{Session::get('flash_message')}}
                    </div>
                    @endif

                    <!-- Your Page Content Here -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('layouts.partials.controlsidebar')

            @include('layouts.partials.footer')

        </div><!-- ./wrapper -->
    </body>
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</html>
