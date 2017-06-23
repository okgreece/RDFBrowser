<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
<!--                    <img src="{{asset('/img/avatar.png')}}" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        @endif
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Main Menu</li>
            <li><a  href="{{ route('geo-extractor.index')  }}"><i class='fa fa-globe'></i><span>GEO Extractors</span></a></li>
            <li><a  href="{{ route('endpoint.index')  }}"><i class='fa fa-database'></i><span>Endpoint</span></a></li>
            <li><a  href="{{ route('graphs.index')  }}"><i class='fa fa-upload'></i><span>Graphs</span></a></li>
            <li><a  href="{{ route('user.index')  }}"><i class='fa fa-users'></i><span>Users</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-eye"></i> 
                    <span>Look & Feel<i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('rdfnamespace.index')}}"><i class="fa fa-circle-o"></i> Namespaces</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Header
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('label-extractor.index')}}"><i class="fa fa-circle-o"></i> Label Extractor</a></li>
                            <li><a href="{{ route('abstract-extractor.index')}}"><i class="fa fa-circle-o"></i> Abstract Extractor</a></li>
                            <li><a href="{{ route('image-extractor.index')}}"><i class="fa fa-circle-o"></i> Image Extractor</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
