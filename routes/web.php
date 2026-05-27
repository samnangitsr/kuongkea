<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Models\CustomerExchangeCapture;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CaptureController;
use App\Http\Controllers\FacebookWebhookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/success', [FacebookWebhookController::class, 'success']);
Route::get('/facebook/webhook', [FacebookWebhookController::class, 'verify']);
Route::post('/facebook/webhook', [FacebookWebhookController::class, 'receive']);

Route::get('/facerecognit', [CaptureController::class, 'index'])->name('exchange.recognit');;           // webcam page

Route::post('/capture', [CaptureController::class, 'store'])
     ->name('customer.capture');
Route::get('/captures', function () {
    $caps = CustomerExchangeCapture::latest()->take(50)->get();
    return view('captures', compact('caps'));
});
Route::post('/track-time', [App\Http\Controllers\TrackController::class, 'time'])->name('track.time');
Route::post('/user-offline', [App\Http\Controllers\TrackController::class, 'offline'])->name('user.offline');

Route::post('/send-sms', [SMSController::class, 'sendSmsToTelegram']);
//Auth::routes();
Route::group(['middleware'=>['prevent-back-history']],function(){});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chatpage', [App\Http\Controllers\ChatController::class, 'index'])->name('chattest');
Route::get('/verify/{verifyToken}', [App\Http\Controllers\CustomAuth\LoginController::class,'sendEmailDone'])->name('sendEmailDone');
Route::get('/allrate', [App\Http\Controllers\CurrencyController::class,'ratedisplay'])->name('currency.ratedisplay');
Route::get('/getcustomercompany', [App\Http\Controllers\CustomAuth\LoginController::class,'getcustomercompany'])->name('getcustomercompany');
Route::get('/ratedisplayforcustomer', [App\Http\Controllers\CurrencyController::class,'ratedisplayforcustomer'])->name('currency.ratedisplayforcustomer');
Route::get('/ratedisplay/sendtosocialmedia', [App\Http\Controllers\CurrencyController::class, 'ratedisplayforcustomer_sendToSocial'])->name('ratedisplay_sendtosocial');

// Route::get('/',[App\Http\Controllers\CustomAuth\LoginController::class,'showLogin'])->name('showlogin');
Route::get('/', function () {
  return redirect()->route('showlogin');
});
Route::get('/ratedisplayrightsidebar', [App\Http\Controllers\CurrencyController::class,'ratedisplayrightsidebar'])->name('currency.ratedisplayrightsidebar');
Route::get('/ratedisplayrightsidebar1', [App\Http\Controllers\CurrencyController::class,'ratedisplayrightsidebar1'])->name('currency.ratedisplayrightsidebar1');

Route::get('/tv', [App\Http\Controllers\CurrencyController::class,'ratedisplaytv'])->name('currency.ratedisplaytv');
Route::get('/refreshdisplayrate', [App\Http\Controllers\CurrencyController::class,'refreshdisplayrate'])->name('currency.refreshdisplayrate');
Route::get('/refreshdisplayrateforcustomer', [App\Http\Controllers\CurrencyController::class,'refreshdisplayrateforcustomer'])->name('currency.refreshdisplayrateforcustomer');

Route::get('/refreshdisplayratetv', [App\Http\Controllers\CurrencyController::class,'refreshdisplayratetv'])->name('currency.refreshdisplayratetv');
Route::get('/checkrefreshpage', [App\Http\Controllers\CurrencyController::class,'checkrefreshpagedisplayrate'])->name('currency.checkrefreshpage');
Route::get('/savepermuserstorage',[App\Http\Controllers\CustomAuth\LoginController::class,'savepermuserstorage'])->name('savepermuserstorage');

Route::get('/login',[App\Http\Controllers\CustomAuth\LoginController::class,'showLogin'])->name('showlogin');
Route::post('/login',[App\Http\Controllers\CustomAuth\LoginController::class,'checkLogin'])
    ->middleware('throttle:10,1')
    ->name('checklogin');

Route::get('/dashboard',[App\Http\Controllers\CustomAuth\LoginController::class,'showdashboard'])->name('dashboard');
Route::post('/logout',[App\Http\Controllers\CustomAuth\LoginController::class,'getlogout'])->name('logout');
Route::get('/login/getuserbycompany',[App\Http\Controllers\CustomAuth\LoginController::class,'getuserbycompany'])->name('login.getuserbycompany');
// Route::get('/multiselect', function () {
//     return view('closelists.multiselect');
// });

