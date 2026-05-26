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

<div class="card-header">
    <table>
        <tr>
            <td ><h3 class="kh22-b" style="margin-top:7px;">តារាងបញ្ជីលុយសំរាប់ថ្ងៃទី</h3></td>
            <td><input type="text" id="txtolddate" name="txtolddate" class="kh22-b" value="{{ date('d-m-Y',strtotime($oldlist->closedate)) }}" style="background-color:transparent;border-style:none;" readonly></td>
        </tr>
    </table>


</div>
<div class="tableFixHead1" style="padding:0px;">
    <table id="tbl_list1" class="table table-bordered tbl_list1" style="table-layout:fixed;">
        <thead class="kh14" style="text-align:center;">
            <th style="width:60px;">លរ</th>
            <th>បរិយាយ</th>
            <th style="width:150px;">ដុល្លា</th>
            <th style="width:150px;">បាត</th>
            <th style="width:180px;">រៀល</th>
            <th style="width:200px;display:none;">ដុង</th>
            <th style="width:160px;">គិតជាដុល្លា</th>
            <th style="display:none;">Model</th>
        </thead>

            <tbody>
                @foreach ($oldlistdetails as $key => $cl)
                <tr>
                    <td class="kh14" style="padding:5px 0px 0px 0px;text-align:center;">{{ ++$key }}</td>
                    <td class="kh14" style="">
                        <input type="text" name="desr1[]" value="{{ $cl->desr }}" class="kh14" style="width:100%;height:30px;" readonly>
                    </td>
                    <td class="kh16" style="">
                        <input type="text" name="usd1[]" value="{{ phpformatnumber($cl->usd) . '$' }}" style="width:150px;{{ $cl->usd>0?'color:blue;':'color:red;' }}" class="inputrow" readonly>
                    </td>
                    <td class="kh16" style="">
                        <input type="text" name="thb1[]" value="{{ phpformatnumber($cl->thb) . 'B' }}" style="width:150px;{{ $cl->thb>0?'color:blue;':'color:red;' }}" class="inputrow" readonly>
                    </td>
                    <td class="kh16" style="">
                        <input type="text" name="khr1[]" value="{{ phpformatnumber($cl->khr) . 'R' }}" style="width:180px;{{ $cl->khr>0?'color:blue;':'color:red;' }}" class="inputrow" readonly>
                    </td>
                    <td class="kh16" style="display:none;">
                      <input type="text" name="vnd1[]" value="{{ phpformatnumber($cl->vnd) . 'V' }}" style="width:200px;{{ $cl->vnd>0?'color:blue;':'color:red;' }}" class="inputrow" readonly>
                  </td>
                    <td class="kh16" style="">
                        <input type="text" name="inusd1[]" value="{{ phpformatnumber($cl->inusd) . '$' }}" style="width:160px;{{ $cl->inusd>0?'color:blue;':'color:red;' }}" class="inputrow" readonly>
                    </td>
                    <td class="kh16" style="padding:0px;width:100px;display:none;">
                        <input type="text" name="modelname1[]" value="{{ $cl->modelname }}" style="text-align:right;width:80px;" readonly>
                    </td>

                </tr>
            @endforeach
            <tr style="background-color:rgb(154, 195, 195)">
                <td colspan=2 class="kh16" style="padding:0px;">
                    <input type="text" name="total_desr1" value="សរុប/Total" class="kh16" style="width:100%;height:30px;text-align:left;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="total_usd1" value="{{ phpformatnumber($oldlist->newusd) . '$' }}" style="width:150px;background-color:rgb(154, 195, 195);{{ $oldlist->newusd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="total_thb1" value="{{ phpformatnumber($oldlist->newthb) . 'B' }}" style="width:150px;background-color:rgb(154, 195, 195);{{ $oldlist->newthb>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="total_khr1" value="{{ phpformatnumber($oldlist->newkhr) . 'R' }}" style="width:180px;background-color:rgb(154, 195, 195);{{ $oldlist->newkhr>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="display:none;">
                  <input type="text" name="total_vnd1" value="{{ phpformatnumber($oldlist->newvnd) . 'V' }}" style="width:200px;background-color:rgb(154, 195, 195);{{ $oldlist->newvnd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
              </td>
                <td class="kh16" style="">
                    <input type="text" name="total_inusd1" id="total_inusd1" value="{{ phpformatnumber($oldlist->newinusd) . '$' }}" style="width:160px;background-color:rgb(154, 195, 195);{{ $oldlist->newinusd>0?'color:blue;':'color:red;' }}" class="inputrow1" readonly>
                </td>
            </tr>
            <tr style="background-color:rgb(154, 195, 195)">
                <td colspan=2 class="kh16" style="">
                    <input type="text" name="ratedesr" class="kh16" value="អត្រាប្តូរប្រាក់" style="width:100%;height:30px;text-align:left;background-color:rgb(154, 195, 195)" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="rateusd1" value="1" style="width:150px;background-color:rgb(154, 195, 195)" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="ratethb1" value="{{ $oldlist->rate_thb }}" style="width:150px;background-color:rgb(154, 195, 195)" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="">
                    <input type="text" name="ratekhr1" value="{{ $oldlist->rate_khr }}" style="width:180px;background-color:rgb(154, 195, 195)" class="inputrow1" readonly>
                </td>
                <td class="kh16" style="display:none;">
                  <input type="text" name="ratevnd1" value="{{ $oldlist->rate_vnd }}" style="width:200px;background-color:rgb(154, 195, 195)" class="inputrow1" readonly>
              </td>
            </tr>
            </tbody>

    </table>
</div>



