<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function partner()
    {
    	return $this->belongsTo('App\Customer')->withDefault(['name' =>'']);
    }

  static public function showexchangeidfromtransfer($ex_id){
      $datas=null;
      $datas=PartnerTransfer::where('status',1)->where('exchange_list_id',$ex_id)->orderBy('id')->get();
      return $datas;
  }
  static public function showbygroup($ex_id,$group_id){
      $datas=null;
      $datas=Exchange::where('status',1)->where('ref_group_id',$group_id)->orderBy('id')->get();
      return $datas;
  }
}
