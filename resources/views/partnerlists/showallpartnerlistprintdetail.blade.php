<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintPartnerAllList</title>
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
           div.pagebreak, div.appendix {page-break-after: always;}
    #invoice-pos{
        box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
        padding:0mm;
        margin:0 auto;
        /* width:60mm; */
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
        .kh32-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:32px;
            font-weight:bold;
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
        #tblheader td{
            border-style:none;
        }
        td.totalrow{
            text-align:right;
            font-weight:bold;
            font-size:22px;
            font-family:'Noto Sans Khmer', sans-serif;
        }
        td.amountrow{
            text-align:right;
            font-size:16px;
            font-family:'Noto Sans Khmer', sans-serif;
            font-weight:bold;

        }
        #tbl_all_partnerlist td{
          padding:2px;
        }
        #tbl_all_partnerlist th{
          padding:2px;
        }
</style>
@php

    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        $fp=substr($num,$p,strlen($num)-$p);
        $dc=strlen((float)$fp)-2;
        if($dc>2){
            $dc=2;
        }
        }
        return number_format($num,$dc,'.',',');
    }
    function phpformatnumber1($num,$dc){
        return number_format($num,$dc,'.',',');
    }
@endphp
<body>
    <div id="invoice-pos">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tblheader" class="table">
                        <tr>
                            <td class="kh22-b" style="">{{ $rpttitle }}</td>
                            <td class="kh22-b" style="text-align:right;">{{ $datestr }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row pagebreak" style="margin-top:0px;">
            <div class="table-responsive">
                <table id="tbl_all_partnerlist" class="table table-bordered table-striped kh22">
                    <thead style="text-align:center;" >
                        <tr>
                            <td class="kh16-b" rowspan=2>លរ</td>
                            <td class="kh16-b" rowspan=2>ឈ្មោះដៃគូ</td>
                            <td class="kh16-b" colspan=4 style="color:blue;">បើកនៅយើង</td>
                            <td class="kh16-b" colspan=4 style="color:red">បើកនៅគេ</td>
                            <td class="kh16-b" colspan=4>សរុបបញ្ជី</td>
                        </tr>
                        <tr>
                            <td class="kh14-b" style="color:blue;">ដុល្លា</td>
                            <td class="kh14-b" style="color:blue;">បាត</td>
                            <td class="kh14-b" style="color:blue;">រៀល</td>
                            <td class="kh14-b" style="color:blue;">ដុង</td>
                            <td class="kh14-b" style="color:red;">ដុល្លា</td>
                            <td class="kh14-b" style="color:red;">បាត</td>
                            <td class="kh14-b" style="color:red;">រៀល</td>
                            <td class="kh14-b" style="color:red;">ដុង</td>
                            <td class="kh14-b" style="color:black;">ដុល្លា</td>
                            <td class="kh14-b" style="color:black;">បាត</td>
                            <td class="kh14-b" style="color:black;">រៀល</td>
                            <td class="kh14-b" style="color:black;">ដុង</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $usd=0;
                            $thb=0;
                            $khr=0;
                            $vnd=0;

                        @endphp
                        @foreach ($allpartnerlists as $key=>$d)

                            <tr>
                                <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh12-b">{{ $d->customer->name }}</td>
                                <td class="kh12-b" style="text-align:right;color:blue;">{{ phpformatnumber($d->usd) . '$'}}</td>
                                <td class="kh12-b" style="text-align:right;color:blue;">{{ phpformatnumber($d->thb) .'B'}}</td>
                                <td class="kh12-b" style="text-align:right;color:blue;">{{ phpformatnumber($d->khr) .'R'}}</td>
                                <td class="kh12-b" style="text-align:right;color:blue;">{{ phpformatnumber($d->vnd) .'V'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($d->usd1) . '$'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($d->thb1) .'B'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($d->khr1) .'R'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($d->vnd1) .'V'}}</td>
                                <td class="kh12-b" style="text-align:right;color:black;">{{ phpformatnumber($d->usd+$d->usd1) . '$'}}</td>
                                <td class="kh12-b" style="text-align:right;color:black;">{{ phpformatnumber($d->thb+$d->thb1) .'B'}}</td>
                                <td class="kh12-b" style="text-align:right;color:black;">{{ phpformatnumber($d->khr+$d->khr1) .'R'}}</td>
                                <td class="kh12-b" style="text-align:right;color:black;">{{ phpformatnumber($d->vnd+$d->vnd1) .'V'}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-title">
                    <h1 class="kh32-b" style="text-align:center;">មុនទូទាត់</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered tbl_total kh22-b" style="width:50%">
                            <tr style="background-color:azure">
                                <td class="kh22-b" style="text-align:center">សរុបបើកនៅខាងយើង</td>
                            </tr>

                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tusd) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($totalwe->tbat) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber1($totalwe->tkhr,0) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber1($totalwe->tvnd,0) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered tbl_total" style="width:50%">
                            <tr style="background-color:azure">
                                <td class="kh22-b" style="text-align:center">សរុបបើកនៅខាងគេ</td>
                            </tr>

                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tusd1) . ' USD' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber($totalthey->tbat1) . ' THB' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber1($totalthey->tkhr1,0) . ' KHR' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="kh22-b" style="text-align:right;">
                                    {{ phpformatnumber1($totalthey->tvnd1,0) . ' VND' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-title">
                    <h1 class="kh32-b" style="text-align:center;">ក្រោយទូទាត់</h1>
                </div>
                <div class="card-body">
                    <div class="row">

                            @php
                                $usd1=0;
                                $thb1=0;
                                $khr1=0;
                                $vnd1=0;
                                $usd2=0;
                                $thb2=0;
                                $khr2=0;
                                $vnd2=0;
                                $lasttotal->usd<0?$usd1=$lasttotal->usd:$usd2=$lasttotal->usd;
                                $lasttotal->thb<0?$thb1=$lasttotal->thb:$thb2=$lasttotal->thb;
                                $lasttotal->khr<0?$khr1=$lasttotal->khr:$khr2=$lasttotal->khr;
                                    $lasttotal->vnd<0?$vnd1=$lasttotal->vnd:$vnd2=$lasttotal->vnd;
                            @endphp

                            <table class="table table-bordered tbl_total kh22-b" style="width:50%">
                                <tr style="background-color:azure">
                                    <td class="kh22-b" style="text-align:center">នៅខ្វះខាងយើង</td>
                                </tr>

                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber($usd1) . ' USD' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber($thb1) . ' THB' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber1($khr1,0) . ' KHR' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber1($vnd1,0) . ' VND' }}
                                    </td>
                                </tr>
                            </table>

                            <table class="table table-bordered tbl_total" style="width:50%">
                                <tr style="background-color:azure">
                                    <td class="kh22-b" style="text-align:center">នៅខ្វះខាងគេ</td>
                                </tr>

                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber($usd2) . ' USD' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber($thb2) . ' THB' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber1($khr2,0) . ' KHR' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh22-b" style="text-align:right;">
                                        {{ phpformatnumber1($vnd2,0) . ' VND' }}
                                    </td>
                                </tr>
                            </table>

                    </div>
                </div>
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
