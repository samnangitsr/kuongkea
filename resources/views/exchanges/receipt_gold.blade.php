<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Narith</title>
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
        width:80mm;
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
          font-family:Arial, Helvetica, sans-serif;
          font-size:16px;
          font-weight: bold;
          padding:0px;
          /* border-style:none none dotted none; */
          /* border-color:black; */
          border-width: 1px;
        }
        td.exchange2{
          font-family:Arial, Helvetica, sans-serif;
          font-size:16px;
          /* border-top:1px solid black;
          border-bottom:none; */
          /* border:1px dashed black; */

          padding:0px;
          font-weight:bold;
        }
        .exchange2{
          font-family:Arial, Helvetica, sans-serif;
          font-size:14px;
          /* border-top:1px solid black;
          border-bottom:none; */
          /* border:1px dashed black; */

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
        td{
            padding:0px;
            border-style:none;
        }
        #tbl_exchange{
            border:1px solid black;
        }
       #tbl_exchange tbody tr.last-ex {
            border-bottom: 1px solid black !important;
        }
        .tbl_a, .tbl_b {
            table-layout: fixed;
        }

        .tbl_a td, .tbl_b td {
            word-wrap: break-word;     /* break long words */
            white-space: normal;       /* allow wrapping */
        }

        .tbl_b {
            text-align: right;
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
    function convertcurrency($cur)
    {
        if($cur=='USD') return '$';
        if($cur=='KHR') return 'R';
        if($cur=='THB') return 'B';
        return $cur;
    }
@endphp
<body>
    <div id="invoice-pos">
        <div class="row" style="margin-top:0px;">
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

        <div class="row" style="margin:10px 0px;">

                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        @if($exchanges[0]->product>0)
                            <td class="kh16-b" style="width:100%;text-align:center;padding:0px;text-decoration:underline;">{{ $reprint==0?'បង្កាន់ដៃទិញមាស':'ព្រីនឡើងវិញ' }}</td>
                        @else
                            <td class="kh16-b" style="width:100%;text-align:center;padding:0px;text-decoration:underline;">{{ $reprint==0?'បង្កាន់ដៃលក់មាស':'ព្រីនឡើងវិញ' }}</td>
                        @endif
                    </tr>
                </table>

        </div>
        <div class="row" style="margin:0px 5px;">

            <table class="table tbl_a" style="width:55%;">
                <tr class="kh10">
                    <td style="padding:0px;" class="kh12-b">
                        <table class="kh12-b">
                            <tr>
                                <td class="kh12">អតិថិជន</td>
                                <td class="kh12-b" style="padding:0px 2px;"> : </td>
                                <td class="kh12-b">{{ $exchanges[0]->client }}</td>
                            </tr>
                            <tr>
                                <td class="kh12">Tel</td>
                                <td class="kh12-b" style="padding:0px 2px;"> : </td>
                                <td class="kh12-b">{{ $exchanges[0]->phone }}</td>
                            </tr>
                            <tr>
                                <td class="kh12">ផុតកំណត់</td>
                                <td class="kh12-b" style="padding:0px 2px;"> : </td>
                                <td class="kh12-b"> {{ date('d-m-Y', strtotime($exchanges[0]->dd . ' +7 days')) }}</td>
                            </tr>
                            <tr>
                                <td class="kh12">ទូទាត់តាម</td>
                                <td class="kh12-b" style="padding:0px 2px;"> : </td>
                                <td class="kh12-b">{{ $deposit_via }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table class="table tbl_b" style="width:45%;">
                <tr class="kh10">
                    <td class="kh12-b" style="padding:0px;text-align:right;width:40px;">N <sup>o</sup></td>
                    <td class="kh12-b" style="padding:0px 2px;width:10px;">:</td>
                    <td class="kh12-b" style="text-align:right;padding:0px;">{{ sprintf('%04d',$exchanges[0]->id) }}</td>
                </tr>
                <tr>
                     <td class="kh12-b" style="padding:0px;text-align:right;width:40px;">ថ្ងៃទី</td>
                    <td class="kh12-b" style="padding:0px 2px;width:10px;">:</td>
                    <td class="kh12-b" style="text-align:right;padding:0px;">{{ date('d-m-Y',strtotime($exchanges[0]->dd))}}</td>
                </tr>
                <tr class="kh10">
                    <td class="kh12-b" style="padding:0px;text-align:right;">ម៉ោង</td>
                    <td class="kh12-b" style="padding:0px 2px;">:</td>
                    <td class="kh12-b" style="text-align:right;padding:0px;">{{ $exchanges[0]->tt }}</td>
                </tr>
                <tr>
                    <td class="kh12-b" style="width:40px;text-align:right;padding:0px;">បុគ្គ</td>
                    <td class="kh12-b" style="padding:0px 2px;"> : </td>
                    <td class="kh12-b" style="text-align:right;padding:0px;">{{ $exchanges[0]->user->name }}</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin:-10px 5px 0px 5px;">
            <div class="row" style="padding:0px;margin:0px;">
                <table id="tbl_exchange" class="table" style="width:100%;">
                  <thead class="kh12" style="text-align:center;background-color:silver;">
                    <th class="kh12-b" style="">មាស</th>
                    <th class="kh12-b" style="">ហាងឆេង</th>
                    <th class="kh12-b" style="">ប្តូរបាន</th>
                  </thead>
                    <tbody>
                        @php
                            $sign='';
                            $sumproduct=0;
                            $sumamount=0;
                        @endphp
                        @foreach ($exchanges as $key =>$e)
                            @php
                                if(abs($e->product)>abs($e->amount)){
                                    if($e->rate<1){
                                        $sign='*';
                                    }else{
                                        $sign='/';
                                    }
                                }else{
                                    if($e->rate<1){
                                        $sign='/';
                                    }else{

                                        $sign='*';
                                    }
                                }

                            @endphp

                            <tr class="exrow {{ $loop->last ? 'last-ex' : '' }}">

                                <td class="exchange1" style="text-align:center;">
                                    {{ phpformatnumber($e->product) . '' . $e->currency->sk }}
                                    @php
                                        $sumproduct +=floatval($e->product);
                                    @endphp
                                </td>

                                <td class="" style="text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:16px;padding:0px;">
                                    @if($e->goldwater>1)
                                        <span>{{ $sign }}</span>{{ phpformatnumber($e->rate) }} * <span>{{ $e->goldwater }}</span>
                                    @else
                                        <span>{{ $sign }}</span>{{ phpformatnumber($e->rate) }}=
                                    @endif
                                </td>


                                <td class="exchange1" style="text-align:right;">
                                    {{ phpformatnumber($e->amount) . '$' }}

                                </td>

                            </tr>

                        @endforeach
                            <tr>
                                <td></td>
                                <td class="kh16-b" style="padding:0px;">
                                    សរុបទឹកប្រាក់
                                </td>
                                <td style="text-align:right;padding:0px;" class="kh16-b">
                                    {{phpformatnumber($sum_exchange) . '$'}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="kh16-b" style="padding:0px;">
                                    ប្រាក់កក់
                                </td>
                                <td style="text-align:right;padding:0px;" class="kh16-b">
                                    {{phpformatnumber(-1 * $sumdeposit) . '$'}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="kh16-b" style="padding:0px;">
                                    នៅខ្វះ
                                </td>
                                <td style="text-align:right;padding:0px;" class="kh16-b">
                                    {{phpformatnumber(-1 * $balance) . '$'}}
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>


            <div class="legalcopy" style="margin-top:0px;">

                    <p class="kh12-b" style="text-align:center;color:black;">សូមអរគុណចំពោះការអញ្ជើញមក <br>
                        ** Thank you for your visiting **
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
