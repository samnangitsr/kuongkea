<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $created_at
 * @property mixed $currency_id
 * @property mixed $cuscharge
 * @property mixed $cuscharge_currency_id
 * @property mixed $dd
 * @property mixed $fee
 * @property mixed $fee_currency_id
 * @property mixed $mekun
 * @property mixed $parrent_id
 * @property mixed $recname
 * @property mixed $rectel
 * @property mixed $sendername
 * @property mixed $sendertel
 * @property mixed $trancode
 * @property mixed $tranname
 * @property mixed $updated_at
 * @property mixed $user_affect
 * @property mixed $user_id
 */
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
