<?php

namespace App\Http\Controllers;
use App\User;
use App\Stock;
use App\Company;
use App\Invoice;
use App\Currency;
use App\Exchange;
use Carbon\Carbon;
use App\StockReport;
use App\UserCapital;
use App\Models\StockPrint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    public function report()
    {
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        return view('stocks.report',compact('users'));
    }
    public function getreportgoldbuysale(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $d1= date('Y-m-d', strtotime($request->d1));
      $d2= date('Y-m-d', strtotime($request->d2));

      $exchanges=Exchange::whereBetween(DB::raw('DATE(updated_at)'), array($d1, $d2))
      ->where('status',1)
      ->where('isexchangelist',0)
      ->where('company_id',$selcomid);
       if($request->userid){
            $exchanges=$exchanges->where('user_id',$request->userid);
       }
       $exchanges=$exchanges->orderBy('id')->get();
      return view('stocks.getreportgoldbuysale',compact('exchanges'));
    }
    public function reportgoldbuysale()
    {
      $selcomid=Session('log_into_company_id');
      $current = Carbon::now();
      $current->timezone('Asia/Phnom_Penh');
      $dd = date("y-m-d",strtotime($current));

      $exchanges=Exchange::whereBetween(DB::raw('DATE(updated_at)'), array($dd, $dd))
      ->where('status',1)
      ->where('isexchangelist',0)
      ->where('company_id',$selcomid)
      ->orderBy('id')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();
      return view('stocks.reportgoldbuysale',compact('exchanges','users'));

    }
    public function reportbuysale()
    {
        $selcomid=Session('log_into_company_id');
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })->get();

        return view('stocks.reportbuysale',compact('users'));
    }
    public function index()
    {
        $selcomid=Session('log_into_company_id');
        $stockdates=Stock::where('company_id',$selcomid)->select('stockdate')->distinct()->orderBy('stockdate','desc')->take(30)->get();
        $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();
        return view('stocks.index',compact('currencies','stockdates'));

    }
    public function stockexchangecurprint(Request $request)
    {
        //return $request->all();
        // $viewdate=$request->viewdate;
        // $curname=$request->curname;
        // $username=$request->username;
        // $curid=$request->curid;
        // $userid=$request->userid;
        // if($userid=='0'){
        //     $buys=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->orderBy('id')->get();
        //     $sales=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->orderBy('id')->get();
        // }else{
        //     $buys=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->where('user_id',$request->userid)->orderBy('id')->get();
        //     $sales=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->where('user_id',$request->userid)->orderBy('id')->get();
        // }
        // $curreport=StockReport::where('user_id',Auth::user()->name)->where('currency_id',$request->curid)->first();
        // return view('stocks.seeexchangedetailprint',compact('buys','sales','viewdate','curname','username','curreport','curid','userid'));


        $viewdate=$request->viewdate;
        $curname=$request->curname;
        $username=$request->username;
        $curid=$request->curid;
        $userid=$request->userid;
        $stockdate=$request->stockdate;
        $todate=$request->todate;
        $gold_tuochek=$request->tuochek;
        $oprand = ($stockdate == $viewdate) ? '>=' : '>';

        if($userid=='0'){
            //$buys=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->orderBy('id')->get();
            $buys = Exchange::whereRaw("DATE(dd) <= ?", [$request->todate])
            ->whereRaw("DATE(dd) $oprand ?", [$stockdate])
            ->where('status', 1)
            ->where('currency_id', $request->curid)
            ->where('product', '>', 0)
            ->orderBy('id')
            ->get();
            //$sales=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->orderBy('id')->get();
            $sales = Exchange::whereRaw("DATE(dd) <= ?", [$request->todate])
            ->whereRaw("DATE(dd) $oprand ?", [$stockdate])
            ->where('status', 1)
            ->where('currency_id', $request->curid)
            ->where('product', '<', 0)
            ->orderBy('id')
            ->get();
        }else{
            $buys=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->where('user_id',$request->userid)->orderBy('id')->get();
            $sales=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->where('user_id',$request->userid)->orderBy('id')->get();
        }

        //$curreport=StockReport::where('user_id',Auth::id())->where('currency_id',$request->curid)->first();
        $curreport=StockReport::where('viewby',Auth::user()->name)->where('currency_id',$request->curid)->first();

        return view('stocks.seeexchangedetailprint',compact('buys','sales','viewdate','stockdate','todate','curname','username','curreport','curid','userid','gold_tuochek'));



    }
    public function stockexchangecurprint1(Request $request)
    {
        $d1=$request->d1;
        $d2=$request->d2;
        $curname=$request->curname;
        $username=$request->username;
        $curid=$request->curid;
        $userid=$request->userid;
        $buys=Exchange::whereDate('dd','>=',$request->d1)->whereDate('dd','<=',$request->d2)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->where('user_id',$request->userid)->orderBy('id')->get();
        $sales=Exchange::whereDate('dd','>=',$request->d1)->whereDate('dd','<=',$request->d2)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->where('user_id',$request->userid)->orderBy('id')->get();
        $curreport=StockReport::where('user_id',Auth::id())->where('currency_id',$request->curid)->first();
        return view('stocks.seeexchangedetailprint1',compact('buys','sales','d1','d2','curname','username','curreport','curid','userid'));

    }
    public function viewexchangeprofitdetailbycurrency(Request $request)
    {
        //return $request->all();
        $viewdate=date('Y-m-d', strtotime($request->viewdate));
        $curname=$request->curname;
        $username=$request->username;
        $curid=$request->curid;
        $userid=$request->userid;
        $stockdate=date('Y-m-d', strtotime($request->stockdate));
        $todate=date('Y-m-d', strtotime($request->todate));
        $gold_tuochek=$request->tuochek;
        $oprand = ($stockdate == $viewdate || $stockdate == $todate) ? '>=' : '>';
        if($userid=='0'){
            //$buys=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->orderBy('id')->get();

            $buys = Exchange::whereRaw("DATE(dd) <= ?", [$todate])
            ->whereRaw("DATE(dd) $oprand ?", [$stockdate])
            ->where('status', 1)
            ->where('currency_id', $request->curid)
            ->where('product', '>', 0)
            ->orderBy('id')
            ->get();

            //$sales=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->orderBy('id')->get();
            $sales = Exchange::whereRaw("DATE(dd) <= ?", [$todate])
            ->whereRaw("DATE(dd) $oprand ?", [$stockdate])
            ->where('status', 1)
            ->where('currency_id', $request->curid)
            ->where('product', '<', 0)
            ->orderBy('id')
            ->get();

        }else{
            $buys=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->where('user_id',$request->userid)->orderBy('id')->get();
            $sales=Exchange::whereDate('dd','<=',$request->todate)->whereDate('dd',$oprand,$stockdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->where('user_id',$request->userid)->orderBy('id')->get();
        }

        //$curreport=StockReport::where('user_id',Auth::id())->where('currency_id',$request->curid)->first();
        $curreport=StockReport::where('viewby',Auth::user()->name)->where('currency_id',$request->curid)->first();
        if(isset($request->isprint) && $request->isprint==1){
            return view('stocks.seeexchangedetailprint',compact('buys','sales','viewdate','stockdate','todate','curname','username','curreport','curid','userid','gold_tuochek'));
        }else{
            return view('stocks.seeexchangedetail',compact('buys','sales','viewdate','stockdate','todate','curname','username','curreport','curid','userid','gold_tuochek'));
        }
    }
    public function viewexchangeprofitdetailbycurrency1(Request $request)
    {
        //return $request->all();
        $viewdate=$request->viewdate;
        $enddate=$request->enddate;
        $curname=$request->curname;
        $username=$request->username;
        $curid=$request->curid;
        $userid=$request->userid;
        $buys=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','>',0)->where('user_id',$request->userid)->orderBy('id')->get();
        $sales=Exchange::whereDate('dd',$request->viewdate)->where('status',1)->where('currency_id',$request->curid)->where('product','<',0)->where('user_id',$request->userid)->orderBy('id')->get();
        $curreport=StockReport::where('user_id',Auth::id())->where('currency_id',$request->curid)->first();
        return view('stocks.seeexchangedetail1',compact('buys','sales','viewdate','enddate','curname','username','curreport','curid','userid'));
    }
    public function stockexchangecurallprint(Request $request)
    {
        $report=StockReport::where('user_id',Auth::id())->orderBy('id')->get();
        $username=$request->username;
        $dd=$request->dd;
        return view('stocks.tempstockreportprint',compact('report','username','dd'));
    }
    public function showstockreport(Request $request){
        //return $request->all();

        $selcomid=Session('log_into_company_id');
        DB::table('stock_reports')->where('viewby',Auth::user()->name)->delete();
        //$currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('isfn',1)->orderBy('no')->get();
        $viewdate = str_replace('/', '-', $request->viewdate);
        $viewdate= date('Y-m-d', strtotime($viewdate));
        $todate = str_replace('/', '-', $request->todate);
        $todate= date('Y-m-d', strtotime($todate));
        if($request->user=='0'){
            $fromdate=UserCapital::where('trancode',2)->where('status',1)->whereDate('trandate','<=',$viewdate)->where('company_id',$selcomid)->max('trandate');
        }else{
            $fromdate=UserCapital::where('trancode',2)->where('user_id_affect',$request->user)->where('status',1)->whereDate('trandate','<=',$viewdate)->where('company_id',$selcomid)->max('trandate');
        }
        if(is_null($fromdate)){
            $fromdate=$viewdate;
        }

        if(isset($request->selgold) && $request->selgold==0){
             $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)
             ->where(function($q){
                $q->whereNull('isgold')->orWhere('isgold',0);
             })
             ->orderBy('no')->get();
        }else if(isset($request->selgold) && $request->selgold==1){
             $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)->where('isgold',1)->orderBy('no')->get();
        }else{
            $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();
        }
        foreach($currencies as $cur){
            if($cur->isgold==1){
                $this->doreportgold1($request,$cur->id,$cur->tuochek,$cur->isexchangecur,$cur->optsign,$cur->ratebuy,$fromdate,$viewdate,$todate);
            }else{
                $this->doreport($request,$cur->id,$cur->isexchangecur,$cur->optsign,$cur->ratebuy,$fromdate,$viewdate,$todate);
            }
        }
        // $report=StockReport::join('currencies','stock_reports.currency_id','=','currencies.id')->where('stock_reports.user_id',Auth::id())->orderBy('currencies.no')->get();
        $report=StockReport::where('viewby',Auth::user()->name)->orderBy('id')->get();

        return view('stocks.tempstockreport',compact('report'));
    }
    public function showstockreport1(Request $request){
        $selcomid=Session('log_into_company_id');
        DB::table('stock_reports')->where('user_id',Auth::id())->delete();
        $currencies=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)->orderBy('no')->get();
        foreach($currencies as $cur){
            if($cur->isgold==1){

            }else{
                $this->doreport1($request,$cur->id,$cur->isexchangecur,$cur->optsign,$cur->ratebuy);
            }
        }
        // $report=StockReport::join('currencies','stock_reports.currency_id','=','currencies.id')->where('stock_reports.user_id',Auth::id())->orderBy('currencies.no')->get();
        $report=StockReport::where('user_id',Auth::id())->orderBy('id')->get();

        return view('stocks.tempstockreport1',compact('report'));
    }
    public function doreport1(Request $request,$curid,$isexchangecur,$operator,$ratebuy)
    {
        $d1 = str_replace('/', '-', $request->d1);
        $d1= date('Y-m-d', strtotime($d1));
        $d2 = str_replace('/', '-', $request->d2);
        $d2= date('Y-m-d', strtotime($d2));

        $avgratebuy=1;
        $avgratesale=1;
        $buyweight=0;
        $buyamount=0;
        $saleweight=0;
        $saleamount=0;
        $startstock=0;
        $stockamount=0;
        $avgstock=1;
        $totalbuy=0;
        $pweight=0;
        $weightin=0;
        $stdate='2023-01-01';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');

        $stock=Stock::where('currency_id',$curid)->whereDate('stockdate','<',$d1)->orderBy('stockdate','DESC')->first();
        if($stock<>null){
            if($stock->stock<>null){
                $stdate=$stock->stockdate;
                $startstock=$stock->stock;
                $stockamount=$stock->amount;
                if($startstock==0){
                    $avgstock=1;
                }else{
                    if($operator=='/'){
                        $avgstock=$startstock/$stockamount;
                    }else{
                        $avgstock=$stockamount/$startstock;
                    }

                }
            }
        }

        if($isexchangecur==0){
            if($request->user=='stock'){
                $invbuy=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                $pweight=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();
            }else{
                if($request->user=='all'){
                    $invbuy=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                    $pweight=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();

                }else{
                    $invbuy=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('user_id',$request->user)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                    $pweight=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('user_id',$request->user)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();
                }
            }
            if($pweight->pweight<>null){
                $weightin=$pweight->pweight;
            }
            if($invbuy->tweight<>null){
                $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
            }
            if($request->user=='stock'){
                $invsale=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
            }else{
                if($request->user=='all'){
                    $invsale=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                }else{
                    $invsale=Invoice::whereDate('invdate','>=',$d1)->whereDate('invdate','<=',$d2)->where('user_id',$request->user)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                }
            }
            if($invsale->tweight<>null){
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);

            }
        }else{
            if($request->user=='stock'){
                $invbuy=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$d2)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
            }else{
                if($request->user=='all'){
                    $invbuy=Exchange::whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }
            }
            if($invbuy->tweight<>null){
                $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
                if($operator=='/'){
                    $avgratebuy=$buyweight/$buyamount;
                }else{
                    $avgratebuy=$buyamount/$buyweight;
                }
            }
            if($request->user=='stock'){
                $invsale=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$d2)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
            }else{
                if($request->user=='all'){
                    $invsale=Exchange::whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereDate('dd','>=',$d1)->whereDate('dd','<=',$d2)->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }
            }

            if($invsale->tweight<>null){
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);
                if($operator=='/'){
                    $avgratesale=$saleweight/$saleamount;
                }else{
                    $avgratesale=$saleamount/$saleweight;
                }
            }
        }


        if($buyweight>=$saleweight){
            if($buyweight>0){
                if($operator=='/'){
                    $pricebuy=$buyweight/$buyamount;
                    $totalbuy=$saleweight/$pricebuy;
                }else{
                    $pricebuy=$buyamount/$buyweight;
                    $totalbuy=$saleweight*$pricebuy;
                }
            }
        }else{
            $qty=$saleweight-$buyweight;
            if($avgstock==1){
                if($operator=='/'){
                    //$totalbuy1=$qty/$avgratesale;
                    $totalbuy1=$qty/$avgratebuy;

                }else{
                    //$totalbuy1=$qty*$avgratesale;
                    $totalbuy1=$qty*$avgratebuy;
                }

            }else{
                if($operator=='/'){
                    $totalbuy1=$qty/$avgstock;
                }else{
                    $totalbuy1=$qty*$avgstock;
                }

            }
            $totalbuy=$totalbuy1+$buyamount;
        }
        DB::table('stock_reports')->insert([
            'viewdate'=>$d1,
            'enddate'=>$d2,
            'user_id'=>Auth::id(),
            'currency_id'=>$curid,
            'stockdate'=>$stdate,
            'startstock'=>$startstock,
            'startamount'=>$stockamount,
            'buyqty'=>$buyweight+$weightin,
            'buyamt'=>$buyamount,
            'qtysale'=>$saleweight,
            'totalsale'=>$saleamount,
            'totalbuy'=>$totalbuy,
            'stock'=>$startstock +$buyweight+$weightin-$saleweight,
            'amount'=>$stockamount+$buyamount-$totalbuy
        ]);
    }
    public function doreport(Request $request,$curid,$isexchangecur,$operator,$ratebuy,$fromdate,$viewdate,$todate)
    {
        // $viewdate = str_replace('/', '-', $request->viewdate);
        // $viewdate= date('Y-m-d', strtotime($viewdate));
        $avgratebuy=0;
        $avgratesale=0;
        $buyweight=0;
        $buyamount=0;
        $saleweight=0;
        $saleamount=0;
        $startstock=0;
        $stockamount=0;
        $avgstock=0;
        $totalbuy=0;
        $pweight=0;
        $weightin=0;
        $stdate=$fromdate;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');

        // if($request->alldate==='true'){
        //     $min_exchange_date = Exchange::where('currency_id',$curid)->where('status',1)->min('dd');
        //     if($min_exchange_date){
        //         $stock=Stock::where('currency_id',$curid)->whereDate('stockdate','<',$min_exchange_date)->orderBy('stockdate','DESC')->first();
        //     }else{
        //          $stock=Stock::where('currency_id',$curid)->whereDate('stockdate','<',$viewdate)->orderBy('stockdate','DESC')->first();
        //     }
        //     //$stdate = $min_exchange_date ? Carbon::parse($min_exchange_date)->subDay()->toDateString(): null;
        // }else{
        //     $stock=Stock::where('currency_id',$curid)->whereDate('stockdate','<',$viewdate)->orderBy('stockdate','DESC')->first();
        // }


        if ($request->alldate === 'true') {
            $min_exchange_date = Exchange::where('currency_id', $curid)
                ->where('status', 1)
                ->min('dd');

            $newdate = $min_exchange_date ?: $viewdate;
        } else {
            $newdate = $viewdate;
        }

        $stock = Stock::where('currency_id', $curid)
            ->whereDate('stockdate', '<', $newdate)
            ->orderBy('stockdate', 'DESC')
            ->first();

        if ($stock && $stock->stock !== null) {
            $stdate     = $stock->stockdate;
            $startstock = $stock->stock;
            $stockamount= $stock->amount;

            if ($startstock == 0) {
                // fallback to rate
                $avgstock = $stock->rate ?: 1;  // if rate=0, force avgstock=1
            } else {
                $avgstock = $operator == '/'
                    ? $startstock / $stockamount
                    : $stockamount / $startstock;
            }
        }

        // if($stock<>null){
        //     if($stock->stock<>null){
        //         $stdate=$stock->stockdate;
        //         $startstock=$stock->stock;
        //         $stockamount=$stock->amount;
        //         if($startstock==0){
        //             //$avgstock=1;
        //             $avgstock=$stock->rate;
        //             if($avgstock==0){
        //                 $avgstock==1;
        //             }
        //         }else{
        //             if($operator=='/'){
        //                 $avgstock=$startstock/$stockamount;
        //             }else{
        //                 $avgstock=$stockamount/$startstock;
        //             }

        //         }
        //     }
        // }

        if($isexchangecur==0){
            if($request->user=='stock'){
                $invbuy=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$todate)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                $pweight=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$todate)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();
            }else{
                if($request->user=='all'){
                    $invbuy=Invoice::whereDate('invdate','=',$todate)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                    $pweight=Invoice::whereDate('invdate','=',$todate)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();

                }else{
                    $invbuy=Invoice::whereDate('invdate','=',$todate)->where('user_id',$request->user)->where('status',1)->where('cur','USD')->where('totalweight','>','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                    $pweight=Invoice::whereDate('invdate','=',$todate)->where('user_id',$request->user)->where('status',1)->where('cur','LI')->select(DB::raw('sum(totalweight+total) as pweight'))->first();
                }
            }
            if($pweight->pweight<>null){
                $weightin=$pweight->pweight;
            }
            if($invbuy->tweight<>null){
                $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
            }
            if($request->user=='stock'){
                $invsale=Invoice::whereDate('invdate','>',$stdate)->whereDate('invdate','<=',$todate)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
            }else{
                if($request->user=='all'){
                    $invsale=Invoice::whereDate('invdate','=',$todate)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                }else{
                    $invsale=Invoice::whereDate('invdate','=',$todate)->where('user_id',$request->user)->where('status',1)->where('cur','USD')->where('totalweight','<','0')->select(DB::raw('sum(totalweight) as tweight,sum(total) as totalamount'))->first();
                }
            }
            if($invsale->tweight<>null){
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);

            }
        }else{
            if($request->user=='stock'){
                if($stock){
                    $invbuy=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }

            }else{
                if($request->user=='0'){
                    $invbuy=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }

            }
            if($invbuy->tweight<>null){
                $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
                if($operator=='/'){
                    $avgratebuy=$buyweight/$buyamount;
                }else{
                    $avgratebuy=$buyamount/$buyweight;
                }
            }
            if($request->user=='stock'){
                if($stock){
                    $invsale=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }
            }else{
                if($request->user=='0'){
                    $invsale=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }
            }

            if($invsale->tweight<>null){
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);
                if($operator=='/'){
                    $avgratesale=$saleweight/$saleamount;
                }else{
                    $avgratesale=$saleamount/$saleweight;
                }
            }
        }

        if($request->user<>'stock'){
            if($request->user=='0'){
                //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('status',1)->where('trancode','<>','-2')->sum('amount');
            }else{
                $usercapital=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$request->user)->where('currency_id',$curid)->where('status',1)->where('trancode',2)->select(DB::raw('sum(amount) as amt'))->first();
                if($usercapital->amt<>null){
                    $startstock=$usercapital->amt;
                    if($avgratebuy==0 && $ratebuy<>0){
                        $avgratebuy=$ratebuy;
                    }
                    if($avgstock==0){
                        if($operator=='/'){
                            $stockamount=$startstock / $avgratebuy;
                        }else{
                            $stockamount=$startstock * $avgratebuy;
                        }

                    }else{
                        if($operator=='/'){
                            $stockamount=$startstock / $avgstock;
                        }else{
                            $stockamount=$startstock * $avgstock;
                        }
                    }
                }
                //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('user_id_affect',$request->user)->where('status',1)->where('trancode','<>','-2')->sum('amount');
            }

        }
        if($buyweight>=$saleweight){
            if($buyweight>0){
                if($operator=='/'){
                    $pricebuy=$buyweight/$buyamount;
                    $totalbuy=$saleweight/$pricebuy;
                }else{
                    $pricebuy=$buyamount/$buyweight;
                    $totalbuy=$saleweight*$pricebuy;
                }
            }
        }else{
            $qty=$saleweight-$buyweight;
            if($avgstock==0){
                if($operator=='/'){
                    //$totalbuy1=$qty/$avgratesale;
                    if($buyweight==0){
                        $totalbuy1=$qty/$avgratesale;
                    }else{
                        $totalbuy1=$qty/$avgratebuy;
                    }

                }else{
                    //$totalbuy1=$qty*$avgratesale;
                     if($buyweight==0){
                        $totalbuy1=$qty*$avgratesale;
                     }else{
                         $totalbuy1=$qty*$avgratebuy;
                     }
                }

            }else{
                if($operator=='/'){
                    $totalbuy1=$qty/$avgstock;
                }else{
                    $totalbuy1=$qty*$avgstock;
                }

            }
            $totalbuy=$totalbuy1+$buyamount;
        }
        DB::table('stock_reports')->insert([
            'viewdate'=>$viewdate,
            'viewby'=>Auth::user()->name,
            'user_id'=>$request->user=='stock'?0:$request->user,
            'currency_id'=>$curid,
            'stockdate'=>$stdate,
            'todate'=>$todate,
            'startstock'=>$startstock,
            'startamount'=>$stockamount,
            'buyqty'=>$buyweight+$weightin,
            'buyamt'=>$buyamount,
            'qtysale'=>$saleweight,
            'totalsale'=>$saleamount,
            'totalbuy'=>$totalbuy,
            'stock'=>$startstock +$buyweight+$weightin-$saleweight,
            'amount'=>$stockamount+$buyamount-$totalbuy
        ]);
    }
     public function doreportgold(Request $request,$curid,$isexchangecur,$operator,$ratebuy,$fromdate,$viewdate,$todate)
    {
        // $viewdate = str_replace('/', '-', $request->viewdate);
        // $viewdate= date('Y-m-d', strtotime($viewdate));
        $avgratebuy=0;
        $avgratesale=0;
        $buyweight=0;
        $buyamount=0;
        $saleweight=0;
        $saleamount=0;
        $startstock=0;
        $stockamount=0;
        $avgstock=0;
        $totalbuy=0;
        $pweight=0;
        $weightin=0;
        $stdate=$fromdate;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');

        if ($request->alldate === 'true') {
            $min_exchange_date = Exchange::where('currency_id', $curid)
                ->where('status', 1)
                ->min('dd');
            $newdate = $min_exchange_date ?: $viewdate;
        } else {
            $newdate = $viewdate;
        }

        //get currency gold water
        $goldwaters = Exchange::where('currency_id', $curid)->select('goldwater')->orderBy('goldwater')->get()->unique('goldwater')->values();
        //$goldwater = Currency::where('id', $curid)->select('goldwater')->distinct()->pluck('goldwater');
        //$goldwater = Currency::where('id', $curid)->select('goldwater')->groupBy('goldwater')->get();
        foreach($goldwaters as $gw)
        {

            $stock = Stock::where('currency_id', $curid)->where('goldwater',$gw->goldwater)->whereDate('stockdate', '<', $newdate)->orderBy('stockdate', 'DESC')->first();

            if ($stock && $stock->stock !== null) {
                $stdate     = $stock->stockdate;
                $startstock = $stock->stock;
                $stockamount= $stock->amount;

                if ($startstock == 0) {
                    // fallback to rate
                    $avgstock = $stock->rate ?: 1;  // if rate=0, force avgstock=1
                } else {
                    if($gw->goldwater>0){
                        $avgstock = $operator == '/'
                            ? $startstock / $stockamount
                            : ($stockamount * 10000) / ($startstock * $gw->goldwater);
                    }else{
                        $avgstock = $operator == '/'
                            ? $startstock / $stockamount
                            : $stockamount / $startstock;
                    }
                }
            }
            if($request->user=='stock'){
                if($stock){
                    $invbuy=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }

            }else{
                if($request->user=='0'){
                    $invbuy=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('goldwater',$gw->goldwater)->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }

            }
            if($invbuy->tweight<>null){
                $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
                if($operator=='/'){
                    $avgratebuy=$buyweight/$buyamount;
                }else{
                     if($gw->goldwater>0){
                        $avgratebuy=($buyamount * 10000)/($buyweight * $gw->goldwater);
                     }else{
                         $avgratebuy=$buyamount/$buyweight;
                     }
                }
            }

            if($request->user=='stock'){
                if($stock){
                    $invsale=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }
            }else{
                if($request->user=='0'){
                    $invsale=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$request->user)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(amount) as totalamount'))->first();
                }

            }
            if($invsale->tweight<>null){
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);
                if($operator=='/'){
                    $avgratesale=$saleweight/$saleamount;
                }else{
                     if($gw->goldwater>0){
                        $avgratesale=($saleamount * 10000) / ($saleweight * $gw->goldwater);
                     }else{
                         $avgratesale=$saleamount/$saleweight;
                     }
                }
            }


            if($request->user<>'stock'){
                if($request->user=='0'){
                    //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('status',1)->where('trancode','<>','-2')->sum('amount');
                }else{
                    $usercapital=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$request->user)->where('currency_id',$curid)->where('goldwater',$gw->goldwater)->where('status',1)->where('trancode',2)->select(DB::raw('sum(amount) as amt'))->first();
                    if($usercapital->amt<>null){
                        $startstock=$usercapital->amt;
                        if($avgratebuy==0 && $ratebuy<>0){
                            $avgratebuy=$ratebuy;
                        }
                        if($avgstock==0){
                            if($operator=='/'){
                                $stockamount=$startstock / $avgratebuy;
                            }else{
                                if($gw->goldwater>0){
                                    $stockamount=($startstock * $avgratebuy * $gw->goldwater)/10000;
                                }else{
                                    $stockamount=$startstock * $avgratebuy;
                                }
                            }

                        }else{
                            if($operator=='/'){
                                $stockamount=$startstock / $avgstock;
                            }else{
                                 if($gw->goldwater>0){
                                     $stockamount=($startstock * $avgstock * $gw->goldwater)/10000;
                                 }else{
                                    $stockamount=$startstock * $avgstock;
                                 }
                            }
                        }
                    }
                    //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('user_id_affect',$request->user)->where('status',1)->where('trancode','<>','-2')->sum('amount');
                }

            }
            if($buyweight>=$saleweight){
                if($buyweight>0){
                    if($operator=='/'){
                        $pricebuy=$buyweight/$buyamount;
                        $totalbuy=$saleweight/$pricebuy;
                    }else{
                        if($gw->goldwater>0){
                            $pricebuy=($buyamount*10000)/($buyweight*$gw->goldwater);
                            $totalbuy=($saleweight*$pricebuy*$gw->goldwater)/10000;
                        }else{
                            $pricebuy=$buyamount/$buyweight;
                            $totalbuy=$saleweight*$pricebuy;
                        }
                    }
                }
            }else{
                $qty=$saleweight-$buyweight;
                if($avgstock==0){
                    if($operator=='/'){

                        if($buyweight==0){
                            $totalbuy1=$qty/$avgratesale;
                        }else{
                            $totalbuy1=$qty/$avgratebuy;
                        }

                    }else{
                        if($gw->goldwater>0){
                            if($buyweight==0){
                               $totalbuy1=($qty*$avgratesale*$gw->goldwater)/10000;
                            }else{
                                $totalbuy1=($qty*$avgratebuy*$gw->goldwater)/10000;
                            }

                        }else{
                            if($buyweight==0){
                               $totalbuy1=$qty*$avgratesale;
                            }else{
                                $totalbuy1=$qty*$avgratebuy;
                            }
                        }
                    }

                }else{
                    if($operator=='/'){
                        $totalbuy1=$qty/$avgstock;
                    }else{
                         if($gw->goldwater>0){
                             $totalbuy1=($qty*$avgstock*$gw->goldwater)/10000;
                         }else{
                             $totalbuy1=$qty*$avgstock;
                         }
                    }

                }
                $totalbuy=$totalbuy1+$buyamount;
            }
            DB::table('stock_reports')->insert([
                'viewdate'=>$viewdate,
                'viewby'=>Auth::user()->name,
                'user_id'=>$request->user=='stock'?0:$request->user,
                'currency_id'=>$curid,
                'goldwater'=>$gw->goldwater,
                'stockdate'=>$stdate,
                'todate'=>$todate,
                'startstock'=>$startstock,
                'startamount'=>$stockamount,
                'buyqty'=>$buyweight,
                'buyamt'=>$buyamount,
                'qtysale'=>$saleweight,
                'totalsale'=>$saleamount,
                'totalbuy'=>$totalbuy,
                'stock'=>$startstock +$buyweight-$saleweight,
                'amount'=>$stockamount+$buyamount-$totalbuy
            ]);

            //clear variable
            $stdate=$fromdate;
            $startstock=0;
            $stockamount=0;
            $avgstock=0;
            $buyweight=0;
            $buyamount=0;
            $avgratebuy=0;
            $saleweight=0;
            $saleamount=0;
            $avgratesale=0;
            $totalbuy=0;

        }

    }
     public function doreportgold1(Request $request,$curid,$tuochek,$isexchangecur,$operator,$ratebuy,$fromdate,$viewdate,$todate)
    {
        // $viewdate = str_replace('/', '-', $request->viewdate);
        // $viewdate= date('Y-m-d', strtotime($viewdate));
        $avgratebuy=0;
        $avgratesale=0;
        $buyweight=0;
        $buyweight_gold=0;
        $buyamount=0;
        $saleweight=0;
        $saleweight_gold=0;

        $saleamount=0;
        $startstock=0;
        $startstock_gold=0;

        $stockamount=0;
        $avgstock=0;
        $totalbuy=0;
        $pweight=0;
        $weightin=0;
        $weightin_gold=0;
        $stdate=$fromdate;
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');



        if ($request->alldate === 'true') {
            $min_exchange_date = Exchange::where('currency_id', $curid)
                ->where('status', 1)
                ->min('dd');

            $newdate = $min_exchange_date ?: $viewdate;
        } else {
            $newdate = $viewdate;
        }

        $stock = Stock::where('currency_id', $curid)
            ->whereDate('stockdate', '<', $newdate)
            ->orderBy('stockdate', 'DESC')
            ->first();

        if ($stock && $stock->stock !== null) {
            $stdate     = $stock->stockdate;
            $startstock_gold = $stock->stock;
            $startstock = $stock->platin_weight;

            $stockamount= $stock->amount;

            if ($startstock_gold == 0) {
                // fallback to rate
                $avgstock = $stock->rate ?: 1;  // if rate=0, force avgstock=1
            } else {
                $avgstock = $operator == '/'
                    ? $startstock_gold / $stockamount
                    : $stockamount / $startstock_gold;
            }
        }


            if($request->user=='stock'){
                if($stock){
                    $invbuy=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }

            }else{
                if($request->user=='0'){
                    $invbuy=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }else{
                    $invbuy=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','>','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }

            }
            if($invbuy->tweight<>null){
                if($tuochek>1){//is platin
                    $buyweight_gold=abs($invbuy->twgold);
                }else{// is gold kilo
                    $buyweight_gold=abs($invbuy->tweight);
                }
                 $buyweight=abs($invbuy->tweight);
                $buyamount=abs($invbuy->totalamount);
                if($operator=='/'){
                    $avgratebuy=$buyweight_gold/$buyamount;
                }else{
                    $avgratebuy=$buyamount/$buyweight_gold;
                }
            }
            if($request->user=='stock'){
                if($stock){
                    $invsale=Exchange::whereDate('dd','>',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereDate('dd','>=',$stdate)->whereDate('dd','<=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }
            }else{
                if($request->user=='0'){
                    $invsale=Exchange::whereDate('dd','=',$todate)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }else{
                    $invsale=Exchange::whereBetween(DB::raw('DATE(dd)'), array($fromdate, $todate))->where('user_id',$request->user)->where('currency_id',$curid)->where('status',1)->where('product','<','0')->select(DB::raw('sum(product) as tweight,sum(product*goldwater/100) as twgold,sum(amount) as totalamount'))->first();
                }
            }

            if($invsale->tweight<>null){
                if($tuochek>1){
                    $saleweight_gold=abs($invsale->twgold);
                }else{
                    $saleweight_gold=abs($invsale->tweight);
                }
                $saleweight=abs($invsale->tweight);
                $saleamount=abs($invsale->totalamount);
                if($operator=='/'){
                    $avgratesale=$saleweight_gold/$saleamount;
                }else{
                    $avgratesale=$saleamount/$saleweight_gold;
                }
            }


        if($request->user<>'stock'){
            if($request->user=='0'){
                //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('status',1)->where('trancode','<>','-2')->sum('amount');
            }else{
                $usercapital=UserCapital::whereDate('trandate',$fromdate)->where('user_id_affect',$request->user)->where('currency_id',$curid)->where('status',1)->where('trancode',2)->select(DB::raw('sum(amount) as amt,sum(amount*goldwater/100) as twgold'))->first();
                if($usercapital->amt<>null){
                    if($tuochek>1){
                        $startstock=$usercapital->amt;
                        $startstock_gold=$usercapital->twgold;
                    }else{
                        $startstock=$usercapital->amt;
                        $startstock_gold=$usercapital->amt;
                    }

                    if($avgratebuy==0 && $ratebuy<>0){
                        $avgratebuy=$ratebuy;
                    }
                    if($avgstock==0){
                        if($operator=='/'){
                            $stockamount=$startstock_gold / $avgratebuy;
                        }else{
                            $stockamount=$startstock_gold * $avgratebuy;
                        }

                    }else{
                        if($operator=='/'){
                            $stockamount=$startstock_gold / $avgstock;
                        }else{
                            $stockamount=$startstock_gold * $avgstock;
                        }
                    }
                }
                //$usercapital=UserCapital::where('currency_id',$curid)->where('trandate',$todate)->where('user_id_affect',$request->user)->where('status',1)->where('trancode','<>','-2')->sum('amount');
            }

        }
        if($buyweight_gold>=$saleweight_gold){
            if($buyweight_gold>0){
                if($operator=='/'){
                    $pricebuy=$buyweight_gold/$buyamount;
                    $totalbuy=$saleweight_gold/$pricebuy;
                }else{
                    $pricebuy=$buyamount/$buyweight_gold;
                    $totalbuy=$saleweight_gold*$pricebuy;
                }
            }
        }else{
            $qty=$saleweight_gold-$buyweight_gold;
            if($avgstock==0){
                if($operator=='/'){
                    //$totalbuy1=$qty/$avgratesale;
                    if($buyweight_gold==0){
                        $totalbuy1=$qty/$avgratesale;
                    }else{
                        $totalbuy1=$qty/$avgratebuy;
                    }

                }else{
                    //$totalbuy1=$qty*$avgratesale;
                     if($buyweight_gold==0){
                        $totalbuy1=$qty*$avgratesale;
                     }else{
                         $totalbuy1=$qty*$avgratebuy;
                     }
                }

            }else{
                if($operator=='/'){
                    $totalbuy1=$qty/$avgstock;
                }else{
                    $totalbuy1=$qty*$avgstock;
                }

            }
            $totalbuy=$totalbuy1+$buyamount;
        }
        $gold_weight=$startstock_gold +$buyweight_gold+$weightin_gold-$saleweight_gold;
        if($tuochek>1){
            $platin_weight=$startstock +$buyweight+$weightin-$saleweight;
        }else{
            $platin_weight=0;
        }
        DB::table('stock_reports')->insert([
            'viewdate'=>$viewdate,
            'viewby'=>Auth::user()->name,
            'user_id'=>$request->user=='stock'?0:$request->user,
            'currency_id'=>$curid,
            'stockdate'=>$stdate,
            'todate'=>$todate,
            'startstock'=>$startstock_gold,
            'startamount'=>$stockamount,
            'buyqty'=>$buyweight_gold+$weightin_gold,
            'buyamt'=>$buyamount,
            'qtysale'=>$saleweight_gold,
            'totalsale'=>$saleamount,
            'totalbuy'=>$totalbuy,
            'stock'=>$gold_weight,
            'amount'=>$stockamount+$buyamount-$totalbuy,
            'startstock_platin' => $startstock,
            'buyin_platin' => $buyweight,
            'saleout_platin' => $saleweight,
            'stock_platin' => $platin_weight,
            'goldwater' => $platin_weight<>0?$gold_weight / $platin_weight * 100:0,
        ]);
    }
    public function store(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $selcomid=Session('log_into_company_id');
        $stockdate = str_replace('/', '-', $request->stockdate);
        $stockdate= date('Y-m-d', strtotime($stockdate));
        if($request->isgold==2){
            DB::table('stocks')->whereDate('stockdate','=',$stockdate)->where('company_id',$selcomid)->delete();
        }else{
            DB::table('stocks')->whereDate('stockdate','=',$stockdate)->where('company_id',$selcomid)->where('isgold',$request->isgold)->delete();
        }
        foreach ($request->curid as $key => $value) {

            $amtstock=str_replace('USD','',$request->amtstock[$key]);
            $amtstock=str_replace('$','',$amtstock);

            $stock=array(
            'company_id'=>$selcomid,
            'stockdate'=>$stockdate,
            'user_id'=>Auth::id(),
            'currency_id'=>$value,
            'stock'=>floatval(str_replace(',','',$request->stock[$key])),
            'amount'=>str_replace(',','',$amtstock),
            'rate'=>floatval(str_replace(',','',$request->ratestock[$key])),
            'goldwater' => $request->txtgoldwater[$key],
            'isgold' => $request->iscurgold[$key],
            'platin_weight' => str_replace(',','',$request->stock_platin[$key]),
            'created_at' => $current,
            'updated_at' => $current,

            );
            Stock::insert($stock);

        }

    }
    public function saveselectstock(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $validator = Validator::make($request->all(), [
            'amtstock.*' => 'required',
            'curstock.*' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        // $stockdate = str_replace('/', '-', $request->stockdate);
        // $stockdate= date('Y-m-d', strtotime($stockdate));
        DB::table('stock_prints')->where('printby','=',Auth::user()->name)->delete();
        foreach ($request->amtstock as $key => $value) {
            $amtstock=str_replace('USD','',$request->amtstock[$key]);
            $stock=array(

            'printby'=>Auth::user()->name,
            'amtstock'=>str_replace(',','',$value),
            'cur'=>$request->curstock[$key],
            'created_at'=>$current,
            'updated_at'=>$current,

            );
            StockPrint::insert($stock);

        }
        return response()->json(['success'=>true,'userprint'=>Auth::user()->name]);

    }
    public function printselectstock(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $logo=Company::find($selcomid);
        $stockprints=StockPrint::where('printby','=',Auth::user()->name)->get();
        return view('stocks.selectstockprint',compact('stockprints','logo'));
    }
    public function saveeditstock(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'stock.*' => 'required',
            'amtstock.*' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        $stockdate = str_replace('/', '-', $request->stockdate);
        $stockdate= date('Y-m-d', strtotime($stockdate));
        //DB::table('stocks')->where('company_id',$selcomid)->whereDate('stockdate','=',$stockdate)->whereNull('goldwater')->delete();
        foreach ($request->curid as $key => $value) {
            $amtstock=str_replace('USD','',$request->amtstock[$key]);
            // $stock=array(
            // 'stockdate'=>$stockdate,
            // 'user_id'=>Auth::id(),
            // 'currency_id'=>$value,
            // 'stock'=>str_replace(',','',$request->stock[$key]),
            // 'amount'=>str_replace(',','',$amtstock),
            // 'rate'=>str_replace(',','',$request->rate[$key]),
            // 'company_id' => $selcomid,
            // 'created_at' => $current,
            // 'updated_at' => $current,

            // );
            // Stock::insert($stock);

             Stock::updateOrCreate(
                [
                    'stockdate' => $stockdate,
                    'company_id' => $selcomid,
                    'currency_id' => $value,
                ],
                [
                    'user_id'=>Auth::id(),

                    'stock'=>str_replace(',','',$request->stock[$key]),
                    'amount'=>str_replace(',','',$amtstock),
                    'rate'=>str_replace(',','',$request->rate[$key]),
                    'isgold' => $request->isgold[$key]??0,
                    'goldwater' => 0,
                    'created_at' => $current,
                    'updated_at' => $current,
                ]
            );
        }

    }
    public function editstock(Request $request)
    {
        $selcomid=Session('log_into_company_id');

        $currencystock=Currency::where('active',1)->where('ismain',0)->where('ispandp',0)->where('company_id',$selcomid)
        ->where(function($q){
            $q->where('tuochek','<=',1)->orWhereNull('tuochek');
        })->orderBy('no')->get();

        foreach($currencystock as $c)
        {
            $stock=Stock::where('currency_id',$c->id)->first();
            if($stock){
                $c['stock']=$stock->stock;
                $c['stock_amount']=$stock->amount;
                $c['stock_rate']=$stock->rate;
            }else{
                $c['stock']=0;
                $c['stock_amount']=0;
                $c['stock_rate']=$c->rate_buy;
            }
        }
        return response($currencystock);
    }
    public function showstock(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $stockdate = str_replace('/', '-', $request->stockdate);
        $stockdate= date('Y-m-d', strtotime($stockdate));
        if($request->isgold==2){
            $stock=Stock::whereDate('stockdate',$stockdate)->where('company_id',$selcomid)->orderBy('id')->get();
        }else{
             $stock=Stock::whereDate('stockdate',$stockdate)->where('company_id',$selcomid)->where('isgold',$request->isgold)->orderBy('id')->get();
        }
        return view('stocks.tempstock',compact('stock'));
    }
     public function deletestock(Request $request)
    {
        $selcomid=Session('log_into_company_id');
        $stockdate = str_replace('/', '-', $request->stockdate);
        $stockdate= date('Y-m-d', strtotime($stockdate));
        $del=Stock::whereDate('stockdate',$stockdate)->where('company_id',$selcomid)->delete();
        if($del){
            return response()->json(['success'=>true,'message'=>'Stock Removed.']);
        }else{
             return response()->json(['error'=>true,'message'=>'Stock Remove Fail.']);
        }
    }
    public function getlaststock(Request $request)
    {

    }
}
