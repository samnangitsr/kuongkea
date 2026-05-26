<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserCloseList</title>
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

    @php
        $usdin=0;
        $usdout=0;
    @endphp
    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td class="kh22-b" style="padding:0px;border-style:none;">
                       របាយការណ៏បិទបញ្ជីបុគ្គលិក {{ $title['user'] }}
                    </td>
                    <td class="kh22-b" style="padding:0px;border-style:none;text-align:right;">
                       {{ $title['date'] }}
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <table class="table table-bordered table-striped tbl_userreport">
        <thead class="" style="text-align:center;font-family:'Noto Sans Khmer', sans-serif;font-size:14px;">
             <th>លរ</th>
             <th>រូបិយប័ណ្ណ</th>
             <th>លុយដើមគ្រា</th>
             <th>ទិញចូល</th>
             <th>លក់ចេញ</th>
             <th>លុយដាក់</th>
             <th>លុយដក</th>
             <th>ដកចុងគ្រា</th>
             {{-- <th>ខ្វះគេ</th>
             <th>គេខ្វះ</th> --}}
             <th>សមតុល្យ</th>

        </thead>
        @php
            $pl=0;
        @endphp
        <tbody>
            @foreach ($report as $key=>$r)
                @php
                    $usdin =$usdin + $r->amtsale;
                    $usdout=$usdout + $r->amtbuy;
                    $total_main=$r->capital + $buysaleusd->tbuy + $buysaleusd->tsale + abs($acc->accpay) - $acc->accrec + $r->cashin + $r->cashout+$r->capitalend;
                    $total=$r->capital + $r->buyin + $r->saleout + $r->cashin + $r->cashout+$r->capitalend;
              @endphp
            @if($r->currency->ismain==1)
                @php
                    $pl=$total_main;
                @endphp
                <tr style="">
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td class="kh16-b" style="">{{ $r->currency->curname }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->capital) . ' USD' }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($buysaleusd->tbuy) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($buysaleusd->tsale) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->cashin) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->cashout) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->capitalend) }}</td>
                    {{-- <td style="text-align:right;text-align:right;color:red">{{ phpformatnumber(abs($acc->accpay)) }}</td>
                    <td style="text-align:right;color:blue;">{{ phpformatnumber($acc->accrec) }}</td> --}}
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($total_main) . ' USD'}}</td>
                </tr>
            @else
                @php
                    $totalinusd =App\UserReport::exchangetousd($total,$r->currency_id,$r->viewdate);
                    //dd($totalinusd[1]);
                    $pl+=$totalinusd[0];
                @endphp
                <tr class="">
                    <td style="text-align:center;">{{ ++$key }}</td>
                    <td class="kh16-b" style="">{{ $r->currency->curname }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->capital) . ' ' . $r->currency->shortcut  }}</td>
                    <td class="kh16-b" style="text-align:right;">
                        {{ phpformatnumber($r->buyin) }} <br>
                        <span class="badge bg-secondary">{{ phpformatnumber($r->amtbuy) . '$' }}</span>
                    </td>
                    <td class="kh16-b" style="text-align:right;">
                        {{ phpformatnumber($r->saleout) }} <br>
                        <span class="badge bg-secondary">+{{ phpformatnumber($r->amtsale) . '$' }}</span>
                    </td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->cashin) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->cashout) }}</td>
                    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($r->capitalend) }}</td>
                    {{-- @if($r->currency->isexchangecur==0)
                        <td style="text-align:right;text-align:right;color:red">{{ phpformatnumber(abs($acc->accpay)) }}</td>
                        <td style="text-align:right;color:blue;">{{ phpformatnumber($acc->accrec) }}</td>
                    @else
                        <td style="text-align:right;">0</td>
                        <td style="text-align:right;">0</td>
                    @endif --}}

                    <td class="kh16-b" style="text-align:right;"><span style="font-weight:bold;">{{ phpformatnumber($total) . ' ' . $r->currency->shortcut }}</span> <br>
                        {{ $totalinusd[2] . $totalinusd[1]. '='. phpformatnumber($totalinusd[0]) . ' USD' }}
                    </td>
                </tr>
            @endif
         @endforeach
         <tr style="background-color:rgb(234, 234, 181)">
            <td colspan=8 class="kh22-b">ប្រាក់ចំណេញ</td>
            <td style="text-align:right;" class="kh22-b">{{ phpformatnumber($pl) . ' USD' }}</td>

         </tr>
        </tbody>
     </table>



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
