@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen((float)$fp)-2;
            //$dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    function phpformatnumber2d($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            // $fp=substr($num,$p,strlen($num)-$p);
            // $dc=strlen((float)$fp)-2;

            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
     function bongkot($amount,$cur)
      {
        if($cur=='KHR'){
            $amt = round($amount / 100) * 100;
        }else if($cur=='THB'){
            $amt = round($amount);
        }else{
            $amt=$amount;
        }
        if($cur=='USD'){
            return phpformatnumber2d($amt);
        }else{
            return phpformatnumber($amt);
        }
      }
@endphp
@php
    $usdin=0;
    $usdout=0;
    $pl=0;
    $total2=0;
    $totalusd2=0;
    $sumtotalusd=0;
    $sumbalendinusd=0;
    $overleft=0;
@endphp

        @foreach ($report as $key=>$r)
        @php
            $usdin =$usdin + $r->amtsale;
            $usdout=$usdout + $r->amtbuy;
            $total=$r->capital + $r->buyin + $r->saleout + $r->cashin + $r->cashout+$r->capitalend+$r->fee_in+$r->fee_out;
            $total2=$r->capital + $r->buyin + $r->saleout + $r->cashin + $r->cashout+$r->fee_in+$r->fee_out;
            $balance=$r->capital + $buysaleusd->tbuy + $buysaleusd->tsale + abs($acc->accpay) - $acc->accrec + $r->cashin + $r->cashout+$r->fee_in+$r->fee_out;
            $usdtotal=$r->capital + $buysaleusd->tbuy + $buysaleusd->tsale + abs($acc->accpay) - $acc->accrec + $r->cashin + $r->cashout+$r->fee_in+$r->fee_out;
            $overleft=  abs($r->cashout)+abs($r->capitalend)+abs($r->fee_out)-($r->capital + $r->cashin+$r->fee_in);

        @endphp
        @if($r->currency->ismain==1)
            @php
                //$pl +=$balance;
                $pl +=$overleft;
                $sumtotalusd +=$usdtotal;
                $sumbalendinusd+=$r->capitalend;
            @endphp
            <tr class="kh14-b">
                <td style="text-align:center;">{{ ++$key }} <br>
                    <a href="{{ route('usercapital.seedetail',[$r->currency_id,$r->currency->curname,$r->currency->shortcut,$r->currency->isexchangecur,$r->currency->ismain,$r->viewdate,$r->user_id,$r->user->name,$fromdate,$ckcash,1,1,0]) }}" class="mybtn kh12-b" style="" target="_Blank">View</a>
                </td>
                <td style="text-align:center;display:none;">
                    <input type="text" style="border-style:none;width:60px;background-color:transparent" name="curid[]" value="{{ $r->currency_id }}">
                </td>
                <td style="">{{ $r->currency->curname }} <br> {{ $r->currency->shortcut }}</td>
                <td style="text-align:right;color:blue;">{{ phpformatnumber($r->capital) . '$' }}</td>
                <td style="text-align:right;color:blue;">{{ phpformatnumber($buysaleusd->tbuy) }}</td>
                <td style="text-align:right;color:red;">{{ phpformatnumber($buysaleusd->tsale) }}</td>
                <td style="text-align:right;color:blue;">
                    {{ phpformatnumber($r->cashin) }}
                    <br>+{{phpformatnumber2d($r->fee_in)}}
                </td>
                <td style="text-align:right;color:red;">{{ phpformatnumber($r->cashout) }}
                    <br>{{phpformatnumber2d($r->fee_out)}}
                </td>
                <td style="text-align:right;font-weight:bold;{{ $balance>=0?'color:blue;':'color:red;' }}">
                    <span style="font-weight:bold;" class="userbalance">{{ phpformatnumber2d($balance) }}</span><span style="font-weight:bold;">{{ $r->currency->sk }}</span> <br>
                </td>
                <td style="text-align:right;">{{ phpformatnumber($r->capitalend) }}</td>
                <td style="text-align:right;font-weight:bold;{{ abs($r->capitalend) - $balance>=0?'color:blue;':'color:red;' }}">
                    <span style="font-weight:bold;" class="">{{ phpformatnumber2d(abs($r->capitalend) - $balance) }}</span><span style="font-weight:bold;">{{ $r->currency->sk }}</span> <br>
                </td>
                {{-- <td style="text-align:right;text-align:right;color:red">{{ phpformatnumber(abs($acc->accpay)) }}</td>
                <td style="text-align:right;color:blue;">{{ phpformatnumber($acc->accrec) }}</td> --}}
                <td style="font-weight:bold;{{ $overleft>=0?'color:blue;':'color:red;' }} text-align:right;">{{ phpformatnumber2d($overleft) . $r->currency->sk}}</td>
            </tr>
        @else
            @php

                $totalinusd =App\UserReport::exchangetousd($total,$r->currency_id,$viewdate);
                $overleftinusd =App\UserReport::exchangetousd($overleft,$r->currency_id,$viewdate);
                $total2usd =App\UserReport::exchangetousd($total2,$r->currency_id,$viewdate);
                $balendinusd =App\UserReport::exchangetousd($r->capitalend,$r->currency_id,$viewdate);

                $pl+=$overleftinusd[0];
                $sumtotalusd +=$total2usd[0];
                $sumbalendinusd+=$balendinusd[0];
            @endphp
         <tr class="kh14-b">
             <td style="text-align:center;">{{ ++$key }} <br>
                <a href="{{ route('usercapital.seedetail',[$r->currency_id,$r->currency->curname,$r->currency->shortcut,$r->currency->isexchangecur,$r->currency->ismain,$r->viewdate,$r->user_id,$r->user->name,$fromdate,$ckcash,1,1,0]) }}" class="mybtn kh12-b" style="margin-top:8px;" target="_Blank">View</a>
             </td>
             <td style="text-align:center;display:none;">
                 <input type="text" style="border-style:none;width:60px;background-color:transparent" name="curid[]" value="{{ $r->currency_id }}">
             </td>
             <td style="">{{ $r->currency->curname }} <br> {{ $r->currency->shortcut }}</td>
             <td style="text-align:right;color:blue;">{{ bongkot($r->capital,$r->currency->shortcut) .  $r->currency->sk  }}</td>
             <td style="text-align:right;color:blue;" title="{{ phpformatnumber($r->buyin) }}">
                 {{ bongkot($r->buyin,$r->currency->shortcut) }} <br>
                 <span class="badge bg-secondary kh12-b">{{ phpformatnumber($r->amtbuy) . '$' }}</span>
             </td>
             <td style="text-align:right;color:red;" title="{{ phpformatnumber($r->saleout) }}">
                 {{ bongkot($r->saleout,$r->currency->shortcut) }} <br>
                 <span class="badge bg-secondary kh12-b">+{{ phpformatnumber($r->amtsale) . '$' }}</span>
             </td>
             <td style="text-align:right;color:blue;">{{ bongkot($r->cashin,$r->currency->shortcut) }}<br>+{{bongkot($r->fee_in,$r->currency->shortcut)}}</td>
             <td style="text-align:right;color:red;">{{ bongkot($r->cashout,$r->currency->shortcut) }}<br>{{bongkot($r->fee_out,$r->currency->shortcut)}}</td>
             <td style="text-align:right;{{ $total2>=0?'color:blue;':'color:red;' }}"><span style="font-weight:bold;" class="userbalance">
                {{ bongkot($total2,$r->currency->shortcut) }}</span><span style="font-weight:bold;">{{ $r->currency->sk }}</span><br>
                    {{ $total2usd[2] . phpformatnumber($total2usd[1]). '=' }} <span class="badge bg-success">{{ phpformatnumber2d($total2usd[0]) . '$' }}</span>
            </td>
             <td style="text-align:right;">
                <span style="font-weight:bold;">{{ bongkot($r->capitalend,$r->currency->shortcut) }}</span> <br>
                <span class="kh12-b">{{ $balendinusd[2] . phpformatnumber($balendinusd[1]). '=' }}</span><span class="badge bg-success kh12-b">{{ phpformatnumber2d($balendinusd[0]) . '$' }}</span>
             </td>
             <td style="text-align:right;{{ abs($r->capitalend) - $total2>=0?'color:blue;':'color:red;' }}"><span style="font-weight:bold;" class="">
                {{ bongkot(abs($r->capitalend) - $total2,$r->currency->shortcut) }}</span><span style="font-weight:bold;">{{ $r->currency->sk }}</span>
             </td>
             <td style="{{ $overleftinusd[0]>=0?'color:blue;':'color:red;' }} text-align:right;" class="">{{ bongkot($overleft,$r->currency->shortcut) . $r->currency->sk }}
                @if($overleft<>0)
                    {{ $overleftinusd[2] . phpformatnumber($overleftinusd[1]) }} <br> <span class="">={{ phpformatnumber2d($overleftinusd[0]) . '$' }}</span>
                @endif

             </td>

         </tr>
        @endif
     @endforeach
         <tr style="background-color:rgb(234, 234, 181)">
            <td colspan=2 class="kh18-b">ប្រាក់ចំណេញ</td>
            <td style="text-align:right;" class="kh18-b">{{ phpformatnumber2d($pl) . '$' }}</td>

            <td colspan=2 class="kh18-b" style="text-align:right;">សរុបដកចុងគ្រា</td>
            <td colspan=2 style="text-align:left;" class="kh18-b">{{ phpformatnumber2d($sumbalendinusd) . '$' }}</td>

            <td class="kh18-b" style="text-align:right;">សរុបស្តុក</td>
            <td style="text-align:right;" class="kh18-b">{{ phpformatnumber2d($sumtotalusd) . '$' }}</td>

            <td colspan=2></td>
         </tr>


