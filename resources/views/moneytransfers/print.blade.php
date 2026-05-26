<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
     @page {
        margin:2mm !important;
        margin-right:0mm !important;
    }
    @media print {
        html, body {
            width: 80mm;
        }
    }
    #invoice-pos{
        box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
        padding:0mm;
        margin:0 auto;
        width:80mm;
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
        .kh10{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh28{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:28px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        #tbl_body td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
        }
        #tbl_header td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
        }
        #tbl_cashin td{
            padding:0px;
            border-style:none;
        }
        #tbl_cashin th{
            padding:0px;
            border-style:none;
        }
        #tbl_cashout td{
            padding:0px;
            border-style:none;
        }
        #tbl_cashout th{
            padding:0px;
            border-style:none;
        }
        #tbl_exchange td{
          padding:2px;
          border-style:none;
        }

        #tbl_exchange th{
          padding:2px;
          border-style:none;
        }
        #tbl_exchange tr{
          border-style:none;
        }
        td{
            color:black;
        }
</style>
@php

    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        // $fp=substr($num,$p,strlen($num)-$p);
        // $dc=strlen((float)$fp)-2;
            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
@endphp
<body>
    <div id="invoice-pos">
        {{-- <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:32px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:22px;padding:0px;">{{ $logo->name }}</td>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:32px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0%;text-align:center;"></td>
                        <td style="width:0%;text-align:center;"></td>
                    </tr>

                </table>
            </div>
        </div> --}}
        {{-- <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:100%;text-align:center;font-family:khmer os muol light;font-size:12px;padding:0px;">{{ $logo->subname }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="kh14-b" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh14-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->tel }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="kh14-b" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh14-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->address }}</td>
                    </tr>
                </table>
            </div>
        </div> --}}
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">វិក្កយបត្រ</td>
                    </tr>
                    <tr>
                      <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->subname }}</td>
                    </tr>
                    <tr>
                      <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->tel }}</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table id="tbl_header" class="table" style="width:100%;overflow:hidden">
                  <tr>
                    <td class="kh12-b" style="width:50%;padding:0px;">អ្នកប្រើ : {{ $transfer->user->name }}</td>
                    <td class="kh12-b" style="width:50%;padding:0px;text-align:right;">វិក្កយបត្រ : {{ sprintf("%04d",$transfer->id) }}</td>
                  </tr>
                  <tr>
                    <?php
                      $date=date_create($transfer->dd);
                      $date1=date_create($transfer->dd);
                      date_add($date1,date_interval_create_from_date_string("7 days"));
                      //echo date_format($date,"Y-m-d");
                    ?>
                    <td style="width:50%;padding:0px 0px 5px 0px;border-bottom:1px solid;"><span class="kh12-b">ថ្ងៃវេរ :</span> <span class="kh12-b">{{ date_format($date,"d/m/Y")}} {{ substr($transfer->tt,0,5)}}</span> </td>
                    <td class="kh12-b" style="width:50%;padding:0px 0px 5px 0px;text-align:right;border-bottom:1px solid;">ថ្ងៃផុត : {{ date_format($date1,"d/m/Y") }}</td>
                  </tr>

                    {{-- <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;">លេខវិ.</td>
                        @if($transfer->customer_id)
                            <td class="kh12-b" style="width:30%;padding:0px;">{{ sprintf("%04d",$transfer->id) }}</td>
                            <td class="kh12-b" colspan=2 style="width:50%;padding:0px;">អតិថិជន: {{ $transfer->customer->name }}</td>
                        @else
                            <td class="kh12-b" style="width:80%;padding:0px;">{{ sprintf("%04d",$transfer->id) }}</td>
                        @endif

                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;">ថ្ងៃទី</td>
                        <td class="kh12-b" style="width:30%;padding:0px;">{{ date('d-m-Y',strtotime($transfer->dd))}}</td>
                        <td class="kh12-b" style="width:20%;padding:0px;">ម៉ោង</td>
                        <td class="kh12-b" style="width:30%;padding:0px;">{{ $transfer->tt }}</td>
                    </tr> --}}

                </table>
            </div>
        </div>
        @php
             $leftamt=0;
             $addseva='';
        @endphp
        <div class="row" style="margin-top:-10px;">
          <div class="table-responsive">
            <table id="tbl_body" class="table" style="">
                <tbody>
                  @foreach ($transfers as $transfer)
                    {{-- <tr>
                      <td class="kh12-b" style="width:20%;">វេរទៅ</td>
                      <td class="kh12-b" style="width:5%;">:</td>
                      <td class="kh12-b" style="width:75%;">{{ $transfer->partner->name }}</td>
                    </tr> --}}
                    <tr>
                      <td class="kh12-b" style="width:20%">អ្នកផ្ញើ</td>
                      <td class="kh12-b" style="width:5%;">:</td>
                      <td class="kh12-b" style="width:75%;">{{ $transfer->sendertel }} @if($transfer->sendername) <br> {{ $transfer->sendername }} @endif</td>
                  </tr>
                  <tr>
                      <td class="kh12-b" style="width:20%">អ្នកទទួល</td>
                      <td class="kh12-b" style="width:5%;">:</td>
                      <td class="kh12-b" style="width:75%;">{{ $transfer->rectel }} @if($transfer->recname) <br> {{ $transfer->recname }} @endif</td>
                  </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%">វេរចំនួន</td>
                        <td class="kh12-b" style="width:5%;">:</td>
                        <td class="kh12-b" style="width:75%;">{{ phpformatnumber($transfer->amount) . $transfer->currency->sk }}</td>
                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%">បូកសេវ៉ា</td>
                        <td class="kh12-b" style="width:5%;">:</td>
                        <td class="kh12-b" style="width:75%;">{{ phpformatnumber($transfer->cuscharge) . $transfer->cuschargecur->sk }}</td>
                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%">សរុប</td>
                        <td class="kh12-b" style="width:5%;">:</td>
                        <td class="kh12-b" style="width:75%;">
                            @if($transfer->currency_id==$transfer->cuscharge_currency_id)
                                {{ phpformatnumber($transfer->cuscharge+$transfer->amount) . $transfer->currency->sk }}
                            @else
                                {{ phpformatnumber($transfer->amount) . $transfer->currency->sk }}
                            @endif
                        </td>
                    </tr>

                    {{-- <tr>
                        <td class="kh12-b" colspan=3 style="text-align:center;">ទីតាំងបើកប្រាក់</td>
                    </tr> --}}
                    <tr>
                      <td colspan=3>&nbsp;</td>

                    </tr>
                    <tr>
                        @if($transfer->child_id)
                            <td class="kh12-b" colspan=3 style="text-align:center;border:1px dotted;">{{ $transfer->customerchildren->openaddress }}</td>
                        @else
                            <td class="kh12-b" colspan=3 style="text-align:center;border:1px dotted">{{ $transfer->partner->openaddress }}</td>
                        @endif
                    </tr>
                    @php


                    if($transfer->currency_id==$transfer->cuscharge_currency_id){
                      $leftamt +=floatval($transfer->amount)+floatval($transfer->cuscharge);
                    }else{
                      $leftamt +=floatval($transfer->amount);
                      $addseva .='+ ' . $transfer->cuscharge . ' ' . $transfer->cuschargecur->sk;
                    }

                @endphp
                  @endforeach
                </tbody>
            </table>
          </div>

            <div class="row" style="margin-left:0px;">
                @if($exchanges->count()>0)

                    <table id="tbl_exchange" class="table" style="margin:0px;">
                       <tr>
                          <td class="kh16-b" colspan=4 style="text-align:center;text-decoration:underline;">ប្តូរប្រាក់</td>
                       </tr>
                       @foreach ($totaltransferamount as $totalvey)
                        <tr>
                            <td style=""></td>
                            <td colspan=2 class="kh14-b" style="text-align:right;">វេរ</td>
                            <td class="kh14-b" style="text-align:right">+ {{ phpformatnumber($totalvey->tamt) . ' ' . $totalvey->currency->sk }}</td>
                        </tr>
                       @endforeach
                       @foreach ($totaltransfercuscharge as $totalseva)
                        @if($totalseva->tcuscharge<>0)
                        <tr>
                            <td style=""></td>
                            <td colspan=2 class="kh14-b" style="text-align:right;">សេវ៉ា</td>
                            <td class="kh14-b" style="text-align:right">+ {{ phpformatnumber($totalseva->tcuscharge) . ' ' . $totalseva->cuschargecur->sk }}</td>
                        </tr>
                        @endif

                       @endforeach
                        {{-- <tbody> --}}
                          @foreach ($exchanges as $e)
                              @php
                                  if($e->buy>$e->sale){
                                      $exrate='  /  '.phpformatnumber($e->rate);
                                      // $extext=phpformatnumber($e->buy) . ' ' . $e->curbuy . ' / ' . phpformatnumber($e->rate) . ' = '  . phpformatnumber($e->sale) .' '. $e->cursale;
                                  }else{
                                    $exrate='  *  '.phpformatnumber($e->rate);
                                      //$extext=phpformatnumber($e->buy) .' ' . $e->curbuy . ' * ' . phpformatnumber($e->rate) . ' = '  . phpformatnumber($e->sale) .' '. $e->cursale;
                                  }
                                  $leftamt -=floatval($e->sale);
                              @endphp

                              <tr>
                                  <td class="kh14-b" style="text-align:right;">
                                      + {{phpformatnumber($e->buy) . ' ' . App\partnerTransfer::doshortcut($e->curbuy) }}
                                  </td>
                                  <td class="kh14-b" style="text-align:center;">
                                   {{ $exrate }}
                                  </td>
                                  <td class="kh14-b" style="text-align:right;">=</td>
                                  <td class="kh14-b" style="text-align:right;">
                                   - {{ phpformatnumber($e->sale) .' '. App\partnerTransfer::doshortcut($e->cursale) }}
                                  </td>
                              </tr>
                          @endforeach
                          @if($leftamt>0)
                            <tr>
                              <td class="kh14-b" style="text-align:right">+ {{ phpformatnumber($leftamt) . ' ' . $transfer->currency->sk }}</td>
                              <td></td>
                              <td></td>
                              <td class="kh14-b" style="text-align:right;">- {{ phpformatnumber($leftamt) . ' ' . $transfer->currency->sk }}</td>
                            </tr>

                          @endif
                          <tr>
                            <td class="kh14-b" style="text-align:right;">{{ $addseva }}</td>
                            <td></td>
                            <td></td>
                            <td class="kh14-b" style="text-align:right;border-top:solid">0</td>
                          </tr>
                        {{-- </tbody> --}}
                    </table>
                @endif

            </div>
            <div class="row" style="margin-left:0px;">
                @if($cashin->count()>0)
                    <table>
                        <tr>
                            <td colspan=2 class="kh14-b" style="text-align:center;">@if($transfer->trancode==-1)​ទឹកប្រាក់ត្រូវប្រគល់អោយអតិថិជន  @else ទឹកប្រាក់ត្រូវទទួលពីអតិថិជន @endif</td>
                        </tr>
                        {{-- @foreach ($cashin as $sc)
                           <tr>
                                <td colspan=2 class="kh22-b" style="text-align:right;">{{ phpformatnumber($sc['value']) . ' ' . App\partnerTransfer::doshortcut($sc['cur']) }}</td>
                           </tr>
                        @endforeach --}}
                        @if($bankpayments!=null)
                            @foreach ($bankpayments as $bp)
                                <tr>
                                    <td class="kh12-b" style=""> {{ $bp->partner->name }}</td>

                                    <td class="kh14-b" style="text-align:right;">{{ $bp->trancode==-3?phpformatnumber(abs($bp->amount+$bp->fee)). $bp->currency->sk:phpformatnumber(abs($bp->amount)) . $bp->currency->sk }}</td>
                                </tr>
                            @endforeach
                        @endif
                        @foreach ($cash as $c)
                            <tr>
                                <td class="kh12-b" style="">CASH</td>
                                <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($c['value']) . ' ' . App\partnerTransfer::doshortcut($c['cur']) }}</td>
                            </tr>
                        @endforeach

                    </table>
                @endif

            </div>
            <hr>
            <div class="legalcopy" style="margin-top:-30px;">
                <p class=""legal>
                    <p style="font-family:Noto Sans Khmer,sans-serif;font-size:12px;text-align:center;color:black;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
                        ** Thank you for your visiting **
                    </p>

                </p>
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