Route::group(['middleware'=>['auth']],function(){
    Route::get('/storage-link', function () {
        try {
            Artisan::call('storage:link');
            return response()->json([
                'message' => 'Storage link created successfully',
                'output' => Artisan::output()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create storage link',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    Route::get('/storage-unlink', function () {
        try {
            $symlinkPath = public_path('storage');

            if (is_link($symlinkPath)) {
                unlink($symlinkPath); // PHP's native unlink function
                return response()->json([
                    'success' => true,
                    'message' => 'Storage symlink deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Symlink not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    });

	Route::get('/getuserright', [App\Http\Controllers\CustomAuth\LoginController::class,'getuser_right'])->name('getuser_right');
	Route::post('/saveuserpermission', [App\Http\Controllers\CustomAuth\LoginController::class,'saveuserpermission'])->name('saveuserpermission');
	Route::post('/updateuserpermission', [App\Http\Controllers\CustomAuth\LoginController::class,'updateuserpermission'])->name('updateuserpermission');
	Route::post('/deleteuserpermission', [App\Http\Controllers\CustomAuth\LoginController::class,'deleteuserpermission'])->name('deleteuserpermission');
	Route::get('/register', [App\Http\Controllers\CustomAuth\LoginController::class,'create'])->name('userregister');
	Route::post('/register', [App\Http\Controllers\CustomAuth\LoginController::class,'store']);
    Route::get('/user/verifyEmailFirst', [App\Http\Controllers\CustomAuth\LoginController::class,'verifyEmailFirst'])->name('verifyEmailFirst');
	Route::post('/saveapplyright', [App\Http\Controllers\CustomAuth\LoginController::class,'saveapplyright'])->name('saveapplyright');
	Route::get('/applyright', [App\Http\Controllers\CustomAuth\LoginController::class,'applyright'])->name('applyright');
    Route::group(['prefix'=>'user'],function(){
        Route::post('/storeuser',[App\Http\Controllers\CustomAuth\LoginController::class,'store'])->name('saveuser');
        Route::post('/updateuser',[App\Http\Controllers\CustomAuth\LoginController::class,'update'])->name('updateuser');
        Route::post('/deleteuser',[App\Http\Controllers\CustomAuth\LoginController::class,'destroy'])->name('deleteuser');
        Route::get('/refreshuser', [App\Http\Controllers\CustomAuth\LoginController::class,'refreshuser'])->name('refreshuser');
        Route::get('/change-password', [App\Http\Controllers\CustomAuth\LoginController::class,'changepassword'])->name('changepwd');
        Route::post('/change-password', [App\Http\Controllers\CustomAuth\LoginController::class,'storepwd'])->name('change.password');
        Route::post('/reset-password', [App\Http\Controllers\CustomAuth\LoginController::class,'resetpassword'])->name('resetpwd');
        Route::post('/saveuser_right', [App\Http\Controllers\CustomAuth\LoginController::class,'saveuser_right'])->name('saveuser_right');
        Route::post('/switchstatus', [App\Http\Controllers\CustomAuth\LoginController::class,'switchstatus'])->name('switchstatus');
        Route::post('/switchblock', [App\Http\Controllers\CustomAuth\LoginController::class,'switchblock'])->name('switchblock');
    });
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/currency', [App\Http\Controllers\CurrencyController::class,'currency'])->name('currency.index');
    Route::post('/createcurrency', [App\Http\Controllers\CurrencyController::class,'createcurrency'])->name('createcurrency');
    Route::post('/updatecurrency', [App\Http\Controllers\CurrencyController::class,'updatecurrency'])->name('updatecurrency');
    Route::get('/getcurrencynumber', [App\Http\Controllers\CurrencyController::class,'getcurrencynumber'])->name('getcurrencynumber');
    Route::get('/currencyedit', [App\Http\Controllers\CurrencyController::class,'currencyedit'])->name('currencyedit');
    Route::get('/currencylist', [App\Http\Controllers\CurrencyController::class,'currencylist'])->name('currencylist');
    Route::post('/updatecurrencyno', [App\Http\Controllers\CurrencyController::class,'updatecurrencyno'])->name('updatecurrencyno');
    Route::post('/deletecurrency', [App\Http\Controllers\CurrencyController::class,'deletecurrency'])->name('deletecurrency');
    Route::post('/restorecurrency', [App\Http\Controllers\CurrencyController::class,'restorecurrency'])->name('restorecurrency');
    Route::get('/checkcurrencyproduct', [App\Http\Controllers\CurrencyController::class,'checkcurrencyproduct'])->name('checkcurrencyproduct');
    Route::post('/savepexchangep', [App\Http\Controllers\CurrencyController::class,'savepexchangep'])->name('savepexchangep');
    Route::post('/saveexchangebutton', [App\Http\Controllers\CurrencyController::class,'saveexchangebutton'])->name('saveexchangebutton');
    Route::get('/update_currency_button', [App\Http\Controllers\CurrencyController::class,'update_currency_button'])->name('update_currency_button');
    Route::post('/deletecurrencybutton', [App\Http\Controllers\CurrencyController::class,'deletecurrencybutton'])->name('deletecurrencybutton');

    Route::get('/getcurrencybutton', [App\Http\Controllers\CurrencyController::class,'getcurrencybutton'])->name('getcurrencybutton');
    Route::get('/productlist', [App\Http\Controllers\CurrencyController::class,'productlist'])->name('productlist');
    Route::post('/deleteproduct', [App\Http\Controllers\CurrencyController::class,'deleteproduct'])->name('deleteproduct');
    Route::post('/updateproduct', [App\Http\Controllers\CurrencyController::class,'updateproduct'])->name('updateproduct');
    Route::post('/updateallpprate', [App\Http\Controllers\CurrencyController::class,'updateallpprate'])->name('updateallpprate');
    Route::get('/exchangerate', [App\Http\Controllers\CurrencyController::class,'exchangerate'])->name('currency.exchangerate');
    Route::get('/exchangeratenew', [App\Http\Controllers\CurrencyController::class,'exchangeratenew'])->name('currency.exchangeratenew');
    Route::get('/currencyrate', [App\Http\Controllers\CurrencyController::class,'currencyrate'])->name('currencyrate');
    Route::post('/setrate', [App\Http\Controllers\CurrencyController::class,'setrate'])->name('currency.setrate');
    Route::post('/setratecloselist', [App\Http\Controllers\CurrencyController::class,'setratecloselist'])->name('currency.setratecloselist');

    Route::post('/setratethai', [App\Http\Controllers\CurrencyController::class,'setratethai'])->name('currency.setratethai');
    Route::get('/exchangeratethai', [App\Http\Controllers\CurrencyController::class,'exchangeratethai'])->name('currency.exchangeratethai');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/exchange', [App\Http\Controllers\ExchangeController::class,'index'])->name('exchange.index');
    Route::get('/getcurrencybykey', [App\Http\Controllers\ExchangeController::class,'getcurrencybykey'])->name('getcurrencybykey');
    Route::get('/getcurrencybyshortcut', [App\Http\Controllers\ExchangeController::class,'getcurrencybyshortcut'])->name('getcurrencybyshortcut');
    Route::get('/getcurrencybyshortcut2', [App\Http\Controllers\ExchangeController::class,'getcurrencybyshortcut2'])->name('getcurrencybyshortcut2');
    Route::get('/exchange/refreshdisplayrate', [App\Http\Controllers\ExchangeController::class,'refreshdisplayrateinexchangeform'])->name('exchange.refreshdisplayrate');

    Route::get('/getcurrencybyid', [App\Http\Controllers\ExchangeController::class,'getcurrencybyid'])->name('getcurrencybyid');
    Route::get('/getproductrate', [App\Http\Controllers\ExchangeController::class,'getproductrate'])->name('getproductrate');
    Route::post('/saveexchange', [App\Http\Controllers\ExchangeController::class,'saveexchange'])->name('saveexchange');
    Route::post('/savedepositgold', [App\Http\Controllers\ExchangeController::class,'savedepositgold'])->name('exchange.savedepositgold');

    Route::post('/saveexchangeproduct', [App\Http\Controllers\ExchangeController::class,'saveexchangeproduct'])->name('saveexchangeproduct');
    Route::post('/saveaddlist', [App\Http\Controllers\ExchangeController::class,'saveaddlist'])->name('saveaddlist');
    Route::post('/saveaddlistmulti', [App\Http\Controllers\ExchangeController::class,'saveaddlistmulti'])->name('saveaddlistmulti');
    Route::get('/savecurrencytostorage', [App\Http\Controllers\ExchangeController::class,'savecurrencytostorage'])->name('savecurrencytostorage');
    Route::get('/savecurrencyproducttostorage', [App\Http\Controllers\ExchangeController::class,'savecurrencyproducttostorage'])->name('savecurrencyproducttostorage');

    Route::get('/getmultiexchangelist', [App\Http\Controllers\ExchangeController::class,'getmultiexchangelist'])->name('getmultiexchangelist');
    Route::post('/delete_multiexchangelist', [App\Http\Controllers\ExchangeController::class,'delete_multiexchangelist'])->name('delete_multiexchangelist');
    Route::post('/savemultiexchanges', [App\Http\Controllers\ExchangeController::class,'savemultiexchanges'])->name('savemultiexchanges');
    Route::post('/clearexchangelist', [App\Http\Controllers\ExchangeController::class,'clearexchangelist'])->name('clearexchangelist');
    Route::get('/exchange/print', [App\Http\Controllers\ExchangeController::class,'exchangeprint'])->name('exchangeprint');
    Route::get('/exchange/prints', [App\Http\Controllers\ExchangeController::class,'exchangeprints'])->name('exchangeprints');
    Route::get('/exchangegold/prints', [App\Http\Controllers\ExchangeController::class,'exchangegoldprints'])->name('exchangegoldprints');

    Route::get('/exchangelists', [App\Http\Controllers\ExchangeController::class,'exchangelists'])->name('exchangelists');
    Route::get('/exchangelistsnew', [App\Http\Controllers\ExchangeController::class,'exchangelistsnew'])->name('exchangelistsnew');
    Route::get('/exchangegoldreport', [App\Http\Controllers\ExchangeController::class,'exchangegoldreport'])->name('exchangegoldreport');
    Route::post('/exchangegold/deletelistgroup', [App\Http\Controllers\ExchangeController::class,'exchangegolddeletelistgroup'])->name('exchangegold.deletelistgroup');

    Route::get('/exchangelists/report', [App\Http\Controllers\ExchangeController::class,'exchangelists'])->name('exchangelistsreport');
    Route::get('/exchangegoldreport/showpaymentdetail', [App\Http\Controllers\ExchangeController::class,'showgoldpaymentdetail'])->name('exchangegoldreport.showpaymentdetail');
    Route::post('/deleteexchange', [App\Http\Controllers\ExchangeController::class,'deleteexchange'])->name('deleteexchange');
    Route::get('/getexchangelist', [App\Http\Controllers\ExchangeController::class,'getexchangelist'])->name('getexchangelist');
    Route::get('/getexchangelistnew', [App\Http\Controllers\ExchangeController::class,'getexchangelistnew'])->name('getexchangelistnew');
    Route::get('/getexchangelistgold', [App\Http\Controllers\ExchangeController::class,'getexchangelistgold'])->name('getexchangelistgold');
    Route::get('/getcustomerexchangelist', [App\Http\Controllers\ExchangeController::class,'getcustomerexchangelist'])->name('getcustomerexchangelist');
    Route::post('/customerexchangecapture/delete', [App\Http\Controllers\ExchangeController::class,'delcustomerexchangecapture'])->name('customerexchangecapture.delete');
    Route::post('/customerexchangecapture/deleteall', [App\Http\Controllers\ExchangeController::class,'delallcustomerexchangecapture'])->name('customerexchangecapture.deleteall');


    Route::get('/customerexchangelist', [App\Http\Controllers\ExchangeController::class,'customerexchangelist'])->name('customerexchangelist');
    Route::get('/pagetime', [App\Http\Controllers\ExchangeController::class,'pagetime'])->name('pagetime');
    Route::get('/getexchangepagetime', [App\Http\Controllers\ExchangeController::class,'getexchangepagetime'])->name('getexchangepagetime');
    Route::post('/deleteexchange1', [App\Http\Controllers\ExchangeController::class,'deleteexchange'])->name('deleteexchange1');
    Route::get('/getuserpartner', [App\Http\Controllers\ExchangeController::class,'getuserpartner'])->name('getuserpartner');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/invoice', [App\Http\Controllers\InvoiceController::class,'index'])->name('invoice.index');
    Route::get('/invoice/list', [App\Http\Controllers\InvoiceController::class,'invoicelist'])->name('invoice.list');
    Route::get('/invoice/exchangelist', [App\Http\Controllers\InvoiceController::class,'exchangelist'])->name('invoice.exchangelist');
    Route::get('/getinvoiceexchangelist', [App\Http\Controllers\InvoiceController::class,'getinvoiceexchangelist'])->name('getinvoiceexchangelist');
    Route::post('/invoice/store', [App\Http\Controllers\InvoiceController::class,'store'])->name('invoice.store');
    Route::post('/invoice/savetemplist', [App\Http\Controllers\InvoiceController::class,'savetemplist'])->name('invoice.savetemplist');
    Route::post('/invoice/deltemplist', [App\Http\Controllers\InvoiceController::class,'deltemplist'])->name('invoice.deltemplist');
    Route::get('/invoice/gettemplist', [App\Http\Controllers\InvoiceController::class,'gettemplist'])->name('invoice.gettemplist');
    Route::post('/invoice/cleartemplist', [App\Http\Controllers\InvoiceController::class,'cleartemplist'])->name('invoice.cleartemplist');
    Route::get('/invoice/search', [App\Http\Controllers\InvoiceController::class,'searchinvoice'])->name('invoice.search');
    Route::get('/invoice/detail', [App\Http\Controllers\InvoiceController::class,'invoicedetail'])->name('invoice.invoicedetail');
    Route::get('/invoice/showpaymentmodal', [App\Http\Controllers\InvoiceController::class,'showpaymentmodal'])->name('invoice.showpaymentmodal');
    Route::post('/invoice/payment1', [App\Http\Controllers\InvoiceController::class,'payment1'])->name('invoice.payment1');
    Route::post('/invoice/deletepayment', [App\Http\Controllers\InvoiceController::class,'deletepayment'])->name('invoice.deletepayment');
    Route::post('/invoice/delete', [App\Http\Controllers\InvoiceController::class,'delete'])->name('invoice.delete');
    Route::get('/invoice/getinvpaymentbypaymentcode', [App\Http\Controllers\InvoiceController::class,'getinvpaymentbypaymentcode'])->name('invoice.getinvpaymentbypaymentcode');
    Route::get('/invoice/print', [App\Http\Controllers\InvoiceController::class,'invoiceprint'])->name('invoiceprint');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/customer', [App\Http\Controllers\CustomerController::class,'index'])->name('customer.index');
     Route::get('/getthaiaccount', [App\Http\Controllers\CustomerController::class,'getthaiaccount'])->name('getthaiaccount');
     Route::get('/getusercompany', [App\Http\Controllers\CustomerController::class,'getusercompany'])->name('getusercompany');

    Route::get('/customer/closelist', [App\Http\Controllers\CustomerController::class,'closelist'])->name('customer.closelist');
    Route::get('/customer/checkcloselist', [App\Http\Controllers\CustomerController::class,'checkcloselist'])->name('customer.checkcloselist');
    Route::get('/customer/showlist', [App\Http\Controllers\CustomerController::class,'showlist'])->name('customer.showlist');
    Route::get('/customer/getcloselist', [App\Http\Controllers\CustomerController::class,'getcloselist'])->name('customer.getcloselist');
    Route::post('/customer/store', [App\Http\Controllers\CustomerController::class,'store'])->name('customer.store');
    Route::get('/customer/cusname/autocomplete', [App\Http\Controllers\CustomerController::class,'cusnameautocomplete'])->name('cusname.autocomplete');
    Route::post('/customer/savepartneraccount', [App\Http\Controllers\CustomerController::class,'savepartneraccount'])->name('customer.savepartneraccount');
    Route::post('/customer/savecloselist', [App\Http\Controllers\CustomerController::class,'savecloselist'])->name('customer.savecloselist');
    Route::post('/customer/deletecloselist', [App\Http\Controllers\CustomerController::class,'deletecloselist'])->name('customer.deletecloselist');
    Route::get('/customer/searchbytype', [App\Http\Controllers\CustomerController::class,'searchbytype'])->name('customer.searchbytype');
    Route::get('/customer/print', [App\Http\Controllers\CustomerController::class,'print'])->name('customer.print');
    Route::post('/customer/updateno', [App\Http\Controllers\CustomerController::class,'updateno'])->name('customer.updateno');
    Route::post('/customer/delete', [App\Http\Controllers\CustomerController::class,'delete'])->name('customer.delete');
    Route::post('/customer/deleteaccount', [App\Http\Controllers\CustomerController::class,'deleteaccount'])->name('customer.deleteaccount');

    Route::get('/customer/getmaxcustomerno', [App\Http\Controllers\CustomerController::class,'getmaxcustomerno'])->name('customer.getmaxcustomerno');
    Route::get('/customer/getcustomeraccount', [App\Http\Controllers\CustomerController::class,'getcustomeraccount'])->name('customer.getcustomeraccount');
    Route::get('/customer/getiteminfo', [App\Http\Controllers\CustomerController::class,'getiteminfo'])->name('customer.getiteminfo');
    Route::get('/customer/getlocationinfo', [App\Http\Controllers\CustomerController::class,'getlocationinfo'])->name('customer.getlocationinfo');

    Route::post('/customer/storeitem', [App\Http\Controllers\CustomerController::class,'storeitem'])->name('storeitem');
    Route::post('/customer/storeagenttype', [App\Http\Controllers\CustomerController::class,'storeagenttype'])->name('storeagenttype');
    Route::get('/customer/getmainitemlist', [App\Http\Controllers\CustomerController::class,'getmainitemlist'])->name('getmainitemlist');
    Route::get('/customer/readagenttype', [App\Http\Controllers\CustomerController::class,'readagenttype'])->name('readagenttype');
    Route::post('/customer/deleteagenttype', [App\Http\Controllers\CustomerController::class,'deleteagenttype'])->name('deleteagenttype');

    Route::post('/customer/deletemainitem', [App\Http\Controllers\CustomerController::class,'deletemainitem'])->name('deletemainitem');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/child', [App\Http\Controllers\ChildController::class,'index'])->name('child.index');
    Route::get('/address', [App\Http\Controllers\ChildController::class,'address'])->name('address.index');
    Route::post('/address/saveprovince', [App\Http\Controllers\ChildController::class,'saveprovince'])->name('address.saveprovince');
    Route::post('/address/savedistrict', [App\Http\Controllers\ChildController::class,'savedistrict'])->name('address.savedistrict');
    Route::post('/address/savecommune', [App\Http\Controllers\ChildController::class,'savecommune'])->name('address.savecommune');
    Route::post('/address/savevillage', [App\Http\Controllers\ChildController::class,'savevillage'])->name('address.savevillage');
    Route::get('/address/getdistrict', [App\Http\Controllers\ChildController::class,'getdistrict'])->name('address.getdistrict');
    Route::get('/address/getcommune', [App\Http\Controllers\ChildController::class,'getcommune'])->name('address.getcommune');
    Route::get('/address/getvillage', [App\Http\Controllers\ChildController::class,'getvillage'])->name('address.getvillage');
    Route::get('/address/search', [App\Http\Controllers\ChildController::class,'searchaddress'])->name('address.search');
    Route::post('/address/delete', [App\Http\Controllers\ChildController::class,'deleteaddress'])->name('address.delete');
    Route::post('/child/delete', [App\Http\Controllers\ChildController::class,'delete'])->name('child.delete');

    Route::post('/child/store', [App\Http\Controllers\ChildController::class,'store'])->name('child.store');
    Route::get('/child/search', [App\Http\Controllers\ChildController::class,'searchchild'])->name('child.search');
    Route::get('/child/getmaxchildno', [App\Http\Controllers\ChildController::class,'getmaxchildno'])->name('child.getmaxchildno');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/payment', [App\Http\Controllers\PaymentController::class,'index'])->name('payment.index');
    Route::get('/payment/search', [App\Http\Controllers\PaymentController::class,'searchinvoice'])->name('payment.search');
    Route::post('/payment/store', [App\Http\Controllers\PaymentController::class,'store'])->name('payment.store');
    Route::get('/payment/print', [App\Http\Controllers\PaymentController::class,'print'])->name('paymentprint');
    Route::get('/payment/report', [App\Http\Controllers\PaymentController::class,'report'])->name('payment.report');
    Route::get('/payment/report/search', [App\Http\Controllers\PaymentController::class,'searchpayment'])->name('payment.reportsearch');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/banktransfer', [App\Http\Controllers\BankTransferController::class,'index'])->name('banktransfer.index');
    Route::get('/banktransfer/report', [App\Http\Controllers\BankTransferController::class,'report'])->name('banktransfer.report');
    Route::get('/banktransfer/summaryreport', [App\Http\Controllers\BankTransferController::class,'summaryreport'])->name('banktransfer.summaryreport');
    Route::get('/banktransfer/doreportsummary', [App\Http\Controllers\BankTransferController::class,'doreportsummary'])->name('banktransfer.doreportsummary');
    Route::get('/banktransfer/search', [App\Http\Controllers\BankTransferController::class,'search'])->name('banktransfer.search');
    Route::post('/banktransfer/savetransfer', [App\Http\Controllers\BankTransferController::class,'savetransfer'])->name('banktransfer.savetransfer');
    Route::post('/banktransfer/delete', [App\Http\Controllers\BankTransferController::class,'delete'])->name('banktransfer.delete');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/stock', [App\Http\Controllers\StockController::class,'index'])->name('stock.index');
    Route::get('/stockreport', [App\Http\Controllers\StockController::class,'report'])->name('stock.report');
    Route::get('/stockreportbuysale', [App\Http\Controllers\StockController::class,'reportbuysale'])->name('stock.reportbuysale');
    Route::get('/stockreportgoldbuysale', [App\Http\Controllers\StockController::class,'reportgoldbuysale'])->name('stock.buysalegoldreport');
    Route::get('/getstockreportgoldbuysale', [App\Http\Controllers\StockController::class,'getreportgoldbuysale'])->name('stock.getbuysalegoldreport');

    Route::get('/showstockreport', [App\Http\Controllers\StockController::class,'showstockreport'])->name('stock.showstockreport');
    Route::get('/showstockreport1', [App\Http\Controllers\StockController::class,'showstockreport1'])->name('stock.showstockreport1');
    Route::post('/stock/delete', [App\Http\Controllers\StockController::class,'deletestock'])->name('stock.delete');

    Route::post('/stock/store', [App\Http\Controllers\StockController::class,'store'])->name('stock.store');
    Route::get('/showstock', [App\Http\Controllers\StockController::class,'showstock'])->name('stock.showstock');
    Route::get('/stock/editstock', [App\Http\Controllers\StockController::class,'editstock'])->name('stock.editstock');

    Route::post('/stock/saveeditstock', [App\Http\Controllers\StockController::class,'saveeditstock'])->name('stock.saveeditstock');
    Route::post('/stock/saveselectstock', [App\Http\Controllers\StockController::class,'saveselectstock'])->name('stock.saveselectstock');

    Route::get('/getlaststock', [App\Http\Controllers\StockController::class,'getlaststock'])->name('stock.getlaststock');
    Route::get('/viewexchangeprofitdetailbycurrency', [App\Http\Controllers\StockController::class,'viewexchangeprofitdetailbycurrency'])->name('stock.viewexchangeprofitdetailbycurrency');
    Route::get('/viewexchangeprofitdetailbycurrency1', [App\Http\Controllers\StockController::class,'viewexchangeprofitdetailbycurrency1'])->name('stock.viewexchangeprofitdetailbycurrency1');

    Route::get('/stockexchangecur/print', [App\Http\Controllers\StockController::class,'stockexchangecurprint'])->name('stock.stockexchangecurprint');
    Route::get('/stockexchangecur1/print', [App\Http\Controllers\StockController::class,'stockexchangecurprint1'])->name('stock.stockexchangecurprint1');

    Route::get('/stockexchangecurall/print', [App\Http\Controllers\StockController::class,'stockexchangecurallprint'])->name('stock.stockexchangecurallprint');
    Route::get('/selectstock/print', [App\Http\Controllers\StockController::class,'printselectstock'])->name('stock.printselectstock');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/moneytransfer/formtransfer', [App\Http\Controllers\MoneyTransferController::class,'formtransaction'])->name('moneytransfer.formtransfer');
    Route::get('/moneytransfer/banktransfer', [App\Http\Controllers\MoneyTransferController::class,'banktransfer'])->name('moneytransfer.banktransfer');
    Route::get('/moneytransfer/wingtransfer', [App\Http\Controllers\MoneyTransferController::class,'wingtransfer'])->name('moneytransfer.wingtransfer');
    Route::get('/moneytransfer/customertransfer', [App\Http\Controllers\MoneyTransferController::class,'customertransfer'])->name('moneytransfer.customertransfer');
    Route::get('/moneytransfer/quicktransfer', [App\Http\Controllers\MoneyTransferController::class,'quicktransfer'])->name('moneytransfer.quicktransfer');

    Route::get('/moneytransfer/wingedit', [App\Http\Controllers\MoneyTransferController::class,'wingedit'])->name('moneytransfer.wingedit');
    Route::get('/moneytransfer/settransferrate', [App\Http\Controllers\MoneyTransferController::class,'settransferrate'])->name('moneytransfer.settransferrate');
    Route::get('/moneytransfer/gettranname', [App\Http\Controllers\MoneyTransferController::class,'gettranname'])->name('moneytransfer.gettranname');
    Route::post('/moneytransfer/storerateset', [App\Http\Controllers\MoneyTransferController::class,'storerateset'])->name('moneytransfer.storerateset');
    Route::post('/moneytransfer/storetranname', [App\Http\Controllers\MoneyTransferController::class,'storetranname'])->name('moneytransfer.storetranname');
    Route::post('/moneytransfer/deletetranname', [App\Http\Controllers\MoneyTransferController::class,'deletetranname'])->name('moneytransfer.deletetranname');
    Route::post('/moneytransfer/showratelist/update', [App\Http\Controllers\MoneyTransferController::class,'updateratelist'])->name('moneytransfer.updateratelist');
    Route::get('/moneytransfer/showratelist', [App\Http\Controllers\MoneyTransferController::class,'showratelist'])->name('moneytransfer.showratelist');
    Route::get('/moneytransfer/delsetrate', [App\Http\Controllers\MoneyTransferController::class,'delsetrate'])->name('moneytransfer.delsetrate');
    Route::get('/moneytransfer/showtranname', [App\Http\Controllers\MoneyTransferController::class,'showtranname'])->name('moneytransfer.showtranname');
    Route::get('/moneytransfer/getmaxtrannameno', [App\Http\Controllers\MoneyTransferController::class,'getmaxtrannameno'])->name('moneytransfer.getmaxtrannameno');

    Route::get('/moneytransfer', [App\Http\Controllers\MoneyTransferController::class,'index'])->name('moneytransfer.index');
    Route::get('/moneytransfer/report', [App\Http\Controllers\MoneyTransferController::class,'index'])->name('moneytransfer.indexreport');

    Route::get('/moneytransfer/gettransferlist', [App\Http\Controllers\MoneyTransferController::class,'gettransferlist'])->name('moneytransfer.gettransferlist');
    Route::get('/moneytransfer/countrecordsaved', [App\Http\Controllers\MoneyTransferController::class,'countrecordsaved'])->name('moneytransfer.countrecordsaved');

    Route::get('/moneytransfer/updatedeletereport', [App\Http\Controllers\MoneyTransferController::class,'updatedeletereport'])->name('moneytransfer.update_delete_report');
    Route::get('/moneytransfer/updatedeletereport/report', [App\Http\Controllers\MoneyTransferController::class,'updatedeletereport'])->name('moneytransfer.update_delete_report_report');

    Route::get('/moneytransfer/checkamountortel', [App\Http\Controllers\MoneyTransferController::class,'checkamountortel'])->name('moneytransfer.checkamountortel');
    Route::get('/moneytransfer/gettemptransferlist', [App\Http\Controllers\MoneyTransferController::class,'gettemptransferlist'])->name('moneytransfer.gettemptransferlist');
    Route::get('/moneytransfer/getphonenumber', [App\Http\Controllers\MoneyTransferController::class,'getphonenumber'])->name('moneytransfer.getphonenumber');

    Route::get('/moneytransfer/formtransaction/{mekun}', [App\Http\Controllers\MoneyTransferController::class,'formtransaction'])->name('moneytransfer.formtransaction');
    Route::post('/moneytransfer/store', [App\Http\Controllers\MoneyTransferController::class,'store'])->name('moneytransfer.store');
    Route::post('/moneytransfer/thailist_store', [App\Http\Controllers\MoneyTransferController::class,'thailist_store'])->name('moneytransfer.thailist_store');
    Route::get('/moneytransfer/checkthailistintransfer', [App\Http\Controllers\MoneyTransferController::class,'checkthailistintransfer'])->name('moneytransfer.checkthailistintransfer');
    Route::get('/moneytransfer/transactiontransfertothai', [App\Http\Controllers\MoneyTransferController::class,'transactiontransfertothai'])->name('moneytransfer.transactiontransfertothai');

    Route::post('/banktransfer/store', [App\Http\Controllers\MoneyTransferController::class,'bankstore'])->name('banktransfer.store');
    Route::post('/customertransfer/store', [App\Http\Controllers\MoneyTransferController::class,'customerstore'])->name('customertransfer.store');
    Route::get('/customertransfer/edit', [App\Http\Controllers\MoneyTransferController::class,'customeredit'])->name('customertransfer.edit');
    Route::post('/customertransfer/delete', [App\Http\Controllers\MoneyTransferController::class,'customerdelete'])->name('customertransfer.delete');

    Route::post('/wingtransfer/store', [App\Http\Controllers\MoneyTransferController::class,'wingstore'])->name('wingtransfer.store');
    Route::get('/wingtransfer/gettransactionname', [App\Http\Controllers\MoneyTransferController::class,'gettransactionname'])->name('wingtransfer.gettransactionname');
    Route::post('/moneytransfer/savetotemplist', [App\Http\Controllers\MoneyTransferController::class,'savetotemplist'])->name('moneytransfer.savetotemplist');
    Route::post('/moneytransfer/deltransfertemplist', [App\Http\Controllers\MoneyTransferController::class,'deltransfertemplist'])->name('moneytransfer.deltransfertemplist');

    Route::get('/moneytransfer/print', [App\Http\Controllers\MoneyTransferController::class,'print'])->name('moneytransfer.print');

    Route::get('/moneytransfer/edit', [App\Http\Controllers\MoneyTransferController::class,'edit'])->name('moneytransfer.edit');
    Route::post('/moneytransfer/update', [App\Http\Controllers\MoneyTransferController::class,'update'])->name('moneytransfer.update');
    Route::get('/moneytransfer/recttel/autocomplete', [App\Http\Controllers\MoneyTransferController::class,'rectelautocomplete'])->name('rectel.autocomplete');
    // Route::get('/moneytransfer/recname/autocomplete', [App\Http\Controllers\MoneyTransferController::class,'recnameautocomplete'])->name('recname.autocomplete');


    Route::get('/moneytransfer/accountnumber/autocomplete', [App\Http\Controllers\MoneyTransferController::class,'accountnumberautocomplete'])->name('accountnumber.autocomplete');

    Route::get('/moneytransfer/cashdrawrecttel/autocomplete', [App\Http\Controllers\MoneyTransferController::class,'cashdrawrectelautocomplete'])->name('cashdrawrectel.autocomplete');
    Route::get('/moneytransfer/phonenumberlocalstorage', [App\Http\Controllers\MoneyTransferController::class,'phonenumber_localstorage'])->name('phonenumberlocalstorage');
    Route::get('/moneytransfer/phonenumberlocalstoragethai', [App\Http\Controllers\MoneyTransferController::class,'phonenumber_localstorage_thai'])->name('phonenumberlocalstoragethai');

    Route::post('/moneytransfer/delete', [App\Http\Controllers\MoneyTransferController::class,'delete'])->name('moneytransfer.delete');
    Route::get('/moneytransfer/search', [App\Http\Controllers\MoneyTransferController::class,'search'])->name('moneytransfer.search');
    Route::get('/moneytransfer/search_update_delete_record', [App\Http\Controllers\MoneyTransferController::class,'search_update_delete_record'])->name('moneytransfer.search_update_delete_record');

    Route::get('/moneytransfer/searchnotyetcashdraw', [App\Http\Controllers\MoneyTransferController::class,'searchnotyetcashdraw'])->name('moneytransfer.searchnotyetcashdraw');
    Route::get('/moneytransfer/notyetcashdrawreport/print', [App\Http\Controllers\MoneyTransferController::class,'notyetcashdrawreportprint']);
    Route::get('/moneytransfer/showrelate_refnumber', [App\Http\Controllers\MoneyTransferController::class,'showrelate_refnumber'])->name('moneytransfer.showrelate_refnumber');

    Route::get('/moneytransfer/cashdrawsearch', [App\Http\Controllers\MoneyTransferController::class,'cashdrawsearch'])->name('moneytransfer.cashdrawsearch');

    Route::get('/moneytransfer/searchsendpartnerslip', [App\Http\Controllers\MoneyTransferController::class,'searchsendpartnerslip'])->name('moneytransfer.searchsendpartnerslip');
    Route::get('/moneytransfer/cashdraw', [App\Http\Controllers\MoneyTransferController::class,'cashdraw'])->name('moneytransfer.cashdraw');
    Route::get('/moneytransfer/notyetcashdrawreport', [App\Http\Controllers\MoneyTransferController::class,'notyetcashdrawreport'])->name('moneytransfer.notyetcashdrawreport');
    Route::get('/moneytransfer/setiscashdrawtrue', [App\Http\Controllers\MoneyTransferController::class,'setiscashdrawtrue'])->name('moneytransfer.setiscashdrawtrue');

    Route::get('/moneytransfer/opencashdraw', [App\Http\Controllers\MoneyTransferController::class,'opencashdraw'])->name('moneytransfer.opencashdraw');
    Route::get('/moneytransfer/unselectcashdraw', [App\Http\Controllers\MoneyTransferController::class,'unselectcashdraw'])->name('moneytransfer.unselectcashdraw');
    Route::get('/moneytransfer/clearcashdrawselect', [App\Http\Controllers\MoneyTransferController::class,'clearcashdrawselect'])->name('moneytransfer.clearcashdrawselect');

    Route::get('/moneytransfer/getmulticashdraw', [App\Http\Controllers\MoneyTransferController::class,'getmulticashdraw'])->name('moneytransfer.getmulticashdraw');

    Route::get('/moneytransfer/cashdrawcheckother', [App\Http\Controllers\MoneyTransferController::class,'cashdrawcheckother'])->name('cashdraw.checkother');
    Route::post('/moneytransfer/cashdrawdelete', [App\Http\Controllers\MoneyTransferController::class,'cashdrawdelete'])->name('cashdraw.delete');
    Route::post('/moneytransfer/cashdrawdelete1', [App\Http\Controllers\MoneyTransferController::class,'cashdrawdelete1'])->name('cashdraw.delete1');
    Route::get('/moneytransfer/getwingrate', [App\Http\Controllers\MoneyTransferController::class,'getwingrate'])->name('moneytransfer.getwingrate');
    Route::get('/moneytransfer/getwingratestorage', [App\Http\Controllers\MoneyTransferController::class,'getwingratestorage'])->name('moneytransfer.getwingratestorage');


    Route::post('/moneytransfer/cashdrawdeletebankcontinue', [App\Http\Controllers\MoneyTransferController::class,'cashdrawdeletebankcontinue'])->name('cashdraw.deletebankcontinue');
    Route::post('/moneytransfer/cashdrawselectdelaction', [App\Http\Controllers\MoneyTransferController::class,'cashdrawselectdelaction'])->name('cashdrawselect.delaction');
    Route::get('/moneytransfer/cashdraw/clearclick', [App\Http\Controllers\MoneyTransferController::class,'cashdrawclearclick'])->name('cashdraw.clearclick');
    Route::post('/moneytransfer/deleteuseraction', [App\Http\Controllers\MoneyTransferController::class,'deleteuseraction'])->name('deleteuseraction');
    Route::post('/moneytransfer/deleteuseractionbytransferid', [App\Http\Controllers\MoneyTransferController::class,'deleteuseractionbytransferid'])->name('deleteuseractionbytransferid');
    Route::post('/moneytransfer/saveuseraction', [App\Http\Controllers\MoneyTransferController::class,'saveuseraction'])->name('saveuseraction');
    Route::get('/moneytransfer/cashdrawreport', [App\Http\Controllers\MoneyTransferController::class,'cashdrawreport'])->name('moneytransfer.cashdrawreport');
    Route::get('/moneytransfer/cashdrawreport/report', [App\Http\Controllers\MoneyTransferController::class,'cashdrawreport'])->name('moneytransfer.cashdrawreportreport');

    Route::get('/moneytransfer/continuecashdraw', [App\Http\Controllers\MoneyTransferController::class,'continuecashdraw'])->name('moneytransfer.continuecashdraw');
    Route::post('/moneytransfer/savecashdraw', [App\Http\Controllers\MoneyTransferController::class,'savecashdraw'])->name('moneytransfer.savecashdraw');
    Route::post('/moneytransfer/savebankcontinue', [App\Http\Controllers\MoneyTransferController::class,'savebankcontinue'])->name('moneytransfer.savebankcontinue');
    Route::get('/moneytransfer/searchcashdraw', [App\Http\Controllers\MoneyTransferController::class,'searchcashdraw'])->name('moneytransfer.searchcashdraw');
    Route::get('/cashdraw/prints', [App\Http\Controllers\MoneyTransferController::class,'cashdrawprint'])->name('cashdraw.prints');
    Route::get('/moneytransfer/sendpartnerslip', [App\Http\Controllers\MoneyTransferController::class,'sendpartnerslip'])->name('moneytransfer.sendpartnerslip');
    Route::get('/moneytransfer/sendslip', [App\Http\Controllers\MoneyTransferController::class,'sendslip'])->name('moneytransfer.sendslip');
    Route::get('/moneytransfer/check_reference_id', [App\Http\Controllers\MoneyTransferController::class,'check_reference_id'])->name('moneytransfer.check_reference_id');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/thaicashdraw/countthairectel', [App\Http\Controllers\ThaiController::class,'countthairectel'])->name('thaicashdraw.countrectel');
    Route::get('/thaicashdraw/showrectelinfo', [App\Http\Controllers\ThaiController::class,'showrectelinfo'])->name('thaicashdraw.showrectelinfo');
    // Route::get('/thaicashdraw/cashdrawrecttel/autocomplete', [App\Http\Controllers\ThaiController::class,'thaicashdrawrectelautocomplete'])->name('thaicashdrawrectel.autocomplete');
    Route::get('/thaicashdraw/notyetcashdrawreport/print', [App\Http\Controllers\ThaiController::class,'notyetcashdrawreportprint']);
    Route::get('/thaicashdraw/cashdraw', [App\Http\Controllers\ThaiController::class,'cashdraw'])->name('thaicashdraw.cashdraw');
    Route::get('/thaicashdraw/thaisms', [App\Http\Controllers\ThaiController::class,'thaisms'])->name('thaicashdraw.thaisms');
    Route::get('/thaicashdraw/getthaisms', [App\Http\Controllers\ThaiController::class,'getthaisms'])->name('thaicashdraw.getthaisms');
    Route::get('/thaisms/refreshacclist', [App\Http\Controllers\ThaiController::class,'refreshacclist'])->name('thaisms.refreshacclist');
    Route::get('/thaicashdraw/setiscashdrawtrue', [App\Http\Controllers\ThaiController::class,'setiscashdrawtrue'])->name('thaicashdraw.setiscashdrawtrue');
     Route::get('/thaicashdraw/searchnotyetcashdraw', [App\Http\Controllers\ThaiController::class,'searchnotyetcashdraw'])->name('thaicashdraw.searchnotyetcashdraw');
    Route::get('/thaicashdraw/cashdraw1', [App\Http\Controllers\ThaiController::class,'cashdraw1'])->name('thaicashdraw.cashdraw1');
    Route::get('/thaicashdraw/cashdraw2', [App\Http\Controllers\ThaiController::class,'cashdraw2'])->name('thaicashdraw.cashdraw2');

    Route::get('/thaicashdraw/showgroupid', [App\Http\Controllers\ThaiController::class,'showgroupid'])->name('thaicashdraw.showgroupid');
    Route::post('/thaicashdraw/deletegroupid', [App\Http\Controllers\ThaiController::class,'deletegroupid'])->name('thaicashdraw.deletegroupid');
    Route::get('/thaicashdraw/updatestep', [App\Http\Controllers\ThaiController::class,'updatestep'])->name('thaicashdraw.updatestep');
    Route::get('/thaicashdraw/updatemissioncomplete', [App\Http\Controllers\ThaiController::class,'mission_ready'])->name('thaicashdraw.mission_ready');
    Route::get('/thaicashdraw/getpartnerbalancebycur', [App\Http\Controllers\ThaiController::class,'getpartnerbalancebycur'])->name('thaicashdraw.getpartnerbalancebycur');
    Route::post('/thaicashdraw/updatesmsnote', [App\Http\Controllers\ThaiController::class,'updatesmsnote'])->name('thaicashdraw.updatesmsnote');


    Route::get('/thaicashdraw/notyetcashdrawreport', [App\Http\Controllers\ThaiController::class,'notyetcashdrawreport'])->name('thaicashdraw.notyetcashdrawreport');

    Route::get('/thaicashdraw/cashdrawreport', [App\Http\Controllers\ThaiController::class,'cashdrawreport'])->name('thaicashdraw.cashdrawreport');
    Route::get('/thaicashdraw/continuecashdraw', [App\Http\Controllers\ThaiController::class,'continuecashdraw'])->name('thaicashdraw.continuecashdraw');
    Route::post('/thaicashdraw/savecashdraw', [App\Http\Controllers\ThaiController::class,'savecashdraw'])->name('thaicashdraw.savecashdraw');
    Route::post('/thaicashdraw/savemultiimage', [App\Http\Controllers\ThaiController::class,'savemultiimage'])->name('thaicashdraw.savemultiimage');

    Route::post('/thaicashdraw/savecashdrawwingcode', [App\Http\Controllers\ThaiController::class,'savecashdrawwingcode'])->name('thaicashdraw.savecashdrawwingcode');
    Route::get('/thaicashdraw/seephoto', [App\Http\Controllers\ThaiController::class,'seephoto'])->name('thaicashdraw.seephoto');

    Route::get('/thaicashdraw/searchcashdraw', [App\Http\Controllers\ThaiController::class,'searchcashdraw'])->name('thaicashdraw.searchcashdraw');
    Route::get('/thaicashdraw/searchcashdrawreport', [App\Http\Controllers\ThaiController::class,'searchcashdrawreport'])->name('thaicashdraw.searchcashdrawreport');

    Route::get('/thaicashdraw1/searchcashdraw1', [App\Http\Controllers\ThaiController::class,'searchcashdraw1new'])->name('thaicashdraw1.searchcashdraw1');
    Route::get('/thaicashdraw2/searchcashdraw2', [App\Http\Controllers\ThaiController::class,'searchcashdraw2'])->name('thaicashdraw2.searchcashdraw2');
    Route::get('/thaicashdraw/countsmsrefresh', [App\Http\Controllers\ThaiController::class,'countsmsrefresh'])->name('thaicashdraw.countsmsrefresh');
    Route::get('/thaicashdraw/clearrefreshaction', [App\Http\Controllers\ThaiController::class,'clearrefreshaction'])->name('thaicashdraw.clearrefreshaction');

    Route::post('/thaicashdraw1/updatetransfer', [App\Http\Controllers\ThaiController::class,'updatetransfer'])->name('thaicashdraw1.updatetransfer');
    Route::post('/thaicashdraw1/updatetransferinfo', [App\Http\Controllers\ThaiController::class,'updatetransferinfo'])->name('thaicashdraw1.updatetransferinfo');
    Route::post('/thaicashdraw1/updatetransferready', [App\Http\Controllers\ThaiController::class,'updatetransferready'])->name('thaicashdraw1.updatetransferready');
    Route::post('/thaicashdraw1/notyetready', [App\Http\Controllers\ThaiController::class,'notyetready'])->name('thaicashdraw1.notyetready');


    Route::post('/thaicashdraw1/updatetransfer0', [App\Http\Controllers\ThaiController::class,'updatetransfer0'])->name('thaicashdraw1.updatetransfer0');
    Route::get('/thaicashdraw1/printcode', [App\Http\Controllers\ThaiController::class,'printcode'])->name('thaicashdraw1.printcode');

    Route::get('/thaicashdraw/opencashdraw', [App\Http\Controllers\ThaiController::class,'opencashdraw'])->name('thaicashdraw.opencashdraw');
    Route::get('/thaicashdraw1/opencashdraw1new', [App\Http\Controllers\ThaiController::class,'opencashdraw1new'])->name('thaicashdraw1.opencashdraw1new');
    Route::get('/thaicashdraw1/opencashdraw1', [App\Http\Controllers\ThaiController::class,'opencashdraw1'])->name('thaicashdraw1.opencashdraw1');

    Route::get('/thaicashdraw1/resetexchange', [App\Http\Controllers\ThaiController::class,'resetexchange'])->name('thaicashdraw1.resetexchange');
    Route::post('/thaicashdraw/delcashdrawaction', [App\Http\Controllers\ThaiController::class,'delcashdrawaction'])->name('thaicashdraw.delcashdrawaction');
    Route::post('/thaicashdraw1/delcashdrawaction1', [App\Http\Controllers\ThaiController::class,'delcashdrawaction1'])->name('thaicashdraw1.delcashdrawaction1');
    Route::post('/thaicashdraw1/delcashdrawaction2', [App\Http\Controllers\ThaiController::class,'delcashdrawaction2'])->name('thaicashdraw1.delcashdrawaction2');

    Route::get('/thaicashdraw/clearclick', [App\Http\Controllers\ThaiController::class,'cashdrawclearclick'])->name('thaicashdraw.clearclick');
    Route::get('/thaicashdraw1/clearclick1', [App\Http\Controllers\ThaiController::class,'cashdrawclearclick1'])->name('thaicashdraw1.clearclick1');

    Route::post('/thaicashdraw/deleteuseraction', [App\Http\Controllers\ThaiController::class,'deleteuseraction'])->name('thaideleteuseraction');
    Route::post('/thaicashdraw1/deleteuseraction1', [App\Http\Controllers\ThaiController::class,'deleteuseraction1'])->name('thaideleteuseraction1');

    Route::get('/thaicashdraw/prints', [App\Http\Controllers\ThaiController::class,'cashdrawprint'])->name('thaicashdraw.prints');

    Route::get('/thaicashdraw/getwingfee', [App\Http\Controllers\ThaiController::class,'getwingfee'])->name('thaicashdraw.getwingfee');
    Route::get('/thaicashdraw/getagenttranname', [App\Http\Controllers\ThaiController::class,'getagenttranname'])->name('thaicashdraw.getagenttranname');

    Route::get('/thaicashdraw/unselectcashdraw', [App\Http\Controllers\ThaiController::class,'unselectcashdraw'])->name('thaicashdraw.unselectcashdraw');
    Route::get('/thaicashdraw/getmulticashdraw', [App\Http\Controllers\ThaiController::class,'getmulticashdraw'])->name('thaicashdraw.getmulticashdraw');
    Route::post('/thaicashdraw/thaismsmix', [App\Http\Controllers\ThaiController::class,'mixsms'])->name('thaicashdraw.mixsms');
    Route::get('/thaicashdraw/clearcashdrawselect', [App\Http\Controllers\ThaiController::class,'clearcashdrawselect'])->name('thaicashdraw.clearcashdrawselect');
    Route::get('/thaicashdraw/clearmixsms', [App\Http\Controllers\ThaiController::class,'clearmixsms'])->name('thaicashdraw.clearmixsms');
    Route::get('/thaicashdraw/accountregister', [App\Http\Controllers\ThaiController::class,'accountregister'])->name('thaicashdraw.accountregister');
    Route::get('/thaicashdraw/registerthaicustomer', [App\Http\Controllers\ThaiController::class,'registerthaicustomer'])->name('thaicashdraw.registerthaicustomer');
    Route::get('/thaicashdraw/accountlistreport', [App\Http\Controllers\ThaiController::class,'accountlistreport'])->name('thaicashdraw.accountlistreport');

    Route::get('/thaisms/getaccountlistbybank', [App\Http\Controllers\ThaiController::class,'getaccountlistbybank'])->name('thaisms.getaccountlistbybank');

    Route::get('/thaicashdraw/closelist', [App\Http\Controllers\ThaiController::class,'closelist'])->name('thaicashdraw.closelist');
    Route::post('/thaiaccount/store', [App\Http\Controllers\ThaiController::class,'thaiaccountstore'])->name('thaiaccount.store');
    Route::post('/thaicustomer/store', [App\Http\Controllers\ThaiController::class,'thaicustomerstore'])->name('thaicustomer.store');
    Route::get('/thaicustomer/read', [App\Http\Controllers\ThaiController::class,'thaicustomerread'])->name('thaicustomer.read');
    Route::get('/thaiaccount/getmaxno', [App\Http\Controllers\ThaiController::class,'thaiaccountgetmaxno'])->name('thaiaccount.getmaxno');
    Route::get('/thaiaccount/getaccountlist', [App\Http\Controllers\ThaiController::class,'getaccountlist'])->name('thaiaccount.getaccountlist');
    Route::get('/thaiaccount/getaccountlistreport', [App\Http\Controllers\ThaiController::class,'getaccountlistreport'])->name('thaiaccount.getaccountlistreport');

    Route::post('/thaiaccount/deleteaccount', [App\Http\Controllers\ThaiController::class,'deleteaccount'])->name('thaiaccount.deleteaccount');
    Route::post('/thaicustomer/deletecustomer', [App\Http\Controllers\ThaiController::class,'deletecustomer'])->name('thaicustomer.deletecustomer');

    Route::get('/thaiaccount/getaccountbalance', [App\Http\Controllers\ThaiController::class,'getaccountbalance'])->name('thaiaccount.getaccountbalance');
    Route::post('/thaiaccount/closelist', [App\Http\Controllers\ThaiController::class,'thaiaccountcloselist'])->name('thaiaccount.closelist');
    Route::get('/thaiaccount/getaccountcloselist', [App\Http\Controllers\ThaiController::class,'getaccountcloselist'])->name('thaiaccount.getaccountcloselist');
    Route::post('/thaiaccount/deletecloselistaccount', [App\Http\Controllers\ThaiController::class,'deletecloselistaccount'])->name('thaiaccount.deletecloselist');
    Route::post('/thaiaccount/savesms', [App\Http\Controllers\ThaiController::class,'savesms'])->name('thaiaccount.savesms');
    Route::get('/thaisms/getaccountbybank', [App\Http\Controllers\ThaiController::class,'getaccountbybank'])->name('thaisms.getacclistbybank');
    Route::get('/thaisms/getsmsuserinsert', [App\Http\Controllers\ThaiController::class,'getsmsuserinsert'])->name('thaisms.getsmsuserinsert');
    Route::post('/thaisms/smsdelete', [App\Http\Controllers\ThaiController::class,'smsdelete'])->name('thaisms.smsdelete');
    Route::get('/thaisms/matchsmsidtotransfer', [App\Http\Controllers\ThaiController::class,'matchsmsidtotransfer'])->name('thaisms.matchsmsidtotransfer');
    Route::get('/thaisms/delmatchsmsidtotransfer', [App\Http\Controllers\ThaiController::class,'delmatchsmsidtotransfer'])->name('thaisms.delmatchsmsidtotransfer');

    Route::get('/thaisms/checkthesameamount', [App\Http\Controllers\ThaiController::class,'checkthesameamount'])->name('thaicashdraws.checkthesameamount');
    Route::get('/thaisms/cashdrawreport', [App\Http\Controllers\ThaiController::class,'cashdrawreport'])->name('thaicashdraws.cashdrawreport');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/partnerlist/index', [App\Http\Controllers\PartnerListController::class,'index'])->name('partnerlist.index');
    Route::get('/partnerlist/indexnew', [App\Http\Controllers\PartnerListController::class,'indexnew'])->name('partnerlist.indexnew');

    Route::get('/partnerlist/checklist', [App\Http\Controllers\PartnerListController::class,'checklist'])->name('partnerlist.checklist');

    Route::get('/partnerlist/alllist', [App\Http\Controllers\PartnerListController::class,'alllist'])->name('partnerlist.alllist');
    Route::get('/partnerlist/printallpartnerlist', [App\Http\Controllers\PartnerListController::class,'printallpartnerlist'])->name('partnerlist.printallpartnerlist');
    Route::get('/partnerlist/summaryallpartnerlist', [App\Http\Controllers\PartnerListController::class,'summaryallpartnerlist'])->name('partnerlist.summaryallpartnerlist');
    Route::get('/partnerlist/summaryallpartnerlistdetail', [App\Http\Controllers\PartnerListController::class,'summaryallpartnerlistdetail'])->name('partnerlist.summaryallpartnerlistdetail');
    Route::post('/partnerlist/clearallviewer', [App\Http\Controllers\PartnerListController::class,'clearallviewer'])->name('partnerlist.clearallviewer');

    Route::get('/partnerlist/showdata', [App\Http\Controllers\PartnerListController::class,'showdata'])->name('partnerlist.showdata');
    Route::get('/partnerlist/justrefreshdata', [App\Http\Controllers\PartnerListController::class,'justrefreshdata'])->name('partnerlist.justrefreshdata');

    Route::get('/partnerlist/exchangelist/{partnerid}', [App\Http\Controllers\PartnerListController::class,'exchangelist'])->name('partnerlist.exchangelist');
    Route::get('/partnerlist/exchangelistreport', [App\Http\Controllers\PartnerListController::class,'exchangelistreport'])->name('partnerlist.exchangelistreport');
    Route::get('/partnerlist/searchexchangelistreport', [App\Http\Controllers\PartnerListController::class,'searchexchangelistreport'])->name('partnerlist.searchexchangelistreport');
    Route::get('/partnerlist/printexchangereport', [App\Http\Controllers\PartnerListController::class,'printexchangereport']);
    Route::post('/partnerlist/exchangelistreportstoreinout', [App\Http\Controllers\PartnerListController::class,'exchangelistreportstoreinout'])->name('exchangelistreport.storeinout');
    Route::post('/partnerlist/saveexchangelistleft', [App\Http\Controllers\PartnerListController::class,'saveexchangelistleft'])->name('partnerlist.saveexchangelistleft');

    Route::get('/partnerlist/gettotallist', [App\Http\Controllers\PartnerListController::class,'gettotallist'])->name('partnerlist.gettotallist');
    Route::post('/partnerlist/store', [App\Http\Controllers\PartnerListController::class,'store'])->name('partnerlist.store');
    Route::post('/partnerlist/storecloselist', [App\Http\Controllers\PartnerListController::class,'storecloselist'])->name('partnerlist.storecloselist');
    Route::get('/partnerlist/delkatkong', [App\Http\Controllers\PartnerListController::class,'delkatkong'])->name('exchangelist.delkatkong');
    Route::get('/exchangelist/show', [App\Http\Controllers\PartnerListController::class,'exchangelistshow'])->name('exchangelist.show');
    Route::post('/partnerlist/delete', [App\Http\Controllers\PartnerListController::class,'delete'])->name('exchangelist.delete');
    Route::get('/partnerlist/showcloselist', [App\Http\Controllers\PartnerListController::class,'showcloselist'])->name('partnerlist.showcloselist');
    Route::post('/partnerlist/closelist/delete', [App\Http\Controllers\PartnerListController::class,'closelistdelete'])->name('closelist.delete');
    Route::get('/partnerlist/getpartnerbytype', [App\Http\Controllers\PartnerListController::class,'getpartnerbytype'])->name('getpartnerbytype');
    Route::get('/partnerlist/print', [App\Http\Controllers\PartnerListController::class,'partnerlistprint'])->name('partnerlist.print');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/getagentuser', [App\Http\Controllers\UserCapitalController::class,'getagentuser'])->name('getagentuser');
    Route::get('/getallusermaster', [App\Http\Controllers\UserCapitalController::class,'getallusermaster'])->name('getallusermaster');

    Route::get('/usercapital/index', [App\Http\Controllers\UserCapitalController::class,'index'])->name('usercapital.index');
    Route::get('/usercapital/closelist', [App\Http\Controllers\UserCapitalController::class,'closelist'])->name('usercapital.closelist');
    Route::get('/usercapital/usertransactionreport', [App\Http\Controllers\UserCapitalController::class,'usertransactionreport'])->name('usercapital.usertransactionreport');
    Route::get('/usercapital/dousertransactionreport', [App\Http\Controllers\UserCapitalController::class,'dousertransactionreport'])->name('usercapital.dousertransactionreport');
    Route::get('/usercapital/doallusertransactionreport', [App\Http\Controllers\UserCapitalController::class,'doallusertransactionreport'])->name('usercapital.doallusertransactionreport');
    Route::get('/usercapital/doallusertransactionreportsummary', [App\Http\Controllers\UserCapitalController::class,'doallusertransactionreportsummary'])->name('usercapital.doallusertransactionreportsummary');

    Route::get('/usercapital/searchusertransactionreport', [App\Http\Controllers\UserCapitalController::class,'searchusertransactionreport'])->name('usercapital.searchusertransactionreport');
    Route::get('/usercapital/getusercapitalmaster', [App\Http\Controllers\UserCapitalController::class,'getusercapitalmaster'])->name('usercapital.getusercapitalmaster');

    Route::get('/usercapital/showrefgroupid', [App\Http\Controllers\UserCapitalController::class,'showrefgroupid'])->name('usercapital.showrefgroupid');
    Route::get('/usercapital/showsummarydetail', [App\Http\Controllers\UserCapitalController::class,'showsummarydetail'])->name('usercapital.showsummarydetail');

    Route::post('/usercapital/deletetransactiongroup', [App\Http\Controllers\UserCapitalController::class,'deletetransactiongroup'])->name('usercapital.deletetransactiongroup');
    Route::get('/usercapital/updatetransactiongroup', [App\Http\Controllers\UserCapitalController::class,'updatetransactiongroup'])->name('usercapital.updatetransactiongroup');
    Route::get('/usercapital/updateusercapital', [App\Http\Controllers\UserCapitalController::class,'updateusercapital'])->name('usercapital.updateusercapital');

    Route::get('/usercapital/getmultiexchangelist', [App\Http\Controllers\UserCapitalController::class,'getmultiexchangelist'])->name('usercapital.getmultiexchangelist');
    Route::post('/usercapital/delete_multiexchangelist', [App\Http\Controllers\UserCapitalController::class,'delete_multiexchangelist'])->name('usercapital.delete_multiexchangelist');
    Route::post('/usercapital/clear_multiexchangelist', [App\Http\Controllers\UserCapitalController::class,'clear_multiexchangelist'])->name('usercapital.clear_multiexchangelist');


    Route::get('/usercapital/userprofit', [App\Http\Controllers\UserCapitalController::class,'userprofit'])->name('usercapital.userprofit');
    Route::get('/usercapital/userstatementreport', [App\Http\Controllers\UserCapitalController::class,'userstatementreport'])->name('usercapital.userstatementreport');
    Route::get('/usercapital/douserstatementreport', [App\Http\Controllers\UserCapitalController::class,'douserstatementreport'])->name('usercapital.douserstatementreport');
    Route::get('/usercapital/printuserstatementreport', [App\Http\Controllers\UserCapitalController::class,'printuserstatementreport'])->name('usercapital.printuserstatementreport');

    Route::get('/usercapital/search', [App\Http\Controllers\UserCapitalController::class,'search'])->name('usercapital.search');
    Route::post('/usercapital/store', [App\Http\Controllers\UserCapitalController::class,'store'])->name('usercapital.store');
    Route::post('/usercapital/store1', [App\Http\Controllers\UserCapitalController::class,'store1'])->name('usercapital.store1');
    Route::post('/usercapital/store3', [App\Http\Controllers\UserCapitalController::class,'store3'])->name('usercapital.store3');
    Route::post('/usercapital/saveendbalanceall', [App\Http\Controllers\UserCapitalController::class,'store_endbalance_multi'])->name('usercapital.store_endbalance_all');
    Route::post('/usercapital/delendbalanceall', [App\Http\Controllers\UserCapitalController::class,'delete_endbalance_multi'])->name('usercapital.del_endbalance_all');
    Route::get('/usercapital/gettrueenddingbalance', [App\Http\Controllers\UserCapitalController::class,'gettrueenddingbalance'])->name('usercapital.gettrueenddingbalance');
    Route::get('/usercapital/gettrueenddingbalanceall', [App\Http\Controllers\UserCapitalController::class,'gettrueenddingbalanceall'])->name('usercapital.gettrueenddingbalanceall');


    Route::post('/usercapital/delete', [App\Http\Controllers\UserCapitalController::class,'delete'])->name('usercapital.delete');
    Route::get('/usercapital/edit', [App\Http\Controllers\UserCapitalController::class,'edit'])->name('usercapital.edit');

    Route::get('/usercapital/showcloselist', [App\Http\Controllers\UserCapitalController::class,'showcloselist'])->name('usercapital.showcloselist');
    Route::get('/usercapital/seedetail/{curid}/{curname}/{curshortcut}/{isexchangecur}/{ismain}/{viewdate}/{userid}/{username}/{fromdate}/{ckcash}/{islink}/{hide_view}/{clearallviewer}', [App\Http\Controllers\UserCapitalController::class,'seedetail'])->name('usercapital.seedetail');
    Route::get('/usercapital/seedetail1by1', [App\Http\Controllers\UserCapitalController::class,'seedetail1by1'])->name('usercapital.seedetail1by1');
    Route::get('/usercapital/seedetaillink', [App\Http\Controllers\UserCapitalController::class,'seedetaillink'])->name('usercapital.seedetaillink');
    Route::get('/usercapital/seedetaillinksearch', [App\Http\Controllers\UserCapitalController::class,'seedetaillinksearch'])->name('usercapital.linkdetailsearch');
    Route::post('/usercapital/updatehideview', [App\Http\Controllers\UserCapitalController::class,'updatehideview'])->name('usercapital.updatehideview');

    Route::get('/usercapital/seebyagentname', [App\Http\Controllers\UserCapitalController::class,'seebyagentname'])->name('usercapital.seebyagentname');

    Route::post('/usercapital/capitalcontinue', [App\Http\Controllers\UserCapitalController::class,'capitalcontinue'])->name('usercapital.capitalcontinue');
    Route::post('/usercapital/capitalcontinueall', [App\Http\Controllers\UserCapitalController::class,'capitalcontinueall'])->name('usercapital.capitalcontinueall');

    Route::get('/usercapital/printusercloselist', [App\Http\Controllers\UserCapitalController::class,'printusercloselist'])->name('usercapital.printusercloselist');
    Route::get('/usercapital/printusertransaction', [App\Http\Controllers\UserCapitalController::class,'printusertransaction'])->name('usercapital.printusertransaction');
    Route::get('/usercapital/getcustomertype', [App\Http\Controllers\UserCapitalController::class,'getcustomertype'])->name('usercapital.getcustomerbytype');
    Route::get('/usercapital/getcustomerforuser', [App\Http\Controllers\UserCapitalController::class,'getcustomerforuser'])->name('usercapital.getcustomerforuser');
    Route::get('/usercapital/getcustomer_without_userconnect', [App\Http\Controllers\UserCapitalController::class,'getcustomer_without_userconnect'])->name('usercapital.getcustomer_without_userconnect');

    Route::get('/usercapital/printuserendlist', [App\Http\Controllers\UserCapitalController::class,'printuserendlist'])->name('usercapital.printuserendlist');
    Route::get('/expanseincome/inusercapital', [App\Http\Controllers\ExpanseController::class,'index'])->name('expanseincome.inusercapital');
    Route::get('/usercapital/moneyoffer', [App\Http\Controllers\UserCapitalController::class,'moneyoffer'])->name('usercapital.moneyoffer');
    Route::post('/usercapital/savemoneyoffer', [App\Http\Controllers\UserCapitalController::class,'savemoneyoffer'])->name('usercapital.savemoneyoffer');
    Route::post('/usercapital/updatemoneyoffer', [App\Http\Controllers\UserCapitalController::class,'updatemoneyoffer'])->name('usercapital.updatemoneyoffer');

    Route::get('/usercapital/showuseroffer', [App\Http\Controllers\UserCapitalController::class,'showuseroffer'])->name('usercapital.showuseroffer');
    Route::post('/usercapital/savemoneyofferaccept', [App\Http\Controllers\UserCapitalController::class,'savemoneyofferaccept'])->name('usercapital.savemoneyofferaccept');
    Route::post('/useroffer/delete', [App\Http\Controllers\UserCapitalController::class,'userofferdelete'])->name('useroffer.delete');
    Route::get('/useroffer/reject', [App\Http\Controllers\UserCapitalController::class,'userofferreject'])->name('useroffer.reject');
    Route::get('/useroffer/restore', [App\Http\Controllers\UserCapitalController::class,'userofferrestore'])->name('useroffer.restore');
    Route::get('/moneyoffer/print', [App\Http\Controllers\UserCapitalController::class,'moneyofferprint'])->name('moneyoffer.print');
    Route::get('/closelist/summaryuserpartnerlist', [App\Http\Controllers\UserCapitalController::class,'getuserbalanceaccount'])->name('usercapital.summaryuserpartnerlist');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/closelist/index', [App\Http\Controllers\CloseListController::class,'index'])->name('closelist.index');
    Route::get('/closelist/search', [App\Http\Controllers\CloseListController::class,'search'])->name('closelist.search');
    Route::get('/closelist/summarypartnerlist', [App\Http\Controllers\CloseListController::class,'summarypartnerlist'])->name('closelist.summarypartnerlist');
    Route::get('/closelist/searchold', [App\Http\Controllers\CloseListController::class,'searchold'])->name('closelist.searchold');
    Route::post('/closelist/store', [App\Http\Controllers\CloseListController::class,'store'])->name('closelist.store');
    Route::get('/closelist/report', [App\Http\Controllers\CloseListController::class,'report'])->name('closelist.report');
    Route::get('/closelist/showreport', [App\Http\Controllers\CloseListController::class,'showreport'])->name('closelist.showreport');
    Route::get('/closelist/summaryreport', [App\Http\Controllers\CloseListController::class,'summaryreport'])->name('closelist.summaryreport');
    Route::get('/closelist/showsummaryreport', [App\Http\Controllers\CloseListController::class,'showsummaryreport'])->name('closelist.showsummaryreport');
    Route::get('/closelist/seedetail', [App\Http\Controllers\CloseListController::class,'seedetail'])->name('closelist.seedetail');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/company', [App\Http\Controllers\CompanyController::class,'companyregister'])->name('company.register');
    Route::post('/company-save', [App\Http\Controllers\CompanyController::class,'savecompany'])->name('company.store');
    Route::post('/company-update', [App\Http\Controllers\CompanyController::class,'updatecompany'])->name('company.update');
    Route::post('/company-destroy', [App\Http\Controllers\CompanyController::class,'destroycompany'])->name('company.destroy');
    Route::get('/company-readdata', [App\Http\Controllers\CompanyController::class,'companydata'])->name('company.readdata');
    Route::get('/company-getinfobyid', [App\Http\Controllers\CompanyController::class,'getcompanyinfobyid'])->name('company.getinfobyid');
    Route::get('/company/getbank', [App\Http\Controllers\CompanyController::class,'getbank'])->name('company.getbank');
    Route::get('/company/getuser', [App\Http\Controllers\CompanyController::class,'getuser'])->name('company.getuser');
    Route::get('/company/customerbytype', [App\Http\Controllers\CompanyController::class,'customerbytype'])->name('company.customerbytype');

});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/autocompleteinputtable', [App\Http\Controllers\EmployeeController::class,'multiautocomplete'])->name('Employees.multiautocompleted');
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/report/transferprofit', [App\Http\Controllers\ReportController::class,'transferprofit'])->name('report.transferprofit');
    Route::get('/report/getexpansereport', [App\Http\Controllers\ExpanseController::class,'getexpansereport'])->name('report.getexpansereport');

    Route::get('/report/gettransferprofit', [App\Http\Controllers\ReportController::class,'gettransferprofit'])->name('report.gettransferprofit');
    Route::get('/report/gettransferprofitwithlist', [App\Http\Controllers\ReportController::class,'gettransferprofitwithlist'])->name('report.gettransferprofitwithlist');
    Route::get('/report/printtransferprofit', [App\Http\Controllers\ReportController::class,'gettransferprofit'])->name('report.printtransferprofit');
    Route::get('/report/printtransferprofitwithlist', [App\Http\Controllers\ReportController::class,'gettransferprofitwithlist'])->name('report.printtransferprofitwithlist');

});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/expanseincome', [App\Http\Controllers\ExpanseController::class,'index'])->name('expanseincome.index');
    Route::post('/expanseincome/store', [App\Http\Controllers\ExpanseController::class,'store'])->name('expanseincome.store');
    Route::post('/expanseincome/savetype', [App\Http\Controllers\ExpanseController::class,'savetype'])->name('expanseincome.savetype');

    Route::get('/getexpansetypebygroup', [App\Http\Controllers\ExpanseController::class,'getexpansetypebygroup'])->name('expanseincome.getexpansetypebygroup');
    Route::get('/getexpanselist', [App\Http\Controllers\ExpanseController::class,'getexpanselist'])->name('expanseincome.getexpanselist');
    Route::get('/expanseedit', [App\Http\Controllers\ExpanseController::class,'edit'])->name('expanseincome.edit');
    Route::post('/expansedelete', [App\Http\Controllers\ExpanseController::class,'delete'])->name('expanseincome.delete');
    Route::post('/expansedeletetype', [App\Http\Controllers\ExpanseController::class,'deletetype'])->name('expanseincome.deletetype');
     Route::get('/expansereport', [App\Http\Controllers\ExpanseController::class,'expansereport'])->name('expanseincome.report');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/landregister', [App\Http\Controllers\LandController::class,'index'])->name('land.index');
    Route::get('/getpropertygroup', [App\Http\Controllers\LandController::class,'getpropertygroup'])->name('getpropertygroup');
    Route::post('/propertygroup/delete', [App\Http\Controllers\LandController::class,'propertygroupdelete'])->name('propertygroup.delete');
    Route::post('/savelandgroup', [App\Http\Controllers\LandController::class,'savelandgroup'])->name('savelandgroup');
    Route::post('/property/saveland', [App\Http\Controllers\LandController::class,'saveland'])->name('property.saveland');
    Route::get('/getpropertylist', [App\Http\Controllers\LandController::class,'getpropertylist'])->name('getpropertylist');
    Route::post('/property/delete', [App\Http\Controllers\LandController::class,'propertydelete'])->name('property.delete');
    Route::get('/propertyname/autocomplete', [App\Http\Controllers\LandController::class,'propertynameautocomplete'])->name('propertyname.autocomplete');
    Route::get('/land/deletepropertysold', [App\Http\Controllers\LandController::class,'deletepropertysold'])->name('deletepropertysold');
    Route::get('/land/getpropertysoldlink', [App\Http\Controllers\LandController::class,'getpropertysoldlink'])->name('getpropertysoldlink');
    Route::get('/land/checkpropertysold', [App\Http\Controllers\LandController::class,'checkpropertysold'])->name('checkpropertysold');
    Route::get('/land/checkpropertysoldbypayonid', [App\Http\Controllers\LandController::class,'checkpropertysoldbypayonid'])->name('checkpropertysoldbypayonid');
    Route::get('/landdelete/removegrouppayment', [App\Http\Controllers\LandController::class,'removegrouppayment'])->name('removegrouppayment');
    Route::get('/landdelete/removegrouppayment1', [App\Http\Controllers\LandController::class,'removegrouppayment1'])->name('removegrouppayment1');

    Route::get('/landdelete/removesaledetail', [App\Http\Controllers\LandController::class,'removesaledetail'])->name('removesaledetail');

});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/realestate/fixpaymentbyid', [App\Http\Controllers\RealEstateController::class,'fixpaymentbyid'])->name('realestate.fixpaymentbyid');
    Route::get('/realestate/addcommission', [App\Http\Controllers\RealEstateController::class,'addcommission'])->name('realestate.addcommission');

    Route::get('/realestate/updatesalegroup', [App\Http\Controllers\RealEstateController::class,'updatesalegroup'])->name('realestate.updatesalegroup');
    Route::get('/realestate', [App\Http\Controllers\RealEstateController::class,'index'])->name('realestate.index');
    Route::get('/realestate/checkcontract', [App\Http\Controllers\RealEstateController::class,'checkcontract'])->name('realestate.checkcontract');

    Route::post('/realestate/store', [App\Http\Controllers\RealEstateController::class,'store'])->name('realestate.store');
    Route::post('/realestate/savedocontract', [App\Http\Controllers\RealEstateController::class,'savedocontract'])->name('realestate.savedocontract');

    Route::get('/realestate/edit', [App\Http\Controllers\RealEstateController::class,'edit'])->name('realestate.edit');
    Route::post('/realestate/delete', [App\Http\Controllers\RealEstateController::class,'delete'])->name('realestate.delete');
    Route::get('/realestate/getpropertybygroup', [App\Http\Controllers\RealEstateController::class,'getpropertybygroup'])->name('realestate.getpropertybygroup');
    Route::get('/realestate/saleprint', [App\Http\Controllers\RealEstateController::class,'print'])->name('realestate.saleprint');
    Route::get('/realestate/getsalelist', [App\Http\Controllers\RealEstateController::class,'getsalelist'])->name('realestate.getsalelist');
    Route::get('/realestate/payment', [App\Http\Controllers\RealEstateController::class,'payment'])->name('realestate.payment');
    Route::post('/realestate/savedeposit', [App\Http\Controllers\RealEstateController::class,'savedeposit'])->name('realestate.savedeposit');
    Route::post('/realestate/savedepositcommission', [App\Http\Controllers\RealEstateController::class,'savedepositcommission'])->name('realestate.savedepositcommission');
    Route::get('/realestate/incomeexpansereport', [App\Http\Controllers\RealEstateController::class,'incomeexpansereport'])->name('realestate.incomeexpansereport');
    Route::get('/realestate/show_incomeexpansereport', [App\Http\Controllers\RealEstateController::class,'show_incomeexpansereport'])->name('realestate.show_incomeexpansereport');
    Route::get('/realestate/generalexpanse', [App\Http\Controllers\ExpanseController::class,'index'])->name('realestate.generalexpanse');

    Route::get('/realestate/soldpropertylist', [App\Http\Controllers\RealEstateController::class,'soldpropertylist'])->name('realestate.soldpropertylist');
    Route::get('/realestate/customerromloslist', [App\Http\Controllers\RealEstateController::class,'customerromloslist'])->name('realestate.customerromloslist');
    Route::get('/realestate/commissionlist', [App\Http\Controllers\RealEstateController::class,'commissionlist'])->name('realestate.commissionlist');
    Route::get('/realestate/commissionlistall', [App\Http\Controllers\RealEstateController::class,'commissionlistall'])->name('realestate.commissionlistall');
    Route::get('/realestate/paidcommissionlistall', [App\Http\Controllers\RealEstateController::class,'paidcommissionlistall'])->name('realestate.paidcommissionlistall');
    Route::get('/realestate/commissionreport', [App\Http\Controllers\RealEstateController::class,'commissionreport'])->name('realestate.commissionreport');
    Route::get('/realestate/closelistuser', [App\Http\Controllers\RealEstateController::class,'closelistuser'])->name('realestate.closelistuser');

    Route::get('/realestate/paymentreport', [App\Http\Controllers\RealEstateController::class,'paymentreport'])->name('realestate.paymentreport');

    Route::post('/realestate/updatecuscharge', [App\Http\Controllers\RealEstateController::class,'updatecuscharge'])->name('realestate.updatecuscharge');
    Route::get('/realestate/paymentlist', [App\Http\Controllers\RealEstateController::class,'showdeposit'])->name('realestate.paymentlist');
    Route::get('/realestate/romloslist', [App\Http\Controllers\RealEstateController::class,'showromloslist'])->name('realestate.romloslist');

    Route::get('/realestate/getsoldlist', [App\Http\Controllers\RealEstateController::class,'getsoldlist'])->name('realestate.getsoldlist');
    Route::get('/realestate/showdeposit', [App\Http\Controllers\RealEstateController::class,'showdeposit'])->name('realestate.showdeposit');
    Route::get('/realestate/showinvbycustomer', [App\Http\Controllers\RealEstateController::class,'showinvbycustomer'])->name('realestate.showinvbycustomer');
    Route::get('/realestate/searchdeposit', [App\Http\Controllers\RealEstateController::class,'searchdeposit'])->name('realestate.searchdeposit');
    Route::post('/realestate/deletepayment', [App\Http\Controllers\RealEstateController::class,'deletepayment'])->name('realestate.deletepayment');
    Route::get('/realestate/showromloslist', [App\Http\Controllers\RealEstateController::class,'showromloslist'])->name('realestate.showromloslist');
    Route::get('/realestate/closelist', [App\Http\Controllers\RealEstateController::class,'closelist'])->name('realestate.closelist');
    Route::get('/realestate/updateinfo', [App\Http\Controllers\RealEstateController::class,'updateinfo'])->name('realestate.updateinfo');

    Route::get('/realestate/searchcloselist', [App\Http\Controllers\RealEstateController::class,'searchcloselist'])->name('realestate.searchcloselist');
    Route::get('/realestate/searchpaymentreport', [App\Http\Controllers\RealEstateController::class,'searchpaymentreport'])->name('realestate.searchpaymentreport');

    Route::get('/realestate/fixpayment', [App\Http\Controllers\RealEstateController::class,'fixpayment'])->name('realestate.fixpayment');

    Route::get('/realestate/searchcustomerpayromlos', [App\Http\Controllers\RealEstateController::class,'searchcustomerpayromlos'])->name('realestate.searchcustomerpayromlos');
    Route::get('/realestate/showcommissionpaid', [App\Http\Controllers\RealEstateController::class,'showcommissionpaid'])->name('realestate.showcommissionpaid');
    Route::get('/realestate/showcommissionpaidlist', [App\Http\Controllers\RealEstateController::class,'showcommissionpaid_detail'])->name('realestate.showcommissionpaid_detail');
    Route::get('/realestate/showcommissionlink', [App\Http\Controllers\RealEstateController::class,'showcommissionlink'])->name('realestate.showcommissionlink');
    Route::get('/realestate/linkpaycommission', [App\Http\Controllers\RealEstateController::class,'linkpaycommission'])->name('realestate.linkpaycommission');

    Route::get('/realestate/getnewpayment', [App\Http\Controllers\RealEstateController::class,'getnewpayment'])->name('realestate.getnewpayment');
    Route::post('/realestate/savenewpayromlos', [App\Http\Controllers\RealEstateController::class,'savenewpayromlos'])->name('realestate.savenewpayromlos');
    Route::post('/realestate/updateterm', [App\Http\Controllers\RealEstateController::class,'updateterm'])->name('realestate.updateterm');
    Route::post('/realestate/updatecommissionlink', [App\Http\Controllers\RealEstateController::class,'updatecommissionlink'])->name('realestate.updatecommissionlink');
    Route::post('/realestate/deletenewpayromlos', [App\Http\Controllers\RealEstateController::class,'deletenewpayromlos'])->name('realestate.deletenewpayromlos');

    Route::get('/realestate/buypaymentcompleted', [App\Http\Controllers\RealEstateController::class,'buypaymentcompleted'])->name('realestate.buypaymentcompleted');

    Route::get('/realestate/printromloslistforcustomer', [App\Http\Controllers\RealEstateController::class,'printromloslistforcustomer'])->name('realestate.printromloslistforcustomer');

    Route::get('/realestate/searchromlos', [App\Http\Controllers\RealEstateController::class,'searchromlos'])->name('realestate.searchromlos');
    Route::get('/realestate/depositprint', [App\Http\Controllers\RealEstateController::class,'depositprint'])->name('realestate.depositprint');
    Route::get('/realestate/depositprint1', [App\Http\Controllers\RealEstateController::class,'depositprint1'])->name('realestate.depositprint1');
    Route::post('/realestate/deletepaidcommission', [App\Http\Controllers\RealEstateController::class,'deletepaidcommission'])->name('realestate.deletepaidcommission');
    Route::get('/realestate/removecommission', [App\Http\Controllers\RealEstateController::class,'removecommission'])->name('realestate.removecommission');
    Route::post('/realestate/deletepaidcommissionall', [App\Http\Controllers\RealEstateController::class,'deletepaidcommissionall'])->name('realestate.deletepaidcommissionall');

    Route::get('/realestate/getcommissionlist', [App\Http\Controllers\RealEstateController::class,'getcommissionlist'])->name('realestate.getcommissionlist');
    Route::get('/realestate/getcommissionlist/print', [App\Http\Controllers\RealEstateController::class,'getcommissionlist'])->name('realestate.getcommissionlistprint');
    Route::get('/realestate/getcommissionlistall', [App\Http\Controllers\RealEstateController::class,'getcommissionlistall'])->name('realestate.getcommissionlistall');
    Route::get('/realestate/getpaidcommission', [App\Http\Controllers\RealEstateController::class,'getpaidcommission'])->name('realestate.getpaidcommission');

    Route::get('/realestate/docontract', [App\Http\Controllers\RealEstateController::class,'docontract'])->name('realestate.docontract');
    Route::get('/realestate/buyersalerlocalstorage', [App\Http\Controllers\RealEstateController::class,'buyersalerlocalstorage'])->name('realestate.buyersalerlocalstorage');
    Route::get('/realestate/printcontract', [App\Http\Controllers\RealEstateController::class,'printcontract'])->name('realestate.printcontract');
    Route::get('/realestate/getcontract', [App\Http\Controllers\RealEstateController::class,'getcontract'])->name('realestate.getcontract');
    Route::get('/realestate/findcontract', [App\Http\Controllers\RealEstateController::class,'findcontract'])->name('realestate.findcontract');
    Route::get('/realestate/incomeexpanse/print', [App\Http\Controllers\RealEstateController::class,'print_income_expanse_report'])->name('realestate.printincomeexpansereport');
    Route::get('/realestate/editcontract', [App\Http\Controllers\RealEstateController::class,'editcontract'])->name('realestate.editcontract');
    Route::post('/realestate/deletecontract', [App\Http\Controllers\RealEstateController::class,'deletecontract'])->name('realestate.deletecontract');
    Route::post('/realestate/updatetempcommission', [App\Http\Controllers\RealEstateController::class,'updatetempcommission'])->name('realestate.updatetempcommission');

});
Route::group(['middleware'=>['auth']],function(){

    Route::get('/thaicashdraw/thaisms/pop', [App\Http\Controllers\ThaiController::class,'thaisms'])->name('thaicashdraw.thaisms_pop');
    Route::get('/thaicashdraw/cashdraw/pop', [App\Http\Controllers\ThaiController::class,'cashdraw'])->name('thaicashdraw.cashdraw_pop');
    Route::get('/thaicashdraw/cashdraw1/pop', [App\Http\Controllers\ThaiController::class,'cashdraw1'])->name('thaicashdraw.cashdraw1_pop');
    Route::get('/moneytransfer/formtransfer/pop', [App\Http\Controllers\MoneyTransferController::class,'formtransaction'])->name('moneytransfer.formtransfer_pop');
    Route::get('/moneytransfer/banktransfer/pop', [App\Http\Controllers\MoneyTransferController::class,'banktransfer'])->name('moneytransfer.banktransfer_pop');
    Route::get('/moneytransfer/wingtransfer/pop', [App\Http\Controllers\MoneyTransferController::class,'wingtransfer'])->name('moneytransfer.wingtransfer_pop');
    Route::get('/moneytransfer/customertransfer/pop', [App\Http\Controllers\MoneyTransferController::class,'customertransfer'])->name('moneytransfer.customertransfer_pop');
    Route::get('/moneytransfer/quicktransfer/pop', [App\Http\Controllers\MoneyTransferController::class,'quicktransfer'])->name('moneytransfer.quicktransfer_pop');
    Route::get('/usercapital/index/pop', [App\Http\Controllers\UserCapitalController::class,'index'])->name('usercapital.index_pop');
    Route::get('/usercapital/closelist/pop', [App\Http\Controllers\UserCapitalController::class,'closelist'])->name('usercapital.closelist_pop');
    Route::get('/usercapital/usertransactionreport/pop', [App\Http\Controllers\UserCapitalController::class,'usertransactionreport'])->name('usercapital.usertransactionreport_pop');
    Route::get('/exchange/pop', [App\Http\Controllers\ExchangeController::class,'index'])->name('exchange.index_pop');
    Route::get('/moneytransfer/cashdraw/pop', [App\Http\Controllers\MoneyTransferController::class,'cashdraw'])->name('moneytransfer.cashdraw_pop');
    Route::get('/partnerlist/indexnew/pop', [App\Http\Controllers\PartnerListController::class,'indexnew'])->name('partnerlist.indexnew_pop');
    Route::get('/partnerlist/exchangelistpop/{partnerid}', [App\Http\Controllers\PartnerListController::class,'exchangelist'])->name('partnerlist.exchangelist_pop');
    Route::get('/expanseincome/pop', [App\Http\Controllers\ExpanseController::class,'index'])->name('expanseincome.index_pop');
    Route::get('/closelist/index/pop', [App\Http\Controllers\CloseListController::class,'index'])->name('closelist.index_pop');
});
