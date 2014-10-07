<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class DownloadHistory extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    
    protected $table = 'download_history';
    public $timestamps = false;
    
    public function review() {
        return $this->hasMany('Review', 'download_history_id');
    }
    
    public function user(){
        return $this->belongsTo('User', 'user_id');
    }
    
    public function file(){
        return $this->belongsTo('FileApisa', 'file_id');
    }
}
