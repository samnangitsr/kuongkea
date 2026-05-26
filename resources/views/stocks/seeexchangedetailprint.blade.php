<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockDetail</title>
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
    $totalbuygold=0;
    $totalamtbuy=0;
    $totalsale=0;
    $totalsalegold=0;
    $totalamtsale=0;
     function phpformatnumber($num)
    {
        if (!is_numeric($num)) {
            return $num;
        }

        $num = (string)$num;
        $dc = 0;

        if (strpos($num, '.') !== false) {
            $decimals = explode('.', $num)[1];
            // Count actual meaningful decimals (but max 4)
            $dc = min(strlen(rtrim($decimals, '0')), 4);
        }

        return number_format((float)$num, $dc, '.', ',');
    }

@endphp
<body>
    <div id="invoice-pos">
        <div class="row" style="padding:10px;">
            <table>
                <tr>
                    <td class="kh22-b">របាយការណ៌ទិញលក់រូបិយប័ណ្ណ {{ $curname }}</td>
                    <td class="kh22-b">បុគ្គលិក {{ $username }}</td>
                    <td class="kh22-b">ថ្ងៃទី {{ date('d-m-Y',strtotime($viewdate)) }}</td>

                </tr>
            </table>

        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered kh22 tbl_exchangedetail">
                    <thead style="text-align:center;">
                        <th style="width:50px;">លរ</th>
                        <th style="width:120px;">ថ្ងៃទី</th>
                        <th style="width:100px;">ម៉ោង</th>
                        <th style="width:100px;">រូបិយប័ណ្ណ</th>
                        <th style="width:200px;">ទំនិញ</th>
                        @if($gold_tuochek>1)
                            <th style="width:100px;">ទឹក</th>
                            <th style="width:200px;">ទម្ងន់មាស</th>
                        @endif
                        <th style="width:100px;">អត្រា</th>
                        <th style="width:200px;">សរុបទឹកប្រាក់</th>


                    </thead>
                    <tbody>
                        @foreach ($buys as $k =>$b)
                            @php
                                $totalbuy+=$b->product;
                                $totalbuygold += $b->product * $b->goldwater / 100;
                                $totalamtbuy+=$b->amount;
                            @endphp

                            <tr style="">
                                <td style="text-align:center;">{{ ++$k }}</td>
                                <td>{{ date('d-m-y',strtotime($b->dd))}}</td>
                                <td>{{ $b->tt }}</td>
                                <td>{{ $b->currency->curname }}</td>
                                <td style="text-align:right;@if($b->product>0) color:blue; @else color:red; @endif">
                                    {{ phpformatnumber($b->product) . ' ' . $b->currency->shortcut }}
                                </td>
                                @if($gold_tuochek>1)
                                    <td style="text-align:center;">
                                        {{ $b->goldwater }}
                                    </td>
                                    <td style="text-align:right;@if($b->product>0) color:blue; @else color:red; @endif">
                                        {{ phpformatnumber($b->product * $b->goldwater / 100) . ' ' . $b->currency->shortcut }}
                                    </td>
                                @endif
                                <td style="text-align:center;">{{ floatval($b->rate) }}</td>
                                <td style="text-align:right;@if($b->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($b->amount) . ' ' . $b->maincur }}</td>



                            </tr>

                        @endforeach
                        <tr class="kh18-b" style="background-color:rgb(188, 235, 223);border:2px solid black;">
                            <td colspan=4 style="font-weight:bold;">សរុបទិញ/Total Buy</td>
                            <td style="text-align:right;color:black;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy) . ' ' . $curreport->currency->shortcut }}</td>
                            @if($gold_tuochek>1)
                                <td style="text-align:center;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy<>0?$totalbuygold/$totalbuy*100:0)}}</td>
                                <td style="text-align:right;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuygold) . ' ' . $curreport->currency->shortcut }}</td>
                                <td style="text-align:right;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuygold<>0?abs($totalamtbuy/$totalbuygold*100):0) }}</td>
                            @else
                                @if($curreport->currency->sign=='/')
                                    <td style="text-align:right;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalbuy<>0?abs($totalamtbuy/$totalbuy):0) }}</td>
                                @else
                                    <td style="text-align:right;font-weight:bold;@if($totalbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtbuy<>0?abs($totalbuy/$totalamtbuy):0) }}</td>
                                @endif
                            @endif
                            <td style="text-align:right;font-weight:bold;@if($totalamtbuy>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtbuy) . ' USD' }}</td>

                        </tr>
                        {{-- part sale --}}
                        @foreach ($sales as $k1 =>$s)
                            @php
                                $totalsale+=$s->product;
                                $totalsalegold +=$s->product * $s->goldwater / 100;
                                $totalamtsale+=$s->amount;
                            @endphp
                            <tr style="">
                                <td style="text-align:center;">{{ ++$k1 }}</td>
                                <td>{{ date('d-m-y',strtotime($s->dd))}}</td>
                                <td>{{ $s->tt }}</td>
                                <td>{{ $s->currency->curname }}</td>
                                <td style="text-align:right;@if($s->product>0) color:blue; @else color:red; @endif">
                                    {{ phpformatnumber($s->product) . ' ' . $s->currency->shortcut }}

                                </td>
                                    @if($gold_tuochek>1)
                                    <td style="text-align:center;">
                                        {{ $s->goldwater }}
                                    </td>
                                    <td style="text-align:right;@if($s->product>0) color:blue; @else color:red; @endif">
                                        {{phpformatnumber($s->product * $s->goldwater / 100) . ' ' . $s->currency->shortcut}}
                                    </td>
                                    @endif
                                <td style="text-align:center;">{{ floatval($s->rate) }}</td>
                                <td style="text-align:right;@if($s->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($s->amount) . ' ' . $s->maincur }}</td>



                            </tr>

                        @endforeach
                        <tr class="kh18-b" style="background-color:rgb(237, 209, 209);border:2px solid black;">
                            <td colspan=4 style="font-weight:bold;">សរុបលក់/Total Sale</td>
                            <td style="text-align:right;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale) . ' ' . $curreport->currency->shortcut }}</td>
                            @if($gold_tuochek>1)
                                <td style="text-align:center;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale<>0?$totalsalegold/$totalsale*100:0)}}</td>
                                <td style="text-align:right;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsalegold) . ' ' . $curreport->currency->shortcut }}</td>
                                <td style="text-align:right;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsalegold<>0?abs($totalamtsale/$totalsalegold*100):0) }}</td>
                            @else
                                @if($curreport->currency->sign=='/')
                                    <td style="text-align:right;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalsale<>0?abs($totalamtsale/$totalsale):0) }}</td>
                                @else
                                    <td style="text-align:right;font-weight:bold;@if($totalsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtsale<>0?abs($totalsale/$totalamtsale):0) }}</td>
                                @endif
                            @endif
                            <td style="text-align:right;font-weight:bold;@if($totalamtsale>0) color:blue; @else color:red; @endif">{{ phpformatnumber($totalamtsale) . ' USD' }}</td>

                        </tr>
                        <tr class="kh18-b" style="background-color:yellow;">
                            <td colspan=5 style="font-weight:bold;">ប្រាក់ចំណេញ/PL=
                                  {{ phpformatnumber($curreport->totalsale-$curreport->totalbuy) . ' USD' }}
                            </td>

                            {{-- <td style="text-align:right;">{{ phpformatnumber($curreport->qtysale) . ' ' . $curreport->currency->shortcut }}</td> --}}
                            @if($gold_tuochek>1)
                                <td></td>
                                <td></td>
                                <td></td>
                            @else
                                <td></td>
                            @endif
                            <td style="text-align:right;color:red;font-weight:bold;">-{{ phpformatnumber($curreport->totalbuy) . ' USD' }}</td>


                        </tr>
                        <tr class="kh18-b" style="background-color:aquamarine">
                            <td colspan=4 style="font-weight:bold;">សមតុល្យ/Balance</td>
                            @if($gold_tuochek>1)
                                    <td style="text-align:right;font-weight:bold;">{{ phpformatnumber($curreport->stock_platin) . ' ' . $curreport->currency->shortcut }}</td>
                                    <td style="text-align:right;font-weight:bold;">{{ phpformatnumber($curreport->stock_platin<>0?$curreport->stock/$curreport->stock_platin * 100:0) }}</td>
                                    <td style="text-align:right;font-weight:bold;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                                    <td style="text-align:right;font-weight:bold;">
                                        @if($curreport->stock<>0)
                                            {{ phpformatnumber($curreport->stock<>0?$curreport->amount/$curreport->stock * 100:0) }}
                                        @else

                                        @endif
                                    </td>
                            @else
                                    <td style="text-align:right;font-weight:bold;">{{ phpformatnumber($curreport->stock) . ' ' . $curreport->currency->shortcut }}</td>
                                    <td style="text-align:right;font-weight:bold;">
                                        @if($curreport->currency->optsign=='/')
                                        @if($curreport->amount<>0)
                                            {{phpformatnumber($curreport->stock/$curreport->amount) }}
                                        @else

                                        @endif
                                    @else
                                        @if($curreport->stock<>0)
                                            {{ phpformatnumber($curreport->amount/$curreport->stock) }}
                                        @else

                                        @endif
                                    @endif
                                </td>
                            @endif

                            <td style="text-align:right;font-weight:bold;">{{ phpformatnumber($curreport->amount) . ' USD' }}</td>

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
