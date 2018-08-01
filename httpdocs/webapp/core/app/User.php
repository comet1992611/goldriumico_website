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
       'refid','package_id', 'username', 'password', 'balance', 'firstname', 'lastname', 'date', 'address', 'city', 'postcode', 'country', 'mobile','bitcoin','docv', 'email', 'status', 'paystatus', 'trxpin','gtfa','tfav','emailv','smsv','vsent', 'vercode', 'forgotcode','secretcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function referby()
    {
        return $this->hasOne('App\User', 'id', 'refid');
    }

    public function avatar()
    {
        return $this->hasOne('App\Avatar', 'id', 'user_id');
    }

    public function docver()
    {
        return $this->hasOne('App\Docver', 'id', 'user_id');
    }

    public function soldb()
    {
        return $this->hasMany('App\Soldb', 'id', 'user_id');
    }

    public function uaccount()
    {
        return $this->hasMany('App\Uaccount', 'id', 'user_id');
    }

    public function withdraw()
    {
        return $this->hasMany('App\Withdraw');
    }

    public function deposit()
    {
        return $this->hasMany('App\Deposit','id','user_id');
    }

    public function ginvest()
    {
        return $this->hasMany('App\Ginvest','id','user_id');
    }


    public function uwdlog()
    {
        return $this->hasMany('App\Uwdlog');
    }

    public function upuser()
    {
        return $this->hasMany('App\Upgrade', 'id', 'user_id');
    }

    public function uprefer()
    {
        return $this->hasMany('App\Upgrade', 'id', 'refer_id');
    }

   
}
