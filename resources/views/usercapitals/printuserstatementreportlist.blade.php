<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserStatementReportPrint</title>
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
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;

            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
            font-weight:bold;
        }
        .total{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        .red{
            color:red;
        }
        .blue{
            color:blue;
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
                            <h1 class="kh32">របាយការណ៏បុគ្គលិក {{ $title['username'] }}</h1>
                        </td>


                        <td style="padding:0px;border-style:none;text-align:right;">
                            <h1>{{ $title['date'] }}</h1>
                        </td>
                    </tr>
                    <tr>
                      <td style="padding:0px;border-style:none;">
                        <h1 class="kh32">រូបិយប័ណ្ណ{{ $title['curname'] }}</h1>
                      </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-left:5px;margin-right:5px;">
            <div class="table-responsive">
                <table class="table table-bordered kh16 tbl_usertransaction">
                    <thead class="kh18" style="text-align:center;">
                        <th>លរ</th>
                        <th>ម៉ោង</th>
                        <th>បរិយាយ</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>សមតុល្យ</th>
                        <th>ផ្សេងៗ</th>

                    </thead>
                    <tbody>
                        @php
                            $balance=0;
                        @endphp
                        @foreach ($usertransactions as $key => $ut)
                            <tr>
                                @php
                                    $balance +=$ut->amount;
                                @endphp
                                <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16" style="text-align:center;">{{ $ut->tt }}</td>
                                <td class="kh16">{{ $ut->tranname }}</td>
                                <td class="amt {{ $ut->amount>=0?'blue':'red' }}">
                                    @if($ut->amount>0)
                                        +
                                    @endif
                                    {{ phpformatnumber($ut->amount) . $ut->currency->shortcut }}
                                </td>
                                <td class="amt">{{ phpformatnumber($balance) . $ut->currency->shortcut }}</td>
                                <td class="kh16">{{ $ut->desr }}</td>
                            </tr>
                        @endforeach

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
