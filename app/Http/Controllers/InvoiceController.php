<?php

namespace App\Http\Controllers;

use App\User;
use App\Invoice;
use App\Payment;
use App\Currency;
use App\Customer;
use App\Exchange;
use Carbon\Carbon;
use App\TempInvoice;
use App\InvoiceDetail;
use App\PaymentDetail;
use App\InvoicePayment;
use App\BankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $tempinvs=Tempinvoice::where('user_id',Auth::user()->id)->orderBy('id')->get();
        $totalweight=DB::table('temp_invoices')->select(DB::raw('sum(weight) as tweight'))
        ->where('user_id',Auth::user()->id)->get();
        $totalinv=DB::table('temp_invoices')->select('cur',DB::raw('sum(amount) as tsale'))->groupBy('cur')
        ->where('user_id',Auth::user()->id)->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('customertype','BANK')->orderBy('no')->get();
        $currencies=Currency::where('active',1)->where('ismain',0)->orderBy('no')->get();
        $maincur=Currency::where('active',1)->where('ismain',1)->first();
        
        return view('invoices.index',compact('customers','tempinvs','totalweight','totalinv','banks','currencies','maincur'));
    }

   public function invoicelist()
   {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invlist=Invoice::whereDate('invdate',$current)->where('status',1)->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->get();
        $users=user::where('active',1)->get();
        return view('invoices.invoicelist',compact('invlist','customers','users'));
   }
    public function gettemplist()
    {
        
        $tempinvs=Tempinvoice::where('user_id',Auth::user()->id)->orderBy('id')->get();
        $totalweight=DB::table('temp_invoices')->select(DB::raw('sum(weight) as tweight'))
        ->where('user_id',Auth::user()->id)->get();
        $totalinv=DB::table('temp_invoices')->select('cur',DB::raw('sum(amount) as tsale'))->groupBy('cur')
        ->where('user_id',Auth::user()->id)->get();     
        return view('invoices.gettemplist',compact('tempinvs','totalweight','totalinv'));
    }
    public function exchangelist(Request $request)
    {
       $current = Carbon::now();
       $current->timezone('Asia/Phnom_Penh');
       $dd = date("y-m-d",strtotime($current));
       $userid=Auth::user()->id;
       $exchangelists=Exchange::whereDate('dd',$dd)->where('user_id',$userid)->where('status',1)->where('othercode','<>','')->orderBy('id')->get();
       $users=User::where('active','1')->get();
       return view('invoices.exchangelist',compact('exchangelists','users'));
    }
    public function getinvoiceexchangelist(Request $request)
    {
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $exchangelists=Exchange::whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('othercode','<>','');
        if($request->userid==''){
            $exchangelists=$exchangelists->orderBy('id')->get();
        }else{

            $exchangelists=$exchangelists->where('user_id',$request->userid)->orderBy('id')->get();
        }
        return view('invoices.bodyexchangelist',compact('exchangelists'));
    }
    public function store(Request $request)
    {

        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->invdate);
        $invdate= date('Y-m-d', strtotime($date));
        $actionfrom=$request->actionfrom;
        if($actionfrom=='btnsave' || $actionfrom=='btnsaveprint'){
            if($request->weights){
                $validator = Validator::make($request->all(), [
                    'selcustomer' => 'required',
                    'weights.*' => 'required',
                    'waters.*' => 'required', //input array validate
                    'prices.*' => 'required', //input array validate
                    'totals.*' => 'required', //input array validate
                    
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'selcustomer' => 'required',
                    'weight' => 'required',
                    'water' => 'required', //input array validate
                    'price' => 'required', //input array validate
                    'total' => 'required', //input array validate
                    
                ]);
            }
        }elseif($actionfrom=='btnsavepayment' || $actionfrom=='btnsavepaymentprint'){
            if($request->tdpaymethod){
                $validator = Validator::make($request->all(), [
                    'tdpaymethod.*' => 'required', //input array validate
                    'tdpayamt.*' => 'required|not_in:0', //input array validate gt=greater than 
                ]);
            }else{
                
                $validator = Validator::make($request->all(), [
                    'paymethod' => 'required',
                    //'payamount' => 'required|numeric|gt:0', //input array validate
                    'payamount' => 'required|not_in:0',
                   
                 ]);
                 if($request->paymethod=='bank'){
                    $validator  = Validator::make($request->all(), [
                        'paymethod' => 'required',
                        'selbank' => 'required',
                        'payamount' => 'required|not_in:0',
                       
                     ]);
                    
                 } 
            }
        }
       
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $mekun=1;
            if($request->sign=='-'){
                $mekun=-1;
            }
           if($request->weights){
                $invoice=new Invoice();
                $invoice->invdate=$invdate;
                $invoice->invtime=$invtime;
                $invoice->user_id=Auth::id();
                $invoice->customer_id=$request->selcustomer;
                $invoice->totalweight=str_replace(',','',$request->totalweight);
                $invoice->total=str_replace(',','',$request->totalall);
                $invoice->cur=$request->totalcur;
                $invoice->deposit=str_replace(',','',$request->deposit);
                if($invoice->save()){
                    $id=$invoice->id;
                    foreach ($request->weights as $key => $value) {
                        $invoicedetail=array(
                        'invoice_id'=>$id,
                        'weight'=> str_replace(',','',$value),
                        'water'=>$request->waters[$key],
                        'price'=>str_replace(',','',$request->prices[$key]),
                        'amount'=>str_replace(',','',$request->totals[$key]),
                        'cur'=>$request->totalcur,
                        'created_at'=>$current,
                        'updated_at'=>$current
                        );
                      InvoiceDetail::insert($invoicedetail);
                    }
                    $this->savedeposit($request,$id,$invdate,$invtime);
                    return response()->json(['success'=>'Save Invoice Completed.','invid'=>$id]);
                }
            }else{
                $invoice=new Invoice();
                $invoice->invdate=$invdate;
                $invoice->invtime=$invtime;
                $invoice->user_id=Auth::id();
                $invoice->customer_id=$request->selcustomer;
                $invoice->totalweight= $mekun * str_replace(',','',$request->weight);
                $invoice->total=-1 * $mekun * str_replace(',','',$request->total);
                $invoice->cur=$request->txtcur1;
                $invoice->deposit=str_replace(',','',$request->deposit);
                if($invoice->save()){
                    $id=$invoice->id;
                    $invoicedetail=new InvoiceDetail();
                    $invoicedetail->invoice_id=$id;
                    $invoicedetail->weight=$mekun * str_replace(',','',$request->weight);
                    $invoicedetail->water=$request->water;
                    $invoicedetail->price=$request->price;
                    $invoicedetail->amount=-1 * $mekun * str_replace(',','',$request->total) ;
                    $invoicedetail->cur=$request->txtcur1;
                   
                    if($invoicedetail->save()){
                        $this->savedeposit($request,$id,$invdate,$invtime);
                        return response()->json(['success'=>'Save Invoice Completed.','invid'=>$id]);
                    }
                }
            }
        }
    }
    public function invoiceprint(Request $request)
    {
        $invoice=Invoice::where('id',$request->id)->first();
        $invoicedetails=InvoiceDetail::where('invoice_id',$request->id)->orderBy('id')->get();
        return view('invoices.invprint',compact('invoice','invoicedetails'));
    }
    public function savedeposit(Request $request,$invid,$invdate,$invtime){
        if($request->deposit<>0){
            $isexchangelist=0;
            $payment=new Payment();
           
            $payment->paiddate=$invdate;
            $payment->paidtime=$invtime;
            $payment->customer_id=$request->selcustomer;
            $payment->user_id=Auth::id();
            $payment->amount=str_replace(',','',$request->deposit);
            $payment->cur='USD';
            $payment->note='';
            if($payment->save()){
               $paymentid=$payment->id;
               if($request->tdpaymethod){
                   foreach ($request->tdpaymethod as $key => $value) {
                       
                       $paymentdetail=array(
                       'payment_id'=>$paymentid,
                       'paymethod'=>$value,
                       'paynote'=>$request->tdbankname[$key],
                       'amount'=>str_replace(',','',$request->tdpayamt[$key]),
                       'cur'=>$request->tdcur[$key],
                       'bankamount'=>str_replace(',','',$request->tdexchangeamount[$key]),
                       'bankcur'=>$request->tdcutluy[$key]
                       );
                       PaymentDetail::insert($paymentdetail);
                       if($request->tdpaymethod[$key]=='bank'){
                            $isexchangelist=1;
                            $this->savebanktransaction2($request,$invdate,$invtime,$paymentid,$key);
                        }else{
                            $isexchangelist=0;
                        }
                       //if($request->tdpaymethod=='cash'){
                            if($request->tdexchangeamount[$key]<>'0'){
                                $this->saveexchange1($request,$invdate,$invtime,$paymentid,$key,$isexchangelist);
                            }
                       //}
                   }
               }else{

                   $pmd=new PaymentDetail();
                   $pmd->payment_id=$paymentid;
                   $pmd->paymethod=$request->paymethod;
                   $pmd->paynote=$request->bankname;
                   $pmd->amount=str_replace(',','',$request->payamount);
                   $pmd->cur='USD';
                   if($request->selexchangecur<>''){
                       $pmd->bankamount=str_replace(',','',$request->exchangeamount);
                       $pmd->bankcur=$request->exchangecur;
                   }
                   $pmd->save();
                   if($request->paymethod=='bank'){
                        $isexchangelist=1;
                        $this->savebanktransaction1($request,$invdate,$invtime,$paymentid);
                    }else{
                        $isexchangelist=0;
                    }
                   if($request->selexchangecur<>''){
                    $this->saveexchange($request,$invdate,$invtime,$paymentid,$isexchangelist);
                    }
                }
                $invoicepayment=new InvoicePayment();
                $invoicepayment->paiddate=$invdate;
                $invoicepayment->invoice_id=$invid;
                $invoicepayment->payment_id=$paymentid;
                $invoicepayment->amount=str_replace(',','',$request->deposit);
                $invoicepayment->cur='USD';
                $invoicepayment->save();
                
            }
        }
    }
    public function savebanktransaction1(Request $request,$invdate,$invtime,$payid){
        $bt=new BankTransaction();
        $bt->trandate=$invdate;
        $bt->trantime=$invtime;
        $bt->user_id=Auth::user()->id;
        $bt->customer_id=$request->selbank;
        $bt->payment_id=$payid;
        
        $bt->note='';
        if($request->exchangeamount==0){
            $bt->amount=str_replace(',','',$request->payamount);
            $bt->currency_id=$request->currency_id;
            $amt=str_replace(',','',$request->payamount);
        }else{
            $bt->amount=str_replace(',','',$request->exchangeamount);
            $bt->currency_id=$request->selexchangecur;
            $amt=str_replace(',','',$request->exchangeamount);
        }
        if($amt>0){
            $bt->tranname='Transfer From ' . $request->customername;
        }else{
            $bt->tranname='Transfer To ' . $request->customername;
        }
        $bt->save();
        
    }
    public function savebanktransaction2(Request $request,$invdate,$invtime,$payid,$k){
        $bt=new BankTransaction();
        $bt->trandate=$invdate;
        $bt->trantime=$invtime;
        $bt->user_id=Auth::user()->id;
        $bt->customer_id=$request->tdbankid[$k];
        $bt->payment_id=$payid;
        $bt->tranname='';
        $bt->note='';
        if($request->tdexchangeamount[$k]==0){
            $bt->amount=str_replace(',','',$request->tdpayamt[$k]);
            $bt->currency_id=$request->currency_id;
            $amt=str_replace(',','',$request->tdpayamt[$k]);
        }else{
            $bt->amount=str_replace(',','',$request->tdexchangeamount[$k]);
            $bt->currency_id=$request->tdcurid[$k];
            $amt=str_replace(',','',$request->tdexchangeamount[$k]);
        }
        if($amt>0){
            $bt->tranname='Transfer From ' . $request->customername;
        }else{
            $bt->tranname='Transfer To ' . $request->customername;
        }
        $bt->save();
        
    }
    public function payment1(Request $request){
        //return $request->all();
        $isexchangelist=0;
        if($request->tdpaymethod){
            $validator = Validator::make($request->all(), [
                'tdpaymethod.*' => 'required', //input array validate
                'tdpayamt.*' => 'required|not_in:0', //input array validate gt=greater than 
            ]);
        }else{
            
            $validator = Validator::make($request->all(), [
                'paymethod' => 'required',
                //'payamount' => 'required|numeric|gt:0', //input array validate
                'payamount' => 'required|not_in:0',
               
             ]);
             if($request->paymethod=='bank'){
                $validator  = Validator::make($request->all(), [
                    'paymethod' => 'required',
                    'selbank' => 'required',
                    'payamount' => 'required|not_in:0',
                   
                 ]);
                
             }
        }

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);  
        }
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $paidtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->paiddate);
        $paiddate= date('Y-m-d', strtotime($date));
        if($request->deposit<>0){
            $payment=new Payment();
            $payment->paiddate=$paiddate;
            $payment->paidtime=$paidtime;
            $payment->customer_id=$request->customerID;
            $payment->user_id=Auth::id();
            $payment->amount=str_replace(',','',$request->deposit);
            $payment->cur=$request->invcur1;
            $payment->note='';
            if($payment->save()){
               $paymentid=$payment->id;
               if($request->tdpaymethod){
                   foreach ($request->tdpaymethod as $key => $value) {
                       
                       $paymentdetail=array(
                       'payment_id'=>$paymentid,
                       'paymethod'=>$value,
                       'paynote'=>$request->tdbankname[$key],
                       'amount'=>str_replace(',','',$request->tdpayamt[$key]),
                       'cur'=>$request->tdcur[$key],
                       'bankamount'=>str_replace(',','',$request->tdexchangeamount[$key]),
                       'bankcur'=>$request->tdcutluy[$key]
                       );
                       PaymentDetail::insert($paymentdetail);
                       if($request->tdpaymethod[$key]=='bank'){
                            $isexchangelist=1;
                            $this->savebanktransaction2($request,$paiddate,$paidtime,$paymentid,$key);
                        }else{
                            $isexchangelist=0;
                        }
                       //if($request->tdpaymethod=='cash'){
                            if($request->tdexchangeamount[$key]<>'0'){
                                $this->saveexchange1($request,$paiddate,$paidtime,$paymentid,$key,$isexchangelist);
                            }
                       //}
                   }
               }else{

                   $pmd=new PaymentDetail();
                   $pmd->payment_id=$paymentid;
                   $pmd->paymethod=$request->paymethod;
                   $pmd->paynote=$request->bankname;
                   $pmd->amount=str_replace(',','',$request->payamount);
                   $pmd->cur=$request->invcur1;
                   if($request->selexchangecur<>''){
                       $pmd->bankamount=str_replace(',','',$request->exchangeamount);
                       $pmd->bankcur=$request->exchangecur;
                   }
                   $pmd->save();
                   if($request->paymethod=='bank'){
                        $isexchagelist=1;
                        $this->savebanktransaction1($request,$paiddate,$paidtime,$paymentid);
                    }else{
                        $isexchagelist=0;
                    }
                   if($request->selexchangecur<>''){
                    $this->saveexchange($request,$paiddate,$paidtime,$paymentid,$isexchagelist);
                    }
                }
                $invoicepayment=new InvoicePayment();
                $invoicepayment->paiddate=$paiddate;
                $invoicepayment->invoice_id=$request->invoice_id;
                $invoicepayment->payment_id=$paymentid;
                $invoicepayment->amount=str_replace(',','',$request->deposit);
                $invoicepayment->cur=$request->invcur1;
                $invoicepayment->save();
                $this->updateinvoicedeposit($request->invoice_id);
            }
        }
    }
    public function updateinvoicedeposit($invid){
        $totaldeposit=DB::table('invoice_payments')->where('invoice_id',$invid)
                                                    ->where('status',1)
                                                    ->select(DB::raw('sum(amount) as tamt'))->first();
        if($totaldeposit->tamt){
            DB::table('invoices')->where('id',$invid)->update(['deposit'=>$totaldeposit->tamt]);
        }else{
            DB::table('invoices')->where('id',$invid)->update(['deposit'=>0]);
        }
    }
    public function deletepayment(Request $request)
    {
        //return $request->all();
        $pm=DB::table('payments')->where('id',$request->id)->update(['status'=>0]);
        if($pm==1){
            DB::table('exchanges')->where('othercode','payment-'. $request->id)->update(['status'=>0]);
            DB::table('payment_details')->where('payment_id',$request->id)->update(['status'=>0]);
            DB::table('invoice_payments')->where('payment_id',$request->id)->update(['status'=>0]);
            DB::table('invoices')->where('paymentid',$request->id)->update(['status'=>0]);
            DB::table('bank_transactions')->where('payment_id',$request->id)->update(['status'=>0]);
            
            $invpay=DB::table('invoice_payments')->where('payment_id',$request->id)->get();
            foreach($invpay as $invp){
                $this->updateinvoicedeposit($invp->invoice_id);
            }
            return response()->json(['success'=>true,'message'=>'payment has been deleted']);
        }
    }
    public function delete(Request $request){
        $d= DB::table('invoices')->where('id',$request->id)->update(['status'=>0]);
        if($d==1){
            return response()->json(['success'=>true,'message'=>'invoice has been deleted']);
        }else{
            return response()->json(['error'=>true,'message'=>'delete error']);
        }
    }
    public function saveexchange(Request $request,$invdate,$invtime,$payid,$isexchangelist){
        $sign=-1;
        if($request->payamount>0){
            $sign=1;
        }
        $e=new Exchange();
        $e->dd=$invdate;
        $e->tt=$invtime;
        $e->currency_id=$request->selexchangecur;
        $e->product=$sign * abs(str_replace(',','',$request->exchangeamount));
        $e->pcur=$request->exchangecur;
        $e->amount=-1 * $sign * abs(str_replace(',','',$request->payamount));
        $e->maincur='USD';
        $e->rate=str_replace(',','',$request->rate);
        $e->drate=str_replace(',','',$request->rateset);
        $e->cashreceive=0;
        $e->cashreturn=0;
        $e->isexchangelist=$isexchangelist;
        $e->multiexchangecode='';
        $e->othercode='payment-' . $payid;
        $e->note='';
        $e->user_id=Auth::user()->id;
        $e->save();
        $id=$e->id;
        DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
    }
    public function saveexchange1(Request $request,$invdate,$invtime,$payid,$k,$isexchangelist){
        $sign=-1;
        if($request->tdpayamt[$k]>0){
            $sign=1;
        }
        $e=new Exchange();
        $e->dd=$invdate;
        $e->tt=$invtime;
        $e->currency_id=$request->tdcurid[$k];
        $e->product=$sign * abs(str_replace(',','',$request->tdexchangeamount[$k]));
        $e->pcur=$request->tdcutluy[$k];
        $e->amount=-1 * $sign * abs(str_replace(',','',$request->tdpayamt[$k]));
        $e->maincur='USD';
        $e->rate=str_replace(',','',$request->tdrate[$k]);
        $e->drate=str_replace(',','',$request->tdrateset[$k]);
        $e->cashreceive=0;
        $e->cashreturn=0;
        $e->isexchangelist=$isexchangelist;
        $e->multiexchangecode='';
        $e->othercode='payment-'.$payid;
        $e->note='';
        $e->user_id=Auth::user()->id;
        $e->save();
        $id=$e->id;
        DB::table('exchanges')->where('id',$id)->update(['multiexchangecode'=>$id]);
    }
    public function savetemplist(Request $request)
    {

        //return $request->all();
        $i=new TempInvoice();
        $i->weight=str_replace(',','',$request->weight);
        $i->water=$request->water;
        $i->price=$request->price;
        $i->cur=$request->cur;
        $i->amount=str_replace(',','',$request->amount);
        $i->user_id=Auth::id();
        $i->save();

    }
    public function deltemplist(Request $request)
   {
      $delml= DB::table('temp_invoices')->where('id',$request->id)->delete();
      if($delml){
         return response()->json(['success'=>'delete success']);
      }else{
         return response()->json(['error'=>'delete error']);
      }
      
   }
   public function cleartemplist(Request $request)
   {
      $delml= DB::table('temp_invoices')->where('user_id',Auth::id())->delete();
      if($delml){
         return response()->json(['success'=>'clear success']);
      }else{
         return response()->json(['error'=>'clear error']);
      }
      
   }
   public function searchinvoice(Request $request)
   {
        //return($request->all());
        $fdate=date('Y-m-d',strtotime($request->fdate));
        $tdate=date('Y-m-d',strtotime($request->tdate));
        $invoices=Invoice::whereBetween(DB::raw('DATE(invdate)'), array($fdate, $tdate))->where('status',1);
        if($request->selcustomer<>''){
            $invoices=$invoices->where('customer_id',$request->selcustomer);
        }
        if($request->seluser<>'0'){
            $invoices=$invoices->where('user_id',$request->seluser);
        }
        
        $invoices=$invoices->get();
        return view('invoices.invoicelistsearch',compact('invoices'));
   }
   public function invoicedetail(Request $request)
   {
        $inv=Invoice::where('id',$request->invid)->first();
        $invdetail=InvoiceDetail::where('invoice_id',$request->invid)->get();
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->get();
        return view('invoices.invoicedetail',compact('inv','invdetail','banks','currencies'));
   }
   public function showpaymentmodal(Request $request){
        //return $request->all();
        // $inv=Invoice::join('customers','invoices.customer_id','=','customers.id')
        //             ->where('invoices.id',$request->id)->first();
        $inv=Invoice::find($request->id);
        $inv=$inv->load('customer');
        $sumpayment=DB::table('invoice_payments')->select(DB::raw('sum(amount) as totalpaid'))
        ->where('invoice_id',$request->id)->where('status',1)->first();
        return response()->json(['inv'=>$inv,'sumpaid'=>$sumpayment]);
   }
   public function getinvpaymentbypaymentcode(Request $request)
   {
        $paymentinvoice=InvoicePayment::where('payment_id',$request->paymentid)->where('status',1)->get();
        return response()->json(['payinv'=>$paymentinvoice]);
   }
   
}
