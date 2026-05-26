<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerExchangeList extends Model
{
    public function partner()
    {
    	return $this->belongsTo('App\Customer','partner_id')->withDefault(['name' =>'']);
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function curbuy()
    {
    	return $this->belongsTo('App\Currency','curbuy_id')->withDefault(['shortcut' =>'']);
    }
    public function cursale()
    {
    	return $this->belongsTo('App\Currency','cursale_id')->withDefault(['shortcut' =>'']);
    }
}
