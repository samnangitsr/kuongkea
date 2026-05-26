<?php

namespace App\Http\Controllers;

use App\User;
use App\Stock;
use App\Company;
use App\Invoice;
use App\Currency;
use App\Customer;
use App\CloseList;
use Carbon\Carbon;
use App\Models\SMS;
use App\UserCapital;
use App\CustomerList;
use App\DailyCloseList;
use App\Models\Expanse;
use App\BankTransaction;
use App\CloseListDetail;
use App\PartnerTransfer;
use App\PartnerCloseList;
use App\PartnerTotalList;
use App\Models\ThaiAccount;
use App\PartnerExchangeList;
use App\PartnerTransferList;
use Illuminate\Http\Request;
use App\Models\ThaiCloseList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CloseListController extends Controller
{
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $curthree=Currency::where('active',1)->where('company_id',$selcomid)->whereIn('shortcut',['KHR','THB','VND'])->orderBy('no')->get();
        return view('closelists.index',compact('users','curthree'));
    }
    public function search(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today= date('Y-m-d', strtotime($current));

        $listdate= date('Y-m-d', strtotime($request->showdate));
        $viewby=Auth::user()->name;
        DB::table('daily_close_lists')->where('viewby',$viewby)->delete();
        $rate_thb=0;
        $rate_vnd=0;
        $rate_khr=0;
        // Check if listdate is in the past
        if ($today > $listdate) {
            $check = CloseList::whereDate('closedate', $listdate)->where('company_id',$selcomid)->first();
            if ($check) {
                $rate_thb = $check->rate_thb;
                $rate_vnd = $check->rate_vnd;
                $rate_khr = $check->rate_khr;
            }
        }
//user capital
        $usd=0;
        $thb=0;
        $khr=0;
        $vnd=0;
        $khr_usd=0;
        $thb_usd=0;
        $vnd_usd=0;
        if(!isset($request->seluser)){
            $usercapitals=UserCapital::join('currencies','user_capitals.currency_id','=','currencies.id')->where('currencies.isfn','0')->where('user_capitals.company_id',$selcomid)
            ->whereDate('user_capitals.trandate',$listdate)->where('user_capitals.trancode',-2)->where('user_capitals.status',1)->where('user_capitals.capital_type','cash')
            ->select(DB::raw('currencies.shortcut as cur,sum(amount) as balance'))->groupBy('currencies.shortcut')->get();
        }else{
            $usercapitals=UserCapital::join('currencies','user_capitals.currency_id','=','currencies.id')->where('currencies.isfn','0')->where('user_capitals.company_id',$selcomid)
            ->where('user_capitals.trandate',$listdate)->where('user_capitals.trancode',-2)->where('user_capitals.status',1)->where('user_capitals.capital_type','cash')
            ->whereIn('user_capitals.user_id_affect',$request->seluser)
            ->select(DB::raw('currencies.shortcut as cur,sum(amount) as balance'))->groupBy('currencies.shortcut')->get();
        }
        foreach($usercapitals as $uc)
        {

            if($uc->cur=='USD'){
                $usd=$uc->balance;
            }elseif($uc->cur=='KHR'){
                $khr=$uc->balance;
                $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
            }elseif($uc->cur='THB'){
                $thb=$uc->balance;
                $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
            }elseif($uc->cur='VND'){
              $vnd=$uc->balance;
              $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
            }
        }
        $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
        //DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'លុយដកចុងគ្រា','modelname'=>'usercapital','usd'=>-1 * $usd,'thb'=>-1 * $thb,'khr'=>-1 * $khr,'vnd'=>-1 * $vnd,'inusd'=>-1 * $allinusd]);
        DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'លុយដកចុងគ្រា','modelname'=>'usercapital','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);

        //fn stock
        $fnstock=Stock::join('currencies','stocks.currency_id','=','currencies.id')
        ->where('currencies.isfn',1)->where('currencies.isexchangecur',1)->where('currencies.active',1)
        ->whereDate('stocks.stockdate',$listdate)->where('stocks.company_id',$selcomid)
        ->select(DB::raw('sum(amount) as tamt'))->first();
        if($fnstock){
            DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'សរុបលុយបរទេស','modelname'=>'currencystock','usd'=>-1 * $fnstock->tamt,'thb'=>'0','khr'=>'0','vnd'=>'0','inusd'=>-1 * $fnstock->tamt]);
        }else{
            DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'សរុបលុយបរទេស','modelname'=>'currencystock','usd'=>'0','thb'=>'0','khr'=>'0','vnd'=>'0','inusd'=>'0']);
        }

      $this->notyetcashdraw($request,$rate_thb,$rate_khr,$rate_vnd);

      $this->summaryallpartnerlist($request,$rate_thb,$rate_khr,$rate_vnd);
      $this->summaryallthailist($request,$rate_thb);
      $this->notyetthaicashdraw($request,$rate_thb);
      $this->notyetdocode($request,$rate_thb,$rate_khr,$rate_vnd);



        $usd=0;
        $thb=0;
        $khr=0;
        $vnd=0;
        $khr_usd=0;
        $thb_usd=0;
        $vnd_usd=0;
        if(!isset($request->seluser)){
            $expanses=Expanse::whereDate('dd',$listdate)->where('status',1)->where('trancode','<',0)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            $incomes=Expanse::whereDate('dd',$listdate)->where('status',1)->where('trancode','>',0)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
        }else{
            $expanses=Expanse::whereDate('dd',$listdate)->where('status',1)->whereIn('user_id',$request->seluser)->where('trancode','<',0)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            $incomes=Expanse::whereDate('dd',$listdate)->where('status',1)->whereIn('user_id',$request->seluser)->where('trancode','>',0)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();

        }
        foreach($expanses as $e)
        {

            if($e->currency->shortcut=='USD'){
                $usd=$e->tamt;
            }elseif($e->currency->shortcut=='KHR'){
                $khr=$e->tamt;
                $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
            }elseif($e->currency->shortcut='THB'){
                $thb=$e->tamt;
                $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
            }elseif($e->currency->shortcut='VND'){
              $vnd=$e->tamt;
              $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
            }
        }
        $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
        DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'ចំណាយ','modelname'=>'expanse','usd'=>-1 * $usd,'thb'=>-1 * $thb,'khr'=>-1 * $khr,'vnd'=>-1 * $vnd,'inusd'=>-1 * $allinusd]);
        $usd=0;
        $thb=0;
        $khr=0;
        $vnd=0;
        $khr_usd=0;
        $thb_usd=0;
        $vnd_usd=0;
        foreach($incomes as $e)
        {
            if($e->currency->shortcut=='USD'){
                $usd=$e->tamt;
            }elseif($e->currency->shortcut=='KHR'){
                $khr=$e->tamt;
                $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
            }elseif($e->currency->shortcut='THB'){
                $thb=$e->tamt;
                $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
            }elseif($e->currency->shortcut='VND'){
              $vnd=$e->tamt;
              $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
            }
        }
        $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
        DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'ចំណូល','modelname'=>'income','usd'=>-1 * $usd,'thb'=>-1 * $thb,'khr'=>-1 * $khr,'vnd'=>-1 * $vnd,'inusd'=>-1 * $allinusd]);

