@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        //$dc=strlen((float)$fp)-2;
        $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp



<div class="row">
    <div class="table-responsive">
        <table id="tablemultiexchange" class="table table-bordered">
            <thead style="text-align:center;">
                <th>No</th>
                <th style="display:none;">ID</th>
                <th>Buy</th>
                <th>Cur</th>
                <th style="display:none;">Buyinfo</th>
                <th>Rate</th>
                <th style="display:none;">Rateinfo</th>
                <th>GW</th>
                <th>Sale</th>
                <th>Cur</th>
                <th style="display:none;">Saleinfo</th>
                <th style="display:none;">Drate</th>
                <th>Action</th>
            </thead>
            <tbody id="multiexlist">
                @foreach ($mex as $key => $m)
                    {{-- <tr class="multiexchange">
                        <td style="text-align:center;padding-top:10px;">{{ ++$key }}</td>
                        <td style="width:100px;display:none;">
                          <input type="text" name="txtexids[]" class="form-control" readonly style="width:100px;border-style:none;padding:5px;text-align:right;background-color:white;font-weight:bold;" value="{{ $m->id }}">
                        </td>
                        <td>
                            <input type="text" name="txtbuys[]" class="form-control txtbuys" readonly style="width:100%;border-style:none;padding:5px;text-align:right;background-color:white;font-weight:bold;" value="{{ phpformatnumber($m->buy) }}">
                        </td>
                        <td style="width:60px;">
                            <input type="text" name="txtcurbuys[]" class="form-control txtcurbuys" readonly style="width:60px;border-style:none;padding:5px;text-align:center;background-color:white;font-weight:bold;" value="{{ $m->curbuy }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtbuyinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;font-weight:bold;" value="{{ $m->buyinfo }}">
                        </td>
                        <td style="width:100px;">
                            <input type="text" name="txtrates[]" class="form-control" readonly style="width:100px;border-style:none;padding:5px;text-align:center;background-color:white;font-weight:bold;" value="{{ floatval($m->rate) }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtrateinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:0px;font-weight:bold;" value="{{ $m->rateinfo }}">
                        </td>
                        <td>
                            <input type="text" name="txtsales[]" class="form-control" readonly style="width:100%;border-style:none;padding:5px;text-align:right;background-color:white;font-weight:bold;" value="{{ phpformatnumber($m->sale) }}">
                        </td>
                        <td style="width:60px;">
                            <input type="text" name="txtcursales[]" class="form-control" readonly style="width:60px;border-style:none;padding:5px;text-align:center;background-color:white;font-weight:bold;" value="{{ $m->cursale }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtsaleinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;font-weight:bold;" value="{{ $m->saleinfo }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtdrates[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;font-weight:bold;" value="{{ $m->drate }}">
                        </td>
                        <td style="text-align:center;">
                            <a data-id="{{ $m->id }}" data-mapcode="{{ $m->mapcode }}" class="btn btn-danger btn-sm btndelmxlist" style="padding:0px 5px 0px 5px;" href="">Del</a>
                        </td>
                    </tr> --}}
                    <tr class="multiexchange">
                        <td style="text-align:center;">{{ ++$key }}</td>
                        <td style="width:100px;display:none;">
                            <input type="text" name="txtexids[]" class="" readonly style="width:100px;border-style:none;padding:5px;text-align:right;background-color:white;font-weight:bold;" value="{{ $m->id }}">
                        </td>
                        <td>
                            <input type="text" name="txtbuys[]" class="txtbuys" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->buy) }}">
                        </td>
                        <td style="width:60px;">
                            <input type="text" name="txtcurbuys[]" class="txtcurbuys" style="width:60px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ $m->curbuy }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtbuyinfoes[]" class="txtbuyinfoes" style="width:50px;border-style:none;font-weight:bold;" readonly value="{{ $m->buyinfo }}">
                        </td>
                        <td style="width:100px;">
                            <input type="text" name="txtrates[]" class="txtrates" style="width:100px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ floatval($m->rate) }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtrateinfoes[]" class="txtrateinfoes" style="width:50px;border-style:none;padding:0px;font-weight:bold;" readonly value="{{ $m->rateinfo }}">
                        </td>
                        <td style="width:70px;">
                            <input type="text" name="txtgoldwaters[]" class="txtgoldwaters" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->goldwater) }}">
                        </td>
                        <td>
                            <input type="text" name="txtsales[]" class="txtsales" style="width:100%;border-style:none;text-align:right;background-color:white;font-weight:bold;" readonly value="{{ phpformatnumber($m->sale) }}">
                        </td>
                        <td style="width:60px;">
                            <input type="text" name="txtcursales[]" class="txtcursales" style="width:60px;border-style:none;text-align:center;background-color:white;font-weight:bold;" readonly value="{{ $m->cursale }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtsaleinfoes[]" class="txtsaleinfoes" style="width:50px;border-style:none;font-weight:bold;" value="{{ $m->saleinfo }}">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="txtdrates[]" class="txtdrates" style="width:50px;border-style:none;padding:5px;font-weight:bold;" value="{{ $m->drate }}">
                        </td>
                        <td style="text-align:center;">
                            <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" style="padding:0px 5px 0px 5px;" href="">Del</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="table-responsive">
            <table class="table" id="tbl_in">
                <thead class="kh16" style="text-align:center;">
                    <th style="display:none;">No</th>
                    <th style="width:33.33%">ប្រាក់ទទួល</th>
                    <th style="display:none;">Amount</th>
                    <th style="display:none;">Cur</th>
                    <th style="display:none;">Action</th>
                    <th style="width:33.33%">ប្រាក់ទទួល</th>
                    <th style="width:33.33%">ប្រាក់អាប់</th>
                </thead>
                <tbody>
                  @php
                      $i1=0;
                  @endphp
                    @foreach ($cashin as $ci)
                      @php
                        $i1+=1
                      @endphp
                    <tr style="color:blue;">
                        <td class="no1" style="display:none;">{{ $i1 }}</td>
                        <td style="font-size:16px;text-align:right;font-weight:bold;">{{ phpformatnumber($ci['value']) }} {{ $ci['cur'] }}</td>
                        <td class="amt1" style="font-size:16px;text-align:right;display:none;">{{ phpformatnumber($ci['value']) }} </td>
                        <td class="cur1" style="font-size:16px;text-align:right;display:none;">{{ $ci['cur'] }}</td>
                        <td class="action1" style="display:none;"></td>
                        <td style="padding:0px;">
                            <input type="text" class="exmulti_receive_amt tdcanenter" style="width:100%;text-align:right;font-size:16px;font-weight:bold;border-style:none;padding-right:5px;">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="exmulti_return_amt tdcanenter" style="width:100%;text-align:right;font-size:16px;font-weight:bold;border-style:none;" readonly>
                        </td>
                      </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="table-responsive">
            <table class="table" id="tbl_out">
                <thead class="kh16" style="text-align:center;">
                  <th style="display:none;">No</th>
                  <th>ប្រាក់ប្រគល់</th>
                  <th style="display:none;">Amount</th>
                  <th style="display:none;">Cur</th>
                  <th style="display:none;">Action</th>
                </thead>
                <tbody>
                  @php
                    $i2=0;
                  @endphp
                    @foreach ($cashout as $k2 => $co)
                        @php
                          $i2+=1
                        @endphp
                        <tr style="color:red;">
                          <td class="no2" style="display:none;">{{ $i2 }}</td>
                          <td style="font-size:16px;text-align:right;font-weight:bold;">{{ phpformatnumber($co['value']) }} {{ $co['cur'] }}</td>
                          <td class="amt2" style="font-size:16px;text-align:right;display:none;">{{ phpformatnumber($co['value']) }} </td>
                          <td class="cur2" style="font-size:16px;text-align:right;display:none;">{{ $co['cur'] }}</td>
                          <td class="action2" style="display:none;"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
