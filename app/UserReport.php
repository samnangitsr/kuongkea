<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function currency()
    {
    	return $this->belongsTo('App\Currency');
    }
    public static function exchangetousd($total,$curid,$dd)
    {
        $r=0;
        $s='';
        $c=Currency::find($curid);
        $exr=ExchangeRate::whereDate('dd',$dd)->where('currency_id',$curid)->orderBy('id','DESC')->first();
        $s=$c->optsign;
        // if($total>0){
        //     $r=$c->ratebuy;
        //     if($c->optsign=='/'){
        //         $x=$total/$c->ratebuy;
        //     }else{
        //         $x=$total*$c->ratebuy;
        //     }
        // }else{
        //     $r=$c->ratesale;
        //     if($c->optsign=='/'){
        //         $x=$total/$c->ratesale;
        //     }else{
        //         $x=$total*$c->ratesale;
        //     }
        // }
        if($exr){
            $r=$exr->ratebuy;
        }else{
            $r=$c->ratebuy;
        }
        if($c->optsign=='/'){
            $x=$total/$r;
        }else{
            $x=$total*$r;
        }

        return [$x,$r,$s];
    }
}
