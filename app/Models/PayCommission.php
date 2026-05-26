<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $d1
 * @property mixed $d2
 * @property mixed $saler
 * @property mixed $selblock
 */
class PayCommission extends Model
{
     public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
