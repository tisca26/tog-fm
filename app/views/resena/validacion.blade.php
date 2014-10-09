@extends('layout')

@section('content')
<div id="page-wrapper">            
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Validación de reseñas</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">            
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tabla de validación de reseñas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable-usuarios">
                            <thead>
                                <tr>                                    
                                    <th>NOMBRE</th>
                                    <th>USERNAME</th>
                                    <th>DOCUMENTO</th>
                                    <th>ACCIÓN</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($descargas as $descarga)
                                <?php $type = ($cont % 2 == 0)? 'even' : 'odd';  ?>
                                <tr class="<?php echo $type ?>">
                                    <td>
                                        <?php echo 
                                            $descarga->download_history->user()->first()->nombre 
                                            . ' ' . 
                                            $descarga->download_history->user()->first()->apellidos; 
                                        ?>
                                    </td>
                                    <td><?php echo $descarga->download_history->user()->first()->username; ?></td>
                                    <td>
                                        <a target="_blank" href="{{URL::to('/') . '/public/resenas/' . $descarga->review->archivo}}">
                                            {{$descarga->review->archivo}}
                                        </a>
                                    </td>
                                    <td>                                        
                                        <a href="#" data-toggle="modal" data-target="#aprobarModal-{{$descarga->download_history->id}}">Aprobar</a>
                                        <div class="modal fade" id="aprobarModal-{{$descarga->download_history->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Aprobación de reseña</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>
                                                            ¿Deseas aprobar la reseña enviada por 
                                                                <?php echo 
                                                                    $descarga->download_history->user()->first()->nombre 
                                                                    . ' ' . 
                                                                    $descarga->download_history->user()->first()->apellidos; 
                                                                ?>
                                                            ?
                                                        </label>
                                                        <br />
                                                        Al aprobarla, el usuario podrá descargar otro archivo si es que no está en el límite de descargas.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form role="form" action="{{URL::to('/') . '/resena/aprobacion'}}" method="POST">
                                                            <input type="hidden" name="download_history_id" value="{{$descarga->download_history->id}}">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-danger" >Aprobar</button>
                                                        </form>                                                        
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        |
                                        <a href="#" data-toggle="modal" data-target="#rechazarModal-{{$descarga->download_history->id}}">Rechazar</a>
                                        <div class="modal fade" id="rechazarModal-{{$descarga->download_history->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Rechazo de reseña</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>
                                                            ¿Deseas rechazar la reseña enviada por 
                                                                <?php echo 
                                                                    $descarga->download_history->user()->first()->nombre 
                                                                    . ' ' . 
                                                                    $descarga->download_history->user()->first()->apellidos; 
                                                                ?>
                                                            ?
                                                        </label>
                                                        <br />
                                                        Al rechazarla, el usuario podrá subir otra reseña.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{URL::to('/') . '/resena/rechazo'}}" method="POST">
                                                            <input type="hidden" name="download_history_id" value="{{$descarga->download_history->id}}">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                                        </form>                                                        
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
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