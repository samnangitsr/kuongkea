@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;
    
    }
    if($dc>2){
        $dc=2;
    }
    return number_format($num,$dc,'.',',');
}
@endphp

@foreach ($closelists as $key => $cl)
    <tr>
        <td class="kh22" style="padding:0px;text-align:center;width:80px;">{{ ++$key }}</td>
        <td class="kh22" style="padding:0px;">
            <input type="text" name="desr[]" value="{{ $cl->desr }}" style="width:100%;height:auto;border-style:none;" readonly>
        </td>
        <td class="kh22" style="padding:0px;width:200px;">
           
            <input type="text" name="usd[]" value="{{ phpformatnumber($cl->usd) . ' USD'}}" style="text-align:right;width:200px;border-style:none;" readonly>
        </td>
        
        <td class="kh22" style="padding:0px;width:300px;">
           
            <input type="text" name="khr[]" value="{{ phpformatnumber($cl->khr) . ' KHR'}}" style="text-align:right;width:300px;border-style:none;" readonly>
        </td>
        <td class="kh22" style="padding:0px;width:250px;">
           
            <input type="text" name="thb[]" value="{{ phpformatnumber($cl->thb) . ' THB'}}" style="text-align:right;width:250px;border-style:none;" readonly>
        </td>
        <td class="kh22" style="padding:0px;width:200px;">
           
            <input type="text" name="inusd[]" value="{{ phpformatnumber($cl->inusd)  . ' USD'}}" style="text-align:right;width:200px;border-style:none;" readonly>
        </td>
        <td class="kh22" style="padding:0px;width:200px;display:none;">
           
            <input type="text" name="modelname[]" value="{{ $cl->modelname }}" style="text-align:right;width:200px;border-style:none;" readonly>
        </td>
        
    </tr>
@endforeach
<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 class="kh22" style="padding:0px;">
        <input type="text" name="total_desr" value="សរុប/Total" style="width:auto;border-style:none;text-align:center;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;text-align:right;">
        <input type="text" name="total_usd" value="{{ phpformatnumber($total->tusd) . ' USD' }}" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    
    <td class="kh22" style="padding:0px;text-align:right;">
       
        <input type="text" name="total_khr" value="{{ phpformatnumber($total->tkhr) . ' KHR' }}" style="text-align:right;width:300px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;text-align:right;">
       
        <input type="text" name="total_thb" value="{{ phpformatnumber($total->tthb) . ' THB' }}" style="text-align:right;width:250px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;text-align:right;">
       
        <input type="text" name="total_inusd" id="total_inusd" value="{{ phpformatnumber($totalallinusd) . ' USD' }}" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    
</tr>
@php
    $thb=1;
    $khr=1;
@endphp
@foreach ($todayrate as $r)
    @if($r->shortcut=='THB')
        @php
            $thb=$r->ratebuy . ',' . $r->ratesale;
        @endphp
    @endif
    @if($r->shortcut=='KHR')
        @php
            $khr=$r->ratebuy . ',' . $r->ratesale;
        @endphp
    @endif
@endforeach

<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 class="kh22" style="padding:0px;">
        <input type="text" name="ratedesr" value="អត្រាប្តូរប្រាក់/Exchange Rate" style="width:100%;border-style:none;text-align:center;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;width:150px;">
        <input type="text" name="rateusd" value="1" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;width:150px;">
        <input type="text" name="ratekhr" value="{{ $khr }}" style="text-align:right;width:300px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh22" style="padding:0px;width:150px;">
        <input type="text" name="ratethb" value="{{ $thb }}" style="text-align:right;width:250px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    
    <td class="kh22" style="padding:0px;width:150px;display:none;">
        <input type="text" name="pl" id="pl" value="0" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
   
</tr>