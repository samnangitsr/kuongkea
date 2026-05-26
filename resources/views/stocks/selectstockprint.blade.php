<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Print</title>
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
          padding:1px;
        }
        .exchange1{
          font-family:Arial, Helvetica, sans-serif;
          font-size:16px;
          font-weight:bold;
        }
        .exchange2{
          font-family:Arial, Helvetica, sans-serif;
          font-size:12px;
          font-weight:bold;
        }
        .sup{
          font-family:Arial, Helvetica, sans-serif;
          font-size:8px;
          font-weight:bold;
        }
        th,td{
            color:black;
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
        {{-- <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:32px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:22px;padding:0px;">{{ $logo->name }}</td>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:32px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0%;text-align:center;"></td>
                        <td style="width:0%;text-align:center;"></td>
                    </tr>

                </table>
            </div>
        </div> --}}
        {{-- <div class="row">
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
        </div> --}}

        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;text-decoration:underline;">{{ $logo->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table" style="width:100%;overflow:hidden">
                    <tr class="kh10-b">
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">អ្នកកត់ត្រា</td>
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">ថ្ងៃកត់ត្រា</td>
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">ម៉ោង</td>
                        <td style="width:25%;padding:0px 5px 0px 0px;text-align:right;border-style:none;">លេខវិ.</td>

                    </tr>
                    <tr class="kh10-b">
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">{{ $stockprints[0]->printby }}</td>
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">{{ date('d-m-Y',strtotime($stockprints[0]->created_at)) }}</td>
                        <td style="width:25%;padding:0px 0px 0px 5px;border-style:none;">{{ date('h-i-s',strtotime($stockprints[0]->created_at)) }}</td>
                        <td style="width:25%;padding:0px 5px 0px 0px;text-align:right;border-style:none;">{{ sprintf('%04d',$stockprints[0]->id) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table id="tbl_exchange" class="table table-bordered" style="margin:0px;">
                  <tr class="kh16" style="text-align:center;">
                    <td style="width:30px;">លរ</td>
                    <td style="">ចំនួនទឹកប្រាក់</td>
                    <td style="width:80px;">រូបិយប័ណ្ណ</td>
                  </tr>
                    <tbody>
                        @foreach ($stockprints as $key=>$item)
                            <tr class="">
                                <td class="" style="width:30px;text-align:center;font-size:16px;">{{ ++$key }} </td>

                                <td class="exchange1" style="text-align:right;">
                                 {{ phpformatnumber($item->amtstock) }}
                                </td>
                                <td class="kh16" style="width:80px;padding-left:10px;">{{ $item->cur }} </td>
                            </tr>

                        @endforeach

                    </tbody>


                </table>
            </div>

            {{-- <hr>
            <div class="legalcopy" style="margin-top:-30px;">
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
