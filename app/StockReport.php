<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockReport extends Model
{
    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
