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
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-success" style="margin-top: 60px;">                              
                    <div class="panel-heading" style="text-align: center;">
                        <h3 class="panel-title">Terminos y condiciones</h3>
                    </div>
                    <div class="panel-body" id="nda">
                        <fieldset>
                            <div class="form-group" style="text-align: justify;" >                                
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, 
                                    ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,
                                    fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, j
                                    usto. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper
                                    nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                                    Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius 
                                    laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies 
                                    nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                    sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
                                    Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                    Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales
                                    sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a 
                                    libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                    Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis 
                                    in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium
                                    turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices
                                    mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus 
                                    ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean
                                    ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, 
                                    pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam 
                                    imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. 
                                    Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent
                                    congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus 
                                    velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, 
                                    nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer
                                    vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede 
                                    sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, 
                                    nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat 
                                    a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero
                                    volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus e
                                    t ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas 
                                    vestibulum mollis
                                </p>                                
                            </div>
                            <form role="form" id="loginForm" action="{{URL::to('/')}}/nda/ingresa" method="POST">
                                <div class="form-group">                                    
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Aceptar</button>
                                    <a href="{{URL::to('/')}}/login" class="btn btn-lg btn-danger btn-block">Regresar</a>
                                </div>
                            </form>
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
    <style>
        html, body, container { 
            background-color: white;
            background-image: url('{{URL::to("/")}}/assets/img/tog opa.png');              
            background-attachment: fixed;            
        }
        #nda{
            max-height: 500px;
            overflow-y:scroll; 
        }
    </style>
</body>

</html>

