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
        $rules = array(
            'nombre' => 'required',
            'apellidos' => 'required',
            'username' => 'required'
        );
 
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            return Redirect::to('/users/edit/' . Input::get('user_id'))->withErrors($validation)->withInput();
        }
 
        $user = User::find(Input::get('user_id'));
        $user->nombre = Input::get('nombre');
        $user->apellidos = Input::get('apellidos');
        $user->username = Input::get('username');
        if(is_numeric($user->username)){
            $user->password = Hash::make('4CC3S4C0NFb');
        }else{
            $user->password = (Input::get('password') == '')? $user->password : Hash::make(Input::get('password'));
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
        
        return Redirect::to('/users')->with('msg', 'El usuario ha sido editado');
    }
    
    public function anyLogin()
    {
        //
    }

}
?>