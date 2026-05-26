<?php

namespace App\Http\Controllers;

use App\Currency;
use Carbon\Carbon;
use App\Models\Property;
use App\PartnerTransfer;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use App\Models\PropertyGroup;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LandController extends Controller
{
    public function deletepropertysold()
    {
        $properties=Property::orderby('id','desc')->get();
        return view('lands.deletepropertysold',compact('properties'));
    }
    public function getpropertysoldlink(Request $request)
    {
        $saledetails=SaleDetail::where('property_id',$request->pid)->get()->load('property');
        if($saledetails){
           return response()->json(['saledetails'=>$saledetails]);
        }
    }
    public function checkpropertysold(Request $request)
    {
        //return $request->all();
       $saleinfo=PartnerTransfer::find($request->saleid);
       if($saleinfo){
        $groupsolds=PartnerTransfer::where('ref_group_id',$saleinfo->ref_group_id)->orderBy('id')->get()->load('partner','currency');
        return response()->json(['groupsolds'=>$groupsolds]);
       }
    }
    public function checkpropertysoldbypayonid(Request $request)
    {
        //return $request->all();
       $payinfos=PartnerTransfer::where('payonid',$request->id)->where('ref_group_id','<>',$request->groupid)->orderBy('id')->get();
       if($payinfos){
            return view('lands.showpayonidlink',compact('payinfos'));
       }
    }
    public function removegrouppayment(Request $request)
    {

        $checkpayonid=PartnerTransfer::where('payonid',$request->id)->where('ref_group_id','<>',$request->groupid)->exists();
        if(!$checkpayonid){
            $del=PartnerTransfer::where('ref_group_id',$request->groupid)->delete();
            if($del){
                DB::table('cashdraws')->where('ref_group_id',$request->groupid)->delete();
                return response()->json(['success'=>true,'message'=>'this group has been removed']);
            }else{
                return response()->json(['error'=>true,'message'=>'remove fail.']);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'pay on id found.']);
        }
    }
    public function removegrouppayment1(Request $request)
    {

        $del=PartnerTransfer::where('ref_group_id',$request->groupid)->delete();
        if($del){
            DB::table('cashdraws')->where('ref_group_id',$request->groupid)->delete();
            return response()->json(['success'=>true,'message'=>'this group has been removed']);
        }else{
            return response()->json(['error'=>true,'message'=>'remove fail.']);
        }
    }
    public function removesaledetail(Request $request)
    {
        $checksale=PartnerTransfer::where('id',$request->sid)->exists();
        if(!$checksale)
        {
            $del=SaleDetail::where('id',$request->id)->delete();
            if($del){
                DB::table('properties')->where('id',$request->pid)->delete();
                DB::table('contracts')->where('property_id',$request->pid)->delete();

                return response()->json(['success'=>true,'message'=>'this group has been removed']);
            }else{
                return response()->json(['error'=>true,'message'=>'remove fail.']);
            }

        }else{
            return response()->json(['error'=>true,'message'=>'sale id exists']);
        }
    }
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $groups=PropertyGroup::where('status',1)->orderBy('id','desc')->get();
        $lands=Property::where('status',1)->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->where('partner_cur',1)->get();
        $properties=DB::table('properties')
        ->leftJoin('sale_details', 'properties.id','=', 'sale_details.property_id')
        ->leftJoin('partner_transfers', 'sale_details.sale_id', '=', 'partner_transfers.id')
        ->leftJoin('customers','partner_transfers.parrent_id','=','customers.id')
        ->join('currencies','properties.currency_id','=','currencies.id')
        ->join('property_groups','properties.property_group_id','=','property_groups.id')
        ->join('users','properties.user_id','=','users.id')
        ->where('properties.status',1)
        ->select('properties.id as pid','properties.name as pname','properties.status as pstatus','properties.isclose as pisclose','properties.size as size','properties.size1 as size1','properties.price as price','properties.north','properties.south','properties.east','properties.west','properties.com_payoff','properties.com_payloan','properties.currency_id','properties.created_at','properties.desr','properties.property_group_id',
        'currencies.shortcut as currency_shortcut','sale_details.sale_id as saleid','sale_details.status as dstatus','customers.name as buyer','property_groups.name as gname','property_groups.type as gtype','property_groups.address as gaddress','users.name as username')
        ->orderBy('properties.id')->get();
        //return $properties;

        $jsondecode= json_decode($properties);
        $myproperty=collect();

        foreach($properties as $p){
            $found=0;
            $pid=$p->pid;
            if(is_null($p->saleid)){
                $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=>$p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
            }else{
                foreach ($jsondecode as $item ) {
                    if ( $pid == $item->pid && $item->dstatus==1 ) {
                        $found = 1;
                    }
                }
                if($found==1){
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=>$p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                        'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                        'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
                    }
                }else{//sale has been delete
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=>$p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                        'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                        'saleid'=>'','dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
                    }
                }
            }
        }
         //return $myproperty;
        return view('lands.index',compact('groups','lands','currencies','myproperty'));
    }
    public function savelandgroup(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $validator = Validator::make($request->all(), [
          'groupname' => 'required',
          'grouptype' => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()->all()]);
        }
        if($request->groupid==''){
            $pg=new PropertyGroup();
        }else{
            $pg=PropertyGroup::find($request->groupid);
        }
        $pg->name=$request->groupname;
        $pg->type=$request->grouptype;
        $pg->address=$request->groupaddress;
        $pg->addrhead=$request->addrhead;
        $pg->isclose=$request->group_close;
        $pg->status=$request->group_status;

        if($pg->save()){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function saveland(Request $request)
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if($request->landid==''){
            $p=new Property();
            $exist_name=Property::where('name',$request->landname)->where('status',1)->exists();
            if($exist_name){
              return response()->json(['error'=>'this property name has been taken in database']);
            }
        }else{
            $p=Property::find($request->landid);
            $exist_name=Property::where('name',$request->landname)->where('status',1)->where('id','<>',$p->id)->exists();
            if($exist_name){
              return response()->json(['error'=>'this property name has been taken in database']);
            }
            $p->status=$request->selstatus;
        }
        $validator = Validator::make($request->all(), [
            'selbloc' => 'required',
            'landname' => 'required',
            'size' => 'required',
            'price' => 'required',
            'selcur' => 'required',
            'com_payoff' => 'required',
            'com_payloan' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()->all()]);
        }

        $p->name=$request->landname;
        $p->property_group_id=$request->selbloc;
        $p->size=$request->size;
        $p->size1=$request->size1;
        $p->price=str_replace(',','',$request->price);
        $p->com_payoff=str_replace(',','',$request->com_payoff);
        $p->com_payloan=str_replace(',','',$request->com_payloan);
        $p->currency_id=$request->selcur;
        $p->desr=$request->desr;
        $p->north=$request->north;
        $p->south=$request->south;
        $p->east=$request->east;
        $p->west=$request->west;
        $p->isclose=$request->isclose;
        $p->user_id=Auth::id();
        if($p->save()){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['error'=>true]);
        }
    }
    public function propertynameautocomplete(Request $request)
    {
        $data = Property::select("name as  value", "name")
        ->where("name", 'like', '%'.$request->get('search').'%')->where('status',1)->get();
        return response()->json($data);
    }
    public function getpropertygroup(Request $request)
    {
        $groups=PropertyGroup::where('status',$request->status)->orderBy('id','desc')->get();
        return response()->json(['groups'=>$groups]);
    }
    public function getpropertylist(Request $request)
    {
        //return $request->all();
        if($request->selgroup=='all'){
            //$p=Property::where('status',1)->get()->load(['group','user','currency']);
            $properties=DB::table('properties')
            ->leftJoin('sale_details', 'properties.id','=', 'sale_details.property_id')
            ->leftJoin('partner_transfers', 'sale_details.sale_id', '=', 'partner_transfers.id')
            ->leftJoin('customers','partner_transfers.parrent_id','=','customers.id')
            ->join('currencies','properties.currency_id','=','currencies.id')
            ->join('property_groups','properties.property_group_id','=','property_groups.id')
            ->join('users','properties.user_id','=','users.id')
            ->where('properties.status',$request->status);
        }else{
            //$p=Property::where('status',1)->whereIn('property_group_id',$request->selgroup)->get()->load(['group','user','currency']);
            $properties=DB::table('properties')
            ->leftJoin('sale_details', 'properties.id','=', 'sale_details.property_id')
            ->leftJoin('partner_transfers', 'sale_details.sale_id', '=', 'partner_transfers.id')
            ->leftJoin('customers','partner_transfers.parrent_id','=','customers.id')
            ->join('currencies','properties.currency_id','=','currencies.id')
            ->join('property_groups','properties.property_group_id','=','property_groups.id')
            ->join('users','properties.user_id','=','users.id')
            ->where('properties.status',$request->status)->whereIn('properties.property_group_id',$request->selgroup);
        }
        if($request->isclose<2)
        {
            $properties=$properties->where('properties.isclose',$request->isclose);
        }
        $properties=$properties->select('properties.id as pid','properties.name as pname','properties.status as pstatus','properties.isclose as pisclose','properties.size as size','properties.size1 as size1','properties.price as price','properties.north','properties.south','properties.east','properties.west','properties.com_payoff','properties.com_payloan','properties.currency_id','properties.created_at','properties.desr','properties.property_group_id',
        'currencies.shortcut as currency_shortcut','sale_details.sale_id as saleid','sale_details.status as dstatus','customers.name as buyer','property_groups.name as gname','property_groups.type as gtype','property_groups.address as gaddress','users.name as username')
        ->orderBy('properties.id')->get();
        $jsondecode= json_decode($properties);
        $myproperty=collect();

        // foreach($properties as $p){
        //     $found=0;
        //     $pid=$p->pid;
        //     $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
        //     'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
        //     'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username]);

        // }
        foreach($properties as $p){
            $found=0;
            $pid=$p->pid;
            if(is_null($p->saleid)){
                $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=> $p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
            }else{
                foreach ($jsondecode as $item ) {
                    if ( $pid == $item->pid && $item->dstatus==1 ) {
                        $found = 1;
                    }
                }
                if($found==1){
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=> $p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                        'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                        'saleid'=>$p->saleid,'dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
                    }
                }else{//sale has been delete
                    if(!$myproperty->contains('pid',$pid)){
                        $myproperty=$myproperty->push(['pid'=>$p->pid,'pname'=> $p->pname,'pstatus'=> $p->pstatus,'pisclose'=>$p->pisclose,'size'=>$p->size,'size1'=>$p->size1,'price'=>$p->price,'com_payoff'=>$p->com_payoff,'com_payloan'=>$p->com_payloan,'north'=>$p->north,'south'=>$p->south,'east'=>$p->east,'west'=>$p->west,
                        'currency_id'=>$p->currency_id,'currency_shortcut'=>$p->currency_shortcut,'created_at'=>$p->created_at,'desr'=>$p->desr,'property_group_id'=>$p->property_group_id,
                        'saleid'=>'','dstatus'=>$p->dstatus,'gname'=>$p->gname,'gtype'=>$p->gtype,'gaddress'=>$p->gaddress,'username'=>$p->username,'buyer'=>$p->buyer]);
                    }
                }
            }
        }
        return response()->json(['p'=>$myproperty]);
    }
    public function propertygroupdelete(Request $request)
    {
        $pg=PropertyGroup::find($request->id);
        $pg->status=!$request->status;
        if($pg->save()){
            return response()->json(['success'=>true,'message'=>'this group has been removed']);
        }else{
            return response()->json(['error'=>true,'message'=>'remove fail.']);
        }
    }
    public function propertydelete(Request $request)
    {
        $pg=Property::find($request->id);
        if($request->restore==1){
            $pg->status=1;
            if($pg->save()){
                return response()->json(['success'=>true,'message'=>'this property has been restore']);
            }else{
                return response()->json(['error'=>true,'message'=>'restore fail.']);
            }
        }else{
            if($request->status==1){
                $pg->status=0;
                if($pg->save()){
                    return response()->json(['success'=>true,'message'=>'this property has been remove']);
                }else{
                    return response()->json(['error'=>true,'message'=>'remove fail.']);
                }
            }else{
                if($pg->delete()){
                    return response()->json(['success'=>true,'message'=>'this property has been remove from database']);
                }else{
                    return response()->json(['error'=>true,'message'=>'remove fail.']);
                }
            }
        }

    }
}
