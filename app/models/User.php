<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    protected $fillable = array('username', 'nombre', 'apellidos', 'password');
    
    /*
     * Roles relation by laravel
     */
    public function role()
    {
        return $this->belongsTo('Role');
    }
    
    public function download_history(){
        return $this->hasMany('DownloadHistory', 'user_id');
    }
    
    /*
     * Retrive user and role
     */
    public function getUserWithRole($idUser){
        $query = DB::table('users u')
        ->leftJoin('users_roles ur', 'u.id', '=', 'ur.user_id')
        ->leftJoin('roles r', 'ur.role_id', '=', 'r.id')
        ->where('u.id', '=', $idUser)
        ->first();
        return $query;
    }
    
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }       
}
