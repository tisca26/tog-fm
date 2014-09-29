<?php

class ProtectedController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => 'getLogin'));
        $this->beforeFilter('nda', array('except' => 'getNda'));
    }
}
?>