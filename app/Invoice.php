<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $balance
 * @property mixed $cur
 * @property mixed $customer
 * @property mixed $customer_id
 * @property mixed $deposit
 * @property mixed $invdate
 * @property mixed $invtime
 * @property mixed $payment
 * @property mixed $pweight
 * @property mixed $total
 * @property mixed $totalamount
 * @property mixed $totalweight
 * @property mixed $tweight
 * @property mixed $user_id
 */
class Invoice extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
    public function payment()
	{
		return $this->belongsToMany(Payment::class,'invoice_payments')->withPivot(['amount','cur'])->orderBy('id');
	}
   
}
