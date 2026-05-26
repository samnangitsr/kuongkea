<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrintNotyetCashdraw</title>
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
            color:black;
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
            .kh32{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:32px;
            color:black;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        #tbl_partner_transfer tr td{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            color:black;
            padding:2px 5px 2px 5px;
            word-wrap: break-word;
        }
        #tbl_partner_transfer thead th{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            color:black;
            padding:2px;
            text-align:center;
        }
        #tbl_partner_transfer{
          border:1px solid black;
          table-layout:fixed;
          width:100%;
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
    <div id="report">
        <div class="row" style="margin-left:5px;">
            <table>
                <tr>
                    <td class="kh22-b">{{ $rpttitle }}</td>
                    <td class="kh22-b" style="float:right;">{{ $ddd }}</td>
                </tr>
            </table>
        </div>
        <div class="row" style="margin-top:20px;">
                <div class="table-responsive">
                    <table id="tbl_partner_transfer" class="table table-bordered kh16">
                        <thead class="">
                            <th style="width:60px;">លរ</th>

                            <th style="width:80px;">ថ្ងៃទី</th>
                            <th style="width:80px;">ម៉ោង</th>
                            <th style="width:80px;">អ្នកកត់ត្រា</th>
                            {{-- <th>ប្រតិបត្តិការណ៏</th> --}}
                            <th>ឈ្មោះដៃគូ</th>
                            {{-- <th>អតិថិជន</th> --}}
                            <th>ចំនួនទឹកប្រាក់</th>
                            <th style="width:80px;">សេវ៉ាវេរ</th>
                            <th style="width:80px;">សេវ៉ាដៃគូ</th>
                            <th>ពត៌មានអតិថិជន</th>
                            <th>ផ្សេងៗ</th>


                        </thead>
                        <tbody id="bodytransfer">
                            @foreach ($data as $key => $d)
                                    <tr class="rowclick">
                                        <td style="text-align:center;">{{ ++$key }}</td>

                                        <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                                        <td>{{ $d->tt }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        {{-- <td>{{ $d->tranname }}</td> --}}
                                        <td>
                                            @if($d->child)
                                                {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                                            @else
                                                {{ $d->partner->name }}
                                            @endif

                                        </td>
                                        {{-- <td>{{ $d->customer->name }}</td> --}}
                                        <td class="kh18" style="text-align:right;">
                                            {{ phpformatnumber($d->amount)  . $d->currency->sk }}
                                        </td>
                                        <td class="kh18" style="text-align:right;">
                                            {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->sk }}
                                        </td>
                                        <td class="kh18" style="text-align:right;">
                                            {{ phpformatnumber($d->fee) . $d->feecurrency->sk }}
                                        </td>
                                        <td>
                                            @php
                                                $info1='';
                                                $info2='';
                                                if($d->recname){
                                                    $info1='អ្នកទទួល:' . $d->recname;
                                                }
                                                if($d->rectel){
                                                    if($info1==''){
                                                        $info1='អ្នកទទួល' . $d->rectel;
                                                    }else{
                                                        $info1=$info1 . ' ' . $d->rectel;
                                                    }
                                                }
                                                if($d->sendername){
                                                    $info2='អ្នកផ្ញើ:' . $d->sendername;
                                                }
                                                if($d->sendertel){
                                                    if($info2==''){
                                                        $info2='អ្នកផ្ញើ' . $d->sendertel;
                                                    }else{
                                                        $info2=$info2 . ' ' . $d->sendertel;
                                                    }
                                                }
                                            @endphp

                                        {{ $info1 }} <br> {{ $info2 }}
                                        </td>
                                        <td>{{ $d->note }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

</body>
<script type="text/javascript">

    printContent('report');
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
