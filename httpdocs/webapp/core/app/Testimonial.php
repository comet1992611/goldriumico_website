<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
     protected $fillable = array('photo', 'company', 'comment');
}
