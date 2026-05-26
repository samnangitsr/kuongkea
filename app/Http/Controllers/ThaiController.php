<?php

namespace App\Http\Controllers;
use App\User;
use App\Address;
use App\Company;
use App\Currency;
use App\Customer;
use App\Exchange;
use Carbon\Carbon;
use App\Models\SMS;
use App\UserReport;
use App\ProductRate;
use App\UserCapital;
use App\ExchangeMulti;
use App\CashdrawSelect;
use App\Models\SmsName;
use App\PartnerTransfer;
use App\Models\AgentType;
use App\PartnerCloseList;
use App\Models\SmsProcess;
use App\Models\SmsRefresh;
//use Illuminate\Validation\Rule;
use App\Models\ThaiAccount;
use App\Models\AgentRateSet;
use App\Models\ThaiCustomer;
//use Image;
use App\PartnerCashdrawTemp;
use App\PartnerExchangeList;
use Illuminate\Http\Request;
use App\Models\CashdrawImage;
use App\Models\ThaiCloseList;
use Illuminate\Support\Facades\DB;
use App\Models\WingTransactionName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MoneyTransferController;

class ThaiController extends Controller
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
    public function printcode(Request $request){
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $wingdate= date('Y-m-d', strtotime($current));
        $process_id=$request->id;
        $groupid=$request->groupid;

        $transferid3=$request->transferid3;
        $thaicurid3=$request->thaicurid3;
        $thaiamt3=$request->thaiamt3;
        $exchangeamount3=$request->exchangeamount3;
        $thaicur3=$request->thaicur3;
        $exchangecur3=$request->exchangecur3;
        $exchangerate3=$request->exchangerate3;
        $exchangerateinfo3=$request->exchangerateinfo3;
        $exchangebuyinfo3=$request->exchangebuyinfo3;
        $exchangesaleinfo3=$request->exchangesaleinfo3;

        if(isset($request->groupid)){
            $transfer=PartnerTransfer::where('ref_group_id',$request->groupid)->whereNull('cashdraw_codeid')->orderBy('id')->get();
        }else{
            $transfer=PartnerTransfer::where('id',$request->id)->get();
        }
        if($transfer){
            $ready=0;
            $mission_complete=0;
            // $i=0;
            // $j=0;
            $amt=0;
            $code='';
            $rectel='';
            $ptype='';
            $accname='';
            $accnum='';
            $customertype='';
            $recname='';
            $tranid='';
            $c1=collect();

            foreach($transfer as $t){
                //$j+=1;
                if($t->docodeby>0){
                    $ready=1;
                }
                $mission_complete=$t->mission_complete;
                $tranid=$t->id;
                $recname=$t->recname;
                $ptype=$t->partner->agenttype->name;
                $logo=$t->partner->agenttype->logo;
                $accname=$t->partner->name;
                if($ptype=='BANK'){
                    $accnum=substr_replace($t->partner->tel,"***",3,5);
                    $rectel=substr_replace($t->rectel,"***",3,5);
                }else{
                    $accnum=$t->partner->tel;
                    $rectel=$t->rectel;
                }
                $customertype=$t->partner->customertype;
                $moneycodes=explode("<br>",$t->moneycode);
                foreach($moneycodes as $mc){
                    $arr=explode('=',$mc);
                    if(count($arr)>1){
                        $amt=explode('=',$mc)[0];
                        $code=explode('=',$mc)[1];
                        $c1=$c1->push(['tranid'=>$tranid,'rectel'=>$rectel,'recname'=>$recname,'code'=>$code,'amount'=>$amt,'ptype'=>$ptype,'logo'=>$logo,'accname'=>$accname,'accnum'=>$accnum,'customertype'=>$customertype]);
                    }
                }

            }
            // if($i==$j){
            //     $ready=1;
            // }
            //return $c1;
            return view('thaicashdraws.printcode',compact('c1','wingdate','process_id','groupid','ready','transferid3','thaicurid3','thaiamt3','exchangeamount3','thaicur3','exchangecur3','exchangerate3','exchangerateinfo3','exchangebuyinfo3','exchangesaleinfo3','mission_complete'));

        }else{
            return "No Code Found";
        }

    }
    public function thaicashdrawrectelautocomplete(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $data = SmsProcess::select("rectel as  value", "recname as recname")
        ->whereNotNull('rectel')->where('rectel','<>','')->where('company_id',$selcomid)->distinct()->get();
        return response()->json($data);
    }
    public function registerthaicustomer()
    {
        $selcomid=Session('log_into_company_id');
        $customers=ThaiCustomer::where('status',1)->where('company_id',$selcomid)->get();
        return view('thaicashdraws.registercustomer',compact('customers'));
    }
    public function accountregister(){
        $selcomid=Session('log_into_company_id');
        $banks=DB::connection('mysql_thai')->table('sms_names')->where('company_id',$selcomid)->get();
        $accounts=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        return view('thaicashdraws.accountregister',compact('banks','accounts'));
    }
     public function accountlistreport(){
        $selcomid=Session('log_into_company_id');
        $banks=DB::connection('mysql_thai')->table('sms_names')->where('company_id',$selcomid)->get();
        $accounts=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $thaicus=ThaiCustomer::where('status',1)->where('company_id',$selcomid)->get();
        return view('thaicashdraws.accountlistreport',compact('banks','accounts','thaicus'));
    }
    public function thaiaccountstore(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $validator = Validator::make($request->all(), [
            'smslist' => 'required',
            'fulllist' => 'required',
            'selbank' => 'required',
            'listname'=>'required',
            'no'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->acc_id==''){
            $c=new ThaiAccount();
            $c->created_at=$current;
        }else{
            $c=ThaiAccount::find($request->acc_id);
        }

        $c->user_id=Auth::id();
        $c->accno=$request->smslist;
        $c->fullaccno=$request->fulllist;
        $c->accname=$request->listname;
        $c->bankname=$request->selbank;
        $c->status=1;
        $c->company_id=$selcomid;
        $c->showinlist=$request->showincloselist;
        $c->no=$request->no;

        $c->updated_at=$current;
        if($c->save()){
            $cid=$c->id;
            return response()->json(['success'=>'savesuccess','cid'=>$cid,'cname'=>$request->listname]);
        }

    }
      public function thaicustomerstore(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $validator = Validator::make($request->all(), [
            'cname' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->cid==''){
            $c=new ThaiCustomer();
            $c->created_at=$current;
        }else{
            $c=ThaiCustomer::find($request->cid);
        }
        $c->user_id=Auth::id();
        $c->name=$request->cname;
        $c->sex=$request->sex;
        $c->tel=$request->tel;
        $c->status=1;
        $c->company_id=$selcomid;
        $c->updated_at=$current;
        if($c->save()){
            $cid=$c->id;
            return response()->json(['success'=>'savesuccess','cid'=>$cid,'cname'=>$request->cname]);
        }

    }
    public function thaiaccountcloselist(Request $request)
    {
        //return $request->all();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $closedate = str_replace('/', '-', $request->closedate);
        $closedate= date('Y-m-d', strtotime($closedate));
        $closetime = date("H:i:s",strtotime($current));
        $validator = Validator::make($request->all(), [
            'selaccount' => 'required',
            'balance' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $c=new ThaiCloseList();
        $c->user_id=Auth::id();
        $c->thai_account_id=$request->selaccount;
        $c->closedate=$closedate;
        $c->closetime=$closetime;
        $c->lastsmsid=$request->smsid;
        $c->balance=str_replace(',','',$request->balance);

        $c->created_at=$current;
        $c->updated_at=$current;
        if($c->save()){
            $cid=$c->id;
            return response()->json(['success'=>'savesuccess']);
        }

    }
     public function getaccountlistreport(Request $request){
        //return $request->all();
        $lastsmsid=0;
        $startbal=0;
        $closedate='2025-01-01';
        $closetime='';
        $oldlist=0;

        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        if($request->oldlist==='true'){
            $closelist=ThaiCloseList::where('thai_account_id',$request->id)->whereDate('closedate','<=',$d1)->orderBy('closedate','desc')->first();
            if($closelist){
                $lastsmsid=$closelist->lastsmsid;
                $startbal=$closelist->balance;
                $closedate=$closelist->closedate;
                $closetime=$closelist->closetime;
            }
            $oldlist=Sms::where('accno',$request->accno)->where('id','>',$lastsmsid)->whereDate('smsdate','>=',$closedate)->whereDate('smsdate','<',$d1)->whereNull('mix_from_id')->sum('amount');

        }
        $data=Sms::where('accno',$request->accno)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('id','>',$lastsmsid)->whereNull('mix_from_id');
        if($request->customer){
            $data=$data->where('thai_customer_id',$request->customer);
        }
        if($request->seltran==1){
            $data=$data->where('amount','>',0);
        }else if($request->seltran==-1){
             $data=$data->where('amount','<',0);
        }
        $data=$data->orderBy('id')->get();
        if($request->action=='print'){
            $dd='គិតពី ' . $request->d1 . ' ដល់ ' . $request->d2;
            $rpttitle="របាយការណ៏លេខបញ្ជី " . $request->accno ;
            if($request->cusname){
                $cusname='អតិថិជន: ' . $request->cusname;
            }else{
                $cusname='';
            }
            return view('thaicashdraws.printshowacclistreport',compact('data','startbal','closedate','closetime','oldlist','d1','dd','rpttitle','cusname'));
        }else{
            return view('thaicashdraws.showacclistreport',compact('data','startbal','closedate','closetime','oldlist','d1'));
        }
     }
     public function thaicustomerread(Request $request)
     {
        $selcomid=Session('log_into_company_id');
        $customers=ThaiCustomer::where('status',$request->status)->where('company_id',$selcomid)->get();
        return view('thaicashdraws.readcustomer',compact('customers'));

     }
    public function getaccountlist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if($request->status==2){
            if($request->selbank==''){
                $accounts=ThaiAccount::where('company_id',$selcomid)->orderBy('no')->get();
            }else{
                $accounts=ThaiAccount::where('company_id',$selcomid)->where('bankname',$request->selbank)->orderBy('no')->get();
            }
        }else{
            if($request->selbank==''){
                $accounts=ThaiAccount::where('status',$request->status)->where('company_id',$selcomid)->orderBy('no')->get();
            }else{
                $accounts=ThaiAccount::where('status',$request->status)->where('company_id',$selcomid)->where('bankname',$request->selbank)->orderBy('no')->get();
            }
        }
        return view('thaicashdraws.getaccountlist',compact('accounts'));
    }
    public function getaccountcloselist(Request $request)
    {
        $accounts=ThaiCloseList::where('thai_account_id',$request->account)->orderBy('closedate','DESC')->orderBy('id','DESC')->take(10)->get();
        return view('thaicashdraws.getaccountcloselist',compact('accounts'));
    }
    public function deleteaccount(Request $request)
    {
        if($request->action=='restore'){
             if(DB::connection('mysql_thai')->table('thai_accounts')->where('id',$request->id)->update(['status'=>1])){
                    return response()->json(['success'=>true]);
                }
        }else{
            if($request->status==1){
                if(DB::connection('mysql_thai')->table('thai_accounts')->where('id',$request->id)->update(['status'=>0])){
                    return response()->json(['success'=>true]);
                }
            }else{
                 if(DB::connection('mysql_thai')->table('thai_accounts')->where('id',$request->id)->delete()){
                    return response()->json(['success'=>true]);
                }
            }

        }
    }
     public function deletecustomer(Request $request)
    {
        if($request->action=='restore'){
             if(DB::connection('mysql_thai')->table('thai_customers')->where('id',$request->id)->update(['status'=>1])){
                    return response()->json(['success'=>true]);
                }
        }else{
            if($request->status==1){
                if(DB::connection('mysql_thai')->table('thai_customers')->where('id',$request->id)->update(['status'=>0])){
                    return response()->json(['success'=>true]);
                }
            }else{
                 if(DB::connection('mysql_thai')->table('thai_customers')->where('id',$request->id)->delete()){
                    return response()->json(['success'=>true]);
                }
            }

        }
    }
    public function deletecloselistaccount(Request $request)
    {
        if(DB::connection('mysql_thai')->table('thai_close_lists')->where('id',$request->id)->delete()){
            return response()->json(['success'=>true]);
        }
    }
    public function thaiaccountgetmaxno()
    {
        $selcomid=Session('log_into_company_id');
        $no=DB::connection('mysql_thai')->table('thai_accounts')->where('company_id',$selcomid)->max('no');
        return response()->json(['maxno'=>$no+1]);
    }
    public function closelist(){
        $selcomid=Session('log_into_company_id');
        $accounts=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        return view('thaicashdraws.accountcloselist',compact('accounts'));
    }
    public function getaccountbalance(Request $request)
    {
        $smsid=0;
        $bal=0;
        $balance=0;
        $closelist=ThaiCloseList::where('thai_account_id',$request->account)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
        if($closelist){
            $smsid=$closelist->lastsmsid;
            $balance=$closelist->balance;
        }
        $bal=SMS::where('status',1)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$request->accountname)->sum('amount');
        $lastid=SMS::max('id');
        $accbal=$bal+$balance;
        return response()->json(['bal'=>$accbal,'lastsmsid'=>$lastid,'success'=>true]);
    }
    public function getwingfee(Request $request)
    {
        $wingfee=AgentRateSet::where('agent_type_id',$request->agenttype)->where('amt1','<',$request->amount)->where('amt2','>=',$request->amount)->where('currency',$request->cur)->first();
        if($wingfee){
            return response()->json(['wingfee'=>$wingfee]);
        }else{
            return response()->json(['wingfee'=>0]);
        }
    }
    public function getagenttranname(Request $request)
    {

        $trannames=WingTransactionName::with('agenttype')->where('agent_type_id',$request->agenttype)->where('sign',1)->where('is_tc',1)->get();
        //$agent_logo=AgentType::find($request->agenttype);
        if($trannames){
            return response()->json(['trannames'=>$trannames]);
        }else{
            return response()->json(['trannames'=>null]);
        }
    }

    public function countthairectel(Request $request)
    {
        //return $request->all();
        //$gettelinfoes=PartnerTransfer::whereMonth('dd',$request->month)->where('status',1)->where('rectel',$request->rectel)->orderBy('id','DESC')->get();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd = date("Y-m-d",strtotime($current));
        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('company_id',$selcomid)->where('status',1)->where('rectel',$request->rectel)->get()->load('partner','user','currency','feecurrency');
        $countrow=PartnerTransfer::whereMonth('dd',$request->month)->where('company_id',$selcomid)->where('status',1)->where('rectel',$request->rectel)->count();
        $lasttransfer=PartnerTransfer::where('status',1)->where('company_id',$selcomid)->where('rectel',$request->rectel)->orderBy('id','desc')->first()->load('partner');
        if($lasttransfer){
            return response()->json(['countrow'=>$countrow,'lasttransfer'=>$lasttransfer,'transfers'=>$transfers]);
        }else{
            return response()->json(['countrow'=>$countrow,'lasttransfer'=>$lasttransfer,'transfers'=>$transfers,'error'=>true]);
        }
    }
    public function showrectelinfo(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $rectel=$request->rectel;
        $transfers=PartnerTransfer::whereMonth('dd',$request->month)->where('company_id',$selcomid)->where('status',1)->where('rectel',$request->rectel)->orderBy('id','DESC')->get();

        return view('thaicashdraws.showrectelinfo',compact('transfers','rectel'));
    }
    public function getaccountbybank(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if($request->bankname==''){
            $acclist=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        }else{
            $acclist=ThaiAccount::where('status',1)->where('company_id',$selcomid)->where('bankname',$request->bankname)->orderBy('no')->get();
        }
        return response()->json(['acclist'=>$acclist]);
    }
    public function getaccountlistbybank(Request $request)
    {
         $selcomid=Session('log_into_company_id');
        if($request->bankname==''){
            $acclist=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        }else{
            $acclist=ThaiAccount::where('status',1)->where('company_id',$selcomid)->where('bankname',$request->bankname)->orderBy('no')->get();
        }
        return response()->json(['acclist'=>$acclist]);
    }

    public function getsmsuserinsert(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $smsinserts=SMS::whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('user_insert',1)->where('status',1)->where('company_id',$selcomid);
        if($request->user<>'All'){
            $smsinserts=$smsinserts->where('smsby',$request->user);
        }
        $smsinserts=$smsinserts->with('customer')->orderBy('id')->get();
        return response()->json(['smsinserts'=>$smsinserts]);

    }
    public function cashdrawreport()
    {
        return view('thaicashdraws.cashdrawreportthai');
    }
     public function notyetcashdrawreport()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');

        $partners=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $data=SMS::where('status',1)->where('amount','>',0)->where('isopen',0)->whereDate('smsdate','<=',$current)->where('company_id',$selcomid)->orderBy('id')->get();
        return view('thaicashdraws.notyetcashdrawreport',compact('partners','data'));
    }
    public function setiscashdrawtrue(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $sms=SMS::whereIn('id',$request->id)->update(['isopen'=>1,'opdate'=>$dd,'opname'=>Auth::user()->name,'opdesr'=>'Clear Stock']);
        if($sms){
            return response()->json(['success'=>true,'message'=>'this record has been deleted']);
        }else{
             return response()->json(['error'=>true,'message'=>'fail to delete this record']);
        }
    }
     public function searchnotyetcashdraw(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $data=SMS::where('status',1)->where('amount','>',0)->where('isopen',0)->whereDate('smsdate','<=',$d1)->where('company_id',$selcomid);

        if($request->partner){
            $data=$data->where('accno',$request->partner);
        }

        $data=$data->orderBy('id')->get();
        return view('thaicashdraws.notyetcashdrawreport_search',compact('data'));
    }
      public function notyetcashdrawreportprint(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->dd));
        $data=SMS::where('status',1)->where('amount','>',0)->where('isopen',0)->whereDate('smsdate','<=',$d1)->where('company_id',$selcomid);

        $rpttitle="របាយការណ៏ស្តុកលុយថៃ " ;
        if($request->partner){
            $data=$data->where('accno',$request->partner);
            $rpttitle=$rpttitle . 'លេខបញ្ជី ' . $request->partner;
        }

        $data=$data->orderBy('id')->get();

        $ddd="គិតត្រឹមថ្ងៃទី ". $request->dd;
        return view('thaicashdraws.notyetcashdrawreport_print',compact('data','rpttitle','ddd'));
    }
    public function checkthesameamount(Request $request)
    {
        //return $request->all();
        $smsdate=date('Y-m-d',strtotime($request->smsdate));
        $amt=floatval($request->sign) * floatval(str_replace(',','',$request->amt));
        $sms=SMS::whereDate('smsdate',$smsdate)->where('amount',$amt)->where('accno',$request->accno)->get();
        return response()->json(['sms'=>$sms]);
    }
    public function smsdelete(Request $request)
    {
        $sms=SMS::find($request->id);
        if($sms->user_insert==1){
            if($sms->delete()){
                return response()->json(['success'=>true]);
            }else{
                return response()->json(['error'=>true]);
            }
        }else{
            $sms->status=0;
            if($sms->save()){
                return response()->json(['success'=>true]);
            }else{
                return response()->json(['error'=>true]);
            }
        }
    }
    public function savesms(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        //$smsid=$request->bankname . date('Y-m-d',strtotime($current)) . date('H:i:s',strtotime($current));
        $minid = SMS::min('smsid');

        $smsid=$minid-1;
        $smsdate=date('Y-m-d',strtotime($request->smsdate));
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'selacclist' => 'required',
            'smstime' => 'required',
            'balance' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->sms_id=='0' || $request->sms_id==''){
            $sms=new SMS();
        }else{
            $sms=SMS::find($request->sms_id);
        }

        $smstext='';
        $sms->company_id=$selcomid;
        $sms->smsid=$smsid;
        $sms->sendfrom=$request->bankname;
        $sms->smsdate=$smsdate;
        $sms->smstime=$request->smstime;
        $sms->thai_customer_id=$request->selthaicus;
        $sms->accno=$request->accno;
        $sms->user_insert=1;
        if($request->radinout==1){
            $sms->amount=str_replace(',','',$request->amount);
            $smstext='cashin to ' . $request->accno . ' Amount:' . $request->amount . 'B ' . $request->smsdate . ' ' . $request->smstime;
        }else{
            $sms->amount=-1 * floatval(str_replace(',','',$request->amount));
            $smstext='cashout from ' . $request->accno . ' Amount:' . $request->amount . 'B ' . $request->smsdate . ' ' . $request->smstime;
        }
        $sms->cur='THB';
        $sms->balance=str_replace(',','',$request->balance);
        $sms->smsby=Auth::user()->name;
        $sms->isopen=0;
        $sms->smstext=$smstext;
        $sms->smsnote=$request->smsnote;
        $sms->created_at=$current;
        $sms->updated_at=$current;
        if($sms->save()){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }


    }
    public function matchsmsidtotransfer(Request $request)
    {
        $ptr=PartnerTransfer::find($request->id);
        $ptr->thai_list=$request->thai_list;
        $ptr->thai_sms_id=$request->smsid;
        if($ptr->save()){
            DB::connection('mysql_thai')->table('sms')->where('id',$request->smsid)->update(['transfer_id'=>$request->id,'isopen'=>1]);
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function delmatchsmsidtotransfer(Request $request)
    {
        $ptr=PartnerTransfer::find($request->transfer_id);
        if($ptr->location_id==6){
            $ptr->status=0;
            $ptr->user_delete=Auth::id();
        }else{
            $ptr->thai_sms_id=null;
        }
        if($ptr->save()){
            DB::connection('mysql_thai')->table('sms')->where('id',$request->sms_id)->update(['transfer_id'=>null,'isopen'=>0]);
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function refreshacclist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1=date('Y-m-d', strtotime($request->d1));
        $d2=date('Y-m-d', strtotime($request->d2));
        $myc=collect();
        $thai_acc=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        foreach($thai_acc as $ta){
            $startbal=0;
            $balin=0;
            $balout=0;
            $oldbal=0;
            $closebal=0;
            $smsid=0;
            $closelist=ThaiCloseList::where('thai_account_id',$ta->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $smsid=$closelist->lastsmsid;
                $closebal=$closelist->balance;
            }
            $oldbal=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate','<',$d1)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->sum('amount');
            $startbal=$oldbal+$closebal;
            $balin=SMS::where('status',1)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','>',0)->sum('amount');
            $balout=SMS::where('status',1)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','<',0)->sum('amount');
            $baloutlist=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('thai_list',$ta->accno)->where('company_id',$selcomid)->where('status',1)->whereIn('trancode',[-3,-4])->sum('amount');
            $cashin=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('thai_list',$ta->accno)->where('company_id',$selcomid)->where('status',1)->where('trancode',1)->sum('amount');
            $balinlist=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('thai_list',$ta->accno)->where('company_id',$selcomid)->where('status',1)->whereIn('trancode',[3,4])->sum('amount');

            $receiveamt=SMS::where('status',1)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->whereNull('mix_from_id')->where('company_id',$selcomid)->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','>',0)->where('transfer_id','>',0)->sum('amount');

            $myc=$myc->push(['accno'=>$ta->accno,'startbal'=>$startbal,'balin'=>$balin,'balout'=>$balout,'baloutlist'=>$baloutlist,'cashin'=>$cashin,'receiveamt'=>$receiveamt,'balinlist'=>$balinlist]);
        }
        return response()->json(['acclist'=>$myc]);
    }
    public function thaisms()
    {
        $selcomid=Session('log_into_company_id');
        $myc=collect();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d', strtotime($current));
        $userid=Auth::id();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $thai_acc=ThaiAccount::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        //$banknames=ThaiAccount::where('status',1)->where('company_id',$selcomid)->select('bankname')->distinct()->get();
        $banknames=SmsName::where('company_id',$selcomid)->orderBy('no')->get();
        foreach($thai_acc as $ta){
            $startbal=0;
            $balin=0;
            $balout=0;
            $oldbal=0;
            $closebal=0;
            $smsid=0;
            $closelist=ThaiCloseList::where('thai_account_id',$ta->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $smsid=$closelist->lastsmsid;
                $closebal=$closelist->balance;
            }
            $oldbal=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate','<',$today)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->sum('amount');
            $startbal=$oldbal+$closebal;
            $balin=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate','=',$today)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','>',0)->sum('amount');
            $balout=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate','=',$today)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','<',0)->sum('amount');
            $baloutlist=PartnerTransfer::whereDate('dd',$today)->where('company_id',$selcomid)->where('thai_list',$ta->accno)->where('status',1)->whereIn('trancode',[-3,-4])->sum('amount');
            $balinlist=PartnerTransfer::whereDate('dd',$today)->where('company_id',$selcomid)->where('thai_list',$ta->accno)->where('status',1)->whereIn('trancode',[3,4])->sum('amount');

            $cashin=PartnerTransfer::whereDate('dd',$today)->where('company_id',$selcomid)->where('thai_list',$ta->accno)->where('status',1)->where('trancode',1)->sum('amount');
            $receiveamt=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate',$today)->whereNull('mix_from_id')->where('id','>',$smsid)->where('accno','=',$ta->accno)->where('amount','>',0)->where('transfer_id','>',0)->sum('amount');

            $myc=$myc->push(['accno'=>$ta->accno,'startbal'=>$startbal,'balin'=>$balin,'balout'=>$balout,'baloutlist'=>$baloutlist,'cashin'=>$cashin,'balinlist'=>$balinlist,'receiveamt'=>$receiveamt]);
        }
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();
        $provinces = Address::whereNull('province_id')->get();
        $userpartners=Customer::where('status',1)->where('company_id',$selcomid)
        ->where(function($q) use($userid){
            return $q->where('user_connect','like',$userid.',%')->orWhere('user_connect','like','%,' . $userid.',%')->orWhere('user_connect','like','%,' . $userid)->orWhere('user_connect',$userid);
        })->orderBy('no')->get();
        $sms=SMS::where('status',1)->where('company_id',$selcomid)->whereDate('smsdate',$today)->orderBy('id')->get();
        $cur=Currency::where('shortcut','THB')->where('company_id',$selcomid)->first();
        $cur_id=$cur->id;
        $thaicus=ThaiCustomer::where('status',1)->where('company_id',$selcomid)->get();
        return view('thaicashdraws.thaisms.index',compact('thai_acc','banknames','userpartners','partners','users','myc','sms','currencies','provinces','cur_id','thaicus'));
    }

   public function cashdraw()
   {
    $current = Carbon::now();
    $current->timezone('Asia/Phnom_Penh');
    $selcomid=Session('log_into_company_id');
    $users = User::where('active', 1)
    ->where(function ($q) use ($selcomid) {
        $q->where('company_id', $selcomid)
        ->orWhere('company_id', '')
        ->orWhereNull('company_id');
    })->get();
    // $notyetcashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->whereNull('iscashdraw')->where('trancode',-1)->orderBy('id')->get();
    // $cashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->where('iscashdraw','1')->where('trancode',-1)->orderBy('id')->get();
    $userid=Auth::id();
    $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
    $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
    $banks=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','BANK')->orderBy('no')->get();
    //$userpartners=Customer::where('status',1)->WhereRaw("FIND_IN_SET(?, user_connect)", [$userid])->orderBy('no')->get();
    $userpartners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BANK','AGENT','NOLIST']) ->orderBy('no')->get();

    $provinces = Address::whereNull('province_id')->get();
    $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();
    return view('thaicashdraws.cashdrawthai',compact('userpartners','partners','customers','banks','users','provinces','currencies'));
   }
   public function cashdraw1()
   {
    $current = Carbon::now();
    $current->timezone('Asia/Phnom_Penh');
    $userid=Auth::id();
    $selcomid=Session('log_into_company_id');
    $users = User::where('active', 1)
    ->where(function ($q) use ($selcomid) {
        $q->where('company_id', $selcomid)
        ->orWhere('company_id', '')
        ->orWhereNull('company_id');
    })->get();
    // $notyetcashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->whereNull('iscashdraw')->where('trancode',-1)->orderBy('id')->get();
    // $cashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->where('iscashdraw','1')->where('trancode',-1)->orderBy('id')->get();

    $userpartners=Customer::where('status',1)->where('company_id',$selcomid)->WhereRaw("FIND_IN_SET(?, user_connect)", [$userid])->orderBy('no')->get();
    $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
    $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
    $banks=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','BANK')->orderBy('no')->get();
    $provinces = Address::whereNull('province_id')->get();
    $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();
    $d1= date('Y-m-d', strtotime($current));
    $d2= date('Y-m-d', strtotime($current));
    $data=SmsProcess::where('status',1)->whereIn('step',[2,3])->where('missioncomplete',0)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->get();
    $data1=SmsProcess::where('status',1)->whereIn('step',[2,3])->where('missioncomplete',1)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->get();
    return view('thaicashdraws.cashdrawthai1',compact('userpartners','customers','partners','users','customers','banks','provinces','currencies','data','data1'));
   }
   public function cashdraw2()
   {
    $selcomid=Session('log_into_company_id');
    $current = Carbon::now();
    $current->timezone('Asia/Phnom_Penh');
    $users = User::where('active', 1)
    ->where(function ($q) use ($selcomid) {
        $q->where('company_id', $selcomid)
        ->orWhere('company_id', '')
        ->orWhereNull('company_id');
    })->get();
    $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
    $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
    $banks=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','BANK')->orderBy('no')->get();
    $provinces = Address::whereNull('province_id')->get();
    $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();

    $d1= date('Y-m-d', strtotime($current));
    $d2= date('Y-m-d', strtotime($current));
    $data=SmsProcess::where('status',1)->whereIn('step',[3])->where('missioncomplete',0)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))->get();
    //$data1=SmsProcess::where('status',1)->whereIn('step',[3])->where('missioncomplete',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->get();

    return view('thaicashdraws.cashdrawthai2',compact('customers','partners','users','customers','banks','provinces','currencies','data'));
   }
   public function searchcashdraw(Request $request)
   {
        // $data=SMS::where('isopen',0)->get();
        // return view('thaicashdraws.searchcashdrawresult',compact('data'));
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $notyetcashdraws=SMS::where('status',1)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('company_id',$selcomid)->where('amount','>',0)->where('isopen',0);
        $cashdraws=SMS::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->where('company_id',$selcomid)->where('amount','>',0)->where('isopen',1)->where('opmethod','<>','mixed');

        if($request->searchmore==1){
            if($request->searchby=='amt'){
                if($request->amt1<>null){
                    $amt1=str_replace(',','',$request->amt1);
                    $amt2=$amt1;
                    if($request->amt2<>null){
                        $amt2=str_replace(',','',$request->amt2);
                    }
                    $notyetcashdraws=$notyetcashdraws->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                    $cashdraws=$cashdraws->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);

                }

            }else if($request->searchby=='tel'){
                if($request->tel<>null){
                    $tel=$request->tel;
                    $notyetcashdraws=$notyetcashdraws->where('optel','like','%'.$request->tel.'%');
                    $cashdraws=$cashdraws->where('optel','like','%'.$request->tel.'%');
                    // $notyetcashdraws=$notyetcashdraws->where(function($query) use ($tel) {
                    //     $query->where('rectel','like','%'.$tel.'%')
                    //             ->orwhere('sendertel','like','%'.$tel.'%');
                    // });
                }
            }else if($request->searchby=='time'){
                if($request->time<>null){
                    $time=$request->time;
                    $notyetcashdraws=$notyetcashdraws->where('smstime',$request->time);
                    $cashdraws=$cashdraws->where('smstime',$request->time);

                }
            }

        }
        $notyetcashdraws=$notyetcashdraws->orderBy('id')->get();
        $cashdraws=$cashdraws->orderBy('opdate')->orderBy('id')->get();
        foreach($notyetcashdraws as $n){
            $found=CashdrawSelect::where('sms_id',$n->id)->exists();
            $n['is_select']=$found;
        }
        foreach($cashdraws as $c){
            $groupid='thaicashdraw-'.$c->smsp->id;
            $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$groupid)->where('company_id',$selcomid)->where('cdc_display',1)->orderBy('id')->get();
            $c->transferlist = $transfers->map(function($t) {
                return [
                    'id' => $t->id,
                    'dd'=>$t->dd,
                    'tt'=>$t->tt,
                    'tranname'=>$t->tranname,
                    'partnername'=>$t->partner->name,
                    'amount' => $t->amount,
                    'cur'=>$t->currency->sk,
                    'fee'=>$t->fee,
                    'curfee'=>$t->feecurrency->sk,
                    'rectel'=>$t->rectel,
                    'recname'=>$t->recname,
                    'thai_amt'=>$t->thai_amt,
                    'th_rate'=>$t->th_rate,
                    'moneycode'=>$t->moneycode,
                    'docodeby'=>$t->usercode->name,
                    'recordby'=>$t->user->name,
                    'useraffect'=>$t->useraffect->name,
                    'created_at' => $t->created_at,
                    'note' => $t->note,
                ];
            });
        }
        //return $cashdraws;
        return view('thaicashdraws.searchcashdrawresult',compact('notyetcashdraws','cashdraws'));

   }
    public function searchcashdrawreport(Request $request)
   {
        // $data=SMS::where('isopen',0)->get();
        // return view('thaicashdraws.searchcashdrawresult',compact('data'));
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $notyetcashdraws=SMS::where('status',1)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('company_id',$selcomid)->where('amount','>',0)->where('isopen',0);
        $cashdraws=SMS::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->where('company_id',$selcomid)->where('amount','>',0)->where('isopen',1)->where('opmethod','<>','mixed');

        if($request->searchby=='amt'){
            if($request->amt1<>null){
                $amt1=str_replace(',','',$request->amt1);
                $amt2=$amt1;
                if($request->amt2<>null){
                    $amt2=str_replace(',','',$request->amt2);
                }
                $notyetcashdraws=$notyetcashdraws->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                $cashdraws=$cashdraws->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);

            }

        }else if($request->searchby=='tel'){
            if($request->tel<>null){
                $tel=$request->tel;
                $notyetcashdraws=$notyetcashdraws->where('optel','like','%'.$request->tel.'%');
                $cashdraws=$cashdraws->where('optel','like','%'.$request->tel.'%');
                // $notyetcashdraws=$notyetcashdraws->where(function($query) use ($tel) {
                //     $query->where('rectel','like','%'.$tel.'%')
                //             ->orwhere('sendertel','like','%'.$tel.'%');
                // });
            }
        }else if($request->searchby=='time'){
            if($request->time<>null){
                $time=$request->time;
                $notyetcashdraws=$notyetcashdraws->where('smstime',$request->time);
                $cashdraws=$cashdraws->where('smstime',$request->time);

            }
        }


        $notyetcashdraws=$notyetcashdraws->orderBy('id')->get();
        $cashdraws=$cashdraws->orderBy('opdate')->orderBy('id')->get();

        foreach($cashdraws as $c){
            $groupid='thaicashdraw-'.$c->smsp->id;
            $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$groupid)->where('company_id',$selcomid)->where('cdc_display',1)->orderBy('id')->get();
            $c->transferlist = $transfers->map(function($t) {
                return [
                    'id' => $t->id,
                    'dd'=>$t->dd,
                    'tt'=>$t->tt,
                    'tranname'=>$t->tranname,
                    'partnername'=>$t->partner->name,
                    'amount' => $t->amount,
                    'cur'=>$t->currency->sk,
                    'fee'=>$t->fee,
                    'curfee'=>$t->feecurrency->sk,
                    'rectel'=>$t->rectel,
                    'recname'=>$t->recname,
                    'thai_amt'=>$t->thai_amt,
                    'th_rate'=>$t->th_rate,
                    'moneycode'=>$t->moneycode,
                    'docodeby'=>$t->usercode->name,
                    'recordby'=>$t->user->name,
                    'useraffect'=>$t->useraffect->name,
                    'created_at' => $t->created_at,
                    'note' => $t->note,
                ];
            });
        }
        //return $cashdraws;
        return view('thaicashdraws.searchcashdrawresultreport',compact('notyetcashdraws','cashdraws'));

   }
   public function seephoto(Request $request)
   {
    if($request->type=='th'){
        $cashdraw_photoes=CashdrawImage::where('sms_process_id',$request->id)->get();
    }else{
        $cashdraw_photoes=CashdrawImage::where('cashdraw_id',$request->id)->get();
    }
    return response()->json(['cashdraw_photoes'=>$cashdraw_photoes]);
   }
   public function getthaisms(Request $request)
   {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $sms=SMS::where('status',1)->where('company_id',$selcomid)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2));
        if($request->accno){
            $sms=$sms->where('accno',$request->accno);
        }
        if($request->selbysms){
            if($request->selbysms==1){//សារបាញ់ចូល
                $sms=$sms->where('amount','>','0');
            }else if($request->selbysms==2){//សារបាញ់ចេញ
                $sms=$sms->where('amount','<','0');
            }else if($request->selbysms==3){//សារទូទាត់រួច
                $sms=$sms->where('isopen','=','1');
            }else if($request->selbysms==4){//សារមិនទាន់ទូទាត់
                $sms=$sms->where('isopen','=','0');
            }
        }
        if($request->searchmore==1){
            if($request->searchby=='amt'){
                if($request->amt1<>null){
                    $amt1=str_replace(',','',$request->amt1);
                    $amt2=$amt1;
                    if($request->amt2<>null){
                        $amt2=str_replace(',','',$request->amt2);
                    }
                    $sms=$sms->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                }
            }else if($request->searchby=='tel'){
                if($request->tel<>null){
                    $tel=$request->tel;
                    $sms=$sms->where('optel','like','%'.$request->tel.'%');
                }
            }else if($request->searchby=='time'){
                if($request->time<>null){
                    $time=$request->time;
                    $sms=$sms->where('smstime',$request->time);

                }
            }

        }
        $sms=$sms->orderBy('id')->get();
        return view('thaicashdraws.thaisms.getsms',compact('sms'));

   }
   public function clearrefreshaction()
   {
        DB::connection('mysql_thai')->table('sms_refreshes')->delete();
   }
   public function updatestep(Request $request)
   {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd = date("Y-m-d",strtotime($current));
        if($request->mscp==1){
            //check code is complete or not
            //not null map_id mean open by cash we need money code
            $checkdocodeby=PartnerTransfer::where('ref_group_id',$request->groupid)->where('company_id',$selcomid)->whereNull('map_id')->whereNull('docodeby')->get();
            if($checkdocodeby->count()>0){
                return response()->json(['error'=>true]);
            }
        }
        DB::connection('mysql_thai')->table('sms_refreshes')->insert(['dd'=>$dd,'user_id'=>Auth::id(),'refreshstep'=>$request->step,'created_at'=>$current,'updated_at'=>$current]);
        //DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->id)->update(['step'=>$request->step,'missioncomplete'=>$request->mscp,'updated_at'=>$current]);
        return response()->json(['success'=>true,'error'=>false,'message'=>'Transaction has been finished']);
    }

   public function showgroupid(Request $request)
   {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $smsid=$request->smsid;
        $sms=SMS::where('id',$smsid)->where('company_id',$selcomid)->get();
        if(isset($request->group_id) && !is_null($request->group_id)){
            $transfers=PartnerTransfer::where('ref_group_id',$request->group_id)->where('company_id',$selcomid)->where('status',1)->orderBy('id')->get();
            $smsprocess=SmsProcess::where('group_id',$request->group_id)->where('company_id',$selcomid)->where('status',1)->get();
        }else{
            $transfers=PartnerTransfer::where('id',0)->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
            $smsprocess=SmsProcess::where('id',$request->smspid)->where('company_id',$selcomid)->where('status',1)->get();
        }
     return view('thaicashdraws.showgrouptransaction',compact('transfers','smsprocess','sms'));
   }
   public function deletegroupid(Request $request)
   {
        //return $request->all();
//check befor delete
        $selcomid=Session('log_into_company_id');
        $checkdocode=PartnerTransfer::where('ref_group_id',$request->groupid)->where('company_id',$selcomid)->whereNotNull('docodeby')->whereNull('cashdraw_codeid')->where('trancode',1)->exists();
        if($checkdocode){
            return response()->json(['error'=>true,'message'=>'transaction group can not delete']);
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if($request->btntext=='Restore'){
            if(DB::connection('mysql_thai')->table('sms')->where('id',$request->smsid)->where('company_id',$selcomid)->update(['isopen'=>0])){
                return response()->json(['success'=>true,'message'=>'sms has been restore']);
            }else{
                return response()->json(['error'=>true,'message'=>'sms can not restore']);
            }
        }else{
            if(DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->id)->where('company_id',$selcomid)->update(['status'=>0,'updated_at'=>$current,'del_by'=>Auth::user()->name]))
            {
                DB::connection('mysql_thai')->table('sms')->where('id',$request->smsid)->where('company_id',$selcomid)->update(['isopen'=>0]);
                if($request->groupid && $request->groupid<>''){
                    DB::connection('mysql')->table('partner_transfers')->where('ref_group_id',$request->groupid)->where('company_id',$selcomid)->whereNotNull('ref_group_id')->where('ref_group_id','<>','')->whereDate('dd',$request->opdate)->update(['mission_complete'=>2]);//prevent user edit
                    DB::connection('mysql')->table('partner_transfers')->where('ref_group_id',$request->groupid)->where('company_id',$selcomid)->whereNotNull('ref_group_id')->where('ref_group_id','<>','')->whereNull('docodeby')->whereNull('iscashdraw')->whereDate('dd',$request->opdate)->update(['status'=>0,'updated_at'=>$current,'user_delete'=>Auth::id()]);
                    if($request->paymethod=='Cash' || $request->paymethod=='Partner'){
                        DB::table('exchanges')->where('ref_group_id', $request->groupid)->where('company_id',$selcomid)->whereDate('dd',$request->opdate)->update(['status'=>0,'userdel'=>Auth::user()->name]);
                        DB::table('exchange_multis')->where('ref_group_id', $request->groupid)->where('company_id',$selcomid)->whereDate('dd',$request->opdate)->update(['status'=>0,'userdel'=>Auth::user()->name]);
                    }
                }
                $cashdrawimages=CashdrawImage::where('sms_process_id',$request->id)->get();
                foreach($cashdrawimages as $cms)
                {
                    File::delete(public_path('myimages/'.$cms->imgpath));
                }
                DB::table('cashdraw_images')->where('sms_process_id',$request->id)->delete();
                return response()->json(['success'=>true,'message'=>'related transaction delete']);
            }else{
                return response()->json(['error'=>true,'message'=>'transaction group can not delete']);
            }
        }
   }
   public function updatesmsnote(Request $request)
   {
    //return $request->all();
        $sms=SMS::find($request->txtsmsid);
        if($sms)
        {
            $sms->opname=$request->txtopname;
            $sms->optel=$request->txtoptel;
            $sms->opdesr=$request->txtopdesr;
            if($sms->save()){
                return response()->json(['opname'=>$sms->opname,'optel'=>$sms->optel]);
            }
        }
   }
   public function searchcashdraw1(Request $request)
   {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        //$data=SmsProcess::where('status',1)->whereIn('step',[2,3])->where('missioncomplete',$request->mscp)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2));
        if($request->update=='true'){
            $data=SmsProcess::join('sms','sms_processes.sms_id','=','sms.id')->where('sms_processes.status',1)->where('sms_processes.company_id',$selcomid)->whereIn('sms_processes.step',[1,2,3])->where('sms_processes.missioncomplete',0)->whereBetween(DB::raw('DATE(sms_processes.updated_at)'), array($d1, $d2))->select('sms_processes.*');
        }else{
            $data=SmsProcess::join('sms','sms_processes.sms_id','=','sms.id')->where('sms_processes.status',1)->where('sms_processes.company_id',$selcomid)->whereIn('sms_processes.step',[1,2,3])->where('sms_processes.missioncomplete',0)->whereBetween(DB::raw('DATE(sms_processes.opdate)'), array($d1, $d2))->select('sms_processes.*');
        }

        if($request->update=='true'){
            $dat1=SmsProcess::join('sms','sms_processes.sms_id','=','sms.id')->where('sms_processes.status',1)->where('sms_processes.company_id',$selcomid)->where('sms_processes.missioncomplete',1)->whereBetween(DB::raw('DATE(sms_processes.updated_at)'), array($d1, $d2))->select('sms_processes.*');
        }else{
            $data1=SmsProcess::join('sms','sms_processes.sms_id','=','sms.id')->where('sms_processes.status',1)->where('sms_processes.company_id',$selcomid)->where('sms_processes.missioncomplete',1)->whereBetween(DB::raw('DATE(sms_processes.opdate)'), array($d1, $d2))->select('sms_processes.*');
        }
        if($request->searchmore==1){
            if($request->searchby=='amt'){
                if($request->amt1<>null){
                    $amt1=str_replace(',','',$request->amt1);
                    $amt2=$amt1;
                    if($request->amt2<>null){
                        $amt2=str_replace(',','',$request->amt2);
                    }
                    $data=$data->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                    $data1=$data1->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);

                }

            }else if($request->searchby=='tel'){
                if($request->tel<>null){
                    $tel=$request->tel;
                    $data=$data->where('rectel','like','%'.$request->tel.'%');
                    $data1=$data1->where('rectel','like','%'.$request->tel.'%');

                }
            }else if($request->searchby=='time'){
                if($request->time<>null){
                    $time=$request->time;
                    $data=$data->where('sms.smstime',$time);
                    $data1=$data1->where('sms.smstime',$time);
                }
            }

        }
        $data=$data->orderBy('sms_processes.id')->get();
        $data1=$data1->orderBy('sms_processes.id')->get();

        return view('thaicashdraws.searchcashdrawresult1',compact('data','data1'));
   }
   public function searchcashdraw1new(Request $request)
   {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));

        $data=PartnerTransfer::where('status',1)->where('company_id',$selcomid)->where('trancode',1)->where('mission_complete',0)->where('thai_amt','>',0)->where('cdc_display',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2));
        $data1=PartnerTransfer::where('status',1)->where('company_id',$selcomid)->where('trancode',1)->where('mission_complete',1)->where('thai_amt','>',0)->where('cdc_display',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2));

        if($request->searchmore==1){
            if($request->searchby=='amt'){
                if($request->amt1<>null){
                    $amt1=str_replace(',','',$request->amt1);
                    $amt2=$amt1;
                    if($request->amt2<>null){
                        $amt2=str_replace(',','',$request->amt2);
                    }
                    //$data=$data->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                    //$data1=$data1->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                    if($request->isthaiamt==1){
                        $data=$data->where(function($q) use($amt1,$amt2){
                            $q->where(function($q1) use($amt1,$amt2){
                                $q1->whereRaw('abs(thai_transfer_amount)>=?',[$amt1])->whereRaw('abs(thai_transfer_amount)<=?',[$amt2]);
                            })->orWhere(function($q2) use($amt1,$amt2){
                                $q2->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);
                            });
                        });

                        $data1=$data1->where(function($q) use($amt1,$amt2){
                            $q->where(function($q1) use($amt1,$amt2){
                                $q1->whereRaw('abs(thai_transfer_amount)>=?',[$amt1])->whereRaw('abs(thai_transfer_amount)<=?',[$amt2]);
                            })->orWhere(function($q2) use($amt1,$amt2){
                                $q2->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);
                            });
                        });
                    }else{
                        $data=$data->where(function($q) use($amt1,$amt2){
                            $q->where(function($q1) use($amt1,$amt2){
                                $q1->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                            })->orWhere(function($q2) use($amt1,$amt2){
                                $q2->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);
                            });
                        });

                        $data1=$data1->where(function($q) use($amt1,$amt2){
                            $q->where(function($q1) use($amt1,$amt2){
                                $q1->whereRaw('abs(amount)>=?',[$amt1])->whereRaw('abs(amount)<=?',[$amt2]);
                            })->orWhere(function($q2) use($amt1,$amt2){
                                $q2->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);
                            });
                        });
                    }


                }

            }else if($request->searchby=='tel'){
                if($request->tel<>null){
                    $tel=$request->tel;
                    $data=$data->where('rectel','like','%'.$request->tel.'%');
                    $data1=$data1->where('rectel','like','%'.$request->tel.'%');

                }
            }else if($request->searchby=='thaiamount'){
                if($request->amt1<>null){
                    $amt1=str_replace(',','',$request->amt1);
                    $amt2=$amt1;
                    if($request->amt2<>null){
                        $amt2=str_replace(',','',$request->amt2);
                    }
                    $data=$data->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);
                    $data1=$data1->whereRaw('abs(thai_amt)>=?',[$amt1])->whereRaw('abs(thai_amt)<=?',[$amt2]);

                }
            }

        }
        $data=$data->orderBy('id')->get();
        $data1=$data1->orderBy('id')->get();
        foreach($data as $d)
        {
            $foundselect=CashdrawSelect::where('transfer_id',$d->id)->exists();
            $d['select']=$foundselect;
            $smsp=SmsProcess::where('id',explode('-',$d->ref_group_id)[1])->first();
            $d['smsp_id']=$smsp->id;
            $d['sms_id']=$smsp->sms_id;
            $d['sms_date']=$smsp->thaisms->smsdate??'';
            $d['sms_time']=$smsp->thaisms->smstime??'';
            $d['smsp_opdate']=$smsp->opdate;
            $d['smsp_optime']=$smsp->optime;
            $d['smsp_thaiamt']=$smsp->thai_amount;
            $d['smsp_thaicur']=$smsp->currency->sk;
            $d['smsp_cutseva']=$smsp->cut_seva;
            $d['smsp_amount']=$smsp->amount;
            $d['smsp_recname']=$smsp->recname;
            $d['smsp_rectel']=$smsp->rectel;
            $d['smsp_paymethod']=$smsp->paymethod;
            if ($d->cashdraw_codeid && $d->cdc_display == 1) {
                $check = PartnerTransfer::where('trancode', 1)
                    ->where('ref_group_id', $d->ref_group_id)
                    ->where('status', 1)
                    ->where('id','<>',$d->id)
                    ->whereNull('thai_transfer_amount')
                    ->where('cdc_display',1)
                    ->exists();

                $d['problem'] = $check? 1 : 0;
            }
        }
        foreach($data1 as $d1)
        {
            $foundselect=CashdrawSelect::where('transfer_id',$d1->id)->exists();
            $d1['select']=$foundselect;
            $smsp=SmsProcess::where('id',explode('-',$d1->ref_group_id)[1])->first();
            $d1['smsp_id']=$smsp->id;
            $d1['sms_id']=$smsp->sms_id;
            $d1['sms_date']=$smsp->thaisms->smsdate??'';
            $d1['sms_time']=$smsp->thaisms->smstime??'';
            $d1['smsp_opdate']=$smsp->opdate;
            $d1['smsp_optime']=$smsp->optime;
            $d1['smsp_thaiamt']=$smsp->thai_amount;
            $d1['smsp_thaicur']=$smsp->currency->sk;
            $d1['smsp_cutseva']=$smsp->cut_seva;
            $d1['smsp_amount']=$smsp->amount;
            $d1['smsp_recname']=$smsp->recname;
            $d1['smsp_rectel']=$smsp->rectel;
            $d1['smsp_paymethod']=$smsp->paymethod;

        }
        return view('thaicashdraws.searchcashdrawresult1new',compact('data','data1'));
   }
   public function searchcashdraw2(Request $request)
   {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $data=SmsProcess::where('status',1)->where('company_id',$selcomid)->whereIn('step',[3])->where('missioncomplete',0)->whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))->orderBy('id')->get();
        //$data1=SmsProcess::where('status',1)->whereIn('step',[3])->where('missioncomplete',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2))->get();

        return view('thaicashdraws.searchcashdrawresult2',compact('data'));
   }
   public function countsmsrefresh(Request $request)
   {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=date('Y-m-d',strtotime($current));
        //$countrow=SmsRefresh::where('refreshstep',$request->step)->whereDate('dd',$dd)->count();
        $countrow=SmsRefresh::whereDate('dd',$dd)->count();

        return response()->json(['countrow'=>$countrow]);
   }
   public function delcashdrawaction(Request $request)
    {
        DB::table('cashdraw_selects')->where('sms_id',$request->id)->delete();
    }
    public function delcashdrawaction1(Request $request)
    {
        DB::table('cashdraw_selects')->where('sms_process_id',$request->id)->delete();
    }
    public function delcashdrawaction2(Request $request)
    {
        DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();
    }
    public function deleteuseraction(Request $request)
    {
        DB::table('cashdraw_selects')->where('sms_id',$request->id)->delete();
        DB::table('partner_cashdraw_temps')->where('sms_id',$request->id)->delete();

    }
    public function deleteuseraction1(Request $request)
    {
        DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();

    }
    public function cashdrawclearclick(Request $request)
    {
        $d1 = str_replace('/', '-', $request->d1);
        $d2 = str_replace('/', '-', $request->d2);
        $sd1= date('Y-m-d', strtotime($d1));
        $sd2= date('Y-m-d', strtotime($d2));

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $useractions=CashdrawSelect::whereDate('created_at','>=',$sd1)->whereDate('created_at','<=',$sd2)->whereNotNull('sms_id')->orderBy('id')->get()->load('user','thaisms');
        return response()->json(['useractions'=>$useractions]);
    }
    public function cashdrawclearclick1(Request $request)
    {
        //return $request->all();
        $d1 = str_replace('/', '-', $request->d1);
        $d2 = str_replace('/', '-', $request->d2);
        $sd1= date('Y-m-d', strtotime($d1));
        $sd2= date('Y-m-d', strtotime($d2));

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $useractions=CashdrawSelect::whereDate('created_at','>=',$sd1)->whereDate('created_at','<=',$sd2)->whereNotNull('transfer_id')->orderBy('id')->get()->load('user','transfer');
        return response()->json(['useractions'=>$useractions]);
    }
   public function opencashdraw(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $check=SmsProcess::where('sms_id',$request->id)->where('status',1)->exists();
        if($check){
            return response()->json(['error'=>true,'errorsms'=>'This transaction ID is working.']);
        }
         $ptransfer=SMS::where('id',$request->id)->where('status',1)->first();
        // if(!$ptransfer){
        //     return response()->json(['error'=>true,'errorsms'=>'no transaction found']);
        // }else{
        //     if(Auth::user()->role->name!='Admin'){
        //       $exchangetousd=UserReport::exchangetousd(abs($ptransfer->amount),$ptransfer->currency_id);
        //       if(floatval($request->amtset)<floatval($exchangetousd[0])){
        //           return response()->json(['error'=>true,'errorsms'=>'maximum amount cashdraw limit']);
        //       }
        //     }
        // }

        $thbcur=Currency::where('shortcut','THB')->where('company_id',$selcomid)->first();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $cashdrawsel=new CashdrawSelect();
        $cashdrawsel->sms_id=$request->id;
        $cashdrawsel->user_id=Auth::id();
        $cashdrawsel->created_at=$current;
        try{
            $cashdrawsel->saveOrFail();
        }catch(\Exception $exception){
            //return view('moneytransfers.thiscashdrawalreadyopen');
            $selby=CashdrawSelect::where('sms_id',$request->id)->first();
            return response()->json(['error'=>true,'errorsms'=>$selby->user->name . ' is processing...']);
        }
        if($request->isselect==1){
          $tempcashdraw=new PartnerCashdrawTemp();
          $tempcashdraw->select_by_id=Auth::id();
          $tempcashdraw->sms_id=$ptransfer->id;
          $tempcashdraw->transfer_date=$ptransfer->smsdate;
          $tempcashdraw->partner_id=0;
          $tempcashdraw->user_id=0;
          $tempcashdraw->sender_name=$ptransfer->sendfrom;
          $tempcashdraw->sender_tel=$ptransfer->accno;
          $tempcashdraw->rec_name=$ptransfer->opname;
          $tempcashdraw->rec_tel=$ptransfer->optel;
          $tempcashdraw->amount=$ptransfer->amount;
          $tempcashdraw->currency_id=$thbcur->id;
          $tempcashdraw->created_at=$current;
          $tempcashdraw->updated_at=$current;
          try{
              $tempcashdraw->saveOrFail();
          }catch(\Exception $exception){
              //return view('moneytransfers.thiscashdrawalreadyopen');
              $selby=PartnerCashdrawTemp::where('sms_id',$request->id)->first();
              return response()->json(['error'=>true,'errorsms'=>$selby->selectby->name . ' is processing...']);
          }
        }
            $partners=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();

            $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
            $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
            $provinces = Address::whereNull('province_id')->get();

            $currencies=Currency::where('active',1)->where('ispandp',0)->get();

            $mex=ExchangeMulti::whereNull('mapcode')->where('user_id',Auth::user()->id)->orderBy('id')->get();
            $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))
                    ->whereNull('mapcode')->where('user_id',Auth::user()->id)
                    ->groupBy('curbuy')->get();
            $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))
                ->whereNull('mapcode')->where('user_id',Auth::user()->id)
                ->groupBy('cursale')->get();
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
            return response()->json(['ptransfer'=>$ptransfer,'thbcur'=>$thbcur,'mex'=>$mex,'totalbuy'=>$totalbuy,'totalsale'=>$totalsale,'cashin'=>$cashin,'cashout'=>$cashout]);

    }
    public function opencashdraw1(Request $request)
    {
        //return $request->all();
        $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$request->groupid)->where('trancode',1)->where('Thai_amt','>','0')->where('cdc_display',1)->orderBy('id')->get()->load('usercode','user','partner');

        $smsprocess=SmsProcess::where('id',$request->id)->where('status',1)->first();
        $exchanges=Exchange::where('status',1)->where('ref_group_id',$request->groupid)->orderBy('id')->get();
        if(!$smsprocess){
            return response()->json(['error'=>true,'errorsms'=>'no transaction found']);
        }else{
            // if(Auth::user()->role->name!='Admin'){
            //   $exchangetousd=UserReport::exchangetousd(abs($ptransfer->amount),$ptransfer->currency_id);
            //   if(floatval($request->amtset)<floatval($exchangetousd[0])){
            //       return response()->json(['error'=>true,'errorsms'=>'maximum amount cashdraw limit']);
            //   }
            // }
        }
        //$thbcur=Currency::where('shortcut','THB')->first();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $cashdrawsel=new CashdrawSelect();
        $cashdrawsel->sms_process_id=$request->id;
        $cashdrawsel->user_id=Auth::id();
        $cashdrawsel->created_at=$current;
        try{
            $cashdrawsel->saveOrFail();
        }catch(\Exception $exception){
            //return view('moneytransfers.thiscashdrawalreadyopen');
            $selby=CashdrawSelect::where('sms_process_id',$request->id)->first();
            return response()->json(['error'=>true,'errorsms'=>$selby->user->name . ' is processing...']);
        }

            $partners=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();

            $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
            $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
            $provinces = Address::whereNull('province_id')->get();

            $currencies=Currency::where('active',1)->where('ispandp',0)->get();

            return response()->json(['smsprocess'=>$smsprocess,'transfers'=>$transfers,'exchanges'=>$exchanges]);

    }
    public function opencashdraw1new(Request $request)
    {
        //return $request->all();
         // 1. Validate and parse groupid
        if (!isset($request->groupid) || strpos($request->groupid, '-') === false) {
            return response()->json(['error' => true, 'errorsms' => 'Invalid group ID format']);
        }

        [$prefix, $smsp_id] = explode('-', $request->groupid);

        // 2. Find active SMS process
        $smsprocess = SmsProcess::where('id', $smsp_id)->where('status', 1)->first();
        if (!$smsprocess) {
            return response()->json(['error' => true, 'errorsms' => 'No SMS process found']);
        }

        $transfer=PartnerTransfer::where('id',$request->id)->get()->load('usercode','user','partner','currency');
        $sumtransfer=PartnerTransfer::where('id','<>',$request->id)->where('status',1)->where('ref_group_id',$request->groupid)->where('trancode',1)->whereNull('cashdraw_codeid')->sum('thai_amt');
        $smsamt=DB::connection('mysql_thai')->table('sms_processes')->where('group_id',$request->groupid)->first();
        if($smsamt){
            $smsamt1=$smsamt->amount;
        }else{
            $smsamt1=0;
        }

        if(!$transfer){
            return response()->json(['error'=>true,'errorsms'=>'no transaction found']);
        }else {

        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $cashdrawsel=new CashdrawSelect();
        $cashdrawsel->transfer_id=$request->id;
        $cashdrawsel->user_id=Auth::id();
        $cashdrawsel->created_at=$current;
        try{
            $cashdrawsel->saveOrFail();
        }catch(\Exception $exception){
            //return view('moneytransfers.thiscashdrawalreadyopen');
            $selby=CashdrawSelect::where('transfer_id',$request->id)->first();
            return response()->json(['error'=>true,'errorsms'=>$selby->user->name . ' is processing...']);
        }

            // $partners=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();

            // $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
            // $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
            // $provinces = Address::whereNull('province_id')->get();

            // $currencies=Currency::where('active',1)->where('ispandp',0)->get();

            return response()->json(['error'=>false,'transfer'=>$transfer,'smsamt'=>$smsamt1,'sumtransfer'=>$sumtransfer]);

    }

    public function mixsms(Request $request)
    {
        //return($request->all());
        $selcomid=Session('log_into_company_id');
        foreach ($request->list_amount_open as $key => $value) {
            $check=SMS::find($request->list_transferid[$key]);
            if($check && $check->isopen==1){
                return response()->json(['error'=>true,'message'=>'found id:' . $request->list_transferid[$key] . ' already done.']);
            }
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $opdate = date("Y/m/d",strtotime($current));
        $optime = date("H:i:s",strtotime($current));
        $totalamt=0;
        $sendfrom=array();
        $mixamt='';
        $mixaccno=array();
        $mixfromid=array();
        foreach ($request->list_amount_open as $key => $value) {
            $amt=floatval(str_replace(',','',$request->list_amount_open[$key]));
            $totalamt+=floatval($amt);
            if($mixamt==''){
                $mixamt=$request->list_amount_open[$key];
            }else{
                $mixamt .= '|'.$request->list_amount_open[$key];
            }

            if(!in_array($request->list_sendertel[$key],$mixaccno)){
                array_push($mixaccno,$request->list_sendertel[$key]);
            }

            if(!in_array($request->list_transferid[$key],$mixfromid)){
                array_push($mixfromid,$request->list_transferid[$key]);
            }

            if(!in_array($request->list_sendername[$key],$sendfrom)){
                array_push($sendfrom,$request->list_sendername[$key]);
            }


            DB::table('partner_cashdraw_temps')->where('sms_id',$request->list_transferid[$key])->delete();
            DB::connection('mysql_thai')->table('sms')->where('id',$request->list_transferid[$key])->update(['isopen'=>1,'opdate'=>$opdate,'opname'=>$optime,'opmethod'=>'mixed']);
        }
        $newsms=new SMS();
        $newsms->smsid='mixed-'.$opdate. ' ' .$optime;
        $newsms->sendfrom=implode("|",$sendfrom);
        $newsms->smsdate=$opdate;
        $newsms->smstime=$optime;
        $newsms->smstext='Mixed Amount ' . $mixamt;
        $newsms->accno=implode("|",$mixaccno);
        $newsms->amount=$totalamt;
        $newsms->cur='THB';
        $newsms->balance=0;
        $newsms->smsby=Auth::user()->name;
        $newsms->isopen=0;
        $newsms->mix_from_id=implode("|",$mixfromid);
        $newsms->opmethod='';
        $newsms->company_id=$selcomid;
        if($newsms->save()){
            return response()->json(['success'=>true,'message'=>'mixed sms completed']);
        }else{
            return response()->json(['error'=>true,'message'=>'mixed sms fails']);
        }


    }
    public function clearmixsms(Request $request)
    {
        $check=SmsProcess::where('sms_id',$request->id)->where('status',1)->exists();
        if($check){
            return response()->json(['error'=>true,'message'=>'This transaction ID is working.']);
        }
        $mixid=explode('|',$request->mixid);
        foreach($mixid as $id){
            DB::connection('mysql_thai')->table('sms')->where('id',$id)->update(['isopen'=>0,'opmethod'=>'Cash']);
            DB::table('cashdraw_selects')->where('sms_id',$id)->delete();
        }
        if(DB::connection('mysql_thai')->table('sms')->where('id',$request->id)->update(['status'=>0]));
        {
            return response()->json(['success'=>true,'message'=>'Clear Mixed']);
        }
    }
    public function updatetransferinfo(Request $request)
    {
        //return $request->all();
         $transferid=PartnerTransfer::find($request->transferid3);
         [$prefix, $smsp_id] = explode('-', $transferid->ref_group_id);

        // 2. Find active SMS process
        $smsprocess = SmsProcess::where('id', $smsp_id)->where('status', 1)->first();
        if (!$smsprocess) {
            return response()->json(['error' => true, 'errorsms' => 'No SMS process found']);
        }

        if($request->mekun3==1){
            $tranname='បាញ់ចេញ';
        }else{
            $tranname='បាញ់ចូល';
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $opdate = date("Y/m/d",strtotime($current));
        if($request->btnsavetext=='រក្សាទុក'){
            //$transferid=PartnerTransfer::find($request->transferid3);
            $isnew=1;
            $ptf=new PartnerTransfer();
            $ptf->trancode=$request->mekun3;
            $ptf->tranname=$tranname;
            $ptf->mekun=$request->mekun3;
            $ptf->user_id=Auth::id();
            $ptf->dd=$opdate;
            $ptf->tt=$optime;
            $ptf->ref_group_id=$request->groupid3;
            $ptf->location_id=0;
            $ptf->thai_seva=$transferid->thai_seva??0;
            $ptf->thaiseva_exchange=$transferid->thaiseva_exchange??0;

        }else{
            $isnew=0;
            $ptf=PartnerTRansfer::find($request->transferid3);
            if($request->thai_cut_seva<>0){
                if(isset($request->selcurwing3)){
                    $ptf->thaiseva_exchange=$this->exchangethai($request->selcurwing3,str_replace(',','',$request->thai_cut_seva));
                }
            }
        }
        if(isset($request->selbankname3)){
            $ptf->parrent_id=$request->selbankname3;
        }
        if(isset($request->selcurwing3)){
            $ptf->fee_currency_id=$request->selcurwing3;
            $ptf->cuscharge_currency_id=$request->selcurwing3;
            $ptf->currency_id=$request->selcurwing3;
        }
        $ptf->amount=floatval($request->mekun3) * floatval(str_replace(',','',$request->exchangeamount3));
        $ptf->cuscharge=str_replace(',','',$request->cuscharge3) ;
        $ptf->cuscharge_ex=str_replace(',','',$request->cuscharge3) ;

        $ptf->fee=floatval($request->mekun3) * floatval(str_replace(',','',$request->partnerfee3));
        $ptf->fee_ex=floatval($request->mekun3) * floatval(str_replace(',','',$request->partnerfee3));

        $ptf->recname=$request->wingrecname3;
        $ptf->rectel=$request->wingrectel3;
        $ptf->moneycode=$request->moneycode3;
        if($request->moneycode3!=''){
            $ptf->docodeby=$request->docodebyid3;
        }
        $ptf->thai_amt=str_replace(',','',$request->thaiamt3);
        $ptf->thai_cur=$request->thaicurid3;
        $ptf->th_rate=str_replace(',','',$request->exchangerate3);
        $ptf->th_rateinfo=$request->exchangerateinfo3;
        $ptf->th_buyinfo=$request->buyinfo3;
        $ptf->th_saleinfo=$request->exchangesaleinfo3;
        if(isset($request->selbankname3)){
            $ptf->user_affect=$this->getuseraffectbank($request->selbankname3);
        }
        if($ptf->save()){
            if($isnew==1){
                $id=$ptf->id;
                DB::table('partner_transfers')->where('id','=',$request->transferid3)->update(['cdc_display'=>'0']);

            }else{
                $id=$request->transferid3;
            }
            return response()->json(['id'=>$id]);
        }


    }
    public function notyetready(Request $request)
    {
        //return $request->all();
        $transfer=PartnerTransfer::find($request->id);
        $transfer->mission_complete=0;

        if($transfer->save()){
            DB::table('exchanges')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'userdel'=>Auth::user()->name]);
            DB::table('exchange_multis')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'userdel'=>Auth::user()->name]);
            return response(['success'=>true,'message'=>'transaction has been reset']);
        }
    }
    public function updatetransferready(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $opdate = date("Y/m/d",strtotime($current));
        $note='';
        DB::table('partner_transfers')->where('id',$request->transferid3)->update(['mission_complete'=>1,'updated_at'=>$current]);
        if($request->selcurwing3!==$request->thaicurid3 && $request->selcurwing3!==''){
            if($request->exchangecur3=='USD'){
                $this->saveexchangebyrow($opdate,$optime, 'transfer-'. $request->transferid3,$note,$current,Auth::id(),$request->thaicurid3,$request->thaiamt3,$request->exchangeamount3,$request->thaicur3,$request->exchangecur3,$request->exchangerate3,$request->exchangerateinfo3,$request->exchangebuyinfo3,$request->exchangesaleinfo3);
            }else{
                $bankrateinfo=explode(';',$request->exchangerateinfo3)[1];
                $this->saveexchangeproductbyrow($opdate,$optime,'transfer-'. $request->transferid3,$note,$current,Auth::id(),$request->thaicurid3,$request->thaiamt3,$request->exchangeamount3,$request->thaicur3,$request->exchangecur3,$request->exchangerate3,$bankrateinfo,$request->exchangebuyinfo3,$request->exchangesaleinfo3);
            }
        }
    }
    public function updatetransfer0(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'banktid0.*' => 'required', //input array validate
            'bankname0.*' => 'required', //input array validate
            'bankamt0.*' => 'required', //input array validate
            'bankcur0.*' => 'required', //input array validate
            'bankseva0.*' => 'required', //input array validate

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $opdate = date("Y/m/d",strtotime($current));
        $allrecname='';
        $allrectel='';
        $isnew=0;

        foreach ($request->banktid0 as $key => $value) {
            $amt=floatval(str_replace(',','',$request->bankamt0[$key]));
            if($request->trancode0==1){
              if($amt>0){
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }else{
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }
            }elseif($request->trancode0==-1){
              if($amt>0){
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }else{
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }
            }
            if($allrectel==''){
                $allrectel=$request->bankrectel0[$key];
            }else{
                $allrectel .='|'.$request->bankrectel0[$key];
            }
            if($allrecname==''){
                $allrecname=$request->bankrecname0[$key];
            }else{
                $allrecname .='|' .$request->bankrecname0[$key];
            }
            if($request->cashdrawcodeid0[$key]>0 && isset($request->bankcurexchange0[$key]) || $request->banktid0[$key]==''){
                $isnew=1;
                $ptf=new PartnerTransfer();
                $ptf->trancode=$trancode;
                $ptf->tranname=$tranname;
                $ptf->mekun=$trancode;
                $ptf->user_id=Auth::id();
                $ptf->dd=$opdate;
                $ptf->tt=$optime;
                $ptf->parrent_id=$request->bankid0[$key];
                $ptf->ref_group_id=$request->groupid;
            }else{
                $ptf=PartnerTransfer::find($request->banktid0[$key]);
            }
            $imgname=$request->imageoldpath0[$key];

            if(isset($request->input_image0[$key])){
                if($request->input_image0[$key]){
                  $image = $request->input_image0[$key];
                  if($request->bankrectel0[$key]==''){
                    $imgname = time() . '_' . $image->getClientOriginalName();
                  }else{
                      $imgname = str_replace(' ','',$request->bankrectel0[$key]) . '_' . $image->getClientOriginalName();
                  }
                  File::delete(public_path('qrcode/'.$request->imagepath0[$key]));
                  $image->move(public_path('qrcode'), $imgname);
                }
            }
            $ptf->qrcode=$imgname;
            if(isset($request->bankid0[$key])){
                $ptf->parrent_id=$request->bankid0[$key];
            }
            if(isset($request->bankcurexchange0[$key])){
                if($request->bankcurexchange0[$key]==''){
                    $ptf->amount=-1 * floatval($request->trancode0) * floatval(str_replace(',','',$request->bankamt0[$key]));
                    $ptf->currency_id=$request->bankcur0[$key];
                    $ptf->cuscharge_currency_id=$request->bankcur0[$key];
                    $ptf->fee_currency_id=$request->bankcur0[$key];
                }else{
                    $ptf->amount=-1 * floatval($request->trancode0) * floatval(str_replace(',','',$request->bankamtexchange0[$key]));
                    $ptf->currency_id=$request->bankcurexchange0[$key];
                    $ptf->cuscharge_currency_id=$request->bankcurexchange0[$key];
                    $ptf->fee_currency_id=$request->bankcurexchange0[$key];
                }
            }

            $ptf->cuscharge=0;
            $ptf->fee=str_replace(',','',$request->bankseva0[$key]);
            $ptf->bonus=0;
            // $ptf->sendername=$request->sendername;
            // $ptf->sendertel=str_replace(' ','',$request->sendertel);
            $ptf->recname=$request->bankrecname0[$key];
            $ptf->rectel=str_replace(' ','',$request->bankrectel0[$key]);
            $ptf->moneycode=$request->wingcodeinfo0[$key];
            $ptf->docodeby=$request->wingcodeinfoby0[$key];
            $ptf->cashdraw_codeid=null;
            //$ptf->note=$transferto;
            //$ptf->from_partner_id=$pid;
            $ptf->action='';
            //$ptf->created_at=$current;
            $ptf->updated_at=$current;
            //$ptf->ref_number=$ref_number;
            //$ptf->ref_group_id=$ref_number;
            $ptf->thai_amt=str_replace(',','',$request->bankamt0[$key]);
            $ptf->thai_cur=$request->bankcur0[$key];
            $ptf->th_rate=$request->bankrate0[$key];
            $ptf->th_rateinfo=$request->bankrateinfo0[$key];
            $ptf->th_buyinfo=$request->bankbuyinfo0[$key];
            $ptf->th_saleinfo=$request->banksaleinfo0[$key];

            if($ptf->save()){
                $id=$ptf->id;
                $note='បើកវេរលុយថៃ';
                if(isset($request->bankcurexchange0[$key])){
                    if($request->bankcurexchange0[$key]<>''){
                        if($request->bankcursale0[$key]=='USD'){
                            $this->saveexchangebyrow($opdate,$optime,$request->groupid,$note,$current,Auth::id(),$request->bankcur0[$key],$request->bankamt0[$key],$request->bankamtexchange0[$key],$request->bankcurbuy0[$key],$request->bankcursale0[$key],$request->bankrate0[$key],$request->bankrateinfo0[$key],$request->bankbuyinfo0[$key],$request->banksaleinfo0[$key]);
                        }else{
                            $bankrateinfo=explode(';',$request->bankrateinfo0[$key])[1];
                            $this->saveexchangeproductbyrow($opdate,$optime,$request->groupid,$note,$current,Auth::id(),$request->bankcur0[$key],$request->bankamt0[$key],$request->bankamtexchange0[$key],$request->bankcurbuy0[$key],$request->bankcursale0[$key],$request->bankrate0[$key],$bankrateinfo,$request->bankbuyinfo0[$key],$request->banksaleinfo0[$key]);
                        }
                    }
                }

                if($isnew==1){
                    DB::table('partner_transfers')->where('id',$request->banktid0[$key])->update(['thai_amt'=>null]);
                }

            }
            $isnew=0;

        }

    }
    public function updatetransfer(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'banktid.*' => 'required', //input array validate
            'bankname.*' => 'required', //input array validate
            'bankamt.*' => 'required', //input array validate
            'bankcur.*' => 'required', //input array validate
            'bankseva.*' => 'required', //input array validate

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $isnew=0;
        $optime = date("H:i:s",strtotime($current));
        $opdate = date("Y/m/d",strtotime($current));
        $dddd = date("Y/m/d",strtotime($current));
        $allrecname='';
        $allrectel='';
        // if($request->step==3 || $request->step==2){
        //     DB::connection('mysql_thai')->table('sms_refreshes')->insert(['dd'=>$dddd,'user_id'=>Auth::id(),'refreshstep'=>$request->step,'created_at'=>$current,'updated_at'=>$current]);
        //     DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->transfer_id)->update(['step'=>$request->step,'updated_at'=>$current]);
        // }
        // DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->smsprocess_id)->update(['isgetcode'=>$request->isgetcode]);
        DB::connection('mysql_thai')->table('sms_refreshes')->insert(['dd'=>$dddd,'user_id'=>Auth::id(),'refreshstep'=>$request->step,'created_at'=>$current,'updated_at'=>$current]);

        foreach ($request->banktid as $key => $value) {
            $amt=floatval(str_replace(',','',$request->bankamt[$key]));
            if($request->trancode1==1){
              if($amt>0){
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }else{
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }
            }elseif($request->trancode1==-1){
              if($amt>0){
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }else{
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }
            }
            if($allrectel==''){
                $allrectel=$request->bankrectel[$key];
            }else{
                $allrectel .='|'.$request->bankrectel[$key];
            }
            if($allrecname==''){
                $allrecname=$request->bankrecname[$key];
            }else{
                $allrecname .='|' .$request->bankrecname[$key];
            }
            if($request->cashdrawcodeid[$key]>0 && $request->bankcurexchange_txt[$key]>0){
                $isnew=1;
                $ptf=new PartnerTransfer();
                $ptf->trancode=$trancode;
                $ptf->tranname=$tranname;
                $ptf->mekun=$trancode;
                $ptf->user_id=Auth::id();
                $ptf->dd=$opdate;
                $ptf->tt=$optime;
                $ptf->parrent_id=$request->bankid_txt[$key];
                $ptf->ref_group_id=$request->groupid;
            }else{
                $ptf=PartnerTransfer::find($request->banktid[$key]);
            }

            if($request->bankid_txt[$key]>0){
                $ptf->parrent_id=$request->bankid_txt[$key];
            }
            if($request->bankcurexchange_txt[$key]>0){
                if($request->bankcurexchange_txt[$key]==0){
                    $ptf->amount=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankamt[$key]));
                    $ptf->currency_id=$request->bankcur[$key];
                    $ptf->cuscharge_currency_id=$request->bankcur[$key];
                    $ptf->fee_currency_id=$request->bankcur[$key];
                }else{
                    $ptf->amount=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankamtexchange[$key]));
                    $ptf->currency_id=$request->bankcurexchange_txt[$key];
                    $ptf->cuscharge_currency_id=$request->bankcurexchange_txt[$key];
                    $ptf->fee_currency_id=$request->bankcurexchange_txt[$key];
                }
            }

            $ptf->cuscharge=str_replace(',','',$request->cuscharge[$key]);
            //$ptf->cuscharge=0;

            $ptf->fee=str_replace(',','',$request->bankseva[$key]);
            $ptf->bonus=0;
            // $ptf->sendername=$request->sendername;
            // $ptf->sendertel=str_replace(' ','',$request->sendertel);
            $ptf->recname=$request->bankrecname[$key];
            $ptf->rectel=str_replace(' ','',$request->bankrectel[$key]);
            $ptf->moneycode=$request->wingcodeinfo[$key];
            $ptf->docodeby=$request->wingcodeinfoby[$key];
            //$ptf->cashdraw_codeid=null;
            //$ptf->note=$transferto;
            //$ptf->from_partner_id=$pid;
            $ptf->action='';
            //$ptf->created_at=$current;
            $ptf->updated_at=$current;
            //$ptf->ref_number=$ref_number;
            //$ptf->ref_group_id=$ref_number;
            $ptf->thai_amt=str_replace(',','',$request->bankamt[$key]);
            $ptf->thai_cur=$request->bankcur[$key];
            $ptf->th_rate=$request->bankrate[$key];
            $ptf->th_rateinfo=$request->bankrateinfo[$key];
            $ptf->th_buyinfo=$request->bankbuyinfo[$key];
            $ptf->th_saleinfo=$request->banksaleinfo[$key];

            if($ptf->save()){
                if($isnew==1){
                    DB::table('partner_transfers')->where('id',$request->banktid[$key])->update(['cdc_display'=>0]);
                }
                $note='បើកវេរលុយថៃ';
                $id=$ptf->id;
                if($request->bankcurexchange_txt[$key]>0){
                    if($request->bankcurexchange_txt[$key]<>''){
                        if($request->bankcursale[$key]=='USD'){
                            $this->saveexchangebyrow($opdate,$optime,$request->groupid,$note,$current,Auth::id(),$request->bankcur[$key],$request->bankamt[$key],$request->bankamtexchange[$key],$request->bankcurbuy[$key],$request->bankcursale[$key],$request->bankrate[$key],$request->bankrateinfo[$key],$request->bankbuyinfo[$key],$request->banksaleinfo[$key]);
                        }else{
                            //$bankrateinfo=explode(';',$request->bankrateinfo[$key])[1];
                            $bankrateinfo=$request->bankrateinfo[$key];
                            $this->saveexchangeproductbyrow($opdate,$optime,$request->groupid,$note,$current,Auth::id(),$request->bankcur[$key],$request->bankamt[$key],$request->bankamtexchange[$key],$request->bankcurbuy[$key],$request->bankcursale[$key],$request->bankrate[$key],$bankrateinfo,$request->bankbuyinfo[$key],$request->banksaleinfo[$key]);
                        }
                    }
                }

                if($isnew==1){
                    DB::table('partner_transfers')->where('id',$request->banktid[$key])->update(['thai_amt'=>null]);
                }
            }

        }
        //update smsprocess
        //DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->transfer_id)->update(['step'=>$request->step,'missioncomplete'=>$request->mscp,'rectel'=>$allrectel,'recname'=>$allrecname]);
        //DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->transfer_id)->update(['rectel'=>$allrectel,'recname'=>$allrecname]);

    }

    public function savecashdrawwingcode(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $opdate= date('Y-m-d', strtotime($current));
        $trancode=PartnerTransfer::find($request->tranid);

        $ptf1=new PartnerTransfer();
        $ptf1->tranname='ដកកូត'.$request->customername_out;
        $ptf1->trancode=-1;
        $ptf1->mekun=-1;
        $ptf1->dd=$opdate;
        $ptf1->tt=$optime;
        $ptf1->user_id=Auth::id();
        $ptf1->parrent_id=$request->customerid_out;
        $ptf1->child='';
        $ptf1->amount=-1 * floatval(str_replace(',','',$request->wingamount_out));
        $ptf1->currency_id=$request->wingcurid_out;
        $ptf1->cuscharge=0;
        $ptf1->cuscharge_currency_id=$request->wingcurid_out;
        $ptf1->fee=-1 * floatval(str_replace(',','',$request->wingfee_out)) ;
        $ptf1->fee_ex=-1 * floatval(str_replace(',','',$request->wingfee_out)) ;
        $ptf1->fee_currency_id=$request->wingcurid_out;
        $ptf1->thai_seva=-1 * $trancode->thai_seva??0;
        $ptf1->thaiseva_exchange=-1 * $trancode->thaiseva_exchange??0;
        $ptf1->bonus=0;
        $ptf1->sendername='';
        $ptf1->sendertel='';
        $ptf1->recname='';
        $ptf1->rectel='';
        $ptf1->note='';
        $ptf1->location_id=0;
        //$ptf1->thai_amt=str_replace(',','',$request->thaiamt);
        $ptf1->docodeby=Auth::id();
        $ptf1->user_affect=$this->getuseraffectbank($request->customerid_out);
        $ptf1->iscashdraw=1;
        $ptf1->ref_number='';
        $ptf1->ref_group_id=$request->refgroupid;
        $ptf1->updated_at=$current;
        $ptf1->created_at=$current;
        $ptf1->company_id=$selcomid;
        if($ptf1->save()){
            $id=$ptf1->id;
            //DB::table('partner_transfers')->where('id',$request->tranid)->update(['cashdraw_codeid'=>$id,'docodeby'=>null,'moneycode'=>'']);
            DB::table('partner_transfers')->where('id',$request->tranid)->update(['cashdraw_codeid'=>$id,'mission_complete'=>0]);
            DB::connection('mysql_thai')->table('sms_processes')->where('id',$request->smsprocess_id)->update(['isgetcode'=>0]);
            return response()->json(['success'=>true,'id'=>$request->tranid]);
        }
    }
    public function savemultiimage(Request $request,$cashdraw_id,$current)
    {
        $n=0;
        foreach ($request->imgphotopath as $key => $value) {
            $n+=1;
            $imgname=$value;
            $folderPath = "public/myimages/";
            $image_paths = explode(";base64,", $imgname);
            $image_base64 = base64_decode($image_paths[1]);
            //$filename = uniqid() . '.jpg';
            $filename='th_'.$cashdraw_id.'_'.$n.'.jpg';
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $cimg=new CashdrawImage();
            $cimg->sms_process_id=$cashdraw_id;
            $cimg->imgpath=$filename;
            $cimg->created_at=$current;
            $cimg->updated_at=$current;
            $cimg->save();
        }
    }
    public function savecashdraw(Request $request)
    {
        //return $request->all();
        $getimagename='';
        $paymethod='Cash';
        $isexchangelist=0;
        $prefix='thaicashdraw-';
        if($request->hasmulticashdraw==1){
          $validator = Validator::make($request->all(), [
              'list_transferid.*' =>'required|unique:cashdraws,transfer_id,NULL,id,status,1',
          ]);
        }else{
            $validator = Validator::make($request->all(), [
                //'transfer_id' =>'required',
                'amount'=>'required',
                'selcur'=>'required',
                'transfer_id'=>'required|unique:mysql_thai.sms_processes,sms_id,NULL,id,status,1',
            ]);
          $exist_smsid=DB::connection('mysql_thai')->table('sms_processes')->where('sms_id',$request->transfer_id)->where('status',1)->exists();
          if($exist_smsid){
            return response()->json(['error'=>'this smsid has been taken in database']);
          }
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->hasexchange=='1'){
            $validator1 = Validator::make($request->all(), [
                'txtbuy' => 'required', //input array validate
                'lblbuy' => 'required', //input array validate
                'txtrate' => 'required', //input array validate
                'lblsale' => 'required',
            ]);
        }
        if($request->hasexchange=='2'){
            $validator2 = Validator::make($request->all(), [
                'txtbuys.*' => 'required', //input array validate
                'txtsales.*' => 'required', //input array validate
            ]);
        }
        if($request->hascontinue=='1'){
            $paymethod='Partner';
            $isexchangelist=1;
            $validator3 = Validator::make($request->all(), [
                'selpartner_continue' => 'required', //input array validate
                'amount_continue' => 'required', //input array validate
                'selcur_continue'=>'required',
                'cuscharge_continue'=>'required',
                'fee_continue'=>'required',

            ]);
        }
        if($request->hasbankpayment=='1'){
            $paymethod='List';
            $isexchangelist=1;
          $validator33 = Validator::make($request->all(), [
              'bankname.*' => 'required', //input array validate
              'bankamt.*' => 'required', //input array validate
              'bankcur.*' => 'required', //input array validate
              'bankseva.*' => 'required', //input array validate
          ]);
        }

        if($request->hasbankpayment==1){
            if ($validator33->fails()) {
                return response()->json(['error'=>$validator33->errors()->all()]);
            }
        }

        $other='';
        if($request->hasexchange==1){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
            $other='ប្តូរប្រាក់';
        }
        if($request->hasexchange==2){
            if ($validator2->fails()) {
                return response()->json(['error'=>$validator2->errors()->all()]);
            }
            $other='ប្តូរប្រាក់ច្រើនតួ';
        }
        if($request->hascontinue==1){
            if ($validator3->fails()) {
                return response()->json(['error'=>$validator3->errors()->all()]);
            }
            if($other=='')
            {
                $other='បន្តដៃគូ' . $request->topartner;
            }else
            {
                $other .=' និងបន្តដៃគូ' . $request->topartner;
            }
        }

        // $paymethod='Cash';
        // if($request->hascontinue=='1'){
        //     $paymethod='List';
        // }
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $optime1=date('H:i:s',strtotime($optime . ' +1 seconds'));
        $date = str_replace('/', '-', $request->opdate);
        $opdate= date('Y-m-d', strtotime($date));
        $date1 = str_replace('/', '-', $request->opdates);
        $opdate1= date('Y-m-d', strtotime($date1));
        $ref_group_id='';
        if($request->hasmulticashdraw==1){
          foreach ($request->list_transferid as $key => $value) {
            $cashdraw=new SmsProcess();
            $cashdraw->company_id=$selcomid;
            $cashdraw->sms_id=$request->list_transferid[$key];
            $cashdraw->user_id=Auth::id();
            $cashdraw->opdate=$opdate;
            $cashdraw->optime=$optime;
            $cashdraw->amount=str_replace(',','',$request->list_amount[$key]);
            $cashdraw->currency_id=$request->list_currencyid[$key];
            $cashdraw->paymethod=$paymethod;
            $cashdraw->rectel=str_replace(' ','',$request->list_rectel[$key]);
            $cashdraw->recname=$request->list_recname[$key];
            $cashdraw->note=$request->txtnote;
            $cashdraw->step=$request->step;
            $cashdraw->isgetcode=$request->isgetcode;
            $cashdraw->missioncomplete=$request->mission_complete;
            $cashdraw->group_id=$ref_group_id;
            $cashdraw->created_at=$current;
            $cashdraw->updated_at=$current;

            if($cashdraw->save()){
              if($key==0){
                $cashdraw_id=$cashdraw->id;
                $ref_group_id='thaicashdraw-'. $cashdraw_id;
              }
              $found_group=1;
              $userprint=Auth::user()->name;
              DB::connection('mysql_thai')->table('sms')->where('id',$request->list_transferid[$key])->update(['isopen'=>'1','opdate'=>$opdate,'optime'=>$optime,'opmethod'=>$paymethod,'cutseva'=>str_replace(',','',$request->cuscharge)]);

            }
          }
          DB::table('partner_cashdraw_temps')->where('select_by_id',Auth::id())->delete();
        }else{
          $cashdraw=new SmsProcess();
          $cashdraw->company_id=$selcomid;
          $cashdraw->sms_id=$request->transfer_id;
          $cashdraw->user_id=Auth::id();
          $cashdraw->opdate=$opdate;
          $cashdraw->optime=$optime;
          $cashdraw->thai_amount=str_replace(',','',$request->amount);
          $cashdraw->cut_seva=str_replace(',','',$request->cuscharge);
          $cashdraw->amount=str_replace(',','',$request->openamt);
          $cashdraw->currency_id=$request->selcur;

          $cashdraw->paymethod=$paymethod;
          $cashdraw->rectel=str_replace(' ','',$request->rec_tel);
          $cashdraw->recname=$request->rec_name;
          $cashdraw->note=$request->txtnote;
          $cashdraw->step=$request->step;
          $cashdraw->isgetcode=$request->isgetcode;
          $cashdraw->missioncomplete=$request->mission_complete;
          $cashdraw->created_at=$current;
          $cashdraw->updated_at=$current;
          if($cashdraw->save()){
              $found_group='';
              $cashdraw_id=$cashdraw->id;
              $userprint=Auth::user()->name;
              DB::connection('mysql_thai')->table('sms')->where('id',$request->transfer_id)->update(['isopen'=>'1','opdate'=>$opdate,'optime'=>$optime,'opmethod'=>$paymethod,'cutseva'=>str_replace(',','',$request->cuscharge)]);
                if($request->hascontinue==1){
                    $found_group=1;
                    $ptf1=new PartnerTransfer();
                    $ptf1->company_id=$selcomid;
                    $ptf1->tranname='បើកវេរបន្ត '.$request->topartner;
                    $ptf1->trancode=4;
                    $ptf1->mekun=1;
                    $ptf1->dd=$opdate;
                    $ptf1->tt=$optime1;
                    $ptf1->user_id=Auth::id();
                    $ptf1->parrent_id=$request->selpartner_continue;
                    $ptf1->child=$request->son;
                    $ptf1->amount= str_replace(',','',$request->amount_continue);
                    $ptf1->currency_id=$request->selcur_continue;
                    $ptf1->cuscharge=str_replace(',','',$request->cuscharge_continue);
                    $ptf1->cuscharge_currency_id=$request->txtcur2;
                    $ptf1->location_id=6;
                    if($request->selcur_continue<>$request->txtcur2){
                        $ptf1->cuscharge_ex = (new MoneyTransferController)->doexchange($request->selcur_continue,$request->txtcur2,str_replace(',','',$request->cuscharge_continue));
                        //second way
                        //$ptf1->cuscharge_ex =app('App\Http\Controllers\MoneyTransferController')->doexchange($request->selcur_continue,$request->txtcur2,str_replace(',','',$request->cuscharge_continue));
                    }else{
                        $ptf1->cuscharge_ex=str_replace(',','',$request->cuscharge_continue);
                    }
                    $ptf1->fee=str_replace(',','',$request->fee_continue);
                    $ptf1->fee_currency_id=$request->txtcur1;
                    if($request->selcur_continue<>$request->txtcur1){
                        $ptf1->fee_ex = (new MoneyTransferController)->doexchange($request->selcur_continue,$request->txtcur1,str_replace(',','',$request->fee_continue));

                    }else{
                        $ptf1->fee_ex=str_replace(',','',$request->fee_continue);
                    }
                    $ptf1->bonus=0;
                    $ptf1->sendername=$request->sendername_continue;
                    $ptf1->sendertel=str_replace(' ','',$request->sendertel_continue);
                    $ptf1->recname=$request->recname_continue;
                    $ptf1->rectel=str_replace(' ','',$request->rectel_continue);
                    $ptf1->note=$request->frompartner . ' ថ្ងៃទទួល:'. $request->invdate . ' ' . $request->smstime . ' ចំនួន:' . $request->amount . $request->curshortcut;
                    // $ptf1->ref_number='cashdraw-' . $cashdraw_id . ',transfer-'.$request->transfer_id;
                    $ptf1->mission_complete==2;
                    //$ptf1->ref_number=$prefix . $cashdraw_id;
                    $ptf1->ref_group_id=$prefix . $cashdraw_id;
                    //$ptf1->thai_amt=str_replace(',','',$request->amount);
                    $ptf1->thai_seva=str_replace(',','',$request->cuscharge);
                    $ptf1->user_affect=$this->getuseraffectbank($request->selpartner_continue);
                    if($request->hasexchange>0){
                        $ptf1->thaiseva_exchange=$this->exchangethai($request->selcur_continue,str_replace(',','',$request->cuscharge));
                    }else{
                        $ptf1->thaiseva_exchange=str_replace(',','',$request->cuscharge);
                    }
                    $ptf1->created_at=$current;
                    $ptf1->updated_at=$current;
                    $ptf1->location_id=0;
                    $ptf1->thai_cur=$request->selcur;
                    $ptf1->thai_transfer_amount=str_replace(',','',$request->amount);
                    $ptf1->thai_cashdraw_seva=str_replace(',','',$request->cuscharge);
                    $ptf1->thai_amount_left=str_replace(',','',$request->openamt);
                    if($request->hasexchange==1){
                        $ptf1->th_rate=$request->txtrate;
                    }
                    if($ptf1->save())
                    {
                        $idc=$ptf1->id;
                        //$refnum='transfer-' . $idc;
                        //$pname='បន្តទៅ '.$ptf1->partner->name .' ថ្ងៃទី' . $request->opdate . ' ចំនួន' . $this->phpformatnumber($ptf1->amount) . $ptf1->currency->sk;
                        //DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['note'=>$pname,'ref_number'=>$refnum]);
                        //DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['note'=>$pname]);


                    }
                    $continueto='';
                    if(is_null($ptf1->child)){
                        $continueto=$ptf1->partner->name;
                    }else{
                        $continueto=$ptf1->child;
                    }

                }
          }

        }
        if($request->clickfrom<>'btncontinuewingbank'){
            if($request->clickfrom=='btnopencashdraw'){
                $isexchangelist==0;
              }
            if($request->hasexchange==1){
              if(is_null($request->maincur)){
                  $this->saveexchangeproduct($request,$opdate,$optime1,$prefix . $cashdraw_id,'បើកវេរថៃ+ប្តូរប្រាក់',$current,Auth::id(),$isexchangelist);
              }else{
                  $this->saveexchange($request,$opdate,$optime1,$prefix . $cashdraw_id,'បើកវេរថៃ+ប្តូរប្រាក់',$current,Auth::id(),$isexchangelist);
              }
            }else if($request->hasexchange==2){
                $this->savemultiexchanges($request,$opdate,$optime1,$prefix . $cashdraw_id,'បើកវេរថៃ+ប្តូរប្រាក់',$current,Auth::id(),$isexchangelist);
            }
            if($request->hasexchange>0){
                $found_group=1;
                $es=ExchangeMulti::where('status',1)->where('othercode',$prefix . $cashdraw_id)->get();
                foreach($es as $e){
                    if($e->buy>$e->sale){
                        $extext=$this->phpformatnumber($e->buy) . $e->curbuy . '/' . $this->phpformatnumber($e->rate) . '='  . $this->phpformatnumber($e->sale) . $e->cursale;
                    }else{
                        $extext=$this->phpformatnumber($e->buy) . $e->curbuy . '*' . $this->phpformatnumber($e->rate) . '='  . $this->phpformatnumber($e->sale) . $e->cursale;
                    }

                }
            }
        }
        if($request->hasbankpayment==1){
          $found_group=1;
          $getimagename= $this->customerpaytransferbybank($request,$opdate,$optime1,$prefix . $cashdraw_id,'បើកវេរថៃទូទាត់តាមធនាគា',$cashdraw_id,$current,'0',Auth::id());
      }
        if($found_group==1){
          DB::connection('mysql_thai')->table('sms_processes')->where('id',$cashdraw_id)->update(['group_id'=>$prefix.$cashdraw_id]);
        }
        // if($request->step==2 || $request->step==3){
        //     DB::connection('mysql_thai')->table('sms_refreshes')->insert(['dd'=>$opdate,'user_id'=>Auth::id(),'refreshstep'=>$request->step,'created_at'=>$current,'updated_at'=>$current]);
        // }
        DB::connection('mysql_thai')->table('sms_refreshes')->insert(['dd'=>$opdate,'user_id'=>Auth::id(),'refreshstep'=>$request->step,'created_at'=>$current,'updated_at'=>$current]);
        if($request->foundmulti_image>0){
            $this->savemultiimage($request,$cashdraw_id,$current);
        }else if($request->clickcapture2==1){

            $imgname=$request->photopath;
            $folderPath = "public/myimages/";
            $image_paths = explode(";base64,", $imgname);
            $image_base64 = base64_decode($image_paths[1]);
            //$filename = uniqid() . '.jpg';
            $filename='th_'.$cashdraw_id.'.jpg';
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $cimg=new CashdrawImage();
            $cimg->sms_process_id=$cashdraw_id;
            $cimg->imgpath=$filename;
            $cimg->created_at=$current;
            $cimg->updated_at=$current;
            $cimg->save();
        }else{
            $image=$request->file('image2');
            if($image){
                //File::delete(public_path('myimages/'.$old_image));
                //$imgname=time().'-'.$image->getClientOriginalName();
                $imgname='th_'.$cashdraw_id.'-'.$image->getClientOriginalName();
                $image->move(public_path('myimages/'),$imgname);
                $cimg=new CashdrawImage();
                $cimg->sms_process_id=$cashdraw_id;
                $cimg->imgpath=$imgname;
                $cimg->created_at=$current;
                $cimg->updated_at=$current;
                $cimg->save();
              }
        }
        return response()->json(['cashdrawid'=>$prefix.$cashdraw_id,'id'=>$cashdraw_id,'qrcode'=>$getimagename]);
    }
    public function getuseraffectbank($cid){
        //prevent 2 users use the save account
        $usercapital=UserCapital::where('agent_id',$cid)->where('trancode',2)->where('status',1)->orderBy('id','DESC')->first();
        if($usercapital){
            return $usercapital->user_id_affect;
        }else{
            $customer=Customer::where('id',$cid)->first();
            $userconnect1=explode(',',$customer->user_connect)[0];
            if($userconnect1==''){
                return null;
            }else{
                return $userconnect1;
            }
        }
    }

    public function customerpaytransferbybank(Request $request,$trdate,$trtime,$ref_number,$transferto,$mainid,$current,$pid,$usersave)
    {
        $note='';
        $refnum='';
        $id=0;
        $amt=0;
        $trancode=0;
        $tranname='';
        $allrecname='';
        $allrectel='';
        $imgname='';
        $i=0;
        $selcomid=Session('log_into_company_id');
        foreach ($request->bankid as $key => $value) {
            $i+=1;
            if($request->agenttype[$key]=='Cash'){
                $note="Bycash";
            }else{
                $note="By" . $request->customertype[$key];
            }
            $amt=floatval(str_replace(',','',$request->bankamt[$key]));
            if($request->trancode1==1){
              if($amt>0){
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }else{
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }
            }elseif($request->trancode1==-1){
              if($amt>0){
                $trancode=1;
                $tranname='បាញ់ចេញ';
              }else{
                $trancode=-1;
                $tranname='បាញ់ចូល';
              }
            }

            if($request->agenttype[$key]=='Cash'){//បំបែកលុយថៃយកមុខផ្ទះខ្លះ
                $ptf1=new PartnerTransfer();
                $ptf1->company_id=$selcomid;
                $ptf1->tranname="ទទួលលុយថៃ";//.$request->bankname[$key];
                $ptf1->trancode=-1;
                $ptf1->dd=$trdate;
                $ptf1->mekun=-1;
                $ptf1->tt=$trtime;
                $ptf1->user_id=$usersave;
                $ptf1->parrent_id=$value;
                if($request->bankcurexchange[$key] &&  !is_null($request->bankcurexchange[$key])){
                    $ptf1->amount=-1 *  floatval(str_replace(',','',$request->bankamtexchange[$key]));
                    $ptf1->currency_id=$request->bankcurexchange[$key];
                    $ptf1->cuscharge_currency_id=$request->bankcurexchange[$key];
                    $ptf1->fee_currency_id=$request->bankcurexchange[$key];
                }else{
                    $ptf1->amount=-1 * floatval(str_replace(',','',$request->bankamt[$key]));
                    $ptf1->currency_id=$request->bankcur[$key];
                    $ptf1->cuscharge_currency_id=$request->bankcur[$key];
                    $ptf1->fee_currency_id=$request->bankcur[$key];
                }
                $ptf1->cuscharge=0;
                $ptf1->fee=str_replace(',','',$request->bankseva[$key]);
                $ptf1->fee_ex=str_replace(',','',$request->bankseva[$key]);

                $ptf1->bonus=0;
                $ptf1->sendername=$request->smstime;
                $ptf1->sendertel=$request->invdate;
                $ptf1->recname=$request->bankrecname[$key];
                $ptf1->rectel=str_replace(' ','',$request->bankrectel[$key]);
                $ptf1->moneycode=$request->wingcodeinfo[$key];
                $ptf1->docodeby=$request->wingcodeinfoby[$key];
                $ptf1->note=$note;
                $ptf1->from_partner_id=$pid;
                $ptf1->action='';
                $ptf1->created_at=$current;
                $ptf1->updated_at=$current;
                //$ptf1->ref_number=$ref_number;
                $ptf1->mission_complete=$request->mission_complete;
                $ptf1->ref_group_id=$ref_number;
                $ptf1->thai_amt=str_replace(',','',$request->bankamt[$key]);
                $ptf1->thai_cur=$request->bankcur[$key];
                $ptf1->th_rate=$request->bankrate[$key];
                $ptf1->th_rateinfo=$request->bankrateinfo[$key];
                $ptf1->th_buyinfo=$request->bankbuyinfo[$key];
                $ptf1->th_saleinfo=$request->banksaleinfo[$key];
                //$ptf1->map_id=$map_id;
                $ptf1->location_id=0;
                $ptf1->thai_transfer_amount=str_replace(',','',$request->amount);
                $ptf1->thai_cashdraw_seva=str_replace(',','',$request->cuscharge);
                $ptf1->thai_amount_left=str_replace(',','',$request->openamt);
                if($ptf1->save()){
                    //$map_id2=$ptf1->id;
                    //DB::table('partner_transfers')->where('id',$map_id)->update(['map_id'=>$map_id2]);
                }

            }else{
                $imgname=$request->imagepath[$key];
                $ptf=new PartnerTransfer();
                if(isset($request->input_image[$key])){
                    if($request->input_image[$key]){
                      $image = $request->input_image[$key];
                      if($request->bankrectel[$key]==''){
                        $imgname = time() . '_' . $image->getClientOriginalName();
                      }else{
                          $imgname = str_replace(' ','',$request->bankrectel[$key]) . '_' . $image->getClientOriginalName();
                      }
                      $image->move(public_path('qrcode'), $imgname);
                    }
                }
                $ptf->company_id=$selcomid;
                $ptf->qrcode=$imgname;
                $ptf->tranname=$tranname;//.$request->bankname[$key];
                $ptf->trancode=$trancode;
                $ptf->dd=$trdate;
                $ptf->mekun=$trancode;
                $ptf->tt=$trtime;
                $ptf->user_id=$usersave;
                $ptf->parrent_id=$value;
                if($i==1){
                    $ptf->thai_seva=str_replace(',','',$request->cuscharge);

                }else{
                    $ptf->thai_seva=0;
                    $ptf->thaiseva_exchange=0;
                }
                if($request->bankcurexchange[$key] &&  !is_null($request->bankcurexchange[$key])){
                    $ptf->amount=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankamtexchange[$key]));
                    $ptf->currency_id=$request->bankcurexchange[$key];
                    $ptf->cuscharge_currency_id=$request->bankcurexchange[$key];
                    $ptf->fee_currency_id=$request->bankcurexchange[$key];
                    if($i==1){
                        $ptf->thaiseva_exchange=$this->exchangethai($request->bankcurexchange[$key],str_replace(',','',$request->cuscharge));
                    }
                }else{
                    $ptf->amount=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankamt[$key]));
                    $ptf->currency_id=$request->bankcur[$key];
                    $ptf->cuscharge_currency_id=$request->bankcur[$key];
                    $ptf->fee_currency_id=$request->bankcur[$key];
                    if($i==1){
                       $ptf->thaiseva_exchange=str_replace(',','',$request->cuscharge);
                    }
                }

                $ptf->cuscharge=0;
                $ptf->fee=str_replace(',','',$request->bankseva[$key]);
                $ptf->fee_ex=str_replace(',','',$request->bankseva[$key]);
                $ptf->bonus=0;
                $ptf->sendername=$request->smstime;
                $ptf->sendertel=$request->invdate;
                $ptf->recname=$request->bankrecname[$key];
                $ptf->rectel=str_replace(' ','',$request->bankrectel[$key]);
                $ptf->moneycode=$request->wingcodeinfo[$key];
                $ptf->docodeby=$request->wingcodeinfoby[$key];
                $ptf->note=$note;
                $ptf->location_id=0;
                $ptf->from_partner_id=$pid;
                $ptf->action='';
                $ptf->created_at=$current;
                $ptf->updated_at=$current;
                //$ptf->ref_number=$ref_number;
                $ptf->mission_complete=$request->mission_complete;
                $ptf->ref_group_id=$ref_number;
                $ptf->thai_amt=str_replace(',','',$request->bankamt[$key]);
                $ptf->thai_cur=$request->bankcur[$key];
                $ptf->th_rate=$request->bankrate[$key];
                $ptf->th_rateinfo=$request->bankrateinfo[$key];
                $ptf->th_buyinfo=$request->bankbuyinfo[$key];
                $ptf->th_saleinfo=$request->banksaleinfo[$key];
                $ptf->user_affect=$this->getuseraffectbank($value);
                $ptf->thai_transfer_amount=str_replace(',','',$request->amount);
                $ptf->thai_cashdraw_seva=str_replace(',','',$request->cuscharge);
                $ptf->thai_amount_left=str_replace(',','',$request->openamt);
                if($ptf->save()){
                    $map_id=$ptf->id;
                    if($request->mission_complete==1){
                        $ex_group_id='transfer-' . $map_id;
                        if($request->bankcurexchange[$key]<>''){
                            if($request->bankcursale[$key]=='USD'){
                                $this->saveexchangebyrow($trdate,$trtime,$ex_group_id,$note,$current,$usersave,$request->bankcur[$key],$request->bankamt[$key],$request->bankamtexchange[$key],$request->bankcurbuy[$key],$request->bankcursale[$key],$request->bankrate[$key],$request->bankrateinfo[$key],$request->bankbuyinfo[$key],$request->banksaleinfo[$key]);
                            }else{
                                $bankrateinfo=explode(';',$request->bankrateinfo[$key])[1];
                                //$bankrateinfo=$request->bankrateinfo[$key];
                                $this->saveexchangeproductbyrow($trdate,$trtime,$ex_group_id,$note,$current,$usersave,$request->bankcur[$key],$request->bankamt[$key],$request->bankamtexchange[$key],$request->bankcurbuy[$key],$request->bankcursale[$key],$request->bankrate[$key],$bankrateinfo,$request->bankbuyinfo[$key],$request->banksaleinfo[$key]);
                            }
                        }
                    }


                }
            }

        }
        return($imgname);
        //DB::connection('mysql_thai')->table('sms_processes')->where('id',$mainid)->update(['rectel'=>$allrectel,'recname'=>$allrecname]);

    }
    public function exchangethai($cur_id,$amt)
    {
        $currency=Currency::find($cur_id);
        $cur=$currency->shortcut;
        $examt=0;
        $r=0;
        $s='';
        if($cur=='USD'){
            $c=Currency::where('shortcut','THB')->first();
            if($c){
                $r=$c->buy;
                $s=$c->optsign;
            }
        }else{
            $cur12='THB-' . $cur;
            $c=ProductRate::where('pshortcut',$cur12)->first();
            $r=$c->rate;
            $s=$c->operator;
        }

        if($s=='/'){
            $examt=$amt / $r;
        }else{
            $examt=$amt * $r;
        }
        return $examt;
    }
    public function resetexchange(Request $request)
    {
        $success=false;
        $message='';
        DB::table('exchange_multis')->where('ref_group_id',$request->groupid)->delete();
        if(DB::table('exchanges')->where('ref_group_id',$request->groupid)->delete()){
            $success=true;
            $message='exchange has been reset';
        }
        $exchanges=Exchange::where('ref_group_id',$request->groupid)->get();
        return response()->json(['success'=>$success,'message'=>$message,'exchanges'=>$exchanges]);


    }
    //exchange by row part
    public function saveexchangebyrow($trandate,$trantime,$othercode,$note,$current,$usersave,$product_id,$buy,$sale,$curbuy,$cursale,$exchange_rate,$origin_rate,$buyinfo,$saleinfo)
    {
       //return $request->all();
        $selcomid=Session('log_into_company_id');
       $e=new Exchange();
       $e->dd=$trandate;
       $e->tt=$trantime;
       $e->currency_id=$product_id;
       $e->product=str_replace(',','',$buy);
       $e->pcur=$curbuy;
       $e->amount=-1 *  floatval(str_replace(',','',$sale));
       $e->maincur=$cursale;
       $e->rate=str_replace(',','',$exchange_rate);
       $e->drate=str_replace(',','',$origin_rate);
       $e->cashreceive=0;
       $e->cashreturn=0;
       $e->multiexchangecode='';
       $e->othercode=$othercode;
       $e->note=$note;
       $e->ref_group_id=$othercode;
       $e->user_id=$usersave;
       $e->isexchangelist=1;
       $e->created_at=$current;
       $e->updated_at=$current;
       $e->company_id=$selcomid;
       if($e->save()){
          $id=$e->id;
          $em=new ExchangeMulti();
          $em->user_id=$usersave;
          $em->dd=$trandate;
          $em->tt=$trantime;
          $em->buy=str_replace(',','',$buy);
          $em->curbuy=$curbuy;
          $em->sale=str_replace(',','',$sale);
          $em->cursale=$cursale;
          $em->buyinfo=$buyinfo;
          $em->saleinfo=$saleinfo;
          $em->rate=str_replace(',','',$exchange_rate);
          $em->drate=str_replace(',','',$origin_rate);
          $em->cashreceive=0;
          $em->cashreturn=0;
          $em->rateinfo='';
          $em->note=$note;
          $em->mapcode=$id;
          $em->isexchangelist=1;
          $em->othercode=$othercode;
          $em->ref_group_id=$othercode;
          $em->created_at=$current;
          $em->updated_at=$current;
          $em->company_id=$selcomid;
          $em->save();
          DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
         // return response()->json(['success'=>'save completed','id'=>$id]);
          return true;
       }else{
         // return response()->json(['error'=>'save error']);
          return false;
       }

    }
    public function saveexchangeproductbyrow($trandate,$trantime,$othercode,$note,$current,$usersave,$product_id,$buy,$sale,$curbuy,$cursale,$exchange_rate,$origin_rate,$buyinfo,$saleinfo)
    {
        $selcomid=Session('log_into_company_id');
           $rb = explode(';',$buyinfo);
           $rs = explode(';',$saleinfo);
           $rate_buy=$rb[1];
           $pid2=$rs[0];
           //$cur_buy=$rb[6];
           $luy =(float)str_replace(',','',$buy) / (float)str_replace(',','',$rate_buy);

             $e1 = new Exchange();
             $e1->dd=$trandate;
             $e1->tt=$trantime;
             $e1->currency_id=$product_id;
             $e1->product=str_replace(',','',$buy);
             $e1->pcur=$curbuy;
             $e1->amount=-1 * $luy;
             $e1->maincur='USD';
             $e1->rate=str_replace(',','',$rate_buy);
             $e1->drate=str_replace(',','',$rate_buy);
             $e1->cashreceive=0;
             $e1->cashreturn=0;
             $e1->multiexchangecode='';
             $e1->othercode=$othercode;
             $e1->note=$note;
             $e1->ref_group_id=$othercode;
             $e1->user_id=$usersave;
             $e1->created_at=$current;
             $e1->updated_at=$current;
             $e1->isexchangelist=1;
             $e1->company_id=$selcomid;
             $e1->save();
             $id=$e1->id;
             $rate_sale =(float)str_replace(',','',$sale) / (float)$luy;
             $e2 = new Exchange();
             $e2->dd=$trandate;
             $e2->tt=$trantime;
             $e2->currency_id=$pid2;
             $e2->product=-1 * str_replace(',','',$sale);
             $e2->pcur=$cursale;
             $e2->amount=$luy;
             $e2->maincur='USD';
             $e2->rate=str_replace(',','',$rate_sale);
             $e2->drate=str_replace(',','',$rate_sale);
             $e2->cashreceive=0;
             $e2->cashreturn=0;
             $e2->multiexchangecode=$id;
             $e2->othercode=$othercode;
             $e2->note=$note;
             $e2->ref_group_id=$othercode;
             $e2->user_id=$usersave;
             $e2->created_at=$current;
             $e2->updated_at=$current;
             $e2->isexchangelist=1;
             $e2->company_id=$selcomid;
             $e2->product_first_id=$id;
             $e2->save();
             $em=new ExchangeMulti();
             $em->user_id=$usersave;
             $em->dd=$trandate;
             $em->tt=$trantime;
             $em->buy=str_replace(',','',$buy);
             $em->curbuy=$curbuy;
             $em->sale=str_replace(',','',$sale);
             $em->cursale=$cursale;
             $em->buyinfo='';
             $em->saleinfo='';
             $em->rate=str_replace(',','',$exchange_rate);
             $em->drate=str_replace(',','',$origin_rate);
             $em->cashreceive=0;
             $em->cashreturn=0;
             $em->rateinfo='';
             $em->note=$note;
             $em->isexchangelist=1;
             $em->mapcode=$id;
             $em->othercode=$othercode;
             $em->ref_group_id=$othercode;
             $em->created_at=$current;
             $em->updated_at=$current;
             $em->company_id=$selcomid;
             $em->save();
             DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id,'product_first_id'=>$id]);
             //return response()->json(['success'=>'Save Success','id'=>$id]);




    }

    //exchange part
    public function saveexchange(Request $request,$trandate,$trantime,$othercode,$note,$current,$usersave,$isexchangelist)
    {
       //return $request->all();
        $selcomid=Session('log_into_company_id');
       $e=new Exchange();
       $e->dd=$trandate;
       $e->tt=$trantime;
       $e->currency_id=$request->product_id;
       $e->product=str_replace(',','',$request->product);
       $e->pcur=$request->product_cur;
       $e->amount=str_replace(',','',$request->exchange_amount);
       $e->maincur=$request->maincur;
       $e->rate=str_replace(',','',$request->exchange_rate);
       $e->drate=str_replace(',','',$request->origin_rate);
       $e->cashreceive=0;
       $e->cashreturn=0;
       $e->multiexchangecode='';
       $e->othercode=$othercode;
       $e->note=$note;
       $e->ref_group_id=$othercode;
       $e->user_id=$usersave;
       $e->isexchangelist=$isexchangelist;
       $e->company_id=$selcomid;
       $e->created_at=$current;
       $e->updated_at=$current;
       if($e->save()){
          $id=$e->id;
          $em=new ExchangeMulti();
          $em->user_id=$usersave;
          $em->dd=$trandate;
          $em->tt=$trantime;
          $em->buy=str_replace(',','',$request->buy);
          $em->curbuy=$request->curbuy;
          $em->sale=str_replace(',','',$request->sale);
          $em->cursale=$request->cursale;
          $em->buyinfo=$request->buyinfo;
          $em->saleinfo=$request->saleinfo;
          $em->rate=str_replace(',','',$request->exchange_rate);
          $em->drate=str_replace(',','',$request->origin_rate);
          $em->cashreceive=0;
          $em->cashreturn=0;
          $em->rateinfo='';
          $em->note=$note;
          $em->mapcode=$id;
          $em->isexchangelist=$isexchangelist;
          $em->othercode=$othercode;
          $em->ref_group_id=$othercode;
          $em->created_at=$current;
          $em->updated_at=$current;
          $em->company_id=$selcomid;
          $em->save();
          DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
         // return response()->json(['success'=>'save completed','id'=>$id]);
         return true;
       }else{
         // return response()->json(['error'=>'save error']);
         return false;
       }

    }
    public function saveexchangeproduct(Request $r,$trandate,$trantime,$othercode,$note,$current,$usersave,$isexchangelist)
    {
        $selcomid=Session('log_into_company_id');
       if ($r->exsign == "+")
       {
           $rate_buy = $r->rate1buy;
           $luy =(float)str_replace(',','',$r->item1) / (float)str_replace(',','',$rate_buy);

             $e1 = new Exchange();
             $e1->dd=$trandate;
             $e1->tt=$trantime;
             $e1->currency_id=$r->curid1;
             $e1->product=str_replace(',','',$r->item1);
             $e1->pcur=$r->pcur1;
             $e1->amount=-1 * $luy;
             $e1->maincur='USD';
             $e1->rate=str_replace(',','',$rate_buy);
             $e1->drate=str_replace(',','',$rate_buy);
             $e1->cashreceive=0;
             $e1->cashreturn=0;
             $e1->multiexchangecode='';
             $e1->othercode=$othercode;
             $e1->note=$note;
             $e1->ref_group_id=$othercode;
             $e1->user_id=$usersave;
             $e1->created_at=$current;
             $e1->updated_at=$current;
             $e1->isexchangelist=$isexchangelist;
             $e1->company_id=$selcomid;
             $e1->save();
             $id=$e1->id;
             $rate_sale =(float)str_replace(',','',$r->item2) / (float)$luy;
             $e2 = new Exchange();
             $e2->dd=$trandate;
             $e2->tt=$trantime;
             $e2->currency_id=$r->curid2;
             $e2->product=-1 * str_replace(',','',$r->item2);
             $e2->pcur=$r->pcur2;
             $e2->amount=$luy;
             $e2->maincur='USD';
             $e2->rate=str_replace(',','',$rate_sale);
             $e2->drate=str_replace(',','',$rate_sale);
             $e2->cashreceive=0;
             $e2->cashreturn=0;
             $e2->multiexchangecode=$id;
             $e2->othercode=$othercode;
             $e2->note=$note;
             $e2->ref_group_id=$othercode;
             $e2->user_id=$usersave;
             $e2->created_at=$current;
             $e2->updated_at=$current;
             $e2->isexchangelist=$isexchangelist;
             $e2->company_id=$selcomid;
             $e2->product_first_id=$id;
             $e2->save();
             $em=new ExchangeMulti();
             $em->user_id=$usersave;
             $em->dd=$trandate;
             $em->tt=$trantime;
             $em->buy=str_replace(',','',$r->buy);
             $em->curbuy=$r->curbuy;
             $em->sale=str_replace(',','',$r->sale);
             $em->cursale=$r->cursale;
             $em->buyinfo='';
             $em->saleinfo='';
             $em->rate=str_replace(',','',$r->exchange_rate);
             $em->drate=str_replace(',','',$r->origin_rate);
             $em->cashreceive=0;
             $em->cashreturn=0;
             $em->rateinfo='';
             $em->note=$note;
             $em->mapcode=$id;
             $em->isexchangelist=$isexchangelist;
             $em->othercode=$othercode;
             $em->ref_group_id=$othercode;
             $em->created_at=$current;
             $em->updated_at=$current;
             $em->company_id=$selcomid;
             $em->save();
             DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id,'product_first_id'=>$id]);
             //return response()->json(['success'=>'Save Success','id'=>$id]);
       }

       else
       {
             $rate_buy = $r->rate2buy;
             $luy =(float)str_replace(',','',$r->item2) / (float)str_replace(',','',$rate_buy);

             $e1 = new Exchange();
             $e1->dd=$trandate;
             $e1->tt=$trantime;
             $e1->currency_id=$r->curid2;
             $e1->product=str_replace(',','',$r->item2);
             $e1->pcur=$r->pcur2;
             $e1->amount=-1 * $luy;
             $e1->maincur='USD';
             $e1->rate=str_replace(',','',$rate_buy);
             $e1->drate=str_replace(',','',$rate_buy);
             $e1->cashreceive=0;
             $e1->cashreturn=0;
             $e1->multiexchangecode='';
             $e1->othercode=$othercode;
             $e1->note=$note;
             $e1->ref_group_id=$othercode;
             $e1->user_id=$usersave;
             $e1->created_at=$current;
             $e1->updated_at=$current;
             $e1->isexchangelist=$isexchangelist;
             $e1->company_id=$selcomid;
             $e1->save();
             $id=$e1->id;
             $rate_sale =(float)str_replace(',','',$r->item1) / (float)($luy);
             $e2 = new Exchange();
             $e2->dd=$trandate;
             $e2->tt=$trantime;
             $e2->currency_id=$r->curid1;
             $e2->product=-1 * str_replace(',','',$r->item1);
             $e2->pcur=$r->pcur1;
             $e2->amount=$luy;
             $e2->maincur='USD';
             $e2->rate=str_replace(',','',$rate_sale);
             $e2->drate=str_replace(',','',$rate_sale);
             $e2->cashreceive=0;
             $e2->cashreturn=0;
             $e2->multiexchangecode=$id;
             $e2->othercode=$othercode;
             $e2->note=$note;
             $e2->ref_group_id=$othercode;
             $e2->user_id=$usersave;
             $e2->created_at=$current;
             $e2->updated_at=$current;
             $e2->isexchangelist=$isexchangelist;
             $e2->company_id=$selcomid;
             $e2->product_first_id=$id;
             $e2->save();
             $em=new ExchangeMulti();
             $em->user_id=$usersave;
             $em->dd=$trandate;
             $em->tt=$trantime;
             $em->buy=str_replace(',','',$r->buy);
             $em->curbuy=$r->curbuy;
             $em->sale=str_replace(',','',$r->sale);
             $em->cursale=$r->cursale;
             $em->buyinfo='';
             $em->saleinfo='';
             $em->rate=str_replace(',','',$r->exchange_rate);
             $em->drate=str_replace(',','',$r->origin_rate);
             $em->cashreceive=0;
             $em->cashreturn=0;
             $em->rateinfo='';
             $em->note=$note;
             $em->mapcode=$id;
             $em->isexchangelist=$isexchangelist;
             $em->othercode=$othercode;
             $em->ref_group_id=$othercode;
             $em->created_at=$current;
             $em->updated_at=$current;
             $em->company_id=$selcomid;
             $em->save();
             DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id,'product_first_id'=>$id]);
             //return response()->json(['success'=>'Save Success','id'=>$id]);
       }

    }
    public function savemultiexchanges(Request $request,$trandate,$trantime,$othercode,$note,$current,$usersave,$isexchangelist)
    {
       //return $request->all();
       $selcomid=Session('log_into_company_id');
       $multi_id='';
       $countrow=count($request->txtbuys)-1;
       for($key=0;$key<=$countrow;$key++){
          $buyinfoes = explode(";", $request->txtbuyinfoes[$key]);
          $saleinfoes = explode(";", $request->txtsaleinfoes[$key]);
          if($request->txtrateinfoes[$key]==null){

             if($buyinfoes[4]==1){ //if buyin is main cur(USD)
                $productid=$saleinfoes[0];
                $product=-1 * (float)str_replace(',','',$request->txtsales[$key]);
                $amount=$request->txtbuys[$key];
                $maincur=$request->txtcurbuys[$key];
                $pcur=$request->txtcursales[$key];
             }else{ // if sale out is main cur
                $productid=$buyinfoes[0];
                $product=$request->txtbuys[$key];
                $amount=-1 * (float)str_replace(',','',$request->txtsales[$key]);
                $maincur=$request->txtcursales[$key];
                $pcur=$request->txtcurbuys[$key];
             }
                $rate=$request->txtrates[$key];
                $drate=$request->txtdrates[$key];
             $e=new Exchange();
             $e->dd=$trandate;
             $e->tt=$trantime;
             $e->currency_id=$productid;
             $e->product=str_replace(',','',$product);
             $e->pcur=$pcur;
             $e->amount=str_replace(',','',$amount);
             $e->maincur=$maincur;
             $e->rate=str_replace(',','',$rate);
             $e->drate=str_replace(',','',$drate);
             $e->cashreceive='';
             $e->cashreturn='';
             $e->multiexchangecode=$multi_id;
             $e->othercode=$othercode;
             $e->ref_group_id=$othercode;
             $e->note=$note;
             $e->user_id=$usersave;
             $e->created_at=$current;
             $e->updated_at=$current;
             $e->isexchangelist=$isexchangelist;
             $e->company_id=$selcomid;
             $e->save();
             if($key==0){
                $multi_id=$e->id;
                DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id]);
             }
             DB::table('exchange_multis')->where('id',$request->txtexids[$key])->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode,'company_id'=>$selcomid]);

          }else{
             $rate_buy = $buyinfoes[1];
             $luy =(float)str_replace(',','',$request->txtbuys[$key]) / (float)str_replace(',','',$rate_buy);

             $e1 = new Exchange();
             $e1->dd=$trandate;
             $e1->tt=$trantime;
             $e1->currency_id=$buyinfoes[0];
             $e1->product=str_replace(',','',$request->txtbuys[$key]);
             $e1->pcur=$request->txtcurbuys[$key];
             $e1->amount=-1 * $luy;
             $e1->maincur='USD';
             $e1->rate=str_replace(',','',$rate_buy);
             $e1->drate=str_replace(',','',$rate_buy);

             $e1->cashreceive='';
             $e1->cashreturn='';
             $e1->multiexchangecode=$multi_id;
             $e1->othercode=$othercode;
             $e1->ref_group_id=$othercode;
             $e1->note=$note;
             $e1->user_id=$usersave;
             $e1->created_at=$current;
             $e1->updated_at=$current;
             $e1->isexchangelist=$isexchangelist;
             $e1->company_id=$selcomid;
             $e1->save();
             $e1_id=$e1->id;
              if($key==0){
                $multi_id=$e1->id;
                DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id,'product_first_id'=>$e1_id]);
            }else{
                DB::table('exchanges')->where('id',$e1->id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id,'product_first_id'=>$e1_id]);
            }
            //  if($key==0){
            //     $multi_id=$e1->id;
            //     DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id,'product_first_id'=>$multi_id]);
            //  }
             $rate_sale =(float)str_replace(',','',$request->txtsales[$key]) / (float)$luy;
             $e2 = new Exchange();
             $e2->dd=$trandate;
             $e2->tt=$trantime;
             $e2->currency_id=$saleinfoes[0];
             $e2->product=-1 * str_replace(',','',$request->txtsales[$key]);
             $e2->pcur=$request->txtcursales[$key];
             $e2->amount=$luy;
             $e2->maincur='USD';
             $e2->rate=str_replace(',','',$rate_sale);
             $e2->drate=str_replace(',','',$rate_sale);
             $e2->cashreceive='';
             $e2->cashreturn='';
             $e2->multiexchangecode=$multi_id;
             $e2->othercode=$othercode;
             $e2->ref_group_id=$othercode;
             $e2->note=$note;
             $e2->user_id=$usersave;
             $e2->created_at=$current;
             $e2->updated_at=$current;
             $e2->isexchangelist=$isexchangelist;
             $e2->company_id=$selcomid;
             $e2->product_first_id=$e1_id;
             $e2->save();
             DB::table('exchange_multis')->where('id',$request->txtexids[$key])->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode,'company_id'=>$selcomid]);

          }
       }
       //DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode]);
       //return response()->json(['success'=>'save list completed','mapid'=>$multi_id]);
    }

    public function cashdrawprint(Request $request)
    {
        // $logo=Company::orderBy('id')->first();
        // $cashdrawslips=MoneyPrintSlip::where('ref_number',$request->ref_number)->where('showprint',1)->orderBy('id')->get();
        // $totalamount=DB::table('money_print_slips')->select(DB::raw('sum(amount) as tamt,curname'))
        //        ->where('ref_number',$request->ref_number)
        //        ->groupBy('curname')->get();
        // $cashin=$totalamount->where('tamt','>','0');
        // $cashout=$totalamount->where('tamt','<','0');
        // return view('moneytransfers.cashdrawprint',compact('cashdrawslips','logo','cashin','cashout'));
        //return $request->all();
        $invtitle=$request->invtitle;
        $logo=Company::orderBy('id')->first();
        $id=explode("-",$request->group_id)[1];
        $transfer=SmsProcess::find($id);
        $transfers=SmsProcess::where('group_id',$request->group_id)->orderBy('id')->get();
        $exchanges=ExchangeMulti::where('ref_group_id',$request->group_id)->orderBy('id')->get();
        $bankpayments=PartnerTransfer::where('ref_group_id',$request->group_id)->get();
        $totalcashdrawamount=SmsProcess::where('group_id',$request->group_id)->select(DB::raw('sum(amount) as tamt,currency_id'))->groupBy('currency_id')->get();
        //$totalcashdraw_cuscharge=SmsProcess::where('ref_group_id',$request->ref_number)->select(DB::raw('sum(customer_charge) as tcuscharge,cuscharge_currency_id'))->groupBy('cuscharge_currency_id')->get();
        //return $totalcashdraw_cuscharge;
        //return $transfer;
        $c=collect();
        if($totalcashdrawamount){
          foreach($totalcashdrawamount as $a1){
            $c=$c->push(['cur'=>$a1->currency->shortcut,'value'=> -1 * $a1->tamt]);
          }
        }
        // if($totalcashdraw_cuscharge){
        //   foreach($totalcashdraw_cuscharge as $a2){
        //     $c=$c->push(['cur'=>$a2->cuschargecur->shortcut,'value'=> $a2->tcuscharge]);
        //   }
        // }

        if($exchanges){
            foreach($exchanges as $e)
            {
                $c=$c->push(['cur'=>$e->cursale,'value'=>-1 * $e->sale]);
                $c=$c->push(['cur'=>$e->curbuy,'value'=>  $e->buy]);
            }
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
        //dd($sumc);
        $cashin=$sumc->where('value','<>','0');
        if($bankpayments){
            foreach($bankpayments as $bp)
            {
                $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount]);
            }
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
        $cash=$sumc->where('value','<>','0');
        //return $totalcashdrawamount;
        return view('thaicashdraws.cashdrawprint1',compact('totalcashdrawamount','exchanges','transfers','transfer','cashin','bankpayments','cash','logo','invtitle'));
    }

    public function unselectcashdraw(Request $request)
    {
      $del1=DB::table('cashdraw_selects')->where('sms_id',$request->id)->delete();
      $del2=DB::table('partner_cashdraw_temps')->where('sms_id',$request->id)->delete();
      return response()->json(['del2'=>$del2]);
    }
    public function clearcashdrawselect(Request $request)
    {
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd=date('Y-m-d',strtotime($current));
      $selects=PartnerCashdrawTemp::where('select_by_id',Auth::id())->whereNull('transfer_id')->get();
      foreach($selects as $s)
      {
        DB::table('cashdraw_selects')->where('sms_id',$s->sms_id)->delete();
      }
      $del2=DB::table('partner_cashdraw_temps')->where('select_by_id',Auth::id())->whereNull('transfer_id')->delete();
    }
    public function getmulticashdraw(Request $request)
    {

      $multicashdraws=PartnerCashdrawTemp::where('select_by_id',Auth::id())->whereNull('transfer_id')->orderBy('id')->get();
      $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
      return view('thaicashdraws.multicashdraws',compact('multicashdraws','currencies'));
    }
    public function getpartnerbalancebycur(Request $request)
    {
        //return $request->all();
        $viewby=Auth::user()->name;
        $d2= date('Y-m-d', strtotime($request->showdate));
        $balance=0;
        $close_transfer_id=0;
        $close_exchange_id=0;
        $closelist=PartnerCloseList::whereDate('closedate','<=',$d2)->where('partner_id',$request->cid)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
        if($closelist){
            $close_transfer_id=$closelist->transaction_id;
            $close_exchange_id=$closelist->exchange_id;
            if($request->curshortcut=='USD'){
                $balance=$closelist->usd;
            }else if($request->curshortcut=='THB'){
                $balance=$closelist->thb;
            }else if($request->curshortcut=='KHR'){
                $balance=$closelist->khr;
            }else if($request->curshortcut=='VND'){
                $balance=$closelist->vnd;
            }

        }

        $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total'))->where('status',1)->where('parrent_id',$request->cid)->where('id','>',$close_transfer_id)->whereNotNull('docodeby')->whereDate('dd','<=',$d2)->where('currency_id',$request->curid)->get();
        $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee'))
        ->where('status',1)->where('parrent_id',$request->cid)->where('id','>',$close_transfer_id)->whereNotNull('docodeby')->whereDate('dd','<=',$d2)->where('fee_currency_id',$request->curid)->get();
        $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy'))
            ->where('status',1)->where('partner_id',$request->cid)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->where('curbuy',$request->curshortcut)->get();
        $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale'))
            ->where('status',1)->where('partner_id',$request->cid)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->where('cursale',$request->curshortcut)->get();

        $balance+=$transfers[0]->total;
        $balance+=$fees[0]->totalfee;
        $balance+=$exbuys[0]->totalbuy;
        $balance+=$exsales[0]->totalsale;
        return response()->json(['balance'=>$balance]);
    }

}
