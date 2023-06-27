<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id'
    
    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'email_verified_at',
        'password',
        'mobile_phone',
        'last_login_time',
        'status',
        'is_logged_in',
        'last_active_time',
        'is_deleted'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDatabases(){
        return $this->hasMany('App\Models\UserDatabase');
    }

    public function userLoginLogs(){
        return $this->hasMany('App\Models\UserLoginLog','email','email');
    }



}
