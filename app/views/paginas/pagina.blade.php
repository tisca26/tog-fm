@extends('layout')

@section('content') 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$menu->nombre}}</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                En este apartado encontrarás los archivos referentes al tema
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="form-group">
                            <label>Lista de archivos disponibles</label> <br />
                            @foreach ($archivos as $archivo)
                                <div class="col-md-6">
                                    <a href="#" data-toggle="modal" data-target="#myModal">{{$archivo->nombre}}</a>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Descarga de archivo</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label>{{$archivo->nombre}}</label>
                                                    <br />
                                                    {{$archivo->descripcion}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <a class="btn btn-primary" href="{{URL::to('/') . '/paginas/download/' . $archivo->id}}" target="_blank" >Descargar</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    @if (Auth::user()->role_id == 1)
                                    <button type="button" class="btn btn-danger btn-circle" style="margin-left: 10px;" data-toggle="modal" data-target="#myModal_{{$archivo->id}}"><i class="fa fa-times"></i></button>
                                    <div class="modal fade" id="myModal_{{$archivo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Eliminar archivo</h4>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea eliminar el archivo <strong>{{$archivo->nombre}}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="closeModal_{{$archivo->id}}" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="button" onclick="borrarArchivo({{$archivo->id}})" class="btn btn-danger">Si</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    @endif
                                </div>
                            @endforeach                                                      
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<script>
    
    function borrarArchivo(id){ 
        $.post( "{{URL::to('/')}}" + "/paginas/eliminar/" + id)        
        .done(function( msg ) {
            $('#closeModal_' + id).click();
            location.reload();
            //alert(msg);
        })
        .fail(function( msg ) {
            alert( msg );
        });
    }
</script>
@stop