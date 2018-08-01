<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    protected $table = 'roads';
    protected $fillable = array( 'title','details');
}
