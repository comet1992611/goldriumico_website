<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wdmethod extends Model
{
     protected $fillable = array('name','logo' ,'prtime', 'minamo', 'maxamo', 'chargefx', 'chargepc', 'status');

    public function withdraw()
    {
        return $this->hasMany('App\Withdraw');
    }
}
