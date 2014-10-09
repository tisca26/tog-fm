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
        @if($errors->any())
            <ul>
              {{ implode('', $errors->all('<li>:message</li>'))}}
            </ul>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar usuario
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="agrega_usuario_form" action="{{URL::to('/')}}/users/edit" method="POST">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" name="nombre" value="{{$user->nombre}}" placeholder="Ingrese el nombre del usuario">
                                <span class="help-block" id="nombreMensaje"></span>
                            </div>
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" name="apellidos" value="{{$user->apellidos}}" placeholder="Ingrese los apellidos del usuario">
                                <span class="help-block" id="apellidoMensaje"></span>
                            </div>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input class="form-control" name="username" value="{{$user->username}}" type="text" placeholder="Ingrese el username">
                                <span class="help-block" id="usuarioMensaje"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{$user->email}}" type="text" placeholder="Ingrese el email">                                
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input class="form-control" name="password" type="password" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                                <label>Confirma contraseña</label>
                                <input class="form-control" name="passwordConfirm" type="password" placeholder="Contraseña">
                            </div>
                            <span class="help-block" id="passwordMensaje"></span>
                            <div class="form-group">
                                <label>¿Activo?</label>
                                <label class="checkbox-inline">
                                    {{$checked = '';}}
                                    @if($user->estatus == '1')
                                        <?php $checked = 'checked'; ?>
                                    @endif
                                    &nbsp;<input type="checkbox" name="estatus" value="1" {{$checked}}>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Roles</label>
                                <select class="form-control" name="role_id" >
                                @foreach($roles as $role)
                                    {{$selected = '';}}
                                    @if($role->id == $user->role_id)
                                        {{$selected = 'selected';}}
                                    @endif
                                    <option value="{{$role->id}}" {{$selected}}>{{$role->nombre}}</option>
                                @endforeach                                
                                </select>
                            </div> 
                            <div class="form-group">                            
                                <button type="submit" class="btn btn-default" id="submit_button">Guardar</button>                                
                            </div>
                        </form>                                                               
                    </div>                                
                </div>
            </div>                    
        </div>
    </div>
</div>

<script type="text/javascript" src="{{URL::to('/')}}/assets/js/bootstrapValidator.js"></script>
<script>
$('#agrega_usuario_form').bootstrapValidator({
    container: 'tooltip',
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        nombre: {
            container: '#nombreMensaje',
            validators: {
                notEmpty: {
                    message: 'El nombre es requerido'
                },                
                stringLength: {
                    min: 3, 
                    max: 145,
                    message: 'El nombre debe ser entre 3 y 130 caracteres'
                }
            }
        },
        apellidos: {
            container: '#apellidoMensaje',
            validators: {
                notEmpty: {
                    message: 'Los apellidos son requeridos'
                },
                stringLength: {
                    min: 3, 
                    max: 195,
                    message: 'Los apellidos deben ser entre 3 y 190 caracteres'
                }
            }
        },
        password: {
            validators: {
                identical: {
                    field: 'passwordConfirm',
                    message: 'La contraseña y su confirmación no coinciden'
                }
            }
        },
        passwordConfirm: {
            container: '#passwordMensaje',
            validators: {
                identical: {
                    field: 'password',
                    message: 'La contraseña y su confirmación no coinciden'
                }
            }
        },
        username: {
            container: '#usuarioMensaje',
            validators: { 
                notEmpty: {
                    message: 'El usuario es requerido'
                },
                stringLength: {
                    min: 4,
                    max: 45,                    
                    message: 'El usuario debe ser entre 4 y 45 caracteres'
                }                
            }
        }
    }
})
.find('button[data-toggle]')
    .on('click', function() {
        var $target = $($(this).attr('data-toggle'));
        // Show or hide the additional fields
        // They will or will not be validated based on their visibilities
        $target.toggle();
        if (!$target.is(':visible')) {
            // Enable the submit buttons in case additional fields are not valid
            $('#togglingForm').data('bootstrapValidator').disableSubmitButtons(false);
        }
    });
</script>
@stop