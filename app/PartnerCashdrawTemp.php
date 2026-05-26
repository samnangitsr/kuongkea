<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
