<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
	protected $fillable = array('trancharge','trncrgp','basep', 'varp','convcrg','supply' );
}
