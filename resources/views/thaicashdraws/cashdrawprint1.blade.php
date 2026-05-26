<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashdraw Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
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
        .tblcashdraw td{
          padding:0px;
          border-style:none;
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
                        <td class="kh16-b" style="width:100%;text-align:center;padding:0px;text-decoration:underline;">{{ $invtitle }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table id="tbl_header" class="table" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;">លេខប័ណ្ណ.</td>
                        <td class="kh12-b" style="width:30%;padding:0px;">{{ sprintf("%04d",$transfer->id) }}</td>
                        <td class="kh12-b" style="width:20%;padding:0px;">ចេញដោយ</td>
                        <td class="kh12-b" colspan=3 style="width:30%;padding:0px;text-align:right;">{{ $transfer->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;border-bottom:1px solid black;border-style:dashed;">ថ្ងៃទី</td>
                        <td class="kh12-b" style="width:30%;padding:0px;border-bottom:1px solid black;border-style:dashed;">{{ date('d-m-Y',strtotime($transfer->opdate))}}</td>
                        <td class="kh12-b" style="width:20%;padding:0px;border-bottom:1px solid black;border-style:dashed;">ម៉ោង</td>
                        <td class="kh12-b" style="width:30%;padding:0px;text-align:right;border-bottom:1px solid black;border-style:dashed;">{{ $transfer->optime }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:-10px;">
            @if($transfers->count()>0)
              @foreach ($transfers as $transfer)
                <div class="table-responsive">
                  <table id="" class="table tblcashdraw" style="">
                      <tbody>
                          <tr>
                            <td class="kh12-b" style="width:25%">ទទួលពី</td>
                            <td class="kh14-b" style="width:75%;text-align:right;">{{ $transfer->thaisms->sendfrom  . '(' . $transfer->thaisms->accno . ')'}}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">ចំនួនទឹកប្រាក់</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ phpformatnumber($transfer->thaisms->amount) . ' ' . $transfer->currency->shortcut }}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">កាត់សេវ៉ា</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ phpformatnumber($transfer->thaisms->cutseva) . ' ' . $transfer->currency->shortcut }}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">លុយត្រូវបើក</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">

                                      {{ phpformatnumber($transfer->thaisms->amount-$transfer->thaisms->cutseva). ' ' . $transfer->currency->shortcut }}

                              </td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">អ្នកទទួល</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ $transfer->rectel }} @if($transfer->recname) <br> {{ $transfer->recname }} @endif</td>
                          </tr>
                      </tbody>
                  </table>
                </div>
              @endforeach
            @else
                <div class="table-responsive">
                  <table id="" class="table tblcashdraw" style="">
                      <tbody>
                          <tr>
                            <td class="kh12-b" style="width:25%">ទទួលពី</td>
                            <td class="kh14-b" style="width:75%;text-align:right;">{{ $transfer->thaisms->sendfrom . '(' . $transfer->thaisms->accno . ')'  }}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">ចំនួនទឹកប្រាក់</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ phpformatnumber($transfer->thaisms->amount) . ' ' . $transfer->currency->shortcut  }}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">កាត់សេវ៉ា</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ phpformatnumber($transfer->thaisms->cutseva) . ' ' . $transfer->currency->shortcut }}</td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">លុយត្រូវបើក</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">
                                {{ phpformatnumber($transfer->thaisms->amount-$transfer->thaisms->cutseva) . ' ' . $transfer->currency->shortcut }}
                              </td>
                          </tr>
                          <tr>
                              <td class="kh12-b" style="width:25%">អ្នកទទួល</td>
                              <td class="kh14-b" style="width:75%;text-align:right;">{{ $transfer->rectel }} @if($transfer->recname) <br> {{ $transfer->recname }} @endif</td>
                          </tr>
                      </tbody>
                  </table>
                </div>
            @endif
            <div class="row" style="margin-left:0px;">
                @if($exchanges->count()>0)
                    @php
                        $addseva='';
                        $leftamt=floatval($transfer->thaisms->amount)-floatval($transfer->thaisms->cutseva);
                    @endphp
                    <table id="tbl_exchange" class="table" style="margin:0px;">
                       <tr>
                          <td class="kh22-b" colspan=4 style="text-align:center;text-decoration:underline;">ប្តូរប្រាក់</td>
                       </tr>
                       @foreach ($totalcashdrawamount as $tt)
                          <tr>
                            <td style=""></td>
                            <td colspan=2 class="kh12-b" style="text-align:right;">បើកវេរ</td>
                            <td class="kh14-b" style="text-align:right">- {{ phpformatnumber($tt->tamt) . ' ' . $tt->currency->shortcut }}</td>
                          </tr>

                       @endforeach

                      {{-- @foreach ($totalcashdraw_cuscharge as $tc)
                        @if($tc->tcuscharge<>0)
                          <tr>
                            <td style=""></td>
                            <td colspan=2 class="kh12-b" style="text-align:right;">កាត់សេវ៉ា</td>
                            <td class="kh14-b" style="text-align:right">+ {{ phpformatnumber($tc->tcuscharge) . ' ' . $tc->cuschargecur->shortcut }}</td>
                          </tr>
                        @endif
                      @endforeach --}}

                          @foreach ($exchanges as $e)
                              @php
                                  if($e->sale>$e->buy){
                                      $exrate='  /  '.phpformatnumber($e->rate);

                                  }else{
                                    $exrate='  *  '.phpformatnumber($e->rate);

                                  }
                                  $leftamt -=floatval($e->buy);
                              @endphp

                              <tr>
                                  <td class="kh14-b" style="text-align:right;">
                                      - {{phpformatnumber($e->sale) . ' ' . $e->cursale }}
                                  </td>
                                  <td class="kh14-b" style="text-align:center;">
                                   {{ $exrate }}
                                  </td>
                                  <td class="kh14-b" style="text-align:right;">=</td>
                                  <td class="kh14-b" style="text-align:right;">
                                   + {{ phpformatnumber($e->buy) .' '. $e->curbuy }}
                                  </td>
                              </tr>
                          @endforeach
                          @if($leftamt>0)
                            <tr>
                              <td class="kh14-b" style="text-align:right">+ {{ phpformatnumber($leftamt) . ' ' . $transfer->currency->shortcut }}</td>
                              <td></td>
                              <td></td>
                              <td class="kh14-b" style="text-align:right;">- {{ phpformatnumber($leftamt) . ' ' . $transfer->currency->shortcut }}</td>
                            </tr>
                          @endif
                          <tr>
                            <td class="kh14-b" style="text-align:right;">{{ $addseva }}</td>
                            <td></td>
                            <td></td>
                            <td class="kh14-b" style="text-align:right;border-top:solid">0</td>
                          </tr>

                    </table>
                @endif

            </div>
            <div class="row" style="margin-left:0px;">
                @if($cashin->count()>0)
                    <table>
                        <tr>
                            <td colspan=2 class="kh16-b" style="text-align:center;">​ទឹកប្រាក់ត្រូវប្រគល់អោយអតិថិជន</td>
                        </tr>
                        @foreach ($cashin as $sc)
                           <tr>
                                <td colspan=2 class="kh16-b" style="text-align:right;">{{ phpformatnumber($sc['value']) . ' ' . $sc['cur'] }}</td>
                           </tr>
                        @endforeach
                        @if($bankpayments!=null)
                            @foreach ($bankpayments as $bp)
                                <tr>
                                    <td class="kh12-b" style=""> {{ $bp->partner->name }}</td>
                                    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber(abs($bp->amount)) . ' ' . $bp->currency->shortcut }}</td>
                                </tr>
                            @endforeach
                        @endif
                        @foreach ($cash as $c)
                            <tr>
                                <td class="kh12-b" style="">CASH</td>
                                <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($c['value']) . ' ' . $c['cur'] }}</td>
                            </tr>
                        @endforeach

                    </table>
                @endif

            </div>
            <hr>
            <div class="legalcopy" style="margin-top:-30px;">
                <p class=""legal>
                    <p style="font-family:Noto Sans Khmer,sans-serif;font-size:12px;text-align:center;color:black;border:1px solid black;border-style:dashed;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
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
