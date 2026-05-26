<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
