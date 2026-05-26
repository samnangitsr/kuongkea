<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $balkhr
 * @property mixed $balthb
 * @property mixed $balusd
 * @property mixed $closedate
 */
class CustomerList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
