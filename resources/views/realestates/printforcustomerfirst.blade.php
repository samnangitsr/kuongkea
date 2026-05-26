<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RomlosList Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ config('helper.asset_path') }}/admin/assets/js/jquery.min.js"></script>
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
        #tbl_body td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
        }
        #tbl_header td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
        }
        #tbl_cashin td{
            padding:0px;
            border-style:none;
        }
        #tbl_cashin th{
            padding:0px;
            border-style:none;
        }
        #tbl_cashout td{
            padding:0px;
            border-style:none;
        }
        #tbl_cashout th{
            padding:0px;
            border-style:none;
        }
        #tbl_exchange td{
          padding:2px;
          border-style:none;
        }

        #tbl_exchange th{
          padding:2px;
          border-style:none;
        }
        #tbl_exchange tr{
          border-style:none;
        }
        td{
            color:black;
        }
        #tblromloslist td{
            border:1px solid black;
            padding:2px 5px;
        }
        #tblromloslist th{
            border:1px solid black;
            padding:3px;
        }
        .mybtn{
            border-style:none;
            padding:10px;
            width:100px;
        }
        .mybtn:hover{
            background-color:aquamarine;
        }
        #tblromloslist .clickedrow td{
            background-color: #2213ec;
            color:white;
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

    <button class="mybtn" id="btnclose">Close</button>
    <button class="mybtn" id="btnprint">Print</button>
    <div id="invoice-pos">
        {{-- <div class="row" style="margin-top:40px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:128px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:32px;padding:0px;">
                            ខេអេសរេស៊ីដិន
                        </td>
                        <td style="width:20%;text-align:center;padding:0px;">
                        </td>
                    </tr>
                </table>
            </div>
        </div> --}}

        <div class="row" style="margin:20px;">

                <table class="" style="">
                    <tr>
                        <td class="kh22-b" style="text-align:center;">តារាងបង់រំលស់ប្រចាំខែ(ដីល្វែងKS)</td>
                    </tr>
                    <tr>
                        <td class="kh22-b" style="text-align:center;">ទំនាក់ទំនងបង់ប្រាក់ : 086 815 559</td>
                    </tr>
                </table>

        </div>
        <div class="row" style="margin:20px;">
            <table id="tbl_header" class="table" style="table-layout:fixed;">
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">តំលៃដី </td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:16px;font-weight:bold;">{{ phpformatnumber(abs($buyinfo->amount)) . ' ' . $buyinfo->currency->shortcut}}</td>
                            </tr>
                            <td style="width:120px;font-size:16px;font-weight:bold;">កក់មុន </td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:16px;font-weight:bold;"> {{ phpformatnumber($buyinfo->totaldeposit) . ' ' . $buyinfo->currency->shortcut}}</td>
                            </tr>
                            <tr>
                                <td style="width:100px;font-size:16px;font-weight:bold;">អត្រាការប្រាក់</td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:16px;font-weight:bold;"> {{ phpformatnumber($buyinfo->interest_rate) . ' %' }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px;font-size:16px;font-weight:bold;">ចំនួនខែត្រូវបង់</td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:16px;font-weight:bold;"> {{ phpformatnumber($buyinfo->term) . ' ខែ' }}</td>
                            </tr>
                    </table>
                </td>
                <td style="width:50%">
                    <table>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">ឈ្មោះអតិថិជន</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:16px;font-weight:bold;">{{ $buyinfo->partner->name }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">លេខទូរស័ព្ទ</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:16px;font-weight:bold;">{{ $buyinfo->partner->tel }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">ដីល្វែងលេខ</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:16px;font-weight:bold;">{{ $buyinfo->sendername }}</td>
                        </tr>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">ទីតាំង</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:16px;font-weight:bold;">{{ $buyinfo->propertylocation }}</td>
                        </tr>
                    </table>
                </td>
            </table>
        </div>
        <div class="table-responsive" style="margin:5px 20px;">

                <table id="tblromloslist" class="table table-bordered table-hover" style="">
                    <thead style="text-align:center;" class="kh12-b">
                        <th style="width:40px;">No</th>
                        <th style="width:80px;">ថ្ងៃទី</th>
                        <th style="width:100px;">ប្រាក់ដើម</th>
                        <th style="width:80px;">ការប្រាក់</th>
                        <th style="width:80px;">រំលស់ដើម</th>
                        <th style="width:100px;">ប្រាក់ត្រូវបង់</th>
                        <th style="width:100px;">សមតុល្យ</th>
                        <th style="width:100px;">ថ្ងៃទូទាត់</th>
                        <th style="width:200px;">ផ្សេងៗ</th>

                    </thead>
                    @php
                        $totalrate=0;
                        $totalpayment=0;
                        $cur='';
                    @endphp
                    <tbody id="body_transaction">

                        @foreach ($myc as $k => $tr)
                            @php
                                $totalrate +=$tr['rate'];
                                $totalpayment +=$tr['payamt'];
                                $cur=$tr['cur'];
                            @endphp
                            <tr>
                                <td style="text-align:center;" class="kh12-b">{{ ++$k }}</td>
                                <td class="kh12-b" style="">{{ date('d/m/y',strtotime($tr['dd'])) }}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber(abs($tr['principal'])) . $tr['cur']}}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($tr['rate']) . $tr['cur']}}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($tr['payamt']) . $tr['cur']}}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($tr['payamt']+$tr['rate']) . $tr['cur']}}</td>

                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber(abs($tr['balance'])) .$tr['cur'] }}</td>
                                <td class="kh12-b" style=""></td>
                                <td class="kh12-b" style=""></td>

                            </tr>

                        @endforeach
                        <tr style="border-style:none;background-color:bisque;">
                            <td colspan=3 class="kh12-b">សរុប</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($totalrate) . $cur }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($totalpayment) . $cur }}</td>
                            <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($totalpayment+$totalrate) . $cur }}</td>
                            <td colspan=3 style="border-style:none;"></td>
                        </tr>
                    </tbody>

                </table>


        </div>
        <div class="row">
            <table style="table-layout:fixed;">
                <tr>
                    <td style="font-family: khmer os muol light;font-size:16px;padding-left:100px;width:50%;">អ្នកបង់ប្រាក់</td>
                    <td style="font-family: khmer os muol light;font-size:16px;padding-right:100px;width:50%;text-align:right;">អ្នកទទួលប្រាក់</td>
                </tr>
            </table>

        </div>

    </div>

</body>
<script type="text/javascript">
    $(document).on('click', function () {
        $('#tblromloslist').find('tr.clickedrow').removeClass('clickedrow');
    })
     $(document).on('click', '#tblromloslist td', function (e) {
        $('#tblromloslist').find('tr.clickedrow').removeClass('clickedrow');
        $(this).closest('tr').addClass('clickedrow');
        e.stopPropagation(); // Prevent document click from firing
    });
    $('#btnprint').click(function(e){
        e.preventDefault();
        printContent1('invoice-pos');
    })
     $('#btnclose').click(function(e){
        e.preventDefault();
       window.close();
    })
    //printContent('invoice-pos');
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
    function printContent1(el) {
        let original = document.body.innerHTML;
        let printArea = document.getElementById(el).innerHTML;

        document.body.innerHTML = printArea;
        window.print();

        // Restore the original page after printing
        document.body.innerHTML = original;
        location.reload(); // Optional: force reload to re-bind scripts if needed
    }
</script>
</html>
