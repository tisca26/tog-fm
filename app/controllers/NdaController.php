<?php

class NdaController extends BaseController {       
    
    public function getIndex()
    {    
        if(Auth::check()){
            if(Auth::user()->nda != 1){
                return View::make('nda/index');
            }            
        }
        return Redirect::to('/');
             
    }
    
    public function postIngresa() {
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $user->nda = 1;
            $user->save();
        }
        return Redirect::to('/');
    }
}
