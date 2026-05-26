
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
        <td class="kh14" style="padding:5px 0px 0px 0px;text-align:center;">{{ ++$key }}</td>
        <td style="display:none;">
          <input type="text" name="customer_id[]" value="{{ $cl->customer_id }}" style="" readonly>
        </td>
        <td style="">
            <input type="text" name="desr[]" value="{{ $cl->desr }}" style="width:100%;border:1px solid green;padding:0px 3px;height:30px;" class="kh14" readonly>
        </td>
        <td style="">
            <input type="text" name="usd[]" value="{{ phpformatnumber(-1 * $cl->usd) . '$' }}" style="width:150px;{{ -1 * $cl->usd>0?'color:blue;':'color:red;' }}" class=" inputrow" readonly>
        </td>
        <td style="">
            <input type="text" name="thb[]" value="{{ phpformatnumber(-1 * $cl->thb) . 'B' }}" style="width:150px;{{ -1 * $cl->thb>0?'color:blue;':'color:red;' }}" class=" inputrow" readonly>
        </td>
        <td class="kh16" style="">
            <input type="text" name="khr[]" value="{{ phpformatnumber(-1 * $cl->khr) . 'R' }}" style="width:180px;{{ -1 * $cl->khr>0?'color:blue;':'color:red;' }}" class=" inputrow" readonly>
        </td>
        <td class="kh14-b" style="{{ config('helper.col_vnd')==0?'display:none':'' }}">
          <input type="text" name="vnd[]" value="{{ phpformatnumber(-1 * $cl->vnd) . 'V' }}" style="width:200px;{{ -1 * $cl->vn>0?'color:blue;':'color:red;' }}" class=" inputrow" readonly>
      </td>
        <td class="kh14-b" style="">
            <input type="text" name="inusd[]" value="{{ phpformatnumber(-1 * $cl->inusd) . '$' }}" style="width:160px;{{ -1 * $cl->inusd>0?'color:blue;':'color:red;' }}" class=" inputrow" readonly>
        </td>
        <td class="kh14-b" style="display:none;">
            <input type="text" name="modelname[]" value="{{ $cl->modelname }}" style="" readonly>
        </td>
        <td style="padding:0px;text-align:center;width:60px;">
            <a href="{{ route('closelist.seedetail',['modelname'=>$cl->modelname,'seedate'=>$listdate,'customer_id'=>$cl->customer_id,'customername'=>$cl->customer->name??'']) }}" class="btn btn-info btn-sm" data-model="{{ $cl->modelname }}"  style="width:60px;" target="_blank">Check</a>
        </td>
    </tr>
@endforeach
<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 style="">
        <input type="text" name="total_desr" class="kh16" value="សរុប/Total" style="width:100%;border:1px solid green;height:30px;background-color:rgb(154, 195, 195);padding:5px;" readonly>
    </td>
    <td style="">
        <input type="text" name="total_usd" value="{{ phpformatnumber(-1 * $total->tusd) . '$' }}" style="width:150px;background-color:rgb(154, 195, 195);{{ -1 * $total->tusd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
    </td>
    <td style="">
        <input type="text" name="total_thb" value="{{ phpformatnumber(-1 * $total->tthb) . 'B' }}" style="width:150px;background-color:rgb(154, 195, 195);{{ -1 * $total->tthb>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
    </td>
    <td style="">
        <input type="text" name="total_khr" value="{{ phpformatnumber(-1 * $total->tkhr) . 'R' }}" style="width:180px;background-color:rgb(154, 195, 195);{{ -1 * $total->tkhr>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
    </td>
    <td style="{{ config('helper.col_vnd')==0?'display:none':'' }}">
      <input type="text" name="total_vnd" value="{{ phpformatnumber(-1 * $total->tvnd) . 'V' }}" style="width:200px;background-color:rgb(154, 195, 195);{{ -1 * $total->tvnd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
  </td>
    <td style="">
        <input type="text" name="total_inusd" id="total_inusd" value="{{ phpformatnumber(-1 * $totalallinusd) . '$' }}" style="width:160px;background-color:rgb(154, 195, 195);{{ -1 * $totalallinusd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
    </td>

