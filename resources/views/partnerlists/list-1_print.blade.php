<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PartnerList-1</title>
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
     margin: 5mm;
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
         }
         .kh16-b{
         font-family:'Noto Sans Khmer', sans-serif;
         font-size:16px;
         font-weight:bold;
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
         }
     .kh14-b{
         font-family:'Noto Sans Khmer', sans-serif;
         font-size:14px;
         font-weight:bold;
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
     }
     .amt{
         text-align:right;
         font-family:Arial, Helvetica, sans-serif;
         font-size:16px;
     }
     .total{
         text-align:right;
         font-family:Arial, Helvetica, sans-serif;
         font-size:16px;
         font-weight:bold;
     }
     #tbl_partner_list td{
       padding:0px 5px 0px 5px;
     }
     #tbl_partner_list th{
       padding:0px 5px 0px 5px;
     }
</style>
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
<body>
    <div id="invoice-pos">
      <div class="pagebreak" style="margin-top:20px;">
          <div class="row" style="margin:0px 5px 10px 5px;">
              <table>
                  <tr>
                      <td class="kh16-b">របាយការណ៏ បញ្ជី ជាមួយដៃគូ {{ $partnername }}</td>
                      @if($alldate=='true')
                      <td class="kh16-b" style="float:right;">គិតត្រឹមថ្ងៃ {{ date('d-m-Y',strtotime($d2)) }}</td>
                      @else
                      <td class="kh16-b" style="float:right;">គិតពី {{ date('d-m-Y',strtotime($d1)) }} ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                      @endif

                  </tr>
              </table>
          </div>
          <div class="row">
            <p class="kh16-b" style="text-align:center;color:rgb(237, 19, 19);padding:0px;">បើកនៅ{{ $logo->name }}</p>
            <div class="table-responsive" style="margin-top:-10px;">
                <table id="tbl_partner_list" class="table table-bordered kh16">
                    <thead class="kh14-b" style="text-align:center;">
                        <th>លរ</th>
                        <th>ថ្ងៃទី</th>
                        <th>បរិយាយ</th>
                        <th>អ្នកទទួល/ផ្ញើ</th>
                        <th>ចំនួនទឹកប្រាក់​</th>
                        <th>សេវ៉ា/ការ</th>
                        <th>សរុប</th>
                    </thead>
                    <tbody id="bodytransfer">
                        @php
                            $total=0;
                            $amount=0;
                            $i=0;
                        @endphp
                        <tr style="background-color:gainsboro">
                            <td style="padding:5px;" colspan=7 class="kh16-b">ដុល្លា</td>
                        </tr>
                        @if($weopen_oldlist)
                          @foreach ($weopen_oldlist->where('cur','USD') as $l)
                              @php
                                  $total+=$l->total;
                                  $amount+=$l->total;
                                  ++$i;
                              @endphp
                            <tr>
                                <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                <td class="kh12-b">
                                  {{ date('d-m-Y',strtotime($predate)) }}
                                </td>
                                <td class="kh12-b">{{ $l->tranname??'បញ្ជីយោង' }}</td>
                                <td class="kh12-b">
                                  @if($l->receive)
                                    {{ $l->receive }}
                                    @if($l->sender)
                                      <br>
                                      {{ $l->sender }}
                                    @endif
                                  @else
                                    {{ $l->sender??'' }}
                                  @endif
                                </td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                                <td style="text-align:right;" class="kh12-b">0</td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                              </tr>
                          @endforeach
                        @endif
                        @foreach ($weopen_records->where('cur','USD') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr>
                              <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                              <td class="kh12-b">
                                {{ date('d-m-Y',strtotime($l->dd)) }}
                              </td>
                              <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                              <td class="kh12-b">
                                @if($l->receive && trim($l->receive)<>'')
                                  {{ $l->receive }}
                                  @if($l->sender)
                                    <br>
                                    {{ $l->sender }}
                                  @endif
                                @else
                                  {{ $l->sender??'' }}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                              <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                  {{ phpformatnumber($l->fee) . $l->feecur}}
                                @endif
                                @if($l->interest && $l->interest<>0)
                                  {{ phpformatnumber($l->interest) . $l->cur}}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                          </tr>
                        @endforeach
                        <tr style="">
                            <td colspan=4 class="kh16-b">សរុប ដុល្លា</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'$'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) . '$'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total) . '$'}}</td>
                        </tr>
                        {{--  THB --}}
                        @php
                            $total=0;
                            $amount=0;
                            $i=0;
                        @endphp
                        <tr style="background-color:gainsboro">
                            <td colspan=7 class="kh16-b" style="padding:5px;">បាត</td>
                        </tr>
                        @if($weopen_oldlist)
                          @foreach ($weopen_oldlist->where('cur','THB') as $l)
                              @php
                                  $total+=$l->total;
                                  $amount+=$l->total;
                                  ++$i;
                              @endphp
                            <tr>
                                <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                <td class="kh12-b">
                                  {{ date('d-m-Y',strtotime($predate)) }}
                                </td>
                                <td class="kh12-b">{{ $l->tranname??'បញ្ជីយោង' }}</td>
                                <td class="kh12-b">
                                  @if($l->receive)
                                    {{ $l->receive }}
                                    @if($l->sender)
                                      <br>
                                      {{ $l->sender }}
                                    @endif
                                  @else
                                    {{ $l->sender??'' }}
                                  @endif
                                </td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                                <td style="text-align:right;" class="kh12-b">0</td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                              </tr>
                          @endforeach
                        @endif
                        @foreach ($weopen_records->where('cur','THB') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr>
                              <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                              <td class="kh12-b">
                                {{ date('d-m-Y',strtotime($l->dd)) }}
                              </td>
                              <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                              <td class="kh12-b">
                                @if($l->receive && trim($l->receive)<>'')
                                  {{ $l->receive }}
                                  @if($l->sender)
                                    <br>
                                    {{ $l->sender }}
                                  @endif
                                @else
                                  {{ $l->sender??'' }}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                              <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                  {{ phpformatnumber($l->fee) . $l->feecur}}
                                @endif
                                @if($l->interest && $l->interest<>0)
                                  {{ phpformatnumber($l->interest) . $l->cur}}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                          </tr>
                        @endforeach
                        <tr style="">
                            <td colspan=4 class="kh16-b">សរុប បាត</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'B'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) . 'B'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total) . 'B'}}</td>
                        </tr>
                        {{-- KHR --}}
                        @php
                            $total=0;
                            $amount=0;
                            $i=0;
                        @endphp
                        <tr style="background-color:gainsboro">
                            <td colspan=7 class="kh16-b" style="padding:5px;">រៀល</td>
                        </tr>
                        @if($weopen_oldlist)
                          @foreach ($weopen_oldlist->where('cur','KHR') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->total;
                                ++$i;
                            @endphp
                              <tr>
                                <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                <td class="kh12-b">
                                  {{ date('d-m-Y',strtotime($l->dd)) }}
                                </td>
                                <td class="kh12-b">{{ $l->tranname??'បញ្ជីយោង' }}</td>
                                <td class="kh12-b">
                                  @if($l->receive)
                                    {{ $l->receive }}
                                    @if($l->sender)
                                      <br>
                                      {{ $l->sender }}
                                    @endif
                                  @else
                                    {{ $l->sender??'' }}
                                  @endif
                                </td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                                <td style="text-align:right;" class="kh12-b">0</td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                              </tr>
                          @endforeach
                        @endif
                        @foreach ($weopen_records->where('cur','KHR') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr>
                              <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                              <td class="kh12-b">
                                {{ date('d-m-Y',strtotime($predate)) }}
                              </td>
                              <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                              <td class="kh12-b">
                                @if($l->receive && trim($l->receive)<>'')
                                  {{ $l->receive }}
                                  @if($l->sender)
                                    <br>
                                    {{ $l->sender }}
                                  @endif
                                @else
                                  {{ $l->sender??'' }}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                              <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                  {{ phpformatnumber($l->fee) . $l->feecur}}
                                @endif
                                @if($l->interest && $l->interest<>0)
                                  {{ phpformatnumber($l->interest) . $l->cur}}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                            </tr>
                        @endforeach
                        <tr style="">
                            <td colspan=4 class="kh16-b">សរុប រៀល</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'R'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) . 'R'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total) . 'R'}}</td>
                        </tr>
                        {{-- VND --}}
                        @php
                            $total=0;
                            $amount=0;
                            $i=0;
                        @endphp
                        <tr style="background-color:gainsboro">
                            <td colspan=7 class="kh16-b" style="padding:5px;">ដុង</td>
                        </tr>
                        @if($weopen_oldlist)
                          @foreach ($weopen_oldlist->where('cur','VND') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->total;
                                ++$i;
                            @endphp
                            <tr>
                                <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                <td class="kh12-b">
                                  {{ date('d-m-Y',strtotime($predate)) }}
                                </td>
                                <td class="kh12-b">{{ $l->tranname??'បញ្ជីយោង' }}</td>
                                <td class="kh12-b">
                                  @if($l->receive)
                                    {{ $l->receive }}
                                    @if($l->sender)
                                      <br>
                                      {{ $l->sender }}
                                    @endif
                                  @else
                                    {{ $l->sender??'' }}
                                  @endif
                                </td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                                <td style="text-align:right;" class="kh12-b">0</td>
                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                            </tr>
                          @endforeach
                        @endif
                        @foreach ($weopen_records->where('cur','VND') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr>
                              <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                              <td class="kh12-b">
                                {{ date('d-m-Y',strtotime($l->dd)) }}
                              </td>
                              <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                              <td class="kh12-b">
                                @if($l->receive && trim($l->receive)<>'')
                                  {{ $l->receive }}
                                  @if($l->sender)
                                    <br>
                                    {{ $l->sender }}
                                  @endif
                                @else
                                  {{ $l->sender??'' }}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->amount) . $l->cur}}</td>
                              <td style="text-align:right;" class="kh12-b">
                                @if($l->fee && $l->fee<>0)
                                  {{ phpformatnumber($l->fee) . $l->feecur}}
                                @endif
                                @if($l->interest && $l->interest<>0)
                                  {{ phpformatnumber($l->interest) . $l->cur}}
                                @endif
                              </td>
                              <td style="text-align:right;" class="kh12-b">{{ phpformatnumber($l->total) . $l->cur}}</td>
                            </tr>
                        @endforeach
                        <tr style="">
                            <td colspan=4 class="kh16-b">សរុប ដុង</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($amount) .'V'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total-$amount) . 'V'}}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total) . 'V'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>

    <div class="row">
        <div class="card" style="border-bottom:none;">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;padding:25px 0px 0px 0px;background-color:aquamarine">មុនទូទាត់</h1>
            </div>
            <div class="card-body" style="">
                <div class="row">

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

                      <table class="table table-bordered kh22-b" style="width:50%;">
                          <tr style="background-color:azure">
                              <td class="kh22" style="text-align:center">បើកនៅ {{ $logo->name }}</td>
                          </tr>

                          <tr>
                              <td class="kh22-b" style="text-align:right;">
                                  {{ phpformatnumber($weusd) . ' USD' }}
                              </td>
                          </tr>
                          <tr>
                              <td class="kh22-b" style="text-align:right;">
                                  {{ phpformatnumber($wethb) . ' THB' }}
                              </td>
                          </tr>
                          <tr>
                              <td class="kh22-b" style="text-align:right;">
                                  {{ phpformatnumber($wekhr) . ' KHR' }}
                              </td>
                          </tr>
                          <tr>
                              <td class="kh22-b" style="text-align:right;">
                                  {{ phpformatnumber($wevnd) . ' VND' }}
                              </td>
                          </tr>
                      </table>

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

                        <table class="table table-bordered kh22-b" style="width:50%;">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">បើកនៅ {{ $partnername }}</td>
                            </tr>

                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($theyusd) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($theythb) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($theykhr) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($theyvnd) . ' VND' }}
                                </td>
                            </tr>
                        </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card" style="border-bottom:none;border-top:none;">
            <div class="card-title">
                <h1 class="kh22-b" style="text-align:center;padding-top:25px;">ក្រោយទូទាត់</h1>
            </div>
            <div class="card-body">
                <div class="row">

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

                        <table class="table table-bordered kh22-b" style="width:50%;">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">នៅខ្វះ {{ $logo->name }}</td>
                            </tr>

                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($usd1) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($thb1) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($khr1) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($vnd1) . ' VND' }}
                                </td>
                            </tr>
                        </table>




                        <table class="table table-bordered kh22-b" style="width:50%;">
                            <tr style="background-color:azure">
                                <td class="kh22" style="text-align:center">នៅខ្វះ {{ $partnername }}</td>
                            </tr>

                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($usd2) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($thb2) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($khr2) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($vnd2) . ' VND' }}
                                </td>
                            </tr>
                        </table>

                </div>
            </div>
        </div>
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
