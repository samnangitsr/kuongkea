<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $balance
 * @property mixed $cur
 * @property mixed $currecny_id
 * @property mixed $currency_id
 * @property mixed $customer_id
 * @property mixed $note
 * @property mixed $payment_id
 * @property mixed $ref_number
 * @property mixed $trandate
 * @property mixed $tranname
 * @property mixed $trantime
 * @property mixed $user_id
 */
class BankTransaction extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
}
