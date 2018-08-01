<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gsetting extends Model
{
    protected $fillable = array
					    (
					    	'webTitle','subtitle', 'colorCode', 'curCode', 'curSymbol',
					    	'registration', 'emailVerify', 'smsVerify', 'decimalPoint',
					    	'emailNotify', 'smsNotify', 'emailMessage', 'emailname',
					    	'emailSender', 'smsMessage', 'smsNumber', 'smsApi','startdate'
					    );

}
