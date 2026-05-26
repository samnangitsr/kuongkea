<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Expanse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">
     @page{size: A4;margin:0px;}
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
        #tbl_report th{
            padding:5px;
        }
        #tbl_report td{
            padding:2px 5px;
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
                            <h1 style="font-family:'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;">របាយការណ៏ចំណូលចំណាយបុគ្គលិក {{ $title['username'] }}  ប្រភេទ: {{ $title['type'] }}</h1>
                        </td>
                        <td style="padding:0px;border-style:none;text-align:right;">
                            <h1 style="font-size:16px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;">{{ $title['d1d2'] }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top:-20px;">
            <table id="tbl_report" class="table table-bordered table-hover tbl_report" style="margin:0px;padding:0px;">
                <thead style="text-align:center;" class="kh16">
                    <th style="width:60px;">No</th>
                    <th style="width:120px;">ថ្ងៃកត់ត្រា</th>
                    <th style="">ប្រភេទចំណាយ</th>
                    <th style="">បរិយាយ</th>
                    <th style="">ធនាគា</th>
                    <th style="">ចំនួនទឹកប្រាក់</th>
                    <th style="">គិតជាដុល្លា</th>
                    {{-- <th style="">អត្រា</th> --}}
                    {{-- <th style="">អ្នកកត់ត្រា</th>
                    <th style="">ម៉ោង</th>
                    <th style="">បុ.ពាក់ព័ន្ធ</th> --}}
                </thead>
                <tbody id="body_report">
                    @php

                    @endphp
                    @foreach ($expanses as $k => $tr)
                        <tr>
                            <td style="text-align:center;padding:0px;" class="kh16">{{ ++$k }}</td>
                            <td class="kh16" style="">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                            <td class="kh16">{{ $tr->type }}</td>
                            <td class="kh16">{{ $tr->desr }}</td>
                            <td class="kh16">{{ $tr->customer->name }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->inusd) . '$' }}</td>
                            {{-- <td class="kh16-b" style="text-align:right;">{{ floatval($tr->rate) }}</td> --}}
                            {{-- <td class="kh16">{{ $tr->userrecord->name }}</td>
                            <td class="kh16" style="">{{ $tr->tt }}</td>
                            <td class="kh16">{{ $tr->user->name }}</td> --}}
                        </tr>
                    @endforeach
                    <table>
                        <thead class="kh16">
                            <th style="border:1px solid black;padding:5px 10px;">Total</th>
                            @foreach ($total as $t)
                                <th style="border:1px solid black;padding:5px;@if($t->total<0) color:red; @else color:blue; @endif">{{ phpformatnumber($t->total) . ' ' . $t->currency->shortcut}}</th>
                            @endforeach
                        </thead>
                    </table>
                </tbody>

            </table>
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
