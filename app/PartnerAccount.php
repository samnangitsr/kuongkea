<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerAccount extends Model
{
  public function customer()
  {
    return $this->belongsTo('App\Customer')->withDefault(['name' =>'']);
  }
  public function item()
  {
    return $this->belongsTo('App\Item')->withDefault(['name' =>'']);
  }

}
