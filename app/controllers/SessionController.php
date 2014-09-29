<?php

use \Facebook\FacebookSession;
use \Facebook\FacebookRedirectLoginHelper;
use \Facebook\FacebookRequest;
use \Facebook\GraphUser;

session_start();
FacebookSession::setDefaultApplication('720066458042122','576a44571d734ec6499927e1afd32a60');
class SessionController extends BaseController {

    public function getIndex()
    {        
        if(Auth::check()){
            Auth::logout();
        }
        $helper = new FacebookRedirectLoginHelper(URL::to('/') . '/login/fb-callback');
        return View::make('login/session')->with('helper', $helper);
    }           
    
    public function getGuarda()
    {        
        return View::make('login/store');
    }
    
    public function postIngresa()
    {
        if (Auth::attempt(array('username' => Input::get('email'), 'password' => Input::get('password'), 'estatus' => '1' )))
        {            
            return $this->preparaIndex();
        }
        return View::make('login/session_bad')->with('user', Input::get('email'));
    }
    
    public function getLogout()
    {		
        Auth::logout();
        return Redirect::to('/login');
    }
    
    public function getFb()
    {
        
        $helper = new FacebookRedirectLoginHelper(URL::to('/') . '/login/fb-callback');
        return View::make('test-fb')->with('helper', $helper);
    }
    
    public function getFbCallback()
    {		
        $helper = new FacebookRedirectLoginHelper(URL::to('/') . '/login/fb-callback');
        try {
          $session = $helper->getSessionFromRedirect();
        } catch(FacebookRequestException $ex) {
          // When Facebook returns an error
        } catch(\Exception $ex) {
          // When validation fails or other local issues
        }
        if ($session) {
          // Logged in
            try {
                $user_profile = (new FacebookRequest(                        
                        $session, 'GET', '/me'
                    ))->execute()->getGraphObject(GraphUser::className());		                
                $params = array( 'next' => URL::to('/') . '/login' );
                //return View::make('test')->with('msg', $user_profile->getName())->with('url', $helper->getLogoutUrl($session, $params));
                return $this->existeUsuarioPorFb($user_profile);
            } catch(FacebookRequestException $e) {
//                echo "Exception occured, code: " . $e->getCode();
//                echo " with message: " . $e->getMessage();
                return View::make('test')->with('msg', $e->getCode() . ' <--> ' . $e->getMessage());
            }
        }
    }
    
    private function existeUsuarioPorFb($user_profile)
    {
        $count = User::where('username', '=', $user_profile->getId())->count();
        if ($count > 0){
            if (Auth::attempt(array('username' => $user_profile->getId(), 'password' => '4CC3S4C0NFb', 'estatus' => '1' )))
            {            
                return $this->preparaIndex();
            }
        }else{
            //levar a preregistro con info del perfil
            $user_profile = serialize($user_profile);
            return Redirect::to('/preregistro')->with('user', $user_profile);
        }
    }
    
    private function preparaIndex() {
        $user = User::find(Auth::user()->id);
        $role = $user->role()->get()->first();
        $this->createLogApisa($user->username, 'ingreso', 'Ingreso a la herramienta');
        if(Auth::user()->nda != 1){
            return Redirect::to('/nda');
        }
        $direccion = '';
        if($role->nombre == "ADMINISTRADOR" || $role->nombre == "INTERNO")
        {
            $direccion = '/';
        }else{
            $menu = $role->menus()->get()->first();
            $direccion = '/paginas/' . $menu->id;
        }
        return Redirect::to($direccion)->with('user', serialize($user))->with('role', serialize($role));
    }
    
    private function simpleLogin($user_profile) {
        
    }
    /*
    public function anyLogin()
    {
        //
    }
    */
}
?>