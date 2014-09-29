@extends('layout')

@section('content') 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menus</h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar rol
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="agrega_rol_form" action="{{URL::to('/')}}/menus/insert" method="POST">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" name="nombre" placeholder="Ingrese el nombre del menú">
                                <span class="help-block" id="nombreMensaje"></span>
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
    $('#agrega_rol_form').bootstrapValidator({
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