<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>RDFBrowser</b></a>
        </div>
        <div class="navbar-collapse collapse">
            @if(\Request::route()->getName() == "sparql")
            <ul class="nav navbar-nav">
                <li class="page-scroll"><a>SPARQL Endpoint console</a></li>
                <li class="page-scroll"><a>Query Form</a></li>
                <li class="page-scroll"><a>Results</a></li>
            </ul>
                
            @else
            <ul class="nav navbar-nav">
                <li><a href="#headerwrap" class="page-scroll"><?php echo trans('theme/browser/navbar.start'); ?></a></li>
                <li><a href="#abstract" class="page-scroll"><?php echo trans('theme/browser/navbar.abstract'); ?></a></li>
                <li><a href="#properties" class="page-scroll"><?php echo trans('theme/browser/navbar.properties'); ?></a></li>
                <li><a href="#resources" class="page-scroll"><?php echo trans('theme/browser/navbar.resources'); ?></a></li>
                <li><a href="#reverseResources" class="page-scroll"><?php echo trans('theme/browser/navbar.reverseResources'); ?></a></li>
                <li><a href="#dumps" class="page-scroll"><?php echo trans('theme/browser/navbar.dumps'); ?></a></li>
                
            </ul>
            @endif


            <ul class="nav navbar-nav navbar-right">
                @if(\Request::route()->getName() == "sparql")
            
                @else
                <li>
                    <div id="filter_global" class="input-group-lg">
                        <input type="text" class="global_filter form-control" placeholder="{{trans('theme/browser/navbar.global-search')}}" id="global_filter">
                    </div>
                </li>
                @endif
                @if (Auth::guest())
                <li><a href="{{ url('RDFBrowser/login') }}"><?php echo trans('theme/browser/navbar.login'); ?></a></li>
                @if(config('app.registration'))
                <li><a href="{{ url('RDFBrowser/register') }}"><?php echo trans('theme/browser/navbar.register'); ?></a></li>
                @endif
                @else
                <!-- User Account Menu -->
                <li>
                    <a href="{{ url('RDFBrowser/admin') }}">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>