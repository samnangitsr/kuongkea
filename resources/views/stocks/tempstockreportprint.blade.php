<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockReport</title>
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
   $sumprofit=0;
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
                    <td class="kh22-b">របាយការណ៌ទិញលក់រូបិយប័ណ្ណ </td>
                    <td class="kh22-b">បុគ្គលិក {{ $username }}</td>
                    <td class="kh22-b">ថ្ងៃទី {{ date('d-m-Y',strtotime($dd)) }}</td>

                </tr>
            </table>

        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered tbl_stockreport">
                    <thead class="kh16" style="text-align:center;">
                        <th>លរ</th>

                        <th>រូបិយ</th>
                        <th>ស្តុកដើមគ្រា</th>
                        <th>គិតជាលុយ</th>
                        <th>ទិញចូល</th>
                        <th>គិតជាលុយ</th>
                        <th>លក់ចេញ</th>
                        <th>សរុបលក់</th>
                        <th>សរុបទិញ</th>
                        <th>ចំណេញ</th>
                        <th>ស្តុកចុងគ្រា</th>
                        <th>គិតជាលុយ</th>
                    </thead>
                    <tbody id="stockreport">
                        @foreach ($report as $key=>$r)
                            @php
                                $sumprofit+=$r->totalsale-$r->totalbuy;
                            @endphp
                            <tr class="kh22">
                                <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>

                                <td class="kh12-b" style="">
                                    {{ $r->currency->shortcut }}
                                </td>
                                <td class="kh12-b" style="" title="{{ date('d-M-y',strtotime($r->stockdate)) }}"> {{ phpformatnumber($r->startstock) }}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($r->startamount) . '$' }}</td>
                                <td class="kh12-b" style="color:blue;">{{ phpformatnumber($r->buyqty) }}</td>
                                <td class="kh12-b" style="text-align:right;color:blue;">{{ phpformatnumber($r->buyamt) . '$' }}</td>
                                <td class="kh12-b" style="color:red;">{{ phpformatnumber($r->qtysale) }}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($r->totalsale) . '$' }}</td>
                                <td class="kh12-b" style="color:blue;">{{ phpformatnumber($r->totalbuy) . '$' }}</td>
                                <td class="kh12-b" style="text-align:right;">{{ number_format($r->totalsale-$r->totalbuy,2,'.',',') . '$' }}</td>
                                <td class="kh12-b" style="text-align:right;">
                                    {{ phpformatnumber($r->stock) }}
                                </td>
                                <td class="kh12-b" style="text-align:right;">
                                    {{ phpformatnumber($r->amount) . '$' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr style="background-color:aquamarine">
                            <td class="kh16-b" colspan=9 style="text-align:center;">សរុបប្រាក់ចំណេញ</td>
                            <td class="kh16-b" colspan=3>
                                {{ number_format($sumprofit,2,'.',',') . '$' }}
                            </td>
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
