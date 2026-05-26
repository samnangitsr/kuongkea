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
    <tr class="@if($inv->totalweight>0) blue  @else red @endif kh22">
        <td class="">{{ ++$key }}</td>
        <td class="">
            
            <a href="{{ route('invoice.invoicedetail',['invid'=>$inv->id]) }}" target="_blank" class="@if($inv->totalweight>0) blue  @else red @endif">
                {{ sprintf("%04d",$inv->id) }}
                
            </a>
        </td>
        <td class="">
            {{ date('d-m-Y',strtotime($inv->invdate)) }}
        </td>
        <td class="">
            {{ $inv->invtime }}
        </td>
        <td class="">
            {{ $inv->user->name }}
        </td>
        <td class="">
            {{ $inv->customer->name }}
        </td>
        <td class="">
            {{ phpformatnumber($inv->totalweight) . 'លី' }}
        </td>
        <td class="">
            {{ phpformatnumber($inv->total) . $inv->cur }}
        </td>
        <td class="">
            {{ phpformatnumber($inv->deposit) . $inv->cur }}
        </td>
        <td class="">
            {{ phpformatnumber($inv->total-$inv->deposit) . $inv->cur }}
        </td>
        <td>
            @if($inv->deposit==0)
            <a href="#" class="btn btn-sm btn-danger btndelinv" data-id="{{ $inv->id }}" data-deposit="{{ $inv->deposit }}">Delete</a>
        @endif
        </td>
    </tr>
@endforeach