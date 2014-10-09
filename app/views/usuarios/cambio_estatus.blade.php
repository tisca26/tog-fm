@extends('layout')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuarios</h1>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Notificación de usuarios
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="agrega_usuario_form" action="{{URL::to('/')}}/users/notifica" method="POST">
                            <div class="form-group">
                                <label class="control-label">
                                    Se detectó que el estatus de {{$user->nombre . ' ' . $user->apellidos}} ha cambiado. <br />
                                    ¿Desea que se le notifique a dicho usuario via correo electrónico?
                                </label>
                                <input type="hidden" name="pass" value="{{$pass}}">
                                <input type="hidden" name="fb" value="{{$fb}}">
                                <input type="hidden" name="user_id" value="{{$user->id}}">                                
                            </div>                             
                            <div class="form-group">                            
                                <button type="submit" class="btn btn-danger" id="submit_button">Si</button>
                                <a class="btn btn-default" href="{{URL::to('/')}}/users">No</a>
                            </div>
                        </form>                                                               
                    </div>                                
                </div>
            </div>                    
        </div>
    </div>
</div>
@stop