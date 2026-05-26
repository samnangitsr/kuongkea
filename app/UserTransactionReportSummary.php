<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $currency
 * @property mixed $currency_id
 * @property mixed $tamt
 */
class UserTransactionReportSummary extends Model
{
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
}
