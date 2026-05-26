<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use App\Currency;
use App\Customer;
use App\Exchange;
use Carbon\Carbon;
use App\Models\SMS;
use App\ExchangeMulti;
use App\AllPartnerList;
use App\PartnerTransfer;
use App\PartnerCloseList;
use App\PartnerTotalList;
use App\PartnerExchangeLeft;
use App\PartnerExchangeList;
use App\PartnerTransferList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartnerListController extends Controller
{
    public function index()
    {
        $selcomid=Session('log_into_company_id');
      $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
      $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
      $nolists=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','NOLIST')->orderBy('no')->get();
      $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->orderBy('no')->get();
        return view('partnerlists.index',compact('customers','partners','nolists','currencies'));
    }
    public function indexnew()
    {
         $selcomid=Session('log_into_company_id');
      $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
       $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
      $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->orderBy('no')->get();
        return view('partnerlists.indexnew',compact('partners','customers','currencies'));
    }
    public function checklist()
    {
         $selcomid=Session('log_into_company_id');
      $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
      $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
      $nolists=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','NOLIST')->orderBy('no')->get();
      $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->orderBy('no')->get();
        return view('partnerlists.checklists',compact('customers','partners','nolists','currencies'));
    }
    public function getpartnerbytype(Request $request)
    {
        $selcomid=Session('log_into_company_id');


        if(Auth::user()->role->name=='Admin'){
            if($request->type=='' || $request->type=='all'){
                $customers=Customer::where('status',1)->where('company_id',$selcomid)->whereNotIn('customertype',['BUYER','SALER'])->orderBy('no')->get()->load('agenttype');
            }else{
                $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype',$request->type)->orderBy('no')->get()->load('agenttype');
            }

        }else{
            if($request->type=='' || $request->type=='all'){
                $customers=Customer::where('status',1)->where('company_id',$selcomid)->whereNotIn('customertype',['BUYER','SALER','NOLIST'])->orderBy('no')->get()->load('agenttype');
            }else{
                $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype',$request->type)->orderBy('no')->get()->load('agenttype');
            }

        }
        return response($customers);
    }
    public function alllist()
    {
        $selcomid=Session('log_into_company_id');
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->where('customertype','CUSTOMER')->orderBy('no')->get();
        return view('partnerlists.alllist',compact('customers','partners'));
    }
    public function exchangelist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $partnerid=$request->partnerid;
        $logo=Company::find($selcomid);
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();
        return view('partnerlists.exchangelist',compact('customers','partners','logo','partnerid'));
    }
    public function exchangelistreport()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $predate=date('Y-m-d', strtotime($current. ' - 1 days'));
        //return $predate;
        $users=User::where('active',1)->get();
        $logo=Company::orderBy('id')->first();
        $currencies=Currency::where('active',1)->where('ispandp',0)->get();
        $exchangelists=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereDate('dd',$current)->where('user_id',Auth::id())->orderBy('id')->get();
        //$exchangelefts=Exchange::where('status',1)->where('isexchangelist',1)->whereDate('dd','<',$current)->where('user_id',Auth::id())->whereRaw('product-p_inout<>0')->orderBy('id')->get();
        $exchangelefts=PartnerExchangeLeft::whereDate('exdate',$predate)->where('user_id',Auth::id())->get();

        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $partnerselects=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereDate('dd',$current)->where('product','>',0)->where('user_id',Auth::id())->select('partner_id')->distinct()->get();
        $partnerexchangeleft1=PartnerExchangeLeft::whereDate('exdate',$predate)->where('amount','>',0)->where('user_id',Auth::id())->select('partner_id')->distinct()->get();
        //return $partnerselects;
        $c1=collect();
        if($partnerselects){
          foreach($partnerselects as $s){
            $c1=$c1->push(['partnerid'=>$s->partner_id,'partnername'=>$s->partner->name]);
          }
        }
        if($partnerexchangeleft1){
          foreach($partnerexchangeleft1 as $pel){
            $c1=$c1->push(['partnerid'=>$pel->partner_id,'partnername'=>$pel->partner->name]);
          }
        }
        $groups = $c1->groupBy('partnerid');
        $csc1 = $groups->map(function ($group) {
                return [
                'partnerid' =>$group->first()['partnerid'], // opposition_id is constant inside the same group, so just take the first or whatever.
                'partnername' =>$group->first()['partnername'],

                ];
        });
       // return $csc1;
        //c2
        $partnerexchangeleft2=PartnerExchangeLeft::whereDate('exdate',$predate)->where('amount','<',0)->where('user_id',Auth::id())->select('partner_id')->distinct()->get();
        $partnerselects2=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereDate('dd',$current)->where('product','<',0)->where('user_id',Auth::id())->select('partner_id')->distinct()->get();
        //return $partnerselects;
        $c2=collect();
        if($partnerselects2){
          foreach($partnerselects2 as $s2){
            $c2=$c2->push(['partnerid'=>$s2->partner_id,'partnername'=>$s2->partner->name]);
          }
        }
        if($partnerexchangeleft2){
          foreach($partnerexchangeleft2 as $pel2){
            $c2=$c2->push(['partnerid'=>$pel2->partner_id,'partnername'=>$pel2->partner->name]);
          }
        }
        $groups2 = $c2->groupBy('partnerid');
        $csc2 = $groups2->map(function ($group) {
                return [
                'partnerid' =>$group->first()['partnerid'], // opposition_id is constant inside the same group, so just take the first or whatever.
                'partnername' =>$group->first()['partnername'],
                ];
        });
        return view('partnerlists.exchangelistreport',compact('customers','logo','exchangelists','users','currencies','partners','exchangelefts','csc1','csc2'));
    }
    public function saveexchangelistleft(Request $request)
    {
      //return $request->all();
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $trantime = date("H:i:s",strtotime($current));
      //$trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
      $date = str_replace('/', '-', $request->exdate);
      $exdate= date('Y-m-d', strtotime($date));
      DB::table('partner_exchange_lefts')->whereDate('exdate',$exdate)->where('partner_id',$request->partner_id)->where('currency_id',$request->currency_id)->where('user_id',$request->user_id)->delete();
      $pel=new PartnerExchangeLeft();
      $pel->exdate=$exdate;
      $pel->user_id=$request->user_id;
      $pel->partner_id=$request->partner_id;
      $pel->amount=str_replace(',','',$request->amount);
      $pel->currency_id=$request->currency_id;
      $pel->saveby=Auth::user()->name;
      $pel->created_at=$current;
      $pel->updated_at=$current;
      if($pel->save()){
        return response()->json(['success'=>'Save Partner List Left Completed']);
      }else{
        return response()->json(['error'=>'Save Partner List Left Completed']);
      }
    }
    public function exchangelistreportstoreinout(Request $request)
    {
       // return $request->all();
        $validator = Validator::make($request->all(), [
            'selpartner' => 'required',
            'selpartner2' => 'required',
            'amount' => 'required',
            'selcur0'=>'required',
            'txtcur1'=>'required',
            'txtcur2'=>'required',
            'fee'=>'required',
            'fee2'=>'required',
            'main_exchange_id'=>'required',
            'main_exchange_id2'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        //save transactions
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $ptf=new PartnerTransfer();
        $ptf->tranname='ទទួល' . $request->partner1;
        $ptf->trancode=-4;
        $ptf->dd=$trandate;
        $ptf->mekun=-1;
        $ptf->tt=$trantime;
        $ptf->user_id=Auth::id();
        $ptf->parrent_id=$request->selpartner;
        $ptf->amount=-1 * floatval(str_replace(',','',$request->amount));
        $ptf->currency_id=$request->selcur0;
        $ptf->cuscharge=0;
        $ptf->cuscharge_currency_id=$request->selcur0;
        $ptf->fee=-1 * floatval(str_replace(',','',$request->fee));
        $ptf->fee_currency_id=$request->txtcur1;
        $ptf->bonus=0;
        $ptf->sendername=$request->sendername;
        $ptf->sendertel=str_replace(' ','',$request->sendertel);
        $ptf->recname=$request->recname;
        $ptf->rectel=str_replace(' ','',$request->rectel);
        $ptf->note='';
        $ptf->exchange_list_id=$request->main_exchange_id;
        $ptf->action='u,d';
        if($ptf->save()){
            $stbe1=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$request->main_exchange_id)->sum('amount');
            DB::table('exchanges')->where('id',$request->main_exchange_id)->update(['p_inout'=>$stbe1]);
            $id=$ptf->id;
            $refnum='transfer-'.$id;
            $partner_name=$ptf->partner->name;
            $transferto=$ptf->partner->name;

            $ptf1=new PartnerTransfer();
            $ptf1->tranname='បន្ត'.$request->partner2;
            $ptf1->trancode=4;
            $ptf1->mekun=1;
            $ptf1->dd=$trandate;
            $ptf1->tt=$trantime;
            $ptf1->user_id=Auth::id();
            $ptf1->parrent_id=$request->selpartner2;
            $ptf1->amount=str_replace(',','',$request->amount);
            $ptf1->currency_id=$request->selcur0;
            $ptf1->cuscharge=0;
            $ptf1->cuscharge_currency_id=$request->selcur0;
            $ptf1->fee=str_replace(',','',$request->fee2);
            $ptf1->fee_currency_id=$request->txtcur2;
            $ptf1->bonus=0;
            $ptf1->sendername=$request->sendername;
            $ptf1->sendertel=str_replace(' ','',$request->sendertel);
            $ptf1->recname=$request->recname;
            $ptf1->rectel=str_replace(' ','',$request->rectel);
            $ptf1->map_id=$id;
            $ptf1->note=$partner_name;
            $ptf1->ref_number=$refnum;
            $ptf1->ref_group_id=$refnum;
            $ptf1->exchange_list_id=$request->main_exchange_id2;
            if($ptf1->save()){
              $stbe2=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$request->main_exchange_id2)->sum('amount');
              DB::table('exchanges')->where('id',$request->main_exchange_id2)->update(['p_inout'=>$stbe2]);
                $id1=$ptf1->id;
                $refnum1='transfer-'.$id1;
                $partner_name1=$ptf1->partner->name;
                DB::table('partner_transfers')->where('id',$id)->update(['map_id'=>$id1,'note'=>$partner_name1,'ref_number'=>$refnum1,'ref_group_id'=>$refnum]);
            }
            return response()->json(['success'=>'true','id'=>$id,'message'=>'transfer has been saved.']);
        }
    }
    public function searchexchangelistreport(Request $request)
    {
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));

        $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
        //return $predate;
        $exchangelists=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2));
        $exchangelefts=PartnerExchangeLeft::whereDate('exdate',$predate)->where('user_id',Auth::id());

        $partnerselects=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('product','>',0);
        $partnerexchangeleft1=PartnerExchangeLeft::whereDate('exdate',$predate)->where('amount','>',0);

        $partnerselects2=Exchange::where('status',1)->where('isexchangelist',1)->where('isexchange_normal',0)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('product','<',0);
        $partnerexchangeleft2=PartnerExchangeLeft::whereDate('exdate',$predate)->where('amount','<',0);


      if($request->partnerid)
      {
        $exchangelists=$exchangelists->where('partner_id',$request->partnerid);
        $exchangelefts=$exchangelefts->where('partner_id',$request->partnerid);

        $partnerselects=$partnerselects->where('partner_id',$request->partnerid);
        $partnerexchangeleft1=$partnerexchangeleft1->where('partner_id',$request->partnerid);
        $partnerselects2=$partnerselects2->where('partner_id',$request->partnerid);
        $partnerexchangeleft2=$partnerexchangeleft2->where('partner_id',$request->partnerid);
      }
      if($request->userid)
      {
        $exchangelists=$exchangelists->where('user_id',$request->userid);
        $exchangeleft=$exchangelefts->where('user_id',$request->userid);

        $partnerselects=$partnerselects->where('user_id',$request->userid);
        $partnerexchangeleft1=$partnerexchangeleft1->where('user_id',$request->userid);
        $partnerselects2=$partnerselects2->where('user_id',$request->userid);
        $partnerexchangeleft2=$partnerexchangeleft2->where('user_id',$request->userid);
      }
      if($request->curid)
      {
        $exchangelists=$exchangelists->where('currency_id',$request->curid);
        $exchangelefts=$exchangelefts->where('currency_id',$request->curid);

        $partnerselects=$partnerselects->where('currency_id',$request->curid);
        $partnerexchangeleft1=$partnerexchangeleft1->where('currency_id',$request->curid);
        $partnerselects2=$partnerselects2->where('currency_id',$request->curid);
        $partnerexchangeleft2=$partnerexchangeleft2->where('currency_id',$request->curid);
      }
      $exchangelists=$exchangelists->orderBy('id')->get();
      $exchangelefts=$exchangelefts->orderBy('id')->get();

      $partnerselects=$partnerselects->select('partner_id')->distinct()->get();
      $partnerexchangeleft1=$partnerexchangeleft1->select('partner_id')->distinct()->get();

      $partnerselects2=$partnerselects2->select('partner_id')->distinct()->get();
      $partnerexchangeleft2=$partnerexchangeleft2->select('partner_id')->distinct()->get();

        $c1=collect();
        if($partnerselects){
          foreach($partnerselects as $s){
            $c1=$c1->push(['partnerid'=>$s->partner_id,'partnername'=>$s->partner->name]);
          }
        }
        if($partnerexchangeleft1){
          foreach($partnerexchangeleft1 as $pel){
            $c1=$c1->push(['partnerid'=>$pel->partner_id,'partnername'=>$pel->partner->name]);
          }
        }
        $groups = $c1->groupBy('partnerid');
        $csc1 = $groups->map(function ($group) {
                return [
                'partnerid' =>$group->first()['partnerid'], // opposition_id is constant inside the same group, so just take the first or whatever.
                'partnername' =>$group->first()['partnername'],

                ];
        });
       // return $csc1;
        //c2

        //return $partnerselects;
        $c2=collect();
        if($partnerselects2){
          foreach($partnerselects2 as $s2){
            $c2=$c2->push(['partnerid'=>$s2->partner_id,'partnername'=>$s2->partner->name]);
          }
        }
        if($partnerexchangeleft2){
          foreach($partnerexchangeleft2 as $pel2){
            $c2=$c2->push(['partnerid'=>$pel2->partner_id,'partnername'=>$pel2->partner->name]);
          }
        }
        $groups2 = $c2->groupBy('partnerid');
        $csc2 = $groups2->map(function ($group) {
                return [
                'partnerid' =>$group->first()['partnerid'], // opposition_id is constant inside the same group, so just take the first or whatever.
                'partnername' =>$group->first()['partnername'],
                ];
        });
        return view('partnerlists.exchangelistreportview',compact('exchangelists','exchangelefts','csc1','csc2'));


    }
    public function printexchangereport(Request $request)
    {
      //return $request->all();
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      $username=$request->username;
      $curname=$request->curname;
      $partnername=$request->partnername;
      $exchangelefts=Exchange::where('status',1)->where('isexchangelist',1)->whereDate('dd','<',$d1)->whereRaw('product-p_inout<>0');
      $exchangelists=Exchange::where('status',1)->where('isexchangelist',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2));
      if($request->partnerid)
      {
        $exchangelists=$exchangelists->where('partner_id',$request->partnerid);
        $exchangelefts=$exchangelefts->where('partner_id',$request->partnerid);
      }
      if($request->userid)
      {
        $exchangelists=$exchangelists->where('user_id',$request->userid);
        $exchangeleft=$exchangelefts->where('user_id',$request->userid);
      }
      if($request->curid)
      {
        $exchangelists=$exchangelists->where('currency_id',$request->curid);
        $exchangelefts=$exchangelefts->where('currency_id',$request->curid);
      }
      $exchangelists=$exchangelists->orderBy('id')->get();
      $exchangelefts=$exchangelefts->orderBy('id')->get();
      if($request->btnid=='btnprintdetail'){
        return view('partnerlists.exchangelistviewprintdetail',compact('exchangelists','d1','d2','username','partnername','curname','exchangelefts'));
      }else{
        return view('partnerlists.exchangelistviewprint',compact('exchangelists','d1','d2','username','partnername','curname','exchangelefts'));
      }
    }
    public function gettotallist(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $usd_id=Currency::where('shortcut','USD')->where('company_id',$selcomid)->where('active',1)->first();
        $thb_id=Currency::where('shortcut','THB')->where('company_id',$selcomid)->where('active',1)->first();
        $khr_id=Currency::where('shortcut','KHR')->where('company_id',$selcomid)->where('active',1)->first();
        $vnd_id=Currency::where('shortcut','VND')->where('company_id',$selcomid)->where('active',1)->first();
        $closedate='';
        $transaction_id=0;
        $exchange_id=0;
        $sms_id=0;

        $close_usd=0;
        $close_thb=0;
        $close_khr=0;
        $close_vnd=0;
        $partnername=$request->partnername;
        $katkongdate= date('Y-m-d', strtotime($request->exchangedate));
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        $customer=Customer::find($request->partner);
        $thai_list=$customer->thai_list??'';
        $closelist=PartnerCloseList::where('partner_id',$request->partner)->whereDate('closedate','<=',$katkongdate)->orderBy('id','DESC')->first();
        if($closelist){
            $closedate=$closelist->closedate;
            $transaction_id=$closelist->transaction_id??0;
            $exchange_id=$closelist->exchange_id??0;
            $sms_id=$closelist->sms_id??0;
            $close_usd=$closelist->usd??0;
            $close_thb=$closelist->thb??0;
            $close_khr=$closelist->khr??0;
            $close_vnd=$closelist->vnd??0;

        }
        DB::table('partner_total_lists')->insert([
            ['viewby'=>Auth::user()->name,'total'=>$close_usd,'cur'=>'USD','note'=>'closelist'],
            ['viewby'=>Auth::user()->name,'total'=>$close_thb,'cur'=>'THB','note'=>'closelist'],
            ['viewby'=>Auth::user()->name,'total'=>$close_khr,'cur'=>'KHR','note'=>'closelist'],
            ['viewby'=>Auth::user()->name,'total'=>$close_vnd,'cur'=>'VND','note'=>'closelist'],

        ]);
        // //$maxtid=PartnerTransfer::where('status',1)->where('parrent_id',$request->partner)->where('id','>',$transaction_id)->whereDate('dd','<=',$katkongdate)->max('id');
        // $maxtid=PartnerTransfer::where('status',1)->where('parrent_id',$request->partner)->max('id');
        // if($maxtid==null){
        //     $maxtid=0;
        // }
        // //$maxeid=PartnerExchangeList::where('status',1)->where('partner_id',$request->partner)->where('id','>',$exchange_id)->whereDate('ex_date','<=',$katkongdate)->max('id');
        // $maxeid=PartnerExchangeList::where('status',1)->where('partner_id',$request->partner)->max('id');
        // if(is_null($maxeid)){
        //     $maxeid=0;
        // }
        // $maxsmsid=SMS::where('accno',$thai_list)->where('status',1)->max('id');
        // if(is_null($maxsmsid)){
        //     $maxsmsid=0;
        // }

        $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
        ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$transaction_id)->whereDate('dd','<=',$katkongdate)->groupBy('currency_id')->get();
        $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
        ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$transaction_id)->whereDate('dd','<=',$katkongdate)->groupBy('fee_currency_id')->get();

        $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
        ->where('status',1)->where('partner_id',$request->partner)->where('id','>',$exchange_id)->whereDate('ex_date','<=',$katkongdate)->groupBy('curbuy')->get();
        $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
        ->where('status',1)->where('partner_id',$request->partner)->where('id','>',$exchange_id)->whereDate('ex_date','<=',$katkongdate)->groupBy('cursale')->get();
        if($thai_list){
            //ករណីភ្ជាប់បញ្ជីដៃគូទៅបញ្ជីថៃ
            $sms_in=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
            ->where('status',1)->where('amount','>',0)->where('accno',$thai_list)->where('id','>',$sms_id)->whereDate('smsdate','<=',$katkongdate)->whereNull('mix_from_id')->groupBy('cur')->get();
            $sms_out=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
            ->where('status',1)->where('amount','<',0)->where('accno',$thai_list)->where('id','>',$sms_id)->whereDate('smsdate','<=',$katkongdate)->whereNull('mix_from_id')->groupBy('cur')->get();
            foreach($sms_in as $si){
                DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'total'=>-1 * floatval($si->totalamount),
                    'cur'=>$si->cur,
                    'note'=>'smslist'
                ]);
            }
            foreach($sms_out as $so){
                DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'total'=>-1 * floatval($so->totalamount),
                    'cur'=>$so->cur,
                    'note'=>'smslist'
                ]);
            }
        }


        foreach($transfers as $t){
            DB::table('partner_total_lists')->insert([
                'viewby'=>Auth::user()->name,
                'total'=>$t->total,
                'cur'=>$t->currency->shortcut,
                'note'=>'transaction'
            ]);
        }
        foreach($fees as $t){
          DB::table('partner_total_lists')->insert([
              'viewby'=>Auth::user()->name,
              'total'=>$t->totalfee,
              'cur'=>$t->feecurrency->shortcut,
              'note'=>'transaction'
          ]);
      }
        foreach($exbuys as $b){
            DB::table('partner_total_lists')->insert([
                'viewby'=>Auth::user()->name,
                'total'=>-1 * $b->totalbuy,
                'cur'=>$b->curbuy,
                'note'=>'exchangelist'
            ]);
        }
        foreach($exsales as $s){
            DB::table('partner_total_lists')->insert([
                'viewby'=>Auth::user()->name,
                'total'=>$s->totalsale,
                'cur'=>$s->cursale,
                'note'=>'exchangelist'
            ]);
        }


        $total_list=PartnerTotalList::select(DB::raw('sum(total) as total,cur'))->where('viewby',Auth::user()->name)->groupBy('cur')->get();
        $mycash=$total_list->where('total','<','0');
        $theircash=$total_list->where('total','>','0');
        $logo=Company::find($selcomid);
        if($request->iscloselist==1){
            return view('partnerlists.close_list',compact('total_list','mycash','theircash','logo','partnername','usd_id','thb_id','khr_id','vnd_id'));
        }else{
            return view('partnerlists.total_list',compact('total_list','mycash','theircash','logo','partnername','usd_id','thb_id','khr_id','vnd_id'));
        }
    }
    public function converttimetoint($t){
        $a=explode(':',$t);
        $h=intval($a[0])*3600;
        $m=intval($a[1])*60;
        $s=intval($a[2]);
        return $h+$m+$s;
    }
    public function getcurrencyidbyshortcut($shortcut)
    {
        $cur=Currency::where('shortcut',$shortcut)->select('id')->first();
        return $cur;
    }
    public function justrefreshdata(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        if(isset($request->linkdetail)){
            $linkdetail=$request->linkdetail;
        }else{
            $linkdetail='true';
        }
        $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
        $last_trandate_usd=$predate;
        $last_trandate_thb=$predate;
        $last_trandate_khr=$predate;
        $last_trandate_vnd=$predate;
        $seelist=$request->seelist;
        $ptls=PartnerTransferList::where('viewby',Auth::user()->name)->orderBy('trandate')->orderBy('id')->get();
        $ptls_new=$ptls;
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
        $befortotalwe=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $befortotalthey=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $aftertotal=PartnerTotalList::where('viewby',Auth::user()->name)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $logo=Company::find($selcomid);
        $partnername=$request->partnername;
        $weopen_oldlist=null;
        $theyopen_oldlist=null;
        $oldlist=null;
        $weopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->get();
        if($request->alldate=='true'){
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $weopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }

        $theyopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->get();
        if($request->alldate=='true'){
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $theyopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        if($request->alldate=='true'){
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        if($request->searchtran==2){
            return view('partnerlists.lists',compact('ptls','befortotalwe','befortotalthey','aftertotal','logo','partnername'));
        }elseif($request->searchtran==1){
            return view('partnerlists.list+1',compact('theyopen','theyopen_oldlist','theyopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate'));
        }elseif($request->searchtran==-1){
            return view('partnerlists.list-1',compact('weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate'));
        }elseif($request->searchtran==0){
            if($request->isbooklist==1){
              return view('partnerlists.listbook0',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd'));
            }elseif($request->isbooklist==2){
              return view('partnerlists.list0',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd'));
            }elseif($request->isbooklist==3){
              return view('partnerlists.listbook3',compact('oldlist','records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd'));
            }
        }elseif($request->searchtran==10){
            if($request->showby=='col'){
                return view('partnerlists.reportnew1',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','ptls_new','linkdetail'));
            }else if($request->showby=='cur'){
                return view('partnerlists.reportnewbycur',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','seelist','linkdetail'));
            }
        }
    }
    public function showdata(Request $request)
    {
        //return $request->all();
        // $curusd=$this->getcurrencyidbyshortcut('USD');
        // $curthb=$this->getcurrencyidbyshortcut('THB');
        // $curkhr=$this->getcurrencyidbyshortcut('KHR');
        // $curvnd=$this->getcurrencyidbyshortcut('VND');
        if(isset($request->linkdetail)){
            $linkdetail=$request->linkdetail;
        }else{
            $linkdetail='true';
        }
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $close_transfer_id=0;
        $close_exchange_id=0;
        $close_sms_id=0;

        $mindate=DB::table('partner_transfers')->where('status',1)->min('dd');
        $customer=Customer::find($request->partner);
        $thai_list=$customer->thai_list;

        // $last_trandate_usd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curusd->id)->whereDate('dd','<',$d1)->max('dd');
        // $last_trandate_thb=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curthb->id)->whereDate('dd','<',$d1)->max('dd');
        // $last_trandate_khr=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curkhr->id)->whereDate('dd','<',$d1)->max('dd');
        // if($curvnd){
        //     $last_trandate_vnd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curvnd->id)->whereDate('dd','<',$d1)->max('dd');
        // }
        $last_trandate_usd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$request->usd_id)->whereDate('dd','<',$d1)->max('dd');
        $last_trandate_thb=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$request->thb_id)->whereDate('dd','<',$d1)->max('dd');
        $last_trandate_khr=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$request->khr_id)->whereDate('dd','<',$d1)->max('dd');
        if(isset($request->vnd_id) && $request->vnd_id>0){
            $last_trandate_vnd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$request->vnd_id)->whereDate('dd','<',$d1)->max('dd');
        }else{
            $last_trandate_vnd=null;
        }
        $alldate=$request->alldate;
        $partnername=$request->partnername;
        $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
        if(is_null($last_trandate_usd)){
            $last_trandate_usd=$predate;
        }
        if(is_null($last_trandate_thb)){
            $last_trandate_thb=$predate;
        }
        if(is_null($last_trandate_khr)){
            $last_trandate_khr=$predate;
        }
        if(is_null($last_trandate_vnd)){
            $last_trandate_vnd=$predate;
        }
        DB::table('partner_transfer_lists')->where('viewby',Auth::user()->name)->delete();
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        if($request->alldate=='false'){
          if($request->oldlist=='true'){
              $closedate=$predate;
              $closetime='';
              $inttime='0';
              $close_usd=0;
              $close_thb=0;
              $close_khr=0;
              $close_vnd=0;
              $oldtranname='លុយសល់';
              $oldnote='OldList';
              //$closelist=PartnerCloseList::whereDate('closedate','<=',$d1)->where('partner_id',$request->partner)->orderBy('closedate','DESC')->first();
              $closelist=PartnerCloseList::whereDate('closedate','<=',$d1)->where('partner_id',$request->partner)->orderBy('id','DESC')->first();
              $c=collect();
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

                  $c=$c->push(['cur'=>'USD','value'=> $close_usd]);
                  $c=$c->push(['cur'=>'THB','value'=> $close_thb]);
                  $c=$c->push(['cur'=>'KHR','value'=> $close_khr]);
                  $c=$c->push(['cur'=>'VND','value'=> $close_vnd]);
              }
              if($closedate>=$d1){
                $oldtranname='បិទបញ្ជីដៃគូ';
                $oldnote='CloseList';
              }
              $oldtransfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                  ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)
                  ->where(function($q){
                    $q->whereNull('thai_amt')->orWhere(function($q1){
                        $q1->whereNotNull('thai_amt')->whereNotNull('docodeby');
                    });
                  })
                  ->groupBy('currency_id')->get();
              $oldfees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                  ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)
                  ->where(function($q){
                    $q->whereNull('thai_amt')->orWhere(function($q1){
                        $q1->whereNotNull('thai_amt')->whereNotNull('docodeby');
                    });
                  })
                  ->groupBy('fee_currency_id')->get();
            //   $oldtransfers_thai=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            //       ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
            //       ->groupBy('currency_id')->get();
            //   $oldfees_thai=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            //       ->where('status',1)->where('parrent_id',$request->partner)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)->whereNotNull('thai_amt')->whereNotNull('docodeby')
            //       ->groupBy('fee_currency_id')->get();
              $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                  ->where('status',1)->where('partner_id',$request->partner)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('curbuy')->get();
              $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                  ->where('status',1)->where('partner_id',$request->partner)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('cursale')->get();

            if($thai_list){
                $sms_in=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
                ->where('status',1)->where('amount','>',0)->where('accno',$thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<',$d1)->whereNull('mix_from_id')->groupBy('cur')->get();
                $sms_out=SMS::select(DB::raw('sum(amount) as totalamount,cur'))
                ->where('status',1)->where('amount','<',0)->where('accno',$thai_list)->where('id','>',$close_sms_id)->whereDate('smsdate','<',$d1)->whereNull('mix_from_id')->groupBy('cur')->get();
                foreach($sms_in as $si){
                    $c=$c->push(['cur'=>$si->cur,'value'=> -1 * $si->totalamount]);
                }
                    foreach($sms_out as $so){
                    $c=$c->push(['cur'=>$so->cur,'value'=> -1 * $so->totalamount]);
                }
            }

            foreach($oldtransfers as $t){
                $c=$c->push(['cur'=>$t->currency->shortcut,'value'=> $t->total]);
              }
              foreach($oldfees as $t){
                $c=$c->push(['cur'=>$t->feecurrency->shortcut,'value'=> $t->totalfee]);
              }
            //   foreach($oldtransfers_thai as $t){
            //     $c=$c->push(['cur'=>$t->currency->shortcut,'value'=> $t->total]);
            //   }
            //   foreach($oldfees_thai as $t){
            //     $c=$c->push(['cur'=>$t->feecurrency->shortcut,'value'=> $t->totalfee]);
            //   }
              foreach($exbuys as $b){
                $c=$c->push(['cur'=>$b->curbuy,'value'=>-1 * $b->totalbuy]);
              }
              foreach($exsales as $s){
                $c=$c->push(['cur'=>$s->cursale,'value'=>$s->totalsale]);
              }
              $groups = $c->groupBy('cur');
              $sumc = $groups->map(function ($group) {
                return [
                'cur' => $group->first()['cur'],
                'value' => $group->sum('value'),
                ];
              });

              $dd=$closedate;
              foreach($sumc as $sc){
                if($sc['cur']=='USD'){
                    $dd=$last_trandate_usd??$closedate;
                }else if($sc['cur']=='THB'){
                   $dd=$last_trandate_thb??$closedate;
                }else if($sc['cur']=='KHR'){
                   $dd=$last_trandate_khr??$closedate;
                }else if($sc['cur']=='VND'){
                   $dd=$last_trandate_vnd??$closedate;
                }
                DB::table('partner_total_lists')->insert([
                  'viewby'=>Auth::user()->name,
                  'dd'=>$dd,
                  'tt'=>$closetime,
                  'ttint'=>$inttime,
                  'tranname'=>$oldtranname,
                  'total'=>$sc['value'],
                  'cur'=>$sc['cur'],
                  'note'=>$oldnote,
                  'amount'=>$sc['value'],
                ]);
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
                  'tranname'=>'លុយសល់',
                  'trandate'=>$predate,
                  'trantime'=>'',
                  'ttint'=>0,
                  'recordby'=>'',
                  'usd'=>$usd,
                  'thb'=>$thb,
                  'khr'=>$khr,
                  'vnd'=>$vnd,
                  'sendertel'=>'',
                  'rectel'=>'',
                  'note'=>$rank_olddate
              ]);
          }
        }

        if($request->alldate=='true'){
          $datas=PartnerTransfer::where('parrent_id',$request->partner)->where('status',1)->orderBy('dd')
          ->where(function($q){
            $q->whereNull('thai_amt')->orWhere(function($q){
                $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
            });
          })
          ->orderBy('id')->get();
        }else{
          $datas=PartnerTransfer::where('parrent_id',$request->partner)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('id','>',$close_transfer_id)
          ->where(function($q){
            $q->whereNull('thai_amt')->orWhere(function($q){
                $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
            });
          })
          ->orderBy('dd')->orderBy('id')->get();
        }
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
                'ttint'=>$this->converttimetoint($data->tt),
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
                'interest'=>$data->interest,
                'ref_group_id'=>$data->ref_group_id,
                'trancode'=>$data->trancode,
                'pointname'=>$data->frompartner->name??''
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
                  'interest'=>$data->interest,
                  'ref_group_id'=>$data->ref_group_id,
                  'trancode'=>$data->trancode,
                  'pointname'=>$data->frompartner->name??'',
                  'thai_seva'=>$data->thai_seva,
                  'thaiseva_exchange'=>$data->thaiseva_exchange,
                  'cuscharge_exchange'=>$data->cuscharge_ex,
                  'fee_exchange'=>$data->fee_ex
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
                  'interest'=>$data->interest,
                  'ref_group_id'=>$data->ref_group_id,
                  'trancode'=>$data->trancode,
                  'pointname'=>$data->frompartner->name??'',
                  'thai_seva'=>$data->thai_seva,
                  'thaiseva_exchange'=>$data->thaiseva_exchange,
                  'cuscharge_exchange'=>$data->cuscharge_ex,
                  'fee_exchange'=>$data->fee_ex

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
                  'ref_number'=>$data->ref_number,
                  'trancode'=>$data->trancode,
                  'pointname'=>$data->frompartner->name??''

              ]);
            }
        }
        if($request->alldate=='true'){
          $partnerexlists=PartnerExchangeList::where('partner_id',$request->partner)->where('status',1)->orderBy('id')->get();
        }else{
          $partnerexlists=PartnerExchangeList::where('partner_id',$request->partner)->whereBetween(DB::raw('DATE(ex_date)'), array($d1, $d2))->where('status',1)->where('id','>',$close_exchange_id)->orderBy('id')->get();
        }
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
                'ttint'=>$this->converttimetoint($pel->ex_time),
                'recordby'=>$pel->user->name,
                'usd'=>$usd,
                'thb'=>$thb,
                'khr'=>$khr,
                'vnd'=>$vnd,
                'sendertel'=>$this->phpformatnumber(floatval($pel->main_rate)),
                'rectel'=>$this->phpformatnumber(floatval($pel->agree_rate)),
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
                'sender'=>$this->phpformatnumber(floatval($pel->main_rate)),
                'receive'=>$this->phpformatnumber(floatval($pel->agree_rate)),
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
                'sender'=>$this->phpformatnumber(floatval($pel->main_rate)),
                'receive'=>$this->phpformatnumber(floatval($pel->agree_rate)),
                'desr'=>$pel->note,
                'ref_number'=>'exchangelist-'.$pel->id
            ]);
        }

        if($thai_list){
            $tint=0;
            if($request->alldate=='true'){
                $sms=SMS::where('accno',$thai_list)->where('status',1)->whereNull('mix_from_id')->orderBy('id')->get();
            }else{
                $sms=SMS::where('accno',$thai_list)->whereBetween(DB::raw('DATE(smsdate)'), array($d1, $d2))->where('status',1)->where('id','>',$close_sms_id)->whereNull('mix_from_id')->orderBy('id')->get();
            }
            foreach($sms as $ss){
                $khr=0;
                $usd=0;
                $thb=0;
                $vnd=0;
                $tint+=1;
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
                    'tranname'=>$ss->amount>0?'លុយដាក់ចូល':'លុយដកចេញ',
                    'trandate'=>$ss->smsdate,
                    'trantime'=>$ss->smstime,
                    'ttint'=>$tint,
                    'recordby'=>$ss->smsby,
                    'usd'=>$usd,
                    'thb'=>$thb,
                    'khr'=>$khr,
                    'vnd'=>$vnd,
                    'sendertel'=>$ss->customer->name??'',
                    'rectel'=>'',
                    'note'=>$ss->opdesr
                ]);

                DB::table('partner_total_lists')->insert([
                    'viewby'=>Auth::user()->name,
                    'dd'=>$ss->smsdate,
                    'tt'=>$ss->smstime,
                    'ttint'=>$tint,
                    'recordby'=>$ss->smsby,
                    'tranname'=>$ss->amount>0?'លុយដាក់ចូល':'លុយដកចេញ',
                    'total'=>-1 * $ss->amount,
                    'cur'=>$ss->cur,
                    'note'=>'',
                    'amount'=>-1 * $ss->amount,
                    'sender'=>$ss->customer->name??'',
                    'receive'=>'',
                    'desr'=>'',
                    'ref_number'=>'smslist-'.$ss->id
                ]);
            }
        }

        $seelist=$request->seelist;
        $ptls=PartnerTransferList::where('viewby',Auth::user()->name)->orderBy('trandate')->orderBy('ttint')->get();
        $ptls_new=$ptls;
        if($seelist==2){
            $ptls_new=$ptls;
        }else if($seelist==1){
            $ptls_new=PartnerTransferList::where('viewby',Auth::user()->name)->where(function($q){
                $q->where('usd','>',0)->orWhere('thb','>',0)->orWhere('khr','>',0)->orWhere('vnd','>',0);
            })
            ->orderBy('trandate')->orderBy('ttint')->get();
        }else if($seelist==-1){
            $ptls_new=PartnerTransferList::where('viewby',Auth::user()->name)->where(function($q){
                $q->where('usd','<',0)->orWhere('thb','<',0)->orWhere('khr','<',0)->orWhere('vnd','<',0);
            })
            ->orderBy('trandate')->orderBy('ttint')->get();
        }
        $selcomid=Session('log_into_company_id');
        $ptls1=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('id')->get();
        $befortotalwe=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $befortotalthey=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $aftertotal=PartnerTotalList::where('viewby',Auth::user()->name)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $logo=Company::find($selcomid);
        $partnername=$request->partnername;
        $weopen_oldlist=null;
        $theyopen_oldlist=null;
        $oldlist=null;
        $weopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->get();
        if($request->alldate=='true'){
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $weopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }

        $theyopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->get();
        if($request->alldate=='true'){
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $theyopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        if($request->alldate=='true'){
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        if($request->searchtran==2){
            return view('partnerlists.lists',compact('ptls','befortotalwe','befortotalthey','aftertotal','logo','partnername'));
        }elseif($request->searchtran==1){
            return view('partnerlists.list+1',compact('theyopen','theyopen_oldlist','theyopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate'));
        }elseif($request->searchtran==-1){
            return view('partnerlists.list-1',compact('weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate'));
        }elseif($request->searchtran==0){
            if($request->isbooklist==1){
              return view('partnerlists.listbook0',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd'));
            }elseif($request->isbooklist==2){
                //if($request->ck2col=='true'){
                    return view('partnerlists.list000',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','linkdetail'));
                // }else{
                //     return view('partnerlists.list0',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','linkdetail'));
                // }
            }elseif($request->isbooklist==3){
              return view('partnerlists.listbook3',compact('oldlist','records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd'));
            }
        }elseif($request->searchtran==10){
            if($request->showby=='col'){
                if(isset($request->isprint) && $request->isprint==1){
                    return view('partnerlists.reportnew1print',compact('alldate','partnername','d1','d2','theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','ptls_new','linkdetail'));
                }else{
                    return view('partnerlists.reportnew1',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','ptls_new','linkdetail'));
                }
            }else if($request->showby=='cur'){
                if(isset($request->isprint) && $request->isprint==1){
                    return view('partnerlists.reportnewbycurprint',compact('alldate','partnername','d1','d2','theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','seelist','linkdetail'));
                }else{
                    return view('partnerlists.reportnewbycur',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','ptls','ptls1','befortotalwe','befortotalthey','aftertotal','logo','partnername','oldlist','records','predate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','seelist','linkdetail'));
                }
            }
        }
    }
    public function partnerlistprint(Request $request)
    {
      //return $request->all();
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->orderBy('no')->get();
        $curusd=$this->getcurrencyidbyshortcut('USD');
        $curthb=$this->getcurrencyidbyshortcut('THB');
        $curkhr=$this->getcurrencyidbyshortcut('KHR');
        $curvnd=$this->getcurrencyidbyshortcut('VND');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $alldate=$request->alldate;
        $selcur=$request->selcur;
        $mindate=DB::table('partner_transfers')->where('status',1)->min('dd');
        $predate=date('Y-m-d', strtotime($d1. ' - 1 days'));
        $last_trandate_usd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curusd->id)->whereDate('dd','<',$d1)->max('dd');
        $last_trandate_thb=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curthb->id)->whereDate('dd','<',$d1)->max('dd');
        $last_trandate_khr=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curkhr->id)->whereDate('dd','<',$d1)->max('dd');
        $last_trandate_vnd=DB::table('partner_transfers')->where('status',1)->where('parrent_id',$request->partner)->where('currency_id',$curvnd->id)->whereDate('dd','<',$d1)->max('dd');

        $partnername=$request->partnername;
        $ptls=PartnerTransferList::where('viewby',Auth::user()->name)->orderBy('trandate')->orderBy('id')->get();
        $befortotalwe=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $befortotalthey=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $aftertotal=PartnerTotalList::where('viewby',Auth::user()->name)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
        $logo=Company::orderBy('id')->first();
        $partnername=$request->partnername;
        $weopen_oldlist=null;
        $oldlist=null;
        $weopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->get();
        if($request->alldate=='true'){
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $weopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,sum(amount) as amount,cur'))->groupBy('cur')->get();
          $weopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','<',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        $theyopen_oldlist=null;
        $theyopen=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->get();
        if($request->alldate=='true'){
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $theyopen_oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $theyopen_records=PartnerTotalList::where('viewby',Auth::user()->name)->where('total','>',0)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        if($request->alldate=='true'){
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->orderBy('dd')->orderBy('ttint')->get();
        }else{
          $oldlist=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','<',$d1)->select(DB::raw('sum(total) as total,cur'))->groupBy('cur')->get();
          $records=PartnerTotalList::where('viewby',Auth::user()->name)->whereDate('dd','>=',$d1)->orderBy('dd')->orderBy('ttint')->get();
        }
        //return $theyopen_oldlist;
        if($request->searchtran==2){
            return view('partnerlists.lists_print1',compact('ptls','befortotalwe','befortotalthey','aftertotal','logo','partnername','d1','d2','alldate','selcur','partners','currencies'));
        }elseif($request->searchtran==1){
            return view('partnerlists.list+1_print',compact('theyopen','theyopen_oldlist','theyopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','selcur'));
        }elseif($request->searchtran==-1){
            return view('partnerlists.list-1_print',compact('weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','selcur'));
        }elseif($request->searchtran==0){
            if($request->isbooklist==1){
              return view('partnerlists.listbook0_print',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','selcur'));
            }elseif($request->isbooklist==3){
              return view('partnerlists.listbook3_print',compact('oldlist','records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','selcur'));
            }elseif($request->isbooklist==2){
                if($request->btnclick=='btnprint'){
                    return view('partnerlists.list0_print',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','selcur'));
                }else{
                    return view('partnerlists.list0_view',compact('theyopen','theyopen_oldlist','theyopen_records','weopen','weopen_oldlist','weopen_records','befortotalwe','befortotalthey','aftertotal','logo','partnername','predate','d1','d2','alldate','last_trandate_usd','last_trandate_thb','last_trandate_khr','last_trandate_vnd','selcur'));
                }
            }
        }
    }
    public function showcloselist(Request $request)
    {
       // return $request->all();
        $closelists=PartnerCloseList::where('partner_id',$request->partner)->orderBy('closedate','DESC')->orderBy('id','DESC')->take(10)->get();
        return view('partnerlists.show_close_list',compact('closelists'));
    }
    public function closelistdelete(Request $request)
    {
        $d= DB::table('partner_close_lists')->where('id',$request->id)->delete();
        if($d==1){
            return response()->json(['success'=>true,'message'=>'closelist has been deleted']);
        }else{
            return response()->json(['error'=>true,'message'=>'delete error']);
        }
    }
    public function delkatkong(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $exchangelists=PartnerExchangeList::where('status',1)->whereDate('ex_date',$current)->where('user_id',Auth::id())->where('company_id',$selcomid)->orderBy('id')->get();
        //$users=User::where('active',1)->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT'])->where('company_id',$selcomid)->orderBy('no')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->where('company_id',$selcomid)->orderBy('no')->get();
        //$customers=Customer::where('status',1)->orderBy('no')->get();
        return view('partnerlists.delkatkong',compact('customers','partners','exchangelists','users'));
    }
    public function delete(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $othercode='exchangelist-' . $request->id;
        if($request->status==1){
            $status=0;
        }else{
            $status=1;
        }
        $exchangelist=PartnerExchangeList::find($request->id);
        $exchangelist->status=$status;
        $exchangelist->userdel=Auth::user()->name;
        $exchangelist->updated_at=$current;
        $exchanges=Exchange::where('othercode',$othercode)->get();
        foreach($exchanges as $e){
          $checkexchangeid=DB::table('partner_transfers')->where('status',1)->where('exchange_list_id',$e->id)->exists();
          if($checkexchangeid==true){
            return response()->json(['error'=>true,'message'=>'you can not delete this exchange list now.']);
          }
        }
        if($exchangelist->save()){
            DB::table('exchanges')->where('othercode',$othercode)->update(['status'=>$status,'userdel'=>Auth::user()->name,'updated_at'=>$current]);
            DB::table('exchange_multis')->where('othercode',$othercode)->update(['status'=>$status,'userdel'=>Auth::user()->name,'updated_at'=>$current]);
            return response()->json(['success'=>true,'message'=>'this record has been deleted']);
        }
    }
    public function exchangelistshow(Request $request)
    {
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $status=$request->isdel=='true'?0:1;
        $exchangelists=PartnerExchangeList::whereBetween(DB::raw('DATE(ex_date)'), array($d1, $d2))->where('status',$status);
        if($request->partner){
            $exchangelists=$exchangelists->where('partner_id',$request->partner);
        }
        if($request->user){
            $exchangelists=$exchangelists->where('user_id',$request->user);
        }

        $exchangelists=$exchangelists->orderBy('id')->get();
        return view('partnerlists.exchangelistshow',compact('exchangelists'));
    }
    public function storecloselist(Request $request)
    {
       // return $request->all();
       $validator = Validator::make($request->all(), [
            'selcustomer1'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }



        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $cltime = date("H:i:s",strtotime($current));
        $cdate = str_replace('/', '-', $request->closedate);
        $cldate= date('Y-m-d', strtotime($cdate));

        $customer=Customer::find($request->selcustomer1);

        $max_tid_of_cldate = PartnerTransfer::where('status',1)->where('parrent_id',$request->selcustomer1)->whereDate('dd','<=',$cldate)->max('id') ?? 0; // shorthand for null check
        $min_tid_of_nextdate = PartnerTransfer::where('status',1)->where('parrent_id',$request->selcustomer1)->whereDate('dd','>',$cldate)->min('id');

       if ($min_tid_of_nextdate && $max_tid_of_cldate > $min_tid_of_nextdate) {
            return response()->json([
                'error' => 'true',
                'sms'   => 'Save close list not allowed because closedate last id is bigger than next date of close date.'
            ]);
        }

        $max_eid_of_cldate=PartnerExchangeList::where('status',1)->where('partner_id',$request->selcustomer1)->whereDate('ex_date','<=',$cldate)->max('id') ?? 0;
        $min_eid_of_nextdate=PartnerExchangeList::where('status',1)->where('partner_id',$request->selcustomer1)->whereDate('ex_date','>',$cldate)->min('id');

        if ($min_eid_of_nextdate && $max_eid_of_cldate > $min_eid_of_nextdate) {
            return response()->json([
                'error' => 'true',
                'sms'   => 'Save close list not allowed because closedate last id is bigger than next date of close date.'
            ]);
        }

        $max_smsid_of_cldate=SMS::where('accno',$customer->thai_list)->where('status',1)->whereDate('smsdate','<=',$cldate)->max('id') ?? 0;
        $min_smsid_of_nextdate=SMS::where('accno',$customer->thai_list)->where('status',1)->whereDate('smsdate','>',$cldate)->max('id');

        if ($min_smsid_of_nextdate && $max_smsid_of_cldate > $min_smsid_of_nextdate) {
            return response()->json([
                'error' => 'true',
                'sms'   => 'Save close list not allowed because closedate last id is bigger than next date of close date.'
            ]);
        }

        $cl=new PartnerCloseList();
        $cl->closedate=$cldate;
        $cl->closetime=$cltime;
        $cl->closeby=Auth::user()->name;
        $cl->partner_id=$request->selcustomer1;
        $cl->usd=str_replace(',','',$request->close_usd);
        $cl->thb=str_replace(',','',$request->close_thb);
        $cl->khr=str_replace(',','',$request->close_khr);
        $cl->vnd=str_replace(',','',$request->close_vnd);
        $cl->transaction_id=$max_tid_of_cldate;
        $cl->exchange_id=$max_eid_of_cldate;
        $cl->sms_id=$max_smsid_of_cldate;
        $cl->note='';
        $cl->created_at=$current;
        $cl->updated_at=$current;
        if($cl->save()){
            return response()->json(['sms'=>'save close list completed']);
        }

    }
    public function store(Request $request)
    {
        //return $request->all();
        // $validator = Validator::make($request->all(), [
        //     'txtbuy'=>'required',
        //     'txtsale' => 'required',

        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['error'=>$validator->errors()->all()]);
        // }
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $extime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->exchangedate);
        $exdate= date('Y-m-d', strtotime($date));
        $pel=new PartnerExchangeList();
        $pel->ex_date=$exdate;
        $pel->ex_time=$extime;
        $pel->user_id=Auth::id();
        $pel->buy=str_replace(',','',$request->buy);
        $pel->curbuy=$request->curbuy;
        $pel->curbuy_id=$request->curbuy_id;

        $pel->sale=str_replace(',','',$request->sale);
        $pel->cursale=$request->cursale;
        $pel->cursale_id=$request->cursale_id;
        $pel->partner_id=$request->partner_id;
        $pel->main_rate=str_replace(',','',$request->main_rate);
        $pel->agree_rate=str_replace(',','',$request->agree_rate);
        $pel->company_id=$selcomid;
        if($pel->save()){
            $id=$pel->id;
            $partnername=$pel->partner->name;
            if(is_null($request->maincur)){
                $this->saveexchangeproduct($request,$exdate,$extime,'exchangelist-' . $id,$partnername);
            }else{
                $this->saveexchange($request,$exdate,$extime,'exchangelist-' . $id,$partnername);
            }
            return response()->json(['success'=>true,'message'=>'save list successfully']);
        }else{
            return response()->json(['error'=>true,'message'=>'save list fail']);
        }
    }
    public function saveexchange(Request $request,$trandate,$trantime,$othercode,$partnername)
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
       $e->rate=str_replace(',','',$request->agree_rate);
       $e->drate=str_replace(',','',$request->main_rate);
       $e->cashreceive=0;
       $e->cashreturn=0;
       $e->multiexchangecode='';
       $e->othercode=$othercode;
       $e->ref_group_id=$othercode;
       $e->partner_id=$request->partner_id;
       $e->isexchange_normal=$request->isexchange_normal;
       if($request->buysaleid){
        $e->buysaleid=$request->buysaleid;
      }
       $e->isexchangelist=1;
       $e->note=$partnername;
       $e->user_id=Auth::user()->id;
       $e->company_id=$selcomid;
       if($e->save()){
          $id=$e->id;
          $em=new ExchangeMulti();
          $em->user_id=Auth::user()->id;
          $em->dd=$trandate;
          $em->tt=$trantime;
          $em->buy=str_replace(',','',$request->buy);
          $em->curbuy=$request->curbuy;
          $em->sale=str_replace(',','',$request->sale);
          $em->cursale=$request->cursale;
          $em->buyinfo='';
          $em->saleinfo='';
          $em->rate=str_replace(',','',$request->agree_rate);
          $em->drate=str_replace(',','',$request->main_rate);
          $em->cashreceive=0;
          $em->cashreturn=0;
          $em->rateinfo='';
          $em->mapcode=$id;
          $em->othercode=$othercode;
          $em->ref_group_id=$othercode;
          $em->isexchangelist=1;
          $em->note=$partnername;
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
    public function saveexchangeproduct(Request $r,$trandate,$trantime,$othercode,$partnername)
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
            $e1->company_id=$selcomid;
            $e1->cashreceive=0;
            $e1->cashreturn=0;
            $e1->multiexchangecode='';
            $e1->othercode=$othercode;
            $e1->ref_group_id=$othercode;
            $e1->partner_id=$r->partner_id;
            if($r->buysaleid){
              $e1->buysaleid=$r->buysaleid;
            }
            $e1->isexchangelist=1;
            $e1->note=$partnername;
            $e1->user_id=Auth::user()->id;
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
            $e2->company_id=$selcomid;
            $e2->cashreceive=0;
            $e2->cashreturn=0;
            $e2->multiexchangecode=$id;
            $e2->othercode=$othercode;
            $e2->ref_group_id=$othercode;
            $e2->partner_id=$r->partner_id;
            if($r->buysaleid){
              $e2->buysaleid=$r->buysaleid;
            }
            $e2->isexchangelist=1;
            $e2->note=$partnername;
            $e2->user_id=Auth::user()->id;
            $e2->save();
            $em=new ExchangeMulti();
            $em->user_id=Auth::user()->id;
            $em->dd=$trandate;
            $em->tt=$trantime;
            $em->buy=str_replace(',','',$r->buy);
            $em->curbuy=$r->curbuy;
            $em->sale=str_replace(',','',$r->sale);
            $em->cursale=$r->cursale;
            $em->buyinfo='';
            $em->saleinfo='';
            $em->rate=str_replace(',','',$r->agree_rate);
            $em->drate=str_replace(',','',$r->main_rate);
            $em->cashreceive=0;
            $em->cashreturn=0;
            $em->rateinfo='';
            $em->mapcode=$id;
            $em->othercode=$othercode;
            $em->ref_group_id=$othercode;
            $em->isexchangelist=1;
            $em->note=$partnername;
            $em->company_id=$selcomid;
            $em->save();
            DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
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
            $e1->ref_group_id=$othercode;
            $e1->partner_id=$r->partner_id;
            if($r->buysaleid){
              $e1->buysaleid=$r->buysaleid;
            }
            $e1->isexchangelist=1;
            $e1->note=$partnername;
            $e1->user_id=Auth::user()->id;
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
            $e2->company_id=$selcomid;
            $e2->cashreceive=0;
            $e2->cashreturn=0;
            $e2->multiexchangecode=$id;
            $e2->othercode=$othercode;
            $e2->ref_group_id=$othercode;
            $e2->partner_id=$r->partner_id;
            if($r->buysaleid){
              $e2->buysaleid=$r->buysaleid;
            }
            $e2->isexchangelist=1;
            $e2->note=$partnername;
            $e2->user_id=Auth::user()->id;
            $e2->save();
            $em=new ExchangeMulti();
            $em->user_id=Auth::user()->id;
            $em->dd=$trandate;
            $em->tt=$trantime;
            $em->buy=str_replace(',','',$r->buy);
            $em->curbuy=$r->curbuy;
            $em->sale=str_replace(',','',$r->sale);
            $em->cursale=$r->cursale;
            $em->buyinfo='';
            $em->saleinfo='';
            $em->rate=str_replace(',','',$r->agree_rate);
            $em->drate=str_replace(',','',$r->main_rate);
            $em->company_id=$selcomid;
            $em->cashreceive=0;
            $em->cashreturn=0;
            $em->rateinfo='';
            $em->mapcode=$id;
            $em->othercode=$othercode;
            $em->ref_group_id=$othercode;
            $em->isexchangelist=1;
            $em->note=$partnername;
            $em->save();
            DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
            //return response()->json(['success'=>'Save Success','id'=>$id]);
      }

   }
   function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;
        if($dc>2){
          $dc=2;
        }
      }
        return number_format($num,$dc,'.',',');
    }

    public function summaryallpartnerlist(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $close_transfer_id=0;
        $close_exchange_id=0;
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        DB::table('all_partner_lists')->where('viewby',Auth::user()->name)->delete();
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();
        if(isset($request->ptype)){
          if(in_array('NOLIST',$request->ptype) && count($request->ptype)==1){

          }else{
            if($request->luysal=='true'){
              $this->notyetcashdraw($request);
            }
          }
          $customers=Customer::where('status',1)->whereIn('customertype',$request->ptype)->where('company_id',$selcomid)->orderBy('customertype')->orderBy('no')->get();
        }else{
          if($request->luysal=='true'){
            $this->notyetcashdraw($request);
          }
          if(Auth::user()->role->name=='Admin'){
            $customers=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER','AGENT','CUSTOMER','BUYER','SALER'])->where('company_id',$selcomid)->orderBy('customertype')->orderBy('no')->get();
          }else{
            $customers=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER','AGENT','BUYER','SALER'])->where('company_id',$selcomid)->orderBy('customertype')->orderBy('no')->get();
          }
        }

        foreach($customers as $c)
        {
            $close_transfer_id=0;
            $close_exchange_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            if($request->oldlist=='true'){
                $closelist=PartnerCloseList::whereDate('closedate','<=',$d2)->where('partner_id',$c->id)->orderBy('id','DESC')->first();
                if($closelist){
                    $close_transfer_id=$closelist->transaction_id;
                    $close_exchange_id=$closelist->exchange_id;
                    $usd=$closelist->usd;
                    $thb=$closelist->thb;
                    $khr=$closelist->khr;
                    $vnd=$closelist->vnd;

                }
                $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
                $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->groupBy('fee_currency_id')->get();

                $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                    ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('curbuy')->get();
                $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                    ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('cursale')->get();
            }else{
                $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
                $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->groupBy('fee_currency_id')->get();

                $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                    ->where('status',1)->where('partner_id',$c->id)->whereDate('ex_date','>=',$d1)->whereDate('ex_date','<=',$d2)->groupBy('curbuy')->get();
                $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                    ->where('status',1)->where('partner_id',$c->id)->whereDate('ex_date','>=',$d1)->whereDate('ex_date','<=',$d2)->groupBy('cursale')->get();

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

            DB::table('all_partner_lists')->insert([
                'viewby'=>Auth::user()->name,'customer_id'=>$c->id,'usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'desr'=>''
            ]);
        }

        $allpartnerlists=AllPartnerList::where('viewby',Auth::user()->name)->orderBy('id')->get();
        return view('partnerlists.showalllist',compact('allpartnerlists'));

    }
    public function notyetcashdraw(Request $request)
  {
    $selcomid=Session('log_into_company_id');
    $d2= date('Y-m-d', strtotime($request->d2));
    $khr=0;
    $usd=0;
    $thb=0;
    $vnd=0;
    $transfers=PartnerTransfer::select(DB::raw('sum(amount) as total,currency_id'))->where('company_id',$selcomid)
            ->where('status',1)->where('trancode',-1)->whereNull('iscashdraw')->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
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

    DB::table('all_partner_lists')->insert([
      'viewby'=>Auth::user()->name,'customer_id'=>0,'usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'desr'=>'លុយសល់មិនទាន់បើក'
    ]);

  }
    public function printallpartnerlist(Request $request)
    {
        $rpttitle='';
        if($request->oldlist=='true'){
            $datestr='គិតត្រឹមថ្ងៃទី '. $request->d2;
        }else{
            $datestr='គិតពី '. $request->d1 . ' ដល់ '. $request->d2;
        }

        if(isset($request->ptype)){
          $rpttitle=$request->ptype;
        }else{
          $rpttitle='បញ្ជីធនាគា ដៃគូ អតិថិជន និងភ្នាក់ងារ ទាំងអស់';
        }
        $printby=Auth::user()->name;
        $allpartnerlists=AllPartnerList::where('viewby',Auth::user()->name)->orderBy('id')->get();
        if($request->viewdetail==1){
            $totalwe=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd) as tusd,sum(thb) as tbat,sum(khr) as tkhr,sum(vnd) as tvnd'))->first();
            $totalthey=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd1) as tusd1,sum(thb1) as tbat1,sum(khr1) as tkhr1,sum(vnd1) as tvnd1'))->first();
            $lasttotal=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd+usd1) as usd,sum(thb+thb1) as thb,sum(khr+khr1) as khr,sum(vnd+vnd1) as vnd'))->first();
            return view('partnerlists.showallpartnerlistprintdetail1',compact('allpartnerlists','totalwe','totalthey','lasttotal','rpttitle','datestr','printby'));
        }else{
            return view('partnerlists.showallpartnerlistprint',compact('allpartnerlists','rpttitle','datestr','printby'));
        }
    }
    public function clearallviewer(){
      $clear1=DB::table('all_partner_lists')->delete();
      $clear2=DB::table('partner_total_lists')->delete();
      return response()->json(['clear1'=>$clear1,'clear2'=>$clear2]);

    }
    public function summaryallpartnerlistdetail(Request $request)
    {
        //return $request->all();
        $found=0;
        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $khr1=0;
        $usd1=0;
        $thb1=0;
        $vnd1=0;
        $close_transfer_id=0;
        $close_exchange_id=0;
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $selcomid=Session('log_into_company_id');
        DB::table('all_partner_lists')->where('viewby',Auth::user()->name)->delete();
        DB::table('partner_total_lists')->where('viewby',Auth::user()->name)->delete();

        if(isset($request->ptype)){
          if(in_array('NOLIST',$request->ptype) && count($request->ptype)==1){

          }else{
            if($request->luysal=='true'){
              $this->notyetcashdraw1($request);
            }
          }
          $customers=Customer::where('status',1)->whereIn('customertype',$request->ptype)->orderBy('customertype')->where('company_id',$selcomid)->orderBy('no')->get();
        }else{
          if($request->luysal=='true'){
            $this->notyetcashdraw1($request);
          }
          if(Auth::user()->role->name=='Admin'){
            $customers=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER','AGENT','CUSTOMER'])->where('company_id',$selcomid)->orderBy('customertype')->orderBy('no')->get();
          }else{
            $customers=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER','AGENT'])->where('company_id',$selcomid)->orderBy('customertype')->orderBy('no')->get();
          }
        }

        foreach($customers as $c)
        {

            $close_transfer_id=0;
            $close_exchange_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;
            $usd1=0;
            $thb1=0;
            $khr1=0;
            $vnd1=0;
            if($request->oldlist=='true'){
                $closelist=PartnerCloseList::whereDate('closedate','<=',$d2)->where('partner_id',$c->id)->orderBy('id','DESC')->first();
                if($closelist){
                    $close_transfer_id=$closelist->transaction_id;
                    $close_exchange_id=$closelist->exchange_id;
                    $closelist->usd<0?$usd=$closelist->usd: $usd1=$closelist->usd;
                    $closelist->thb<0?$thb=$closelist->thb: $thb1=$closelist->thb;
                    $closelist->usd<0?$khr=$closelist->khr: $khr1=$closelist->khr;
                    $closelist->usd<0?$vnd=$closelist->vnd: $vnd1=$closelist->vnd;
                }
                $receives=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->where('amount','<',0)->groupBy('currency_id')->get();
                $senders=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->where('amount','>',0)->groupBy('currency_id')->get();

                $feereceives=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->where('fee','<',0)->groupBy('fee_currency_id')->get();
                $feesenders=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<=',$d2)->where('fee','>',0)->groupBy('fee_currency_id')->get();

                $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                    ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('curbuy')->get();

                $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                    ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<=',$d2)->groupBy('cursale')->get();
            }else{
                $receives=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('amount','<',0)->groupBy('currency_id')->get();
                $senders=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('amount','>',0)->groupBy('currency_id')->get();

                $feereceives=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('fee','<',0)->groupBy('fee_currency_id')->get();
                $feesenders=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
                ->where('status',1)->where('parrent_id',$c->id)->whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('fee','>',0)->groupBy('fee_currency_id')->get();

                $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                    ->where('status',1)->where('partner_id',$c->id)->whereDate('ex_date','>=',$d1)->whereDate('ex_date','<=',$d2)->groupBy('curbuy')->get();

                $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                    ->where('status',1)->where('partner_id',$c->id)->whereDate('ex_date','>=',$d1)->whereDate('ex_date','<=',$d2)->groupBy('cursale')->get();

            }

            if($receives){
              foreach($receives as $r){
                  if($r->currency->shortcut=='USD'){
                      $usd +=$r->total;
                  }elseif($r->currency->shortcut=='THB'){
                      $thb +=$r->total;
                  }elseif($r->currency->shortcut=='KHR'){
                      $khr +=$r->total;
                  }elseif($r->currency->shortcut=='VND'){
                      $vnd +=$r->total;
                  }
              }
            }
            if($senders){
              foreach($senders as $s){
                  if($s->currency->shortcut=='USD'){
                      $usd1 +=$s->total;
                  }elseif($s->currency->shortcut=='THB'){
                      $thb1 +=$s->total;
                  }elseif($s->currency->shortcut=='KHR'){
                      $khr1 +=$s->total;
                  }elseif($s->currency->shortcut=='VND'){
                      $vnd1 +=$s->total;
                  }
              }
            }
            if($feereceives){
              foreach($feereceives as $r){
                  if($r->feecurrency->shortcut=='USD'){
                      $usd +=$r->totalfee;
                  }elseif($r->feecurrency->shortcut=='THB'){
                      $thb +=$r->totalfee;
                  }elseif($r->feecurrency->shortcut=='KHR'){
                      $khr +=$r->totalfee;
                  }elseif($r->feecurrency->shortcut=='VND'){
                      $vnd +=$r->totalfee;
                  }
              }
            }
            if($feesenders){
              foreach($feesenders as $s){

                  if($s->feecurrency->shortcut=='USD'){
                      $usd1 +=$s->totalfee;
                  }elseif($s->feecurrency->shortcut=='THB'){
                      $thb1 +=$s->totalfee;
                  }elseif($s->feecurrency->shortcut=='KHR'){
                      $khr1 +=$s->totalfee;
                  }elseif($s->feecurrency->shortcut=='VND'){
                      $vnd1 +=$s->totalfee;
                  }
              }
            }
            if($exbuys){
              foreach($exbuys as $t){

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
            }

            if($exsales){
              foreach($exsales as $t){
                  $found=1;
                  if($t->cursale=='USD'){
                      $usd1 +=$t->totalsale;
                  }elseif($t->cursale=='THB'){
                      $thb1 +=$t->totalsale;
                  }elseif($t->cursale=='KHR'){
                      $khr1 +=$t->totalsale;
                  }elseif($t->cursale=='VND'){
                      $vnd1 +=$t->totalsale;
                  }
              }
            }

            DB::table('all_partner_lists')->insert([
                'viewby'=>Auth::user()->name,'customer_id'=>$c->id,'usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'vnd'=>$vnd,'desr'=>'','usd1'=>$usd1,'thb1'=>$thb1,'khr1'=>$khr1,'vnd1'=>$vnd1
            ]);
        }

        $allpartnerlists=AllPartnerList::where('viewby',Auth::user()->name)->orderBy('id')->get();
        $totalwe=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd) as tusd,sum(thb) as tbat,sum(khr) as tkhr,sum(vnd) as tvnd'))->first();
        $totalthey=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd1) as tusd1,sum(thb1) as tbat1,sum(khr1) as tkhr1,sum(vnd1) as tvnd1'))->first();
        $lasttotal=AllPartnerList::where('viewby',Auth::user()->name)->select(DB::raw('sum(usd+usd1) as usd,sum(thb+thb1) as thb,sum(khr+khr1) as khr,sum(vnd+vnd1) as vnd'))->first();

        return view('partnerlists.showalllistdetail',compact('allpartnerlists','totalwe','totalthey','lasttotal'));

    }

    public function notyetcashdraw1(Request $request)
  {
    //$viewby=Auth::user()->name;
    $d2= date('Y-m-d', strtotime($request->d2));
    $khr1=0;
    $usd1=0;
    $thb1=0;
    $vnd1=0;
    $selcomid=Session('log_into_company_id');
    $transfers=PartnerTransfer::select(DB::raw('sum(amount) as total,currency_id'))->where('company_id',$selcomid)
            ->where('status',1)->where('trancode',-1)->whereNull('iscashdraw')->whereDate('dd','<=',$d2)->groupBy('currency_id')->get();
    foreach($transfers as $t){
        if($t->currency->shortcut=='USD'){
            $usd1 =abs($t->total);
        }elseif($t->currency->shortcut=='THB'){
            $thb1 =abs($t->total);
        }elseif($t->currency->shortcut=='KHR'){
            $khr1 =abs($t->total);
        }elseif($t->currency->shortcut=='VND'){
            $vnd1 =abs($t->total);
        }
    }
    DB::table('all_partner_lists')->insert([
      'viewby'=>Auth::user()->name,'customer_id'=>0,'usd'=>0,'thb'=>0,'khr'=>0,'vnd'=>0,'desr'=>'លុយសល់មិនទាន់បើក','usd1'=>$usd1,'thb1'=>$thb1,'khr1'=>$khr1,'vnd1'=>$vnd1
  ]);

  }
}
