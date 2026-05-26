<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property mixed $amount
 * @property mixed $platin_weight
 * @property mixed $rate
 * @property mixed $stock
 * @property mixed $stockdate
 * @property mixed $tamt
 */
class Stock extends Model
{
     use HasFactory;

    protected $fillable = [
        'stockdate',
        'company_id',
        'currency_id',
        'user_id',
        'stock',
        'amount',
        'rate',
        'isgold',
        'goldwater',
    ];
    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
