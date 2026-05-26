<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserCloseList</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">
     @page
		  {
        size: A4 landscape;
		  	margin: 5mm;
		   }
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
    .blue{
      color:blue;
    }
    .red{
      color:red;
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
        .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
            .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;

            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
            .kh32{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:32px;

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
        <div class="row" style="margin:5px;">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="padding:0px;border-style:none;">
                            <h1 class="kh32">របាយការណ៏បុគ្គលិក {{ $title['user'] }}</h1>
                        </td>
                        <td style="padding:0px;border-style:none;text-align:right;">
                            <h1>{{ $title['date'] }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin:-15px 5px 0px 5px;">
          <div class="table-responsive">
              <table class="table table-bordered kh16 tbl_usertransaction">
                  <thead style="text-align:center;">
                      <th>No</th>
                      <th>Time</th>
                      <th>Description</th>
                      <th>GOLD</th>
                      <th>USD</th>
                      <th>THB</th>
                      <th>KHR</th>
                      <th>VND</th>
                      <th>FN</th>

                      {{-- <th>គេខ្វះ</th>
                      <th>ខ្វះគេ</th>
                      <th>ធនាគា</th> --}}
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
                      @endphp
                      @foreach ($usertransactions as $key => $ut)
                          <tr>
                              @php
                                  $usd+=$ut->usd;
                                  $gold+=$ut->gold;
                                  $khr+=$ut->khr;
                                  $thb+=$ut->thb;
                                  $vnd+=$ut->vnd;
                                  $theylack+=$ut->theylack;
                                  $welack+=$ut->welack;
                                  $bank+=$ut->paybybank;
                                  $sumusd+=$ut->usd+$ut->theylack+$ut->welack+$ut->paybybank;
                              @endphp
                              <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                              <td class="kh16" style="text-align:center;">{{ $ut->tt }}</td>
                              <td class="kh16">{{ $ut->tranname }}{{ $ut->desr==''?'':' ['.trim($ut->desr).']' }}</td>
                              <td class="amt @if($ut->gold>=0) blue @else red @endif">@if($ut->gold<>0) {{ phpformatnumber($ut->gold) . 'G' }} @endif </td>
                              <td class="amt @if($ut->usd>=0) blue @else red @endif">@if($ut->usd<>0){{ phpformatnumber($ut->usd) . '$' }} @endif</td>
                              <td class="amt @if($ut->thb>=0) blue @else red @endif">@if($ut->thb<>0) {{ phpformatnumber($ut->thb) . 'B' }} @endif</td>
                              <td class="amt @if($ut->khr>=0) blue @else red @endif">@if($ut->khr<>0){{ phpformatnumber($ut->khr) . 'R' }} @endif</td>
                              <td class="amt @if($ut->vnd>=0) blue @else red @endif">@if($ut->vnd<>0){{ phpformatnumber($ut->vnd) . 'V' }}@endif</td>
                              <td class="amt @if($ut->vnd>=0) blue @else red @endif">
                                @if($ut->fn<>'0')
                                  {{ phpformatnumber($ut->fn) . $ut->shortcut }}
                                @else

                                @endif

                            </td>

                              {{-- <td class="amt">{{ phpformatnumber($ut->theylack) . '$' }}</td>
                              <td class="amt">{{ phpformatnumber($ut->welack) . '$' }}</td>
                              <td class="amt">{{ phpformatnumber($ut->paybybank) . '$' }}</td> --}}

                          </tr>
                      @endforeach
                      <tr style="background-color:aqua">
                          <td colspan=3 style="font-size:22px;font-weight:bold;">Total</td>
                          {{-- <td class="total" style="text-align:left;">{{ phpformatnumber($sumusd) . 'USD' }}</td> --}}
                          <td class="total">{{ phpformatnumber($gold) . 'G' }}</td>
                          <td class="total">{{ phpformatnumber($usd) . '$'}}</td>
                          <td class="total">{{ phpformatnumber($thb) . 'B' }}</td>
                          <td class="total">{{ phpformatnumber($khr) . 'R'}}</td>
                          <td class="total">{{ phpformatnumber($vnd) . 'V'}}</td>
                          <td class="total">0</td>
                          {{-- <td class="total">{{ phpformatnumber($theylack) . '$'}}</td>
                          <td class="total">{{ phpformatnumber($welack) . '$'}}</td>
                          <td class="total">{{ phpformatnumber($bank) . '$'}}</td> --}}
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
        <div class="row" style="margin:5px;">
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
