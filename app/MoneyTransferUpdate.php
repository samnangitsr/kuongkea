<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $action_by_id
 * @property mixed $amount
 * @property mixed $bonus
 * @property mixed $child
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $currency_id
 * @property mixed $cuscharge
 * @property mixed $cuscharge_currency_id
 * @property mixed $customer_id
 * @property mixed $dd
 * @property mixed $fee
 * @property mixed $fee_currency_id
 * @property mixed $map_id
 * @property mixed $mekun
 * @property mixed $note
 * @property mixed $parrent_id
 * @property mixed $partner_transfer_id
 * @property mixed $recname
 * @property mixed $rectel
 * @property mixed $ref_group_id
 * @property mixed $ref_number
 * @property mixed $sendername
 * @property mixed $sendertel
 * @property mixed $status
 * @property mixed $trancode
 * @property mixed $tranname
 * @property mixed $tt
 * @property mixed $updated_at
 * @property mixed $user_id
 */
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
