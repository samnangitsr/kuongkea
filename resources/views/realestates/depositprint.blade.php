<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depsit Print</title>
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
        #tbldetail td{
            border:1px solid black;
        }
        #tbldetail th{
            border:1px solid black;
        }
        #tblsummary td{
            padding:2px 5px;
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

        <div class="row" style="margin:20px 0px 0px 10px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;"><abbr title="">{{ $rpttitle }}</abbr> </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row" style="margin:0px 10px 0px 20px;">

            <table id="tbl_header" class="table" style="table-layout:fixed;">
                <td style="width:75%">
                    <table>
                        <tr>
                            <td style="width:100px;font-size:16px;font-weight:bold;">{{ $transfer->partner->customertype=='BUYER'?'អតិថិជន':'អ្នកលក់គំរោង' }} </td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:16px;font-weight:bold;">{{ $transfer->partner->name }} &nbsp;&nbsp; ភេទ:{{ $transfer->partner->sex==1?'ប្រុស':'ស្រី' }}</td>
                            </tr>
                            <td style="width:120px;font-size:14px;font-weight:bold;">អត្តសញ្ញាណប័ណ្ណ </td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:14px;font-weight:bold;"> {{ $transfer->partner->idcard }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px;font-size:14px;font-weight:bold;">លេខទូរស័ព្ទ</td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:14px;font-weight:bold;"> {{ $transfer->partner->tel }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px;font-size:14px;font-weight:bold;">អាស័យដ្ឋាន</td>
                                <td style="width:10px;">:</td>
                                <td style="font-size:14px;font-weight:bold;"> {{ 'ភូមិ' . $transfer->partner->village->name . ' ឃុំ' . $transfer->partner->commune->name . ' ស្រុក' .  $transfer->partner->district->name . ' ខេត្ត' . $transfer->partner->province->name }}</td>
                            </tr>
                    </table>
                </td>
                <td style="width:25%">
                    <table>
                        <tr>
                            <td style="width:80px;font-size:16px;font-weight:bold;">វិក្កយបត្រ#</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:16px;font-weight:bold;">{{ sprintf("%04d",$transfer->id) }}</td>
                        </tr>
                        <tr>
                            <?php
                                    $date=date_create($transfer->dd);
                                    $date1=date_create($transfer->dd);
                                    date_add($date1,date_interval_create_from_date_string("7 days"));
                                ?>
                            <td style="width:80px;font-size:14px;font-weight:bold;"><span>កាលបរិច្ឆេទ </td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:14px;font-weight:bold;">{{ date_format($date,"d/m/Y")}}</td>
                        </tr>
                        <tr>
                            <td style="width:80px;font-size:14px;font-weight:bold;">ម៉ោង</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:14px;font-weight:bold;">{{ $transfer->tt }}</td>
                        </tr>
                        <tr>
                            <td style="width:80px;font-size:14px;font-weight:bold;">អ្នកកត់ត្រា</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:14px;font-weight:bold;">{{ $transfer->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="width:80px;font-size:14px;font-weight:bold;">អចលនទ្រព្យ</td>
                            <td style="width:10px;">:</td>
                            <td style="font-size:14px;font-weight:bold;">{{ $propertyname }}</td>
                        </tr>

                    </table>
                </td>
            </table>

        </div>

        <div class="row" style="margin:0px 10px 0px 20px;">
            <table id="tbldetail" class="table">
                <thead style="font-size:16px;text-align:center;border-style:1px solid black;">
                    <th>លរ</th>
                    <th>ថ្ងៃកក់</th>
                    <th>ប្រភេទទូទាត់</th>
                    <th>ចំនួនទឹកប្រាក់</th>
                </thead>
                <tbody>
                    @php
                        $total=0;
                        $cur=$transfer->currency->shortcut;
                    @endphp
                   @foreach ($transfergroup as $key => $g)
                        @php
                            $total +=$g->amount;
                            // $nextpayment=$g->nextpayment;
                        @endphp
                       <tr>
                        <td class="kh16-b" style="text-align:center;">{{ ++$key }}</td>
                        <td class="kh16-b">{{ date('d-m-Y',strtotime($g->dd))  }}</td>

                        <td class="kh16-b">{{ $g->deposit_via??'' }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($g->amount) . ' ' . $g->currency->shortcut }}</td>


                       </tr>
                   @endforeach
                       <tr>
                            {{-- <td colspan=2 style="padding:0px;">
                                <table id="tblsummary" class="table" style="padding:0px;margin:0px;">
                                    <tr style="text-align:center;">
                                        <td class="kh16-b">តំលៃលក់</td>
                                        <td class="kh16-b">បានទូទាត់</td>
                                        <td class="kh16-b">នៅសល់</td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($transfer->soldprice)) . $transfer->currency->sk}}</td>
                                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($transfer->deposited) . $transfer->currency->sk . '(' . $transfer->countdeposit . ')'}}</td>
                                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($transfer->soldprice)-abs($transfer->deposited)) . $transfer->currency->sk}}</td>
                                    </tr>
                                </table>
                            </td> --}}
                            <td colspan=3 class="kh22-b" style="text-align:right;">
                                សរុបទឹកប្រាក់បានបង់
                            </td>
                            <td class="kh22-b" style="text-align:right;">
                               {{ phpformatnumber(abs($total))  . ' ' . $cur }}
                            </td>
                       </tr>

                </tbody>
            </table>
            <div class="row">
                <table style="table-layout:fixed;">
                    <tr>
                        <td style="font-family: khmer os muol light;font-size:16px;padding-left:100px;width:50%;">អ្នកបង់ប្រាក់</td>
                        <td style="font-family: khmer os muol light;font-size:16px;padding-right:100px;width:50%;text-align:right;">អ្នកទទួលប្រាក់</td>
                    </tr>
                </table>

            </div>

            {{-- <div class="legalcopy" style="margin-top:-30px;">
                <p class=""legal>
                    <p style="font-family:Noto Sans Khmer,sans-serif;font-size:12px;text-align:center;color:black;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
                        ** Thank you for your visiting **
                    </p>

                </p>
            </div> --}}

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
