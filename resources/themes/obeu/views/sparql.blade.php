@extends('layouts.landing')

@section('title', 'OpenBudgets.eu SPARQL Endpoint')

@section('subtitle', 'Explore our data using the SPARQL query language!')

@section('content')
    <style>
        .endpointWrapper {
            display:none!important;
        }
    </style>
    <link href='//cdn.jsdelivr.net/npm/yasgui@2.7.16/dist/yasgui.min.css' rel='stylesheet' type='text/css'/>
    <script src='//cdn.jsdelivr.net/npm/yasgui@2.7.16/dist/yasgui.min.js'></script>
    <div id='yasgui'></div>
    <script type="text/javascript">
        var yasgui = YASGUI(document.getElementById("yasgui"), {
            //Uncomment below to change the default endpoint
            //Note: If you've already opened the YASGUI page before, you should first clear your
            //local-storage cache before you will see the changes taking effect
            yasqe: {sparql: {endpoint: '{{env("DEFAULT_ENDPOINT")}}'}},
        });
    </script>
    @include('layouts.browser_partials.footer')
@endsection


