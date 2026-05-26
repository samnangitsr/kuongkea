<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashdrawPrint</title>
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
            color:black;
            }
          .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            color:black;
            font-weight:bold;
            }
        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            color:black;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            color:black;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            color:black;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            color:black;
            }
        .kh28{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:28px;
            color:black;
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
            color:black;
        }
        table td.shrink {
            white-space:nowrap
        }
        table td.expand {
            width: 99%
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
        #tbl_body td{
          border:1px solid black;
          padding:5px;
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
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:100%;text-align:center;padding:0px;">{{ $logo->tel }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh10" style="width:100%;text-align:center;padding:0px;">{{ $logo->address }}</td>
                    </tr>
                </table>
            </div>
        </div> --}}
        <div class="row">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh22-b" style="width:100%;text-align:center;padding:0px;">បង្កាន់ដៃបើកវេរ</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table id="tbl_header" class="table" style="width:100%;overflow:hidden">
                    <tr>
                        <td class="kh12-b"  style="width:20%;padding:0px;">លេខវិ.</td>
                        <td class="kh12-b" colspan=3 style="width:80%;padding:0px;">{{ $cashdrawslips[0]->ref_number }}</td>
                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;">ថ្ងៃទី</td>
                        <td class="kh12-b" style="width:30%;padding:0px;">{{ date('d-m-Y',strtotime($cashdrawslips[0]->dd))}}</td>
                        <td class="kh12-b" style="width:20%;padding:0px;">ម៉ោង</td>
                        <td class="kh12-b" style="width:30%;padding:0px;">{{ $cashdrawslips[0]->tt }}</td>
                    </tr>
                    <tr>
                        <td class="kh12-b" style="width:20%;padding:0px;">ចេញដោយ</td>
                        <td class="kh12-b" colspan=3 style="width:80%;padding:0px 0px 0px 0px;">{{ $cashdrawslips[0]->printby }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:-10px;">
            <div class="table-responsive">
                <table id="tbl_body" class="table table-bordered" style="">
                    <tbody>
                        @foreach ($cashdrawslips as $item)
                            @if($item->title=='ប្តូរប្រាក់')
                                <td colspan=2 style="text-align:center;text-decoration: underline;" class="kh22-b">
                                    {{ $item->title }}
                                </td>
                            @endif
                            <tr>
                                @if($item->title=='ប្តូរប្រាក់')
                                    <td class="kh16-b" style="text-align:right;" colspan=2 class="kh16-b">
                                       {{ $item->quote }}
                                    </td>
                                @else
                                    <td class="kh16-b">{{ $item->title }}</td>
                                    @if($item->isnumber==1)
                                        <td style="text-align:right;" class="kh16-b">{{ $item->quote }}</td>
                                    @else
                                        <td style="text-align:right;" class="kh16-b">{{ $item->quote }}</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin-left:0px;">
                @if($cashin->count())
                    <table id="tbl_cashin" class="table">
                        <th class="kh16-b">លុយត្រូវយកពីអតិថិជន</th>
                        @foreach ($cashin as $ci)
                            <tr>
                                <td class="kh22-b">{{ phpformatnumber($ci->tamt) .' '. $ci->curname }}</td>

                            </tr>
                        @endforeach
                    </table>
                @endif
               @if($cashout->count())
                    <table id="tbl_cashout" class="table">
                        <th style="" class="kh16-b">លុយត្រូវប្រគល់អោយអតិថិជន</th>
                        @foreach ($cashout as $co)
                            <tr>
                                <td class="kh22-b">{{ phpformatnumber(abs($co->tamt)) . ' ' .  $co->curname }}</td>

                            </tr>
                        @endforeach
                    </table>
               @endif
            </div>
            <hr>
            <div class="legalcopy" style="margin-top:-30px;">
                <p class=""legal>
                    <p style="font-family:Noto Sans Khmer,sans-serif;font-size:12px;text-align:center;color:black;font-weight:bold;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
                        ** Thank you for your visiting **
                    </p>

                </p>
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
