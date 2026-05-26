<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerTempList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
