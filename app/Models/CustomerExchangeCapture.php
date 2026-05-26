<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerExchangeCapture extends Model
{
    protected $fillable = ['customer_exchange_id','user_id','stand_time', 'photo','created_at','updated_at','company_id'];

    public function customerexchange() {
        return $this->belongsTo(CustomerExchange::class);
    }
}
