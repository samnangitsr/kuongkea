<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $created_at
 * @property mixed $currency_id
 * @property mixed $exdate
 * @property mixed $partner
 * @property mixed $partner_id
 * @property mixed $saveby
 * @property mixed $updated_at
 * @property mixed $user_id
 */
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
