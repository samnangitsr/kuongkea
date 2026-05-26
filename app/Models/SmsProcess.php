<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CashdrawSelect;
use App\PartnerTransfer;
use App\Exchange;

class SmsProcess extends Model
{
    use HasFactory;
    protected $connection="mysql_thai";
    public function thaisms()
    {
        return $this->belongsTo(SMS::class,'sms_id');
    }
    public function currency()
    {
    	return $this->setConnection('mysql')->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function user()
    {
    	return $this->setConnection('mysql')->belongsTo('App\User')->withDefault(['name' =>'']);
    }
    static public function checkselect($transferid){
        $found=CashdrawSelect::where('sms_id',$transferid)->exists();
        return $found;
      }
      static public function checkselect2($transferid){
        $found=CashdrawSelect::where('sms_process_id',$transferid)->exists();
        return $found;
      }
      static public function checkselect3($transferid){
        $found=CashdrawSelect::where('transfer_id',$transferid)->exists();
        return $found;
      }
    static public function gettransfer($smsprocessid)
    {
        $groupid='thaicashdraw-'.$smsprocessid;
        //$transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$groupid)->where('trancode',1)->where('cdc_display',1)->orderBy('id')->get();
        $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$groupid)->where('cdc_display',1)->orderBy('id')->get();
        return $transfers;
    }
    static public function getsmsprocess($id)
    {
        $smsprocess=SmsProcess::where('id',$id)->get();
        if($smsprocess){
            return $smsprocess;
        }
    }
    static public function getsmsprocessbysmsid($smsid)
    {
        $smsprocess=SmsProcess::where('sms_id',$smsid)->get();
        if($smsprocess){
            return $smsprocess;
        }
    }
    static public function gettransferbyid($trid,$smsid)
    {
        $p=SmsProcess::where('sms_id',$smsid)->first();
        if($p){
            $transfers=PartnerTransfer::where('ref_group_id',$p->group_id)->whereNotNull('ref_group_id')->get();
            return $transfers;
        }

        $transfers=PartnerTransfer::where('id',$trid)->get();
        if($transfers){
            return $transfers;
        }
    }

    static public function getexchange($smsprocessid)
    {
        $groupid='thaicashdraw-'.$smsprocessid;
        $exchanges=Exchange::where('status',1)->where('ref_group_id',$groupid)->orderBy('id')->get();
        return $exchanges;
    }

}
