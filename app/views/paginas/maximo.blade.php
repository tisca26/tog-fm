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
    <!-- Page-Level Plugin CSS - Buttons -->
    <link href="<?php echo URL::to('/'); ?>/assets/css/plugins/social-buttons/social-buttons.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-danger">                    
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <img src="{{URL::to('/')}}/assets/img/tog logo.png" style="width: 5%;">
                            The Open Group México
                        </h3>
                    </div>
                    <div class="panel-body">                        
                        <p>
                            Lo sentimos, ha excedido el límite de descargas.                            
                        </p>
                        <p>
                            Lo invitamos a unirse a The Open Group para obtener todos los beneficios que esto tiene. 
                        </p>
                        <p>
                            Ingrese a <a href="http://opengroup.org/getinvolved/becomeamember/goldsilver">The Open Group</a> y sea parte de esta gran comunidad.
                        </p>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <style>
        html, body, container { 
            background-color: white;
            background-image: url('{{URL::to("/")}}/assets/img/tog opa.png');              
            background-attachment: fixed;            
        }
    </style>
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo URL::to('/'); ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo URL::to('/'); ?>/assets/js/sb-admin.js"></script>

</body>

</html>

