<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expanse extends Model
{
    use HasFactory;
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function customer()
    {
    	return $this->belongsTo('App\Customer')->withDefault(['name' =>'Cash']);
    }
    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault(['name' =>'']);
    }
    public function userrecord()
    {
    	return $this->belongsTo('App\User','user_record')->withDefault(['name' =>'']);
    }
}
