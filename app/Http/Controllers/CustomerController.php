<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Address;
use App\Company;
use App\Invoice;
use App\Customer;
use Carbon\Carbon;
use App\CustomerList;
use App\CustomerChild;
use App\PartnerAccount;
use App\BankTransaction;
use App\CustomerTempList;
use App\Models\AgentType;
use App\Models\ThaiAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
  public function cusnameautocomplete(Request $request)
  {
      $data = Customer::select("name as  value", "tel")->where('company_id',$request->company)
      ->where("name", 'like', '%'.$request->get('search').'%')->get();
      return response()->json($data);
  }
  public function getthaiaccount(Request $request)
  {
    $thaiacc=ThaiAccount::where('status',1)->where('company_id',$request->company)->get();
     return response($thaiacc);
  }
  public function getusercompany(Request $request)
  {
    $selcomid=$request->company;
     $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
         return response($users);
  }
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $customers=Customer::where('status',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $provinces = Address::whereNull('province_id')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $agenttypes=AgentType::where('status',1)->get();
        $thaiacc=ThaiAccount::where('status',1)->where('company_id',$selcomid)->get();
        $companies=Company::where('status',1)->get();
        return view('customers.index',compact('customers','provinces','users','agenttypes','thaiacc','companies','selcomid'));
    }
    public function getiteminfo(Request $request){
      $data=Item::all();
      return response()->json(['data'=>$data]);
    }
    public function getlocationinfo(Request $request){
      $data=PartnerAccount::select('location')->distinct()->get();
      return response()->json(['data'=>$data]);
    }
    public function searchbytype(Request $request)
    {
        //return($request->all());
        if($request->selcompany=='all'){
             $customers=Customer::where('status',1);
        }else{
            $customers=Customer::where('status',1)->where('company_id',$request->selcompany);
        }
        if($request->custype!=='all'){
            $customers=$customers->whereIn('customertype',$request->custype);
        }
        $customers=$customers->orderBy($request->sortby)->get();
        return view('customers.searchlist',compact('customers'));
    }
    public function savepartneraccount(Request $request)
    {
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $validator = Validator::make($request->all(), [
        'acc_partner_id' => 'required',
        'acc_partner_name' => 'required',
        'selitem'=>'required'
      ]);
      if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()->all()]);
      }
      if($request->account_id==''){
          $c=new PartnerAccount();
      }else{
          $c=PartnerAccount::find($request->account_id);
      }
      $c->customer_id=$request->acc_partner_id;
      $c->item_id= $request->selitem;
      $c->location= $request->location;
      $c->ac_r= $request->ac_r;
      $c->ac_name_r= $request->ac_name_r;
      $c->ac_d= $request->ac_d;
      $c->ac_name_d= $request->ac_name_d;
      $c->ac_b= $request->ac_b;
      $c->ac_name_b= $request->ac_name_b;
      $c->regby=Auth::user()->name;
      $c->regdate=$current;
      $c->created_at=$current;
      $c->updated_at=$current;
      if($c->save())
      {
        return response()->json(['success'=>true]);
      }else{
        return response()->json(['error'=>true]);
      }

    }
    public function storeagenttype(Request $request)
    {
        //return $request->all();
         $validator = Validator::make($request->all(), [
            'txtitemtype' => 'required|',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
          ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $imgname='';
                $current = Carbon::now();
                $current->timezone('Asia/Phnom_Penh');
                $old_image=$request->old_image;
                $image=$request->file('image');
                if($request->typeid==''){
                    $nb=new AgentType();
                    if($request->hasFile('image')){
                        $image = $request->file('image');
                        $imgname = $request->txtitemtype . '_' . $image->getClientOriginalName();
                        $image->move(public_path('logo'), $imgname);
                      }
                }else{
                    $nb=AgentType::find($request->typeid);
                    if($image){
                        File::delete(public_path('logo/'.$old_image));
                        $imgname=time().'-'.$image->getClientOriginalName();
                        $image->move(public_path('logo/'),$imgname);
                    }else{
                        $imgname=$old_image;
                    }
                }
                $nb->name=$request->txtitemtype;
                $nb->created_at=$current;
                $nb->updated_at=$current;
                $nb->logo=$imgname;
                $nb->transfer_amount=$request->transfer_amount;
                $nb->customer_fee=$request->customer_fee;
                $nb->transfer_fee=$request->transfer_fee;
                $nb->cashdraw_fee=$request->cashdraw_fee;
                if($nb->save()){
                    return response()->json(['success'=>'Save Agenttype Completed.']);
                }
            }
    }
    public function readagenttype(){
        $agenttypes=AgentType::where('status',1)->get();
        return view('customers.agenttypelist',compact('agenttypes'));

    }
    public function deleteagenttype(Request $request)
    {
        $a=AgentType::find($request->id);
        $a->status=0;
        $a->save();
    }
    public function storeitem(Request $request)
    {
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $validator = Validator::make($request->all(), [
        'itemname' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()->all()]);
      }

      $c=new Item();

      $c->name=$request->itemname;

      $c->created_at=$current;
      $c->updated_at=$current;
      if($c->save())
      {
        return response()->json(['success'=>true]);
      }else{
        return response()->json(['error'=>true]);
      }

    }
    public function getcustomeraccount(Request $request){
      $c=PartnerAccount::where('customer_id',$request->customerid)->orderBy('id')->get()->load('customer','item');
      return response()->json(['success'=>true,'account'=>$c]);
    }
    public function getmainitemlist(Request $request){
      $c=Item::orderBy('id')->get();
      return response()->json(['success'=>true,'mainitem'=>$c]);
    }
    public function updateno(Request $request)
    {
      DB::table('customers')->where('id',$request->id)->update(['no'=>$request->no]);
    }
    public function print(Request $request)
    {
      //return $request->all();
        $customertype=$request->custype;
        if($request->custype=='all'){
            $customers=Customer::where('status',1)->orderBy($request->sortby)->get();
        }else{
            $customers=Customer::where('status',1)->where('customertype',$request->custype)->orderBy($request->sortby)->get();
        }
       // return $customers;
        return view('customers.print',compact('customers','customertype'));
    }
    public function getmaxcustomerno(){
        $maxno=Customer::max('no');

        return response()->json(['maxno'=>$maxno+1]);
    }
    public function store(Request $request)
    {
        //return $request->all();
        $showinlist=$request->showinlist?1:0;
        $isgoldlist=$request->is_gold_list?1:0;

        $validator = Validator::make($request->all(), [
            'seltype' => 'required',
            'cusname' => 'required',
            'no'=>'required',
            'company'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->txtcusid==''){
            $c=new Customer();
        }else{
            $c=Customer::find($request->txtcusid);
        }
        $c->user_id=Auth::id();
        $c->name=$request->cusname;
        $c->sex=$request->radsex;
        $c->tel=$request->tel;
        $c->openaddress=$request->addr;
        $c->customertype=$request->seltype;
        $c->agent_type_id=$request->selagenttype;
        $c->company_id=$request->company;
        $c->no=$request->no;
        $c->showinlist=$showinlist;
        $c->is_gold_list=$isgoldlist;
        $c->thai_list=$request->thai_account;
        $c->province_id=$request->sel_province1;
        $c->district_id=$request->sel_district1;
        $c->commune_id=$request->sel_commune1;
        $c->village_id=$request->sel_village1;
        $c->idcard=$request->idcard;
        if($request->seluserconnect){
            $c->user_connect=implode(',',$request->seluserconnect);
        }else{
            $c->user_connect='';
        }

        if($c->save()){
            $cid=$c->id;
            return response()->json(['success'=>'savesuccess','cid'=>$cid,'cname'=>$request->cusname]);
        }
    }
    public function delete(Request $request)
    {
        $c=Customer::find($request->id);
        $c->status=0;
        if($c->save()){
            return response()->json(['success'=>true,'message'=>'Customer has been remove.']);
        }
    }
    public function deleteaccount(Request $request)
    {
        $c=PartnerAccount::find($request->id);
        if($c->delete()){
            return response()->json(['success'=>true,'message'=>'Customer account has been remove.']);
        }
    }
    public function deletemainitem(Request $request)
    {
        $c=Item::find($request->id);
        if($c->delete()){
            return response()->json(['success'=>true,'message'=>'Item has been remove.']);
        }
    }
    public function closelist()
    {
        return view('customers.closelist');
    }
    public function checkcloselist()
    {
        return view('customers.checkcloselist');
    }
    public function getcloselist(Request $request)
    {
        $listdate = str_replace('/', '-', $request->listdate);
        $listdate= date('Y-m-d', strtotime($listdate));
        if($request->customertype=='all'){
            $data=CustomerList::join('customers','customer_lists.customer_id','=','customers.id')
            ->whereDate('customer_lists.closedate',$listdate)->orderBy('customers.no')->get();
        }else{
            $data=CustomerList::join('customers','customer_lists.customer_id','=','customers.id')
            ->whereDate('customer_lists.closedate',$listdate)->where('customers.customertype',$request->customertype)->orderBy('customers.no')->get();
        }

        return view('customers.cuslist',compact('data'));

    }
    public function deletecloselist(Request $request)
    {
        $listdate = str_replace('/', '-', $request->dd);
        $listdate= date('Y-m-d', strtotime($listdate));
        if($request->customertype=='all'){
            $delete=CustomerList::whereDate('closedate',$listdate)->delete();
        }else{
            $delete=CustomerList::join('customers','customer_lists.customer_id','=','customers.id')
            ->whereDate('customer_lists.closedate',$listdate)->where('customers.customertype',$request->customertype)->delete();
        }
        if($delete){
            return response()->json(['success'=>true,'message'=>'customer close list has been deleted']);
        }else{
            return response()->json(['error'=>true,'message'=>'delete error']);
        }

    }

    public function showlist(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $listdate = str_replace('/', '-', $request->listdate);
        $listdate= date('Y-m-d', strtotime($listdate));
        DB::table('customer_temp_lists')->where('user_id',Auth::id())->delete();
        if($request->custype=='all' || $request->custype=='customer'){
            $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('id')->get();
            foreach($customers as $c)
            {
                $bal=0;
                $closeusd=0;
                $closethb=0;
                $closekhr=0;
                $closedate='1901-01-01';
                $customerlist=CustomerList::where('customer_id',$c->id)->orderBy('closedate','desc')->first();
                if($customerlist){
                    $closeusd=$customerlist->balusd;
                    $closethb=$customerlist->balthb;
                    $closekhr=$customerlist->balkhr;
                    $closedate=$customerlist->closedate;
                }
                $cuslist=Invoice::where('customer_id',$c->id)->where('status',1)->whereDate('invdate','<=',$listdate)->whereDate('invdate','>',$closedate)->where('cur','USD')->select(DB::raw('sum(total-deposit) as balance'))->first();
               if($cuslist->balance<>null){
                    $bal=$cuslist->balance;
               }
                DB::table('customer_temp_lists')->insert([
                    'customer_id'=>$c->id,
                    'user_id'=>Auth::id(),
                    'balusd'=>$bal+$closeusd,
                    'balkhr'=>$closekhr,
                    'balthb'=>$closethb,
                    'created_at'=>$current,
                    'updated_at'=>$current
                ]);
            }
        }
        if($request->custype=='all' || $request->custype=='bank'){
            $customers=Customer::where('status',1)->where('customertype','BANK')->orderBy('id')->get();
            foreach($customers as $c)
            {
                $balusd=0;
                $balkhr=0;
                $balthb=0;
                $closeusd=0;
                $closethb=0;
                $closekhr=0;
                $closedate='1901-01-01';
                $customerlist=CustomerList::where('customer_id',$c->id)->orderBy('closedate','desc')->first();
                if($customerlist){
                    $closeusd=$customerlist->balusd;
                    $closethb=$customerlist->balthb;
                    $closekhr=$customerlist->balkhr;
                    $closedate=$customerlist->closedate;
                }
                $banklist=BankTransaction::where('customer_id',$c->id)->where('status',1)->whereDate('trandate','<=',$listdate)->whereDate('trandate','>',$closedate)->select(DB::raw('cur,sum(amount) as balance'))->groupBy('cur')->get();
                foreach($banklist as $bl){
                    if($bl->cur=='USD'){
                        $balusd=$bl->balance;
                    }elseif($bl->cur=='KHR'){
                        $balkhr=$bl->balance;
                    }elseif($bl->cur=='THB'){
                        $balthb=$bl->balance;
                    }
                }
                DB::table('customer_temp_lists')->insert([
                    'customer_id'=>$c->id,
                    'user_id'=>Auth::id(),
                    'balusd'=>$balusd+$closeusd,
                    'balkhr'=>$balkhr+$closekhr,
                    'balthb'=>$balthb+$closethb,
                    'created_at'=>$current,
                    'updated_at'=>$current
                ]);
            }
        }
        $data=CustomerTempList::where('user_id',Auth::id())->get();
        return view('customers.custemplist',compact('data'));

    }
    public function savecloselist(Request $request)
    {
        //return $request->all();
        $listdate = str_replace('/', '-', $request->listdate);
        $listdate= date('Y-m-d', strtotime($listdate));

        foreach ($request->cusid as $key => $value) {
            DB::table('customer_lists')->whereDate('closedate','=',$listdate)->where('customer_id',$value)->delete();
            $balusd=str_replace('USD','',$request->balusd[$key]);
            $balkhr=str_replace('KHR','',$request->balkhr[$key]);
            $balthb=str_replace('THB','',$request->balthb[$key]);
            $cuslist=array(
            'closedate'=>$listdate,
            'user_id'=>Auth::id(),
            'customer_id'=>$value,
            'balusd'=>str_replace(',','',$balusd),
            'balkhr'=>str_replace(',','',$balkhr),
            'balthb'=>str_replace(',','',$balthb)

            );
            CustomerList::insert($cuslist);

        }

    }
}