//get data
        $closelists=DailyCloseList::where('viewby',$viewby)->orderBy('id')->get();
        $total=DailyCloseList::where('viewby',$viewby)->whereNotIn('modelname',['income','expanse'])->select(DB::raw('sum(usd) as tusd,sum(thb) as tthb,sum(khr) as tkhr,sum(vnd) as tvnd,sum(inusd) as tinusd'))->first();

        $totalkhrinusd=$this->exchangetousd('KHR',$total->tkhr);
        $totalthbinusd=$this->exchangetousd('THB',$total->tthb);
        $totalvndinusd=$this->exchangetousd('VND',$total->tvnd);
        $totalincome=DailyCloseList::where('viewby',$viewby)->whereIn('modelname',['income'])->select(DB::raw('sum(usd) as tusd,sum(thb) as tthb,sum(khr) as tkhr,sum(vnd) as tvnd,sum(inusd) as tinusd'))->first();
        $totalexpanse=DailyCloseList::where('viewby',$viewby)->whereIn('modelname',['expanse'])->select(DB::raw('sum(usd) as tusd,sum(thb) as tthb,sum(khr) as tkhr,sum(vnd) as tvnd,sum(inusd) as tinusd'))->first();

        $totalallinusd=$total->tusd+$totalkhrinusd+$totalthbinusd+$totalvndinusd;
        $todayrate=Currency::where('company_id',$selcomid)->whereIn('shortcut',['KHR','THB','VND'])->get();
        //return $totalexpanse;
        return view('closelists.searchlist',compact('closelists','total','totalallinusd','todayrate','listdate','totalincome','totalexpanse','rate_thb','rate_khr','rate_vnd'));

    }
    public function converttimetoint($t){
      $a=explode(':',$t);
      $h=$a[0]*3600;
      $m=$a[1]*60;
      $s=$a[2];
      return $h+$m+$s;
  }
  function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;

    }
    return number_format($num,$dc,'.',',');
}

  public function notyetcashdraw(Request $request,$rate_thb,$rate_khr,$rate_vnd)
  {
    $selcomid=Session('log_into_company_id');
    $viewby=Auth::user()->name;
    $d2= date('Y-m-d', strtotime($request->showdate));
    $khr=0;
    $usd=0;
    $thb=0;
    $vnd=0;
    $transfers=PartnerTransfer::select(DB::raw('sum(amount) as total,currency_id'))
            ->where('status',1)->where('trancode',-1)->where('company_id',$selcomid)->whereNull('iscashdraw')->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
    foreach($transfers as $t){
        if($t->currency->shortcut=='USD'){
            $usd =abs($t->total);
        }elseif($t->currency->shortcut=='THB'){
            $thb =abs($t->total);
        }elseif($t->currency->shortcut=='KHR'){
            $khr =abs($t->total);
        }elseif($t->currency->shortcut=='VND'){
            $vnd =abs($t->total);
        }
    }
    $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
    $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
    $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
    $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
    DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'លុយមិនទាន់បើកវេរ','modelname'=>'notyet_cashdraws','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);
  }
  public function notyetdocode(Request $request,$rate_thb,$rate_khr,$rate_vnd)
  {
    $viewby=Auth::user()->name;
    $selcomid=Session('log_into_company_id');
    $d2= date('Y-m-d', strtotime($request->showdate));
    $khr=0;
    $usd=0;
    $thb=0;
    $vnd=0;
    $transfers=PartnerTransfer::select(DB::raw('sum(amount) as total,currency_id'))
            ->where('status',1)->where('trancode',1)->where('company_id',$selcomid)->whereNotNull('thai_amt')->whereNull('docodeby')->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
    foreach($transfers as $t){
        if($t->currency->shortcut=='USD'){
            $usd =abs($t->total);
        }elseif($t->currency->shortcut=='THB'){
            $thb =abs($t->total);
        }elseif($t->currency->shortcut=='KHR'){
            $khr =abs($t->total);
        }elseif($t->currency->shortcut=='VND'){
            $vnd =abs($t->total);
        }
    }
    $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
    $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
    $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
    $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
    DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'លុយមិនទាន់ធ្វើកូត','modelname'=>'notyet_docode','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);
  }
  public function notyetthaicashdraw(Request $request,$rate_thb)
  {
    $viewby=Auth::user()->name;
    $selcomid=Session('log_into_company_id');
    $d2= date('Y-m-d', strtotime($request->showdate));
    $khr=0;
    $usd=0;
    $thb=0;
    $vnd=0;
    $sumamt=SMS::where('amount','>',0)->where('isopen',0)->where('company_id',$selcomid)->whereDate('smsdate','<=',$d2)->where('status',1)->sum('amount');

    if($sumamt){
        $thb=$sumamt;
    }
    $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
    $allinusd=$thb_usd;
    DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>'លុយថៃមិនទាន់បើក','modelname'=>'notyet_thaicashdraws','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);


  }

    public function summaryallpartnerlist(Request $request,$rate_thb,$rate_khr,$rate_vnd)
    {
        //return $request->all();
        $viewby=Auth::user()->name;
        $selcomid=Session('log_into_company_id');
        $d2= date('Y-m-d', strtotime($request->showdate));
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $close_transfer_id=0;
        $close_exchange_id=0;
        $close_sms_id=0;
        DB::table('all_partner_lists')->where('viewby',Auth::user()->name)->delete();
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();

        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','<>','NOLIST')->where('showinlist',1)->orderBy('customertype')->get();

        foreach($customers as $c)
        {
            $close_transfer_id=0;
            $close_exchange_id=0;
            $close_sms_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

            $closelist=PartnerCloseList::whereDate('closedate','<=',$d2)->where('partner_id',$c->id)->orderBy('id','DESC')->first();
            if($closelist){
                $close_transfer_id=$closelist->transaction_id??0;
                $close_exchange_id=$closelist->exchange_id??0;
                $close_sms_id=$closelist->sms_id??0;

                $usd=$closelist->usd;
                $thb=$closelist->thb;
                $khr=$closelist->khr;
                $vnd=$closelist->vnd;

            }

            $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q1){
                    $q1->whereNotNull('docodeby')->whereNotNull('thai_amt');
                });
            })->groupBy('currency_id')->get();

            $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q1){
                    $q1->whereNotNull('docodeby')->whereNotNull('thai_amt');
                });
            })->groupBy('fee_currency_id')->get();

            $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('curbuy')->get();
            $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('cursale')->get();

            if($c->thai_list){
            //ករណីភ្ជាប់បញ្ជីដៃគូទៅបញ្ជីថៃ
            $sms_in=SMS::select(DB::raw('sum(amount) as amount,cur'))
            ->where('status',1)->where('amount','>',0)->where('accno',$c->thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<=',$d2)->whereNull('mix_from_id')->groupBy('cur')->get();
            $sms_out=SMS::select(DB::raw('sum(amount) as amount,cur'))
            ->where('status',1)->where('amount','<',0)->where('accno',$c->thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<=',$d2)->whereNull('mix_from_id')->groupBy('cur')->get();
            foreach($sms_in as $si){
                if($si->cur=='USD'){
                    $usd +=-1 * $si->amount;
                }elseif($si->cur=='THB'){
                    $thb +=-1 * $si->amount;
                }elseif($si->cur=='KHR'){
                    $khr +=-1 * $si->amount;
                }elseif($si->cur=='VND'){
                    $vnd +=-1 * $si->amount;
                }
            }

            foreach($sms_out as $so){
                if($so->cur=='USD'){
                    $usd +=-1 * $so->amount;
                }elseif($so->cur=='THB'){
                    $thb +=-1 * $so->amount;
                }elseif($so->cur=='KHR'){
                    $khr +=-1 * $so->amount;
                }elseif($so->cur=='VND'){
                    $vnd +=-1 * $so->amount;
                }
            }

        }

          foreach($transfers as $t){

                if($t->currency->shortcut=='USD'){
                    $usd +=$t->total;
                }elseif($t->currency->shortcut=='THB'){
                    $thb +=$t->total;
                }elseif($t->currency->shortcut=='KHR'){
                    $khr +=$t->total;
                }elseif($t->currency->shortcut=='VND'){
                    $vnd +=$t->total;
                }
            }
          foreach($fees as $t){

            if($t->feecurrency->shortcut=='USD'){
                $usd +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='THB'){
                $thb +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='KHR'){
                $khr +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='VND'){
                $vnd +=$t->totalfee;
            }
        }


            foreach($exbuys as $t){
                $found=1;
                if($t->curbuy=='USD'){
                    $usd +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='THB'){
                    $thb +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='KHR'){
                    $khr +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='VND'){
                    $vnd +=-1 * $t->totalbuy;
                }
            }

            foreach($exsales as $t){

                if($t->cursale=='USD'){
                    $usd +=$t->totalsale;
                }elseif($t->cursale=='THB'){
                    $thb +=$t->totalsale;
                }elseif($t->cursale=='KHR'){
                    $khr +=$t->totalsale;
                }elseif($t->cursale=='VND'){
                    $vnd +=$t->totalsale;
                }
            }

            $khr_usd=$this->exchangetousd('KHR',$khr,$rate_khr);
            $thb_usd=$this->exchangetousd('THB',$thb,$rate_thb);
            $vnd_usd=$this->exchangetousd('VND',$vnd,$rate_vnd);
            $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;
            DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>$c->name,'customer_id'=>$c->id,'modelname'=>'partner_transfers','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);

        }
    }

    public function summaryallthailist(Request $request,$rate_thb)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $viewby=Auth::user()->name;
        $d2= date('Y-m-d', strtotime($request->showdate));
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;

        $thaiaccounts=ThaiAccount::where('status',1)->where('company_id',$selcomid)->where('showinlist',1)->orderBy('no')->get();

        foreach($thaiaccounts as $c)
        {

            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

            $smsid=0;
            $balance=0;
            $closelist=ThaiCloseList::where('thai_account_id',$c->id)->whereDate('closedate','<=',$d2)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $smsid=$closelist->lastsmsid;
                $balance=$closelist->balance;
            }
            $bal=SMS::where('status',1)->where('company_id',$selcomid)->whereNull('mix_from_id')->where('id','>',$smsid)->whereDate('smsdate','<=',$d2)->where('accno',$c->accno)->sum('amount');
            $thb=$bal+ $balance;
            $thb_usd=$this->exchangetousd('THB',-1 * $thb,$rate_thb);
            $allinusd=$thb_usd;
            DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>$c->accno,'customer_id'=>$c->id,'modelname'=>'thai_sms','usd'=>$usd,'thb'=>-1 * $thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>-1 * $allinusd]);

        }
    }

    public function summarypartnerlist(Request $request)
    {
        //return $request->all();
        //$viewby=Auth::user()->name;
        //$selcomid=Session('log_into_company_id');
        $d2= date('Y-m-d', strtotime($request->showdate));
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $close_transfer_id=0;
        $close_exchange_id=0;

        // DB::table('all_partner_lists')->where('viewby',Auth::user()->name)->delete();
        // DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        $op=$request->op;//op <=
        $c=Customer::where('id',$request->cid)->first();


            $close_transfer_id=0;
            $close_exchange_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

            $closelist=PartnerCloseList::whereDate('closedate',$op,$d2)->where('partner_id',$c->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $close_transfer_id=$closelist->transaction_id;
                $close_exchange_id=$closelist->exchange_id;
                $usd=$closelist->usd;
                $thb=$closelist->thb;
                $khr=$closelist->khr;
                $vnd=$closelist->vnd;
            }

            $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$d2)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('currency_id')->get();
            $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd',$op,$d2)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('fee_currency_id')->get();

            $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date',$op,$d2)->groupBy('curbuy')->get();
            $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date',$op,$d2)->groupBy('cursale')->get();
            //return $closelist;

          foreach($transfers as $t){

                if($t->currency->shortcut=='USD'){
                    $usd +=$t->total;
                }elseif($t->currency->shortcut=='THB'){
                    $thb +=$t->total;
                }elseif($t->currency->shortcut=='KHR'){
                    $khr +=$t->total;
                }elseif($t->currency->shortcut=='VND'){
                    $vnd +=$t->total;
                }
            }
          foreach($fees as $t){

            if($t->feecurrency->shortcut=='USD'){
                $usd +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='THB'){
                $thb +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='KHR'){
                $khr +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='VND'){
                $vnd +=$t->totalfee;
            }
        }


            foreach($exbuys as $t){
                $found=1;
                if($t->curbuy=='USD'){
                    $usd +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='THB'){
                    $thb +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='KHR'){
                    $khr +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='VND'){
                    $vnd +=-1 * $t->totalbuy;
                }
            }

            foreach($exsales as $t){

                if($t->cursale=='USD'){
                    $usd +=$t->totalsale;
                }elseif($t->cursale=='THB'){
                    $thb +=$t->totalsale;
                }elseif($t->cursale=='KHR'){
                    $khr +=$t->totalsale;
                }elseif($t->cursale=='VND'){
                    $vnd +=$t->totalsale;
                }
            }

            // $khr_usd=$this->exchangetousd('KHR',$khr);
            // $thb_usd=$this->exchangetousd('THB',$thb);
            // $vnd_usd=$this->exchangetousd('VND',$vnd);
            // $allinusd=$usd+$khr_usd+$thb_usd+$vnd_usd;

            //DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>$c->name,'customer_id'=>$c->id,'modelname'=>'partner_transfers','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'inusd'=>$allinusd]);
            return response()->json(['usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd]);


    }
    public function searchold(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $listdate= date('Y-m-d', strtotime($request->showdate));
        $viewby=Auth::user()->name;
        //get olddata
        $oldlist='';
        $oldlistdetails='';
        $lastlist=CloseList::whereDate('closedate','<',$listdate)->where('company_id',$selcomid)->orderBy('closedate','DESC')->first();

        if($lastlist!=null){
            $oldlist=CloseList::whereDate('closedate',$lastlist->closedate)->where('company_id',$selcomid)->first();
            $oldlistdetails=CloseListDetail::where('close_list_id',$lastlist->id)->where('company_id',$selcomid)->orderBy('id')->get();
        }else{
            return;
        }

        return view('closelists.searchlistold',compact('oldlist','oldlistdetails'));

    }

    public function exchangetousd($cur,$amt,$getrate=0)
    {
        $inusd=0;
        $selcomid=Session('log_into_company_id');
        $r=Currency::where('shortcut',$cur)->where('company_id',$selcomid)->first();
        if($r){
            if($getrate<>0){
                $ratebuy=str_replace(',','',explode("/",$getrate)[0]);
                $ratesale=str_replace(',','',explode("/",$getrate)[1]);
            }else{
                if(config('helper.auto_closelist_rate') == 0){
                    $ratebuy=$r->ratebuy_closelist??$r->ratebuy;
                    $ratesale=$r->ratesale_closelist??$r->ratesale;
                }else{
                    $ratebuy=$r->ratebuy;
                    $ratesale=$r->ratesale;
                }
            }
            $opsign=$r->optsign;
            if($opsign=='/'){
                if($amt>0){
                    $inusd=$amt / $ratebuy;
                }else{
                    $inusd=$amt / $ratesale;
                }

            }else{
                if($amt>0){
                    $inusd=$amt * $ratebuy;
                }else{
                    $inusd=$amt * $ratesale;
                }
            }
            return $inusd;
        }else{
            return $amt;
        }
    }
    public function store(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $closetime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->txtclosedate);
        $closedate= date('Y-m-d', strtotime($date));

        $date1 = str_replace('/', '-', $request->txtolddate);
        $olddate= date('Y-m-d', strtotime($date1));

        DB::table('close_lists')->whereDate('closedate',$closedate)->where('company_id',$selcomid)->delete();
        DB::table('close_list_details')->whereDate('closedate',$closedate)->where('company_id',$selcomid)->delete();

        $closelist=new CloseList();
        $closelist->closeby=Auth::user()->name;
        $closelist->closedate=$closedate;


        if($request->total_usd1)
        {
            $closelist->olddate=$olddate;
            $closelist->oldusd=str_replace(',','',str_replace('$','',$request->total_usd1));
            $closelist->oldthb=str_replace(',','',str_replace('B','',$request->total_thb1));
            $closelist->oldkhr=str_replace(',','',str_replace('R','',$request->total_khr1));
            $closelist->oldvnd=str_replace(',','',str_replace('V','',$request->total_vnd1));
            $closelist->oldinusd=str_replace(',','',str_replace('$','',$request->total_inusd1));
        }else{
            $closelist->olddate=$closedate;
            // $closelist->oldusd=str_replace(',','',str_replace('$','',$request->total_usd));
            // $closelist->oldthb=str_replace(',','',str_replace('B','',$request->total_thb));
            // $closelist->oldkhr=str_replace(',','',str_replace('R','',$request->total_khr));
            // $closelist->oldvnd=str_replace(',','',str_replace('V','',$request->total_vnd));
            // $closelist->oldinusd=str_replace(',','',str_replace('$','',$request->total_inusd));
            $closelist->oldusd=0;
            $closelist->oldthb=0;
            $closelist->oldkhr=0;
            $closelist->oldvnd=0;
            $closelist->oldinusd=0;

        }
        $closelist->newusd=str_replace(',','',str_replace('$','',$request->total_usd));
        $closelist->newthb=str_replace(',','',str_replace('B','',$request->total_thb));
        $closelist->newkhr=str_replace(',','',str_replace('R','',$request->total_khr));
        $closelist->newvnd=str_replace(',','',str_replace('V','',$request->total_vnd));
        $closelist->newinusd=str_replace(',','',str_replace('$','',$request->total_inusd));
        $closelist->rate_thb=$request->ratethb;
        $closelist->rate_khr=$request->ratekhr;
        $closelist->rate_vnd=$request->ratevnd;
        $closelist->income=str_replace(',','',str_replace('$','',$request->income));
        $closelist->expanse=str_replace(',','',str_replace('$','',$request->expanse));
        $closelist->company_id=$selcomid;
        if($closelist->save())
        {
            $closeid=$closelist->id;
            foreach ($request->desr as $key => $value) {

                $closelistdetail=array(
                'company_id' => $selcomid,
                'close_list_id'=>$closeid,
                'closedate'=>$closedate,
                'customer_id'=>$request->customer_id[$key],
                'desr'=>$value,
                'modelname'=>$request->modelname[$key],
                'usd'=> str_replace(',','',str_replace('$','',$request->usd[$key])),
                'thb'=> str_replace(',','',str_replace('B','',$request->thb[$key])),
                'khr'=> str_replace(',','',str_replace('R','',$request->khr[$key])),
                'vnd'=> str_replace(',','',str_replace('V','',$request->vnd[$key])),
                'inusd'=> str_replace(',','',str_replace('$','',$request->inusd[$key])),
                );
                CloseListDetail::insert($closelistdetail);

            }
        }
    }
    public function report(Request $request)
    {
        return view('closelists.report');
    }

    public function showreport(Request $request)
    {
         $selcomid=Session('log_into_company_id');
        $showdate= date('Y-m-d', strtotime($request->showdate));
        $closelist=CloseList::whereDate('closedate',$showdate)->where('company_id',$selcomid)->first();
        if($closelist)
        {
            $closelistdetails=CloseListDetail::where('close_list_id',$closelist->id)->orderBy('id')->get();
            return view('closelists.showreport',compact('closelist','closelistdetails'));
        }

    }

    public function summaryreport(Request $request)
    {
        return view('closelists.summaryreport');
    }
    public function showsummaryreport(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $fdate= date('Y-m-d', strtotime($request->fdate));
        $tdate= date('Y-m-d', strtotime($request->tdate));

        $closelist=CloseList::whereBetween(DB::raw('DATE(closedate)'), array($fdate, $tdate))->where('company_id',$selcomid)->orderBy('closedate')->get();
        return view('closelists.showsummaryreport',compact('closelist'));
    }
    public function seedetail(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $viewdate=$request->seedate;
        $seedate= date('Y-m-d', strtotime($request->seedate));
        $modelname=$request->modelname;
        $customer_id=$request->customer_id;
        $customername=$request->customername;
        if($modelname=='usercapital'){
            $summary=UserCapital::whereDate('trandate',$request->seedate)->where('trancode',-2)->where('status',1)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as tamt'))->groupBy('currency_id')->get();
            $usercapitals=UserCapital::whereDate('trandate',$request->seedate)->where('trancode',-2)->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
            return view('closelists.usercapital',compact('usercapitals','summary','viewdate'));
        }elseif($modelname=='currencystock'){
            $title='CURRENCY STOCK';
            $fnstock=Stock::join('currencies','stocks.currency_id','=','currencies.id')
            ->where('currencies.isfn',1)->where('currencies.isexchangecur',1)->where('currencies.active',1)
            ->whereDate('stocks.stockdate',$request->seedate)->where('stocks.company_id',$selcomid)
            ->select(DB::raw('sum(amount) as tamt'))->first();
            $fnstockdetails=Stock::join('currencies','stocks.currency_id','=','currencies.id')
            ->where('currencies.isfn',1)->where('currencies.isexchangecur',1)->where('currencies.active',1)
            ->whereDate('stocks.stockdate',$request->seedate)->where('stocks.company_id',$selcomid)
            ->select('stocks.*')->get();
            return view('closelists.stock',compact('fnstock','fnstockdetails','title','viewdate'));
        }elseif($modelname=='goldstock'){
            $title='GOLD STOCK';
            $fnstock=Stock::join('currencies','stocks.currency_id','=','currencies.id')
            ->where('currencies.isfn',1)->where('currencies.isexchangecur',0)->where('currencies.active',1)
            ->whereDate('stocks.stockdate',$request->seedate)->where('stocks.company_id',$selcomid)
            ->select(DB::raw('sum(amount) as tamt'))->first();
            $fnstockdetails=Stock::join('currencies','stocks.currency_id','=','currencies.id')
            ->where('currencies.isfn',1)->where('currencies.isexchangecur',0)->where('currencies.active',1)
            ->whereDate('stocks.stockdate',$request->seedate)->where('stocks.company_id',$selcomid)
            ->select('stocks.*')->get();
            return view('closelists.stock',compact('fnstock','fnstockdetails','title','viewdate'));
        }elseif($modelname=='invoice'){
            $title='SUMMARY INVOICE For: ' . $customername;
            $suminv=Invoice::where('customer_id',$customer_id)->where('status',1)->where('cur','USD')->select(DB::raw('sum(total-deposit) as balance'))->first();
            $invs=Invoice::where('customer_id',$customer_id)->where('status',1)->where('cur','USD')->whereRaw('total-deposit<>0')->select('invoices.*')->get();
            return view('closelists.invoice',compact('suminv','invs','title','viewdate'));
        }elseif($modelname=='bank'){
            $title='SUMMARY INVOICE For: ' . $customername;
            $summary=BankTransaction::where('customer_id',$customer_id)->where('status',1)
            ->select(DB::raw('cur,sum(amount) as balance'))->groupBy('cur')->get();
            $oldlist=BankTransaction::where('customer_id',$customer_id)->where('status',1)->whereDate('trandate','<',$request->seedate)
            ->select(DB::raw('cur,sum(amount) as balance'))->groupBy('cur')->get();
            $newlists=BankTransaction::where('customer_id',$customer_id)->where('status',1)->whereDate('trandate','>=',$request->seedate)
            ->select('bank_transactions.*')->orderBy('trandate')->orderBy('id')->get();
            return view('closelists.bank',compact('summary','oldlist','newlists','title','viewdate'));
        }elseif($modelname=='partner_transfers'){
          $d1= date('Y-m-d', strtotime($request->seedate));
          $d2= date('Y-m-d', strtotime($request->seedate));
          $partnername=$request->customername;
          $mindate=DB::table('partner_transfers')->where('status',1)->min('dd');
          $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
          $this->showpartnerlistdetail($request);
            $oldlist='true';
            $linkdetail='false';
            $seelist=2;
            $ptls=PartnerTransferList::where('viewby',Auth::user()->name)->orderBy('trandate')->orderBy('id')->get();
            if($seelist==2){
                $ptls_new=$ptls;
            }else if($seelist==1){
                $ptls_new=PartnerTransferList::where('viewby',Auth::user()->name)->where(function($q){
                    $q->where('usd','>',0)->orWhere('thb','>',0)->orWhere('khr','>',0)->orWhere('vnd','>',0);
                })
                ->orderBy('trandate')->orderBy('id')->get();
            }else if($seelist==-1){
                $ptls_new=PartnerTransferList::where('viewby',Auth::user()->name)->where(function($q){
                    $q->where('usd','<',0)->orWhere('thb','<',0)->orWhere('khr','<',0)->orWhere('vnd','<',0);
                })
                ->orderBy('trandate')->orderBy('id')->get();
            }
            $ptls1=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('id')->get();
            $records=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('ttint')->get();
            $ptls=PartnerTransferList::where('viewby',Auth::user()->name)->orderBy('trandate')->orderBy('id')->get();
            $befortotalwe=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
            $befortotalthey=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
            $aftertotal=PartnerTotalList::where('viewby',Auth::user()->name)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
            $logo=Company::orderBy('id')->first();
            $partnername=$request->customername;

            $weopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->get();
            $weopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
            $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();

            $theyopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->get();
            $theyopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
            $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
            return view('closelists.seepartnerlist1',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','ptls_new','linkdetail','partnername'));
            //return view('closelists.seepartnerlist',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1'));

        }elseif($modelname=='notyet_cashdraws'){
          $title='របាយការណ៏មិនទាន់បើកវេរ';
          $summary=PartnerTransfer::select(DB::raw('sum(amount) as total,currency_id'))
            ->where('status',1)->where('trancode',-1)->whereNull('iscashdraw')->whereDate('dd','<=',$seedate)->where('company_id',$selcomid)->groupBy('currency_id')->get();
          $notyetcashdraws=PartnerTransfer::where('status',1)->where('trancode',-1)->whereNull('iscashdraw')->whereDate('dd','<=',$seedate)->where('company_id',$selcomid)->get();
          return view('closelists.seenotyetcashdraw',compact('summary','notyetcashdraws','title','viewdate'));
        }elseif($modelname=='thai_sms'){

            $smsid=0;
            $balance=0;
            $c=collect();
            $thaiacc=ThaiAccount::find($request->customer_id);
            $accno=$thaiacc->accno;
            $title="របាយការណ៏លុយថៃ លេខបញ្ជី៖" . $accno;
            $closelist=ThaiCloseList::where('thai_account_id',$thaiacc->id)->whereDate('closedate','<=',$seedate)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $balance=$closelist->balance;
                $smsid=$closelist->lastsmsid;
                $closedate=$closelist->closedate;
                $closetime=$closelist->closetime;
                $c=$c->push(['id'=>0,'sendfrom'=>'បិទបញ្ជី','smsdate'=>$closedate,'smstime'=>$closetime,'amount'=>$balance,'smstext'=>'']);
            }
            $sumoldlist=SMS::where('accno',$accno)->whereDate('smsdate','<',$seedate)->where('id','>',$smsid)->whereNull('mix_from_id')->sum('amount');
            if($sumoldlist){
                $predate=date('Y-m-d', strtotime($seedate. ' - 1 days'));
                $c=$c->push(['id'=>1,'sendfrom'=>'បញ្ជីចាស់','smsdate'=>$predate,'smstime'=>'','amount'=>$sumoldlist,'smstext'=>'']);
            }
            $sms=SMS::where('accno',$accno)->whereDate('smsdate','=',$seedate)->where('id','>',$smsid)->whereNull('mix_from_id')->orderBy('id')->get();
            foreach($sms as $s){
                $c=$c->push(['id'=>$s->id,'sendfrom'=>$s->sendfrom,'smsdate'=>$s->smsdate,'smstime'=>$s->smstime,'amount'=>$s->amount,'smstext'=>$s->smstext]);
            }
            //return $c;

            $total=$c->sum('amount');
            //return $c;
            return view('closelists.seethaisms',compact('c','title','viewdate','total'));

        }elseif($modelname=='notyet_thaicashdraws'){
            $title="របាយការណ៏លុយថៃ មិនទាន់បើកវេរ";
            $c=collect();
            $sms=SMS::where('isopen',0)->where('amount','>',0)->whereDate('smsdate','<=',$seedate)->where('status',1)->orderBy('id')->get();
            foreach($sms as $s){
                $c=$c->push(['id'=>$s->id,'sendfrom'=>$s->sendfrom,'smsdate'=>$s->smsdate,'smstime'=>$s->smstime,'amount'=>$s->amount,'smstext'=>$s->smstext]);
            }
            //return $c;

            $total=$c->sum('amount');
            //return $c;
            return view('closelists.seethaisms',compact('c','title','viewdate','total'));
        }elseif($modelname=='income'){
            $title='ចំណូលទូទៅ';
            $summary=Expanse::select(DB::raw('sum(amount) as total,currency_id'))
              ->where('status',1)->whereDate('dd','=',$seedate)->where('amount','>',0)->groupBy('currency_id')->get();
            $expanses=Expanse::where('status',1)->whereDate('dd','=',$seedate)->where('amount','>',0)->get();
            return view('closelists.seeincomeexpanse',compact('summary','expanses','title','viewdate'));
          }elseif($modelname=='expanse'){
            $title='ចំណាយទូទៅ';
            $summary=Expanse::select(DB::raw('sum(amount) as total,currency_id'))
              ->where('status',1)->whereDate('dd','=',$seedate)->where('amount','<',0)->groupBy('currency_id')->get();
            $expanses=Expanse::where('status',1)->whereDate('dd','=',$seedate)->where('amount','<',0)->get();
            return view('closelists.seeincomeexpanse',compact('summary','expanses','title','viewdate'));
          }

    }

    public function showpartnerlistdetail(Request $request)
    {
        //return $request->all();
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $d1= date('Y-m-d', strtotime($request->seedate));
        $d2= date('Y-m-d', strtotime($request->seedate));

        $mindate=DB::table('partner_transfers')->where('status',1)->min('dd');
        $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
        DB::table('partner_transfer_lists')->where('viewby',Auth::user()->name)->delete();
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        $close_transfer_id=0;
        $close_exchange_id=0;
        $close_sms_id=0;
          $closedate=$predate;
          $closetime='00:00:00';
          $inttime='0';
          $close_usd=0;
          $close_thb=0;
          $close_khr=0;
          $close_vnd=0;
            $customer=Customer::find($request->customer_id);
            $thai_list=$customer->thai_list;
          //$closelist=PartnerCloseList::whereDate('closedate','<=',$d1)->where('partner_id',$request->partner)->orderBy('closedate','DESC')->first();
          $closelist=PartnerCloseList::whereDate('closedate','<=',$d1)->where('partner_id',$request->customer_id)->orderBy('id','DESC')->first();

          if($closelist){
              $closedate=$closelist->closedate;
              $close_transfer_id=$closelist->transaction_id;
              $close_exchange_id=$closelist->exchange_id;
              $close_sms_id=$closelist->sms_id;
              $close_usd=$closelist->usd;
              $close_thb=$closelist->thb;
              $close_khr=$closelist->khr;
              $close_vnd=$closelist->vnd;
              $closetime=$closelist->closetime;
              $inttime=$this->converttimetoint($closetime);
              DB::table('partner_total_lists')->insert([
                  ['viewby'=>Auth::user()->name,'dd'=>$closedate,'tt'=>$closetime,'ttint'=>$inttime,'total'=>$close_usd,'cur'=>'USD','note'=>'closelist'],
                  ['viewby'=>Auth::user()->name,'dd'=>$closedate,'tt'=>$closetime,'ttint'=>$inttime,'total'=>$close_thb,'cur'=>'THB','note'=>'closelist'],
                  ['viewby'=>Auth::user()->name,'dd'=>$closedate,'tt'=>$closetime,'ttint'=>$inttime,'total'=>$close_khr,'cur'=>'KHR','note'=>'closelist'],
                  ['viewby'=>Auth::user()->name,'dd'=>$closedate,'tt'=>$closetime,'ttint'=>$inttime,'total'=>$close_vnd,'cur'=>'VND','note'=>'closelist'],

              ]);
          }
          $oldtransfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
              ->where('status',1)->where('parrent_id',$request->customer_id)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)->groupBy('currency_id')->get();
          $oldfees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
              ->where('status',1)->where('parrent_id',$request->customer_id)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)->groupBy('fee_currency_id')->get();
          $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
              ->where('status',1)->where('partner_id',$request->customer_id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('curbuy')->get();
          $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
              ->where('status',1)->where('partner_id',$request->customer_id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('cursale')->get();
          foreach($oldtransfers as $t){
              DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$closedate,
                  'tt'=>$closetime,
                  'ttint'=>$inttime,
                  'total'=>$t->total,
                  'cur'=>$t->currency->shortcut,
                  'note'=>'sumtransfer',
                  'amount'=>$t->total
              ]);
          }
          foreach($oldfees as $t){
            DB::table('partner_total_lists')->insert([
                'viewby'=>Auth::user()->name,
                'dd'=>$closedate,
                'tt'=>$closetime,
                'ttint'=>$inttime,
                'total'=>$t->totalfee,
                'cur'=>$t->feecurrency->shortcut,
                'note'=>'sumtransfer',
                'amount'=>$t->totalfee
            ]);
          }
          foreach($exbuys as $b){
              DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$closedate,
                  'tt'=>$closetime,
                  'ttint'=>$inttime,
                  'total'=>-1 * $b->totalbuy,
                  'cur'=>$b->curbuy,
                  'note'=>'sumexchangelist',
                  'amount'=>-1 * $b->totalbuy
              ]);
          }
          foreach($exsales as $s){
              DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$closedate,
                  'tt'=>$closetime,
                  'ttint'=>$inttime,
                  'total'=>$s->totalsale,
                  'cur'=>$s->cursale,
                  'note'=>'sumexchangelist',
                  'amount'=>$s->totalsale,

              ]);
          }

          if($thai_list){
                $sms_in=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
                ->where('status',1)->where('amount','>',0)->where('accno',$thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<',$d1)->groupBy('cur')->get();
                $sms_out=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
                ->where('status',1)->where('amount','<',0)->where('accno',$thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<',$d1)->groupBy('cur')->get();
                foreach($sms_in as $si){
                    DB::table('partner_total_lists')->insert([
                        'viewby'=>Auth::user()->name,
                        'dd'=>$closedate,
                        'tt'=>$closetime,
                        'ttint'=>$inttime,
                        'total'=>-1 * $si->totalamount,
                        'cur'=>$si->cur,
                        'note'=>'sumthailist',
                        'amount'=>-1 * $si->totalamount
                    ]);
                }
                foreach($sms_out as $so){
                    DB::table('partner_total_lists')->insert([
                        'viewby'=>Auth::user()->name,
                        'dd'=>$closedate,
                        'tt'=>$closetime,
                        'ttint'=>$inttime,
                        'total'=>-1 * $so->totalamount,
                        'cur'=>$so->cur,
                        'note'=>'sumthailist',
                        'amount'=>-1 * $so->totalamount
                    ]);
                }
            }

          $total_lists=PartnerTotalList::select(DB::raw('sum(total) as total,cur'))->where('viewby',Auth::user()->name)->groupBy('cur')->get();
          $khr=0;
          $usd=0;
          $thb=0;
          $vnd=0;
          foreach($total_lists as $tl)
          {

              if($tl->cur=='USD'){
                  $usd=$tl->total;
              }elseif($tl->cur=='KHR'){
                  $khr=$tl->total;
              }elseif($tl->cur=='THB'){
                  $thb=$tl->total;
              }elseif($tl->cur=='VND'){
                  $vnd=$tl->total;
              }
          }
          $rank_olddate='';
          if($closedate==''){
              $rank_olddate=date('d-m-Y', strtotime($mindate)). ' to '. date('d-m-Y', strtotime($predate));
          }else{
              $rank_olddate=date('d-m-Y', strtotime($closedate)). ' to '. date('d-m-Y', strtotime($predate));
          }
          DB::table('partner_transfer_lists')->insert([
              'viewby'=>Auth::user()->name,
              'tranid'=>0,
              'tranname'=>'លុយយោង',
              'trandate'=>$predate,
              'trantime'=>'00:00:00',
              'recordby'=>'',
              'usd'=>$usd,
              'thb'=>$thb,
              'khr'=>$khr,
              'vnd'=>$vnd,
              'sendertel'=>'',
              'rectel'=>'',
              'note'=>$rank_olddate
          ]);
          //new record

          $datas=PartnerTransfer::where('parrent_id',$request->customer_id)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('id','>',$close_transfer_id)->orderBy('dd')->orderBy('id')->get();

          //dd($datas);
          foreach($datas as $data){
              $khr=0;
              $usd=0;
              $thb=0;
              $vnd=0;
              $feekhr=0;
              $feeusd=0;
              $feethb=0;
              $feevnd=0;

              if($data->currency->shortcut=='USD'){
                $usd=$data->amount+$data->interest;
                //$feeusd=$data->fee;
              }elseif($data->currency->shortcut=='KHR'){
                $khr=$data->amount+$data->interest;
                //$feekhr=$data->fee;
              }elseif($data->currency->shortcut=='THB'){
                $thb=$data->amount+$data->interest;
                //$feethb=$data->fee;
              }elseif($data->currency->shortcut=='VND'){
                $vnd=$data->amount+$data->interest;
                //$feevnd=$data->fee;
              }


            if($data->feecurrency->shortcut=='USD'){
                $feeusd=$data->fee;
            }elseif($data->feecurrency->shortcut=='KHR'){
                $feekhr=$data->fee;
            }elseif($data->feecurrency->shortcut=='THB'){
                $feethb=$data->fee;
            }elseif($data->feecurrency->shortcut=='VND'){
                $feevnd=$data->fee;
            }
              DB::table('partner_transfer_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'tranid'=>$data->id,
                  'tranname'=>$data->tranname,
                  'trandate'=>$data->dd,
                  'trantime'=>$data->tt,
                  'recordby'=>$data->user->name,
                  'usd'=>$usd+$feeusd,
                  'thb'=>$thb+$feethb,
                  'khr'=>$khr+$feekhr,
                  'vnd'=>$vnd+$feevnd,
                  'sendertel'=>$data->sendername . ' ' . $data->sendertel,
                  'rectel'=>$data->recname . ' ' . $data->rectel,
                  'note'=>$data->note,
                  'amount'=>$data->amount,
                  'cur'=>$data->currency->shortcut,
                  'fee'=>$data->fee,
                  'feecur'=>$data->feecurrency->shortcut,
                  'interest'=>$data->interest
              ]);
              if($data->currency_id==$data->fee_currency_id){
                  DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'dd'=>$data->dd,
                    'tt'=>$data->tt,
                    'ttint'=>$this->converttimetoint($data->tt),
                    'recordby'=>$data->user->name,
                    'tranname'=>$data->tranname,
                    'total'=>$data->amount+$data->fee+$data->interest,
                    'cur'=>$data->currency->shortcut,
                    'note'=>'transfer',
                    'amount'=>$data->amount,
                    'fee'=>$data->fee,
                    'feecur'=>$data->feecurrency->shortcut,
                    'sender'=>$data->sendername . ' ' . $data->sendertel,
                    'receive'=>$data->recname . ' ' . $data->rectel,
                    'desr'=>$data->note,
                    'idtransfer'=>$data->id,
                    'idcashdraw'=>$data->cashdraw_id,
                    'ref_number'=>$data->ref_number,
                    'interest'=>$data->interest
                ]);
              }else{
                  DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'dd'=>$data->dd,
                    'tt'=>$data->tt,
                    'ttint'=>$this->converttimetoint($data->tt),
                    'recordby'=>$data->user->name,
                    'tranname'=>$data->tranname,
                    'total'=>$data->amount,
                    'cur'=>$data->currency->shortcut,
                    'note'=>'transfer',
                    'amount'=>$data->amount+$data->interest,
                    'fee'=>$data->fee,
                    'feecur'=>$data->feecurrency->shortcut,
                    'sender'=>$data->sendername . ' ' . $data->sendertel,
                    'receive'=>$data->recname . ' ' . $data->rectel,
                    'desr'=>$data->note,
                    'idtransfer'=>$data->id,
                    'idcashdraw'=>$data->cashdraw_id,
                    'ref_number'=>$data->ref_number,
                    'interest'=>$data->interest
                ]);
                  DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'dd'=>$data->dd,
                    'tt'=>$data->tt,
                    'ttint'=>$this->converttimetoint($data->tt),
                    'recordby'=>$data->user->name,
                    'tranname'=>$data->tranname,
                    'total'=>$data->fee,
                    'cur'=>$data->feecurrency->shortcut,
                    'note'=>'transfer',
                    'amount'=>0,
                    'fee'=>$data->fee,
                    'feecur'=>$data->feecurrency->shortcut,
                    'sender'=>$data->sendername . ' ' . $data->sendertel,
                    'receive'=>$data->recname . ' ' . $data->rectel,
                    'desr'=>$data->note,
                    'idtransfer'=>$data->id,
                    'idcashdraw'=>$data->cashdraw_id,
                    'ref_number'=>$data->ref_number
                ]);
              }
          }
          $partnerexlists=PartnerExchangeList::where('partner_id',$request->customer_id)->whereBetween(DB::raw('DATE(ex_date)'), array($d1, $d2))->where('status',1)->where('id','>',$close_exchange_id)->orderBy('id')->get();
          foreach($partnerexlists as $pel){
              $khr=0;
              $usd=0;
              $thb=0;
              $vnd=0;

              if($pel->curbuy=='USD'){
                  $usd=-1 * $pel->buy;
              }elseif($pel->curbuy=='KHR'){
                  $khr=-1 * $pel->buy;
              }elseif($pel->curbuy=='THB'){
                  $thb=-1 * $pel->buy;
              }elseif($pel->curbuy=='VND'){
                  $vnd=-1 * $pel->buy;
              }

              if($pel->cursale=='USD'){
                  $usd=$pel->sale;
              }elseif($pel->cursale=='KHR'){
                  $khr=$pel->sale;
              }elseif($pel->cursale=='THB'){
                  $thb=$pel->sale;
              }elseif($pel->cursale=='VND'){
                  $vnd=$pel->sale;
              }
              DB::table('partner_transfer_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'tranid'=>$pel->id,
                  'tranname'=>'កាត់កង',
                  'trandate'=>$pel->ex_date,
                  'trantime'=>$pel->ex_time,
                  'recordby'=>$pel->user->name,
                  'usd'=>$usd,
                  'thb'=>$thb,
                  'khr'=>$khr,
                  'vnd'=>$vnd,
                  'sendertel'=>$pel->main_rate,
                  'rectel'=>$pel->agree_rate,
                  'note'=>$pel->note
              ]);
              DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$pel->ex_date,
                  'tt'=>$pel->ex_time,
                  'ttint'=>$this->converttimetoint($pel->ex_time),
                  'recordby'=>$pel->user->name,
                  'tranname'=>'កាត់កង',
                  'total'=>-1 * $pel->buy,
                  'cur'=>$pel->curbuy,
                  'note'=>'ExchangeList:'. $this->phpformatnumber($pel->sale) . ' ' .  $pel->cursale,
                  'amount'=>-1 * $pel->buy,
                  'sender'=>$pel->main_rate,
                  'receive'=>$pel->agree_rate,
                  'desr'=>$pel->note,
                  'ref_number'=>'exchangelist-'.$pel->id
              ]);
              DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$pel->ex_date,
                  'tt'=>$pel->ex_time,
                  'ttint'=>$this->converttimetoint($pel->ex_time),
                  'recordby'=>$pel->user->name,
                  'tranname'=>'កាត់កង',
                  'total'=>$pel->sale,
                  'cur'=>$pel->cursale,
                  'note'=>'ExchangeList:'. $this->phpformatnumber($pel->buy) . ' ' .  $pel->curbuy,
                  'amount'=>$pel->sale,
                  'sender'=>$pel->main_rate,
                  'receive'=>$pel->agree_rate,
                  'desr'=>$pel->note,
                  'ref_number'=>'exchangelist-'.$pel->id
              ]);
          }

            if($thai_list){
            $tint=0;

            $sms=SMS::where('accno',$thai_list)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('status',1)->where('id','>',$close_sms_id)->orderBy('id')->get();
            foreach($sms as $ss){
              $khr=0;
              $usd=0;
              $thb=0;
              $vnd=0;

              if($ss->cur=='USD'){
                  $usd=-1 * $ss->amount;
              }elseif($ss->cur=='KHR'){
                  $khr=-1 * $ss->amount;
              }elseif($ss->cur=='THB'){
                  $thb=-1 * $ss->amount;
              }elseif($ss->cur=='VND'){
                  $vnd=-1 * $ss->amount;
              }

              DB::table('partner_transfer_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'tranid'=>$ss->id,
                    'tranname'=>$ss->amount>0?'លុយដាក់ចូល'. $ss->accno:'លុយដកចេញ'.$ss->accno,
                    'trandate'=>$ss->smsdate,
                    'trantime'=>$ss->smstime,
                    'ttint'=>$tint,
                    'recordby'=>$ss->smsby,
                    'usd'=>$usd,
                    'thb'=>$thb,
                    'khr'=>$khr,
                    'vnd'=>$vnd,
                    'sendertel'=>'',
                    'rectel'=>'',
                    'note'=>$ss->opdesr
                ]);

               DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'dd'=>$ss->smsdate,
                    'tt'=>$ss->smstime,
                    'ttint'=>$tint,
                    'recordby'=>$ss->smsby,
                    'tranname'=>$ss->amount>0?'លុយដាក់ចូល'. $ss->accno:'លុយដកចេញ'.$ss->accno,
                    'total'=>-1 * $ss->amount,
                    'cur'=>$ss->cur,
                    'note'=>'',
                    'amount'=>-1 * $ss->amount,
                    'sender'=>'',
                    'receive'=>'',
                    'desr'=>'',
                    'ref_number'=>'smslist-'.$ss->id
                ]);


          }

        }





    }
}
