<?php

namespace App;

use App\CashdrawSelect;
use Illuminate\Database\Eloquent\Model;

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
