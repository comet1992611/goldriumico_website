<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testim extends Model
{
    protected $table = 'testims';
    protected $fillable = array('photo', 'name', 'company', 'star', 'comment');
}
