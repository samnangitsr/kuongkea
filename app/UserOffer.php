<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOffer extends Model
{
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function currency1()
    {
    	return $this->belongsTo('App\Currency','currency_id1')->withDefault(['shortcut' =>'']);
    }
    public function offerby()
    {
    	return $this->belongsTo('App\User','offer_by_user_id')->withDefault(['name'=>'']);
    }
    public function offerto()
    {
    	return $this->belongsTo('App\User','offer_to_user_id')->withDefault(['name'=>'']);
    }
     public function customer()
    {
    	return $this->belongsTo('App\Customer','customer_id')->withDefault(['name'=>'']);
    }
    public function customer1()
    {
    	return $this->belongsTo('App\Customer','customer_id1')->withDefault(['name'=>'']);
    }
}
