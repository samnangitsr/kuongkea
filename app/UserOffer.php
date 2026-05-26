<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $amount1
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $currency_id
 * @property mixed $currency_id1
 * @property mixed $customer_id
 * @property mixed $customer_id1
 * @property mixed $offer_by_user_id
 * @property mixed $offer_date
 * @property mixed $offer_time
 * @property mixed $offer_to_user_id
 * @property mixed $offer_type
 * @property mixed $offer_type1
 * @property mixed $updated_at
 */
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
