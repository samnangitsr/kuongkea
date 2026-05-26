<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use App\Company;
use App\Invoice;
use App\Payment;
use App\Cashdraw;
use App\Currency;
use App\Customer;
use App\Exchange;
use App\UserOffer;
use Carbon\Carbon;
use App\Models\SMS;
use App\UserReport;
use App\UserCapital;
use App\ExchangeMulti;
use App\InvoicePayment;
use App\Models\Expanse;
use App\BankTransaction;
use App\PartnerTransfer;
use App\Models\AgentType;
use App\PartnerCloseList;
use App\UserReportDetail;
use App\Models\SmsProcess;
use App\Models\ThaiAccount;
use App\MoneyTransferUpdate;
use App\PartnerExchangeList;
use App\PartnerTransferTemp;
use App\UserStatementReport;
use Illuminate\Http\Request;
use App\Models\ThaiCloseList;
use App\UserTransactionReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\UserTransactionReportSummary;
use Illuminate\Support\Facades\Validator;

class UserCapitalController extends Controller
{
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;

        }
        return number_format($num,$dc,'.',',');
    }
    public function index()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $selcomid=Session('log_into_company_id');
        //$currencies=Currency::where('active',1)->where('ispandp','0')->where('partner_cur',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('ispandp','0')->where('company_id',$selcomid)->orderBy('no')->get();
        //$users=User::where('active',1)->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $banks=Customer::where('status',1)->whereIn('customertype',['BANK'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();
        $usercapitals=UserCapital::whereDate('trandate',$current)->where('status',1)->where('user_id_affect',Auth::id())->where('company_id',$selcomid)->orderBy('id')->get();
        $usercurrencies=UserCapital::whereDate('trandate',$current)->where('status',1)->where('user_id_affect',Auth::id())->where('company_id',$selcomid)->select('currency_id')->distinct()->get();
        $companies=Company::where('status',1)->get();
        return view('usercapitals.index',compact('currencies','users','usercapitals','banks','customers','usercurrencies','current','companies','selcomid'));
    }
    public function getallusermaster(Request $request){
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        return response()->json(['users'=>$users]);

       }
    public function getagentuser(Request $request){
      //return $request->all();
      $s=$request->useragent;
      $userpartner=User::where('id',$s)->first();
      $useragent=explode(',',$userpartner->customer_connect);
      $agentuser1=Customer::where('status',1)->whereIn('id',$useragent)->get();
    //   $agentuser1=Customer::where('status',1)
    //   ->where(function($q) use($s){
    //     return $q->where('user_connect','like',$s.',%')->orWhere('user_connect','like','%,' . $s.',%')->orWhere('user_connect','like','%,' . $s)->orWhere('user_connect',$s);
    //     })->get();

      return response()->json(['agentuser1'=>$agentuser1]);

     }
    public function getcustomertype(Request $request)
    {
        $customers=Customer::where('status',1)->where('customertype',$request->customertype)->orderBy('id')->get();
        return response($customers);
    }
    public function getcustomerforuser(Request $request)
    {
        //return($request->all());
        //$selcomid=Session('log_into_company_id');
        $selcomid=$request->companyid;
        $user_id=$request->user_id;
        $user=User::find($user_id);
        if(isset($request->offertype) && $request->offertype){
             if($user->role->name=='Admin'){
                $customers=Customer::where('status',1)->whereIn('customertype',['BANK','AGENT'])->where('company_id',$selcomid)->orderBy('id')->get();
            }else{
                $customers=Customer::where('status',1)->whereIn('customertype',['BANK','AGENT'])->WhereRaw("FIND_IN_SET(?, user_connect)", [$user_id])->where('company_id',$selcomid)->orderBy('id')->get();
            }
        }else{
            if($user->role->name=='Admin'){
                $customers=Customer::where('status',1)->whereIn('customertype',['BANK','AGENT'])->where('company_id',$selcomid)->orderBy('id')->get();
            }else{
                $customers=Customer::where('status',1)->WhereRaw("FIND_IN_SET(?, user_connect)", [$user_id])->where('company_id',$selcomid)->orderBy('id')->get();
            }
        }
        return response($customers);
    }
     public function getcustomer_without_userconnect(Request $request)
    {
        //return($request->all());
        //$selcomid=Session('log_into_company_id');
        $selcomid=$request->companyid;
        $customers=Customer::where('status',1)->whereIn('customertype',['BANK','AGENT'])->where('company_id',$selcomid)->orderBy('id')->get();
        return response($customers);
    }
    public function userprofit()
    {
       $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        return view('usercapitals.userprofit',compact('users'));
    }
    public function search(Request $request)
    {
        //$selcomid=Session('log_into_company_id');
        $selcomid=$request->companyid;
        $date = str_replace('/', '-', $request->searchdate);
        $trandate= date('Y-m-d', strtotime($date));
        $ucs=UserCapital::whereDate('trandate',$trandate)->where('status',$request->radstatus)->where('company_id',$selcomid);
        $usercurrencies=UserCapital::whereDate('trandate',$trandate)->where('status',1);
        $userid=$request->user;
        $raduser=$request->raduser;
        if($request->user<>'all'){
            if($request->raduser=='userrecord'){
                $ucs=$ucs->where('user_id',$request->user);
                $usercurrencies=$usercurrencies->where('user_id',$request->user);
            }elseif($request->raduser=='useraffect'){
                $ucs=$ucs->where('user_id_affect',$request->user);
                $usercurrencies=$usercurrencies->where('user_id_affect',$request->user);
            }
        }
        if($request->trancode<>'all'){

            $ucs=$ucs->where('trancode',$request->trancode);
            $usercurrencies=$usercurrencies->where('trancode',$request->trancode);

        }
        if($request->cur<>'all'){
            $ucs=$ucs->where('currency_id',$request->cur);
        }
        $ucs=$ucs->orderBy('id')->get();
        $usercurrencies=$usercurrencies->select('currency_id')->distinct()->get();
        //return $ucs;
        if(isset($request->print)){
            $user=User::find($userid);
            return view('usercapitals.search_print',compact('ucs','usercurrencies','trandate','user','raduser'));
        }else{
            return view('usercapitals.search',compact('ucs','usercurrencies','trandate','userid','raduser'));
        }
    }
    public function closelist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();
        $companies=Company::where('status',1)->get();
        return view('usercapitals.closelist',compact('users','currencies','companies','selcomid'));

    }
    public function convertimetoint($t)
    {
        $tt=explode(':',$t);
        $h=$tt[0] * 3600;
        $m=$tt[1] * 60;
        $s=$tt[2]+$m+$h;
        return $s;

    }
    public function seebyagentname(Request $request){
        $userid=$request->userid;
        $curid=$request->curid;
        $curshortcut=$request->shortcut;
        $curname=$request->curname;
        $username=$request->username;
        if($request->seeby=='all'){
            $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('cur',$request->shortcut)->orderBy('timeint')->orderBy('id')->get();
        }else{
            $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('agent_name',$request->seeby)->where('cur',$request->shortcut)->orderBy('timeint')->orderBy('id')->get();
        }
        $ismain=$request->ismain;
        $curname=$request->curname;
        return view('usercapitals.seedetail1by1',compact('userreportdetails','ismain','curname','userid','curid','curshortcut','username'));
    }
    public function seedetail1by1(Request $request)
    {
        $userid=$request->userid;
        $curid=$request->curid;
        $curshortcut=$request->shortcut;
        $curname=$request->curname;
        $username=$request->username;

        if($request->seeby==''){
            $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->orderBy('timeint')->orderBy('id')->get();
        }else{
            if($request->seeby=='startbal'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','usercapital')->where('trancode',2)->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='endbal'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','usercapital')->where('trancode',-2)->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='allbalin'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)
                ->where(function($q){
                    $q->where(function($capital_in){
                        $capital_in->where('table','usercapital')->where('trancode',1);
                    })->orWhere(function($transfer){
                        $transfer->where('table','like','%transfer%')->where(function($sq2){
                            $sq2->where('amount','>',0)->orWhere('buysale','>',0);
                        });
                    })->orWhere(function($expanse){
                        $expanse->where('table','expanse')->where(function($sq3){
                            $sq3->where('amount','>',0)->orWhere('buysale','>',0);
                        });
                    })->orWhere(function($cashdraw_cuscharge){
                        $cashdraw_cuscharge->where('table','cashdraw_cuscharge_notthesamecur')->where(function($sq4){
                            $sq4->where('amount','>',0)->orWhere('buysale','>',0);
                        });
                    });
                })
                ->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='allbalout'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)
                ->where(function($q){
                    $q->where(function($capital_out){
                        $capital_out->where('table','usercapital')->where('trancode',-1);
                    })->orWhere(function($transfer){
                        $transfer->where('table','like','%transfer%')->where(function($sq2){
                            $sq2->where('amount','<',0)->orWhere('buysale','<',0);
                        });
                    })->orWhere(function($expanse){
                        $expanse->where('table','expanse')->where(function($sq3){
                            $sq3->where('amount','<',0)->orWhere('buysale','<',0);
                        });
                    })->orWhere(function($cashdraw){
                        $cashdraw->where('table','cashdraw')->where(function($sq4){
                            $sq4->where('amount','<',0)->orWhere('buysale','<',0);
                        });
                    });
                })
                ->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='exchange'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','exchange')->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='transfer'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','transfer')->where('trancode',1)->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='capital_cashin'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','usercapital')->where('trancode',1)->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='capital_cashout'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','usercapital')->where('trancode',-1)->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='cashdraw'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','cashdraw')->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='income'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','expanse')
                ->where(function($q){
                    $q->where('buysale','>',0)->orWhere('amount','>',0);
                })->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='expanse'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','expanse')
                ->where(function($q){
                    $q->where('buysale','<',0)->orWhere('amount','<',0);
                })->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='transfer_balout_user'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','like','transfer_useraffect')
                ->where(function($q){
                    $q->where('amount','<',0)->orWhere('buysale','<',0);
                })->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='transfer_balin_user'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','like','transfer_useraffect')
                ->where(function($q){
                    $q->where('amount','>',0)->orWhere('buysale','>',0);
                })->orderBy('timeint')->orderBy('id')->get();
            }else if($request->seeby=='thaicashdraw'){
                $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->where('table','smsprocess')->orderBy('timeint')->orderBy('id')->get();
            }

        }
        $ismain=$request->ismain;
        $curname=$request->curname;
        return view('usercapitals.seedetail1by1',compact('userreportdetails','ismain','curname','userid','curid','curshortcut','username'));
    }
     public function seedetaillinksearch(Request $request){
        //return $request->all();
        $d1 = str_replace('/', '-', $request->fromdate);
        $d1= date('Y-m-d', strtotime($d1));
        $d2 = str_replace('/', '-', $request->todate);
        $d2= date('Y-m-d', strtotime($d2));
        $tablename=$request->tablename;
        $cur=$request->cur;
        $userid=$request->userid;
        $curid=$request->curid;
        if (str_contains($request->tablename, 'transfer')) {
             $showlink = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$d1, $d2])
                ->where('user_id', $userid)->where('status', 1)->whereNull('thai_amt')->where('location_id','<>',8)
                 ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function ($q) use ($userid) {
                    $q->where(function ($q1) {
                        $q1->where('trancode', 1)->whereNull('user_affect');
                    })
                    ->orWhere(function ($q2) use ($userid) {
                        $q2->where('trancode', -1)
                            ->where('iscashdraw', 1)
                            ->whereNull('cashdraw_id')
                            ->where('location_id', 3)
                            ->where('user_affect', '<>', $userid)
                            ->whereNotNull('user_affect');
                    });
                })->get();

                $sumamount = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$d1, $d2])
                ->where('user_id', $userid)->where('status', 1)->whereNull('thai_amt')->where('location_id','<>',8)
                 ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function ($q) use ($userid) {
                    $q->where(function ($q1) {
                        $q1->where('trancode', 1)->whereNull('user_affect');
                    })
                    ->orWhere(function ($q2) use ($userid) {
                        $q2->where('trancode', -1)
                            ->where('iscashdraw', 1)
                            ->whereNull('cashdraw_id')
                            ->where('location_id', 3)
                            ->where('user_affect', '<>', $userid)
                            ->whereNotNull('user_affect');
                    });
                }) ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN cuscharge_currency_id = ? THEN cuscharge ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');
        }else if(str_contains($request->tablename, 'partner_useraffect')){
            $showlink=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    })->orWhere(function($q3) use($userid){
                        $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->get();

                $sumamount=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    })->orWhere(function($q3) use($userid){
                        $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->sum('amount');

        }else if(str_contains($request->tablename, 'thai_useraffect')){
             $showlink=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
            ->where(function($qx) use($curid){
                $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
            })->get();

                $sumamount=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
                ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
                })
            ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN fee_currency_id = ? THEN fee ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');

        }else if(str_contains($request->tablename, 'cashdraw')){
            $showlink=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->where('user_id',$userid)->where('status',1)
               ->where(function($qx) use($curid){
                       $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })->get();

            $sumamount=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->where('user_id',$userid)->where('status',1)
               ->where(function($qx) use($curid){
                       $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                   })
                   ->selectRaw("SUM(
                       CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                       CASE WHEN cuscharge_currency_id = ? THEN -1 * customer_charge ELSE 0 END
                   ) as total", [$curid, $curid])
                   ->value('total');
        }else if(str_contains($request->tablename, 'usercapital')){
            if(isset($request->seltype) && $request->seltype<>''){
                $showlink=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($d1, $d2))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type',$request->seltype)->whereIn('trancode',[1,-1,2])->get();
                $sumamount=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($d1, $d2))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type',$request->seltype)->whereIn('trancode',[1,-1,2])->sum('amount');
            }else{
                $showlink=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($d1, $d2))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->get();
                $sumamount=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($d1, $d2))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->sum('amount');
            }
        }else if(str_contains($request->tablename, 'exchangemultis')){

        }else if(str_contains($request->tablename, 'exchanges')){
            if($request->ismain==1){
                $showlink=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$request->userid)->where('status',1)->where('isexchangelist',0)->get();
                $sumamount=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$request->userid)->where('status',1)->where('isexchangelist',0)->sum('amount');

            }else{
                $showlink=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$request->userid)->where('currency_id',$request->curid)->where('status',1)->where('isexchangelist',0)->get();
                $sumamount=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$request->userid)->where('currency_id',$request->curid)->where('status',1)->where('isexchangelist',0)->sum('product');
            }
        }else if(str_contains($request->tablename, 'expanse')){
            $sumamount=Expanse::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->sum('amount');
            $showlink=Expanse::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->get();
        }

        //return $showlink;
        return view('usercapitals.seelinkdetailsearch',compact('showlink','sumamount','tablename','cur'));
     }
    public function seedetaillink(Request $request){
        //return $request->all();
        $showlink='';
        $sumamount=0;
        $table='';
        $title='';
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        $curshortcut=$request->curshortcut;
        $ismain=$request->ismain;
        $userid=$request->userid;
        $curid=$request->curid;
        $username=$request->username;
        $linkid=$request->id;
        if (str_contains($request->tablename, 'transfer')) {
            $table='transfer';
             $title='TRANSFER LINK ID=' . $linkid;

             if($request->id>0){
                 $showlink=PartnerTransfer::where('id',$request->id)->where('status',1)->get();
             }else{
                $title='របាយការណ៏ផ្ទេរប្រាក់ ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $showlink = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $todate])
                ->where('user_id', $userid)->where('status', 1)->whereNull('thai_amt')->where('location_id','<>',8)
                 ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function ($q) use ($userid) {
                    $q->where(function ($q1) {
                        $q1->where('trancode', 1)->whereNull('user_affect');
                    })
                    ->orWhere(function ($q2) use ($userid) {
                        $q2->where('trancode', -1)
                            ->where('iscashdraw', 1)
                            ->whereNull('cashdraw_id')
                            ->where('location_id', 3)
                            ->where('user_affect', '<>', $userid)
                            ->whereNotNull('user_affect');
                    });
                })->get();

                $sumamount = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $todate])
                ->where('user_id', $userid)->where('status', 1)->whereNull('thai_amt')->where('location_id','<>',8)
                 ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function ($q) use ($userid) {
                    $q->where(function ($q1) {
                        $q1->where('trancode', 1)->whereNull('user_affect');
                    })
                    ->orWhere(function ($q2) use ($userid) {
                        $q2->where('trancode', -1)
                            ->where('iscashdraw', 1)
                            ->whereNull('cashdraw_id')
                            ->where('location_id', 3)
                            ->where('user_affect', '<>', $userid)
                            ->whereNotNull('user_affect');
                    });
                }) ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN cuscharge_currency_id = ? THEN cuscharge ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');

            }
        }else if(str_contains($request->tablename, 'partner_useraffect')){
            $table='partner_useraffect';
             $title='TRANSFER USER AFFECT LINK ID=' . $linkid;

             if($request->id>0){
                 $showlink=PartnerTransfer::where('id',$request->id)->where('status',1)->get();
             }else{
                $title='របាយការណ៏ផ្ទេរប្រាក់ពាក់ព័ន្ធបញ្ជីបុគ្គលិក ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $showlink=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    })->orWhere(function($q3) use($userid){
                        $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->get();

                $sumamount=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    })->orWhere(function($q3) use($userid){
                        $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->sum('amount');
             }
        }else if(str_contains($request->tablename, 'thai_useraffect')){
            $table='thai_useraffect';
            $title='THAI TRANSFER LINK ID=' . $linkid;

            if($request->id>0){
                $showlink=PartnerTransfer::where('id',$request->id)->where('status',1)->get();
            }else{
                $title='របាយការណ៏វេរថៃ ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $showlink=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
                ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
                })->get();

                    $sumamount=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
                    ->where(function($qx) use($curid){
                        $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
                    })
                ->selectRaw("SUM(
                        CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                        CASE WHEN fee_currency_id = ? THEN fee ELSE 0 END
                    ) as total", [$curid, $curid])
                    ->value('total');
            }
        }else if(str_contains($request->tablename, 'cashdraw')){
            $table='cashdraw';
            $title='CASHDRAW LINK ID=' . $linkid;
            if($request->id>0){
                 $showlink=Cashdraw::where('id',$request->id)->where('status',1)->get();
            }else{
                 $title='របាយការណ៏បើកវេរ ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $showlink=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $todate))->where('user_id',$userid)->where('status',1)
               ->where(function($qx) use($curid){
                       $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })->get();

                $sumamount=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $todate))->where('user_id',$userid)->where('status',1)
               ->where(function($qx) use($curid){
                       $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                   })
                   ->selectRaw("SUM(
                       CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                       CASE WHEN cuscharge_currency_id = ? THEN -1 * customer_charge ELSE 0 END
                   ) as total", [$curid, $curid])
                   ->value('total');
            }

        }else if(str_contains($request->tablename, 'exchange')){
            $title='EXCHANGE LINK ID= ' . $linkid;
            if($request->id>0){
                $table='exchangemultis';
                $showlink=ExchangeMulti::where('mapcode',$request->id)->where('status',1)->get();
            }else{
                $title='របាយការណ៏ប្តូរប្រាក់ ' . $curshortcut . ' បុគ្គលិក:'. $username;
                 $table='exchanges';
                if($request->ismain==1){
                    $showlink=Exchange::whereBetween(DB::raw('DATE(dd)'), array($request->fromdate, $request->todate))->where('user_id',$request->userid)->where('status',1)->where('isexchangelist',0)->get();
                    $sumamount=Exchange::whereBetween(DB::raw('DATE(dd)'), array($request->fromdate, $request->todate))->where('user_id',$request->userid)->where('status',1)->where('isexchangelist',0)->sum('amount');

                }else{
                    $showlink=Exchange::whereBetween(DB::raw('DATE(dd)'), array($request->fromdate, $request->todate))->where('user_id',$request->userid)->where('currency_id',$request->curid)->where('status',1)->where('isexchangelist',0)->get();
                    $sumamount=Exchange::whereBetween(DB::raw('DATE(dd)'), array($request->fromdate, $request->todate))->where('user_id',$request->userid)->where('currency_id',$request->curid)->where('status',1)->where('isexchangelist',0)->sum('product');
                }

            }

        }else if(str_contains($request->tablename, 'usercapital')){
             $title='USER CAPITAL LINK ID= ' . $linkid;
             $table='usercapital';
            if($request->id>0){
                $showlink=UserCapital::where('id',$request->id)->where('status',1)->get();
            }else{
                $title='សរុបដើមទុន ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $showlink=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $todate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->get();
                $sumamount=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $todate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->sum('amount');
            }

        }else if(str_contains($request->tablename, 'expanse')){
            $title='EXPANSE LINK ID= ' . $linkid;
            $table='expanse';
            if($request->id>0){
                $showlink=Expanse::where('id',$request->id)->where('status',1)->get();
            }else{
                $title='សរុបចំណូលចំណាយ ' . $curshortcut . ' បុគ្គលិក:'. $username;
                $sumamount=Expanse::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->sum('amount');
                $showlink=Expanse::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->get();
            }
        }

        $arrvar=['curshortcut'=>$curshortcut,'ismain'=>$ismain,'userid'=>$userid,'username'=>$username,'curid'=>$curid,'fromdate'=>$fromdate,'todate'=>$todate,'linkid'=>$linkid];
        return view('usercapitals.seedetaillink',compact('showlink','table','sumamount','curshortcut','title','arrvar'));

    }
    public function updatehideview(Request $request)
    {

        // Example: update column "checked" = 1 for all selected
        UserReportDetail::whereIn('id', $request->ids)
            ->update(['hide_view' => 1]);

        return response()->json(['success' => true, 'updated_ids' => $request->ids]);
    }
    public function seedetail($curid,$curname,$curshortcut,$isexchangecur,$ismain,$viewdate,$userid,$username,$fromdate,$ckcash,$islink,$hide_view,$clearallviewer)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $viewdate=Date('Y-m-d',strtotime($viewdate));
        //return $clearallviewer;
        if($clearallviewer==1){
            DB::table('user_report_details')->delete();
        }else{
            DB::table('user_report_details')->where('viewby',Auth::id())->delete();
        }
        $predate = Carbon::parse($viewdate)->subDay();
        $show = Carbon::parse($viewdate);
        $from = Carbon::parse($fromdate);
        $pre=Carbon::parse($predate);
        $note=date('d-M-y',strtotime($fromdate)) . ' To ' . date('d-M-y',strtotime($predate));
        if ($show->equalTo($from)) {
            $startdate_eq_enddate=true;
            if($ckcash=="cash"){
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','cash')->whereIn('trancode',[1,-1,2,-2])->get();
            }elseif($ckcash=="bank"){
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','<>','cash')->whereIn('trancode',[1,-1,2,-2])->get();
            }else{
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2,-2])->get();
            }
        }else{
             $startdate_eq_enddate=false;
            if($ckcash=="cash"){
                $capital_type='Cash';
                $sumuc=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','cash')->whereIn('trancode',[1,-1,2])->sum('amount');
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($viewdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','cash')->whereIn('trancode',[1,-1,2])->get();
            }elseif($ckcash=="bank"){
                $capital_type='Bank';
                $sumuc=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','<>','cash')->whereIn('trancode',[1,-1,2])->sum('amount');
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($viewdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->where('capital_type','<>','cash')->whereIn('trancode',[1,-1,2])->get();
            }else{
                $capital_type='Mixed';
                $sumuc=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->sum('amount');
                $usercapitals=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($viewdate, $viewdate))->where('user_id_affect',$userid)->where('currency_id',$curid)->where('status',1)->whereIn('trancode',[1,-1,2])->get();
            }
            if($sumuc){
                if($ismain==1){
                    $buysale=0;
                    $amount=$sumuc;
                }else{
                    $buysale=$sumuc;
                    $amount=0;
                }
                DB::table('user_report_details')->insert([
                    'description'=>'សរុបដើមទុន',
                    'buysale'=>$buysale,
                    'cur'=>$curshortcut,
                    'amount'=>$amount,
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>'',
                    'timeint'=>'0',
                    'viewby'=>Auth::id(),
                    'table'=>'usercapital',
                    'trancode'=>0,
                    'tran_id'=>0,
                    'group_id'=>0,
                    'note'=>$note,
                    'capital_type'=>$capital_type,
                    'agent_name'=>'',
                    'dd'=>$predate,
                    'from_date'=>$fromdate,
                    'to_date'=>$predate,
                    'created_at'=>$current,
                    'updated_at'=>$current,
                ]);
            }

        }


        foreach($usercapitals as $uc)
        {
            if($ismain==1){
                $buysale=0;
                $amount=$uc->amount;
            }else{
                $buysale=$uc->amount;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>$uc->tranname,
                'buysale'=>$buysale,
                'cur'=>$uc->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$uc->trantime,
                'timeint'=>$this->convertimetoint($uc->trantime),
                'viewby'=>Auth::id(),
                'table'=>'usercapital',
                'trancode'=>$uc->trancode,
                'tran_id'=>$uc->id,
                'group_id'=>$uc->trancode==2?'':$uc->ref_number,
                'note'=>$uc->note,
                'capital_type'=>$uc->capital_type,
                'agent_name'=>$uc->agentname->name,
                'dd'=>$uc->trandate,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'recordby' => $uc->user->name,
                'created_at'=>$current,
                'updated_at'=>$current,
            ]);
        }
        if($ckcash=="cash" || $ckcash=="both"){
            if($ismain==1){
                //$this->seeinvoice($fromdate,$viewdate,$userid);
                $this->seeexchange($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
            }else{
                if($isexchangecur==0){
                    //$this->seeinvoice($fromdate,$viewdate,$userid);
                }else{
                  $this->seeexchange($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
                }
            }
        }
        $this->SeeTransfer($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$ckcash,$curshortcut,$note);
        if($ckcash=='both'){
            $this->SeeTransferuseraffect($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
        }
        if(config('helper.realestate') == 1){
            $this->Seerealestate($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$ckcash,$curshortcut,$note);
        }
        if($ckcash=="cash" || $ckcash=="both"){
            $this->SeeCashdraw($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
            $this->SeeCashdrawthai($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
            $this->SeeExpanse($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note);
        }
        //for thorn request hide amount zero
        if($hide_view==1){
            if($ismain==1){

                DB::table('user_report_details as urd')
                ->join(DB::raw("(
                    SELECT group_id
                    FROM user_report_details
                    GROUP BY group_id
                    HAVING SUM(amount) = 0
                ) as t"), function($join) {
                    $join->on('urd.group_id', '=', 't.group_id');
                })
                ->update(['urd.hide_view' => 1]);

            }else{
                DB::table('user_report_details as urd')
                ->join(DB::raw("(
                    SELECT group_id, cur
                    FROM user_report_details
                    GROUP BY group_id, cur
                    HAVING SUM(buysale) = 0
                ) as t"), function($join) {
                    $join->on('urd.group_id', '=', 't.group_id')
                        ->on('urd.cur', '=', 't.cur');
                })
                ->update(['urd.hide_view' => 1]);

            }
             $userreportdetails=UserReportDetail::where('viewby',Auth::id())->where('hide_view',0)->orderBy('dd')->orderBy('timeint')->orderBy('id')->get();
        }else{
            $userreportdetails=UserReportDetail::where('viewby',Auth::id())->orderBy('dd')->orderBy('timeint')->orderBy('id')->get();

        }


        $agentnames = UserReportDetail::where('viewby', Auth::id())->where('agent_name','<>','')->select('agent_name')->distinct()->get();
        $selcomid=Session('log_into_company_id');
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->orderBy('no')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        if($islink==1){
            return view('usercapitals.seedetail',compact('userreportdetails','currencies','users','viewdate','fromdate','curname','curshortcut','username','ismain','ckcash','agentnames','userid','curid','username'));
        }else{
            return view('usercapitals.seedetail_search',compact('userreportdetails','currencies','users','viewdate','fromdate','curname','curshortcut','username','ismain','ckcash','agentnames','userid','curid','username'));
        }
    }
    public function SeeTransfer($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$ckcash,$curshortcut,$note)
    {
        if($startdate_eq_enddate==false){
            if($ckcash=='cash'){
                $sum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_id',$userid)->where('status',1)->whereNull('thai_amt')->where('location_id','<>',8)
                ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function($q) use($userid){
                    $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                        $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                    });
                })
                ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN cuscharge_currency_id = ? THEN cuscharge ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');
            }elseif($ckcash=='bank'){

                 $sum1 = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $predate])
                    ->where('user_id', $userid)
                    ->where('status', 1)
                    ->whereNull('thai_amt')
                    ->where('currency_id', $curid)
                    ->where('user_affect', $userid)
                    ->where('amount', '>', 0)
                    ->where('location_id', '<>', 8)
                    ->selectRaw('SUM(amount + fee) as total')
                    ->value('total');

                $sum2 = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $predate])
                    ->where('user_id', $userid)
                    ->where('status', 1)
                    ->whereNull('thai_amt')
                    ->where('currency_id', $curid)
                    ->where('user_affect', $userid)
                    ->where('amount', '<', 0)
                    ->where('location_id', '<>', 8)
                    ->selectRaw('SUM(amount + fee) as total')
                    ->value('total');
                $sum = -1 * floatval($sum1) + -1 * floatval($sum2);

                $sum_thai=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))
                ->where('user_affect',$userid)
                ->where('status',1)
                ->whereNotNull('thai_amt')
                ->whereNotNull('docodeby')
                ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
                })
                ->selectRaw("SUM(
                        CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                        CASE WHEN fee_currency_id = ? THEN fee ELSE 0 END
                    ) as total", [$curid, $curid])
                    ->value('total');
                if($ismain==1){
                    $buysale=0;
                    $amount=$sum_thai??0;
                }else{
                    $buysale=$sum_thai??0;
                    $amount=0;
                }
                DB::table('user_report_details')->insert([
                    'description'=>'សរុបលុយថៃពាក់ព័ន្ធបុគ្គលិក',
                    'buysale'=>-1 * floatval($buysale),
                    'cur'=>$curshortcut,
                    'amount'=>-1 * floatval($amount),
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>'',
                    'timeint'=>0,
                    'viewby'=>Auth::id(),
                    'table'=>'thai_useraffect',
                    'trancode'=>0,
                    'tran_id'=>0,
                    'group_id'=>'',
                    'note'=>$note,
                    'agent_name'=>'',
                    'dd'=>$predate,
                    'from_date'=>$fromdate,
                    'to_date'=>$predate,
                ]);

            }else{
               $sum = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $predate])
                ->where('user_id', $userid)->where('status', 1)->whereNull('thai_amt')->where('location_id','<>',8)
                 ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->where(function ($q) use ($userid) {
                    $q->where(function ($q1) {
                        $q1->where('trancode', 1)->whereNull('user_affect');
                    })
                    ->orWhere(function ($q2) use ($userid) {
                        $q2->where('trancode', -1)
                            ->where('iscashdraw', 1)
                            ->whereNull('cashdraw_id')
                            ->where('location_id', 3)
                            ->where('user_affect', '<>', $userid)
                            ->whereNotNull('user_affect');
                    });
                })
               ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN cuscharge_currency_id = ? THEN cuscharge ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');

            }

             if($ismain==1){
                $buysale=0;
                $amount=$sum??0;
            }else{
                $buysale=$sum??0;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>'សរុបលុយវេរ',
                'buysale'=>$buysale,
                'cur'=>$curshortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>'',
                'timeint'=>'0',
                'viewby'=>Auth::id(),
                'table'=>'transfer',
                'trancode'=>'0',
                'tran_id'=>0,
                'group_id'=>'',
                'note'=>$note ,
                'from_date'=>$fromdate,
                'to_date'=>$predate,
                'agent_name'=>'',
                'dd'=>$predate,
            ]);

        }

        if($ckcash=='cash'){
            $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('user_id',$userid)->where('status',1)->whereNull('thai_amt')->where('location_id','<>',8)
            ->where(function($qx) use($curid){
                $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
            })
            ->where(function($q) use($userid){
                $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                    $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                });
            })
            ->get();
        }elseif($ckcash=='bank'){
            $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('status',1)->whereNull('thai_amt')
            ->where('user_affect',$userid)->where('currency_id',$curid)->where('location_id','<>',8)->get();

            $transfer_thai_useraffects=PartnerTransfer::whereDate('dd',$viewdate)->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
            ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
                })
            ->get();
            foreach($transfer_thai_useraffects as $tr)
            {
                if($ismain==1){
                    $buysale=0;
                    $amount=0;
                    if($tr->currency_id==$curid){
                        $amount +=$tr->amount;
                    }
                    if($tr->fee_currency_id==$curid){
                        $amount +=$tr->fee;
                    }
                }else{
                $buysale=0;
                    $amount=0;
                    if($tr->currency_id==$curid){
                        $buysale +=$tr->amount;
                    }
                    if($tr->fee_currency_id==$curid){
                        $buysale +=$tr->fee;
                    }
                }
                DB::table('user_report_details')->insert([
                    'description'=>$tr->tranname . 'លុយថៃ(' . $this->phpformatnumber($tr->thai_amt) .'B)',
                    'buysale'=>-1 * floatval($buysale),
                    'cur'=>$tr->currency->shortcut,
                    'amount'=>-1 * floatval($amount),
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>$tr->tt,
                    'timeint'=>$this->convertimetoint($tr->tt),
                    'viewby'=>Auth::id(),
                    'table'=>'thai_transfer_useraffect',
                    'trancode'=>$tr->trancode,
                    'tran_id'=>$tr->id,
                    'group_id'=>$tr->ref_group_id,
                    'note'=>$tr->note . ' ' . $tr->sendertel . $tr->sendername . ' ' . $tr->rectel . $tr->recname,
                    'agent_name'=>$tr->partner->name,
                    'dd'=>$tr->dd,
                    'from_date'=>$viewdate,
                    'to_date'=>$viewdate,
                ]);
            }

        }else{
            $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('user_id',$userid)->where('status',1)->whereNull('thai_amt')->where('location_id','<>',8)
            ->where(function($qx) use($curid){
                $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
            })
            ->where(function($q) use($userid){
                $q->where(function($q1){
                    $q1->where('trancode',1)->whereNull('user_affect');
                })
                ->orWhere(function($q2) use($userid){//បើកវេរវីង
                    $q2->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3)->where('user_affect','<>',$userid)->whereNotNull('user_affect');
                });
            })
            ->get();
        }
        foreach($transfers as $tr)
        {
            if($ckcash=='bank'){
                if($ismain==1){
                    $buysale=0;
                    $amount=0;
                    if($tr->currency_id==$curid){
                        $amount +=-1 * floatval($tr->amount+$tr->fee);
                    }

                }else{
                    $amount=0;
                    $buysale=0;
                    if($tr->currency_id==$curid){
                         $buysale +=-1 * floatval($tr->amount+$tr->fee);
                    }

                }
            }else{
                if($ismain==1){
                    $buysale=0;
                    $amount=0;
                    if($tr->currency_id==$curid){
                        $amount +=$tr->amount;
                    }
                    if($tr->cuscharge_currency_id==$curid){
                        $amount +=$tr->cuscharge;
                    }
                }else{
                    $amount=0;
                    $buysale=0;
                    if($tr->currency_id==$curid){
                         $buysale +=$tr->amount;
                    }
                    if($tr->cuscharge_currency_id==$curid){
                         $buysale +=$tr->cuscharge;
                    }
                }
            }
            DB::table('user_report_details')->insert([
                'description'=>$tr->cuscharge<>0? $tr->tranname . '+' . $this->phpformatnumber($tr->cuscharge) . $tr->cuschargecur->sk:$tr->tranname,
                'buysale'=>$buysale,
                'cur'=>$tr->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->tt,
                'timeint'=>$this->convertimetoint($tr->tt),
                'viewby'=>Auth::id(),
                'table'=>'transfer',
                'trancode'=>$tr->trancode,
                'tran_id'=>$tr->id,
                'group_id'=>$tr->ref_group_id,
                'note'=>$tr->note . ' ' . $tr->sendertel . $tr->sendername . ' ' . $tr->rectel . $tr->recname ,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'agent_name'=>$tr->partner->name,
                'dd'=>$tr->dd,
                'recordby' => $tr->user->name,
            ]);
        }
        //get cuscharge difference currency id
        // if($ckcash=='true'){
        //     $cuscharges=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('cuscharge_currency_id',$curid)->where('status',1)->whereNull('thai_amt')
        //      ->where(function($q) use($userid){
        //         $q->where(function($q1){
        //             $q1->where('trancode',1)->whereNull('user_affect');
        //         })
        //         ->orWhere(function($q2) use($userid){//បើកវេរវីង
        //             $q2->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
        //         })->orWhere(function($q5) use($userid){
        //             //$q5->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','=',$userid)->where('user_id','=',$userid)->whereNotNull('ref_group_id');//ភ្ញៀវប្តូរប្រាក់វេរតាមវីងឬធនាគា
        //         });
        //     })->get();
        // }else{
        //     $cuscharges=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('cuscharge_currency_id',$curid)->where('status',1)->whereNull('thai_amt')
        //     ->where(function($q) use($userid){
        //         $q->where(function($q1){
        //             $q1->where('trancode',1)->whereNull('user_affect');
        //         })
        //         ->orWhere(function($q2) use($userid){//បើកវេរវីង
        //             $q2->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3)->where('user_affect','<>',$userid)->whereNotNull('user_affect');
        //         })->orWhere(function($q5) use($userid){
        //             //$q5->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','=',$userid)->where('user_id','=',$userid)->whereNotNull('ref_group_id');//ភ្ញៀវប្តូរប្រាក់វេរតាមវីងឬធនាគា
        //         });
        //     })
        //     ->get();
        // }

        // foreach($cuscharges as $tr)
        // {
        //     if($ismain==1){
        //         $buysale=0;
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $amount=$tr->cuscharge;

        //         }else{
        //             $amount=0;
        //         }

        //     }else{
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $buysale=$tr->cuscharge;
        //         }else{
        //             $buysale=0;
        //         }

        //         $amount=0;
        //     }
        //     if($buysale+$amount!==0){
        //         DB::table('user_report_details')->insert([
        //             'description'=>'សេវ៉ា'.$tr->tranname .'(' .$this->phpformatnumber($tr->amount) . $tr->currency->shortcut .')',
        //             'buysale'=>$buysale,
        //             'cur'=>$tr->cuschargecur->shortcut,
        //             'amount'=>$amount,
        //             'deposit'=>'0',
        //             'debt'=>'0',
        //             'trantime'=>$tr->tt,
        //             'timeint'=>$this->convertimetoint($tr->tt),
        //             'viewby'=>Auth::id(),
        //             'table'=>'transfer',
        //             'trancode'=>$tr->trancode,
        //             'tran_id'=>$tr->id,
        //             'group_id'=>$tr->ref_group_id,
        //             'note'=>$tr->note,
        //             'dd'=>$tr->dd,
        //         ]);
        //     }
        // }
    }
    public function SeeTransferuseraffect($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note)
    {
        if($startdate_eq_enddate==false){
             $transfersum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
            ->where(function($q) use($userid){
                $q->where(function($q1) use($userid){
                    $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
                })->orWhere(function($q2) use($userid){
                    $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                })->orWhere(function($q3) use($userid){
                    $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
                })->orWhere(function($q4) use($userid){
                    $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                })->orWhere(function($q5) use($userid){
                    $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                });
            })->get();
              $sign=-1;
              $amount=0;
              $buysale=0;
                foreach($transfersum as $trsum)
                {
                    if($trsum->trancode==1 && $trsum->user_id==$userid && $trsum->user_affect <> $userid && !is_null($trsum->user_affect)){
                        $sign=1;
                    }else{
                        $sign=-1;
                    }
                    if($ismain==1){
                        $amount +=floatval($sign) * floatval($trsum->amount);
                    }else{
                        $buysale +=floatval($sign) * floatval($trsum->amount);
                    }

                }
                DB::table('user_report_details')->insert([
                'description'=>'សរុបបញ្ជីពាក់ព័ន្ធបុគ្គលិក',
                'buysale'=>$buysale,
                'cur'=>$curshortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>0,
                'timeint'=>0,
                'viewby'=>Auth::id(),
                'table'=>'partner_useraffect',
                'trancode'=>0,
                'tran_id'=>0,
                'group_id'=>'',
                'note'=>$note ,
                'from_date'=>$fromdate,
                'to_date'=>$predate,
                'agent_name'=>'',
                'dd'=>$predate,
            ]);

        }
        $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('currency_id',$curid)->where('status',1)->whereNull('thai_amt')
        ->where(function($q) use($userid){
            $q->where(function($q1) use($userid){
                $q1->where('user_affect',$userid)->where('cashdraw_id','>',0)->where('trancode',-1);//ប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិក
            })->orWhere(function($q2) use($userid){
                $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
            })->orWhere(function($q3) use($userid){
                $q3->where('user_affect',$userid)->whereIn('trancode',[4,-4]);
            })->orWhere(function($q4) use($userid){
                $q4->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
            })->orWhere(function($q5) use($userid){
                $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
            });
        })->get();
        $sign=-1;
        foreach($transfers as $tr)
        {
            if($tr->trancode==1 && $tr->user_id==$userid && $tr->user_affect <> $userid && !is_null($tr->user_affect)){
                $sign=1;
            }else{
                $sign=-1;
            }
            if($ismain==1){
                $buysale=0;
                // if($tr->currency_id==$tr->fee_currency_id){
                //     $amount=$tr->amount+$tr->fee;
                // }else{
                //     $amount=$tr->amount;
                // }
                 $amount=$tr->amount;
            }else{
                // if($tr->currency_id==$tr->fee_currency_id){
                //     $buysale=$tr->amount+$tr->fee;
                // }else{
                //     $buysale=$tr->amount;
                // }
                 $buysale=$tr->amount;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>$tr->tranname,
                'buysale'=>floatval($sign) * floatval($buysale),
                'cur'=>$tr->currency->shortcut,
                'amount'=>floatval($sign) * floatval($amount),
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->tt,
                'timeint'=>$this->convertimetoint($tr->tt),
                'viewby'=>Auth::id(),
                'table'=>'transfer_useraffect',
                'trancode'=>$tr->trancode,
                'tran_id'=>$tr->id,
                'group_id'=>$tr->ref_group_id,
                'note'=>$tr->note . ' ' . $tr->sendertel . $tr->sendername . ' ' . $tr->rectel . $tr->recname ,
                'agent_name'=>$tr->partner->name,
                'dd'=>$tr->dd,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'recordby' => $tr->user->name,
            ]);
        }
        //បាញ់ចេញអោយលុយថៃ
         if($startdate_eq_enddate==false){
            $sum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
             ->where(function($qx) use($curid){
                $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
            })
             ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN fee_currency_id = ? THEN fee ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');
            if($ismain==1){
                $buysale=0;
                $amount=$sum??0;
            }else{
                $buysale=$sum??0;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>'សរុបលុយថៃពាក់ព័ន្ធបុគ្គលិក',
                'buysale'=>-1 * floatval($buysale),
                'cur'=>$curshortcut,
                'amount'=>-1 * floatval($amount),
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>'',
                'timeint'=>0,
                'viewby'=>Auth::id(),
                'table'=>'thai_useraffect',
                'trancode'=>0,
                'tran_id'=>0,
                'group_id'=>'',
                'note'=>$note,
                'agent_name'=>'',
                'dd'=>$predate,
                'from_date'=>$fromdate,
                'to_date'=>$predate,
            ]);
         }

        $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('user_affect',$userid)->where('status',1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
          ->where(function($qx) use($curid){
                $qx->where('currency_id',$curid)->orWhere('fee_currency_id',$curid);
            })
        ->get();
        foreach($transfers as $tr)
        {
            if($ismain==1){
                $buysale=0;
                $amount=0;
                if($tr->currency_id==$curid){
                    $amount +=$tr->amount;
                }
                if($tr->fee_currency_id==$curid){
                     $amount +=$tr->fee;
                }
            }else{
               $buysale=0;
                $amount=0;
                 if($tr->currency_id==$curid){
                    $buysale +=$tr->amount;
                }
                if($tr->fee_currency_id==$curid){
                     $buysale +=$tr->fee;
                }
            }
            DB::table('user_report_details')->insert([
                'description'=>$tr->tranname . 'លុយថៃ(' . $this->phpformatnumber($tr->thai_amt) .'B)',
                'buysale'=>-1 * floatval($buysale),
                'cur'=>$tr->currency->shortcut,
                'amount'=>-1 * floatval($amount),
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->tt,
                'timeint'=>$this->convertimetoint($tr->tt),
                'viewby'=>Auth::id(),
                'table'=>'thai_transfer_useraffect',
                'trancode'=>$tr->trancode,
                'tran_id'=>$tr->id,
                'group_id'=>$tr->ref_group_id,
                'note'=>$tr->note . ' ' . $tr->sendertel . $tr->sendername . ' ' . $tr->rectel . $tr->recname,
                'agent_name'=>$tr->partner->name,
                'dd'=>$tr->dd,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
            ]);
        }
        //បូកសេវ៉ាវេរយកពីអតិថិជន
        $cuscharges=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('cuscharge_currency_id',$curid)->where('status',1) ->whereNull('thai_amt')->whereNotNull('user_affect')
        ->where(function($query){
            $query->where('trancode',1)->orWhere(function($query1){
                $query1->where('trancode',4)->where('iscutwater',0);
            });
        })
        ->where(function($q1) use($userid){
            $q1->where(function($q2) use($userid){
                $q2->where('user_id',$userid)->where('user_affect',$userid);
            })->orWhere(function($q3) use($userid){
                $q3->where('user_id',$userid)->where('user_affect','<>',$userid);//បុគ្គលិកទី១យកaccount បុគ្គលិកទី២បាញ់ចេញ
            });
        })->sum('cuscharge');
        if($cuscharges){
            if($ismain==1){
                $buysale=0;
                $amount=$cuscharges;
            }else{
                $buysale=$cuscharges;
                $amount=0;
            }
            if(floatval($buysale)+floatval($amount)<>0){
                DB::table('user_report_details')->insert([
                    'description'=>'សរុបសេវ៉ាអតិថិជន',
                    'buysale'=>$buysale,
                    'cur'=>$curshortcut,
                    'amount'=>$amount,
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>'',
                    'timeint'=>1111,
                    'viewby'=>Auth::id(),
                    'table'=>'transfer_wing_cuscharge',
                    'note'=>'វេរតាមភ្នាក់ងារឬធនាគា',
                    'agent_name'=>'',
                    'dd'=>$viewdate,
                    'from_date'=>$fromdate,
                    'to_date'=>$viewdate,
                ]);
            }
        }


         //វេរតាមវីង ដកកំរៃជើងសារដៃគូ
         //$wefees=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('user_affect',$userid)->where('fee_currency_id',$curid)->where('status',1)->where('fee','<',0)->whereNull('thai_amt')->sum('fee');
         $wefees=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_affect',$userid)->where('fee_currency_id',$curid)->where('status',1)->where('fee','<',0)->whereNull('thai_amt')->sum('fee');
         if($wefees)
         {
             if($ismain==1){
                 $buysale=0;
                 $amount=abs($wefees);
             }else{
                 $buysale=abs($wefees);
                 $amount=0;
             }
             if(floatval($buysale)+floatval($amount)<>0){
                 DB::table('user_report_details')->insert([
                     'description'=>'សរុបបូកសេវ៉ាដៃគូ',
                     'buysale'=>floatval($buysale),
                     'cur'=>$curshortcut,
                     'amount'=>floatval($amount),
                     'deposit'=>'0',
                     'debt'=>'0',
                     'trantime'=>'',
                     'timeint'=>1111,
                     'viewby'=>Auth::id(),
                     'table'=>'transfer_wing_fee_we',
                     'note'=>'វេរតាមភ្នាក់ងារឬធនាគា',
                     'agent_name'=>'',
                     'dd'=>$viewdate,
                     'from_date'=>$fromdate,
                     'to_date'=>$viewdate,
                 ]);
             }
         }
        // $theyfees=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('user_affect',$userid)->where('fee_currency_id',$curid)->where('status',1)->where('fee','>',0)->whereNull('thai_amt')->sum('fee');
         $theyfees=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_affect',$userid)->where('fee_currency_id',$curid)->where('status',1)->where('fee','>',0)->whereNull('thai_amt')->sum('fee');
         if($theyfees)
         {
             if($ismain==1){
                 $buysale=0;
                 $amount=abs($theyfees);
             }else{
                 $buysale=abs($theyfees);
                 $amount=0;
             }
             if(floatval($buysale)+floatval($amount)<>0){
                 DB::table('user_report_details')->insert([
                     'description'=>'សរុបដកសេវ៉ាដៃគូ',
                     'buysale'=>-1 * floatval($buysale),
                     'cur'=>$curshortcut,
                     'amount'=>-1 * floatval($amount),
                     'deposit'=>'0',
                     'debt'=>'0',
                     'trantime'=>'',
                     'timeint'=>1111,
                     'viewby'=>Auth::id(),
                     'table'=>'transfer_wing_fee_they',
                     'note'=>'វេរតាមភ្នាក់ងារឬធនាគា',
                     'agent_name'=>'',
                     'dd'=>$viewdate,
                     'from_date'=>$fromdate,
                     'to_date'=>$viewdate,
                 ]);
             }
         }
    }
     public function Seerealestate($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$ckcash,$curshortcut,$note)
    {
        if($startdate_eq_enddate==false){

                $sum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_id',$userid)->where('status',1)
                ->where('currency_id',$curid)->where('location_id',8)->whereIn('trancode',[1,-1,4,-4])
                ->selectRaw("SUM(cash_amount) as total")
                ->value('total');


             if($ismain==1){
                $buysale=0;
                $amount=$sum??0;
            }else{
                $buysale=$sum??0;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>'សរុបលុយអចលនទ្រព្យ',
                'buysale'=>$buysale,
                'cur'=>$curshortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>'',
                'timeint'=>'0',
                'viewby'=>Auth::id(),
                'table'=>'transfer',
                'trancode'=>'0',
                'tran_id'=>0,
                'group_id'=>'',
                'note'=>$note ,
                'agent_name'=>'',
                'dd'=>$predate,
                'from_date'=>$fromdate,
                'to_date'=>$predate,
            ]);

        }

        $transfers=PartnerTransfer::whereDate('dd',$viewdate)->where('user_id',$userid)->where('status',1)->where('location_id',8)
        ->where('currency_id',$curid)->whereIn('trancode',[-1,1,4,-4])->get();

        foreach($transfers as $tr)
        {
            if($ismain==1){
                $buysale=0;
                $amount=$tr->cash_amount??0;
            }else{
                $amount=0;
                $buysale =$tr->cash_amount??0;
            }
            DB::table('user_report_details')->insert([
                'description'=>$tr->tranname,
                'buysale'=>$buysale,
                'cur'=>$tr->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->tt,
                'timeint'=>$this->convertimetoint($tr->tt),
                'viewby'=>Auth::id(),
                'table'=>'transfer',
                'trancode'=>$tr->trancode,
                'tran_id'=>$tr->id,
                'group_id'=>$tr->ref_group_id,
                'note'=>$tr->note . ' ' . $tr->sendertel . $tr->sendername . ' ' . $tr->rectel . $tr->recname ,
                'agent_name'=>$tr->partner->name,
                'dd'=>$tr->dd,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
            ]);
        }

    }
    public function SeeExpanse($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note)
    {
         if($startdate_eq_enddate==false){
            $sum=Expanse::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->sum('amount');
            if($ismain==1){
                $buysale=0;
                $amount=$sum??0;
            }else{
                $buysale=$sum??0;
                $amount=0;
            }
                DB::table('user_report_details')->insert([
                    'description'=>'សរុបចំណាយ',
                    'buysale'=>$buysale,
                    'cur'=>$curshortcut,
                    'amount'=>$amount,
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>'',
                    'timeint'=>0,
                    'viewby'=>Auth::id(),
                    'table'=>'expanse',
                    'tran_id'=>0,
                    'note'=>$note,
                    'dd'=>$predate,
                    'from_date'=>$fromdate,
                    'to_date'=>$predate,
                ]);
         }
        $expanse=Expanse::whereDate('dd',$viewdate)->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->whereNull('transfer_id')->get();
        foreach($expanse as $tr)
        {
            if($ismain==1){
                $buysale=0;
                $amount=$tr->amount;
            }else{
                $buysale=$tr->amount;
                $amount=0;
            }
            DB::table('user_report_details')->insert([
                'description'=>$tr->tranname . $tr->type,
                'buysale'=>$buysale,
                'cur'=>$tr->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->tt,
                'timeint'=>$this->convertimetoint($tr->tt),
                'viewby'=>Auth::id(),
                'table'=>'expanse',
                'tran_id'=>$tr->id,
                'note'=>$tr->desr,
                'dd'=>$tr->dd,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
            ]);
        }
    }
    public function SeeCashdraw($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note)
    {
         if($startdate_eq_enddate==false){
            $sum=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $predate))->where('user_id',$userid)->where('status',1)
            ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
                ->selectRaw("SUM(
                    CASE WHEN currency_id = ? THEN amount ELSE 0 END +
                    CASE WHEN cuscharge_currency_id = ? THEN -1 * customer_charge ELSE 0 END
                ) as total", [$curid, $curid])
                ->value('total');

                if($ismain==1){
                    $buysale=0;
                    $amount=-1 * floatval($sum??0);
                }else{
                    $buysale=-1 * floatval($sum??0);
                    $amount=0;
                }
                DB::table('user_report_details')->insert([
                'description'=>'សរុបបើកវេរ',
                'buysale'=>$buysale,
                'cur'=>$curshortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>'',
                'timeint'=>0,
                'viewby'=>Auth::id(),
                'table'=>'cashdraw',
                'tran_id'=>0,
                'group_id'=>'',
                'note'=>$note,
                'dd'=>$predate,
                'from_date'=>$fromdate,
                'to_date'=>$predate,
            ]);
         }

        $cashdraws=Cashdraw::whereDate('opdate',$viewdate)->where('user_id',$userid)->where('status',1)
        ->where(function($qx) use($curid){
                    $qx->where('currency_id',$curid)->orWhere('cuscharge_currency_id',$curid);
                })
        ->get();
        foreach($cashdraws as $tr)
        {
            if($ismain==1){
                $buysale=0;
                $amount=0;
                if($tr->currency_id==$curid){
                    $amount +=-1 * floatval($tr->amount);
                }
                if($tr->cuscharge_currency_id==$curid){
                    $amount +=floatval($tr->customer_charge);
                }
            }else{
                $buysale=0;
                $amount=0;
                if($tr->currency_id==$curid){
                    $buysale +=-1 * floatval($tr->amount);
                }
                if($tr->cuscharge_currency_id==$curid){
                    $buysale +=floatval($tr->customer_charge);
                }
            }

            if($tr->customer_charge<>0){
                $desr='បើកវេរ(' . $this->phpformatnumber($tr->amount) . $tr->currency->sk . '-' . $this->phpformatnumber($tr->customer_charge) . $tr->cuschargecur->sk . ')';
            }else{
                $desr='បើកវេរ';
            }
            DB::table('user_report_details')->insert([
                'description'=>$desr,
                'buysale'=>$buysale,
                'cur'=>$tr->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->optime,
                'timeint'=>$this->convertimetoint($tr->optime),
                'viewby'=>Auth::id(),
                'table'=>'cashdraw',
                'tran_id'=>$tr->id,
                'group_id'=>$tr->ref_group_id,
                'note'=>$tr->other . ' ' . $tr->receive_tel . '' . $tr->receive_name,
                'dd'=>$tr->opdate,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'recordby'=>$tr->user->name
            ]);
        }

        // $cashdrawscuscharge=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('cuscharge_currency_id',$curid)->whereColumn('cuscharge_currency_id','<>','currency_id')->where('status',1)->get();
        // foreach($cashdrawscuscharge as $tr)
        // {
        //     if($ismain==1){
        //         $buysale=0;
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $amount=floatval($tr->customer_charge);
        //         }else{
        //             $amount=0;
        //         }
        //     }else{
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $buysale=floatval($tr->customer_charge);
        //         }else{
        //             $buysale=0;
        //         }
        //         $amount=0;
        //     }


        //     if($tr->customer_charge<>0){
        //         $desr='សេវ៉ាបើកវេរ(' . $this->phpformatnumber($tr->amount) . $tr->currency->sk . '-' . $this->phpformatnumber($tr->customer_charge). $tr->cuschargecur->sk . ')';
        //     }else{
        //         $desr='សេវ៉ាបើកវេរ';
        //     }
        //     if($amount<>0 || $buysale<>0){
        //         DB::table('user_report_details')->insert([
        //             'description'=>$desr,
        //             'buysale'=>$buysale,
        //             'cur'=>$tr->cuschargecur->shortcut,
        //             'amount'=>$amount,
        //             'deposit'=>'0',
        //             'debt'=>'0',
        //             'trantime'=>$tr->optime,
        //             'timeint'=>$this->convertimetoint($tr->optime),
        //             'viewby'=>Auth::id(),
        //             'table'=>'cashdraw_cuscharge_notthesamecur',
        //             'tran_id'=>$tr->id,
        //             'group_id'=>$tr->ref_group_id,
        //             'note'=>$tr->other . ' ' . $tr->receive_tel . '' . $tr->receive_name,
        //             'dd'=>$tr->opdate,
        //         ]);
        //     }
        // }
    }
    public function SeeCashdrawthai($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curshortcut,$note)
    {
        if($startdate_eq_enddate==false){
            $sum=SmsProcess::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $predate))->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->where('paymethod','Cash')->sum('amount');
            $buysale=-1 * floatval($sum??0);
            $amount=0;
            $desr='សរុបបើកវេរលុយថៃ';
            DB::table('user_report_details')->insert([
                'description'=>$desr,
                'buysale'=>$buysale,
                'cur'=>$curshortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>'',
                'timeint'=>0,
                'viewby'=>Auth::id(),
                'table'=>'smsprocess',
                'tran_id'=>0,
                'note'=>$note,
                'dd'=>$predate,
                'from_date'=>$fromdate,
                'to_date'=>$predate,

            ]);
        }

        $cashdraws=SmsProcess::whereDate('opdate',$viewdate)->where('user_id',$userid)->where('currency_id',$curid)->where('status',1)->where('paymethod','Cash')->get();
        foreach($cashdraws as $tr)
        {
            $buysale=-1 * floatval($tr->amount);
            $amount=0;
            $desr='បើកវេរលុយថៃ';
            DB::table('user_report_details')->insert([
                'description'=>$desr,
                'buysale'=>$buysale,
                'cur'=>$tr->currency->shortcut,
                'amount'=>$amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$tr->optime,
                'timeint'=>$this->convertimetoint($tr->optime),
                'viewby'=>Auth::id(),
                'table'=>'smsprocess',
                'tran_id'=>$tr->id,
                'note'=>$tr->other . ' ' . $tr->rectel . '' . $tr->recname,
                'dd'=>$tr->opdate,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'recordby'=>$tr->user->name
            ]);
        }

        // $cashdraws=SmsProcess::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $viewdate))->where('user_id',$userid)->where('cuscharge_currency_id',$curid)->where('status',1)->get();
        // foreach($cashdraws as $tr)
        // {
        //     if($ismain==1){
        //         $buysale=0;
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $amount=-1 *  floatval($tr->customer_charge);
        //         }else{
        //             $amount=0;
        //         }
        //     }else{
        //         if($tr->currency_id!==$tr->cuscharge_currency_id){
        //             $buysale=-1 * floatval($tr->customer_charge);
        //         }else{
        //             $buysale=0;
        //         }
        //         $amount=0;
        //     }


        //     if($tr->customer_charge<>0){
        //         $desr='បើកវេរ(' . $this->phpformatnumber($tr->amount) . '-' . $this->phpformatnumber($tr->customer_charge) . ')';
        //     }else{
        //         $desr='បើកវេរ';
        //     }
        //     DB::table('user_report_details')->insert([
        //         'description'=>$desr,
        //         'buysale'=>$buysale,
        //         'cur'=>$tr->currency->shortcut,
        //         'amount'=>$amount,
        //         'deposit'=>'0',
        //         'debt'=>'0',
        //         'trantime'=>$tr->optime,
        //         'timeint'=>$this->convertimetoint($tr->optime),
        //         'viewby'=>Auth::id(),
        //         'table'=>'smsprocess',
        //         'note'=>$tr->other . ' ' . $tr->receive_tel . '' . $tr->receive_name,
        //         'dd'=>$tr->opdate,
        //     ]);
        // }
    }
    public function Seeinvoice($fromdate,$viewdate,$userid)
    {
        $op='=';
        $sumid=0;
        $oldid=0;
        if($userid==0){
            $op='<>';
        }
        $invs=Invoice::whereBetween(DB::raw('DATE(invdate)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('status',1)->where('cur','USD')->orderBy('id')->get();

        foreach($invs as $i){
            if($i->totalweight>0){
                $desr='ទិញពី' . $i->customer->name ;
            }else{
                $desr='លក់អោយ' . $i->customer->name ;
            }

            //get deposit
            $sumpayment=$i->payment->where('paiddate',$viewdate)->sum('amount');
            $sumid=$i->payment->where('paiddate',$viewdate)->sum('id');


            if($oldid==0){
                $oldid=$sumid;
            }else{
                if($oldid==$sumid){
                    $sumpayment=0;
                }
                $oldid=$sumid;
            }

            DB::table('user_report_details')->insert([
                'invnum'=>$i->id,
                'description'=>$desr,
                'buysale'=>$i->totalweight,
                'cur'=>'លី',
                'amount'=>$i->total,
                'deposit'=>$sumpayment,
                'debt'=>$i->total-$sumpayment,
                'trantime'=>$i->invtime,
                'timeint'=>$this->convertimetoint($i->invtime),
                'viewby'=>Auth::id(),
                'table'=>'invoice',
                'dd'=>$i->invdate,
                'from_date'=>$fromdate,
                'to_date'=>$viewdate,
            ]);
        }
        $paybuyvaibank=Payment::join('payment_details','payment_details.payment_id','=','payments.id')
        ->whereDate('payments.paiddate','=',$viewdate)->where('payments.status',1)->where('payments.user_id',$op,$userid)->where('payments.amount','<','0')->where('payment_details.paymethod','bank')
        ->select('payments.*','payment_details.amount as payamt','payment_details.paynote')->get();
        foreach($paybuyvaibank as $pbb){
            DB::table('user_report_details')->insert([
                'description'=>'ទូទាត់អោយអតិថិជនតាមរយះ'. $pbb->paynote,
                'buysale'=>0,
                'cur'=>'',
                'amount'=>abs($pbb->payamt),
                'deposit'=>0,
                'debt'=>0,
                'trantime'=>$pbb->paidtime,
                'timeint'=>$this->convertimetoint($pbb->paidtime),
                'viewby'=>Auth::id(),
                'table'=>'invoice',
                'from_date'=>$fromdate,
                'to_date'=>$viewdate,
            ]);
        }

        $paysalevaibank=Payment::join('payment_details','payment_details.payment_id','=','payments.id')
        ->whereDate('payments.paiddate','=',$viewdate)->where('payments.status',1)->where('payments.user_id',$op,$userid)->where('payments.amount','>','0')->where('payment_details.paymethod','bank')
        ->select('payments.*','payment_details.amount as payamt','payment_details.paynote')->get();
        foreach($paysalevaibank as $pbb){
            DB::table('user_report_details')->insert([
                'description'=>'អតិថិជនទូទាត់សងតាមរយះ'. $pbb->paynote,
                'buysale'=>0,
                'cur'=>'',
                'amount'=>-1 * abs($pbb->payamt),
                'deposit'=>0,
                'debt'=>0,
                'trantime'=>$pbb->paidtime,
                'timeint'=>$this->convertimetoint($pbb->paidtime),
                'viewby'=>Auth::id(),
                'table'=>'invoice',
                'from_date'=>$fromdate,
                'to_date'=>$viewdate,
            ]);
        }

    }
    public function seeexchange($fromdate,$predate,$viewdate,$startdate_eq_enddate,$userid,$curid,$ismain,$curname,$note)
    {
        $op='=';
        if($userid==0){
            $op='<>';
        }
        if($startdate_eq_enddate==false){
            if($ismain==1){
                $sum=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_id',$op,$userid)->where('status',1)->where('isexchangelist',0)->sum('amount');
                $luy=$sum??0;
                $product=0;
            }else{
                $sum=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('user_id',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('isexchangelist',0)->sum('product');
                $luy=0;
                $product=$sum??0;
            }
             if($sum){
                 DB::table('user_report_details')->insert([
                    'description'=>'សរុបប្តូរប្រាក់',
                    'buysale'=>$product,
                    'cur'=>$curname,
                    'amount'=>$luy,
                    'deposit'=>'0',
                    'debt'=>'0',
                    'trantime'=>'0',
                    'timeint'=>'0',
                    'viewby'=>Auth::id(),
                    'table'=>'exchange',
                    'dd'=>$predate,
                    'note'=>$note,
                    'from_date'=>$fromdate,
                    'to_date'=>$predate,
                    'tran_id'=>0,
                    'group_id'=>'',
                ]);
            }
        }
        if($ismain==1){
            $exchanges=Exchange::whereDate('dd',$viewdate)->where('user_id',$op,$userid)->where('status',1)->where('isexchangelist',0)->get();
        }else{
            $exchanges=Exchange::whereDate('dd',$viewdate)->where('user_id',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('isexchangelist',0)->get();
        }
        foreach($exchanges as $ex)
        {
            //$exchangefrom=Exchange::where('id','<>',$ex->id)->where('multiexchangecode',$ex->id)->first();
            $exchangefrom=Exchange::where('id','<>',$ex->id)->where('product_first_id',$ex->product_first_id)->whereNotNull('product_first_id')->first();
            if($exchangefrom){
                if($ex->product>0){
                    //$desr='ទិញចូល('. $this->phpformatnumber($exchangefrom->product) . ' ' . $exchangefrom->pcur . ')';
                    $desr=$ex->pcur . '-' . $exchangefrom->pcur . '('. $this->phpformatnumber($exchangefrom->product) . ' ' . $exchangefrom->pcur . ')';

                }else{
                    $desr='លក់ចេញ('.$this->phpformatnumber($exchangefrom->product) . ' ' . $exchangefrom->pcur . ')';
                    $desr=$exchangefrom->pcur . '-' . $ex->pcur . '('. $this->phpformatnumber($exchangefrom->product) . ' ' . $exchangefrom->pcur . ')';
                }
            }else{
                if($ex->product>0){
                    if($ex->goldwater>0){
                        $desr='ទិញចូល' . '(ទឹកមាស=' . $ex->goldwater . ')' ;
                    }else{
                        $desr='ទិញចូល';
                    }
                }else{
                     if($ex->goldwater>0){
                        $desr='លក់ចេញ' . '(ទឹកមាស=' . $ex->goldwater . ')' ;
                     }else{
                         $desr='លក់ចេញ';
                     }
                }
            }
            DB::table('user_report_details')->insert([

                'description'=>$desr ,
                'buysale'=>$ex->product,
                'cur'=>$ex->currency->shortcut,
                'amount'=>$ex->amount,
                'deposit'=>'0',
                'debt'=>'0',
                'trantime'=>$ex->tt,
                'timeint'=>$this->convertimetoint($ex->tt),
                'viewby'=>Auth::id(),
                'table'=>'exchange',
                'dd'=>$ex->dd,
                'note'=>$ex->note . ' ' . $ex->desr,
                'from_date'=>$viewdate,
                'to_date'=>$viewdate,
                'tran_id'=>$ex->id,
                'group_id'=>$ex->product_first_id?$ex->ref_group_id.'_'.$ex->product_first_id:$ex->ref_group_id,
                'recordby'=>$ex->user->name,
            ]);
        }
    }
    public function showcloselist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $viewdate = str_replace('/', '-', $request->viewdate);
        $viewdate= date('Y-m-d', strtotime($viewdate));
        $userid=$request->userid;
        DB::table('user_reports')->where('viewby',Auth::id())->delete();
        $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$userid)->where('status',1)->whereDate('trandate','<=',$viewdate)->where('company_id',$selcomid)->max('trandate');
        if(is_null($fromdate)){
            $fromdate=PartnerTransfer::where('status',1)->where('user_id',$userid)->where('company_id',$selcomid)->whereDate('dd','<=',$viewdate)->min('dd');
            if(is_null($fromdate)){
                $fromdate=$viewdate;
            }
        }

        $usercapitalcur=UserCapital::where('user_id_affect',$userid)->where('company_id',$selcomid)->where('status',1)->whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->select('currency_id')->distinct()->get();

        $userpartnercur=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        $exchangecur=Exchange::where('status',1)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$userid)->select('currency_id')->distinct()->get();

        $c=collect();
        foreach($usercapitalcur as $cur)
        {
            $c=$c->push(['currency_id'=>$cur->currency_id,'no'=>$cur->currency->no,'isexchangecur'=>$cur->currency->isexchangecur,'ismain'=>$cur->currency->ismain,'partner_cur'=>$cur->currency->partner_cur]);
        }
        foreach($userpartnercur as $cur)
        {
            if(!$c->contains('currency_id',$cur->id)){
                $c=$c->push(['currency_id'=>$cur->id,'no'=>$cur->no,'isexchangecur'=>$cur->isexchangecur,'ismain'=>$cur->ismain,'partner_cur'=>$cur->partner_cur]);
            }
        }
        foreach($exchangecur as $cur)
        {
            if(!$c->contains('currency_id',$cur->currency_id)){
                $c=$c->push(['currency_id'=>$cur->currency_id,'no'=>$cur->currency->no,'isexchangecur'=>$cur->currency->isexchangecur,'ismain'=>$cur->currency->ismain,'partner_cur'=>$cur->partner_cur]);
            }
        }

        $myc=$c->sortBy('no');

        foreach($myc as $uc)
        {
            $this->douserreport($request,$uc['currency_id'],$uc['isexchangecur'],$uc['ismain'],$uc['partner_cur'],$fromdate);
        }

        $report=UserReport::where('viewby',Auth::id())->orderBy('id')->get();
        $buysaleusd=UserReport::where('viewby',Auth::id())->select(DB::raw('sum(amtsale) as tbuy,sum(amtbuy) as tsale'))->first();
        $acc=UserReport::where('viewby',Auth::id())->where('isexchangecur',0)->select(DB::raw('sum(amtbuy-depositbuy) as accpay,sum(amtsale-depositsale) as accrec'))->first();
        $ckcash=$request->moneytype;
        return view('usercapitals.userreport',compact('report','buysaleusd','acc','fromdate','ckcash','viewdate'));
    }
    public function printusercloselist(Request $request)
    {
        //$date = str_replace('/', '-', $request->dd);
        $title=['user'=>$request->username,'date'=>$request->date];
        $report=UserReport::where('viewby',Auth::id())->orderBy('id')->get();
        $buysaleusd=UserReport::where('viewby',Auth::id())->select(DB::raw('sum(amtsale) as tbuy,sum(amtbuy) as tsale'))->first();
        $acc=UserReport::where('viewby',Auth::id())->where('isexchangecur',0)->select(DB::raw('sum(amtbuy-depositbuy) as accpay,sum(amtsale-depositsale) as accrec'))->first();
        return view('usercapitals.printusercloselist',compact('report','buysaleusd','acc','title'));
    }
    public function printuserendlist(Request $request)
    {
        //return $request->all();
        $date = str_replace('/', '-', $request->dd);
        $trandate= date('Y-m-d', strtotime($date));
        $title=['user'=>$request->username,'date'=>$request->dd];
        $usercapitalend=UserCapital::whereDate('trandate',$trandate)->where('user_id_affect',$request->userid)->where('status',1)->where('trancode',-2)->orderBy('id')->get();
        //return $title;
        return view('usercapitals.printuserendlist',compact('usercapitalend','title'));
    }
    public function printusertransaction(Request $request)
    {
        $title=['user'=>$request->username,'date'=>$request->date];
        $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->orderBy('ttint')->orderBy('id')->get();
        $sumfns=UserTransactionReport::where('viewby',Auth::user()->name)->where('fn','<>','0')->select(DB::raw('shortcut,sum(fn) as fn'))->groupBy('shortcut')->get();
        if($request->alltran){
          return view('usercapitals.printusertransactionall',compact('usertransactions','sumfns','title'));
        }else{
          return view('usercapitals.printusertransaction',compact('usertransactions','sumfns','title'));
        }
    }
    public function moneyoffer()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        //$users=User::where('active',1)->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $currencies=Currency::where('active',1)->where('ispandp','0')->where('company_id',$selcomid)->orderBy('no')->get();

        $user_id=Auth::id();
        $moneyoffers=UserOffer::whereDate('offer_date',$current)->where('status',1)->where('isaccept',0)->where('company_id',$selcomid);
        $moneyoffers->where(function ($query) use($user_id){
            return $query->where('offer_by_user_id',$user_id)->orWhere('offer_to_user_id',$user_id);
        });
        $moneyoffers=$moneyoffers->orderBy('id')->get();
        $agenttypes=AgentType::where('status',1)->orderBy('no')->get();
        $companies=Company::where('status',1)->get();
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BANK','AGENT'])->get();
        return view('usercapitals.moneyoffer',compact('users','currencies','moneyoffers','agenttypes','companies','selcomid','banks'));
    }
    public function showuseroffer(Request $request)
    {
        // WHERE (a = 1 OR b =1 ) AND (c = 1 OR d = 1)
        // Model::where(function ($query) {
        //     $query->where('a', '=', 1)
        //           ->orWhere('b', '=', 1);
        // })->where(function ($query) {
        //     $query->where('c', '=', 1)
        //           ->orWhere('d', '=', 1);
        // });
        //return $request->all();
        $rad=$request->rad;
        //$selcomid=Session('log_into_company_id');
        $user_id=$request->user;
        $selcomid=$request->companyid;
        $date = str_replace('/', '-', $request->searchdate);
        $showdate= date('Y-m-d', strtotime($date));
        $moneyoffers=UserOffer::whereDate('offer_date',$showdate)->where('company_id',$selcomid);
        if($rad==0){
            $moneyofers=$moneyoffers->where('status',1)->where('isaccept',0);
        }elseif($rad==1){
            $moneyofers=$moneyoffers->where('status',1)->where('isaccept',1);
        }elseif($rad==-1){
            $moneyofers=$moneyoffers->where('status',0);
        }
        if($user_id!='all'){
            $moneyoffers->where(function ($query) use($user_id){
                return $query->where('offer_by_user_id',$user_id)->orWhere('offer_to_user_id',$user_id);
            });
        }
        $moneyoffers=$moneyoffers->orderBy('id')->get();


        return view('usercapitals.showmoneyoffer',compact('moneyoffers'));
    }
    public function douserreport(Request $request,$curid,$isexchangecur,$ismaincur,$partnercur,$fromdate)
    {
        $viewdate = str_replace('/', '-', $request->viewdate);
        $viewdate= date('Y-m-d', strtotime($viewdate));
        $qtybuy=0;
        $amtbuy=0;
        $qtysale=0;
        $amtsale=0;
        $capital=0;
        $cashin=0;
        $cashout=0;
        $capitalend=0;
        $depositbuy=0;
        $depositsale=0;
        $moneytranfer=0;
        $cuscharge=0;
        $cashdraw=0;
        $cashdrawing_other_account=0;
        $cashdrawcuscharge=0;
        $thaicashdraw=0;
        $expanse=0;
        $income=0;
        $realestate_in=0;
        $realestate_out=0;

        // $bankin=0;
        // $bankout=0;
        $transfer_affect_user_cashout=0;
        $transfer_affect_user_cashout_thai=0;
        $transfer_affect_user_cashin=0;
        $cuscharge_useraffect_cashin=0;

        $fee_useraffect_cashout=0;
        $fee_useraffect_cashin=0;

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $op='=';
        $userid=$request->userid;
        if($request->userid==0){
            $op='<>';
        }
        // $user_customer=[];
        // $user=User::find($userid);
        // if($user){
        //     $user_customer=explode(',',$user->customer_connect);
        // }
        if($request->moneytype=='cash'){
            $capital1=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',2)->where('capital_type','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $cashin1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',1)->where('capital_type','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $cashout1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-1)->where('capital_type','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $capitalend1=UserCapital::whereDate('trandate',$viewdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-2)->where('capital_type','cash')->select(DB::raw('sum(amount) as amt'))->first();
            if($partnercur==1){
                $moneytransfer1=PartnerTransfer::where('trancode',1)->whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('currency_id',$curid)->where('location_id','<>',8)
                ->select(DB::raw('sum(amount) as amt'))->first();
                $cuscharge1=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('cuscharge_currency_id',$curid)
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){
                        $q1->where('trancode',4)->where('iscutwater',0);
                    });
                })
                ->select(DB::raw('sum(cuscharge) as amt'))->first();
                $cashdraw_wing_other_useraccount=PartnerTransfer::where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3)->whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->where('user_id',$op,$userid)
                ->select(DB::raw('sum(amount) as amt'))->first();
            }
        }elseif($request->moneytype==='bank'){
            $capital1=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',2)->where('capital_type','<>','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $cashin1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',1)->where('capital_type','<>','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $cashout1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-1)->where('capital_type','<>','cash')->select(DB::raw('sum(amount) as amt'))->first();
            $capitalend1=UserCapital::whereDate('trandate',$viewdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-2)->where('capital_type','<>','cash')->select(DB::raw('sum(amount) as amt'))->first();
            if($partnercur==1){
                $moneytransfer_useraffectcashout=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();
                $moneytransfer_useraffectcashin_positive=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')->where('amount','>',0)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);//ភ្ញៀវប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិកខ្លួន
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();
                $moneytransfer_useraffectcashin_negative=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')->where('amount','<',0)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);//ភ្ញៀវប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិកខ្លួន
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();

                $cuscharge_useraffect=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('cuscharge_currency_id',$curid)->whereNull('thai_amt')
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){
                        $q1->where('trancode',4)->where('iscutwater',0);
                    });
                })
                ->where(function($q2) use($userid){
                    $q2->where(function($q3) use($userid){
                        $q3->where('user_id',$userid)->where('user_affect',$userid);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('user_id',$userid)->where('user_affect','<>',$userid);//បុគ្គលិកទី១យកaccount បុគ្គលិកទី២បាញ់ចេញ
                    });
                })
                ->select(DB::raw('sum(cuscharge) as amt'))->first();
                $fee_affectcashout=PartnerTransfer::where('fee','>',0)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->where('fee_currency_id',$curid)->select(DB::raw('sum(fee) as amt'))->first();
                $fee_affectcashin=PartnerTransfer::where('fee','<',0)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->where('fee_currency_id',$curid)->select(DB::raw('sum(fee) as amt'))->first();
                $moneytransfer_useraffectcashout_thai=PartnerTransfer::where('mekun',1)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->whereNotNull('thai_amt')->whereNotNull('docodeby')->where('currency_id',$curid)->select(DB::raw('sum(amount) as amt'))->first();
                $cashdraw_wing_other_useraccount=PartnerTransfer::where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3)->whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('user_affect','<>',$userid)->where('currency_id',$curid)
                ->select(DB::raw('sum(amount) as amt'))->first();
            }

        }else{
            $capital1=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',2)->select(DB::raw('sum(amount) as amt'))->first();
            $cashin1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',1)->select(DB::raw('sum(amount) as amt'))->first();
            $cashout1=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $viewdate))->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-1)->select(DB::raw('sum(amount) as amt'))->first();
            $capitalend1=UserCapital::whereDate('trandate',$viewdate)->where('user_id_affect',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('trancode',-2)->select(DB::raw('sum(amount) as amt'))->first();

            if($partnercur==1){
                $moneytransfer1=PartnerTransfer::where('trancode',1)->whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->whereNull('user_affect')->where('currency_id',$curid)->where('location_id','<>',8)->select(DB::raw('sum(amount) as amt'))->first();
                $cuscharge1=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->whereNull('user_affect')->where('cuscharge_currency_id',$curid)
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){
                        $q1->where('trancode',4)->where('iscutwater',0);
                    });
                })
                ->select(DB::raw('sum(cuscharge) as amt'))->first();
                $moneytransfer_useraffectcashout=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់ លុយត្រូវដកចេញពីបុគ្គលិកទី២
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();
                $moneytransfer_useraffectcashin_positive=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')->where('amount','>',0)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);//ភ្ញៀវប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិកខ្លួន
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();
                $moneytransfer_useraffectcashin_negative=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('currency_id',$curid)->whereNull('thai_amt')->where('amount','<',0)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->whereNotNull('user_affect')->where('user_affect','<>',$userid)->where('user_id','=',$userid);//ភ្ញៀវប្តូរប្រាក់យកគណនីបុគ្គលិកផ្សេងបាញ់ចេញ លុយត្រូវបូកចូលបុគ្គលិកទី១
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);//ភ្ញៀវប្តូរប្រាក់បាញ់ចូលគណនីបុគ្គលិកខ្លួន
                    })->orWhere(function($q5) use($userid){
                        $q5->where('trancode',-1)->where('iscashdraw',1)->where('user_affect',$userid)->whereNotNull('docodeby');//ដកកូតវីង កន្លែងធ្វើលុយថៃ
                    });
                })->select(DB::raw('sum(amount) as amt'))->first();
                $cuscharge_useraffect=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('cuscharge_currency_id',$curid)->whereNull('thai_amt')
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){
                        $q1->where('trancode',4)->where('iscutwater',0);
                    });
                })
                ->where(function($q2) use($userid){
                    $q2->where(function($q3) use($userid){
                        $q3->where('user_id',$userid)->where('user_affect',$userid);
                    })->orWhere(function($q4) use($userid){
                        $q4->where('user_id',$userid)->where('user_affect','<>',$userid);//បុគ្គលិកទី១យកaccount បុគ្គលិកទី២បាញ់ចេញ
                    });
                })
                ->select(DB::raw('sum(cuscharge) as amt'))->first();
                $fee_affectcashout=PartnerTransfer::where('fee','>',0)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->where('fee_currency_id',$curid)->select(DB::raw('sum(fee) as amt'))->first();
                $fee_affectcashin=PartnerTransfer::where('fee','<',0)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->where('fee_currency_id',$curid)->select(DB::raw('sum(fee) as amt'))->first();
                $moneytransfer_useraffectcashout_thai=PartnerTransfer::where('mekun',1)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_affect',$op,$userid)->whereNotNull('thai_amt')->whereNotNull('docodeby')->where('currency_id',$curid)->select(DB::raw('sum(amount) as amt'))->first();
                $cashdraw_wing_other_useraccount=PartnerTransfer::where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3)->whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('user_affect','<>',$userid)->where('currency_id',$curid)
                ->select(DB::raw('sum(amount) as amt'))->first();
            }
        }
        if(config('helper.realestate') == 1){
            $realestate_cashin=PartnerTransfer::whereIn('trancode',[1,4])->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('currency_id',$curid)->where('location_id',8)
            ->select(DB::raw('sum(cash_amount) as amt'))->first();

            $realestate_cashout=PartnerTransfer::whereIn('trancode',[-1,-4])->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('status',1)->where('user_id',$op,$userid)->where('currency_id',$curid)->where('location_id',8)
            ->select(DB::raw('sum(cash_amount) as amt'))->first();
            if($realestate_cashin->amt<>null){
                $realestate_in=$realestate_cashin->amt;
            }
            if($realestate_cashout->amt<>null){
                $realestate_out=$realestate_cashout->amt;
            }
        }

        if($request->moneytype=='cash' || $request->moneytype=='both'){
            if($partnercur==1){
                $cashdraw1=Cashdraw::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->select(DB::raw('sum(amount) as amt'))->first();
                $cashdrawcuscharge1=Cashdraw::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('cuscharge_currency_id',$curid)->select(DB::raw('sum(customer_charge) as amt'))->first();
                $expanse1=Expanse::where('status',1)->where('amount','<',0)->whereNull('transfer_id')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->select(DB::raw('sum(amount) as amt'))->first();
                $income1=Expanse::where('status',1)->where('amount','>',0)->whereNull('transfer_id')->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->select(DB::raw('sum(amount) as amt'))->first();
                $thai_cashdraw=SmsProcess::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->where('paymethod','Cash')->select(DB::raw('sum(amount) as amt'))->first();

                if($thai_cashdraw->amt<>null){
                     $thaicashdraw=-1 * floatval($thai_cashdraw->amt);
                 }
                if($moneytransfer1->amt<>null){
                    $moneytranfer=$moneytransfer1->amt;
                }
                if($cuscharge1->amt<>null){
                    $cuscharge=$cuscharge1->amt;
                }
                 if($cashdraw1->amt<>null){
                $cashdraw=-1 * $cashdraw1->amt;
                }
                if($expanse1->amt<>null){
                    $expanse=$expanse1->amt;
                }
                if($income1->amt<>null){
                    $income=$income1->amt;
                }
                if($cashdrawcuscharge1->amt<>null){
                    $cashdrawcuscharge= $cashdrawcuscharge1->amt;
                }
            }
        }


        if($capital1->amt<>null){
            $capital=$capital1->amt;
        }
        if($cashin1->amt<>null){
            $cashin=$cashin1->amt;
        }
        if($cashout1->amt<>null){
            $cashout=$cashout1->amt;
        }
        if($capitalend1->amt<>null){
            $capitalend=$capitalend1->amt;
        }
        if($partnercur==1){
            if($request->moneytype=='both' || $request->moneytype=='bank'){
                if($moneytransfer_useraffectcashin_positive->amt<>null){
                    $transfer_affect_user_cashin=abs($moneytransfer_useraffectcashin_positive->amt);
                }
                if($moneytransfer_useraffectcashin_negative->amt<>null){
                    $transfer_affect_user_cashin +=abs($moneytransfer_useraffectcashin_negative->amt);
                }
                if($moneytransfer_useraffectcashout->amt<>null){
                  //$transfer_affect_user_cashout=-1 * $moneytransfer_useraffectcashout->amt;
                  $transfer_affect_user_cashout=-1 * abs($moneytransfer_useraffectcashout->amt);
                }
                if($moneytransfer_useraffectcashout_thai->amt<>null){
                    $transfer_affect_user_cashout_thai=-1 * $moneytransfer_useraffectcashout_thai->amt;
                }
                if($cuscharge_useraffect->amt<>null){
                    $cuscharge_useraffect_cashin=$cuscharge_useraffect->amt;
                }

                if($fee_affectcashin->amt<>null){
                    $fee_useraffect_cashin=abs($fee_affectcashin->amt);
                }
                if($fee_affectcashout->amt<>null){
                    $fee_useraffect_cashout=-1 * abs($fee_affectcashout->amt);
                }

            }

            if($cashdraw_wing_other_useraccount->amt<>null){
                $cashdrawing_other_account=$cashdraw_wing_other_useraccount->amt;
            }
        }

        if($ismaincur==0){
            if($isexchangecur==0){

                $invbuy=Invoice::whereDate('invdate','=',$viewdate)->where('user_id',$op,$userid)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight'))->first();
                if($invbuy->tweight<>null){
                    $qtybuy=$invbuy->tweight;

                }
                $invbuy1=Invoice::whereDate('invdate','=',$viewdate)->where('user_id',$op,$userid)->where('status',1)->where('cur','USD')->where('total','<','0')->select(DB::raw('sum(total) as totalamount'))->first();
                if($invbuy1->totalamount<>null){
                    $amtbuy=$invbuy1->totalamount;
                }
                //get deposit to customer
                $depositbuy1=Payment::whereDate('paiddate',$viewdate)->where('status',1)->where('user_id',$op,$userid)->where('amount','<','0')->select(DB::raw('sum(amount) as depositamt'))->first();
                if($depositbuy1->depositamt<>null){
                    $depositbuy=$depositbuy1->depositamt;
                }

                $invsale=Invoice::whereDate('invdate','=',$viewdate)->where('user_id',$op,$userid)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight'))->first();
                if($invsale->tweight<>null){
                    $qtysale=$invsale->tweight;
                }
                $invsale1=Invoice::whereDate('invdate','=',$viewdate)->where('user_id',$op,$userid)->where('status',1)->where('cur','USD')->where('total','>','0')->select(DB::raw('sum(total) as totalamount'))->first();
                if($invsale1->totalamount<>null){
                    $amtsale=$invsale1->totalamount;
                }
                $depositsale1=Payment::whereDate('paiddate',$viewdate)->where('status',1)->where('user_id',$op,$userid)->where('amount','>','0')->select(DB::raw('sum(amount) as depositamt'))->first();
                if($depositsale1->depositamt<>null){
                    $depositsale=$depositsale1->depositamt;
                }
            }else{
                if($request->moneytype=='cash' || $request->moneytype=='both'){
                    $invbuy=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('isexchangelist',0)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                    if($invbuy->tweight<>null){
                        $qtybuy=$invbuy->tweight;
                        $amtbuy=$invbuy->totalamount;
                    }
                    $invsale=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $viewdate))->where('user_id',$op,$userid)->where('currency_id',$curid)->where('status',1)->where('isexchangelist',0)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();

                    if($invsale->tweight<>null){
                        $qtysale=$invsale->tweight;
                        $amtsale=$invsale->totalamount;
                    }
                }
            }
        }else{
            //cashin money to user by bank
            $paybuyvaibank=Payment::join('payment_details','payment_details.payment_id','=','payments.id')
            ->whereBetween(DB::raw('DATE(payments.paiddate)'), array($fromdate, $viewdate))
            ->where('payments.status',1)->where('payments.user_id',$op,$userid)->where('payments.amount','<','0')->where('payment_details.paymethod','bank')
            ->select(DB::raw('sum(payment_details.amount) as tamountdetail'))->first();
            if($paybuyvaibank->tamountdetail<>null){
                $cashin +=abs($paybuyvaibank->tamountdetail);
            }

            //cashout money from user by bank
            $paysalevaibank=Payment::join('payment_details','payment_details.payment_id','=','payments.id')
            ->whereBetween(DB::raw('DATE(payments.paiddate)'), array($fromdate, $viewdate))
            ->where('payments.status',1)->where('payments.user_id',$op,$userid)->where('payments.amount','>','0')->where('payment_details.paymethod','bank')
            ->select(DB::raw('sum(payment_details.amount) as tamountdetail'))->first();
            if($paysalevaibank->tamountdetail<>null){
                $cashout += -1 * $paysalevaibank->tamountdetail;
            }
        }

        DB::table('user_reports')->insert([
            'viewdate'=>$viewdate,
            'user_id'=>$userid,
            'currency_id'=>$curid,
            'capital'=>$capital,
            'buyin'=>$qtybuy,
            'amtbuy'=>$amtbuy,
            'depositbuy'=>$depositbuy,
            'saleout'=>$qtysale,
            'amtsale'=>$amtsale,
            'depositsale'=>$depositsale,

            //'cashin'=>$cashin +$moneytranfer+$cuscharge+$transfer_affect_user_cashin+$income+$cashdrawcuscharge+$cuscharge_useraffect_cashin+$fee_useraffect_cashin,
            'cashin'=>$cashin +$moneytranfer+$transfer_affect_user_cashin+$income+$realestate_in,

            //'cashout'=>$cashout+$cashdraw+$cashdrawing_other_account+$transfer_affect_user_cashout+$thaicashdraw+$transfer_affect_user_cashout_thai+$expanse+$fee_useraffect_cashout,
            'cashout'=>$cashout+$cashdraw+$cashdrawing_other_account+$transfer_affect_user_cashout+$thaicashdraw+$transfer_affect_user_cashout_thai+$expanse+$realestate_out,
            'fee_in'=>$cuscharge+$cashdrawcuscharge+$cuscharge_useraffect_cashin+$fee_useraffect_cashin,
            'fee_out'=>$fee_useraffect_cashout,
            'capitalend'=>$capitalend,
            'viewby'=>Auth::id(),
            'isexchangecur'=>$isexchangecur

        ]);
    }
    public function usertransactionreport()
    {
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $companies=Company::where('status',1)->get();
        $currencies=Currency::where('active',1)->where('partner_cur','1')->where('company_id',$selcomid)->orderBy('no')->get();
       return view('usercapitals.usertransactionreport',compact('users','currencies','companies','selcomid'));
    }
    public function dousertransactionreport(Request $request)
    {
        //return($request->all());
        $date = str_replace('/', '-', $request->trandate);
        $startdate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $enddate= date('Y-m-d', strtotime($date2));
        $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$request->userid)->where('status',1)->whereDate('trandate','<=',$startdate)->max('trandate');
        if(is_null($fromdate)){
            $fromdate=PartnerTransfer::where('status',1)->where('user_id',$request->userid)->whereDate('dd','<=',$startdate)->min('dd');
            if(is_null($fromdate)){
                $fromdate=$startdate;
            }
        }

        $predate = Carbon::parse($startdate)->subDay();
        $show = Carbon::parse($startdate);
        $from = Carbon::parse($fromdate);

        $notedate=date('d-M-y',strtotime($fromdate)) . ' To ' . date('d-M-y',strtotime($predate));
        if ($show->equalTo($from)) {
            $startdate_eq_enddate=true;
        }else{
             $startdate_eq_enddate=false;
        }

        DB::table('user_transaction_reports')->where('viewby',Auth::user()->name)->delete();
       $this->dousercapitaltransaction($request,2,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       $this->dousercashinouttransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       $this->douserexchangetransaction($request,0,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       //$this->douserinvoicetransaction($request);
       if($startdate_eq_enddate==true){
           $this->dousercapitaltransaction($request,-2,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       }
        $this->dotransfertransaction($request,0,0,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       $this->dotransfertransaction($request,0,1,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       $this->dotransfertransaction($request,0,-4,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
       $this->dotransfertransaction($request,0,4,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
        $this->docashdrawtransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
        $this->dothaicashdrawtransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);

       $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->orderBy('ttint')->get();
       $sumfns=UserTransactionReport::where('viewby',Auth::user()->name)->where('fn','<>','0')->select(DB::raw('shortcut,sum(fn) as fn'))->groupBy('shortcut')->get();
       return view('usercapitals.usertransactionreporttable',compact('usertransactions','sumfns'));
    }
    public function doallusertransactionreportsummary(Request $request)
    {
        //return($request->all());
        $fromdate = str_replace('/', '-', $request->trandate);
        $d1= date('Y-m-d', strtotime($fromdate));
        $todate = str_replace('/', '-', $request->todate);
        $d2= date('Y-m-d', strtotime($todate));
        DB::table('user_transaction_reports')->where('viewby',Auth::user()->name)->delete();
       $this->sum_dousercapitaltransaction($request,2,0);
       $this->sum_dousercapitaltransaction($request,1,1);
       $this->sum_dousercapitaltransaction($request,-1,2);
       $this->sum_dousercapitaltransaction($request,-2,11);
       $this->sum_douserexchangetransaction($request,0,3);
    // $this->sum_douserinvoicetransaction($request);
        $this->sum_dotransfertransaction($request,0,0,4);
       $this->sum_dotransfertransaction($request,0,1,6);
       $this->sum_dotransfertransaction($request,0,-4,7);
       $this->sum_dotransfertransaction($request,0,4,8);
        $this->sum_docashdrawtransaction($request,9);
        $this->sum_dothaicashdrawtransaction($request,10);
        $this->sum_doexpanseincometransaction($request,-1,11);
        $this->sum_doexpanseincometransaction($request,1,12);


       $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->orderBy('ttint')->get();
       $sumfns=UserTransactionReport::where('viewby',Auth::user()->name)->where('fn','<>','0')->select(DB::raw('shortcut,sum(fn) as fn'))->groupBy('shortcut')->get();
       return view('usercapitals.usertransactionreportallsum',compact('usertransactions','sumfns','d1','d2'));
    }
    public function searchusertransactionreport(Request $request)
    {

      //return $request->all();
      DB::table('user_transaction_reports')->where('viewby',Auth::user()->name)->delete();
      $this->searchtransfertransaction($request);
      $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->orderBy('ttint')->orderBy('id')->get();
      $sumfns=UserTransactionReport::where('viewby',Auth::user()->name)->where('fn','<>','0')->select(DB::raw('shortcut,sum(fn) as fn'))->groupBy('shortcut')->get();
      return view('usercapitals.usertransactionreporttableall',compact('usertransactions','sumfns'));
    }
    public function searchtransfertransaction(Request $request)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $usd1=0;
        $khr1=0;
        $thb1=0;
        $vnd1=0;
       $cuschargenotthesamecur=0;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $d1 = str_replace('/', '-', $request->d1);
        $d1= date('Y-m-d', strtotime($d1));
        $d2 = str_replace('/', '-', $request->d2);
        $d2= date('Y-m-d', strtotime($d2));
        if($request->alldate=='true'){
          $transfers=PartnerTransfer::where('status',1);
        }else{
          $transfers=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2));
        }
        if($request->userid){
          $transfers=$transfers->where('user_id',$request->userid);
        }
        if($request->selcur){
          $transfers=$transfers->where('currency_id',$request->selcur);
        }
        if($request->searchby=='amt'){
          if($request->amt1<>null){
              $amt1=str_replace(',','',$request->amt1);
              $amt2=$amt1;
              if($request->amt2<>null){
                  $amt2=str_replace(',','',$request->amt2);
              }
              $transfers=$transfers->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
          }

        }else if($request->searchby=='tel'){
            if($request->tel<>null){
                $transfers=$transfers->where('rectel','like','%'.$request->tel.'%')->orwhere('sendertel','like','%'.$request->tel.'%');
            }
        }
      $transfers=$transfers->orderBy('id')->get();
        $issum=0;
        //$notetext='';
        foreach($transfers as $tr)
        {
            $issum=0;
            //$notetext='';
            if($tr->trancode==1){
              $issum=1;
            }
            // if($tr->trancode==-1){
            //   if($tr->iscashdraw==1){
            //     if($tr->cashdraw_amt>0){
            //       $issum=1;
            //     }else{
            //       $notetext=$tr->note;
            //     }
            //   }else{
            //     $notetext='(មិនទាន់បើកវេរ)';
            //   }

            // }elseif($tr->trancode==1){
            //   $issum=1;
            // }
            if($tr->currency->shortcut=='USD'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $usd=$tr->amount+$tr->cuscharge;
                }else{
                    $usd=$tr->amount;
                    $cuschargenotthesamecur=1;
                }

            }else if($tr->currency->shortcut=='KHR'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $khr=$tr->amount+$tr->cuscharge;
                }else{
                    $khr=$tr->amount;
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='THB'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $thb=$tr->amount+$tr->cuscharge;
                }else{
                    $thb=$tr->amount;
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='VND'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $vnd=$tr->amount+$tr->cuscharge;
                }else{
                    $vnd=$tr->amount;
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='GOLD'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $gold=$tr->amount+$tr->cuscharge;
                }else{
                    $gold=$tr->amount;
                }
            }else{
                $fn=$tr->amount;
                $shortcut=$tr->currency->shortcut;
            }
            if($cuschargenotthesamecur==1){
                if($tr->cuschargecur->shortcut=='USD'){
                    $usd1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='THB'){
                    $thb1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='KHR'){
                    $khr1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='VND'){
                    $vnd1=$tr->cuscharge;
                }
            }

            $sender='';
            $receiver='';
            $desr='';
            $feestr='';
            if($tr->fee<>0){
              $feestr='(' . $this->phpformatnumber($tr->fee) . $tr->feecurrency->shortcut .')';
            }
            if($tr->sendertel){
                $sender=$tr->sendertel;
            }
            if($tr->sendername){
                if($sender!=''){
                    $sender .='|'. $tr->sendername;
                }else{
                    $sender = $tr->sendername;
                }
            }

            if($tr->rectel){
                $receiver= $tr->rectel;
            }
            if($tr->recname){
                if($receiver!=''){
                    $receiver .='|'. $tr->recname;
                }else{
                    $receiver =$tr->recname;
                }
            }
            if($receiver<>''){
              $receiver='(' . $receiver . ')';
            }
            if($sender<>''){
              $sender='(' . $sender . ')';
            }
            // $desr='វេរទៅ ' . $tr->partner->name . ' ' . $receiver . $sender;
            $desr=$tr->note . $receiver  . $sender . $feestr;
            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $tr->dd,
                'tt'=>$tr->tt,
                'ttint'=>$this->convertimetoint($tr->tt),
                'user_id'=>$tr->user_id,
                'tranname'=>$tr->tranname . $tr->partner->name, //. $notetext,
                //'tranname'=>$tr->partner->name . $tr->note,
                'desr'=>$desr,
                'note'=>$tr->note,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$tr->id,
                'ref_number'=>$tr->ref_number,
                'ref_group_id'=>$tr->ref_group_id,
                'tablename'=>'partner_transfers',
                'issum'=>$issum,
                'created_at'=>$current,
                'updated_at'=>$current
                );
            UserTransactionReport::insert($utr);

            if($cuschargenotthesamecur==1){
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'dd'=> $tr->dd,
                    'tt'=>$tr->tt,
                    'ttint'=>$this->convertimetoint($tr->tt),
                    'user_id'=>$tr->user_id,
                    'tranname'=>'សេវ៉ាវេរ',
                    'desr'=>$desr,
                    'note'=>'វេរចំនួន '.$this->phpformatnumber($tr->amount) . $tr->currency->shortcut,
                    'usd'=>$usd1,
                    'khr'=>$khr1,
                    'thb'=>$thb1,
                    'vnd'=>$vnd1,
                    'gold'=>0,
                    'fn'=>0,
                    'shortcut'=>'',
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>$tr->id,
                    'tablename'=>'partner_transfers',
                    'ref_group_id'=>$tr->ref_group_id,
                    'issum'=>$issum,
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
            }

            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $shortcut='';
            $usd1=0;
            $thb1=0;
            $khr1=0;
            $vnd1=0;
            $cuschargenotthesamecur=0;
        }



    }
    public function doallusertransactionreport(Request $request)
    {

        //return($request->all());
        $date = str_replace('/', '-', $request->trandate);
        $startdate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $enddate= date('Y-m-d', strtotime($date2));
        $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$request->userid)->where('status',1)->whereDate('trandate','<=',$startdate)->max('trandate');
        if(is_null($fromdate)){
            $fromdate=PartnerTransfer::where('status',1)->where('user_id',$request->userid)->whereDate('dd','<=',$startdate)->min('dd');
            if(is_null($fromdate)){
                $fromdate=$startdate;
            }
        }

        $predate = Carbon::parse($startdate)->subDay();
        $show = Carbon::parse($startdate);
        $from = Carbon::parse($fromdate);

        $notedate=date('d-M-y',strtotime($fromdate)) . ' To ' . date('d-M-y',strtotime($predate));
        if ($show->equalTo($from)) {
            $startdate_eq_enddate=true;
        }else{
             $startdate_eq_enddate=false;
        }

        if($request->showfast==0){
            DB::table('user_transaction_reports')->where('viewby',Auth::user()->name)->delete();
              $this->dousercapitaltransaction($request,2,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
              if($startdate_eq_enddate==true){
                  $this->dousercapitaltransaction($request,-2,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
              }
              $this->dousercashinouttransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
              $this->douserexchangetransaction($request,0,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
             //$this->douserinvoicetransaction($request);
             if($request->ckcash=='true'){
                $this->dotransfertransactioncash($request,1,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
             }else{
                $this->dotransfertransaction($request,1,0,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
             }
              //$this->dotransfertransaction($request,1,1);
            //   $this->dotransfertransaction($request,1,-4);
            //   $this->dotransfertransaction($request,1,4);
              $this->docashdrawtransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
              $this->dothaicashdrawtransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
              $this->doexpanseincometransaction($request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate);
            }
            if($request->hidenotsum=="true"){
                $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->where('issum',1)->orderBy('dd')->orderBy('ttint')->orderBy('id')->get();
            }else{
                $usertransactions=UserTransactionReport::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('ttint')->orderBy('id')->get();
            }
        $sumfns=UserTransactionReport::where('viewby',Auth::user()->name)->where('fn','<>','0')->select(DB::raw('shortcut,sum(fn) as fn'))->groupBy('shortcut')->get();
       return view('usercapitals.usertransactionreporttableall',compact('usertransactions','sumfns'));
    }

    public function getuserbalanceaccount(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $viewby=Auth::user()->name;
        //$d2= date('Y-m-d', strtotime($request->showdate));
        $userid=$request->userid;
        $myuser=User::find($userid);
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $useraccount=collect();
        $usercash=collect();

        $close_transfer_id=0;
        $close_exchange_id=0;
        //get user cash
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->showdate);
        $showdate= date('Y-m-d', strtotime($date));
        DB::table('user_transaction_report_summaries')->where('viewby',Auth::id())->delete();
        $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$userid)->where('status',1)->whereDate('trandate','<=',$showdate)->max('trandate');
        if(is_null($fromdate)){
            $fromdate=$showdate;
        }
        $this->sumusercapital($userid,$showdate,$fromdate);
        $this->sumexchange($userid,$showdate,$fromdate);
        $this->sumtransfer($userid,$showdate,$fromdate,0);
         if(config('helper.realestate') == 1){
             $this->sumrealestate($userid,$showdate,$fromdate);
         }

        // $this->sumtransfer($userid,$showdate,1);
        // $this->sumtransfer($userid,$showdate,-4);
        // $this->sumtransfer($userid,$showdate,4);

        $this->sumcashdraw($userid,$showdate,$fromdate);
        $this->sumthaicashdraw($userid,$showdate,$fromdate);
        $this->sumexpanse($userid,$showdate,$fromdate);
       // $sumusercash=DB::table('user_transaction_report_summaries')->where('viewby',Auth::id())->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        $sumusercash=UserTransactionReportSummary::where('viewby',Auth::id())->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();

        //return $sumusercash;
        foreach($sumusercash as $sc){
            if($sc->currency->shortcut=='USD'){
                $usd=$sc->tamt;
            }else if($sc->currency->shortcut=='THB'){
                $thb=$sc->tamt;
            }else if($sc->currency->shortcut=='KHR'){
                $khr=$sc->tamt;
            }else if($sc->currency->shortcut=='VND'){
                $vnd=$sc->tamt;
            }
            $usercash=$usercash->push(['curid'=>$sc->currency_id,'curshortcut'=>$sc->currency->shortcut,'cursk'=>$sc->currency->sk,'curno'=>$sc->currency->no,'amount'=>$sc->tamt,'customer'=>'CASH','customer_id'=>0]);
        }
        $useraccount=$useraccount->push(['usd'=>$usd,'thb'=>$thb,'khr'=>round($khr),'vnd'=>$vnd,'customer'=>'CASH','display'=>1]);

        // DB::table('all_partner_lists')->where('viewby',Auth::user()->name)->delete();
        // DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        if($myuser){
            $customerconnect=explode(',',$myuser->customer_connect);
        }else{
            $customerconnect='';
        }
        $op=$request->op;
        $customers=Customer::whereIn('id',$customerconnect)->get();

        foreach($customers as $c)
        {
            $close_transfer_id=0;
            $close_exchange_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

            $closelist=PartnerCloseList::whereDate('closedate',$op,$showdate)->where('partner_id',$c->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            // if($closelist){
            //     $close_transfer_id=$closelist->transaction_id;
            //     $close_exchange_id=$closelist->exchange_id;
            //     $usd=$closelist->usd;
            //     $thb=$closelist->thb;
            //     $khr=$closelist->khr;
            //     $vnd=$closelist->vnd;
            //     if($usd<>0){
            //         $curtransfer=Currency::where('shortcut','USD')->where('active',1)->first();
            //         $usercash=$usercash->push(['curid'=>$curtransfer->id,'curshortcut'=>$curtransfer->shortcut,'cursk'=>$curtransfer->sk,'curno'=>$curtransfer->no,'amount'=>-1 * $usd,'customer'=>$c->name,'customer_id'=>$c->id]);
            //     }
            //     if($thb<>0){
            //         $curtransfer=Currency::where('shortcut','THB')->where('active',1)->first();
            //         $usercash=$usercash->push(['curid'=>$curtransfer->id,'curshortcut'=>$curtransfer->shortcut,'curno'=>$curtransfer->no,'amount'=>-1 * $thb,'customer'=>$c->name,'customer_id'=>$c->id]);
            //     }
            //     if($khr<>0){
            //         $curtransfer=Currency::where('shortcut','KHR')->where('active',1)->first();
            //         $usercash=$usercash->push(['curid'=>$curtransfer->id,'curshortcut'=>$curtransfer->shortcut,'curno'=>$curtransfer->no,'amount'=>-1 * $khr,'customer'=>$c->name,'customer_id'=>$c->id]);
            //     }
            //     if($vnd<>0){
            //         $curtransfer=Currency::where('shortcut','VND')->where('active',1)->first();
            //         $usercash=$usercash->push(['curid'=>$curtransfer->id,'curshortcut'=>$curtransfer->shortcut,'curno'=>$curtransfer->no,'amount'=>-1 * $vnd,'customer'=>$c->name,'customer_id'=>$c->id]);
            //     }

            // }

            // Get all active currencies, key by shortcut for quick access
            $currencies = Currency::where('active', 1)->where('company_id',$selcomid)->whereIn('shortcut',['USD','THB','KHR','VND'])->get()->keyBy('shortcut');
            if ($closelist) {
                $close_transfer_id = $closelist->transaction_id;
                $close_exchange_id = $closelist->exchange_id;
                $usd=$closelist->usd;
                $thb=$closelist->thb;
                $khr=$closelist->khr;
                $vnd=$closelist->vnd;
                $amounts = [
                    'USD' => $closelist->usd,
                    'THB' => $closelist->thb,
                    'KHR' => $closelist->khr,
                    'VND' => $closelist->vnd,
                ];

                foreach ($amounts as $shortcut => $amount) {
                    if ($amount != 0 && isset($currencies[$shortcut])) {
                        $cur = $currencies[$shortcut];
                        $usercash = $usercash->push([
                            'curid'       => $cur->id,
                            'curshortcut' => $cur->shortcut,
                            'cursk'       => $cur->sk,
                            'curno'       => $cur->no,
                            'amount'      => -1 * $amount,
                            'customer'    => $c->name,
                            'customer_id' => $c->id,
                        ]);
                    }
                }
            }


            $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$showdate)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('currency_id')->get();

            $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$showdate)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('fee_currency_id')->get();

            // $thai_transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            // ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$showdate)->whereNotNull('thai_amt')->whereNotNull('docodeby')->groupBy('currency_id')->get();
            // $thai_fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            // ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$showdate)->whereNotNull('thai_amt')->whereNotNull('docodeby')->groupBy('fee_currency_id')->get();

            $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy_id'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date',$op,$showdate)->groupBy('curbuy_id')->get();
            $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale_id'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date',$op,$showdate)->groupBy('cursale_id')->get();
            //return $closelist;

          foreach($transfers as $t)
            {
                $foundcur=1;
                if($t->currency->shortcut=='USD'){
                    $usd +=$t->total;
                }elseif($t->currency->shortcut=='THB'){
                    $thb +=$t->total;
                }elseif($t->currency->shortcut=='KHR'){
                    $khr +=$t->total;
                }elseif($t->currency->shortcut=='VND'){
                    $vnd +=$t->total;
                }else{
                    $foundcur=0;
                }
                if($foundcur==1){
                    $usercash=$usercash->push(['curid'=>$t->currency_id,'curshortcut'=>$t->currency->shortcut,'cursk'=>$t->currency->sk,'curno'=>$t->currency->no,'amount'=>-1 * $t->total,'customer'=>$c->name,'customer_id'=>$c->id]);
                }
            }
          foreach($fees as $t)
            {
                $foundcur=1;
                if($t->feecurrency->shortcut=='USD'){
                    $usd +=$t->totalfee;
                }elseif($t->feecurrency->shortcut=='THB'){
                    $thb +=$t->totalfee;
                }elseif($t->feecurrency->shortcut=='KHR'){
                    $khr +=$t->totalfee;
                }elseif($t->feecurrency->shortcut=='VND'){
                    $vnd +=$t->totalfee;
                }else{
                    $foundcur=0;
                }
                if($foundcur==1){
                    $usercash=$usercash->push(['curid'=>$t->fee_currency_id,'curshortcut'=>$t->feecurrency->shortcut,'cursk'=>$t->feecurrency->sk,'curno'=>$t->currency->no,'amount'=>-1 * $t->totalfee,'customer'=>$c->name,'customer_id'=>$c->id]);
                }
            }

            foreach($exbuys as $t)
            {
                $foundcur=1;
                if($t->curbuy->shortcut=='USD'){
                    $usd +=-1 * $t->totalbuy;
                }elseif($t->curbuy->shortcut=='THB'){
                    $thb +=-1 * $t->totalbuy;
                }elseif($t->curbuy->shortcut=='KHR'){
                    $khr +=-1 * $t->totalbuy;
                }elseif($t->curbuy->shortcut=='VND'){
                    $vnd +=-1 * $t->totalbuy;
                }else{
                    $foundcur=0;
                }
                if($foundcur==1){
                    $usercash=$usercash->push(['curid'=>$t->curbuy_id,'curshortcut'=>$t->curbuy->shortcut,'cursk'=>$t->curbuy->sk,'curno'=>$t->currency->no,'amount'=>-1 * $t->totalbuy,'customer'=>$c->name,'customer_id'=>$c->id]);
                }
            }

            foreach($exsales as $t)
            {
                $foundcur=1;
                if($t->cursale->shortcut=='USD'){
                    $usd +=$t->totalsale;
                }elseif($t->cursale->shortcut=='THB'){
                    $thb +=$t->totalsale;
                }elseif($t->cursale->shortcut=='KHR'){
                    $khr +=$t->totalsale;
                }elseif($t->cursale->shortcut=='VND'){
                    $vnd +=$t->totalsale;
                }else{
                    $foundcur=0;
                }
                if($foundcur==1){
                    $usercash=$usercash->push(['curid'=>$t->cursale_id,'curshortcut'=>$t->cursale->shortcut,'cursk'=>$t->cursale->sk,'curno'=>$t->currency->no,'amount'=>-1 * $t->totalsale,'customer'=>$c->name,'customer_id'=>$c->id]);
                }
            }

            $useraccount=$useraccount->push(['usd'=>-1*$usd,'thb'=>-1*$thb,'khr'=>round(-1*$khr),'vnd'=>-1*$vnd,'customer'=>$c->name,'display'=>1]);
        }
        //return $usercash;
        //group multi colump
        $groupcustomer = $usercash->groupBy(function ($item, $key) {
            return $item['customer'].$item['curid'];
        });

        $summary_usercash = $groupcustomer->map(function ($group) {
            return [
                'customer' => $group->first()['customer'],
                'customer_id' => $group->first()['customer_id'],
                'curid'=>$group->first()['curid'],
                'curno'=>$group->first()['curno'],
                'shortcut'=>$group->first()['curshortcut'],
                'cursk'=>$group->first()['cursk'],
                'amount' => $group->sum('amount'),
            ];
        });
        $newcash=collect();
        $newagent=collect();

        foreach($summary_usercash->where('customer','CASH')->sortBy('curno') as $key => $result){
            //if($result['customer']=='CASH'){
                $newcash=$newcash->push(['amount'=>$result['amount'],'customer'=>$result['customer'],'customer_id'=>$result['customer_id'],'curid'=>$result['curid'],'shortcut'=>$result['shortcut'],'cursk'=>$result['cursk']]);
            // }else{
            //     $newagent=$newagent->push(['amount'=>$result['amount'],'customer'=>$result['customer'],'customer_id'=>$result['customer_id'],'curid'=>$result['curid'],'shortcut'=>$result['shortcut']]);
            // }
        }
        foreach($summary_usercash->where('customer','<>','CASH')->sortBy('customer,curno') as $key => $result){
            $newagent=$newagent->push(['amount'=>$result['amount'],'customer'=>$result['customer'],'customer_id'=>$result['customer_id'],'curid'=>$result['curid'],'shortcut'=>$result['shortcut'],'cursk'=>$result['cursk']]);

        }

        if($request->enddingbalance==1){
            return response()->json(['useraccount'=>$useraccount,'summary_usercash'=>$summary_usercash,'newcash'=>$newcash,'newagent'=>$newagent]);
        }

        //get thai account list
        if(Auth::user()->role->name=='Admin'){
            $thai_acc=ThaiAccount::where('status',1)->where('company_id',$selcomid)->where('showinlist',1)->orderBy('no')->get();
            foreach($thai_acc as $ta){
                $startbal=0;
                $balin=0;
                $balout=0;
                $oldbal=0;
                $closebal=0;
                $smsid=0;
                $thb=0;
                $closelist=ThaiCloseList::where('thai_account_id',$ta->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
                if($closelist){
                    $smsid=$closelist->lastsmsid;
                    $closebal=$closelist->balance;
                }
                $oldbal=SMS::where('status',1)->whereDate('smsdate','<',$showdate)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->sum('amount');
                $startbal=$oldbal+$closebal;
                $balin=SMS::where('status',1)->whereDate('smsdate',$showdate)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','>',0)->sum('amount');
                $balout=SMS::where('status',1)->whereDate('smsdate',$showdate)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','<',0)->sum('amount');
                $thb=$startbal+$balin+$balout;
                $useraccount=$useraccount->push(['usd'=>0,'thb'=>$thb,'khr'=>0,'vnd'=>0,'customer'=>$ta->accno,'display'=>0]);

            }
        }
        return response()->json(['useraccount'=>$useraccount,'summary_usercash'=>$summary_usercash,'newcash'=>$newcash,'newagent'=>$newagent]);
        //return response()->json(['useraccount'=>$useraccount]);
    }
    public function getusercapitalmaster(Request $request){
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->showdate);
        $showdate= date('Y-m-d', strtotime($date));
        // $userid=$request->userid;
        // $myuser=User::find($userid);
        // $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$userid)->where('status',1)->max('trandate');

      DB::table('user_transaction_report_summaries')->where('viewby',Auth::id())->delete();
      $this->sumusercapital($request->userid,$showdate,$showdate);
      $this->sumexchange($request->userid,$showdate,$showdate);
      $this->sumtransfer($request->userid,$showdate,$showdate,0);
    //   $this->sumtransfer($request->userid,$showdate,1);
    //   $this->sumtransfer($request->userid,$showdate,-4);
    //   $this->sumtransfer($request->userid,$showdate,4);

      $this->sumcashdraw($request->userid,$showdate,$showdate);
      $this->sumthaicashdraw($request->userid,$showdate,$showdate);
      $this->sumexpanse($request->userid,$showdate,$showdate);
      $sumusercash=DB::table('user_transaction_report_summaries')->where('viewby',Auth::id())->select(DB::raw('cur,sum(amount) as tamt'))->groupBy('cur')->orderBy('cur')->get();
      if(isset($request->isrightsidebarview)){
        return response()->json(['sumusercash'=>$sumusercash]);
      }else{
          return view('usercapitals.displaymaincapital',compact('sumusercash'));
      }

    }
    public function sumusercapital($userid,$showdate,$fromdate){
         if(config('helper.autocontinueusercash') == 1){
            $show = Carbon::parse($showdate);
            $from = Carbon::parse($fromdate);
            if ($show->equalTo($from)) {
                $sum=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $showdate))->where('status',1)->where('user_id_affect',$userid)->where('capital_type','cash')->whereIn('trancode',['1','-1','2','-2'])->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            }else{
                $sum=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $showdate))->where('status',1)->where('user_id_affect',$userid)->where('capital_type','cash')->whereIn('trancode',['1','-1','2'])->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            }

            // if ($from->lt($show)) {
            //     // fromdate is earlier than showdate
            // }
            // if ($from->gt($show)) {
            //     // fromdate is after showdate (unexpected?)
            // }
         }else{
            $sum=UserCapital::whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $showdate))->where('status',1)->where('user_id_affect',$userid)->where('capital_type','cash')->whereIn('trancode',['1','-1','2','-2'])->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
         }

      if($sum){
        foreach($sum as $s){
          DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'UserCapital','amount'=>$s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
        }
      }
    }
    public function sumexpanse($userid,$showdate,$fromdate){

        $sum=Expanse::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->where('user_id',$userid)->whereIn('trancode',['1','-1'])->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        if($sum){
          foreach($sum as $s){
            DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'Expanse','amount'=>$s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
          }
        }
      }
    public function sumexchange($userid,$showdate,$fromdate){
        $selcomid=Session('log_into_company_id');
        $maincurid=Currency::where('shortcut','USD')->where('company_id',$selcomid)->first();
        $sum=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->where('isexchangelist',0)->where('user_id',$userid)->select(DB::raw('currency_id,sum(product) as tamt'))->groupBy('currency_id')->get();
        if($sum){
          foreach($sum as $s){
            DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'Exchangeproduct','amount'=>$s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
          }
        }
        $sum1=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->where('isexchangelist',0)->where('user_id',$userid)->select(DB::raw('maincur,sum(amount) as tamt'))->groupBy('maincur')->get();
        if($sum1){
            foreach($sum1 as $s1){
              DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'Exchangeluy','amount'=>$s1->tamt,'cur'=>$s1->maincur,'currency_id'=>$maincurid->id]);
            }
          }
      }
      public function sumtransfer($userid,$showdate,$fromdate,$mode){

        $tranname='';
        $user_customer=[];
        // $user=User::find($userid);
        // if($user){
        //     $user_customer=explode(',',$user->customer_connect);
        // }
        if($mode==0){
            $sign=1;
            $tranname='វេរលុយ';
            $sum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->whereNull('thai_amt')->where('user_id',$userid)
            ->where(function($q){
                $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                    $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                });
            })->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }elseif($mode==1){//thai cashdraw by bank
            $sign=-1;
            $tranname='បើកវេរលុយថៃបន្តតាមធនាគាបុគ្គលិក';
            $sum=PartnerTransfer::where('docodeby',$userid)->where('trancode',1)->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }elseif($mode==-4){//bank receive
            $sign=-1;
            $tranname='បាញ់ចូល';
            $sum=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }elseif($mode==4){//banck transfer
            $sign=-1;
            $tranname='បាញ់ចេញ';
            $sum=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }
        if($sum){
          foreach($sum as $s){
            DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>$tranname,'amount'=>$sign * floatval($s->tamt),'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
          }
        }
        if($mode==0){
            //សេវ៉ា វេរមុខផ្ទះ ឬ វេរបន្ត
            $sum1=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->whereNull('thai_amt')->where('user_id',$userid)
            ->where(function($q){
                $q->where('trancode',1)->orWhere(function($q1){
                    $q1->where('trancode',4)->where('iscutwater',0);
                });
            })
            ->select(DB::raw('cuscharge_currency_id,sum(cuscharge) as tamt'))
            ->groupBy('cuscharge_currency_id')->get();
            if($sum1){
              foreach($sum1 as $s1){
                if($s1->tamt<>0){
                  DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>'សេវ៉ាវេរ','amount'=>$s1->tamt,'cur'=>$s1->cuschargecur->shortcut,'currency_id'=>$s1->cuscharge_currency_id]);
                }
              }
            }
        }
      }
    public function sumrealestate($userid,$showdate,$fromdate){
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $sum=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $showdate))->where('status',1)->where('user_id',$userid)->where('location_id',8)->whereIn('trancode',[1,-1])->select(DB::raw('currency_id,sum(cash_amount) as tamt'))->groupBy('currency_id')->get();
        // if($sum){
        //     foreach($sum as $s){
        //         DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>'Realestate','amount'=>$s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
        //     }
        // }

        $sum = PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), [$fromdate, $showdate])
                ->where('status', 1)
                ->where('user_id', $userid)
                ->where('location_id', 8)
                ->whereIn('trancode', [1, -1,4,-4])
                ->select(DB::raw('currency_id, SUM(COALESCE(cash_amount, 0)) as tamt'))
                ->groupBy('currency_id')
                ->get();
        foreach($sum as $s){
            $cur = $s->currency->shortcut ?? '';
            DB::table('user_transaction_report_summaries')->insert([
                'viewby' => Auth::id(),
                'user_id' => $userid,
                'tranname' => 'Realestate',
                'amount' => $s->tamt,
                'cur' => $cur,
                'currency_id' => $s->currency_id
            ]);
        }

    }
      public function sumcashdraw($userid,$showdate,$fromdate){
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $sum=Cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $showdate))->where('status',1)->where('user_id',$userid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        if($sum){
          foreach($sum as $s){
            DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>'Cashdraw','amount'=>-1 * $s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
          }
        }
        $sum1=cashdraw::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $showdate))->where('status',1)->where('user_id',$userid)->select(DB::raw('cuscharge_currency_id,sum(customer_charge) as tamt'))->groupBy('cuscharge_currency_id')->get();
        if($sum1){
          foreach($sum1 as $s1){
            if($s1->tamt<>0){
              DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>'CashdrawCuscharge','amount'=>$s1->tamt,'cur'=>$s1->cuschargecur->shortcut,'currency_id'=>$s1->cuscharge_currency_id]);
            }
          }
        }
      }
      public function sumthaicashdraw($userid,$showdate,$fromdate){

        $sum=SmsProcess::whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $showdate))->where('status',1)->where('user_id',$userid)->where('paymethod','Cash')->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        if($sum){
          foreach($sum as $s){
            DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>$userid,'tranname'=>'Thai Cashdraw','amount'=>-1 * $s->tamt,'cur'=>$s->currency->shortcut,'currency_id'=>$s->currency_id]);
          }
        }
        // $user_customer=[];
        // $user=User::find(Auth::id());
        // if($user){
        //     $user_customer=explode(',',$user->customer_connect);
        // }

        // $bankout=PartnerTransfer::where('trancode',1)->where('docodeby',Auth::id())->whereIn('parrent_id',$user_customer)->whereDate('dd',$showdate)->where('status',1)->select(DB::raw('currency_id,sum(amount) as amt'))->groupBy('currency_id')->get();
        // if($bankout){
        //     foreach($bankout as $bo){
        //       DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'UserBankOut','amount'=>-1 * $bo->tamt,'cur'=>$bo->currency->shortcut]);
        //     }
        //   }

        // $bankin=PartnerTransfer::where('trancode',-1)->whereNull('thai_amt')->whereIn('parrent_id',$user_customer)->whereDate('dd',$showdate)->where('status',1)->select(DB::raw('currency_id,sum(amount) as amt'))->groupBy('currency_id')->get();
        // if($bankin){
        //     foreach($bankin as $bi){
        //       DB::table('user_transaction_report_summaries')->insert(['viewby'=>Auth::id(),'user_id'=>Auth::id(),'tranname'=>'UserBankIn','amount'=>1 * $bi->tamt,'cur'=>$bi->currency->shortcut]);
        //     }
        //   }

      }
    public function userstatementreport(Request $request)
    {
        $users=user::where('active',1)->get();
        $currencies=Currency::where('active',1)->where('ispandp','0')->orderBy('no')->get();
        return view('usercapitals.userstatementreport',compact('users','currencies'));
    }
    public function printuserstatementreport(Request $request)
    {
        $title=['username'=>$request->username,'curname'=>$request->curname,'date'=>$request->date];
        $usertransactions=UserStatementReport::where('viewby',Auth::user()->name)->where('currency_id',$request->cur)->orderBy('ttint')->orderBy('id')->get();
        return view('usercapitals.printuserstatementreportlist',compact('usertransactions','title'));
    }
    public function showsummarydetail(Request $request)
    {
       // return $request->all();
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname=$request->tranname;
        $tablename=$request->tablename;
        $gold=$request->gold;
        $usd=$request->usd;
        $thb=$request->thb;
        $khr=$request->khr;
        $vnd=$request->vnd;
        $fn=$request->fn;
        $shortcut=$request->shortcut;


       //$userview=auth()->user()->name . '-viewsummarydetail';
       $userview=Auth::user()->name . '-viewsummarydetail';
       DB::table('user_transaction_reports')->where('viewby',$userview)->delete();

       $current = Carbon::now();
       $current->timezone('Asia/Phnom_Penh');

        $fd1 = str_replace('/', '-', $request->d1);
        $d1= date('Y-m-d', strtotime($fd1));
        $fd2 = str_replace('/', '-', $request->d2);
        $d2= date('Y-m-d', strtotime($fd2));

        $userid=$request->userid;
       $getdata=0;
       $transferouts=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)
                    ->where(function($q) use($userid){
                        $q->where(function($q1) use($userid){
                            $q1->where('trancode',4)->where('user_affect',$userid);
                        })->orWhere(function($q2) use($userid){
                            $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                        });
                    })->get();
                    return view('usercapitals.showsummarydetailnew',compact('transferouts','tranname','d1','d2','tablename','gold','usd','thb','khr','vnd','fn','shortcut'));


                    if(str_contains($request->tablename,'partner_transfers')){
                if(str_contains($request->tablename,'mode0')){
                    $transfers=PartnerTransfer::where('user_id',$request->userid)->whereNull('thai_amt')->whereNull('user_affect')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',1)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
                }elseif(str_contains($request->tablename,'mode1')){
                    $transfers=PartnerTransfer::whereNotNull('docodeby')->where('user_affect',$userid)->where('trancode',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                }elseif(str_contains($request->tablename,'mode-4')){
                    $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)
                    ->where(function($q) use($userid){
                        $q->where(function($q1) use($userid){
                            $q1->where('trancode',-4)->where('user_affect',$userid);
                        })->orWhere(function($q2) use($userid){
                            $q2->where('trancode',-1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                        })->orWhere(function($q3) use($userid){
                            $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);
                        });
                    })
                    ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                }elseif(str_contains($request->tablename,'mode4')){
                    $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)
                    ->where(function($q) use($userid){
                        $q->where(function($q1) use($userid){
                            $q1->where('trancode',4)->where('user_affect',$userid);
                        })->orWhere(function($q2) use($userid){
                            $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                        });
                    })
                    ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

                }
                foreach($transfers as $tr)
                {
                    if($tr->currency->shortcut=='USD'){
                        $usd=$tr->tamt;
                    }elseif($tr->currency->shortcut=='KHR'){
                        $khr=$tr->tamt;
                    }elseif($tr->currency->shortcut=='THB'){
                        $thb=$tr->tamt;
                    }elseif($tr->currency->shortcut=='VND'){
                        $vnd=$tr->tamt;
                    }elseif($tr->currency->shortcut=='GOLD'){
                        $gold=$tr->tamt;
                    }else{
                        $fn=$tr->tamt;
                        $shortcut=$tr->currency->shortcut;
                        UserTransactionReport::insert([
                            'viewby'=>$userview,
                            'inputdate'=>$tr->dd,
                            'dd'=> $tr->dd,
                            'tt'=>'',
                            'ttint'=>0,
                            'user_id'=>$request->userid,
                            'tranname'=>$tr->partner->name,
                            'desr'=>'',
                            'note'=>'',
                            'usd'=>'0',
                            'khr'=>'0',
                            'thb'=>'0',
                            'vnd'=>'0',
                            'gold'=>'0',
                            'fn'=> $fn,
                            'shortcut'=>$shortcut,
                            'theylack'=>'0',
                            'welack'=>'0',
                            'paybybank'=>'0',
                            'link_id'=>$tr->parrent_id,
                            'ref_number'=>'',
                            'ref_group_id'=>'',
                            'tablename'=>$request->tablename,
                            'issum'=>'1',
                            'created_at'=>$current,
                            'updated_at'=>$current
                        ]);

                    }
                }

                UserTransactionReport::insert([
                    'viewby'=>$userview,
                    'inputdate'=>$d1,
                    'dd'=> $d1,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>$tranname,
                    'desr'=>'',
                    'note'=>'',
                    'usd'=>  floatval($usd),
                    'khr'=>  floatval($khr),
                    'thb'=>  floatval($thb),
                    'vnd'=>  floatval($vnd),
                    'gold'=> floatval($gold),
                    'fn'=>'0',
                    'shortcut'=>'',
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>'0',
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>$request->tablename,
                    'issum'=>'1',
                    'created_at'=>$current,
                    'updated_at'=>$current
                ]);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;



       }else{
            $getdata=1;
       }
       if($getdata==1){
        $usd=$request->usd;
        $thb=$request->thb;
        $khr=$request->khr;
        $gold=$request->gold;
        $vnd=$request->vnd;
        $fn=$request->fn;
        $shortcut=$request->shortcut??'';
        UserTransactionReport::insert([
            'viewby'=>$userview,
            'inputdate'=>$d1,
            'dd'=> $d1,
            'tt'=>'',
            'ttint'=>0,
            'user_id'=>$request->userid,
            'tranname'=>$request->tranname,
            'desr'=>'',
            'note'=>'',
            'usd'=>  floatval($usd),
            'khr'=>  floatval($khr),
            'thb'=>  floatval($thb),
            'vnd'=>  floatval($vnd),
            'gold'=> floatval($gold),
            'fn'=>$fn,
            'shortcut'=>$shortcut,
            'theylack'=>'0',
            'welack'=>'0',
            'paybybank'=>'0',
            'link_id'=>$shortcut,
            'ref_number'=>'',
            'ref_group_id'=>'',
            'tablename'=>$request->tablename,
            'issum'=>'1',
            'created_at'=>$current,
            'updated_at'=>$current
        ]);

       }
       $usertransactions=UserTransactionReport::where('viewby',$userview)->get();
       return view('usercapitals.showsummarydetailnew',compact('usertransactions','tranname','d1','d2','tablename','gold','usd','thb','khr','vnd','fn','shortcut'));
    }
    public function showrefgroupid(Request $request)
    {
      //return $request->all();
      $partners=Customer::where('status',1)->get();
      $currencies=Currency::where('active',1)->get();
      $group=explode('-',$request->group_id);
      $groupid=$request->group_id;
      $exchanges=Exchange::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();
      $exchangemultis=ExchangeMulti::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();
      $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();
      $cashdraws=Cashdraw::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();
      $smsprocess=SmsProcess::where('status',1)->where('group_id',$request->group_id)->orderBy('id')->get();
      if(isset($request->showdelbuton)){
        $showdelbtn=$request->showdelbuton;
      }else{
        $showdelbtn=true;
      }
      return view('usercapitals.grouptransaction',compact('exchanges','exchangemultis','transfers','cashdraws','groupid','partners','currencies','smsprocess','showdelbtn'));
    }
    public function getmultiexchangelist(Request $request)
    {
      $gid=$request->ref_group_id;
      $mex=ExchangeMulti::where(function($query) use($gid){
        $query->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
      })->where('user_id',Auth::user()->id)->where('status',1)->orderBy('id')->get();


      $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))
                  ->where(function($q) use($gid){
                    $q->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
                  })->where('user_id',Auth::user()->id)->where('status',1)->groupBy('curbuy')->get();

      $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))
              ->where(function($q)use($gid){
                $q->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
              })->where('user_id',Auth::user()->id)->where('status',1)->groupBy('cursale')->get();

               $c=collect();
               foreach($totalbuy as $tb)
               {
                  $c=$c->push(['cur'=>$tb->curbuy,'value'=>$tb->tbuy]);
               }
               foreach($totalsale as $ts)
               {
                  $c=$c->push(['cur'=>$ts->cursale,'value'=> -1* $ts->tsale]);
               }

               $groups = $c->groupBy('cur');
               $sumc = $groups->map(function ($group) {
                     return [
                        'cur' => $group->first()['cur'], // opposition_id is constant inside the same group, so just take the first or whatever.
                        'value' => $group->sum('value'),
                        // 'won' => $group->where('result', 'won')->count(),
                        // 'lost' => $group->where('result', 'lost')->count(),
                     ];
               });
               $cashin=$sumc->where('value','>','0');
               $cashout=$sumc->where('value','<','0');

      if($mex){
         return view('exchanges.multiexlists',compact('mex','totalbuy','totalsale','cashin','cashout'));
      }
   }
   public function delete_multiexchangelist(Request $request)
   {
      //return $request->all();
      if(is_null($request->mapcode)){
        DB::table('exchange_multis')->where('id',$request->id)->delete();
      }else{
        ExchangeMulti::where('id',$request->id)->update(['status'=>'0','userdel'=>Auth::user()->name]);
        Exchange::where('multiexchangecode',$request->mapcode)->update(['status'=>'0','userdel'=>Auth::user()->name]);
      }
   }
   public function clear_multiexchangelist(Request $request)
   {
      DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->delete();
      ExchangeMulti::where('ref_group_id',$request->ref_group_id)->update(['status'=>'0','userdel'=>Auth::user()->name]);
      Exchange::where('ref_group_id',$request->ref_group_id)->update(['status'=>'0','userdel'=>Auth::user()->name]);

   }
    public function updatetransactiongroup(Request $request)
    {
      //return $request->all();
        $transfer1=null;
        $id=$request->id;
        $banktransfers=PartnerTransfer::where('status',1)->whereNull('map_id')->whereNotNull('ref_group_id')->where('ref_group_id',$request->ref_group_id)->whereNull('ismulti_transfer')->where('id','<>',$id)->orderBy('id')->get();
        $transfer=PartnerTransfer::where('id',$id)->where('status',1)->first();
        if($transfer){
          if($transfer->count()>0){
            if($transfer->trancode==-4){
              $transfer1=PartnerTransfer::find($transfer->map_id);
            }
            if($transfer->trancode==3){
                // $transferdebt=PartnerTransfer::find($transfer->map_id);
                // $transfer->cuscharge=$transferdebt->cuscharge;
                $transfer1=PartnerTransfer::find($transfer->map_id);
              }

          }
        }
        $transfermultis=PartnerTransfer::where('ref_group_id',$request->ref_group_id)->where('status',1)->whereNotNull('ismulti_transfer')->orderBy('id')->get();
        DB::table('partner_transfer_temps')->where('user_id',Auth::id())->delete();
        if($transfermultis && $transfermultis->count()>0){
          $current = Carbon::now();
          $current->timezone('Asia/Phnom_Penh');
          $updatedate=date('Y-m-d',strtotime($current));
          foreach($transfermultis as $tms){
            $ptf=new PartnerTransferTemp();
            $ptf->tranname=$tms->tranname;
            $ptf->trancode=$tms->trancode;
            $ptf->dd=$updatedate;
            $ptf->mekun=$tms->mekun;
            $ptf->user_id=Auth::id();
            $ptf->parrent_id=$tms->parrent_id;
            //$ptf->amount=floatval($tms->mekun) * floatval(str_replace(',','',$tms->amount));
            $ptf->amount= floatval(str_replace(',','',$tms->amount));

            $ptf->currency_id=$tms->currency_id;

            $ptf->cuscharge=str_replace(',','',$tms->cuscharge);
            $ptf->cuscharge_currency_id=$tms->cuscharge_currency_id;

            $ptf->fee=floatval($tms->mekun) * floatval(str_replace(',','',$tms->fee));
            $ptf->fee_currency_id=$tms->fee_currency_id;

            $ptf->sendername=$tms->sendername;
            $ptf->sendertel=str_replace(' ','',$tms->sendertel);
            $ptf->recname=$tms->recname;
            $ptf->rectel=str_replace(' ','',$tms->rectel);
            $ptf->user_affect=$tms->user_affect;
            $ptf->created_at=$tms->created_at;
            $ptf->updated_at=$tms->updated_at;
            $ptf->save();
          }

        }
        $transfertemplists=PartnerTransferTemp::where('user_id',Auth::id())->orderBy('id')->get();
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT','NOLIST'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->get();

        $gid=$request->ref_group_id;
        // $mex=ExchangeMulti::where(function($query) use($gid){
        //   $query->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
        // })->where('user_id',$request->user_id)->where('status',1)->orderBy('id')->get();

        $mex=ExchangeMulti::where('ref_group_id',$gid)->whereNotNull('ref_group_id')->where('user_id',$request->user_id)->where('status',1)->orderBy('id')->get();

        $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))
        ->where(function($q) use($gid){
          $q->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
        })->where('user_id',$request->user_id)->where('status',1)->groupBy('curbuy')->get();

        $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))
            ->where(function($q)use($gid){
              $q->whereNull('mapcode')->Orwhere('ref_group_id',$gid);
            })->where('user_id',$request->user_id)->where('status',1)->groupBy('cursale')->get();


        $hasbankpayment=0;
        $hasexchange=0;
        $hasmultitransfer=0;
        if($mex->count()>0){
         $hasexchange=2;
        }

        if($banktransfers->count()>0){
          $hasbankpayment=1;
        }
        if($transfermultis->count()>0){
          $hasmultitransfer=1;
        }
        $c=collect();
        foreach($totalbuy as $tb)
        {
            $c=$c->push(['cur'=>$tb->curbuy,'value'=>$tb->tbuy]);
        }
        foreach($totalsale as $ts)
        {
            $c=$c->push(['cur'=>$ts->cursale,'value'=> -1* $ts->tsale]);
        }

        $groups = $c->groupBy('cur');
        $sumc = $groups->map(function ($group) {
                return [
                'cur' => $group->first()['cur'], // opposition_id is constant inside the same group, so just take the first or whatever.
                'value' => $group->sum('value'),
                // 'won' => $group->where('result', 'won')->count(),
                // 'lost' => $group->where('result', 'lost')->count(),
                ];
        });
        $cashin=$sumc->where('value','>','0');
        $cashout=$sumc->where('value','<','0');
        if($transfer){
          return view('usercapitals.updategrouptransaction',compact('transfer','transfer1','transfermultis','transfertemplists','banktransfers','partners','banks','provinces','currencies','mex','totalbuy','totalsale','cashin','cashout','customers','hasbankpayment','hasexchange','hasmultitransfer'));

        }else{
          return('<h1 style="text-align:center;color:red;font-family:Khmer OS System;font-size:100px;">មិនមិនលេខកូតនេះទេ</h1><h1 style="text-align:center;color:red;font-family:Khmer OS System;font-size:100px;">សូមត្រួតពិនិត្យឡើងវិញ</h1>');
        }
    }
    public function deletetransactiongroup(Request $request)
    {
      //return $request->all();
        $current = now()->timezone('Asia/Phnom_Penh');
        $groupid=$request->groupid;
        $group=explode('-',$groupid);
        if($group[0]=='cashdraw')
        {
          DB::table('partner_transfers')->where('ref_number',$groupid)->update(['action'=>'u,d','ref_number'=>null,'iscashdraw'=>null,'cashdraw_id'=>null,'note'=>'']);
        }
        if($group[0]=='thaicashdraw')
        {
          $smsp=SmsProcess::where('group_id',$groupid)->first();
          if($smsp){
              DB::connection('mysql_thai')->table('sms')->where('id',$smsp->sms_id)->update(['isopen'=>0]);
          }
        }
        //$ptrs=PartnerTransfer::where('ref_group_id',$groupid)->where('status',1)->get();
        // foreach($ptrs as $pt){
        //   $this->storeupdated($pt->id,0,0);
        // }
        DB::table('exchanges')->where('ref_group_id',$groupid)->update(['status'=>0,'userdel'=>Auth::user()->name]);
        DB::table('exchange_multis')->where('ref_group_id',$groupid)->update(['status'=>0,'userdel'=>Auth::user()->name]);
        DB::table('partner_transfers')->where('ref_group_id',$groupid)->update(['status'=>0,'user_delete'=>Auth::id(),'updated_at'=>$current]);
        DB::table('cashdraws')->where('ref_group_id',$groupid)->update(['status'=>0,'delby'=>Auth::user()->name]);
        DB::connection('mysql_thai')->table('sms_processes')->where('group_id',$groupid)->delete();
        // $smsp=SmsProcess::where('group_id',$groupid)->where('status',1)->get();
        // if(DB::connection('mysql_thai')->table('sms_processes')->where('group_id',$groupid)->update(['status'=>0,'del_by'=>Auth::user()->name])){
        //     foreach($smsp as $sm){
        //         DB::connection('mysql_thai')->table('sms')->where('id',$sm->sms_id)->update(['isopen'=>0]);
        //     }
        // }
        return response()->json(['success'=>true,'message'=>'Transaction Group Deleted.']);

    }
    public function storeupdated($id1,$id2,$status)
    {
      $transfer1=PartnerTransfer::find($id1);
      if($transfer1){
          $ptf=new MoneyTransferUpdate();
          $ptf->action_by_id=Auth::id();
          $ptf->partner_transfer_id=$id1;
          $ptf->ref_number=$transfer1->ref_number;
          $ptf->map_id=$transfer1->map_id;
          $ptf->dd=$transfer1->dd;
          $ptf->mekun=$transfer1->mekun;
          $ptf->tranname=$transfer1->tranname;
          $ptf->trancode=$transfer1->trancode;
          $ptf->tt=$transfer1->tt;
          $ptf->user_id=$transfer1->user_id;
          $ptf->parrent_id=$transfer1->parrent_id;
          $ptf->child=$transfer1->child;
          $ptf->customer_id=$transfer1->customer_id;
          $ptf->amount=$transfer1->amount;
          $ptf->currency_id=$transfer1->currency_id;
          $ptf->cuscharge=$transfer1->cuscharge;
          $ptf->cuscharge_currency_id=$transfer1->cuscharge_currency_id;
          $ptf->fee=$transfer1->fee;
          $ptf->fee_currency_id=$transfer1->fee_currency_id;
          $ptf->bonus=0;
          $ptf->sendername=$transfer1->sendername;
          $ptf->sendertel=str_replace(' ','',$transfer1->sendertel);
          $ptf->recname=$transfer1->recname;
          $ptf->rectel=str_replace(' ','',$transfer1->rectel);
          $ptf->note=$transfer1->note;
          $ptf->status=$status;
          $ptf->save();
      }
      $transfer2=PartnerTransfer::find($id2);
      if($transfer2){
          $ptf2=new MoneyTransferUpdate();
          $ptf2->action_by_id=Auth::id();
          $ptf2->partner_transfer_id=$id2;
          $ptf2->ref_number=$transfer2->ref_number;
          $ptf2->map_id=$transfer2->map_id;
          $ptf2->dd=$transfer2->dd;
          $ptf2->tranname=$transfer2->tranname;
          $ptf2->mekun=$transfer2->mekun;
          $ptf2->tt=$transfer2->tt;
          $ptf2->user_id=$transfer2->user_id;
          $ptf2->parrent_id=$transfer2->parrent_id;
          $ptf2->child=$transfer2->child;
          $ptf2->customer_id=$transfer2->customer_id;
          $ptf2->amount=$transfer2->amount;
          $ptf2->currency_id=$transfer2->currency_id;
          $ptf2->cuscharge=$transfer2->cuscharge;
          $ptf2->cuscharge_currency_id=$transfer2->cuscharge_currency_id;
          $ptf2->fee=$transfer2->fee;
          $ptf2->fee_currency_id=$transfer2->fee_currency_id;
          $ptf2->bonus=0;
          $ptf2->sendername=$transfer2->sendername;
          $ptf2->sendertel=str_replace(' ','',$transfer2->sendertel);
          $ptf2->recname=$transfer2->recname;
          $ptf2->rectel=str_replace(' ','',$transfer2->rectel);
          $ptf2->note=$transfer2->note;
          $ptf2->status=$status;
          $ptf2->save();
      }
    }
    public function douserstatementreport(Request $request)
    {
        //return($request->all());
        DB::table('user_statement_reports')->where('viewby',Auth::user()->name)->delete();
        $this->getusercapital($request);
        $this->getexchange($request);
        $this->getpartnertransfer($request,0);
        $this->getpartnertransfer($request,1);
        $this->getpartnertransfer($request,-4);
        $this->getpartnertransfer($request,4);

        $this->getcashdraw($request);
        $this->getthaicashdraw($request);
       $usertransactions=UserStatementReport::where('viewby',Auth::user()->name)->where('currency_id',$request->cur)->orderBy('ttint')->orderBy('id')->get();
       return view('usercapitals.userstatementreportlist',compact('usertransactions'));
    }
    public function getexchange(Request $request)
    {
        $usds=Currency::where('shortcut','USD')->first();
        $usd_id=$usds->id;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $tranname='';
        $shortcut='';
        $userexchanges=Exchange::where('user_id',$request->userid)->whereDate('dd',$trandate)->where('isexchangelist',0)->where('status',1)->orderBy('id')->get();
        foreach($userexchanges as $uc)
        {
            if($uc->product>0){
                $tranname=$uc->pcur . '-USD' . '(' . $uc->rate . ')';
            }else{
                $tranname= 'USD-' . $uc->pcur . '(' . $uc->rate . ')';
            }
            $shortcut=$uc->currency->shortcut;
            $ttint=$this->convertimetoint($uc->tt);
            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $uc->dd,
                'tt'=>$uc->tt,
                'ttint'=>$ttint,
                'user_id'=>$uc->user_id,
                'tranname'=>$tranname,
                'desr'=> $uc->note,
                'amount'=>$uc->product,
                'currency_id'=>$uc->currency_id,
                'link_id'=>$uc->multiexchangecode,
                'ref_number'=>$uc->othercode,
                'tablename'=>'exchanges',
                'created_at'=>$current,
                'updated_at'=>$current
                );
                UserStatementReport::insert($utr);
                $utr1=array(
                    'viewby'=>Auth::user()->name,
                    'dd'=> $uc->dd,
                    'tt'=>$uc->tt,
                    'ttint'=>$ttint,
                    'user_id'=>$uc->user_id,
                    'tranname'=>$tranname,
                    'desr'=> $uc->note,
                    'amount'=>$uc->amount,
                    'currency_id'=>$usd_id,
                    'link_id'=>$uc->multiexchangecode,
                    'ref_number'=>$uc->othercode,
                    'tablename'=>'exchanges',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                    UserStatementReport::insert($utr1);
        }

    }
    public function getusercapital(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereDate('trandate',$trandate)->where('status',1)->where('currency_id',$request->cur)->orderBy('id')->get();
        foreach($usercapitals as $uc)
        {
            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $uc->trandate,
                'tt'=>$uc->trantime,
                'ttint'=>$this->convertimetoint($uc->trantime),
                'user_id'=>$uc->user_id_affect,
                'tranname'=>$uc->tranname,
                'desr'=> $uc->note,
                'amount'=>$uc->amount,
                'currency_id'=>$uc->currency_id,
                'link_id'=>$uc->id,
                'ref_number'=>$uc->ref_number,
                'tablename'=>'user_capitals',
                'created_at'=>$current,
                'updated_at'=>$current
                );
                  UserStatementReport::insert($utr);
        }

    }
    public function getpartnertransfer(Request $request,$mode)
    {

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $user_customer=[];
        $user=User::find($request->userid);
        if($user){
            $user_customer=explode(',',$user->customer_connect);
        }
        if($mode==0){
            $mekun=1;
            $transfers=PartnerTransfer::where('user_id',$request->userid)->whereDate('dd',$trandate)->where('trancode',1)->where('status',1)->where('currency_id',$request->cur)->whereNull('thai_amt')->get();

        }elseif($mode==1){//thai cashdraw bank out
            $mekun=-1;
            $transfers=PartnerTransfer::where('docodeby',$request->userid)->where('trancode',1)->whereIn('parrent_id',$user_customer)->whereDate('dd',$trandate)->where('status',1)->where('currency_id',$request->cur)->orderBy('id')->get();

        }elseif($mode==-4){//bank receive
            $mekun=-1;
            $transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->whereIn('parrent_id',$user_customer)->whereDate('dd',$trandate)->where('status',1)->where('currency_id',$request->cur)->orderBy('id')->get();

        }elseif($mode==4){//bank transfer
            $mekun=-1;
            $transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->whereIn('parrent_id',$user_customer)->whereDate('dd',$trandate)->where('status',1)->where('currency_id',$request->cur)->orderBy('id')->get();
        }

        if($transfers){
            foreach($transfers as $uc)
            {
                $sender='';
                $receiver='';
                $desr='';
                $tranname=$uc->tranname . $uc->partner->name;
                if($mode==4){
                    $tranname='បាញ់ចេញ ' . $uc->partner->name;
                }
                if($uc->sendertel){
                    $sender='អ្នកផ្ញើ' . $uc->sendertel;
                }
                if($uc->sendername){
                    if($sender!=''){
                        $sender .= $uc->sendername;
                    }else{
                        $sender ='អ្នកផ្ញើ' . $uc->sendername;
                    }
                }

                if($uc->rectel){
                    $receiver='អ្នកទទួល' . $uc->rectel;
                }
                if($uc->recname){
                    if($receiver!=''){
                        $receiver .= $uc->recname;
                    }else{
                        $receiver ='អ្នកទទួល' . $uc->recname;
                    }
                }

                $desr='វេរទៅ ' . $uc->partner->name . ' ' . $receiver . $sender;
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'dd'=> $uc->dd,
                    'tt'=>$uc->tt,
                    'ttint'=>$this->convertimetoint($uc->tt),
                    'user_id'=>$uc->user_id,
                    'tranname'=>$tranname,
                    'desr'=> $desr,
                    'note'=>$uc->note,
                    'amount'=>$mekun * floatval($uc->amount),
                    'currency_id'=>$uc->currency_id,
                    'link_id'=>$uc->id,
                    'ref_number'=>$uc->ref_number,
                    'tablename'=>'partner_transfers',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                    UserStatementReport::insert($utr);

            }
        }
        if($mode==0){
            $cuscharges=PartnerTransfer::where('user_id',$request->userid)->whereDate('dd',$trandate)->where('trancode',1)->where('status',1)->where('cuscharge','<>',0)->where('cuscharge_currency_id',$request->cur)->whereNull('thai_amt')->get();
            if($cuscharges){
                foreach($cuscharges as $uc){
                    $utr1=array(
                        'viewby'=>Auth::user()->name,
                        'dd'=> $uc->dd,
                        'tt'=>$uc->tt,
                        'ttint'=>$this->convertimetoint($uc->tt),
                        'user_id'=>$uc->user_id,
                        'tranname'=>'សេវ៉ាវេរ',
                        'desr'=>'',
                        'amount'=>$uc->cuscharge,
                        'currency_id'=>$uc->cuscharge_currency_id,
                        'link_id'=>$uc->id,
                        'ref_number'=>$uc->ref_number,
                        'tablename'=>'partner_transfers',
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                        UserStatementReport::insert($utr1);
                }
            }
        }

    }

    public function getcashdraw(Request $request)
    {

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $cashdraws=Cashdraw::where('user_id',$request->userid)->whereDate('opdate',$trandate)->where('status',1)->where('currency_id',$request->cur)->orderBy('id')->get();
        foreach($cashdraws as $uc)
        {
            $receiver='';
            $desr='';
            if($uc->receive_tel){
                $receiver='អ្នកទទួល' . $uc->receive_tel;
            }
            if($uc->receive_name){
                if($receiver!=''){
                    $receiver .= $uc->receive_name;
                }else{
                    $receiver ='អ្នកទទួល' . $uc->receive_name;
                }
            }
            $desr=$uc->other . ' ' . $receiver ;
            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $uc->opdate,
                'tt'=>$uc->optime,
                'ttint'=>$this->convertimetoint($uc->optime),
                'user_id'=>$uc->user_id,
                'tranname'=>'បើកវេរ(' . $this->phpformatnumber($uc->amount) . '-' . $this->phpformatnumber($uc->customer_charge) . ')',
                'desr'=> $desr,
                'note'=>$uc->note,
                'amount'=>(-1 * $uc->amount)+$uc->customer_charge,
                'currency_id'=>$uc->currency_id,
                'link_id'=>$uc->id,
                'ref_number'=>$uc->ref_number,
                'tablename'=>'cashdraws',
                'created_at'=>$current,
                'updated_at'=>$current
                );
                  UserStatementReport::insert($utr);
        }

    }

    public function getthaicashdraw(Request $request)
    {

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $cashdraws=SmsProcess::where('user_id',$request->userid)->whereDate('opdate',$trandate)->where('status',1)->where('paymethod','Cash')->where('currency_id',$request->cur)->orderBy('id')->get();
        foreach($cashdraws as $uc)
        {
            $receiver='';
            $desr='';
            if($uc->rectel){
                $receiver='អ្នកទទួល' . $uc->rectel;
            }
            if($uc->recname){
                if($receiver!=''){
                    $receiver .= $uc->recname;
                }else{
                    $receiver ='អ្នកទទួល' . $uc->recname;
                }
            }
            $desr=$uc->note . ' ' . $receiver ;
            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $uc->opdate,
                'tt'=>$uc->optime,
                'ttint'=>$this->convertimetoint($uc->optime),
                'user_id'=>$uc->user_id,
                'tranname'=>'បើកវេរលុយថៃ(' . $this->phpformatnumber($uc->amount),
                'desr'=> $desr,
                'note'=>$uc->note,
                'amount'=>-1 * $uc->amount,
                'currency_id'=>$uc->currency_id,
                'link_id'=>$uc->id,
                'ref_number'=>$uc->group_id,
                'tablename'=>'sms_processes',
                'created_at'=>$current,
                'updated_at'=>$current
                );
                  UserStatementReport::insert($utr);
        }

    }
    public function douserinvoicetransaction(Request $request)
    {
        $payinv=0;
        $paybybank=0;
        $usd=0;
        $gold=0;
        $shortcut='';
        $tranname='';
        $theylack=0;
        $welack=0;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        if($request->isinputdate=='true'){
            $userinvoices=Invoice::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->get();
        }else{
            $userinvoices=Invoice::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(invdate)'), array($trandate, $trandate2))->where('status',1)->get();
        }
        foreach($userinvoices as $uc)
        {
            $sumpayment=InvoicePayment::join('payments','payments.id','=','invoice_payments.payment_id')
            ->where('invoice_payments.invoice_id',$uc->id)
            ->whereDate('payments.paiddate',$trandate)
            ->where('payments.user_id',$request->userid)
            ->where('invoice_payments.status',1)
            ->sum('invoice_payments.amount');
            if($sumpayment<>null){
                $payinv=$sumpayment;
            }
            $paybybank=InvoicePayment::join('payments','payments.id','=','invoice_payments.payment_id')
            ->join('payment_details','payment_details.payment_id','=','payments.id')
            ->where('invoice_payments.invoice_id',$uc->id)
            ->whereDate('payments.paiddate',$trandate)
            ->where('payments.user_id',$request->userid)
            ->where('invoice_payments.status',1)
            ->where('payment_details.paymethod','=','bank')
            ->sum('payment_details.amount');

            $usd=$uc->total;
            $gold=$uc->totalweight;

            if($uc->totalweight>0){
                $tranname='Buy Gold(' . $uc->customer->name . ')inv#' . $uc->id;
                $welack=abs($uc->total-$payinv);
                $theylack=0;
            }else{
                $tranname= 'Sale Gold(' . $uc->customer->name . ')inv#' . $uc->id;
                $theylack=$uc->total-$payinv;
                $welack=0;
            }

            $utr=array(
                'viewby'=>Auth::user()->name,
                'dd'=> $uc->invdate,
                'tt'=>$uc->invtime,
                'ttint'=>$this->convertimetoint($uc->invtime),
                'user_id'=>$uc->user_id,
                'tranname'=>$tranname,
                'desr'=>'',
                'usd'=>$usd,
                'khr'=>0,
                'thb'=>0,
                'vnd'=>0,
                'gold'=>$gold,
                'fn'=>0,
                'shortcut'=>'USD',
                'theylack'=>-1 * $theylack,
                'welack'=>$welack,
                'paybybank'=>-1 * $paybybank,
                'created_at'=>$current,
                'updated_at'=>$current
                );
              UserTransactionReport::insert($utr);

              $usd=0;
              $gold=0;
              $shortcut='';
              $tranname='';
              $payinv=0;
              $theylack=0;
              $welack=0;
        }
    }
    public function douserexchangetransaction(Request $request,$exchangelist,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname='';
        $desr='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        if($startdate_eq_enddate==false){
            if($request->isinputdate=='true'){
                if($exchangelist==0){
                    $sum=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('status',1)->where('isexchangelist',0)->select('currency_id','isexchangelist',DB::raw('SUM(product) as product'),DB::raw('SUM(amount) as amount'))->groupBy('currency_id','isexchangelist')->get();
                }else{
                    $sum=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('status',1)->where('ref_group_id','not like','thaicashdraw%')->select('currency_id','isexchangelist',DB::raw('SUM(product) as product'),DB::raw('SUM(amount) as amount'))->groupBy('currency_id','isexchangelist')->get();
                }
            }else{
                if($exchangelist==0){
                    $sum=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('status',1)->where('isexchangelist',0)->select('currency_id','isexchangelist',DB::raw('SUM(product) as product'),DB::raw('SUM(amount) as amount'))->groupBy('currency_id','isexchangelist')->get();
                }else{
                    $sum=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('status',1)
                    ->where(function($query){
                        return $query->where('isexchangelist',0)->orWhere(function($query1){
                            return $query1->where('isexchangelist',1)->where('ref_group_id','not like','thaicashdraw%');
                        });
                    })
                    ->select('currency_id','isexchangelist',DB::raw('SUM(product) as product'),DB::raw('SUM(amount) as amount'))->groupBy('currency_id','isexchangelist')->get();
                }
            }
            foreach($sum as $uc)
            {
                $desr='';
                if($uc->isexchangelist==1){
                    $issum=0;
                }else{
                    $issum=1;
                }
                $usd=$uc->amount;
                if($uc->currency->shortcut=='KHR'){
                    $khr=$uc->product;
                }else if($uc->currency->shortcut=='THB'){
                    $thb=$uc->product;
                }else if($uc->currency->shortcut=='VND'){
                    $vnd=$uc->product;
                }else if($uc->currency->shortcut=='GOLD'){
                    $gold=$uc->product;
                }else{
                    $fn=$uc->product;
                }
                $shortcut=$uc->currency->shortcut;
                if($uc->product>0){
                    $tranname=$shortcut . '-USD';
                }else{
                    $tranname= 'USD-' . $shortcut;
                }

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>$tranname,
                    'desr'=>$notedate,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>'exchanges',
                    'issum'=>$issum,
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);

                $usd=0;
                $khr=0;
                $thb=0;
                $vnd=0;
                $fn=0;
                $gold=0;
                $shortcut='';
                $tranname='';
            }
        }
        if($request->isinputdate=='true'){
          if($exchangelist==0){
            $userexchanges=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)->where('isexchangelist',0)->get();
          }else{
            $userexchanges=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)->where('ref_group_id','not like','thaicashdraw%')->get();
          }
        }else{
          if($exchangelist==0){
            $userexchanges=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)->where('isexchangelist',0)->get();
          }else{

            $userexchanges=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)
            ->where(function($query){
                return $query->where('isexchangelist',0)->orWhere(function($query1){
                    return $query1->where('isexchangelist',1)->where('ref_group_id','not like','thaicashdraw%');
                });
            })

            ->get();
          }
        }
        foreach($userexchanges as $uc)
        {
            $desr='';
            if($uc->isexchangelist==1){
              $issum=0;
            }else{
              $issum=1;
            }
            $usd=$uc->amount;
            if($uc->currency->shortcut=='KHR'){
                $khr=$uc->product;
            }else if($uc->currency->shortcut=='THB'){
                $thb=$uc->product;
            }else if($uc->currency->shortcut=='VND'){
                $vnd=$uc->product;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold=$uc->product;
            }else{
                $fn=$uc->product;
            }
            if($uc->product>0){
                $tranname=$uc->pcur . '-USD' . '(' . floatval($uc->rate) . ')';
            }else{
                $tranname= 'USD-' . $uc->pcur . '(' . floatval($uc->rate) . ')';
            }
            $shortcut=$uc->currency->shortcut;
            if($uc->desr){
              $desr=$uc->desr;
            }
            if($uc->note){
              if($desr<>''){
                $desr=$desr . '|' . $uc->note;
              }else{
                $desr=$uc->note;
              }
            }
            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$uc->created_at,
                'dd'=> $uc->dd,
                'tt'=>$uc->tt,
                'ttint'=>$this->convertimetoint($uc->tt),
                'user_id'=>$uc->user_id,
                'tranname'=>$tranname,
                'desr'=>$desr,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$uc->id,
                'ref_number'=>$uc->othercode,
                'ref_group_id'=>$uc->ref_group_id,
                'tablename'=>'exchanges',
                'issum'=>$issum,
                'created_at'=>$current,
                'updated_at'=>$current
                );
              UserTransactionReport::insert($utr);

              $usd=0;
              $khr=0;
              $thb=0;
              $vnd=0;
              $fn=0;
              $gold=0;
              $shortcut='';
              $tranname='';
        }
    }
    public function sum_douserexchangetransaction(Request $request,$exchangelist,$timeint)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname='ប្តូរប្រាក់';
        $desr='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        $shortcut='';
        if($request->isinputdate=='true'){
            $sum=Exchange::whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->where('isexchangelist',0)->where('user_id',$request->userid)->select(DB::raw('currency_id,sum(product) as product'))->groupBy('currency_id')->get();
        }else{
            $sum=Exchange::whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->where('isexchangelist',0)->where('user_id',$request->userid)->select(DB::raw('currency_id,sum(product) as product'))->groupBy('currency_id')->get();
        }
        if($sum){
          foreach($sum as $s){
                if($s->currency->shortcut=='KHR'){
                    $khr=$s->product;
                }else if($s->currency->shortcut=='THB'){
                    $thb=$s->product;
                }else if($s->currency->shortcut=='VND'){
                    $vnd=$s->product;
                }else if($s->currency->shortcut=='GOLD'){
                    $gold=$s->product;
                }else{
                    $fn=$s->product;
                    $shortcut=$s->currency->shortcut;
                    $utr=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$trandate,
                        'dd'=> $trandate,
                        'tt'=>'',
                        'ttint'=>$timeint,
                        'user_id'=>$request->userid,
                        'tranname'=>$tranname . $shortcut,
                        'desr'=>'',
                        'usd'=>0,
                        'khr'=>0,
                        'thb'=>0,
                        'vnd'=>0,
                        'gold'=>0,
                        'fn'=>$fn,
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>0,
                        'ref_number'=>'',
                        'ref_group_id'=>'',
                        'tablename'=>'exchanges-'. $shortcut,
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr);
                }
            }
        }
        if($request->isinputdate=='true'){
            $sum1=Exchange::whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->where('isexchangelist',0)->where('user_id',$request->userid)->select(DB::raw('maincur,sum(amount) as tamt'))->groupBy('maincur')->get();
        }else{
            $sum1=Exchange::whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->where('isexchangelist',0)->where('user_id',$request->userid)->select(DB::raw('maincur,sum(amount) as tamt'))->groupBy('maincur')->get();
        }
        if($sum1){
            foreach($sum1 as $s1){
              $usd=$s1->tamt;
            }
          }
          $utr=array(
            'viewby'=>Auth::user()->name,
            'inputdate'=>$trandate,
            'dd'=> $trandate,
            'tt'=>'',
            'ttint'=>$timeint,
            'user_id'=>$request->userid,
            'tranname'=>$tranname,
            'desr'=>'',
            'usd'=>$usd,
            'khr'=>$khr,
            'thb'=>$thb,
            'vnd'=>$vnd,
            'gold'=>$gold,
            'fn'=>0,
            'shortcut'=>'',
            'theylack'=>'0',
            'welack'=>'0',
            'paybybank'=>'0',
            'link_id'=>0,
            'ref_number'=>'',
            'ref_group_id'=>'',
            'tablename'=>'exchanges',
            'issum'=>1,
            'created_at'=>$current,
            'updated_at'=>$current
            );
        UserTransactionReport::insert($utr);

    }
    public function dousercapitaltransaction(Request $request,$trancode,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {
        $found=0;
        $created_at='';
        $trdate='';
        //$trandate='';
        $trantime='';
        $tranname='';
        $desr='';
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $refnum='';
        $link_id='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        if($startdate_eq_enddate==false){
            if($request->ckcash=='true'){
                if($request->isinputdate=='true'){
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('trancode',$trancode)->where('capital_type','cash')->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }else{
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->where('trancode',$trancode)->where('capital_type','cash')->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }
            }else{
                if($request->isinputdate=='true'){
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('trancode',$trancode)->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }else{
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->where('trancode',$trancode)->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }
            }
            foreach($sum as $uc)
            {

                ++ $found;

                if($uc->currency->shortcut=='USD'){
                    $usd +=$uc->amount;
                }else if($uc->currency->shortcut=='KHR'){
                    $khr +=$uc->amount;
                }else if($uc->currency->shortcut=='THB'){
                    $thb +=$uc->amount;
                }else if($uc->currency->shortcut=='VND'){
                    $vnd +=$uc->amount;
                }else if($uc->currency->shortcut=='GOLD'){
                    $gold +=$uc->amount;
                }else{
                    $fn=$uc->amount;
                    $shortcut=$uc->currency->shortcut;
                    $utr=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$predate,
                        'dd'=> $predate,
                        'tt'=>'',
                        'ttint'=>0,
                        'user_id'=>$request->userid,
                        'tranname'=>'Total Capital',
                        'desr'=> $notedate,
                        'usd'=>0,
                        'khr'=>0,
                        'thb'=>0,
                        'vnd'=>0,
                        'gold'=>0,
                        'fn'=>$fn,
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'ref_number'=>'',
                        'link_id'=>'0',
                        'tablename'=>'user_capitals',
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr);
                    $fn=0;
                    $shortcut='';
                    $refnum='';
                }
            }
            if($found>0){
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Capital',
                    'desr'=>$notedate,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>0,
                    'shortcut'=>'',
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'tablename'=>'user_capitals',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
            }
        }

        $found=0;
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        if($request->ckcash=='true'){
            if($request->isinputdate=='true'){
                $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('trancode',$trancode)->where('capital_type','cash')->where('status',1)->orderBy('id')->get();
              }else{
                $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($startdate, $enddate))->where('trancode',$trancode)->where('capital_type','cash')->where('status',1)->orderBy('id')->get();
              }
        }else{
            if($request->isinputdate=='true'){
              $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('trancode',$trancode)->where('status',1)->orderBy('id')->get();
            }else{
              $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($startdate, $enddate))->where('trancode',$trancode)->where('status',1)->orderBy('id')->get();
            }
        }

        foreach($usercapitals as $uc)
        {
            if($found==0){
              $trantime=$uc->trantime;
            }
           ++ $found;
            $trdate=$uc->trandate;
            $created_at=$uc->created_at;
            $tranname=$uc->tranname;
            $desr=$uc->note;

            if($uc->currency->shortcut=='USD'){
                $usd +=$uc->amount;
                $link_id==''?$link_id=$uc->id:$link_id =$link_id.','.$uc->id;
            }else if($uc->currency->shortcut=='KHR'){
                $khr +=$uc->amount;
                $link_id==''?$link_id=$uc->id:$link_id =$link_id.','.$uc->id;
            }else if($uc->currency->shortcut=='THB'){
                $thb +=$uc->amount;
                $link_id==''?$link_id=$uc->id:$link_id =$link_id.','.$uc->id;
            }else if($uc->currency->shortcut=='VND'){
                $vnd +=$uc->amount;
                $link_id==''?$link_id=$uc->id:$link_id =$link_id.','.$uc->id;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold +=$uc->amount;
                $link_id==''?$link_id=$uc->id:$link_id =$link_id.','.$uc->id;
            }else{
                $fn=$uc->amount;
                $shortcut=$uc->currency->shortcut;
                $refnum=$uc->id;
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$uc->created_at,
                    'dd'=> $uc->trandate,
                    'tt'=>$uc->trantime,
                    'ttint'=>$this->convertimetoint($uc->trantime),
                    'user_id'=>$uc->user_id_affect,
                    'tranname'=>$uc->tranname,
                    'desr'=> $uc->note,
                    'usd'=>0,
                    'khr'=>0,
                    'thb'=>0,
                    'vnd'=>0,
                    'gold'=>0,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'ref_number'=>'usercapital-id-'.$refnum,
                    'link_id'=>$uc->id,
                    'tablename'=>'user_capitals',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                  UserTransactionReport::insert($utr);
                  $fn=0;
                  $shortcut='';
                  $refnum='';
            }
        }
        if($found>0){
            // if($trancode==2){
            //     $link_id='MixedId';
            // }
            $linkidcut='';
            $showlinkid=explode(',',$link_id);
            if(count($showlinkid)>1){
                $linkidcut=$showlinkid[0] . ',...';
            }else{
                $linkidcut=$showlinkid[0];
            }
            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$created_at,
                'dd'=> $trdate,
                'tt'=>$trantime,
                'ttint'=>$this->convertimetoint($trantime),
                'user_id'=>$request->userid,
                'tranname'=>$tranname,
                'desr'=>$desr,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>0,
                'shortcut'=>'',
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$linkidcut,
                'tablename'=>'user_capitals',
                'created_at'=>$current,
                'updated_at'=>$current
                );
              UserTransactionReport::insert($utr);
        }
    }
    public function sum_dousercapitaltransaction(Request $request,$trancode,$timeint)
    {
        $found=0;
        $tranname='';
        $desr='';
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $refnum='';
        $link_id='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        if($request->isinputdate=='true'){
          $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('trancode',$trancode)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }else{
          $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($trandate, $trandate2))->where('trancode',$trancode)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }
        if($trancode==2){
            $tranname='សរុបដើមទុនចាប់ផ្តើម';
        }elseif($trancode==-2){
            $tranname='សរុបដើមទុនដកចុងគ្រា';
        }elseif($trancode==-1){
            $tranname='សរុបលុយដកពីបុគ្គលិក';
        }elseif($trancode==1){
            $tranname='សរុបលុយដាក់អោយបុគ្គលិក';
        }
        foreach($usercapitals as $uc)
        {
           ++ $found;
            if($uc->currency->shortcut=='USD'){
                $usd +=$uc->tamt;

            }else if($uc->currency->shortcut=='KHR'){
                $khr +=$uc->tamt;
            }else if($uc->currency->shortcut=='THB'){
                $thb +=$uc->tamt;
            }else if($uc->currency->shortcut=='VND'){
                $vnd +=$uc->tamt;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold +=$uc->tamt;
            }else{
                $fn=$uc->tamt;
                $shortcut=$uc->currency->shortcut;
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$trandate,
                    'dd'=> $trandate,
                    'tt'=>'',
                    'ttint'=>$timeint,
                    'user_id'=>$request->userid,
                    'tranname'=>'សរុបដើមទុនបរទេស',
                    'desr'=> $uc->note,
                    'usd'=>0,
                    'khr'=>0,
                    'thb'=>0,
                    'vnd'=>0,
                    'gold'=>0,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'ref_number'=>'usercapital-id-'.$refnum,
                    'link_id'=>$uc->id,
                    'tablename'=>'user_capitals',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                  UserTransactionReport::insert($utr);
                  $fn=0;
                  $shortcut='';
                  $refnum='';
            }
        }
        if($found>0){
            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$trandate,
                'dd'=> $trandate,
                'tt'=>'',
                'ttint'=>$timeint,
                'user_id'=>$request->userid,
                'tranname'=>$tranname,
                'desr'=>$desr,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>0,
                'shortcut'=>'',
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$link_id,
                'tablename'=>'user_capitals',
                'created_at'=>$current,
                'updated_at'=>$current
                );
              UserTransactionReport::insert($utr);
        }
    }

    public function dousercashinouttransaction(Request $request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $note='';
        $shortcut='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        if($startdate_eq_enddate==false){
            if($request->ckcash=='true'){
                if($request->isinputdate=='true'){
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('capital_type','cash')->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }else{
                    $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('capital_type','cash')->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }
            }else{
                if($request->isinputdate=='true'){
                $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }else{
                $sum=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                }
            }
            foreach($sum as $uc)
            {

                if($uc->currency->shortcut=='USD'){
                    $usd=$uc->amount;
                }else if($uc->currency->shortcut=='KHR'){
                    $khr=$uc->amount;
                }else if($uc->currency->shortcut=='THB'){
                    $thb=$uc->amount;
                }else if($uc->currency->shortcut=='VND'){
                    $vnd=$uc->amount;
                }else if($uc->currency->shortcut=='GOLD'){
                    $gold=$uc->amount;
                }else{
                    $fn=$uc->amount;
                    $shortcut=$uc->currency->shortcut;
                }

                if($uc->note<>''){
                $note=$uc->note;
                if($uc->note1<>''){
                    $note = $note .'('. $uc->note1 . ')';
                }
                }else{
                $note=$uc->note1;
                }

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Cashin Out',
                    'desr'=> $notedate,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'tablename'=>'user_capitals',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $note='';
                $shortcut='';
            }
        }
        if($request->ckcash=='true'){
            if($request->isinputdate=='true'){
                $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('capital_type','cash')->where('status',1)->get();
              }else{
                $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('capital_type','cash')->where('status',1)->get();
              }
        }else{
            if($request->isinputdate=='true'){
              $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('status',1)->get();
            }else{
              $usercapitals=UserCapital::where('user_id_affect',$request->userid)->whereBetween(DB::raw('DATE(trandate)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('status',1)->get();
            }
        }
        foreach($usercapitals as $uc)
        {

            if($uc->currency->shortcut=='USD'){
                $usd=$uc->amount;
            }else if($uc->currency->shortcut=='KHR'){
                $khr=$uc->amount;
            }else if($uc->currency->shortcut=='THB'){
                $thb=$uc->amount;
            }else if($uc->currency->shortcut=='VND'){
                $vnd=$uc->amount;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold=$uc->amount;
            }else{
                $fn=$uc->amount;
                $shortcut=$uc->currency->shortcut;
            }

            if($uc->note<>''){
              $note=$uc->note;
              if($uc->note1<>''){
                $note = $note .'('. $uc->note1 . ')';
              }
            }else{
              $note=$uc->note1;
            }

            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$uc->created_at,
                'dd'=> $uc->trandate,
                'tt'=>$uc->trantime,
                'ttint'=>$this->convertimetoint($uc->trantime),
                'user_id'=>$uc->user_id_affect,
                'tranname'=>$uc->tranname,
                'desr'=> $note,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$uc->id,
                'tablename'=>'user_capitals',
                'created_at'=>$current,
                'updated_at'=>$current
                );
            UserTransactionReport::insert($utr);
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $note='';
            $shortcut='';
        }
    }
    public function doexpanseincometransaction(Request $request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $note='';
        $shortcut='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        if($startdate_eq_enddate==false){
            if($request->isinputdate=='true'){
                $sum=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
            }else{
                $sum=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->whereIn('trancode',[-1,1])->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
            }
            foreach($sum as $uc)
            {

                if($uc->currency->shortcut=='USD'){
                    $usd=$uc->amount;
                }else if($uc->currency->shortcut=='KHR'){
                    $khr=$uc->amount;
                }else if($uc->currency->shortcut=='THB'){
                    $thb=$uc->amount;
                }else if($uc->currency->shortcut=='VND'){
                    $vnd=$uc->amount;
                }else if($uc->currency->shortcut=='GOLD'){
                    $gold=$uc->amount;
                }else{
                    $fn=$uc->amount;
                    $shortcut=$uc->currency->shortcut;
                }

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Expanse',
                    'desr'=> $notedate,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'tablename'=>'expanses',
                    'created_at'=>$current,
                    'updated_at'=>$current
                );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $note='';
                $shortcut='';
            }
        }
        if($request->isinputdate=='true'){
          $expanses=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('status',1)->get();
        }else{
          $expanses=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->whereIn('trancode',[-1,1])->where('status',1)->get();
        }
        foreach($expanses as $uc)
        {

            if($uc->currency->shortcut=='USD'){
                $usd=$uc->amount;
            }else if($uc->currency->shortcut=='KHR'){
                $khr=$uc->amount;
            }else if($uc->currency->shortcut=='THB'){
                $thb=$uc->amount;
            }else if($uc->currency->shortcut=='VND'){
                $vnd=$uc->amount;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold=$uc->amount;
            }else{
                $fn=$uc->amount;
                $shortcut=$uc->currency->shortcut;
            }

            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$uc->created_at,
                'dd'=> $uc->dd,
                'tt'=>$uc->tt,
                'ttint'=>$this->convertimetoint($uc->tt),
                'user_id'=>$uc->user_id,
                'tranname'=>$uc->type,
                'desr'=> $uc->desr,
                'usd'=>$usd,
                'khr'=>$khr,
                'thb'=>$thb,
                'vnd'=>$vnd,
                'gold'=>$gold,
                'fn'=>$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$uc->id,
                'tablename'=>'expanses',
                'created_at'=>$current,
                'updated_at'=>$current
            );
            UserTransactionReport::insert($utr);
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $note='';
            $shortcut='';
        }
    }
    public function sum_doexpanseincometransaction(Request $request,$trancode,$timeint)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $note='';
        $shortcut='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        if($request->isinputdate=='true'){
          $expanses=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('trancode',$trancode)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }else{
          $expanses=Expanse::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('trancode',$trancode)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }
        if($trancode==1){
            $tranname='សរុបចំណូលផ្សេងៗ';
        }elseif($trancode==-1){
            $tranname='សរុបចំណាយទូទៅ';
        }
        foreach($expanses as $uc)
        {

            if($uc->currency->shortcut=='USD'){
                $usd=$uc->tamt;
            }else if($uc->currency->shortcut=='KHR'){
                $khr=$uc->tamt;
            }else if($uc->currency->shortcut=='THB'){
                $thb=$uc->tamt;
            }else if($uc->currency->shortcut=='VND'){
                $vnd=$uc->tamt;
            }else if($uc->currency->shortcut=='GOLD'){
                $gold=$uc->tamt;
            }else{
                $fn=$uc->tamt;
                $shortcut=$uc->currency->shortcut;
            }



        $utr=array(
            'viewby'=>Auth::user()->name,
            'inputdate'=>$trandate,
            'dd'=> $trandate,
            'tt'=>'',
            'ttint'=>$timeint,
            'user_id'=>$request->userid,
            'tranname'=>$tranname,
            'desr'=> '',
            'usd'=>$usd,
            'khr'=>$khr,
            'thb'=>$thb,
            'vnd'=>$vnd,
            'gold'=>$gold,
            'fn'=>$fn,
            'shortcut'=>$shortcut,
            'theylack'=>'0',
            'welack'=>'0',
            'paybybank'=>'0',
            'link_id'=>'',
            'tablename'=>'expanses'.$trancode,
            'created_at'=>$current,
            'updated_at'=>$current
            );
            UserTransactionReport::insert($utr);
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $note='';
            $shortcut='';
        }
    }
    public function dotransfertransaction(Request $request,$showall,$mode,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $usd1=0;
        $khr1=0;
        $thb1=0;
        $vnd1=0;
        $cuschargenotthesamecur=0;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        //$user_customer=[];
        // $user=User::find($request->userid);
        // if($user){
        //     $user_customer=explode(',',$user->customer_connect);
        // }
        $from = Carbon::parse($fromdate);
        $start = Carbon::parse($startdate);

        if ($from->lt($start)) {
            // fromdate is earlier than showdate
            $startdate=$fromdate;
        }
        // if ($from->gt($start)) {
        //     // fromdate is after showdate (unexpected?)
        // }
        $userid=$request->userid;
        if($request->isinputdate=='true'){
            if($mode==0){
                if($showall==1){
                    $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)->where('isshow',1)
                    ->where(function($query) use($userid){
                        $query->where('user_id',$userid)->orWhere('user_affect',$userid);
                    })->orderBy('id')->get();
                }else{
                    $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)
                    ->where(function($query) use($userid){
                        $query->where('user_id',$userid)->orWhere('user_affect',$userid);
                    })->orderBy('id')->get();
                }
             }
        }else{
            if($mode==0){
                if($showall==1){
                    $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)->where('isshow',1)
                    ->where(function($query) use($userid){
                        $query->where('user_id',$userid)->orWhere('user_affect',$userid);
                    })->orderBy('id')->get();
                }else{
                    $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)
                    ->where(function($query) use($userid){
                        $query->where('user_id',$userid)->orWhere('user_affect',$userid);
                    })->orderBy('id')->get();
                }
             }
        }

        $issum=0;
        $mekun=0;
        //$notetext='';
        foreach($transfers as $tr)
        {
            $issum=0;
            //$notetext='';
            if($mode==0){

                if($tr->thai_amt){//បើកវេរលុយថៃ
                    if($tr->mekun==1){//ធ្វើកូតវីង
                        $mekun=-1;
                    }
                    if($tr->user_affect==$request->userid && $tr->docodeby){
                        $issum=1;
                    }

                }else{
                    if($tr->docodeby){//ដកកូត
                        if($tr->user_affect==$request->userid){
                            $issum=1;
                        }
                    }else{
                        // if($tr->trancode==1 || ($tr->user_affect==$request->userid)){
                        //         $issum=1;
                        // }
                        if($tr->trancode==1 && $tr->user_id==$request->userid){//លុយវេរតាមខេត្ត
                            $issum=1;
                        }
                        if(($tr->trancode==1 || $tr->trancode==-1) && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid){//បុគ្គលិកប្រើគណនីបុគ្គលិកមួយទៀតបាញ់ចេញ
                            $issum=1;
                        }
                        if($tr->trancode==-1 && $tr->user_affect<>$request->userid && $tr->user_id==$request->userid && $tr->iscashdraw==1 && is_null($tr->cashdraw_id)){//បុគ្គលិកប្រើគណនីបុគ្គលិកមួយទៀតដកលុយតាមវីង
                            $issum=1;
                        }
                        if(($tr->trancode==-1) && $tr->user_affect==$request->userid && $tr->cashdraw_id>0){//ប្តូរប្រាក់បាញ់ចូលគណនេយ្យបុគ្គលិក
                            $issum=1;
                        }
                        if(($tr->trancode==-1) && $tr->user_affect==$request->userid && $tr->iscashdraw==1 && $tr->location_id==3){//ដកកូតតាមវីង
                            $issum=1;
                        }
                        if(($tr->trancode==4 || $tr->trancode==-4) && $tr->user_affect==$request->userid){//បាញ់ចូលបុគ្គលិក
                            $issum=1;
                        }
                    }
                    $mekun=$tr->mekun;
                    //ករណីមេយកABAបុគ្គលិកវេរ
                    if($tr->trancode>0 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid){
                        $mekun=-1 * $tr->mekun;
                    }
                    if($tr->trancode==4 && $tr->user_affect==$request->userid){
                        $mekun=-1 * $tr->mekun;
                    }
                    if($tr->trancode==-1 && $tr->user_affect<>$request->userid && $tr->user_id==$request->userid && $tr->iscashdraw==1 && is_null($tr->cashdraw_id)){
                        $mekun=-1 * $tr->mekun;
                    }
                }

            }

            if($tr->trancode==-3){//វេរជំពាក់
                $cuscharge=$tr->fee;
            }else{
                $cuscharge=$tr->cuscharge;
            }
            $tranname=$tr->tranname . $tr->partner->name;

            if($tr->trancode==4 || $tr->trancode==-4 || $tr->docodeby){ //អតិថិជនយកតាមABA របស់បុគ្គលិក
                if($tr->iscutwater==0){

                    $cuscharge= floatval($tr->fee) + $mekun * floatval($tr->cuscharge);// not sure why sum like this
                }else{
                    $cuscharge=$tr->fee;
                }
                if($tr->mekun==1){
                    $tranname='បាញ់ចេញតាម ' . $tr->partner->name;
                }else{
                    if($tr->docodeby){
                        $tranname='ដកកូត ' . $tr->partner->name;
                    }else{
                        $tranname='បាញ់ចូល ' . $tr->partner->name;
                    }
                }

            }else{
                if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                    $tranname='ជើងសារវេរតាម' . $tr->partner->name . '('. $this->phpformatnumber($tr->amount)  . $tr->currency->sk . ')';
                }
            }
            if($tr->currency->shortcut=='USD'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                     //ករណីអតិថិជនវេរតាមABAបុគ្គលិកquicktransfer
                     if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){//វេរតាមវីង បូកចូលតែសេវ៉ា
                        $usd=($tr->amount+$cuscharge)-($tr->amount+$tr->fee);
                     }else if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid && is_null($tr->thai_amt)){//បុគ្គលិកទី១យកគណនីបុគ្គលិកទី២បាញ់
                        $usd=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->cashdraw_id>0 && !is_null($tr->cashdraw_id) && is_null($tr->thai_amt)){//ភ្ញៀវយកក្រៅ
                        $usd=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//បានសេវ៉ាដកលុយតាមវីង
                        $usd=$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect<>$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//ប្រើAccountបុគ្គលិកផ្សេងបើកតាមវីង
                        $usd=$tr->amount;
                     }else{
                        $usd=$tr->amount+$cuscharge;
                     }
                }else{
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $usd=$tr->amount-($tr->amount+$tr->fee);
                    }else{
                        $usd=$tr->amount;
                    }
                    $cuschargenotthesamecur=1;
                }

            }else if($tr->currency->shortcut=='KHR'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $khr=($tr->amount+$cuscharge)-($tr->amount+$tr->fee);
                     }else if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid && is_null($tr->thai_amt)){
                        $khr=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->cashdraw_id>0 && !is_null($tr->cashdraw_id) && is_null($tr->thai_amt)){
                        $khr=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//បានសេវ៉ាដកលុយតាមវីង
                        $khr=$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect<>$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//ប្រើAccountបុគ្គលិកផ្សេងបើកតាមវីង
                        $khr=$tr->amount;
                     }else{
                         $khr=$tr->amount+$cuscharge;
                     }
                }else{
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $khr=$tr->amount-($tr->amount+$tr->fee);
                    }else{
                        $khr=$tr->amount;
                    }
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='THB'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $thb=($tr->amount+$cuscharge)-($tr->amount+$tr->fee);
                     }else if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid && is_null($tr->thai_amt)){
                        $thb=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->cashdraw_id>0 && !is_null($tr->cashdraw_id) && is_null($tr->thai_amt)){
                        $thb=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//បានសេវ៉ាដកលុយតាមវីង
                        $thb=$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect<>$request->userid && $tr->iscashdraw==1 && $tr->location_id==3 && is_null($tr->thai_amt)){//ប្រើAccountបុគ្គលិកផ្សេងបើកតាមវីង
                        $thb=$tr->amount;
                     }else{
                         $thb=$tr->amount+$cuscharge;
                     }
                }else{
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $thb=$tr->amount-($tr->amount+$tr->fee);
                    }else{
                        $thb=$tr->amount;
                    }
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='VND'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $vnd=($tr->amount+$cuscharge)-($tr->amount+$tr->fee);
                     }else if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid && is_null($tr->thai_amt)){
                        $vnd=$tr->amount+$tr->fee;
                     }else if($tr->trancode==-1 && $tr->user_affect==$request->userid && $tr->cashdraw_id>0 && !is_null($tr->cashdraw_id) && is_null($tr->thai_amt)){
                        $vnd=$tr->amount+$tr->fee;
                     }else{
                         $vnd=$tr->amount+$cuscharge;
                     }
                }else{
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $vnd=$tr->amount-($tr->amount+$tr->fee);
                    }else{
                        $vnd=$tr->amount;
                    }
                    $cuschargenotthesamecur=1;
                }
            }else if($tr->currency->shortcut=='GOLD'){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $gold=($tr->amount+$cuscharge)-($tr->amount+$tr->fee);
                     }else if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id<>$request->userid && is_null($tr->thai_amt)){
                        $gold=$tr->amount+$tr->fee;
                     }else{
                         $gold=$tr->amount+$cuscharge;
                     }

                }else{
                    if($tr->trancode==1 && $tr->user_affect==$request->userid && $tr->user_id==$request->userid && is_null($tr->thai_amt)){
                        $gold=$tr->amount-($tr->amount+$tr->fee);
                    }else{
                        $gold=$tr->amount;
                    }
                    $cuschargenotthesamecur=1;
                }
            }else{
                $fn=$tr->amount;
                $shortcut=$tr->currency->shortcut;
            }
            if($cuschargenotthesamecur==1){
                if($tr->cuschargecur->shortcut=='USD'){
                    $usd1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='THB'){
                    $thb1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='KHR'){
                    $khr1=$tr->cuscharge;
                }else if($tr->cuschargecur->shortcut=='VND'){
                    $vnd1=$tr->cuscharge;
                }
            }

            $sender='';
            $receiver='';
            $desr='';
            $feestr='';
            if($tr->fee<>0){
              $feestr='(' . $this->phpformatnumber($tr->fee) . $tr->feecurrency->shortcut .')';
            }
            if($tr->sendertel){
                $sender=$tr->sendertel;
            }
            if($tr->sendername){
                if($sender!=''){
                    $sender .='|'. $tr->sendername;
                }else{
                    $sender = $tr->sendername;
                }
            }

            if($tr->rectel){
                $receiver= $tr->rectel;
            }
            if($tr->recname){
                if($receiver!=''){
                    $receiver .='|'. $tr->recname;
                }else{
                    $receiver =$tr->recname;
                }
            }
            if($receiver<>''){
              $receiver='(' . $receiver . ')';
            }
            if($sender<>''){
              $sender='(' . $sender . ')';
            }
            // $desr='វេរទៅ ' . $tr->partner->name . ' ' . $receiver . $sender;
            $desr=$tr->note . $receiver  . $sender . $feestr ;
            // if(UserTransactionReport::where('link_id',$tr->id)->where('tablename','partner_transfers')->exists()){
            //     DB::table('user_transaction_reports')->where('link_id',$tr->id)->where('tablename','partner_transfers')
            //     ->update(['issum'=>1,'usd'=>$mekun * floatval($usd),'khr'=> $mekun * floatval($khr),'thb'=> $mekun * floatval($thb),'vnd'=> $mekun * floatval($vnd),'fn'=> $mekun * floatval($fn)]);
            // }else{

            // }
            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$tr->created_at,
                'dd'=> $tr->dd,
                'tt'=>$tr->tt,
                'ttint'=>$this->convertimetoint($tr->tt),
                'user_id'=>$tr->user_id,
                'tranname'=>$tranname, //. $notetext,
                //'tranname'=>$tr->partner->name . $tr->note,
                'desr'=>$desr,
                'note'=>$tr->note,
                'usd'=> $mekun * floatval($usd),
                'khr'=> $mekun * floatval($khr),
                'thb'=> $mekun * floatval($thb),
                'vnd'=> $mekun * floatval($vnd),
                'gold'=> $mekun * floatval($gold),
                'fn'=> $mekun * floatval($fn),
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$tr->id,
                'ref_number'=>$tr->ref_number,
                'ref_group_id'=>$tr->ref_group_id,
                'tablename'=>'partner_transfers',
                'issum'=>$issum,
                'created_at'=>$current,
                'updated_at'=>$current
                );
            UserTransactionReport::insert($utr);

            if($cuschargenotthesamecur==1){
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$tr->created_at,
                    'dd'=> $tr->dd,
                    'tt'=>$tr->tt,
                    'ttint'=>$this->convertimetoint($tr->tt),
                    'user_id'=>$tr->user_id,
                    'tranname'=>'សេវ៉ាវេរ',
                    'desr'=>$desr,
                    'note'=>'វេរចំនួន '.$this->phpformatnumber($tr->amount) . $tr->currency->shortcut,
                    'usd'=> $mekun * floatval($usd1),
                    'khr'=> $mekun * floatval($khr1),
                    'thb'=> $mekun * floatval($thb1),
                    'vnd'=> $mekun * floatval($vnd1),
                    'gold'=>0,
                    'fn'=>0,
                    'shortcut'=>'',
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>$tr->id,
                    'tablename'=>'partner_transfers',
                    'ref_group_id'=>$tr->ref_group_id,
                    'issum'=>$issum,
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
            }


            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $shortcut='';
            $usd1=0;
            $thb1=0;
            $khr1=0;
            $vnd1=0;
            $cuschargenotthesamecur=0;
        }



    }
    public function dotransfertransactioncash(Request $request,$showall,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
            // $date = str_replace('/', '-', $request->trandate);
            // $fromdate= date('Y-m-d', strtotime($date));
            // $date2 = str_replace('/', '-', $request->todate);
            // $todate= date('Y-m-d', strtotime($date2));
            if($startdate_eq_enddate==false){
                $sumamount=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('status',1)->whereNull('thai_amt')->where('user_id',$request->userid)
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                        $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                    });
                })->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                $sumcuscharge=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('status',1)->whereNull('thai_amt')->where('user_id',$request->userid)
                ->where(function($q){
                    $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                        $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                    });
                })->select('cuscharge_currency_id', DB::raw('SUM(cuscharge) as cuscharge'))->groupBy('cuscharge_currency_id')->get();
                foreach($sumamount as $tr)
                {



                    $utr=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$predate,
                        'dd'=> $predate,
                        'tt'=>'',
                        'ttint'=>0,
                        'user_id'=>$request->userid,
                        'tranname'=>'Total Transfer Amount', //. $notetext,
                        //'tranname'=>$tr->partner->name . $tr->note,
                        'desr'=>$notedate,
                        'note'=>$notedate,
                        'usd'=> $tr->currency->shortcut=='USD'?$tr->amount:0,
                        'khr'=> $tr->currency->shortcut=='KHR'?$tr->amount:0,
                        'thb'=> $tr->currency->shortcut=='THB'?$tr->amount:0,
                        'vnd'=> $tr->currency->shortcut=='VND'?$tr->amount:0,
                        'gold'=> $tr->currency->shortcut=='GOLD'?$tr->amount:0,
                        'fn'=> 0,
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>0,
                        'ref_number'=>'',
                        'ref_group_id'=>'',
                        'tablename'=>'partner_transfers',
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr);


                }
                 foreach($sumcuscharge as $tr)
                {
                    $utr=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$predate,
                        'dd'=> $predate,
                        'tt'=>'',
                        'ttint'=>0,
                        'user_id'=>$request->userid,
                        'tranname'=>'Total Transfer Cuscharge', //. $notetext,
                        //'tranname'=>$tr->partner->name . $tr->note,
                        'desr'=>$notedate,
                        'note'=>$notedate,
                        'usd'=> $tr->cuschargecur->shortcut=='USD'?$tr->cuscharge:0,
                        'khr'=> $tr->cuschargecur->shortcut=='KHR'?$tr->cuscharge:0,
                        'thb'=> $tr->cuschargecur->shortcut=='THB'?$tr->cuscharge:0,
                        'vnd'=> $tr->cuschargecur->shortcut=='VND'?$tr->cuscharge:0,
                        'gold'=> $tr->cuschargecur->shortcut=='GOLD'?$tr->cuscharge:0,
                        'fn'=> 0,
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>0,
                        'ref_number'=>'',
                        'ref_group_id'=>'',
                        'tablename'=>'partner_transfers',
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr);


                }
                 $cuscharge_useraffect=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $predate))->where('status',1)->where('iscutwater',0)->where('user_affect',$request->userid)->where('trancode',4)->where('cuscharge','<>',0)
                ->select('cuscharge_currency_id', DB::raw('SUM(cuscharge) as cuscharge'))->groupBy('cuscharge_currency_id')->get();
               foreach($cuscharge_useraffect as $tr)
                {
                    $utr=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$predate,
                        'dd'=> $predate,
                        'tt'=>'',
                        'ttint'=>0,
                        'user_id'=>$request->userid,
                        'tranname'=>'Total Transfer Cuscharge UserAffect', //. $notetext,
                        //'tranname'=>$tr->partner->name . $tr->note,
                        'desr'=>$notedate,
                        'note'=>$notedate,
                        'usd'=> $tr->cuschargecur->shortcut=='USD'?$tr->cuscharge:0,
                        'khr'=> $tr->cuschargecur->shortcut=='KHR'?$tr->cuscharge:0,
                        'thb'=> $tr->cuschargecur->shortcut=='THB'?$tr->cuscharge:0,
                        'vnd'=> $tr->cuschargecur->shortcut=='VND'?$tr->cuscharge:0,
                        'gold'=> $tr->cuschargecur->shortcut=='GOLD'?$tr->cuscharge:0,
                        'fn'=> 0,
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>0,
                        'ref_number'=>'',
                        'ref_group_id'=>'',
                        'tablename'=>'partner_transfers',
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr);


                }
            }

            $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)->whereNull('thai_amt')->where('user_id',$request->userid)
            ->where(function($q){
                $q->where('trancode',1)->orWhere(function($q1){//បើកវេរវីង
                    $q1->where('trancode',-1)->where('iscashdraw',1)->whereNull('cashdraw_id')->where('location_id',3);
                });
            })->orderBy('id')->get();

            foreach($transfers as $tr)
            {
                $sender='';
                $receiver='';
                $desr='';

                if($tr->sendertel){
                    $sender=$tr->sendertel;
                }
                if($tr->sendername){
                    if($sender!=''){
                        $sender .='|'. $tr->sendername;
                    }else{
                        $sender = $tr->sendername;
                    }
                }

                if($tr->rectel){
                    $receiver= $tr->rectel;
                }
                if($tr->recname){
                    if($receiver!=''){
                        $receiver .='|'. $tr->recname;
                    }else{
                        $receiver =$tr->recname;
                    }
                }
                if($receiver<>''){
                  $receiver='(' . $receiver . ')';
                }
                if($sender<>''){
                  $sender='(' . $sender . ')';
                }
                // $desr='វេរទៅ ' . $tr->partner->name . ' ' . $receiver . $sender;
                $desr=$tr->note . $receiver  . $sender ;

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$tr->created_at,
                    'dd'=> $tr->dd,
                    'tt'=>$tr->tt,
                    'ttint'=>$this->convertimetoint($tr->tt),
                    'user_id'=>$tr->user_id,
                    'tranname'=>$tr->tranname, //. $notetext,
                    //'tranname'=>$tr->partner->name . $tr->note,
                    'desr'=>$desr,
                    'note'=>$tr->note,
                    'usd'=> $tr->currency->shortcut=='USD'?$tr->amount:0,
                    'khr'=> $tr->currency->shortcut=='KHR'?$tr->amount:0,
                    'thb'=> $tr->currency->shortcut=='THB'?$tr->amount:0,
                    'vnd'=> $tr->currency->shortcut=='VND'?$tr->amount:0,
                    'gold'=> $tr->currency->shortcut=='GOLD'?$tr->amount:0,
                    'fn'=> 0,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>$tr->id,
                    'ref_number'=>$tr->ref_number,
                    'ref_group_id'=>$tr->ref_group_id,
                    'tablename'=>'partner_transfers',
                    'issum'=>1,
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);

                if($tr->cuscharge<>0){
                    $utr1=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$tr->created_at,
                        'dd'=> $tr->dd,
                        'tt'=>$tr->tt,
                        'ttint'=>$this->convertimetoint($tr->tt),
                        'user_id'=>$tr->user_id,
                        'tranname'=>'សេវ៉ា', //. $notetext,
                        //'tranname'=>$tr->partner->name . $tr->note,
                        'desr'=>$desr,
                        'note'=>$tr->note,
                        'usd'=> $tr->cuschargecur->shortcut=='USD'?$tr->cuscharge:0,
                        'khr'=> $tr->cuschargecur->shortcut=='KHR'?$tr->cuscharge:0,
                        'thb'=> $tr->cuschargecur->shortcut=='THB'?$tr->cuscharge:0,
                        'vnd'=> $tr->cuschargecur->shortcut=='VND'?$tr->cuscharge:0,
                        'gold'=> $tr->cuschargecur->shortcut=='GOLD'?$tr->cuscharge:0,
                        'fn'=> 0,
                        'shortcut'=>'',
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>$tr->id,
                        'ref_number'=>$tr->ref_number,
                        'ref_group_id'=>$tr->ref_group_id,
                        'tablename'=>'partner_transfers',
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr1);
                }
            }


            $cuscharge_useraffect=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($startdate, $enddate))->where('status',1)->where('iscutwater',0)->where('user_affect',$request->userid)->where('trancode',4)->where('cuscharge','<>',0)->orderBy('id')->get();
               foreach($cuscharge_useraffect as $tr)
            {
                $sender='';
                $receiver='';
                $desr='';

                if($tr->sendertel){
                    $sender=$tr->sendertel;
                }
                if($tr->sendername){
                    if($sender!=''){
                        $sender .='|'. $tr->sendername;
                    }else{
                        $sender = $tr->sendername;
                    }
                }

                if($tr->rectel){
                    $receiver= $tr->rectel;
                }
                if($tr->recname){
                    if($receiver!=''){
                        $receiver .='|'. $tr->recname;
                    }else{
                        $receiver =$tr->recname;
                    }
                }
                if($receiver<>''){
                  $receiver='(' . $receiver . ')';
                }
                if($sender<>''){
                  $sender='(' . $sender . ')';
                }
                // $desr='វេរទៅ ' . $tr->partner->name . ' ' . $receiver . $sender;
                $desr=$tr->note . $receiver  . $sender ;



                if($tr->cuscharge<>0){
                    $utr2=array(
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$tr->created_at,
                        'dd'=> $tr->dd,
                        'tt'=>$tr->tt,
                        'ttint'=>$this->convertimetoint($tr->tt),
                        'user_id'=>$tr->user_id,
                        'tranname'=>'សេវ៉ា', //. $notetext,
                        //'tranname'=>$tr->partner->name . $tr->note,
                        'desr'=>$desr,
                        'note'=>$tr->note,
                        'usd'=> $tr->cuschargecur->shortcut=='USD'?$tr->cuscharge:0,
                        'khr'=> $tr->cuschargecur->shortcut=='KHR'?$tr->cuscharge:0,
                        'thb'=> $tr->cuschargecur->shortcut=='THB'?$tr->cuscharge:0,
                        'vnd'=> $tr->cuschargecur->shortcut=='VND'?$tr->cuscharge:0,
                        'gold'=> $tr->cuschargecur->shortcut=='GOLD'?$tr->cuscharge:0,
                        'fn'=> 0,
                        'shortcut'=>'',
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>$tr->id,
                        'ref_number'=>$tr->ref_number,
                        'ref_group_id'=>$tr->ref_group_id,
                        'tablename'=>'partner_transfers',
                        'issum'=>1,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                    UserTransactionReport::insert($utr2);
                }
            }


    }
    public function sum_dotransfertransaction(Request $request,$showall,$mode,$timeint)
    {
        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname='';
        $tablename='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        // $user_customer=[];
        // $user=User::find($request->userid);
        // if($user){
        //     $user_customer=explode(',',$user->customer_connect);
        // }

         if($request->isinputdate=='true'){
            if($mode==0){
                $tranname='សរុបលុយវេរតាមខេត្ត';
                $tablename='partner_transfers_mode0';
                $mekun=1;
                $transfers=PartnerTransfer::where('user_id',$request->userid)->whereNull('thai_amt')->whereNull('user_affect')->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('trancode',1)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            }elseif($mode==1){//thai cashdraw bank out
                $tablename='partner_transfers_mode1';
                $tranname='សរុបបើកលុយថៃបន្តតាមធនាគា';
                $mekun=-1;
                // $transfers=PartnerTransfer::where('docodeby',$request->userid)->where('trancode',1)->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $transfers=PartnerTransfer::whereNotNull('docodeby')->where('trancode',1)->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

            }elseif($mode==-4){//bank receive
                $tablename='partner_transfers_mode-4';
                $tranname='សរុបលុយបាញ់ចូល';
                $mekun=-1;
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $userid=$request->userid;
                $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',-1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);
                    });
                })
                ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

            }elseif($mode==4){//bank transfer
                $tablename='partner_transfers_mode4';
                $tranname='សរុបលុយបាញ់ចេញ';
                $mekun=-1;
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $userid=$request->userid;
                $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)
                 ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                    });
                })
                ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
            }

        }else{
            if($mode==0){
                $tablename='partner_transfers_mode0';
                $tranname='សរុបលុយវេរតាមខេត្ត';
                $mekun=1;
                $transfers=PartnerTransfer::where('user_id',$request->userid)->whereNull('thai_amt')->whereNull('user_affect')->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('trancode',1)->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            }elseif($mode==1){//thai cashdraw bank out
                $tablename='partner_transfers_mode1';
                $tranname='សរុបបើកលុយថៃបន្តតាមធនាគា';
                $mekun=-1;
                // $transfers=PartnerTransfer::where('docodeby',$request->userid)->where('trancode',1)->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $transfers=PartnerTransfer::whereNotNull('docodeby')->where('trancode',1)->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

            }elseif($mode==-4){//bank receive
                $tablename='partner_transfers_mode-4';
                $tranname='សរុបលុយបាញ់ចូល';
                $mekun=-1;

                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[-1,-4])->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $userid=$request->userid;
                $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',-4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',-1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                    })->orWhere(function($q3) use($userid){
                        $q3->where('trancode',-1)->where('user_affect',$userid)->where('cashdraw_id','>',0);
                    });
                })
                ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

            }elseif($mode==4){//bank transfer
                $tablename='partner_transfers_mode4';
                $tranname='សរុបលុយបាញ់ចេញ';
                $mekun=-1;
                $userid=$request->userid;
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->whereIn('parrent_id',$user_customer)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                //$transfers=PartnerTransfer::whereNull('thai_amt')->whereIn('trancode',[1,4])->where('user_affect',$request->userid)->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();
                $transfers=PartnerTransfer::whereNull('thai_amt')->whereBetween(DB::raw('DATE(dd)'), array($trandate, $trandate2))->where('status',1)
                ->where(function($q) use($userid){
                    $q->where(function($q1) use($userid){
                        $q1->where('trancode',4)->where('user_affect',$userid);
                    })->orWhere(function($q2) use($userid){
                        $q2->where('trancode',1)->where('user_affect',$userid)->where('user_id','<>',$userid);
                    });
                })
                ->select(DB::raw('currency_id,sum(amount+fee) as tamt'))->groupBy('currency_id')->get();

            }

        }

            foreach($transfers as $tr)
            {
                if($tr->currency->shortcut=='USD'){
                    $usd=$tr->tamt;
                }elseif($tr->currency->shortcut=='KHR'){
                    $khr=$tr->tamt;
                }elseif($tr->currency->shortcut=='THB'){
                    $thb=$tr->tamt;
                }elseif($tr->currency->shortcut=='VND'){
                    $vnd=$tr->tamt;
                }elseif($tr->currency->shortcut=='GOLD'){
                    $gold=$tr->tamt;
                }else{
                    $fn=$tr->tamt;
                    $shortcut=$tr->currency->shortcut;
                    UserTransactionReport::insert([
                        'viewby'=>Auth::user()->name,
                        'inputdate'=>$trandate,
                        'dd'=> $trandate,
                        'tt'=>'',
                        'ttint'=>$timeint,
                        'user_id'=>$request->userid,
                        'tranname'=>$tranname,
                        'desr'=>'',
                        'note'=>'',
                        'usd'=>'0',
                        'khr'=>'0',
                        'thb'=>'0',
                        'vnd'=>'0',
                        'gold'=>'0',
                        'fn'=> $mekun * floatval($fn),
                        'shortcut'=>$shortcut,
                        'theylack'=>'0',
                        'welack'=>'0',
                        'paybybank'=>'0',
                        'link_id'=>'0',
                        'ref_number'=>'',
                        'ref_group_id'=>'',
                        'tablename'=>$tablename,
                        'issum'=>'1',
                        'created_at'=>$current,
                        'updated_at'=>$current
                    ]);

                }
            }

            UserTransactionReport::insert([
                'viewby'=>Auth::user()->name,
                'inputdate'=>$trandate,
                'dd'=> $trandate,
                'tt'=>'',
                'ttint'=>$timeint,
                'user_id'=>$request->userid,
                'tranname'=>$tranname,
                'desr'=>'',
                'note'=>'',
                'usd'=> $mekun * floatval($usd),
                'khr'=> $mekun * floatval($khr),
                'thb'=> $mekun * floatval($thb),
                'vnd'=> $mekun * floatval($vnd),
                'gold'=> $mekun * floatval($gold),
                'fn'=>'0',
                'shortcut'=>'',
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>'',
                'ref_number'=>'',
                'ref_group_id'=>'',
                'tablename'=>$tablename,
                'issum'=>'1',
                'created_at'=>$current,
                'updated_at'=>$current
            ]);



        if($mode==0){
            $usd=0;
            $khr=0;
            $thb=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $shortcut='';
            $tranname='សរុបសេវ៉ាវេរតាមខេត្ត';
            $tablename='partner_transfers_cuscharge0';
            if($request->isinputdate=='true'){
                $cuscharges=PartnerTransfer::where('user_id',$request->userid)->whereNull('thai_amt')->whereDate('created_at',$trandate)->where('trancode',1)->where('status',1)->select(DB::raw('cuscharge_currency_id,sum(cuscharge) as tcharge'))->groupBy('cuscharge_currency_id')->get();
            }else{
                $cuscharges=PartnerTransfer::where('user_id',$request->userid)->whereNull('thai_amt')->whereDate('dd',$trandate)->where('trancode',1)->where('status',1)->select(DB::raw('cuscharge_currency_id,sum(cuscharge) as tcharge'))->groupBy('cuscharge_currency_id')->get();
            }
            if($cuscharges->count()>0){
                foreach($cuscharges as $ch)
                {
                    if($ch->cuschargecur->shortcut=='USD'){
                        $usd=$ch->tcharge;
                    }elseif($ch->cuschargecur->shortcut=='KHR'){
                        $khr=$ch->tcharge;
                    }elseif($ch->cuschargecur->shortcut=='THB'){
                        $thb=$ch->tcharge;
                    }elseif($ch->cuschargecur->shortcut=='VND'){
                        $vnd=$ch->tcharge;
                    }elseif($ch->cuschargecur->shortcut=='GOLD'){
                        $gold=$ch->tcharge;
                    }else{
                        $fn=$ch->tcharge;
                        $shortcut=$tr->cuschargecur->shortcut;
                    }
                }

                   UserTransactionReport::insert([
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$trandate,
                    'dd'=> $trandate,
                    'tt'=>'',
                    'ttint'=>$timeint+1,
                    'user_id'=>$request->userid,
                    'tranname'=>$tranname,
                    'desr'=>'',
                    'note'=>'',
                    'usd'=>floatval($usd),
                    'khr'=>floatval($khr),
                    'thb'=>floatval($thb),
                    'vnd'=>floatval($vnd),
                    'gold'=>floatval($gold),
                    'fn'=>floatval($fn),
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>'0',
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>$tablename,
                    'issum'=>'1',
                    'created_at'=>$current,
                    'updated_at'=>$current
                   ]);
            }

        }



    }
    public function docashdrawtransaction(Request $request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        // $cashdraws=Cashdraw::where('user_id',$request->userid)->whereDate('opdate',$trandate)->where('status',1)->where('paymethod','Cash')->get();
        if($startdate_eq_enddate==false)
        {
            if($request->isinputdate=='true'){
                $sumcashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                $sumcharges=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('status',1)->select('cuscharge_currency_id', DB::raw('SUM(customer_charge) as cuscharge'))->groupBy('cuscharge_currency_id')->get();
            }else{
                $sumcashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $predate))->where('status',1)->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
                $sumcharges=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $predate))->where('status',1)->select('cuscharge_currency_id', DB::raw('SUM(customer_charge) as cuscharge'))->groupBy('cuscharge_currency_id')->get();
            }
            foreach($sumcashdraws as $tr)
            {
                if($tr->currency->shortcut=='USD'){
                    $usd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='KHR'){
                    $khr=floatval($tr->amount);
                }else if($tr->currency->shortcut=='THB'){
                    $thb=floatval($tr->amount);
                }else if($tr->currency->shortcut=='VND'){
                    $vnd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='GOLD'){
                    $gold=floatval($tr->amount);
                }else{
                    $fn=floatval($tr->amount);
                    $shortcut=$tr->currency->shortcut;
                }


                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Cashdraw',
                    'desr'=>$notedate,
                    'note'=> $notedate,
                    'usd'=>-1*$usd,
                    'khr'=>-1*$khr,
                    'thb'=>-1*$thb,
                    'vnd'=>-1*$vnd,
                    'gold'=>-1*$gold,
                    'fn'=>-1*$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>'cashdraws',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $shortcut='';

            }
             foreach($sumcharges as $tr)
            {
                if($tr->cuschargecur->shortcut=='USD'){
                    $usd=floatval($tr->cuscharge);
                }else if($tr->cuschargecur->shortcut=='KHR'){
                    $khr=floatval($tr->cuscharge);
                }else if($tr->cuschargecur->shortcut=='THB'){
                    $thb=floatval($tr->cuscharge);
                }else if($tr->cuschargecur->shortcut=='VND'){
                    $vnd=floatval($tr->cuscharge);
                }else if($tr->cuschargecur->shortcut=='GOLD'){
                    $gold=floatval($tr->cuscharge);
                }else{
                    $fn=floatval($tr->cuscharge);
                    $shortcut=$tr->cuschargecur->shortcut;
                }

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Cashdraw CusCharge',
                    'desr'=>$notedate,
                    'note'=> $notedate,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>'cashdraws',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $shortcut='';

            }
        }
        if($request->isinputdate=='true'){
            $cashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)->orderBy('id')->get();
        }else{
            $cashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($startdate, $enddate))->where('status',1)->orderBy('id')->get();
        }

        foreach($cashdraws as $tr)
        {
            if($tr->customer_charge && $tr->customer_charge<>0){
                if($tr->currency_id==$tr->cuscharge_currency_id){
                    $samecur=1;
                }else{
                    $samecur=0;
                }
            }else{
                $samecur=1;
            }
            if($tr->currency_id==$tr->cuscharge_currency_id){

                if($tr->currency->shortcut=='USD'){
                    $usd=floatval($tr->amount)-floatval($tr->customer_charge);
                }else if($tr->currency->shortcut=='KHR'){
                    $khr=floatval($tr->amount)-floatval($tr->customer_charge);
                }else if($tr->currency->shortcut=='THB'){
                    $thb=floatval($tr->amount)-floatval($tr->customer_charge);
                }else if($tr->currency->shortcut=='VND'){
                    $vnd=floatval($tr->amount)-floatval($tr->customer_charge);
                }else if($tr->currency->shortcut=='GOLD'){
                    $gold=floatval($tr->amount)-floatval($tr->customer_charge);
                }else{
                    $fn=floatval($tr->amount)-floatval($tr->customer_charge);
                    $shortcut=$tr->currency->shortcut;
                }
            }else{

                if($tr->currency->shortcut=='USD'){
                    $usd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='KHR'){
                    $khr=floatval($tr->amount);
                }else if($tr->currency->shortcut=='THB'){
                    $thb=floatval($tr->amount);
                }else if($tr->currency->shortcut=='VND'){
                    $vnd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='GOLD'){
                    $gold=floatval($tr->amount);
                }else{
                    $fn=floatval($tr->amount);
                    $shortcut=$tr->currency->shortcut;
                }

            }

            $receiver='';
            $desr='';
            $tranname='';
            if($tr->receive_tel){
                $receiver='អ្នកទទួល' . $tr->receive_tel;
            }
            if($tr->receive_name){
                if($receiver!=''){
                    $receiver .= $tr->receive_name;
                }else{
                    $receiver ='អ្នកទទួល' . $tr->receive_name;
                }
            }
            $desr=$tr->other . ' ' . $receiver ;
            if($tr->customer_charge<>0){
              $tranname='បើកវេរ' . $tr->frompartner->name .'(ដកសេវ៉ា'. $this->phpformatnumber($tr->customer_charge) . $tr->cuschargecur->sk .')';
            }else{
              $tranname='បើកវេរ' . $tr->frompartner->name;
            }
            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$tr->created_at,
                'dd'=> $tr->opdate,
                'tt'=>$tr->optime,
                'ttint'=>$this->convertimetoint($tr->optime),
                'user_id'=>$tr->user_id,
                'tranname'=>$tranname,
                'desr'=>$desr,
                'note'=> $tr->other . ' ' . $tr->note,
                'usd'=>-1*$usd,
                'khr'=>-1*$khr,
                'thb'=>-1*$thb,
                'vnd'=>-1*$vnd,
                'gold'=>-1*$gold,
                'fn'=>-1*$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$tr->id,
                'ref_number'=>$tr->ref_number,
                'ref_group_id'=>$tr->ref_group_id,
                'tablename'=>'cashdraws',
                'created_at'=>$current,
                'updated_at'=>$current
                );
            UserTransactionReport::insert($utr);
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $shortcut='';
            if($samecur==0){
                if($tr->cuschargecur->shortcut=='USD'){
                    $usd=$tr->customer_charge;
                }else if($tr->cuschargecur->shortcut=='THB'){
                    $thb=$tr->customer_charge;
                }else if($tr->cuschargecur->shortcut=='KHR'){
                    $khr=$tr->customer_charge;
                }else if($tr->cuschargecur->shortcut=='VND'){
                    $vnd=$tr->customer_charge;
                }
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$tr->created_at,
                    'dd'=> $tr->opdate,
                    'tt'=>$tr->optime,
                    'ttint'=>$this->convertimetoint($tr->optime),
                    'user_id'=>$tr->user_id,
                    'tranname'=>'បើកវេរដកសេវ៉ា',
                    'desr'=>$desr,
                    'note'=> $tr->other . ' ' . $tr->note,
                    'usd'=>$usd,
                    'khr'=>$khr,
                    'thb'=>$thb,
                    'vnd'=>$vnd,
                    'gold'=>$gold,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>$tr->id,
                    'ref_number'=>$tr->ref_number,
                    'ref_group_id'=>$tr->ref_group_id,
                    'tablename'=>'cashdraws',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $shortcut='';
            }

        }



    }
    public function sum_docashdrawtransaction(Request $request,$timeint)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname='សរុបបើកវេរតាមខេត្ត';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        if($request->isinputdate=='true'){
            $cashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt,sum(customer_charge) as tcuscharge'))->groupBy('currency_id')->get();
        }else{
            $cashdraws=Cashdraw::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($trandate, $trandate2))->where('status',1)->select(DB::raw('currency_id,sum(amount) as tamt,sum(customer_charge) as tcuscharge'))->groupBy('currency_id')->get();
        }

        foreach($cashdraws as $tr)
        {

            if($tr->currency->shortcut=='USD'){
                $usd=floatval($tr->tamt)-floatval($tr->tcuscharge);
            }else if($tr->currency->shortcut=='KHR'){
                $khr=floatval($tr->tamt)-floatval($tr->tcuscharge);
            }else if($tr->currency->shortcut=='THB'){
                $thb=floatval($tr->tamt)-floatval($tr->tcuscharge);
            }else if($tr->currency->shortcut=='VND'){
                $vnd=floatval($tr->tamt)-floatval($tr->tcuscharge);
            }else if($tr->currency->shortcut=='GOLD'){
                $gold=floatval($tr->tamt)-floatval($tr->tcuscharge);
            }else{
                $fn=floatval($tr->tamt)-floatval($tr->tcuscharge);
                $shortcut=$tr->currency->shortcut;
                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$trandate,
                    'dd'=> $trandate,
                    'tt'=>'',
                    'ttint'=>$timeint,
                    'user_id'=>$request->userid,
                    'tranname'=>$tranname,
                    'desr'=>'',
                    'note'=>'',
                    'usd'=>0,
                    'khr'=>0,
                    'thb'=>0,
                    'vnd'=>0,
                    'gold'=>0,
                    'fn'=>$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>'cashdraws',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);

            }
        }

        $utr=array(
            'viewby'=>Auth::user()->name,
            'inputdate'=>$trandate,
            'dd'=> $trandate,
            'tt'=>'',
            'ttint'=>$timeint,
            'user_id'=>$request->userid,
            'tranname'=>$tranname,
            'desr'=>'',
            'note'=>'',
            'usd'=>-1*$usd,
            'khr'=>-1*$khr,
            'thb'=>-1*$thb,
            'vnd'=>-1*$vnd,
            'gold'=>-1*$gold,
            'fn'=>0,
            'shortcut'=>'',
            'theylack'=>'0',
            'welack'=>'0',
            'paybybank'=>'0',
            'link_id'=>0,
            'ref_number'=>'',
            'ref_group_id'=>'',
            'tablename'=>'cashdraws',
            'created_at'=>$current,
            'updated_at'=>$current
            );
        UserTransactionReport::insert($utr);

    }
    public function dothaicashdrawtransaction(Request $request,$fromdate,$predate,$startdate,$enddate,$notedate,$startdate_eq_enddate)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $date = str_replace('/', '-', $request->trandate);
        // $trandate= date('Y-m-d', strtotime($date));
        // $date2 = str_replace('/', '-', $request->todate);
        // $trandate2= date('Y-m-d', strtotime($date2));
        // $cashdraws=Cashdraw::where('user_id',$request->userid)->whereDate('opdate',$trandate)->where('status',1)->where('paymethod','Cash')->get();
        if($startdate_eq_enddate==false){
            if($request->isinputdate=='true'){
                $sum=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($fromdate, $predate))->where('status',1)->where('paymethod','Cash')->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
            }else{
                $sum=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($fromdate, $predate))->where('status',1)->where('paymethod','Cash')->select('currency_id', DB::raw('SUM(amount) as amount'))->groupBy('currency_id')->get();
            }
            foreach($sum as $tr)
            {

                if($tr->currency->shortcut=='USD'){
                    $usd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='KHR'){
                    $khr=floatval($tr->amount);
                }else if($tr->currency->shortcut=='THB'){
                    $thb=floatval($tr->amount);
                }else if($tr->currency->shortcut=='VND'){
                    $vnd=floatval($tr->amount);
                }else if($tr->currency->shortcut=='GOLD'){
                    $gold=floatval($tr->amount);
                }else{
                    $fn=floatval($tr->amount);
                    $shortcut=$tr->currency->shortcut;
                }

                $utr=array(
                    'viewby'=>Auth::user()->name,
                    'inputdate'=>$predate,
                    'dd'=> $predate,
                    'tt'=>'',
                    'ttint'=>0,
                    'user_id'=>$request->userid,
                    'tranname'=>'Total Thai Cashdraw By Cash',
                    'desr'=>$notedate,
                    'note'=> $notedate,
                    'usd'=>-1*$usd,
                    'khr'=>-1*$khr,
                    'thb'=>-1*$thb,
                    'vnd'=>-1*$vnd,
                    'gold'=>-1*$gold,
                    'fn'=>-1*$fn,
                    'shortcut'=>$shortcut,
                    'theylack'=>'0',
                    'welack'=>'0',
                    'paybybank'=>'0',
                    'link_id'=>0,
                    'ref_number'=>'',
                    'ref_group_id'=>'',
                    'tablename'=>'sms_processes',
                    'created_at'=>$current,
                    'updated_at'=>$current
                    );
                UserTransactionReport::insert($utr);
                $usd=0;
                $thb=0;
                $khr=0;
                $vnd=0;
                $gold=0;
                $fn=0;
                $shortcut='';

            }

        }
        if($request->isinputdate=='true'){
            $cashdraws=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($startdate, $enddate))->where('status',1)->where('paymethod','Cash')->orderBy('id')->get();
        }else{
            $cashdraws=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($startdate, $enddate))->where('status',1)->where('paymethod','Cash')->orderBy('id')->get();
        }

        foreach($cashdraws as $tr)
        {

            if($tr->currency->shortcut=='USD'){
                $usd=floatval($tr->amount);
            }else if($tr->currency->shortcut=='KHR'){
                $khr=floatval($tr->amount);
            }else if($tr->currency->shortcut=='THB'){
                $thb=floatval($tr->amount);
            }else if($tr->currency->shortcut=='VND'){
                $vnd=floatval($tr->amount);
            }else if($tr->currency->shortcut=='GOLD'){
                $gold=floatval($tr->amount);
            }else{
                $fn=floatval($tr->amount);
                $shortcut=$tr->currency->shortcut;
            }

            $receiver='';
            $desr='';
            $tranname='';
            if($tr->rectel){
                $receiver='អ្នកទទួល' . $tr->rectel;
            }
            if($tr->receive_name){
                if($receiver!=''){
                    $receiver .= $tr->recname;
                }else{
                    $receiver ='អ្នកទទួល' . $tr->recname;
                }
            }
            $desr=$tr->note . ' ' . $receiver ;

            $tranname='បើកវេរលុយថៃ' . $tr->thaisms->sendfrom;

            $utr=array(
                'viewby'=>Auth::user()->name,
                'inputdate'=>$tr->created_at,
                'dd'=> $tr->opdate,
                'tt'=>$tr->optime,
                'ttint'=>$this->convertimetoint($tr->optime),
                'user_id'=>$tr->user_id,
                'tranname'=>$tranname,
                'desr'=>$desr,
                'note'=> $tr->note,
                'usd'=>-1*$usd,
                'khr'=>-1*$khr,
                'thb'=>-1*$thb,
                'vnd'=>-1*$vnd,
                'gold'=>-1*$gold,
                'fn'=>-1*$fn,
                'shortcut'=>$shortcut,
                'theylack'=>'0',
                'welack'=>'0',
                'paybybank'=>'0',
                'link_id'=>$tr->id,
                'ref_number'=>'',
                'ref_group_id'=>$tr->group_id,
                'tablename'=>'sms_processes',
                'created_at'=>$current,
                'updated_at'=>$current
                );
            UserTransactionReport::insert($utr);
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $gold=0;
            $fn=0;
            $shortcut='';

        }
    }
    public function sum_dothaicashdrawtransaction(Request $request,$timeint)
    {

        $usd=0;
        $khr=0;
        $thb=0;
        $vnd=0;
        $fn=0;
        $gold=0;
        $shortcut='';
        $tranname='សរុបបើកវេរលុយថៃ';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $date2 = str_replace('/', '-', $request->todate);
        $trandate2= date('Y-m-d', strtotime($date2));
        if($request->isinputdate=='true'){
            $cashdraws=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(created_at)'), array($trandate, $trandate2))->where('status',1)->where('paymethod','Cash')->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }else{
            $cashdraws=SmsProcess::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(opdate)'), array($trandate, $trandate2))->where('status',1)->where('paymethod','Cash')->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }

        foreach($cashdraws as $tr)
        {

            if($tr->currency->shortcut=='USD'){
                $usd=floatval($tr->tamt);
            }else if($tr->currency->shortcut=='KHR'){
                $khr=floatval($tr->tamt);
            }else if($tr->currency->shortcut=='THB'){
                $thb=floatval($tr->tamt);
            }else if($tr->currency->shortcut=='VND'){
                $vnd=floatval($tr->tamt);
            }else if($tr->currency->shortcut=='GOLD'){
                $gold=floatval($tr->tamt);
            }else{
                $fn=floatval($tr->tamt);
                $shortcut=$tr->currency->shortcut;
            }
        }
        $utr=array(
            'viewby'=>Auth::user()->name,
            'inputdate'=>$trandate,
            'dd'=> $trandate,
            'tt'=>'',
            'ttint'=>$timeint,
            'user_id'=>$request->userid,
            'tranname'=>$tranname,
            'desr'=>'',
            'note'=>'',
            'usd'=>-1*$usd,
            'khr'=>-1*$khr,
            'thb'=>-1*$thb,
            'vnd'=>-1*$vnd,
            'gold'=>-1*$gold,
            'fn'=>0,
            'shortcut'=>'',
            'theylack'=>'0',
            'welack'=>'0',
            'paybybank'=>'0',
            'link_id'=>0,
            'ref_number'=>'',
            'ref_group_id'=>'',
            'tablename'=>'sms_processes',
            'created_at'=>$current,
            'updated_at'=>$current
            );
        UserTransactionReport::insert($utr);


    }
    public function gettrueenddingbalance(Request $request){
        $date = str_replace('/', '-', $request->showdate);
        $trandate= date('Y-m-d', strtotime($date));
        $cash=UserCapital::whereDate('trandate',$trandate)->where('user_id_affect',$request->userid)->where('status',1)->where('trancode',-2)->where('capital_type','cash')->orderBy('id')->get()->load('agentname','currency');
        $agent=UserCapital::whereDate('trandate',$trandate)->where('user_id_affect',$request->userid)->where('status',1)->where('trancode',-2)->where('capital_type','<>','cash')->orderBy('id')->get()->load('agentname','currency');

        return response()->json(['cash'=>$cash,'agent'=>$agent]);
    }

    public function gettrueenddingbalanceall(Request $request)
    {
        $date = str_replace('/', '-', $request->showdate);
        $trandate = date('Y-m-d', strtotime($date));
        $selcomid=Session('log_into_company_id');
        $endbals = DB::table('user_capitals as uc')
            ->join('users as u', 'uc.user_id_affect', '=', 'u.id')
            ->join('currencies as c', 'uc.currency_id', '=', 'c.id')
            ->whereDate('uc.trandate', $trandate)
            ->where('uc.status', 1)
            ->where('uc.trancode', -2)
            ->where('uc.company_id',$selcomid)
            ->select(DB::raw('u.id as user_id, u.name as user_name, c.shortcut as currency_code, SUM(uc.amount) as tamt'))
            ->groupBy('u.id', 'u.name', 'c.shortcut')
            ->get();

        // Step 1: Get all unique currency codes
        $allCurrencies = $endbals->pluck('currency_code')->unique()->values();

        // Step 2: Pivot the data with user_id and user_name
        $pivoted = $endbals->groupBy('user_id')->map(function ($group) use ($allCurrencies) {
            $user = $group->first();
            $row = [
                'user_id' => $user->user_id,
                'user_name' => $user->user_name,
            ];

            foreach ($allCurrencies as $currency) {
                $amount = $group->firstWhere('currency_code', $currency)->tamt ?? 0;
                $row[$currency] = $amount;
            }

            return $row;
        })->values();

        return response()->json([
            'currencies' => $allCurrencies,
            'endbals' => $pivoted
        ]);
    }

     public function capitalcontinueall(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->dd);
        $trandate= date('Y-m-d', strtotime($date));
        $date1 = str_replace('/', '-', $request->tomorrow);
        $tomorrow= date('Y-m-d', strtotime($date1));
        //$userid=$request->userid;
        $validator1 = Validator::make($request->all(), [
                'selected_users.*' => 'required',
        ]);
        if ($validator1->fails()) {
            return response()->json(['error'=>$validator1->errors()->all()]);
        }


        //return($request->all());
        $selectedUserIds = $request->input('selected_users');
        DB::table('user_capitals')->where('company_id',$selcomid)->whereDate('trandate',$tomorrow)->whereIn('continue_from_user_id',$selectedUserIds)->where('status',1)->where('trancode',2)->delete();
        if($request->isdel==1){
            return response()->json(['success'=>true,'message'=>'Delete selected user capital tomorrow completed']);
        }
        $usercapital=UserCapital::where('company_id',$selcomid)->whereDate('trandate',$trandate)->whereIn('user_id_affect',$selectedUserIds)->where('status',1)->where('trancode',-2)->orderBy('id')->get();
        foreach($usercapital as $uc){
            $uscp=array(
                'trandate'=>$tomorrow,
                'trantime'=> '05:00:00',
                'user_id'=>Auth::id(),
                'user_id_affect'=>$uc->user_id_affect,
                'continue_from_user_id'=>$uc->user_id_affect,
                'amount'=>abs($uc->amount),
                'currency_id'=>$uc->currency_id,
                'tranname'=>'លុយបន្តដើមគ្រា',
                'trancode'=>'2',
                'capital_type'=>$uc->capital_type,
                'agent_id'=>$uc->agent_id,
                'ref_number'=>'',
                'note'=>'បន្តពីថ្ងៃ ' . $date,
                'created_at'=>$current,
                'updated_at'=>$current,
                'company_id'=>$selcomid,
                );
              UserCapital::insert($uscp);
        }

        return response()->json(['success'=>true,'message'=>'save selected user capital tomorrow completed']);
    }


    public function capitalcontinue(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->dd);
        $trandate= date('Y-m-d', strtotime($date));
        $date1 = str_replace('/', '-', $request->tomorrow);
        $tomorrow= date('Y-m-d', strtotime($date1));
        //$userid=$request->userid;

         if($request->iscontinue){
            $validator1 = Validator::make($request->all(), [
                'usercontinue' => 'required',
            ]);
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $iscontinue = $request->iscontinue?1:0;
        if($iscontinue==1){
            $userid=$request->usercontinue;
        }else{
            $userid=$request->fromuser;
        }
        //return($request->all());
        DB::table('user_capitals')->where('company_id',$selcomid)->whereDate('trandate',$tomorrow)->where('continue_from_user_id',$request->fromuser)->where('status',1)->where('trancode',2)->delete();
        $usercapital=UserCapital::where('company_id',$selcomid)->whereDate('trandate',$trandate)->where('user_id_affect',$request->fromuser)->where('status',1)->where('trancode',-2)->orderBy('id')->get();
        foreach($usercapital as $uc){
            $uscp=array(
                'trandate'=>$tomorrow,
                'trantime'=> '05:00:00',
                'user_id'=>Auth::id(),
                'user_id_affect'=>$userid,
                'continue_from_user_id'=>$request->fromuser,
                'amount'=>abs($uc->amount),
                'currency_id'=>$uc->currency_id,
                'tranname'=>'លុយបន្តដើមគ្រា',
                'trancode'=>'2',
                'capital_type'=>$uc->capital_type,
                'agent_id'=>$uc->agent_id,
                'ref_number'=>'',
                'note'=>'បន្តពីថ្ងៃ ' . $date,
                'created_at'=>$current,
                'updated_at'=>$current,
                'company_id'=>$selcomid,
                );
              UserCapital::insert($uscp);
        }
        if($request->fromuser<>$request->usercontinue){
            //reset user capital to zero
            $usercapital1=UserCapital::where('company_id',$selcomid)->whereDate('trandate',$trandate)->where('user_id_affect',$request->fromuser)->where('status',1)->where('trancode',-2)->where('capital_type','cash')->orderBy('id')->get();
            foreach($usercapital1 as $uc){
                $uscp1=array(
                    'trandate'=>$tomorrow,
                    'trantime'=> '05:00:00',
                    'user_id'=>Auth::id(),
                    'user_id_affect'=>$request->fromuser,
                    'continue_from_user_id'=>$request->fromuser,
                    'amount'=>0,
                    'currency_id'=>$uc->currency_id,
                    'tranname'=>'លុយបន្តដើមគ្រា',
                    'trancode'=>'2',
                    'capital_type'=>$uc->capital_type,
                    'agent_id'=>$uc->agent_id,
                    'ref_number'=>'',
                    'note'=>'បន្តពីថ្ងៃ ' . $date,
                    'created_at'=>$current,
                    'updated_at'=>$current,
                    'company_id'=>$selcomid,
                    );
                  UserCapital::insert($uscp1);
            }
        }

        return response()->json(['success'=>true,'message'=>'save user capital tomorrow completed']);
    }
    public function savemoneyofferaccept(Request $request)
    {
        //return $request->all();
        return $this->storemoneyofferaccept2($request);
    }
    public function storemoneyofferaccept(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $accepttime = date("H:i:s",strtotime($current));
        $trdate = str_replace('/', '-', $request->offerdate_accept);
        $trandate= date('Y-m-d', strtotime($trdate));
        $uc1=new UserCapital();
        $uc1->trandate=$trandate;
        $uc1->trantime=$accepttime;
        $uc1->user_id=Auth::id();
        $uc1->user_id_affect=$request->usercashin_id;
        $uc1->amount=str_replace(',','',$request->amount3);
        $uc1->currency_id=$request->selcur3;
        $uc1->tranname='Cashin';
        $uc1->capital_type='cash';
        $uc1->trancode=1;
        $uc1->note='ស្នើពី'. $request->usercashout . $request->acceptnote;
        $uc1->ref_number='moneyoffer-'. $request->offer_id;
        $uc1->company_id=$selcomid;
        if($uc1->save())
        {
            $id1=$uc1->id;
            DB::table('user_offers')->where('id',$request->offer_id)->update(['isaccept'=>1,'accept_time'=>$accepttime,'accept_note'=>$request->acceptnote,'ref_number'=>$id1]);
            $uc2=new UserCapital();
            $uc2->trandate=$trandate;
            $uc2->trantime=$accepttime;
            $uc2->user_id=Auth::id();
            $uc2->user_id_affect=$request->selusercashout;
            $uc2->amount=-1 * floatval(str_replace(',','',$request->amount3));
            $uc2->currency_id=$request->selcur3;
            $uc2->tranname='Cashout';
            $uc2->trancode=-1;
            $uc2->capital_type='cash';
            $uc2->note= $request->usercashin . 'ស្នើ' . $request->usercashout . $request->acceptnote;
            $uc2->ref_number='moneyoffer-'. $request->offer_id;
            $uc2->company_id=$selcomid;
            if($uc2->save()){
                $id2=$uc2->id;
                DB::table('user_offers')->where('id',$request->offer_id)->update(['ref_number'=>$id1.'/'.$id2]);

            }
        }
        if($request->amount4){
            $uc3=new UserCapital();
            $uc3->trandate=$trandate;
            $uc3->trantime=$accepttime;
            $uc3->user_id=Auth::id();
            $uc3->user_id_affect=$request->usercashin_id;
            $uc3->amount=-1 * floatval(str_replace(',','',$request->amount4));
            $uc3->currency_id=$request->selcur4;
            $uc3->tranname='Cashout';
            $uc3->trancode=-1;
            $uc3->capital_type='cash';
            $uc3->note='លុយកាត់កង'. $request->usercashout . $request->acceptnote;
            $uc3->ref_number='moneyoffer-'. $request->offer_id;
            $uc3->company_id=$selcomid;
            if($uc3->save())
            {
                $id3=$uc3->id;
                DB::table('user_offers')->where('id',$request->offer_id)->update(['ref_number'=>$id1.'/'.$id2.'/'.$id3]);
                $uc4=new UserCapital();
                $uc4->trandate=$trandate;
                $uc4->trantime=$accepttime;
                $uc4->user_id=Auth::id();
                $uc4->user_id_affect=$request->selusercashout;
                $uc4->amount=floatval(str_replace(',','',$request->amount4));
                $uc4->currency_id=$request->selcur4;
                $uc4->tranname='Cashin';
                $uc4->trancode=1;
                $uc4->capital_type='cash';
                $uc4->note='លុយកាត់កងពេលស្នើ';
                $uc4->ref_number='moneyoffer-'. $request->offer_id;
                $uc4->company_id=$selcomid;
                if($uc4->save()){
                    $id4=$uc4->id;
                    DB::table('user_offers')->where('id',$request->offer_id)->update(['ref_number'=>$id1.'/'.$id2.'/'.$id3.'/'.$id4]);
                }
            }
        }
    }
    public function isAllowedToSave($id,$btn)
    {
        $offer = UserOffer::find($id);
        if (! $offer) {
            return false; // no offer → not allowed
        }
        if ($offer->status == 0) return false;
        if ($offer->isaccept == 1) return false;
        if($btn=='accept'){
            if (Auth::id() <> $offer->offer_to_user_id) return false;
        }

        return true; // ✅ all checks passed → allowed
    }

    public function storemoneyofferaccept2(Request $request)
    {

        //return $request->all();
        //check before save

        if (! $this->isAllowedToSave($request->offer_id,'accept')) {
            return response()->json(['error' => true, 'message' => 'This offer transaction is not allowed to save.']);
        }
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selusercashout' => 'required',
            'userreceive' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $trdate = str_replace('/', '-', $request->offerdate_accept);
        $trandate= date('Y-m-d', strtotime($trdate));

        $amt1=0;
        $amt2=0;
        $tranname1='';
        $tranname2='';
        $trancode1='';
        $trancode2='';
        $note1='';
        $note2='';
        //$trname='';
        $idtr1='0';
        $idtr2='0';

        $prefix='moneyoffer-';

        $amt2=str_replace(',','',$request->amount3);
        $amt1=-1 * floatval(str_replace(',','',$request->amount3));
        $tranname1=$request->sellistin==''?'Cash in':'Balance in';
        $tranname2=$request->sellistout==''?'Cash out':'Balance out';
        $trname1='បាញ់ចូល';
        $trname2='បាញ់ចេញ';
        $trancode1='-1';
        $trancode2='1';
        $note1='ដាក់អោយ: ' . $request->userreceive . '(' . $request->receivelist . ')';
        $note2='ទទួលពី: ' . $request->sender . '(' . $request->senderlist . ')';
        DB::beginTransaction();
        try{
            $uc=new UserCapital();
            $uc->trantime=$invtime;
            $uc->user_id=Auth::id();
            $uc->created_at=$current;
            $uc->company_id=$selcomid;
            $uc->trandate=$trandate;
            $uc->user_id_affect=$request->selusercashout;
            $uc->amount=$amt1;
            $uc->currency_id=$request->selcur3;
            $uc->tranname=$tranname2;
            $uc->trancode=$request->sellistout==''?$trancode1:floatval($trancode1)*4;
            $uc->note=$note1;
            $uc->note1='user money offer';
            $uc->ref_number='';
            $uc->action='';
            $uc->capital_type=$request->customertype1;
            $uc->agent_id=$request->sellistout;
            //$uc->location_id=3;
            $uc->user_reverse_id=$request->usercashin_id;
            $uc->agent_id_reverse=$request->sellistin;
            $uc->updated_at=$current;
            if($uc->save())
            {
                $id=$uc->id;
                $refnumber=$prefix . $id;
                $uc1=new UserCapital();
                $uc1->trantime=$invtime;
                $uc1->user_id=Auth::id();
                $uc1->created_at=$current;

                  $uc1->company_id=$selcomid;
                  $uc1->trandate=$trandate;
                  $uc1->user_id_affect=$request->usercashin_id;
                  $uc1->amount=$amt2;
                  $uc1->currency_id=$request->selcur3;
                  $uc1->tranname=$tranname1;
                  $uc1->trancode=$request->sellistin==''?$trancode2:floatval($trancode2)*4;
                  $uc1->note=$note2;
                  $uc1->note1='user money offer';
                  $uc1->ref_number=$refnumber;
                  $uc1->action='';
                  $uc1->capital_type=$request->customertype2;
                  $uc1->agent_id=$request->sellistin;
                  $uc1->agent_id_reverse=$request->sellistout;
                  //$uc1->location_id=3;
                  $uc1->user_reverse_id=$request->selusercashout;
                  $uc1->updated_at=$current;
                  if($uc1->save()){
                    $id6=$uc1->id;
                  }else{
                    $id6=0;
                  }
                  if($request->sellistin<>''){

                    $ptf=new PartnerTransfer();
                    $ptf->tt=$invtime;
                    $ptf->created_at=$current;

                      $ptf->company_id=$selcomid;
                      $ptf->tranname=$trname1;
                      $ptf->trancode=floatval($trancode1) * 4;
                      $ptf->dd=$trandate;
                      $ptf->mekun=$trancode1;
                      $ptf->user_id=Auth::id();
                      $ptf->parrent_id=$request->sellistin;
                      $ptf->amount=$amt1;
                      $ptf->currency_id=$request->selcur3;
                      $ptf->cuscharge=0;
                      $ptf->cuscharge_currency_id=$request->selcur3;
                      $ptf->fee=0;
                      $ptf->fee_currency_id=$request->selcur3;
                      $ptf->bonus=0;
                      $ptf->sendername='user money offer';
                      // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                      // $ptf->recname=$request->txtaccountname44;
                      // $ptf->rectel=str_replace(' ','',$request->txtaccountnumber44);
                     if($request->customertype2=='BANK' || $request->customertype2=='AGENT'){
                        $ptf->isbank=1;
                      }
                      $ptf->ref_number=$refnumber;
                      $ptf->ref_group_id=$refnumber;
                      $ptf->note=$note2;
                      $ptf->user_affect=$request->usercashin_id;
                      $ptf->updated_at=$current;
                      //$ptf->sendername=$request->noteu2;
                      if($ptf->save()){
                          $lastid=$ptf->id;
                          $idtr1=$ptf->id;
                      }else{
                          $idtr1=0;
                      }

                  }

                  if($request->sellistout<>'')
                  {

                    $ptf1=new PartnerTransfer();
                    $ptf1->tt=$invtime;
                    $ptf1->created_at=$current;
                      $ptf1->tranname=$trname2;
                      $ptf1->trancode=floatval($trancode2) * 4;
                      $ptf1->dd=$trandate;
                      $ptf1->company_id=$selcomid;
                      $ptf1->mekun=$trancode2;
                      $ptf1->user_id=Auth::id();
                      $ptf1->parrent_id=$request->sellistout;
                      $ptf1->amount=$amt2;
                      $ptf1->currency_id=$request->selcur3;
                      $ptf1->cuscharge=0;
                      $ptf1->cuscharge_currency_id=$request->selcur3;
                      $ptf1->fee=0;
                      $ptf1->fee_currency_id=$request->selcur3;
                      $ptf1->bonus=0;
                      $ptf->sendername='user offer money';
                      // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                      // $ptf1->recname=$request->txtaccountname44;
                      // $ptf1->rectel=str_replace(' ','',$request->txtaccountnumber44);
                      if($request->customertype1=='BANK' || $request->customertype1=='AGENT'){
                        $ptf1->isbank=1;
                      }
                      $ptf1->ref_number=$refnumber;
                      $ptf1->ref_group_id=$refnumber;
                      $ptf1->note=$note1;
                      $ptf1->updated_at=$current;
                      $ptf1->user_affect=$request->selusercashout;
                      //$ptf1->sendername=$request->noteu2;
                      if($ptf1->save()){
                          $idtr2=$ptf1->id;

                      }else{
                          $idtr2=0;
                      }
                  }

                DB::table('user_capitals')->where('id',$id)->update(['ref_number'=>$refnumber,'map_id'=>$id6,'transfer_id'=>$idtr1,'transfer_id2'=>$idtr2]);

            }else{
                DB::rollBack();
                return response()->json(['success'=> false , 'message' => 'save user balance in out fails']);
            }
            //save katkong
            if($request->amount4 && $request->amount4>0){
                $amt1=0;
                $amt2=0;
                $tranname1='';
                $tranname2='';
                $trancode1='';
                $trancode2='';
                $note1='';
                $note2='';
                //$trname='';
                $idtr1='0';
                $idtr2='0';

                $amt1=str_replace(',','',$request->amount4);
                $amt2=-1 * floatval(str_replace(',','',$request->amount4));
                $tranname1=$request->sellistin1==''?'Cash in':'Balance in';
                $tranname2=$request->sellistout1==''?'Cash out':'Balance out';
                $trname1='បាញ់ចូល';
                $trname2='បាញ់ចេញ';
                $trancode1='1';
                $trancode2='-1';
                $note1='ទទួលពី: ' . $request->userreceive . '(' . $request->sender_back_list . ')';
                $note2='ដាក់អោយ: ' . $request->receive_back . '(' . $request->receive_back_list . ')';

                $uc=new UserCapital();
                $uc->trantime=$invtime;
                $uc->user_id=Auth::id();
                $uc->created_at=$current;

                $uc->company_id=$selcomid;
                $uc->trandate=$trandate;
                $uc->user_id_affect=$request->selusercashin1;
                $uc->amount=$amt1;
                $uc->currency_id=$request->selcur4;
                $uc->tranname=$tranname1;
                $uc->trancode=$request->sellistin1==''?$trancode1:floatval($trancode1)*4;
                $uc->note=$note1;
                $uc->note1='user money offer';
                $uc->ref_number=$refnumber;
                $uc->action='';
                $uc->capital_type=$request->customertype3;
                $uc->agent_id=$request->sellistin1;
                //$uc->location_id=3;
                $uc->user_reverse_id=$request->usercashin_id;
                $uc->agent_id_reverse=$request->sellistout1;
                $uc->updated_at=$current;
                if($uc->save())
                {
                    $id=$uc->id;

                    $uc1=new UserCapital();
                    $uc1->trantime=$invtime;
                    $uc1->user_id=Auth::id();
                    $uc1->created_at=$current;

                    $uc1->company_id=$selcomid;
                    $uc1->trandate=$trandate;
                    $uc1->user_id_affect=$request->usercashin_id;
                    $uc1->amount=$amt2;
                    $uc1->currency_id=$request->selcur4;
                    $uc1->tranname=$tranname2;
                    $uc1->trancode=$request->sellistout1==''?$trancode2:floatval($trancode2)*4;
                    $uc1->note=$note2;
                    $uc1->note1='user money offer';
                    $uc1->ref_number=$refnumber;
                    $uc1->action='';
                    $uc1->capital_type=$request->customertype4;
                    $uc1->agent_id=$request->sellistout1;
                    $uc1->agent_id_reverse=$request->sellistin1;
                    //$uc1->location_id=3;
                    $uc1->user_reverse_id=$request->selusercashin1;
                    $uc1->updated_at=$current;
                    if($uc1->save()){
                        $id6=$uc1->id;
                    }else{
                        $id6=0;
                    }
                    if($request->sellistout1<>''){

                        $ptf=new PartnerTransfer();
                        $ptf->tt=$invtime;
                        $ptf->created_at=$current;

                        $ptf->company_id=$selcomid;
                        $ptf->tranname=$trname2;
                        $ptf->trancode=floatval($trancode1) * 4;
                        $ptf->dd=$trandate;
                        $ptf->mekun=$trancode1;
                        $ptf->user_id=Auth::id();
                        $ptf->parrent_id=$request->sellistout1;
                        $ptf->amount=$amt1;
                        $ptf->currency_id=$request->selcur4;
                        $ptf->cuscharge=0;
                        $ptf->cuscharge_currency_id=$request->selcur4;
                        $ptf->fee=0;
                        $ptf->fee_currency_id=$request->selcur4;
                        $ptf->bonus=0;
                        $ptf->sendername='user money offer';
                        // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                        // $ptf->recname=$request->txtaccountname44;
                        // $ptf->rectel=str_replace(' ','',$request->txtaccountnumber44);
                        $ptf->ref_number=$refnumber;
                        $ptf->note=$note2;
                        $ptf->user_affect=$request->usercashin_id;
                        $ptf->updated_at=$current;
                        //$ptf->sendername=$request->noteu2;
                        if($ptf->save()){
                            $lastid=$ptf->id;
                            $idtr1=$ptf->id;
                        }else{
                            $idtr1=0;
                        }

                    }

                    if($request->sellistin1<>'')
                    {

                        $ptf1=new PartnerTransfer();
                        $ptf1->tt=$invtime;
                        $ptf1->created_at=$current;


                        $ptf1->tranname=$trname1;
                        $ptf1->trancode=floatval($trancode2) * 4;
                        $ptf1->dd=$trandate;
                        $ptf1->company_id=$selcomid;
                        $ptf1->mekun=$trancode2;
                        $ptf1->user_id=Auth::id();
                        $ptf1->parrent_id=$request->sellistin1;
                        $ptf1->amount=$amt2;
                        $ptf1->currency_id=$request->selcur4;
                        $ptf1->cuscharge=0;
                        $ptf1->cuscharge_currency_id=$request->selcur4;
                        $ptf1->fee=0;
                        $ptf1->fee_currency_id=$request->selcur4;
                        $ptf1->bonus=0;
                        $ptf->sendername='user offer money';
                        // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                        // $ptf1->recname=$request->txtaccountname44;
                        // $ptf1->rectel=str_replace(' ','',$request->txtaccountnumber44);
                        $ptf1->ref_number=$refnumber;
                        $ptf1->note=$note1;
                        $ptf1->updated_at=$current;
                        $ptf1->user_affect=$request->selusercashin1;
                        //$ptf1->sendername=$request->noteu2;
                        if($ptf1->save()){
                            $idtr2=$ptf1->id;

                        }else{
                            $idtr2=0;
                        }
                    }

                    DB::table('user_capitals')->where('id',$id)->update(['ref_number'=>$refnumber,'map_id'=>$id6,'transfer_id'=>$idtr1,'transfer_id2'=>$idtr2]);

                }else{
                    return response()->json(['success'=> false , 'message' => 'save user balance in out fails']);
                }
            }
            DB::table('user_offers')->where('id',$request->offer_id)->update(['isaccept'=>1,'accept_time'=>$invtime,'accept_note'=>$request->acceptnote,'ref_number'=>$refnumber]);
            DB::commit();
            return response()->json(['success' => true,'message' => 'saved'],200);
        }catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false,'message' => $e->getMessage()], 500);
        }


    }
    public function updatemoneyoffer(Request $request)
    {
        //return $request->all();
        if (! $this->isAllowedToSave($request->offer_continue_id,'updateoffer')) {
            return response()->json(['success' => false, 'message' => 'This offer transaction is not allowed to save.']);
        }
        $offer=UserOffer::find($request->offer_continue_id);
        $offer->offer_to_user_id=$request->seluser_continue;
        if($offer->save()){
            return response()->json(['success'=>true,'message' => 'Update Completed']);
        }else{
            return response()->json(['success'=>false , 'message' => 'Update Fail']);
        }
    }

    public function savemoneyoffer(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'amount1' => 'required',
            'selcur1' => 'required',
            'seluser' => 'required',
            'useroffer_id'=>'required',
        ]);
        if($request->ckkatkong){
            $validator1 = Validator::make($request->all(), [
            'amount2' => 'required',
            'selcurkatkong' => 'required',
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->ckkatkong){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $offertime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->offerdate);
        $offerdate= date('Y-m-d', strtotime($date));
        $uf=new UserOffer();
        $uf->offer_date=$offerdate;
        $uf->offer_time=$offertime;
        $uf->offer_type=$request->offertype;
        $uf->customer_id=$request->sel_customer_id;
        $uf->offer_type1=$request->offertype1;
        $uf->customer_id1=$request->sel_customer_id1;
        $uf->offer_by_user_id=$request->useroffer_id;
        $uf->offer_to_user_id=$request->seluser;
        $uf->amount=str_replace(',','',$request->amount1);
        $uf->currency_id=$request->selcur1;
        if($request->ckkatkong){
            $uf->amount1=str_replace(',','',$request->amount2);
            $uf->currency_id1=$request->selcurkatkong;
        }
        $uf->created_at=$current;
        $uf->updated_at=$current;
        $uf->company_id=$selcomid;
        if($uf->save()){
            $id=$uf->id;
            return response()->json(['success'=>true,'message'=>'save successfully','id'=>$id]);
        }
    }
    public function store(Request $request)
    {
        //return $request->all();
        //$selcomid=Session('log_into_company_id');
        $selcomid=$request->selcompany1;
        $save=0;
        $validator = Validator::make($request->all(), [
            'seluserreceive' => 'required',
            //'selcur' => 'required',
            //'amount' => 'required',
        ]);
        if($request->trid>0){
            $validator1 = Validator::make($request->all(), [
                'selcur' => 'required',
                'amount' => 'required',
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->trid>0){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $ref_number='';
        if($request->agentid<>'' && $request->agentid<>'null' ){
            $ref_number='startbalance_partnerid-' . $request->useraccount;
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $sign=1;
        if($request->trmode<0){
            $sign=-1;
        }
        if($request->trid==0){
          $uc=new UserCapital();
          $uc->trantime=$invtime;
          $uc->user_id=Auth::id();
          $uc->created_at=$current;
          $uc->capital_type=$request->cashtype;
          $uc->agent_id=$request->useraccount;
          $uc->ref_number=$ref_number;
        }else{
          $uc=UserCapital::find($request->trid);
          $oldcur=$uc->currency->shortcut;
        }
        $uc->company_id=$selcomid;
        $uc->trandate=$trandate;
        $uc->user_id_affect=$request->seluserreceive;
        $uc->tranname=$request->tranname;
        $uc->trancode=$request->trmode;
        $uc->note=$request->note;
        $uc->updated_at=$current;
        $uc->location_id=1;
        //$uc->note1=$request->agentname;
        $uc->goldwater=(float) str_replace(',', '', $request->goldwater ?: 0);
        $uc->action='u,d';
        if($request->amount<>'' && $request->amount<>'0'){
          if($request->selcur<>''){
            $uc->amount=floatval($sign) * floatval(abs(str_replace(',','',$request->amount)));
            $uc->currency_id=$request->selcur;
            if($uc->save()){
              $save +=1;
            }
          }
        }
        $uc1=array(
          'trantime'=>$invtime,
          'user_id'=>Auth::id(),
          'created_at'=>$current,
          'trandate'=>$trandate,
          'user_id_affect'=>$request->seluserreceive,
          'tranname'=>$request->tranname,
          'trancode'=>$request->trmode,
          'note'=>$request->note,
          'updated_at'=>$current,
          'ref_number'=>$ref_number,
          'action'=>'u,d',
          'capital_type'=>$request->cashtype,
          //'note1'=>$request->agentname,
          'agent_id'=>$request->useraccount,
          'location_id'=>1,
          'company_id'=>$selcomid,
          'goldwater' => (float) str_replace(',', '', $request->goldwater ?: 0),
        );
        if($request->usd_amount<>'' && $request->usd_amount<>'0'){
          $amount=floatval($sign) * floatval(abs(str_replace(',','',$request->usd_amount)));
          $cur=$request->selcurusd;
          $uc1['amount']=$amount;
          $uc1['currency_id']=$cur;
          if(UserCapital::insert($uc1)){
            $save +=1;
          }
        }
        if($request->khr_amount<>'' && $request->khr_amount<>'0'){
          $amount=floatval($sign) * floatval(abs(str_replace(',','',$request->khr_amount)));
          $cur=$request->selcurkhr;
          $uc1['amount']=$amount;
          $uc1['currency_id']=$cur;
          if(UserCapital::insert($uc1)){
            $save +=1;
          }
        }
        if($request->thb_amount<>'' && $request->thb_amount<>'0'){
          $amount=floatval($sign) * floatval(abs(str_replace(',','',$request->thb_amount)));
          $cur=$request->selcurthb;
          $uc1['amount']=$amount;
          $uc1['currency_id']=$cur;
          if(UserCapital::insert($uc1)){
            $save +=1;
          }
        }
        if($save>0)
        {
            if($ref_number<>''){
                $maxtid=PartnerTransfer::where('status',1)->where('parrent_id',$request->agentid)->max('id');
                $maxeid=PartnerExchangeList::where('status',1)->where('partner_id',$request->agentid)->max('id');
                if($maxtid==null){
                    $maxtid=0;
                }
                if($maxeid==null){
                    $maxeid=0;
                }
                if($request->trmode==2){
                    $foundclose=PartnerCloseList::whereDate('closedate',$trandate)->where('partner_id',$request->agentid)->where('startcapital',1)->first();
                }else if($request->trmode==-2){
                    $foundclose=PartnerCloseList::whereDate('closedate',$trandate)->where('partner_id',$request->agentid)->where('startcapital',-1)->first();
                }
                if($foundclose){
                    //update
                    if($request->trid>0){
                        if($oldcur=='USD'){
                            $usd=-1 * floatval(str_replace(',','',$request->amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['usd'=>$usd]);
                        }else if($oldcur=='THB'){
                            $thb=-1 * floatval(str_replace(',','',$request->amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['thb'=>$thb]);
                        }else if($oldcur=='KHR'){
                            $khr=-1 * floatval(str_replace(',','',$request->amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['khr'=>$khr]);
                        }else if($oldcur=='VND'){

                        }
                    }else{
                        if($request->usd_amount<>''){
                            $usd=-1 * floatval(str_replace(',','',$request->usd_amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['usd'=>$usd]);
                        }

                        if($request->thb_amount<>''){
                            $thb=-1 * floatval(str_replace(',','',$request->thb_amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['thb'=>$thb]);
                        }
                        if($request->khr_amount<>''){
                            $khr=-1 * floatval(str_replace(',','',$request->khr_amount));
                            DB::table('partner_close_lists')->where('id',$foundclose->id)->update(['khr'=>$khr]);
                        }

                    }

                }else{
                    //insert new
                    $cl=new PartnerCloseList();
                    $cl->closedate=$trandate;
                    $cl->closetime=$invtime;
                    $cl->closeby=Auth::user()->name;
                    $cl->partner_id=$request->agentid;
                    $cl->startcapital=$request->trmode==2?1:-1;
                    if($request->usd_amount<>''){
                        $cl->usd=-1 * floatval(str_replace(',','',$request->usd_amount));
                    }else{
                        $cl->usd=0;
                    }

                    if($request->thb_amount<>''){
                        $cl->thb=-1 * floatval(str_replace(',','',$request->thb_amount));
                    }else{
                        $cl->thb=0;
                    }
                    if($request->khr_amount<>''){
                        $cl->khr=-1 * floatval(str_replace(',','',$request->khr_amount));
                    }else{
                        $cl->khr=0;
                    }

                    $cl->vnd=0;
                    $cl->transaction_id=$maxtid;
                    $cl->exchange_id=$maxeid;
                    $cl->note='';
                    $cl->created_at=$current;
                    $cl->updated_at=$current;
                    if($cl->save()){
                        return response()->json(['success'=>'save user capital completed']);
                    }
                }

            }
          return response()->json(['success'=>'save user capital completed']);
        }else{
          return response()->json(['error'=>'save user capital fails']);
        }
    }
    public function delete_endbalance_multi(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $date = str_replace('/', '-', $request->dd);
        $trandate= date('Y-m-d', strtotime($date));
        $isdel=DB::table('user_capitals')->where('company_id',$selcomid)->whereDate('trandate','=',$trandate)->where('user_id_affect',$request->userid)->where('trancode','-2')->delete();
        if($isdel>0){
            return response()->json(['success'=>true,'message'=>'User endding capital has been delete']);
        }else{
            return response()->json(['error'=>true,'message'=>'Delte user endding capital fail']);
        }
    }
    public function store_endbalance_multi(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->trandate);
        $trandate= date('Y-m-d', strtotime($date));
        $validator = Validator::make($request->all(), [
            'stock.*' => 'required',
            'curid.*' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        DB::table('user_capitals')->where('company_id',$selcomid)->whereDate('trandate','=',$trandate)->where('user_id_affect',$request->useraffect)->where('trancode','-2')->delete();
        foreach ($request->curid7 as $key => $value) {
            $amount=str_replace(',','',$request->amount7[$key]);
            $amount=-1 * floatval($amount);
            $capitaltype=$request->cid7[$key]==0?'cash':'agent';
            $agent_id=$request->cid7[$key]==0?NULL:$request->cid7[$key];
            $uc=array(
                'trantime'=>$invtime,
                'user_id'=>Auth::id(),
                'created_at'=>$current,
                'trandate'=>$trandate,
                'user_id_affect'=>$request->useraffect,
                'tranname'=>'លុយដកចុងគ្រា',
                'trancode'=>-2,
                'note'=>'ដកពេលបិទបញ្ជីបុគ្គលិក',
                'capital_type'=>$capitaltype,
                'agent_id'=>$agent_id,
                'updated_at'=>$current,
                'ref_number'=>'',
                'action'=>'u,d',
                'amount'=>$amount,
                'currency_id'=>$request->curid7[$key],
                'company_id'=>$selcomid,
              );
            UserCapital::insert($uc);

        }
    }

    public function store1(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'seluser1' => 'required',
            'seluser2' => 'required',
            'selcur1' => 'required',
            'amount1' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->trandate1);
        $trandate= date('Y-m-d', strtotime($date));
        $amt1=0;
        $amt2=0;
        $tranname1='';
        $tranname2='';
        $trancode1='';
        $trancode2='';
        $note1='';
        $note2='';
        $trname='';
        $useraffect='';
        $capitaltype1='';
        $capitaltype2='';
        $prefix='usercapital-';
        if($request->sign1=='+'){
            $amt1=str_replace(',','',$request->amount1);
            $amt2=-1 * floatval(str_replace(',','',$request->amount1));
            $tranname1='Cashin';
            $tranname2='Cashout';
            $trname='ដកចេញ';
            $trancode1='1';
            $trancode2='-1';
            $note1='ទទួលពី: ' . $request->user2;
            $note2='ដាក់អោយ: ' . $request->user1;
            $capitaltype1='cash';
            $capitaltype2=$request->capitaltype;
            $useraffect=$request->seluser2;
        }else{
            $amt1=-1 * floatval(str_replace(',','',$request->amount1));
            $amt2=str_replace(',','',$request->amount1);
            $tranname1='Cashout';
            $tranname2='Cashin';
            $trname='ដាក់ចូល';
            $trancode1='-1';
            $trancode2='1';
            $note1='ដាក់អោយ: ' . $request->user2;
            $note2='ទទួលពី: ' . $request->user1;
            $capitaltype2='cash';
            $capitaltype1=$request->capitaltype;
            $useraffect=$request->seluser1;
        }
        if($request->id1==0){
          $uc=new UserCapital();
          $uc->trantime=$invtime;
          $uc->user_id=Auth::id();
          $uc->created_at=$current;
        }else{
          $uc=UserCapital::find($request->id1);
        }
            $uc->trandate=$trandate;
            $uc->user_id_affect=$request->seluser1;
            $uc->user_reverse_id=$request->seluser2;
            $uc->amount=$amt1;
            $uc->currency_id=$request->selcur1;
            $uc->tranname=$tranname1;
            $uc->trancode=$trancode1;
            $uc->note=$note1;
            $uc->note1=$request->noteu2;
            $uc->ref_number='';
            $uc->capital_type=$capitaltype1;
            $uc->agent_id=$request->selbank;
            $uc->action='u,d';
            $uc->updated_at=$current;
            $uc->location_id=2;
            $uc->company_id=$selcomid;
            if($uc->save())
            {
                $id1=$uc->id;
                $group_id=$prefix . $id1;
                  if($request->id2==0){
                    $uc1=new UserCapital();
                    $uc1->trantime=$invtime;
                    $uc1->user_id=Auth::id();
                    $uc1->created_at=$current;
                  }else{
                    $uc1=UserCapital::find($request->id2);
                  }
                    $uc1->trandate=$trandate;
                    $uc1->user_id_affect=$request->seluser2;
                    $uc1->user_reverse_id=$request->seluser1;
                    $uc1->amount=$amt2;
                    $uc1->currency_id=$request->selcur1;
                    $uc1->tranname=$tranname2;
                    $uc1->trancode=$trancode2;
                    $uc1->ref_number=$group_id;
                    $uc1->note=$note2;
                    $uc1->note1=$request->noteu2;
                    $uc1->capital_type=$capitaltype2;
                    $uc1->agent_id=$request->selbank;
                    $uc1->updated_at=$current;
                    $uc1->location_id=2;
                    $uc1->map_id=$id1;
                    $uc1->company_id=$selcomid;
                    if($uc1->save()){
                        $id2=$uc1->id;
                        DB::table('user_capitals')->where('id',$id1)->update(['ref_number'=>$group_id,'map_id'=>$id2]);
                        if($request->selbank<>''){
                            if($request->transfer_id==0){
                                $ptf=new PartnerTransfer();
                                $ptf->tt=$invtime;
                                $ptf->created_at=$current;
                              }else{
                                $ptf=PartnerTransfer::find($request->transfer_id);
                              }
                              $ptf->tranname=$trname;
                              $ptf->trancode=floatval($trancode1) * 5;
                              $ptf->dd=$trandate;
                              $ptf->mekun=$trancode1;
                              $ptf->user_id=Auth::id();
                              $ptf->parrent_id=$request->selbank;
                              $ptf->amount= $amt1;
                              $ptf->currency_id=$request->selcur1;
                              $ptf->cuscharge=0;
                              $ptf->cuscharge_currency_id=$request->selcur1;
                              $ptf->fee=0;
                              $ptf->fee_currency_id=$request->selcur1;
                              $ptf->bonus=0;
                              $ptf->user_affect=$useraffect;
                              // $ptf->sendername=$request->sendername;
                              // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                              // $ptf->recname=$request->recname;
                              // $ptf->rectel=str_replace(' ','',$request->rectel);
                              $ptf->ref_number=$group_id;
                              $ptf->note=$note2;
                              $ptf->sendername=$request->noteu2;
                              $ptf->isshow=0;
                              $ptf->updated_at=$current;
                              if($ptf->save()){
                                $id3=$ptf->id;
                                DB::table('user_capitals')->where('id',$id1)->update(['transfer_id'=>$id3]);
                              }

                        }
                        return response()->json(['success'=>'save user cashin cash out completed']);
                    }

            }else{
                return response()->json(['error'=>'save user cashin cash out fails']);
            }

    }
    public function store3(Request $request)
    {
        //return $request->all();
        //$selcomid=Session('log_into_company_id');
        $selcomid=$request->selcompany2;
        $validator = Validator::make($request->all(), [
            'seluser33' => 'required',
            'seluserout33' => 'required',
            //'sellist33' => 'required',
            //'selbank44' => 'required',
            'selcur33' => 'required',
            'amount33' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->trandate3);
        $trandate= date('Y-m-d', strtotime($date));
        $amt1=0;
        $amt2=0;
        $tranname1='';
        $tranname2='';
        $trancode1='';
        $trancode2='';
        $note1='';
        $note2='';
        //$trname='';
        $idtr1='0';
        $idtr2='0';

        $prefix='usercapital-';
        if($request->sign33=='+'){
            $amt1=str_replace(',','',$request->amount33);
            $amt2=-1 * floatval(str_replace(',','',$request->amount33));
            $tranname1=$request->sellist33==''?'Cash in':'Balance in';
            $tranname2=$request->selbank44==''?'Cash out':'Balance out';
            $trname1='បាញ់ចេញ';
            $trname2='បាញ់ចូល';
            $trancode1='1';
            $trancode2='-1';
            $note1='ទទួលពី: ' . $request->sender . '(' . $request->senderlist . ')';
            $note2='ដាក់អោយ: ' . $request->receive . '(' . $request->receivelist . ')';

        }else{
            $amt1=-1 * floatval(str_replace(',','',$request->amount33));
            $amt2=str_replace(',','',$request->amount33);
            $tranname1=$request->sellist33==''?'Cash out':'Balance out';
            $tranname2=$request->selbank44==''?'Cash in':'Balance in';
            $trname1='បាញ់ចូល';
            $trname2='បាញ់ចេញ';
            $trancode1='-1';
            $trancode2='1';
            $note1='ដាក់អោយ: ' . $request->sender . '(' . $request->senderlist . ')';
            $note2='ទទួលពី: ' . $request->receive . '(' . $request->receivelist . ')';
        }
        if($request->id3==0 || $request->id3==''){
          $uc=new UserCapital();
          $uc->trantime=$invtime;
          $uc->user_id=Auth::id();
          $uc->created_at=$current;
        }else{
          $uc=UserCapital::find($request->id3);
        }
        $uc->company_id=$selcomid;
        $uc->trandate=$trandate;
        $uc->user_id_affect=$request->seluser33;
        $uc->amount=$amt1;
        $uc->currency_id=$request->selcur33;
        $uc->tranname=$tranname1;
        $uc->trancode=$request->sellist33==''?$trancode1:floatval($trancode1)*4;
        $uc->note=$note1;
        $uc->note1=$request->note33;
        $uc->ref_number='';
        $uc->action='u,d';
        $uc->capital_type=$request->customertype1;
        $uc->agent_id=$request->sellist33;
        $uc->location_id=3;
        $uc->user_reverse_id=$request->seluserout33;
        $uc->agent_id_reverse=$request->selbank44;
        $uc->updated_at=$current;
        $uc->goldwater=(float) str_replace(',', '', $request->goldwater33 ?: 0);
        if($uc->save())
        {
            $id=$uc->id;
            $refnumber=$prefix . $id;
            if($request->id6==0 || $request->id6==''){
                $uc1=new UserCapital();
                $uc1->trantime=$invtime;
                $uc1->user_id=Auth::id();
                $uc1->created_at=$current;
              }else{
                $uc1=UserCapital::find($request->id6);
              }
              $uc1->company_id=$selcomid;
              $uc1->trandate=$trandate;
              $uc1->user_id_affect=$request->seluserout33;
              $uc1->amount=$amt2;
              $uc1->currency_id=$request->selcur33;
              $uc1->tranname=$tranname2;
              $uc1->trancode=$request->selbank44==''?$trancode2:floatval($trancode2)*4;
              $uc1->note=$note2;
              $uc1->note1=$request->note33;
              $uc1->ref_number=$refnumber;
              $uc1->action='';
              $uc1->capital_type=$request->customertype2;
              $uc1->agent_id=$request->selbank44;
              $uc1->agent_id_reverse=$request->sellist33;
              $uc1->location_id=3;
              $uc1->user_reverse_id=$request->seluser33;
              $uc1->updated_at=$current;
              $uc1->goldwater=(float) str_replace(',', '', $request->goldwater33 ?: 0);
              if($uc1->save()){
                $id6=$uc1->id;
              }else{
                $id6=0;
              }
              if($request->selbank44<>''){
                  if($request->id4==0 || $request->id4==''){
                      $ptf=new PartnerTransfer();
                      $ptf->tt=$invtime;
                      $ptf->created_at=$current;
                  }else{
                      $ptf=PartnerTransfer::find($request->id4);
                  }
                  $ptf->company_id=$selcomid;
                  $ptf->tranname=$trname1;
                  $ptf->trancode=floatval($trancode1) * 4;
                  $ptf->dd=$trandate;
                  $ptf->mekun=$trancode1;
                  $ptf->user_id=Auth::id();
                  $ptf->parrent_id=$request->selbank44;
                  $ptf->amount=$amt1;
                  $ptf->currency_id=$request->selcur33;
                  $ptf->cuscharge=0;
                  $ptf->cuscharge_currency_id=$request->selcur33;
                  $ptf->fee=0;
                  $ptf->bonus=0;
                  // $ptf->sendername=$request->sendername;
                  // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                  // $ptf->recname=$request->txtaccountname44;
                  // $ptf->rectel=str_replace(' ','',$request->txtaccountnumber44);
                  $ptf->ref_number=$refnumber;
                  $ptf->note=$note2;
                  $ptf->user_affect=$request->seluserout33;
                  $ptf->updated_at=$current;
                  //$ptf->sendername=$request->noteu2;
                  if($ptf->save()){
                      $lastid=$ptf->id;
                      $idtr1=$ptf->id;

                      //DB::table('user_capitals')->where('id',$id)->update(['ref_number'=>$id1]);
                  }else{
                      $idtr1=0;
                  }

              }

              if($request->sellist33<>'')
              {
                  if($request->id5==0 || $request->id5==''){
                      $ptf1=new PartnerTransfer();
                      $ptf1->tt=$invtime;
                      $ptf1->created_at=$current;
                  }else{
                      $ptf1=PartnerTransfer::find($request->id5);
                  }

                  $ptf1->tranname=$trname2;
                  $ptf1->trancode=floatval($trancode2) * 4;
                  $ptf1->dd=$trandate;
                  $ptf1->company_id=$selcomid;
                  $ptf1->mekun=$trancode2;
                  $ptf1->user_id=Auth::id();
                  $ptf1->parrent_id=$request->sellist33;
                  $ptf1->amount=$amt2;
                  $ptf1->currency_id=$request->selcur33;
                  $ptf1->cuscharge=0;
                  $ptf1->cuscharge_currency_id=$request->selcur33;
                  $ptf1->fee=0;
                  $ptf1->bonus=0;
                  // $ptf->sendername=$request->sendername;
                  // $ptf->sendertel=str_replace(' ','',$request->sendertel);
                  // $ptf1->recname=$request->txtaccountname44;
                  // $ptf1->rectel=str_replace(' ','',$request->txtaccountnumber44);
                  $ptf1->ref_number=$refnumber;
                  $ptf1->note=$note1;
                  $ptf1->updated_at=$current;
                  $ptf1->user_affect=$request->seluser33;
                  //$ptf1->sendername=$request->noteu2;
                  if($ptf1->save()){
                      $idtr2=$ptf1->id;
                      //DB::table('user_capitals')->where('id',$id)->update(['ref_number'=>$id1]);
                  }else{
                      $idtr2=0;
                  }
              }

            //$id12=$idtr1 . ','. $idtr2;
            DB::table('user_capitals')->where('id',$id)->update(['ref_number'=>$refnumber,'map_id'=>$id6,'transfer_id'=>$idtr1,'transfer_id2'=>$idtr2]);

        }else{
            return response()->json(['error'=>'save user balance in out fails']);
        }
    }
    public function updateusercapital(Request $request)
    {
      //return $request->all();
      $record2_istransfer=0;
      $record1=UserCapital::find($request->id);
      $record2=null;
      $record3=null;
      $refnum=explode("-",$request->refnumber);
        if(count($refnum)==2){
            if($refnum[0]=='transfer'){
            $record2_istransfer=1;
            $record2=PartnerTransfer::find($refnum[1]);
            }else{
                $record2=UserCapital::find($refnum[1]);
            }
        }else{
            if($refnum[0]=='transfer'){
                $record2_istransfer=2;
                $refnum2=explode(",",$request->refnumber);
                $refid1=explode("-",$refnum2[0])[1];
                $refid2=explode("-",$refnum2[1])[1];
                $record2=PartnerTransfer::find($refid1);
                $record3=PartnerTransfer::find($refid2);

            }else{
                $record2=UserCapital::find($refnum[1]);
            }
        }

      $currencies=Currency::where('active',1)->where('ispandp','0')->orderBy('no')->get();
      $users=User::where('active',1)->get();
      $banks=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER','AGENT','NOLIST'])->get();
      return view('usercapitals.usercapital_update',compact('record1','record2','record3','record2_istransfer','currencies','users','banks'));

    }
    public function edit(Request $request)
    {
      $record2_istransfer=0;
      $record1=UserCapital::find($request->id);
      return response()->json(['record1'=>$record1]);
    //   $record2=null;
    //   $record3=null;
    //   if($request->refnumber<>''){
    //     $refnum=explode("-",$request->refnumber);
    //     if(count($refnum)==2){
    //       if($refnum[0]=='transfer'){
    //         $record2_istransfer=1;
    //         $record2=PartnerTransfer::find($refnum[1])->load('partner');
    //       }else{
    //         $record2=UserCapital::find($refnum[1]);
    //       }
    //     }else{
    //       if($refnum[0]=='transfer'){
    //           $record2_istransfer=2;
    //           $refnum2=explode(",",$request->refnumber);
    //           $refid1=explode("-",$refnum2[0])[1];
    //           $refid2=explode("-",$refnum2[1])[1];
    //           $record2=PartnerTransfer::find($refid1)->load('partner');
    //           $record3=PartnerTransfer::find($refid2)->load('partner');

    //         }else{
    //           $record2=UserCapital::find($refnum[1]);
    //         }
    //     }
    //   }
    //   return response()->json(['record1'=>$record1,'record2'=>$record2,'record2_istransfer'=>$record2_istransfer,'record3'=>$record3]);
    }

    public function delete(Request $request)
    {
        //return $request->all();
        $user_del=Auth::id();
        $action=$request->action;
        $status=$request->status;
        DB::beginTransaction();
        try{
            if($action=='restore'){
                if($request->location_id==1 || empty($request->refnumber)){
                    DB::table('user_capitals')->where('id',$request->id)->update(['status'=>'1','user_del'=>$user_del]);
                    $uc=UserCapital::find($request->id);
                    if($uc->trancode==2 && $uc->capital_type<>'cash'){
                        if($uc->currency->shortcut=='USD'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['usd'=> -1 * floatval($uc->amount)]);
                        }else if($uc->currency->shortcut=='THB'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['thb'=> -1 * floatval($uc->amount)]);
                        }else if($uc->currency->shortcut=='KHR'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['khr'=> -1 * floatval($uc->amount)]);
                        }
                    }else if($uc->trancode==-2 && $uc->capital_type<>'cash'){
                        if($uc->currency->shortcut=='USD'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['usd'=> $uc->amount]);
                        }else if($uc->currency->shortcut=='THB'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['thb'=> $uc->amount]);
                        }else if($uc->currency->shortcut=='KHR'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['khr'=> $uc->amount]);
                        }
                    }
                }else {
                    DB::table('user_capitals')->where('ref_number',$request->refnumber)->update(['status'=>'1','user_del'=>$user_del]);
                    DB::table('partner_transfers')->where('ref_number',$request->refnumber)->update(['status'=>'1','user_delete'=>$user_del]);
                }

            }else if($action=='delete'){
                if($status==0){
                    if($request->location_id==1 || empty($request->refnumber)){
                        DB::table('user_capitals')->where('id',$request->id)->delete();
                    }else {
                        DB::table('user_capitals')->where('ref_number',$request->refnumber)->delete();
                        DB::table('partner_transfers')->where('ref_number',$request->refnumber)->delete();
                    }
                }else{
                    if($request->location_id==1 || empty($request->refnumber)){
                        DB::table('user_capitals')->where('id',$request->id)->update(['status'=>'0','user_del'=>$user_del]);
                    }else {
                        DB::table('user_capitals')->where('ref_number',$request->refnumber)->update(['status'=>'0','user_del'=>$user_del]);
                        DB::table('partner_transfers')->where('ref_number',$request->refnumber)->update(['status'=>'0','user_delete'=>$user_del]);
                    }
                    $uc=UserCapital::find($request->id);
                    if($uc->trancode==2 && $uc->capital_type<>'cash'){
                        if($uc->currency->shortcut=='USD'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['usd'=>0]);
                        }else if($uc->currency->shortcut=='THB'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['thb'=>0]);
                        }else if($uc->currency->shortcut=='KHR'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',1)->update(['khr'=>0]);
                        }
                    }else if($uc->trancode==-2 && $uc->capital_type<>'cash'){
                        if($uc->currency->shortcut=='USD'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['usd'=>0]);
                        }else if($uc->currency->shortcut=='THB'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['thb'=>0]);
                        }else if($uc->currency->shortcut=='KHR'){
                            DB::table('partner_close_lists')->whereDate('closedate',$uc->trandate)->where('partner_id',$uc->agent_id)->where('startcapital',-1)->update(['khr'=>0]);
                        }
                    }
                }
            }


            //DB::table('bank_transactions')->where('ref_number','usercapital-' . $request->id)->update(['status'=>'0','delby'=>$delby]);
             if($action=='restore'){
                 return response()->json(['success'=>true,'message'=>'user capital has been restore']);
             }else{
                 return response()->json(['success'=>true,'message'=>'user capital has been deleted']);
             }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }

    }
    public function userofferdelete(Request $request)
    {

        $useroffer=UserOffer::find($request->id);
        if($useroffer){
            DB::table('user_capitals')->where('ref_number',$useroffer->ref_number)->update(['status'=>0,'user_del'=>Auth::id()]);
            DB::table('partner_transfers')->where('ref_number',$useroffer->ref_number)->update(['status'=>0,'user_delete'=>Auth::id()]);
            DB::table('user_offers')->where('id',$request->id)->update(['isaccept'=>0]);
            return response()->json(['success'=>true,'message'=>'user offer has been deleted']);
        }

    }
    public function userofferreject(Request $request)
    {
        if (! $this->isAllowedToSave($request->id,'reject')) {
            return response()->json(['success' => false, 'message' => 'This offer transaction is not allowed to save.']);
        }
        $offerid=$request->id;
        DB::table('user_offers')->where('id',$offerid)->update(['status'=>0]);
        return response()->json(['success'=>true,'message'=>'user offer has been reject']);
    }
    public function userofferrestore(Request $request)
    {
        $offerid=$request->id;
        DB::table('user_offers')->where('id',$offerid)->update(['status'=>1]);
        return response()->json(['success'=>true,'message'=>'user offer has been restore']);
    }
    public function moneyofferprint(Request $request)
    {
        $offer=UserOffer::find($request->id);
        return view('usercapitals.printoffer',compact('offer'));
    }
}
