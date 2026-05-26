<?php

namespace App;

use App\Stock;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $active
 * @property mixed $buy
 * @property mixed $company_id
 * @property mixed $created_at
 * @property mixed $curname
 * @property mixed $decpoint
 * @property mixed $imglocation
 * @property mixed $imgpath
 * @property mixed $iscustomerdisplay
 * @property mixed $isexchangecur
 * @property mixed $isfn
 * @property mixed $isgold
 * @property mixed $ismain
 * @property mixed $ispandp
 * @property mixed $lmr
 * @property mixed $lomeang
 * @property mixed $no
 * @property mixed $optsign
 * @property mixed $partner_cur
 * @property mixed $rate_buy
 * @property mixed $ratebuy
 * @property mixed $ratesale
 * @property mixed $ratio
 * @property mixed $sale
 * @property mixed $shortcut
 * @property mixed $sk
 * @property mixed $skey
 * @property mixed $tuochek
 * @property mixed $updated_at
 * @property mixed $user_connect
 * @property mixed $user_id
 */
class Currency extends Model
{
    // protected $fillable = [
    //     'shortcut'
    // ];
      public function company()
    {
    	return $this->belongsTo('App\Company','company_id')->withDefault(['name' =>'']);
    }
   static function productstock($curid)
    {

       $pstock= Stock::query()->where('currency_id',$curid)->orderBy('id', 'desc')->first();
       if($pstock){
        return $pstock->stock;
       }else{
        return 0;
       }

    }
    static function stockamount($curid)
    {

       $stockamt= Stock::query()->where('currency_id',$curid)->orderBy('id', 'desc')->first();
       if($stockamt){
           return $stockamt->amount;
       }else{
        return 0;
       }
    }
    static function ratestock($curid)
    {
      $rate=0;
      $stock=0;
      $amt=0;
      $pstock= Stock::query()->where('currency_id',$curid)->orderBy('id', 'desc')->first();
       if($pstock){
         $stock= $pstock->stock;
         $amt=$pstock->amount;
       }
       $c=Currency::where('id',$curid)->first();
       if($c->optsign=='*'){
         if($stock<>0){
            $rate=$amt/$stock;
         }else{
          $rate=$c->ratebuy;
         }
       }else{
         if($amt<>0){
            $rate=$stock/$amt;
         }else{
          $rate=$c->ratebuy;
         }
       }

      return $rate;
    }
}
