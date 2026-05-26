<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
