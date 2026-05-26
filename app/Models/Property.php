<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    public function group()
    {
    	return $this->belongsTo('App\Models\PropertyGroup','property_group_id')->withDefault(['name' =>'']);
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }

}
