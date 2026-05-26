<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $closeby
 * @property mixed $closedate
 * @property mixed $company_id
 * @property mixed $expanse
 * @property mixed $income
 * @property mixed $newinusd
 * @property mixed $newkhr
 * @property mixed $newthb
 * @property mixed $newusd
 * @property mixed $newvnd
 * @property mixed $olddate
 * @property mixed $oldinusd
 * @property mixed $oldkhr
 * @property mixed $oldthb
 * @property mixed $oldusd
 * @property mixed $oldvnd
 * @property mixed $rate_khr
 * @property mixed $rate_thb
 * @property mixed $rate_vnd
 */
class CloseList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
