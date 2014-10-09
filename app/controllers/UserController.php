<?php

class UserController extends ProtectedController {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex()
    {        
        $users = User::all();
        $roles = Role::all();
        return View::make('usuarios/users')->with('users', $users)->with('roles', $roles);
    }

    public function getInsert()
    {       
        $roles = Role::all();
        return View::make('usuarios/insert')->with('roles', $roles);
    }

    public function getShow($idUser){
        $user = User::find($idUser);
        return View::make('usuarios/show')->with('user', $user);
    }
    
    public function postInsert()
    {
        $rules = array(
            'nombre' => 'required',
            'apellidos' => 'required',
            'username' => 'required',
            'password' => 'required'
        );
 
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            return Redirect::to('/users/insert')->withInput()->withErrors($validation);
        }
 
        $user = new User;
        $user->nombre = Input::get('nombre');
        $user->apellidos = Input::get('apellidos');
        $user->username = Input::get('username');
        $user->password = (is_numeric($user->username))? Hash::make('4CC3S4C0NFb') : Hash::make(Input::get('password'));
        $user->estatus = Input::get('estatus', '0');
        $user->role_id = Input::get('role_id');
        $user->save();
        
        $user_auth = User::find(Auth::user()->id);
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'alta usuario';
        $log->descripcion = 'Da de alta a ' . $user->username;
        $log->save();
        
        return Redirect::to('/users')->with('msg', 'El usuario ha sido insertado');
        
    }
    
    public function getEdit($idUser)
    {
        $user = User::find($idUser);
        $roles = Role::all();
        return View::make('usuarios/edit')->with('roles', $roles)->with('user', $user);
    }
    
    public function postEdit() {
        $l_cambioDeEstatus = 'no';
        $l_porFb = FALSE;        
        $rules = array(
            'nombre' => 'required',
            'apellidos' => 'required',
            'username' => 'required',
            'email' => 'required'
        );
 
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            return Redirect::to('/users/edit/' . Input::get('user_id'))->withErrors($validation)->withInput();
        }
 
        $user = User::find(Input::get('user_id'));
        $user->nombre = Input::get('nombre');
        $user->apellidos = Input::get('apellidos');
        $user->email = Input::get('email');
        $user->username = Input::get('username');
        $l_password = Input::get('password', '');
        if(is_numeric($user->username)){
            $user->password = Hash::make('4CC3S4C0NFb');
            $l_porFb = TRUE;
        }else{
            $user->password = ($l_password == '')? $user->password : Hash::make($l_password);
        }        
        if($user->estatus == 0 && Input::get('estatus') == 1){
            $l_cambioDeEstatus = 'activado';
            $user->fecha_activacion = date(DATE_ATOM);
        }
        if($user->estatus == 1 && Input::get('estatus') == 0){
            $l_cambioDeEstatus = 'desactivado';
            $user->fecha_activacion = '';
        }
        
        $user->estatus = Input::get('estatus', '0');
        $user->role_id = Input::get('role_id');
        $user->save();
        
        $user_auth = User::find(Auth::user()->id);
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'editar usuario';
        $log->descripcion = 'Edita al usuario ' . $user->username;
        $log->save();
        
        switch ($l_cambioDeEstatus){
            case 'activado':
                return View::make('usuarios.cambio_estatus')->with('user', $user)->with('pass', $l_password)->with('fb', $l_porFb);
            break;
            case 'desactivado':
                return View::make('usuarios.cambio_estatus_des')->with('user', $user);
            break;
            default :
                return Redirect::to('/users')->with('msg', 'El usuario ha sido editado');
        }                
    }
    
    public function postNotifica() {
        $fb = Input::get('fb', FALSE);
        $pass = Input::get('pass', '');
        $des = Input::get('des', FALSE);
        $user = User::find(Input::get('user_id'));
        $vista = $fb? 'emails.notifica_activacion_usuario_fb' : 'emails.notifica_activacion_usuario';
        $vista = $des? 'emails.notifica_desactivacion_usuario'  : $vista;
        $this->notificaEnvio($user->nombre, $user->apellidos, $user->username, $user->email, $pass, $vista);
        return Redirect::to('/users')->with('msg', 'El usuario ha sido editado y fue notificado correctamente');
    }
    
    private function notificaEnvio($nombre, $apellidos, $username, $email, $pass, $vista_final) {
        $datos = array(
            'nombre'            => $nombre . ' ' . $apellidos,
            'username'          => $username,            
            'pass'              => $pass
        );
        $vista = $vista_final;
        $correo = $email;
        $nombre = $nombre . ' ' . $apellidos;
        $asunto = 'Notificación The Open Group México';        
        $this->enviaCorreo($datos, $vista, $correo, $nombre, $asunto);
    }
    
    public function anyLogin()
    {
        //
    }

}
?>