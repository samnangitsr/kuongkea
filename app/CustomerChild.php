<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerChild extends Model
{
   
    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
    public function province()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
    public function district()
    {
        return $this->belongsTo('App\Address')->withDefault(['name' =>'']);
    }
}
