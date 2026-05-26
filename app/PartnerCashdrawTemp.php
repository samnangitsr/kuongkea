<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $created_at
 * @property mixed $currency_id
 * @property mixed $partner_id
 * @property mixed $rec_name
 * @property mixed $rec_tel
 * @property mixed $select_by_id
 * @property mixed $selectby
 * @property mixed $sender_name
 * @property mixed $sender_tel
 * @property mixed $sms_id
 * @property mixed $transfer_date
 * @property mixed $transfer_id
 * @property mixed $updated_at
 * @property mixed $user_id
 */
class PartnerCashdrawTemp extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function selectby()
  {
    return $this->belongsTo('App\User','select_by_id');
  }
  public function partner()
  {
    return $this->belongsTo('App\Customer','partner_id')->withDefault(['name' =>'']);
  }
  public function currency()
  {
    return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
  }

}
