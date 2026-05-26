<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Profit</title>
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
        #tbl_partner_transfer td{
            padding:3px;
        }
        #tbl_partner_transfer th{
            padding:3px;
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
    <div id="a4report">
        <div class="row" style="">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="padding:0px;border-style:none;">
                            <h1 style="font-family:'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">របាយការណ៏ប្រាក់ចំណេញពីការផ្ទេរប្រាក់ {{ $title['customer'] }}</h1>
                        </td>
                        <td style="padding:0px;border-style:none;text-align:right;">
                            <h1 style="font-size:12px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;">{{ $title['d1d2'] }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top:-20px;">
            <div class="table-responsive">
                <table id="tbl_partner_transfer" class="table table-bordered kh14" style="">
                    <thead style="text-align:center;" class="">
                        <th>លរ</th>
                        <th>ម៉ោង</th>

                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ឈ្មោះដៃគូ</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>សេវ៉ាវេរ</th>
                        <th>សេវ៉ាដៃគូ</th>
                        <th>សេវ៉ាថៃ</th>
                        <th>ប្រាក់ចំណេញ</th>
                        {{-- <th>សមតុល្យ</th> --}}
                        <th>លុយថៃ</th>
                        <th>អត្រា</th>
                        <th>សេវ៉ាថៃ</th>
                        <th>ពត៌មានអតិថិជន</th>
                        <th>ផ្សេងៗ</th>
                        {{-- <th>អ្នកកត់ត្រា</th> --}}

                    </thead>
                    @php
                        $n=0;
                        $balance=0;
                    @endphp
                    <tbody id="bodytransfer">

                        @foreach ($transfers as $key => $t)
                            @php
                                $n=$n+1;
                                $profit=floatval($t->cuscharge_ex)-floatval($t->fee_ex)+floatval($t->thaiseva_exchange);
                                 $balance= $balance + floatval($t->amount)+ floatval($t->fee_ex);
                                 $k=$key+1
                            @endphp
                            @if($k==1)
                                @php
                                    $predate=$t->dd;
                                @endphp
                                <tr class="kh12-b">
                                    <td colspan=13>{{ date('d-m-Y',strtotime($t->dd)) }}</td>
                                </tr>
                            @else
                                @if($t->dd<>$predate)
                                    @php
                                        $predate=$t->dd;
                                    @endphp
                                    <tr class="kh12-b">
                                        <td colspan=13>{{ date('d-m-Y',strtotime($t->dd)) }}</td>
                                    </tr>
                                @endif
                            @endif
                            <tr class="kh12-b">
                                <td style="text-align:center;">{{ $n }}</td>
                                <td>{{ $t->tt }}</td>
                                <td>{{ $t->tranname }}</td>
                                <td>{{ $t->partner->name }}</td>
                                <td style="text-align:right;@if($t->amount>0) color:red @else color:blue @endif">{{ phpformatnumber(-1 * $t->amount) . $t->currency->sk}}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t->cuscharge_ex) . $t->currency->sk }}</td>
                                <td style="text-align:right;">{{ phpformatnumber(-1 * $t->fee_ex) . $t->currency->sk }}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t->thaiseva_exchange) . $t->currency->sk }}</td>
                                <td style="text-align:right;@if($profit>0) color:blue; @else color:red; @endif">{{ phpformatnumber($profit) . $t->currency->sk}}</td>
                                {{-- <td style="text-align:right;background-color:powderblue; @if($balance>0) color:red @else color:blue @endif">{{ phpformatnumber(-1 * $balance) . $t->currency->sk }}</td> --}}
                                <td style="text-align:right;">{{ phpformatnumber($t['thai_amt']) }}B</td>
                                <td style="text-align:center;">{{ floatval($t['th_rate']) }}</td>
                                <td style="text-align:right;">{{ phpformatnumber($t['thai_seva']) }}B</td>
                                <td>{{ $t->recname . $t->rectel }}</td>
                                <td>{{ $t->note }}</td>
                                {{-- <td>{{ $t->user->name }}</td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table-hover kh16-b" style="background-color:aquamarine;">
                    <thead>
                        <th style="border:1px solid black;padding:5px;">Total Profit:</th>
                        @foreach ($totalprofit as $p)
                            <th style="border:1px solid black;padding:5px;">{{ phpformatnumber($p->tprofit) . $p->currency->sk  }}</td>

                        @endforeach
                    </thead>
                </table>
            </div>
        </div>

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
