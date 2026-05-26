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
@php
$i=0;
@endphp
<table class="table table-bordered kh16 tbl_usertransaction" style="table-layout:fixed;width:100%;margin:0px;padding:0px;">
    <thead style="text-align:center;">
        <th style="width:60px;">No</th>
        <th style="width:100px;">ថ្ងៃទី</th>
        <th style="width:100px;">បុគ្គលិក</th>
        <th>ប្រតិបត្តិការណ៏</th>
        <th>GOLD</th>
        <th>USD</th>
        <th>THB</th>
        <th>KHR</th>
        <th>VND</th>
        <th>FN</th>
        {{-- <th>គេខ្វះ</th>
        <th>ខ្វះគេ</th>
        <th>ធនាគា</th> --}}
        <th>Description</th>

    </thead>
    <tbody>
        @php
            $usd=0;
            $gold=0;
            $khr=0;
            $thb=0;
            $vnd=0;
            $theylack=0;
            $welack=0;
            $bank=0;
            $sumusd=0;
            $trdate='';
            $create_at='';
        @endphp
        @foreach ($usertransactions as $key => $ut)
            <tr>
                @php
                  if($ut->issum==1){
                    $usd+=$ut->usd;
                    $gold+=$ut->gold;
                    $khr+=$ut->khr;
                    $thb+=$ut->thb;
                    $vnd+=$ut->vnd;
                    $theylack+=$ut->theylack;
                    $welack+=$ut->welack;
                    $bank+=$ut->paybybank;
                    $sumusd+=$ut->usd+$ut->theylack+$ut->welack+$ut->paybybank;
                  }
                  $trdate=date('Y-m-d',strtotime($ut->dd));
                  $created_at=date('Y-m-d',strtotime($ut->inputdate));

                @endphp
                <td class="en14" style="text-align:center;">{{ ++$key }}</td>
                <td class="en14" style="text-align:center;@if($trdate<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($ut->dd)) }} <br> {{ $ut->tt }} </td>
                <td class="en14" style=""> {{ $ut->user->name }}</td>
                <td class="kh16">
                    {{-- <a href="{{ route('usercapital.showsummarydetail',['tablename'=>$ut->tablename,'tranname'=>$ut->tranname,'userid'=>$ut->user_id,'dd'=>$ut->dd,'gold'=>$ut->gold,'usd'=>$ut->usd,'thb'=>$ut->thb,'khr'=>$ut->khr,'vnd'=>$ut->vnd,'fn'=>$ut->fn,'shortcut'=>$ut->shortcut]) }}" class="kh16" target="_blank" style="margin:0px;text-align:left;text-decoration:underline;">{{ $ut->tranname }}</a> --}}
                    <a href="" class="kh16 btnseesummarydetail" data-tablename="{{ $ut->tablename }}" data-tranname="{{ $ut->tranname }}" data-userid="{{ $ut->user_id }}" data-gold="{{ $ut->gold }}" data-usd="{{ $ut->usd }}" data-thb="{{ $ut->thb }}" data-khr="{{ $ut->khr }}" data-vnd="{{ $ut->vnd }}" data-fn="{{ $ut->fn }}" data-shortcut="{{ $ut->shortcut }}" style="margin:0px;text-align:left;text-decoration:underline;">{{ $ut->tranname }}</a>

                </td>

                <td class="en16-b @if($ut->gold>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->gold<>0) {{ phpformatnumber($ut->gold) . 'G' }} @endif @if($ut->issum==1) @if($ut->gold<>0) <br> <span class="amt12">{{ phpformatnumber($gold) . 'G' }} @endif @endif</td>
                <td class="en16-b @if($ut->usd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->usd<>0){{ phpformatnumber($ut->usd) . '$' }} @endif @if($ut->issum==1) @if($ut->usd<>0) <br> <span class="amt12">{{ phpformatnumber($usd) . '$' }}</span> @endif @endif</td>
                <td class="en16-b @if($ut->thb>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->thb<>0) {{ phpformatnumber($ut->thb) . 'B' }} @endif @if($ut->issum==1) @if($ut->thb<>0) <br> <span class="amt12">{{ phpformatnumber($thb) . 'B' }} @endif @endif</td>
                <td class="en16-b @if($ut->khr>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->khr<>0){{ phpformatnumber($ut->khr) . 'R' }} @endif @if($ut->issum==1) @if($ut->khr<>0) <br> <span class="amt12">{{ phpformatnumber($khr) . 'R' }} @endif @endif</td>
                <td class="en16-b @if($ut->vnd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">@if($ut->vnd<>0){{ phpformatnumber($ut->vnd) . 'V' }}@endif @if($ut->issum==1) @if($ut->vnd<>0) <br> <span class="amt12">{{ phpformatnumber($vnd) . 'V' }} @endif @endif</td>
                <td class="en16-b @if($ut->vnd>=0) blue @else red @endif @if($ut->issum==0) linethrough @endif">
                    @if($ut->fn<>'0')
                      {{ phpformatnumber($ut->fn) . $ut->shortcut }}
                    @else

                    @endif

                </td>

                {{-- <td class="amt">{{ phpformatnumber($ut->theylack) . '$' }}</td>
                <td class="amt">{{ phpformatnumber($ut->welack) . '$' }}</td>
                <td class="amt">{{ phpformatnumber($ut->paybybank) . '$' }}</td> --}}
                <td class="kh16">{{ $ut->desr }}</td>
            </tr>







        @endforeach
        <tr style="background-color:aqua">
            <td colspan=4 style="font-size:16px;font-weight:bold;">Total</td>
            {{-- <td class="total" style="text-align:left;">{{ phpformatnumber($sumusd) . 'USD' }}</td> --}}
            <td class="total">{{ phpformatnumber($gold) . 'G' }}</td>
            <td class="total">{{ phpformatnumber($usd) . '$'}}</td>
            <td class="total">{{ phpformatnumber($thb) . 'B' }}</td>
            <td class="total">{{ phpformatnumber($khr) . 'R'}}</td>
            <td class="total">{{ phpformatnumber($vnd) . 'V'}}</td>
            <td colspan=2 class="total">0</td>
            {{-- <td class="total">{{ phpformatnumber($theylack) . '$'}}</td>
            <td class="total">{{ phpformatnumber($welack) . '$'}}</td>
            <td class="total">{{ phpformatnumber($bank) . '$'}}</td> --}}
        </tr>
    </tbody>
</table>

<div class="row" style="margin:0px;padding:0px;">
    <div class="col-lg-4">
        <div class="table-responsive">
            <table class="table table-bordered kh22-b" style="background-color:rgb(0, 255, 234);">
                @foreach ($sumfns as $key => $fn)
                    <tr>
                        {{-- <td style="text-align:center;">{{ ++$key }}</td> --}}
                        <td style="text-align:right;width:250px;">{{ phpformatnumber($fn->fn) }}</td>
                        <td>{{ $fn->shortcut }}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
