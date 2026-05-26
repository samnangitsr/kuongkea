<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Company;
use App\Currency;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    //------------------company setup------------------------
    public function companyregister()
    {
        $companies=Company::where('status',1)->get();
        return view('companies.index',compact('companies'));
    }
    public function savecompany(Request $request)
    {
        //return($request->all());
        //count company
        $countcompany=Company::where('status',1)->count();
        if(config('helper.multi_bussiness') <= $countcompany){
             return response()->json(['error'=>true,'message'=>'You can not add more bussiness']);
        }
        // if(config('helper.multi_bussiness') == 0){
        //     //check company first
        //     $havecompany=Company::get();
        //     if($havecompany->count()>0){
        //         return response()->json(['error'=>true,'message'=>'You can not add more bussiness']);
        //     }
        //     //DB::table('companies')->delete();
        // }
        $validator = Validator::make($request->all(), [
        'companyname' => 'required|',
        'subname'=>'required',
        'tel'=>'required',
        'address'=>'required',
        // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);


    if ($validator->fails()) {
        return response()->json(['error'=>$validator->errors()->all()]);
    }else{
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $nb=new Company;
            $nb->name=$request->companyname;
            $nb->name1=$request->companyname1;
            $nb->subname=$request->subname;
            $nb->tel=$request->tel;
            $nb->email=$request->email;
            $nb->website=$request->website;
            $nb->address=$request->address;
            $nb->public_ip=$request->public_ip;
            $nb->subtext=$request->subtext;
            $nb->bossname=$request->ownername;
            $nb->age=$request->age;
            $nb->sex=$request->sex;
            $nb->nation=$request->nation;
            $nb->idcard=$request->idcard;
            $nb->note_text=$request->note_text;
            $nb->boss_address=$request->owneraddress;
            $nb->created_at=$current;
            $nb->updated_at=$current;
            $imgname='';
            if($request->hasFile('image')){
              $image = $request->file('image');
              $imgname = time() . '_' . $image->getClientOriginalName();
              $image->move(public_path('logo'), $imgname);
            }
            $nb->logo=$imgname;

            if($request->hasFile('imageqr')){
              $image = $request->file('imageqr');
              $imgname = time() . '_qr_' . $image->getClientOriginalName();
              $image->move(public_path('logo'), $imgname);
            }
            $nb->qrlogo=$imgname;

            $nb->save();
            return response()->json(['success'=>true,'message'=>'Save Company Completed.']);
        }
        //return response()->json(['error'=>$validator->errors()->all()]);
    }
     public function updatecompany(Request $request)
    {
        //return($request->all());
        $validator = Validator::make($request->all(), [
        'companyname' => 'required|',
        'subname'=>'required',
        'tel'=>'required',
        'address'=>'required',
        // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $nb=Company::find($request->comid);
            $nb->name=$request->companyname;
            $nb->name1=$request->companyname1;
            $nb->subname=$request->subname;
            $nb->tel=$request->tel;
            $nb->email=$request->email;
            $nb->website=$request->website;
            $nb->public_ip=$request->public_ip;
            $nb->address=$request->address;
            $nb->subtext=$request->subtext;
            $nb->bossname=$request->ownername;
            $nb->age=$request->age;
            $nb->sex=$request->sex;
            $nb->nation=$request->nation;
            $nb->idcard=$request->idcard;
            $nb->note_text=$request->note_text;
            $nb->boss_address=$request->owneraddress;
            $nb->updated_at=$current;
            $old_image=$request->old_image;
            $image=$request->file('image');
            if($image){
              File::delete(public_path('logo/'.$old_image));
              $imgname=time().'_'.$image->getClientOriginalName();
              $image->move(public_path('logo/'),$imgname);
            }else
              {
                  $imgname=$old_image;
              }
            $nb->logo=$imgname;

            $old_image=$request->old_imageqr;
            $image=$request->file('imageqr');
            if($image){
              File::delete(public_path('logo/'.$old_image));
              $imgname=time().'_qr_'.$image->getClientOriginalName();
              $image->move(public_path('logo/'),$imgname);
            }else
              {
                  $imgname=$old_image;
              }
            $nb->qrlogo=$imgname;
            $nb->save();
            return response()->json(['success'=>true,'message'=>'Update Company Completed.']);
        }
        //return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function companydata(Request $request)
    {
        $companies=Company::where('status',$request->status)->get();
        return view('companies.companylist',compact('companies'));
    }
    public function customerbytype(Request $request)
    {
        //return $request->all();
        $banks=Customer::where('status',1)->where('company_id',$request->company_id)->where('agent_type_id',$request->seltype)->get();
        return response()->json(['banks'=>$banks]);
    }
     public function getbank(Request $request)
    {
        $selcomid=$request->company_id;

        $banks=Customer::where('status',1)->whereIn('customertype',['BANK','AGENT'])->where('company_id',$selcomid)->get();
        return response()->json(['banks'=>$banks]);
    }
     public function getuser(Request $request)
    {
        $selcomid=$request->company_id;
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
        $currencies=Currency::where('active',1)->where('ispandp','0')->where('company_id',$selcomid)->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('company_id',$selcomid)->get();
        return response()->json(['users'=>$users,'currencies'=>$currencies,'banks'=>$banks]);
    }
    public function getcompanyinfobyid(Request $request)
    {
        $coms=Company::where('id',$request->id)->first();
        return response($coms);
    }
    public function destroycompany(Request $request)
    {
        $com=Company::find($request->id);
        if($request->restore==1){
            $com->status=1;
            $com->save();
        }else{
            if($com->status==1){
                $com->status=0;
                $com->save();
            }else{
                if($com->delete()){
                    File::delete(public_path('logo/'.$request->logo));
                }
            }

        }
    }

}
