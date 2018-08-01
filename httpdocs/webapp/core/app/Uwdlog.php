<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uwdlog extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     protected $fillable = array('user_id', 'trxid', 'amount','balance','toacc','charge','flag','status', 'desc');

}
