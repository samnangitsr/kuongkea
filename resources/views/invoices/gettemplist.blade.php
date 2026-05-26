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
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered kh22">
            <thead style="text-align:center;">
                <th>លរ</th>
                <th>ទម្ងន់</th>
                <th>ទឹក</th>
                <th>តំលៃ</th>
                <th>រូបិយ</th>
                <th>សរុបទឹកប្រាក់</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($tempinvs as $key => $m)
                <tr>
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td style="padding:0px;width:150px;">
                        <input type="text" name="weights[]" class="form-control kh22" style="width:150px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ phpformatnumber($m->weight) }}"> 
                    </td>
                    <td style="padding:0px;width:120px;">
                        <input type="text" name="waters[]" class="form-control kh22" style="width:120px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->water }}">
                    </td>
                    <td style="padding:0px;width:100px;">
                        <input type="text" name="prices[]" class="form-control kh22" style="width:100px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->price }}">
                    </td>
                    <td style="padding:0px;width:80px;">
                        <input type="text" name="curs[]" class="form-control kh22" style="width:80px;border-style:none;padding-left:0px;padding-right:0px;text-align:center;" value="{{ $m->cur }}">
                    </td>
                    
                    <td style="padding:0px;width:180px;">
                        <input type="text" name="totals[]" class="form-control kh22" style="width:180px;border-style:none;padding-left:0px;padding-right:0px;text-align:center" value="{{ phpformatnumber($m->amount) }}">
                    </td>
                    <td style="padding:5px;text-align:center;">
                        <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="table-responsive">
            <table class="table">
                <thead class="kh22">
                    <th>សរុបទម្ងន់</th>
                    
                </thead>
                <tbody>
                    @foreach ($totalweight as $key =>$tb)
                        <tr>
                            <td style="padding:0px;border-style:none;"> 
                                <div class="input-group mb-3">
                                    <input type="text" id="totalweight" name="totalweight" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;" value="{{ phpformatnumber($tb->tweight) }}" readonly> 
                                    <input type="text" id="totalunit" name="totalunit" class="form-control kh22" value="លី" style="font-size:22px;color:blue;border-style:none;text-align:left;" readonly>
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="table-responsive">
            <table id="tbl_totalinv" class="table">
                <thead class="kh22">
                    <th>សរុបទឹកប្រាក់</th>
                    
                </thead>
                <tbody>
                    @foreach ($totalinv as $key =>$ts)
                    <tr>
                        
                        <td style="padding:0px;border-style:none;"> 
                            <div class="input-group mb-3">
                                <input type="text" id="totalall" name="totalall" class="form-control" style="font-size:22px;color:red;border-style:none;text-align:right;" value="{{ phpformatnumber($ts->tsale) }}" readonly> 
                                <input type="text" id="totalcur" name="totalcur" class="form-control" value="{{ $ts->cur }}" style="font-size:22px;color:red;border-style:none;text-align:left;" readonly>
                              </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




