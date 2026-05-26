<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $created_at
 * @property mixed $sms_id
 * @property mixed $sms_process_id
 * @property mixed $transfer_id
 * @property mixed $user
 * @property mixed $user_id
 */
class CashdrawSelect extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function transfer()
    {
      return $this->belongsTo('App\PartnerTransfer','transfer_id')->withDefault(['amount' =>'0','dd'=>'2001-01-01']);
    }
    public function thaisms()
    {
      return $this->setConnection('mysql_thai')->belongsTo('App\Models\SMS','sms_id')->withDefault(['amount' =>'0','dd'=>'2001-01-01']);
    }
    public function smsprocess()
    {
      return $this->setConnection('mysql_thai')->belongsTo('App\Models\SmsProcess','sms_process_id')->withDefault(['amount' =>'0','opdate'=>'2001-01-01']);
    }
}
