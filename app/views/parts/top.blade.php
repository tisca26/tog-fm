<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{URL::to('/')}}/assets/img/tog logo.png" style="width: 5%;">The Open Group México File Manager</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        {{Auth::user()->nombre . ' ' . Auth::user()->apellidos}}
        @if (Auth::user()->role_id == 1)
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="glyphicon glyphicon-tower"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{URL::to('/')}}/roles"><i class="fa fa-user fa-fw"></i> Roles</a>
                </li>
                <li><a href="{{URL::to('/')}}/menus"><i class="fa fa-user fa-fw"></i> Menus</a>
                </li>
                <li><a href="{{URL::to('/')}}/resena/validacion"><i class="fa fa-user fa-fw"></i> Validación de reseñas</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{URL::to('/')}}/users"><i class="glyphicon glyphicon-list"></i> Usuarios</a>
                </li>                                
            </ul>
            <!-- /.dropdown-user -->
        </li>
        @endif
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{URL::to('/')}}/login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
</nav>
<!-- /.navbar-static-top -->