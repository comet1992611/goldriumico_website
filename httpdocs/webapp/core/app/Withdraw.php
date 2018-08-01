<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{

     public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function wdmethod()
    {
        return $this->belongsTo('App\Wdmethod');
    }

    protected $fillable = array('wdid', 'user_id', 'amount','charge', 'wdmethod_id', 'details', 'status');
}
