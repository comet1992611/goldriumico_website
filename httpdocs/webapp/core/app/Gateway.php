<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
	
   protected $fillable = array(
   								'name','gateimg', 'minamo', 'maxamo', 'charged',
   	 							'chargep', 'rate', 'val1', 'val2','currency', 'status'
   	 						);
   	public function deposit()
    {
        return $this->hasMany('App\Deposit', 'id', 'user_id');
    }
}
