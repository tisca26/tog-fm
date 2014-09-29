<?php

class RoleController extends ProtectedController{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getIndex()
    {
        $roles = Role::all();
        return View::make('roles/roles')->with('roles', $roles);
    }
    
    public function getInsert()
    {
        return View::make('roles/insert');
    }
    
    public function postInsert(){
        $name = Input::get('nombre');
        $role = new Role;
        $role->nombre = $name;
        $role->save();
        return Redirect::to('/roles')->with('inserted', 'Se insertó el rol correctamente');
    }
    
    public function postMenus()
    {
        $role = Role::find(Input::get('idRol'));
        $menus_role = $role->menus()->get();
        $menus = Menu::all();
        $menus_role_array = array();
        foreach($menus_role as $menu){
            array_push($menus_role_array, $menu->id);
        }
        return View::make('roles/seleccion_menus')->with('role', $role)->with('menus', $menus)->with('menus_role', $menus_role_array);
    }
    
    public function postStoreMenus()
    {
        $idRol = $_POST['idRol'];
        if (isset($_POST["menus"]) && !empty($_POST["menus"])) {
            $menus = $_POST['menus'];
            DB::table('roles_menus')->where('role_id', '=', $idRol)->delete();
            foreach ($menus as $value) {
                DB::table('roles_menus')->insert(
                    array('role_id' => $idRol, 'menu_id' => $value)
                );                
            }
            echo "Se guardaron los menús con éxito";
        }else{
            DB::table('roles_menus')->where('role_id', '=', $idRol)->delete();            
            echo "Se guardaron los menús con éxito";            
        }
    }
}
