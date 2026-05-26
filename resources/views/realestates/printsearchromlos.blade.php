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
                        <td class="kh16-b" style=""><abbr title="">{{ $rpttile }} </td>
                        <td class="kh14-b" style="text-align:right;">គិតពី {{ date('d-m-Y',strtotime($startdate)) }} ដល់ {{ date('d-m-Y',strtotime($enddate)) }}</td>
                    </tr>

                </table>

        </div>

        <div class="table-responsive" style="margin:5px 20px;">

                <table id="tblromloslist" class="table table-bordered table-hover " style="">
                    <thead style="text-align:center;" class="kh12-b">
                        <th style="width:40px;">No</th>
                        <th style="width:80px;">ថ្ងៃទី</th>
                        <th style="width:220px;">ប្រតិបត្តិការណ៏</th>
                        <th style="width:100px;">ចំនួនទឹកប្រាក់</th>
                        <th style="width:100px;">សមតុល្យ</th>
                        <th style="width:100px;">អ្នកកត់ត្រា</th>
                        <th style="width:80px;">ថ្ងៃទូទាត់</th>

                    </thead>

                    <tbody id="body_transaction">
                        @php
                            $balance=0;
                        @endphp
                        @foreach ($myc as $k => $tr)
                            @php
                                $balance += floatval($tr['amount']);
                            @endphp
                            <tr>
                                <td style="text-align:center;padding-top:4px;" class="kh12-b">{{ ++$k }}</td>
                                <td class="kh12-b" style="padding-top:4px;">{{ date('d-m-Y',strtotime($tr['dd'])) }}</td>
                                <td class="kh12-b" style="padding-top:4px;">{{ $tr['tranname'] }}</td>
                                <td class="kh14-b" style="text-align:right;@if($tr['amount']>0) color:blue; @else color:red; @endif">{{ $tr['amount']>0?'+':'' }} {{ phpformatnumber($tr['amount']) .$tr['currency'] }}</td>
                                <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($balance) .$tr['currency'] }}</td>
                                <td class="kh12-b" style="padding-top:4px;">{{ $tr['usersave'] }}</td>
                                <td class="kh12-b" style="padding-top:4px;">{{ $tr['trandate']? date('d-m-Y',strtotime($tr['trandate'])):'' }}</td>

                            </tr>

                        @endforeach
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
