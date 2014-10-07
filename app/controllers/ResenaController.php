<?php

class ResenaController extends ProtectedController{        
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex()
    {
        $msg = 'no';
        if(DownloadHistory::where('user_id', '=', Auth::user()->id)->count() > 0){
            if(DownloadHistory::where('user_id', '=', $user_auth->id)->where('entrega_resena', '=', 0)->count() > 0){
                $historial = DownloadHistory::where('user_id', '=', $user_auth->id)->where('entrega_resena', '=', 0)->get()->first();
                $this->createLogApisa($user_auth->username, "Descarga sin reseña", "Intentó descargar un archivo sin subir su reseña");
                return View::make('paginas/sin_resena')->with('historial', $historial);
            }
        }
        
        return View::make('resena.index')->with('msg', $msg);
    }
    
}
