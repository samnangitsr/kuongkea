<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommissionList Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
   @page {
        /* size: A4 landscape; */
        size: A4;
        margin: 0;
    }

    @media print {
        html, body {
            width: 297mm;
            height: 210mm;
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

                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;"><abbr title="">{{ $rpttitle }}</abbr> </td>
                    </tr>
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">
                            <span class="kh22-b">គិតពី {{ date('d-m-Y',strtotime($d1)) }}</span>
                            <span class="kh22-b">ដល់ {{ date('d-m-Y',strtotime($d2)) }}</span>
                        </td>
                    </tr>

                </table>

        </div>
        <div class="row" style="margin:10px 20px 0px 20px;">
            <div class="table-responsive">
                <table id="mytable" class="table table-bordered table-hover kh14-b tbl_transferlist" style="table-layout:fixed;">
                    <thead style="text-align:center;" class="kh14">
                        <th style="width:50px;">No</th>
                        <th style="width:150px;">អ្នកលក់</th>
                        <th style="width:100px;">ថ្ងៃទូទាត់</th>
                        <th style="width:80px;">ចំនួនទូទាត់</th>
                        <th style="width:150px;">ទូទាត់តាម</th>
                        <th style="width:80px;">អចលនទ្រព្យ</th>
                        <th style="width:120px;">កម្រៃជើងសារ</th>
                        <th style="width:120px;">បានទូទាត់រួច</th>
                        <th style="width:120px;">នៅខ្វះ</th>
                    </thead>
                    <tbody id="body_transaction">
                        @php
                            $i=0;
                            $totalcom=0;
                            $totalpay=0;
                            $totalpaid=0;
                        @endphp
                        @foreach ($transfers->where('ispaytosaler',1) as $key => $t)
                            @php
                                $i+=1;
                                $totalpay +=$t->amount;
                                $totalcom +=$t->commission;
                                $totalpaid +=$t->commission_paid;


                            @endphp
                            <tr>
                                <td style="text-align:center;" class="kh14-b">{{ $i }}</td>

                                <td class="kh14-b">{{ $t->partner->name }}</td>
                                <td class="kh14-b">{{ date('d-m-Y',strtotime($t->dd))}}</td-b>
                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($t->amount) . $t->currency->sk}}</td>
                                <td class="kh14-b">{{ $t->deposit_via }}</td>
                                <td class="kh14-b">{{ $t->propertyname }}</td>
                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber($t->commission_paid) . $t->currency->sk}}</td>
                                <td style="text-align:right;" class="kh14-b">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                            </tr>

                        @endforeach
                        <tr>
                            <td colspan=2 class="kh16-b">សរុប</td>
                            <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($totalpay) . '$'}}</td>
                            <td></td>
                            <td colspan=2 style="text-align:right;" class="kh16-b">{{ phpformatnumber($totalcom) . '$'}}</td>
                            <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($totalpaid) . '$'}}</td>
                            <td style="text-align:right;" class="kh16-b">{{ phpformatnumber(abs($totalcom)-abs($totalpaid)) . '$'}}</td>
                        </tr>
                    </tbody>
                    <tr>
                        <td colspan=9>
                            <table class="table">
                                <tr>
                                    <td colspan=3 class="kh16-b" style="border-style:none;text-align:right;">
                                        {{ $printdatetext }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="border-style:none;text-align:center;padding-bottom:150px;">ឯកភាពដោយ</td>
                                    <td class="kh16-b" style="border-style:none;text-align:center;">ពិនិត្យដោយ</td>
                                    <td class="kh16-b" style="border-style:none;text-align:center;">រៀបចំដោយ</td>

                                </tr>
                            </table>

                        </td>
                    </tr>
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
