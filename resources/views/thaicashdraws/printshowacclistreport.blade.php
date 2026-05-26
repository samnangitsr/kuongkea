<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thai Account Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">
     @page{size: A4 landscape;margin:0px;}
    @media print {
        @page { margin-top: -40px; }
        body { margin: 3mm;}

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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
        #tblacclist td{
            padding:3px;
            border:1px solid black;
        }
        #tblacclist th{
            padding:3px;
            border:1px solid black;
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
    $balance=0;
    $cashin=0;
    $cashout=0;
@endphp
<body>
    <div id="a4report">
        <div class="row" style="">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="padding:0px;border-style:none;">
                            <h1 style="font-family:'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">{{ $rpttitle }}</h1>
                        </td>
                        <td style="padding:0px;border-style:none;text-align:right;">
                            <h1 style="font-family:'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">{{ $dd }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if($startbal<>0)
        @php
            $balance+=$startbal;
        @endphp
        <tr style="">
            <td style="text-align:center;"></td>

            <td>{{ date('d-m-Y',strtotime($closedate)) }}</td>
            <td>{{ $closetime }}</td>
            <td style="border-right:1px solid black;">លុយចាប់ផ្តើមបញ្ជី</td>
            <td style="text-align:right;border:1px solid black;@if($startbal>0) color:blue; @else color:red; @endif">{{$startbal>0?'+' . phpformatnumber($startbal): phpformatnumber($startbal) }} B</td>
            <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance) . ' B'}}</td>
            <td></td>
        </tr>
@endif
        <table id="tblacclist" class="table table-bordered table-hover kh12-b">
            <thead style="text-align:center;">
                <th>No</th>

                <th>Date</th>
                <th>Time</th>
                <th>Transaction</th>
                <th>Amount</th>
                <th>Balance</th>
                <th>SMS</th>
                <th>អតិថិជន</th>

            </thead>
            <tbody id="bodyacclist">
                @if($oldlist<>0)
                        @php
                            $balance+=$oldlist;
                        @endphp
                        <tr style="">
                            <td style="text-align:center;"></td>

                            <td></td>
                            <td></td>
                            <td style="border-right:1px solid black;">បញ្ជីចាស់</td>
                            <td style="text-align:right;border:1px solid black;@if($oldlist>0) color:blue; @else color:red; @endif">{{$oldlist>0?'+' . phpformatnumber($oldlist): phpformatnumber($oldlist) }} B</td>
                            <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance) . ' B'}}</td>
                            <td>គិតពី {{ date('d-m-Y',strtotime($closedate)) }} ដល់ {{ date('d-m-Y',strtotime($d1)) }}</td>
                            <td></td>
                        </tr>
                @endif
                @foreach ($data as $key => $item)
                    @php
                        $balance+=$item->amount;
                        if($item->amount>0){
                            $cashin+=$item->amount;
                        }elseif($item->amount<0){
                            $cashout+=$item->amount;
                        }
                    @endphp
                    <tr style="">
                        <td style="text-align:center;">{{ ++$key }}</td>

                        <td>{{ date('d-m-Y',strtotime($item->smsdate)) }}</td>
                        <td>{{ $item->smstime }}</td>
                        <td style="border-right:1px solid black;">{{ $item->amount>0?'ដាក់ចូល':'ដកចេញ' }}</td>
                        <td style="text-align:right;border:1px solid black;@if($item->amount>0) color:blue; @else color:red; @endif">{{$item->amount>0?'+' . phpformatnumber($item->amount): phpformatnumber($item->amount)}} B</td>
                        <td style="text-align:right;@if($balance>0) color:blue; @else color:red; @endif">{{ phpformatnumber($balance)}} B</td>
                        <td>{{ $item->smstext }}</td>
                        <td>{{ $item->customer->name??'' }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan=8>
                        <table style="">
                            <tr style="text-align:center;">
                                <td style="width:150px;font-size:14px;">លុយចាប់ផ្តើមបញ្ជី</td>
                                <td style="width:150px;font-size:14px;">បញ្ជីចាស់</td>
                                <td style="width:150px;font-size:14px;">លុយដាក់ចូល</td>
                                <td style="width:150px;font-size:14px;">លុយដកចេញ</td>
                                <td style="width:150px;font-size:14px;">សមតុល្យ</td>

                            </tr>
                            <tr>
                                <td style="color:blue;text-align:right;font-size:14px;">{{ phpformatnumber($startbal) }}B</td>
                                <td style="@if($oldlist>0)color:blue; @else color:red; @endif text-align:right;font-size:14px;">{{ phpformatnumber($oldlist) }}B</td>
                                <td style="color:blue;text-align:right;font-size:14px;">{{ phpformatnumber($cashin) }}B</td>
                                <td style="color:red;text-align:right;font-size:14px;">{{ phpformatnumber($cashout) }}B</td>
                                <td style="@if($balance>0)color:blue; @else color:red; @endif text-align:right;font-size:14px;">{{ phpformatnumber($balance) }}B</td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
<script type="text/javascript">

    printContent('a4report');
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
