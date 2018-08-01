<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
	protected $fillable = array('user_id', 'refer_id');
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function refer()
    {
        return $this->belongsTo('App\User');
    }
}
