<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PartnerListPrint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css">


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
        }
        .tbltotal tr{
          border:1px solid black;
        }
        .tbltotal th{
          border:1px solid black;
          padding:5px;
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
        <div class="" style="margin-top:20px;">
            <div class="row" style="margin:0px 15px 5px 15px;">
                <table>
                    <tr>
                        <td class="kh22-b">សៀវភៅបញ្ជី ដៃគូ {{ $partnername }}</td>
                        @if($alldate=='true')
                        <td class="kh16-b" style="float:right;">គិតត្រឹមថ្ងៃ {{ date('d-m-Y',strtotime($d2)) }}</td>
                        @else
                        <td class="kh16-b" style="float:right;">គិតពី {{ date('d-m-Y',strtotime($d1)) }} ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                        @endif

                    </tr>
                </table>
            </div>
            <div class="row" style="margin:0px 5px 0px 5px;">
                <div class="col-lg-6">
                    <p class="kh16-b" style="text-align:center;color:rgb(237, 19, 19);padding:0px;">បើកនៅ{{ $logo->name }}</p>
                    <div class="table-responsive" style="margin-top:-10px;">
                      <table id="tbl" class="table table-bordered kh16">
                          <thead class="kh14-b" style="text-align:center;">
                              <th>លរ</th>
                              <th>ថ្ងៃទី</th>
                              <th>បរិយាយ</th>
                              <th>អ្នកទទួល</th>
                              <th>អ្នកផ្ញើ</th>
                              <th>ចំនួនទឹកប្រាក់​</th>
                              <th>សេវ៉ា/ការ</th>
                              <th>សរុបទឹកប្រាក់</th>
                          </thead>
                          <tbody id="bodytransfer">
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                              @if($selcur=='usd' || $selcur=='all currency')
                                <tr style="background-color:gainsboro">
                                    <td style="padding:5px;" colspan=8 class="kh16-b">ដុល្លា/USD</td>
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
                                            {{ date('d-m-Y',strtotime($last_trandate_usd)) }}
                                        </td>
                                        <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">0</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
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
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">
                                        @if($l->fee && $l->fee<>0)
                                            {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                        @endif
                                        @if($l->interest && $l->interest<>0)
                                            {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                        @endif
                                        </td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                    </tr>
                                @endforeach
                                <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប ដុល្លា</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . '$'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . '$'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'$'}}</td>
                                </tr>
                              @endif
                              {{--  THB --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                                @if($selcur=='thb' || $selcur=='all currency')
                                    <tr style="background-color:gainsboro">
                                        <td style="padding:5px;" colspan=8 class="kh16-b">បាត/THB</td>
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
                                                {{ date('d-m-Y',strtotime($last_trandate_thb)) }}
                                            </td>
                                            <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                            <td class="kh12-b">{{ $l->receive??''}}</td>
                                            <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                            <td style="text-align:right;" class="kh12-b">0</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
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
                                            <td class="kh12-b">{{ $l->receive??''}}</td>
                                            <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                            <td style="text-align:right;" class="kh12-b">
                                            @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                            @endif
                                            @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                            @endif
                                            </td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        </tr>
                                    @endforeach
                                    <tr style="">

                                        <td colspan=5 class="kh14-b" style="">សរុប បាត</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'B'}}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'B'}}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'B'}}</td>
                                    </tr>
                                @endif
                                {{-- KHR --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                            @if($selcur=='khr' || $selcur=='all currency')
                              <tr style="background-color:gainsboro">
                                <td style="padding:5px;" colspan=8 class="kh16-b">រៀល/KHR</td>
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
                                        {{ date('d-m-Y',strtotime($last_trandate_khr)) }}
                                      </td>
                                      <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                      <td class="kh12-b">{{ $l->receive??''}}</td>
                                      <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                      <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                      <td style="text-align:right;" class="kh12-b">0</td>
                                      <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
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
                                      {{ date('d-m-Y',strtotime($l->dd)) }}
                                    </td>
                                    <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                                    <td class="kh12-b">{{ $l->receive??''}}</td>
                                    <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                    <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                    <td style="text-align:right;" class="kh12-b">
                                      @if($l->fee && $l->fee<>0)
                                        {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                      @endif
                                      @if($l->interest && $l->interest<>0)
                                        {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                      @endif
                                    </td>
                                    <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                </tr>
                              @endforeach
                              <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប រៀល</td>
                                  <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'R'}}</td>
                                  <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'R'}}</td>
                                  <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'R'}}</td>
                              </tr>
                            @endif
                              {{-- VND --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                              @if($selcur=='vnd' || $selcur=='all currency')
                                <tr style="background-color:gainsboro">
                                    <td style="padding:5px;" colspan=8 class="kh16-b">ដុង/VND</td>
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
                                            {{ date('d-m-Y',strtotime($last_trandate_vnd)) }}
                                        </td>
                                        <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">0</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
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
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">
                                        @if($l->fee && $l->fee<>0)
                                            {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                        @endif
                                        @if($l->interest && $l->interest<>0)
                                            {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                        @endif
                                        </td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                    </tr>
                                @endforeach
                                <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប ដុង</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'V'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'V'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'V'}}</td>
                                </tr>
                              @endif
                          </tbody>
                      </table>
                    </div>
                </div>
                {{-- They --}}
                <div class="col-lg-6">
                    <p class="kh16-b" style="text-align:center;color:blue;padding:0px;">បើកនៅ{{ $partnername }}</p>
                    <div class="table-responsive" style="margin-top:-10px;">
                        <table id="tbl" class="table table-bordered kh16">
                            <thead class="kh14-b" style="text-align:center;">
                                <th>លរ</th>
                                <th>ថ្ងៃទី</th>
                                <th>បរិយាយ</th>
                                <th>អ្នកទទួល</th>
                                <th>អ្នកផ្ញើ</th>
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
                              @if($selcur=='usd' || $selcur=='all currency')
                                <tr style="background-color:gainsboro">
                                    <td style="padding:5px;" colspan=8 class="kh16-b">ដុល្លា/USD</td>
                                </tr>
                                @if($theyopen_oldlist)
                                    @foreach ($theyopen_oldlist->where('cur','USD') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->total;
                                            ++$i;
                                        @endphp
                                    <tr>
                                        <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                        <td class="kh12-b">
                                            {{ date('d-m-Y',strtotime($last_trandate_usd)) }}
                                        </td>
                                        <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">0</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @foreach ($theyopen_records->where('cur','USD') as $l)
                                    @php
                                        $total+=$l->total;
                                        $amount+= $l->amount;
                                        ++$i;
                                    @endphp
                                    <tr>
                                        <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                        <td class="kh12-b">
                                        {{ date('d-m-Y',strtotime($l->dd)) }}
                                        </td>
                                        <td class="kh12-b">{{ $l->tranname??''}}|{{ $l->recordby }}</td>
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">
                                        @if($l->fee && $l->fee<>0)
                                            {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                        @endif
                                        @if($l->interest && $l->interest<>0)
                                            {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                        @endif
                                        </td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                    </tr>
                                @endforeach
                                <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប ដុល្លា</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . '$'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . '$'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'$'}}</td>
                                </tr>
                              @endif
                              {{--  THB --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                            @if($selcur=='thb' || $selcur=='all currency')
                                <tr style="background-color:gainsboro">
                                    <td style="padding:5px;" colspan=8 class="kh16-b">បាត/THB</td>
                                </tr>
                                @if($theyopen_oldlist)
                                    @foreach ($theyopen_oldlist->where('cur','THB') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->total;
                                            ++$i;
                                        @endphp
                                    <tr>
                                        <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                        <td class="kh12-b">
                                            {{ date('d-m-Y',strtotime($last_trandate_thb)) }}
                                        </td>
                                        <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">0</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @foreach ($theyopen_records->where('cur','THB') as $l)
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
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">
                                        @if($l->fee && $l->fee<>0)
                                            {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                        @endif
                                        @if($l->interest && $l->interest<>0)
                                            {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                        @endif
                                        </td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                    </tr>
                                @endforeach
                                <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប បាត</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'B'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'B'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'B'}}</td>
                                </tr>
                            @endif
                              {{-- KHR --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                              @if($selcur=='thb' || $selcur=='all currency')
                                <tr style="background-color:gainsboro">
                                    <td style="padding:5px;" colspan=8 class="kh16-b">រៀល/KHR</td>
                                </tr>
                                @if($theyopen_oldlist)
                                    @foreach ($theyopen_oldlist->where('cur','KHR') as $l)
                                        @php
                                            $total+=$l->total;
                                            $amount+=$l->total;
                                            ++$i;
                                        @endphp
                                        <tr>
                                            <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                            <td class="kh12-b">
                                                {{ date('d-m-Y',strtotime($last_trandate_khr)) }}
                                            </td>
                                            <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                            <td class="kh12-b">{{ $l->receive??''}}</td>
                                            <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                            <td style="text-align:right;" class="kh12-b">0</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                @foreach ($theyopen_records->where('cur','KHR') as $l)
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
                                        <td class="kh12-b">{{ $l->receive??''}}</td>
                                        <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                        <td style="text-align:right;" class="kh12-b">
                                        @if($l->fee && $l->fee<>0)
                                            {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                        @endif
                                        @if($l->interest && $l->interest<>0)
                                            {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                        @endif
                                        </td>
                                        <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                    </tr>
                                @endforeach
                                <tr style="">
                                    <td colspan=5 class="kh14-b" style="">សរុប រៀល</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'R'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'R'}}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'R'}}</td>
                                </tr>
                              @endif
                              {{-- VND --}}
                              @php
                                  $total=0;
                                  $amount=0;
                                  $i=0;
                              @endphp
                               @if($selcur=='vnd' || $selcur=='all currency')
                                    <tr style="background-color:gainsboro">
                                        <td style="padding:5px;" colspan=8 class="kh16-b">ដុង/VND</td>
                                    </tr>
                                    @if($theyopen_oldlist)
                                        @foreach ($theyopen_oldlist->where('cur','VND') as $l)
                                            @php
                                                $total+=$l->total;
                                                $amount+=$l->total;
                                                ++$i;
                                            @endphp
                                            <tr>
                                                <td class="kh12-b" style="text-align:center;">{{ $i }}</td>
                                                <td class="kh12-b">
                                                    {{ date('d-m-Y',strtotime($last_trandate_vnd)) }}
                                                </td>
                                                <td class="kh12-b">{{ $l->tranname??'លុយសល់' }}</td>
                                                <td class="kh12-b">{{ $l->receive??''}}</td>
                                                <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                                <td style="text-align:right;" class="kh12-b">0</td>
                                                <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @foreach ($theyopen_records->where('cur','VND') as $l)
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
                                            <td class="kh12-b">{{ $l->receive??''}}</td>
                                            <td class="kh12-b"> {{ $l->sender??'' }}</td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->amount)) . $l->cur}}</td>
                                            <td style="text-align:right;" class="kh12-b">
                                            @if($l->fee && $l->fee<>0)
                                                {{ phpformatnumber(abs($l->fee)) . $l->feecur}}
                                            @endif
                                            @if($l->interest && $l->interest<>0)
                                                {{ phpformatnumber(abs($l->interest)) . $l->cur}}
                                            @endif
                                            </td>
                                            <td style="text-align:right;" class="kh12-b">{{ phpformatnumber(abs($l->total)) . $l->cur}}</td>
                                        </tr>
                                    @endforeach
                                    <tr style="">
                                        <td colspan=5 class="kh14-b" style="">សរុប ដុង</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($amount)) . 'V'}}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total-$amount)) . 'V'}}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($total)) .'V'}}</td>
                                    </tr>
                              @endif
                          </tbody>
                        </table>
                    </div>
                </div>
          </div>
        </div>


        <div class="row" style="margin:0px 5px 0px 5px;">
          <table class="table">
              <tr>
                <td style="width:50%;border-style:none;">

                    <div class="card" style="border-bottom:none;border-top:none;">
                      <div class="card-title" style="background-color:aquamarine">
                          <h1 class="kh22-b" style="text-align:center;padding:5px;">មុនទូទាត់</h1>
                      </div>
                      <div class="card-body" style="margin-top:-20px;">
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

                                <table id="" class="table table-bordered kh16-b tbltotal" style="width:50%;">
                                    <tr style="background-color:azure">
                                        <td class="kh16-b" style="text-align:center;padding:0px;">បើកនៅ {{ $logo->name }}</td>
                                    </tr>

                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:3px;">
                                            {{ phpformatnumber(abs($weusd)) . ' $' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:3px;">
                                            {{ phpformatnumber(abs($wethb)) . ' B' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:3px;">
                                            {{ phpformatnumber(abs($wekhr)) . ' R' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:3px;">
                                            {{ phpformatnumber(abs($wevnd)) . ' D' }}
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

                                  <table  class="table table-bordered kh16-b tbltotal" style="width:50%;">
                                      <tr style="background-color:azure">
                                          <td class="kh16-b" style="text-align:center;padding:0px;">បើកនៅ {{ $partnername }}</td>
                                      </tr>

                                      <tr>
                                          <td class="kh16-b" style="text-align:right;padding:3px;">
                                              {{ phpformatnumber(abs($theyusd)) . ' $' }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="kh16-b" style="text-align:right;padding:3px;">
                                              {{ phpformatnumber(abs($theythb)) . ' B' }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="kh16-b" style="text-align:right;padding:3px;">
                                              {{ phpformatnumber(abs($theykhr)) . ' R' }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td class="kh16-b" style="text-align:right;padding:3px;">
                                              {{ phpformatnumber(abs($theyvnd)) . ' D' }}
                                          </td>
                                      </tr>
                                  </table>

                          </div>
                      </div>
                    </div>

                </td>
                <td style="width:50%;border-style:none;">

                    <div class="card" style="border-bottom:none;border-top:none;">
                        <div class="card-title" style="background-color:aquamarine">
                            <h1 class="kh22-b" style="text-align:center;padding:5px;">ក្រោយទូទាត់</h1>
                        </div>
                        <div class="card-body" style="margin-top:-20px;">
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

                                    <table id="" class="table table-bordered kh16-b tbltotal" style="width:50%;">
                                        <tr style="background-color:azure">
                                            <td class="kh16-b" style="text-align:center;padding:0px;">នៅខ្វះ {{ $logo->name }}</td>
                                        </tr>

                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($usd1)) . ' $' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($thb1)) . ' B' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($khr1)) . ' R' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($vnd1)) . ' D' }}
                                            </td>
                                        </tr>
                                    </table>




                                    <table class="table table-bordered kh22-b tbltotal" style="width:50%;">
                                        <tr style="background-color:azure">
                                            <td class="kh16-b" style="text-align:center;padding:0px;">នៅខ្វះ {{ $partnername }}</td>
                                        </tr>

                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($usd2)) . ' $' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($thb2)) . ' B' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($khr2)) . ' R' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh16-b" style="text-align:right;padding:3px;">
                                                {{ phpformatnumber(abs($vnd2)) . ' D' }}
                                            </td>
                                        </tr>
                                    </table>

                            </div>
                        </div>
                    </div>

                </td>

              </tr>
          </table>

        </div>




    </div>

</body>
<script type="text/javascript">

    //printContent('invoice-pos');
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
