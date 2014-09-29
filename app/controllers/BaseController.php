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
    
    protected function createLogApisa($user, $accion, $descripcion) {
        $log = new LogApisa;
        $log->username = $user->username;
        $log->accion = $accion;
        $log->descripcion = $descripcion . $user->username;
        $log->save();
    }

}
