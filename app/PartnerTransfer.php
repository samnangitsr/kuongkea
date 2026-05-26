<?php

namespace App;

use App\Models\AgentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PartnerTransfer extends Model
{
     function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;

        }
        return number_format($num,$dc,'.',',');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function useraffect()
    {
        return $this->belongsTo('App\User','user_affect')->withDefault(['name'=>'']);
    }
    public function userdelete()
    {
        return $this->belongsTo('App\User','user_delete')->withDefault(['name'=>'']);
    }
    public function usercode()
    {
        return $this->belongsTo('App\User','docodeby')->withDefault(['name'=>'']);
    }
    public function cashdraw()
    {
    	return $this->belongsTo('App\Cashdraw');
    }
    public function customer()
    {
    	return $this->belongsTo('App\Customer')->withDefault(['name' =>'']);
    }
    public function partner()
    {
    	return $this->belongsTo('App\Customer','parrent_id')->withDefault(['name' =>''])->with('agenttype');
    }
    public function frompartner()
    {
        return $this->belongsTo('App\Customer','from_partner_id')->withDefault(['name'=>'']);
    }
    public function currency()
    {
    	return $this->belongsTo('App\Currency')->withDefault(['shortcut' =>'']);
    }
    public function cuschargecur()
    {
    	return $this->belongsTo('App\Currency','cuscharge_currency_id')->withDefault(['shortcut' =>'']);
    }
    public function feecurrency()
    {
    	return $this->belongsTo('App\Currency','fee_currency_id')->withDefault(['shortcut' =>'']);
    }
    public function thaicur()
    {
    	return $this->belongsTo('App\Currency','thai_cur')->withDefault(['shortcut' =>'']);
    }
    public function customerchildren()
    {
    	return $this->belongsTo('App\CustomerChild','child_id','id' )->withDefault(['name' =>'']);
    }
    static public function showbyid($id){
        $partnertransfer=PartnerTransfer::where('id',$id)->get();
        return $partnertransfer;
    }
    static public function showbygroup($id,$groupid){
        $partnertransfer=PartnerTransfer::whereNotNull('ref_group_id')->where('ref_group_id',$groupid)->where('status',1)->orderBy('id')->get();
        return $partnertransfer;
    }

    static public function showByIdAndGroup_old($id) {
        $transfer = PartnerTransfer::find($id);

        if (!$transfer) {
            return null;
        }

        if ($transfer->ref_group_id) {
            return PartnerTransfer::where('ref_group_id', $transfer->ref_group_id)
                ->where('status', 1)
                ->orderBy('id')
                ->get();
        }

        return $transfer;
    }
    static public function showByIdAndGroup($refgroup) {
        $parts = explode('-', $refgroup);
        $id = end($parts); // will be "33" if transfer-33, or "12" if just 12

        $transfer = PartnerTransfer::find($id);
        if (!$transfer) {
            return collect(); // empty collection
        }

        if ($transfer->ref_group_id) {
            return PartnerTransfer::where('ref_group_id', $transfer->ref_group_id)
                ->orderBy('id')
                ->get();
        }

        return collect([$transfer]); // single model in a collection
    }

    static public function showbygroupall($groupid){
        $partnertransfer=PartnerTransfer::whereNotNull('ref_group_id')->where('ref_group_id',$groupid)->orderBy('id')->get();
        return $partnertransfer;
    }
    static public function showbygroupsale($id,$groupid){
        $partnertransfer=PartnerTransfer::whereNotNull('ref_group_id')->where('ref_group_id',$groupid)->where('id','<>',$id)->where('status',1)->orderBy('id')->get();
        return $partnertransfer;
    }
    static public function showbyrefgroupid($id,$refgroupid){
      $transfers=PartnerTransfer::where('ref_group_id',$refgroupid)->where('id','<>',$id)->where('isshow',1)->orderBy('id')->get();
      $exchanges=Exchange::where('ref_group_id',$refgroupid)->orderBy('id')->get();
      //return $exchanges;
      return array($exchanges,$transfers);
      // $c=collect();
      //   if($transfers && $transfers->count()>0){
      //     foreach($transfers as $t){
      //       $c=$c->push(['dd'=>$t->dd,'tt'=>$t->tt,'amt'=> $t->amount]);
      //     }
      //   }
      // return $c;

    }
    static public function showbyrefgroupid8($id,$refgroupid){
        $transfers=PartnerTransfer::where('ref_group_id',$refgroupid)->where('id','>',$id)->where('amount','>','0')->where('status',1)->orderBy('id')->get();
        $cashdraw=Cashdraw::where('ref_group_id',$refgroupid)->where('status',1)->get();
        return array($cashdraw,$transfers);
    }
    static public function showcashdrawref($refid){
        $cashdraws=Cashdraw::where('id',$refid)->where('status',1)->get();
        return $cashdraws;
    }
    static public function linkrefnum($refnum){
        $datarefs=null;
        $arr=explode("-",$refnum);
        if($arr[0]=='transfer'){
            $datarefs=PartnerTransfer::where('id',$arr[1])->where('status',1)->get();

        }else if($arr[0]=='exchange'){
            $datarefs=ExchangeMulti::where('status',1)->where('mapcode',$arr[1])->get();

        }else if($arr[0]=='usercapital'){
            $datarefs=UserCapital::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
        }
        return $datarefs;

    }
    static public function showref_number($refnum){
      $datarefs=null;
      $arr=explode("-",$refnum);
      if($arr[0]=='transfer'){
          $datarefs=PartnerTransfer::where('id',$arr[1])->where('status',1)->orderBy('id')->get();
      }else if($arr[0]=='exchange'){
          $datarefs=ExchangeMulti::where('status',1)->where('mapcode',$arr[1])->orderBy('id')->get();
      }else if($arr[0]=='usercapital'){
          $datarefs=UserCapital::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
      }else if($arr[0]=='cashdraw'){
          $datarefs=Cashdraw::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
      }else if($arr[0]=='exchangelist'){
        $datarefs=PartnerExchangeList::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
    }
      return $datarefs;
  }
  static public function showgroupid($groupid){
    $datarefs=null;

    $arr=explode("-",$groupid);
    if($arr[0]=='transfer' || $arr[0]=='moneyoffer'){
        $datarefs=PartnerTransfer::where('ref_group_id',$groupid)->where('status',1)->orderBy('id')->get();
    }else if($arr[0]=='exchange'){
        $datarefs=ExchangeMulti::where('status',1)->where('ref_group_id',$groupid)->orderBy('id')->get();
    }else if($arr[0]=='usercapital'){
        $datarefs=UserCapital::where('status',1)->where('ref_number',$groupid)->orderBy('id')->get();
    }else if($arr[0]=='cashdraw'){
        // $cashdraws=Cashdraw::where('status',1)->where('ref_group_id',$groupid)->orderBy('id')->get();
        // $transfers=PartnerTransfer::where('ref_group_id',$groupid)->where('status',1)->orderBy('id')->get();
        $cashdraws = Cashdraw::where('status', 1)
        ->where('ref_group_id', $groupid)
        ->get()
        ->map(function ($item) {
            return (object)[
                'id' => $item->id ,
                'tt'=>$item->optime,
                'dd'=>$item->opdate,
                'amount' => phpformatnumber($item->amount) . $item->currency->sk,
                'fee'=>0,
                'interest'=>0,
                'cuscharge'=>phpformatnumber($item->customer_charge) . $item->cuschargecur->sk,
                'saveby' => $item->user->name ?? '',
                'partner_name' => $item->frompartner->name ?? '',
                'tranname' => 'Cash Draw', // static label or $item->tt
                'receive'=>$item->receive_name .' '. $item->receive_tel,
                'sender'=>$item->paymethod,
                'useraffect'=>'',
                'note'=>$item->note,
                'created_at' => $item->created_at,
                'tablename'=>'Cashdraw'
            ];
        });

        $transfers = PartnerTransfer::where('status', 1)
            ->where('ref_group_id', $groupid)
            ->get()
            ->map(function ($item) {
               return (object)[
                    'id' => $item->id ,
                    'dd'=>$item->dd,
                    'tt'=>$item->tt,
                    'amount' => phpformatnumber($item->amount) . $item->currency->sk,
                    'fee'=>phpformatnumber($item->fee) . $item->feecurrency->sk,
                    'interest'=>phpformatnumber($item->interest) . $item->currency->sk,
                    'cuscharge'=>phpformatnumber($item->customer_charge) . $item->cuschargecur->sk,
                    'saveby' => $item->user->name ?? '',
                    'partner_name' => $item->partner->name ?? '',
                    'tranname' => $item->tranname,
                    'receive'=>$item->rectel . ' ' . $item->recname,
                    'sender'=>$item->sendertel . ' ' . $item->sendername,
                    'useraffect'=>$item->useraffect->name,
                    'note'=>$item->note,
                    'created_at' => $item->created_at,
                    'tablename'=>'Transfer'
                ];
            });
        $datarefs = $cashdraws->merge($transfers);
    }else if($arr[0]=='exchangelist'){
      $datarefs=PartnerExchangeList::where('status',1)->where('id',$arr[1])->orderBy('id')->get();
  }
  //dd($datarefs);
    return $datarefs;

}
  static public function doshortcut($shortcut){
    $cur=Currency::where('shortcut',$shortcut)->first();
    if($cur){
        return $cur->sk;
    }else{
        if($shortcut=='USD'){
          return '$';
        }elseif($shortcut=='THB'){
          return 'B';
        }elseif($shortcut=='KHR'){
          return 'R';
        }elseif($shortcut=='VND'){
          return 'D';
        }else{
          return $shortcut;
        }
    }
  }
}
