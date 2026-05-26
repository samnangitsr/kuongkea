<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Payment;
use App\Currency;
use App\Customer;
use App\Exchange;
use Carbon\Carbon;
use App\InvoiceDetail;
use App\PaymentDetail;
use App\InvoicePayment;
use App\BankTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invlist=Invoice::where('status',1)->whereRaw('total-deposit<>0')->where('user_id',Auth::id())->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->where('ispandp',0)->orderBy('no')->get();
        $maincur=Currency::where('active',1)->where('ismain',1)->first();
        $users=user::where('active',1)->get();
        return view('payments.index',compact('invlist','customers','banks','currencies','users','maincur'));
    }
    public function report()
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $payments=Payment::whereDate('paiddate',$current)->where('status',1)->where('user_id',Auth::id())->orderBy('paiddate','desc')->get();
        $customers=Customer::where('status',1)->where('customertype','CUSTOMER')->orderBy('no')->get();
        $banks=Customer::where('status',1)->where('customertype','BANK')->get();
        $currencies=Currency::where('active',1)->where('ispandp',0)->orderBy('no')->get();
        $users=user::where('active',1)->get();
        return view('payments.report',compact('payments','customers','banks','currencies','users'));
    }
    public function searchinvoice(Request $request)
   {
        //return($request->all());
        $fdate=date('Y-m-d',strtotime($request->fdate));
        $tdate=date('Y-m-d',strtotime($request->tdate));
        if($request->radsel==0){//not yet total
            $invoices=Invoice::where('status',1);
        }else{
            $invoices=Invoice::whereBetween(DB::raw('DATE(invdate)'), array($fdate, $tdate))->where('status',1);
        }
        if($request->selcustomer<>''){
            $invoices=$invoices->where('customer_id',$request->selcustomer);
        }
        if($request->seluser<>'0'){
            $invoices=$invoices->where('user_id',$request->seluser);
        }
        if($request->radsel==0){
            $invoices=$invoices->whereRaw('total-deposit<>0');
        }
        if($request->radsel==1){
            $invoices=$invoices->whereRaw('total-deposit=0');
        }

        $invoices=$invoices->get();
        return view('payments.invoicelistsearch',compact('invoices'));
   }
   public function searchpayment(Request $request)
   {
        //return($request->all());
        $fdate=date('Y-m-d',strtotime($request->fdate));
        $tdate=date('Y-m-d',strtotime($request->tdate));

        $payments=Payment::whereBetween(DB::raw('DATE(paiddate)'), array($fdate, $tdate))->where('status',1);

        if($request->selcustomer<>''){
            $payments=$payments->where('customer_id',$request->selcustomer);
        }
        if($request->seluser<>'0'){
            $payments=$payments->where('user_id',$request->seluser);
        }

        $payments=$payments->get();
        return view('payments.paymentlistsearch',compact('payments'));
   }
   public function store(Request $request)
   {
        //return $request->all();
        if($request->tdpaymethod){
            $validator = Validator::make($request->all(), [
                'tdpaymethod.*' => 'required', //input array validate
                //'tdpayamt.*' => 'required|numeric|gt:0', //input array validate gt=greater than
                'tdpayamt.*' => 'required|not_in:0',
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
        $isexchangelist=0;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $paidtime = date("H:i:s",strtotime($current));
        $date = str_replace('/', '-', $request->paiddate);
        $paiddate= date('Y-m-d', strtotime($date));
        $ispayliinusd=$request->ckpayinmoneyval;
        if($ispayliinusd=='true'){
            $this->storeinv($request,$paiddate,$paidtime,$current);
        }else{
            if($request->deposit<>0){
                $payment=new Payment();
                $payment->paiddate=$paiddate;
                $payment->paidtime=$paidtime;
                $payment->customer_id=$request->customerid;
                $payment->user_id=Auth::id();
                $payment->amount= str_replace(',','',$request->deposit);
                $payment->cur=$request->paycur;
                $payment->note='';
                if($payment->save()){
                    $paymentid=$payment->id;
                    if($request->tdpaymethod){
                        foreach ($request->tdpaymethod as $key => $value) {

                            $paymentdetail=array(
                            'payment_id'=>$paymentid,
                            'paymethod'=>$value,
                            'paynote'=>$request->tdbankname[$key],
                            'amount'=> str_replace(',','',$request->tdpayamt[$key]),
                            'cur'=>$request->tdcur[$key],
                            'bankamount'=> str_replace(',','',$request->tdexchangeamount[$key]),
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
                        $pmd->amount= str_replace(',','',$request->payamount);
                        $pmd->cur=$request->paycur;
                        if($request->selexchangecur<>''){
                            $pmd->bankamount= str_replace(',','',$request->exchangeamount);
                            $pmd->bankcur=$request->exchangecur;
                        }
                        $pmd->save();
                        if($request->paymethod=='bank'){
                            $isexchangelist=1;
                            $this->savebanktransaction1($request,$paiddate,$paidtime,$paymentid);
                        }else{
                            $isexchangelist=0;
                        }
                        if($request->selexchangecur<>''){
                            $this->saveexchange($request,$paiddate,$paidtime,$paymentid,$isexchangelist);
                        }
                    }

                    foreach ($request->paidinv as $key => $value) {

                        $invpaid=array(
                            'paiddate'=>$paiddate,
                            'invoice_id'=>$value,
                            'payment_id'=>$paymentid,
                            'amount'=> str_replace(',','',$request->paiddeposit[$key]),
                            'cur'=>$request->paidcur1[$key],
                            'created_at'=>$current,
                            'updated_at'=>$current
                        );
                        InvoicePayment::insert($invpaid);
                        $this->updateinvoicedeposit($value);

                    }

                    return response()->json(['paymentid'=>$paymentid]);
                }
            }
        }
   }
   public function print(Request $request)
   {
        $payment=Payment::where('id',$request->id)->first();
        $paymentdetails=PaymentDetail::where('payment_id',$request->id)->orderBy('id')->get();
        return view('payments.print',compact('payment','paymentdetails'));
   }
   public function storeinv(Request $request,$paiddate,$paidtime,$current){
        $invoice=new Invoice();
        $invoice->invdate=$paiddate;
        $invoice->invtime=$paidtime;
        $invoice->user_id=Auth::id();
        $invoice->customer_id=$request->customerid;
        $invoice->totalweight= str_replace(',','',$request->weight);
        $invoice->total=str_replace(',','',$request->totalamount);
        $invoice->cur=$request->paycur;
        $invoice->deposit=str_replace(',','',$request->hasdeposit);
        if($invoice->save()){
            $id=$invoice->id;
            $invoicedetail=new InvoiceDetail();
            $invoicedetail->invoice_id=$id;
            $invoicedetail->weight=str_replace(',','',$request->weight);
            $invoicedetail->water=$request->water;
            $invoicedetail->price=$request->price;
            $invoicedetail->amount=str_replace(',','',$request->totalamount) ;
            $invoicedetail->cur=$request->paycur;

            if($invoicedetail->save()){
                $this->savedeposit($request,$id,$paiddate,$paidtime,$current);
                return response()->json(['success'=>'Save Invoice Completed.','invid'=>$id]);
            }
        }
   }
   public function savedeposit(Request $request,$invid,$invdate,$invtime,$current){
    if($request->hasdeposit<>0){
        $payment=new Payment();
        $payment->paiddate=$invdate;
        $payment->paidtime=$invtime;
        $payment->customer_id=$request->customerid;
        $payment->user_id=Auth::id();
        $payment->amount=str_replace(',','',$request->hasdeposit);
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
                        $this->savebanktransaction2($request,$invdate,$invtime,$paymentid,$key);
                    }
                   //if($request->tdpaymethod=='cash'){
                        if($request->tdexchangeamount[$key]<>'0'){
                            $this->saveexchange1($request,$invdate,$invtime,$paymentid,$key,0);
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
                    $this->savebanktransaction1($request,$invdate,$invtime,$paymentid);
                }
               if($request->selexchangecur<>''){
                $this->saveexchange($request,$invdate,$invtime,$paymentid,0);
                }
            }
            $invoicepayment=new InvoicePayment();
            $invoicepayment->paiddate=$invdate;
            $invoicepayment->invoice_id=$invid;
            $invoicepayment->payment_id=$paymentid;
            $invoicepayment->amount=str_replace(',','',$request->hasdeposit);
            $invoicepayment->cur='USD';
            $invoicepayment->save();
            DB::table('invoices')->where('id',$invid)->update(['deposit'=>str_replace(',','',$request->hasdeposit),'paymentid'=>$paymentid]);
            //$this->updateinvoicedeposit($invid);
            foreach ($request->paidinv as $key => $value) {
                $invpaid=array(
                    'paiddate'=>$invdate,
                    'invoice_id'=>$value,
                    'payment_id'=>$paymentid,
                    'amount'=> str_replace(',','',$request->paiddeposit[$key]),
                    'cur'=>$request->paidcur1[$key],
                    'created_at'=>$current,
                    'updated_at'=>$current
                );
                InvoicePayment::insert($invpaid);
                $this->updateinvoicedeposit($value);
            }
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
            $bt->currecny_id=$request->selexchangecur;
            $amt=str_replace(',','',$request->exchangeamount);
        }
        if($amt>0){
            $bt->tranname='Receive';
            $bt->note='Receive From ' . $request->customername;
        }else{
            $bt->tranname='Transfer';
            $bt->note='Transfer To ' . $request->customername;
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
            $bt->tranname='Receive';
            $bt->note='Receive From ' . $request->customername;
        }else{
            $bt->tranname='Transfer';
            $bt->note='Transfer To ' . $request->customername;
        }
        $bt->save();

    }
   public function saveexchange1(Request $request,$invdate,$invtime,$payid,$k,$isexchangelist){
        $e=new Exchange();
        $e->dd=$invdate;
        $e->tt=$invtime;
        $e->currency_id=$request->tdcurid[$k];
        $e->product=abs(str_replace(',','',$request->tdexchangeamount[$k]));
        $e->pcur=$request->tdcutluy[$k];
        $e->amount=-1 * abs(str_replace(',','',$request->tdpayamt[$k]));
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

}
