<?php
/* 
 * The MIT License
 *
 * Copyright 2017 Sotiris Karampatakis Open Knowledge Greece.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="@yield('title') - Served by RDFBrowser">
    <meta name="author" content="Karampatakis Sotirios - s.karampatakis@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RDFBrowser') - RDFBrowser || openbudgets.eu </title>
    <!-- Styles -->
    <script  src="https://code.jquery.com/jquery-1.12.4.min.js"  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="  crossorigin="anonymous"></script>
    <link href="//fonts.googleapis.com/css?family=Cabin:400,400i,600,700" rel="stylesheet"> 
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <link href="{{ asset('/browser_assets/css/datatable-browser.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/browser_assets/css/admin/obeu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/browser_assets/css/flag-icon.css') }}" rel="stylesheet" type="text/css" />
    <!--    Datatables-->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
    <!--    Leaflet Map-->
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" />    
    <link rel="stylesheet" href="http://okfnlabs.org/openbudgets.github.io/css/main.css">
    <script src="http://okfnlabs.org/openbudgets.github.io/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="http://okfnlabs.org/openbudgets.github.io/js/plugins.js"></script>
    <script src="http://okfnlabs.org/openbudgets.github.io/js/main.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    @include('layouts.browser_partials.scripts')
</head>