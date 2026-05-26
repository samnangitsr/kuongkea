<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $action
 * @property mixed $bank_amount
 * @property mixed $buy
 * @property mixed $buyinfo
 * @property mixed $cash_amount
 * @property mixed $cashreceive
 * @property mixed $cashreturn
 * @property mixed $client
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $curbuy
 * @property mixed $cursale
 * @property mixed $dd
 * @property mixed $deposit
 * @property mixed $deposit_via
 * @property mixed $drate
 * @property mixed $goldwater
 * @property mixed $isexchangelist
 * @property mixed $ismultiexchange
 * @property mixed $mapcode
 * @property mixed $note
 * @property mixed $othercode
 * @property mixed $phone
 * @property mixed $rate
 * @property mixed $rateinfo
 * @property mixed $ref_group_id
 * @property mixed $sale
 * @property mixed $saleinfo
 * @property mixed $status
 * @property mixed $tt
 * @property mixed $updated_at
 * @property mixed $user_id
 */
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
