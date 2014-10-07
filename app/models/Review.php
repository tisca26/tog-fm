<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Review extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    
    protected $table = 'review';
    public $timestamps = false;
    
    public function download_history() {
        return $this->belongsTo('Download_history', 'download_history_id');
    }
}
