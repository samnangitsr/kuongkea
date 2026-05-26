<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
