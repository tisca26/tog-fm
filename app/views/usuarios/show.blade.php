@extends('layout')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuario</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">        
        <div class="panel panel-default">
            <div class="panel-heading">
                Información del usuario
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Nombre</label>                            
                            <span class="help-block">{{$user->nombre . ' ' . $user->apellidos}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Username</label>                            
                            <span class="help-block">{{$user->username}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Estatus</label>
                            <?php $estatus = ($user->estatus == '1')? 'ACTIVO' : 'INACTIVO'; ?>
                            <span class="help-block">{{$estatus}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Fecha de registro</label>                            
                            <span class="help-block">{{$user->fecha_registro}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Empresa</label>                            
                            <span class="help-block">{{$user->empresa}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Giro</label>
                            <span class="help-block">{{$user->giro}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Dirección</label>
                            <span class="help-block">{{$user->direccion}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">                        
                        <div class="form-group">
                            <label class="control-label">Teléfono móvil</label> 
                            <span class="help-block">{{$user->tel_movil}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Teléfono fijo</label>
                            <span class="help-block">{{$user->tel_fijo}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <span class="help-block">{{$user->email}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Motivo o interes</label>
                            <span class="help-block">{{$user->descripcion}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Fecha de activación</label>
                            <span class="help-block">{{$user->fecha_activacion}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Firma de NDA</label>
                            <?php $nda = ($user->nda == '1')? 'SI' : 'NO';?>
                            <span class="help-block">{{$nda}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Rol</label>                            
                            <span class="help-block">{{$user->role()->get()->first()->nombre}}</span>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</div>
@stop

