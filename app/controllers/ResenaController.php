<?php

class ResenaController extends ProtectedController{        
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex()
    {
        $historial = '';
        $msg = 'no';
        if(DownloadHistory::where('user_id', '=', Auth::user()->id)->count() > 0){
            if(DownloadHistory::where('user_id', '=', Auth::user()->id)->where('entrega_resena', '=', 0)->count() > 0){
                $msg = 'si';
                $historial = DownloadHistory::where('user_id', '=', Auth::user()->id)->where('entrega_resena', '=', 0)->get()->first();
                $this->createLogApisa(Auth::user()->username, "Descarga sin reseña", "Intentó descargar un archivo sin subir su reseña");                
            }
        }
        
        return View::make('resena.index')->with('msg', $msg)->with('historial', $historial);
    }
    
    public function getValidacion() {
        if(Auth::user()->role_id == 1){
            $modal_array = array();
            $download_history = DownloadHistory::where('entrega_resena', '=', 1)->where('aprobado', '=', 0)->get();
            foreach ($download_history as $dh) {
                $review = Review::where('download_history_id', '=', $dh->id)->orderBy('id', 'DESC')->first();
                $obj = new stdClass();
                $obj->download_history = $dh;
                $obj->review = $review;
                array_push($modal_array, $obj);
            }
            return View::make('resena.validacion')->with('descargas', $modal_array);
        }
        
        return Redirect::to('/');
    }
    
    public function postAprobacion() {
        $dh = Input::get('download_history_id');
        $download_history = DownloadHistory::find($dh);
        $download_history->aprobado = 1;
        $download_history->save();
        return Redirect::to('/resena/validacion');
    }
    
    public function postRechazo() {
        $dh = Input::get('download_history_id');
        $download_history = DownloadHistory::find($dh);
        $download_history->entrega_resena = 0;
        $download_history->save();
        return Redirect::to('/resena/validacion');
    }
    
    public function postCarga() {
        if (empty($_FILES['file']['name'])){
            echo "sin_archivo";
            die;
        }        
        $allowedExts = array( "pdf", 'PDF');
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);        

        if ($_FILES["file"]["type"] != "" && $_FILES["file"]["type"] != NULL && in_array($extension, $allowedExts)) {
          if ($_FILES["file"]["error"] > 0) {
            echo "Código de error: " . $_FILES["file"]["error"] . "<br />";
          } else {
            $nombreArchivo = Auth::user()->id . '-' . $this->limpiaCadena($_FILES["file"]["name"]);
            if (file_exists(public_path() . '/resenas/' . $nombreArchivo)) {
//                echo '<p style="color:red;">Estatus: Error </p>';
//                echo $nombreArchivo . " ya existe. ";
                $nombreArchivo = '(' . $this->contarArchivosIguales($nombreArchivo) . ')-' . $nombreArchivo;
            }
                           
            Input::file('file')->move(public_path() . '/resenas/', $nombreArchivo);
            //move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__. "/storage/uploads/" . $nombreArchivo);
            $review = new Review;
            $review->nombre = $nombreArchivo;
            $review->fecha_creacion = date(DATE_ATOM);
            $review->archivo = $nombreArchivo;
            $review->content_type = Input::file('file')->getClientMimeType();
            $review->download_history_id = Input::get('download_history_id');
            $review->save();                
            echo "<h4>Muchas gracias por su reseña, en 24 hrs recibirá una aprobación de la misma para que pueda continuar descargando archivos.</h4>";
            echo "Archivo cargado: " . $nombreArchivo . "<br>";
            echo "Tipo: " . $_FILES["file"]["type"] . "<br>";
            echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo '<p style="color:green;">Estatus: OK </p>';

            $download_history = DownloadHistory::find(Input::get('download_history_id'));
            $download_history->entrega_resena = 1;
            $download_history->save();
            $this->notificaEnvio($nombreArchivo, $download_history->file()->get()->first()->nombre);
            
          }
        } else {
            echo '<p style="color:red;">Estatus: Error </p>';            
            echo "Tipo: " . $_FILES["file"]["type"] . "<br>";
            echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Archivo no válido";                     
        }
    }
    
    private function notificaDictaminaconResena($usuario, $dictaminacion) {
        $datos = array(
            'nombre'        => $usuario->nombre . ' ' . $usuario->apellidos            
        );
        $vista = 'emails.dictaminacion_resena';
        $correo = 'notificaciones@opengroup.org.mx';        
        $nombre = "Claudia Guzmán Moreno";
        $asunto = 'Notificación de dictaminación de reseña';        
        $this->enviaCorreo($datos, $vista, $correo, $nombre, $asunto);        
    }
    
    private function notificaEnvio($nombreArchivo, $nombreArchivoDescarga) {
        $datos = array(
            'nombre'            => Auth::user()->nombre . ' ' . Auth::user()->apellidos,
            'username'          => Auth::user()->username,
            'email'             => Auth::user()->email,
            'archivoDescarga'   => $nombreArchivoDescarga
        );
        $vista = 'emails.entrega_resena';
        $correo = 'notificaciones@opengroup.org.mx';        
        $nombre = "Claudia Guzmán Moreno";
        $asunto = 'Notificación de carga de reseña';
        $adjunto = public_path() . '/resenas/' . $nombreArchivo;
        $this->enviaCorreo($datos, $vista, $correo, $nombre, $asunto, $adjunto);        
    }
    
    private function contarArchivosIguales($nombreArchivo) {
        $i = 0; 
        $dir = public_path() . '/resenas/';
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false){
                if (!in_array($file, array('.', '..')) && !is_dir($dir.$file) && $file == $nombreArchivo){
                    $i++;
                }                    
            }
        }
        // prints out how many were in the directory
        return $i;
    }
}
