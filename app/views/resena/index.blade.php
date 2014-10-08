@extends('layout')

@section('content')  
<?php 
$role = unserialize (Session::get('role')); 
?>
<style>    
    .progress { 
        position:relative; 
        width:100%; 
        border: 1px solid #ddd; 
        padding: 1px; 
        border-radius: 3px; 
        margin-top: 20px;
    }  
    .bar { 
        background-color: #B4F5B4; 
        width:0%; 
        height:20px; 
        border-radius: 3px;
    }  
    .percent { 
        position:absolute; 
        display:inline-block; 
        top:3px; 
        left:48%; 
    }  
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Carga de reseña
            </h1>
        </div>                
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="panel panel-default">
            @if($msg == 'si')
            <div class="panel-heading">
                Carga de reseña para el archivo <strong>{{$historial->file()->get()->first()->nombre}}</strong>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="form_upload" action="<?php echo URL::to('/'); ?>/resena/carga" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('submit_button').disabled = 1;">
                            <div class="form-group">
                                <label>Solo se aceptan archivos en formato PDF</label>                                
                            </div>                            
                            <div class="form-group">
                                <label>Seleccione el archivo</label>
                                <input type="file" name="file">
                                <input type="hidden" name="download_history_id" value="{{$historial->id}}">
                            </div> 
                            <div class="row">                                            
                                <div class="col-md-3 col-md-offset-11">
                                    <button id="submit_button" type="submit" class="btn btn-default btn-circle btn-xl">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="progress">  
                            <div class="bar"></div >  
                            <div class="percent">0%</div >  
                        </div>  
                        <div id="status"></div>
                    </div>                                
                </div>
            </div>
            @else
            <div class="panel-heading">
                No ha descargado ningún documento
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="form_upload">
                            <div class="form-group">
                                <label>No ha descargado ningún documento.</label>
                            </div>
                        </form>                        
                    </div>                                
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- /.row -->
</div>
<script src="<?php echo URL::to('/'); ?>/assets/js/jquery.form.js"></script>  
    
<script>
    (function() {  
        var bar = $('.bar');  
        var percent = $('.percent');  
        var status = $('#status');  
        $('form').ajaxForm({  
            beforeSend: function() {
                status.empty();
                status.html('Espere por favor...'); 
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {  
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },  
            complete: function(xhr) {  
                bar.width("100%");
                percent.html("100%");
                status.html(xhr.responseText);                    
                $('form').find("input").val("");
                document.getElementById('submit_button').disabled = 0;
            }  
        }); 
    })();

    function foobar_cont(){
        console.log("Listo.");
    };
    function sleep(millis, callback) {
        setTimeout(function()
                { callback(); }
        , millis);
    }
</script>

@stop