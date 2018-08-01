<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contac extends Model
{
    protected $fillable = array('email', 'mobile', 'location');
}
