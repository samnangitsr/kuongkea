<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IncomeExpanse Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    @page{size: A4;margin:0;}
    @media print {
        html, body {
            width: 210mm;
        }
    }
    #invoice-pos{
        box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
        padding:0mm;
        margin:0 auto;
        width:210mm;
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
        .tblreport th{
            padding:5px;
        }
        .tblreport td{
            padding:5px;
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
        <div class="row" style="margin:20px 0px 0px 10px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td colspan=2 class="kh22-b" style="width:100%;text-align:center;padding:0px;"><abbr title="">{{ $rpttitle }}</abbr> </td>

                    </tr>
                    <tr>
                        <td class="kh16-b" style="padding:0px;">
                            ប្រភេទទូទាត់:{{$paymenttype}}
                        </td>
                        <td class="kh16-b" style="text-align:right;padding:0px;">
                            <span class="kh16-b">គិតពី {{ date('d-m-Y',strtotime($d1)) }}</span>
                            <span class="kh16-b">ដល់ {{ date('d-m-Y',strtotime($d2)) }}</span>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row" style="margin:10px 0px 0px 20px;">
            <table id="" class="table table-bordered table-hover kh16-b tblreport">
                <thead style="text-align:center;">
                    <th>លរ</th>
                    <th>ថ្ងៃទី</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>{{ $trancode==8?'ឈ្មោះអ្នកលក់':'ឈ្មោះអ្នកទិញ' }}</th>
                    <th>ប្រតិបត្តិការណ៏</th>
                    <th>ទូទាត់តាម</th>
                    <th>ចំនួនទឹកប្រាក់</th>

                </thead>
                <tbody>
                    @php
                        $total=0;
                    @endphp
                    @foreach ($reports as $key => $in)
                        @php
                            $total +=$in->amount;
                        @endphp
                        <tr>
                            <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
                            <td class="kh12-b">{{ date('d-m-Y',strtotime($in->dd)) }}</td>
                            <td class="kh12-b">{{ $in->user->name }}</td>
                            <td class="kh12-b">{{ $in->customername }}</td>
                            <td class="kh12-b">{{ $in->tranname . ' ' . $in->sendername}}</td>
                            <td class="kh12-b">{{ $in->deposit_via }}</td>
                            <td class="kh12-b" style="text-align:right;color:black;">{{ phpformatnumber($in->amount) . $in->currency->sk}}</td>
                        </tr>
                    @endforeach
                    <tr style="">
                        <td class="kh16-b" style="color:black;padding:0px 10px;" colspan=4>{{ $trancode==8?'សរុបចំណាយ':'សរុបចំណូល' }}</td>
                        <td colspan=3 class="kh16-b" style="text-align:right;color:black;padding:0px 10px;">{{ phpformatnumber($total) . '$'}}</td>
                    </tr>
                </tbody>

            </table>

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
