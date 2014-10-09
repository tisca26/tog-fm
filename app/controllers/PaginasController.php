<?php

class PaginasController extends ProtectedController{        
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex()
    {
        return Redirect::to('/');
    }
    
    public function getPagina($idPag) {
        $user_auth = User::find(Auth::user()->id);
        $role = $user_auth->role()->get()->first();
        $menus = $role->menus()->get();
        $menus_array = array();
        foreach ($menus as $menu) {
            array_push($menus_array, $menu->id);
        }
        if(!in_array($idPag, $menus_array)){
            $idPag = $menus->first()->id;
        }
        
        $menu = Menu::find($idPag);
        $archivos = FileApisa::where('menu_id', '=', $idPag)->get();                
                
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'ver página';
        $log->descripcion = 'Ver página ID: ' . $menu->id . ' Nombre: ' . $menu->nombre;
        $log->save();               
        
        return View::make('paginas/pagina')->with('menu', $menu)->with('archivos', $archivos);;
    }
    
    /*
     * Solo se permite 5 descargas por usuario
     */
    public function getDownload($idFile, $idMenu) {                        
        $user_auth = User::find(Auth::user()->id);
        if($user_auth->download_history()->count() > CatalogApisa::$MAX_DOWNLOADS){
            $this->createLogApisa($user_auth->username, "Descarga máxima", "Intentó descargar un archivo pero excedió el límite");
            return View::make('paginas/maximo');
        }
        
        if(DownloadHistory::where('user_id', '=', $user_auth->id)->count() > 0){
            if(DownloadHistory::where('user_id', '=', $user_auth->id)->where('entrega_resena', '=', 0)->orWhere('aprobado', '=', 0)->count() > 0){
                $historial = DownloadHistory::where('user_id', '=', $user_auth->id)->where('entrega_resena', '=', 0)->get()->first();
                $this->createLogApisa($user_auth->username, "Descarga sin reseña", "Intentó descargar un archivo sin subir su reseña o la validación de la misma");
                return View::make('paginas/sin_resena')->with('historial', $historial);
            }
        }
        
        $myFile = FileApisa::find($idFile);
        if($myFile->menu_id != $idMenu){
            $this->createLogApisa($user_auth->username, "Descarga erronea", "Intentó descargar un archivo de otro menu");
            return View::make('paginas/archivo_erroneo');
        }
        $file= public_path(). "/files/" . $myFile->nombre;
        $headers = array( 'Content-Type: ' . $myFile->content_type, );
        $this->createLogApisa($user_auth->username, 'ver documento', 'Ver documento ID: ' . $myFile->id . ' Nombre: ' . $myFile->nombre);
        $history = new DownloadHistory;
        $history->user_id = $user_auth->id;
        $history->file_id = $idFile;
        $history->fecha_descarga = date(DATE_ATOM);
        $history->entrega_resena = 0;
        $history->aprobado = 0;
        $history->save();
        
        return Response::download($file, $myFile->nombre, $headers);
    }
    
    public function postEliminar($idFile){
        $myFile = FileApisa::find($idFile);
        $files = FileApisa::where('nombre', '=', $myFile->nombre)->get();                
        if(count($files) == 1){            
            File::delete(public_path(). "/files/" . $myFile->nombre);
        }
        
        $user_auth = User::find(Auth::user()->id);
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'eliminar documento';
        $log->descripcion = 'Elimina documento ID: ' . $myFile->id . ' Nombre: ' . $myFile->nombre;
        $log->save();
        
        $myFile->delete();
        return 'ok';
    }
    
    public function getEliminarArchivo($idFile){        
        $myFile = FileApisa::find($idFile);
        $files = FileApisa::where('nombre', '=', $myFile->nombre)->get();                
        if(count($files) == 1){            
            File::delete(public_path(). "/files/" . $myFile->nombre);
        }
        $myFile->delete();
        return 'ok';
    }
    
    public function getEnvia() {
        $datos = array(
            'nombre' => 'Gerry'
        );
        $vista = 'emails.test';
        $correo = 'gerry.t26@gmail.com';
        $nombre = "Tis bb";
        $asunto = 'Otro correo sin adjunto';
        $adjunto = public_path() . '/files/test public.pdf';
        $this->enviaCorreo($datos, $vista, $correo, $nombre, $asunto);        
    }
    
    public function getMaximo() {
        return View::make('paginas/maximo');
    }
}
