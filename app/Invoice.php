<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
