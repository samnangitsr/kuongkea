<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $cur
 * @property mixed $customer_id
 * @property mixed $depositamt
 * @property mixed $note
 * @property mixed $paiddate
 * @property mixed $paidtime
 * @property mixed $payamt
 * @property mixed $paynote
 * @property mixed $tamountdetail
 * @property mixed $user_id
 */
class Payment extends Model
{
    public function invoice()
	{
		return $this->belongsToMany(Invoice::class,'invoice_payments')->withPivot(['amount','cur']);
	}
	public function detail()
    {
        return $this->hasMany('App\PaymentDetail');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
