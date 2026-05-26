<style>
   #tbl_group_id td{
      padding:0px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:12px;
      font-weight:bold;
    }
    #tbl_group_id th{
      padding:5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:12px;
      font-weight:bold;
    }
</style>
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
  <div class="col-lg-6">
    <div class="row" style="">
        <div class="card" style="">
            <div class="card-title">
                <h1 class="kh26-b" style="text-align:center;margin-top:10px;padding:0px;">មុនទូទាត់</h1>
            </div>
            <div class="card-body">
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

                        <table id="tbl_before_total_we" class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $logo->name }}</td>
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

                        <table id="tbl_before_total_they" class="table table-bordered kh22-b">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">សរុបបើកនៅ {{ $partnername }}</td>
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
            <h1 class="kh26-b" style="text-align:center;margin-top:10px;">ក្រោយទូទាត់</h1>
        </div>
        <div class="card-body">
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

                    <table id="tbl_after_total_we" class="table table-bordered kh22-b">
                        <tr style="background-color:azure">
                            <td class="kh22" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
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


                    <table id="tbl_after_total_they" class="table table-bordered kh22-b">
                        <tr style="background-color:azure">
                            <td class="kh22" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
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
{{-- we --}}

<p class="kh22-b" style="text-align:center;color:red;padding:0px;">បើកនៅ{{ $logo->name }}</p>
<table id="tbl_we" class="table table-bordered kh16" style="width:100%;margin:0px;">
    <thead style="text-align:center;">
        <th style="width:60px;">លរ</th>
        <th style="width:110px;">ថ្ងៃទី</th>
        <th style="width:90px;">ម៉ោង</th>
        <th style="width:100px;">អ្នកកត់ត្រា</th>
        <th style="width:80px;">TID</th>
        <th style="width:220px;">ប្រតិបត្តិការណ៏</th>
        <th style="width:200px;">សរុបទឹកប្រាក់</th>
        <th style="width:150px;">Sender</th>
        <th style="width:250px;">Receiver</th>
        <th style="width:200px;">ផ្សេងៗ</th>
        <th style="width:200px;">ចំនួនទឹកប្រាក់​</th>
        <th style="width:200px;">សេវ៉ា/ការ</th>
    </thead>
    <tbody id="bodytransfer">

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_usd" style="border:2px solid black;border-bottom:1px;">
          <td colspan=12 class="kh16-b">ដុល្លា/USD</td>
        </tr>
        @if($weopen_oldlist)
          @foreach ($weopen_oldlist->where('cur','USD') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_usd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($weopen_records->where('cur','USD') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_usd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_usd collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>
                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>
                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>
                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $t->note }}
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_usd" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:red;" class="kh18-b">{{ phpformatnumber($total).'USD'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'USD'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'USD'}}</td>
        </tr>

      {{--  THB --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_thb" style="border:2px solid black;border-bottom:1px;">
            <td colspan=12 class="kh16-b">បាត/THB</td>
        </tr>
        @if($weopen_oldlist)
          @foreach ($weopen_oldlist->where('cur','THB') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_thb" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_thb)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($weopen_records->where('cur','THB') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_thb" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_thb collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>

                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_thb" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:red;" class="kh18-b">{{ phpformatnumber($total).'THB'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'THB'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'THB'}}</td>
        </tr>

      {{-- KHR --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_khr" style="border:2px solid black;border-bottom:1px;">
          <td colspan=12 class="kh16-b">រៀល/KHR</td>
        </tr>
        @if($weopen_oldlist)
          @foreach ($weopen_oldlist->where('cur','KHR') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_khr" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_khr)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($weopen_records->where('cur','KHR') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_khr" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_khr collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>
                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_khr" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:red;" class="kh18-b">{{ phpformatnumber($total).'KHR'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'KHR'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'KHR'}}</td>
        </tr>

      {{-- VND --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_vnd" style="border:2px solid black;border-bottom:1px;">
            <td colspan=12 class="kh16-b">ដុង/VND</td>
        </tr>
        @if($weopen_oldlist)
          @foreach ($weopen_oldlist->where('cur','VND') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_vnd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_vnd)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($weopen_records->where('cur','VND') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_vnd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:red" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_vnd collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>
                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_vnd" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:red;" class="kh18-b">{{ phpformatnumber($total).'VND'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'VND'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'VND'}}</td>
        </tr>

    </tbody>
</table>

{{-- They --}}

<p class="kh22-b" style="text-align:center;color:blue;padding:0px;">បើកនៅ{{ $partnername }}</p>
<table id="tbl_they" class="table table-bordered kh16" style="width:100%;margin:0px;">
    <thead style="text-align:center;">
      <th style="width:60px;">លរ</th>
      <th style="width:110px;">ថ្ងៃទី</th>
      <th style="width:90px;">ម៉ោង</th>
      <th style="width:100px;">អ្នកកត់ត្រា</th>
      <th style="width:80px;">TID</th>
      <th style="width:220px;">ប្រតិបត្តិការណ៏</th>
      <th style="width:200px;">សរុបទឹកប្រាក់</th>
      <th style="width:150px;">Sender</th>
      <th style="width:250px;">Receiver</th>
      <th style="width:200px;">ផ្សេងៗ</th>
      <th style="width:200px;">ចំនួនទឹកប្រាក់​</th>
      <th style="width:200px;">សេវ៉ា/ការ</th>
    </thead>
    <tbody id="bodytransfer">
        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_usd" style="border:2px solid black;border-bottom:1px;">
          <td colspan=12 class="kh16-b">ដុល្លា/USD</td>
        </tr>
        @if($theyopen_oldlist)
          @foreach ($theyopen_oldlist->where('cur','USD') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_usd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($theyopen_records->where('cur','USD') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_usd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_usd collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>
                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_usd" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:blue;" class="kh18-b">{{ phpformatnumber($total).'USD'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'USD'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'USD'}}</td>
        </tr>

      {{--  THB --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_thb" style="border:2px solid black;border-bottom:1px;">
            <td colspan=12 class="kh16-b">បាត/THB</td>
        </tr>
        @if($theyopen_oldlist)
          @foreach ($theyopen_oldlist->where('cur','THB') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_thb" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_thb)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($theyopen_records->where('cur','THB') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_thb" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_thb collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>

                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_thb" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:blue;" class="kh18-b">{{ phpformatnumber($total).'THB'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'THB'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'THB'}}</td>
        </tr>

      {{-- KHR --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_khr" style="border:2px solid black;border-bottom:1px;">
          <td colspan=12 class="kh16-b">រៀល/KHR</td>
        </tr>
        @if($theyopen_oldlist)
          @foreach ($theyopen_oldlist->where('cur','KHR') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_khr" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_khr)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($theyopen_records->where('cur','KHR') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_khr" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_khr collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>

                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">

                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>

                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_khr" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:blue;" class="kh18-b">{{ phpformatnumber($total).'KHR'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'KHR'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'KHR'}}</td>
        </tr>

      {{-- VND --}}

        @php
            $total=0;
            $amount=0;
            $i=0;
        @endphp
        <tr class="tr_vnd" style="border:2px solid black;border-bottom:1px;">
            <td colspan=12 class="kh16-b">ដុង/VND</td>
        </tr>
        @if($theyopen_oldlist)
          @foreach ($theyopen_oldlist->where('cur','VND') as $l)
              @php
                  $total+=$l->total;
                  $amount+=$l->amount;
                  ++$i;
              @endphp
              <tr class="tr_vnd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                  <td class="no" style="text-align:center;">{{ $i }}</td>
                  <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_vnd)) }}</td>
                  <td>{{ $l->tt }}</td>
                  <td>{{ $l->recordby??'' }}</td>
                  <td></td>
                  <td>{{ $l->tranname??'លុយសល់' }}</td>
                  <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) .  $l->cur  }}</td>

                  <td>{{ $l->sender??'' }}</td>
                  <td>
                    @if($l->desr)
                      {{ $l->desr }}
                      @if($l->note)
                        <br>
                        {{ $l->note }}
                      @endif
                    @else
                      @if($l->note)
                        {{ $l->note }}
                      @endif
                    @endif
                  </td>
                  <td>{{ $l->desr??'' . $l->note??'' }}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                  <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->fee)}}</td>
              </tr>
          @endforeach
        @endif
        @foreach ($theyopen_records->where('cur','VND') as $l)
            @php
                $total+=$l->total;
                $amount+=$l->amount;
                ++$i;
            @endphp
            <tr class="tr_vnd" style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                <td class="no" style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                <td>{{ date('d-m-Y',strtotime($l->dd)) }}</td>
                <td>{{ $l->tt }}</td>
                <td>{{ $l->recordby??'' }}</td>
                <td>
                    @if($l->idtransfer)
                      <a href="#c{{ $l->id }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $l->idtransfer }}</a>
                    @endif
                </td>
                <td>{{ $l->tranname??'' }}</td>
                <td style="text-align:right;color:blue" class="kh16-b">{{ phpformatnumber($l->total) . $l->cur }}</td>
                <td>{{ $l->sender??'' }}</td>
                <td>{{ $l->receive??'' }}</td>
                <td>{{ $l->desr }}</td>
                <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                <td style="text-align:right;" class="kh16-b">
                    @if($l->fee && $l->fee<>0)
                      {{ phpformatnumber($l->fee) . $l->feecur}}
                    @endif
                    @if($l->interest && $l->interest<>0)
                      {{ phpformatnumber($l->interest) . $l->cur}}
                    @endif
                </td>
            </tr>
            @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
              @php
                  $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
              @endphp
              <tr id="c{{ $l->id }}" class="tr_vnd collapse show" style="">
                  <td style="padding:0px;" colspan=13>
                      <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:50%">
                          <tbody>
                            @foreach ($getdata[0] as $ex)
                              <tr style="">
                                  <td>
                                      {{ $ex->user->name . '('. $ex->tt . ')' }}
                                  </td>
                                  <td>ប្តូរប្រាក់</td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' USD' : phpformatnumber($ex->product) . ' ' . $ex->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">
                                    {{ $ex->amount>0? phpformatnumber($ex->product). ' ' . $ex->currency->shortcut . '|' . floatval($ex->drate) : phpformatnumber($ex->amount) . ' USD' . '|' . floatval($ex->drate) }}
                                  </td>

                              </tr>
                              @endforeach
                              @foreach ($getdata[1] as $t)
                              <tr style="">
                                  <td>
                                      {{$t->user->name . '(' . $t->tt . ')' }}
                                  </td>

                                  <td>{{$t->tranname . $t->partner->name }}</td>
                                  <td style="text-align:right;">
                                    {{ phpformatnumber($t->amount) . ' ' . $t->currency->shortcut  }}
                                  </td>
                                  <td style="text-align:right;">{{ $t->note }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </td>

              </tr>
            @endif
        @endforeach
        <tr class="tr_vnd" style="border:2px solid black;border-top:1px;">
            <td colspan=7 style="text-align:right;color:blue;" class="kh18-b">{{ phpformatnumber($total).'VND'}}</td>
            <td colspan=4 class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'VND'}}</td>
            <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'VND'}}</td>
        </tr>

    </tbody>
</table>










