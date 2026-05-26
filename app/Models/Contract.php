<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    public function buyer()
    {
    	return $this->belongsTo('App\Customer','customer_id')->withDefault(['name' =>''])->with('province','district','commune','village');
    }
    public function saler()
    {
    	return $this->belongsTo('App\Customer','saler_id')->withDefault(['name' =>''])->with('province','district','commune','village');
    }
    public function company()
    {
    	return $this->belongsTo('App\Company','company_id')->withDefault(['bossname' =>'']);
    }
    public function property()
    {
    	return $this->belongsTo('App\Models\Property','property_id')->withDefault(['name' =>''])->with('currency','group');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id')->withDefault(['name' =>'']);
    }

}
