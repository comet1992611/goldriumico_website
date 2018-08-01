<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    protected $table = 'frontends';
    protected $fillable = array('ban_title','ban_details','ban_price','ban_date','ban_subtitle','ban_sold','about_title','video','about_content','serv_title','serv_details','road_title','road_details','team_title','team_details','testm_title','testm_details','faq_title','faq_details','subs_title','subs_details','footer1','footer2','secbg1','secbg2','secbg3','secbg4');
}
