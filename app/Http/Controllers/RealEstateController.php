<?php

namespace App\Http\Controllers;

use DateTime;
use App\Address;
use App\Company;
use App\Cashdraw;
use App\Currency;
use App\Customer;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contract;
use App\Models\Property;
use App\PartnerTransfer;
use App\Models\SaleDetail;
use App\Models\NewPayRomlos;
use Illuminate\Http\Request;
use App\Models\PayCommission;
use App\Models\PropertyGroup;
use App\Services\TelegramService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RealEstateController extends Controller
{
    protected $telegramService;
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }
    public function updatesalegroup()
    {
        $buys=PartnerTransfer::where('status',1)->where('trancode',-8)->get();
        foreach($buys as $b)
        {
            $property_groups='';
            $property_id='';
            $sales=SaleDetail::where('status',1)->where('sale_id',$b->id)->get();
            foreach($sales as $s)
            {
                $property_groups=$property_groups . '(' . $s->property->property_group_id . ')';
                $property_id=$property_id . '(' . $s->property_id . ')';
            }
            DB::table('partner_transfers')->where('id',$b->id)->update(['property_group'=>$property_groups,'property_id'=>$property_id]);
            DB::table('partner_transfers')->where('payonid',$b->id)->update(['property_group'=>$property_groups,'property_id'=>$property_id]);
            DB::table('partner_transfers')->where('map_id',$b->id)->where('trancode',8)->update(['property_group'=>$property_groups,'property_id'=>$property_id]);
            DB::table('partner_transfers')->where('payonid',$b->map_id)->update(['property_group'=>$property_groups,'property_id'=>$property_id]);

        }
        return response()->json(['success'=>true,'message'=>'update sale group completed']);
    }
    public function docontract()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $d=explode("-",$dd);
        $d1=$d[2];
        $y1=$d[0];
        $m1=$this->dokhmermonth(floatval($d[1]));
        $logo=Company::find($selcomid);
        $companies=Company::orderBy('id')->get();

        $contracts=Contract::whereDate('reg_date',$dd)->where('status',1)->get();
        $provinces = Address::whereNull('province_id')->get();
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $properties=DB::table('properties')
        ->leftJoin('contracts', 'properties.id','=', 'contracts.property_id')
        ->join('currencies','properties.currency_id','=','currencies.id')
        ->join('property_groups','properties.property_group_id','=','property_groups.id')
        ->where('properties.status',1)->where('properties.isclose',0)->where('property_groups.isclose',0)->where('property_groups.status',1)
        ->select('properties.id as pid','properties.name as pname','properties.size as size','properties.size1 as size1','properties.north','properties.south','properties.east','properties.west','properties.price as price','property_groups.address as property_address','property_groups.name as groupname','properties.com_payoff','properties.com_payloan','properties.currency_id','currencies.shortcut as currency_shortcut','contracts.id as saleid','contracts.status as dstatus')
        ->orderBy('properties.id')->get();
        $jsonitem= json_decode($properties);
        //dd($jsonitem);
        $myproperty=collect();

        foreach($properties as $p){
            $found=0;
            $pid=$p->pid;
            if(is_null($p->saleid)){
                $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,'price'=>$p->price,'address'=>$p->property_address,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'groupname'=>$p->groupname]);
            }else{
                foreach ($jsonitem as $item ) {
                    if ( $pid == $item->pid && $item->dstatus==1 ) {
                        $found = 1;
                    }
                }
                if($found==0){
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'price'=>$p->price,'address'=>$p->property_address,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'groupname'=>$p->groupname]);
                    }
                }
            }
        }
        $users=User::where('active',1)->get();
        return view('realestates.docontract',compact('provinces','myproperty','partners','logo','companies','contracts','d1','m1','y1','users'));
    }
    public function getcontract(Request $request)
    {
        if($request->searchby=='pn'){
            $contracts=Contract::where('propertyname','like','%'.$request->propertyname . '%')->get();
        }else{
            $d1= date('Y-m-d', strtotime($request->d1));
            $d2= date('Y-m-d', strtotime($request->d2));
            if($request->ckcreate=="true"){
                if(isset($request->userid) && $request->userid){
                    $contracts=Contract::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('status',1)->where('user_id',$request->userid)->get();
                }else{
                    $contracts=Contract::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('status',1)->get();
                }
            }else{
                if(isset($request->userid) && $request->userid){
                    $contracts=Contract::whereBetween(DB::raw('DATE(reg_date)'), array($d1, $d2))->where('status',1)->where('user_id',$request->userid)->get();
                }else{
                    $contracts=Contract::whereBetween(DB::raw('DATE(reg_date)'), array($d1, $d2))->where('status',1)->get();
                }
            }
        }
        //return response()->json(['contracts'=>$contracts]);
        return view('realestates.getdocontract',compact('contracts'));
    }
    public function findcontract(Request $request)
    {
        // $d1= date('Y-m-d', strtotime($request->d1));
        // $d2= date('Y-m-d', strtotime($request->d2));
        $contracts=Contract::where('status',1)->where('customer_id',$request->customer_id)->orderBy('id','DESC')->get();
        return response()->json(['contracts'=>$contracts]);
    }
    public function updatetempcommission(Request $request)
    {
        //return $request->all();
        $trf=PartnerTransfer::find($request->id);
        if($trf){
            $trf->temp_amount=str_replace(',','',$request->commission);
            $trf->save();

        }
    }
    public function deletecontract(Request $request)
    {
        $del=Contract::where('id',$request->id)->delete();
        if($del){
            return response()->json(['success'=>true,'message'=>'this group has been removed']);
        }else{
            return response()->json(['error'=>true,'message'=>'remove fail.']);
        }
    }
    public function editcontract(Request $request)
    {
        $contract=Contract::find($request->id)->load('buyer','saler','property');
        return response()->json(['contract'=>$contract]);
    }
    public function printcontract(Request $request)
    {
        //return $request->all();
        $logo=Company::orderBy('id')->first();
        $ct=Contract::find($request->id);
        if($ct->name_bb){
            return view('realestates.printcontract1',compact('logo','ct'));
        }else{
            return view('realestates.printcontract',compact('logo','ct'));
        }
    }
    public function checkcontract(Request $request)
    {
        $check=Contract::where('status',1)->where('customer_id',$request->customerid)->where('saler_id',$request->salerid)->where('property_id',$request->pid)->exists();
        return response()->json(['check'=>$check]);

    }
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();
        // $projects=PropertyGroup::where('status',1)->orderBy('id','DESC')->get();
        // $allproperty=Property::where('status',1)->get();
        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $projects=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $projects=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        $properties=DB::table('properties')
        ->leftJoin('sale_details', 'properties.id','=', 'sale_details.property_id')
        ->join('currencies','properties.currency_id','=','currencies.id')
        ->where('properties.status',1)
        ->select('properties.id as pid','properties.name as pname','properties.property_group_id as pgroupid','properties.size as size','properties.size1 as size1','properties.price as price','properties.com_payoff','properties.com_payloan','properties.currency_id','currencies.shortcut as currency_shortcut','sale_details.sale_id as saleid','sale_details.status as dstatus')
        ->orderBy('properties.id')->get();
        $jsonitem= json_decode($properties);
        //dd($jsonitem);
        $myproperty=collect();

        foreach($properties as $p){
            $found=0;
            $pid=$p->pid;
            if(is_null($p->saleid)){
                $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'pgroupid'=>$p->pgroupid,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus]);
            }else{
                foreach ($jsonitem as $item ) {
                    if ( $pid == $item->pid && $item->dstatus==1 ) {
                        $found = 1;
                    }
                }
                if($found==0){
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'pgroupid'=>$p->pgroupid,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus]);
                    }
                }
            }
        }
        //dd($myproperty);
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $transfers=PartnerTransfer::whereDate('created_at',$dd)->where('user_id',Auth::id())->where('status',1)->where('location_id',8)->where('trancode',-8)->orderBy('id')->get();
        return view('realestates.index',compact('partners','currencies','myproperty','transfers','projects','users','allproperty'));
    }
    public function getsalelist(Request $request)
    {
        //return $request->all();
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        if($request->status==2){
            $saleids=SaleDetail::where('status',1)->where('property_id',$request->pid)->pluck('sale_id');
            $transfers=PartnerTransfer::whereIn('id',$saleids)->get();
        }else{
            if($request->ckcreate=="true"){
                $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('status',$request->status)->where('location_id',$request->location_id)->where('trancode',-8);
            }else{
                $transfers=PartnerTransfer::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',$request->status)->where('location_id',$request->location_id)->where('trancode',-8);
            }
            if(isset($request->userid) && $request->userid){
                $transfers=$transfers->where('user_id',$request->userid);
            }
            $transfers=$transfers->orderBy('id')->get();
        }
        //dd($transfers);
        return view('realestates.gettransferlist',compact('transfers'));

    }
    public function soldpropertylist(Request $request)
    {

        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
        // $transfers=PartnerTransfer::where('status',1)->where('trancode',-8)->where('loancomplete',0)->orderBy('id')->get();
        // foreach($transfers as $t){
        //     $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
        //     $t['deposited']=$deposited;
        // }

        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        return view('realestates.propertysoldlist',compact('partners','currencies','allproperty','groups'));

    }
   public function getpaidcommission(Request $request)
    {
        // Convert to proper date format
        $d1 = date('Y-m-d', strtotime($request->d1));
        $d2 = date('Y-m-d', strtotime($request->d2));

        $paidcoms = PayCommission::where('status',1)
            ->where(function ($q) use ($d1, $d2) {
                $q->whereBetween(DB::raw('DATE(d1)'), [$d1, $d2])
                ->orWhereBetween(DB::raw('DATE(d2)'), [$d1, $d2])
                ->orWhereBetween(DB::raw('DATE(dd)'), [$d1, $d2]);

            })
            ->orderBy('id', 'desc')
            ->get();

        return view('realestates.getpaidcommission', compact('paidcoms'));
    }

    public function getcommissionlistall(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $printdate=date('d-m-Y',strtotime($current));
        $printdate1=explode('-',$printdate);
        $printday=$printdate1[0];
        $printyear=$printdate1[2];
        $printmonth=$this->dokhmermonth(floatval($printdate1[1]));
        $printdatetext='ប.ជ, ថ្ងៃទី ' . $printday . ' ខែ ' . $printmonth . ' ឆ្នាំ ' . $printyear;
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        if($request->seldata==0){ //មិនទាន់ទូទាត់
            $transfers=PartnerTransfer::where('status',1)->where('location_id',8)
            ->where(function($q) use($d1,$d2){
                $q->where(function($q1) use($d1,$d2){
                     $q1->whereBetween(DB::raw('DATE(payformonth)'), array($d1, $d2))->where('amount',0)->whereIn('trancode',[-1,-4])->whereNull('ispaytosaler');
                })->orWhere(function($q2) use($d1){
                    $q2->WhereDate('payformonth','<',$d1)->where('amount',0)->whereIn('trancode',[-1,-4])->whereNull('ispaytosaler');
                })->orWhere(function($q3) use($d1,$d2){
                    $q3->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('amount',0)->whereIn('trancode',[-1,-4])->whereNull('ispaytosaler');
                });
            });

        }else if($request->seldata==1){ // ទូទាត់រួចរាល់
            $transfers=PartnerTransfer::where('status',1)->where('location_id',8)
             ->where(function($q) use($d1,$d2){
                $q->where(function($q1) use($d1,$d2){
                     $q1->whereBetween(DB::raw('DATE(payformonth)'), array($d1, $d2))->where('amount','<>',0)->whereIn('trancode',[-1,-4])->where('ispaytosaler',1);
                })->orWhere(function($q3) use($d1,$d2){
                    $q3->whereBetween(DB::raw('DATE(created_at)'), array($d1, $d2))->where('amount','<>',0)->whereIn('trancode',[-1,-4])->where('ispaytosaler',1);
                });
            });

        }else{
            $transfers=PartnerTransfer::where('status',1)->where('location_id',8)->whereBetween(DB::raw('DATE(payformonth)'), array($d1, $d2))->whereIn('trancode',[-1,-4])
            ->where(function($q){
                $q->where('amount',0)->orWhere('ispaytosaler',1);
            });

        }
        if(isset($request->saler) && $request->saler){
            $transfers=$transfers->where('parrent_id',$request->saler);
        }
        if(isset($request->selgroup) && $request->selgroup){
            $selgroup=$request->selgroup;
            $transfers = $transfers
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('property_group', 'like', '%(' . $g . ')%');
                }
            });
        }
        if(isset($request->pid) && $request->pid){
            $transfers=$transfers->where('property_id','like','%('.$request->pid.')%');
        }
        //$transfers=$transfers->orderBy('payformonth')->get();
        $transfers=$transfers->orderBy('sendername')->get();

          foreach($transfers as $t){
            $getcustomerpaymentrow=PartnerTransfer::where('id',$t->map_id)->first();
            $t['customername']=$getcustomerpaymentrow->partner->name??'';
            $t['deposit_date']=$getcustomerpaymentrow->dd??'';
            $t['deposit_time']=$getcustomerpaymentrow->tt??'';
            $t['deposit_amount']=$getcustomerpaymentrow->amount??'0';
            $t['payformonth']=$getcustomerpaymentrow->payformonth??'';
            ////////////////////////
            $payonid=$getcustomerpaymentrow->payonid??'0';
            $soldamt=PartnerTransfer::where('id',$payonid)->first();
            //////////////////////
            $t['sold_amount']=$soldamt->amount??'0';
            $t['propertyname']=$soldamt->sendername??'';

            $t['main_id']=$soldamt->id??'';
            $t['main_parrent_id']=$soldamt->parrent_id??'';
            $t['main_customertype']=$soldamt->partner->customertype??'';
            $t['main_term']=$soldamt->term??'';
            $t['main_interest_rate']=$soldamt->interest_rate??'';
            $t['main_startdate']=$soldamt->startdate??'';
            $t['main_enddate']=$soldamt->enddate??'';
            $t['main_payinmonth']=$soldamt->payinmonth??'';
            $t['main_property_id']=$soldamt->property_id??'';
            $t['main_property_group']=$soldamt->property_group??'';

            //////////////////////////
            $totaldeposit = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $getcustomerpaymentrow->parrent_id??'0')
            ->where('payonid', $payonid)
            ->where('id', '<>', $payonid)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow = $totaldeposit->countrow ?? 0;
            $sumdeposit = $totaldeposit->sumamt ?? 0;
            ///////////////////////
            $t['countrow']=$countrow;
            $t['sumdeposit']=$sumdeposit;

            $commission=PartnerTransfer::where('id',$t->payonid)->first();
            $t['commission']=$commission->amount??0;
            $totalpay_commission = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('id', '<>', $payonid)
            //->where('amount','<>',0)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow1 = $totalpay_commission->countrow ?? 0;
            $sumdeposit1 = $totalpay_commission->sumamt ?? 0;
            $sum_temp_amount =PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('amount',0)
            ->sum('temp_amount');
            $commissionamount=$commission->amount??0;
            if($commissionamount<abs($sumdeposit1)+abs($sum_temp_amount)){
                $t['over_pay']=1;
            }else{
                $t['over_pay']=0;
            }
            $t['getcommission']=$t->temp_amount??0;
            $t['countpay_commission']=$countrow1;
            $t['commission_paid']=$sumdeposit1;
        }
        if(isset($request->isprint)){

            $rpttitle='របាយការណ៏ទូទាត់កម្រៃជើងសារ ' .$request->salername;

            return view('realestates.getcommissionlistprint',compact('transfers','rpttitle','d1','d2','printdatetext'));
        }else{
            return view('realestates.getcommissionlistall',compact('transfers'));
        }
    }
    public function getcommissionlist(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $printdate=date('d-m-Y',strtotime($current));
        $printdate1=explode('-',$printdate);
        $printday=$printdate1[0];
        $printyear=$printdate1[2];
        $printmonth=$this->dokhmermonth(floatval($printdate1[1]));
        $printdatetext='ប.ជ, ថ្ងៃទី ' . $printday . ' ខែ ' . $printmonth . ' ឆ្នាំ ' . $printyear;
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));

        if($request->alldate=='true'){
            if($request->removed=='true'){
                $transfers=PartnerTransfer::where('status',0)->where('location_id',8)
                ->where(function($q){
                    $q->where(function($q1){
                        $q1->where('trancode',-1)->where('amount',0);
                    })->orWhere(function($q2){
                        $q2->where('ispaytosaler',1);
                    });
                });
            }else{
                $transfers=PartnerTransfer::where('status',1)->where('location_id',8)
                ->where(function($q){
                    $q->where(function($q1){
                        $q1->where('trancode',-1)->where('amount',0);
                    })->orWhere(function($q2){
                        $q2->where('ispaytosaler',1);
                    });
                });
            }
        }else{
             if($request->removed=='true'){
                $transfers=PartnerTransfer::where('status',0)->where('location_id',8)->whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))
                 ->where(function($q){
                     $q->where(function($q1){
                         $q1->where('trancode',-1)->where('amount',0);
                     })->orWhere(function($q2){
                         $q2->where('ispaytosaler',1);
                     });
                 });
             }else{
                 $transfers=PartnerTransfer::where('status',1)->where('location_id',8)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))
                 ->where(function($q){
                     $q->where(function($q1){
                         $q1->where('trancode',-1)->where('amount',0);
                     })->orWhere(function($q2){
                         $q2->where('ispaytosaler',1);
                     });
                 });
             }
        }
        if(isset($request->saler) && $request->saler){
            $transfers=$transfers->where('parrent_id',$request->saler);
        }
        if(isset($request->block) && $request->block){
            $transfers=$transfers->where('property_group','like','%('.$request->block.')%');
        }
        if(isset($request->pid) && $request->pid){
            $transfers=$transfers->where('property_id','like','%('.$request->pid.')%');
        }
        $transfers=$transfers->get();
        foreach($transfers as $t){
            $getcustomerpaymentrow=PartnerTransfer::where('id',$t->map_id)->first();
            $t['customername']=$getcustomerpaymentrow->partner->name??'';
            $t['deposit_date']=$getcustomerpaymentrow->dd??'';
            $t['deposit_time']=$getcustomerpaymentrow->tt??'';
            $t['deposit_amount']=$getcustomerpaymentrow->amount??0;
            $t['payformonth']=$getcustomerpaymentrow->payformonth;
            ////////////////////////
            $payonid=$getcustomerpaymentrow->payonid??0;
            $soldamt=PartnerTransfer::where('id',$payonid)->first();
            //////////////////////
            $t['sold_amount']=$soldamt->amount??0;
            $t['propertyname']=$soldamt->sendername??'';
            $t['main_id']=$soldamt->id??'';
            $t['main_parrent_id']=$soldamt->parrent_id??'';
            $t['main_customertype']=$soldamt->partner->customertype??'';
            $t['main_term']=$soldamt->term??'';
            $t['main_interest_rate']=$soldamt->interest_rate??'';
            $t['main_startdate']=$soldamt->startdate??'';
            $t['main_enddate']=$soldamt->enddate??'';
            $t['main_payinmonth']=$soldamt->payinmonth??'';
            $t['main_property_id']=$soldamt->property_id??'';
            $t['main_property_group']=$soldamt->property_group??'';

            //////////////////////////
            $totaldeposit = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $getcustomerpaymentrow->parrent_id??0)
            ->where('payonid', $payonid)
            ->where('id', '<>', $payonid)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow = $totaldeposit->countrow ?? 0;
            $sumdeposit = $totaldeposit->sumamt ?? 0;
            ///////////////////////
            $t['countrow']=$countrow;
            $t['sumdeposit']=$sumdeposit;
            //////////////////////////////
            // $totalpay=PartnerTransfer::where('status',1)->where('parrent_id',$t->parrent_id)->where('payonid',$t->payonid)->sum('amount');
            // $t['commission_paid']=$totalpay;
            $commission=PartnerTransfer::where('id',$t->payonid)->first();
            $t['commission']=$commission->amount;
            $totalpay_commission = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('id', '<>', $payonid)
            ->where('amount','<>',0)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow1 = $totalpay_commission->countrow ?? 0;
            $sumdeposit1 = $totalpay_commission->sumamt ?? 0;
            $t['countpay_commission']=$countrow1;
            $t['commission_paid']=$sumdeposit1;

        }
        if(isset($request->isprint)){

            $rpttitle='របាយការណ៏ទូទាត់កម្រៃជើងសារ ' .$request->salername;

            return view('realestates.getcommissionlistprint',compact('transfers','rpttitle','d1','d2','printdatetext'));
        }else{
            return view('realestates.getcommissionlist',compact('transfers'));
        }
    }
    public function commissionreport(Request $request)
    {
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        return view('realestates.commissionreport',compact('groups','partners','currencies','allproperty'));
    }
    public function commissionlist(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=Date('Y-m-d',strtotime($current));
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        // $transfers=PartnerTransfer::where('status',1)->where('location_id',8)
        // ->where(function($q) use($dd){
        //     $q->where(function($q1){
        //         $q1->where('trancode',-1)->where('amount',0);
        //     })->orWhere(function($q2) use($dd){
        //         $q2->where('ispaytosaler',1)->whereDate('dd',$dd);
        //     });
        // })->get();

        $transfers=PartnerTransfer::where('status',1)->where('location_id',8)->whereDate('dd',$dd)
        ->where(function($q){
            $q->where(function($q1){
                $q1->where('trancode',-1)->where('amount',0);
            })->orWhere(function($q2){
                $q2->where('ispaytosaler',1);
            });
        })->get();

        foreach($transfers as $t){
            $getcustomerpaymentrow=PartnerTransfer::where('id',$t->map_id)->first();
            $t['customername']=$getcustomerpaymentrow->partner->name??'';
            $t['deposit_date']=$getcustomerpaymentrow->dd??'';
            $t['deposit_time']=$getcustomerpaymentrow->tt??'';
            $t['deposit_amount']=$getcustomerpaymentrow->amount??'0';
            $t['payformonth']=$getcustomerpaymentrow->payformonth;
            ////////////////////////
            $payonid=$getcustomerpaymentrow->payonid??'0';
            $soldamt=PartnerTransfer::where('id',$payonid)->first();
            //////////////////////
            $t['sold_amount']=$soldamt->amount??'0';
            $t['propertyname']=$soldamt->sendername??'';
            //$t['sold_amount']=$soldamt->amount;
            $t['propertyname']=$soldamt->sendername;
            $t['main_id']=$soldamt->id;
            $t['main_parrent_id']=$soldamt->parrent_id;
            $t['main_customertype']=$soldamt->partner->customertype;
            $t['main_term']=$soldamt->term;
            $t['main_interest_rate']=$soldamt->interest_rate;
            $t['main_startdate']=$soldamt->startdate;
            $t['main_enddate']=$soldamt->enddate;
            $t['main_payinmonth']=$soldamt->payinmonth;
            $t['main_property_id']=$soldamt->property_id;
            $t['main_property_group']=$soldamt->property_group;

            //////////////////////////
            $totaldeposit = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $getcustomerpaymentrow->parrent_id??'0')
            ->where('payonid', $payonid)
            ->where('id', '<>', $payonid)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow = $totaldeposit->countrow ?? 0;
            $sumdeposit = $totaldeposit->sumamt ?? 0;
            ///////////////////////
            $t['countrow']=$countrow;
            $t['sumdeposit']=$sumdeposit;
            //////////////////////////////
            // $totalpay=PartnerTransfer::where('status',1)->where('parrent_id',$t->parrent_id)->where('payonid',$t->payonid)->sum('amount');
            // $t['commission_paid']=$totalpay;
            $commission=PartnerTransfer::where('id',$t->payonid)->first();
            $t['commission']=$commission->amount;
            $totalpay_commission = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('id', '<>', $payonid)
            ->where('amount','<>',0)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow1 = $totalpay_commission->countrow ?? 0;
            $sumdeposit1 = $totalpay_commission->sumamt ?? 0;
            $t['countpay_commission']=$countrow1;
            $t['commission_paid']=$sumdeposit1;
        }
        $salers=Customer::where('status',1)->where('customertype','SALER')->get();
        return view('realestates.commissionlist',compact('transfers','partners','currencies','salers','allproperty','groups'));
    }
    public function commissionlistall(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd=$current;
        $month = $dd->format('m');   // "01"–"12"
        $year = $dd->year;       // example: 2025
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();

        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        $transfers=PartnerTransfer::where('status',1)
        ->where('location_id',8)
        ->whereMonth('payformonth', $month)
        ->whereYear('payformonth', $year)
        ->whereIn('trancode',[-1,-4])
        ->where('amount',0)
        ->whereNull('ispaytosaler')
        ->orderBy('id')
        ->get();
        //return $transfers;
        foreach($transfers as $t){
            $getcustomerpaymentrow=PartnerTransfer::where('id',$t->map_id)->first();
            $t['customername']=$getcustomerpaymentrow->partner->name??'';
            $t['deposit_date']=$getcustomerpaymentrow->dd??'';
            $t['deposit_time']=$getcustomerpaymentrow->tt??'';
            $t['deposit_amount']=$getcustomerpaymentrow->amount??'0';
            $t['payformonth']=$getcustomerpaymentrow->payformonth??'';
            ////////////////////////
            $payonid=$getcustomerpaymentrow->payonid??'0';
            $soldamt=PartnerTransfer::where('id',$payonid)->first();
            //////////////////////
            if($soldamt){
                $t['sold_amount']=$soldamt->amount??'0';
                $t['propertyname']=$soldamt->sendername??'';
                $t['main_id']=$soldamt->id;
                $t['main_parrent_id']=$soldamt->parrent_id;
                $t['main_customertype']=$soldamt->partner->customertype;
                $t['main_term']=$soldamt->term;
                $t['main_interest_rate']=$soldamt->interest_rate;
                $t['main_startdate']=$soldamt->startdate;
                $t['main_enddate']=$soldamt->enddate;
                $t['main_payinmonth']=$soldamt->payinmonth;
                $t['main_property_id']=$soldamt->property_id;
                $t['main_property_group']=$soldamt->property_group;
            }

            //////////////////////////
            $totaldeposit = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $getcustomerpaymentrow->parrent_id??'0')
            ->where('payonid', $payonid)
            ->where('id', '<>', $payonid)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow = $totaldeposit->countrow ?? 0;
            $sumdeposit = $totaldeposit->sumamt ?? 0;
            ///////////////////////
            $t['countrow']=$countrow;
            $t['sumdeposit']=$sumdeposit;

            $commission=PartnerTransfer::where('id',$t->payonid)->first();
            $t['commission']=$commission->amount??0;
            $totalpay_commission = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('id', '<>', $payonid)
            //->where('amount','<>',0)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $countrow1 = $totalpay_commission->countrow ?? 0;
            $sumdeposit1 = $totalpay_commission->sumamt ?? 0;
            $sum_temp_amount =PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->payonid)
            ->where('amount',0)
            ->sum('temp_amount');
            if($commission->amount??0<abs($sumdeposit1)+abs($sum_temp_amount)){
                $t['over_pay']=1;
            }else{
                $t['over_pay']=0;
            }
            $t['getcommission']=$t->temp_amount;
            $t['countpay_commission']=$countrow1;
            $t['commission_paid']=$sumdeposit1;
        }
        $salers=Customer::where('status',1)->where('customertype','SALER')->get();
        return view('realestates.commissionlistall',compact('transfers','partners','currencies','salers','allproperty','groups'));
    }
    public function paidcommissionlistall(Request $request)
    {
       // return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $selcomid=Session('log_into_company_id');
        $selbank = $request->input('selbank');
        $selbanktext = $request->input('selbanktext');
        $dd = $request->input('dd');
        $d1 = $request->input('d1');
        $d2 = $request->input('d2');
        $d1=Date('Y-m-d',strtotime($d1));
        $d2=Date('Y-m-d',strtotime($d2));
        $totalcom=$request->input('totalcom');
        $trandate=Date('Y-m-d',strtotime($dd));
        $items = $request->input('items'); // array of {id, amount}
        $cur=Currency::where('shortcut','USD')->where('company_id',$selcomid)->first();
        $curid=$cur->id;
        $trancode='';
        $total_commission=0;
        if (empty($items) || !is_array($items)) {
            return response()->json(['success' => false, 'message' => 'No data received']);
        }

        DB::beginTransaction();
        try{
            $paycom=new PayCommission();
            $paycom->dd=$trandate;
            $paycom->tt=$trantime;
            $paycom->user_id=Auth::id();
            $paycom->amount=str_replace(',','',$totalcom);
            $paycom->cur='USD';
            $paycom->payment_type=$selbanktext;
            $paycom->note='';
            $paycom->saler=$request->input('saler');
            $paycom->selblock=$request->input('selblock');
            $paycom->d1=$d1;
            $paycom->d2=$d2;
            $paycom->save();
            $paycom_id=$paycom->id;
            foreach ($items as $item) {
                $id = $item['id'];
                $amount = str_replace(',', '', $item['amount']);
                $total_commission+=floatval($amount);


                if($selbank<>'cash'){
                    $trancode=-4 ;
                    $cash=0;
                    $bank=$amount;
                }else{
                    $trancode=-1;
                    $cash=$amount;
                    $bank=0;
                }

                DB::table('partner_transfers')
                    ->where('id', $id)
                    ->update([
                        'dd' => $trandate,
                        'tt' => $trantime,
                        'trancode' => $trancode,
                        'ispaytosaler'   => 1,
                        'amount'         => -1 * $amount,
                        'temp_amount'   => $amount,
                        'user_update_id' => Auth::id(),
                        'deposit_via' => $selbanktext,
                        'deposit_via_id' => $selbank,
                        'cash_amount' => $cash,
                        'bank_amount' => $bank,
                        'pay_commission_id' => $paycom_id,
                        'updated_at' => $current,
                    ]);
            }

            if($trancode==-4){
                    //save to bank
                    $ptf1=new PartnerTransfer();
                    $ptf1->tranname='បាញ់ចេញ';
                    $ptf1->trancode=4;
                    $ptf1->mekun=1;
                    $ptf1->dd=$trandate;
                    $ptf1->tt=date('H:i:s',strtotime($trantime . ' +1 seconds'));
                    $ptf1->user_id=Auth::id();
                    $ptf1->parrent_id=$selbank;

                    $ptf1->amount= $total_commission;
                    $ptf1->currency_id=$curid;
                    $ptf1->cuscharge=0;
                    $ptf1->cuscharge_ex=0;
                    $ptf1->cuscharge_currency_id=$curid;
                    $ptf1->fee=0;
                    $ptf1->fee_ex=0;
                    $ptf1->fee_currency_id=$curid;
                    $ptf1->bonus=0;
                    $ptf1->ref_group_id='paycommissionall-'.$paycom_id;
                    $ptf1->pay_commission_id=$paycom_id;

                    $ptf1->recname='';
                    $ptf1->note='ទូទាត់កម្រៃជើងសារសរុប';
                    $ptf1->isbank=1;
                    $ptf1->location_id=8;
                    $ptf1->created_at=$current;
                    $ptf1->updated_at=$current;
                $ptf1->save();
            }else{
                //save cashdraw
                $cashdraw=new Cashdraw();
                $cashdraw->from_partner_id='0';
                $cashdraw->transfer_id='0';
                $cashdraw->opdate=$trandate;
                $cashdraw->optime=date('H:i:s',strtotime($trantime . ' +1 seconds'));
                $cashdraw->user_id=Auth::id();
                $cashdraw->amount=$total_commission;
                $cashdraw->currency_id=$curid;
                $cashdraw->customer_charge=0;
                $cashdraw->cuscharge_currency_id=$curid;
                $cashdraw->paymethod='Cash';
                $cashdraw->receive_tel='';
                $cashdraw->receive_name='';
                $cashdraw->note=$request->note;
                $cashdraw->other='';
                $cashdraw->ref_number=$paycom_id;
                $cashdraw->ref_group_id='paycommissionall-' . $paycom_id;
                $cashdraw->pay_commission_id=$paycom_id;
                $cashdraw->action='';
                $cashdraw->created_at=$current;
                $cashdraw->updated_at=$current;
                $cashdraw->save();
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'count'   => count($items),
                'group_id' => $paycom_id, // ✅ return it to frontend if needed
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function customerromloslist(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        // $transfers=PartnerTransfer::where('status',1)->whereNotNull('nextpayment')->where('loancomplete',0)->orderBy('id','DESC')->get()->unique(['payonid']);
        // foreach($transfers as $t){

        //     $buyinv=PartnerTransfer::where('id',$t->payonid)->where('status',1)->first();
        //     if($buyinv){
        //         $t['main_amount']=$buyinv->amount;
        //         $t['main_id']=$buyinv->id;
        //         $t['main_dd']=$buyinv->dd;
        //         $t['main_property']=$buyinv->sendername;
        //         $t['buyer']=$buyinv->partner->name;
        //         $t['saler']=$buyinv->customer->name;
        //         $t['main_cuscharge']=$buyinv->cuscharge;
        //         $t['main_saveby']=$buyinv->user->name;
        //         $t['main_note']=$buyinv->note;
        //         $t['main_tel']=$buyinv->partner->tel;
        //         $t['main_idcard']=$buyinv->partner->idcard;
        //         $t['main_term']=$buyinv->term;
        //         $t['main_interest_rate']=$buyinv->interest_rate;
        //         $t['main_startdate']=$buyinv->startdate;
        //         $t['main_enddate']=$buyinv->enddate;
        //         $t['main_payinmonth']=$buyinv->payinmonth;
        //         $t['main_parrent_id']=$buyinv->parrent_id;
        //         $t['main_customertype']=$buyinv->partner->customertype;

        //     }
        //     $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->payonid)->where('payonid',$t->payonid)->where('parrent_id',$t->parrent_id)->sum('amount');
        //     $t['deposited']=$deposited;
        //     $current = Carbon::now();
        //     $current->timezone('Asia/Phnom_Penh');
        //     $today = date("Y-m-d",strtotime($current));
        //     $diff=date_diff(date_create($today),date_create($t->nextpayment));
        //     $qtyleftday=$diff->format("%R%a");
        //     $t['qtyleftday']=$qtyleftday;
        //     $t['cuschargeoverday']=5;


        // }
        // $transfers=$transfers->sortBy('qtyleftday');
        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }

        return view('realestates.propertysoldlist_romlos',compact('groups','partners','currencies','allproperty'));

    }
    public function deletenewpayromlos(Request $request)
    {
        $newpayromlos=NewPayRomlos::find($request->id);
        if($newpayromlos){
            if($newpayromlos->status==1){
                $newpayromlos->status=0;
                $newpayromlos->save();
            }else{
                if($request->restore==1){
                    $newpayromlos->status=1;
                    $newpayromlos->save();
                }else{
                    $newpayromlos->delete();
                }
            }

        }
        if($request->txtstatus==2){
            $newpayment=NewPayRomlos::with('currency','user')->where('transfer_id',$request->transfer_id)->get();
        }else{
            $newpayment=NewPayRomlos::with('currency','user')->where('transfer_id',$request->transfer_id)->where('status',$request->status)->get();
        }
         return response()->json(['success'=>true,'message'=>'delete new payment completed','newpaylist'=>$newpayment]);
    }
    public function updateterm(Request $request)
    {
        //return($request->all());
        $startdate= date('Y-m-d', strtotime($request->startdate));
        $enddate= date('Y-m-d', strtotime($request->enddate));

        $transfer=PartnerTransfer::find($request->id);
        $transfer->term=$request->term;
        $transfer->startdate=$startdate;
        $transfer->enddate=$enddate;
        $transfer->save();

    }
    public function updatecommissionlink(Request $request)
    {
        //return $request->all();
        $pr=PartnerTransfer::find($request->tid);
        if($pr){
            $mekun=$request->mekun;
            $amount=str_replace(',','',$request->amount);

            $pr->parrent_id=$request->selpartner;
            $pr->amount=floatval($mekun) * floatval($amount);
            $pr->map_id=$request->mapid;
            $pr->save();
        }

    }
    public function savenewpayromlos(Request $request)
    {
        //return($request->all());

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $dd = str_replace('/', '-', $request->dd);
        $record_date= date('Y-m-d', strtotime($dd));
        $d1 = str_replace('/', '-', $request->d1);
        $start_date= date('Y-m-d', strtotime($d1));
        $d2 = str_replace('/', '-', $request->d2);
        $end_date= date('Y-m-d', strtotime($d2));

         $validator = Validator::make($request->all(), [
            'payamtnew'=>'required',
            'selcur_paynew' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->newpayid>0){
            $newpay=NewPayRomlos::find($request->newpayid);
        }else{
            $newpay=new NewpayRomLos();
        }
        $newpay->transfer_id=$request->saleid_newpay;
        $newpay->user_id=Auth::id();
        $newpay->dd=$record_date;
        $newpay->start_date=$start_date;
        $newpay->end_date=$end_date;
        $newpay->amount=str_replace(',','',$request->payamtnew);
        $newpay->currency_id=$request->selcur_paynew;
        $newpay->note=$request->note_newpay;
        if($newpay->save()){
            $newpayment=NewPayRomlos::with('currency','user')->where('transfer_id',$request->saleid_newpay)->where('status',1)->get();
            return response()->json(['success'=>true,'message'=>'set new payment completed','newpaylist'=>$newpayment]);
        }else{
             return response()->json(['error'=>true,'message'=>'set new payment fail']);
        }

    }
    public function getnewpayment(Request $request)
    {
        if($request->status==2){
             $newpayment=NewPayRomlos::with('currency','user')->where('transfer_id',$request->id)->get();
        }else{
            $newpayment=NewPayRomlos::with('currency','user')->where('transfer_id',$request->id)->where('status',$request->status)->get();
        }
        $transfer = PartnerTransfer::with('currency')->find($request->id);
        return response()->json(['newpayment'=>$newpayment,'transfer'=>$transfer]);
    }
    public function showcommissionpaid_detail(Request $request)
    {
        $transfers=PartnerTransfer::where('status',1)->where('payonid',$request->payonid)->get();
        foreach($transfers as $t){
            $custr=PartnerTransfer::where('status',1)->where('id',$t->map_id)->first();
            $t['customer_dd']=$custr->dd;
            $t['customer_paymonth']=$custr->payformonth??$custr->dd;
            $t['customer_payamt']=$custr->amount;
        }
        return view('realestates.showcommissionpaid_detail',compact('transfers'));
    }
    public function linkpaycommission(Request $request)
    {
        $transfers=PartnerTransfer::where('status',1)->where('pay_commission_id',$request->id)->orderBy('id')->get();
        return view('realestates.showlinkpaycommission',compact('transfers'));
    }
     public function showcommissionlink(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->whereIn('customertype',['BUYER','SALER','BANK','AGENT'])->orderBy('no')->get();
        $transfers=PartnerTransfer::where('status',1)->where('ref_group_id',$request->group_id)->orderBy('id')->get();
        return view('realestates.showcommissionlink',compact('transfers','partners'));
    }
    public function showcommissionpaid(Request $request)
    {
        //return $request->all();
        //$selgroup = is_array($request->selgroup) ? implode(',', $request->selgroup) : $request->selgroup;
        $transfers=PartnerTransfer::where('status',1)->where('loancomplete',0)->where('trancode',8);
        if($request->property_id){
            $transfers=$transfers->where('property_id','like','%('.$request->property_id.')%');
        }
        if($request->customer){
            $transfers=$transfers->where('parrent_id',$request->customer);
        }

        if(isset($request->selgroup) && $request->selgroup){
            //$transfers=$transfers->where('property_group','like','%('.$request->selgroup.')%');
             //$selgroup=explode(",",$request->selgroup);
             $selgroup=$request->selgroup;
            $transfers = $transfers
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('property_group', 'like', '%(' . $g . ')%');
                }
            });
        }

        $transfers=$transfers->orderBy('id')->get();
        foreach($transfers as $t){
            // $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
            // $t['deposited']=$deposited;
            // $t['balance']=$t->amount+$deposited;

            $deposited = PartnerTransfer::where('status', 1)
            ->where('parrent_id', $t->parrent_id)
            ->where('payonid', $t->id)
            ->where('id', '<>', $t->id)
            ->where('amount','<>',0)
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
            ->first();
            $t['countpay']=$deposited->countrow ?? 0;
            $t['deposited']=$deposited->sumamt ?? 0;

        }
        $transfers=$transfers->sortByDesc('balance');
        if(isset($request->isprint)){
            $rpttitle='របាយការណ៏កម្រៃជើងសារ';
            $blockname=$request->blockname;
            $customername=$request->customername;
            return view('realestates.commissionpaidprint',compact('transfers','rpttitle','blockname','customername'));
        }else{
            return view('realestates.showcommissionpaid',compact('transfers'));
        }
    }
    public function searchcustomerpayromlos(Request $request)
    {
        $selgroup=$request->selgroup;
        if($request->selgroup=='all' || $selgroup==''){
            if($request->property_id){
                $saleid=SaleDetail::where('status',1)->where('property_id',$request->property_id)->pluck('sale_id')->toArray();
                $transfers=PartnerTransfer::where('status',1)->whereIn('payonid',$saleid)->whereNotNull('nextpayment')->orderBy('id','DESC')->get()->unique(['payonid']);
            }else{
                $transfers=PartnerTransfer::where('status',1)->whereNotNull('nextpayment')->where('loancomplete',0)->orderBy('id','DESC')->get()->unique(['payonid']);
            }

        }else{

            $transfers = DB::table('partner_transfers')
            ->join('sale_details', 'sale_details.sale_id', '=', 'partner_transfers.id')
            ->join('properties', 'sale_details.property_id', '=', 'properties.id')
            ->join('currencies', 'partner_transfers.currency_id', '=', 'currencies.id')
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.loancomplete', 0)
            ->whereNotNull('partner_transfers.nextpayment')
            ->where('sale_details.status', 1)
            ->whereIn('properties.property_group_id', $selgroup)
            ->orderBy('partner_transfers.id','DESC')->get()->unique(['payonid']);
        }

        foreach($transfers as $t){
            $buyinv=PartnerTransfer::where('id',$t->payonid)->where('status',1)->first();

                if($buyinv){
                    $t->main_amount=$buyinv->amount;
                    $t->main_shortcut=$buyinv->currency->shortcut;
                    $t->main_id=$buyinv->id;
                    $t->main_dd=$buyinv->dd;
                    $t->main_property=$buyinv->sendername;
                    $t->buyer=$buyinv->partner->name;
                    $t->saler=$buyinv->customer->name;
                    $t->main_cuscharge=$buyinv->cuscharge;
                    $t->main_saveby=$buyinv->user->name;
                    $t->main_note=$buyinv->note;
                    $t->main_tel=$buyinv->partner->tel;
                    $t->main_idcard=$buyinv->partner->idcard;
                    $t->main_paymenttype=$buyinv->paymenttype;
                    $t->main_term=$buyinv->term;
                    $t->main_interest_rate=$buyinv->interest_rate;
                    $t->main_startdate=$buyinv->startdate;
                    $t->main_enddate=$buyinv->enddate;
                    $t->main_payinmonth=$buyinv->payinmonth;
                    $t->main_parrent_id=$buyinv->parrent_id;
                    $t->main_customertype=$buyinv->partner->customertype;
                    $t->main_property_group=$buyinv->property_group;
                    $t->main_property_id=$buyinv->property_id;
                    $nextpayment_main=$buyinv->nextpayment;
                }
            if($request->selgroup!='all'){
                $lastpayment = PartnerTransfer::where('status', 1)
                ->where('id','<>',$t->payonid)
                ->where('payonid', $t->payonid)
                ->whereNotNull('nextpayment')
                ->orderBy('id','DESC')->first();//->unique(['payonid']);
                if($lastpayment){
                    $t->payformonth_new=$lastpayment->payformonth;
                    $t->nextpayment_new=$lastpayment->nextpayment;
                    $nextpayment_new=$lastpayment->nextpayment;
                }else{
                    $t->payformonth_new=$nextpayment_main;
                    $t->nextpayment_new=$nextpayment_main;
                    $nextpayment_new=$nextpayment_main;
                }
            }
            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->payonid)->where('payonid',$t->payonid)->where('parrent_id',$t->parrent_id)->sum('amount');
            //$t['deposited']=$deposited;
            $t->deposited=$deposited;
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $today = date("Y-m-d",strtotime($current));
            if($request->selgroup!='all'){
                $diff=date_diff(date_create($today),date_create($nextpayment_new));
            }else{
                $diff=date_diff(date_create($today),date_create($t->nextpayment));
            }
            $qtyleftday=$diff->format("%R%a");
            // $t['qtyleftday']=$qtyleftday;
            // $t['cuschargeoverday']=5;
            $t->qtyleftday=$qtyleftday;
            $t->cuschargeoverday=5;//5$/day

        }
        $transfers=$transfers->sortBy('qtyleftday');
        if(isset($request->isprint)){
            $rpttitle='របាយការណ៏បិទបញ្ជី សំរាប់ខែ​ ' . $this->dokhmermonth($request->m) . ' ឆ្នាំ ' . $request->y;
            if($request->selgroup=='all'){
                return view('realestates.closelistprint',compact('transfers','rpttitle'));
            }else{
                $blockname=$request->blockname;
                return view('realestates.closelistsearchbyblockprint',compact('transfers','rpttitle','blockname'));
            }
        }else{
            if($request->selgroup=='all'){
                return view('realestates.searchcustomerpayromlos',compact('transfers'));
            }else{
                return view('realestates.searchcustomerpayromlosbyblock',compact('transfers'));
            }
        }
    }
    public function addcommission(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $today = date("Y-m-d",strtotime($current));
        $paytran=PartnerTransfer::find($request->id);
        if($paytran){
            $bought_tran=PartnerTransfer::find($paytran->payonid);
            $sold_tran=PartnerTransfer::where('id',$bought_tran->map_id)->where('trancode',8)->first();
            $saler_id=$sold_tran->parrent_id;

            $ptf2=new PartnerTransfer();
            $ptf2->tranname='ទូទាត់កម្រៃជើងសារ';
            $ptf2->trancode=-1;
            $ptf2->mekun=-1;
            $ptf2->dd=$today;
            $ptf2->tt=$trantime;
            $ptf2->user_id=Auth::id();
            $ptf2->parrent_id=$saler_id;
            $ptf2->amount=0;
            $ptf2->temp_amount=0;

            $ptf2->currency_id=$paytran->currency_id;
            $ptf2->cuscharge=0;
            $ptf2->cuscharge_ex=0;
            $ptf2->cuscharge_currency_id=$paytran->currency_id;
            $ptf2->fee=0;
            $ptf2->fee_ex=0;
            $ptf2->fee_currency_id=$paytran->currency_id;
            $ptf2->bonus=0;
            $ptf2->sendername=$paytran->sendername;
            $ptf2->sendertel='';
            $ptf2->payonid=$sold_tran->id;
            $ptf2->map_id=$paytran->id;
            $ptf2->ref_group_id=$paytran->ref_group_id;
            $ptf2->note='បញ្ចូលបន្ថែមកម្រៃជើងសារ';
            $ptf2->location_id=8;
            $ptf2->created_at=$current;
            $ptf2->updated_at=$current;
            $ptf2->property_group=$paytran->property_group;
            $ptf2->property_id=$paytran->property_id;
            $ptf2->payformonth=$paytran->payformonth;


            if($ptf2->save()){
               return response()->json(['success'=>true]);
            }else{
                 return response()->json(['error'=>true]);
            }
        }


    }
     public function fixpaymentbyid(Request $request)
    {
        $group=explode('-',$request->group_id);
        if($request->id==$group[1]){

            $t=PartnerTransfer::find($request->id);
            if($t->trancode==-8){
                //find id payment
                $t1=PartnerTransfer::where('ref_group_id',$request->group_id)->where('payonid',$t->id)->where('id','<>',$t->id)->where('status',1)->first();
               if ($t1) {
                    $sumpay=PartnerTransfer::where('ref_group_id',$request->group_id)->whereIn('trancode',[1,4])->where('status',1)->where('payonid',$t1->payonid)->sum('amount');
                    $t1->cash_amount = $t1->deposit_via_id === 'cash' ? $sumpay : 0;
                    $t1->bank_amount = $t1->deposit_via_id === 'cash' ? 0 : $sumpay;

                    if ($t1->save()) {
                        return response()->json(['success' => true, 'message' => 'Fixed payment completed']);
                    } else {
                        return response()->json(['error' => true, 'message' => 'Fixed payment failed']);
                    }
                } else {
                    return response()->json(['error' => true, 'message' => 'No eligible transfer found']);
                }
            }else{
                if($t){
                    $current = Carbon::now();
                    $current->timezone('Asia/Phnom_Penh');
                    $main_id=$t->payonid;
                    $maintransfer=PartnerTransfer::find($main_id);
                    if($maintransfer){
                        $saler_id=$maintransfer->customer_id;
                        $commission=$maintransfer->cuscharge;
                        $sumpaycom=PartnerTransfer::where('payonid',$maintransfer->map_id)->where('parrent_id',$saler_id)->where('status',1)->sum('amount');
                        //check if have commission ready
                        $foundcoms=PartnerTransfer::where('ref_group_id',$t->ref_group_id)->where('status',1)->where('payonid',$maintransfer->map_id)->exists();
                        $havecommission = abs($sumpaycom) < abs($commission) ? 1 : 0;
                          if($havecommission==1 && !$foundcoms){
                            $ptf2=new PartnerTransfer();
                            $ptf2->tranname='ទូទាត់កម្រៃជើងសារ';
                            $ptf2->trancode=-1;
                            $ptf2->mekun=-1;
                            $ptf2->dd=$t->dd;
                            $ptf2->tt=$t->tt;
                            $ptf2->user_id=Auth::id();
                            $ptf2->parrent_id=$saler_id;
                            $ptf2->amount=0;
                            $ptf2->temp_amount=0;

                            $ptf2->currency_id=$t->currency_id;
                            $ptf2->cuscharge=0;
                            $ptf2->cuscharge_ex=0;
                            $ptf2->cuscharge_currency_id=$t->currency_id;
                            $ptf2->fee=0;
                            $ptf2->fee_ex=0;
                            $ptf2->fee_currency_id=$t->currency_id;
                            $ptf2->bonus=0;
                            $ptf2->sendername=$t->sendername;
                            $ptf2->sendertel='';
                            $ptf2->payonid=$maintransfer->map_id;
                            $ptf2->map_id=$t->id;
                            $ptf2->ref_group_id=$t->ref_group_id;
                            $ptf2->note=$request->note;
                            $ptf2->location_id=8;
                            $ptf2->created_at=$current;
                            $ptf2->updated_at=$current;
                            $ptf2->property_group=$request->property_group;
                            $ptf2->property_id=$request->property_id;
                            $ptf2->payformonth=$t->payformonth;
                            $ptf2->save();

                        }
                    }

                    $sumpay=PartnerTransfer::where('ref_group_id',$request->group_id)->whereIn('trancode',[1,4])->where('status',1)->where('payonid',$t->payonid)->sum('amount');

                    $cash=0;
                    $bank=0;
                    if($t->deposit_via_id=='cash'){
                        $cash=$sumpay;
                    }else{
                        $bank=$sumpay;
                    }
                    $t->cash_amount=$cash;
                    $t->bank_amount=$bank;
                    if($t->save()){
                        return response()->json(['success'=>true,'message'=>'fixed payment completed']);
                    }else{
                        return response()->json(['error'=>true,'message'=>'fixed payment fail']);
                    }
                }
            }
        }


    }
     public function fixpayment(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $transfers=PartnerTransfer::where('status',1)->where('trancode',-8)->whereMonth('dd',$m)->whereYear('dd',$y)->orderBy('id')->get();
        foreach($transfers as $tr)
        {
            $groupid='property-' . $tr->id;
            DB::table('partner_transfers')->where('status',1)->where('payonid',$tr->id)->where('ref_group_id',$groupid)->where('id','<>',$tr->id)
            ->update(['cash_amount'=>$tr->cash_amount,'bank_amount'=>$tr->bank_amount]);
        }
    }

    public function searchcloselist(Request $request)
    {
        // $current = Carbon::now();
        // $current->timezone('Asia/Phnom_Penh');
        // $today = date("Y-m-d",strtotime($current));
        //return $request->all();
        $m = $request->m;
        $y = $request->y;
        $lastDate = new DateTime("last day of $y-$m");
        $lastDateofMonth=$lastDate->format('Y-m-d');
        //echo $lastDateofMonth->format('Y-m-d'); // Output: 2025-02-28
        if($request->property){
             $transfers=PartnerTransfer::where('status',1)->where('property_id','like','%(' . $request->property . ')%' )
            ->where(function($q) use($m,$y){
                $q->where(function($q1) use($m,$y){
                    $q1->whereMonth('payformonth','<=',$m)->whereYear('payformonth','<=',$y)->whereNotNull('nextpayment');
                })->orWhere(function($q2) use($m,$y){
                    $q2->whereNull('payformonth')->whereNotNull('nextpayment');
                })->orWhere(function($q3) use($m,$y){//សំរាប់អតិថិជនទិញបង់់ផ្តាច់
                    $q3->where('paymenttype',1)->where('trancode',-8);
                });
            })
            ->orderBy('id','DESC')->get()->unique(['payonid']);
        }else if($request->selgroup && isset($request->selgroup)){

            if(isset($request->isprint)){
                $selgroup=explode(",",$request->selgroup);
            }else{
                $selgroup=$request->selgroup;
            }

            $transfers = DB::table('partner_transfers')
            ->join('sale_details', 'sale_details.sale_id', '=', 'partner_transfers.id')
            ->join('properties', 'sale_details.property_id', '=', 'properties.id')
            ->join('currencies', 'partner_transfers.currency_id', '=', 'currencies.id')
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.loancomplete', 0)
            ->where('sale_details.status', 1)
            ->whereIn('properties.property_group_id', $selgroup)
            ->where(function($q) use($m,$y){
                $q->where(function($q1) use($m,$y){
                    $q1->whereMonth('partner_transfers.payformonth','<=',$m)->whereYear('partner_transfers.payformonth','<=',$y)->whereNotNull('partner_transfers.nextpayment');
                })->orWhere(function($q2) use($m,$y){
                    $q2->whereNull('partner_transfers.payformonth')->whereNotNull('partner_transfers.nextpayment');
                })->orWhere(function($q3) use($m,$y){//សំរាប់អតិថិជនទិញបង់់ផ្តាច់
                    $q3->where('partner_transfers.paymenttype',1)->where('partner_transfers.trancode',-8);
                });
            })->orderBy('partner_transfers.id','DESC')->get()->unique(['payonid']);

        }else{
             $transfers=PartnerTransfer::where('status',1)
            ->where(function($q) use($m,$y){
                $q->where(function($q1) use($m,$y){
                    $q1->whereMonth('payformonth','<=',$m)->whereYear('payformonth','<=',$y)->whereNotNull('nextpayment');
                })->orWhere(function($q2) use($m,$y){
                    $q2->whereNull('payformonth')->whereNotNull('nextpayment');
                })->orWhere(function($q3) use($m,$y){//សំរាប់អតិថិជនទិញបង់់ផ្តាច់
                   $q3->where('paymenttype',1)->where('trancode',-8);
                });
            })
            ->orderBy('id','DESC')->get()->unique(['payonid']);


        }

        foreach($transfers as $t){

            $paythismonth = PartnerTransfer::where([
                ['status', '=', 1],
                ['id', '<>', $t->payonid],
                ['payonid', '=', $t->payonid],
            ])
            ->where(function($q) use($m,$y){
               $q->whereMonth('payformonth', $m)->whereYear('payformonth', $y)->where('trancode','<>',-8);
            })
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt,SUM(cash_amount) as total_cash,SUM(bank_amount) as total_bank,SUM(cuscharge) as total_cuscharge,SUM(cuscharge_debt) as total_cuscharge_debt,SUM(discount_amount) as total_discount,MAX(dd) as max_dd')
            ->first();
            $t->count_pay = $paythismonth->countrow ?? '0';
            $t->inmonth  = $m;
            if ($paythismonth->max_dd && date('Y', strtotime($paythismonth->max_dd)) == $y && date('n', strtotime($paythismonth->max_dd)) == $m) {
                $t->amt_pay  = $paythismonth->sumamt ?? '0';
                $t->amt_cash = $paythismonth->total_cash ?? '0';
                $t->amt_bank = $paythismonth->total_bank ?? '0';
                $t->punish=$paythismonth->total_cuscharge??'0';
                $t->discount_punish=$paythismonth->total_discount??'0';
                $t->punish_debt=$paythismonth->total_cuscharge_debt??'0';
            }else{
                $t->amt_pay  = 0;
                $t->amt_cash = 0;
                $t->amt_bank =0;
                $t->punish=0;
                $t->discount_punish=0;
                $t->punish_debt=0;
            }
            //return $paythismonth;
            $payover = PartnerTransfer::where([
                ['status', '=', 1],
                ['id', '<>', $t->payonid],
                ['payonid', '=', $t->payonid],
            ])
            ->where(function($q) use($m, $y) {
                $q->whereMonth('dd', $m)
                ->whereYear('dd', $y)
                ->where('trancode', '<>', -8)
                ->whereNotNull('nextpayment')
                ->where(function($sub) use($m, $y) {
                    $sub->whereMonth('payformonth', '<>', $m)
                        ->orWhereYear('payformonth', '<>', $y);
                });
            })
            ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt, SUM(cash_amount) as total_cash, SUM(bank_amount) as total_bank,SUM(cuscharge) as total_cuscharge,SUM(cuscharge_debt) as total_cuscharge_debt,SUM(discount_amount) as total_discount')
            ->first();


            $t->count_pay_over = $payover->countrow ?? '0';
            $t->amt_pay_over   = $payover->sumamt ?? '0';
            $t->amt_cash_over   = $payover->total_cash ?? '0';
            $t->amt_bank_over   = $payover->total_bank ?? '0';
            $t->punish_over=$payover->total_cuscharge??'0';
            $t->discount_punish_over=$payover->total_discount??'0';
            $t->punish_debt_over=$payover->total_cuscharge_debt??'0';
            //return $payover;
            //កក់បន្ថែម
             $extrapay = PartnerTransfer::where([
                    ['status', '=', 1],
                    ['id', '<>', $t->payonid],
                    ['payonid', '=', $t->payonid],
                ])
                ->whereNull('payformonth')
                ->whereNull('nextpayment')
                ->whereMonth('dd', $m)
                ->whereYear('dd', $y)
                ->where('trancode','<>',-8)
                ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt,SUM(cash_amount) as total_cash,SUM(bank_amount) as total_bank')
                ->first();
                $t->count_moredeposit = $extrapay->countrow??0;
                $t->more_pay   = $extrapay->sumamt ?? 0;
                $t->more_cash   = $extrapay->total_cash ?? '0';
                $t->more_bank   = $extrapay->total_bank ?? '0';

            //return $extrapay;
             $buyinv=PartnerTransfer::where('id',$t->payonid)->where('status',1)->first();
            if($buyinv){
                $t->main_amount=$buyinv->amount;
                $t->main_id=$buyinv->id;
                $t->main_dd=$buyinv->dd;
                $t->main_property=$buyinv->sendername;
                $t->buyer=$buyinv->partner->name;
                $t->saler=$buyinv->customer->name;
                $t->main_cuscharge=$buyinv->cuscharge;
                $t->main_saveby=$buyinv->user->name;
                $t->main_note=$buyinv->note;
                $t->main_tel=$buyinv->partner->tel;
                $t->main_idcard=$buyinv->partner->idcard;
                $t->main_term=$buyinv->term;
                $t->main_interest_rate=$buyinv->interest_rate;
                $t->main_startdate=$buyinv->startdate;
                $t->main_enddate=$buyinv->enddate;
                $t->main_payinmonth=$buyinv->payinmonth;
                $t->main_parrent_id=$buyinv->parrent_id;
                $t->main_customertype=$buyinv->partner->customertype;
                $t->main_paymenttype=$buyinv->paymenttype;
                $t->main_term=$buyinv->term;
                $t->main_interest_rate=$buyinv->interest_rate;
                $t->main_startdate=$buyinv->startdate;
                $t->main_enddate=$buyinv->enddate;
                $t->main_payinmonth=$buyinv->payinmonth;
                $t->main_parrent_id=$buyinv->parrent_id;
                $nextpayment_main=$buyinv->nextpayment;
                $cuscharge_main=$buyinv->cuscharge;
                $discount_main=$buyinv->discount_amount;
                $mainid=$buyinv->id;
                $trancode=$buyinv->trancode;
            }
            if($request->selgroup!='all'){
                $lastpayment = PartnerTransfer::where('status', 1)
                ->where('id','<>',$t->payonid)
                ->where('payonid', $t->payonid)
                ->whereNotNull('nextpayment')
                ->where(function($q) use($m,$y){
                    $q->where(function($q1) use($m,$y){
                        $q1->whereMonth('payformonth','<=',$m)->whereYear('payformonth','<=',$y);
                    })->orWhere(function($q2) use($m,$y){
                        $q2->whereNull('payformonth');
                    });
                })->orderBy('id','DESC')->first();//->unique(['payonid']);
                if($lastpayment){
                    $t->payformonth_new=$lastpayment->payformonth;
                    $t->nextpayment_new=$lastpayment->nextpayment;
                    $t->cuscharge_new=$lastpayment->cuscharge;
                    $t->cuscharge_debt_new=$lastpayment->cuscharge_debt;
                    $t->discount_new=$lastpayment->discount_amount;
                    $t->trid_new=$lastpayment->id;
                    $t->trancode_new=$lastpayment->trancode;

                    $nextpayment_new=$lastpayment->nextpayment;
               }else{
                    $t->payformonth_new='';
                    $t->cuscharge_new=$cuscharge_main;
                    $t->cuscharge_debt_new=0;
                    $t->discount_new=$discount_main;
                    $t->nextpayment_new=$nextpayment_main;
                    $t->trid_new=$mainid;
                    $t->trancode_new=$trancode;
                    $nextpayment_new=$nextpayment_main;
               }
            }


            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->payonid)->where('payonid',$t->payonid)->where('parrent_id',$t->parrent_id)->sum('amount');
            $t->deposited=$deposited;
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $today = date("Y-m-d",strtotime($current));
            if($today>$lastDateofMonth){
                $selectdate = $lastDateofMonth;
            }else{
                $selectdate = $today;
            }
            if($request->selgroup!='all'){
                $diff=date_diff(date_create($selectdate),date_create($nextpayment_new));
            }else{
                $diff=date_diff(date_create($selectdate),date_create($t->nextpayment));
            }
            $qtyleftday=$diff->format("%R%a");
            $t->qtyleftday=$qtyleftday;
            $t->cuschargeoverday=5;//5$/day
        }

        $transfers=$transfers->sortBy('count_pay')->sortBy('qtyleftday');
        //return $transfers;
        if(isset($request->isprint)){
            $rpttitle='របាយការណ៏បិទបញ្ជី សំរាប់ខែ​ ' . $this->dokhmermonth($request->m) . ' ឆ្នាំ ' . $request->y;
            if($request->selgroup=='all'){
                return view('realestates.closelistprint',compact('transfers','rpttitle'));
            }else{
                $blockname=$request->blockname;
                return view('realestates.closelistsearchbyblockprint',compact('transfers','rpttitle','blockname'));
            }
        }else{
            if($request->selgroup=='all'){
                return view('realestates.closelistsearch',compact('transfers'));
                //return response()->json(['transfers'=>$transfers]);
            }else{
                //return response()->json(['transfers'=>$transfers]);
                return view('realestates.closelistsearchbyblock',compact('transfers'));
            }
        }
    }
      public function searchpaymentreport(Request $request)
    {

        $m = $request->m;
        $y = $request->y;
        $lastDate = new DateTime("last day of $y-$m");
        $lastDateofMonth=$lastDate->format('Y-m-d');
        //echo $lastDateofMonth->format('Y-m-d'); // Output: 2025-02-28
        $transfers=PartnerTransfer::where('status',1)->where('trancode',-8);
        if($request->selpaymenttype<>0 && !$request->property){
            $transfers=$transfers->where('paymenttype',$request->selpaymenttype);
        }
        if($request->property){
                $transfers=$transfers->where('property_id','like','%(' . $request->property . ')%' );
        }else if($request->selgroup && isset($request->selgroup)){
            $selgroup=$request->selgroup;
            $transfers = $transfers
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('property_group', 'like', '%(' . $g . ')%');
                }
            });
        }
        $transfers=$transfers->get();

        foreach($transfers as $t){
            if($t->paymenttype==2){
                $paythismonth = PartnerTransfer::where([
                    ['status', '=', 1],
                    ['id', '<>', $t->id],
                    ['payonid', '=', $t->id],
                    ['trancode','<>',-8]
                ])->whereMonth('payformonth','<=', $m)->whereYear('payformonth','<=', $y)->orderBy('payformonth','desc')->first();
                if($paythismonth){
                    $t->inmonth  = $m;
                    $t->payformonths=$paythismonth->payformonth??'';
                    $t->nextpayments=$paythismonth->nextpayment??'';
                    $t->amt_pay  = $paythismonth->amount;
                    if ($paythismonth->payformonth && date('Y', strtotime($paythismonth->payformonth)) == $y && date('n', strtotime($paythismonth->payformonth)) == $m) {
                        $t->count_pay = 1;
                    }else{
                         $t->count_pay = 0;
                    }
                    if ($paythismonth->dd && date('Y', strtotime($paythismonth->dd)) == $y && date('n', strtotime($paythismonth->dd)) == $m) {//ថ្ងៃបង់ ខុសពី បុង់សំរាប់ខែ
                        $t->amt_cash = $paythismonth->cash_amount;
                        $t->amt_bank = $paythismonth->bank_amount;
                        $t->deposit_by=$paythismonth->deposit_via;
                        $t->deposit_by_id=$paythismonth->deposit_via_id;
                        $t->payromlos_cuscharge=$paythismonth->cuscharge;
                        $t->payromlos_discount=$paythismonth->discount_amount;

                    }else{

                        $t->amt_cash = 0;
                        $t->amt_bank =0;
                        $t->deposit_by=0;
                        $t->deposit_by_id=0;
                        $t->payromlos_cuscharge=0;
                        $t->payromlos_discount=0;
                    }

                    $t->paymentdate=$paythismonth->dd;

                    $nextpayment=$paythismonth->nextpayment;

                }else{
                    $t->count_pay = 0;
                    $t->inmonth  = $m;

                    $t->amt_pay  = 0;
                    $t->amt_cash = 0;
                    $t->amt_bank = 0;
                    $nextpayment=$t->nextpayment;
                }

                $payover = PartnerTransfer::where([
                    ['status', '=', 1],
                    ['id', '<>', $t->id],
                    ['payonid', '=', $t->id],
                ])
                ->where(function($q) use($m, $y) {
                    $q->whereMonth('dd', $m)
                    ->whereYear('dd', $y)
                    ->where('trancode', '<>', -8)
                    ->whereNotNull('nextpayment')
                    ->where(function($sub) use($m, $y) {
                        $sub->whereMonth('payformonth', '<>', $m)
                            ->orWhereYear('payformonth', '<>', $y);
                    });
                })
                ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt, SUM(cash_amount) as total_cash, SUM(bank_amount) as total_bank')
                ->first();
                $t->count_pay_over = $payover->countrow ?? '0';
                $t->amt_pay_over   = $payover->sumamt ?? '0';
                $t->amt_cash_over   = $payover->total_cash ?? '0';
                $t->amt_bank_over   = $payover->total_bank ?? '0';

                $extrapay = PartnerTransfer::where([
                        ['status', '=', 1],
                        ['id', '<>', $t->id],
                        ['payonid', '=', $t->id],
                    ])
                    ->whereNull('payformonth')
                    ->whereNull('nextpayment')
                    ->whereMonth('dd', $m)
                    ->whereYear('dd', $y)
                    ->where('trancode','<>',-8)
                    ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt,SUM(cash_amount) as total_cash,SUM(bank_amount) as total_bank')
                    ->first();
                    $t->count_moredeposit = $extrapay->countrow??0;
                    $t->more_pay   = $extrapay->sumamt ?? 0;
                    $t->more_cash   = $extrapay->total_cash ?? '0';
                    $t->more_bank   = $extrapay->total_bank ?? '0';
                    $t->more_dd=$extrapay->dd ?? '';
            }

            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->payonid)->where('payonid',$t->payonid)->where('parrent_id',$t->parrent_id)->sum('amount');
            $t->deposited=$deposited;
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $today = date("Y-m-d",strtotime($current));
            if($today>$lastDateofMonth){
                $selectdate = $lastDateofMonth;
            }else{
                $selectdate = $today;
            }
            //return($nextpayment);
            if($t->paymenttype==2){
                $diff=date_diff(date_create($selectdate),date_create($nextpayment));
            }else{
                $diff=date_diff(date_create($selectdate),date_create($selectdate));
            }

            $qtyleftday=$diff->format("%R%a");
            $t->qtyleftday=$qtyleftday;
            $t->cuschargeoverday=5;//5$/day
        }

        $transfers=$transfers->sortBy('count_pay')->sortBy('qtyleftday');
        //return $transfers;
        if(isset($request->isprint)){
            $rpttitle='របាយការណ៏បិទបញ្ជី សំរាប់ខែ​ ' . $this->dokhmermonth($request->m) . ' ឆ្នាំ ' . $request->y;
            return view('realestates.paymentreportsearchprint',compact('transfers','rpttitle'));
        }else{
            return view('realestates.paymentreportsearch',compact('transfers'));
        }
    }
     public function paymentreport()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today = date("Y-m-d",strtotime($current));

        $m = date("n",strtotime($today));//m=01 --- 12 n=1 to 12 F=jan feb ...
        $y = date("Y",strtotime($today));
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->get();

        if(Auth::user()->role->name=='Admin'){
            $properties=Property::where('status',1)->orderBy('id')->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $properties=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->orderBy('id')->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        return view('realestates.paymentreport',compact('partners','currencies','m','y','groups','properties'));
    }
    public function updateinfo(Request $request)
    {
        $property_id='';
        $group_id='';
        $transfer=PartnerTransfer::find($request->id);
        $propertynames=explode(',',$transfer->sendername);
        foreach ($propertynames as $index => $name) {
            $p=Property::where('name',$name)->first();
            if($index==0){
                $property_id = '('. $p->id . ')';
                $group_id = '('. $p->property_group_id . ')';
            }else{
                $property_id .= '('. $p->id . ')';
                $group_id .= '('. $p->property_group_id . ')';
            }

        }

        DB::table('partner_transfers')->where('id',$request->id)->update(['property_id'=>$property_id,'property_group'=>$group_id]);
        return response()->json(['success'=>true,'message'=>'fixed error info.']);

    }
    public function closelist()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today = date("Y-m-d",strtotime($current));

        $m = date("n",strtotime($today));//m=01 --- 12 n=1 to 12 F=jan feb ...
        $y = date("Y",strtotime($today));
        $partners=Customer::where('status',1)->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('partner_cur',1)->get();
        // $transfers=PartnerTransfer::where('status',1)->whereNotNull('nextpayment')->where('loancomplete',0)->orderBy('id','DESC')->get()->unique(['payonid']);
        // foreach($transfers as $t){
        //     $paythismonth = PartnerTransfer::where('status', 1)
        //     ->where('id','<>',$t->payonid)
        //     ->where('payonid', $t->payonid)
        //     ->whereMonth('payformonth', $m)->whereYear('payformonth',$y)
        //     ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
        //     ->first();
        //     if($paythismonth){
        //         $t['count_pay']=$paythismonth->countrow;
        //         $t['amt_pay']=$paythismonth->sumamt;
        //         $t['inmonth']=$m;
        //     }

        //     $buyinv=PartnerTransfer::where('id',$t->payonid)->where('status',1)->first();
        //     if($buyinv){
        //         $t['main_amount']=$buyinv->amount;
        //         $t['main_id']=$buyinv->id;
        //         $t['main_dd']=$buyinv->dd;
        //         $t['main_property']=$buyinv->sendername;
        //         $t['buyer']=$buyinv->partner->name;
        //         $t['saler']=$buyinv->customer->name;
        //         $t['main_cuscharge']=$buyinv->cuscharge;
        //         $t['main_saveby']=$buyinv->user->name;
        //         $t['main_note']=$buyinv->note;
        //         $t['main_tel']=$buyinv->partner->tel;
        //         $t['main_idcard']=$buyinv->partner->idcard;
        //         $t['main_term']=$buyinv->term;
        //         $t['main_interest_rate']=$buyinv->interest_rate;
        //         $t['main_startdate']=$buyinv->startdate;
        //         $t['main_enddate']=$buyinv->enddate;
        //         $t['main_payinmonth']=$buyinv->payinmonth;
        //         $t['main_parrent_id']=$buyinv->parrent_id;
        //         $t['main_customertype']=$buyinv->partner->customertype;

        //     }
        //     $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->payonid)->where('payonid',$t->payonid)->where('parrent_id',$t->parrent_id)->sum('amount');
        //     $t['deposited']=$deposited;
        //     $current = Carbon::now();
        //     $current->timezone('Asia/Phnom_Penh');
        //     $today = date("Y-m-d",strtotime($current));
        //     $diff=date_diff(date_create($today),date_create($t->nextpayment));
        //     $qtyleftday=$diff->format("%R%a");
        //     $t['qtyleftday']=$qtyleftday;
        //     $t['cuschargeoverday']=5;//5$/day


        // }
        // $transfers=$transfers->sortBy('count_pay')->sortBy('qtyleftday');

        if(Auth::user()->role->name=='Admin'){
            $properties=Property::where('status',1)->orderBy('id')->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $properties=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->orderBy('id')->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        return view('realestates.closelist',compact('partners','currencies','m','y','groups','properties'));
    }
    public function getsoldlist(Request $request)
    {
        //return $request->all();
        $selgroup=$request->selgroup;
        if($request->selgroup=='all' || $request->property_id>0){
            if($request->property_id){
                $saleid=SaleDetail::where('status',1)->where('property_id',$request->property_id)->pluck('sale_id')->toArray();
                $transfers=PartnerTransfer::where('status',1)->whereIn('id',$saleid)->where('loancomplete',0);
            }else{
                $transfers=PartnerTransfer::where('status',1)->where('trancode',$request->trancode)->where('loancomplete',0);
            }
            if($request->paymenttype>0){
                $transfers=$transfers->where('paymenttype',$request->paymenttype);
            }
            $transfers=$transfers->orderBy('id')->get();
            foreach($transfers as $t){
                $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
                $t['deposited']=$deposited;
            }
        }else{

            $transfers = DB::table('partner_transfers')
                ->join('sale_details', 'sale_details.sale_id', '=', 'partner_transfers.id')
                ->join('properties', 'sale_details.property_id', '=', 'properties.id')
                ->join('currencies as cur1', 'partner_transfers.currency_id', '=', 'cur1.id')
                ->join('currencies as cur2', 'partner_transfers.cuscharge_currency_id', '=', 'cur2.id')
                ->join('users', 'partner_transfers.user_id', '=', 'users.id')
                ->join('customers as buyer', 'partner_transfers.parrent_id', '=', 'buyer.id')
                ->join('customers as saler', 'partner_transfers.customer_id', '=', 'saler.id')
                ->where('partner_transfers.status', 1)
                ->where('partner_transfers.loancomplete', 0)
                ->where('partner_transfers.trancode', $request->trancode)
                ->where('sale_details.status', 1)
                ->whereIn('properties.property_group_id', $selgroup)
                ->select(
                    // 'partner_transfers.*',
                    // 'buyer.name as buyername',
                    // 'buyer.tel as buyertel',
                    // 'buyer.idcard as buyer_identity',
                    // 'saler.name as salername',
                    // 'buyer.customertype as customertype', // updated to 'buyer.customertype'
                    // 'cur1.sk as cursk',
                    // 'cur1.shortcut as cur_shortcut',
                    // 'cur2.sk as cuscharge_sk',
                    // 'cur2.shortcut as cuscharge_cur_shortcut',
                    // 'users.name as username',
                    //  DB::raw('GROUP_CONCAT(properties.name) as property_names'),
                    //  DB::raw('SUM(sale_details.price) as total_price')
                    'partner_transfers.id',
                    DB::raw('MAX(partner_transfers.tranname) as tranname'),
                    DB::raw('MAX(partner_transfers.trancode) as trancode'),
                    DB::raw('MAX(partner_transfers.amount) as amount'),
                    DB::raw('MAX(partner_transfers.cuscharge) as cuscharge'),
                    DB::raw('MAX(partner_transfers.currency_id) as currency_id'),
                    DB::raw('MAX(partner_transfers.ref_group_id) as ref_group_id'),
                    DB::raw('MAX(partner_transfers.user_id) as user_id'),
                    DB::raw('MAX(partner_transfers.dd) as dd'),
                    DB::raw('MAX(partner_transfers.parrent_id) as parrent_id'),
                    DB::raw('MAX(partner_transfers.note) as note'),
                    DB::raw('MAX(partner_transfers.map_id) as map_id'),

                    DB::raw('MAX(partner_transfers.ref_number) as ref_number'),
                    DB::raw('MAX(partner_transfers.sendername) as sendername'),
                    DB::raw('MAX(partner_transfers.term) as term'),
                    DB::raw('MAX(partner_transfers.interest_rate) as interest_rate'),
                    DB::raw('MAX(partner_transfers.startdate) as startdate'),
                    DB::raw('MAX(partner_transfers.enddate) as enddate'),
                    DB::raw('MAX(partner_transfers.payinmonth) as payinmonth'),
                    DB::raw('MAX(partner_transfers.created_at) as created_at'),
                    DB::raw('MAX(partner_transfers.paymenttype) as paymenttype'),

                    DB::raw('MAX(buyer.name) as buyername'),
                    DB::raw('MAX(buyer.tel) as buyertel'),
                    DB::raw('MAX(buyer.idcard) as buyer_identity'),
                    DB::raw('MAX(saler.name) as salername'),
                    DB::raw('MAX(buyer.customertype) as customertype'),
                    DB::raw('MAX(cur1.sk) as cursk'),
                    DB::raw('MAX(cur1.shortcut) as cur_shortcut'),
                    DB::raw('MAX(cur2.sk) as cuscharge_sk'),
                    DB::raw('MAX(cur2.shortcut) as cuscharge_cur_shortcut'),
                    DB::raw('MAX(users.name) as username'),
                    DB::raw('GROUP_CONCAT(properties.name) as property_names'),
                    DB::raw('SUM(sale_details.price) as total_price')
                )->groupBy('partner_transfers.id');

            if($request->paymenttype>0){
                $transfers=$transfers->where('partner_transfers.paymenttype',$request->paymenttype);
            }

            $transfers=$transfers->orderBy('partner_transfers.id')->get();

            foreach($transfers as $t){
                $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
                $t->deposited=$deposited;
            }
            //return $transfers;
        }

        if($request->selgroup=='all'){
            return view('realestates.getsoldlist',compact('transfers'));
        }else{
            return view('realestates.getsoldlistgroup',compact('transfers'));
        }


    }
    public function print(Request $request){
        $logo=Company::orderBy('id')->first();
        $title=$request->title;
        $transfer=PartnerTransfer::where('id',$request->tr_id)->first();
        $saledetails=SaleDetail::where('sale_id',$request->tr_id)->where('status',1)->get();
        return view('realestates.saleprint',compact('transfer','saledetails','logo','title'));
    }
    public function depositprint(Request $request){
       // return $request->all();
       $rpttitle=$request->rpttitle;
       $propertyname=$request->propertyname;
       $id=$request->id;
        $logo=Company::orderBy('id')->first();
        $transfer=PartnerTransfer::where('id',$request->id)->first();
        if($transfer){
            $transfer0=PartnerTransfer::where('id',$transfer->payonid)->first();
            $soldprice=$transfer0->amount ?? '0';
            $propertyname=$transfer0->sendername ?? '';
            $transfergroup=PartnerTransfer::where('ref_group_id',$request->groupid)->whereNotNull('ref_group_id')->whereNotIn('trancode',[-8,8])->where('parrent_id',$transfer->parrent_id)->where('status',1)
            ->orwhere(function($query) use($id){
                return $query->where('id',$id);
            })->orderBy('id')->get();

              // Get total deposit information
              $totaldeposit = PartnerTransfer::where('status', 1)
              ->where('parrent_id', $transfer->parrent_id)
              ->where('payonid', $transfer->payonid)
              ->where('id', '<>', $transfer->payonid)
              ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
              ->first();

          // Extract values safely
          $countrow = $totaldeposit->countrow ?? 0;
          $sumdeposit = $totaldeposit->sumamt ?? 0;

          // Append additional data to the transfer object

          $transfer->countdeposit = $countrow;
          $transfer->deposited = $sumdeposit;
          $transfer->soldprice = $soldprice;
        }

        if($request->ispayromlos==1){
            return view('realestates.paymentprint',compact('transfer','transfergroup','logo','rpttitle','propertyname'));
        }else{
            return view('realestates.depositprint',compact('transfer','transfergroup','logo','rpttitle','propertyname'));
        }
    }
     public function removecommission(Request $request)
    {
        // $current = Carbon::now();
        // $current->timezone('Asia/Phnom_Penh');
        $userId = Auth::check() ? Auth::id() : null;
        $transfer = PartnerTransfer::find($request->id);
        $transfer->status=!$transfer->status;
        $transfer->user_delete=$userId;
        $transfer->updated_at=now()->timezone('Asia/Phnom_Penh');
       if($transfer->save())
       {
            return response()->json(['success' => true, 'message' => 'Completed']);
       }else{
            return response()->json(['error' => true, 'message' => 'Fail']);
       }
    }
    public function deletepaidcommissionall(Request $request)
{
    DB::beginTransaction();

    try {
        $id = $request->id;

        // 1️⃣ Update partner_transfers
         DB::table('partner_transfers')
            ->where('pay_commission_id', $id)->where('trancode','<>',4)
            ->update([
                'amount' => 0,
                'ispaytosaler' => null,
            ]);



         DB::table('partner_transfers')
            ->where('pay_commission_id', $id)->where('trancode',4)
            ->update([
                'status' => 0
            ]);



        // 2️⃣ Update cashdraws
         DB::table('cashdraws')
            ->where('pay_commission_id', $id)
            ->update(['status' => 0]);



        // 3️⃣ Update pay_commissions
         DB::table('pay_commissions')
            ->where('id', $id)
            ->update(['status' => 0]);



        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Delete completed successfully.'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500);
    }
}


    public function deletepaidcommission(Request $request)
    {
        // Validate that ID and group ID exist
        if (!$request->has('id') || !$request->has('groupid')) {
            return response()->json(['error' => true, 'message' => 'Invalid request parameters']);
        }

        // Find the transfer
        $transfer = PartnerTransfer::find($request->id);

        if (!$transfer) {
            return response()->json(['error' => true, 'message' => 'Transfer not found']);
        }

        try {
            // Update transfer fields
            $transfer->amount = 0;
            $transfer->ispaytosaler = null;
            $transfer->trancode = -1;
            $transfer->cash_amount=0;
            $transfer->bank_amount=0;
            $transfer->deposit = 0;
            if ($transfer->save()) {
                // Ensure user is authenticated before accessing Auth data
                $userId = Auth::check() ? Auth::id() : null;
                $userName = Auth::check() ? Auth::user()->name : 'Unknown';

                // Update related partner transfers
                DB::table('partner_transfers')
                    ->where('ref_group_id', $request->groupid)
                    ->where('id', '>', $request->id)
                    ->where('amount','>','0')
                    ->update(['status' => 0, 'user_delete' => $userId]);

                // Update related cash draws
                DB::table('cashdraws')
                    ->where('ref_group_id', $request->groupid)
                    ->update(['status' => 0, 'delby' => $userName]);

                return response()->json(['success' => true, 'message' => 'Delete Completed']);
            } else {
                return response()->json(['error' => true, 'message' => 'Delete Failed']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    public function depositprint1(Request $request){
        // return $request->all();
        $rpttitle = $request->rpttitle;

        // Get the company logo
        $logo = Company::orderBy('id')->first();

        // Get the transfer record, ensuring it exists
        $transfer = PartnerTransfer::where('id', $request->id)->first();

        if ($transfer) {
            // Fetch commission amount correctly
            $commission = PartnerTransfer::where('id', $transfer->payonid)->value('amount');

            // Get total deposit information
            $totaldeposit = PartnerTransfer::where('status', 1)
                ->where('parrent_id', $transfer->parrent_id)
                ->where('payonid', $transfer->payonid)
                ->where('id', '<>', $transfer->payonid)
                ->selectRaw('COUNT(*) as countrow, SUM(amount) as sumamt')
                ->first();

            // Extract values safely
            $countrow = $totaldeposit->countrow ?? 0;
            $sumdeposit = $totaldeposit->sumamt ?? 0;

            // Append additional data to the transfer object
            $transfer->commission = $commission;
            $transfer->countdeposit = $countrow;
            $transfer->deposited = $sumdeposit;
        }


        return view('realestates.depositprint1',compact('transfer','logo','rpttitle'));

     }
    public function getpropertybygroup(Request $request)
    {
        $properties=DB::table('properties')
        ->leftJoin('sale_details', 'properties.id','=', 'sale_details.property_id')
        ->join('currencies','properties.currency_id','=','currencies.id')
        ->where('properties.status',1)->where('properties.property_group_id',$request->groupid)
        ->select('properties.id as pid','properties.name as pname','properties.property_group_id as pgroupid','properties.size as size','properties.size1 as size1','properties.price as price','properties.com_payoff','properties.com_payloan','properties.currency_id','currencies.shortcut as currency_shortcut','sale_details.sale_id as saleid','sale_details.status as dstatus')
        ->orderBy('properties.id')->get();

        $jsonitem= json_decode($properties);
        //dd($jsonitem);
        $myproperty=collect();

        foreach($properties as $p){
            $found=0;
            $pid=$p->pid;
            if(is_null($p->saleid)){
                $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'pgroupid'=>$p->pgroupid,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus]);
            }else{
                foreach ($jsonitem as $item ) {
                    if ( $pid == $item->pid && $item->dstatus==1 ) {
                        $found = 1;
                    }
                }
                if($found==0){
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'pgroupid'=>$p->pgroupid,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'saleid'=>$p->saleid,'dstatus'=>$p->dstatus]);
                    }
                }
            }
        }
        return response()->json(['myproperty'=>$myproperty]);
    }
    function dokhmermonth($m)
    {
        if($m==1) return 'មករា';
        if($m==2) return 'គុម្ភះ';
        if($m==3) return 'មិនា';
        if($m==4) return 'មេសា';
        if($m==5) return 'ឧសភា';
        if($m==6) return 'មិថុនា';
        if($m==7) return 'កក្កដា';
        if($m==8) return 'សីហា';
        if($m==9) return 'កញ្ញា';
        if($m==10) return 'តុលា';
        if($m==11) return 'វិច្ចិកា';
        if($m==12) return 'ធ្នូ';
    }
    public function buyersalerlocalstorage(){
        $buyers=Customer::where('status',1)->where('customertype','BUYER')->orderBy('name')->get()->load('province','district','commune','village');
        $salers=Customer::where('status',1)->where('customertype','SALER')->orderBy('name')->get()->load('province','district','commune','village');
        $doats = Contract::whereNotNull('doat')->distinct()->pluck('doat');
        return response()->json(['buyers'=>$buyers,'salers'=>$salers,'doats'=>$doats]);
    }
    public function storebuyer(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if($request->customer_id==''){
            $c=new Customer();
        }else{
            $c=Customer::find($request->customer_id);
        }

        $c->user_id=Auth::id();
        $c->name=$request->name2;
        $c->sex=$request->sex2;
        $c->tel=$request->tel2;
        $c->age=$request->age2;
        $c->nation=$request->nation2;
        $c->customertype='BUYER';
        $c->no=0;
        $c->tel=$request->tel2;
        $c->showinlist=1;
        $c->province_id=$request->sel_province2;
        $c->district_id=$request->sel_district2;
        $c->commune_id=$request->sel_commune2;
        $c->village_id=$request->sel_village2;
        $c->idcard=$request->id2;
        $c->company_id=$selcomid;
        if($c->save()){
            $cid=$c->id;
            return $cid;
        }
    }
    public function storesaler(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        if($request->saler_id==''){
            $c=new Customer();
        }else{
            $c=Customer::find($request->saler_id);
        }
        $c->user_id=Auth::id();
        $c->name=$request->name3;
        $c->sex=$request->sex3;
        $c->tel=$request->tel3;
        $c->age=$request->age3;
        $c->nation=$request->nation3;
        $c->customertype='SALER';
        $c->no=0;
        $c->tel=$request->tel3;
        $c->showinlist=1;
        $c->province_id=$request->sel_province3;
        $c->district_id=$request->sel_district3;
        $c->commune_id=$request->sel_commune3;
        $c->village_id=$request->sel_village3;
        $c->idcard=$request->id3;
        $c->company_id=$selcomid;
        if($c->save()){
            $cid=$c->id;
            return $cid;
        }
    }
    public function savedocontract(Request $request)
    {
        //return $request->all();
        $contractId=$request->ctid;
        $validator = Validator::make($request->all(), [
            'name2'=>'required',
            'id2'=>'required',
            'sel_property' => 'required|unique:contracts,property_id,' . $contractId,
            'price' => 'required',
            'pricediscount' => 'required',
            'discount' => 'required',
            'deposit' => 'required',
            'name3'=>'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        // if($request->name3 <> ''){
        //     $validator1 = Validator::make($request->all(), [
        //         'name3'=>'required',
        //         'id3'=>'required',
        //     ]);
        //     if ($validator1->fails()) {
        //         return response()->json(['error'=>$validator1->errors()->all()]);
        //     }
        // }
        $reg_date=Date('Y-m-d',strtotime($request->dd));
        $paydate= date('Y-m-d', strtotime($request->paiddate));
        $lastpaydate= date('Y-m-d', strtotime($request->paiddatelast));
        $paydate1=explode("-",$paydate);
        $paydate2=explode("-",$lastpaydate);
        $d1=$paydate1[2];
        $d2=$paydate2[2];
        $y1=$paydate1[0];
        $y2=$paydate2[0];
        $m1=$this->dokhmermonth(floatval($paydate1[1]));
        $m2=$this->dokhmermonth(floatval($paydate2[1]));

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        if($request->ctid && $request->ctid>0){
            $contract=Contract::find($request->ctid);
        }else{
            $contract=new Contract();
        }
        $contract->customer_id=$this->storebuyer($request);
        if($request->name3 <> ''){
            $contract->saler_id=$this->storesaler($request);
        }
        $contract->user_id=Auth::id();
        $contract->reg_date=$reg_date;
        $contract->company_id=$request->name1;
        $contract->name_b=$request->name2;
        $contract->sex_b=$request->sex2;
        $contract->age_b=$request->age2;
        $contract->nation_b=$request->nation2;
        $contract->id_b=$request->id2;
        $contract->tel_b=$request->tel2;
        $contract->address_b=$request->address2;

        $contract->name_bb=$request->name22;
        $contract->sex_bb=$request->sex22;
        $contract->age_bb=$request->age22;
        $contract->nation_bb=$request->nation22;
        $contract->id_bb=$request->id22;
        $contract->tel_bb=$request->tel22;
        $contract->address_bb=$request->address22;

        $contract->province_id_bb=$request->sel_province22;
        $contract->district_id_bb=$request->sel_district22;
        $contract->district_name_bb=$request->district22;
        $contract->commune_id_bb=$request->sel_commune22;
        $contract->commune_name_bb=$request->commune22;
        $contract->village_id_bb=$request->sel_village22;
        $contract->village_name_bb=$request->village22;

        $contract->name_c=$request->name3;
        $contract->sex_c=$request->sex3;
        $contract->age_c=$request->age3;
        $contract->nation_c=$request->nation3;
        $contract->id_c=$request->id3;
        $contract->tel_c=$request->tel3;
        $contract->address_c=$request->address3;

        $contract->propertyname=$request->propertyname;
        $contract->property_id=$request->sel_property;
        $contract->size=$request->size1;
        $contract->north=$request->north;
        $contract->south=$request->south;
        $contract->east=$request->east;
        $contract->west=$request->west;

        $contract->p_addr=$request->property_address;
        $contract->price=str_replace(',','',$request->price) ;
        $contract->price_text=$request->price_text;
        $contract->pay=str_replace(',','',$request->deposit);
        $contract->pay_text=$request->deposit_text;

        $contract->paytype=$request->paytype;
        $contract->d=$d1;
        $contract->m=$m1;
        $contract->y=$y1;
        $contract->paiddate1=$paydate;

        $contract->dd=$d2;
        $contract->mm=$m2;
        $contract->yy=$y2;
        $contract->paiddate2=$lastpaydate;

        $contract->doat=$request->doat;
        $contract->dodate=$request->dodate;
        $contract->domonth=$request->domonth;
        $contract->doyear=$request->doyear;

        $contract->discount=str_replace(',','',$request->discount);
        $contract->disc_by=$request->disc_by;
        $contract->priceafterdiscount=str_replace(',','',$request->pricediscount);
        $contract->price_text1=$request->price_text1;

        if($contract->save()){
            $id=$contract->id;
            $cid=$contract->customer_id;
            return response()->json(['id'=>$id,'cid'=>$cid]);
        }else{
            return response()->json(['error'=>true]);
        }

    }
    public function store(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'selpartner'=>'required',
            'selsaler' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'deposit' => 'required',
            'bankamt' => 'required',
            'amountdiscount' => 'required',
            'commission' => 'required',
            'paycommission' => 'required',
            'paymenttype' => 'required',
            'txtcur'=>'required',
            'curid'=>'required',
            'p_price.*'=>'required',
            'pid.*'=>'required',
            'p_cur_id.*'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->paymenttype==2){
            $validator1 = Validator::make($request->all(), [
                'term'=>'required',
                'interest_rate'=>'required',
                'payinmonth'=>'required',
            ]);
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);
            }
        }
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $completesave=0;
        if($request->id1==''){
            $ptf=new PartnerTransfer();
            $ptf->user_id=Auth::id();
            $ptf->created_at=$current;
        }else{
            $ptf=PartnerTransfer::find($request->id1);
        }
        $ptf->tranname='ទិញ' . $request->propertyname; //. $request->partner1;
        $ptf->trancode=-8;
        $ptf->mekun=-1;
        $ptf->dd=$trandate;
        $ptf->tt=$trantime;

        $ptf->parrent_id=$request->selpartner;
        $ptf->customer_id=$request->selsaler;
        $ptf->amount=-1 * floatval(str_replace(',','',$request->amountdiscount));
        $ptf->discount=str_replace(',','',$request->discount);
        $ptf->disc_by=$request->disc_by;
        $ptf->amountbeforediscount=-1 * floatval(str_replace(',','',$request->amount));
        $ptf->deposit=str_replace(',','',$request->deposit);
        $ptf->currency_id=$request->curid;
        $ptf->cuscharge=str_replace(',','',$request->commission);
        $ptf->cuscharge_ex=str_replace(',','',$request->commission);
        $ptf->cuscharge_currency_id=$request->curid;
        $ptf->fee=0;
        $ptf->fee_ex=0;
        $ptf->fee_currency_id=$request->curid;
        $ptf->bonus=0;
        $ptf->paymenttype=$request->paymenttype;
        $ptf->deposit_via=$request->deposit_via;
        $ptf->deposit_via_id=$request->selbank;
        if($request->selbank=='cash'){
            $cash=str_replace(',','',$request->bankamt);
            $bank=0;
        }else{
            $bank=str_replace(',','',$request->bankamt);
            $cash=floatval(str_replace(',','',$request->deposit))-floatval($bank);
        }
        $ptf->cash_amount=$cash;
        $ptf->bank_amount=$bank;
        if($request->paymenttype==2){
            $ptf->term=$request->term;
            $ptf->interest_rate=$request->interest_rate;
            $startdate= date('Y-m-d', strtotime($request->startdate));
            $enddate= date('Y-m-d', strtotime($request->enddate));
            $ptf->startdate=$startdate;
            $ptf->enddate=$enddate;
            $ptf->payinmonth=str_replace(',','',$request->payinmonth);
            //$nexpayment = date('Y-m-d', strtotime("+1 months", strtotime($startdate)));
            $ptf->nextpayment=$startdate;
        }
        $ptf->sendername=$request->propertyname;
        $ptf->property_group=$request->groupid;
        $ptf->property_id=$request->propertyid;
        $ptf->note=$request->note;
        $ptf->location_id=8;
        $ptf->updated_at=$current;
        $ptf->temp_amount=str_replace(',','',$request->paycommission);
        $ptf->action='u,d';
        if($ptf->save()){
            $id=$ptf->id;
            $refgroupid='property-'. $id;
            if($request->id1==''){
                $ptf1=new PartnerTransfer();
                $ptf1->created_at=$current;
            }else{
                $ptf1=PartnerTransfer::find($request->id2);
            }
            $ptf1->tranname='កំរៃជើងសារ';
            $ptf1->trancode=8;
            $ptf1->mekun=1;
            $ptf1->dd=$trandate;
            $ptf1->tt=$trantime;
            $ptf1->user_id=Auth::id();
            $ptf1->parrent_id=$request->selsaler;
            $ptf1->amount=str_replace(',','',$request->commission);
            $ptf1->currency_id=$request->curid;
            $ptf1->cuscharge=0;
            $ptf1->cuscharge_ex=0;
            $ptf1->cuscharge_currency_id=$request->curid;
            $ptf1->fee=0;
            $ptf1->fee_ex=0;
            $ptf1->fee_currency_id=$request->curid;
            $ptf1->bonus=0;
            $ptf1->sendername=$request->propertyname;
            $ptf1->property_group=$request->groupid;
            $ptf1->property_id=$request->propertyid;
            $ptf1->note=$request->note;
            $ptf1->location_id=8;
            $ptf1->map_id=$id;
            $ptf1->ref_group_id=$refgroupid;
            $ptf1->paymenttype=$request->paymenttype;

            $ptf1->updated_at=$current;
            if($ptf1->save()){
                $id1=$ptf1->id;
                DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$refgroupid,'map_id'=>$id1,'payonid'=>$id]);
                foreach ($request->pid as $key => $value) {
                    if($request->id1==''){
                        $saledetail=new SaleDetail();
                        $saledetail->sale_id=$id;
                        $saledetail->property_id=$value;
                        $saledetail->price=str_replace(',','',$request->p_price[$key]);
                        $saledetail->currency_id=$request->p_cur_id[$key];
                        if($saledetail->save()){
                            $completesave=1;
                        }else{
                            return response()->json(['error'=>true,'message'=>'Error 03']);
                        }
                    }else{
                        if(SaleDetail::where('sale_id',$request->id1)->where('property_id',$value)->where('status',1)->exists()){
                            SaleDetail::where('sale_id',$request->id1)->where('property_id',$value)->where('status',1)->update(['price'=>str_replace(',','',$request->p_price[$key]) ]);
                        }else{
                            $saledetail=new SaleDetail();
                            $saledetail->sale_id=$id;
                            $saledetail->property_id=$value;
                            $saledetail->price=str_replace(',','',$request->p_price[$key]);
                            $saledetail->currency_id=$request->p_cur_id[$key];
                            if($saledetail->save()){
                                $completesave=1;
                            }else{
                                return response()->json(['error'=>true,'message'=>'Error 03']);
                            }

                        }
                    }


                }
                //if customer deposit
                if($request->deposit>0){
                    if($request->id3==''){
                        $ptf3=new PartnerTransfer();
                        $ptf3->created_at=$current;
                    }else{
                        $ptf3=PartnerTransfer::find($request->id3);
                    }
                    $ptf3->tranname='កក់ប្រាក់'; //. $request->partner1;
                    if($request->selbank=='cash'){
                        $ptf3->trancode=1;
                    }else{
                        $ptf3->trancode=4;
                    }
                    $ptf3->mekun=1;
                    $ptf3->dd=$trandate;
                    $ptf3->tt=$trantime;
                    $ptf3->user_id=Auth::id();
                    $ptf3->parrent_id=$request->selpartner;
                    $ptf3->amount=str_replace(',','',$request->deposit);
                    $ptf3->currency_id=$request->curid;
                    $ptf3->cash_amount=$cash;
                    $ptf3->bank_amount=$bank;
                    $ptf3->cuscharge=0;
                    $ptf3->cuscharge_ex=0;
                    $ptf3->cuscharge_currency_id=$request->curid;
                    $ptf3->fee=0;
                    $ptf3->fee_ex=0;
                    $ptf3->fee_currency_id=$request->curid;
                    $ptf3->bonus=0;
                    $ptf3->paymenttype=$request->paymenttype;
                    $ptf3->map_id=$id;
                    $ptf3->payonid=$id;
                    $ptf3->ref_group_id=$refgroupid;
                    $ptf3->sendername=$request->propertyname;
                    $ptf3->note=$request->note;
                    $ptf3->location_id=8;
                    $ptf3->property_group=$request->groupid;
                    $ptf3->property_id=$request->propertyid;
                    $ptf3->updated_at=$current;
                    $ptf3->deposit_via=$request->deposit_via;
                    $ptf3->deposit_via_id=$request->selbank;
                    $ptf3->action='';
                    if($ptf3->save()){
                        $id3=$ptf3->id;
                        //if pay by bank
                        if($request->selbank<>'cash'){
                            if($request->id4==''){
                                $ptf4=new PartnerTransfer();
                                $ptf4->created_at=$current;
                            }else{
                                $ptf4=PartnerTransfer::find($request->id4);
                            }
                            $ptf4->tranname='កក់ប្រាក់';
                            $ptf4->trancode=-4;
                            $ptf4->mekun=-1;
                            $ptf4->dd=$trandate;
                            $ptf4->tt=$trantime;
                            $ptf4->user_id=Auth::id();
                            $ptf4->parrent_id=$request->selbank;
                            $ptf4->amount=-1 * floatval(str_replace(',','',$request->bankamt));

                            $ptf4->currency_id=$request->curid;
                            $ptf4->cuscharge=0;
                            $ptf4->cuscharge_ex=0;
                            $ptf4->cuscharge_currency_id=$request->curid;
                            $ptf4->fee=0;
                            $ptf4->fee_ex=0;
                            $ptf4->fee_currency_id=$request->curid;
                            $ptf4->bonus=0;
                            $ptf4->paymenttype=$request->paymenttype;
                            $ptf4->map_id=$id3;
                            $ptf4->ref_group_id=$refgroupid;
                            $ptf4->sendername=$request->propertyname;
                            $ptf4->note=$request->note;
                            $ptf4->location_id=8;
                            $ptf4->updated_at=$current;
                            $ptf4->action='';
                            if($ptf4->save()){
                                $completesave=1;
                            }else{
                                return response()->json(['error'=>true,'message'=>'Error 05']);
                            }
                        }
                        if($request->id3==''){
                            //auto save commission to saler
                            $ptf8=new PartnerTransfer();
                            $ptf8->mekun=-1;
                            $ptf8->trancode=-1;
                            $ptf8->dd=$trandate;
                            $ptf8->tt=$trantime;
                            $ptf8->user_id=Auth::id();
                            $ptf8->tranname='មានកម្រៃជើងសារ';
                            $ptf8->parrent_id=$request->selsaler;
                            $ptf8->amount=0;
                            $ptf8->currency_id=$request->curid;
                            $ptf8->cuscharge=0;
                            $ptf8->cuscharge_ex=0;
                            $ptf8->cuscharge_currency_id=$request->curid;
                            $ptf8->fee=0;
                            $ptf8->fee_ex=0;
                            $ptf8->fee_currency_id=$request->curid;
                            $ptf8->bonus=0;
                            $ptf8->paymenttype=$request->paymenttype;
                            $ptf8->payonid=$id1;
                            $ptf8->map_id=$id3;
                            $ptf8->ref_group_id=$refgroupid;
                            $ptf8->sendername=$request->propertyname;
                            $ptf8->note=$request->note;
                            $ptf8->location_id=8;
                            $ptf8->property_group=$request->groupid;
                            $ptf8->property_id=$request->propertyid;
                            $ptf8->created_at=$current;
                            $ptf8->updated_at=$current;
                            $ptf8->temp_amount=str_replace(',','',$request->paycommission);
                            $ptf8->action='';
                            if($ptf8->save()){
                                $completesave=1;
                            }else{
                                 return response()->json(['error'=>true,'message'=>'Error 08']);
                            }
                        }else{
                            DB::table('partner_transfers')->where('amount',0)->where('ref_group_id',$refgroupid)->update(['temp_amount'=>str_replace(',','',$request->paycommission)]);
                        }
                        $completesave=1;
                    }else{
                        return response()->json(['error'=>true,'message'=>'Error 04']);
                    }
                }
            }else{
                return response()->json(['error'=>true,'message'=>'Error 02']);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Error 01']);
        }
        if($completesave==1){
            return response()->json(['success'=>true,'id'=>$id,'message'=>'Save Transaction Completed']);
        }
    }

    public function savedepositcommission(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'deposit' => 'required',
            'partner_id'=>'required',
            'payamt' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $checkpayonid=PartnerTransfer::find($request->payonid);
        if($checkpayonid){
            $saler_id=$checkpayonid->parrent_id;
            $commission=$checkpayonid->amount;
            $sumpaycom=PartnerTransfer::where('payonid',$checkpayonid->id)->where('parrent_id',$saler_id)->where('id','<>',$checkpayonid->id)->where('status',1)->sum('amount');
            if($sumpaycom>=$commission){
                return response()->json(['error'=>true,'message'=>'over flow pay commission']);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'pay on id not found']);
        }
        if($request->selbank<>'cash'){
            $trancode=-4 ;
        }else{
            $trancode=-1;
        }
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $founderror=0;
        $bank=0;
        $cash=0;
        $payment=PartnerTransfer::find($request->id);
        if($payment){
            $payment->trancode=$trancode;
            $payment->dd=$trandate;
            $payment->tt=$trantime;
            $payment->user_update_id=Auth::id();
            $payment->amount=-1 * floatval(str_replace(',','',$request->deposit));
            $payment->deposit_via=$request->payby;
            $payment->deposit_via_id=$request->selbank;
            //$payment->deposit=floatval(str_replace(',','',$request->deposit));
            $payment->ispaytosaler=1;
            if($request->selbank=='cash'){
                $cash=str_replace(',','',$request->payamt);
                $bank=0;
            }else{
                $bank=str_replace(',','',$request->payamt);
                $cash=floatval(str_replace(',','',$request->deposit))-floatval($bank);
            }
            $payment->cash_amount=$cash;
            $payment->bank_amount=$bank;
            if($payment->save()){
                if($trancode==-4){
                     //save to bank
                     $ptf1=new PartnerTransfer();
                     $ptf1->tranname='បាញ់ចេញ';
                     $ptf1->trancode=4;
                     $ptf1->mekun=1;
                     $ptf1->dd=$trandate;
                     $ptf1->tt=date('H:i:s',strtotime($trantime . ' +1 seconds'));
                     $ptf1->user_id=Auth::id();
                     $ptf1->parrent_id=$request->selbank;
                     //$ptf1->amount= str_replace(',','',$request->deposit);
                     $ptf1->amount= $bank;
                     $ptf1->currency_id=$request->curid;
                     $ptf1->cuscharge=0;
                     $ptf1->cuscharge_ex=0;
                     $ptf1->cuscharge_currency_id=$request->curid;
                     $ptf1->fee=0;
                     $ptf1->fee_ex=0;
                     $ptf1->fee_currency_id=$request->curid;
                     $ptf1->bonus=0;
                     $ptf1->ref_group_id=$payment->ref_group_id;
                     $ptf1->recname=$request->saler;
                     $ptf1->note=$request->note;
                     $ptf1->isbank=1;
                     $ptf1->location_id=8;
                     $ptf1->created_at=$current;
                     $ptf1->updated_at=$current;
                     if($ptf1->save())
                     {

                     }else{
                         $founderror=1;
                     }
                }else{
                    //save cashdraw
                    $cashdraw=new Cashdraw();
                    $cashdraw->from_partner_id=$payment->parrent_id;
                    $cashdraw->transfer_id=$request->id;
                    $cashdraw->opdate=$trandate;
                    $cashdraw->optime=date('H:i:s',strtotime($trantime . ' +1 seconds'));
                    $cashdraw->user_id=Auth::id();
                    $cashdraw->amount=str_replace(',','',$request->deposit);
                    $cashdraw->currency_id=$request->curid;
                    $cashdraw->customer_charge=0;
                    $cashdraw->cuscharge_currency_id=$request->curid;
                    $cashdraw->paymethod='Cash';
                    $cashdraw->receive_tel='';
                    $cashdraw->receive_name='';
                    $cashdraw->note=$request->note;
                    $cashdraw->other='';
                    $cashdraw->ref_number=$payment->ref_group_id;
                    $cashdraw->ref_group_id=$payment->ref_group_id;
                    $cashdraw->action='';
                    $cashdraw->created_at=$current;
                    $cashdraw->updated_at=$current;
                    if($cashdraw->save())
                    {
                        $cashdraw_id=$cashdraw->id;
                        DB::table('partner_transfers')->where('id',$request->id)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'deposit_via'=>$request->payby . '('. Auth::user()->name . ')']);
                    }else{
                        $founderror=1;
                    }
                }
            }
        }
        if($founderror==0){
            return response()->json(['success'=>true,'id'=>$payment->id,'groupid'=>$payment->ref_group_id,'message'=>'Save Deposit Transaction Completed']);
        }else{
            return response()->json(['error'=>true,'message'=>'Save Deposit Error']);
        }
    }
    public function incomeexpansereport(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $d=date('Y-m-d',strtotime($current));
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $incomes = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
        ->where('c.customertype', 'BUYER')
        ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d, $d])
        ->where('partner_transfers.status', 1)
        ->where('partner_transfers.location_id', 8)
        ->whereNotIn('partner_transfers.trancode', [-8, 8])
        ->where('partner_transfers.amount', '>', 0)
        ->select('partner_transfers.*', 'c.name as customername') // Example: Fetching customer names too
        ->orderBy('partner_transfers.id')->get();

        $expanses = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
        ->where('c.customertype', 'SALER')
        ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d, $d])
        ->where('partner_transfers.status', 1)
        ->where('partner_transfers.location_id', 8)
        ->whereNotIn('partner_transfers.trancode', [-8, 8])
        ->where('partner_transfers.amount', '<', 0)
        ->select('partner_transfers.*', 'c.name as customername') // Example: Fetching customer names too
        ->orderBy('partner_transfers.id')->get();
        $companies=Company::where('status',1)->get();
        if(Auth::user()->role->name=='Admin'){
            $allproperty=Property::where('status',1)->get();
            $groups=PropertyGroup::where('status',1)->orderBy('id')->get();
        }else{
            $groupconnect=explode(',',Auth::user()->property_group_connect);
            $allproperty=Property::where('status',1)->whereIn('property_group_id',$groupconnect)->get();
            $groups=PropertyGroup::where('status',1)->whereIn('id',$groupconnect)->orderBy('id')->get();
        }
        return view('realestates.income_expanse_report',compact('incomes','expanses','partners','companies','selcomid','groups','allproperty'));
    }
    public function print_income_expanse_report(Request $request)
    {
        //return $request->all();
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $trancode=$request->type;
        $rpttitle='';
        $paymenttype=$request->selbankname;
        if($request->type=='-8'){
             if($request->selbank=='all'){
                 $reports = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
                 ->where('c.customertype', 'BUYER')
                 ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
                 ->where('partner_transfers.status', 1)
                 ->where('partner_transfers.location_id', 8)
                 ->whereNotIn('partner_transfers.trancode', [-8, 8])
                 ->where('partner_transfers.amount', '>', 0)
                 ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too

             }else{
                $reports = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
                ->where('c.customertype', 'BUYER')
                ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
                ->where('partner_transfers.status', 1)
                ->where('partner_transfers.location_id', 8)
                ->whereNotIn('partner_transfers.trancode', [-8, 8])
                ->where('partner_transfers.amount', '>', 0)
                ->where('partner_transfers.deposit_via_id', '=', $request->selbank)
                ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too
             }

            $rpttitle='របាយការណ៏ចំណូលពីការលក់';
        }else if($request->type=='8'){
              if($request->selbank=='all'){
                  $reports = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
                  ->where('c.customertype', 'SALER')
                  ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
                  ->where('partner_transfers.status', 1)
                  ->where('partner_transfers.location_id', 8)
                  ->whereNotIn('partner_transfers.trancode', [-8, 8])
                  ->where('partner_transfers.amount', '<', 0)
                  ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too
              }else{
                    $reports = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
                    ->where('c.customertype', 'SALER')
                    ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
                    ->where('partner_transfers.status', 1)
                    ->where('partner_transfers.location_id', 8)
                    ->whereNotIn('partner_transfers.trancode', [-8, 8])
                    ->where('partner_transfers.amount', '<', 0)
                    ->where('partner_transfers.deposit_via_id', '=', $request->selbank)
                    ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too
              }

            $rpttitle='របាយការណ៏ចំណាយពីការលក់';
        }
         if(isset($request->selgroup) && $request->selgroup){
            $selgroup=$request->selgroup;
            $reports = $reports
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('partner_transfers.property_group', 'like', '%(' . $g . ')%');
                }
            });
        }
        if(isset($request->pid) && $request->pid){
            $reports=$reports->where('property_id','like','%('.$request->pid.')%');
        }
        $reports=$reports->orderBy('partner_transfers.id')->get();

        return view('realestates.print_income_expanse_report',compact('reports','d1','d2','trancode','rpttitle','paymenttype'));
    }
    public function show_incomeexpansereport(Request $request)
    {
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        if($request->selbank=='all'){
            $incomes = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
            ->where('c.customertype', 'BUYER')
            ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.location_id', 8)
            ->whereNotIn('partner_transfers.trancode', [-8, 8])
            ->where('partner_transfers.amount', '>', 0)
            ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too

            $expanses = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
            ->where('c.customertype', 'SALER')
            ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.location_id', 8)
            ->whereNotIn('partner_transfers.trancode', [-8, 8])
            ->where('partner_transfers.amount', '<', 0)
            ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too

        }else{
            $incomes = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
            ->where('c.customertype', 'BUYER')
            ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.location_id', 8)
            ->whereNotIn('partner_transfers.trancode', [-8, 8])
            ->where('partner_transfers.amount', '>', 0)
            ->where('partner_transfers.deposit_via_id', '=', $request->selbank)
            ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too

             $expanses = PartnerTransfer::join('customers as c', 'partner_transfers.parrent_id', '=', 'c.id')
            ->where('c.customertype', 'SALER')
            ->whereBetween(DB::raw('DATE(partner_transfers.dd)'), [$d1, $d2])
            ->where('partner_transfers.status', 1)
            ->where('partner_transfers.location_id', 8)
            ->whereNotIn('partner_transfers.trancode', [-8, 8])
            ->where('partner_transfers.amount', '<', 0)
            ->where('partner_transfers.deposit_via_id', '=', $request->selbank)
            ->select('partner_transfers.*', 'c.name as customername'); // Example: Fetching customer names too

        }

        if(isset($request->selgroup) && $request->selgroup){
            $selgroup=$request->selgroup;
            $incomes = $incomes
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('partner_transfers.property_group', 'like', '%(' . $g . ')%');
                }
            });

            $expanses = $expanses
            ->where(function ($query) use ($selgroup) {
                foreach ($selgroup as $g) {
                    $query->orWhere('partner_transfers.property_group', 'like', '%(' . $g . ')%');
                }
            });
        }
        if(isset($request->pid) && $request->pid){
            $incomes=$incomes->where('property_id','like','%('.$request->pid.')%');
            $expanses=$expanses->where('property_id','like','%('.$request->pid.')%');

        }
        $incomes=$incomes->orderBy('partner_transfers.id')->get();
        $expanses=$expanses->orderBy('partner_transfers.id')->get();

        return view('realestates.show_income_expanse_report',compact('incomes','expanses'));
    }
    public function updatecuscharge(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'discount_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $transfer=PartnerTransfer::find($request->id);
        if($transfer){
            $cuscharge=str_replace(',','',$request->balance);
            if(floatval($cuscharge)<0){
                $cuscharge=0;
            }
            $transfer->cuscharge=$cuscharge;
            $transfer->discount_amount=str_replace(',','',$request->discount_amount);
            if($transfer->save()){
                return response()->json(['success'=>true,'message'=>'update completed']);
            }else{
                return response()->json(['error'=>true,'message'=>'update fail']);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'id not found']);
        }
    }
    public function savedeposit(Request $request)
    {
        //return $request->all();
        $validator = Validator::make($request->all(), [
            'deposit' => 'required',
            'partner_id'=>'required',
            'overday'=>'required',
            'overprice'=>'required',
            'payamt'=>'required',
            'paycommission' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $saler_id=0;
        $checktrid=PartnerTransfer::find($request->id1);
        if($checktrid){
            if($checktrid->trancode==-8){
                $trancode=1;
                $mekun=1;
                $saler_id=$checktrid->customer_id;
                $commission=$checktrid->cuscharge;
                $sumpaycom=PartnerTransfer::where('payonid',$checktrid->map_id)->where('parrent_id',$saler_id)->where('status',1)->sum('amount');
                $havecommission = abs($sumpaycom) < abs($commission) ? 1 : 0;

                if(isset($request->isromlos)){
                    $tranname="បង់ប្រាក់";
                    $tranname1="ទទួលបង់ប្រាក់";
                }else{
                    $tranname="កក់ប្រាក់";
                    $tranname1="ទទួលប្រាក់កក់";
                }
            }else if($checktrid->trancode==8){
                $havecommission=0;
                $trancode=-1;
                $mekun=-1;
                $tranname="ទូទាត់កម្រៃជើងសារ";
                $tranname1="សងកម្រៃជើងសារ";
            }
        }else{
            return response()->json(['error'=>true,'message'=>'pay on id not found']);
        }
        if($request->selbank<>'cash'){
            $trancode=4 * floatval($trancode);
        }
        $date = str_replace('/', '-', $request->invdate);
        $trandate= date('Y-m-d', strtotime($date));
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trantime = date("H:i:s",strtotime($current));
        $founderror=0;
        $refgroupid=null;
        $id=null;

        if($checktrid){
            if(isset($request->isromlos)){
                $qty=$request->qty;
            }else{
                $qty=1;
            }
            for($i=0;$i<$qty;$i++){  //ភ្ញៀវចង់បង់ច្រើនជាង១ខែ
                $j=$i+1;
                $ptf=new PartnerTransfer();
                $ptf->tranname=$tranname;
                $ptf->trancode=$trancode;
                $ptf->mekun=$mekun;
                $ptf->dd=$trandate;
                $ptf->tt=$trantime;
                $ptf->user_id=Auth::id();
                $ptf->parrent_id=$request->partner_id;
                $ptf->amount=(floatval($mekun) * floatval(str_replace(',','',$request->deposit)))/floatval($qty);
                $ptf->currency_id=$request->curid;
                $ptf->cuscharge=$i==0?floatval(str_replace(',','',$request->overamount)) + floatval(str_replace(',','',$request->old_cuscharge_debt)) : 0;
                $ptf->cuscharge_ex=$i==0?floatval(str_replace(',','',$request->overamount)) + floatval(str_replace(',','',$request->old_cuscharge_debt)) : 0;

                $ptf->cuscharge_currency_id=$request->curid;
                $ptf->fee=0;
                $ptf->fee_ex=0;
                $ptf->fee_currency_id=$request->curid;
                $ptf->bonus=0;
                $ptf->deposit_via=$request->payby;
                $ptf->deposit_via_id=$request->selbank;
                $ptf->payonid=$request->id1;
                $ptf->sendername=$request->property;
                $ptf->property_group=$request->property_group;
                $ptf->property_id=$request->property_id;
                if($i==0){
                    if($request->selbank=='cash'){
                        $cash=str_replace(',','',$request->payamt);
                        $bank=0;
                    }else{
                        $bank=str_replace(',','',$request->payamt);
                        $cash=floatval(str_replace(',','',$request->deposit))+floatval(str_replace(',','',$request->overamount))-floatval(str_replace(',','',$request->discount_amount))-floatval($bank);
                    }
                    $ptf->cash_amount=$cash;
                    $ptf->bank_amount=$bank;
                    $ptf->cuscharge_debt=str_replace(',','',$request->cuscharge_debt);
                }
                if(isset($request->isromlos)){
                    $ptf->payformonth=date('Y-m-d', strtotime( "+ $i months", strtotime($request->payformonth)));
                    //$ptf->nextpayment=date('Y-m-d', strtotime( "+ $i months", strtotime($request->payfornextmonth)));
                    $ptf->nextpayment=date('Y-m-d', strtotime( "+ $j months", strtotime($request->payformonth)));
                }
                $ptf->ref_group_id=$refgroupid;
                $ptf->note=$request->note;
                if($j==1){
                    $ptf->overday=$request->overday;
                    $ptf->overprice=$request->overprice;
                    $ptf->nopunish=$request->nopunish=='true'?1:0;
                    $ptf->discount_amount=str_replace(',','',$request->discount_amount);
                }
                $ptf->location_id=8;
                $ptf->created_at=$current;
                $ptf->updated_at=$current;
                $ptf->action='u,d';
                if($ptf->save()){
                    $mapid=$ptf->id;
                    if($i==0){
                        $id=$ptf->id;
                        $refgroupid='propertypayment-'. $id;
                    }
                    //save for commission
                    if($havecommission==1){
                        $ptf2=new PartnerTransfer();
                        $ptf2->tranname='ទូទាត់កម្រៃជើងសារ';
                        $ptf2->trancode=-1;
                        $ptf2->mekun=-1;
                        $ptf2->dd=$trandate;
                        $ptf2->tt=$trantime;
                        $ptf2->user_id=Auth::id();
                        $ptf2->parrent_id=$saler_id;
                        $ptf2->amount=0;
                        $ptf2->temp_amount=str_replace(',','',$request->paycommission);

                        $ptf2->currency_id=$request->curid;
                        $ptf2->cuscharge=0;
                        $ptf2->cuscharge_ex=0;
                        $ptf2->cuscharge_currency_id=$request->curid;
                        $ptf2->fee=0;
                        $ptf2->fee_ex=0;
                        $ptf2->fee_currency_id=$request->curid;
                        $ptf2->bonus=0;
                        $ptf2->sendername=$request->property;
                        $ptf2->sendertel='';
                        $ptf2->payonid=$checktrid->map_id;
                        $ptf2->map_id=$mapid;
                        $ptf2->ref_group_id=$refgroupid;
                        $ptf2->note=$request->note;
                        $ptf2->location_id=8;
                        $ptf2->created_at=$current;
                        $ptf2->updated_at=$current;
                        $ptf2->property_group=$request->property_group;
                        $ptf2->property_id=$request->property_id;
                        if(isset($request->isromlos)){
                            $ptf2->payformonth=date('Y-m-d', strtotime( "+ $i months", strtotime($request->payformonth)));
                            //$ptf2->nextpayment=date('Y-m-d', strtotime( "+ $j months", strtotime($request->payformonth)));
                        }
                        if($ptf2->save()){
                            DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$refgroupid]);
                        }else{
                             $founderror=1;
                        }
                    }
                }else{
                    $founderror=1;
                }
            }
            if($founderror==0){
                if($request->selbank=='cash'){
                    if($checktrid->trancode==8){
                        $cashdraw=new Cashdraw();
                        $cashdraw->from_partner_id=$request->partner_id;
                        $cashdraw->transfer_id=$id;
                        $cashdraw->opdate=$trandate;
                        $cashdraw->optime=$trantime;
                        $cashdraw->user_id=Auth::id();
                        $cashdraw->amount=str_replace(',','',$request->deposit);
                        $cashdraw->currency_id=$request->curid;
                        $cashdraw->customer_charge=0;
                        $cashdraw->cuscharge_currency_id=$request->curid;
                        $cashdraw->paymethod='Cash';
                        $cashdraw->receive_tel='';
                        $cashdraw->receive_name='';
                        $cashdraw->note=$request->note;
                        $cashdraw->other='';
                        $cashdraw->ref_number=$refgroupid;
                        $cashdraw->ref_group_id=$refgroupid;
                        $cashdraw->action='';
                        $cashdraw->created_at=$current;
                        $cashdraw->updated_at=$current;
                        if($cashdraw->save())
                        {
                            $cashdraw_id=$cashdraw->id;
                            DB::table('partner_transfers')->where('id',$id)->update(['iscashdraw'=>'1','cashdraw_id'=>$cashdraw_id,'ref_group_id'=>$refgroupid]);
                        }else{
                            $founderror=1;
                        }
                    }else{
                        if($qty>1){
                            DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$refgroupid]);
                        }
                    }
                }else{
                    //save to bank
                    $ptf1=new PartnerTransfer();
                    $ptf1->tranname=$tranname1;
                    $ptf1->trancode=-1 * floatval($trancode);
                    $ptf1->mekun=-1 * floatval($mekun);
                    $ptf1->dd=$trandate;
                    $ptf1->tt=date('H:i:s',strtotime($trantime . ' +1 seconds'));
                    $ptf1->user_id=Auth::id();
                    $ptf1->parrent_id=$request->selbank;
                    $ptf1->amount=-1 * floatval($mekun) * floatval(str_replace(',','',$request->payamt));
                    $ptf1->currency_id=$request->curid;
                    $ptf1->cuscharge=0;
                    $ptf1->cuscharge_ex=0;
                    $ptf1->cuscharge_currency_id=$request->curid;
                    $ptf1->fee=0;
                    $ptf1->fee_ex=0;
                    $ptf1->fee_currency_id=$request->curid;
                    $ptf1->bonus=0;
                    $ptf1->ref_group_id=$refgroupid;
                    $ptf1->sendername=$request->txtname;
                    $ptf1->note=$request->note;
                    $ptf1->isbank=1;
                    $ptf1->location_id=8;
                    $ptf1->created_at=$current;
                    $ptf1->updated_at=$current;
                    if($ptf1->save())
                    {
                        DB::table('partner_transfers')->where('id',$id)->update(['ref_group_id'=>$refgroupid]);
                    }else{
                        $founderror=1;
                    }

                }

                if($request->selproperty50){
                    DB::table('sale_details')->where('sale_id',$request->id1)->whereIn('property_id',$request->selproperty50)->update(['payoff'=>1,'transfer_id'=>$id,'pay_off_date'=>$trandate,'updated_at'=>$current]);
                }
                $message='អតិថិជន: ' . $request->txtname .  "\r\n" .
                        'អចលនទ្រព្យ: ' . $request->property . "\r\n" .
                        'បង់ចំនួន: ' . $request->qty . ' ខែ' . "\r\n" .
                        'ទឹកប្រាក់់: ' . $request->deposit . ' ' . $request->depositcur . "\r\n" .
                        'ទូទាត់តាម: ' . $request->payby . "\r\n" .
                        'បង់សំរាប់ខែ: ' . $request->payformonth . "\r\n" .
                        'ខែបន្ទាប់: ' . $request->payfornextmonth;
                //$chat_ids=["5626149801","986135830"];
                $te_response = $this->telegramService->sendMessage($message);
                //$te_response = $this->telegramService->sendMessageMulitChartId($message,$chat_ids);

            }else{
                $founderror=1;
            }
            if($founderror==0){
                return response()->json(['success'=>true,'id'=>$id,'groupid'=>$refgroupid,'message'=>'Save Deposit Transaction Completed','te_response'=>$te_response]);
            }else{
                return response()->json(['error'=>true,'message'=>'Save Deposit Error','te_response'=>$te_response]);
            }

        }


    }
    public function payment(Request $request)
    {
        $transfers=PartnerTransfer::find($request->id)->load('currency','partner');
        $cusdebt=PartnerTransfer::where('payonid',$request->id)->where('status',1)->orderBy('id','desc')->first();
        // $cusdebt = PartnerTransfer::where('payonid', $request->id)->where('status',1)
        //     ->latest('id')
        //     ->value('cuscharge_debt');
        if($transfers){
            $totalpayment=PartnerTransfer::where('payonid',$request->id)->where('status',1)->where('id','<>',$transfers->id)->where('parrent_id',$transfers->parrent_id)->sum('amount');
            //get paycommission
            $comid=$transfers->map_id;
            $commission=$transfers->cuscharge;
            $customerid=$transfers->customer_id;
            $commission_paid=PartnerTransfer::where('status',1)->where('payonid',$comid)->where('id','<>',$comid)->where('parrent_id',$customerid)->sum('amount');
            $commissionleft=floatval($commission)+floatval($commission_paid);
        }
        if($transfers->trancode==8){
            $saledetails=SaleDetail::where('sale_id',$request->map_id)->where('status',1)->get()->load('property','currency');
        }else{
            $saledetails=SaleDetail::where('sale_id',$request->id)->where('status',1)->get()->load('property','currency');
        }
        if($transfers){
            return response()->json(['success'=>true,'transfers'=>$transfers,'saledetails'=>$saledetails,'totalpayment'=>$totalpayment,'commissionleft' => $commissionleft,'cusdebt' => $cusdebt]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function showdeposit(Request $request)
    {
        //return $request->all();
        $invid=$request->id;
        $customertype=$request->customertype;
        $cid=$request->customer_id;
        $term=$request->term;
        $sendername=$request->sendername;
        $rate=$request->rate;
        $startdate=date('Y-m-d', strtotime($request->startdate));
        $enddate=date('Y-m-d', strtotime($request->enddate));
        $curid=$request->curid;
        $cursk=$request->cursk;
        $curname=$request->curname;
        $payinmonth=$request->payinmonth;
        $customertype=$request->customertype;
        $cid=$request->customer_id;
        $invid=$request->id;
        $partners=Customer::where('status',1)->where('customertype',$customertype)->orderBy('no')->get();
        $transfers=PartnerTransfer::where('status',1)
        ->where(function($q) use($invid){
            return $q->where('id',$invid)->orWhere('payonid',$invid);
        })
       ->orderBy('id')->get();

       $myc= collect();
       $lastdeposit=PartnerTransfer::where('payonid',$request->id)->where('id','<>',$request->id)->where('parrent_id',$cid)->where('status',1)->orderBy('id','desc')->first();
       foreach($transfers as $t){
           if($lastdeposit){
               if($lastdeposit->id==$t->id){
                   $action='d';
               }else{
                   $action='';
               }
           }else{
               $action='';
           }
           $myc=$myc->push(['id'=>$t->id,'payonid'=>$request->id,'created_at'=>$t->created_at,'payformonth'=>$t->payformonth,'tt'=>$t->tt,'usersave'=>$t->user->name,'trancode'=>$t->trancode,'tranname'=>$t->tranname,'amount'=>$t->amount,'curid'=>$t->currency_id,'currency'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'sendername'=>$t->sendername,'groupid'=>$t->ref_group_id,'trandate'=>$t->dd,'action'=>$action,'main_action'=>$t->action]);
       }


        if($customertype=='BUYER'){
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',-8)->where('loancomplete',0)->orderBy('id')->get();
        }else{
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',8)->where('loancomplete',0)->orderBy('id')->get();
        }
        foreach($saleinv as $t){
            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
            $t['deposited']=$deposited;
        }
        return view('realestates.showdeposit',compact('myc','partners','customertype','cid','saleinv','invid','sendername','term','rate','startdate','enddate'));
    }
    public function showromloslist(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $invid=$request->id;
        $customertype=$request->customertype;
        $cid=$request->customer_id;
        $term=$request->term;
        $sendername=$request->sendername;
        $property_group=$request->property_group;
        $property_id=$request->property_id;
        $rate=$request->rate;
        $startdate=date('Y-m-d', strtotime($request->startdate));
        $enddate=date('Y-m-d', strtotime($request->enddate));
        $curid=$request->curid;
        $cursk=$request->cursk;
        $curname=$request->curname;
        $payinmonth=$request->payinmonth;
        $payamt=0;
        $foundblank=0;
        $ispayromlos=$request->ispayromlos;
        if($ispayromlos==1){
            $payamt=$request->payinmonth;
        }
        $partners=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $buyinfo=PartnerTransfer::find($invid);
        $transfers=PartnerTransfer::where('status',1)->whereNull('payformonth')
        ->where(function($q) use($invid){
            return $q->where('id',$invid)->orWhere('payonid',$invid);
        })
        ->orderBy('id')->get();
        $myc= collect();
        $lastromlos=PartnerTransfer::where('payonid',$request->id)->where('id','<>',$request->id)->where('parrent_id',$cid)->where('status',1)->orderBy('id','desc')->first();
        foreach($transfers as $t){
            if($lastromlos){
                if($lastromlos->id==$t->id){
                    $action='d';
                }else{
                    $action='';
                }
            }else{
                $action='';
            }
            $myc=$myc->push(['id'=>$t->id,'payonid'=>$request->id,'dd'=>$t->dd,'tt'=>$t->tt,'payformonth'=>$t->payformonth,'usersave'=>$t->user->name,'trancode'=>$t->trancode,'tranname'=>$t->tranname,'amount'=>$t->amount,'curid'=>$t->currency_id,'currency'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'sendername'=>$t->sendername,'groupid'=>$t->ref_group_id,'trandate'=>$t->dd,'action'=>$action]);
        }

         $payment_lists=NewPayRomlos::where('transfer_id',$request->id)->where('status',1)->orderBy('id')->get();


        for($i=0;$i<$term;$i++){
            $nextpayment = date('Y-m-d', strtotime( "+ $i months", strtotime($startdate)));
            $month = date("n",strtotime($nextpayment));
            $year = date("Y",strtotime($nextpayment));

            $found_paymentlist=0;
             $amount = 0;
            // Find matching payment_list record
            foreach ($payment_lists as $p) {
                if ($nextpayment >= $p->start_date && $nextpayment <= $p->end_date) {
                    $amount = $p->amount;
                    $found_paymentlist=1;
                    break;
                }
            }
            if($found_paymentlist==0){
                $amount=$buyinfo->payinmonth;
            }

            //$found=PartnerTransfer::where('payonid',$request->id)->where('parrent_id',$cid)->whereNotNull('payformonth')->whereDate('payformonth',$nextpayment)->where('status',1)->first();
            $found=PartnerTransfer::where('payonid',$request->id)->where('parrent_id',$cid)->whereNotNull('payformonth')->whereMonth('payformonth',$month)->whereYear('payformonth',$year)->where('status',1)->first();

            if($found){
                if($lastromlos->id==$found->id){
                    $action='d';
                }else{
                    $action='';
                }
                $myc=$myc->push(['id'=>$found->id,'payonid'=>$request->id,'dd'=>$found->payformonth,'payformonth'=>$found->payformonth,'tt'=>$found->tt,'usersave'=>$found->user->name,'trancode'=>$found->trancode,'tranname'=>$found->tranname,'amount'=>$found->amount,'curid'=>$found->currency_id,'currency'=>$found->currency->sk,'curname'=>$found->currency->shortcut,'sendername'=>$found->sendername,'groupid'=>$found->ref_group_id,'trandate'=>$found->dd,'action'=>$action]);
            }else{
                $foundblank +=1;
                if($foundblank==1){
                    if($ispayromlos==1){
                        $action='p';
                    }else{
                        $action='';
                    }
                }else{
                    $action='';
                }
                //$myc=$myc->push(['id'=>0,'payonid'=>$request->id,'dd'=>$nextpayment,'tt'=>null,'usersave'=>'','trancode'=>null,'tranname'=>'','amount'=>$payamt,'curid'=>$curid,'currency'=>$cursk,'curname'=>$curname,'sendername'=>'','groupid'=>null,'trandate'=>null,'action'=>$action]);
                $myc=$myc->push(['id'=>0,'payonid'=>$request->id,'dd'=>$nextpayment,'tt'=>null,'usersave'=>'','trancode'=>null,'tranname'=>'','amount'=>$amount,'curid'=>$curid,'currency'=>$cursk,'curname'=>$curname,'sendername'=>'','groupid'=>null,'trandate'=>null,'action'=>$action]);

                //break;
            }
        }
        $myc=$myc->sortBy('dd');
        //return $myc;
        if($customertype=='BUYER'){
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',-8)->where('loancomplete',0)->orderBy('id')->get()->load('currency','partner');
        }else{
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',8)->where('loancomplete',0)->orderBy('id')->get()->load('currency','partner');
        }
        foreach($saleinv as $t){
            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
            $t['deposited']=$deposited;
        }
        return view('realestates.showromloslist',compact('myc','saleinv','partners','customertype','cid','term','rate','startdate','enddate','ispayromlos','invid','sendername','property_group','property_id'));
    }
    public function closelistuser()
    {
        $users=User::where('active',1)->get();
        return view('realestates.closelistuser',compact('users'));
    }
    public function printromloslistforcustomer(Request $request)
    {
        $buyinfo=PartnerTransfer::find($request->id);
        $totaldeposit=PartnerTransfer::where('status',1)->where('parrent_id',$buyinfo->parrent_id)->whereNull('payformonth')->where('payonid',$buyinfo->id)->where('id','<>',$buyinfo->id)->sum('amount');
        $buyinfo['totaldeposit']=$totaldeposit??0;
        $saledetail=SaleDetail::where('sale_id',$buyinfo->id)->where('status',1)->first();
        $propertylocation=$saledetail->property->group->name;
        $buyinfo['propertylocation']=$propertylocation;
        $contract=Contract::where('property_id',$saledetail->property_id)->first();
        if($contract)
        {
            $companyid=$contract->company_id;
            $companyinfo=Company::find($companyid);
        }
        $payment_lists=NewPayRomlos::where('transfer_id',$request->id)->where('status',1)->orderBy('id')->get();
        //return $companyinfo;
        $myc= collect();
        $principal=floatval($buyinfo->amount)+floatval($totaldeposit);
        $balance=$principal;

        for($i=0;$i<$buyinfo->term;$i++){
            $nextpayment = date('Y-m-d', strtotime( "+ $i months", strtotime($buyinfo->startdate)));
            $found=0;
            $amount = 0;
            // Find matching payment_list record
            foreach ($payment_lists as $p) {
                if ($nextpayment >= $p->start_date && $nextpayment <= $p->end_date) {
                    $amount = $p->amount;
                    $found=1;
                    break;
                }
            }
            if($found==0){
                $amount=$buyinfo->payinmonth;
            }
            $balance = floatval($balance) + floatval($amount);
            //$balance=floatval($balance) + floatval($buyinfo->payinmonth);
            $myc=$myc->push(['dd'=>$nextpayment,'principal'=>$principal,'rate'=>0,'payamt'=>$amount,'balance'=>$balance,'cur'=>$buyinfo->currency->sk]);
            //$principal=floatval($principal)+floatval($buyinfo->payinmonth);
            $principal = floatval($principal) + floatval($amount);
        }
        $myc=$myc->sortBy('dd');
        //return $myc;
        return view('realestates.printforcustomerfirst',compact('buyinfo','myc','companyinfo'));
    }
    public function searchromlos(Request $request)
    {
        //return $request->all();
        $invid=$request->id;
        $customertype=$request->customertype;
        $cid=$request->cid;
        $rpttile='តារាងបង់រំលស់របស់អតិថិជន '. $request->cname . '(' . $request->propertyname . ')';
        $term=$request->term;
        $rate=$request->rate;
        $startdate=date('Y-m-d', strtotime($request->startdate));
        $enddate=date('Y-m-d', strtotime($request->enddate));
        $curid=$request->curid;
        $cursk=$request->cursk;
        $curname=$request->curname;
        $payinmonth=$request->payinmonth;
        $propertyname=$request->propertyname;
        $payamt=0;
        $foundblank=0;
        if($request->ispayromlos==1){
            $payamt=$request->payinmonth;
        }
        $buyinfo=PartnerTransfer::find($invid);
        $transfers=PartnerTransfer::where('status',1)->whereNull('payformonth')
        ->where(function($q) use($invid){
            return $q->where('id',$invid)->orWhere('payonid',$invid);
        })
        ->orderBy('id')->get();

        $myc= collect();
        $lastromlos=PartnerTransfer::where('payonid',$request->id)->where('id','<>',$request->id)->where('parrent_id',$cid)->where('status',1)->orderBy('id','desc')->first();
        foreach($transfers as $t){
            if($lastromlos){
                if($lastromlos->id==$t->id){
                    $action='d';
                }else{
                    $action='';
                }
            }else{
                $action='';
            }
            $myc=$myc->push(['id'=>$t->id,'payonid'=>$request->id,'dd'=>$t->dd,'tt'=>$t->tt,'usersave'=>$t->user->name,'trancode'=>$t->trancode,'tranname'=>$t->tranname,'amount'=>$t->amount,'curid'=>$t->currency_id,'currency'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'sendername'=>$t->sendername,'groupid'=>$t->ref_group_id,'trandate'=>$t->dd,'action'=>$action]);
        }
        $payment_lists=NewPayRomlos::where('transfer_id',$request->id)->where('status',1)->orderBy('id')->get();
        for($i=0;$i<$term;$i++){
            $nextpayment = date('Y-m-d', strtotime( "+ $i months", strtotime($startdate)));
            //$found=PartnerTransfer::where('payonid',$request->id)->where('parrent_id',$cid)->whereNotNull('payformonth')->whereDate('payformonth',$nextpayment)->where('status',1)->first();
            $month = date("n",strtotime($nextpayment));
            $year = date("Y",strtotime($nextpayment));
            $found_paymentlist=0;
            $amount = 0;
             // Find matching payment_list record
            foreach ($payment_lists as $p) {
                if ($nextpayment >= $p->start_date && $nextpayment <= $p->end_date) {
                    $amount = $p->amount;
                    $found_paymentlist=1;
                    break;
                }
            }
            if($found_paymentlist==0){
                $amount=$buyinfo->payinmonth;
            }

            $found=PartnerTransfer::where('payonid',$request->id)->where('parrent_id',$cid)->whereNotNull('payformonth')->whereMonth('payformonth',$month)->whereYear('payformonth',$year)->where('status',1)->first();

            if($found){
                if($lastromlos->id==$found->id){
                    $action='d';
                }else{
                    $action='';
                }
                $myc=$myc->push(['id'=>$found->id,'payonid'=>$request->id,'dd'=>$found->payformonth,'tt'=>$found->tt,'usersave'=>$found->user->name,'trancode'=>$found->trancode,'tranname'=>$found->tranname,'amount'=>$found->amount,'curid'=>$t->currency_id,'currency'=>$found->currency->sk,'curname'=>$found->currency->shortcut,'sendername'=>$found->sendername,'groupid'=>$found->ref_group_id,'trandate'=>$found->dd,'action'=>$action]);
            }else{
                $foundblank +=1;
                if($foundblank==1){
                    if($request->ispayromlos==1){
                        $action='p';
                    }else{
                        $action='';
                    }
                }else{
                    $action='';
                }
                $myc=$myc->push(['id'=>0,'payonid'=>$request->id,'dd'=>$nextpayment,'tt'=>null,'usersave'=>'','trancode'=>null,'tranname'=>'','amount'=>$amount,'curid'=>$curid,'currency'=>$cursk,'curname'=>$curname,'sendername'=>'','groupid'=>null,'trandate'=>null,'action'=>$action]);
                //break;
            }
        }
        $myc=$myc->sortBy('dd');
        if(isset($request->isprint)){
            return view('realestates.printsearchromlos',compact('myc','rpttile','startdate','enddate','propertyname'));
        }else{
            return view('realestates.searchromlos',compact('myc'));

        }
    }
    public function searchdeposit(Request $request)
    {
        $customertype=$request->customertype;
        $cid=$request->cid;
        $invid=$request->id;
        $transfers=PartnerTransfer::where('status',1)
        ->where(function($q) use($invid){
            return $q->where('id',$invid)->orWhere('payonid',$invid);
        })->orderBy('id')->get();
        $myc= collect();
        $lastdeposit=PartnerTransfer::where('payonid',$request->id)->where('id','<>',$request->id)->where('parrent_id',$cid)->where('status',1)->orderBy('id','desc')->first();
        foreach($transfers as $t){
            if($lastdeposit){
                if($lastdeposit->id==$t->id){
                    $action='d';
                }else{
                    $action='';
                }
            }else{
                $action='';
            }
            $myc=$myc->push(['id'=>$t->id,'payonid'=>$request->id,'created_at'=>$t->created_at,'payformonth'=>$t->payformonth,'tt'=>$t->tt,'usersave'=>$t->user->name,'trancode'=>$t->trancode,'tranname'=>$t->tranname,'amount'=>$t->amount,'curid'=>$t->currency_id,'currency'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'sendername'=>$t->sendername,'groupid'=>$t->ref_group_id,'trandate'=>$t->dd,'action'=>$action,'main_action'=>$t->action]);
            //$myc=$myc->push(['id'=>$t->id,'payonid'=>$request->id,'dd'=>$t->dd,'tt'=>$t->tt,'usersave'=>$t->user->name,'trancode'=>$t->trancode,'tranname'=>$t->tranname,'amount'=>$t->amount,'curid'=>$t->currency_id,'currency'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'sendername'=>$t->sendername,'groupid'=>$t->ref_group_id,'trandate'=>$t->dd,'action'=>$action,'main_action'=>$t->action]);
        }
        if($customertype=='BUYER'){
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',-8)->where('loancomplete',0)->get();
        }else{
            $saleinv=PartnerTransfer::where('parrent_id',$cid)->where('status',1)->where('trancode',8)->where('loancomplete',0)->get();
        }
        return view('realestates.searchdeposit',compact('myc','saleinv'));
    }
    public function showinvbycustomer(Request $request)
    {
        $customertype=$request->customertype;
        if($customertype=='BUYER'){
            $saleinv=PartnerTransfer::where('parrent_id',$request->cid)->where('status',1)->where('trancode',-8)->where('loancomplete',0)->orderBy('id')->get()->load('currency','partner');
        }else{
            $saleinv=PartnerTransfer::where('parrent_id',$request->cid)->where('status',1)->where('trancode',8)->where('loancomplete',0)->orderBy('id')->get()->load('currency','partner');
        }
        foreach($saleinv as $t){
            $deposited=PartnerTransfer::where('status',1)->where('id','<>',$t->id)->where('payonid',$t->id)->where('parrent_id',$t->parrent_id)->sum('amount');
            $t['deposited']=$deposited;
        }
        return response()->json(['saleinv'=>$saleinv]);
    }

    public function edit(Request $request)
    {
        $transfers=PartnerTransfer::find($request->id)->load('currency');
        $deposit=PartnerTransfer::where('ref_group_id',$request->groupid)->where('mekun',1)->where('status',1)->whereNotIn('trancode',[-8,8])->first();
        $bankrec=PartnerTransfer::where('ref_group_id',$request->groupid)->where('trancode',-4)->where('status',1)->whereNotIn('trancode',[-8,8])->first();
        $saledetails=SaleDetail::where('sale_id',$request->id)->where('status',1)->get()->load('property','currency');
        if($transfers){
            return response()->json(['success'=>true,'transfers'=>$transfers,'saledetails'=>$saledetails,'deposit'=>$deposit,'bankrec'=>$bankrec]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function buypaymentcompleted(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if(DB::table('partner_transfers')->where('id',$request->id)->update(['loancomplete'=>1,'updated_at'=>$current])){
            DB::table('partner_transfers')->where('payonid',$request->id)->update(['loancomplete'=>1,'updated_at'=>$current]);
            return response()->json(['success'=>true,'message'=>'Update Loan Complete Success']);
        }else{
            return response()->json(['error'=>true,'message'=>'Update Loan Complete Fail']);
        }
    }
    public function deletepayment(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $count=0;
        $checkIsPayToSaler = PartnerTransfer::where('ref_group_id', $request->groupid)
        ->where('ispaytosaler', 1)
        ->exists();
        if ($checkIsPayToSaler) {
            return response()->json([
                'error' => true,
                'message' => "Cannot delete this payment.\nBecause this payment has already been paid to the seller."
            ]);
        }
        if(DB::table('partner_transfers')->where('id',$request->id)->update(['status'=>0,'user_delete'=>Auth::id(),'updated_at'=>$current])){
            $count=1;
        }
        if(DB::table('partner_transfers')->whereNotNull('ref_group_id')->where('ref_group_id',$request->groupid)->update(['status'=>0,'user_delete'=>Auth::id(),'updated_at'=>$current])){
            $count=2;
        }
        if(DB::table('cashdraws')->whereNotNull('ref_group_id')->where('ref_group_id',$request->groupid)->update(['status'=>0,'delby'=>Auth::user()->name,'updated_at'=>$current])){
            $count=3;
        }
        if($count>0){
            return response()->json(['success'=>true,'message'=>'group transaction has been delete(' . $count . ')']);

        }else{
            return response()->json(['error'=>true,'message'=>'delete payment fail']);
        }

    }
    public function delete(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $transfer=PartnerTransfer::find($request->id);
        if($transfer){

            if($transfer->trancode==-8){
                $checkifhaspayment=PartnerTransfer::where('payonid',$request->id)->where('status',1)
                ->where(function($q) use($request){
                    $q->WhereNull('ref_group_id')->orWhere('ref_group_id','<>',$request->groupid);
                })->exists();
                if($checkifhaspayment){
                    return response()->json(['error'=>true,'message'=>'you can not remove this transaction with related pay on id']);
                }

                $upsd=SaleDetail::where('sale_id',$request->id)->update(['status'=>0]);
                if($upsd){
                    $upd=DB::table('partner_transfers')->where('ref_group_id',$request->groupid)->update(['status'=>0,'updated_at'=>$current]);
                    if($upd){
                        return response()->json(['success'=>true,'message'=>'delete sale completed']);
                    }else{
                        return response()->json(['error'=>true,'message'=>'delete fail']);
                    }
                }else{
                    return response()->json(['error'=>true,'message'=>'delete fail']);
                }
            }else{
                if($transfer->ref_group_id){
                    $upd=DB::table('partner_transfers')->whereNotNull('ref_group_id')->where('ref_group_id',$request->groupid)->update(['status'=>0,'updated_at'=>$current]);
                    if($upd){
                        return response()->json(['success'=>true,'message'=>'delete sale completed']);
                    }else{
                        return response()->json(['error'=>true,'message'=>'delete fail']);
                    }

                }else{
                    $upd=DB::table('partner_transfers')->where('id',$request->id)->update(['status'=>0]);
                    if($upd){
                        return response()->json(['success'=>true,'message'=>'delete sale completed']);
                    }else{
                        return response()->json(['error'=>true,'message'=>'delete fail']);
                    }
                }
            }
        }else{
            return response()->json(['error'=>true,'message'=>'transaction id not found']);
        }

    }
}
