<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListBook3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">
     @page
		  {
        size: A4;
		  	margin:10mm 10px 50px 10px;
		   }

    div.pagebreak, div.appendix {page-break-after: always;}
    #invoice-pos{
        box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
        padding:0mm;
        margin:0 auto;
        width:60mm;
        background:#fff;
    }
    #invoice-pos ::selection{
        background:#34495E;
        color:#fff;
    }
    #invoice-pos ::-mox-selection{
        background:#34495E;
        color:#fff;
    }

    thead{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        padding:0px;
        color:black;
    }
    tbody{
        font-family:arial;
        font-size:10px;
        padding:0px;
    }
    .logo{
        font-family:khmer os muol light;
        font-size:22px;
        margin-top:5px;
        color:black;
    }
    .info{
        font-family:khmer os muol light;
        font-size:16px;
        color:black;
    }
    #top p{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        margin-left:0px;
        padding:0px;
        color:black;
    }
    .receipt_info{
        border-style:none;
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
        padding:0px;
        margin-left:0px;
    }
    .service{
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:12px;
        color:black;
    }

    .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            color:black;
            }
            .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            color:black
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            color:black;
            }
        .kh10-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
            font-weight:bold;
            color:black
            }
        .kh10{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
            color:black
            }
        .kh8-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:8px;
            font-weight:bold;
            color:black
            }
        .kh8{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:8px;
            color:black
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            color:black
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }

        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        td{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            padding:0px;
            color:black;
        }
        .amt{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            color:black;
        }
        .total{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
            color:black;
        }
        #tbl_partner_list td{
          padding:0px 5px 0px 5px;
        }
        #tbl_partner_list th{
          padding:0px 5px 0px 5px;
        }
        #tbl td{
          border:1px solid black;
          padding:2px;
        }
        #tbl tr{
          border:1px solid black;
        }
        #tbl th{
          border:1px solid black;
          padding:5px;
        }

        .tbltotal td{
          border:1px solid black;
          padding:2px;
          font-family:'Noto Sans Khmer', sans-serif;
          font-size:16px;
          font-weight:bold;
        }
        .tbltotal tr{
          /* border:1px solid black; */
        }
        .tbltotal th{
          border:1px solid black;
          padding:5px;
        }
        .tblwethey td{
          padding:2px;

        }
      #tbl_group_id td{
      padding:0px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:12px;
      /* font-weight:bold; */
    }
    #tbl_we td{
      padding:2px 5px 2px 5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:12px;
      font-weight:bold;
      word-wrap: break-word;
      /* border:1px solid black; */
    }
    #tbl_we td.total{
      padding:2px 5px 2px 5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:16px;
      font-weight:bold;
      word-wrap: break-word;
    }
    #tbl_we th{
      padding:5px;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:12px;
      border:1px solid black;
    }
    .tblbefore td{
        border-style:solid none none none;
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:16px;
        font-weight:bold;
        height:35px;
    }
    .tblafter td{
        border-style:solid none none none;
        font-family:'Noto Sans Khmer', sans-serif;
        font-size:16px;
        font-weight:bold;
        height:35px;
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
<body>
    <div id="invoice-pos">
      <div class="row" style="margin:0px 5px 10px 5px;">
          <table>
              <tr>
                  <td class="kh16-b">តារាងសមតុល្យ ជាមួយដៃគូ {{ $partnername }}</td>
                  @if($alldate=='true')
                  <td class="kh16-b" style="float:right;">គិតត្រឹមថ្ងៃ {{ date('d-m-Y',strtotime($d2)) }}</td>
                  @else
                  <td class="kh16-b" style="float:right;">គិតពី {{ date('d-m-Y',strtotime($d1)) }} ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                  @endif

              </tr>
          </table>
      </div>
      <div class="row" style="margin:0px;">
        <table id="tbl_we" class="table table-bordered kh12-b" style="margin:0px;width:100%;table-layout:fixed;">
          <thead class="kh12-b" style="text-align:center;">
              <th style="width:50px;">លរ</th>
              <th style="width:80px;">ថ្ងៃទី</th>
              <th style="width:80px;">អ្នកកត់ត្រា</th>
              <th style="width:150px;">ប្រតិបត្តិការណ៏</th>
              <th style="width:120px;">សរុបទឹកប្រាក់</th>
              <th style="width:120px;">សមតុល្យ</th>
              <th style="width:150px;">Rec/Sender</th>
              <th style="width:150px;">ផ្សេងៗ</th>
              <th style="width:140px;">ចំនួន/សេវ៉ា/ការ​</th>

          </thead>
          <tbody id="bodytransfer">
            @php
                $total=0;
                $amount=0;
                $i=0;
            @endphp
            <tr style="border:2px solid black;border-bottom:1px;">
              <td colspan=9 class="kh16-b">ដុល្លា/USD</td>
            </tr>
            @if($oldlist)
              @foreach ($oldlist->where('cur','USD') as $l)
                  @php
                      $total+=$l->total;
                      $amount+=$l->amount;
                      ++$i;
                  @endphp
                  <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                      <td style="text-align:center;">{{ $i }}</td>
                      <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }} <br> {{ $l->tt }}</td>
                      <td>{{ $l->recordby??'' }}</td>

                      <td>{{ $l->tranname??'លុយសល់' }}</td>
                      <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($l->total) .  '$'  }}</td>
                      <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) .  '$'  }}</td>
                      <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                      <td>{{ $l->desr??'' }}</td>
                      <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br> {{ phpformatnumber($l->fee) . $l->cur}}</td>

                  </tr>
              @endforeach
            @endif
            @foreach ($records->where('cur','USD') as $l)
                @php
                    $total+=$l->total;
                    $amount+=$l->amount;
                    ++$i;
                @endphp
                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                    <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                    <td>{{ date('d-m-Y',strtotime($l->dd)) }} <br>{{ $l->tt }}</td>
                    <td>{{ $l->recordby??'' }} <br>{{ $l->idtransfer }}</td>
                    <td>{{ $l->tranname??'' }}</td>
                    <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ $l->total>0?'+':'' }}{{ phpformatnumber($l->total) . '$' }}</td>
                    <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) . '$' }}</td>
                    <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                    <td>{{ $l->desr }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br>
                      @if($l->fee && $l->fee<>0)
                        {{ phpformatnumber($l->fee) . $l->feecur}}
                      @endif
                      @if($l->interest && $l->interest<>0)
                        {{ phpformatnumber($l->interest) . $l->cur}}
                      @endif
                    </td>
                </tr>

            @endforeach
            <tr style="border:2px solid black;border-top:1px;">
                <td class="total" colspan=5 style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total).'USD'}}</td>
                <td colspan=3 class="total" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'USD'}}</td>
                <td class="total" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'USD'}}</td>
            </tr>
            {{--  THB --}}
            @php
                $total=0;
                $amount=0;
                $i=0;
            @endphp
            <tr style="border:2px solid black;border-bottom:1px;">
                <td colspan=9 class="kh16-b">បាត/THB</td>
            </tr>
            @if($oldlist)
              @foreach ($oldlist->where('cur','THB') as $l)
                  @php
                      $total+=$l->total;
                      $amount+=$l->amount;
                      ++$i;
                  @endphp
                  <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                      <td style="text-align:center;">{{ $i }}</td>
                      <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }} <br> {{ $l->tt }}</td>
                      <td>{{ $l->recordby??'' }}</td>

                      <td>{{ $l->tranname??'លុយសល់' }}</td>
                      <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($l->total) .  'B'  }}</td>
                      <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) .  'B'  }}</td>
                      <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                      <td>{{ $l->desr??'' }}</td>
                      <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->amount) . $l->cur}} <br> {{ phpformatnumber($l->fee) . $l->cur}}</td>

                  </tr>
              @endforeach
            @endif
            @foreach ($records->where('cur','THB') as $l)
                @php
                    $total+=$l->total;
                    $amount+=$l->amount;
                    ++$i;
                @endphp
                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                    <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                    <td>{{ date('d-m-Y',strtotime($l->dd)) }} <br>{{ $l->tt }}</td>
                    <td>{{ $l->recordby??'' }} <br>{{ $l->idtransfer }}</td>
                    <td>{{ $l->tranname??'' }}</td>
                    <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ $l->total>0?'+':'' }}{{ phpformatnumber($l->total) . 'B' }}</td>
                    <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) . 'B' }}</td>
                    <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                    <td>{{ $l->desr }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br>
                      @if($l->fee && $l->fee<>0)
                        {{ phpformatnumber($l->fee) . $l->feecur}}
                      @endif
                      @if($l->interest && $l->interest<>0)
                        {{ phpformatnumber($l->interest) . $l->cur}}
                      @endif
                    </td>
                </tr>

            @endforeach
            <tr style="border:2px solid black;border-top:1px;">
                <td class="total" colspan=5 style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total).'THB'}}</td>
                <td colspan=3 class="total" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'THB'}}</td>
                <td class="total" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'THB'}}</td>
            </tr>

            {{-- KHR --}}
            @php
                $total=0;
                $amount=0;
                $i=0;
            @endphp
            <tr style="border:2px solid black;border-bottom:1px;">
              <td colspan=9 class="kh16-b">រៀល/KHR</td>
            </tr>
            @if($oldlist)
              @foreach ($oldlist->where('cur','KHR') as $l)
                  @php
                      $total+=$l->total;
                      $amount+=$l->amount;
                      ++$i;
                  @endphp
                  <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                      <td style="text-align:center;">{{ $i }}</td>
                      <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }} <br> {{ $l->tt }}</td>
                      <td>{{ $l->recordby??'' }}</td>

                      <td>{{ $l->tranname??'លុយសល់' }}</td>
                      <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($l->total) .  'R'  }}</td>
                      <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) .  'R'  }}</td>
                      <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                      <td>{{ $l->desr??'' }}</td>
                      <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br> {{ phpformatnumber($l->fee) . $l->cur}}</td>

                  </tr>
              @endforeach
            @endif
            @foreach ($records->where('cur','KHR') as $l)
                @php
                    $total+=$l->total;
                    $amount+=$l->amount;
                    ++$i;
                @endphp
                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                    <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                    <td>{{ date('d-m-Y',strtotime($l->dd)) }} <br>{{ $l->tt }}</td>
                    <td>{{ $l->recordby??'' }} <br>{{ $l->idtransfer }}</td>
                    <td>{{ $l->tranname??'' }}</td>
                    <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ $l->total>0?'+':'' }}{{ phpformatnumber($l->total) . 'R' }}</td>
                    <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) . 'R' }}</td>
                    <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                    <td>{{ $l->desr }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br>
                      @if($l->fee && $l->fee<>0)
                        {{ phpformatnumber($l->fee) . $l->feecur}}
                      @endif
                      @if($l->interest && $l->interest<>0)
                        {{ phpformatnumber($l->interest) . $l->cur}}
                      @endif
                    </td>
                </tr>

            @endforeach
            <tr style="border:2px solid black;border-top:1px;">
                <td class="total" colspan=5 style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total).'KHR'}}</td>
                <td colspan=3 class="total" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'KHR'}}</td>
                <td class="total" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'KHR'}}</td>
            </tr>

            {{-- VND --}}
            @php
                $total=0;
                $amount=0;
                $i=0;
            @endphp
            <tr style="border:2px solid black;border-bottom:1px;">
                <td colspan=9 class="kh16-b">ដុង/VND</td>
            </tr>
            @if($oldlist)
              @foreach ($oldlist->where('cur','VND') as $l)
                  @php
                      $total+=$l->total;
                      $amount+=$l->amount;
                      ++$i;
                  @endphp
                  <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                      <td style="text-align:center;">{{ $i }}</td>
                      <td class="kh14">{{ date('d-m-Y',strtotime($last_trandate_usd)) }} <br> {{ $l->tt }}</td>
                      <td>{{ $l->recordby??'' }}</td>

                      <td>{{ $l->tranname??'លុយសល់' }}</td>
                      <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($l->total) .  'V'  }}</td>
                      <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) .  'V'  }}</td>
                      <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                      <td>{{ $l->desr??'' }}</td>
                      <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br> {{ phpformatnumber($l->fee) . $l->cur}}</td>

                  </tr>
              @endforeach
            @endif
            @foreach ($records->where('cur','VND') as $l)
                @php
                    $total+=$l->total;
                    $amount+=$l->amount;
                    ++$i;
                @endphp
                <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                    <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                    <td>{{ date('d-m-Y',strtotime($l->dd)) }} <br>{{ $l->tt }}</td>
                    <td>{{ $l->recordby??'' }} <br>{{ $l->idtransfer }}</td>
                    <td>{{ $l->tranname??'' }}</td>
                    <td style="text-align:right;@if($l->total>0)color:blue;@else color:red; @endif">{{ $l->total>0?'+':'' }}{{ phpformatnumber($l->total) . 'V' }}</td>
                    <td style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total) . 'V' }}</td>
                    <td>{{ $l->receive??'' }} <br> {{ $l->sender??'' }}</td>
                    <td>{{ $l->desr }}</td>
                    <td style="text-align:right;">{{ phpformatnumber($l->amount) . $l->cur}} <br>
                      @if($l->fee && $l->fee<>0)
                        {{ phpformatnumber($l->fee) . $l->feecur}}
                      @endif
                      @if($l->interest && $l->interest<>0)
                        {{ phpformatnumber($l->interest) . $l->cur}}
                      @endif
                    </td>
                </tr>

            @endforeach
            <tr style="border:2px solid black;border-top:1px;">
                <td class="total" colspan=5 style="text-align:right;@if($total>0)color:blue;@else color:red; @endif">{{ phpformatnumber($total).'VND'}}</td>
                <td colspan=3 class="total" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'VND'}}</td>
                <td class="total" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'VND'}}</td>
            </tr>

          </tbody>
        </table>
      </div>

      <div class="row" style="margin:10px 0px 0px 0px;padding:0px;">
        @php
            $weusd=0;
            $wethb=0;
            $wekhr=0;
            $wevnd=0;
            foreach($befortotalwe as $w)
            {
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
        @php
            $theyusd=0;
            $theythb=0;
            $theykhr=0;
            $theyvnd=0;
            foreach($befortotalthey as $they)
            {
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
        @php
            $usd1=0;
            $thb1=0;
            $khr1=0;
            $vnd1=0;
            $usd2=0;
            $thb2=0;
            $khr2=0;
            $vnd2=0;
            foreach($aftertotal as $a)
            {
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
        <table class="table table-border tbltotal" style="margin:0px;padding:0px;">
            <tr>
              <td class="kh22-b" style="text-align:center;" colspan=2>មុនទូទាត់</td>
              <td class="kh22-b" style="text-align:center;" colspan=2>ក្រោយទូទាត់</td>
            </tr>
            <tr>
                <td style="text-align:center;width:25%">បើកនៅ {{ $logo->name }}</td>
                <td style="text-align:center;width:25%">បើកនៅ {{ $partnername }}</td>
                <td style="text-align:center;width:25%">នៅខ្វះ {{ $logo->name }}</td>
                <td style="text-align:center;width:25%">នៅខ្វះ {{ $partnername }}</td>
            </tr>

            <tr>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($weusd)) . ' $' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($theyusd)) . ' $' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($usd1)) . ' $' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($usd2)) . ' $' }}
                </td>
            </tr>
            <tr>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($wethb)) . ' B' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($theythb)) . ' B' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($thb1)) . ' B' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($thb2)) . ' B' }}
                </td>
            </tr>
            <tr>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($wekhr)) . ' R' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($theykhr)) . ' R' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($khr1)) . ' R' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($khr2)) . ' R' }}
                </td>
            </tr>
            <tr>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($wevnd)) . ' D' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($theyvnd)) . ' D' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($vnd1)) . ' D' }}
                </td>
                <td style="text-align:right;padding:3px;">
                    {{ phpformatnumber(abs($vnd2)) . ' D' }}
                </td>
            </tr>

        </table>

      </div>

    </div>

</body>
<script type="text/javascript">

    printContent('invoice-pos');
    function printContent(el)
    {

      //var restorpage=document.body.innerHTML;
      var printloc=document.getElementById(el).innerHTML;
      document.body.innerHTML=printloc;
      window.print();
      window.onafterprint = function(){ window.close()};
      //history.back();
      //document.body.innerTHML=restorpage;

    }
</script>
</html>
