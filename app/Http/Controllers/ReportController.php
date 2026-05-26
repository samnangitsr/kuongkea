<?php

namespace App\Http\Controllers;

use App\User;
use App\Currency;
use App\Customer;
use App\Models\Expanse;
use App\PartnerTransfer;
use App\PartnerCloseList;
use App\PartnerExchangeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function transferprofit()
    {
        $selcomid=Session('log_into_company_id');
        $partners=Customer::where('status',1)->whereIn('customertype',['PARTNER','BANK','AGENT','CUSTOMER'])->where('company_id',$selcomid)->orderBy('no')->get();

        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        $currencies=Currency::where('active',1)->where('ispandp',0)->where('partner_cur',1)->where('company_id',$selcomid)->get();
        return view('reports.transferprofit',compact('partners','users','currencies'));
    }
    public function gettransferprofit(Request $request)
    {
        //$c=collect();
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $transfers=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid)
        ->where(function($q){
            $q->whereNull('thai_amt')->orWhere(function($q){
                $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
            });
        });
        $totalprofit=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid)
        ->where(function($q){
            $q->whereNull('thai_amt')->orWhere(function($q){
                $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
            });
          });
        if($request->partner){
            $transfers=$transfers->where('parrent_id',$request->partner);
            $totalprofit=$totalprofit->where('parrent_id',$request->partner);

        }
        if($request->user){
            $transfers=$transfers->where('user_id',$request->user);
            $totalprofit=$totalprofit->where('user_id',$request->user);
        }
        if($request->cur){
            $transfers=$transfers->where('currency_id',$request->cur);
            $totalprofit=$totalprofit->where('currency_id',$request->cur);
        }

        $transfers=$transfers->orderBy('id')->get();
        $totalprofit=$totalprofit->select(DB::raw('currency_id,sum(cuscharge_ex-fee_ex+thaiseva_exchange) as tprofit'))
        ->groupBy('currency_id')->get();

        //return $transfers;
        if(isset($request->isprint)){
            $title=['d1d2'=>$request->d1 . ' To ' . $request->d2];
            $title +=['customer'=>$request->partnername,'user'=>$request->username];
            return view('reports.transfer_profit_print',compact('transfers','totalprofit','title'));
        }else{
            return view('reports.profitreport',compact('transfers','totalprofit'));
        }



    }

    public function gettransferprofitwithlist(Request $request)
    {
        //return $request->all();
        //$viewby=Auth::user()->name;
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
        $d2= date('Y-m-d', strtotime($request->d2));
        $totalprofit=PartnerTransfer::where('status',1)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('company_id',$selcomid)
        ->where(function($q){
            $q->whereNull('thai_amt')->orWhere(function($q){
                $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
            });
          });
        if($request->partner){
            $totalprofit=$totalprofit->where('parrent_id',$request->partner);
        }
        if($request->user){
            $totalprofit=$totalprofit->where('user_id',$request->user);
        }
        if($request->cur){
            $totalprofit=$totalprofit->where('currency_id',$request->cur);
        }

        $totalprofit=$totalprofit->select(DB::raw('currency_id,sum(cuscharge_ex-fee_ex+thaiseva_exchange) as tprofit'))
        ->groupBy('currency_id')->get();

        $partnerlist=null;
        $listdate=null;
        $oldlistdate=date_create($d1);
        date_add($oldlistdate,date_interval_create_from_date_string("-1 days"));
        $listdate= date_format($oldlistdate,"d-m-Y");

        $khr=0;
        $usd=0;
        $thb=0;
        $vnd=0;
        $close_transfer_id=0;
        $close_exchange_id=0;

        $c=Customer::where('id',$request->partner)->first();
        $customername=$c->name;
            $close_transfer_id=0;
            $close_exchange_id=0;
            $usd=0;
            $thb=0;
            $khr=0;
            $vnd=0;

            $closelist=PartnerCloseList::whereDate('closedate','<=',$d1)->where('partner_id',$c->id)->orderBy('closedate','DESC')->orderBy('id','DESC')->first();
            if($closelist){
                $close_transfer_id=$closelist->transaction_id;
                $close_exchange_id=$closelist->exchange_id;
                $usd=$closelist->usd;
                $thb=$closelist->thb;
                $khr=$closelist->khr;
                $vnd=$closelist->vnd;
            }

            $transfers=PartnerTransfer::select(DB::raw('sum(amount+interest) as total,currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('currency_id')->get();
            $fees=PartnerTransfer::select(DB::raw('sum(fee) as totalfee,fee_currency_id'))
            ->where('status',1)->where('parrent_id',$c->id)->where('id','>',$close_transfer_id)->whereDate('dd','<',$d1)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
              })
            ->groupBy('fee_currency_id')->get();

            $exbuys=PartnerExchangeList::select(DB::raw('sum(buy) as totalbuy,curbuy'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('curbuy')->get();
            $exsales=PartnerExchangeList::select(DB::raw('sum(sale) as totalsale,cursale'))
                ->where('status',1)->where('partner_id',$c->id)->where('id','>',$close_exchange_id)->whereDate('ex_date','<',$d1)->groupBy('cursale')->get();
            //return $closelist;

          foreach($transfers as $t){

                if($t->currency->shortcut=='USD'){
                    $usd +=$t->total;
                }elseif($t->currency->shortcut=='THB'){
                    $thb +=$t->total;
                }elseif($t->currency->shortcut=='KHR'){
                    $khr +=$t->total;
                }elseif($t->currency->shortcut=='VND'){
                    $vnd +=$t->total;
                }
            }
          foreach($fees as $t){

            if($t->feecurrency->shortcut=='USD'){
                $usd +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='THB'){
                $thb +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='KHR'){
                $khr +=$t->totalfee;
            }elseif($t->feecurrency->shortcut=='VND'){
                $vnd +=$t->totalfee;
            }
        }


            foreach($exbuys as $t){
                $found=1;
                if($t->curbuy=='USD'){
                    $usd +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='THB'){
                    $thb +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='KHR'){
                    $khr +=-1 * $t->totalbuy;
                }elseif($t->curbuy=='VND'){
                    $vnd +=-1 * $t->totalbuy;
                }
            }

            foreach($exsales as $t){

                if($t->cursale=='USD'){
                    $usd +=$t->totalsale;
                }elseif($t->cursale=='THB'){
                    $thb +=$t->totalsale;
                }elseif($t->cursale=='KHR'){
                    $khr +=$t->totalsale;
                }elseif($t->cursale=='VND'){
                    $vnd +=$t->totalsale;
                }
            }
            //$balance_str=$usd . ',' . $khr . ',' . $thb . ',' . $vnd;
            $balance=0;
            if($request->curname=='USD'){
                $balance= $usd;
            }else if($request->curname=='KHR'){
                $balance= $khr;
            }else if($request->curname=='THB'){
                $balance= $thb;
            }else if($request->curname=='VND'){
                $balance= $vnd;
            }else{
                $balance= 0;
            }
            $transfers=PartnerTransfer::where('parrent_id',$request->partner)->whereBetween(DB::raw('DATE(dd)'), array($d1, $d2))->where('status',1)->where('id','>',$close_transfer_id)->where('currency_id',$request->cur)
            ->where(function($q){
                $q->whereNull('thai_amt')->orWhere(function($q){
                    $q->whereNotNull('thai_amt')->whereNotNull('docodeby');
                });
            });
            if($request->seluser){
                $transfers=$transfers->where('user_id',$request->seluser);
            }
            $transfers=$transfers->orderBy('dd')->orderBy('id')->get();
          $ex_buys=PartnerExchangeList::where('partner_id',$request->partner)->whereBetween(DB::raw('DATE(ex_date)'), array($d1, $d2))->where('status',1)->where('id','>',$close_exchange_id)
          ->where('curbuy',$request->curname)->orderBy('id')->get();
          $ex_sales=PartnerExchangeList::where('partner_id',$request->partner)->whereBetween(DB::raw('DATE(ex_date)'), array($d1, $d2))->where('status',1)->where('id','>',$close_exchange_id)
          ->where('cursale',$request->curname)->orderBy('id')->get();

          $c=collect();
          foreach($transfers as $t)
          {
              $c=$c->push([
                'dd'=>$t->dd,
                'tt'=> $t->tt,
                'timeint'=>$this->converttimetoint($t->tt),
                'tranname'=>$t->tranname,
                'partnername'=>$t->partner->name,
                'amount'=>$t->amount,
                'cur'=>$t->currency->shortcut,
                'cur1'=>$t->currency->sk,
                'cuscharge'=>$t->cuscharge,
                'cuscharge_cur'=>$t->cuschargecur->shortcut,
                'cuscharge_ex'=>$t->cuscharge_ex,
                'fee'=>$t->fee,
                'fee_cur'=>$t->feecurrency->shortcut,
                'fee_ex'=>$t->fee_ex,
                'thai_amt'=>$t->thai_amt,
                'th_rate'=>$t->th_rate,
                'thai_seva'=>$t->thai_seva,
                'thaiseva_ex'=>$t->thaiseva_exchange,
                'recname'=>$t->recname,
                'rectel'=>$t->rectel,
                'note'=>$t->note,
                'moneycode'=>$t->moneycode,
                'tid'=>$t->id,
                'saveby'=>$t->user->name,
            ]);
          }
          foreach($ex_buys as $t)
          {

            $c=$c->push([
                'dd'=>$t->ex_date,
                'tt'=> $t->ex_time,
                'timeint'=>$this->converttimetoint($t->ex_time),
                'tranname'=>'កាត់កង',
                'partnername'=>$t->partner->name,
                'amount'=>-1 * $t->buy,
                'cur'=>$t->curbuy,
                'cur1'=>$request->cursk,
                'cuscharge'=>0,
                'cuscharge_cur'=>'',
                'cuscharge_ex'=>0,
                'fee'=>0,
                'fee_cur'=>'',
                'fee_ex'=>0,
                'thai_amt'=>0,
                'th_rate'=>0,
                'thai_seva'=>0,
                'thaiseva_ex'=>0,
                'recname'=>$this->phpformatnumber($t->sale) . ' ' . $t->cursale,
                'rectel'=>'',
                'note'=>$t->note,
                'moneycode'=>'',
                'tid'=>$t->id,
                'saveby'=>$t->user->name,
            ]);

          }
          foreach($ex_sales as $t)
          {
            $c=$c->push([
                'dd'=>$t->ex_date,
                'tt'=> $t->ex_time,
                'timeint'=>$this->converttimetoint($t->ex_time),
                'tranname'=>'កាត់កង',
                'partnername'=>$t->partner->name,
                'amount'=>$t->sale,
                'cur'=>$t->cursale,
                'cur1'=>$request->cursk,
                'cuscharge'=>0,
                'cuscharge_cur'=>'',
                'cuscharge_ex'=>0,
                'fee'=>0,
                'fee_cur'=>'',
                'fee_ex'=>0,
                'thai_amt'=>0,
                'th_rate'=>0,
                'thai_seva'=>0,
                'thaiseva_ex'=>0,
                'recname'=>$this->phpformatnumber($t->buy) . ' ' . $t->curbuy,
                'rectel'=>'',
                'note'=>$t->note,
                'moneycode'=>'',
                'tid'=>$t->id,
                'saveby'=>$t->user->name,
            ]);
          }
          $c=$c->sortby('dd')->sortby('timeint');
          $oldlist=$balance . ';' . $request->cursk . ';' . $customername;
          //return response()->json(['olddebt'=>$olddebtstr,'datalist'=>$c]);

            if(isset($request->isprint)){
                $title=['d1d2'=>$request->d1 . ' To ' . $request->d2];
                $title +=['customer'=>$request->partnername,'user'=>$request->username];
                return view('reports.transfer_profit_withlist_print',compact('oldlist','c','totalprofit','title','listdate'));
            }else{
                return view('reports.profitreportlist',compact('oldlist','c','totalprofit','listdate'));
            }
    }
    public function converttimetoint($t){
        $a=explode(':',$t);
        $h=$a[0]*3600;
        $m=$a[1]*60;
        $s=$a[2];
        return $h+$m+$s;
    }
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;
        if($dc>2){
          $dc=2;
        }
      }
        return number_format($num,$dc,'.',',');
    }
}
