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
@foreach ($invoices as $key => $inv)
    <tr class="@if($inv->total>0) cgr @endif kh22">
        <td  style="text-align:center;">{{ ++$key }}</td>
        <td  title="{{ $inv->id }}">
            <div class="form-check">
                <input class="form-check-input ckinv" type="checkbox" value="" id="ck{{ $key }}">
                <label class="form-check-label kh22" for="ck{{ $key }}">{{ sprintf("%04d",$inv->id) }}</label>
            </div>
        </td>
        <td >
            {{ date('d-m-Y',strtotime($inv->invdate)) }}
        </td>
        <td >
            {{ $inv->invtime }}
        </td>
        <td >
            {{ $inv->user->name }}
        </td>
       
        <td  title="{{ $inv->customer_id }}">
            {{ $inv->customer->name }}
        </td>
        <td >
            {{ phpformatnumber($inv->totalweight) . 'លី' }}
        </td>
        <td  style="text-align:right;">
            {{ phpformatnumber($inv->total) }}
        </td>
        <td >
            {{ $inv->cur }}
        </td>
        <td  style="text-align:right;">
            {{ phpformatnumber($inv->deposit) }}
        </td>
        <td>
            {{ $inv->cur }}
        </td>
        <td  style="text-align:right;">
            {{ phpformatnumber($inv->total-$inv->deposit) }}
        </td>
        <td >
            {{ $inv->cur }}
        </td>
        <td style="text-align:center;padding-top:10px;">
            <a href="{{ route('invoice.invoicedetail',['invid'=>$inv->id]) }}" target="_blank">
                Edit
            </a>
        </td>
    </tr>
@endforeach