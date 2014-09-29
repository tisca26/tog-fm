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

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if(Session::has('msg'))
                <div class="login-panel panel panel-success">
                @else
                <div class="login-panel panel panel-danger"> 
                @endif                
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Registro a The Open Group México</h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="form-group" style="text-align: justify;">
                                @if(Session::has('msg'))
                                <strong>{{Session::get('msg')}}</strong>
                                @else
                                <strong>Ocurrió un error en su registro, por favor vuelva a intentarlo.</strong>
                                @endif
                                <br />
                                <p>
                                    Puede ir al <a href="{{URL::to('/')}}">ingreso</a> o visite el sitio <a href="http://theopengroup.org">oficial</a>.
                                </p>                                
                            </div>
                        </fieldset>
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

</body>

</html>

