<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function parent()
    {
        return $this->belongsTo(Address::class, 'province_id','id');
    }

    public function children()
    {
        return $this->hasMany(Address::class,'province_id','id');
    }

   
    public function provinceofdistrict(){
        return $this->belongsTo(Address::class,'province_id' ,'id')->withDefault(['name' =>'']);
    }
   
    public function districtofcommune(){
        return $this->belongsTo(Address::class,'district_id' ,'id')->withDefault(['name' =>'']);
    }
   
    public function communeofvillage(){
        return $this->belongsTo(Address::class,'commune_id' ,'id')->withDefault(['name' =>'']);
    }
}
