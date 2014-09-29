<?php

class PreregistroController extends BaseController{
 
    public function getIndex() {
        return View::make('preregistro.index');
    }
    
    public function postIngresa(){
        $rules = array(
            'nombre' => 'required',
            'apellidos' => 'required',
            'empresa' => 'required',
            'giro' => 'required',
            'direccion' => 'required',
            'tel_fijo' => 'required',
            'descripcion' => 'required',
            'email' => 'required|email'
        );
 
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            return Redirect::to('/preregistro')->withInput()->withErrors($validation);
        }
        $username = $this->generateUsername(Input::get('nombre'), Input::get('apellidos'));
        
        $user = new User;
        $user->nombre = Input::get('nombre');
        $user->apellidos = Input::get('apellidos');
        $user->empresa = Input::get('empresa');
        $user->giro = Input::get('giro');
        $user->direccion = Input::get('direccion');
        $user->tel_fijo = Input::get('tel_fijo');
        $user->tel_movil = Input::get('tel_movil', '');
        $user->email = Input::get('email');
        $user->descripcion = Input::get('descripcion');
        $user->username = $username;
        $user->estatus = 0;
        $user->nda = 0;
        $role = Role::where('nombre', '=', 'CLIENTE')->get()->first();
        $user->role_id = $role->id;
        $user->save();
        
        $this->notificaRegistro($user);                
        
        $this->createLogApisa($user, 'Preregistro a la herramienta', 'Se realizó el preregistro a la herramienta el usuario: ');
        
        return Redirect::to('/preregistro/exito')->with('msg', 'Se ha registrado con éxito, recibirá un correo de notificación con el alta definitiva de su usuario por parte de The Open Group México');        
    }
    
    public function getExito()
    {
        return View::make('preregistro.exito');
    }

    private function generateUsername($nombre, $apellidos){
        $unwanted_array = array(    
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $nombre = strtr( $nombre, $unwanted_array );
        $apellidos = strtr( $apellidos, $unwanted_array );
        $ape = explode(' ',trim($apellidos));
        $nom = substr($nombre, 0, 1);
        return strtolower($ape[0] . $nom . rand ( 0 , 100));
    }
    
    private function notificaRegistro($user) {
        $user_array = $user->toArray();
        Mail::send('emails.registered_user', $user_array, function($message){
            $message->to('claudia.guzman@apisamexico.com', 'Claudia Guzmán')->subject('Notificación de registro a The Open Group México');
        });
    }   
}
