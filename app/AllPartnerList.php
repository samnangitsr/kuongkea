<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllPartnerList extends Model
{
    public function customer()
    {
    	return $this->belongsTo('App\Customer')->withDefault(['name' =>'']);
    }
    public static function exchangetousd($total,$shortcut)
    {
        $r=0;
        $s='';
        $c=Currency::where('shortcut',$shortcut)->first();
        $s=$c->optsign;
        if($total>0){
            $r=$c->ratebuy;
            if($c->optsign='/'){
                $x=$total/$c->ratebuy;
            }else{
                $x=$total*$c->ratebuy;
            }
        }else{
            $r=$c->ratesale;
            if($c->optsign='/'){
                $x=$total/$c->ratesale;
            }else{
                $x=$total*$c->ratesale;
            }
        }
        return [$x,$r,$s];
    }
}
