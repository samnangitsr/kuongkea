@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;

        }
        return number_format($num,$dc,'.',',');
    }
@endphp
@php
    $sumproduct =0;
    $sumamount =0;
    $sumdebt =0;
    $balance=0;
@endphp
@foreach ($userreportdetails as $key =>$d)
    @php
        $sumproduct += $d->buysale;
        $sumamount += $d->amount;
        $sumdebt +=$d->debt;
        $balance +=$d->amount-$d->debt;
    @endphp
    <tr>
        <td style="text-align:center;">{{ ++$key }}</td>
        <td class="kh12-b" style="text-align:right;">
              <input type="checkbox" name="ids[]" value="{{ $d->id }}" style="float:left;">
            <a  href="{{ route('usercapital.seedetaillink',['id'=>$d->tran_id,'group_id'=>$d->group_id,'tablename'=>$d->table,'fromdate'=>$d->from_date,'todate'=>$d->to_date,'ismain'=>$ismain,'userid'=>$userid,'curid'=>$curid,'curshortcut'=>$curshortcut,'username'=>$username]) }}" target="_blank" style="color:red;" class="mybtn">
                {{ $d->tran_id?$d->tran_id:'View' }}
            </a>
            @if($d->group_id)
                <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$d->group_id,'showdelbuton'=>false]) }}" class="mybtn" target="_blank" style="margin:0px;padding:2px;">{{ $d->group_id??'' }}</a>
            @endif
        </td>
        <td class="kh14-b">
            @if($d->invnum==null)
                {{ $d->description }}
            @else
                <a href="{{ route('invoice.invoicedetail',['invid'=>$d->invnum]) }}" target="_blank" class="@if($d->buysale>0) blue  @else red @endif">
                    {{ $d->description }}
                </a>
            @endif
        </td>
        <td class="kh14-b">
            {{ $d->capital_type }}
        </td>
        <td class="kh14-b">
            {{ $d->agent_name }}
        </td>

        <td class="kh14-b" style="text-align:right;@if($d->buysale>0) color:blue; @elseif($d->buysale<0) color:red; @endif">{{ phpformatnumber($d->buysale) . ' ' . $d->cur }}</td>
        <td class="kh14-b" style="text-align:right;@if($d->amount>0) color:blue; @elseif($d->amount<0) color:red; @endif">{{ phpformatnumber($d->amount) . ' USD'}}</td>
        {{-- <td style="text-align:right;">{{ phpformatnumber($d->deposit) . ' USD'}}</td>
        <td style="text-align:right;">{{ phpformatnumber($d->debt) . ' USD'}}</td> --}}
        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($balance) . ' USD'}}</td>
        <td class="kh12-b" style="text-align:right;">
            {{ date('d-m-y',strtotime($d->dd))}}
            @if($d->trantime>0)
                {{  ' ' . $d->trantime}}
            @endif
        </td>
        <td class="kh12-b" style="text-align:right;">{{ $d->note??'' }}</td>


    </tr>
@endforeach
<tr class="kh16-b">
<td colspan=5 style="text-align:center;">សរុប</td>
@if($ismain==0)
    <td style="text-align:right;background-color:greenyellow">{{ phpformatnumber($sumproduct) . ' ' . $curname }}</td>
@else
    <td></td>
@endif

<td style="text-align:right;background-color:greenyellow">{{ phpformatnumber($sumamount) . ' USD' }}</td>
<td style="text-align:right;"></td>
{{-- <td style="text-align:right;">{{ phpformatnumber($sumdebt) . ' USD'}}</td> --}}
</tr>
<tr class="kh16-b" style="background-color:aqua">
<td colspan=3 style="text-align:center;">សរុបទូទាត់</td>
<td colspan=4 style="text-align:right;">{{ phpformatnumber($sumamount-$sumdebt) . ' USD' }}</td>

</tr>
