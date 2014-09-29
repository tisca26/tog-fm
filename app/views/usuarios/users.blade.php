@extends('layout')

@section('content')
<div id="page-wrapper">            
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('msg'))        
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('msg')}}.
            </div>
            @endif
            <div class="panel panel-default">                
                <a href="{{URL::to('/')}}/users/insert"  class="btn btn-info">Agregar usuario</a>
                <div class="panel-heading">
                    Tabla de usuarios
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable-usuarios">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>USERNAME</th>
                                    <th>ROL</th>
                                    <th>ESTATUS</th>
                                    <th>ACCIÓN</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($users as $user)
                                <?php $type = ($cont % 2 == 0)? 'even' : 'odd';  ?>
                                <tr class="<?php echo $type ?>">
                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->nombre . ' ' . $user->apellidos; ?></td>
                                    <td><?php echo $user->username; ?></td>
                                    <td><?php echo $user->role()->first()->nombre; ?></td>
                                    <?php $checked = ($user->estatus == 1)? 'checked' : ''; ?>
                                    <td> <input type="checkbox" <?php echo $checked; ?>></td>
                                    <td>
                                        <a href="{{URL::to('/')}}/users/edit/{{$user->id}}">Editar</a> |
                                        <a href="{{URL::to('/')}}/users/show/{{$user->id}}">Ver</a>
                                    </td>
                                </tr>
                                <?php $cont++; ?>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->                            
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div id="agrega_vista">

    </div>
</div>
<script src="{{URL::to('/')}}/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="{{URL::to('/')}}/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>  

<script>
    $(document).ready(function() {
        $('#dataTable-usuarios').dataTable();
    });    
</script>
@stop