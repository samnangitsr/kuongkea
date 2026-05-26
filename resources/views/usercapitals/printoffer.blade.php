<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>offer Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
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
        .kh28{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:28px;
            }
        #tbl_body td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        #tbl_header td{
            padding:0px;
            border-style:none;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">បង្កាន់ដៃស្នើប្រាក់</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table id="tbl_body" class="table" style="">
                    <tbody>
                        <tr>
                            <td style="width:25%">ថ្ងៃស្នើ</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ date('d-m-Y',strtotime($offer->offer_date)) . ' ' .  $offer->offer_time }}</td>
                        </tr>
                         <tr>
                            <td style="width:25%">ប្រភេទស្នើ</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->offer_type }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">គណនីស្នើ</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->customer->name??'' }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">អ្នកស្នើ</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->offerby->name }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">ស្នើទៅ</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->offerto->name }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">ស្នើចំនួន</td>
                            <td style="width:75%;text-align:right;font-weight:bold;font-size:20px;">
                                    {{ phpformatnumber($offer->amount) . $offer->currency->shortcut }}
                            </td>
                        </tr>
                        @if($offer->amount1)
                        <tr>
                            <td style="width:25%">លុយកាត់កង</td>
                            <td style="width:75%;text-align:right;font-weight:bold;font-size:20px;">
                                    {{ phpformatnumber($offer->amount1) . $offer->currency1->shortcut }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%">ប្រភេទកាត់កង</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->offer_type1 }}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">គណនីកាត់កង</td>
                            <td style="width:75%;text-align:right;font-weight:bold;">{{ $offer->customer1->name??'' }}</td>
                        </tr>
                        @endif


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
