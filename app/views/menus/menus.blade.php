@extends('layout')

@section('content')
<div id="page-wrapper">            
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menús</h1>
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
                <a href="{{URL::to('/')}}/menus/insert"  class="btn btn-info">Agregar menú</a>
                <div class="panel-heading">
                    Tabla de menús
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable-menus">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>                                    
                                    <th>ACCIÓN</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($menus as $menu)
                                <?php $type = ($cont % 2 == 0)? 'even' : 'odd';  ?>
                                <tr class="<?php echo $type ?>">
                                    <td><?php echo $menu->id; ?></td>
                                    <td><?php echo $menu->nombre; ?></td>                                   
                                    <td>algo</td>
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
    
</div>
<script src="{{URL::to('/')}}/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="{{URL::to('/')}}/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>  

<script>
    $(document).ready(function() {
        $('#dataTable-menus').dataTable();
    });    
</script>
@stop