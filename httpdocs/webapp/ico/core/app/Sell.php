<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $table = 'sells';
    protected $fillable = array( 'user_id','ico_id','gateway_id','amount', 'status','trx','try');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ico()
    {
        return $this->belongsTo('App\Ico');
    }

    public function gateway()
    {
        return $this->belongsTo('App\Gateway');
    }
}
