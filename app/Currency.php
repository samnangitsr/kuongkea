<?php

namespace App;

use App\Stock;
use Illuminate\Database\Eloquent\Model;

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
