<?php

namespace App;

use App\CashdrawSelect;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $action
 * @property mixed $amount
 * @property mixed $amt
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $currency
 * @property mixed $currency_id
 * @property mixed $cuscharge
 * @property mixed $cuscharge_currency_id
 * @property mixed $cuschargecur
 * @property mixed $customer_charge
 * @property mixed $from_partner_id
 * @property mixed $frompartner
 * @property mixed $have_exchange
 * @property mixed $note
 * @property mixed $opdate
 * @property mixed $optime
 * @property mixed $other
 * @property mixed $pay_commission_id
 * @property mixed $paymethod
 * @property mixed $receive_name
 * @property mixed $receive_tel
 * @property mixed $ref_group_id
 * @property mixed $ref_number
 * @property mixed $tamt
 * @property mixed $tcuscharge
 * @property mixed $transfer_id
 * @property mixed $updated_at
 * @property mixed $user
 * @property mixed $user_id
 */
class Cashdraw extends Model
{
   static public function showcashdraw($trid){
        $cashdraw=Cashdraw::where('transfer_id',$trid)->where('status',1)->get();
        return $cashdraw;
    }
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function cuschargecur()
    {
    	return $this->belongsTo('App\Currency','cuscharge_currency_id')->withDefault(['shortcut' =>'']);
    }
    public function partnertransfer()
    {
        return $this->belongsTo('App\PartnerTransfer','transfer_id');
    }
    public function frompartner()
    {
        return $this->belongsTo('App\Customer','from_partner_id')->withDefault(['name'=>'']);
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    static public function showlinkgroup($id,$tablename){
      $ref_group_id='cashdraw-' . $id;
      $datarefs=null;
      if($tablename=='transfer'){
          $datarefs=PartnerTransfer::where('ref_group_id',$ref_group_id)->where('status',1)->orderBy('id')->get();
      }else if($tablename=='exchange'){
          $datarefs=ExchangeMulti::where('status',1)->where('ref_group_id','=',$ref_group_id)->orderBy('id')->get();
      }
      return $datarefs;
  }
    static public function showlinkgroup_new($groups, $transfer_id)
    {
        $transfers = PartnerTransfer::where('ref_group_id', $groups)
            ->whereNotNull('ref_group_id')
            ->where('status', 1)
            ->orderBy('id')
            ->get();

        // If no transfers, fall back to find single record
        if ($transfers->isEmpty() && $transfer_id) {
            $transfers = collect([PartnerTransfer::find($transfer_id)]);
        }

        $exchanges = ExchangeMulti::where('status', 1)
            ->where('ref_group_id', $groups)
            ->whereNotNull('ref_group_id')
            ->orderBy('id')
            ->get();

        $datarefs = [
            'transfers' => $transfers,
            'exchanges' => $exchanges,
        ];

        return $datarefs;
    }

  static public function checkselect($transferid){
    $found=CashdrawSelect::where('transfer_id',$transferid)->exists();
    return $found;
  }
}
