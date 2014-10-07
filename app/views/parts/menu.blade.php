<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">                    
            @if ($role->id === 1 || $role->nombre === 'INTERNO')
                <li>
                    <a href="{{URL::to('/')}}"><i class="fa fa-upload fa-fw"></i> Carga de documentos</a>
                </li>
            @endif
                <li>
                    <a href="{{URL::to('/')}}/resena"><i class="fa fa-upload fa-fw"></i> Carga de reseñas</a>
                </li>
            @foreach($menus as $menu)
                <li>
                    <a href="{{URL::to('/')}}/paginas/{{$menu->id}}"><i class="fa fa-sitemap fa-fw"></i>{{ $menu->nombre }}</a>
                </li>
            @endforeach
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side --> 
