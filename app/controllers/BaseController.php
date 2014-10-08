<?php

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
                $this->layout = View::make($this->layout);
        }
    }   
    
    protected function createLogApisa($username, $accion, $descripcion) {
        $log = new LogApisa;
        $log->username = $username;
        $log->accion = $accion;
        $log->descripcion = $descripcion . $username;
        $log->save();
    }
    
    protected function enviaCorreo($datos, $vista, $correo, $nombre, $asunto, $adjunto = '') {
        $data = array(
            'correo'    =>  $correo,
            'nombre'    =>  $nombre,
            'asunto'    =>  $asunto,
            'adjunto'   =>  $adjunto
        );
        \Mail::send($vista, $datos, function($message) use ($data)
            {
                $message->to($data['correo'], $data['nombre'])->
                subject($data['asunto']);
                if($data['adjunto'] != '')
                {
                    $message->attach($data['adjunto']);
                }
                
            }
        );
    }
    
    protected function notificaRegistro($user, $correo, $nombre, $asunto) {
        $user_array = $user->toArray();
        $data = array(
            'correo' => $correo,
            'nombre' => $nombre,
            'asunto' => $asunto
        );
        \Mail::send('emails.registered_user', $user_array, function($message) use ($data)
            {
                $message->to($data['correo'], $data['nombre'])->
                subject($data['asunto']);
            }
        );
    }
    
    protected function limpiaCadena($cadena) {
        $unwanted_array = array(    
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $cadena_limpia = strtr( $cadena, $unwanted_array );
        return $cadena_limpia;
    }

}
