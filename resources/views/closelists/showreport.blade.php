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

@foreach ($closelistdetails as $key => $cl)
    <tr>
        <td class="kh16" style="padding:2px 0px;text-align:center;width:60px;">{{ ++$key }}</td>
        <td class="kh16" style="padding:0px;">
            <input class="kh16" type="text" name="desr[]" value="{{ $cl->desr }}" style="width:100%;border-style:none;" readonly>
        </td>
        <td class="kh16" style="padding:0px;width:150px;">
            <input class="kh16-b" type="text" name="usd[]" value="{{ phpformatnumber($cl->usd) }}" style="text-align:right;width:150px;border-style:none;" readonly>
        </td>
        <td class="kh16" style="padding:0px;width:150px;">
            <input class="kh16-b" type="text" name="thb[]" value="{{ phpformatnumber($cl->thb) }}" style="text-align:right;width:150px;border-style:none;" readonly>
        </td>
        <td class="kh16" style="padding:0px;width:150px;">
            <input class="kh16-b" type="text" name="khr[]" value="{{ phpformatnumber($cl->khr) }}" style="text-align:right;width:150px;border-style:none;" readonly>
        </td>
        <td class="kh16" style="padding:0px;width:200px;">
          <input class="kh16-b" type="text" name="vnd[]" value="{{ phpformatnumber($cl->vnd) }}" style="text-align:right;width:200px;border-style:none;" readonly>
      </td>
        <td class="kh16" style="padding:0px;width:150px;">
            <input class="kh16-b" type="text" name="inusd[]" value="{{ phpformatnumber($cl->inusd) }}" style="text-align:right;width:150px;border-style:none;" readonly>
        </td>
        <td class="kh16" style="padding:0px;width:150px;display:none;">
            <input class="kh16-b" type="text" name="modelname[]" value="{{ $cl->modelname }}" style="text-align:right;width:150px;border-style:none;" readonly>
        </td>
        <td style="padding:2px;text-align:center;width:60px;">
          <a href="{{ route('closelist.seedetail',['modelname'=>$cl->modelname,'seedate'=>$closelist->closedate,'customer_id'=>$cl->customer_id,'customername'=>$cl->customer->name??'']) }}" class="mybtn" data-model="{{ $cl->modelname }}"  style="width:60px;font-size:16px;" target="_blank"><i class="fa fa-eye"></i></a>
      </td>
    </tr>
@endforeach
<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 class="kh16" style="padding:0px;">
        <input class="kh16" type="text" name="total_desr" value="សរុប/Total" style="width:100%;border-style:none;text-align:center;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="total_usd" value="{{ phpformatnumber($closelist->newusd) }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="total_thb" value="{{ phpformatnumber($closelist->newthb) }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="total_khr" value="{{ phpformatnumber($closelist->newkhr) }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:200px;">
      <input class="kh16-b" type="text" name="total_vnd" value="{{ phpformatnumber($closelist->newvnd) }}" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="total_inusd" id="total_inusd" value="{{ phpformatnumber($closelist->newinusd) }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>

</tr>

<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 class="kh16" style="padding:0px;">
        <input class="kh16-b" type="text" name="ratedesr" value="អត្រាប្តូរប្រាក់" style="width:100%;border-style:none;text-align:center;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="rateusd" value="1" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="ratethb" value="{{ $closelist->rate_thb }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="ratekhr" value="{{ $closelist->rate_khr }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td class="kh16" style="padding:0px;width:200px;">
      <input class="kh16-b" type="text" name="ratevnd" value="{{ $closelist->rate_vnd }}" style="text-align:right;width:200px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
  </td>
    <td class="kh16" style="padding:0px;width:150px;">
        <input class="kh16-b" type="text" name="pl" id="pl" value="PL= {{ phpformatnumber($closelist->newinusd-$closelist->oldinusd+$closelist->expanse+$closelist->income) }}" style="text-align:right;width:150px;border-style:none;background-color:rgb(154, 195, 195)" readonly>
    </td>

</tr>
