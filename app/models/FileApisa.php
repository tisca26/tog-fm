<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class FileApisa extends Eloquent implements UserInterface, RemindableInterface{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';
    
    public function download_history(){
        return $this->hasMany('Download_history', 'file_id');
    }
    
}
