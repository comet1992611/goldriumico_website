<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = ['gateway_id','user_id','trxid','inusd','amount','charge','bcam','bcid','status','details'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function gateway()
    {
        return $this->belongsTo('App\Gateway');
    }
}
