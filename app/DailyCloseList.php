<?php

namespace App;

use App\Currency;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $tkhr
 * @property mixed $tthb
 * @property mixed $tusd
 * @property mixed $tvnd
 */
class DailyCloseList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
