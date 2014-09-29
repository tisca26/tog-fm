<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>The Open Group México</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo URL::to('/'); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL::to('/'); ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo URL::to('/'); ?>/assets/img/favicon.ico">
    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo URL::to('/'); ?>/assets/css/sb-admin.css" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <?php 
    $user = '';
    $session = FALSE;
    ?>
    @if(Session::has('user'))
    <?php 
    $user = unserialize(Session::get('user')); 
    $session = TRUE;
    ?>   
    @endif
    @include('parts.top-preregistro')
    <div class="container" style="margin-top: 130px;">        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="login-panel panel panel-default" style="margin-top: 5%">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Registro a The Open Group México</strong></h3>
                    </div>
                    <div class="panel-body">                        
                        <form role="form" id="loginForm" action="<?php echo URL::to('/'); ?>/preregistro/ingresa" method="POST">
                            <fieldset>
                                <p class="text-danger">Los campos marcados con * son obligatorios.</p>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input class="form-control" placeholder="Nombre" name="nombre" type="text" id="nombre" value="{{($session)? $user->getFirstName() : ''}}" autofocus>
                                        <span class="help-block" id="nombreMensaje"></span>
                                    </div>                                    
                                </div>  
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label>Apellidos*</label>
                                        <input class="form-control" placeholder="Apellidos" name="apellidos" type="text" id="apellidos" value="{{($session)? $user->getLastName() : ''}}">
                                        <span class="help-block" id="apellidoMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Empresa*</label>(Ingrese "Persona física" en caso de no querer registrar a su empresa)                                    
                                        <input class="form-control" placeholder="Empresa o Persona física" name="empresa" type="text" id="empresa">
                                        <span class="help-block" id="empresaMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Giro*</label>
                                        <textarea class="form-control" placeholder="Giro" name="giro" rows="4" id="giro"></textarea>
                                        <span class="help-block" id="giroMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección*</label>
                                        <input class="form-control" placeholder="Dirección" name="direccion" type="text" id="direccion">
                                        <span class="help-block" id="direccionMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono fijo*</label>
                                        <input class="form-control" placeholder="Teléfono fijo" name="tel_fijo" type="text" id="tel_fijo">
                                        <span class="help-block" id="tel_fijoMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Teléfono móvil</label>
                                        <input class="form-control" placeholder="Teléfono móvil" name="tel_movil" type="text" id="tel_movil">
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>E-mail*</label>
                                        <input class="form-control" placeholder="E-mail" name="email" type="text" id="email">
                                        <span class="help-block" id="emailMensaje"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Describa brevemente la razón por la cual desea unirse a este grupo*</label>                                    
                                        <textarea class="form-control" placeholder="Describa su interes" name="descripcion" id="descripcion" rows="4"></textarea>
                                        <span class="help-block" id="descripcionMensaje"></span>
                                    </div>
                                </div>                                    
                                
                                <div class="col-md-4">
                                    <div class="form-group">                            
                                        <a href="{{URL::to('/')}}" type="submit" class="btn btn-outline btn-primary col-md-12" id="submit_button">Inicio</a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="form-group">                            
                                        <button type="submit" class="btn btn-outline btn-primary col-md-12" id="submit_button">Enviar</button>
                                    </div>
                                </div>                                                                                            
                            </fieldset>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo URL::to('/'); ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo URL::to('/'); ?>/assets/js/sb-admin.js"></script>
    <script type="text/javascript" src="{{URL::to('/')}}/assets/js/bootstrapValidator.js"></script>
    <script>
    $('#loginForm').bootstrapValidator({
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
                    },                    
                    regexp: {
                        regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/i,
                        message: 'El nombre solo puede contener caracteres alfabéticos y espacios'
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
                    },                    
                    regexp: {
                        regexp: /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/i,
                        message: 'El apellido solo puede contener caracteres alfabéticos y espacios'
                    }
                }
            },            
            empresa: {
                container: '#empresaMensaje',
                validators: { 
                    notEmpty: {
                        message: 'La empresa es requerida'
                    },
                    stringLength: {
                        min: 4,
                        max: 230,                    
                        message: 'La empresa debe ser entre 4 y 230 caracteres'
                    }                
                }
            },
            giro: {
                container: '#giroMensaje',
                validators: { 
                    notEmpty: {
                        message: 'El giro es requerido'
                    },
                    stringLength: {
                        min: 4,
                        max: 230,                    
                        message: 'El giro debe ser entre 4 y 230 caracteres'
                    }                
                }
            },
            direccion: {
                container: '#direccionMensaje',
                validators: { 
                    notEmpty: {
                        message: 'La dirección es requerida'
                    },
                    stringLength: {
                        min: 4,
                        max: 230,                    
                        message: 'La dirección debe ser entre 4 y 230 caracteres'
                    }                
                }
            },
            tel_fijo: {
                container: '#tel_fijoMensaje',
                validators: { 
                    notEmpty: {
                        message: 'El teléfono fijo es requerido'
                    },
                    regexp: {
                        regexp: /^\d{10,15}$/i,
                        message: 'El número solo debe tener dígitos y debe ser con clave LADA'
                    }               
                }
            },
            email: {
                container: '#emailMensaje',
                validators: { 
                    notEmpty: {
                        message: 'El email es requerido'
                    },
                    emailAddress: {
                        message: 'No es un correo válido'
                    }               
                }
            },
            descripcion: {
                container: '#descripcionMensaje',
                validators: { 
                    notEmpty: {
                        message: 'La descripcion es requerida'
                    },
                    stringLength: {
                        min: 4,
                        max: 230,                    
                        message: 'La descripcion debe ser entre 4 y 230 caracteres'
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
    <noscript>
        Necesita tener JavaScript activado
    </noscript>

</body>

</html>