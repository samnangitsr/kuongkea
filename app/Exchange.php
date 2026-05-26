<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $amount
 * @property mixed $balance
 * @property mixed $bank_amount
 * @property mixed $buysaleid
 * @property mixed $cash_amount
 * @property mixed $cashreceive
 * @property mixed $cashreturn
 * @property mixed $client
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $currency
 * @property mixed $currency_id
 * @property mixed $dd
 * @property mixed $deposit
 * @property mixed $deposit_via
 * @property mixed $desr
 * @property mixed $drate
 * @property mixed $goldwater
 * @property mixed $isexchange_normal
 * @property mixed $isexchangelist
 * @property mixed $maincur
 * @property mixed $multiexchangecode
 * @property mixed $note
 * @property mixed $othercode
 * @property mixed $partner
 * @property mixed $partner_cur
 * @property mixed $partner_id
 * @property mixed $pcur
 * @property mixed $phone
 * @property mixed $processing
 * @property mixed $product
 * @property mixed $product_first_id
 * @property mixed $rate
 * @property mixed $ref_group_id
 * @property mixed $status
 * @property mixed $sumamount
 * @property mixed $tamt
 * @property mixed $totalamount
 * @property mixed $tt
 * @property mixed $tweight
 * @property mixed $twgold
 * @property mixed $updated_at
 * @property mixed $user
 * @property mixed $user_id
 */
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
