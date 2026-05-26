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
            size: A4;
            margin:10mm 25px 50px 25px;

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
          border:1px solid black;
          word-wrap: break-word;
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
                            <td class="kh18-b" style="">{{ $rpttitle }}</td>
                            <td class="kh18-b" style="text-align:right;">{{ $datestr }}</td>
                            <td class="kh16-b" style="text-align:right;">ព្រីនដោយ {{ $printby }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:-10px;">
            <div class="table-responsive">
                <table id="tbl_all_partnerlist" class="table table-bordered table-striped kh22" style="table-layout:fixed;">
                    <thead style="text-align:center;" >
                        <tr>
                            <td class="kh16-b" rowspan=2 style="width:40px;">លរ</td>
                            <td class="kh16-b" rowspan=2>ឈ្មោះដៃគូ</td>
                            <td class="kh16-b" colspan=4 style="color:blue;border-right:2px solid green;">នៅខ្វះយើង</td>
                            <td class="kh16-b" colspan=4 style="color:red">នៅខ្វះគេ</td>

                        </tr>
                        <tr>
                            <td class="kh14-b" style="color:blue;">ដុល្លា</td>
                            <td class="kh14-b" style="color:blue;">បាត</td>
                            <td class="kh14-b" style="color:blue;">រៀល</td>
                            <td class="kh14-b" style="color:blue;border-right:2px solid green;">ដុង</td>
                            <td class="kh14-b" style="color:red;">ដុល្លា</td>
                            <td class="kh14-b" style="color:red;">បាត</td>
                            <td class="kh14-b" style="color:red;">រៀល</td>
                            <td class="kh14-b" style="color:red;">ដុង</td>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $usd=0;
                            $thb=0;
                            $khr=0;
                            $vnd=0;
                            $usd1=0;
                            $thb1=0;
                            $khr1=0;
                            $vnd1=0;
                            $usd2=0;
                            $thb2=0;
                            $khr2=0;
                            $vnd2=0;
                        @endphp
                        @foreach ($allpartnerlists as $key=>$d)

                            @php
                                if($d->usd+$d->usd1>=0){
                                    $usd1=0;
                                    $usd2=$d->usd+$d->usd1;
                                }else{
                                  $usd2=0;
                                  $usd1=$d->usd+$d->usd1;
                                }
                                if($d->thb+$d->thb1>=0){
                                    $thb1=0;
                                    $thb2=$d->thb+$d->thb1;
                                }else{
                                  $thb2=0;
                                  $thb1=$d->thb+$d->thb1;
                                }
                                if($d->khr+$d->khr1>=0){
                                    $khr1=0;
                                    $khr2=$d->khr+$d->khr1;
                                }else{
                                  $khr2=0;
                                  $khr1=$d->khr+$d->khr1;
                                }
                                if($d->vnd+$d->vnd1>=0){
                                    $vnd1=0;
                                    $vnd2=$d->vnd+$d->vnd1;
                                }else{
                                  $vnd2=0;
                                  $vnd1=$d->vnd+$d->vnd1;
                                }
                            @endphp
                            <tr>
                                <td class="kh12-b" style="text-align:center;width:40px;">{{ ++$key }}</td>
                                <td class="kh12-b" style="width:120px;">{{ $d->customer->name?$d->customer->name:'លុយសល់មិនទាន់បើក' }}</td>
                                <td class="kh12-b" style="text-align:left;color:blue;">{{ phpformatnumber(abs($usd1)) .'$'}}</td>
                                <td class="kh12-b" style="text-align:left;color:blue;">{{ phpformatnumber(abs($thb1)) .'B'}}</td>
                                <td class="kh12-b" style="text-align:left;color:blue;">{{ phpformatnumber(abs($khr1)) .'R'}}</td>
                                <td class="kh12-b" style="text-align:left;color:blue;border-right:2px solid green;">{{ phpformatnumber(abs($vnd1)) .'V'}}</td>

                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($usd2) .'$'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($thb2) .'B'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($khr2) .'R'}}</td>
                                <td class="kh12-b" style="text-align:right;color:red;">{{ phpformatnumber($vnd2) .'V'}}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <table class="table">
              <tr>
                <td style="width:50%;border-style:none;">
                  <div class="card" style="border:none;">
                    <div class="card-title">
                        <h1 class="kh16-b" style="text-align:center;padding:0px;">មុនទូទាត់</h1>
                    </div>
                    <div class="card-body" style="margin-top:-20px;">
                        <div class="row">
                            <table class="table table-bordered tbl_total kh16-b" style="width:50%">
                                <tr style="background-color:azure">
                                    <td class="kh16-b" style="text-align:center;padding:0px;">សរុបបើកនៅខាងយើង</td>
                                </tr>

                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber(abs($totalwe->tusd)) . ' $' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber(abs($totalwe->tbat)) . ' B' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber1(abs($totalwe->tkhr),0) . ' R' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber1(abs($totalwe->tvnd),0) . ' D' }}
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered tbl_total" style="width:50%">
                                <tr style="background-color:azure">
                                    <td class="kh16-b" style="text-align:center;padding:0px;">សរុបបើកនៅខាងគេ</td>
                                </tr>

                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber($totalthey->tusd1) . ' $' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber($totalthey->tbat1) . ' B' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber1($totalthey->tkhr1,0) . ' R' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                        {{ phpformatnumber1($totalthey->tvnd1,0) . ' D' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                  </div>
                </td>
                <td style="width:50%;border-style:none;">
                  <div class="card" style="border:none;">
                    <div class="card-title">
                        <h1 class="kh16-b" style="text-align:center;padding:0px;">ក្រោយទូទាត់</h1>
                    </div>
                    <div class="card-body" style="margin-top:-20px;">
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

                                <table class="table table-bordered tbl_total kh16-b" style="width:50%">
                                    <tr style="background-color:azure">
                                        <td class="kh16-b" style="text-align:center;padding:0px;">នៅខ្វះខាងយើង</td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber(abs($usd1)) . ' $' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber(abs($thb1)) . ' B' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber1(abs($khr1),0) . ' R' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber1(abs($vnd1),0) . ' D' }}
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-bordered tbl_total kh16-b" style="width:50%">
                                    <tr style="background-color:azure">
                                        <td class="kh16-b" style="text-align:center;padding:0px;">នៅខ្វះខាងគេ</td>
                                    </tr>

                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber($usd2) . ' $' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber($thb2) . ' B' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber1($khr2,0) . ' R' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;padding:0px 3px;">
                                            {{ phpformatnumber1($vnd2,0) . ' D' }}
                                        </td>
                                    </tr>
                                </table>

                        </div>
                    </div>
                </div>
                </td>
              </tr>
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
