<?php

class MenusController extends ProtectedController {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex() 
    {
        $menus = Menu::all();
        return View::make('menus/menus')->with('menus', $menus);
    }
    
    public function getInsert()
    {
        return View::make('menus/insert');
    }
    
    public function postInsert()
    {
        $menu = new Menu;
        $menu->nombre = Input::get('nombre');
        $menu->save();
        
        $user_auth = User::find(Auth::user()->id);
        $log = new LogApisa;
        $log->username = $user_auth->username;
        $log->accion = 'alta menú';
        $log->descripcion = 'Da de alta el menú ' . $menu->nombre;
        $log->save();
        
        return Redirect::to('/menus')->with('msg', 'El menú ha sido insertado');
    }
}
