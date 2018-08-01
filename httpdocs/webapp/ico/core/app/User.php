<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','mobile','balance','tauth','tfver','status','emailv','smsv','vsent','vercode','secretcode','refer', 'photo','country', 'city','address','zip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sell()
    {
        return $this->hasMany('App\Sell', 'id', 'user_id');
    }
}
