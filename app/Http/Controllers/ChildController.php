<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use Carbon\Carbon;
use App\CustomerChild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChildController extends Controller
{
    public function index()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
       
        
        $provinces = Address::whereNull('province_id')->get();
        $customers=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();
        $children=CustomerChild::where('status',1)->orderBy('id','desc')->get();
        return view('customers.child',compact('customers','children','provinces'));
    }
    public function address()
    {
        // $provinces = Address::where('province_id','=' ,'1')->first();
        // return $provinces;
        $provinces = Address::whereNull('province_id')->get();
        // return $provinces;
        $addresses=Address::where('status',1)->get();
        
        $customers=Customer::where('status',1)->where('customertype','PARTNER')->orderBy('no')->get();
        $childs=CustomerChild::where('status',1)->orderBy('no')->get();
        return view('customers.address',compact('addresses','childs','provinces'));
    }
    public function deleteaddress(Request $request)
    {
        $a=Address::find($request->id);
        $a->status=0;
        if($a->save()){
            return response()->json(['success'=>true,'message'=>'address has been remove.']);
        }
    }
    public function getdistrict(Request $request)
    {
        $districts = Address::where('province_id',$request->province_id)->where('type','ស្រុក')->where('status',1)->orderBy('id')->get();
        return response($districts);
    }
    public function getcommune(Request $request)
    {
        $communes = Address::where('district_id',$request->district_id)->where('type','ឃុំ')->where('status',1)->orderBy('id')->get();
        return response($communes);
    }
    public function getvillage(Request $request)
    {
        $villages = Address::where('commune_id',$request->commune_id)->where('type','ភូមិ')->where('status',1)->orderBy('id')->get();
        return response($villages);
    }
    public function searchaddress(Request $request)
    {
        
        if($request->province!=''){
            $addresses=Address::where('status',1)->where('province_id',$request->province)->where('type','ស្រុក');
        }
        if($request->district!=''){
            $addresses=Address::where('status',1)->where('province_id',$request->province)->where('district_id',$request->district)->where('type','ឃុំ');
        }
        if($request->commune!=''){
            $addresses=Address::where('status',1)->where('province_id',$request->province)->where('district_id',$request->district)->where('commune_id',$request->commune)->where('type','ភូមិ');
        }
        if($request->village!=''){
            // $addresses=Address::where('status',1)->where('province_id',$request->province)->where('district_id',$request->district)->where('commune_id',$request->commune);
            $addresses=Address::where('id',$request->village);
        }
        $addresses=$addresses->orderBy('id')->get();
        return view('customers.searchaddress',compact('addresses'));

    }
   
    public function saveprovince(Request $request)
    {
        //return $request->all();
        if($request->id==''){
            $a=new Address();
        }else{
            $a=Address::find($request->id);
        }
        $a->name=$request->province;
        $a->type='ខេត្ត';
        if($a->save()){
            $id=$a->id;
            return response()->json(['id'=>$id,'name'=>$request->province,'success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function savedistrict(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'province_id' => 'required', 
            'district' => 'required', 
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        if($request->id==''){
            $a=new Address();
        }else{
            $a=Address::find($request->id);
        }
        
        $a->name=$request->district;
        $a->type='ស្រុក';
        $a->province_id=$request->province_id;
        if($a->save()){
            $id=$a->id;
            return response()->json(['id'=>$id,'name'=>$request->district,'success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function savecommune(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'province_id' => 'required', 
            'district_id' => 'required', 
            'commune'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        if($request->id==''){
            $a=new Address();
        }else{
            $a=Address::find($request->id);
        }
        $a->name=$request->commune;
        $a->type='ឃុំ';
        $a->province_id=$request->province_id;
        $a->district_id=$request->district_id;
        
        if($a->save()){
            $id=$a->id;
            return response()->json(['id'=>$id,'name'=>$request->commune,'success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function savevillage(Request $request)
    {
        //return $request->all();

        $validator = Validator::make($request->all(), [
            'province_id' => 'required', 
            'district_id' => 'required', 
            'commune_id'=>'required',
            'village'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        if($request->id==''){
            $a=new Address();
        }else{
            $a=Address::find($request->id);
        }
        $a->name=$request->village;
        $a->type='ភូមិ';
        $a->province_id=$request->province_id;
        $a->district_id=$request->district_id;
        $a->commune_id=$request->commune_id;
        if($a->save()){
            $id=$a->id;
            return response()->json(['id'=>$id,'name'=>$request->village,'success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function getmaxchildno(Request $request){
        $maxno=CustomerChild::where('customer_id',$request->parentid)->max('no');
        return response()->json(['maxno'=>$maxno+1]);
    }
    public function searchchild(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if($request->searchby=='registerdate'){
            $children=CustomerChild::where('status',1)->whereDate('created_at',$current)->orderBy('id','desc')->get();
        }else{
            $children=CustomerChild::where('status',1);
            if($request->province!=''){
                $children=$children->where('province_id',$request->province);
            }
            if($request->district!=''){
                $children=$children->where('district_id',$request->district);
            }
            if($request->customer!=''){
                $children=$children->where('customer_id',$request->customer);
            }
            $children=$children->orderBy('id','desc')->get();
        }
        if($request->searchfrom=='transfer'){
            return view('moneytransfers.searchchildlist',compact('children'));
        }else{
            return view('customers.searchchildlist',compact('children'));
        }
    }
    
    public function store(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $validator = Validator::make($request->all(), [
            'selcustomer' => 'required', 
            'childname' => 'required', 
            'no'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        if($request->child_id==''){
            $c=new CustomerChild();
        }else{
            $c=CustomerChild::find($request->child_id);
        }
        $c->customer_id=$request->selcustomer;
        $c->name=$request->childname;
        $c->tel=$request->tel;
        $c->province_id=$request->sel_province1;
        $c->district_id=$request->sel_district1;
        $c->commune_id=$request->sel_commune1;
        $c->village_id=$request->sel_village1;
        
        $c->no=$request->no;
        $c->recordby=Auth::user()->name;
        $c->created_at=$current;
        if($c->save()){
            $cid=$c->id;
            return response()->json(['success'=>'savesuccess','cid'=>$cid,'cname'=>$request->childname]);
        }
    }
    public function delete(Request $request)
    {
        $c=CustomerChild::find($request->id);
        $c->status=0;
        if($c->save()){
            return response()->json(['success'=>true,'message'=>'Child has been remove.']);
        }
    }
}
