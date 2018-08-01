<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable= array('user_id', 'photo');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
