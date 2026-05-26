<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeMulti extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function currencybuy()
    {
    	return $this->belongsTo('App\Currency','curbuy')->withDefault(['curname' =>'']);
    }
    public function currencysale()
    {
    	return $this->belongsTo('App\Currency','cursale')->withDefault(['curname' =>'']);
    }
}
