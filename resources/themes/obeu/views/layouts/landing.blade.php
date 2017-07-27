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
<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="{{Cookie::get('locale')}}">
    <?php App::setLocale(Cookie::get('locale')); ?>
    @include('layouts.browser_partials.html_head')
    <body>
        @include('layouts.browser_partials.header')
        <main class="cd-main-content">
            <div>
                <div class="banner">
                    <div class="wrapper">
                        
                            @if(\Route::current()->getName() != 'sparql')
                                @include('layouts.browser_partials.browser_header')
                            @else
                            <span>
                                <h1>@yield('title', 'Title')</h1>
                                <p>@yield('subtitle', 'Subtitle')</p>                            
                            </span>
                            @endif
                            

                    </div>
                </div>
            </div>
            <div class="wrapper">
                
                </br>
                @section('content')
                @show
                @section('dumps')
                @show
            </div>
        </div>
        @include('layouts.browser_partials.footer_nav')
    </main>
    @include('layouts.browser_partials.lateral_nav')
    @if(!empty(config('app.google_analytics')))
        @include('layouts.browser_partials.google_analytics')
        @show
    @endif
</body>
</html>
