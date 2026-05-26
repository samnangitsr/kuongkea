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
        #tblheader td{
            border-style:none;
        }
        td.totalrow{
            text-align:right;
            font-weight:bold;
            font-size:16px;
            font-family:'Noto Sans Khmer', sans-serif;
        }
        td.amountrow{
            text-align:right;
            font-size:12px;
            font-weight:bold;
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
@endphp
<body>
    <div id="invoice-pos">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tblheader" class="table">
                        <tr>
                            <td style="font-size:22px;">{{ $rpttitle }}</td>
                            <td style="font-size:22px;text-align:right;">{{ $datestr }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table id="tbl_all_partnerlist" class="table table-bordered table-striped">
                    <thead style="text-align:center;font-size:16px;">
                        <th>លរ</th>
                        <th>ឈ្មោះដៃគូ</th>
                        <th>ដុល្លា</th>
                        <th>បាត</th>
                        <th>រៀល</th>
                        <th>ដុង</th>
                        <th>គិតជាដុល្លា</th>
                    </thead>
                    <tbody>
                        @php
                            $usd=0;
                            $thb=0;
                            $khr=0;
                            $vnd=0;

                        @endphp
                        @foreach ($allpartnerlists as $key=>$d)

                            @php
                                $khr_usd=array(0,0,'/');
                                $thb_usd=array(0,0,'/');
                                $vnd_usd=array(0,0,'/');
                                if($d->khr!=0){
                                    $khr_usd=App\AllPartnerList::exchangetousd($d->khr,'KHR');
                                }
                                if($d->thb!=0){
                                    $thb_usd=App\AllPartnerList::exchangetousd($d->thb,'THB');
                                }
                                if($d->vnd!=0){
                                    $vnd_usd=App\AllPartnerList::exchangetousd($d->vnd,'VND');
                                }
                                $inusd=$d->usd+$khr_usd[0]+$thb_usd[0]+$vnd_usd[0];
                                $usd+=$d->usd;
                                $thb+=$d->thb;
                                $khr+=$d->khr;
                                $vnd+=$d->vnd;
                            @endphp
                            <tr>
                                <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh12-b">{{ $d->customer->name?$d->customer->name:'លុយសល់មិនទាន់បើក' }}</td>
                                <td class="amountrow">{{ phpformatnumber($d->usd) . '$'}}</td>
                                <td class="amountrow">{{ phpformatnumber($d->thb) .'B'}}</td>
                                <td class="amountrow">{{ phpformatnumber($d->khr) .'R'}}</td>
                                <td class="amountrow">{{ phpformatnumber($d->vnd) .'V'}}</td>
                                <td class="amountrow">{{ phpformatnumber($inusd) .'$'}}</td>
                            </tr>
                        @endforeach
                        @php
                            $khr_usd=array(0,0,'/');
                            $thb_usd=array(0,0,'/');
                            $vnd_usd=array(0,0,'/');
                                if($khr!=0){
                                    $khr_usd=App\AllPartnerList::exchangetousd($khr,'KHR');
                                }
                                if($thb!=0){
                                    $thb_usd=App\AllPartnerList::exchangetousd($thb,'THB');
                                }
                                if($vnd!=0){
                                    $vnd_usd=App\AllPartnerList::exchangetousd($vnd,'VND');
                                }
                                $inusd=$usd+$khr_usd[0]+$thb_usd[0]+$vnd_usd[0];
                        @endphp
                        <tr style="background-color:beige;">
                            <td class="kh16-b" colspan=2>សរុប</td>
                            <td class="totalrow">{{ phpformatnumber($usd) .'$'}}</td>
                            <td class="totalrow">{{ phpformatnumber($thb) .'B'}}</td>
                            <td class="totalrow">{{ phpformatnumber($khr) .'R'}}</td>
                            <td class="totalrow">{{ phpformatnumber($vnd) .'V'}}</td>
                            <td class="totalrow">{{ phpformatnumber($inusd) .'$'}}</td>
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
