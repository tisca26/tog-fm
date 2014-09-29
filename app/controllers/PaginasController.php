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
    
    public function getDownload($idFile) {        
        
        $myFile = FileApisa::find($idFile);
        $file= storage_path(). "/uploads/" . $myFile->nombre;
        $headers = array(
              'Content-Type: ' . $myFile->content_type,
            );
        
        $user_auth = User::find(Auth::user()->id);
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'ver documento';
        $log->descripcion = 'Ver documento ID: ' . $myFile->id . ' Nombre: ' . $myFile->nombre;
        $log->save();
        
        return Response::download($file, $myFile->nombre, $headers);
    }
    
    public function postEliminar($idFile){
        $myFile = FileApisa::find($idFile);
        $files = FileApisa::where('nombre', '=', $myFile->nombre)->get();                
        if(count($files) == 1){            
            File::delete(storage_path(). "/uploads/" . $myFile->nombre);
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
            File::delete(storage_path(). "/uploads/" . $myFile->nombre);
        }
        $myFile->delete();
        return 'ok';
    }
}
