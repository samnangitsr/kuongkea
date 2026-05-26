<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $end_date
 * @property mixed $start_date
 */
class NewPayRomlos extends Model
{
     public function user()
    {
    	return $this->belongsTo('App\User');
    }
     public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
}