</tr>
@php
    $thb=1;
    $khr=1;
    $vnd=1;
@endphp
@foreach ($todayrate as $r)
    @if($r->shortcut=='THB')
        @if($rate_thb==0)
            @php
                 if(config('helper.auto_closelist_rate') == 0){
                     $thb=phpformatnumber(($r->ratebuy_closelist??$r->ratebuy)) . '/' . phpformatnumber(($r->ratesale_closelist??$r->ratesale));
                 }else{
                    $thb=phpformatnumber($r->ratebuy) . '/' . phpformatnumber($r->ratesale);
                 }
            @endphp
        @else
            @php
                $thb=$rate_thb;
            @endphp
        @endif
    @endif
    @if($r->shortcut=='KHR')
        @if($rate_khr==0)
            @php
                if(config('helper.auto_closelist_rate') == 0){
                    $khr=phpformatnumber(($r->ratebuy_closelist??$r->ratebuy)) . '/' . phpformatnumber(($r->ratesale_closelist??$r->ratesale));
                }else{
                    $khr=phpformatnumber($r->ratebuy) . '/' . phpformatnumber($r->ratesale);
                }
            @endphp
        @else
            @php
                $khr=$rate_khr;
            @endphp
        @endif
    @endif
    @if($r->shortcut=='VND')
          @if($rate_vnd==0)
            @php
                if(config('helper.auto_closelist_rate') == 0){
                    $vnd=phpformatnumber(($r->ratebuy_closelist??$r->ratebuy)) . '/' . phpformatnumber(($r->ratesale_closelist??$r->ratesale));
                }else{
                    $vnd=phpformatnumber($r->ratebuy) . '/' . phpformatnumber($r->ratesale);
                }
            @endphp
        @else
            @php
                $vnd=$rate_vnd;
            @endphp
        @endif
    @endif
@endforeach

<tr style="background-color:rgb(154, 195, 195)">
    <td colspan=2 style="">
        <input type="text" name="ratedesr" value="អត្រាប្តូរប្រាក់" class="kh16" style="width:100%;border:1px solid green;height:30px;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td style="">
        <input type="text" name="rateusd" class="inputrow1" value="1" style="width:150px;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td style="">
        <input type="text" name="ratethb" class="inputrow1" value="{{ $thb }}" style="width:150px;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td style="">
        <input type="text" name="ratekhr" class="inputrow1" value="{{ $khr }}" style="width:180px;background-color:rgb(154, 195, 195)" readonly>
    </td>
    <td style="{{ config('helper.col_vnd')==0?'display:none':'' }}">
      <input type="text" name="ratevnd" class="inputrow1" value="{{ $vnd }}" style="width:200px;background-color:rgb(154, 195, 195)" readonly>
  </td>
    <td style="">

    </td>

</tr>
<tr>
    <td colspan=6>
        <table>
           <tr style="text-align:center;">
            <td class="kh16-b">បិទបញ្ជី <span id="tdolddate">មុន</span></td>
            <td class="kh16-b">សរុបថ្ងៃនេះ</td>
            <td class="kh16-b">ចំណាយ</td>
            <td class="kh16-b">ចំណូល</td>
            <td id="plhead" class="kh16-b">ចំណេញ</td>
            <td>Action</td>
           </tr>
            <tr>
                <td style="">
                    <input type="text" name="oldlist" id="oldlist" class="inputrow1" value="0" style="width:160px;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td style="">
                    <input type="text" name="newlist" id="newlist" class="inputrow1" value="{{ phpformatnumber(-1 * $totalallinusd) . '$' }}" style="width:160px;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td style="">
                    <input type="text" name="expanse" id="expanse" class="inputrow1" value="{{ phpformatnumber($totalexpanse->tinusd) . '$' }}" style="width:160px;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td style="">
                    <input type="text" name="income" id="income" class="inputrow1" value="{{ phpformatnumber($totalincome->tinusd) . '$' }}" style="width:160px;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td style="">
                    <input type="text" name="pl" id="pl" class="inputrow1" value="0" style="width:160px;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td>
                    <button id="btnsave1" class="btn btn-info btn-sm kh14-b">រក្សាទុក</button>
                </td>

            </tr>
        </table>
    </td>
</tr>
