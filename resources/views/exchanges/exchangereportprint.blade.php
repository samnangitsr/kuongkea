<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exchange report print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    @page{size: A4;margin:10px 10px 0px 20px;}
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
        .en12-b{
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;
            font-weight:bold;
        }
        .en12{
            font-family: Arial, Helvetica, sans-serif;
            font-size:12px;
        }
        .kh10-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
            font-weight:bold;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:rgb(111, 111, 114);
        }
        #tbl_exchange th{
          padding:1px;
        }
        #tbl_exchange td{
          /* padding:1px; */
        }
        td.exchange{
          font-family:Tahoma;
          font-size:14px;
        }
        td.exchangecur{
          font-family:Tahoma;
          font-size:16px;
          /* font-weight: bold; */
          padding:0px;
          border-style:none none dotted none;
          /* border-color:black; */
          border-width: 1px;
        }
        td.exchange1{
          font-family:Tahoma;
          font-size:14px;
          /* font-weight: bold; */
          padding:0px 0px 0px 0px;
          border-style:none none dotted none;
          /* border-color:black; */
          border-width: 1px;
        }
        td.exchange2{
          font-family:Tahoma;
          font-size:14px;
          /* border-top:1px solid black;
          border-bottom:none; */
          border:1px dashed black;

          padding:0px;
          font-weight:bold;
        }
        .exchange2{
          font-family:Tahoma;
          font-size:14px;
          /* border-top:1px solid black;
          border-bottom:none; */
          //border:1px dashed black;

          padding:0px;
          font-weight:bold;
        }
        .sup{
          font-family:Tahoma;
          font-size:8px;
          font-weight:bold;
        }
        th,td{
            color:black;
        }
        #tblexchangelist th{
            padding:3px;
        }
        #tblexchangelist td{
            padding:3px;
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
        <div class="row" style="margin-top:10px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ config('helper.asset_path') }}/logo/{{ $logo->logo }}" alt="" style="width:32px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:22px;padding:0px;">{{ $logo->name }}</td>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ config('helper.asset_path') }}/logo/{{ $logo->logo }}" alt="" style="width:32px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0%;text-align:center;"></td>
                        <td style="width:0%;text-align:center;"></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:100%;text-align:center;font-family:khmer os muol light;font-size:12px;padding:0px;">{{ $logo->subname }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table  style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh14-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->tel }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh14-b" style="width:100%;text-align:center;padding:0px;">{{ $logo->address }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin:0px;">
            <table class="table">
                <tr>
                    <td class="kh16-b" style="border-style:none;">{{ $rpttitle . '(' . $type . ')'  }}</td>
                    <td class="kh16-b" style="text-align:center;border-style:none;">{{ $username }}</td>
                    <td class="kh16-b" style="text-align:right;border-style:none;">{{ $d1d2 }}</td>
                </tr>
            </table>
        </div>
        <div class="row" style="margin-top:-10px">

                <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh12" style="">
                    <thead style="text-align:center;">
                        <th style="width:75px;">N <sup>o</sup></th>
                        <th style="width:100px;">Date</th>
                        <th style="width:80px;">Time</th>
                        <th style="width:150px;">By</th>
                        <th style="width:100px;">Exchange</th>
                        <th style="width:170px;">Buy</th>
                        <th style="width:150px;">Rate</th>
                        <th style="width:170px;">Sale</th>

                    </thead>
                    <tbody id="bodyexchangelist">

                        @foreach ($exchangelists as $key=>$e)
                            <tr id="tr_object_id_{{ $e->mapcode }}">
                                <td class="en12" style="text-align:center;">{{ ++$key }}</td>
                                <td class="en12-b">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                <td class="en12-b">{{ $e->tt }}</td>
                                <td class="en12-b">{{ $e->user->name }}</td>
                                <td class="en12-b" style="text-align:center;">{{ $e->curbuy . '-' . $e->cursale }}</td>
                                <td class="en12-b" style="text-align:right;color:blue;">+{{ phpformatnumber($e->buy) . ' ' . $e->curbuy }}</td>
                                <td class="en12-b" style="text-align:center;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">{{ $e->rate }}</td>
                                <td class="en12-b" style="text-align:right;color:red;">-{{ phpformatnumber($e->sale) . ' ' . $e->cursale }}</td>


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
