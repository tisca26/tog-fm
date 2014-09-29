<?php echo $user . ' -- ' . $password ?>
<div class="col-lg-12">
    <form role="form" id="agrega_usuario_form" action="login/store" method="post">
        <div class="form-group">
            <label class="control-label">Nombre</label>
            <input class="form-control" name="nombre" placeholder="Ingrese el nombre del usuario">
            <span class="help-block" id="nombreMensaje"></span>
        </div>
        <div class="form-group">
            <label>Apellidos</label>
            <input class="form-control" name="apellidos" placeholder="Ingrese los apellidos del usuario">
            <span class="help-block" id="apellidoMensaje"></span>
        </div>
        <div class="form-group">
            <label>Usuario</label>
            <input class="form-control" name="usuario" type="text" placeholder="Ingrese el usuario">
            <span class="help-block" id="usuarioMensaje"></span>
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
                &nbsp;<input type="checkbox" name="estatus" value="1">
            </label>
        </div>        
        <div class="form-group">
            <input type="submit" value="Enviar"> 
        </div>  
    </form>                                         
</div>