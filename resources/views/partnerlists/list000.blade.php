@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;
        if($dc>6){
            $dc=6;
        }
    }
    return number_format($num,$dc,'.',',');
}
function changeshortcut($shortcut){
    if($shortcut=='USD') return '$';
    if($shortcut=='THB') return 'B';
    if($shortcut=='KHR') return 'R';
    if($shortcut=='VND') return 'V';
    return $shortcut;
}

@endphp
<div class="row" style="margin-top:10px;">
    <div class="col-lg-6">
        <div class="row" style="">
            <div class="card" style="padding:0px;margin:0px;">
                <div class="card-title">
                    <h1 class="kh22-b" style="text-align:center;margin-top:0px;padding:0px;">មុនទូទាត់</h1>
                </div>
                <div class="card-body" style="padding:0px;margin:10px 5px 0px 5px;">
                    <div class="row" style="margin-top:-20px;">
                        <div class="col-lg-6">
                            @php
                                $weusd=0;
                                $wethb=0;
                                $wekhr=0;
                                $wevnd=0;
                                foreach($befortotalwe as $w){
                                    if($w->cur=='USD'){
                                        $weusd=$w->total;
                                    }else if($w->cur=='THB'){
                                        $wethb=$w->total;
                                    }else if($w->cur=='KHR'){
                                        $wekhr=$w->total;
                                    }else if($w->cur=='VND'){
                                        $wevnd=$w->total;
                                    }
                                }
                            @endphp

                            <table id="tbl_before_total_we" class="table table-bordered kh16-b">
                                <tr style="background-color:azure">
                                    <td class="kh14-b" style="text-align:center">បើកនៅ {{ $logo->name }}</td>
                                </tr>

                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber(abs($weusd)) . ' USD' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber(abs($wethb)) . ' THB' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber(abs($wekhr)) . ' KHR' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber(abs($wevnd)) . ' VND' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            @php
                                $theyusd=0;
                                $theythb=0;
                                $theykhr=0;
                                $theyvnd=0;
                                foreach($befortotalthey as $they){
                                    if($they->cur=='USD'){
                                        $theyusd=$they->total;
                                    }else if($they->cur=='THB'){
                                        $theythb=$they->total;
                                    }else if($they->cur=='KHR'){
                                        $theykhr=$they->total;
                                    }else if($they->cur=='VND'){
                                        $theyvnd=$they->total;
                                    }
                                }
                            @endphp

                            <table id="tbl_before_total_they" class="table table-bordered kh16-b">
                                <tr style="background-color:azure">
                                    <td class="kh14" style="text-align:center">បើកនៅ {{ $partnername }}</td>
                                </tr>

                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber($theyusd) . ' USD' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber($theythb) . ' THB' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber($theykhr) . ' KHR' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;">
                                        {{ phpformatnumber($theyvnd) . ' VND' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;margin-top:0px;">ក្រោយទូទាត់</h1>
            </div>
            <div class="card-body" style="padding:0px;margin:10px 5px 0px 5px;">
                <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-6">
                        @php
                            $usd1=0;
                            $thb1=0;
                            $khr1=0;
                            $vnd1=0;
                            $usd2=0;
                            $thb2=0;
                            $khr2=0;
                            $vnd2=0;
                            foreach($aftertotal as $a){
                                if($a->cur=='USD'){
                                    if($a->total>0){
                                        $usd2=$a->total;
                                    }else{
                                        $usd1=$a->total;
                                    }

                                }else if($a->cur=='THB'){
                                    if($a->total>0){
                                        $thb2=$a->total;
                                    }else{
                                        $thb1=$a->total;
                                    }
                                }else if($a->cur=='KHR'){
                                    if($a->total>0){
                                        $khr2=$a->total;
                                    }else{
                                        $khr1=$a->total;
                                    }
                                }else if($a->cur=='VND'){
                                    if($a->total>0){
                                        $vnd2=$a->total;
                                    }else{
                                        $vnd1=$a->total;
                                    }
                                }
                            }
                        @endphp

                        <table id="tbl_after_total_we" class="table table-bordered kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh14-b" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($usd1)) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($thb1)) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($khr1)) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber(abs($vnd1)) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">


                        <table id="tbl_after_total_they" class="table table-bordered kh16-b">
                            <tr style="background-color:azure">
                                <td class="kh14-b" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($usd2) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($thb2) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($khr2) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    {{ phpformatnumber($vnd2) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top:-10px;">
    {{-- we --}}
    <div id="divwe" class="col-lg-12">
        <p class="kh22-b" style="text-align:center;color:red;padding:0px;">បើកនៅ{{ $logo->name }}</p>
        <table id="tbl_we" class="table table-bordered kh12-b" style="margin-top:-10px;">
            <tbody id="bodytransfer">
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_usd" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowweusd" class="kh14" style="" data-bs-toggle="collapse"> ដុល្លា/USD</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tblweusd">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowweusd" class="collapse show tr_usd">
                    <td>
                        <div class="table-responsive">
                            <table id="tblweusd" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($weopen_oldlist)
                                        @foreach ($weopen_oldlist->where('cur','USD') as $l)
                                            @php
                                                $total+=$l->total;
                                                $amount+=$l->amount;
                                                ++$i;
                                            @endphp
                                            <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                <td class="no" style="text-align:center;">{{ $i }}</td>
                                                <td class="">{{ date('d-m-y',strtotime($last_trandate_usd)) }}</td>
                                                <td></td>
                                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                <td>
                                                    {{ $l->receive??'' }}
                                                </td>
                                                <td>{{ $l->sender??'' }}</td>
                                                <td>{{ $l->desr??'' }}</td>

                                                <td>{{ $l->tt }}</td>
                                                <td>{{ $l->recordby??'' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @foreach ($weopen_records->where('cur','USD') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'$'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'$'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'$'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'$'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'$'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

            {{--  THB --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_thb" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowwethb" class="kh14" style="" data-bs-toggle="collapse"> បាត/THB</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tblwethb">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowwethb" class="collapse show tr_thb">
                    <td>
                        <div class="table-responsive">
                            <table id="tblwethb" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr  style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:150px;">សរុបទឹកប្រាក់</th>
                                    <th style="">Receiver</th>
                                    <th style="">Sender</th>
                                    <th style="">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($weopen_oldlist)
                                        @foreach ($weopen_oldlist->where('cur','THB') as $l)
                                                @php
                                                    $total+=$l->total;
                                                    $amount+=$l->amount;
                                                    ++$i;
                                                @endphp
                                                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                    <td class="no" style="text-align:center;">{{ $i }}</td>
                                                    <td class="">{{ date('d-m-y',strtotime($last_trandate_thb)) }}</td>
                                                    <td></td>
                                                    <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                    <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                    <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                    <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                    <td>
                                                        {{ $l->receive??'' }}
                                                    </td>
                                                    <td>{{ $l->sender??'' }}</td>
                                                    <td>{{ $l->desr??'' }}</td>

                                                    <td>{{ $l->tt }}</td>
                                                    <td>{{ $l->recordby??'' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @foreach ($weopen_records->where('cur','THB') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'B'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'B'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'B'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'B'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'B'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            {{-- KHR --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp

                <tr class="tr_khr" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowwekhr" class="kh14" style="" data-bs-toggle="collapse"> រៀល/KHR</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tblwekhr">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowwekhr" class="collapse show tr_khr">
                    <td>
                        <div class="table-responsive">
                            <table id="tblwekhr" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($weopen_oldlist)
                                        @foreach ($weopen_oldlist->where('cur','KHR') as $l)
                                            @php
                                                $total+=$l->total;
                                                $amount+=$l->amount;
                                                ++$i;
                                            @endphp
                                                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                <td class="no" style="text-align:center;">{{ $i }}</td>
                                                <td class="">{{ date('d-m-y',strtotime($last_trandate_khr)) }}</td>
                                                <td></td>
                                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                <td>
                                                    {{ $l->receive??'' }}
                                                </td>
                                                <td>{{ $l->sender??'' }}</td>
                                                <td>{{ $l->desr??'' }}</td>

                                                <td>{{ $l->tt }}</td>
                                                <td>{{ $l->recordby??'' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @foreach ($weopen_records->where('cur','KHR') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'R'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'R'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'R'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'R'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'R'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            {{-- VND --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_vnd" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowwevnd" class="kh14" style="" data-bs-toggle="collapse"> ដុង/VND</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tblwevnd">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowwevnd" class="collapse show tr_vnd">
                    <td>
                        <div class="table-responsive">
                            <table id="tblwevnd" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($weopen_oldlist)
                                    @foreach ($weopen_oldlist->where('cur','VND') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($last_trandate_vnd)) }}</td>
                                            <td></td>
                                            <td>{{ $l->tranname??'លុយសល់' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                            <td>
                                                {{ $l->receive??'' }}
                                            </td>
                                            <td>{{ $l->sender??'' }}</td>
                                            <td>{{ $l->desr??'' }}</td>

                                            <td>{{ $l->tt }}</td>
                                            <td>{{ $l->recordby??'' }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    @foreach ($weopen_records->where('cur','VND') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'V'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'V'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'V'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'V'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'V'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
     {{-- They --}}
    <div id="divthey" class="col-lg-12">
        <p class="kh22-b" style="text-align:center;color:blue;padding:0px;">បើកនៅ{{ $partnername }}</p>
        <table id="tbl_they" class="table table-bordered kh12-b" style="margin-top:-10px;">
            <tbody id="bodytransfer">
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_usd" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowtheyusd" class="kh14" style="" data-bs-toggle="collapse"> ដុល្លា/USD</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tbltheyusd">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowtheyusd" class="collapse show tr_usd">
                    <td>
                        <div class="table-responsive">
                            <table id="tbltheyusd" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($theyopen_oldlist)
                                        @foreach ($theyopen_oldlist->where('cur','USD') as $l)
                                            @php
                                                $total+=$l->total;
                                                $amount+=$l->amount;
                                                ++$i;
                                            @endphp
                                            <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                <td class="no" style="text-align:center;">{{ $i }}</td>
                                                <td class="">{{ date('d-m-y',strtotime($last_trandate_usd)) }}</td>
                                                <td></td>
                                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                <td>
                                                    {{ $l->receive??'' }}
                                                </td>
                                                <td>{{ $l->sender??'' }}</td>
                                                <td>{{ $l->desr??'' }}</td>

                                                <td>{{ $l->tt }}</td>
                                                <td>{{ $l->recordby??'' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @foreach ($theyopen_records->where('cur','USD') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'$'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'$'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'$'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'$'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'$'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

            {{--  THB --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_thb" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowtheythb" class="kh14" style="" data-bs-toggle="collapse"> បាត/THB</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tbltheythb">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowtheythb" class="collapse show tr_thb">
                    <td>
                        <div class="table-responsive">
                            <table id="tbltheythb" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr  style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($theyopen_oldlist)
                                        @foreach ($theyopen_oldlist->where('cur','THB') as $l)
                                                @php
                                                    $total+=$l->total;
                                                    $amount+=$l->amount;
                                                    ++$i;
                                                @endphp
                                                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                    <td class="no" style="text-align:center;">{{ $i }}</td>
                                                    <td class="">{{ date('d-m-y',strtotime($last_trandate_thb)) }}</td>
                                                    <td></td>
                                                    <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                    <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                    <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                    <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                    <td>
                                                        {{ $l->receive??'' }}
                                                    </td>
                                                    <td>{{ $l->sender??'' }}</td>
                                                    <td>{{ $l->desr??'' }}</td>

                                                    <td>{{ $l->tt }}</td>
                                                    <td>{{ $l->recordby??'' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @foreach ($theyopen_records->where('cur','THB') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'B'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'B'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'B'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'B'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'B'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            {{-- KHR --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp

                <tr class="tr_khr" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowtheykhr" class="kh14" style="" data-bs-toggle="collapse"> រៀល/KHR</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tbltheykhr">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowtheykhr" class="collapse show tr_khr">
                    <td>
                        <div class="table-responsive">
                            <table id="tbltheykhr" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($theyopen_oldlist)
                                        @foreach ($theyopen_oldlist->where('cur','KHR') as $l)
                                            @php
                                                $total+=$l->total;
                                                $amount+=$l->amount;
                                                ++$i;
                                            @endphp
                                             <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                                <td class="no" style="text-align:center;">{{ $i }}</td>
                                                <td class="">{{ date('d-m-y',strtotime($last_trandate_khr)) }}</td>
                                                <td></td>
                                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                                <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                                <td>
                                                    {{ $l->receive??'' }}
                                                </td>
                                                <td>{{ $l->sender??'' }}</td>
                                                <td>{{ $l->desr??'' }}</td>

                                                <td>{{ $l->tt }}</td>
                                                <td>{{ $l->recordby??'' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @foreach ($theyopen_records->where('cur','KHR') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'R'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'R'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'R'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'R'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'R'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            {{-- VND --}}
                @php
                    $total=0;
                    $amount=0;
                    $fee=0;
                    $i=0;
                @endphp
                <tr class="tr_vnd" style="border:2px solid black;border-bottom:1px;">
                    <td>
                        <a href="#rowtheyvnd" class="kh14" style="" data-bs-toggle="collapse"> ដុង/VND</a>
                        <a href="" style="float:right;" class="hscol2" data-id="tbltheyvnd">HideShowCol2</a>
                    </td>
                </tr>
                <tr id="rowtheyvnd" class="collapse show tr_vnd">
                    <td>
                        <div class="table-responsive">
                            <table id="tbltheyvnd" class="table table-bordered kh12-b tbl_sub" style="">
                                <tr style="text-align:center;">
                                    <th style="width:50px;padding:0px;">លរ</th>
                                    <th style="width:70px;">ថ្ងៃទី</th>
                                    <th style="width:150px;">LinkID</th>
                                    <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
                                    <th style="width:120px;">ចំនួនទឹកប្រាក់​</th>
                                    <th style="width:80px;">សេវ៉ា</th>
                                    <th style="width:120px;">សរុបទឹកប្រាក់</th>
                                    <th style="width:300px;">Receiver</th>
                                    <th style="width:200px;">Sender</th>
                                    <th style="width:300px;">ផ្សេងៗ</th>
                                    <th style="width:70px;">ម៉ោង</th>
                                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                                </tr>
                                <tbody>
                                    @if($theyopen_oldlist)
                                    @foreach ($theyopen_oldlist->where('cur','VND') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($last_trandate_vnd)) }}</td>
                                            <td></td>
                                            <td>{{ $l->tranname??'លុយសល់' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->fee)}}</td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) .  changeshortcut($l->cur)  }}</td>
                                            <td>
                                                {{ $l->receive??'' }}
                                            </td>
                                            <td>{{ $l->sender??'' }}</td>
                                            <td>{{ $l->desr??'' }}</td>

                                            <td>{{ $l->tt }}</td>
                                            <td>{{ $l->recordby??'' }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    @foreach ($theyopen_records->where('cur','VND') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->amount;
                                            $fee+=$l->fee;
                                            ++$i;
                                        @endphp
                                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                            <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                                            <td class="">{{ date('d-m-y',strtotime($l->dd)) }}</td>
                                            <td>
                                                @if($l->idtransfer)
                                                    <a href="#c{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                                                @endif
                                                @if($l->ref_number)
                                                    <a href="#ref{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_number }}</a>
                                                @endif
                                                @if($l->ref_group_id)
                                                    <a href="#group{{ $l->id }}" class="" style="@if($linkdetail=='true') text-decoration:underline; @endif" data-bs-toggle="collapse"> {{ $l->ref_group_id }}</a>
                                                @endif

                                            </td>
                                            <td class="">{{ $l->tranname??'' }}</td>
                                            <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($l->amount) . changeshortcut($l->cur)}}</td>
                                            <td style="text-align:right;" class="kh14-b">
                                                @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber($l->fee) . changeshortcut($l->feecur)}}
                                                @endif
                                                @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber($l->interest) . changeshortcut($l->cur)}}
                                                @endif
                                            </td>
                                            <td style="text-align:right;color:red" class="kh14-b">{{ phpformatnumber($l->total) . changeshortcut($l->cur) }}</td>
                                            <td class="">{{ $l->receive??'' }}</td>
                                            <td class="">{{ $l->sender??'' }}</td>
                                            <td class="">{{ $l->desr??'' }}</td>
                                            <td class="">{{ $l->tt }}</td>
                                            <td class="">{{ $l->recordby??'' }}</td>
                                        </tr>
                                        @if($linkdetail=='true')
                                            @if($l->idtransfer)
                                                @foreach (App\PartnerTransfer::showbyid($l->idtransfer) as $item)
                                                    <tr id="c{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                        <td colspan=13>
                                                            <table class="table-bordered" style="margin:0px;">
                                                                <thead style="text-align:center;">
                                                                    <th>ថ្ងៃទី</th>
                                                                    <th>អ្នកកត់ត្រា</th>
                                                                    <th>ដៃគូ</th>
                                                                    <th>TID</th>
                                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                                    <th>សរុបទឹកប្រាក់</th>
                                                                    <th>សេវ៉ា/ការប្រាក់</th>
                                                                    <th>សេវ៉ាអតិថិជន</th>
                                                                    <th>Receiver</th>
                                                                    <th>Sender</th>
                                                                    <th>ផ្សេងៗ</th>
                                                                    <th>ថ្ងៃកត់ត្រា</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="kh12-b" style="text-align:center;">
                                                                        <td>
                                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                        </td>
                                                                        <td>{{ $item->user->name }}</td>
                                                                        <td>{{ $item->partner->name }}</td>
                                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                        <td>{{ $item->tranname }}</td>
                                                                        <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                        <td>
                                                                        @if($item->fee && $item->fee<>0)
                                                                            {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                        @endif
                                                                        @if($item->interest && $item->interest<>0)
                                                                            {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                        @endif
                                                                        </td>
                                                                        <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                        <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                        <td>{{ $item->note }}</td>
                                                                        <td>
                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if($l->ref_number)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showref_number($l->ref_number);
                                                    if($datarefs){
                                                    $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                    @foreach ($datarefs as $item)
                                                        @if(explode("-",$l->ref_number)[0]=='transfer')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>
                                                                                @if($item->fee && $item->fee<>0)
                                                                                    {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                @endif
                                                                                @if($item->interest && $item->interest<>0)
                                                                                    {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                @endif
                                                                                </td>
                                                                                <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchange')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='usercapital')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-border">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->useraffect->name }}</td>
                                                                                <td>{{ $item->tranname }}</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='cashdraw')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->frompartner->name }}</td>
                                                                                <td>បើកវេរ</td>
                                                                                <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_number)[0]=='exchangelist')
                                                            <tr id="ref{{ $l->id }}" class="tr_vnd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="kh12-b" style="text-align:center;">
                                                                                <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                <td>
                                                                                    {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                </td>
                                                                                <td>{{ $item->user->name }}</td>
                                                                                <td>{{ $item->partner->name }}</td>
                                                                                <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                <td>{{ $item->note }}</td>
                                                                                <td>
                                                                                {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if($l->ref_group_id)
                                                @php
                                                    $countdata=0;
                                                    $datarefs=App\PartnerTransfer::showgroupid($l->ref_group_id);
                                                    if($datarefs){
                                                        $countdata=1;
                                                    }
                                                @endphp
                                                @if($countdata>0)
                                                        @if(explode("-",$l->ref_group_id)[0]=='transfer')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>TID</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>សរុបទឹកប្រាក់</th>
                                                                            <th>សេវ៉ា/ការប្រាក់</th>
                                                                            <th>សេវ៉ាអតិថិជន</th>
                                                                            <th>Receiver</th>
                                                                            <th>Sender</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>
                                                                                        @if($item->fee && $item->fee<>0)
                                                                                        {{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}
                                                                                        @endif
                                                                                        @if($item->interest && $item->interest<>0)
                                                                                        {{ phpformatnumber($item->interest) . ' ' . $item->currency->shortcut }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ phpformatnumber($item->cuscharge) . ' ' . $item->cuschargecur->shortcut }}</td>
                                                                                    <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                                                    <td>{{ $item->sendertel . ' ' . $item->sendername }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchange')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រា</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->rate)}}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='usercapital')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ពាក់ព័ន្ធបុគ្គលិក</th>
                                                                            <th>បរិយាយ</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->trandate))  . ' ' . $item->trantime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->useraffect->name }}</td>
                                                                                    <td>{{ $item->tranname }}</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='cashdraw')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>TID</th>
                                                                            <th>ថ្ងៃបើក</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូ</th>
                                                                            <th>ប្រតិបត្តិការណ៏</th>
                                                                            <th>ចំនួនទឹកប្រាក់</th>
                                                                            <th>កាត់សេវ៉ា</th>
                                                                            <th>អ្នកទទួលប្រាក់</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->opdate))  . ' ' . $item->optime }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->frompartner->name }}</td>
                                                                                    <td>បើកវេរ</td>
                                                                                    <td>{{ phpformatnumber($item->amount) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ phpformatnumber($item->customer_charge) . ' ' . $item->currency->shortcut }}</td>
                                                                                    <td>{{ $item->receive_tel . ' ' . $item->receive_name }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @elseif(explode("-",$l->ref_group_id)[0]=='exchangelist')
                                                            <tr id="group{{ $l->id }}" class="tr_usd collapse" style="background-color:rgb(206, 240, 229);">
                                                                <td colspan=13>
                                                                    <table class="table-bordered">
                                                                        <thead style="text-align:center;">
                                                                            <th>ID</th>
                                                                            <th>ថ្ងៃទី</th>
                                                                            <th>អ្នកកត់ត្រា</th>
                                                                            <th>ដៃគូកាត់កង</th>
                                                                            <th>ទិញ</th>
                                                                            <th>លក់</th>
                                                                            <th>អត្រាព្រមព្រាង</th>
                                                                            <th>អត្រាគោល</th>
                                                                            <th>ផ្សេងៗ</th>
                                                                            <th>ថ្ងៃកត់ត្រា</th>

                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datarefs as $item)
                                                                                <tr class="kh12-b" style="text-align:center;">
                                                                                    <td>{{ sprintf("%04d",$item->id) }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y',strtotime($item->ex_date))  . ' ' . $item->ex_time }}
                                                                                    </td>
                                                                                    <td>{{ $item->user->name }}</td>
                                                                                    <td>{{ $item->partner->name }}</td>
                                                                                    <td>{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                                                    <td>{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                                                    <td>{{ phpformatnumber($item->agree_rate) }}</td>
                                                                                    <td>{{ phpformatnumber($item->main_rate) }}</td>
                                                                                    <td>{{ $item->note }}</td>
                                                                                    <td>
                                                                                        {{ date('d-m-Y H:i:s',strtotime($item->created_at))}}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr style="border:2px solid black;border-top:1px;">
                                        <td colspan=4 style="background-color:aqua;"></td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="">{{ phpformatnumber($amount).'V'}}</td>
                                        <td style="text-align:right;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($fee).'V'}}</td>
                                        <td style="text-align:right;color:red;background-color:aqua;font-size:14px;font-weight:bold;" class="kh16-b">{{ phpformatnumber($total).'V'}}</td>
                                        <td colspan=4 class="" style="text-align:right;color:balck;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($amount) .'V'}}</td>
                                        <td class="" style="text-align:right;color:black;background-color:aqua;font-size:14px;font-weight:bold;">{{ phpformatnumber($total-$amount) .'V'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>






