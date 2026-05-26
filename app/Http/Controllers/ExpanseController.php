<?php

namespace App\Http\Controllers;

use App\User;
use App\Currency;
use App\Customer;
use Carbon\Carbon;
use App\UserCapital;
use App\Models\Expanse;
use App\PartnerTransfer;
use App\Models\ExpanseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpanseController extends Controller
{
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        //$expansetypes=ExpanseType::all();
         //$users=User::where('active',1)->get();
         $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $expanses=Expanse::whereDate('dd',$dd)->where('user_record',Auth::id())->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
        $expansetypes=ExpanseType::where('group_id',-1)->where('company_id',$selcomid)->orderBy('id')->get();
        return view('expanses.index',compact('expanses','banks','currencies','users','expansetypes'));
    }
     public function getexpansereport(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $expanses=Expanse::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid);
        $total=Expanse::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid);

        if($request->type<>0){
            $expanses=$expanses->where('mekun',$request->type);
             $total=$total->where('mekun',$request->type);
        }
         if($request->user){
            $expanses=$expanses->where('user_record',$request->user);
            $total=$total->where('user_record',$request->user);
        }
        $expanses=$expanses->orderBy('id')->get();
        $total=$total->select(DB::raw('currency_id,sum(amount) as total'))->groupBy('currency_id')->get();
        if(isset($request->print)){
             $title=['d1d2'=>$request->d1 . ' To ' . $request->d2];
            $title +=['type'=>$request->typename,'username'=>$request->username];
            return view('expanses.printreport',compact('expanses','total','title'));
        }else{
            return view('expanses.reportlist',compact('expanses','total'));
        }

    }
    public function expansereport()
    {

        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $expanses=Expanse::whereDate('dd',$dd)->where('user_record',Auth::id())->where('status',1)->where('company_id',$selcomid)->orderBy('id')->get();
        $expansetypes=ExpanseType::where('company_id',$selcomid)->orderBy('id')->get();
        $total=Expanse::whereDate('dd',$dd)->where('user_record',Auth::id())->where('status',1)->where('company_id',$selcomid)->select(DB::raw('currency_id,sum(amount) as total'))->groupBy('currency_id')->get();
        return view('expanses.report',compact('expanses','users','expansetypes','total'));
    }
      public function savetype(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'group_id'=>'required',
            'type_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if($request->exptype_id==''){
            $t=new ExpanseType();

        }else{
            $t=ExpanseType::find($request->exptype_id);
        }
        $t->group_id=$request->group_id;
        $t->name=$request->type_name;
        $t->created_at=$current;
        if($t->save()){
            return response()->json(['success'=>'true','message'=>'expanse type has been saved.']);
        }

    }
    public function store(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'expansetype'=>'required',
            'amount' => 'required',
            'selcur'=>'required',
            'amount2' => 'required',
            'txtrate' => 'required',
            'trancode_change'=>'required',
            'seluseraffect'=>'required'

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->trancode==4 || $request->trancode==-4){
            $validator1 = Validator::make($request->all(), [
                'selpartner2'=>'required',
            ]);
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $expanse_type_id=$request->seltype;
        if($request->id1==''){
            if($request->seltype=='' && $request->expansetype<>''){
                $newtype=new ExpanseType();
                $newtype->group_id=$request->mekun;
                $newtype->name=$request->expansetype;
                $newtype->company_id=$selcomid;
                $newtype->save();
                $expanse_type_id=$newtype->id;
            }else if($request->seltype<>'' && $request->expansetype<>''){
                if($request->expansetype<>$request->inputtype){
                    $newtype=ExpanseType::find($request->seltype);
                    $newtype->name=$request->expansetype;
                    $newtype->save();
                }
            }
        }else{
            if($request->seltype<>'' && $request->expansetype<>''){
                if($request->expansetype<>$request->inputtype){
                    $newtype=ExpanseType::find($request->seltype);
                    $newtype->name=$request->expansetype;
                    $newtype->save();
                }
            }
        }


        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $trantime = date("H:i:s",strtotime($current));
        $trantime1=date('H:i:s',strtotime($trantime . ' +1 seconds'));
        if($request->id1==''){
            $ptf=new Expanse();
            $ptf->dd=$trandate;
            $ptf->tt=$trantime;
            $ptf->user_record=Auth::id();
            $ptf->created_at=$current;
        }else{
            $ptf=Expanse::find($request->id1);
        }
        $ptf->company_id=$selcomid;
        $ptf->user_id=$request->seluseraffect;
        $ptf->tranname=$request->tranname;
        $ptf->trancode=$request->trancode_change;
        $ptf->mekun=$request->mekun;
        $ptf->amount=floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
        $ptf->currency_id=$request->selcur;
        $ptf->inusd=floatval($request->mekun) * floatval(str_replace(',','',$request->amount2));
        $ptf->rate=str_replace(',','',$request->txtrate);
        $ptf->expanse_type_id=$expanse_type_id;
        $ptf->type=$request->expansetype;
        $ptf->desr=$request->desr;
        $ptf->customer_id=$request->selpartner2;
        if($ptf->save()){
            if($request->id1==''){
                $id1=$ptf->id;
            }else{
                $id1=$request->id1;
            }
            if($request->trancode_change==4 || $request->trancode_change==-4){
                if($request->id2==''){
                    $ptf1=new PartnerTransfer();
                    $ptf1->ref_number='expanse-'.$id1;
                    $ptf1->ref_group_id='expanse-'.$id1;

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
                //$ptf1->from_partner_id=$request->selpartner;
                $ptf1->amount=-1 * floatval($request->mekun) * floatval(str_replace(',','',$request->amount));
                $ptf1->currency_id=$request->selcur;
                $ptf1->cuscharge=0;
                $ptf1->cuscharge_currency_id=$request->selcur;
                $ptf1->fee=0;
                $ptf1->fee_currency_id=$request->selcur;
                $ptf1->bonus=0;
                $ptf1->interest=0;
                $ptf1->location_id=5;
                if($request->trancode_change==4){
                    $ptf1->sendername=$request->expansetype;
                    $ptf1->recname=$request->bank;
                  }else if($request->trancode_change==-4){
                    $ptf1->sendername=$request->bank;
                    $ptf1->recname=$request->expansetype;
                  }
                $ptf1->sendertel='';
                $ptf1->rectel='';
                $ptf1->note=$request->desr;
                $ptf1->updated_at=$current;
                $ptf1->user_affect=$this->getuseraffectbank($request->selpartner2);
                //$ptf1->user_delete=Auth::id();
                $ptf1->action='';
                if($ptf1->save()){
                    $id2=$ptf1->id;
                    DB::table('expanses')->where('id',$id1)->update(['transfer_id'=>$id2]);
                }
            }

           // $expanses=Expanse::whereDate('dd',$trandate)->where('user_id',Auth::id())->where('status',1)->orderBy('id')->get();

            return response()->json(['success'=>'true','id'=>$id1,'message'=>'expanse has been saved.']);

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
    public function getexpansetypebygroup(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $expansetype=ExpanseType::where('group_id',$request->group_id)->where('company_id',$selcomid)->get();
        return response()->json(['expansetype'=>$expansetype]);
    }
    public function getexpanselist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
          //return $request->all();
        $dd= date('Y-m-d', strtotime($request->d));
          //$userid=Auth::id();
        $expanses=Expanse::whereDate('dd',$dd)->where('status',1)->where('company_id',$selcomid);
        //   $transfers=$transfers->where('user_id',$request->user_id);
          if(isset($request->user_id)){
              if($request->user_id<>'all' && $request->user_id<>''){
                $expanses=$expanses->where('user_record',$request->user_id);
            }
          }

        $expanses=$expanses->orderBy('id')->get();

        return view('expanses.expanselist',compact('expanses'));


    }
    public function edit(Request $request)
    {
        $expanse=Expanse::find($request->id);
        if($expanse){

            $expansetype=ExpanseType::where('group_id',$expanse->mekun)->get();

            return response()->json(['expanse'=>$expanse,'success'=>true,'expansetype'=>$expansetype]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
    public function delete(Request $request)
    {
        if($request->id2<>''){
            $transfer=PartnerTransfer::where('id',$request->id2)->update(['status'=>0,'user_delete'=>Auth::id()]);
            if($transfer){
                $delxpanse=Expanse::where('id',$request->id1)->update(['status'=>0,'delby'=>Auth::user()->name]);
                if($delxpanse){
                    return response()->json(['success'=>true,'message'=>'expanse has been delete']);
                }
            }
        }else{
            $delxpanse=Expanse::where('id',$request->id1)->update(['status'=>0,'delby'=>Auth::user()->name]);
            if($delxpanse){
                return response()->json(['success'=>true,'message'=>'expanse has been delete']);
            }
        }
    }
     public function deletetype(Request $request)
    {
       $type=ExpanseType::find($request->id);
       if($type->delete()){
            return response()->json(['success'=>true,'message'=>'expanse type has been delete']);
       }else{
            return response()->json(['error'=>true,'message'=>'delete expanse type fail']);
       }
    }
}
