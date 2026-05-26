<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Customer;
use Carbon\Carbon;
use App\CustomerList;
use App\DailyCloseList;
use App\BankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankTransferController extends Controller
{
    public function index()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->orderBy('no')->get();
        $BankTransactions=BankTransaction::whereDate('trandate',$current)->where('status',1)->orderBy('id')->get();
        return view('banktransfers.index',compact('currencies','banks','BankTransactions'));
    }
    public function report()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->where('isfn',0)->orderBy('no')->get();
        
        return view('banktransfers.report',compact('currencies','banks'));
    }
    public function summaryreport()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->get();
        
        return view('banktransfers.summaryreport',compact('currencies','banks'));
    }
    public function doreportsummary(Request $request)
    {
        $listdate= date('Y-m-d', strtotime($request->dd));
        $viewby=Auth::user()->name;
        DB::table('daily_close_lists')->where('viewby',$viewby)->delete();
        $banks=Customer::where('customertype','BANK')->where('status',1)->get();
        foreach($banks as $b)
        {
            //customer close list
            $closedate='1901-01-01';
            $balusd=0;
            $balkhr=0;
            $balthb=0;
            $bankcloselist=CustomerList::where('customer_id',$b->id)->orderBy('closedate','DESC')->first();
             if($bankcloselist){
                 $closedate=$bankcloselist->closedate;
                 $balusd=$bankcloselist->balusd;
                 $balkhr=$bankcloselist->balkhr;
                 $balthb=$bankcloselist->balthb;
             }
            $closedate=date('Y-m-d', strtotime($closedate));
             //bank transaction
            $usd=0;
            $thb=0;
            $khr=0;
            $khr_usd=0;
            $thb_usd=0;


            $bankdebts=BankTransaction::where('customer_id',$b->id)->where('status',1)->whereDate('trandate','>',$closedate)->whereDate('trandate','<=',$listdate)
            ->select(DB::raw('cur,sum(amount) as balance'))->groupBy('cur')->get();
            foreach($bankdebts as $bd)
            {
                if($bd->cur=='USD'){
                    $usd=$bd->balance;
                }elseif($bd->cur=='KHR'){
                    $khr=$bd->balance;
                    
                }elseif($bd->cur='THB'){
                    $thb=$bd->balance;
                   
                }
            }
            $usd += $balusd;
            $khr +=$balkhr;
            $thb +=$balthb;
            $khr_usd=$this->exchangetousd('KHR',$khr);
            $thb_usd=$this->exchangetousd('THB',$thb);
            $allinusd=$usd+$khr_usd+$thb_usd;

           

            DB::table('daily_close_lists')->insert(['viewby'=>$viewby,'desr'=>$b->name,'customer_id'=>$b->id,'modelname'=>'bank','usd'=>$usd,'thb'=>$thb,'khr'=>$khr,'inusd'=>$allinusd]);
        }

        $closelists=DailyCloseList::where('viewby',$viewby)->orderBy('id')->get();
        $total=DailyCloseList::where('viewby',$viewby)->select(DB::raw('sum(usd) as tusd,sum(thb) as tthb,sum(khr) as tkhr,sum(inusd) as tinusd'))->first();
        $totalkhrinusd=$this->exchangetousd('KHR',$total->tkhr);
        $totalthbinusd=$this->exchangetousd('THB',$total->tthb);
        $totalallinusd=$total->tusd+$totalkhrinusd+$totalthbinusd;
        $todayrate=Currency::whereIn('shortcut',['KHR','THB'])->get();

        return view('banktransfers.banklist',compact('closelists','total','totalallinusd','todayrate','listdate'));
        
    }
    public function exchangetousd($cur,$amt)
    {
        $inusd=0;
        $r=Currency::where('shortcut',$cur)->first();
        $ratebuy=$r->ratebuy;
        $ratesale=$r->ratesale;
        $opsign=$r->optsign;
        if($opsign='/'){
            if($amt>0){
                $inusd=$amt / $ratebuy;
            }else{
                $inusd=$amt / $ratesale;
            }
            
        }else{
            if($amt>0){
                $inusd=$amt * $ratebuy;
            }else{
                $inusd=$amt * $ratesale;
            }
            
        }
        return $inusd;
    }
    public function search(Request $request)
    {
         //customer close list
         $closedate='1901-01-01';
         $balusd=0;
         $balkhr=0;
         $balthb=0;
         $bankcloselist=CustomerList::where('customer_id',$request->bankid)->orderBy('closedate','DESC')->first();
          if($bankcloselist){
              $closedate=$bankcloselist->closedate;
              $balusd=$bankcloselist->balusd;
              $balkhr=$bankcloselist->balkhr;
              $balthb=$bankcloselist->balthb;
          }
         $closedate=date('Y-m-d', strtotime($closedate));

        $d1 = str_replace('/', '-', $request->d1);
        $d1= date('Y-m-d', strtotime($d1));
        $d2 = str_replace('/', '-', $request->d2);
        $d2= date('Y-m-d', strtotime($d2));
        
        $olddebt=BankTransaction::whereDate('trandate','<',$d1)->whereDate('trandate','>',$closedate)
                                ->where('status',1)->where('customer_id',$request->bankid)->where('cur',$request->cur)
                                ->select(DB::raw('sum(amount) as tamount'))->get();
        $newdebt=BankTransaction::whereBetween(DB::raw('DATE(trandate)'), array($d1, $d2))->whereDate('trandate','>',$closedate)
                                ->where('status',1)->where('customer_id',$request->bankid)->where('cur',$request->cur)->orderBy('id')->get();
        //return view('banktransfers.list',compact('olddata','newdata'));
        $newdebt=$newdebt->load('customer','user');
        return response()->json(['olddebt'=>$olddebt,'newdebt'=>$newdebt,'closelist'=>$bankcloselist]);
        
    }
    public function savetransfer(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'sel_from' => 'required', 
            'sel_to' => 'required', 
            'amount1' => 'required', 
            'sel_cur1'=>'required'
        ]);
        if($request->sel_cur2){
            $validator1 = Validator::make($request->all(), [
                'amount2' => 'required', 
                'sel_cur2'=>'required',
                'rate'=>'required|not_in:0'
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        if($request->sel_cur2){
            if ($validator1->fails()) {
                return response()->json(['error'=>$validator1->errors()->all()]);  
            }
        }
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $trtime = date("H:i:s",strtotime($current));
        $trdate = str_replace('/', '-', $request->trdate);
        $trdate= date('Y-m-d', strtotime($trdate));
        $amt2=$request->amount1;
        $cur2=$request->cur1;
        $curid=$request->sel_cur1;
        if($request->sel_cur2){
            $amt2=$request->amount2;
            $cur2=$request->cur2;
            $curid=$request->sel_cur2;
        }
        $bt=new BankTransaction();
        $bt->trandate=$trdate;
        $bt->trantime=$trtime;
        $bt->user_id=Auth::user()->id;
        $bt->customer_id=$request->sel_from;
        $bt->amount=-1 * str_replace(',','',$request->amount1);
        $bt->currency_id=$request->sel_cur1;
        $bt->tranname='Transfer';
        $bt->note='Transfer to ' . $request->receiver . ' Amount: ' . $amt2 . ' ' . $cur2 ;
        if($bt->save()){
            $id=$bt->id;
           
            $bt1=new BankTransaction();
            $bt1->trandate=$trdate;
            $bt1->trantime=$trtime;
            $bt1->user_id=Auth::user()->id;
            $bt1->customer_id=$request->sel_to;
            $bt1->amount=str_replace(',','',$amt2);
            $bt1->currency_id=$curid;
            $bt1->tranname='Receive';
            $bt1->note='Receive from ' . $request->sender . ' Amount: ' . $amt2 . ' ' . $cur2 ;
            $bt1->ref_number=$id;
            $bt1->save();

        }
      
    }
    public function delete(Request $request)
    {
       $d= DB::table('bank_transactions')->where('id',$request->id)->update(['status'=>0]);
        if($d){
            DB::table('bank_transactions')->where('ref_number',$request->id)->update(['status'=>0]);
            return response()->json(['success'=>true,'message'=>'delete completed']);
        }
    }
}
