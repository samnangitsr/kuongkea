<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;
use App\Currency;
use App\ThaiRate;
use Carbon\Carbon;
use App\ProductRate;
use App\ThaiRateSet;
use App\ExchangeRate;
use App\ExchangeRateProduct;
use Illuminate\Http\Request;
use App\Models\CurrencyButton;
use Illuminate\Validation\Rule;
use App\Events\RefreshPageEvent;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function currency()
    {
        $selcomid=Session('log_into_company_id');
        $companies=Company::where('status',1)->get();
        $pls=ProductRate::where('company_id',$selcomid)->get();
        $currencies=Currency::where('active',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $buttonlists=CurrencyButton::where('company_id',$selcomid)->orderBy('no')->get();
        $users = User::where('active', 1)
        ->where(function ($q) use ($selcomid) {
            $q->where('company_id', $selcomid)
            ->orWhere('company_id', '')
            ->orWhereNull('company_id');
        })
        ->get();

        return view("currencies.index",compact('currencies','buttonlists','pls','users','companies','selcomid'));
    }
    public function exchangerate()
    {

        $currencies=Currency::where('active',1)->where('ismain',0)->orderBy('no')->get();
        return view("currencies.exchangerate",compact('currencies'));
    }
    public function exchangeratenew()
    {
        $selcomid=Session('log_into_company_id');
        $curleft=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('company_id',$selcomid)->orderBy('no')->get();
        $curmiddle=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('company_id',$selcomid)->orderBy('no')->get();
        $curright=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('company_id',$selcomid)->orderBy('no')->get();
        $thais=ThaiRate::where('exchangetype','THAI')->where('company_id',$selcomid)->get();
        $banks=ThaiRate::where('exchangetype','BANK')->where('company_id',$selcomid)->get();

        return view("currencies.exchangeratenew",compact('curleft','curmiddle','curright','thais','banks'));
    }
    public function currencyrate(Request $request)
    {
        //return $request->all();

        $currencies=Currency::where('active',$request->active)->where('ismain',0);
        if($request->viewcol<>''){
            $currencies=$currencies->where('lmr',$request->viewcol);
        }
        $currencies=$currencies->orderBy('no')->get();
        return view("currencies.currencyrate",compact('currencies'));
    }
    public function exchangeratethai()
    {

        $thais=ThaiRate::all();
        return view("currencies.exchangeratethai",compact('thais'));
    }
    public function setratecloselist(Request $request)
    {
        //return($request->all());
        // $current = Carbon::now();
        // $current->timezone('Asia/Phnom_Penh');
        // $invtime = date("H:i:s",strtotime($current));
        $count=0;

        foreach ($request->curid_closelist as $key => $value) {
            $c=Currency::find($value);
            $c->ratebuy_closelist=str_replace(',','',$request->buy_closelist[$key]);
            $c->ratesale_closelist=str_replace(',','',$request->sale_closelist[$key]);
            $c->save();
            ++$count;
        }
        if($count>0){
            return response()->json(['success'=>'true','message'=>'rate have been set successfully.']);
        }else{
            return response()->json(['success'=>'true','message'=>'no rate set.']);
        }

    }
    public function setrate(Request $request)
    {
        //return($request->all());
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $count=0;
        $selcomid=Session('log_into_company_id');
        foreach ($request->curid as $key => $value) {
            // if($request->txtchk[$key]=='true'){
                $exchangerate=array(
                'currency_id'=>$value,
                'user_id'=>Auth::id(),
                'dd'=>$current,
                'tt'=>$invtime,
                'buy'=>str_replace(',','',$request->buy[$key]),
                'sale'=>str_replace(',','',$request->sale[$key]),
                'ratebuy'=>str_replace(',','',$request->ratebuy[$key]),
                'ratesale'=>str_replace(',','',$request->ratesale[$key]),
                'company_id'=>$selcomid,
                'created_at'=>$current,
                'updated_at'=>$current
                );
                ExchangeRate::insert($exchangerate);
                $c=Currency::find($value);
                $c->buy=str_replace(',','',$request->buy[$key]);
                $c->sale=str_replace(',','',$request->sale[$key]);
                $c->ratebuy=str_replace(',','',$request->ratebuy[$key]);
                $c->ratesale=str_replace(',','',$request->ratesale[$key]);
                $c->save();

                if($request->ispandp[$key]==1){
                    $pattern1 = "/(THB|Baht)/i";
                    $pattern2 = "/(VND|Dong)/i";
                    $shortcut=$request->shortcut[$key];
                    $shortcut1='';
                    $c1='';
                    $c2='';
                    if(preg_match($pattern1,$shortcut)===1){
                        $shortcut1='THB';
                    }elseif(preg_match($pattern2,$shortcut)===1){
                        $shortcut1='VND';
                    }
                    if($shortcut=='KHR-THB'){
                        $c1='KHR-THB';
                        $c2='THB-KHR';
                    }else if($shortcut=='THB-KHR'){
                        $c1='THB-KHR';
                        $c2='KHR-THB';
                    }else if($shortcut=='VND-KHR'){
                        $c1='VND-KHR';
                        $c2='KHR-VND';
                    }else if($shortcut=='KHR-VND'){
                        $c1='KHR-VND';
                        $c2='VND-KHR';
                    }
                    // $c1=$shortcut . '-KHR';
                    // $c2='KHR-' . $shortcut;

                    // $khrbath=0;
                    // $bathkhr=0;
                    // if($shortcut=='THB'){
                    //   $thai_rate=ThaiRate::where('curname','KHR')->first();
                    //   $khrbath=$thai_rate->buy;
                    //   $bathkhr=$thai_rate->sale;
                    // }

                    if($shortcut1=='THB'){
                        DB::table('product_rates')->where('pshortcut',$c1)->where('company_id',$selcomid)->update(['rate'=>str_replace(',','',$request->ratebuy[$key])]);
                        DB::table('product_rates')->where('pshortcut',$c2)->where('company_id',$selcomid)->update(['rate'=>str_replace(',','',$request->ratesale[$key])]);
                    }
                    if($shortcut1=='VND'){
                        DB::table('product_rates')->where('pshortcut',$c1)->where('company_id',$selcomid)->update(['rate'=>str_replace(',','',$request->ratebuy[$key])]);
                        DB::table('product_rates')->where('pshortcut',$c2)->where('company_id',$selcomid)->update(['rate'=>str_replace(',','',$request->ratesale[$key])]);
                    }
                }

                ++$count;
           // }

        }
        if($count>0){
            //event(new RefreshPageEvent('hi from laravel reverb'));
            return response()->json(['success'=>'true','message'=>'rate have been set successfully.']);
        }else{
            return response()->json(['success'=>'true','message'=>'no rate set.']);
        }

    }
    public function setratethai(Request $request)
    {
        //return($request->all());
        $selcomid=Session('log_into_company_id');
        $c1='THB-KHR';
        $c2='KHR-THB';
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $count=0;
        foreach ($request->curname as $key => $value) {

                $exchangerate=array(
                'curname'=>$value,
                'user_id'=>Auth::id(),
                'dd'=>$current,
                'tt'=>$invtime,
                'buy'=>str_replace(',','',$request->buy[$key]),
                'sale'=>str_replace(',','',$request->sale[$key]),
                'exchangetype'=>$request->exchangetype,
                'company_id'=>$selcomid,
                'created_at'=>$current,
                'updated_at'=>$current
                );
                ThaiRateSet::insert($exchangerate);
                DB::table('thai_rates')->where('curname',$value)->where('company_id',$selcomid)->where('exchangetype',$request->exchangetype)
                ->update([
                    'buy'=>str_replace(',','',$request->buy[$key]),
                    'sale'=>str_replace(',','',$request->sale[$key]),
                    'updated_at'=>$current,
                ]);
                if($request->exchangetype=='THAI'){
                    DB::table('currencies')->where('shortcut',$value)->where('company_id',$selcomid)->update(['buy_thai'=>str_replace(',','',$request->buy[$key]),'sale_thai'=>str_replace(',','',$request->sale[$key])]);
                    if($value=='KHR'){
                        DB::table('product_rates')->where('pshortcut',$c1)->where('company_id',$selcomid)->update(['thai_rate'=>str_replace(',','',$request->buy[$key])]);
                        DB::table('product_rates')->where('pshortcut',$c2)->where('company_id',$selcomid)->update(['thai_rate'=>str_replace(',','',$request->sale[$key])]);
                    }
                }

                ++$count;

        }
        if($count>0){
            return response()->json(['success'=>'true','message'=>'rate have been set.']);
        }else{
            return response()->json(['success'=>'true','message'=>'no rate set.']);
        }

    }

    public function ratedisplay()
    {
        $thai_usd=ThaiRate::where('curname','=','USD')->first();
        $thai_khr=ThaiRate::where('curname','=','KHR')->first();
        $company=Company::orderBy('id')->first();
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->orderBy('no')->get();
        $curdate=Currency::max('updated_at');
        $curdate1=ExchangeRate::max('updated_at');
        $curdate2=ThaiRateSet::max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        return view('currencies.ratedisplay',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
    }
    public function ratedisplayforcustomer()
    {
        if (isset($_COOKIE['company_id_cookie'])) {
            $selcomid = $_COOKIE['company_id_cookie'];

        } else {

            $selcomid=Session('log_into_company_id');
        }

        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
         $thai_usd=ThaiRate::where('curname','=','USD')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();
         $thai_khr=ThaiRate::where('curname','=','KHR')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();
         $thai_usd_khr=ThaiRate::where('curname','=','USD-KHR')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();
         if($thai_khr){
             $updated_at=$thai_khr->updated_at;
         }else{
            $updated_at=$current;
         }

        $bank_khr=ThaiRate::where('curname','=','KHR')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
        $bank_thb=ThaiRate::where('curname','=','THB')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
        $bank_vnd=ThaiRate::where('curname','=','VND')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();

        $company=Company::where('id',$selcomid)->orderBy('id')->first();
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();

        $curdate=Currency::where('company_id',$selcomid)->max('updated_at');
        $curdate1=ExchangeRate::where('company_id',$selcomid)->max('updated_at');
        $curdate2=ThaiRateSet::where('company_id',$selcomid)->max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        if(config('helper.transfer_option') == 'thorn'){
            return view('currencies.ratedisplayforthorn2',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'norn'){
            return view('currencies.ratedisplayfornorn2',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'spn'){
            return view('currencies.ratedisplayforspn2',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'chivra'){
            return view('currencies.ratedisplayforchivra',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'lpk'){
            return view('currencies.ratedisplayforlpk',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'kuongkea'){
            return view('currencies.ratedisplayforkuongkea',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else{
            return view('currencies.ratedisplayforcustomer',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate'));
        }
    }

    public function ratedisplayforcustomer_sendToSocial()
{
    // 🔥 STEP 1 — Get the same data as your existing render function
    if (isset($_COOKIE['company_id_cookie'])) {
        $selcomid = $_COOKIE['company_id_cookie'];
    } else {
        $selcomid = Session('log_into_company_id');
    }

    $current = Carbon::now();
    $current->timezone('Asia/Phnom_Penh');

    $thai_usd = ThaiRate::where('curname', 'USD')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();
    $thai_khr = ThaiRate::where('curname', 'KHR')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();
    $thai_usd_khr = ThaiRate::where('curname', 'USD-KHR')->where('exchangetype','THAI')->where('company_id',$selcomid)->first();

    $updated_at = $thai_khr ? $thai_khr->updated_at : $current;

    $bank_khr = ThaiRate::where('curname','KHR')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
    $bank_thb = ThaiRate::where('curname','THB')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
    $bank_vnd = ThaiRate::where('curname','VND')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();

    $company = Company::where('id',$selcomid)->first();

    $cur1 = Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
    $cur2 = Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
    $cur3 = Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();

    $curdate = Currency::where('company_id',$selcomid)->max('updated_at');
    $curdate1 = ExchangeRate::where('company_id',$selcomid)->max('updated_at');
    $curdate2 = ThaiRateSet::where('company_id',$selcomid)->max('updated_at');

    $today = date('Y-m-d', strtotime($current));
    $maxdate = max([$curdate, $curdate1, $curdate2, $today]);


    // 🔥 STEP 2 — Render your table to HTML

    $htmlContent = view('currencies.ratedisplayforlpk_khmer', compact(
        'cur1','cur2','cur3',
        'bank_khr','bank_thb','bank_vnd',
        'thai_usd','thai_khr','thai_usd_khr',
        'company','maxdate','updated_at'
    ))->render();


    // Wrap inside a screenshot-friendly plain layout
    $fullHtml = "
    <html>
    <head>
    <meta charset='utf-8'>
    <style>
        body { background: white; padding: 20px; font-family: Arial; }
        table { font-size: 28px; }
    </style>
    </head>
    <body>
        $htmlContent
    </body>
    </html>
    ";


    // 🔥 STEP 3 — Convert HTML → PNG Image
    $filename = 'rate_table_'.time().'.png';
    $path = storage_path('app/public/'.$filename);

    Browsershot::html($fullHtml)
        //->windowSize(1250, 1120)//4currencies
        ->windowSize(1250, 970)//3currencies

        ->deviceScaleFactor(2)
        ->save($path);


    // 🔥 STEP 4 — Send to Telegram
    $telegram = $this->sendToTelegramGroup($path);

    // 🔥 STEP 5 — Send to Facebook Page Inbox
    //$facebook = $this->sendToFacebookPage($path);


    return response()->json([
        'success' => true,
        'telegram_result' => $telegram,
        //'facebook_result' => $facebook,
        'image' => url('storage/'.$filename)
    ]);
}

    protected function sendToTelegramGroup($imagePath)
{
    if(config('helper.transfer_option') == 'kuongkea'){
        $token = config('services.kuongkea.bot_token');
        $chatId = config('services.kuongkea.chat_id');
    }else{
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

    }

    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->post("https://api.telegram.org/bot$token/sendPhoto", [
            'multipart' => [
                ['name' => 'chat_id', 'contents' => $chatId],
                ['name' => 'photo', 'contents' => fopen($imagePath, 'r')],
                ['name' => 'caption', 'contents' => 'Rate Display Updated']
            ]
        ]);

        return json_decode($response->getBody(), true);
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
protected function sendToFacebookPage($imagePath)
{
    $pageToken = config('services.facebook.verify_token');
    $recipientId = config('services.facebook.page_id');

    $client = new \GuzzleHttp\Client();

    try {
        $response = $client->post("https://graph.facebook.com/v21.0/me/messages?access_token=$pageToken", [
            'multipart' => [
                [
                    'name' => 'recipient',
                    'contents' => json_encode(['id' => $recipientId]),
                ],
                [
                    'name' => 'message',
                    'contents' => json_encode([
                        'attachment' => [
                            'type' => 'image',
                            'payload' => []
                        ]
                    ])
                ],
                [
                    'name' => 'filedata',
                    'contents' => fopen($imagePath, 'r'),
                    'filename' => 'rate_table.png'
                ]
            ],
        ]);

        return json_decode($response->getBody(), true);
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}



    public function ratedisplayrightsidebar1()
    {
        $selcomid=Session('log_into_company_id');
        $curleft=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('company_id',$selcomid)->orderBy('no')->get();
        $thais=ThaiRate::where('exchangetype','THAI')->where('company_id',$selcomid)->get();
        return view('currencies.ratedisplayrightsidebar1',compact('curleft','thais'));

    }
    public function ratedisplayrightsidebar()
    {
        $selcomid=Session('log_into_company_id');
        $thai_usd=ThaiRate::where('curname','=','USD')->where('company_id',$selcomid)->first();
        $thai_khr=ThaiRate::where('curname','=','KHR')->where('company_id',$selcomid)->first();
        $company=Company::where('company_id',$selcomid)->orderBy('id')->first();
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();

        $curdate=Currency::where('company_id',$selcomid)->max('updated_at');
        $curdate1=ExchangeRate::where('company_id',$selcomid)->max('updated_at');
        $curdate2=ThaiRateSet::where('company_id',$selcomid)->max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        return view('currencies.ratedisplayrightsidebar',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
    }
    public function ratedisplaytv()
    {
        if (isset($_COOKIE['company_id_cookie'])) {
            $selcomid = $_COOKIE['company_id_cookie'];

        } else {

            $selcomid=Session('log_into_company_id');
        }

        $thai_usd=ThaiRate::where('curname','USD')->where('company_id',$selcomid)->first();
        $thai_khr=ThaiRate::where('curname','KHR')->where('company_id',$selcomid)->first();
        $company=Company::find($selcomid);
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $curdate=Currency::where('company_id',$selcomid)->max('updated_at');
        $curdate1=ExchangeRate::where('company_id',$selcomid)->max('updated_at');
        $curdate2=ThaiRateSet::where('company_id',$selcomid)->max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
         if(config('helper.transfer_option') == 'chivra'){
             return view('currencies.ratedisplaytv',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
        }else if(config('helper.transfer_option') == 'lpk'){
            return view('currencies.fullscreenrateboard05',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
        }else if(config('helper.transfer_option') == 'spn'){
            return view('currencies.spntv',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
        }else if(config('helper.transfer_option') == 'kuongkea'){
            return view('currencies.fullscreenrateboardkuongkea',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));
        }else{
             return view('currencies.fullscreenrateboard',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));

         }
        //return view('currencies.ratedisplaytv_thorn2',compact('cur1','cur2','cur3','thai_usd','thai_khr','company','maxdate'));

    }
    public function refreshdisplayrate()
    {
        $company=Company::orderBy('id')->first();
        $thai_usd=ThaiRate::where('curname','USD')->first();
        $thai_khr=ThaiRate::where('curname','KHR')->first();
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->orderBy('no')->get();
        $curdate=Currency::max('updated_at');
        $curdate1=ExchangeRate::max('updated_at');
        $curdate2=ThaiRateSet::max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        return view('currencies.ratedisplay1',compact('cur1','cur2','cur3','thai_usd','thai_khr','maxdate','company'));
    }
    public function refreshdisplayrateforcustomer()
    {
        $selcomid=Session('log_into_company_id');
        $company=Company::find($selcomid);
        $thai_usd=ThaiRate::where('curname','USD')->where('company_id',$selcomid)->where('exchangetype','THAI')->first();
        $thai_khr=ThaiRate::where('curname','KHR')->where('company_id',$selcomid)->where('exchangetype','THAI')->first();
        $thai_usd_khr=ThaiRate::where('curname','=','USD-KHR')->where('company_id',$selcomid)->where('exchangetype','THAI')->first();
        if($thai_khr){
            $updated_at=$thai_khr->updated_at;
        }
        $bank_khr=ThaiRate::where('curname','=','KHR')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
        $bank_thb=ThaiRate::where('curname','=','THB')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
        $bank_vnd=ThaiRate::where('curname','=','VND')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();

        $curdate=Currency::where('company_id',$selcomid)->max('updated_at');
        $curdate1=ExchangeRate::where('company_id',$selcomid)->max('updated_at');
        $curdate2=ThaiRateSet::where('company_id',$selcomid)->max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        $updated_at=$maxdate;
        if(config('helper.transfer_option') == 'thorn'){
            return view('currencies.ratedisplayforthorn3',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else if(config('helper.transfer_option') == 'norn'){
            return view('currencies.ratedisplayfornorn3',compact('cur1','cur2','cur3','bank_khr','bank_thb','bank_vnd','thai_usd','thai_khr','thai_usd_khr','company','maxdate','updated_at'));
        }else{
            return view('currencies.ratedisplayforcustomer1',compact('cur1','cur2','cur3','thai_usd','thai_khr','maxdate','company'));
        }
    }
    public function refreshdisplayratetv()
    {
        $selcomid=Session('log_into_company_id');
        $company=Company::find($selcomid);
        $thai_usd=ThaiRate::where('curname','=','USD')->where('company_id',$selcomid)->first();
        $thai_khr=ThaiRate::where('curname','=','KHR')->where('company_id',$selcomid)->first();
        $thai_usd_khr=ThaiRate::where('curname','=','USD-KHR')->where('company_id',$selcomid)->first();
        if($thai_khr){
            $updated_at=$thai_khr->updated_at;
        }

       $bank_khr=ThaiRate::where('curname','=','KHR')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
       $bank_thb=ThaiRate::where('curname','=','THB')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();
       $bank_vnd=ThaiRate::where('curname','=','VND')->where('exchangetype','BANK')->where('company_id',$selcomid)->first();

        $cur1=Currency::where('active',1)->where('ismain',0)->where('lmr','l')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur2=Currency::where('active',1)->where('ismain',0)->where('lmr','m')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $cur3=Currency::where('active',1)->where('ismain',0)->where('lmr','r')->where('iscustomerdisplay',1)->where('company_id',$selcomid)->orderBy('no')->get();
        $curdate=Currency::where('company_id',$selcomid)->max('updated_at');
        $curdate1=ExchangeRate::where('company_id',$selcomid)->max('updated_at');
        $curdate2=ThaiRateSet::where('company_id',$selcomid)->max('updated_at');
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $today=date('Y-m-d',strtotime($current));
        $maxdate=$current;
        if($curdate>$curdate1){
            $maxdate=$curdate;
        }else{
            $maxdate=$curdate1;
        }
        if($maxdate<$curdate2){
            $maxdate=$curdate2;
        }
        if($maxdate<$today){
            $maxdate=$today;
        }
        return view('currencies.ratedisplaytv1',compact('cur1','cur2','cur3','thai_usd','thai_khr','maxdate','company'));
    }
    public function checkrefreshpagedisplayrate(){
        if (isset($_COOKIE['company_id_cookie'])) {
            $selcomid = $_COOKIE['company_id_cookie'];
        } else {
            $selcomid=Session('log_into_company_id');
        }

        $id1=0;
        $id2=0;
        $id3=0;
        $exrateid1=ExchangeRate::where('company_id',$selcomid)->select('id')->orderBy('id','desc')->first();
        $exrateid2=ExchangeRateProduct::where('company_id',$selcomid)->select('id')->orderBy('id','desc')->first();
        $thairate=ThaiRateSet::where('company_id',$selcomid)->select('id')->orderBy('id','desc')->first();
        if($exrateid1<>null){
            $id1=$exrateid1->id;
        }
        if($exrateid2<>null){
            $id2=$exrateid2->id;
        }
        if($thairate<>null){
            $id3=$thairate->id;
        }
        $sumid=$id1 + $id2 + $id3;

        return response()->json(['maxid'=>$sumid]);

    }
    public function checkcurrencyproduct(Request $request){
        $selcomid=Session('log_into_company_id');
        $p=ProductRate::where('pshortcut',$request->cur)->where('company_id',$selcomid)->exists();
        return response()->json(['exists'=>$p]);
    }
    public function savepexchangep(Request $request){
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selcur1' => 'required|',
            'selcur2' => 'required|',
            'ppsign' => 'required|',
            'p_rate'=>'required|',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $c1c2=$request->selcur1 . '-' . $request->selcur2;
            $p=new ProductRate();
            $p->pshortcut=$c1c2;
            $p->rate=str_replace(',','',$request->p_rate) ;
            $p->operator=$request->ppsign;
            $p->user_id=Auth::user()->id;
            $p->created_at=$current;
            $p->updated_at=$current;
            $p->company_id=$selcomid;
            if($p->save()){
                return response()->json(['success'=>'rate have been save']);
            }else{
                return response()->json(['error'=>'save error']);
            }
        }

    }
    public function update_currency_button(Request $request)
    {
        //return $request->all();
        $cb=CurrencyButton::find($request->id);
        $cb->no=$request->no;
        if($cb->save()){
            return response()->json(['success'=>'currency button no updated']);
        }else{
            return response()->json(['error'=>'update currency button error']);
        }
    }
    public function saveexchangebutton(Request $request){
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $validator = Validator::make($request->all(), [
            'selcur8' => 'required',
            'selcur9' => 'required',
            'button_no' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $id12=$request->selcur8 . '-' . $request->selcur9;
            $p=new CurrencyButton();
            $p->btnname=$request->shortcut2;
            $p->id12=$id12;
            $p->no=$request->button_no;
            $p->company_id=$selcomid;
            $p->created_at=$current;
            $p->updated_at=$current;

            if($p->save()){
                $curbuttons=CurrencyButton::where('company_id',$selcomid)->orderBy('no')->get();
                return response()->json(['success'=>'button has been set','currencybuttons'=>$curbuttons]);
            }else{
                return response()->json(['error'=>'save error']);
            }
        }

    }
    public function getcurrencybutton()
    {
        $selcomid=Session('log_into_company_id');
        $curbuttons=CurrencyButton::where('company_id',$selcomid)->orderBy('no')->get();
        return response()->json(['currencybuttons'=>$curbuttons]);
    }
    public function currencylist(Request $request)
    {
        //return $request->all();
        $active=$request->active;
        if($request->company=='all'){
            $currencies=Currency::where('active',$active);
        }else{
            $currencies=Currency::where('active',$active)->where('company_id',$request->company);
        }
        if($request->viewcol<>''){
            $currencies=$currencies->where('lmr',$request->viewcol);
        }
        $currencies=$currencies->orderBy('no')->get();
        return view("currencies.currencylist",compact('currencies','active'));
    }
    public function productlist(Request $request)
    {
        //return $request->all();
        $selcomid=Session('log_into_company_id');
        $pls=ProductRate::where('company_id',$selcomid)->get();
        return view("currencies.productlist",compact('pls'));
    }
    public function getcurrencynumber(){
        $maxno=DB::table('currencies')->max('no');
        return response()->json(['maxno'=>$maxno]);
    }
    public function currencyedit(Request $request)
    {
        $id=$request->id;
        $currency=Currency::find($id);
        return response()->json(['currency'=>$currency]);
    }
    public function createcurrency(Request $request)
    {
         //return($request->all());
        $ismain = $request->ismaincur?1:0;
        $isfn = $request->isfn?1:0;
        $isactive = $request->isactive?1:0;
        $ispandp=$request->ispandp?1:0;
        $partner_cur=$request->ispartnercurrency?1:0;
        $iscustomerdisplay=$request->iscustomerdisplay?1:0;
        $isgold = $request->isgold?1:0;
        // $validator = Validator::make($request->all(), [
        //     'curname' => 'required|unique:currencies,curname',
        //     'shortcut' => 'required|unique:currencies,shortcut',
        //     'skey' => 'required|unique:currencies,skey',
        //     'ratio' => 'required|',
        //     'optsign' => 'required|',
        //     'buy'=>'required',
        //     'sale'=>'required',
        //     'no'=>'required',
        //     'decpoint'=>'required',
        //     'company'=>'required'
        // ]);
        $companyId=$request->company;
        $validator = Validator::make($request->all(), [
            'curname' => [
                'required',
                Rule::unique('currencies')->where(function ($query) use ($companyId) {
                    return $query->where('company_id', $companyId);
                }),
            ],
            'shortcut' => [
                'required',
                Rule::unique('currencies')->where(function ($query) use ($companyId) {
                    return $query->where('company_id', $companyId);
                }),
            ],
            'skey' => [
                'required',
                Rule::unique('currencies')->where(function ($query) use ($companyId) {
                    return $query->where('company_id', $companyId);
                }),
            ],
            'ratio' => 'required',
            'optsign' => 'required',
            'buy' => 'required',
            'sale' => 'required',
            'no' => 'required',
            'decpoint' => 'required',
            'company' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            // $invtime = date("H:i:s",strtotime($current));
            // $date = str_replace('/', '-', $request->invdate);
            // $invdate= date('Y-m-d', strtotime($date));

            $c=new Currency();
            $c->company_id=$request->company;
            $c->user_id=Auth::user()->id;
            $c->no=$request->no;
            $c->curname=$request->curname;
            $c->shortcut=$request->shortcut;
            $c->sk=$request->shortcut1;
            $c->skey=$request->skey;
            $c->optsign=$request->optsign;
            $c->ratio=$request->ratio;
            $c->isfn=$isfn;
            $c->ismain=$ismain;
            $c->ispandp=$ispandp;
            $c->partner_cur=$partner_cur;
            $c->iscustomerdisplay=$iscustomerdisplay;
            $c->decpoint=$request->decpoint;
            $c->buy=str_replace(',','',$request->buy);
            $c->sale=str_replace(',','',$request->sale);
            $c->ratebuy=str_replace(',','',$request->ratebuy);
            $c->ratesale=str_replace(',','',$request->ratesale);
            $c->lmr=$request->lmr;
            $c->imglocation=$request->circleleft;
            $c->lomeang=$request->lomeang;
            $c->isgold=$isgold;
            $c->tuochek=$request->tuochek??1;
            if($request->seluserconnect){
                $c->user_connect=implode(',',$request->seluserconnect);
              }
            $c->created_at=$current;
            $c->updated_at=$current;

            $imgname='';

            if($request->hasFile('image')){
                    $image = $request->file('image');
                    $imgname = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('myimages'), $imgname);
                    $c->imgpath=$imgname;
            }else{
                if($request->clickcapture==1){
                    $imgname=$request->valphotocapture;
                    $folderPath = "public/myimages/";
                    $image_paths = explode(";base64,", $imgname);

                    $image_base64 = base64_decode($image_paths[1]);
                    $filename = uniqid() . '.jpg';
                    $file = $folderPath . $filename;
                    file_put_contents($file, $image_base64);
                    $c->imgpath=$filename;
                }else{
                    $c->imgpath=$imgname;
                }

            }
            if($c->save()){
               // $this->updatecustomer(Request);
                return response()->json(['success'=>'Save New loan Completed.']);
            }

        }
    }
    public function updatecurrencyno(Request $request)
    {
        $c=Currency::find($request->curid);
        $c->no=$request->no;
        $v=$c->save();
        return response()->json(['v'=>$v]);
    }
    public function updatecurrency(Request $request)
    {
     //return($request->all());
     //$l= Loan::findOrFail($request->product_id);
     $c=Currency::where('id',$request->curid)->first();
     if($c==null){
         return response()->json(['error'=>'currency not found']);
     }

        // $validator = Validator::make($request->all(), [
        //     'curname' => 'required|unique:currencies,curname,'.$c->id.',id',
        //     'shortcut' => 'required|unique:currencies,shortcut,'.$c->id.',id',
        //     'skey' => 'required|unique:currencies,skey,'.$c->id.',id',
        //     'ratio' => 'required|',
        //     'optsign' => 'required|',
        //     'buy'=>'required',
        //     'sale'=>'required',
        //     'no'=>'required',
        //     'decpoint'=>'required',
        //     'company'=>'required'
        // ]);

        $companyId=$request->company;
        $validator = Validator::make($request->all(), [
        'curname' => [
            'required',
            Rule::unique('currencies', 'curname')
                ->where('company_id',$companyId)
                ->ignore($c->id)
        ],
        'shortcut' => [
            'required',
            Rule::unique('currencies', 'shortcut')
                ->where('company_id',$companyId)
                ->ignore($c->id)
        ],
        'skey' => [
            'required',
            Rule::unique('currencies', 'skey')
                ->where('company_id',$companyId)
                ->ignore($c->id)
        ],
        'ratio' => 'required',
        'optsign' => 'required',
        'buy' => 'required',
        'sale' => 'required',
        'no' => 'required',
        'decpoint' => 'required',
        'company' => 'required'
    ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }else{
            $ismain = $request->ismaincur?1:0;
            $isfn = $request->isfn?1:0;
            $isactive = $request->isactive?1:0;
            $ispandp = $request->ispandp?1:0;
            $partner_cur = $request->ispartnercurrency?1:0;
            $iscustomerdisplay=$request->iscustomerdisplay?1:0;
            $current = Carbon::now();
            $current->timezone('Asia/Phnom_Penh');
            $c->company_id=$request->company;
            $c->no=$request->no;
            $c->curname=$request->curname;
            $c->shortcut=$request->shortcut;
            $c->sk=$request->shortcut1;
            $c->skey=$request->skey;
            $c->optsign=$request->optsign;
            $c->ratio=$request->ratio;
            $c->isfn=$isfn;
            $c->ismain=$ismain;
            $c->ispandp=$ispandp;
            $c->partner_cur=$partner_cur;
            $c->iscustomerdisplay=$iscustomerdisplay;
            $c->decpoint=$request->decpoint;
            $c->buy=str_replace(',','',$request->buy);
            $c->sale=str_replace(',','',$request->sale);
            $c->ratebuy=str_replace(',','',$request->ratebuy);
            $c->ratesale=str_replace(',','',$request->ratesale);
            $c->lmr=$request->lmr;
            $c->user_connect='';
            $c->lomeang=$request->lomeang;
            $c->isgold=$request->isgold?1:0;
            $c->tuochek=$request->tuochek??1;
            if($request->seluserconnect){
                $c->user_connect=implode(',',$request->seluserconnect);
            }
            $c->imglocation=$request->circleleft;
            $c->updated_at=$current;
            if($request->old_image==null){
                $old_image='';
            }else{
                $old_image=$request->old_image;
            }

            if($request->clickcapture==1){
                File::delete(public_path('myimages/'.$old_image));
                $imgname=$request->valphotocapture;
                $folderPath = "public/myimages/";
                $image_paths = explode(";base64,", $imgname);
                $image_base64 = base64_decode($image_paths[1]);
                $filename = uniqid() . '.jpg';
                $file = $folderPath . $filename;
                file_put_contents($file, $image_base64);
                $c->imgpath=$filename;
            }else{
                $image=$request->file('image');

                if($image){
                  File::delete(public_path('myimages/'.$old_image));
                  $imgname=time().'-'.$image->getClientOriginalName();
                  $image->move(public_path('myimages/'),$imgname);
                }else
                  {
                      $imgname=$old_image;
                  }
                $c->imgpath=$imgname;
            }
            if($c->save()){

                return response()->json(['success'=>'Update Completed.']);
            }
        }
    }

    public function deletecurrency(Request $request)
{
    // Find the currency by its ID or fail
    $currency = Currency::findOrFail($request->id);

    // Check the status from the request
    if ($request->status == 1) {
        // If status is 1, deactivate the currency
        $currency->active = 0;
        if ($currency->save()) {
            // Return success response if the update was successful
            return response()->json(['success' => true, 'message' => 'The currency has been deactivated.']);
        } else {
            // Return failure response if the update failed
            return response()->json(['success' => false, 'message' => 'Failed to deactivate the currency.']);
        }
    } else {
        // If status is not 1, delete the currency permanently
        if ($currency->delete()) {
            // Return success response if the deletion was successful
            return response()->json(['success' => true, 'message' => 'The currency has been permanently deleted.']);
        } else {
            // Return failure response if the deletion failed
            return response()->json(['success' => false, 'message' => 'Failed to delete the currency.']);
        }
    }
}
    public function deletecurrencybutton(Request $request)
    {
        $cb=CurrencyButton::find($request->id);
        if($cb->delete()){
            return response()->json(['success'=>true,'message'=>'this currency button has been removed.']);
        }
    }
    public function restorecurrency(Request $request)
    {
        //return $request->all();
        $c=Currency::where('id',$request->id)->first();
        $c->active=1;
        if($c->save()){

            return response()->json(['success'=>true,'message'=>'this currency has been restore.']);
        }

    }
    public function deleteproduct(Request $request)
    {
        //return $request->all();
        $c=ProductRate::where('id',$request->id)->delete();

        if($c){

            return response()->json(['success'=>true,'message'=>'this product has been removed.']);
        }
    }
    public function updateproduct(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $c=ProductRate::find($request->id);

        if($c){
            $c->rate=$request->rate;
            $c->operator=$request->sign;
            $c->user_id=Auth::user()->id;
            $c->updated_at=$current;
            $c->save();
            return response()->json(['success'=>true,'message'=>'this product has been update.']);
        }
    }
    public function updateallpprate(Request $request)
    {
        //return $request->all();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $invtime = date("H:i:s",strtotime($current));
        $countrow=count($request->productid)-1;
        for($key=0;$key<=$countrow;$key++){
            $p=ProductRate::find($request->productid[$key]);
            $p->rate=str_replace(',','',$request->pprate[$key]);
            $p->operator=$request->ppoperator[$key];
            $p->save();
            $exchangerate=array(
                'currencyname'=>$request->ppshortcut[$key],
                'user_id'=>Auth::id(),
                'dd'=>$current,
                'tt'=>$invtime,
                'rate'=>str_replace(',','',$request->pprate[$key]),
                'created_at'=>$current,
                'updated_at'=>$current
                );
                ExchangeRateProduct::insert($exchangerate);
        }
        return response()->json(['success'=>'products has been update.']);
    }
}
