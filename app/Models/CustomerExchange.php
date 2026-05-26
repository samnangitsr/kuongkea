<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerExchange extends Model
{
    protected $fillable = ['name', 'photo','user_id', 'face_embedding','created_at','updated_at','company_id'];
    protected $casts = ['face_embedding' => 'array'];

    public function captures() {
        return $this->hasMany(CustomerExchangeCapture::class);
    }
}
