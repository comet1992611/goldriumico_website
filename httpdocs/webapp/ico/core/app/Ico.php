<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ico extends Model
{
    protected $table = 'icos';
    protected $fillable = array( 'start','end','quant', 'price','sold','status');

    public function sell()
    {
        return $this->hasMany('App\Sell', 'id', 'ico_id');
    }
}
