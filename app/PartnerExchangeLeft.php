<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerExchangeLeft extends Model
{
  public function currency()
  {
    return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
  }
  public function partner()
  {
    return $this->belongsTo('App\Customer','partner_id')->withDefault(['name' =>'']);
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
