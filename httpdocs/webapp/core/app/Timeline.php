<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';
    protected $fillable = array( 'title', 'desc','date');
}
