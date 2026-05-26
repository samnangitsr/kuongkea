<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $currency_id
 * @property mixed $price
 * @property mixed $property
 * @property mixed $property_id
 * @property mixed $sale_id
 */
class SaleDetail extends Model
{
    use HasFactory;
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function property()
    {
    	return $this->belongsTo('App\Models\Property')->withDefault(['name' =>'']);
    }
}
