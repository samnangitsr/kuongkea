<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransactionReportSummary extends Model
{
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
}
