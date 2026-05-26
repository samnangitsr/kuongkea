<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $agree_rate
 * @property mixed $buy
 * @property mixed $company_id
 * @property mixed $curbuy
 * @property mixed $curbuy_id
 * @property mixed $currency
 * @property mixed $cursale
 * @property mixed $cursale_id
 * @property mixed $ex_date
 * @property mixed $ex_time
 * @property mixed $main_rate
 * @property mixed $note
 * @property mixed $partner
 * @property mixed $partner_id
 * @property mixed $sale
 * @property mixed $totalbuy
 * @property mixed $totalsale
 * @property mixed $user
 * @property mixed $user_id
 */
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
