<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uaccount extends Model
{
    protected $table = 'uaccounts';
    protected $fillable = array( 'user_id','accnum', 'type','amount');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
