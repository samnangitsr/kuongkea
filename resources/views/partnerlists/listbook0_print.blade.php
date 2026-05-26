<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListBook1</title>
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
        }
        .tbltotal tr{
          border:1px solid black;
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
                  <td class="kh16-b">ផ្ទៀងផ្ទាត់បញ្ជី ជាមួយដៃគូ {{ $partnername }}</td>
                  @if($alldate=='true')
                  <td class="kh16-b" style="float:right;">គិតត្រឹមថ្ងៃ {{ date('d-m-Y',strtotime($d2)) }}</td>
                  @else
                  <td class="kh16-b" style="float:right;">គិតពី {{ date('d-m-Y',strtotime($d1)) }} ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                  @endif

              </tr>
          </table>
      </div>
      <div class="row" style="margin:0px;">
       <table class="table">
          <tr>
            <td style="width:50%">
              <table id="tbl_we" class="table table-bordered kh16  tblwethey">
                <tr>
                  <td colspan=5 class="kh12-b" colspan=5 style="text-align:center;">បើកនៅ{{ $logo->name }}</td>
                </tr>
                <tr>
                  <td style="text-align:center;">លរ</td>
                  <td style="text-align:center;">ម៉ោង</td>
                  <td style="text-align:center;">អ្នកកត់ត្រា</td>
                  <td style="text-align:center;">សរុបទឹកប្រាក់</td>
                  <td style="text-align:center;">ផ្សេងៗ</td>
                </tr>

                  <tbody id="bodytransfer">
                    @php
                        $total=0;
                        $amount=0;
                        $i=0;
                    @endphp
                    <tr style="border:2px solid black;border-bottom:1px;">
                      <td colspan=5 class="kh12-b">ដុល្លា/USD</td>
                    </tr>
                    @if($weopen_oldlist)
                      @foreach ($weopen_oldlist->where('cur','USD') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->tranname??'លុយសល់' }}</td>
                              <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  '$'  }}</td>
                              <td style="text-align:center;">{{ $l->desr??'' }}</td>
                          </tr>
                      @endforeach
                    @endif
                    @foreach ($weopen_records->where('cur','USD') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                            <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                            <td>{{ $l->tt }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) . '$' }}</td>
                            <td class="kh10-b" style="text-align:center;">
                              @if($l->receive && strlen(trim($l->receive,' '))>0)
                                {{ $l->desr . '(' . $l->receive . ')' }}
                              @else
                                {{ $l->desr }}
                              @endif
                            </td>
                        </tr>
                        @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
                          @php
                              $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                          @endphp
                          <tr>
                              <td style="padding:0px;" colspan=5>
                                  <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:100%">
                                      <tbody>
                                        @foreach ($getdata[0] as $ex)
                                          <tr style="">
                                              <td>
                                                  {{ $ex->user->name . '('. $ex->tt . ')' }}
                                              </td>

                                              <td>ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                @if($l->trancode==1)
                                                  {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @else
                                                {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @endif
                                            </td>
                                            <td style="text-align:right;">
                                              {{ floatval($ex->drate) }}
                                            </td>

                                          </tr>
                                          @endforeach
                                          @foreach ($getdata[1] as $t)
                                          <tr style="">
                                              <td>
                                                  {{$t->user->name . '(' . $t->tt . ')' }}
                                              </td>

                                              <td>{{ $t->partner->name }}</td>
                                              <td style="text-align:right;">
                                                {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                              </td>
                                              <td>

                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                        @endif
                    @endforeach
                    <tr style="border:2px solid black;border-top:1px;">
                        <td class="kh12-b" colspan=2>សរុប</td>
                        <td colspan=2 style="text-align:right;color:red;" class="kh12-b">{{ phpformatnumber(abs($total)).'USD'}}</td>
                        {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'USD'}}</td> --}}
                        {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'USD'}}</td> --}}
                    </tr>
                    {{--  THB --}}
                    @php
                        $total=0;
                        $amount=0;
                        $i=0;
                    @endphp
                    <tr style="border:2px solid black;border-bottom:1px;">
                      <td colspan=5 class="kh12-b">បាត/THB</td>
                    </tr>
                    @if($weopen_oldlist)
                      @foreach ($weopen_oldlist->where('cur','THB') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->tranname??'លុយសល់' }}</td>
                              <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'B'  }}</td>
                              <td style="text-align:center;">{{ $l->desr??'' }}</td>
                          </tr>
                      @endforeach
                    @endif
                    @foreach ($weopen_records->where('cur','THB') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                            <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                            <td>{{ $l->tt }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'B' }}</td>
                            <td class="kh10-b" style="text-align:center;">
                              @if($l->receive && strlen(trim($l->receive,' '))>0)
                                {{ $l->desr . '(' . $l->receive . ')' }}
                              @else
                                {{ $l->desr }}
                              @endif
                            </td>
                        </tr>
                        @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
                          @php
                              $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                          @endphp
                          <tr>
                              <td style="padding:0px;" colspan=5>
                                  <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:100%">
                                      <tbody>
                                        @foreach ($getdata[0] as $ex)
                                          <tr style="">
                                              <td>
                                                  {{ $ex->user->name . '('. $ex->tt . ')' }}
                                              </td>

                                              <td>ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                @if($l->trancode==1)
                                                  {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @else
                                                {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @endif
                                            </td>
                                            <td style="text-align:right;">
                                              {{ floatval($ex->drate) }}
                                            </td>

                                          </tr>
                                          @endforeach
                                          @foreach ($getdata[1] as $t)
                                          <tr style="">
                                              <td>
                                                  {{$t->user->name . '(' . $t->tt . ')' }}
                                              </td>

                                              <td>{{ $t->partner->name }}</td>
                                              <td style="text-align:right;">
                                                {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                              </td>
                                              <td>

                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                        @endif
                    @endforeach
                    <tr style="border:2px solid black;border-top:1px;">
                        <td class="kh12-b" colspan=2>សរុប</td>
                        <td colspan=2 style="text-align:right;color:red;" class="kh12-b">{{ phpformatnumber(abs($total)).'THB'}}</td>
                        {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'THB'}}</td> --}}
                        {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'THB'}}</td> --}}
                    </tr>
                    {{-- KHR --}}
                    @php
                        $total=0;
                        $amount=0;
                        $i=0;
                    @endphp
                    <tr style="border:2px solid black;border-bottom:1px;">
                      <td colspan=5 class="kh12-b">រៀល/KHR</td>
                    </tr>
                    @if($weopen_oldlist)
                      @foreach ($weopen_oldlist->where('cur','KHR') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->tranname??'លុយសល់' }}</td>
                              <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'R'  }}</td>
                              <td style="text-align:center;">{{ $l->desr??'' }}</td>
                          </tr>
                      @endforeach
                    @endif
                    @foreach ($weopen_records->where('cur','KHR') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                            <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                            <td>{{ $l->tt }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'R' }}</td>
                            <td class="kh10-b" style="text-align:center;">
                              @if($l->receive && strlen(trim($l->receive,' '))>0)
                                {{ $l->desr . '(' . $l->receive . ')' }}
                              @else
                                {{ $l->desr }}
                              @endif
                            </td>
                        </tr>
                        @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
                          @php
                              $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                          @endphp
                          <tr>
                              <td style="padding:0px;" colspan=5>
                                  <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:100%;">
                                      <tbody>
                                        @foreach ($getdata[0] as $ex)
                                          <tr style="">
                                              <td>
                                                  {{ $ex->user->name . '('. $ex->tt . ')' }}
                                              </td>

                                              <td>ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                @if($l->trancode==1)
                                                  {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @else
                                                {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @endif
                                              </td>
                                              <td style="text-align:right;">
                                                {{ floatval($ex->drate) }}
                                              </td>

                                          </tr>
                                          @endforeach
                                          @foreach ($getdata[1] as $t)
                                          <tr style="">
                                              <td>
                                                  {{$t->user->name . '(' . $t->tt . ')' }}
                                              </td>

                                              <td>{{ $t->partner->name }}</td>
                                              <td style="text-align:right;">
                                                {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                              </td>
                                              <td>

                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                        @endif
                    @endforeach
                    <tr style="border:2px solid black;border-top:1px;">
                        <td class="kh12-b" colspan=2>សរុប</td>
                        <td colspan=2 style="text-align:right;color:red;" class="kh12-b">{{ phpformatnumber(abs($total)).'KHR'}}</td>
                        {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'KHR'}}</td> --}}
                        {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'KHR'}}</td> --}}
                    </tr>
                    {{-- VND --}}
                    @php
                      $total=0;
                      $amount=0;
                      $i=0;
                    @endphp
                    <tr style="border:2px solid black;border-bottom:1px;">
                      <td colspan=5 class="kh12-b">ដុង/VND</td>
                    </tr>
                    @if($weopen_oldlist)
                      @foreach ($weopen_oldlist->where('cur','VND') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->tranname??'លុយសល់' }}</td>
                              <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'V'  }}</td>
                              <td style="text-align:center;">{{ $l->desr??'' }}</td>
                          </tr>
                      @endforeach
                    @endif
                    @foreach ($weopen_records->where('cur','VND') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                            <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                            <td>{{ $l->tt }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td style="text-align:right;color:red" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'V' }}</td>
                            <td class="kh10-b" style="text-align:center;">
                              @if($l->trancode==1 || $l->trancode==-1)
                                {{ $l->receive }}
                              @else
                                @if($l->receive && strlen(trim($l->receive,' '))>0)
                                  {{ $l->desr . '(' . $l->receive . ')' }}
                                @else
                                  {{ $l->desr }}
                                @endif
                              @endif
                            </td>
                        </tr>
                        @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))
                          @php
                              $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                          @endphp
                          <tr>
                              <td style="padding:0px;" colspan=5>
                                  <table id="tbl_group_id" class="table table-bordered" style="margin:0px;width:100%">
                                      <tbody>
                                        @foreach ($getdata[0] as $ex)
                                          <tr style="">
                                              <td>
                                                  {{ $ex->user->name . '('. $ex->tt . ')' }}
                                              </td>

                                              <td>ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                  @if($l->trancode==1)
                                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @else
                                                  {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @endif
                                              </td>
                                              <td style="text-align:right;">
                                                {{ floatval($ex->drate) }}
                                              </td>
                                          </tr>
                                          @endforeach
                                          @foreach ($getdata[1] as $t)
                                          <tr style="">
                                              <td>
                                                  {{$t->user->name . '(' . $t->tt . ')' }}
                                              </td>

                                              <td>{{ $t->partner->name }}</td>
                                              <td style="text-align:right;">
                                                {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                              </td>
                                              <td>

                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                        @endif
                    @endforeach
                    <tr style="border:2px solid black;border-top:1px;">
                        <td class="kh12-b" colspan=2>សរុប</td>
                        <td colspan=2 style="text-align:right;color:red;" class="kh12-b">{{ phpformatnumber(abs($total)).'VND'}}</td>
                        {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'VND'}}</td> --}}
                        {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'VND'}}</td> --}}
                    </tr>
                  </tbody>
              </table>
            </td>

            <td style="width:50%">
              <table id="tbl_they" class="table table-bordered kh16  tblwethey">
                <tr>
                  <td colspan=5 class="kh12-b" colspan=5 style="text-align:center;">បើកនៅ{{ $partnername }}</td>
                </tr>
                <tr>
                  <td style="text-align:center;">លរ</td>
                  <td style="text-align:center;">ម៉ោង</td>
                  <td style="text-align:center;">អ្នកកត់ត្រា</td>
                  <td style="text-align:center;">សរុបទឹកប្រាក់</td>
                  <td style="text-align:center;">ផ្សេងៗ</td>
                </tr>

                  <tbody id="bodytransfer">
                      @php
                          $total=0;
                          $amount=0;
                          $i=0;
                      @endphp
                      <tr style="border:2px solid black;border-bottom:1px;">
                        <td colspan=5 class="kh12-b">ដុល្លា/USD</td>
                      </tr>
                      @if($theyopen_oldlist)
                        @foreach ($theyopen_oldlist->where('cur','USD') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                <td style="text-align:center;">{{ $i }}</td>
                                <td>{{ $l->tt }}</td>
                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  '$'  }}</td>
                                <td style="text-align:center;">{{ $l->desr??'' }}</td>
                            </tr>
                        @endforeach
                      @endif
                      @foreach ($theyopen_records->where('cur','USD') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->recordby??'' }}</td>
                              <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) . '$' }}</td>
                              <td class="kh10-b" style="text-align:center;">
                                @if($l->receive && strlen(trim($l->receive,' '))>0)
                                  {{ $l->desr . '(' . $l->receive . ')' }}
                                @else
                                  {{ $l->desr }}
                                @endif
                              </td>
                          </tr>
                          @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))

                            @php
                                $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                            @endphp
                            <tr>
                                <td style="padding:0px;" colspan=5>
                                    <table id="tbl_group_id" class="table table-bordered" style="margin:0px;">
                                        <tbody>
                                          @foreach ($getdata[0] as $ex)
                                            <tr style="">
                                              <td class="kh8">
                                                  {{ $ex->user->name }}
                                              </td>

                                              <td class="kh8">ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                  @if($l->trancode==1)
                                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @else
                                                  {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @endif
                                              </td>
                                              <td style="text-align:right;">
                                                {{ floatval($ex->drate) }}
                                              </td>

                                            </tr>
                                            @endforeach
                                            @foreach ($getdata[1] as $t)
                                            <tr style="">
                                                <td class="kh8">
                                                    {{$t->user->name  }}
                                                </td>

                                                <td class="kh8"> {{ $t->partner->name }}</td>
                                                <td class="kh8" style="text-align:right;">
                                                  {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                          @endif
                      @endforeach
                      <tr style="border:2px solid black;border-top:1px;">
                          <td class="kh12-b" colspan=2>សរុប</td>
                          <td colspan=2 style="text-align:right;color:blue;" class="kh12-b">{{ phpformatnumber(abs($total)).'USD'}}</td>
                          {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'USD'}}</td> --}}
                          {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'USD'}}</td> --}}
                      </tr>
                    {{--  THB --}}
                      @php
                          $total=0;
                          $amount=0;
                          $i=0;
                      @endphp
                      <tr style="border:2px solid black;border-bottom:1px;">
                        <td colspan=5 class="kh12-b">បាត/THB</td>
                      </tr>
                      @if($theyopen_oldlist)
                        @foreach ($theyopen_oldlist->where('cur','THB') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                <td style="text-align:center;">{{ $i }}</td>
                                <td>{{ $l->tt }}</td>
                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'B'  }}</td>
                                <td style="text-align:center;">{{ $l->desr??'' }}</td>
                            </tr>
                        @endforeach
                      @endif
                      @foreach ($theyopen_records->where('cur','THB') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->recordby??'' }}</td>
                              <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'B' }}</td>
                              <td class="kh10-b" style="text-align:center;">
                                @if($l->receive && strlen(trim($l->receive,' '))>0)
                                  {{ $l->desr . '(' . $l->receive . ')' }}
                                @else
                                  {{ $l->desr }}
                                @endif
                              </td>
                          </tr>
                          @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))

                            @php
                                $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                            @endphp
                            <tr>
                                <td style="padding:0px;" colspan=5>
                                    <table id="tbl_group_id" class="table table-bordered" style="margin:0px;">
                                        <tbody>
                                          @foreach ($getdata[0] as $ex)
                                            <tr style="">
                                                <td class="kh8">
                                                    {{ $ex->user->name }}
                                                </td>

                                                <td class="kh8">ប្តូរប្រាក់</td>
                                                <td style="text-align:right;">
                                                  @if($l->trancode==1)
                                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @else
                                                  {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @endif
                                              </td>
                                              <td style="text-align:right;">
                                                {{ floatval($ex->drate) }}
                                              </td>

                                            </tr>
                                            @endforeach
                                            @foreach ($getdata[1] as $t)
                                            <tr style="">
                                                <td class="kh8">
                                                    {{$t->user->name  }}
                                                </td>

                                                <td class="kh8"> {{ $t->partner->name }}</td>
                                                <td class="kh8" style="text-align:right;">
                                                  {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                          @endif
                      @endforeach
                      <tr style="border:2px solid black;border-top:1px;">
                          <td class="kh12-b" colspan=2>សរុប</td>
                          <td colspan=2 style="text-align:right;color:blue;" class="kh12-b">{{ phpformatnumber(abs($total)).'THB'}}</td>
                          {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'THB'}}</td> --}}
                          {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'THB'}}</td> --}}
                      </tr>
                    {{-- KHR --}}
                      @php
                          $total=0;
                          $amount=0;
                          $i=0;
                      @endphp
                    <tr style="border:2px solid black;border-bottom:1px;">
                      <td colspan=5 class="kh12-b">រៀល/KHR</td>
                    </tr>
                    @if($theyopen_oldlist)
                      @foreach ($theyopen_oldlist->where('cur','KHR') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->tranname??'លុយសល់' }}</td>
                              <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'R'  }}</td>
                              <td style="text-align:center;">{{ $l->desr??'' }}</td>
                          </tr>
                      @endforeach
                    @endif
                    @foreach ($theyopen_records->where('cur','KHR') as $l)
                        @php
                            $total+=$l->total;
                            $amount+=$l->amount;
                            ++$i;
                        @endphp
                        <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                            <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                            <td>{{ $l->tt }}</td>
                            <td>{{ $l->recordby??'' }}</td>
                            <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'R' }}</td>
                            <td class="kh10-b" style="text-align:center;">
                              @if($l->receive && strlen(trim($l->receive,' '))>0)
                                {{ $l->desr . '(' . $l->receive . ')' }}
                              @else
                                {{ $l->desr }}
                              @endif
                            </td>
                        </tr>
                        @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))

                          @php
                              $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                          @endphp
                          <tr>
                              <td style="padding:0px;" colspan=5>
                                  <table id="tbl_group_id" class="table table-bordered" style="margin:0px;">
                                      <tbody>
                                        @foreach ($getdata[0] as $ex)
                                          <tr style="">
                                              <td class="kh8">
                                                  {{ $ex->user->name }}
                                              </td>

                                              <td class="kh8">ប្តូរប្រាក់</td>
                                              <td style="text-align:right;">
                                                @if($l->trancode==1)
                                                  {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @else
                                                {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                @endif
                                            </td>
                                            <td style="text-align:right;">
                                              {{ floatval($ex->drate) }}
                                            </td>

                                          </tr>
                                          @endforeach
                                          @foreach ($getdata[1] as $t)
                                          <tr style="">
                                              <td class="kh8">
                                                  {{$t->user->name  }}
                                              </td>

                                              <td class="kh8"> {{ $t->partner->name }}</td>
                                              <td class="kh8" style="text-align:right;">
                                                {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                              </td>
                                              <td>

                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </td>

                          </tr>
                        @endif
                    @endforeach
                    <tr style="border:2px solid black;border-top:1px;">
                        <td class="kh12-b" colspan=2>សរុប</td>
                        <td colspan=2 style="text-align:right;color:blue;" class="kh12-b">{{ phpformatnumber(abs($total)).'KHR'}}</td>
                        {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'KHR'}}</td> --}}
                        {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'KHR'}}</td> --}}
                    </tr>
                    {{-- VND --}}
                      @php
                          $total=0;
                          $amount=0;
                          $i=0;
                      @endphp
                      <tr style="border:2px solid black;border-bottom:1px;">
                        <td colspan=5 class="kh12-b">ដុង/VND</td>
                      </tr>
                      @if($theyopen_oldlist)
                        @foreach ($theyopen_oldlist->where('cur','VND') as $l)
                            @php
                                $total+=$l->total;
                                $amount+=$l->amount;
                                ++$i;
                            @endphp
                            <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                                <td style="text-align:center;">{{ $i }}</td>
                                <td>{{ $l->tt }}</td>
                                <td>{{ $l->tranname??'លុយសល់' }}</td>
                                <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) .  'V'  }}</td>
                                <td style="text-align:center;">{{ $l->desr??'' }}</td>
                            </tr>
                        @endforeach
                      @endif
                      @foreach ($theyopen_records->where('cur','VND') as $l)
                          @php
                              $total+=$l->total;
                              $amount+=$l->amount;
                              ++$i;
                          @endphp
                          <tr style="border:1px solid black;border-left:2px solid black;border-right:2px solid black;">
                              <td style="text-align:center;border-left:2px solid black;">{{ $i }}</td>
                              <td>{{ $l->tt }}</td>
                              <td>{{ $l->recordby??'' }}</td>
                              <td style="text-align:right;color:blue" class="kh12-b">{{ phpformatnumber(abs($l->total)) . 'V' }}</td>
                              <td class="kh10-b" style="text-align:center;">
                                  @if($l->receive && strlen(trim($l->receive,' '))>0)
                                    {{ $l->desr . '(' . $l->receive . ')' }}
                                  @else
                                    {{ $l->desr }}
                                  @endif
                              </td>
                          </tr>
                          @if($l->ref_group_id  && ($l->trancode==1 || $l->trancode==-1) && (is_null($l->pointname) || $l->pointname==''))

                            @php
                                $getdata=App\PartnerTransfer::showbyrefgroupid($l->idtransfer,$l->ref_group_id);
                            @endphp
                            <tr>
                                <td style="padding:0px;" colspan=5>
                                    <table id="tbl_group_id" class="table table-bordered" style="margin:0px;">
                                        <tbody>
                                          @foreach ($getdata[0] as $ex)
                                            <tr style="">
                                                <td class="kh8">
                                                    {{ $ex->user->name }}
                                                </td>

                                                <td class="kh8">ប្តូរប្រាក់</td>
                                                <td style="text-align:right;">
                                                  @if($l->trancode==1)
                                                    {{ $ex->amount>0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @else
                                                  {{ $ex->amount<0? phpformatnumber($ex->amount).' $' : phpformatnumber($ex->product) . ' ' . $ex->currency->sk  }}
                                                  @endif
                                              </td>
                                              <td style="text-align:right;">
                                                {{ floatval($ex->drate) }}
                                              </td>

                                            </tr>
                                            @endforeach
                                            @foreach ($getdata[1] as $t)
                                            <tr style="">
                                                <td class="kh8">
                                                    {{$t->user->name  }}
                                                </td>

                                                <td class="kh8"> {{ $t->partner->name }}</td>
                                                <td class="kh8" style="text-align:right;">
                                                  {{ phpformatnumber($t->amount) . ' ' . $t->currency->sk  }}
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                          @endif
                      @endforeach
                      <tr style="border:2px solid black;border-top:1px;">
                          <td class="kh12-b" colspan=2>សរុប</td>
                          <td colspan=2 style="text-align:right;color:blue;" class="kh12-b">{{ phpformatnumber(abs($total)).'VND'}}</td>
                          {{-- <td  class="kh18-b" style="text-align:right;color:balck;">{{ phpformatnumber($amount) .'VND'}}</td> --}}
                          {{-- <td class="kh18-b" style="text-align:right;color:black;">{{ phpformatnumber($total-$amount) .'VND'}}</td> --}}
                      </tr>
                  </tbody>
              </table>
            </td>
          </tr>
       </table>

      </div>






      <div class="row">
        <table class="table">
            <tr>
              <td style="width:50%;border-style:none;">

                  <div class="card" style="border-bottom:none;border-top:none;">
                    <div class="card-title" style="">
                        <h1 class="kh16-b" style="text-align:center;padding:0px;background-color:aquamarine">មុនទូទាត់</h1>
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
                      <div class="card-title">
                          <h1 class="kh16-b" style="text-align:center;">ក្រោយទូទាត់</h1>
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
