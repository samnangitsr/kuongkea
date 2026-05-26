<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyTransferUpdate extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function actionby()
  {
    return $this->belongsTo('App\User','action_by_id')->withDefault(['name'=>'']);
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
  public function customerchildren()
  {
    return $this->belongsTo('App\CustomerChild','child_id','id' )->withDefault(['name' =>'']);
  }
}
