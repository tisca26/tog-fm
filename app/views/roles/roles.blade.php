@extends('layout')

@section('content') 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Roles</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">       
        @if(Session::has('inserted'))        
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('inserted')}}.
        </div>
        @endif
        <div class="panel panel-default">            
            <a href="{{URL::to('/')}}/roles/insert"  class="btn btn-info">Agregar rol</a>
            <div class="panel-heading">
                En este apartado encontrarás los roles disponibles en el sistema
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="form-group">
                            <label>Roles creados</label><br />
                            @foreach ($roles as $role)
                                <div class="col-md-6">
                                    <a href="#" onclick="cargaContenido('menus_rol', {{$role->id}}, '{{$role->nombre}}')">{{$role->nombre}}</a>
                                </div>
                            @endforeach                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menus_rol">

    </div>
    <!-- /.row -->
</div>
<script>    
    function cargaContenido(idElemento, idRol, nombreRol){
        var elemento = $("#" + idElemento);
        $.ajax({                  
            type: 'POST',
            url: "{{URL::to('/') . '/roles/menus'}}",
            data: {idRol : idRol, nombreRol : nombreRol},
            success: function(msg){
                elemento.html(msg);
            }
        });
    }
</script>
@stop