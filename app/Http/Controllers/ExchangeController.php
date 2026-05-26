<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use App\Cashdraw;
use App\Currency;
use App\Customer;
use App\Exchange;
use Carbon\Carbon;
use App\ProductRate;
use App\UserCapital;
use App\ExchangeMulti;
use App\PartnerAccount;
use App\Models\PageTime;
use App\PartnerTransfer;
//use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\CurrencyButton;
use Illuminate\Support\Facades\DB;
use App\Models\WingTransactionName;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerExchangeCapture;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    public function refreshdisplayrateinexchangeform()
    {
        $selcomid=Session('log_into_company_id');
        $curleft=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('company_id',$selcomid)->orderBy('no')->get();
        return view('exchanges.refreshexchangerate',compact('curleft'));

    }
   public function index()
   {
    $selcomid=Session('log_into_company_id');
    $current = Carbon::now();
    $current->timezone('Asia/Phnom_Penh');
    $dd = date("y-m-d",strtotime($current));
    $userid=Auth::user()->id;
    $exchangelists=ExchangeMulti::whereDate('dd',$dd)->where('user_id',$userid)->where('status',1)->where('isexchangelist',0)->whereNotNull('mapcode')->where('company_id',$selcomid)->orderBy('id')->get();
    $currencybuttons=CurrencyButton::where('company_id',$selcomid)->orderBy('no')->get();
    $mex=ExchangeMulti::whereNull('mapcode')->where('user_id',Auth::user()->id)->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
    $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))
                  ->whereNull('mapcode')->where('user_id',Auth::user()->id)->where('company_id',$selcomid)->where('status',1)
                  ->groupBy('curbuy')->get();
    $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))
               ->whereNull('mapcode')->where('user_id',Auth::user()->id)->where('company_id',$selcomid)->where('status',1)
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
      $banks=Customer::where('status',1)->whereIn('customertype',['BANK','PARTNER'])->orderBy('no')->get();
      //$partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','CUSTOMER'])->orderBy('no')->get();
      $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
      $authid=Auth::id();
      if(Auth::user()->role->name<>'Admin'){
        //   $allcurrencies=Currency::where('active',1)->where('ispandp',0)
        //   ->where(function($query) use ($authid){
        //     return $query->where('user_connect','not like','%,'. $authid .',%')->Orwhere('user_connect','not like','%,'. $authid )->Orwhere('user_connect','not like', $authid .',%')->orWhere('user_connect','not like',$authid );
        //   })
        //   ->orderBy('no')->get();

        //get all currency not find in user_connect
        $allcurrencies = Currency::where('active',1)->where('ispandp',0)->where('company_id',$selcomid)
            ->where(function ($query) use ($authid) {
                $query->whereNull('user_connect')
                    ->orWhereRaw("NOT FIND_IN_SET(?, user_connect)", [$authid]);
            })
            ->get();

      }else{
        $allcurrencies=Currency::where('active',1)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();

      }

      $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();
      //$trannames=WingTransactionName::orderBy('num')->get();
      //$users=User::where('active',1)->get();
      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      $curleft=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('company_id',$selcomid)->orderBy('no')->get();
      //dd($cashin);
      return view('exchanges.index',compact('mex','totalbuy','totalsale','cashin','cashout','banks','currencies','partners','allcurrencies','exchangelists','currencybuttons','users','curleft'));
   }
   public function savecurrencytostorage(){
    $selcomid=Session('log_into_company_id');
    if(Auth::user()->role->name<>'Admin'){
        // $allcurrencies=Currency::where('active',1)->where('ispandp',0)
        // ->where(function($query){
        //   return $query->where('user_connect','like','%,'. Auth::id() .',%')->Orwhere('user_connect','like','%,'. Auth::id() )->Orwhere('user_connect','like', Auth::id() .',%')->orWhere('user_connect',Auth::id() );
        // })
        // ->orderBy('no')->get();
        $authid=Auth::id();
        $allcurrencies = Currency::where('active',1)->where('ispandp',0)->where('company_id',$selcomid)
        ->where(function ($query) use ($authid) {
            $query->whereNull('user_connect')
                ->orWhereRaw("NOT FIND_IN_SET(?, user_connect)", [$authid]);
        })->orderBy('no')->get();
    }else{
      $allcurrencies=Currency::where('active',1)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();
    }
    return response()->json(['success'=>true,'currencies'=>$allcurrencies]);
   }
   public function savecurrencyproducttostorage(){
        $selcomid=Session('log_into_company_id');
        $productrates=ProductRate::where('company_id',$selcomid)->get();
        return response()->json(['success'=>true,'productrates'=>$productrates]);
   }
   public function getcurrencybykey(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $c=Currency::where('company_id',$selcomid)->where('skey','like','%'.$request->key.'%')->first();
      return response()->json(['c'=>$c]);
   }
   public function getcurrencybyshortcut(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $c=Currency::where('company_id',$selcomid)->where('shortcut',$request->key)->first();
      return response()->json(['c'=>$c]);
   }
   public function getcurrencybyshortcut2(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $c1=Currency::where('company_id',$selcomid)->where('shortcut',$request->shortcut1)->first();
      $c2=Currency::where('company_id',$selcomid)->where('shortcut',$request->shortcut2)->first();

      return response()->json(['c1'=>$c1,'c2'=>$c2]);
   }
   public function getcurrencybyid(Request $request)
   {
      $c=Currency::where('id',$request->key)->first();
      return response()->json(['c'=>$c]);
   }
   public function getuserpartner(Request $request){
    //$selcomid=Session('log_into_company_id');
    $customer=Customer::find($request->customer_id);
    if($customer){
      $arruser=explode(',',$customer->user_connect);
      $useraffect=User::whereIn('id',$arruser)->get();
    }else{
      $useraffect='';
    }
    $items=PartnerAccount::where('customer_id',$request->customer_id)->orderBy('item_id')->get()->load('item');
    return response()->json(['useraffect'=>$useraffect,'items'=> $items]);
   }

   public function getproductrate(Request $request)
   {
        $selcomid=Session('log_into_company_id');
      $pr=ProductRate::where('company_id',$selcomid)->where('pshortcut',$request->curname)->first();
      return response()->json(['pr'=>$pr,'success'=>'found exchange rate']);
   }
   public function savedepositgold(Request $request)
   {
        //return $request->all();
        $validator = Validator::make($request->all(), [
          'txtdeposit' => 'required', //input array validate
          'txtdeposit1' => 'required', //input array validate

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));

        $date = str_replace('/', '-', $request->deposit_date);
        $dd= date('Y-m-d', strtotime($date));
        $this->savecustomergoldlist1($request,$dd,$invtime,$request->txtex_group,$current);
        if($request->txtbalance=='0'){
            $processing=2;//mission complete
        }else{
            $processing=1;
        }
        DB::table('exchanges')->where('ref_group_id',$request->txtex_group)->update(['updated_at'=>$current,'processing'=>$processing]);
   }
   public function saveexchange(Request $request)
   {
        $selcomid=Session('log_into_company_id');
      //return $request->all();
    //   if($request->hasbankpayment=='1'){
    //      $validator3 = Validator::make($request->all(), [
    //          'bankid.*' => 'required', //input array validate
    //          'bankamt.*' => 'required', //input array validate
    //          'bankcur.*' => 'required', //input array validate
    //      ]);
    //  }
     $validator3 = Validator::make($request->all(), []);
     if($request->foundpartnerlist=='1'){

        $validator3 = Validator::make($request->all(), [
            'parrent_id.*' => 'required', //input array validate
            'listamt.*' => 'required', //input array validate
            'listcurid.*' => 'required',
            'listcuscharge.*' => 'required',
            'listcuschargecurid.*' => 'required',
            'listfee.*' => 'required',
            'listfeecurid.*' => 'required',
        ]);
    }
     $exnote='';
    //  if($request->haspartnerlist=='1'){
    //   $exnote='ចូលបញ្ជី ' . $request->partnername;
    //   $validator4 = Validator::make($request->all(), [
    //       'selpartner' => 'required', //input array validate
    //   ]);
    // }

     if($request->foundpartnerlist=='1'){
         if ($validator3->fails()) {
            return response()->json(['error'=>$validator3->errors()->all()]);
         }else{

            foreach ($request->partner_id as $key => $value) {
                $amt=$request->listamt[$key] . ' ' . $request->listcur[$key];
                $pname=$request->parrent_name[$key];
                if($exnote==''){
                    $exnote=$pname . '('. $amt . ')';
                }else{
                    $exnote .=$pname . '('. $amt . ')';
                }
            }

         }
      }
      // if($request->haspartnerlist=='1'){
      //    if ($validator4->fails()) {
      //       return response()->json(['error'=>$validator4->errors()->all()]);
      //    }
      // }
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $invtime = date("H:i:s",strtotime($current));
      $invtime1=date('H:i:s',strtotime($invtime . ' +1 seconds'));
      $date = str_replace('/', '-', $request->dd);
      $exchangedate= date('Y-m-d', strtotime($date));
      $e=new Exchange();
      $e->dd=$exchangedate;
      $e->tt=$invtime;
      $e->currency_id=$request->currency_id;
      $e->product=str_replace(',','',$request->product);
      $e->pcur=$request->pcur;
      $e->amount=str_replace(',','',$request->amount);
      $e->maincur=$request->maincur;
      $e->rate=str_replace(',','',$request->rate);
      $e->drate=str_replace(',','',$request->drate);
      $e->cashreceive=$request->cashreceive;
      $e->cashreturn=$request->cashreturn;
      $e->multiexchangecode='';
      $e->othercode='';
      if($request->status==1){
          $e->note=$exnote;
      }else{
        $e->note='Print Test';
      }
      $e->desr=$request->desr;
      $e->user_id=Auth::user()->id;
      $e->created_at=$current;
      $e->updated_at=$current;
      $e->company_id=$selcomid;
      $e->goldwater=$request->watergold;
      $e->processing=$request->isgold_deposit;
      $e->status=$request->status;
      if($request->isgold_deposit==1){
        $e->client=$request->client_name;
        $e->phone=$request->client_tel;
        $e->deposit=str_replace(',','',$request->txtdeposit);
        $e->deposit_via=$request->deposit_via;
        $e->bank_amount=$request->bank_amount;
        $e->cash_amount=$request->cash_amount;
      }
      if($e->save()){
         $id=$e->id;
         $refgroupid='exchange-' . $id;
         $em=new ExchangeMulti();
         $em->user_id=Auth::user()->id;
         $em->dd=$exchangedate;
         $em->tt=$invtime;
         $em->buy=str_replace(',','',$request->buy);
         $em->curbuy=$request->curbuy;
         $em->sale=str_replace(',','',$request->sale);
         $em->cursale=$request->cursale;
         $em->buyinfo='';
         $em->saleinfo='';
         $em->rate=str_replace(',','',$request->rate);
         $em->drate=str_replace(',','',$request->drate);
         $em->cashreceive=$request->cashreceive;
         $em->cashreturn=$request->cashreturn;
         $em->rateinfo='';
         $em->mapcode=$id;
         $em->ref_group_id=$refgroupid;
         $em->action='d';
         $em->note=$exnote . ' ' . $request->desr;
         $em->created_at=$current;
         $em->updated_at=$current;
         $em->company_id=$selcomid;
         $em->goldwater=$request->watergold;
         $em->status=$request->status;
         if($request->isgold_deposit==1){
            $em->client=$request->client_name;
            $em->phone=$request->client_tel;
            $em->deposit=str_replace(',','',$request->txtdeposit);
            $em->deposit_via=$request->deposit_via;
            $em->bank_amount=$request->bank_amount;
            $em->cash_amount=$request->cash_amount;
        }
         if($em->save()){
           //$idm=$em->id;
         }
         $foundgroup=0;
         DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id,'ref_group_id'=>$refgroupid]);
        //  if($request->haspartnerlist==1){
        //     $foundgroup=1;
        //     $this->exchangeentrylist($request,$exchangedate,$invtime1,'exchange-' . $id,$current);
        //  }else{
        //     if($request->hasbankpayment==1){
        //       $foundgroup=1;
        //        $this->customerpayexchangebybank($request,$exchangedate,$invtime1,'exchange-' . $id,$current);
        //    }
        //  }
         if($request->status==1){
            if($request->foundpartnerlist==1){
                $foundgroup=1;
                $this->customerpayexchangebypartner($request,$exchangedate,$invtime1,$refgroupid,$current);
            }
            if($request->isgold_deposit==1){
                 $this->savecustomergoldlist($request,$exchangedate,$invtime1,$refgroupid,$current,$request->amount,$request->luy_id,$request->exsign);
            }
         }
         if($foundgroup==1){
            //DB::table('exchange_multis')->where('id',$idm)->update(['action'=>'']);
         }
         return response()->json(['success'=>'save completed','id'=>$id]);
      }else{
         return response()->json(['error'=>'save error']);
      }

   }
   public function saveexchangeproduct(Request $r)
   {
      //return $r->all();
    //   if($r->hasbankpayment=='1'){
    //      $validator3 = Validator::make($r->all(), [
    //          'bankid.*' => 'required', //input array validate
    //          'bankamt.*' => 'required', //input array validate
    //          'bankcur.*' => 'required', //input array validate

    //      ]);
    //  }
    //  if($r->hasbankpayment=='1'){
    //      if ($validator3->fails()) {
    //         return response()->json(['error'=>$validator3->errors()->all()]);
    //      }
    //   }
    //   if($r->haspartnerlist=='1'){
    //      $validator4 = Validator::make($r->all(), [
    //          'selpartner' => 'required', //input array validate
    //      ]);
    //  }
    $selcomid=Session('log_into_company_id');
    $validator3 = Validator::make($r->all(), []);
    if($r->foundpartnerlist=='1'){
        $validator3 = Validator::make($r->all(), [
            'parrent_id.*' => 'required', //input array validate
            'listamt.*' => 'required', //input array validate
            'listcurid.*' => 'required',
            'listcuscharge.*' => 'required',
            'listcuschargecurid.*' => 'required',
            'listfee.*' => 'required',
            'listfeecurid.*' => 'required',
        ]);
    }
     $exnote='';
    //  if($r->haspartnerlist=='1'){
    //      $exnote='ចូលបញ្ជី ' . $r->partnername;
    //      if ($validator4->fails()) {
    //         return response()->json(['error'=>$validator4->errors()->all()]);
    //      }
    //   }
    if($r->foundpartnerlist=='1'){
        if ($validator3->fails()) {
           return response()->json(['error'=>$validator3->errors()->all()]);
        }else{
            foreach ($r->partner_id as $key => $value) {
                $amt=$r->listamt[$key] . ' ' . $r->listcur[$key];
                $pname=$r->parrent_name[$key];
                if($exnote==''){
                    $exnote=$pname . '('. $amt . ')';
                }else{
                    $exnote .=$pname . '('. $amt . ')';
                }
            }
        }
     }
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $invtime = date("H:i:s",strtotime($current));
      $invtime1=date('H:i:s',strtotime($invtime . ' +1 seconds'));
      $date = str_replace('/', '-', $r->dd);
      $exchangedate= date('Y-m-d', strtotime($date));
      if ($r->exsign == "+")
      {
          $rate_buy = $r->rate1buy;
          $luy =number_format((floatval(str_replace(',','',$r->item1)) / floatval(str_replace(',','',$rate_buy))),4);

            $e1 = new Exchange();
            $e1->dd=$exchangedate;
            $e1->tt=$invtime;
            $e1->currency_id=$r->curid1;
            $e1->product=str_replace(',','',$r->item1);
            $e1->pcur=$r->pcur1;
            $e1->amount=-1 * floatval(str_replace(',','',$luy));
            $e1->maincur='USD';
            $e1->rate=str_replace(',','',$rate_buy);
            $e1->drate=str_replace(',','',$rate_buy);
            $e1->cashreceive=$r->cashreceive;
            $e1->cashreturn=$r->cashreturn;
            $e1->multiexchangecode='';
            $e1->othercode='';
            $e1->desr=$r->desr;
            if($r->status==1){
                $e1->note=$exnote;
            }else{
                $e1->note='Print Test';
            }

            $e1->user_id=Auth::user()->id;
            $e1->created_at=$current;
            $e1->updated_at=$current;
            $e1->company_id=$selcomid;
            $e1->status=$r->status;
            $e1->save();
            $id=$e1->id;
            $refgroupid='exchange-' . $id;
            $rate_sale =number_format((floatval(str_replace(',','',$r->item2)) / floatval(str_replace(',','',$luy))),4);
            $e2 = new Exchange();
            $e2->dd=$exchangedate;
            $e2->tt=$invtime;
            $e2->currency_id=$r->curid2;
            $e2->product=-1 * floatval(str_replace(',','',$r->item2));
            $e2->pcur=$r->pcur2;
            $e2->amount=str_replace(',','',$luy);
            $e2->maincur='USD';
            $e2->rate=str_replace(',','',$rate_sale);
            $e2->drate=str_replace(',','',$rate_sale);
            $e2->cashreceive=$r->cashreceive;
            $e2->cashreturn=$r->cashreturn;
            $e2->multiexchangecode=$id;
            $e2->othercode='';
            $e2->ref_group_id=$refgroupid;
            if($r->status==1){
                $e2->note=$exnote;
            }else{
                $e2->note='Print Test';
            }
            $e2->desr=$r->desr;
            $e2->user_id=Auth::user()->id;
            $e2->product_first_id=$id;
            $e2->created_at=$current;
            $e2->updated_at=$current;
            $e2->company_id=$selcomid;
            $e2->status=$r->status;
            $e2->save();
            $em=new ExchangeMulti();
            $em->user_id=Auth::user()->id;
            $em->dd=$exchangedate;
            $em->tt=$invtime;
            $em->buy=str_replace(',','',$r->buy);
            $em->curbuy=$r->curbuy;
            $em->sale=str_replace(',','',$r->sale);
            $em->cursale=$r->cursale;
            $em->buyinfo='';
            $em->saleinfo='';
            $em->rate=str_replace(',','',$r->rate);
            $em->drate=str_replace(',','',$r->drate);
            $em->cashreceive=$r->cashreceive;
            $em->cashreturn=$r->cashreturn;
            $em->rateinfo='';
            $em->mapcode=$id;
            $em->ref_group_id=$refgroupid;
            $em->action='d';
            $em->note=$exnote;
            $em->created_at=$current;
            $em->updated_at=$current;
            $em->company_id=$selcomid;
            $em->status=$r->status;
            if($em->save()){
              //$idm=$em->id;
            }
            $foundgroup=0;
            DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id,'ref_group_id'=>$refgroupid,'product_first_id'=>$id]);
            // if($r->haspartnerlist==1){
            //   $foundgroup=1;
            //    $this->exchangeentrylist($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
            // }else{
            //    if($r->hasbankpayment==1){
            //       $foundgroup=1;
            //       $this->customerpayexchangebybank($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
            //   }
            // }
            if($r->status==1){
                if($r->foundpartnerlist==1){
                    $foundgroup=1;
                    $this->customerpayexchangebypartner($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
                 }
            }
            if($foundgroup==1){
              //DB::table('exchange_multis')->where('id',$idm)->update(['action'=>'']);
           }
            return response()->json(['success'=>'Save Success','id'=>$id]);
      }

      else
      {
            $rate_buy = $r->rate2buy;
            $luy =number_format((floatval(str_replace(',','',$r->item2)) / floatval(str_replace(',','',$rate_buy))),4);
            $e1 = new Exchange();
            $e1->dd=$exchangedate;
            $e1->tt=$invtime;
            $e1->currency_id=$r->curid2;
            $e1->product=str_replace(',','',$r->item2);
            $e1->pcur=$r->pcur2;
            $e1->amount=-1 * floatval(str_replace(',','',$luy));
            $e1->maincur='USD';
            $e1->rate=str_replace(',','',$rate_buy);
            $e1->drate=str_replace(',','',$rate_buy);
            $e1->cashreceive=$r->cashreceive;
            $e1->cashreturn=$r->cashreturn;
            $e1->multiexchangecode='';
            $e1->othercode='';
            $e1->note=$exnote;
            $e1->desr=$r->desr;
            $e1->user_id=Auth::user()->id;
            $e1->created_at=$current;
            $e1->updated_at=$current;
            $e1->company_id=$selcomid;
            $e1->status=$r->status;
            $e1->save();
            $id=$e1->id;

            $rate_sale =number_format((floatval(str_replace(',','',$r->item1)) / floatval(str_replace(',','',$luy))),4);
            $e2 = new Exchange();
            $e2->dd=$exchangedate;
            $e2->tt=$invtime;
            $e2->currency_id=$r->curid1;
            $e2->product=-1 * floatval(str_replace(',','',$r->item1));
            $e2->pcur=$r->pcur1;
            $e2->amount=str_replace(',','',$luy);
            $e2->maincur='USD';
            $e2->rate=str_replace(',','',$rate_sale);
            $e2->drate=str_replace(',','',$rate_sale);
            $e2->cashreceive=$r->cashreceive;
            $e2->cashreturn=$r->cashreturn;
            $e2->multiexchangecode=$id;
            $e2->othercode='';
            $e2->note=$exnote;
            $e2->desr=$r->desr;
            $e2->user_id=Auth::user()->id;
            $e2->created_at=$current;
            $e2->updated_at=$current;
            $e2->company_id=$selcomid;
            $e2->status=$r->status;
            $e2->save();
            $em=new ExchangeMulti();
            $em->user_id=Auth::user()->id;
            $em->dd=$exchangedate;
            $em->tt=$invtime;
            $em->buy=str_replace(',','',$r->buy);
            $em->curbuy=$r->curbuy;
            $em->sale=str_replace(',','',$r->sale);
            $em->cursale=$r->cursale;
            $em->buyinfo='';
            $em->saleinfo='';
            $em->rate=str_replace(',','',$r->rate);
            $em->drate=str_replace(',','',$r->drate);
            $em->cashreceive=$r->cashreceive;
            $em->cashreturn=$r->cashreturn;
            $em->rateinfo='';
            $em->mapcode=$id;
            $em->action='d';
            $em->note=$exnote;
            $em->company_id=$selcomid;
            $em->created_at=$current;
            $em->updated_at=$current;
            $em->status=$r->status;
            if($em->save())
            {
              //$idm=$em->id;
            }
            $foundgroup=0;
            DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
            // if($r->haspartnerlist==1){
            //     $foundgroup=1;
            //    $this->exchangeentrylist($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
            // }else{
            //    if($r->hasbankpayment==1){
            //     $foundgroup=1;
            //       $this->customerpayexchangebybank($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
            //   }
            // }
            if($r->status==1){
                if($r->foundpartnerlist==1){
                    $foundgroup=1;
                    $this->customerpayexchangebypartner($r,$exchangedate,$invtime1,'exchange-' . $id,$current);
                 }
            }
            if($foundgroup==1){
              //DB::table('exchange_multis')->where('id',$idm)->update(['action'=>'']);
           }
            return response()->json(['success'=>'Save Success','id'=>$id]);
      }

   }
   public function exchangeentrylist(Request $request,$trdate,$trtime,$ref_number,$current)
   {
      $selcomid=Session('log_into_company_id');
      $trtime1=date('H:i:s',strtotime($trtime . ' +1 seconds'));
      $tranname='ប្តូរប្រាក់ចូលបញ្ជី';
      $ptf=new PartnerTransfer();
      $ptf->tranname=$tranname;
      $ptf->trancode=$request->trancode;
      $ptf->dd=$trdate;
      $ptf->tt=$trtime;
      $ptf->mekun=$request->trancode;
      $ptf->user_id=Auth::id();
      $ptf->parrent_id=$request->selpartner;
      $ptf->amount=floatval($request->trancode) * floatval(str_replace(',','',$request->amtlist));
      $ptf->currency_id=$request->curlist;
      // if($request->trancode==1){
      //   $isshow=1;
      // }else{
      //   $isshow=0;
      // }
        $isshow=1;
        $ptf->cuscharge=0;
        $ptf->cuscharge_currency_id=$request->curlist;
        $ptf->fee=0;
        $ptf->bonus=0;
        $ptf->sendername=$request->partnername;
        $ptf->sendertel='';
        $ptf->recname=$request->desr;
        $ptf->rectel='';
        $ptf->note=$request->notelist;
        $ptf->ref_number=$ref_number;
        $ptf->action='';
        $ptf->isshow=$isshow;
        $ptf->ref_group_id=$ref_number;
        $ptf->company_id=$selcomid;
        $ptf->created_at=$current;
        $ptf->updated_at=$current;
        if($ptf->save()){
            $tanferid=$ptf->id;
            $parrent_id=$ptf->parrent_id;
            $partnername=$ptf->partner->name;
            if($request->trancode==-1){//ចូលបញ្ជីគេខ្វះ = ទទួលលុយដូររួចបើកវេរវិញ
              $cashdraw=new Cashdraw();
              $cashdraw->transfer_id=$tanferid;
              $cashdraw->from_partner_id=$parrent_id;
              $cashdraw->opdate=$trdate;
              $cashdraw->optime=$trtime;
              $cashdraw->user_id=Auth::id();
              $cashdraw->amount= str_replace(',','',$request->amtlist);
              $cashdraw->currency_id=$request->curlist;
              $cashdraw->customer_charge=0;
              $cashdraw->paymethod='Cash';
              $cashdraw->receive_tel='';
              $cashdraw->receive_name='';
              $cashdraw->note='ប្តូរប្រាក់ចូលបញ្ជីគេខ្វះយើង​';
              $cashdraw->other= $partnername.'ប្តូរប្រាក់ជំពាក់';
              $cashdraw->ref_number='transfer-'. $tanferid;
              $cashdraw->ref_group_id=$ref_number;
              $cashdraw->company_id=$selcomid;
              $cashdraw->created_at=$current;
              $cashdraw->updated_at=$current;
              if($cashdraw->save()){
                  $cashdrawid=$cashdraw->id;
                  DB::table('partner_transfers')->where('id',$tanferid)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
              }
          }
            if($request->payincash>0){
               $note='';
               $ptf1=new PartnerTransfer();
               if($request->trancode=='1'){
                  $ptf1->tranname='ដកលុយស្រស់';
                  $isshow=0;
                  $note='ដកលុយស្រស់អោយ'.$request->partnername;
               }else{
                  $isshow=1;
                   $ptf1->tranname='ទទួលលុយស្រស់';
                   $note='ទទួលលុយស្រស់ពី'.$request->partnername;
               }
               $ptf1->trancode=-1 * floatval($request->trancode);
               $ptf1->dd=$trdate;
               $ptf1->mekun=-1 * floatval($request->trancode);
               $ptf1->tt=$trtime1;
               $ptf1->user_id=Auth::id();
               $ptf1->parrent_id=$request->selpartner;
               $ptf1->amount=-1 * floatval($request->trancode) * floatval(str_replace(',','',$request->payincash));
               $ptf1->currency_id=$request->curlist;
               $ptf1->cuscharge=0;
               $ptf1->cuscharge_currency_id=$request->curlist;
               $ptf1->fee=0;
               $ptf1->bonus=0;
               $ptf1->sendername='';
               $ptf1->sendertel='';
               $ptf1->recname='';
               $ptf1->rectel='';
               $ptf1->note=$note;
               $ptf1->isshow=$isshow;
               $ptf1->from_partner_id=$parrent_id;
               $ptf1->ref_group_id=$ref_number;
               $ptf1->company_id=$selcomid;
               $ptf1->created_at=$current;
               $ptf1->updated_at=$current;
               //$ptf1->ref_number='transfer-'.$tanferid;
               if($ptf1->save()){
                   if($request->trancode=='1'){
                      $ptf1_id=$ptf1->id;
                      $partnername=$ptf1->partner->name;
                      $cashdraw=new Cashdraw();
                      $cashdraw->transfer_id=$ptf1_id;
                      $cashdraw->from_partner_id=$request->selpartner;
                      $cashdraw->opdate=$trdate;
                      $cashdraw->optime=$trtime1;
                      $cashdraw->user_id=Auth::id();
                      $cashdraw->amount= str_replace(',','',$request->payincash);
                      $cashdraw->currency_id=$request->curlist;
                      $cashdraw->customer_charge=0;
                      $cashdraw->paymethod='Cash';
                      $cashdraw->receive_tel='';
                      $cashdraw->receive_name='';
                      $cashdraw->note=$request->notelist;
                      $cashdraw->other='ដកលុយស្រស់អោយ '. $partnername;
                      $cashdraw->ref_number='transfer-'. $ptf1_id;
                      $cashdraw->ref_group_id=$ref_number;
                      $cashdraw->created_at=$current;
                      $cashdraw->updated_at=$current;
                      $cashdraw->company_id=$selcomid;
                      if($cashdraw->save()){
                          $cashdrawid=$cashdraw->id;
                          DB::table('partner_transfers')->where('id',$ptf1_id)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                      }
                   }
               }
            }
            if($request->hasbankpayment==1){
                $note='';
               foreach ($request->bankid as $key => $value) {
                  $ptf2=new PartnerTransfer();
                  if($request->banksign=='1'){
                     $ptf2->tranname='បាញ់ចេញ';
                     $note='ទូទាត់អោយ '. $request->partnername . ' តាម ' . $request->bankname[$key];
                  }else{
                      $ptf2->tranname='បាញ់ចូល';
                      $note='ទទួលពី '. $request->partnername . ' តាម ' . $request->bankname[$key];
                  }
                  //$ptf2->trancode=4 * floatval($request->banksign);
                  $ptf2->trancode=$request->banksign;

                  $ptf2->dd=$trdate;
                  $ptf2->mekun= floatval($request->banksign);
                  $ptf2->tt=$trtime1;
                  $ptf2->user_id=Auth::id();
                  $ptf2->parrent_id=$value;
                  $ptf2->amount=floatval($request->banksign) * floatval(str_replace(',','',$request->bankamt[$key]));
                  $ptf2->currency_id=$request->bankcur[$key];
                  $ptf2->cuscharge=0;
                  $ptf2->cuscharge_currency_id=$request->bankcur[$key];
                  $ptf2->fee=0;
                  $ptf2->bonus=0;
                  $ptf2->sendername='';
                  $ptf2->sendertel='';
                  $ptf2->recname='';
                  $ptf2->rectel='';
                  $ptf2->note=$note;
                  $ptf2->ref_number='';
                  $ptf2->ref_group_id=$ref_number;
                  $ptf2->created_at=$current;
                  $ptf2->updated_at=$current;
                  $ptf2->company_id=$selcomid;
                  if($ptf2->save()){
                        // $trname3='';
                        // $note='';
                        //  $id2=$ptf2->id;
                        //  $bankid=$ptf2->parrent_id;
                        //  $bankname=$ptf2->partner->name;
                        //  $ptf3=new PartnerTransfer();
                        //  if($request->banksign=='1'){
                        //     $trname3='ដៃគូដក';
                        //     $note=$request->partnername.'ដកពីធនាគា' . $bankname;
                        //  }else{
                        //     $trname3='ដៃគូដាក់ចូល';
                        //     $note=$request->partnername.'ដាក់ចូលធនាគា' . $bankname;
                        //  }
                        //  $ptf3->tranname=$trname3;
                        //  $ptf3->trancode=-4 * floatval($request->banksign);
                        //  $ptf3->dd=$trdate;
                        //  $ptf3->mekun=-1 * floatval($request->banksign);
                        //  $ptf3->tt=$trtime;
                        //  $ptf3->user_id=Auth::id();
                        //  $ptf3->parrent_id=$request->selpartner;
                        //  $ptf3->amount=-1 * floatval($request->banksign) * floatval(str_replace(',','',$request->bankamt[$key]));
                        //  $ptf3->currency_id=$request->bankcur[$key];
                        //  $ptf3->cuscharge=0;
                        //  $ptf3->cuscharge_currency_id=$request->bankcur[$key];
                        //  $ptf3->fee=0;
                        //  $ptf3->bonus=0;
                        //  $ptf3->sendername='';
                        //  $ptf3->sendertel='';
                        //  $ptf3->recname='';
                        //  $ptf3->rectel='';
                        //  $ptf3->note=$note;
                        //  $ptf3->isshow=0;
                        //  $ptf3->ref_number='transfer-' . $id2;
                        //  $ptf3->ref_group_id=$ref_number;
                        //  $ptf3->from_partner_id=$bankid;
                        //  $ptf3->created_at=$current;
                        //  $ptf3->updated_at=$current;
                        //  if($ptf3->save()){
                        //     $id3=$ptf3->id;
                        //     DB::table('partner_transfers')->where('id',$id2)->update(['ref_number'=>'transfer-'.$id3]);
                        //  }

                        //if exchange and transfer to bank mean cash out from user to bank
                        if($request->banksign==-1){
                           $id2=$ptf2->id;
                           $partnername=$ptf2->partner->name;
                           $cashdraw=new Cashdraw();
                           $cashdraw->transfer_id=$id2;
                           $cashdraw->from_partner_id=$request->bankid[$key];
                           $cashdraw->opdate=$trdate;
                           $cashdraw->optime=$trtime1;
                           $cashdraw->user_id=Auth::id();
                           $cashdraw->amount=floatval(str_replace(',','',$request->bankamt[$key]));
                           $cashdraw->currency_id=$request->bankcur[$key];
                           $cashdraw->customer_charge=0;
                           $cashdraw->paymethod='Bank';
                           $cashdraw->receive_tel='';
                           $cashdraw->receive_name='';
                           $cashdraw->note=$request->notelist;
                           $cashdraw->other='បាញ់ចូល '. $partnername;
                           $cashdraw->ref_number='transfer-'. $id2;
                           $cashdraw->ref_group_id=$ref_number;
                           $cashdraw->created_at=$current;
                           $cashdraw->updated_at=$current;
                           $cashdraw->company_id=$selcomid;
                           if($cashdraw->save()){
                               $cashdrawid=$cashdraw->id;
                               DB::table('partner_transfers')->where('id',$id2)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                           }
                        }

                    }
                }
              }
            }

   }

   public function customerpayexchangebybank(Request $request,$trdate,$trtime,$ref_number,$current)
   {
      $note='';
      $amt=0;
      $selcomid=Session('log_into_company_id');
       foreach ($request->bankid as $key => $value) {
          $amt=floatval(str_replace(',','',$request->bankamt[$key]));

           $ptf=new PartnerTransfer();
           if($request->banksign=='1'){
              if($amt>0){
                $ptf->tranname='បាញ់ចេញ';
                $note='បាញ់ចេញពី' . $request->bankname[$key];
              }else{
                $ptf->tranname='បាញ់ចូល';
                $note='បាញ់ចូលពី' . $request->bankname[$key];
              }

           }else{
              if($amt>0){
                $ptf->tranname='បាញ់ចូល';
                $note='បាញ់ចូលពី' . $request->bankname[$key];
              }else{
                $ptf->tranname='បាញ់ចេញ';
                $note='បាញ់ចេញពី' . $request->bankname[$key];
              }
           }
           $ptf->trancode=$request->banksign;
           $ptf->dd=$trdate;
           $ptf->mekun=$request->banksign;
           $ptf->tt=$trtime;
           $ptf->user_id=Auth::id();
           $ptf->parrent_id=$value;
           $ptf->amount=floatval($request->banksign) * floatval(str_replace(',','',$request->bankamt[$key]));
           $ptf->currency_id=$request->bankcur[$key];
           $ptf->cuscharge=0;
           $ptf->cuscharge_currency_id=$request->bankcur[$key];
           $ptf->fee=0;
           $ptf->bonus=0;
           $ptf->sendername=$request->sendername;
           $ptf->sendertel=str_replace(' ','',$request->sendertel);
           $ptf->recname=$request->desr;
           $ptf->rectel=str_replace(' ','',$request->rectel);
           $ptf->note=$note;
           $ptf->ref_number=$ref_number;
           $ptf->ref_group_id=$ref_number;
           $ptf->created_at=$current;
           $ptf->updated_at=$current;
           $ptf->company_id=$selcomid;
           if($ptf->save()){
               if($request->banksign=='-1'){
                  $id=$ptf->id;
                  $bankname=$ptf->partner->name;
                  $cashdraw=new Cashdraw();
                  $cashdraw->transfer_id=$id;
                  $cashdraw->from_partner_id=$value;
                  $cashdraw->opdate=$trdate;
                  $cashdraw->optime=$trtime;
                  $cashdraw->user_id=Auth::id();
                  $cashdraw->amount= str_replace(',','',$request->bankamt[$key]);
                  $cashdraw->currency_id=$request->bankcur[$key];
                  $cashdraw->customer_charge=0;
                  $cashdraw->paymethod='Cash';
                  $cashdraw->receive_tel=str_replace(' ','',$request->rectel);
                  $cashdraw->receive_name=$request->recname;
                  $cashdraw->note=$request->note;
                  $cashdraw->other='ប្តូរប្រាក់បាញ់ចូលធនាគា ' . $bankname;
                  $cashdraw->ref_number=$ref_number;
                  $cashdraw->ref_group_id=$ref_number;
                  $cashdraw->created_at=$current;
                  $cashdraw->updated_at=$current;
                  $cashdraw->company_id=$selcomid;
                  if($cashdraw->save()){
                      $cashdrawid=$cashdraw->id;
                      DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                  }
               }
           }
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
   public function customerpayexchangebypartner(Request $request,$trdate,$trtime,$ref_number,$current)
   {
        $note='';
        $amt=0;
        $selcomid=Session('log_into_company_id');
       foreach ($request->partner_id as $key => $value) {
            $customer=Customer::find($value);
            $amt=abs(floatval(str_replace(',','',$request->listamt[$key])));
           $ptf=new PartnerTransfer();
           if($request->transign[$key]=='1'){
              if($amt>0){
                $ptf->tranname='បាញ់ចេញ';
                $note='បាញ់ចេញពី' . $request->parrent_name[$key];
              }else{
                $ptf->tranname='បាញ់ចូល';
                $note='បាញ់ចូលពី' . $request->parrent_name[$key];
              }

           }else{
              if($amt>0){
                $ptf->tranname='បាញ់ចូល';
                $note='បាញ់ចូលពី' . $request->parrent_name[$key];
              }else{
                $ptf->tranname='បាញ់ចេញ';
                $note='បាញ់ចេញពី' . $request->parrent_name[$key];
              }
           }

            if($customer->customertype=='AGENT' || $customer->customertype=='BANK'){
                $ptf->isbank=1;
                $useraffect=$this->getuseraffectbank($value);
                $ptf->user_affect=$useraffect;
            }
           $ptf->trancode=$request->transign[$key];
           $ptf->dd=$trdate;
           $ptf->mekun=$request->transign[$key];
           $ptf->tt=$trtime;
           $ptf->user_id=Auth::id();
           $ptf->parrent_id=$value;
           $ptf->amount=floatval($request->transign[$key]) * floatval($amt);
           $ptf->currency_id=$request->listcurid[$key];
           $ptf->cuscharge=str_replace(',','',$request->listcuscharge[$key]);
           $ptf->cuscharge_currency_id=$request->listcuschargecurid[$key];
           $ptf->fee=floatval($request->transign[$key]) * floatval(str_replace(',','',$request->listfee[$key]));
           $ptf->fee_currency_id=$request->listfeecurid[$key];
           $ptf->bonus=0;
           $ptf->sendername=$request->listsendname[$key];;
           $ptf->sendertel=$request->listsendtel[$key];
           $ptf->recname=$request->listrecname[$key];
           $ptf->rectel=$request->listrectel[$key];
           $ptf->note=$note;
           $ptf->ref_number=$ref_number;
           $ptf->ref_group_id=$ref_number;
           $ptf->created_at=$current;
           $ptf->updated_at=$current;
           $ptf->company_id=$selcomid;
           $ptf->thai_list=$request->thai_list[$key];
           if($request->transign[$key]=='-1'){
               $ptf->iscashdraw=1;
           }

           $ptf->iscutwater=$request->ck_water;
           if($ptf->save()){
               $id=$ptf->id;
               if($request->transign[$key]=='-1'){
                  $bankname=$ptf->partner->name;
                  $cashdraw=new Cashdraw();
                  $cashdraw->transfer_id=$id;
                  $cashdraw->from_partner_id=$value;
                  $cashdraw->opdate=$trdate;
                  $cashdraw->optime=$trtime;
                  $cashdraw->user_id=Auth::id();
                  $cashdraw->amount= $amt;
                  $cashdraw->currency_id=$request->listcurid[$key];
                  $cashdraw->customer_charge=0;
                  $cashdraw->paymethod='Cash';
                  $cashdraw->receive_tel=str_replace(' ','',$request->listrectel[$key]);
                  $cashdraw->receive_name=$request->listrecname[$key];
                  $cashdraw->note=$request->note;
                  $cashdraw->other='ប្តូរប្រាក់បាញ់ចូលបញ្ជី ' . $bankname;
                  $cashdraw->ref_number=$ref_number;
                  $cashdraw->ref_group_id=$ref_number;
                  $cashdraw->created_at=$current;
                  $cashdraw->updated_at=$current;
                  $cashdraw->company_id=$selcomid;
                  if($cashdraw->save()){
                      $cashdrawid=$cashdraw->id;
                      DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                  }
               }
           }
       }
   }
    public function savecustomergoldlist(Request $request,$trdate,$trtime,$ref_number,$current,$amount,$luy_id,$exsign)
   {
        $selcomid=Session('log_into_company_id');
        $ptf = new PartnerTransfer();
        $ptf->company_id=$selcomid;
        if($exsign=='+'){//ទិញមាសចូល
            $foundcashdraw=0;
            $ptf->tranname='ទិញមាស';
            $ptf->trancode=1;
            $ptf->mekun=1;
            $ptf->amount=abs(str_replace(',','',$amount));

        }else{
            $foundcashdraw=1;
            $ptf->tranname='លក់មាស';
            $ptf->trancode=-1;
            $ptf->mekun=-1;
            $ptf->amount=-1 * abs(floatval(str_replace(',','',$amount)));
        }
        $ptf->dd=$trdate;
        $ptf->tt=$trtime;
        $ptf->user_id=Auth::id();
        $ptf->parrent_id=$request->selcustomergold;

        $ptf->currency_id=$luy_id;
        $ptf->iscutwater=0;
        $ptf->cuscharge=0;
        $ptf->cuscharge_currency_id=$luy_id;
        $ptf->cuscharge_ex=0;


        $ptf->fee=0;
        $ptf->interest=0;
        $ptf->fee_currency_id=$luy_id;
        $ptf->fee_ex=0;

        $ptf->bonus=0;
        $ptf->sendername='';
        $ptf->sendertel='';
        $ptf->recname=$request->client_name;
        $ptf->rectel=str_replace(' ','',$request->client_tel);

        $ptf->ref_group_id=$ref_number;
        $ptf->ref_number=$ref_number;

        $ptf->created_at=$current;
        $ptf->updated_at=$current;
        $ptf->location_id=1;

        if($ptf->save()){
            $id=$ptf->id;
             if($foundcashdraw==1){
                    $cashdraw=new Cashdraw();
                    $cashdraw->transfer_id=$id;
                    $cashdraw->from_partner_id=$request->selcustomergold;
                    $cashdraw->opdate=$trdate;
                    $cashdraw->optime=$trtime;
                    $cashdraw->user_id=Auth::id();
                    $cashdraw->amount= abs(floatval(str_replace(',','',$amount)));
                    $cashdraw->currency_id=$luy_id;
                    $cashdraw->customer_charge=0;
                    $cashdraw->paymethod='Cash';
                    $cashdraw->receive_tel=str_replace(' ','',$request->client_tel);
                    $cashdraw->receive_name=$request->client_name;
                    $cashdraw->note='កក់មាស';
                    $cashdraw->other='';
                    $cashdraw->ref_number=$ref_number;
                    $cashdraw->ref_group_id=$ref_number;
                    $cashdraw->created_at=$current;
                    $cashdraw->updated_at=$current;
                    $cashdraw->company_id=$selcomid;
                    if($cashdraw->save()){
                        $cashdrawid=$cashdraw->id;
                        DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                    }
                }
            if (!empty($request->selbankdeposit) && $request->selbankdeposit>0) {
                // user selected bank
                $ptf2 = new PartnerTransfer();
                $ptf2->company_id=$selcomid;
                if($exsign=='+'){
                    $ptf2->tranname='បាញ់ចេញ';
                    $ptf2->trancode=4;
                    $ptf2->mekun=1;
                    $ptf2->amount=str_replace(',','',$request->txtdeposit1);
                }else{
                    $ptf2->tranname='បាញ់ចូល';
                    $ptf2->trancode=-4;
                    $ptf2->mekun=-1;
                    $ptf2->amount=-1 * floatval(str_replace(',','',$request->txtdeposit1));
                }
                $ptf2->dd=$trdate;
                $ptf2->tt=$trtime;
                $ptf2->user_id=Auth::id();
                $ptf2->parrent_id=$request->selbankdeposit;

                $ptf2->currency_id=$luy_id;
                $ptf2->iscutwater=0;
                $ptf2->cuscharge=0;
                $ptf2->cuscharge_currency_id=$luy_id;
                $ptf2->cuscharge_ex=0;
                $ptf2->fee=0;
                $ptf2->interest=0;
                $ptf2->fee_currency_id=$luy_id;
                $ptf2->fee_ex=0;
                $ptf2->bonus=0;
                $ptf2->sendername='';
                $ptf2->sendertel='';
                $ptf2->recname='';
                $ptf2->rectel='';
                $ptf2->ref_group_id=$ref_number;
                $ptf2->ref_number=$ref_number;
                $ptf2->note='កក់មាស';
                $ptf2->created_at=$current;
                $ptf2->updated_at=$current;
                $ptf2->location_id=1;
                if($request->customertype_deposit=='AGENT' || $request->customertype_deposit=='BANK'){
                    $ptf2->user_affect=$this->getuseraffectbank($request->selbankdeposit);
                }
                $ptf2->save();
                //លុយកក់របស់អតិថិជន
                $ptf = new PartnerTransfer();
                $ptf->company_id=$selcomid;
                if($exsign=='+'){
                    $ptf->tranname='ទទួល';
                    $ptf->trancode=-4;
                    $ptf->mekun=-1;
                    $ptf->amount=-1 * floatval(str_replace(',','',$request->txtdeposit1));
                }else{
                    $ptf->tranname='ផ្ញើ';
                    $ptf->trancode=4;
                    $ptf->mekun=1;
                    $ptf->amount=str_replace(',','',$request->txtdeposit1);
                }
                $ptf->dd=$trdate;
                $ptf->tt=$trtime;
                $ptf->user_id=Auth::id();
                $ptf->parrent_id=$request->selcustomergold;

                $ptf->currency_id=$luy_id;
                $ptf->iscutwater=0;
                $ptf->cuscharge=0;
                $ptf->cuscharge_currency_id=$luy_id;
                $ptf->cuscharge_ex=0;
                $ptf->fee=0;
                $ptf->interest=0;
                $ptf->fee_currency_id=$luy_id;
                $ptf->fee_ex=0;
                $ptf->bonus=0;
                $ptf->sendername='';
                $ptf->sendertel='';
                $ptf->recname=$request->client_name;
                $ptf->rectel=str_replace(' ','',$request->client_tel);
                $ptf->ref_group_id=$ref_number;
                $ptf->ref_number=$ref_number;
                $ptf->note='កក់មាស';
                $ptf->deposit=str_replace(',','',$request->txtdeposit1);
                $ptf->deposit_via=$request->deposit_via;
                $ptf->created_at=$current;
                $ptf->updated_at=$current;
                $ptf->location_id=1;
                $ptf->save();

                //
                if($request->cash_amount>0){
                   $this->savecustomergoldpaycash($request,$trdate,$trtime,$ref_number,$current,$luy_id,$exsign);
                }

            } else {
                // user selected cash
                if($request->cash_amount>0){
                    $this->savecustomergoldpaycash($request,$trdate,$trtime,$ref_number,$current,$luy_id,$exsign);
                }
            }




        }
   }
   public function savecustomergoldpaycash(Request $request,$trdate,$trtime,$ref_number,$current,$luy_id,$exsign)
   {
        $selcomid=Session('log_into_company_id');
        $ptf3 = new PartnerTransfer();
        $ptf3->company_id=$selcomid;
        if($exsign=='+'){
            $ptf3->tranname='ទទួល';
            $ptf3->trancode=-1;
            $ptf3->mekun=-1;
            $ptf3->amount=-1 * floatval(str_replace(',','',$request->cash_amount));
            $savecashdraw=1;
        }else{
            $ptf3->tranname='ផ្ញើ';
            $ptf3->trancode=1;
            $ptf3->mekun=1;
            $ptf3->amount=str_replace(',','',$request->cash_amount);
            $savecashdraw=0;
        }
            $ptf3->dd=$trdate;
            $ptf3->tt=$trtime;
            $ptf3->user_id=Auth::id();
            $ptf3->parrent_id=$request->selcustomergold;

            $ptf3->currency_id=$luy_id;
            $ptf3->iscutwater=0;
            $ptf3->cuscharge=0;
            $ptf3->cuscharge_currency_id=$luy_id;
            $ptf3->cuscharge_ex=0;
            $ptf3->fee=0;
            $ptf3->interest=0;
            $ptf3->fee_currency_id=$luy_id;
            $ptf3->fee_ex=0;
            $ptf3->bonus=0;
            $ptf3->sendername='';
            $ptf3->sendertel='';
            $ptf3->recname=$request->client_name;
            $ptf3->rectel=str_replace(' ','',$request->client_tel);
            $ptf3->ref_group_id=$ref_number;
            $ptf3->ref_number=$ref_number;
            $ptf3->note='កក់មាស';
            $ptf3->deposit=str_replace(',','',$request->cash_amount);
            $ptf3->deposit_via=$request->deposit_via;
            $ptf3->created_at=$current;
            $ptf3->updated_at=$current;
            $ptf3->location_id=1;
            if($ptf3->save()){
                $id3=$ptf3->id;
                if($savecashdraw==1){
                    $cashdraw=new Cashdraw();
                    $cashdraw->transfer_id=$id3;
                    $cashdraw->from_partner_id=$request->selcustomergold;
                    $cashdraw->opdate=$trdate;
                    $cashdraw->optime=$trtime;
                    $cashdraw->user_id=Auth::id();
                    $cashdraw->amount= $request->cash_amount;
                    $cashdraw->currency_id=$luy_id;
                    $cashdraw->customer_charge=0;
                    $cashdraw->paymethod='Cash';
                    $cashdraw->receive_tel=str_replace(' ','',$request->client_tel);
                    $cashdraw->receive_name=$request->client_name;
                    $cashdraw->note='កក់មាស';
                    $cashdraw->other='';
                    $cashdraw->ref_number=$ref_number;
                    $cashdraw->ref_group_id=$ref_number;
                    $cashdraw->created_at=$current;
                    $cashdraw->updated_at=$current;
                    $cashdraw->company_id=$selcomid;
                    if($cashdraw->save()){
                        $cashdrawid=$cashdraw->id;
                        DB::table('partner_transfers')->where('id',$id3)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                    }
                }
            }

   }
   /////////////////

   public function savecustomergoldlist1(Request $request,$trdate,$trtime,$ref_number,$current)
   {
        $selcomid=Session('log_into_company_id');

        if (!empty($request->selbankdeposit)) {
                // user selected bank
                $ptf2 = new PartnerTransfer();
                $ptf2->company_id=$selcomid;
                if($request->examount<0){
                    $ptf2->tranname='បាញ់ចេញ';
                    $ptf2->trancode=4;
                    $ptf2->mekun=1;
                    $ptf2->amount=str_replace(',','',$request->txtdeposit1);
                }else{
                    $ptf2->tranname='បាញ់ចូល';
                    $ptf2->trancode=-4;
                    $ptf2->mekun=-1;
                    $ptf2->amount=-1 * floatval(str_replace(',','',$request->txtdeposit1));
                }
                $ptf2->dd=$trdate;
                $ptf2->tt=$trtime;
                $ptf2->user_id=Auth::id();
                $ptf2->parrent_id=$request->selbankdeposit;

                $ptf2->currency_id=$request->selcur;
                $ptf2->iscutwater=0;
                $ptf2->cuscharge=0;
                $ptf2->cuscharge_currency_id=$request->selcur;
                $ptf2->cuscharge_ex=0;
                $ptf2->fee=0;
                $ptf2->interest=0;
                $ptf2->fee_currency_id=$request->selcur;
                $ptf2->fee_ex=0;
                $ptf2->bonus=0;
                $ptf2->sendername='';
                $ptf2->sendertel='';
                $ptf2->recname='';
                $ptf2->rectel='';
                $ptf2->ref_group_id=$ref_number;
                $ptf2->ref_number=$ref_number;
                $ptf2->note='កក់មាស';
                $ptf2->created_at=$current;
                $ptf2->updated_at=$current;
                $ptf2->location_id=1;
                if($request->customertype_deposit=='AGENT' || $request->customertype_deposit=='BANK'){
                    $ptf2->user_affect=$this->getuseraffectbank($request->selbankdeposit);
                }
                $ptf2->save();
                //លុយកក់របស់អតិថិជន
                $ptf = new PartnerTransfer();
                $ptf->company_id=$selcomid;
                if($request->examount<0){
                    $ptf->tranname='ទទួល';
                    $ptf->trancode=-4;
                    $ptf->mekun=-1;
                    $ptf->amount=-1 * floatval(str_replace(',','',$request->txtdeposit1));
                }else{
                    $ptf->tranname='ផ្ញើ';
                    $ptf->trancode=4;
                    $ptf->mekun=1;
                    $ptf->amount=str_replace(',','',$request->txtdeposit1);
                }
                $ptf->dd=$trdate;
                $ptf->tt=$trtime;
                $ptf->user_id=Auth::id();
                $ptf->parrent_id=$request->selcustomergold;

                $ptf->currency_id=$request->selcur;
                $ptf->iscutwater=0;
                $ptf->cuscharge=0;
                $ptf->cuscharge_currency_id=$request->selcur;
                $ptf->cuscharge_ex=0;
                $ptf->fee=0;
                $ptf->interest=0;
                $ptf->fee_currency_id=$request->selcur;
                $ptf->fee_ex=0;
                $ptf->bonus=0;
                $ptf->sendername='';
                $ptf->sendertel='';
                $ptf->recname=$request->client_name;
                $ptf->rectel=str_replace(' ','',$request->client_tel);
                $ptf->ref_group_id=$ref_number;
                $ptf->ref_number=$ref_number;
                $ptf->note='កក់មាស';
                $ptf->deposit=str_replace(',','',$request->txtdeposit1);
                $ptf->deposit_via=$request->deposit_via;
                $ptf->created_at=$current;
                $ptf->updated_at=$current;
                $ptf->location_id=1;
                $ptf->save();

                //
                if($request->cash_amount>0){
                   $this->savecustomergoldpaycash1($request,$trdate,$trtime,$ref_number,$current);
                }

            } else {
                // user selected cash
               $this->savecustomergoldpaycash1($request,$trdate,$trtime,$ref_number,$current);
            }



   }
   public function savecustomergoldpaycash1(Request $request,$trdate,$trtime,$ref_number,$current,)
   {
        $selcomid=Session('log_into_company_id');
        $ptf3 = new PartnerTransfer();
        $ptf3->company_id=$selcomid;
        if($request->examount<0){
            $ptf3->tranname='ទទួល';
            $ptf3->trancode=-1;
            $ptf3->mekun=-1;
            $ptf3->amount=-1 * floatval(str_replace(',','',$request->cash_amount));
            $savecashdraw=1;
        }else{
            $ptf3->tranname='ផ្ញើ';
            $ptf3->trancode=1;
            $ptf3->mekun=1;
            $ptf3->amount=str_replace(',','',$request->cash_amount);
            $savecashdraw=0;
        }
            $ptf3->dd=$trdate;
            $ptf3->tt=$trtime;
            $ptf3->user_id=Auth::id();
            $ptf3->parrent_id=$request->selcustomergold;

            $ptf3->currency_id=$request->selcur;
            $ptf3->iscutwater=0;
            $ptf3->cuscharge=0;
            $ptf3->cuscharge_currency_id=$request->selcur;
            $ptf3->cuscharge_ex=0;
            $ptf3->fee=0;
            $ptf3->interest=0;
            $ptf3->fee_currency_id=$request->selcur;
            $ptf3->fee_ex=0;
            $ptf3->bonus=0;
            $ptf3->sendername='';
            $ptf3->sendertel='';
            $ptf3->recname=$request->client_name;
            $ptf3->rectel=str_replace(' ','',$request->client_tel);
            $ptf3->ref_group_id=$ref_number;
            $ptf3->ref_number=$ref_number;
            $ptf3->note='កក់មាស';
            $ptf3->deposit=str_replace(',','',$request->cash_amount);
            $ptf3->deposit_via=$request->deposit_via;
            $ptf3->created_at=$current;
            $ptf3->updated_at=$current;
            $ptf3->location_id=1;
            if($ptf3->save()){
                $id3=$ptf3->id;
                if($savecashdraw==1){
                    $cashdraw=new Cashdraw();
                    $cashdraw->transfer_id=$id3;
                    $cashdraw->from_partner_id=$request->selcustomergold;
                    $cashdraw->opdate=$trdate;
                    $cashdraw->optime=$trtime;
                    $cashdraw->user_id=Auth::id();
                    $cashdraw->amount= $request->cash_amount;
                    $cashdraw->currency_id=$request->selcur;
                    $cashdraw->customer_charge=0;
                    $cashdraw->paymethod='Cash';
                    $cashdraw->receive_tel=str_replace(' ','',$request->client_tel);
                    $cashdraw->receive_name=$request->client_name;
                    $cashdraw->note='កក់មាស';
                    $cashdraw->other='';
                    $cashdraw->ref_number=$ref_number;
                    $cashdraw->ref_group_id=$ref_number;
                    $cashdraw->created_at=$current;
                    $cashdraw->updated_at=$current;
                    $cashdraw->company_id=$selcomid;
                    if($cashdraw->save()){
                        $cashdrawid=$cashdraw->id;
                        DB::table('partner_transfers')->where('id',$id3)->update(['iscashdraw'=>1,'cashdraw_id'=>$cashdrawid]);
                    }
                }
            }

   }


   ////////////////////


   public function saveaddlistmulti(Request $request)
   {
      //return $request->all();
      $selcomid=Session('log_into_company_id');
      if(isset($request->isclear) && $request->isclear==1){
        DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->delete();
      }
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $invtime = date("H:i:s",strtotime($current));
      $date = str_replace('/', '-', $request->dd);
      $exchangedate= date('Y-m-d', strtotime($date));
      foreach ($request->buy as $key => $value) {
        $em=new ExchangeMulti();
        $em->user_id=Auth::user()->id;
        $em->dd=$exchangedate;
        $em->tt=$invtime;
        $em->buy=str_replace(',','',$value);
        $em->curbuy=$request->curbuy[$key];
        $em->sale=str_replace(',','',$request->sale[$key]);
        $em->cursale=$request->cursale[$key];
        $em->buyinfo=$request->buyinfo[$key];
        $em->saleinfo=$request->saleinfo[$key];
        $em->rate=str_replace(',','',$request->rate[$key]);
        $em->drate=str_replace(',','',$request->drate[$key]);
        $em->rateinfo=$request->rateinfo[$key];
        $em->ismultiexchange=1;
        $em->created_at=$current;
        $em->updated_at=$current;
        $em->company_id=$selcomid;
        $em->save();
      }

   }
   public function saveaddlist(Request $request)
   {
      //return $request->all();
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $invtime = date("H:i:s",strtotime($current));
      $date = str_replace('/', '-', $request->dd);
      $exchangedate= date('Y-m-d', strtotime($date));
      $em=new ExchangeMulti();
      $em->user_id=Auth::user()->id;
      $em->dd=$exchangedate;
      $em->tt=$invtime;
      $em->buy=str_replace(',','',$request->buy);
      $em->curbuy=$request->curbuy;
      $em->sale=str_replace(',','',$request->sale);
      $em->cursale=$request->cursale;
      $em->buyinfo=$request->buyinfo;
      $em->saleinfo=$request->saleinfo;
      $em->rate=str_replace(',','',$request->rate);
      $em->drate=str_replace(',','',$request->drate);
      $em->rateinfo=$request->rateinfo;
      $em->ismultiexchange=1;
      $em->created_at=$current;
      $em->updated_at=$current;
      $em->company_id=$selcomid;
      $em->goldwater=$request->watergold;
      $em->save();

   }
   public function getmultiexchangelist(){
        $selcomid=Session('log_into_company_id');
        $mex=ExchangeMulti::whereNull('mapcode')->where('user_id',Auth::user()->id)->where('company_id',$selcomid)->orderBy('id')->get();
        $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))->where('company_id',$selcomid)
                    ->whereNull('mapcode')->where('user_id',Auth::user()->id)
                    ->groupBy('curbuy')->get();
        $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))->where('company_id',$selcomid)
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

      if($mex){
         return view('exchanges.multiexlists',compact('mex','totalbuy','totalsale','cashin','cashout'));
      }
   }
   public function delete_multiexchangelist(Request $request)
   {
      $delml= DB::table('exchange_multis')->where('id',$request->id)->delete();
      if($delml){
         return response()->json(['success'=>'delete success']);
      }else{
         return response()->json(['error'=>'delete error']);
      }
   }
   public function savemultiexchanges(Request $request)
   {
      //return $request->all();
    //   if($request->hasbankpayment=='1'){
    //      $validator3 = Validator::make($request->all(), [
    //          'bankid.*' => 'required', //input array validate
    //          'bankamt.*' => 'required', //input array validate
    //          'bankcur.*' => 'required', //input array validate
    //      ]);
    //  }
    $selcomid=Session('log_into_company_id');
    $validator3 = Validator::make($request->all(), []);
    if($request->foundpartnerlist=='1'){
      $validator3 = Validator::make($request->all(), [
          'parrent_id.*' => 'required', //input array validate
          'listamt.*' => 'required', //input array validate
          'listcurid.*' => 'required',
          'listcuscharge.*' => 'required',
          'listcuschargecurid.*' => 'required',
          'listfee.*' => 'required',
          'listfeecurid.*' => 'required',
      ]);
    }
     if($request->foundpartnerlist=='1'){
         if ($validator3->fails()) {
            return response()->json(['error'=>$validator3->errors()->all()]);
         }
      }
      $multi_id='';
      $total_luy=0;
      $e1_id=null;
      $luy_id=null;
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $invtime = date("H:i:s",strtotime($current));
      $date = str_replace('/', '-', $request->dd);
      $exchangedate= date('Y-m-d', strtotime($date));
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
            if($request->isgold_deposit==1){
                // $luy_id = Currency::where('active', 1)
                // ->where('shortcut', 'USD')
                // ->where('company_id', $selcomid)
                // ->first()
                // ->id ?? null;
                $luy_id=Currency::where('active',1)->where('shortcut','USD')->where('company_id',$selcomid)->value('id');
                $total_luy += (float)str_replace(',','',$amount);
            }
            $rate=$request->txtrates[$key];
            $drate=$request->txtdrates[$key];
            $e=new Exchange();
            $e->dd=$exchangedate;
            $e->tt=$invtime;
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
            $e->othercode='';
            $e->note='';
            $e->user_id=Auth::user()->id;
            $e->created_at=$current;
            $e->updated_at=$current;
            $e->company_id=$selcomid;
            $e->goldwater=$request->txtgoldwaters[$key];
            $e->processing=$request->isgold_deposit;
            $e->status=$request->status;
            if($request->isgold_deposit==1){
                $e->client=$request->client_name;
                $e->phone=$request->client_tel;
            }
            if($request->isgold_deposit==1){
                $e->save();
            }else{
                if($request->status==1){
                     $e->save();
                }
            }
            if($key==0){
              $multi_id=$e->id;
               DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id]);
            }else{
              DB::table('exchanges')->where('id',$e->id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id]);
            }

         }else{
            $rate_buy = $buyinfoes[1];
            $luy =number_format((float)str_replace(',','',$request->txtbuys[$key]) / (float)str_replace(',','',$rate_buy),4);
            $luy=str_replace(',','',$luy);
            $e1 = new Exchange();
            $e1->dd=$exchangedate;
            $e1->tt=$invtime;
            $e1->currency_id=$buyinfoes[0];
            $e1->product=str_replace(',','',$request->txtbuys[$key]);
            $e1->pcur=$request->txtcurbuys[$key];
            $e1->amount=-1 * floatval($luy);
            $e1->maincur='USD';
            $e1->rate=str_replace(',','',$rate_buy);
            $e1->drate=str_replace(',','',$rate_buy);

            $e1->cashreceive='';
            $e1->cashreturn='';
            $e1->multiexchangecode=$multi_id;
            $e1->othercode='';
            $e1->note='';
            $e1->user_id=Auth::user()->id;
            $e1->created_at=$current;
            $e1->updated_at=$current;
            $e1->company_id=$selcomid;
            $e1->status=$request->status;
            if($request->status==1){
                $e1->save();
                $e1_id=$e1->id;
                if($key==0){
                    $multi_id=$e1->id;
                    DB::table('exchanges')->where('id',$multi_id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id,'product_first_id'=>$e1_id]);
                }else{
                    DB::table('exchanges')->where('id',$e1->id)->update(['multiexchangecode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id,'product_first_id'=>$e1_id]);
                }
            }
            $rate_sale =number_format((float)str_replace(',','',$request->txtsales[$key]) / (float)$luy,4);
            $e2 = new Exchange();
            $e2->dd=$exchangedate;
            $e2->tt=$invtime;
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
            $e2->ref_group_id='exchange-'.$multi_id;
            $e2->othercode='';
            $e2->note='';
            $e2->user_id=Auth::user()->id;
            $e2->created_at=$current;
            $e2->updated_at=$current;
            $e2->company_id=$selcomid;
            $e2->status=$request->status;
            if($request->status==1){
                $e2->product_first_id=$e1_id;
                $e2->save();
            }
         }
      }
        //   if($request->hasbankpayment==1){
        //      $this->customerpayexchangebybank($request,$exchangedate,$invtime,'exchange-' . $multi_id,$current);
        //  }
        if($request->status==1){
            if($request->foundpartnerlist==1){
            $this->customerpayexchangebypartner($request,$exchangedate,$invtime,'exchange-' . $multi_id,$current);
            }
            if($request->isgold_deposit==1){
                if($total_luy>0){
                    $exsign='-';
                }else{
                    $exsign='+';
                }
                $this->savecustomergoldlist($request,$exchangedate,$invtime,'exchange-'.$multi_id,$current,$total_luy,$luy_id,$exsign);
            }
            DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->update(['mapcode'=>$multi_id,'ref_group_id'=>'exchange-'.$multi_id,'company_id'=>$selcomid]);
            return response()->json(['success'=>'save list completed','mapid'=>$multi_id]);
        }else{
            DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->update(['ref_group_id'=>'printtest','company_id'=>$selcomid]);
            return response()->json(['success'=>'print test completed','mapid'=>'printtest']);
        }

   }
   public function clearexchangelist(){
      DB::table('exchange_multis')->where('user_id',Auth::user()->id)->whereNull('mapcode')->delete();
   }
   public function exchangeprint(Request $request){

      $e=Exchange::where('id',$request->id)->first();
      $logo=Company::orderBy('id')->first();
      return view('exchanges.receipt',compact('e','logo'));
  }
  public function exchangegoldprints(Request $request)
  {
    //return $request->all();
    $reprint=$request->reprint;
    $selcomid=Session('log_into_company_id');
    $logo=Company::find($selcomid);
    $exchange=Exchange::find($request->ex_id);
    if($exchange){
        $sum_exchange=Exchange::where('ref_group_id',$exchange->ref_group_id)->where('status',1)->sum('amount');
        $exchanges=Exchange::where('ref_group_id',$exchange->ref_group_id)->where('status',1)->get();
        $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$exchange->ref_group_id)->where('rectel',$exchange->phone)->sum('amount');
        $deposit_details=PartnerTransfer::where('status',1)->where('ref_group_id',$exchange->ref_group_id)->where('rectel',$exchange->phone)->where('deposit','>',0)->orderBy('id')->get();
        $sum_deposit=PartnerTransfer::where('status',1)->where('ref_group_id',$exchange->ref_group_id)->where('rectel',$exchange->phone)->where('deposit','>',0)->sum('amount');
        return view('exchanges.receipt_gold1',compact('exchanges','logo','reprint','deposit_details','balance','sum_deposit','sum_exchange'));

    }else{
        return 'exchange id not found';
    }

  }
  public function exchangeprints(Request $request){
    //return $request->all();
      $selcomid=Session('log_into_company_id');
        $logo=Company::find($selcomid);
        $sumdeposit=0;
        $deposit_via='';
        $balance=0;
        $sum_exchange=0;
        $exchanges=collect();
        $totalbuy=collect();
        $totalsale=collect();
        $currencies=collect();
        $bankpayments=collect();
        $cashreceive_cm=collect();
        $cashreturn_cm=collect();
        $cash=collect();
        if($request->isgold_deposit==1){
            $sumdeposit=0;
            $deposit_via='';
            $groupid='exchange-'.$request->mapid;
            $exchanges=Exchange::where('ref_group_id',$groupid)->get();
            $sum_exchange=Exchange::where('ref_group_id',$groupid)->where('status',1)->sum('amount');
            $sumdeposit = PartnerTransfer::where('status', 1)
                ->where('ref_group_id', $groupid)
                ->where('deposit', '>', 0)
                ->sum('amount');
            $deposit_via = PartnerTransfer::where('status', 1)
                ->where('ref_group_id', $groupid)
                ->where('deposit', '>', 0)
                ->value('deposit_via'); // returns only this column
            $balance = PartnerTransfer::where('status', 1)
                ->where('ref_group_id', $groupid)
                ->where('rectel',$exchanges[0]->phone)
                ->sum('amount');

        }else{
            if (isset($request->found_cashreceive) && $request->found_cashreceive==1) {
                if($request->status==1){
                    DB::table('exchange_multis')->where('mapcode',$request->mapid)->where('company_id',$selcomid)->update(['cashreceive'=>$request->cash_receive,'cashreturn'=>$request->cash_return]);
                }else{
                    DB::table('exchange_multis')->where('ref_group_id',$request->mapid)->where('company_id',$selcomid)->update(['cashreceive'=>$request->cash_receive,'cashreturn'=>$request->cash_return]);

                }
            }
            $c=collect();
            $cm=collect();
            if($request->status==1){
                $exchanges=ExchangeMulti::where('mapcode',$request->mapid)->where('company_id',$selcomid)->orderBy('id')->get();
                $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))->where('mapcode',$request->mapid)->where('company_id',$selcomid)->groupBy('curbuy')->get();
                $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))->where('mapcode',$request->mapid)->where('company_id',$selcomid)->groupBy('cursale')->get();
                $currencies=Currency::where('active',1)->where('company_id',$selcomid)->get();
                $bankpayments=PartnerTransfer::where('ref_group_id','=','exchange-' . $request->mapid)->where('status',1)->where('company_id',$selcomid)->get();
            }else{
                $exchanges=ExchangeMulti::where('ref_group_id',$request->mapid)->where('company_id',$selcomid)->orderBy('id')->get();
                $totalbuy=DB::table('exchange_multis')->select(DB::raw('sum(buy) as tbuy,curbuy'))->where('ref_group_id',$request->mapid)->where('company_id',$selcomid)->groupBy('curbuy')->get();
                $totalsale=DB::table('exchange_multis')->select(DB::raw('sum(sale) as tsale,cursale'))->where('ref_group_id',$request->mapid)->where('company_id',$selcomid)->groupBy('cursale')->get();
                $bankpayments=PartnerTransfer::where('ref_group_id','=','exchange-' . $request->mapid)->where('status',1)->where('company_id',$selcomid)->get();
            }
            //update cash receive and cash return if user input
            // $cash_receive = json_decode($request->cash_receive, true) ?? [];
            // $cash_return  = json_decode($request->cash_return, true) ?? [];
            // $cur_receive  = json_decode($request->cur_receive, true) ?? [];

            // if (count($cash_receive)>0 && $cash_receive[0]!=='') {

            //     foreach($exchanges as $key => $ex) {

            //         // Skip when any index missing
            //         if (
            //             !isset($cash_receive[$key]) ||
            //             !isset($cash_return[$key]) ||
            //             !isset($cur_receive[$key])
            //         ) {
            //             continue; // do NOT update
            //         }

            //         DB::table('exchange_multis')
            //             ->where('id', $ex->id)
            //             ->update([
            //                 'cashreceive' => $cash_receive[$key],
            //                 'cashreturn'  => $cash_return[$key],
            //                 'cur_receive' => $cur_receive[$key],
            //             ]);
            //     }
            // }

            if($totalbuy){
               foreach($totalbuy as $e)
               {
                   $c=$c->push(['cur'=>$e->curbuy,'value'=> $e->tbuy]);
                   $cm=$cm->push(['cur'=>$e->curbuy,'value'=> $e->tbuy]);
               }
            }
            if($totalsale){
              foreach($totalsale as $s)
              {
                 $c=$c->push(['cur'=>$s->cursale,'value'=> -1 * $s->tsale]);
                  $cm=$cm->push(['cur'=>$s->cursale,'value'=> -1 * $s->tsale]);
              }
           }
            if($bankpayments){
               foreach($bankpayments as $bp)
               {
                     $c=$c->push(['cur'=>$bp->currency->shortcut,'value'=> $bp->amount]);
               }
               foreach($bankpayments as $bp)
               {
                     $c=$c->push(['cur'=>$bp->cuschargecur->shortcut,'value'=> $bp->cuscharge]);
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

            $groupcm = $cm->groupBy('cur');
            $sumcm = $groupcm->map(function ($groupcm) {
                    return [
                    'cur' => $groupcm->first()['cur'],// opposition_id is constant inside the same group, so just take the first or whatever.
                    'value' => $groupcm->sum('value'),
                    // 'won' => $group->where('result', 'won')->count(),
                    // 'lost' => $group->where('result', 'lost')->count(),
                    ];
            });

            $cashreceive_cm=$sumcm->where('value','>','0');
            $cashreturn_cm=$sumcm->where('value','<','0');
            $cash=$sumc->where('value','<>','0');

        }
        $status=$request->status;
        $reprint=$request->reprint;

      if($request->isgold_deposit==1){
            return view('exchanges.receipt_gold',compact('exchanges','logo','reprint','sumdeposit','deposit_via','balance','sum_exchange'));
      }else{
          if(config('helper.transfer_option') == 'norn'){
            return view('exchanges.receipt2norn',compact('exchanges','totalbuy','totalsale','logo','bankpayments','cash','cashreceive_cm','cashreturn_cm','reprint'));
          }else if(config('helper.transfer_option') == 'chivra'){
            return view('exchanges.receiptnotax',compact('exchanges','totalbuy','totalsale','logo','bankpayments','cash','cashreceive_cm','cashreturn_cm','reprint','currencies'));
          }else{

              return view('exchanges.receipt2en_narith',compact('exchanges','totalbuy','totalsale','logo','bankpayments','cash','cashreceive_cm','cashreturn_cm','reprint','status'));
            //   return view('exchanges.receipt2en',compact('exchanges','totalbuy','totalsale','logo','bankpayments','cash','cashreceive_cm','cashreturn_cm','reprint'));
          }
      }
   }
   public function exchangelists(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));
      $userid=Auth::user()->id;
      $sumexchangelist = DB::table('exchange_multis')->select(DB::raw('CONCAT(curbuy,"-",cursale) as curstr,count(*) as qty'))->whereDate('dd',$dd)->where('user_id',$userid)->where('status',1)->where('isexchangelist',0)->whereNotNull('mapcode')->where('company_id',$selcomid)->groupBy('curstr')->orderBy('curstr')->get();
      $exchangelists=ExchangeMulti::whereDate('dd',$dd)->where('user_id',$userid)->where('status',1)->where('isexchangelist',0)->whereNotNull('mapcode')->where('company_id',$selcomid)->orderBy('id')->get();
      //$users=User::where('active','1')->get();
      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      return view('exchanges.exchangelists',compact('exchangelists','sumexchangelist','users'));
   }
    public function exchangelistsnew(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));
      $userid=Auth::user()->id;
      $sumexchanges = DB::table('exchanges')
        ->join('currencies', 'exchanges.currency_id', '=', 'currencies.id')
        ->select(
            'exchanges.currency_id',
            'currencies.no',
            'currencies.shortcut',
            'currencies.sk',
            'currencies.curname',
            'currencies.optsign',
            'currencies.tuochek',
            DB::raw("CASE WHEN exchanges.product > 0 THEN 'positive' ELSE 'negative' END as type"),
            DB::raw("SUM(exchanges.product) as total_product"),
            DB::raw("SUM((exchanges.product * exchanges.goldwater)/100) as total_product1"),
            DB::raw("SUM(exchanges.amount) as total_amount"),
            DB::raw("COUNT(*) as qty")
        )
        ->whereDate('exchanges.dd', $dd)
        ->where('exchanges.user_id', $userid)
        ->where('exchanges.status', 1)
        ->where('exchanges.isexchangelist', 0)
        ->where('exchanges.company_id', $selcomid)
        ->groupBy('exchanges.currency_id', 'currencies.shortcut','currencies.sk','currencies.no','currencies.curname','currencies.optsign','currencies.tuochek', 'type')
        ->orderBy('currencies.no')
        ->orderBy('type', 'desc')
        ->get();

      $exchanges=Exchange::whereDate('dd',$dd)->where('user_id',$userid)->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->orderBy('id')->get();
      //$users=User::where('active','1')->get();
      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      return view('exchanges.exchangelistsnew',compact('exchanges','sumexchanges','users'));
   }
   public function showgoldpaymentdetail(Request $request)
   {
        //return $request->all();
        $groupid=$request->group_id;
        $exid=$request->exchange_id;

        $exchanges=Exchange::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();

        $transfers = PartnerTransfer::where('status', 1)
        ->where('ref_group_id', $request->group_id)
        ->orderBy('dd', 'asc')
        ->orderBy('id') // make sure sorted
        ->get()
        ->groupBy(function ($t) {
            return \Carbon\Carbon::parse($t->dd)->format('Y-m-d'); // group by date
        });
        //return $transfers;
        return view('exchanges.exchangegoldreportgroup',compact('transfers','exchanges','groupid','exid'));
   }
   public function exchangegolddeletelistgroup(Request $request)
   {
        //return $request->all();
        DB::table('partner_transfers')->where('ref_group_id',$request->groupid)->whereDate('dd',$request->dd)->update(['status'=>0]);
        DB::table('cashdraws')->where('ref_group_id',$request->groupid)->whereDate('opdate',$request->dd)->update(['status'=>0]);
        DB::table('exchanges')->where('ref_group_id',$request->groupid)->whereDate('dd',$request->dd)->update(['status'=>0]);
        DB::table('exchange_multis')->where('ref_group_id',$request->groupid)->whereDate('dd',$request->dd)->update(['status'=>0]);
        $exchange=Exchange::find($request->exid);
        if($exchange){
            $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$exchange->ref_group_id)->where('rectel',$exchange->phone)->sum('amount');
            if ((float)$balance !== 0.0) {
               DB::table('exchanges')->where('ref_group_id',$exchange->ref_group_id)->update(['processing'=>1]);
            }
        }else{
            return response()->json(['success'=>false,'message'=>'delete error']);
        }

        return response()->json(['success'=>true,'message'=>'delete completed']);
   }
    public function exchangegoldreport(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));
      $userid=Auth::user()->id;
      $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
      $exchanges=Exchange::where('user_id',$userid)
      ->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->where('processing',1)->orderBy('id')->get();
      foreach($exchanges as $e){
        $sumamount=Exchange::where('status',1)->where('ref_group_id',$e->ref_group_id)->sum('amount');
        $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$e->ref_group_id)->where('rectel',$e->phone)->sum('amount');
        if($e->id==$e->multiexchangecode){
            $e->balance=$balance;
            $e->sumamount=$sumamount;
        }else{
            $e->balance=0;
            $e->sumamount=0;
        }
      }
      $exchanges_complete=Exchange::where('user_id',$userid)
      ->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->whereDate('updated_at',$dd)->where('processing',2)->orderBy('id')->get();
      foreach($exchanges_complete as $e){
        $sumamount=Exchange::where('status',1)->where('ref_group_id',$e->ref_group_id)->sum('amount');
        $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$e->ref_group_id)->where('rectel',$e->phone)->sum('amount');
        if($e->id==$e->multiexchangecode){
            $e->balance=$balance;
            $e->sumamount=$sumamount;
        }else{
            $e->balance=0;
            $e->sumamount=0;
        }
      }
      $currencies=Currency::where('active',1)->where('ismain',1)->where('company_id',$selcomid)->get();
      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      return view('exchanges.exchangegoldreport',compact('exchanges','exchanges_complete','users','partners','currencies'));
   }
     public function getexchangelistgold(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      if(!empty($request->userid)){
         $exchanges=Exchange::where('user_id',$request->userid)
          ->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->where('processing',1);
          $exchanges_complete=Exchange::where('user_id',$request->userid)->whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))
          ->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->where('processing',2);
      }else{
          $exchanges=Exchange::where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->where('processing',1);
          $exchanges_complete=Exchange::whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))
          ->where('status',1)->where('isexchangelist',0)->where('company_id',$selcomid)->where('processing',2);
      }
      if($request->status==1){
            $exchanges=$exchanges->where('product','>',0);
            $exchanges_complete=$exchanges_complete->where('product','>',0);
      }else if($request->status==-1){
            $exchanges=$exchanges->where('product','<',0);
            $exchanges_complete=$exchanges_complete->where('product','<',0);
      }
      $exchanges=$exchanges->orderBy('id')->get();
      $exchanges_complete=$exchanges_complete->orderBy('id')->get();
        foreach($exchanges as $e){
            $sumamount=Exchange::where('status',1)->where('ref_group_id',$e->ref_group_id)->sum('amount');
            $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$e->ref_group_id)->where('rectel',$e->phone)->sum('amount');
            if($e->id==$e->multiexchangecode){
                $e->balance=$balance;
                $e->sumamount=$sumamount;
            }else{
                $e->balance=0;
                $e->sumamount=0;
            }
        }
        foreach($exchanges_complete as $e){
            $sumamount=Exchange::where('status',1)->where('ref_group_id',$e->ref_group_id)->sum('amount');
            $balance=PartnerTransfer::where('status',1)->where('ref_group_id',$e->ref_group_id)->where('rectel',$e->phone)->sum('amount');
            if($e->id==$e->multiexchangecode){
                $e->balance=$balance;
                $e->sumamount=$sumamount;
            }else{
                $e->balance=0;
                $e->sumamount=0;
            }
        }
      return view('exchanges.getexchangegoldreport',compact('exchanges','exchanges_complete'));
   }
    public function customerexchangelist(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));
      $userid=Auth::user()->id;

      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      return view('exchanges.customerexchangelist',compact('users'));
   }
    public function pagetime(Request $request)
   {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));
      $userid=Auth::user()->id;

      $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

      return view('exchanges.pagetime',compact('users'));
   }
   public function deleteexchange(Request $request)
   {
      $es=ExchangeMulti::where('mapcode',$request->id)->update(['status'=>'0','userdel'=>Auth::user()->name]);

      if($es){
         $e=Exchange::where('multiexchangecode',$request->id)->update(['status'=>'0','userdel'=>Auth::user()->name]);
         if($e){
            $refnumber='exchange-' . $request->id;
            // DB::table('partner_transfers')->where('ref_number',$refnumber)->update(['status'=>0,'user_delete'=>Auth::id()]);
            // DB::table('cashdraws')->where('ref_number',$refnumber)->update(['status'=>0,'delby'=>Auth::user()->name]);
            DB::table('partner_transfers')->where('ref_group_id',$refnumber)->update(['status'=>0,'user_delete'=>Auth::id()]);
            DB::table('cashdraws')->where('ref_group_id',$refnumber)->update(['status'=>0,'delby'=>Auth::user()->name]);
            return response()->json(['success'=>true,'message'=>'this exchange has been removed.']);
         }
      }
   }
    public function getexchangelist(Request $request)
   {
    //return $request->all();
      $selcomid=Session('log_into_company_id');
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      $type='';
      if($request->isinputdate=='true'){
        $exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('company_id',$selcomid);
        $sumexchangelist = DB::table('exchange_multis')->select(DB::raw('CONCAT(curbuy,"-",cursale) as curstr,count(*) as qty'))->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->whereNotNull('mapcode')->where('company_id',$selcomid);

      }else{
        $exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid);
        $sumexchangelist = DB::table('exchange_multis')->select(DB::raw('CONCAT(curbuy,"-",cursale) as curstr,count(*) as qty'))->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->whereNotNull('mapcode')->where('company_id',$selcomid);

      }

      if($request->status==-1){//កាត់កងបញ្ជី
        $type='List';
         //$exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('isexchangelist',1)->whereNotNull('mapcode');
         $exchangelists=$exchangelists->where('isexchangelist',1)->where('status',1)->whereNotNull('mapcode');
         $sumexchangelist=$sumexchangelist->where('status',1)->where('isexchangelist',1);
      }else if($request->status==0){//ប្តូរប្រាក់លុប
        $type='Deleted';
         //$exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',$request->status);
         $exchangelists=$exchangelists->where('status',$request->status);
         $sumexchangelist=$sumexchangelist->where('status',0);

      }else if($request->status==1){//ប្តូរប្រាក់ទូទៅ
        $type='Walk in';
         //$exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('isexchangelist',0)->whereNotNull('mapcode');
          $exchangelists=$exchangelists->where('status',1)->where('isexchangelist',0)->whereNotNull('mapcode');
         $sumexchangelist=$sumexchangelist->where('status',1)->where('isexchangelist',0);
      }else{
        $type='All';
        //$exchangelists=ExchangeMulti::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->whereNotNull('mapcode');
         $exchangelists=$exchangelists->where('status',1)->whereNotNull('mapcode');
        $sumexchangelist=$sumexchangelist->where('status',1);
      }
      if($request->userid){
         $exchangelists=$exchangelists->where('user_id',$request->userid);
         $sumexchangelist=$sumexchangelist->where('user_id',$request->userid);
      }
      $sumexchangelist=$sumexchangelist->groupBy('curstr')->orderBy('curstr')->get();
      $exchangelists=$exchangelists->orderBy('id')->get();
      if($request->location==1){
        return view('exchanges.bodyexchangelist1',compact('exchangelists','sumexchangelist'));
      }else{
            if(isset($request->isprint) && $request->isprint==1){
                $logo=Company::orderBy('id')->first();
                $rpttitle='Exchange Report';
                $username='For User: ' . $request->username;
                $d1d2='From: ' . $request->d1 . ' To: ' . $request->d2;
                return view('exchanges.exchangereportprint',compact('exchangelists','sumexchangelist','rpttitle','d1d2','type','username','logo'));
            }else{
                return view('exchanges.bodyexchangelist',compact('exchangelists','sumexchangelist'));
            }
      }
   }
   public function getexchangelistnew(Request $request)
   {
    //return $request->all();
      $selcomid=Session('log_into_company_id');
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      $type='';
      if($request->isinputdate=='true'){
        $sumexchanges = DB::table('exchanges')
        ->join('currencies', 'exchanges.currency_id', '=', 'currencies.id')
        ->select(
            'exchanges.currency_id',
            'currencies.no',
            'currencies.shortcut',
            'currencies.sk',
            'currencies.curname',
            'currencies.optsign',
            'currencies.tuochek',
            DB::raw("CASE WHEN exchanges.product > 0 THEN 'positive' ELSE 'negative' END as type"),
            DB::raw("SUM(exchanges.product) as total_product"),
            DB::raw("SUM((exchanges.product * exchanges.goldwater)/100) as total_product1"),
            DB::raw("SUM(exchanges.amount) as total_amount"),
            DB::raw("COUNT(*) as qty")
        )
        ->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))
        ->where('exchanges.company_id', $selcomid);
        $exchanges=Exchange::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('company_id',$selcomid);

      }else{
        $sumexchanges = DB::table('exchanges')
        ->join('currencies', 'exchanges.currency_id', '=', 'currencies.id')
        ->select(
            'exchanges.currency_id',
            'currencies.no',
            'currencies.shortcut',
            'currencies.sk',
            'currencies.curname',
            'currencies.optsign',
            'currencies.tuochek',
            DB::raw("CASE WHEN exchanges.product > 0 THEN 'positive' ELSE 'negative' END as type"),
            DB::raw("SUM(exchanges.product) as total_product"),
            DB::raw("SUM((exchanges.product * exchanges.goldwater)/100) as total_product1"),

            DB::raw("SUM(exchanges.amount) as total_amount"),
            DB::raw("COUNT(*) as qty")
        )
        ->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))
        ->where('exchanges.company_id', $selcomid);

        $exchanges=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid);

      }

      if($request->status==-1){//កាត់កងបញ្ជី
        $type='List';
         $exchanges=$exchanges->where('isexchangelist',1)->where('status',1)->whereNotNull('mapcode');
         $sumexchanges=$sumexchanges->where('exchanges.status',1)->where('exchanges.isexchangelist',1);
      }else if($request->status==0){//ប្តូរប្រាក់លុប
        $type='Deleted';
         $exchanges=$exchanges->where('status',$request->status);
         $sumexchanges=$sumexchanges->where('exchanges.status',0);

      }else if($request->status==1){//ប្តូរប្រាក់ទូទៅ
        $type='Walk in';
          $exchanges=$exchanges->where('status',1)->where('isexchangelist',0);
         $sumexchanges=$sumexchanges->where('exchabges.status',1)->where('exchanges.isexchangelist',0);
      }else{
        $type='All';
         $exchanges=$exchanges->where('status',1);
        $sumexchanges=$sumexchanges->where('exchanges.status',1);
      }
      if($request->userid){
         $exchanges=$exchanges->where('user_id',$request->userid);
         $sumexchanges=$sumexchanges->where('exchanges.user_id',$request->userid);
      }
      $sumexchanges=$sumexchanges
        ->groupBy('exchanges.currency_id', 'currencies.shortcut','currencies.sk', 'currencies.no','currencies.curname','currencies.optsign','currencies.tuochek', 'type')
        ->orderBy('currencies.no')
        ->orderBy('type', 'desc')
        ->get();
      $exchanges=$exchanges->orderBy('id')->get();
        if(isset($request->isprint) && $request->isprint==1){
            $logo=Company::orderBy('id')->first();
            $rpttitle='Exchange Report';
            $username='For User: ' . $request->username;
            $d1d2='From: ' . $request->d1 . ' To: ' . $request->d2;
            return view('exchanges.exchangereportprintnew',compact('exchanges','sumexchanges','rpttitle','d1d2','type','username','logo'));
        }else{
            return view('exchanges.bodyexchangelistnew',compact('exchanges','sumexchanges'));
        }
   }
    public function getcustomerexchangelist_old(Request $request)
   {
        //return $request->all();
      $selcomid=Session('log_into_company_id');
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      $t1=$request->t1;
      $t2=$request->t2;
      $userid=$request->userid;
      $stand_time=$request->stand_time??0;
      $op=$request->selop;
      if($userid){
          if($op==''){
            if($request->t1){
                $data = CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), [$d1, $d2])
                ->whereRaw('TIME(created_at) BETWEEN ? AND ?', [$t1, $t2])
                ->where('user_id', $userid)
                ->get();
            }else{
                $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('user_id',$userid)->get();
            }
          }else{
                 if($request->t1){
                    $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->whereRaw('TIME(created_at) BETWEEN ? AND ?', [$t1, $t2])->where('user_id',$userid)->where('stand_time',$op,$stand_time)->get();
                 }else{
                     $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('user_id',$userid)->where('stand_time',$op,$stand_time)->get();
                 }
          }
      }else{
          if($op==''){
            if($request->t1){
                $data = CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), [$d1, $d2])
                ->whereRaw('TIME(created_at) BETWEEN ? AND ?', [$t1, $t2])
                ->get();
            }else{
                $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->get();
            }
          }else{
                 if($request->t1){
                    $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->whereRaw('TIME(created_at) BETWEEN ? AND ?', [$t1, $t2])->where('stand_time',$op,$stand_time)->get();
                 }else{
                     $data=CustomerExchangeCapture::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('stand_time',$op,$stand_time)->get();
                 }
          }
      }
      if($request->isdelete==1){
          foreach ($data as $item) {
                // Delete image file if exists
                if ($item->photo && Storage::disk('public')->exists($item->photo)) {
                    Storage::disk('public')->delete($item->photo);
                }
                // Delete DB record
                $item->delete();
            }
      }
      return view('exchanges.seecustomerexchange',compact('data'));
   }
   public function delcustomerexchangecapture(Request $request)
   {
     $cec=CustomerExchangeCapture::find($request->id);
    if($cec){
         if ($cec->photo && Storage::disk('public')->exists($cec->photo)) {
            Storage::disk('public')->delete($cec->photo);
        }
        $cec->delete();
        return response()->json(['success'=>true,'message'=>'']);
    }
   }
    public function delallcustomerexchangecapture_old(Request $request)
   {
        $selcomid=Session('log_into_company_id');
        //Storage::disk('public')->deleteDirectory('customers');//delete folder customers
        Storage::disk('public')->delete(Storage::disk('public')->files('customers'));
        DB::table('customer_exchanges')->where('company_id',$selcomid)->delete();
        DB::table('customer_exchange_captures')->where('company_id',$selcomid)->delete();
        return response()->json(['success'=>true,'message'=>'']);

   }
   public function delallcustomerexchangecapture(Request $request)
    {
        $selcomid = Session('log_into_company_id');

        // Get all files in customers folder
        $files = Storage::disk('public')->files('customers');
        foreach ($files as $file) {
            $filename = basename($file);
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (str_ends_with($filename, '_' . $selcomid . '.' . $ext)) {
                Storage::disk('public')->delete($file);
            }
        }

        // Delete database records
        DB::table('customer_exchanges')->where('company_id', $selcomid)->delete();
        DB::table('customer_exchange_captures')->where('company_id', $selcomid)->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully']);
    }

   public function getcustomerexchangelist(Request $request)
    {
        //return $request->all();

        $d1 = date('Y-m-d', strtotime($request->d1));
        $d2 = date('Y-m-d', strtotime($request->d2));
        $t1 = $request->t1;
        $t2 = $request->t2;
        $userid = $request->userid;
        $stand_time = $request->stand_time ?? 0;
        $op = $request->selop;

        // initial query
        $data = $this->buildCustomerExchangeQuery($d1, $d2, $t1, $t2, $userid, $op, $stand_time)->get();

        if ($request->isdelete == 1) {
            foreach ($data as $item) {
                if ($item->photo && Storage::disk('public')->exists($item->photo)) {
                    Storage::disk('public')->delete($item->photo);
                }
                $item->delete();
            }

            // refresh after delete
            $data = $this->buildCustomerExchangeQuery($d1, $d2, $t1, $t2, $userid, $op, $stand_time)->get();
        }

        return view('exchanges.seecustomerexchange', compact('data'));
    }

   private function buildCustomerExchangeQuery($d1, $d2, $t1, $t2, $userid, $op, $stand_time)
    {
        $selcomid=Session('log_into_company_id');
        $query = CustomerExchangeCapture::where('company_id',$selcomid)->whereBetween(DB::raw('DATE(created_at)'), [$d1, $d2]);

        if ($t1) {
            $query->whereRaw('TIME(created_at) BETWEEN ? AND ?', [$t1, $t2]);
        }

        if ($userid) {
            $query->where('user_id', $userid);
        }

        if (!is_null($op) && $op !== '') {
            $query->where('stand_time', $op, $stand_time);
        }


        return $query;
    }

   public function getexchangepagetime(Request $request)
   {
        //return $request->all();
      $selcomid=Session('log_into_company_id');
      $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));
      $userid=$request->userid;
      $data = PageTime::whereBetween(DB::raw('DATE(created_at)'), [$d1, $d2])->where('user_id',$userid)->get();

      return view('exchanges.seepagetime',compact('data'));
   }
   function phpformatnumber($num){
      $dc=0;
      $p=strpos((float)$num,'.');
      if($p>0){
      $fp=substr($num,$p,strlen($num)-$p);
      $dc=strlen((float)$fp)-2;

      }
      //return number_format('60000',0);
      return number_format($num,$dc,'.',',');
  }
}
