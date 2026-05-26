<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockDetail1</title>
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
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }

       .cgr{
        background-color:aquamarine;
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
    $totalbuy=0;
    $totalamtbuy=0;
    $totalsale=0;
    $totalamtsale=0;
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
        <div class="row" style="background-color:rgb(208, 234, 137);padding:10px;">
            <table>
                <tr>
                    <td class="kh16-b">របាយការណ៌ទិញលក់ {{ $curname }}</td>
                    <td class="kh16-b">បុគ្គលិក {{ $username }}</td>
                    <td class="kh16-b">គិតពី {{ date('d-m-Y',strtotime($d1)) }}</td>
                    <td class="kh16-b">ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                </tr>
            </table>

        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered kh22 tbl_exchangedetail">
                    <thead style="text-align:center;" class="kh16">
                        <th>លរ</th>
                        <th>ម៉ោង</th>
                        <th>រូបិយប័ណ្ណ</th>
                        <th>ទិញចូល</th>
                        <th>សរុបទឹកប្រាក់</th>
                        <th>អត្រា</th>
                        <th>ផ្សេងៗ</th>
                    </thead>
                    <tbody>
                        @foreach ($buys as $k =>$b)
                            @php
                                $totalbuy+=$b->product;
                                $totalamtbuy+=$b->amount;
                            @endphp
                            <tr style="background-color:rgb(199, 199, 232)">
                                <td class="kh16" style="text-align:center;">{{ ++$k }}</td>
                                <td class="kh16">{{ $b->tt }}</td>
                                <td class="kh16">{{ $b->currency->curname }}</td>
                                <td class="kh16" style="text-align:right;">{{ phpformatnumber($b->product) . ' ' . $b->currency->shortcut }}</td>
                                <td class="kh16" style="text-align:right;">{{ phpformatnumber($b->amount) . ' ' . $b->maincur }}</td>
                                <td class="kh16" style="text-align:center;">{{ floatval($b->rate) }}</td>
                                <td class="kh16">{{ $b->note }}</td>

                            </tr>
                        @endforeach
                        <tr  style="background-color:rgb(199, 199, 232)">
                            <td class="kh16-b" colspan=3>សរុបទិញ/Total Buy</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalbuy) . ' ' . $curreport->currency->shortcut }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalamtbuy) . ' USD' }}</td>
                            <td colspan=2></td>
                        </tr>
                        @foreach ($sales as $k1 =>$s)
                            @php
                                $totalsale+=$s->product;
                                $totalamtsale+=$s->amount;
                            @endphp
                            <tr style="background-color:rgb(237, 209, 209)">
                                <td class="kh16" style="text-align:center;">{{ ++$k1 }}</td>
                                <td class="kh16">{{ $s->tt }}</td>
                                <td class="kh16">{{ $s->currency->curname }}</td>
                                <td class="kh16" style="text-align:right;">{{ phpformatnumber($s->product) . ' ' . $s->currency->shortcut }}</td>
                                <td class="kh16" style="text-align:right;">{{ phpformatnumber($s->amount) . ' ' . $s->maincur }}</td>
                                <td class="kh16" style="text-align:center;">{{ floatval($s->rate) }}</td>
                                <td class="kh16">{{ $s->note }}</td>
                            </tr>
                        @endforeach
                        <tr  style="background-color:rgb(237, 209, 209)">
                            <td class="kh16-b" colspan=3>សរុបលក់/Total Sale</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalsale) . ' ' . $curreport->currency->shortcut }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($totalamtsale) . ' USD' }}</td>
                            <td colspan=2></td>
                        </tr>
                        <tr class="kh16-b" style="">
                            <td class="kh16-b" colspan=3>សរុបទិញ/Total Buy</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($curreport->qtysale) . ' ' . $curreport->currency->shortcut }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($curreport->totalbuy) . ' USD' }}</td>
                            <td class="kh16-b" colspan=2 style="text-align:center;">P/L={{ phpformatnumber($curreport->totalsale-$curreport->totalbuy) . ' USD' }}</td>
                        </tr>
                        <tr class="kh16-b" style="">
                            <td class="kh16-b" colspan=3>សមតុល្យ/Balance</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($curreport->amount) . ' USD' }}</td>
                            <td colspan=2></td>
                        </tr>
                    </tbody>
                </table>
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
