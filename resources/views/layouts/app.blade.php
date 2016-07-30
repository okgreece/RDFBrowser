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

        @include('layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
<script>
  var host   = 'ws://{{$_SERVER["HTTP_HOST"]}}:8889';  
  //var host   = 'ws://127.0.0.1:8889';
  var socket = null;
  
  var output = document.getElementById('output');
  var print  = function (message) {
      var samp       = document.createElement('samp');
      samp.innerHTML = message + '\n';
      output.appendChild(samp);

      return;
  };

    try {
      socket = new WebSocket(host);
      socket.onopen = function () {
          //print('connection is opened');
          

          return;
      };
      socket.onmessage = function (msg) {
          //print(msg.data);
          console.log(msg);
          var myData = JSON.parse(msg.data);
          console.log(myData.project);
          var selector = 'form[action="' + '{{URL::to("/")}}' + '/createlinks/' + myData.project +'"]';
          
          if(myData.state=="finish"){
            var myButton = $( selector )[0][1];
            myButton.className ="btn";
            $("div.alert > p")[0].innerHTML = myData.message;
          }
          else{
              console.log(myData.state);
              $("div.alert > p")[0].innerHTML = myData.message;
          }
          
          

          return;
      };
      socket.onclose = function () {
          //print('connection is closed');

          return;
      };
  } catch (e) {
      console.log(e);
  }
</script>
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')

</div><!-- ./wrapper -->





</body>
</html>
