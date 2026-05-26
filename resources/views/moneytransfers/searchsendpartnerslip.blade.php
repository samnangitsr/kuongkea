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
    <table class="table table-bordered">
        <tr>
            <td class="kh16-b" style="color:blue">
                ប្រតិបត្តិការណ៏មិនទាន់បានផ្ញើ
                <button id="btnsendselected" class="mybtn kh16">Send Selected Invoice</button>
            </td>

        </tr>
       </table>
</div>
<div class="row" style="margin-top:0px;">


            <table id="tblsend" class="table table-bordered table-hover kh16 tblsend">

                <thead style="text-align:center;">
                    <th>លរ</th>
                    <th>TID</th>
                    <th>ថ្ងៃទី</th>
                    <th>ម៉ោង</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ឈ្មោះដៃគូ</th>
                    <th>អតិថិជន</th>
                    <th>ចំនួនទឹកប្រាក់</th>
                    <th>សេវ៉ាវេរ</th>
                    <th>សេវ៉ាដៃគូ</th>
                    <th>ពត៌មានអតិថិជន</th>
                    <th>ផ្សេងៗ</th>
                    <th>លេខយោង</th>
                    <th>កូតបើកវេរ</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="bodytransfer">
                @foreach ($notyetsent as $key => $d)
                        <tr class="rowclick">
                            <td style="text-align:center;">
                                <div class="form-check">
                                    <label class="form-check-label kh16">
                                      <input class="form-check-input ckno1" type="checkbox" name="ckno1"> {{ ++$key }}
                                    </label>
                                </div>
                            </td>
                            <td>{{ $d->id }}</td>
                            <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                            <td>{{ $d->tt }}</td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->tranname }}</td>
                            <td>
                                @if($d->child)
                                    {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                                @else
                                    {{ $d->partner->name }}
                                @endif

                            </td>
                            <td>{{ $d->customer->name }}</td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber($d->amount)  . $d->currency->sk }}
                            </td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->sk }}
                            </td>
                            <td class="kh18" style="text-align:right;">
                                {{ phpformatnumber($d->fee) . $d->feecurrency->sk }}
                            </td>
                            <td>
                                @php
                                    $info1='';
                                    $info2='';
                                    if($d->recname){
                                        $info1='អ្នកទទួល:' . $d->recname;
                                    }
                                    if($d->rectel){
                                        if($info1==''){
                                            $info1='អ្នកទទួល' . $d->rectel;
                                        }else{
                                            $info1=$info1 . ' ' . $d->rectel;
                                        }
                                    }
                                    if($d->sendername){
                                        $info2='អ្នកផ្ញើ:' . $d->sendername;
                                    }
                                    if($d->sendertel){
                                        if($info2==''){
                                            $info2='អ្នកផ្ញើ' . $d->sendertel;
                                        }else{
                                            $info2=$info2 . ' ' . $d->sendertel;
                                        }
                                    }
                                @endphp

                            {{ $info1 }} <br> {{ $info2 }}
                            </td>
                            <td>{{ $d->note }}</td>
                            <td>{{ $d->ref_number }}</td>
                            <td>{{ $d->cashdraw_id }}</td>
                            @if(is_null($d->ref_number) && is_null($d->cashdraw_id))
                                <td style="text-align:center;">
                                    {{-- <a href="{{ route('moneytransfer.sendslip',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">Slip</a> --}}
                                    <button id="btnsendslip" class="mybtn" >Send</button>
                                </td>


                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

</div>
<div class="row">
   <table class="table table-bordered">
    <tr>
        <td class="kh16-b" style="color:green">
            ប្រតិបត្តិការណ៏បានផ្ញើរួច
            <button id="btnresentselected" class="mybtn kh16">ReSend Selected Item</button>
        </td>

    </tr>
   </table>
</div>
<div class="row" style="margin-top:0px;">

        <table id="tblsent" class="table table-bordered table-hover kh16">
            <thead style="text-align:center;">
                <th>លរ</th>
                <th>TID</th>
                <th>ថ្ងៃទី</th>
                <th>ម៉ោង</th>
                <th>អ្នកកត់ត្រា</th>
                <th>ប្រតិបត្តិការណ៏</th>
                <th>ឈ្មោះដៃគូ</th>
                <th>អតិថិជន</th>
                <th>ចំនួនទឹកប្រាក់</th>
                <th>សេវ៉ាវេរ</th>
                <th>សេវ៉ាដៃគូ</th>
                <th>ពត៌មានអតិថិជន</th>
                <th>ផ្សេងៗ</th>
                <th>លេខយោង</th>
                <th>កូតបើកវេរ</th>
                <th>សកម្មភាព</th>
            </thead>
            <tbody id="bodytransfer">
            @foreach ($sent as $key => $d)
                    <tr class="rowclick">
                        <td style="text-align:center;">
                            <div class="form-check">
                                <label class="form-check-label kh16">
                                  <input class="form-check-input ckno" type="checkbox" name="ckno"> {{ ++$key }}
                                </label>
                              </div>
                        </td>
                        <td>{{ $d->id }}</td>
                        <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                        <td>{{ $d->tt }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>{{ $d->tranname }}</td>
                        <td>
                            @if($d->child)
                                {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                            @else
                                {{ $d->partner->name }}
                            @endif

                        </td>
                        <td>{{ $d->customer->name }}</td>
                        <td class="kh18" style="text-align:right;">
                            {{ phpformatnumber($d->amount)  . $d->currency->sk }}
                        </td>
                        <td class="kh18" style="text-align:right;">
                            {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->sk }}
                        </td>
                        <td class="kh18" style="text-align:right;">
                            {{ phpformatnumber($d->fee) . $d->feecurrency->sk }}
                        </td>
                        <td>
                            @php
                                $info1='';
                                $info2='';
                                if($d->recname){
                                    $info1='អ្នកទទួល:' . $d->recname;
                                }
                                if($d->rectel){
                                    if($info1==''){
                                        $info1='អ្នកទទួល' . $d->rectel;
                                    }else{
                                        $info1=$info1 . ' ' . $d->rectel;
                                    }
                                }
                                if($d->sendername){
                                    $info2='អ្នកផ្ញើ:' . $d->sendername;
                                }
                                if($d->sendertel){
                                    if($info2==''){
                                        $info2='អ្នកផ្ញើ' . $d->sendertel;
                                    }else{
                                        $info2=$info2 . ' ' . $d->sendertel;
                                    }
                                }
                            @endphp

                        {{ $info1 }} <br> {{ $info2 }}
                        </td>
                        <td>{{ $d->note }}</td>
                        <td>{{ $d->ref_number }}</td>
                        <td>{{ $d->cashdraw_id }}</td>
                        @if(is_null($d->ref_number) && is_null($d->cashdraw_id))
                            <td style="text-align:center;">
                                {{-- <a href="{{ route('moneytransfer.sendslip',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">Slip</a> --}}
                                <button id="btnsentslip" class="mybtn" >ReSent</button>
                            </td>


                        @endif
                    </tr>
            @endforeach
            </tbody>
        </table>

</div>
