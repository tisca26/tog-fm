<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            Estos son los menús para {{$role->nombre}} <br />            
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12"> 
                    <form role="form" id="form_menus">
                        <div class="form-group">
                            <label>Menus disponibles</label><br />                            
                            @foreach ($menus as $menu)
                                <div class="col-md-6">
                                    <label class="checkbox-inline">
                                        <?php
                                        $checked = '';
                                        if(in_array($menu->id, $menus_role)){
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="menus[]" value="{{$menu->id; ?>}}" {{$checked}}> {{$menu->nombre}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="idRol" value="{{$role->id}}" >
                        <div class="row">
                            <div class="col-md-3 col-md-offset-10">
                                <button type="button" class="btn btn-outline btn-primary" id="submit_button">Guardar</button>
                            </div>
                        </div>                        
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#submit_button').click(function(){        
        $.ajax({
            type: "POST",
            url: "{{URL::to('/') . '/roles/store-menus'}}",            
            data: $('#form_menus').serialize()
        })
        .done(function( msg ) {
            alert(msg);      
        })
        .fail(function( msg ) {
            alert( "Falló al momento de guardar");
        });
    });
    
</script>