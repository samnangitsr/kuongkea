<?php

namespace App;

use App\Cashdraw;
use App\Exchange;
use App\Models\Expanse;
use App\PartnerTransfer;
use App\Models\SmsProcess;
use App\PartnerExchangeList;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UserCapital extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault(['name'=>'']);
    }
    public function useraffect()
    {
    	return $this->belongsTo('App\User','user_id_affect')->withDefault(['name'=>'Cash']);
    }
    public function agentname()
    {
    	return $this->belongsTo('App\Customer','agent_id')->withDefault(['name'=>'']);
    }

    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
    public static function summarycapital($curid,$dd,$userid,$raduser)
    {
        $selcomid=Session('log_into_company_id');
        if($userid=='all'){
                $sumcapital=UserCapital::whereDate('trandate',$dd)->where('status',1)->where('currency_id',$curid)->where('company_id',$selcomid)->sum('amount');
        }else{
            if($raduser=='userrecord'){
                $sumcapital=UserCapital::whereDate('trandate',$dd)->where('status',1)->where('user_id',$userid)->where('currency_id',$curid)->where('company_id',$selcomid)->sum('amount');
            }else{
                $sumcapital=UserCapital::whereDate('trandate',$dd)->where('status',1)->where('user_id_affect',$userid)->where('currency_id',$curid)->where('company_id',$selcomid)->sum('amount');
            }
        }
        return $sumcapital;
    }
    static public function showtransactiondetail($tablename,$d1,$d2,$userid){
        $datas='';
        if($tablename=='user_capitals'){
            // $datas=UserCapital::where('id',$linkid)->orderBy('id')->get();
        }elseif(str_contains($tablename,'exchanges')){

            $datas=Exchange::join('currencies','currencies.id','=','exchanges.currency_id')->where('exchanges.user_id',$userid)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('exchanges.status',1)->where('exchanges.isexchangelist',0)->where('currencies.isfn',0)
            ->select('exchanges.*')->orderBy('id')->get();

        }elseif($tablename=='partner_transfers_mode0'){
            // $datas=PartnerTransfer::where('user_id',$userid)->where('parrent_id',$parrentid)->whereNull('thai_amt')->whereDate('dd',$d1)->where('trancode',1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
            $datas=PartnerTransfer::where('user_id',$userid)->whereNull('thai_amt')->whereNull('user_affect')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
        }elseif($tablename=='partner_transfers_mode1'){
            // $datas=PartnerTransfer::where('docodeby',$userid)->where('trancode',1)->where('parrent_id',$parrentid)->whereDate('dd',$d1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
            $datas=PartnerTransfer::whereNotNull('docodeby')->where('user_affect',$userid)->where('trancode',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
        }elseif($tablename=='partner_transfers_mode-4'){
            // $datas=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->where('parrent_id',$parrentid)->whereDate('dd',$d1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
            $datas=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)
            ->where(function($q) use($userid){
                $q->where(function($q1) use($userid){
                    $q1->where('trancode',-4)->where('user_affect',$userid);
                })->orWhere(function($q2) use($userid){
                    $q2->where('trancode',-1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                })->orWhere(function($q3) use($userid){
                    $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);
                });
            })->orderBy('currency_id')->orderBy('id')->get();
        }elseif($tablename=='partner_transfers_mode4'){
            // $datas=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->where('parrent_id',$parrentid)->whereDate('dd',$d1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
            $datas=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)
            ->where(function($q) use($userid){
                $q->where(function($q1) use($userid){
                    $q1->where('trancode',4)->where('user_affect',$userid);
                })->orWhere(function($q2) use($userid){
                    $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                });
            })->orderBy('currency_id')->orderBy('id')->get();
        }elseif($tablename=='partner_transfers_cuscharge0'){
            // $datas=PartnerTransfer::where('trancode',1)->where('parrent_id',$parrentid)->whereDate('dd',$d1)->where('status',1)->orderBy('currency_id')->orderBy('id')->get();
        }elseif($tablename=='cashdraws'){
            $datas=Cashdraw::where('user_id',$userid)->whereDate('opdate',$d1)->where('status',1)->orderBy('id')->get();
        }elseif($tablename=='sms_processes'){
            $datas=SmsProcess::where('user_id',$userid)->whereDate('opdate',$d1)->where('status',1)->where('paymethod','Cash')->orderBy('id')->get();
        }elseif($tablename=='expanses1'){
            $datas=Expanse::where('user_id',$userid)->whereDate('dd',$d1)->where('status',1)->where('trancode',1)->orderBy('id')->get();
        }elseif($tablename=='expanses-1'){
            $datas=Expanse::where('user_id',$userid)->whereDate('dd',$d1)->where('status',1)->where('trancode',-1)->orderBy('id')->get();
        }
        return $datas;
    }
    static public function showlink_id($linkid,$tablename){
        if($tablename=='user_capitals'){
            $datas=UserCapital::where('id',$linkid)->orderBy('id')->get();
        }elseif($tablename=='exchanges'){
            $datas=Exchange::where('multiexchangecode',$linkid)->orderBy('id')->get();
        }elseif($tablename=='partner_transfers'){
            $datas=PartnerTransfer::where('id',$linkid)->orderBy('id')->get();
        }elseif($tablename=='cashdraws'){
            $datas=Cashdraw::where('id',$linkid)->orderBy('id')->get();
        }elseif($tablename=='sms_processes'){
            $datas=SmsProcess::where('id',$linkid)->orderBy('id')->get();
        }
        return $datas;
    }
    static public function showlink_ids($linkid,$tablename){
      $arrid=explode(',',$linkid);
      $datas=null;
      if($tablename=='user_capitals'){
          $datas=UserCapital::whereIn('id',$arrid)->orderBy('id')->get();
      }elseif($tablename=='exchanges'){
          $datas=Exchange::whereIn('multiexchangecode',$arrid)->orderBy('id')->get();
      }elseif($tablename=='partner_transfers'){
          $datas=PartnerTransfer::whereIn('id',$arrid)->orderBy('id')->get();
      }elseif($tablename=='cashdraws'){
          $datas=Cashdraw::whereIn('id',$arrid)->orderBy('id')->get();
      }elseif($tablename=='sms_processes'){
        $datas=SmsProcess::whereIn('id',$arrid)->orderBy('id')->get();
      }elseif($tablename=='expanses'){
        $datas=Expanse::whereIn('id',$arrid)->orderBy('id')->get();
      }
      return $datas;
  }
  static public function showref_number($refnum){
        $datarefs=null;
        $arr=explode("-",$refnum);
        if($arr[0]=='transfer'){
            $datarefs=PartnerTransfer::where('id',$arr[1])->where('status',1)->orderBy('id')->get();
        }else if($arr[0]=='exchange'){
            $datarefs=ExchangeMulti::where('status',1)->where('mapcode',$arr[1])->orderBy('id')->get();
        }else if($arr[0]=='usercapital'){
            $datarefs=UserCapital::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
        }else if($arr[0]=='cashdraw'){
            $datarefs=Cashdraw::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
        }else if($arr[0]=='exchangelist'){
          $datarefs=PartnerExchangeList::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
      }
        return $datarefs;

    }
}
