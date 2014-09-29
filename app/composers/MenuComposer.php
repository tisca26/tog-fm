<?php

class MenuComposer {

    public function compose($view)
    {
        $user = User::find(Auth::user()->id);
        $role = $user->role()->get()->first();
        $menus = $role->menus()->get();
                
        $view->with('menus', $menus)->with('role', $role);
    }

}

?>