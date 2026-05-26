<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerTransferTemp extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function customer()
  {
    return $this->belongsTo('App\Customer')->withDefault(['name' =>'']);
  }
  public function partner()
  {
    return $this->belongsTo('App\Customer','parrent_id')->withDefault(['name' =>'']);
  }
  public function currency()
  {
    return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
  }
  public function cuschargecur()
  {
    return $this->belongsTo('App\Currency','cuscharge_currency_id')->withDefault(['shortcut' =>'']);
  }
  public function feecurrency()
  {
    return $this->belongsTo('App\Currency','fee_currency_id')->withDefault(['shortcut' =>'']);
  }
}
