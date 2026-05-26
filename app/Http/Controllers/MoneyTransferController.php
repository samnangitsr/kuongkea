<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use App\Company;
use App\Cashdraw;
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
use App\MoneyPrintSlip;
use App\BankTransaction;
use App\PartnerTransfer;
use App\Models\AgentType;
use App\Models\SaleDetail;
use App\Models\AgentRateSet;
use App\MoneyTransferUpdate;
use App\PartnerCashdrawTemp;
use App\PartnerTransferTemp;
use Illuminate\Http\Request;
use App\Models\CashdrawImage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\WingTransactionName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MoneyTransferController extends Controller
{
    // public function rectelautocompleteold(Request $request)
    // {
    //     $data = PartnerTransfer::select("rectel as  value", "recname")
    //     ->where("rectel", 'like', '%'.$request->get('search').'%')->distinct()->get();
    //     return response()->json($data);
    // }
    public function settransferrate()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        //$customers=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();
        $users=User::where('active',1)->get();
        //return $data;
        $agenttypes=AgentType::where('status',1)->get();

        return view('moneytransfers.settransferrate',compact('agenttypes','users'));
    }
    public function storetranname(Request $request){
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'tranname' =>'required',
            'selagenttype1'=>'required',
            'no'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $sign=$request->radbal_updown;
        $list=$request->radlist;
        if($sign==1){
            if($list==1){
                $sign=4;
            }
        }else if($sign==-1){
            if($list==1){
                $sign=-4;
            }
        }
        if($request->isfav=='true'){
            $isfav=1;
        }else{
            $isfav=0;
        }
        if($request->istransfer=='true'){
            $istransfer=1;
        }else{
            $istransfer=0;
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if(isset($request->tranname_id) && $request->tranname_id>0){
            $trname=WingTransactionName::find($request->tranname_id);
        }else{
            $trname=new WingTransactionName();
        }
        $trname->agent_type_id=$request->selagenttype1;
        $trname->name=$request->tranname;
        $trname->sign=$sign;
        $trname->num=$request->no;
        $trname->popular=$isfav;
        $trname->is_tc=$istransfer;
        $trname->created_at=$current;
        $trname->updated_at=$current;
        if($trname->save()){
            return response()->json(['success'=>true,'message'=>'save complete']);
        }else{
            return response()->json(['error'=>true,'message'=>'save fail']);
        }
    }
    public function deletetranname(Request $request)
    {
        $del=DB::table('wing_transaction_names')->where('id',$request->id)->delete();
        if($del){
            return response()->json(['success'=>true,'message'=>'data have been delete']);
        }

    }
    public function getmaxtrannameno(Request $request)
    {
        $maxno=WingTransactionName::where('agent_type_id',$request->agenttypeid)->max('num');
        if($maxno){
            $maxno=$maxno+1;
        }else{
            $maxno=1;
        }
        return response()->json(['maxno'=>$maxno]);
    }
    public function storerateset(Request $request){
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'selcur' =>'required',
            'selagenttype'=>'required',
            'seltranname'=>'required',
            'amt1.*'=>'required',
            'amt2.*'=>'required',
            'agentdork.*'=>'required',
            'agentvey.*'=>'required',
            'customercharge.*'=>'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));

        $date = str_replace('/', '-', $request->d1);
        $setdate= date('Y-m-d', strtotime($date));
        foreach ($request->amt1 as $key => $value) {
            $ars=new AgentRateSet();
            $ars->user_id=Auth::id();
            $ars->setdate=$setdate;
            $ars->agent_type_id=$request->selagenttype;
            //$ars->transaction_name_id=implode(",",$request->seltranname);
            $ars->transaction_name_id=$request->seltranname;

            $ars->amt1=str_replace(',','',$request->amt1[$key]);
            $ars->amt2=str_replace(',','',$request->amt2[$key]);
            $ars->transfer_rate=str_replace(',','',$request->agentvey[$key]);
            $ars->cashdraw_rate=str_replace(',','',$request->agentdork[$key]);
            $ars->customer_rate=str_replace(',','',$request->customercharge[$key]);
            $ars->currency=$request->selcur;
            if($ars->save()){
                if(isset($request->isapplycur_usd) && $request->isapplycur_usd==1){
                    $ars1=new AgentRateSet();
                    $ars1->user_id=Auth::id();
                    $ars1->setdate=$setdate;
                    $ars1->agent_type_id=$request->selagenttype;
                    $decimal=floatval($request->decimals);

                    //$ars1->transaction_name_id=implode(",",$request->seltranname);
                    $ars1->transaction_name_id=$request->seltranname;
                    if($request->sign=='*'){
                        $ars1->amt1=floatval(str_replace(',','',$request->amt1[$key])) * floatval(str_replace(',','',$request->rate)) ;
                        $ars1->amt2=floatval(str_replace(',','',$request->amt2[$key])) * floatval(str_replace(',','',$request->rate)) ;
                        $ars1->transfer_rate=floatval(str_replace(',','',$request->agentvey[$key])) * floatval(str_replace(',','',$request->rate)) ;
                        $ars1->cashdraw_rate=floatval(str_replace(',','',$request->agentdork[$key])) * floatval(str_replace(',','',$request->rate)) ;
                        $ars1->customer_rate=floatval(str_replace(',','',$request->customercharge[$key])) * floatval(str_replace(',','',$request->rate)) ;
                    }else{
                        $ars1->amt1=floatval(str_replace(',','',$request->amt1[$key])) / floatval(str_replace(',','',$request->rate)) ;
                        $ars1->amt2=floatval(str_replace(',','',$request->amt2[$key])) / floatval(str_replace(',','',$request->rate)) ;
                        $agentvey = str_replace(',', '', $request->agentvey[$key]);
                        $rate     = str_replace(',', '', $request->rate);
                        $ars1->transfer_rate=bcdiv($agentvey,$rate,$decimal)  ;
                        $agentdork = str_replace(',', '', $request->agentdork[$key]);
                        $ars1->cashdraw_rate=bcdiv($agentdork,$rate,$decimal)  ;
                        $customercharge = str_replace(',', '', $request->customercharge[$key]);
                        $ars1->customer_rate=bcdiv($customercharge,$rate,$decimal)  ;
                    }

                    $ars1->currency=$request->selcur_usd;
                    $ars1->save();
                }
                if(isset($request->isapplycur_thb) && $request->isapplycur_thb==1){
                    $ars2=new AgentRateSet();
                    $ars2->user_id=Auth::id();
                    $ars2->setdate=$setdate;
                    $ars2->agent_type_id=$request->selagenttype;
                    $decimal=0;

                    //$ars2->transaction_name_id=implode(",",$request->seltranname);
                    $ars2->transaction_name_id=$request->seltranname;
                    if($request->sign=='*'){
                        $ars2->amt1=floatval(str_replace(',','',$request->amt1[$key])) * floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->amt2=floatval(str_replace(',','',$request->amt2[$key])) * floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->transfer_rate=floatval(str_replace(',','',$request->agentvey[$key])) * floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->cashdraw_rate=floatval(str_replace(',','',$request->agentdork[$key])) * floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->customer_rate=floatval(str_replace(',','',$request->customercharge[$key])) * floatval(str_replace(',','',$request->rate_thb)) ;
                    }else{
                        $ars2->amt1=floatval(str_replace(',','',$request->amt1[$key])) / floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->amt2=floatval(str_replace(',','',$request->amt2[$key])) / floatval(str_replace(',','',$request->rate_thb)) ;
                        $ars2->transfer_rate=number_format(floatval(str_replace(',','',$request->agentvey[$key])) / floatval(str_replace(',','',$request->rate_thb)),$decimal)  ;
                        $ars2->cashdraw_rate=number_format(floatval(str_replace(',','',$request->agentdork[$key])) / floatval(str_replace(',','',$request->rate_thb)),$decimal)  ;
                        $ars2->customer_rate=number_format(floatval(str_replace(',','',$request->customercharge[$key])) / floatval(str_replace(',','',$request->rate_thb)),$decimal)  ;
                    }

                    $ars2->currency=$request->selcur_thb;
                    $ars2->save();
                }
            }
        }
    }
    public function delsetrate(Request $request)
    {
        $ars=AgentRateSet::find($request->id);
        if($ars->delete()){
            return response()->json(['del'=>'1','message'=>'rate deleted']);
        }

    }
    public function updateratelist(Request $request){
        //return $request->all();
        $item = AgentRateSet::findOrFail($request->id);
        $item->amt1 = str_replace(',','',$request->amt1);
        $item->amt2 = str_replace(',','',$request->amt2);
        $item->transfer_rate = str_replace(',','',$request->transfer_rate);
        $item->cashdraw_rate =str_replace(',','',$request->cashdraw_rate);
        $item->customer_rate =str_replace(',','',$request->customer_rate);
        $item->save();

        return response()->json(['success' => true,'message'=>'update rate completed','data'=>$item]);
    }
    public function showratelist(Request $request){
        //return $request->all();

        $tranname = (array) $request->tranname; // always array, safe
        $agenttype = $request->agenttype;
        $cur = $request->cur;

        $agentratelist = AgentRateSet::where('agent_type_id', $agenttype)
            ->where('currency', $cur)
            ->where(function($q) use ($tranname) {
                foreach ($tranname as $t) {
                    $q->orWhereRaw("FIND_IN_SET(?, transaction_name_id)", [$t]);
                }
            })
            ->orderBy('amt1')
            ->get();

        return view('moneytransfers.showagentratelist',compact('agentratelist'));
        //return response()->json(['agentrates'=>$agentrates]);
    }
    public function showtranname(Request $request){
        $trannames=WingTransactionName::where('agent_type_id',$request->agentid)->orderBy('id')->get();

        return view('moneytransfers.showtrannamelist',compact('trannames'));
        //return response()->json(['agentrates'=>$agentrates]);
    }
    public function gettranname(Request $request){
        $trannames=WingTransactionName::where('agent_type_id',$request->id)->orderBy('num')->get();
        return response()->json(['trannames'=>$trannames]);
    }
    public function phonenumberlocalstorage_old(Request $request)
    {
        // $recphonelist = PartnerTransfer::select("rectel","recname")->whereNotNull('rectel')->where('rectel','<>','')->where('lastrectel',1)->distinct()->get();
        // $sendphonelist = PartnerTransfer::select("sendertel","sendername")->whereNotNull('sendertel')->where('sendertel','<>','')->where('lastsendertel',1)->distinct()->get();

        $recphonelist = PartnerTransfer::where('status',1)
            ->whereNotNull('rectel')->where('rectel','<>','')
            ->latest()
            ->get()
            ->unique('rectel');
        $sendphonelist = PartnerTransfer::where('status',1)
            ->whereNotNull('sendertel')->where('sendertel','<>','')
            ->latest()
            ->get()
            ->unique('sendertel');
        return response()->json(['recphonelist'=>$recphonelist,'sendphonelist'=>$sendphonelist]);
    }
    public function phonenumber_localstorage(Request $request)
{
    $selcomid=Session('log_into_company_id');
    $recphonelist = PartnerTransfer::where('status', 1)->where('company_id',$selcomid)
        ->whereNull('thai_amt')
        ->whereNotNull('rectel')
        ->where('rectel', '<>', '')
        ->select('recname', 'rectel') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('rectel'); // using alias here for uniqueness

        $sendphonelist = PartnerTransfer::where('status',1)->where('company_id',$selcomid)
        ->whereNull('thai_amt')
        ->whereNotNull('sendertel')
        ->where('sendertel','<>','')
        ->select('sendername', 'sendertel') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('sendertel');

        $customerexchanges = Exchange::where('status', 1)->where('company_id',$selcomid)
        ->whereNotNull('phone')
        ->where('phone', '<>', '')
        ->select('client', 'phone') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('phone'); // using alias here for uniqueness
    return response()->json(['recphonelist'=>$recphonelist,'sendphonelist'=>$sendphonelist,'customerexchanges'=>$customerexchanges]);
}
 public function phonenumber_localstorage_thai(Request $request)
{
    $selcomid=Session('log_into_company_id');
    $recphonelist = PartnerTransfer::where('status', 1)->where('company_id',$selcomid)
        ->whereNotNull('thai_amt')
        ->whereNotNull('rectel')
        ->where('rectel', '<>', '')
        ->select('recname', 'rectel','qrcode') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('rectel'); // using alias here for uniqueness

        $sendphonelist = PartnerTransfer::where('status',1)->where('company_id',$selcomid)
        ->whereNotNull('thai_amt')
        ->whereNotNull('sendertel')
        ->where('sendertel','<>','')
        ->select('sendername', 'sendertel','qrcode') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('sendertel');
    return response()->json(['recphonelist'=>$recphonelist,'sendphonelist'=>$sendphonelist]);
}

    public function rectelautocomplete(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $data = PartnerTransfer::where('status',1)->where('company_id',$selcomid)
            ->whereNotNull('rectel')->where('rectel','<>','')
            ->latest()
            ->get()
            ->unique('rectel');
        return response()->json($data);
    }
    // public function recnameautocomplete(Request $request)
    // {

    //     $data = PartnerTransfer::select("recname as value","rectel","qrcode")->whereNotNull('rectel')->where('rectel','<>','')->where('lastrectel',1)->distinct()->get();
    //     return response()->json($data);
    // }
    // public function accountnumberautocomplete(Request $request)
    // {

    //     $data = PartnerTransfer::select("rectel as value","recname")->where('parrent_id',$request->parrent_id)->whereNotNull('rectel')->where('rectel','<>','')->where('lastrectel',1)->distinct()->get();
    //     return response()->json($data);
    // }
    public function getphonenumber()
    {
        //only rectel
        $selcomid=Session('log_into_company_id');
        $data = PartnerTransfer::select("rectel")->whereNotNull('rectel')->where('rectel','<>','')->where('company_id',$selcomid)->distinct()->get();
        $a=array();
        foreach($data as $d){
          array_push($a,$d->rectel);
        }
        return response()->json($a);
    }


    public function cashdrawrectelautocomplete(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $data = Cashdraw::where('status', 1)->where('company_id',$selcomid)
        ->whereNotNull('receive_tel')
        ->where('receive_tel', '<>', '')
        ->select('receive_name as recname', 'receive_tel as value') // selecting only necessary columns
        ->latest()
        ->get()
        ->unique('rectel_tel'); // using alias here for uniqueness
        return response()->json($data);
    }
    public function checkamountortel(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $predate=date('Y-m-d', strtotime($current));
        if($request->searchby=='tel'){
          $search=str_replace(' ','',$request->search);
          //$transfers=PartnerTransfer::whereDate('dd',$current)->where('status',1)->where('rectel',$search)->where('parrent_id',$request->partner_id)->get()->load('partner','user','currency','feecurrency');
          $transfers=PartnerTransfer::whereDate('dd',$current)->where('company_id',$selcomid)->where('status',1)->where('rectel',$search)->get()->load('partner','user','currency','feecurrency');

        }else{
          $search=str_replace(',','',$request->search);
          //$transfers=PartnerTransfer::whereDate('dd',$current)->where('status',1)->whereRaw('abs(amount)=?',[$search])->where('parrent_id',$request->partner_id)->get()->load('partner','user','currency','feecurrency');
          $transfers=PartnerTransfer::whereDate('dd',$current)->where('company_id',$selcomid)->where('status',1)->whereRaw('abs(amount)=?',[$search])->get()->load('partner','user','currency','feecurrency');

        }
        return response()->json(['transfers'=>$transfers]);

    }
    public function cashdraw()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        });
        // $notyetcashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->whereNull('iscashdraw')->where('trancode',-1)->orderBy('id')->get();
        // $cashdraws=PartnerTransfer::where('status',1)->whereDate('dd',$current)->where('iscashdraw','1')->where('trancode',-1)->orderBy('id')->get();

        $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();

        $banks=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','BANK')->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();

        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('ispandp',0)->where('partner_cur',1)->get();

        return view('moneytransfers.cashdraw',compact('customers','partners','users','customers','banks','provinces','currencies'));
    }
    public function notyetcashdrawreport()
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
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT','NOLIST'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        $data=PartnerTransfer::where('status',1)->where('trancode',-1)->whereDate('dd','<=',$current)->whereNull('iscashdraw')->where('user_id',Auth::id())->where('company_id',$selcomid)->orderBy('id')->get();
        return view('moneytransfers.notyetcashdrawreport',compact('customers','partners','currencies','data','users'));
    }
    public function cashdrawreport()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        $data=Cashdraw::where('status',1)->whereDate('opdate',$current)->where('user_id',Auth::id())->where('company_id',$selcomid)->orderBy('id')->get();
        $summary=Cashdraw::where('status',1)->whereDate('opdate',$current)->where('user_id',Auth::id())->where('company_id',$selcomid)->select(DB::raw('sum(amount) as tamt,sum(customer_charge) as tcharge,paymethod,currency_id'))->groupBy('paymethod')->groupBy('currency_id')->get();
        foreach($data as $d)
        {
            $d->have_exchange = Exchange::where('ref_group_id', $d->ref_group_id)->exists();
        }
        // $summarylist=Cashdraw::where('status',1)->whereDate('opdate',$current)->where('user_id',Auth::id())->where('paymethod','List')->select(DB::raw('sum(amount) as tamt,sum(customer_charge) as tcharge,currency_id'))->groupBy('currency_id')->get();
        return view('moneytransfers.cashdrawreport',compact('data','customers','partners','users','summary','currencies'));
    }

    public function cashdrawsearch(Request $request)
    {
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $username=$request->username;
        $datestr=$request->datestr;
        //$usd_id=Currency::where('shortcut','USD')->select('id')->first();

        $data=Cashdraw::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2));
        $data1=Cashdraw::where('status',1)->whereBetween(DB::raw('DATE(opdate)'), array($d1, $d2));
        if($request->partner){
            $data=$data->where('from_partner_id',$request->partner);
             $data1=$data1->where('from_partner_id',$request->partner);
        }
        if($request->user){
            $data=$data->where('user_id',$request->user);
             $data1=$data1->where('user_id',$request->user);
        }
        if($request->cur){
            $data=$data->where('currency_id',$request->cur);
             $data1=$data1->where('currency_id',$request->cur);
        }
        $data=$data->orderBy('currency_id')->orderBy('id')->get();
        $summary=$data1->select(DB::raw('sum(amount) as tamt,sum(customer_charge) as tcharge,paymethod,currency_id'))->groupBy('paymethod')->groupBy('currency_id')->get();
        foreach($data as $d)
        {
            $d->have_exchange = Exchange::where('ref_group_id', $d->ref_group_id)->exists();
        }

        if($request->isprint==1){
          return view('moneytransfers.cashdrawreport_print',compact('data','summary','username','datestr'));
        }else{
          return view('moneytransfers.cashdrawreport_search',compact('data','summary'));
        }
    }
    public function cashdrawdelete(Request $request)
    {
        $c=Cashdraw::find($request->cashdraw_id);
        $c->status='0';
        $c->delby=Auth::user()->name;
        if($c->save()){
            DB::table('exchanges')->where('ref_group_id','cashdraw-'.$request->cashdraw_id)->update(['status'=>0,'userdel'=>Auth::user()->name]);
            DB::table('exchange_multis')->where('ref_group_id','cashdraw-'.$request->cashdraw_id)->update(['status'=>0,'userdel'=>Auth::user()->name]);
            DB::table('partner_transfers')->where('id',$request->id)->update(['iscashdraw'=>null,'cashdraw_id'=>null,'ref_number'=>null,'action'=>'u,d','note'=>'']);
            DB::table('partner_transfers')->where('ref_group_id','cashdraw-'.$request->cashdraw_id)->update(['status'=>0,'user_delete'=>Auth::id()]);

            return response()->json(['success'=>true,'message'=>'cashdraw has been deleted']);
        }
    }
    public function cashdrawdelete1(Request $request)
    {
        $c=Cashdraw::find($request->id);
        $c->status='0';
        $c->delby=Auth::user()->name;
        if($c->save()){
           DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['iscashdraw'=>null,'cashdraw_id'=>null,'ref_number'=>null,'action'=>'u,d','note'=>'']);
            return response()->json(['success'=>true,'message'=>'cashdraw has been deleted']);
        }
    }
    public function cashdrawdeletebankcontinue(Request $request)
    {
      //return $request->all();
       DB::table('partner_transfers')->where('id',$request->id)->update(['status'=>0,'user_delete'=>Auth::id()]);
       $this->storeupdated($request->id,0,0);
       if($request->fromid){
          DB::table('partner_transfers')->where('id',$request->fromid)->update(['ref_number'=>null,'note'=>'','action'=>'u,d']);
       }
       return response()->json(['success'=>true,'message'=>'cashdraw has been deleted']);

    }
    public function cashdrawcheckother(Request $request)
    {
        $pt=PartnerTransfer::find($request->transfer_id);
        $cashdraw=Cashdraw::find($request->id);
        $exchanges=Exchange::where('othercode','cashdraw-'. $request->id)->get();
        $transfers=PartnerTransfer::where('ref_number','cashdraw-' . $request->id)->get();
        return view('moneytransfers.checkcashdrawother',compact('exchanges','transfers','pt','cashdraw'));
    }
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();

        $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        //$data=PartnerTransfer::where('status',1)->whereDate('dd',$current)->where('user_id',Auth::id())->where('location_id',1)->orderBy('id')->get();
         $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        //$data=PartnerTransfer::where('status',1)->whereDate('created_at',$current)->where('user_id',Auth::id())->orderBy('id')->get();
        $transfers=PartnerTransfer::whereDate('dd',$current)->where('user_id',Auth::id())->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
        return view('moneytransfers.index',compact('transfers','customers','users','currencies','partners'));
    }
    public function updatedeletereport()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('ispandp',0)->get();
        $data=MoneyTransferUpdate::whereDate('created_at',$current)->where('action_by_id',Auth::id())->orderBy('id')->get()->groupBy('ref_group_id');
        //return $data;

        return view('moneytransfers.updatedeletereport',compact('data','customers','users','currencies'));
    }
    public function search_update_delete_record(Request $request)
    {
        //return $request->all();
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $seltran=$request->seltran;
        if($request->seltran==0){
            $data=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',0);
            if($request->customer){
              $data=$data->where('parrent_id',$request->customer);
            }
            if($request->user){
              $data=$data->where('user_delete',$request->user);
            }
            $data=$data->orderBy('id')->get()->groupBy('ref_group_id');
        }else{
            $data=MoneyTransferUpdate::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2));
            if($request->customer){
              $data=$data->where('parrent_id',$request->customer);
            }
            if($request->user){
              $data=$data->where('action_by_id',$request->user);
            }
            $data=$data->orderBy('id')->get()->groupBy('ref_group_id');
        }
      return view('moneytransfers.searchupdatedeleterecord',compact('data','seltran'));
    }
    public function sendpartnerslip()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $customers=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();
        $users=User::where('active',1)->get();
        $notyetsent=PartnerTransfer::where('status',1)->whereDate('dd',$current)->whereIn('trancode',[1,3])->where('issend',0)->where('user_id',Auth::id())->orderBy('id')->get();
        $sent=PartnerTransfer::where('status',1)->whereDate('dd',$current)->whereIn('trancode',[1,3])->where('issend',1)->where('user_id',Auth::id())->orderBy('id')->get();
        //$data=PartnerTransfer::where('status',1)->orderBy('id')->get();
        return view('moneytransfers.sendpartnerslip',compact('notyetsent','sent','customers','users'));
    }
    public function searchsendpartnerslip(Request $request)
    {
        //return $request->all();
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));

        $notyetsent=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->whereIn('trancode',[1,3])->where('issend',0);
        $sent=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->whereIn('trancode',[1,3])->where('issend',1);

        if($request->partner){
            $notyetsent=$notyetsent->where('parrent_id',$request->partner);
            $sent=$sent->where('parrent_id',$request->partner);
        }
        if($request->user){
            $notyetsent=$notyetsent->where('user_id',$request->user);
            $sent=$sent->where('user_id',$request->user);
        }
        if($request->searchby=='amt'){

            if($request->amt1<>null){
                $amt2=$request->amt1;
                if($request->amt2<>null){
                    $amt2=$request->amt2;
                }
                $notyetsent=$notyetsent->where('amount','>=',$request->amt1)->where('amount','<=',$amt2);
                $sent=$sent->where('amount','>=',$request->amt1)->where('amount','<=',$amt2);
            }

        }else if($request->searchby=='tel'){
            if($request->tel<>null){
                $notyetsent=$notyetsent->where('rectel','like','%'.$request->tel.'%')->orwhere('sendertel','like','%'.$request->tel.'%');
                $sent=$sent->where('rectel','like','%'.$request->tel.'%')->orwhere('sendertel','like','%'.$request->tel.'%');

            }
        }
        $notyetsent=$notyetsent->orderBy('id')->get();
        $sent=$sent->orderBy('id')->get();
        return view('moneytransfers.searchsendpartnerslip',compact('notyetsent','sent'));
    }
    public function sendslip(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        // $slip=PartnerTransfer::find($request->id);
        // $note='';
        // if($slip->issend==1){
        //     $note='ផ្ញើឡើងវិញ';
        // }
        // $slip->issend=1;
        // $slip->sentby=Auth::user()->name;
        // $slip->save();

        $selid=explode(',',$request->id);

        $slips=PartnerTransfer::whereIn('id',$selid)->orderBy('id')->get();
        DB::table('partner_transfers')->whereIn('id',$selid)->update(['issend'=>1,'sentby'=>Auth::user()->name]);
        $logo=Company::orderBy('id')->first();
        //return $slips;
        return view('moneytransfers.slipforsend',compact('slips','logo','current'));
    }
    public function searchcashdraw(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');

        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $notyetcashdraws=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',-1)->whereNull('iscashdraw')->where('location_id','<>',8)->where('company_id',$selcomid);
        $cashdraws=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',-1)->whereNotNull('iscashdraw')->where('cashdraw_id','>',0)->where('location_id','<>',8)->where('company_id',$selcomid);
        $bankcashdraws=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',-1)->whereNotNull('iscashdraw')->whereNull('cashdraw_id')->where('location_id','<>',8)->where('company_id',$selcomid)->get();

        if($request->partner){
            $notyetcashdraws=$notyetcashdraws->where('parrent_id',$request->partner);
            $cashdraws=$cashdraws->where('parrent_id',$request->partner);

        }
        // if($request->user){
        //     $notyetcashdraws=$notyetcashdraws->where('user_id',$request->user);
        //     $cashdraws=$cashdraws->where('user_id',$request->user);
        // }
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
                    $notyetcashdraws=$notyetcashdraws->where('rectel','like','%'.$request->tel.'%');
                    $cashdraws=$cashdraws->where('rectel','like','%'.$request->tel.'%');
                    // $notyetcashdraws=$notyetcashdraws->where(function($query) use ($tel) {
                    //     $query->where('rectel','like','%'.$tel.'%')
                    //             ->orwhere('sendertel','like','%'.$tel.'%');
                    // });
                }
            }
        }
        $notyetcashdraws=$notyetcashdraws->orderBy('id')->get();
        $cashdraws=$cashdraws->orderBy('id')->get();
        foreach($notyetcashdraws as $ncd){
            $issel=CashdrawSelect::where('transfer_id',$ncd->id)->exists();
            $examt=$this->exchangetousd($ncd->currency_id,$ncd->amount);
            $ncd['issel_cashdraw_upd']=$issel;
            $ncd['amtinusd_upd']=$examt;
        }
        //return $notyetcashdraws;
        return view('moneytransfers.searchtransactioncashdraw',compact('notyetcashdraws','cashdraws','bankcashdraws'));
    }
    public function searchnotyetcashdraw(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $data=PartnerTransfer::where('status',1)->where('trancode',-1)->whereDate('dd','<=',$d1)->whereNull('iscashdraw')->where('company_id',$selcomid);

        if($request->partner){
            $data=$data->where('parrent_id',$request->partner);
        }
        if($request->user){
            $data=$data->where('user_id',$request->user);
        }
        if($request->cur){
            $data=$data->where('currency_id',$request->cur);
        }
        $data=$data->orderBy('id')->get();
        return view('moneytransfers.notyetcashdrawreport_search',compact('data'));
    }
    public function notyetcashdrawreportprint(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->dd));
        $data=PartnerTransfer::where('status',1)->where('trancode',-1)->whereDate('dd','<=',$d1)->whereNull('iscashdraw')->where('company_id',$selcomid);
        $rpttitle="របាយការណ៏ស្តុកបើកវេរ " ;
        if($request->partner){
            $data=$data->where('parrent_id',$request->partner);
            $rpttitle=$rpttitle . 'របស់ដៃគូ ' . $request->partner;
        }
        if($request->user){
            $data=$data->where('user_id',$request->user);
            $rpttitle=$rpttitle . 'បុគ្គលិក ' . $request->username;
        }
        if($request->cur){
            $data=$data->where('currency_id',$request->cur);
            $rpttitle=$rpttitle . 'រូបិយប័ណ្ណ ' . $request->curname;
        }
        $data=$data->orderBy('id')->get();

        $ddd="គិតត្រឹមថ្ងៃទី ". $request->dd;
        return view('moneytransfers.notyetcashdrawreport_print',compact('data','rpttitle','ddd'));
    }
    public function setiscashdrawtrue(Request $request)
    {
        //return $request->all();
        DB::table('partner_transfers')->whereIn('id',$request->id)->update(['iscashdraw'=>true]);
        return response()->json(['success'=>true,'message'=>'this record has been deleted']);
    }
    public function search(Request $request)
    {
        //return $request->all();
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $selcomid=Session('log_into_company_id');
        if($request->tran==0){
            if($request->searchbyinputdate=='true'){
              $data=PartnerTransfer::where('status',0)->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('company_id',$selcomid)->where('location_id','<>',8);
            }else{
              $data=PartnerTransfer::where('status',0)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid)->where('location_id','<>',8);
            }
        }else{
          if($request->searchbyinputdate=='true'){
            $data=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('company_id',$selcomid)->where('location_id','<>',8);
          }else{
            $data=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid)->where('location_id','<>',8);
          }

        }
        if($request->partner){
            $data=$data->where('parrent_id',$request->partner);
        }
        if($request->user){
            $data=$data->where('user_id',$request->user);
        }
        if($request->cur){
            $data=$data->where('currency_id',$request->cur);
        }
        if($request->tran){
            if($request->tran==1){
                $data=$data->where('amount','>',0);
            }elseif($request->tran==-1){
                $data=$data->where('amount','<',0);
            }
        }
        if($request->selbank=='true'){
            $data=$data->where('isbank',1);
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
                }

            }else if($request->searchby=='tel'){
                if($request->tel<>null){
                    $data=$data->where('rectel','like','%'.$request->tel.'%')->orwhere('sendertel','like','%'.$request->tel.'%');
                }
            }
        }
        $data=$data->orderBy('id')->get();

        //return $data;
        if(isset($request->isprint) && $request->isprint==1){
            $rpttitle='Money Transfer Report';
            $d1d2='From: ' . $request->d1 . ' To: ' . $request->d2;
            $username='Record By: '.$request->username;
            $partnername=$request->partnername;
            $logo=Company::orderBy('id')->first();
            return view('moneytransfers.searchtransactionsprint',compact('data','rpttitle','d1d2','username','logo','partnername'));
        }else{
            return view('moneytransfers.searchtransactions',compact('data'));
        }
    }
    public function formtransaction(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if(Auth::user()->role->name=='Admin'){
            $partners=Customer::where('status',1)->whereNotIn('customertype',['BUYER','SALER'])->where('company_id',$selcomid)->orderBy('no')->get();
        }else{
             $partners=Customer::where('status',1)->whereNotIn('customertype',['BUYER','SALER','NOLIST'])->where('company_id',$selcomid)->orderBy('no')->get();
        }

        //$customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        //$banks=Customer::where('status',1)->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
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
        //$records=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->get();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        // $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','PARTNER')->count();
        // $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','BANK')->count();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();
        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('user_id',Auth::id())->where('status',1)->where('location_id',1)->where('company_id',$selcomid)->orderBy('tt')->orderBy('id')->get();
        //$trannames=WingTransactionName::where('link_trancode',1)->orderBy('num')->get();
        return view('moneytransfers.formtransfer',compact('partners','provinces','currencies','mex','totalbuy','totalsale','cashin','cashout','transfers','users'));
    }
    public function quicktransfer(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if(Auth::user()->role->name=='Admin' || Auth::user()->role->name=='admin'){
            $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
        }else{
            $userid=Auth::id();
            $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->WhereRaw("FIND_IN_SET(?, user_connect)", [$userid])->orderBy('no')->get();
        }
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();
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

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('user_id',Auth::id())->where('status',1)->where('location_id',-1)->orderBy('tt')->get();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();
        return view('moneytransfers.quicktransfer',compact('partners','banks','provinces','currencies','mex','totalbuy','totalsale','cashin','cashout','customers','transfers','users'));
    }
    public function wingtransfer(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $userid=Auth::id();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $partner2s=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        if(Auth::user()->role->name=='Admin' || Auth::user()->role->name=='admin'){
            $partners=Customer::where('status',1)->whereIn('customertype',['AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
            //$partner2s=Customer::where('status',1)->orderBy('no')->get();
        }else{
            $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['AGENT'])->WhereRaw("FIND_IN_SET(?, user_connect)", [$userid])->orderBy('no')->get();
            // ->where(function($q) use($userid){
            //     return $q->where('user_connect','like',$userid.',%')->orWhere('user_connect','like','%,' . $userid.',%')->orWhere('user_connect','like','%,' . $userid)->orWhere('user_connect',$userid);
            // })->orderBy('no')->get();

            //  $partner2s=Customer::where('status',1)
            // ->where(function($q) use($userid){
            //     return $q->where('user_connect','like',$userid.',%')->orWhere('user_connect','like','%,' . $userid.',%')->orWhere('user_connect','like','%,' . $userid)->orWhere('user_connect',$userid);
            // })->orderBy('no')->get();
        }
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();
        // $banks=Customer::where('status',1)->orderBy('no')->get();
        // $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        //$trannames=WingTransactionName::orderBy('num')->get();
        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('user_id',Auth::id())->where('status',1)->where('company_id',$selcomid)->orderBy('tt')->get();
        return view('moneytransfers.wingtransfer',compact('partners','partner2s','customers','currencies','transfers','users'));

    }
    public function gettransactionname(Request $request)
    {
        $wtn=WingTransactionName::where('agent_type_id',$request->agenttype)->get();
        $wtnp=WingTransactionName::where('agent_type_id',$request->agenttype)->where('popular',1)->get();

        return response()->json(['wtn'=>$wtn,'wtnp'=>$wtnp]);
    }
    public function customertransfer(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        // $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','PARTNER')->count();
        // $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','BANK')->count();

        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('user_id',Auth::id())->where('status',1)->where('location_id',4)->where('action','<>','')->orderBy('tt')->get();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();
        return view('moneytransfers.customertransfer',compact('customers','banks','provinces','currencies','transfers','users'));
    }
    public function getwingratestorage(Request $request)
    {
        $wingrate=AgentRateSet::all();
        return response(['wingrate'=>$wingrate]);
    }
    public function getwingrate(Request $request)
    {
        $amt=str_replace(',','',$request->amount);
        //return $request->all();
        $s=$request->trannameid;
        $wingrate=AgentRateSet::where('agent_type_id',$request->agenttype)->where('amt1','<',$amt)->where('amt2','>=',$amt)->where('currency',$request->cur)
        ->where(function($q) use($s){
            return $q->where('transaction_name_id','like',$s.',%')->orWhere('transaction_name_id','like','%,' . $s.',%')->orWhere('transaction_name_id','like','%,' . $s)->orWhere('transaction_name_id',$s);
        })->first();

        return response()->json(['wingrate'=>$wingrate]);
    }
    public function banktransfer(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();
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
        //$records=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->get();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        // $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','PARTNER')->count();
        // $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //         ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //         ->whereDate('dd',$dd)
        //         ->where('customers.customertype','BANK')->count();

        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('user_id',Auth::id())->where('status',1)->where('location_id',2)->orderBy('tt')->get();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();
        return view('moneytransfers.banktransfer',compact('partners','banks','provinces','currencies','mex','totalbuy','totalsale','cashin','cashout','customers','transfers','users'));
    }

    public function gettransferlist(Request $request)
    {
      //return $request->all();
      $selcomid=Session('log_into_company_id');
      $dd= date('Y-m-d', strtotime($request->d));
      //$userid=Auth::id();
      if($request->location_id==3){//wing
        $transfers=PartnerTransfer::whereDate('dd',$dd)->where('status',1)->where('parrent_id',$request->parrent_id)->where('company_id',$selcomid);
      }else{
          $transfers=PartnerTransfer::whereDate('dd',$dd)->where('status',1)->where('location_id',$request->location_id)->where('company_id',$selcomid);
          if(isset($request->parrent_id)){
            $transfers=$transfers->where('parrent_id',$request->parrent_id);
        }
        if(isset($request->location_id)){
            if($request->location_id==4){//customer transfer
                $transfers=$transfers->where('location_id',$request->location_id)->where('action','<>','');
            }else{
                $transfers=$transfers->where('location_id',$request->location_id);
            }
        }
      }
    //   $transfers=$transfers->where('user_id',$request->user_id);
        if(isset($request->user_id)){
            if($request->user_id<>'all' && $request->user_id<>''){
                $transfers=$transfers->where('user_id',$request->user_id);
            }
        }

        $transfers=$transfers->orderBy('tt')->orderBy('id')->get();
        if($request->location_id==3){
            return view('moneytransfers.gettransferlistwing',compact('transfers'));
        }else if($request->location_id==4){
            return view('moneytransfers.gettransferlistcustomer',compact('transfers'));
        }else{
            return view('moneytransfers.gettransferlist',compact('transfers'));
        }
    }
    public function countrecordsaved(Request $request)
    {
      $dd= date('Y-m-d', strtotime($request->d));
      $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
                ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
                ->whereDate('dd',$dd)
                ->where('customers.customertype','PARTNER')->count();
      $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
                ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
                ->whereDate('dd',$dd)
                ->where('customers.customertype','BANK')->count();
      return response()->json(['precords'=>$partner_records,'brecords'=>$bank_records]);

    }
    public function edit(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $ptransfer1=null;
        //$hasothercode=null;
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BANK','PARTNER'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $currencies=Currency::where('active',1)->where('ispandp',0)->get();
        $ptransfer=PartnerTransfer::where('id',$request->id)->first();

        if($ptransfer->cashdraw_id>0){
            return response()->json(['error'=>true,'message'=>'this record has been cashdraw']);
        }
        $trcode=$ptransfer->trancode;
        $mapid=$ptransfer->map_id;
        if($mapid){
            $ptransfer1=PartnerTransfer::find($mapid);
        }else{
            //$hasothercode=DB::table('partner_transfers')->where('ref_number','transfer-'. $request->id)->exists();
            //$hasothercode=$ptransfer->ref_group_id;

        }

        //check if has exchange dissable amount

        // if($hasothercode==false){
        //     $hasothercode=DB::table('exchanges')->where('othercode','transfer-'. $request->id)->exists();
        //     if($hasothercode==false){
        //         $hasothercode=DB::table('user_capitals')->where('ref_number','transfer-'. $request->id)->exists();
        //     }
        // }

        return view('moneytransfers.formtransferedit',compact('partners','customers','currencies','provinces','ptransfer','ptransfer1'));
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
        $useractions=CashdrawSelect::whereDate('created_at','>=',$sd1)->whereDate('created_at','<=',$sd2)->whereNotNull('transfer_id')->orderBy('id')->get()->load('user','transfer');
        return response()->json(['useractions'=>$useractions]);

    }
    public function deleteuseraction(Request $request)
    {
        DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();
        DB::table('partner_cashdraw_temps')->where('transfer_id',$request->id)->delete();

    }
    public function deleteuseractionbytransferid(Request $request)
    {
        DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();
    }
    public function cashdrawselectdelaction(Request $request)
    {
        DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();
    }
    public function saveuseraction(Request $request)
    {
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
    }
    public function getmulticashdraw(Request $request)
    {
      $multicashdraws=PartnerCashdrawTemp::where('select_by_id',Auth::id())->whereNull('sms_id')->orderBy('id')->get();
      $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
      return view('moneytransfers.multicashdraws',compact('multicashdraws','currencies'));
    }
    public function unselectcashdraw(Request $request)
    {
      $del1=DB::table('cashdraw_selects')->where('transfer_id',$request->id)->delete();
      $del2=DB::table('partner_cashdraw_temps')->where('transfer_id',$request->id)->delete();
      return response()->json(['del2'=>$del2]);
    }
    public function clearcashdrawselect(Request $request)
    {
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd=date('Y-m-d',strtotime($current));
      $selects=PartnerCashdrawTemp::where('select_by_id',Auth::id())->whereNull('sms_id')->get();
      foreach($selects as $s)
      {
        DB::table('cashdraw_selects')->where('transfer_id',$s->transfer_id)->delete();
      }
      $del2=DB::table('partner_cashdraw_temps')->where('select_by_id',Auth::id())->whereNull('sms_id')->delete();
    }

    public function opencashdraw(Request $request)
    {
        //return $request->all();
        $ptransfer=PartnerTransfer::where('id',$request->id)->where('status',1)->first();
        if(!$ptransfer){
            return response()->json(['error'=>true,'errorsms'=>'no transaction found']);
        }else{
            // if(Auth::user()->role->name!='Admin'){
            //   $exchangetousd=UserReport::exchangetousd(abs($ptransfer->amount),$ptransfer->currency_id);
            //   if(floatval($request->amtset)<floatval($exchangetousd[0])){
            //       return response()->json(['error'=>true,'errorsms'=>'maximum amount cashdraw limit']);
            //   }
            // }
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
        if($request->isselect==1){
          $tempcashdraw=new PartnerCashdrawTemp();
          $tempcashdraw->select_by_id=Auth::id();
          $tempcashdraw->transfer_id=$ptransfer->id;
          $tempcashdraw->transfer_date=$ptransfer->dd;
          $tempcashdraw->partner_id=$ptransfer->parrent_id;
          $tempcashdraw->user_id=$ptransfer->user_id;
          $tempcashdraw->sender_name=$ptransfer->sendername;
          $tempcashdraw->sender_tel=$ptransfer->sendertel;
          $tempcashdraw->rec_name=$ptransfer->recname;
          $tempcashdraw->rec_tel=$ptransfer->rectel;
          $tempcashdraw->amount=$ptransfer->amount;
          $tempcashdraw->currency_id=$ptransfer->currency_id;
          $tempcashdraw->created_at=$current;
          $tempcashdraw->updated_at=$current;
          try{
              $tempcashdraw->saveOrFail();
          }catch(\Exception $exception){
              //return view('moneytransfers.thiscashdrawalreadyopen');
              $selby=PartnerCashdrawTemp::where('transfer_id',$request->id)->first();
              return response()->json(['error'=>true,'errorsms'=>$selby->selectby->name . ' is processing...']);
          }
        }
            //$selcomid=Session('log_into_company_id');
            // $partners=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','PARTNER')->orderBy('no')->get();
            // $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
            // $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
            // $provinces = Address::whereNull('province_id')->get();
            // $currencies=Currency::where('active',1)->where('ispandp',0)->get();

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
            $ptransfer=$ptransfer->load('currency','customer','partner');
            return response()->json(['ptransfer'=>$ptransfer,'mex'=>$mex,'totalbuy'=>$totalbuy,'totalsale'=>$totalsale,'cashin'=>$cashin,'cashout'=>$cashout]);

            //return view('moneytransfers.cashdrawform',compact('partners','customers','banks','provinces','currencies','ptransfer','mex','totalbuy','totalsale','cashin','cashout'));
    }
    public function check_reference_id(Request $request)
    {
        //return $request->all();
        $refnum=PartnerTransfer::where('ref_number',$request->refid)->where('status',1)->exists();
        return response()->json(['see'=>$refnum]);
    }
    public function savebankcontinue(Request $request)
    {
        //return $request->all();
        $validator3 = Validator::make($request->all(), [
            'selpartner_continue_2' => 'required', //input array validate
            'amount_continue_2' => 'required', //input array validate
            'selcur_continue_2'=>'required',
            'cuscharge_continue_2'=>'required',
            'fee_continue_2'=>'required',
        ]);
        if ($validator3->fails()) {
            return response()->json(['error'=>$validator3->errors()->all()]);
        }
        $note='';
        if($note==''){
            $note='ចូលបញ្ជី' . $request->partnername;
        }else{
            $note .=' និង ចូលបញ្ជី' . $request->partnername;
        }
        // $paymethod='List';
        $refgroup='transfer-' . $request->receive_id;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->datecontinue);
        $opdate= date('Y-m-d', strtotime($date));
        $ptf1=new PartnerTransfer();
        $ptf1->tranname='បន្ត ' . $request->partnername;
        $ptf1->trancode=4;
        $ptf1->mekun=1;
        $ptf1->dd=$opdate;
        $ptf1->tt=$optime;
        $ptf1->user_id=Auth::id();
        $ptf1->parrent_id=$request->selpartner_continue_2;
        $ptf1->child=$request->son_2;
        $ptf1->amount= str_replace(',','',$request->amount_continue_2);
        $ptf1->currency_id=$request->selcur_continue_2;
        $ptf1->cuscharge=str_replace(',','',$request->cuscharge_continue_2);
        $ptf1->cuscharge_currency_id=$request->selcur_continue_2;
        $ptf1->fee=str_replace(',','',$request->fee_continue_2);
        $ptf1->bonus=0;
        $ptf1->sendername=$request->sendername_continue_2;
        $ptf1->sendertel=str_replace(' ','',$request->sendertel_continue_2);
        $ptf1->recname=$request->recname_continue_2;
        $ptf1->rectel=str_replace(' ','',$request->rectel_continue_2);
        $ptf1->note='ពាក់ព័ន្ធ ' .$request->receive_name;
        $ptf1->ref_number=$refgroup;
        $ptf1->action='d';
        //$ptf1->ref_group_id=$refgroup;

        if($ptf1->save()){
            $id=$ptf1->id;
            $refnum='transfer-'.$id;
            DB::table('partner_transfers')->where('id',$request->receive_id)->update(['note'=>$note,'ref_number'=>$refnum,'action'=>'']);
        }

        return response()->json(['success'=>true]);

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
            $filename='kh_'.$cashdraw_id.'_'.$n.'.jpg';
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $cimg=new CashdrawImage();
            $cimg->cashdraw_id=$cashdraw_id;
            $cimg->imgpath=$filename;
            $cimg->created_at=$current;
            $cimg->updated_at=$current;
            $cimg->save();
        }
    }
    public function savecashdraw(Request $request)
    {
        //return $request->all();
        if($request->hasmulticashdraw==1){
          $validator = Validator::make($request->all(), [
              'list_transferid.*' =>'required|unique:cashdraws,transfer_id,NULL,id,status,1',
          ]);
        }else{
          $validator = Validator::make($request->all(), [
              //'rec_tel' => 'required', //input array validate
              'transfer_id' => ['required',Rule::unique('cashdraws')->where(function ($query) use ($request) {
                return $query->where('transfer_id', $request->transfer_id)->where('status',1);
            })],
          ]);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $validator1 = Validator::make($request->all(), []);
        $validator2 = Validator::make($request->all(), []);
        $validator3 = Validator::make($request->all(), []);
        $validator33 = Validator::make($request->all(), []);
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
            $validator3 = Validator::make($request->all(), [
                'selpartner_continue' => 'required', //input array validate
                'amount_continue' => 'required', //input array validate
                'selcur_continue'=>'required',
                'cuscharge_continue'=>'required',
                'fee_continue'=>'required',

            ]);
        }
        if($request->hasbankpayment=='1'){
          $validator33 = Validator::make($request->all(), [
              'bankname.*' => 'required', //input array validate
              'bankamt.*' => 'required', //input array validate
              'bankcur.*' => 'required', //input array validate

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

        $paymethod='Cash';
        if($request->hascontinue=='1'){
            $paymethod='List';
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $optime = date("H:i:s",strtotime($current));
        $optime1=date('H:i:s',strtotime($optime . ' +1 seconds'));
        $date = str_replace('/', '-', $request->opdate);
        $opdate= date('Y-m-d', strtotime($date));
        $date1 = str_replace('/', '-', $request->opdates);
        $opdate1= date('Y-m-d', strtotime($date1));
        $ref_group_id='';
        $cashdraw_id=0;
        $found_group=0;
        $selcomid=Session('log_into_company_id');
        if($request->hasmulticashdraw==1){
          foreach ($request->list_transferid as $key => $value) {
            $cashdraw=new Cashdraw();
            $cashdraw->from_partner_id=$request->list_partnerid[$key];
            $cashdraw->transfer_id=$request->list_transferid[$key];
            $cashdraw->opdate=$opdate1;
            $cashdraw->optime=$optime;
            $cashdraw->user_id=Auth::id();
            $cashdraw->amount=str_replace(',','',$request->list_amount[$key]);
            $cashdraw->currency_id=$request->list_currencyid[$key];
            $cashdraw->customer_charge=str_replace(',','',$request->list_cuscharge[$key]);
            $cashdraw->cuscharge_currency_id=$request->list_curcharge_id[$key];
            $cashdraw->paymethod=$paymethod;
            $cashdraw->receive_tel=str_replace(' ','',$request->list_rectel[$key]);
            $cashdraw->receive_name=$request->list_recname[$key];
            $cashdraw->note= $request->txtnotes;
            $cashdraw->other=$other;
            $cashdraw->action='';
            $cashdraw->ref_group_id=$ref_group_id;
            $cashdraw->created_at=$current;
            $cashdraw->updated_at=$current;
            $cashdraw->company_id=$selcomid;
            if($cashdraw->save()){
              if($key==0){
                $cashdraw_id=$cashdraw->id;
                $ref_group_id='cashdraw-'. $cashdraw_id;
              }
              $found_group=1;
              $userprint=Auth::user()->name;
              DB::table('partner_transfers')->where('id',$request->list_transferid[$key])->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_number'=>'cashdraw-'.$cashdraw_id,'action'=>'']);
              // DB::table('money_print_slips')->insert([
              //     ['printby'=>$userprint,'dd'=>$opdate1,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លុយទទួល','quote'=>$request->list_amount[$key] . ' ' . $cashdraw->currency->shortcut,'amount'=>0,'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate1,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'កាត់សេវ៉ា','quote'=>$request->list_cuscharge[$key] . ' ' . $cashdraw->currency->shortcut,'amount'=>0,'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate1,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លុយបើក','quote'=>$request->list_amount_open[$key] . ' ' . $cashdraw->currency->shortcut,'amount'=>-1 * str_replace(',','',$request->list_amount_open[$key]),'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate1,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'អ្នកទទួល','quote'=>$request->list_rectel[$key] . ' ' . $request->list_recname[$key],'amount'=>0,'curname'=>'','showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //   ]);
            }
          }
          DB::table('partner_cashdraw_temps')->where('select_by_id',Auth::id())->delete();
        }else{
          $cashdraw=new Cashdraw();
          $cashdraw->from_partner_id=$request->from_partner_id;
          $cashdraw->transfer_id=$request->transfer_id;
          $cashdraw->opdate=$opdate;
          $cashdraw->optime=$optime;
          $cashdraw->user_id=Auth::id();
          $cashdraw->amount=str_replace(',','',$request->amount);
          $cashdraw->currency_id=$request->curid;
          $cashdraw->customer_charge=str_replace(',','',$request->cuscharge);
          $cashdraw->cuscharge_currency_id=$request->curid;
          $cashdraw->paymethod=$paymethod;
          $cashdraw->receive_tel=str_replace(' ','',$request->rec_tel);
          $cashdraw->receive_name=$request->rec_name;
          $cashdraw->note=$request->txtnote;
          $cashdraw->other=$other;
          $cashdraw->created_at=$current;
          $cashdraw->updated_at=$current;
          $cashdraw->company_id=$selcomid;
          $cashdraw->action='d';
          if($cashdraw->save()){
              $found_group='';
              $cashdraw_id=$cashdraw->id;
              $userprint=Auth::user()->name;
              DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_number'=>'cashdraw-'.$cashdraw_id,'action'=>'']);
              // DB::table('money_print_slips')->insert([
              //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លុយទទួល','quote'=>$request->amount . ' ' . $cashdraw->currency->shortcut,'amount'=>0,'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'កាត់សេវ៉ា','quote'=>$request->cuscharge . ' ' . $cashdraw->currency->shortcut,'amount'=>0,'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លុយបើក','quote'=>$request->openamt . ' ' . $cashdraw->currency->shortcut,'amount'=>-1 * str_replace(',','',$request->openamt),'curname'=>$cashdraw->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'អ្នកទទួល','quote'=>$request->rec_tel . ' ' . $request->rec_name,'amount'=>0,'curname'=>'','showprint'=>1,'created_at'=>$current,'isnumber'=>1],
              //   ]);
                if($request->hascontinue==1){
                  $found_group=1;
                    $ptf1=new PartnerTransfer();
                    $ptf1->tranname='បើកវេរបន្ត';
                    $ptf1->trancode=1;
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
                    $ptf1->fee=str_replace(',','',$request->fee_continue);
                    $ptf1->fee_currency_id=$request->txtcur1;
                    $ptf1->bonus=0;
                    $ptf1->sendername=$request->sendername_continue;
                    $ptf1->sendertel=str_replace(' ','',$request->sendertel_continue);
                    $ptf1->recname=$request->recname_continue;
                    $ptf1->rectel=str_replace(' ','',$request->rectel_continue);
                    $ptf1->note=$request->frompartner . ' ថ្ងៃទទួល:'. $request->invdate . ' ចំនួន:' . $request->amount . $request->curshortcut;
                    // $ptf1->ref_number='cashdraw-' . $cashdraw_id . ',transfer-'.$request->transfer_id;
                    $ptf1->ref_number='cashdraw-' . $cashdraw_id;
                    $ptf1->ref_group_id='cashdraw-' . $cashdraw_id;
                    $ptf1->company_id=$selcomid;
                    $ptf1->user_affect=$this->getuseraffectbank($request->selpartner_continue);
                    if($ptf1->save())
                    {
                        $idc=$ptf1->id;
                        $refnum='transfer-' . $idc;
                        $pname='បន្តទៅ '.$ptf1->partner->name .' ថ្ងៃទី' . $request->opdate . ' ចំនួន' . $this->phpformatnumber($ptf1->amount) . $ptf1->currency->sk;
                        //DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['note'=>$pname,'ref_number'=>$refnum]);
                        DB::table('partner_transfers')->where('id',$request->transfer_id)->update(['note'=>$pname]);

                    }
                    $continueto='';
                    if(is_null($ptf1->child)){
                        $continueto=$ptf1->partner->name;
                    }else{
                        $continueto=$ptf1->child;
                    }
                    // DB::table('money_print_slips')->insert([
                    //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'បន្តទៅ','quote'=>$continueto,'amount'=>0,'curname'=>$ptf1->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>0],
                    //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'វេរចំនួន','quote'=>$this->phpformatnumber($ptf1->amount) . ' ' . $ptf1->currency->shortcut,'amount'=>$ptf1->amount,'curname'=>$ptf1->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
                    //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'សេវ៉ា','quote'=>$this->phpformatnumber($ptf1->cuscharge) . ' ' . $ptf1->currency->shortcut,'amount'=>$ptf1->cuscharge,'curname'=>$ptf1->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
                    //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'សរុប','quote'=>$this->phpformatnumber($ptf1->cuscharge+$ptf1->amount) . ' ' . $ptf1->currency->shortcut,'amount'=>0,'curname'=>$ptf1->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>1],
                    //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លេខអ្នកទទួល','quote'=>$ptf1->rectel,'amount'=>0,'curname'=>$ptf1->currency->shortcut,'showprint'=>1,'created_at'=>$current,'isnumber'=>0],
                    // ]);
                }
          }

        }
        if($request->hasexchange==1){
          if(is_null($request->maincur)){
              $this->saveexchangeproduct($request,$opdate,$optime1,'cashdraw-' . $cashdraw_id,'បើកវេរប្តូរប្រាក់',$current,Auth::id());
          }else{
              $this->saveexchange($request,$opdate,$optime1,'cashdraw-' . $cashdraw_id,'បើកវេរប្តូរប្រាក់',$current,Auth::id());
          }
        }else if($request->hasexchange==2){
            $this->savemultiexchanges($request,$opdate,$optime1,'cashdraw-' . $cashdraw_id,'បើកវេរប្តូរប្រាក់',$current,Auth::id());
        }
        if($request->hasexchange>0){
            $found_group=1;
            $es=ExchangeMulti::where('status',1)->where('othercode','cashdraw-' . $cashdraw_id)->get();
            foreach($es as $e){
                if($e->buy>$e->sale){
                    $extext=$this->phpformatnumber($e->buy) . $e->curbuy . '/' . $this->phpformatnumber($e->rate) . '='  . $this->phpformatnumber($e->sale) . $e->cursale;
                }else{
                    $extext=$this->phpformatnumber($e->buy) . $e->curbuy . '*' . $this->phpformatnumber($e->rate) . '='  . $this->phpformatnumber($e->sale) . $e->cursale;
                }
                // DB::table('money_print_slips')->insert([
                //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'ប្តូរប្រាក់','quote'=>$extext,'amount'=>$e->buy,'curname'=>$e->curbuy,'showprint'=>1,'created_at'=>$current,'isnumber'=>0],
                //     ['printby'=>$userprint,'dd'=>$opdate,'tt'=>$optime,'type'=>'cashdraw','ref_number'=>'cashdraw-'. $cashdraw_id,'title'=>'លក់ចេញ','quote'=>'','amoun'=>-1 * $e->sale,'curname'=>$e->cursale,'showprint'=>0,'created_at'=>$current,'isnumber'=>0],

                // ]);
            }
        }
        if($request->hasbankpayment==1){
            $found_group=1;
          $this->customerpaytransferbybank($request,$opdate,$optime1,'cashdraw-' . $cashdraw_id,'បើកវេរទូទាត់តាមធនាគា',0,$current,'0',Auth::id());
      }
        if($found_group==1){
          DB::table('cashdraws')->where('id',$cashdraw_id)->update(['ref_group_id'=>'cashdraw-'.$cashdraw_id]);
        }
        if($request->foundmulti_image>0){
            $this->savemultiimage($request,$cashdraw_id,$current);
        }else if($request->clickcapture2==1){

            $imgname=$request->photopath;
            $folderPath = "public/myimages/";
            $image_paths = explode(";base64,", $imgname);
            $image_base64 = base64_decode($image_paths[1]);
            //$filename = uniqid() . '.jpg';
            $filename='kh_'.$cashdraw_id.'.jpg';
            $file = $folderPath . $filename;
            file_put_contents($file, $image_base64);
            $cimg=new CashdrawImage();
            $cimg->cashdraw_id=$cashdraw_id;
            $cimg->imgpath=$filename;
            $cimg->created_at=$current;
            $cimg->updated_at=$current;
            $cimg->save();
        }else{
            $image=$request->file('image2');
            if($image){
                //File::delete(public_path('myimages/'.$old_image));
                //$imgname=time().'-'.$image->getClientOriginalName();
                $imgname='kh_'.$cashdraw_id.'-'.$image->getClientOriginalName();
                $image->move(public_path('myimages/'),$imgname);
                $cimg=new CashdrawImage();
                $cimg->cashdraw_id=$cashdraw_id;
                $cimg->imgpath=$imgname;
                $cimg->created_at=$current;
                $cimg->updated_at=$current;
                $cimg->save();
              }

        }
        return response()->json(['cashdrawid'=>'cashdraw-'.$cashdraw_id]);
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
        $selcomid=Session('log_into_company_id');

        $logo=Company::find($selcomid);
        $id=explode("-",$request->ref_number)[1];
        $transfer=Cashdraw::find($id);
        //$transfer=Cashdraw::where('ref_group_id',$request->ref_number)->first();
        $transfers=Cashdraw::where('ref_group_id',$request->ref_number)->orderBy('id')->get();
        $exchanges=ExchangeMulti::where('ref_group_id',$request->ref_number)->orderBy('id')->get();
        //$bankpayments=PartnerTransfer::where('ref_group_id',$request->ref_number)->get();
        //$bankpayments=PartnerTransfer::where('ref_group_id',$request->ref_number)->where('cashdraw_id','<>',$id)->get();
        $bankpayments=PartnerTransfer::where('ref_group_id',$request->ref_number)->whereNull('cashdraw_id')->get();
        // ->where(function($q) use($id){
        //     return $q->whereNull('cashdraw_id')->orWhere('cashdraw_id','<>',$id);
        // })
        // ->get();

        //return $bankpayments;
        $totalcashdrawamount=Cashdraw::where('ref_group_id',$request->ref_number)->select(DB::raw('sum(amount) as tamt,currency_id'))->groupBy('currency_id')->get();
        $totalcashdraw_cuscharge=Cashdraw::where('ref_group_id',$request->ref_number)->select(DB::raw('sum(customer_charge) as tcuscharge,cuscharge_currency_id'))->groupBy('cuscharge_currency_id')->get();
        //return $totalcashdraw_cuscharge;
        //return $transfer;
        $c=collect();
        if($totalcashdrawamount){
          foreach($totalcashdrawamount as $a1){
            $c=$c->push(['cur'=>$a1->currency->shortcut,'value'=> -1 * $a1->tamt]);
          }
        }
        if($totalcashdraw_cuscharge){
          foreach($totalcashdraw_cuscharge as $a2){
            $c=$c->push(['cur'=>$a2->cuschargecur->shortcut,'value'=> $a2->tcuscharge]);
          }
        }

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
                if($bp->currency_id==$bp->cuscharge_currency_id)
                {
                    $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount+$bp->cuscharge]);
                }else{
                    $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount]);
                }
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

        return view('moneytransfers.cashdrawprint1',compact('totalcashdrawamount','totalcashdraw_cuscharge','exchanges','transfers','transfer','cashin','bankpayments','cash','logo'));
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
    public function delete(Request $request)
    {
        //check is cashdraw ready
        // $cashdraw=Cashdraw::where('transfer_id',$request->id)->exists();
        // if($cashdraw==true){
        //     return response()->json(['error'=>true,'message'=>'this record has been cashdraw']);
        // }
        //$current = now()->timezone('Asia/Phnom_Penh');
        $id1=$request->id;
        $id2=0;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $ptransfer=PartnerTransfer::where('id',$request->id)->first();
        if($ptransfer->cashdraw_id>0){
            $checkcashdraw_id=Cashdraw::where('id',$ptransfer->cashdraw_id)->where('status',1)->exists();
            if($checkcashdraw_id){
                return response()->json(['error'=>true,'message'=>'this record has been cashdraw']);
            }
        }
        $trcode=$ptransfer->trancode;
        $mapid=$ptransfer->map_id;

        $del1=PartnerTransfer::find($request->id);
        $del1->status=0;
        $del1->user_delete=Auth::id();
        if($del1->save()){
          if($del1->exchange_list_id){
            $stbe1=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$del1->exchange_list_id)->sum('amount');
            DB::table('exchanges')->where('id',$del1->exchange_list_id)->update(['p_inout'=>$stbe1]);
          }
            if($mapid){
                $del2=PartnerTransfer::find($mapid);
                $del2->status=0;
                $del2->user_delete=Auth::id();

                if($del2->save()){
                  $id2=$del2->id;
                  if($del2->exchange_list_id){
                    $stbe2=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$del2->exchange_list_id)->sum('amount');
                    DB::table('exchanges')->where('id',$del2->exchange_list_id)->update(['p_inout'=>$stbe2]);
                  }
                }
            }

            DB::table('exchanges')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'userdel'=>Auth::user()->name,'updated_at'=>$current]);
            DB::table('exchange_multis')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'userdel'=>Auth::user()->name,'updated_at'=>$current]);
            //DB::table('bank_transactions')->where('ref_number','transfer-'.$request->id)->update(['status'=>0,'delby'=>Auth::user()->name,'updated_at'=>$current]);
            DB::table('partner_transfers')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'user_delete'=>Auth::id(),'updated_at'=>$current]);
            DB::table('cashdraws')->where('ref_group_id','transfer-'.$request->id)->update(['status'=>0,'delby'=>Auth::user()->name,'updated_at'=>$current]);
            //$this->storeupdated($id1,$id2,0);
            return response()->json(['success'=>true,'message'=>'this record has been deleted']);
        }
    }
    public function update(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'selpartner' => 'required',
            'amount' => 'required',
            'selcur'=>'required',
            'txtcur1'=>'required',
            'fee'=>'required',
        ]);
        $validator4 = Validator::make($request->all(), []);
        $validator5 = Validator::make($request->all(), []);
        if($request->trancode=='-4'){
            $validator4 = Validator::make($request->all(), [
                'selpartner2' => 'required', //input array validate
                'amountcontinue' => 'required', //input array validate
                'selcurcontinue' => 'required', //input array validate
                'fee2' => 'required', //input array validate
                'txtcur2'=>'required',
            ]);
        }
        if($request->trancode=='3'){
            $validator5 = Validator::make($request->all(), [
                'selcustomer' => 'required', //input array validate
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->trancode==-4){
            if ($validator4->fails()) {
                return response()->json(['error'=>$validator4->errors()->all()]);
            }
        }
        if($request->trancode==3){
            if ($validator5->fails()) {
                return response()->json(['error'=>$validator5->errors()->all()]);
            }
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));

        $this->storeupdated($request->id1,$request->id2,1);

        if($request->trancode==-4){
          if($request->mekun==1){
            $tranname1='បន្ត';
            $tranname2="ទទួល";
          }else{
            $tranname1='ទទួល';
            $tranname2="បន្ត";
          }
        }else{
          if($request->mekun==1){
            $tranname1='ផ្ញើ';
            $tranname2="ទទួល";
          }else{
            $tranname1='ទទួល';
            $tranname2="ផ្ញើ";
          }
        }
        $ptf=PartnerTransfer::find($request->id1);
        $ptf->dd=$trandate;
        $ptf->mekun=$request->mekun;
        //$ptf->tt=$trantime;
        $ptf->tranname=$tranname1 . $request->partner;
        $ptf->user_update_id=Auth::id();
        $ptf->parrent_id=$request->selpartner;
        $ptf->child=$request->son;
        if($request->trancode==3){
            $ptf->customer_id=$request->selcustomer;
        }
        $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
        $ptf->currency_id=$request->selcur;
        if($request->mekun==1){
            $ptf->cuscharge=str_replace(',','',$request->cuscharge);
            $ptf->cuscharge_currency_id=$request->selcur1;
        }else{
            $ptf->cuscharge=0;
            $ptf->cuscharge_currency_id=$request->selcur;
        }
        $ptf->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee));
        $ptf->fee_currency_id=$request->txtcur1;
        $ptf->interest=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->interest1));
        $ptf->bonus=0;
        $ptf->sendername=$request->sendername;
        $ptf->sendertel=str_replace(' ','',$request->sendertel);
        $ptf->recname=$request->recname;
        $ptf->rectel=str_replace(' ','',$request->rectel);
        $ptf->note=$request->partner2;
        $ptf->updated_at=$current;
        if($ptf->save()){
          if($ptf->exchange_list_id){
              $stbe1=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$ptf->exchange_list_id)->sum('amount');
              DB::table('exchanges')->where('id',$ptf->exchange_list_id)->update(['p_inout'=>$stbe1]);
            }
            if($request->trancode==-4){
                $ptf1=PartnerTransfer::find($request->id2);

                $ptf->mekun=$request->mekun * -1;
                $ptf1->dd=$trandate;
                //$ptf1->tt=$trantime;
                $ptf1->user_update_id=Auth::id();
                $ptf1->tranname=$tranname2 . $request->partner2;
                $ptf1->parrent_id=$request->selpartner2;
                $ptf1->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amountcontinue)) * -1;
                $ptf1->currency_id=$request->selcurcontinue;

                $ptf1->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee2)) * -1;
                $ptf1->fee_currency_id=$request->txtcur2;
                $ptf1->bonus=0;
                $ptf1->interest= floatval($request->mekun) * floatval(str_replace(',','',$request->interest2));
                $ptf1->sendername=$request->sendername;
                $ptf1->sendertel=str_replace(' ','',$request->sendertel);
                $ptf1->recname=$request->recname;
                $ptf1->rectel=str_replace(' ','',$request->rectel);
                $ptf1->note=$request->partner;
                $ptf1->updated_at=$current;
                if($ptf1->save()){
                  if($ptf1->exchange_list_id){
                    $stbe2=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$ptf1->exchange_list_id)->sum('amount');
                    DB::table('exchanges')->where('id',$ptf1->exchange_list_id)->update(['p_inout'=>$stbe2]);
                  }
                }
            }
            if($request->trancode==3){
                $ptf1=PartnerTransfer::find($request->id2);
                $ptf->mekun=floatval($request->mekun) * -1;
                $ptf1->dd=$trandate;
                //$ptf1->tt=$trantime;
                $ptf1->user_update_id=Auth::id();
                $ptf1->parrent_id=$request->selcustomer;
                $ptf1->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount)) * -1;
                $ptf1->currency_id=$request->selcur;
                $ptf1->cuscharge=str_replace(',','',$request->cuscharge);
                $ptf1->cuscharge_currency_id=$request->selcur1;
                $ptf1->fee=-1 * floatval(str_replace(',','',$request->cuscharge));
                $ptf1->bonus=0;
                $ptf1->sendername=$request->sendername;
                $ptf1->sendertel=str_replace(' ','',$request->sendertel);
                $ptf1->recname=$request->recname;
                $ptf1->rectel=str_replace(' ','',$request->rectel);
                $ptf1->note=$request->partner;
                $ptf1->updated_at=$current;
                $ptf1->save();

            }
            $this->storeupdated($request->id1,$request->id2,1);
            return response()->json(['success'=>'true','message'=>'transfer has been saved.']);
        }

    }

    public function storeupdated_old($id1,$id2,$status)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $transfer1=PartnerTransfer::find($id1);

        if($transfer1){
            if($transfer1->ref_group_id){
                $trgroups=PartnerTransfer::where('ref_group_id','transfer-'. $id1)->orderBy('id')->get();
                foreach($trgroups as $t)
                {
                    $ptf=new MoneyTransferUpdate();
                    $ptf->action_by_id=Auth::id();
                    $ptf->partner_transfer_id=$t->id;
                    $ptf->ref_number=$t->ref_number;
                    $ptf->ref_group_id=$t->ref_group_id;
                    $ptf->map_id=$t->map_id;
                    $ptf->dd=$t->dd;
                    $ptf->mekun=$t->mekun;
                    $ptf->tranname=$t->tranname;
                    $ptf->tt=$t->tt;
                    $ptf->user_id=$t->user_id;
                    $ptf->parrent_id=$t->parrent_id;
                    $ptf->child=$t->child;
                    $ptf->customer_id=$t->customer_id;
                    $ptf->amount=$t->amount;
                    $ptf->currency_id=$t->currency_id;
                    $ptf->cuscharge=$t->cuscharge;
                    $ptf->cuscharge_currency_id=$t->cuscharge_currency_id;
                    $ptf->fee=$t->fee;
                    $ptf->fee_currency_id=$t->fee_currency_id;
                    $ptf->bonus=0;
                    $ptf->sendername=$t->sendername;
                    $ptf->sendertel=str_replace(' ','',$t->sendertel);
                    $ptf->recname=$t->recname;
                    $ptf->rectel=str_replace(' ','',$t->rectel);
                    $ptf->note=$t->note;
                    $ptf->status=$status;
                    $ptf->company_id=$selcomid;
                    $ptf->created_at=$current;
                    $ptf->updated_at=$current;
                    $ptf->save();
                }
            }else{
                $ptf=new MoneyTransferUpdate();
                $ptf->action_by_id=Auth::id();
                $ptf->partner_transfer_id=$id1;
                $ptf->ref_number=$transfer1->ref_number;
                $ptf->ref_group_id=$transfer1->ref_group_id;
                $ptf->map_id=$transfer1->map_id;
                $ptf->dd=$transfer1->dd;
                $ptf->mekun=$transfer1->mekun;
                $ptf->tranname=$transfer1->tranname;
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
                $ptf->company_id=$selcomid;
                $ptf->created_at=$current;
                $ptf->updated_at=$current;
                $ptf->save();
            }

        }
        // $transfer2=PartnerTransfer::find($id2);
        // if($transfer2){
        //     $ptf2=new MoneyTransferUpdate();
        //     $ptf2->action_by_id=Auth::id();
        //     $ptf2->partner_transfer_id=$id2;
        //     $ptf2->ref_number=$transfer2->ref_number;
        //     $ptf2->map_id=$transfer2->map_id;
        //     $ptf2->dd=$transfer2->dd;
        //     $ptf2->tranname=$transfer2->tranname;
        //     $ptf2->mekun=$transfer2->mekun;
        //     $ptf2->tt=$transfer2->tt;
        //     $ptf2->user_id=$transfer2->user_id;
        //     $ptf2->parrent_id=$transfer2->parrent_id;
        //     $ptf2->child=$transfer2->child;
        //     $ptf2->customer_id=$transfer2->customer_id;
        //     $ptf2->amount=$transfer2->amount;
        //     $ptf2->currency_id=$transfer2->currency_id;
        //     $ptf2->cuscharge=$transfer2->cuscharge;
        //     $ptf2->cuscharge_currency_id=$transfer2->cuscharge_currency_id;
        //     $ptf2->fee=$transfer2->fee;
        //     $ptf2->fee_currency_id=$transfer2->fee_currency_id;
        //     $ptf2->bonus=0;
        //     $ptf2->sendername=$transfer2->sendername;
        //     $ptf2->sendertel=str_replace(' ','',$transfer2->sendertel);
        //     $ptf2->recname=$transfer2->recname;
        //     $ptf2->rectel=str_replace(' ','',$transfer2->rectel);
        //     $ptf2->note=$transfer2->note;
        //     $ptf2->status=$status;
        //     $ptf2->created_at=$current;
        //     $ptf2->updated_at=$current;
        //     $ptf2->save();
        // }
    }
    public function storeupdated($id1, $id2, $status)
    {
        $selcomid = session('log_into_company_id');
        $current = now()->timezone('Asia/Phnom_Penh');
        $transfer1 = PartnerTransfer::find($id1);

        if (!$transfer1) {
            return;
        }
        if ($transfer1->ref_group_id) {
            $trgroups = PartnerTransfer::where('ref_group_id', $transfer1->ref_group_id)->orderBy('id')->get();
            foreach ($trgroups as $t) {
                $this->cloneTransferToUpdate($t, $status, $selcomid, $current);
            }
        } else {
            $this->cloneTransferToUpdate($transfer1, $status, $selcomid, $current);
        }
    }
    private function cloneTransferToUpdate($transfer, $status, $companyId, $current)
    {
        $ptf = new MoneyTransferUpdate();
        $ptf->action_by_id = Auth::id();
        $ptf->partner_transfer_id = $transfer->id;
        $ptf->ref_number = $transfer->ref_number;
        $ptf->ref_group_id = $transfer->ref_group_id??$transfer->id;
        $ptf->map_id = $transfer->map_id;
        $ptf->dd = $transfer->dd;
        $ptf->mekun = $transfer->mekun;
        $ptf->tranname = $transfer->tranname;
        $ptf->trancode=$transfer->trancode;
        $ptf->tt = $transfer->tt;
        $ptf->user_id = $transfer->user_id;
        $ptf->parrent_id = $transfer->parrent_id;
        $ptf->child = $transfer->child;
        $ptf->customer_id = $transfer->customer_id;
        $ptf->amount = $transfer->amount;
        $ptf->currency_id = $transfer->currency_id;
        $ptf->cuscharge = $transfer->cuscharge;
        $ptf->cuscharge_currency_id = $transfer->cuscharge_currency_id;
        $ptf->fee = $transfer->fee;
        $ptf->fee_currency_id = $transfer->fee_currency_id;
        $ptf->bonus = 0;
        $ptf->sendername = $transfer->sendername;
        $ptf->sendertel = str_replace(' ', '', $transfer->sendertel);
        $ptf->recname = $transfer->recname;
        $ptf->rectel = str_replace(' ', '', $transfer->rectel);
        $ptf->note = $transfer->note;
        $ptf->status = $status;
        $ptf->company_id = $companyId;
        $ptf->created_at = $current;
        $ptf->updated_at = $current;
        $ptf->save();
    }

    public function gettemptransferlist()
    {
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("Y-m-d",strtotime($current));
      //$temps=PartnerTransferTemp::where('user_id',Auth::id())->whereDate('dd',$dd)->orderBy('id')->get()->load('partner','currency','user','cuschargecur','feecurrency');
      //return response()->json(['temps'=>$temps]);
      $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
      //$customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
      //$users=User::where('active',1)->get();
      $currencies=Currency::where('active',1)->where('ispandp',0)->get();

      $transfertemplists=PartnerTransferTemp::where('user_id',Auth::id())->orderBy('id')->get();
      return view('moneytransfers.templist',compact('transfertemplists','partners','currencies'));

    }
    public function deltransfertemplist(Request $request)
    {
      if($request->delall==1){
        DB::table('partner_transfer_temps')->where('user_id',Auth::id())->delete();
      }else{
        DB::table('partner_transfer_temps')->where('id',$request->id)->delete();
      }
    }
    public function savetotemplist(Request $request)
    {
      //return $request->all();
      $validator = Validator::make($request->all(), [
        'tranname'=>'required',
        'selpartner' => 'required',
        'amount' => 'required',
        'selcur'=>'required',
        'txtcur1'=>'required',
        'fee'=>'required',
        ]);
        if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $ptf=new PartnerTransferTemp();
        $ptf->tranname=$request->tranname . $request->partner1;
        $ptf->trancode=$request->trancode1;
        $ptf->dd=$trandate;
        $ptf->mekun=$request->mekun;
        //$ptf->tt=$trantime;
        $ptf->user_id=Auth::id();
        $ptf->parrent_id=$request->selpartner;
        // $ptf->child=$request->son;
        // $ptf->child_id=$request->child_id;
        // if($request->trancode1==3){
        //     $ptf->customer_id=$request->selcustomer;
        // }
        $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
        $ptf->currency_id=$request->selcur;
        if($request->mekun==1){
            $ptf->cuscharge=str_replace(',','',$request->cuscharge);
            $ptf->cuscharge_currency_id=$request->selcur1;
        }else{
            $ptf->cuscharge=0;
            $ptf->cuscharge_currency_id=$request->selcur;
        }
        $ptf->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee));
        $ptf->fee_currency_id=$request->txtcur1;
        // $ptf->bonus=0;
        // $ptf->interest=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->interest1));
        $ptf->sendername=$request->sendername;
        $ptf->sendertel=str_replace(' ','',$request->sendertel);
        $ptf->recname=$request->recname;
        $ptf->rectel=str_replace(' ','',$request->rectel);
        //$ptf->user_affect=$request->seluseraffect1;
        $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
        $ptf->created_at=$current;
        $ptf->updated_at=$current;
        if($ptf->save()){
          return response()->json(['success'=>true]);
        }
    }
    public function storemulti(Request $request,$trandate,$trtime,$trantime1,$trantime2,$current,$usersave)
    {
      $id=0;
      $ref_group_id='';
      $cashdraw_id='';
      $frompid=0;
      $banknote='';
      $partner_name='';
      $selcomid=Session('log_into_company_id');
      foreach ($request->list_partnername as $key => $value) {
        if($key==0){
          $frompid=$value;
        }
        $ptf=new PartnerTransfer();
        $ptf->company_id=$selcomid;
        $ptf->tranname=$request->list_tranname[$key]; //. $request->list_partnername[$key];
        $ptf->trancode=$request->list_trancode[$key];
        $ptf->mekun=$request->list_mekun[$key];
        $ptf->dd=$trandate;
        $ptf->tt=$trtime;
        $ptf->user_id=$usersave;
        $ptf->parrent_id=$value;
        $ptf->amount=floatval(str_replace(',','',$request->list_amount[$key]));
        $ptf->currency_id=$request->list_curid[$key];
        $ptf->cuscharge=str_replace(',','',$request->list_cuscharge[$key]);
        $ptf->cuscharge_currency_id=$request->list_curcharge_id[$key];
        $ptf->fee=str_replace(',','',$request->list_fee[$key]);
        $ptf->fee_currency_id=$request->list_curfee_id[$key];
        $ptf->bonus=0;
        $ptf->sendername=$request->list_sendername[$key];
        $ptf->sendertel=$request->list_sendertel[$key];
        $ptf->recname=$request->list_recname[$key];
        $ptf->rectel=$request->list_rectel[$key];
        //$ptf->user_affect=$request->list_user_affect[$key];
        $ptf->user_affect=$this->getuseraffectbank($value);
        $ptf->location_id=$request->location_id;
        $ptf->note='';

        $ptf->ismulti_transfer=1;
        $ptf->created_at=$current;
        $ptf->updated_at=$current;
        $ptf->user_delete=Auth::id();
        if($key==0){
          $ptf->action='u,d';
        }
        $ptf->ref_group_id=$ref_group_id;
        if($ptf->save()){
            $tran_id=$ptf->id;
            if($key==0){
              $id=$ptf->id;
              $ref_group_id='transfer-' . $id;
            }else if($key==1){
              DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$ref_group_id,'action'=>'u']);
            }

            $pid=$ptf->partner_id;
            $partner_name=$ptf->partner->name;
            if($banknote==''){
              $banknote=$partner_name;
            }else{
              $banknote .='|'.$partner_name;
            }
            $transferto=$ptf->partner->name;
            $customertype=$ptf->partner->customertype;
            if($request->list_trancode[$key]==-1){
              //if($customertype=='AGENT' || $customertype=='CUSTOMER' || ($customertype=='BANK' && $request->hasexchange>0)){//wing true money cashdraw
                if($request->autocashdraw==1){
                    if($request->list_amount[$key]<>0){
                        $cashdraw=new Cashdraw();
                        $cashdraw->company_id=$selcomid;
                        $cashdraw->from_partner_id=$pid;
                        $cashdraw->transfer_id=$id;
                        $cashdraw->opdate=$trandate;
                        $cashdraw->optime=$trantime1;
                        $cashdraw->user_id=$usersave;
                        $cashdraw->amount=abs(str_replace(',','',$request->list_amount[$key]));
                        $cashdraw->currency_id=$request->list_curid[$key];
                        $cashdraw->customer_charge=0;
                        $cashdraw->paymethod='Cash';
                        $cashdraw->receive_tel=str_replace(' ','',$request->list_rectel[$key]);
                        $cashdraw->receive_name=$request->list_recname[$key];
                        $cashdraw->note=$partner_name;
                        $cashdraw->other=$partner_name;
                        $cashdraw->ref_group_id=$ref_group_id;
                        $cashdraw->action='';
                        $cashdraw->created_at=$current;
                        $cashdraw->updated_at=$current;
                        if($cashdraw->save()){
                            $found_group='';
                            $cashdraw_id=$cashdraw->id;
                            DB::table('partner_transfers')->where('id',$tran_id)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_number'=>'cashdraw-'.$cashdraw_id,'action'=>'']);
                            //DB::table('cashdraws')->where('id',$cashdraw_id)->update(['ref_group_id'=>'cashdraw-' . $cashdraw_id]);
                        }
                    }
              }
            }

        }

      }
    //   if($request->autocashdraw==1){
    //    $ref_group_id='cashdraw-' . $cashdraw_id;
    //   }
    if($request->hasexchange==1){
        if(is_null($request->maincur)){
            $this->saveexchangeproduct($request,$trandate,$trantime1,$ref_group_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
        }else{
            $this->saveexchange($request,$trandate,$trantime1,$ref_group_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
        }
    }else if($request->hasexchange==2){
        $this->savemultiexchanges($request,$trandate,$trantime1,$ref_group_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
    }
        // if($request->hasexchange>0){
        //     DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$ref_group_id]);
        // }
        if($request->hasbankpayment==1){

            if($request->trancode1==-1){
                if($request->autocashdraw==1){
                    $trantime1=$trantime2;
                }
            }

            $this->customerpaytransferbybank($request,$trandate,$trantime1,$ref_group_id,$banknote,$id,$current,$frompid,$usersave);
        }
        if(isset($request->foundcontinue) && $request->foundcontinue==1){
            $this->savecontinuemulti($request,$trandate,$trantime1,$usersave,$id,$partner_name,$ref_group_id,$current,'');
          }
        if($request->autocashdraw==0){
            if($request->hasexchange>0 || $request->hasbankpayment==1){
              DB::table('partner_transfers')->where('id',$id)->update(['action'=>'u','ref_group_id'=>$ref_group_id]);
            }
        }
        //return $id;
        return array($id,$cashdraw_id,$ref_group_id);
    }
    public function wingedit(Request $request)
    {
        $id=$request->id;
        $groupid=$request->groupid;
        $transfer1=PartnerTransfer::find($id);
        $transfer2=PartnerTransfer::where('id','<>',$id)->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->orderBy('id')->first();
        return response()->json(['transfer1'=>$transfer1,'transfer2'=>$transfer2]);
    }
    public function checkthailistintransfer(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $smsid=$request->smsid;
        $sms=SMS::find($smsid);
        $op=$request->op;
        if($sms){
            $isopen=$sms->isopen;
        }else{
            return response()->json(['error'=>true,'message'=>'smsid not found']);
        }
        //check if found thai_sms_id in transfer
        $foundthaismsid=PartnerTransfer::where('thai_sms_id',$smsid)->exists();
        if($foundthaismsid==true){
            if($isopen==0){//when save first time erro on update sms isopen
                $thai_transfer=PartnerTransfer::where('status',1)->where('amount',$request->op,0)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))
                ->where(function($query) use($smsid){
                    $query->where('thai_sms_id',$smsid)->orWhere(function($query){
                        $query->whereNotNull('thai_list')->whereNull('thai_sms_id');
                    });
                })->orderBy('id')->get()->load('partner','user');
                return response()->json(['thai_transfer'=>$thai_transfer]);
            }
        }
        $thai_transfer=PartnerTransfer::where('status',1)->whereNotNull('thai_list')->whereNull('thai_sms_id')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))
        ->where(function($q) use($op){
            $q->where('amount',$op,0)->orWhere('trancode',1);
        })
        ->orderBy('id')->get()->load('partner','user');
        return response()->json(['thai_transfer'=>$thai_transfer]);
    }
    public function transactiontransfertothai(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $thai_transfer=PartnerTransfer::where('status',1)->whereNotNull('thai_list')->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('trancode',1);
        if($request->seelist==1){
            $thai_transfer=$thai_transfer->whereNotNull('thai_sms_id');
        }else if($request->seelist==0){
            $thai_transfer=$thai_transfer->whereNull('thai_sms_id');
        }
        $thai_transfer=$thai_transfer->orderBy('id')->get()->load('partner','user');
        $smsout=SMS::where('status',1)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('amount','<','0')->where('isopen',0)->orderBy('id')->get();
        return response()->json(['thai_transfer'=>$thai_transfer,'smsout'=>$smsout]);
    }

    public function thailist_store(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'selpartner'=>'required',
            'amountlist' => 'required',
            'selcur'=>'required',
            'selcur1'=>'required',
            'cuscharge'=>'required',
            'fee'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->listdate);
        $trandate= date('Y-m-d', strtotime($date));
        $trantime = date("H:i:s",strtotime($current));

        $ptf=new PartnerTransfer();

          $ptf->tranname=$request->tranname;
          $ptf->trancode=$request->trancode;
          $ptf->mekun=$request->mekun;
          $ptf->dd=$trandate;
          $ptf->tt=$trantime;
          $ptf->user_id=Auth::id();
          $ptf->parrent_id=$request->selpartner;
          $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amountlist));
          $ptf->currency_id=$request->selcur;

          $ptf->cuscharge=str_replace(',','',$request->cuscharge);
          $ptf->cuscharge_currency_id=$request->selcur1;
          if($request->cuscharge<>0){
              $ptf->cuscharge_ex=$this->doexchange($request->transfer_cur,$request->cuscharge_cur,str_replace(',','',$request->cuscharge));
          }else{
            $ptf->cuscharge_ex=0;
          }
          $ptf->fee=floatval($request->mekun) *  floatval(str_replace(',','',$request->fee));
          $ptf->fee_currency_id=$request->selcur;
          $ptf->fee_ex=floatval($request->mekun) *  floatval(str_replace(',','',$request->fee));

          $ptf->bonus=0;
          $ptf->interest=0;
          $ptf->sendername=$request->sendername;
          $ptf->sendertel=$request->sendertel;
          $ptf->recname=$request->recname;
          $ptf->rectel=$request->rectel;
          $ptf->location_id=$request->location_id;
          $ptf->note=$request->bankname;
          //$ptf->wingbal=str_replace(',','',$request->balancenext);
          $ptf->created_at=$current;
          $ptf->updated_at=$current;
          $ptf->user_delete=Auth::id();
          $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
          $ptf->action='d';
          $ptf->thai_list=$request->thai_list;
          $ptf->thai_sms_id=$request->smsid;
          if($ptf->save()){
                $trid=$ptf->id;
                DB::connection('mysql_thai')->table('sms')->where('id',$request->smsid)->update(['transfer_id'=>$trid,'isopen'=>1,'opname'=>$request->partner1,'opmethod'=>'partner']);
                return response()->json(['success'=>'true']);
          }else{
                return response()->json(['error'=>'true']);
          }
    }
    public function wingstore(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selpartner'=>'required',
            //'selpartner2' => 'required',
            'amount' => 'required',
            'selcur'=>'required',
            'selcur1'=>'required',
            'cuscharge'=>'required',
            'fee'=>'required',
            'seltranname'=>'required',

            //'amount2'=>'required',
            //'selcur2'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $validator1 = Validator::make($request->all(), []);
        if($request->trancode==-4 || $request->trancode==4){
            $validator1 = Validator::make($request->all(), [
                'selpartner2'=>'required',
                'partnerfee'=>'required',
            ]);
        }
        if($request->trancode==-4 || $request->trancode==4){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));

        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
        if($request->id1>0){
            $ptf=PartnerTransfer::find($request->id1);
        }else{
            $ptf=new PartnerTransfer();
        }
          $ptf->tranname=$request->tranname;
          $ptf->tranname_id=$request->seltranname;
          $ptf->company_id=$selcomid;
          $ptf->trancode=$request->trancode;
          $ptf->dd=$trandate;
          $ptf->mekun=$request->mekun;
          $ptf->tt=$trantime;
          $ptf->user_id=Auth::id();
          $ptf->parrent_id=$request->selpartner;
          //$ptf->from_partner_id=$request->topartner_id;
          $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
          $ptf->currency_id=$request->selcur;
          if($request->trancode==-4 || $request->trancode==4){
            $ptf->cuscharge=0;
          }else{
              $ptf->cuscharge=str_replace(',','',$request->cuscharge);
          }
          $ptf->cuscharge_currency_id=$request->selcur1;
          if($request->cuscharge<>0){
              $ptf->cuscharge_ex=$this->doexchange($request->transfer_cur,$request->cuscharge_cur,str_replace(',','',$request->cuscharge));
          }else{
            $ptf->cuscharge_ex=0;
          }
          $ptf->fee=floatval($request->mekun) *  floatval(str_replace(',','',$request->fee));
          $ptf->fee_currency_id=$request->selcur;
          $ptf->fee_ex=floatval($request->mekun) *  floatval(str_replace(',','',$request->fee));
          if($request->trancode==-1){
              $ptf->iscashdraw=1;
          }
          $ptf->bonus=0;
          $ptf->interest=0;
          $ptf->sendername=$request->sendername;
          $ptf->sendertel=$request->sendertel;
          $ptf->recname=$request->recname;
          $ptf->rectel=$request->rectel;
          $ptf->location_id=$request->location_id;
          //$ptf->note=$request->note;
          $ptf->wingbal=str_replace(',','',$request->balancenext);
          $ptf->created_at=$current;
          $ptf->updated_at=$current;
          $ptf->iscutwater=$request->ck_water;
          $ptf->user_delete=Auth::id();
          $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
          $ptf->action='u,d';
          if($ptf->save()){
              $autocashdraw=0;
              $id1=$ptf->id;
            if($request->trancode==-4 || $request->trancode==4 || $request->userclickcontinue==1){
                if($request->id2>0){
                    $ptf1=PartnerTransfer::find($request->id2);
                }else{
                    $ptf1=new PartnerTransfer();
                }

                $ptf1->ref_number='transfer-'.$id1;
                $ptf1->map_id=$id1;
                $ptf1->ref_group_id='transfer-'.$id1;
                if($request->trancode==-4){
                    $ptf1->tranname='បាញ់ចេញ';
                    $ptf1->trancode=4;
                    $ptf1->mekun=1;

                }else if($request->trancode==4){
                    $ptf1->tranname='បាញ់ចូល';
                    $ptf1->trancode=-4;
                    $ptf1->mekun=-1;

                }else if($request->trancode==-1){
                    $ptf1->tranname='បាញ់ចេញ';
                    $ptf1->trancode=1;
                    $ptf1->mekun=1;

                }else if($request->trancode==1){
                    $ptf1->tranname='បាញ់ចូល';
                    $ptf1->trancode=-1;
                    $ptf1->mekun=-1;
                    $autocashdraw=1;
                }
                if(isset($request->amount_continue) && !empty($request->amount_continue)){
                    $ptf1->amount=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->amount_continue));
                }else{
                     $ptf1->amount=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
                }
                $ptf1->dd=$trandate;
                $ptf1->tt=$trantime1;
                $ptf1->user_id=Auth::id();
                $ptf1->parrent_id=$request->selpartner2;
                $ptf1->from_partner_id=$request->frompartner_id;
                $ptf1->currency_id=$request->selcur;
                $ptf1->company_id=$selcomid;
                $ptf1->cuscharge=0;
                $ptf1->cuscharge_currency_id=$request->selcur;
                if($request->trancode==1 || $request->trancode==-1){
                    $ptf1->fee=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->partnerfee));

                }else{
                    $ptf1->fee=-1 * floatval($request->mekun) * (floatval(str_replace(',','',$request->partnerfee))+floatval(str_replace(',','',$request->cuscharge)));

                }
                $ptf1->fee_currency_id=$request->selcur;
                $ptf1->bonus=0;
                $ptf1->interest=0;
                $ptf1->sendername=$request->sendername;
                $ptf1->sendertel=$request->sendertel;
                $ptf1->recname=$request->recname;
                $ptf1->rectel=$request->rectel;
                //$ptf1->note=$request->note;
                $ptf1->iscutwater=$request->ck_water;
                $ptf1->location_id=$request->location_id;
                $ptf1->created_at=$current;
                $ptf1->updated_at=$current;
                $ptf1->user_delete=Auth::id();
                $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
                $ptf1->action='';
                if($ptf1->save()){
                    $id2=$ptf1->id;
                    DB::table('partner_transfers')->where('id',$id1)->update(['ref_number'=>'transfer-'.$id2,'map_id'=>$id2,'ref_group_id'=>'transfer-'.$id1,'note'=>$request->partner2]);
                    if($autocashdraw==1){//ភ្ញៀវបង់វិក័យប័ត្រ អោយតាមធនាគា

                        $cashdraw=new Cashdraw();
                        $cashdraw->company_id=$selcomid;
                        $cashdraw->from_partner_id=$request->selpartner2;
                        $cashdraw->transfer_id=$id2;
                        $cashdraw->opdate=$trandate;
                        $cashdraw->optime=$trantime1;
                        $cashdraw->user_id=Auth::id();
                        if(isset($request->amount_continue) && !empty($request->amount_continue)){
                            $cashdraw->amount=str_replace(',','',$request->amount_continue);
                        }else{
                            $cashdraw->amount=str_replace(',','',$request->amount);
                        }
                        $cashdraw->currency_id=$request->selcur;
                        $cashdraw->customer_charge=0;
                        $cashdraw->cuscharge_currency_id=$request->selcur;
                        $cashdraw->paymethod='Cash';
                        $cashdraw->receive_tel=str_replace(' ','',$request->rectel);
                        $cashdraw->receive_name=$request->recname;
                        $cashdraw->note='វេរឬបង់វិក័យបត្រ ទូទាត់តាមធនាគា';
                        $cashdraw->other='';
                        $cashdraw->ref_number='transfer-' . $id1;
                        $cashdraw->ref_group_id='transfer-' . $id1;
                        $cashdraw->action='';
                        $cashdraw->created_at=$current;
                        $cashdraw->updated_at=$current;
                        if($cashdraw->save()){
                            //$found_group='';
                            $cashdraw_id=$cashdraw->id;
                            DB::table('partner_transfers')->where('id',$id2)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'action'=>'']);
                            //DB::table('cashdraws')->where('id',$cashdraw_id)->update(['ref_group_id'=>'transfer-' . $id1]);
                        }

                    }
                }

            }
            // $numrecord=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->count();
            // $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //   ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //   ->whereDate('dd',$trandate)
            //   ->where('customers.customertype','PARTNER')->count();
            // $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //   ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //   ->whereDate('dd',$trandate)
            //   ->where('customers.customertype','BANK')->count();
              $data=PartnerTransfer::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->orderBy('id')->get()->load('user','partner','currency','cuschargecur','feecurrency');
              //return response()->json(['success'=>'true','id'=>$id1,'message'=>'transfer has been saved.','numrecord'=>$numrecord,'partner_records'=>$partner_records,'bank_records'=>$bank_records,'transfers'=>$data]);
              return response()->json(['success'=>'true','id'=>$id1,'message'=>'transfer has been saved.','transfers'=>$data]);

            }
    }
    public function exchangetousd($curid,$amt)
    {

        $c=Currency::find($curid);
        if($c){
            if($c->shortcut=='USD'){
                return $amt;
            }else{
                $r=$c->buy;
                $s=$c->optsign;
                if($s=='/'){
                    $examt=$amt / $r;
                }else{
                    $examt=$amt * $r;
                }
                return $examt;
            }
        }else{
            return 0;
        }
    }
    public function doexchange($curtransfer,$curcuschargeorfee,$amt)
    {

        $examt=0;
        $r=0;
        $s='';
        if($curtransfer=='USD'){
            $c=Currency::where('shortcut',$curcuschargeorfee)->first();
            if($c){
                $r=$c->buy;
                $s=$c->optsign;
                if($s=='/'){
                    $examt=$amt / $r;
                }else{
                    $examt=$amt * $r;
                }
            }
        }else if($curcuschargeorfee=='USD'){
            $c=Currency::where('shortcut',$curtransfer)->first();
            if($c){
                $r=$c->sale;
                $s=$c->optsign;
                if($s=='/'){
                    $examt=$amt * $r;
                }else{
                    $examt=$amt / $r;
                }
            }
        }else{
            if($curcuschargeorfee<>$curtransfer){
                $cur12=$curcuschargeorfee . '-' . $curtransfer;
                $c=ProductRate::where('pshortcut',$cur12)->first();
                if($c){
                    $r=$c->rate;
                    $s=$c->operator;
                    if($s=='/'){
                        $examt=$amt / $r;
                    }else{
                        $examt=$amt * $r;
                    }
                }else{
                    $examt=$amt;
                }
            }else{
                $examt=$amt;
            }
        }



        return $examt;
    }
    public function bankstore(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selpartner'=>'required',
            'selpartner2' => 'required',
            'amount' => 'required',
            'selcur'=>'required',
            'amount2'=>'required',
            'selcur2'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));

        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));

        $ptf=new PartnerTransfer();
            $ptf->tranname='Transfer'; //. $request->partner1;
            $ptf->trancode=4;
            $ptf->dd=$trandate;
            $ptf->mekun=1;
            $ptf->tt=$trantime;
            $ptf->user_id=Auth::id();
            $ptf->parrent_id=$request->selpartner;
            $ptf->from_partner_id=$request->topartner_id;
            $ptf->amount=floatval(str_replace(',','',$request->amount));
            $ptf->currency_id=$request->selcur;
            $ptf->cuscharge=0;
            $ptf->cuscharge_currency_id=$request->selcur;
            $ptf->fee=0;
            $ptf->fee_currency_id=$request->selcur;
            $ptf->bonus=0;
            $ptf->interest=0;
            $ptf->sendername=$request->sendername;
            $ptf->sendertel='';
            $ptf->recname=$request->recname;
            $ptf->rectel='';
            $ptf->note=$request->note;
            $ptf->location_id=2;
            $ptf->created_at=$current;
            $ptf->updated_at=$current;
            $ptf->user_delete=Auth::id();
            $ptf->company_id=$selcomid;
            $ptf->action='';
            $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
        if($ptf->save()){
            $id1=$ptf->id;
            $ptf1=new PartnerTransfer();
            $ptf1->ref_number='transfer-'.$id1;
            $ptf1->map_id=$id1;
            $ptf1->ref_group_id='transfer-'.$id1;
            $ptf1->tranname='Receive'; //. $request->partner1;
            $ptf1->trancode=-4;
            $ptf1->dd=$trandate;
            $ptf1->mekun=-1;
            $ptf1->tt=$trantime1;
            $ptf1->user_id=Auth::id();
            $ptf1->parrent_id=$request->selpartner2;
            $ptf1->from_partner_id=$request->frompartner_id;
            $ptf1->amount=-1 * floatval(str_replace(',','',$request->amount2));
            $ptf1->currency_id=$request->selcur2;
            $ptf1->cuscharge=0;
            $ptf1->cuscharge_currency_id=$request->selcur2;
            $ptf1->fee=0;
            $ptf1->fee_currency_id=$request->selcur2;
            $ptf1->bonus=0;
            $ptf1->interest=0;
            $ptf1->sendername=$request->sendername;
            $ptf1->sendertel='';
            $ptf1->recname=$request->recname;
            $ptf1->rectel='';
            $ptf1->note=$request->note;
            $ptf1->location_id=2;
            $ptf1->created_at=$current;
            $ptf1->updated_at=$current;
            $ptf1->user_delete=Auth::id();
            $ptf1->company_id=$selcomid;
            $ptf1->action='u,d';
            $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
            if($ptf1->save()){
                $id2=$ptf1->id;
                DB::table('partner_transfers')->where('id',$id1)->update(['ref_number'=>'transfer-'.$id2,'map_id'=>$id2,'ref_group_id'=>'transfer-'.$id1]);
            }
            $numrecord=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->count();
            $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
              ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
              ->whereDate('dd',$trandate)
              ->where('customers.customertype','PARTNER')->count();
            $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
              ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
              ->whereDate('dd',$trandate)
              ->where('customers.customertype','BANK')->count();
              $data=PartnerTransfer::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->where('location_id',2)->orderBy('id')->get()->load('user','partner','currency','cuschargecur','feecurrency');
              return response()->json(['success'=>'true','id'=>$id1,'message'=>'transfer has been saved.','numrecord'=>$numrecord,'partner_records'=>$partner_records,'bank_records'=>$bank_records,'transfers'=>$data]);
          }
    }
    public function customeredit(Request $request)
    {
        $transfers=PartnerTransfer::find($request->id);
        if($transfers){
            return response()->json(['success'=>true,'transfers'=>$transfers]);

        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function customerdelete(Request $request)
    {
        if($request->id2<>''){
            $del2=PartnerTransfer::where('id',$request->id2)->update(['status'=>0,'user_delete'=>Auth::id()]);
            if($del2){
                $del1=PartnerTransfer::where('id',$request->id1)->update(['status'=>0,'user_delete'=>Auth::id()]);
                if($del1){
                    return response()->json(['success'=>true]);
                }
            }
        }else{
            $del1=PartnerTransfer::where('id',$request->id1)->update(['status'=>0,'user_delete'=>Auth::id()]);
            if($del1){
                DB::table('cashdraws')->where('transfer_id',$request->id1)->update(['status'=>0,'delby'=>Auth::user()->name]);
                return response()->json(['success'=>true]);
            }
        }
    }
    public function customerstore(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selpartner'=>'required',
            'amount' => 'required',
            'selcur'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->trancode_change==4 || $request->trancode_change==-4){
            $validator1 = Validator::make($request->all(), [
                'selpartner2'=>'required',
            ]);
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));

        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
        if($request->id1==''){
            $ptf=new PartnerTransfer();
            $ptf->dd=$trandate;
            $ptf->tt=$trantime;
            $ptf->created_at=$current;
            $ptf->user_id=Auth::id();
        }else{
            $ptf=PartnerTransfer::find($request->id1);
        }
            $ptf->company_id=$selcomid;
            $ptf->tranname=$request->tranname; //. $request->partner1;
            $ptf->trancode=$request->trancode_change;
            $ptf->mekun=$request->mekun;
            $ptf->parrent_id=$request->selpartner;
            $ptf->from_partner_id=$request->selpartner2;
            $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
            $ptf->currency_id=$request->selcur;
            $ptf->cuscharge=0;
            $ptf->cuscharge_currency_id=$request->selcur;
            $ptf->fee=0;
            $ptf->fee_currency_id=$request->selcur;
            $ptf->bonus=0;
            $ptf->interest=0;
          if($request->trancode_change==4){
            $ptf->sendername=$request->customer;
            $ptf->recname=$request->bank;
          }else if($request->trancode_change==-4){
            $ptf->sendername=$request->bank;
            $ptf->recname=$request->customer;
          }else{
            $ptf->user_id=$request->seluseraffect;
          }
          $ptf->sentby=Auth::user()->name;
          $ptf->location_id=4;
          $ptf->sendertel='';
          $ptf->rectel='';
          $ptf->note=$request->note;
          $ptf->updated_at=$current;
          $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
          //$ptf->user_delete=Auth::id();
          $ptf->action='u,d';
          if($ptf->save()){
            if($request->id1==''){
                $id1=$ptf->id;
            }else{
                $id1=$request->id1;
            }
            if($request->trancode_change==4 || $request->trancode_change==-4){
                if($request->cashdrawid){//ករណីកែពីបើកវេរតាមCash មកជា ធនាគាវិញ។
                    DB::table('cashdraws')->where('id',$request->cashdrawid)->update(['status'=>0,'delby'=>Auth::user()->name,'updated_at'=>$current]);
                }
                if($request->id2==''){
                    $ptf1=new PartnerTransfer();
                    $ptf1->ref_number='transfer-'.$id1;
                    $ptf1->map_id=$id1;
                    $ptf1->ref_group_id='transfer-'.$id1;

                    $ptf1->dd=$trandate;
                    $ptf1->tt=$trantime1;
                    $ptf1->user_id=Auth::id();
                    $ptf1->created_at=$current;

                }else{
                    $ptf1=PartnerTransfer::find($request->id2);
                }
                $ptf1->company_id=$selcomid;
                $ptf1->tranname=$request->tranname1; //. $request->partner1;
                $ptf1->trancode=-1 * $request->trancode_change;
                $ptf1->mekun=-1 * $request->mekun;
                $ptf1->parrent_id=$request->selpartner2;
                $ptf1->from_partner_id=$request->selpartner;
                $ptf1->amount=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
                $ptf1->currency_id=$request->selcur;
                $ptf1->cuscharge=0;
                $ptf1->cuscharge_currency_id=$request->selcur;
                $ptf1->fee=0;
                $ptf1->fee_currency_id=$request->selcur;
                $ptf1->bonus=0;
                $ptf1->interest=0;
                $ptf1->location_id=4;
                if($request->trancode_change==4){
                    $ptf1->sendername=$request->customer;
                    $ptf1->recname=$request->bank;
                  }else if($request->trancode_change==-4){
                    $ptf1->sendername=$request->bank;
                    $ptf1->recname=$request->customer;
                  }
                $ptf1->sendertel='';
                $ptf1->rectel='';
                $ptf1->note=$request->note;
                $ptf1->updated_at=$current;
                $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
                //$ptf1->user_delete=Auth::id();
                $ptf1->action='';
                if($ptf1->save()){

                    $id2=$ptf1->id;
                    DB::table('partner_transfers')->where('id',$id1)->update(['ref_number'=>'transfer-'.$id2,'map_id'=>$id2,'ref_group_id'=>'transfer-'.$id1,'cashdraw_id'=>null,'iscashdraw'=>null]);

                }
            }else if($request->trancode_change==-1){
                if($request->id2){//prevent user update from bank to cash
                    DB::table('partner_transfers')->where('id',$request->id2)->update(['status'=>0,'user_delete'=>Auth::id(),'updated_at'=>$current]);
                }
                if($request->cashdrawid==''){
                    $cashdraw=new Cashdraw();
                    $cashdraw->opdate=$trandate;
                    $cashdraw->optime=$trantime;
                    $cashdraw->user_id=$request->seluseraffect;
                    $cashdraw->created_at=$current;
                }else{
                    $cashdraw=Cashdraw::find($request->cashdrawid);
                }
                    $cashdraw->from_partner_id=$request->selpartner;
                    $cashdraw->transfer_id=$id1;
                    $cashdraw->updated_at=$current;
                    $cashdraw->amount=str_replace(',','',$request->amount);
                    $cashdraw->currency_id=$request->selcur;
                    $cashdraw->customer_charge=0;
                    $cashdraw->cuscharge_currency_id=$request->selcur;
                    $cashdraw->paymethod='Cash';
                    $cashdraw->receive_tel='';
                    $cashdraw->receive_name='';
                    $cashdraw->note=$request->note;
                    //$cashdraw->other=$other;
                    $cashdraw->ref_number='transfer-'.$id1;
                    $cashdraw->ref_group_id='transfer-'.$id1;
                    $cashdraw->company_id=$selcomid;
                    $cashdraw->action='d';
                    if($cashdraw->save()){
                        $found_group='';
                        $cashdraw_id=$cashdraw->id;
                        $userprint=Auth::user()->name;
                        DB::table('partner_transfers')->where('id',$id1)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_number'=>'cashdraw-'.$cashdraw_id,'map_id'=>null,'ref_group_id'=>null]);
                    }

            }
            // $numrecord=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->count();
            // $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //   ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //   ->whereDate('dd',$trandate)
            //   ->where('customers.customertype','PARTNER')->count();
            // $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //   ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //   ->whereDate('dd',$trandate)
            //   ->where('customers.customertype','BANK')->count();
              $data=PartnerTransfer::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->orderBy('id')->get()->load('user','partner','currency','cuschargecur','feecurrency');
              return response()->json(['success'=>'true','id'=>$id1,'message'=>'transfer has been saved.','transfers'=>$data]);
          }
    }
    public function store(Request $request)
    {
        //return $request->all();
        $hasmultitransfer=$request->hasmultitransfer;
        $groupid='';
        $validator = Validator::make($request->all(), []);
        $validator1 = Validator::make($request->all(), []);
        $validator2 = Validator::make($request->all(), []);
        $validator3 = Validator::make($request->all(), []);
        $validator4 = Validator::make($request->all(), []);
        $validator5 = Validator::make($request->all(), []);
        if($hasmultitransfer==0){
          $validator = Validator::make($request->all(), [
              'tranname'=>'required',
              'selpartner' => 'required',
              'amount' => 'required',
              'selcur'=>'required',
              'txtcur1'=>'required',
              'fee'=>'required',
          ]);
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
        if($request->hasbankpayment=='1'){
            $validator3 = Validator::make($request->all(), [
                'bankname.*' => 'required', //input array validate
                'bankamt.*' => 'required', //input array validate
                'bankcur.*' => 'required', //input array validate
                'bankcuscharge.*' => 'required', //input array validate
                'bankpartnerfee.*' => 'required', //input array validate

            ]);
        }
        if($hasmultitransfer==0){
          if($request->trancode1=='-4' || $request->foundcontinue==1){
              $validator4 = Validator::make($request->all(), [
                  'amountcontinue'=>'required',
                  'selpartner2' => 'required', //input array validate
                  'fee2' => 'required', //input array validate
                  'txtcur2'=>'required',
                  'selcurcontinue'=>'required'
              ]);
          }
          if($request->trancode1=='3'){
              $validator5 = Validator::make($request->all(), [
                  'selcustomer' => 'required', //input array validate
              ]);
          }
        }
        if($hasmultitransfer==0){
          if ($validator->fails()) {
              return response()->json(['error'=>$validator->errors()->all()]);
          }
          if($request->trancode1==-4){
            if ($validator4->fails()) {
                return response()->json(['error'=>$validator4->errors()->all()]);
            }
          }
          if($request->trancode1==3){
              if ($validator5->fails()) {
                  return response()->json(['error'=>$validator5->errors()->all()]);
              }
          }
        }
        if($request->hasexchange==1){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        if($request->hasexchange==2){
            if ($validator2->fails()) {
                return response()->json(['error'=>$validator2->errors()->all()]);
            }
        }
        if($request->hasbankpayment==1){
            if ($validator3->fails()) {
                return response()->json(['error'=>$validator3->errors()->all()]);
            }
        }
        if ($request->has('id1') && $request->input('id1') > 0) {
            $this->storeupdated($request->id1,0,1);
        }
        if(isset($request->ref_group_id)){
          $groupid=$request->ref_group_id;
          DB::table('exchanges')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->delete();
          if($request->hasexchange<=1){
              DB::table('exchange_multis')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->delete();
          }else{
              DB::table('exchange_multis')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->where('status',0)->delete();
          }
          if($hasmultitransfer==1){
            DB::table('partner_transfers')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->delete();
          }else{
              DB::table('partner_transfers')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->where('id','<>',$request->id1)->where('id','<>',$request->id2)->delete();
          }
          DB::table('cashdraws')->where('ref_group_id',$groupid)->whereNotNull('ref_group_id')->delete();
          //return 'found ref group id';
        }elseif(isset($request->update_transfer_id)){
          //DB::table('partner_transfers')->where('id',$request->update_transfer_id)->delete();
          //return 'delete transfer id';
        }
        $usersave=Auth::id();
        $transferto='';
        $cashdraw_id='';
        //save transactions
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if(isset($request->invtime)){
          $trantime = $request->invtime;
          $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
          $trantime2=date('H:i:s',strtotime($trantime . ' +2 seconds'));

        }else{
          $trantime = date("H:i:s",strtotime($current));
          $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
          $trantime2=date('H:i:s',strtotime($trantime . ' +2 seconds'));
        }
        if(isset($request->usersaved)){
          $usersave=$request->usersaved;
        }
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $dbl_amount=floatval(str_replace(',','',$request->amount));
        if($hasmultitransfer==1){
            $getid= $this->storemulti($request,$trandate,$trantime,$trantime1,$trantime2,$current,$usersave);
            DB::table('partner_transfer_temps')->where('user_id',Auth::id())->delete();
        //   $numrecord=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->count();
        //   $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //     ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //     ->whereDate('dd',$trandate)
        //     ->where('customers.customertype','PARTNER')->count();
        //   $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
        //     ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
        //     ->whereDate('dd',$trandate)
        //     ->where('customers.customertype','BANK')->count();
        //   $data=PartnerTransfer::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->orderBy('id')->get()->load('user','partner','currency','cuschargecur','feecurrency');
          //return response()->json(['success'=>'true','id'=>$getid[0],'message'=>'transfer has been saved.','numrecord'=>$numrecord,'partner_records'=>$partner_records,'bank_records'=>$bank_records,'cashdraw_id'=>'cashdraw-'.$getid[1],'transfers'=>$data]);
          return response()->json(['success'=>'true','id'=>$getid[0],'group_id'=>$getid[2],'message'=>'transfer has been saved.','cashdraw_id'=>$getid[2]]);

        }else{
            if ($request->has('id1') && $request->input('id1') > 0) {
                //$this->storeupdated($request->id1,0,1);
                $ptf = PartnerTransfer::find($request->input('id1')) ?? new PartnerTransfer();
            } else {
                $ptf = new PartnerTransfer();
            }
            $selcomid=Session('log_into_company_id');
            $ptf->company_id=$selcomid;
            $ptf->tranname=$request->tranname; //. $request->partner1;
            $ptf->trancode=$request->trancode1;
            $ptf->dd=$trandate;
            $ptf->mekun=$request->mekun;
            $ptf->tt=$trantime;
            $ptf->user_id=$usersave;
            $ptf->parrent_id=$request->selpartner;
            $ptf->child=$request->son;
            $ptf->child_id=$request->child_id;
            if($request->trancode1==3){
                $ptf->customer_id=$request->selcustomer;
            }
            $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
            $ptf->currency_id=$request->selcur;
            if($request->mekun==1){
                //   if($request->trancode1==3){
                //     $ptf->cuscharge=0;
                //   }else{
                //       $ptf->cuscharge=str_replace(',','',$request->cuscharge);
                //   }
                $ptf->cuscharge=str_replace(',','',$request->cuscharge);
                $ptf->cuscharge_currency_id=$request->selcur1;
                if($request->selcur<>$request->selcur1){
                    $ptf->cuscharge_ex=$this->doexchange($request->cur_transfer,$request->cur_cuscharge,str_replace(',','',$request->cuscharge));
                }else{
                    $ptf->cuscharge_ex=str_replace(',','',$request->cuscharge);
                }
                $ptf->iscutwater=$request->ck_water;
            }else{
                $ptf->cuscharge=0;
                $ptf->cuscharge_currency_id=$request->selcur;
            }
            $ptf->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee));
            $ptf->fee_currency_id=$request->txtcur1;
            if($request->selcur<>$request->txtcur1){
                $ptf->fee_ex=floatval($request->mekun) * $this->doexchange($request->cur_transfer,$request->cur_fee,str_replace(',','',$request->fee));
            }else{
                $ptf->fee_ex=floatval($request->mekun) * floatval(str_replace(',','',$request->fee));
            }
            $ptf->bonus=0;
            $ptf->interest=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->interest1));
            if($request->location_id==-1){
                $ptf->sendername=$request->g_sender . ' ' . $request->sendername;
                $ptf->recname=$request->g_receive . ' ' . $request->recname;
            }else{
                $ptf->sendername=$request->sendername;
                $ptf->recname=$request->recname;
            }
            $ptf->sendertel=str_replace(' ','',$request->sendertel);
            $ptf->rectel=str_replace(' ','',$request->rectel);
            $ptf->note=$request->note;

            if ($request->thai_list_partner === null || $request->thai_list_partner === '' || $request->thai_list_partner === 'null') {
                $ptf->thai_list = null;
            } else {
                $ptf->thai_list = $request->thai_list_partner;
            }


          if($request->customertype=='AGENT' || $request->customertype=='BANK'){
                $ptf->isbank=1;
                $ptf->user_affect=$this->getuseraffectbank($request->selpartner);
          }
          // if($request->trancode1==-1){
          //     if($request->customertype=='BANK' || $dbl_amount==0){
          //         $ptf->iscashdraw=1;
          //     }
          // }
            if($request->trancode1==-1){
                if($dbl_amount==0){
                    $ptf->iscashdraw=1;
                }
            }
          $ptf->location_id=$request->location_id;
          $ptf->from_partner_id=$request->partnerid2;
          $ptf->created_at=$current;
          $ptf->updated_at=$current;
          $ptf->user_delete=Auth::id();
          $ptf->action='u,d';
          if($ptf->save()){
              $id=$ptf->id;
              $pid=$ptf->parrent_id;
              $refnum='transfer-'.$id;
              $partner_name=$ptf->partner->name;
              $transferto=$ptf->partner->name;
              if($request->trancode1==-1){
                //if($request->customertype=='AGENT' || $request->customertype=='CUSTOMER' || ($request->customertype=='BANK' && $request->hasexchange>0) ){//wing true money cashdraw
                  if($request->autocashdraw==1){
                    if($dbl_amount<>0){
                      $cashdraw=new Cashdraw();
                      $cashdraw->company_id=$selcomid;
                      $cashdraw->from_partner_id=$pid;
                      $cashdraw->transfer_id=$id;
                      $cashdraw->opdate=$trandate;
                      $cashdraw->optime=$trantime;
                      $cashdraw->user_id=$usersave;
                      $cashdraw->amount=str_replace(',','',$request->amount);
                      $cashdraw->currency_id=$request->selcur;
                      $cashdraw->customer_charge=str_replace(',','',$request->cuscharge);
                      $cashdraw->cuscharge_currency_id=str_replace(',','',$request->selcur1);
                      $cashdraw->paymethod='Cash';
                      $cashdraw->receive_tel=str_replace(' ','',$request->rectel);
                      $cashdraw->receive_name=$request->recname;
                      $cashdraw->note=$partner_name;
                      $cashdraw->other=$partner_name;
                      $cashdraw->ref_number='transfer-' . $id;
                      //$cashdraw->ref_group_id=$refnum;
                      $cashdraw->action='';
                      $cashdraw->created_at=$current;
                      $cashdraw->updated_at=$current;
                      if($cashdraw->save()){
                          //$found_group='';
                            $cashdraw_id=$cashdraw->id;
                            DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_number'=>'cashdraw-'.$cashdraw_id,'ref_group_id'=>'cashdraw-'.$cashdraw_id,'action'=>'']);
                            DB::table('cashdraws')->where('id',$cashdraw_id)->update(['ref_group_id'=>'cashdraw-' . $cashdraw_id]);
                        }
                    }
                    if($request->foundcontinue==1){//this case not found in transaction
                      $this->savecontinue($request,$trandate,$trantime2,$usersave,$id,$partner_name,$refnum,$current,$cashdraw_id);
                    }
                  }
                //}
              }else{
                  if(isset($request->foundcontinue) && $request->foundcontinue==1 && $request->trancode1==-4){
                    $this->savecontinue($request,$trandate,$trantime,$usersave,$id,$partner_name,$refnum,$current,'');
                  }
              }
              if($request->trancode1==3){
                if ($request->has('id2') && $request->input('id2') > 0) {
                    $this->storeupdated(0,$request->id2,1);
                    $ptf1 = PartnerTransfer::find($request->input('id2')) ?? new PartnerTransfer();
                } else {
                    $ptf1 = new PartnerTransfer();
                }

                  $ptf1->tranname='វេរជំពាក់';
                  $ptf1->mekun=$request->mekun * -1;
                  $ptf1->trancode=-1 * $request->trancode1;
                  $ptf1->dd=$trandate;
                  $ptf1->tt=$trantime;
                  $ptf1->user_id=$usersave;
                  $ptf1->parrent_id=$request->selcustomer;
                  $ptf1->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount)) * -1;
                  $ptf1->currency_id=$request->selcur;
                  //$ptf1->cuscharge=str_replace(',','',$request->cuscharge);
                  $ptf1->cuscharge='0';
                  $ptf1->cuscharge_currency_id=$request->selcur1;
                  $ptf1->cuscharge_ex=0;
                //   $ptf1->cuscharge=str_replace(',','',$request->cuscharge);
                //   $ptf1->cuscharge_currency_id=$request->selcur1;
                //   if($request->selcur<>$request->selcur1){
                //     $ptf1->cuscharge_ex=$this->doexchange($request->cur_transfer,$request->cur_cuscharge,str_replace(',','',$request->cuscharge));
                //   }else{
                //     $ptf1->cuscharge_ex=str_replace(',','',$request->cuscharge);
                //   }
                  $ptf1->fee=-1 * floatval(str_replace(',','',$request->cuscharge));
                  $ptf1->fee_currency_id=$request->selcur1;
                  if($request->selcur<>$request->selcur1){
                    $ptf1->fee_ex=-1 * $this->doexchange($request->cur_transfer,$request->cur_cuscharge,str_replace(',','',$request->cuscharge));
                  }else{
                    $ptf1->fee_ex=-1 * floatval(str_replace(',','',$request->cuscharge));
                  }
                  $ptf1->bonus=0;
                  $ptf1->sendername=$request->sendername;
                  $ptf1->sendertel=str_replace(' ','',$request->sendertel);
                  $ptf1->recname=$request->recname;
                  $ptf1->rectel=str_replace(' ','',$request->rectel);
                  $ptf1->note=$partner_name;
                  $ptf1->ref_number=$refnum;
                  $ptf1->ref_group_id=$refnum;
                  $ptf1->created_at=$current;
                  $ptf1->updated_at=$current;
                  $ptf1->location_id=$request->location_id;
                  $ptf1->map_id=$id;
                  $ptf1->thai_list=$request->thai_list_customer;
                  if($request->customertype1=='AGENT' || $request->customertype1=='BANK'){
                      $ptf1->user_affect=$this->getuseraffectbank($request->selcustomer);;
                  }
                  if($ptf1->save()){
                      $id1=$ptf1->id;
                      $refnum1='transfer-'.$id1;
                      $partner_name1=$ptf1->partner->name;
                      DB::table('partner_transfers')->where('id',$id)->update(['map_id'=>$id1,'note'=>$partner_name1,'ref_number'=>$refnum1,'ref_group_id'=>$refnum]);
                  }
              }
              if($request->autocashdraw==1){
                if($request->hasexchange==1){
                        if(is_null($request->maincur)){
                            $this->saveexchangeproduct($request,$trandate,$trantime1,'cashdraw-' . $cashdraw_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                        }else{
                            $this->saveexchange($request,$trandate,$trantime1,'cashdraw-' . $cashdraw_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                        }
                }else if($request->hasexchange==2){
                    $this->savemultiexchanges($request,$trandate,$trantime1,'cashdraw-' . $cashdraw_id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                    if(isset($request->ref_group_id)){//user update groupid so change ref_group_id to this exchange record
                        DB::table('exchange_multis')->where('ref_group_id',$groupid)->update(['ref_group_id'=>'cashdraw-'. $cashdraw_id]);
                    }
                }
              }else{
                if($request->hasexchange==1){
                    if(is_null($request->maincur)){
                        $this->saveexchangeproduct($request,$trandate,$trantime1,'transfer-' . $id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                    }else{
                        $this->saveexchange($request,$trandate,$trantime1,'transfer-' . $id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                        }
                }else if($request->hasexchange==2){
                    $this->savemultiexchanges($request,$trandate,$trantime1,'transfer-' . $id,'ផ្ទេរប្រាក់ដូរលុយ',$current,$usersave);
                    if(isset($request->ref_group_id)){//user update groupid so change ref_group_id to this exchange record
                        DB::table('exchange_multis')->where('ref_group_id',$groupid)->update(['ref_group_id'=>'transfer-'. $id]);
                    }
                }
              }


              if($request->hasbankpayment==1){
                    $foundcashdraw=0;
                  // $this->cashoutusertobank($request,$trandate,$trantime,'transfer-' . $id);
                  if($request->trancode1==-1){
                    if($request->autocashdraw==1){
                        $foundcashdraw=1;
                    }
                  }
                  if($foundcashdraw==1){
                    $this->customerpaytransferbybank($request,$trandate,$trantime2,'cashdraw-' . $cashdraw_id,$transferto,$id,$current,$pid,$usersave);
                  }else{
                    $this->customerpaytransferbybank($request,$trandate,$trantime1,'transfer-' . $id,$transferto,$id,$current,$pid,$usersave);
                  }
              }
              if($request->autocashdraw==0){
                  if($request->hasexchange>0 || $request->hasbankpayment==1){
                    DB::table('partner_transfers')->where('id',$id)->update(['action'=>'u','ref_group_id'=>$refnum]);
                  }
              }


            //   $numrecord=PartnerTransfer::where('status',1)->where('user_id',Auth::id())->count();
            //   $partner_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //     ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //     ->whereDate('dd',$trandate)
            //     ->where('customers.customertype','PARTNER')->count();
            //   $bank_records=PartnerTransfer::join('customers','partner_transfers.parrent_id','=','customers.id')
            //     ->where('partner_transfers.status',1)->where('partner_transfers.user_id',Auth::id())
            //     ->whereDate('dd',$trandate)
            //     ->where('customers.customertype','BANK')->count();
              //$data=PartnerTransfer::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->orderBy('id')->get()->load('user','partner','currency','cuschargecur','feecurrency');
              //return response()->json(['success'=>'true','id'=>$id,'message'=>'transfer has been saved.','numrecord'=>$numrecord,'partner_records'=>$partner_records,'bank_records'=>$bank_records,'cashdraw_id'=>'cashdraw-'.$cashdraw_id,'transfers'=>$data]);
              return response()->json(['success'=>'true','id'=>$id,'message'=>'transfer has been saved.','cashdraw_id'=>'cashdraw-'.$cashdraw_id]);

            }
        }
    }
   public function checkisbank($cid)
    {
        $customertype = Customer::where('id', $cid)->value('customertype');
        // → directly gets the column value

        if ($customertype === 'BANK' || $customertype === 'AGENT') {
            return 1;
        } else {
            return 0;
        }
    }
    public function getuseraffectbank($cid){
        $usercapital=UserCapital::where('agent_id',$cid)->where('trancode',2)->where('status',1)->orderBy('id','DESC')->first();
        if($usercapital){
            return $usercapital->user_id_affect;
        }else{
            $customer=Customer::where('id',$cid)->first();
            $userconnect1=explode(',',$customer->user_connect)[0];
            if($userconnect1==''){
                return null;
            }
            return $userconnect1;
        }
    }
    public function savecontinuemulti(Request $request,$trandate,$trantime,$usersave,$id,$partner_name,$refnum,$current,$cashdraw_id)
    {
        if ($request->has('id2') && $request->input('id2') > 0) {
            $this->storeupdated(0,$request->id2,1);
            $ptf1 = PartnerTransfer::find($request->input('id2')) ?? new PartnerTransfer();
        } else {
            $ptf1 = new PartnerTransfer();
        }
        $ptf1->company_id=Session('log_into_company_id');
        $ptf1->tranname='បន្ត';//.$request->partner2;
        $ptf1->trancode=$request->trancode2;
        $ptf1->mekun=floatval($request->mekun) * -1;
        $ptf1->dd=$trandate;
        $ptf1->tt=$trantime;
        $ptf1->user_id=$usersave;
        $ptf1->parrent_id=$request->selpartner2;
        $ptf1->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amountcontinue)) * -1;
        $ptf1->currency_id=$request->selcurcontinue;
        $ptf1->cuscharge=str_replace(',','',$request->cuscharge2);
        $ptf1->cuscharge_currency_id=$request->selcuschargecontinuecur;
        $ptf1->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee2)) * -1;
        $ptf1->interest= floatval($request->mekun) * floatval(str_replace(',','',$request->interest2));
        $ptf1->fee_currency_id=$request->txtcur2;
        if($request->selcurcontinue<>$request->txtcur2){
        $ptf1->fee_ex=-1 * floatval($request->mekun) * $this->doexchange($request->cur_transfer_continue,$request->cur_fee_continue,str_replace(',','',$request->fee2));
        }else{
        $ptf1->fee_ex=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->fee2));
        }
        $ptf1->bonus=0;
        $ptf1->sendername=$request->sendername;
        $ptf1->sendertel=str_replace(' ','',$request->sendertel);
        $ptf1->recname=$request->recname;
        $ptf1->rectel=str_replace(' ','',$request->rectel);

        $ptf1->note=$partner_name;
        $ptf1->ref_number=$refnum;
        $ptf1->ref_group_id=$refnum;

        //$ptf1->thai_list=$request->thai_list_continue;
        //$ptf1->from_partner_id=$request->partnerid1;
        $ptf1->created_at=$current;
        $ptf1->updated_at=$current;
        $ptf1->location_id=$request->location_id;
        if($request->customertype2=='AGENT' || $request->customertype2=='BANK'){
            $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
        }
        if($ptf1->save()){
            // $id1=$ptf1->id;
            // $refnum1='transfer-'.$id1;
            // $partner_name1=$ptf1->partner->name;
            // if($cashdraw_id==''){
            //     DB::table('partner_transfers')->where('id',$id)->update(['map_id'=>$id1,'note'=>$partner_name1,'ref_number'=>$refnum1,'ref_group_id'=>$refnum]);
            // }

        }
    }
    public function savecontinue(Request $request,$trandate,$trantime,$usersave,$id,$partner_name,$refnum,$current,$cashdraw_id)
    {

        if ($request->has('id2') && $request->input('id2') > 0) {
            $this->storeupdated(0,$request->id2,1);
            $ptf1 = PartnerTransfer::find($request->input('id2')) ?? new PartnerTransfer();
        } else {
            $ptf1 = new PartnerTransfer();
        }

        $ptf1->company_id=Session('log_into_company_id');
        $ptf1->tranname='បន្ត';//.$request->partner2;
        $ptf1->trancode=$request->trancode2;
        $ptf1->mekun=floatval($request->mekun) * -1;
        $ptf1->dd=$trandate;
        $ptf1->tt=$trantime;
        $ptf1->user_id=$usersave;
        $ptf1->parrent_id=$request->selpartner2;
        $ptf1->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amountcontinue)) * -1;
        $ptf1->currency_id=$request->selcurcontinue;
        $ptf1->iscutwater=$request->ck_water2;
        $ptf1->cuscharge=str_replace(',','',$request->cuscharge2);
        $ptf1->cuscharge_currency_id=$request->selcuschargecontinuecur;

        if($request->selcurcontinue<>$request->selcuschargecontinuecur){
            $ptf1->cuscharge_ex=$this->doexchange($request->cur_transfer_continue,$request->cur_cuscharge_continue,str_replace(',','',$request->cuscharge2));
        }else{
        $ptf1->cuscharge_ex=floatval(str_replace(',','',$request->cuscharge2));
        }

        $ptf1->fee=floatval($request->mekun) * floatval(str_replace(',','',$request->fee2)) * -1;
        $ptf1->interest= floatval($request->mekun) * floatval(str_replace(',','',$request->interest2));
        $ptf1->fee_currency_id=$request->txtcur2;
        if($request->selcurcontinue<>$request->txtcur2){
        $ptf1->fee_ex=-1 * floatval($request->mekun) * $this->doexchange($request->cur_transfer_continue,$request->cur_fee_continue,str_replace(',','',$request->fee2));
        }else{
        $ptf1->fee_ex=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->fee2));
        }
        $ptf1->bonus=0;
        $ptf1->sendername=$request->sendername;
        $ptf1->sendertel=str_replace(' ','',$request->sendertel);
        $ptf1->recname=$request->recname;
        $ptf1->rectel=str_replace(' ','',$request->rectel);
        if($cashdraw_id==''){
            $ptf1->map_id=$id;
            $ptf1->note=$partner_name;
            $ptf1->ref_number=$refnum;
            $ptf1->ref_group_id=$refnum;
        }else{
        $ptf1->ref_group_id='cashdraw-' . $cashdraw_id;
        }
        $ptf1->thai_list=$request->thai_list_continue;
        $ptf1->from_partner_id=$request->partnerid1;
        $ptf1->created_at=$current;
        $ptf1->updated_at=$current;
        $ptf1->location_id=$request->location_id;
        if($request->customertype2=='AGENT' || $request->customertype2=='BANK'){
            $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
        }
        if($ptf1->save()){
            $id1=$ptf1->id;
            $refnum1='transfer-'.$id1;
            $partner_name1=$ptf1->partner->name;
            if($cashdraw_id==''){
                DB::table('partner_transfers')->where('id',$id)->update(['map_id'=>$id1,'note'=>$partner_name1,'ref_number'=>$refnum1,'ref_group_id'=>$refnum]);
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
        foreach ($request->bankid as $key => $value) {
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
            $selcomid=Session('log_into_company_id');
            $ptf=new PartnerTransfer();
            $ptf->tranname=$tranname;//.$request->bankname[$key];
            $ptf->trancode=$trancode;
            $ptf->company_id=$selcomid;
            $ptf->dd=$trdate;
            $ptf->mekun=$trancode;
            $ptf->tt=$trtime;
            $ptf->user_id=$usersave;
            $ptf->parrent_id=$value;
            $ptf->amount=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankamt[$key]));
            $ptf->currency_id=$request->bankcur[$key];
            $ptf->cuscharge=str_replace(',','',$request->bankcuscharge[$key]);
            $ptf->cuscharge_currency_id=$request->bankcur[$key];
            $ptf->fee=-1 * floatval($request->trancode1) * floatval(str_replace(',','',$request->bankpartnerfee[$key]));;
            $ptf->fee_currency_id=$request->bankcur[$key];
            $ptf->bonus=0;
            $ptf->sendername=$request->sendername;
            $ptf->sendertel=str_replace(' ','',$request->sendertel);
            $ptf->recname=$request->recname;
            $ptf->rectel=str_replace(' ','',$request->rectel);
            $ptf->note=$transferto;
            $ptf->from_partner_id=$pid;
            $ptf->action='';
            $ptf->created_at=$current;
            $ptf->updated_at=$current;
            $ptf->location_id=$request->location_id;
            //$ptf->ref_number=$ref_number;
            $ptf->ref_group_id=$ref_number;
            $ptf->user_affect=$this->getuseraffectbank($value);
            $ptf->isbank=$this->checkisbank($value);
            if($ptf->save()){
                $id=$ptf->id;
                if($refnum==''){
                    $refnum='transfer-' . $id;
                    $note=$ptf->partner->name;
                }else{
                    $refnum.=',transfer-' . $id;
                    $note.=',' . $ptf->partner->name;
                }
                if($trancode==-1){
                  $cashdraw=new Cashdraw();
                  $cashdraw->transfer_id=$id;
                  $cashdraw->from_partner_id=$value;
                  $cashdraw->opdate=$trdate;
                  $cashdraw->optime=$trtime;
                  $cashdraw->user_id=$usersave;
                  $cashdraw->amount= str_replace(',','',$request->bankamt[$key]);
                  $cashdraw->currency_id=$request->bankcur[$key];
                  $cashdraw->customer_charge=0;
                  $cashdraw->paymethod='Cash';
                  $cashdraw->receive_tel=str_replace(' ','',$request->rectel);
                  $cashdraw->receive_name=$request->recname;
                  $cashdraw->note=$request->note;
                  $cashdraw->other='វេរទូទាត់តាមធនាគា '. $ptf->partner->name;
                  //$cashdraw->ref_number=$ref_number;
                  $cashdraw->ref_group_id=$ref_number;
                  $cashdraw->created_at=$current;
                  $cashdraw->updated_at=$current;
                  if($cashdraw->save()){
                      $cashdrawid=$cashdraw->id;
                      DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                  }
                }
            }

        }
        if(str_contains($ref_number,'transfer')){
            if($id>0){
                // DB::table('partner_transfers')->where('id',$mainid)->update(['note'=>$note,'ref_number'=>$refnum,'ref_group_id'=>$ref_number]);
                DB::table('partner_transfers')->where('id',$mainid)->update(['note'=>$note,'ref_group_id'=>$ref_number]);
                DB::table('partner_transfers')->where('id','<>',$mainid)->where('ismulti_transfer',1)->where('ref_group_id',$ref_number)->update(['note'=>$note]);
              }
            }

    }
    public function print(Request $request)
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
        // $exchanges=null;
        // $bankpayments=null;
        $tr_id=$request->tr_id;
        $selcomid=Session('log_into_company_id');
        $logo=Company::find($selcomid);
        //$transfers=PartnerTransfer::where('id',$request->tr_id)->Orwhere('ref_group_id','transfer-'.$request->tr_id)->where('amount','>',0)->orderBy('id')->get();
        $transfer=PartnerTransfer::find($request->tr_id);
        if($transfer->trancode==-1){
          $transfers=PartnerTransfer::where(function($query) use($tr_id){
            $query->where('id',$tr_id)->Orwhere('ref_group_id','transfer-'.$tr_id);
          })->where('amount','<',0)->orderBy('id')->get();
        }else{
          $transfers=PartnerTransfer::where(function($query) use($tr_id){
            $query->where('id',$tr_id)->Orwhere('ref_group_id','transfer-'.$tr_id);
          })->where('amount','>',0)->orderBy('id')->get();
        }

        // if($request->hasexchange>0){
        //     $exchanges=ExchangeMulti::where('othercode','=','transfer-' . $request->tr_id)->get();
        // }
        $exchanges=ExchangeMulti::where('ref_group_id','=','transfer-' . $request->tr_id)->orderBy('id')->get();
        // if($request->hasbankpayment>0){
        //     $bankpayments=PartnerTransfer::where('ref_number','=','transfer-' . $request->tr_id)->get();
        // }
        if($transfer->trancode==-1){
          $bankpayments=PartnerTransfer::where('ref_group_id','=','transfer-' . $request->tr_id)->where('amount','>',0)->where('id','<>',$request->tr_id)->get();
        }else{
          $bankpayments=PartnerTransfer::where('ref_group_id','=','transfer-' . $request->tr_id)->where('amount','<',0)->where('id','<>',$request->tr_id)->get();
        }

        //dd($exchanges);
        //return $bankpayments;
        //$totaltransferamount=PartnerTransfer::where('id',$request->tr_id)->Orwhere('ref_group_id','transfer-'.$request->tr_id)->where('amount','>',0)->select(DB::raw('sum(amount) as tamt,currency_id'))->groupBy('currency_id')->get();
        if($transfer->trancode==-1){
          $totaltransferamount=PartnerTransfer::where(function($query) use($tr_id){
            $query->where('id',$tr_id)->Orwhere('ref_group_id','transfer-'.$tr_id);
          })->where('amount','<',0)->select(DB::raw('sum(amount) as tamt,currency_id'))->groupBy('currency_id')->get();
        }else{
          $totaltransferamount=PartnerTransfer::where(function($query) use($tr_id){
            $query->where('id',$tr_id)->Orwhere('ref_group_id','transfer-'.$tr_id);
          })->where('amount','>',0)->select(DB::raw('sum(amount) as tamt,currency_id'))->groupBy('currency_id')->get();
        }
        //$totaltransfercuscharge=PartnerTransfer::where('id',$request->tr_id)->Orwhere('ref_group_id','transfer-'.$request->tr_id)->where('amount','>',0)->select(DB::raw('sum(cuscharge) as tcuscharge,cuscharge_currency_id'))->groupBy('cuscharge_currency_id')->get();

        $totaltransfercuscharge=PartnerTransfer::where(function($query) use($tr_id){
          $query-> where('id',$tr_id)->Orwhere('ref_group_id','transfer-'.$tr_id);
        })->where('amount','>',0)->select(DB::raw('sum(cuscharge) as tcuscharge,cuscharge_currency_id'))->groupBy('cuscharge_currency_id')->get();

        //return $totaltransfercuscharge;
        $c=collect();
        if($totaltransferamount){
          foreach($totaltransferamount as $a1){
            $c=$c->push(['cur'=>$a1->currency->shortcut,'value'=> $a1->tamt]);
          }
        }
        if($totaltransfercuscharge){
          foreach($totaltransfercuscharge as $a2){
            $c=$c->push(['cur'=>$a2->cuschargecur->shortcut,'value'=> $a2->tcuscharge]);
          }
        }

        if($exchanges){
            foreach($exchanges as $e)
            {
                $c=$c->push(['cur'=>$e->cursale,'value'=> -1 * $e->sale]);
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
        //return $sumc;
        $cashin=$sumc->where('value','<>','0');

        if($bankpayments){
            foreach($bankpayments as $bp)
            {
                if($bp->trancode==-3){
                    $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount+$bp->fee]);
                }else{
                    $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount]);
                }
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
        return view('moneytransfers.print',compact('exchanges','transfers','transfer','cashin','bankpayments','cash','logo','totaltransferamount','totaltransfercuscharge'));
    }
    public function saveexchange(Request $request,$trandate,$trantime,$othercode,$note,$current,$usersave)
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
      $e->created_at=$current;
      $e->updated_at=$current;
      $e->company_id=$selcomid;
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
   public function saveexchangeproduct(Request $r,$trandate,$trantime,$othercode,$note,$current,$usersave)
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
            $e1->company_id=$selcomid;
            $e1->save();
            $id=$e1->id;
            $rate_sale =(float)str_replace(',','',$r->item2) / (float)$luy;
            $e2 = new Exchange();
            $e2->dd=$trandate;
            $e2->tt=$trantime;
            $e2->currency_id=$r->curid2;
            $e2->product=-1 * floatval(str_replace(',','',$r->item2));
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
            $e1->company_id=$selcomid;
            $e1->save();
            $id=$e1->id;
            $rate_sale =(float)str_replace(',','',$r->item1) / (float)($luy);
            $e2 = new Exchange();
            $e2->dd=$trandate;
            $e2->tt=$trantime;
            $e2->currency_id=$r->curid1;
            $e2->product=-1 * floatval(str_replace(',','',$r->item1));
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
   public function savemultiexchanges(Request $request,$trandate,$trantime,$othercode,$note,$current,$usersave)
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
                $e->company_id=$selcomid;
                $e->save();
                if($key==0){
                    $multi_id=$e->id;
                    DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id]);
                }
                DB::table('exchange_multis')->where('id',$request->txtexids[$key])->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode]);

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
                $e1->company_id=$selcomid;
                $e1->save();
                $e1_id=$e1->id;
                if($key==0){
                    $multi_id=$e1->id;
                    DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id,'product_first_id'=>$e1_id]);
                }else{
                    DB::table('exchanges')->where('id',$e1_id)->update(['product_first_id'=>$e1_id]);
                }
                $rate_sale =(float)str_replace(',','',$request->txtsales[$key]) / (float)$luy;
                $e2 = new Exchange();
                $e2->dd=$trandate;
                $e2->tt=$trantime;
                $e2->currency_id=$saleinfoes[0];
                $e2->product=-1 * floatval(str_replace(',','',$request->txtsales[$key]));
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
                $e2->company_id=$selcomid;
                $e2->product_first_id=$e1_id;
                $e2->save();
                DB::table('exchange_multis')->where('id',$request->txtexids[$key])->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode]);

            }
      }
      //DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->update(['mapcode'=>$multi_id,'othercode'=>$othercode,'ref_group_id'=>$othercode]);
      //return response()->json(['success'=>'save list completed','mapid'=>$multi_id]);
   }

   public function cashoutusertobank(Request $request,$trandate,$trantime,$ref_number)
   {
       $amt1=0;
       $amt2=0;
       $tranname1='';
       $tranname2='';
       $trancode1='';
       $trancode2='';
       $note1='';
       $note2='';

       foreach ($request->bankid as $key => $value) {
        $uc=array(
            'trandate'=>$trandate,
            'trantime'=>$trantime,
            'user_id'=>Auth::id(),
            'user_id_affect'=>Auth::id(),
            'amount'=>-1 * floatval(str_replace(',','',$request->bankamt[$key])),
            'currency_id'=>$request->bankcur[$key],
            'tranname'=>'ដកលុយ',
            'trancode'=>-1,
            'ref_number'=>$ref_number,
            'note'=>'អតិថិជនវេរដាក់ចូលធនាគា' . $request->bankname[$key],
            );
           if (UserCapital::insert($uc)){
                $bt1=new BankTransaction();
                $bt1->trandate=$trandate;
                $bt1->trantime=$trantime;
                $bt1->user_id=Auth::user()->id;
                $bt1->customer_id=$value;
                $bt1->amount=str_replace(',','',$request->bankamt[$key]);
                $bt1->currency_id=$request->bankcur[$key];
                $bt1->tranname='ទទួលពី'. Auth::user()->name;
                $bt1->note='អតិថិជនវេរដាក់ចូលធនាគា';
                $bt1->ref_number=$ref_number;
                $bt1->save();
           }
       }

   }
   public function showrelate_refnumber(Request $request)
   {
        //return $request->all();
        $id=explode('-',$request->refnum);
        $transfers=collect();
        if($id[0]=='transfer'){
          $transfers=PartnerTransfer::where('id',$id[1])->get()->load('customer','partner','currency','cuschargecur','user');
        }elseif($id[0]=='cashdraw'){
          $transfers=Cashdraw::where('id',$id[1])->get()->load('frompartner','currency','user');
        }elseif($id[0]=='usercapital'){
          $transfers=UserCapital::where('id',$id[1])->get()->load('useraffect','currency','user');
        }

        return response()->json(['transfers'=>$transfers,'tablename'=>$id[0]]);
   }
}
