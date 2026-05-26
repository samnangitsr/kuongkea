<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PartnerReport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css" media="print">

    @page{size: A4;margin:15px;}
    @media print {
        html, body {
            width: 210mm;
        }
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
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
        .amt{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        .total{
            text-align:right;
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        #tbl_partner_list td{
          padding:2px;
        }
        #tbl_partner_list th{
          padding:2px;
        }
        .cblue{
          color:blue;
        }
        .cred{
          color:red;
        }
        #tbl_partner_list td{
            border:1px solid black;
        }
          #tbl_partner_list th{
            border:1px solid black;
        }
         #tbl_before td{
            padding:2px 5px;
            border:1px solid black;
        }
         #tbl_after td{
            padding:2px 5px;
            border:1px solid black;
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
    $tusd=0;
    $tkhr=0;
    $tthb=0;
    $tvnd=0;
@endphp
<body>
    <div id="invoice-pos">
        <div class="pagebreak" style="margin-top:20px;">
            <div class="row" style="margin:-10px 5px 10px 5px;">
              <table>
                  <tr>
                      <td class="kh16-b">របាយការណ៏ បញ្ជី ជាមួយដៃគូ {{ $partnername }}</td>
                      @if($alldate=='true')
                      <td class="kh16-b" style="float:right;">គិតត្រឹមថ្ងៃ {{ date('d-m-Y',strtotime($d2)) }}</td>
                      @else
                      <td class="kh16-b" style="float:right;">គិតពី {{ date('d-m-Y',strtotime($d1)) }} ដល់ {{ date('d-m-Y',strtotime($d2)) }}</td>
                      @endif

                  </tr>
              </table>
            </div>
            <div class="" style="">
                <div class="table-responsive">
                    <table id="tbl_partner_list" class="" style="">
                        <thead style="text-align:center;" class="kh14">
                            <th style="padding:0px;width:60px;">លរ</th>
                            <th style="padding:0px;width:110px;">ថ្ងៃទី</th>
                            <th style="padding:0px;width:80px;">ម៉ោង</th>
                            <th style="padding:0px;width:200px;">ប្រតិបត្តិការណ៏</th>
                            <th style="padding:0px;width:120px;">USD</th>
                            <th style="padding:0px;width:120px;">KHR</th>
                            <th style="padding:0px;width:120px;">THB</th>
                            @if(config('helper.col_vnd') == 1)
                                <th style="padding:0px;width:150px;">VND</th>
                            @endif
                            {{-- <th style="padding:0px;">ផ្សេងៗ</th> --}}
                        </thead>
                        <tbody id="bodytransfer">
                            @foreach ($ptls_new as $key =>$l)
                                @php
                                    $tusd+=$l->usd;
                                    $tkhr+=$l->khr;
                                    $tthb+=$l->thb;
                                    $tvnd+=$l->vnd;
                                @endphp
                                <tr style="">
                                    <td class="kh14" style="text-align:center;padding:0px;width:60px;">{{ ++$key }}</td>

                                    <td class="kh14" style="padding:0px 5px 0px 5px;width:100px;color:black;">{{ date('d-m-Y',strtotime($l->trandate)) }}</td>
                                    <td class="kh14" style="padding:0px 5px 0px 5px;width:80px;color:black;">{{ $l->trantime }}</td>

                                    <td class="kh14" style="padding:0px 5px;color:black;">
                                        @if($l->amount>0)
                                            {{ $l->tranname }} ({{ $l->rectel}})
                                        @else
                                            {{ $l->tranname }} ({{ $l->sendertel}})
                                        @endif
                                    </td>
                                    <td style="text-align:right;padding:0px 3px;width:150px;" class="kh14-b @if($l->usd>0) cred @else cblue @endif"> {{ $l->usd<>0?phpformatnumber(-1 * $l->usd) .'$':'' }}</td>
                                    <td style="text-align:right;padding:0px 3px;width:150px;" class="kh14-b @if($l->khr>0) cred @else cblue @endif">{{ $l->khr<>0?phpformatnumber(-1 * $l->khr) .'R':''}}</td>
                                    <td style="text-align:right;padding:0px 3px;width:150px;" class="kh14-b @if($l->thb>0) cred @else cblue @endif">{{ $l->thb<>0?phpformatnumber(-1 * $l->thb) .'B':''}}</td>
                                    @if(config('helper.col_vnd') == 1)
                                        <td style="text-align:right;padding:0px;width:150px;" class="kh14-b @if($l->vnd>0) cred @else cblue @endif">{{ $l->vnd<>0?phpformatnumber(-1 * $l->vnd) .'D':''}}</td>
                                    @endif
                                    {{-- <td class="kh14" style="padding:0px 0px 0px 5px;">
                                        {{ $l->note }}
                                    </td> --}}
                                </tr>

                            @endforeach
                            <tr style="background-color:rgb(222, 223, 217)">
                                <td colspan=4 class="kh16-b" style="color:black;padding:2px 5px 2px 20px;">សរុប</td>
                                <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh18-b @if($tusd>=0) cred @else cblue @endif">{{ $tusd<>0?phpformatnumber(-1 * $tusd) . '$':'' }}</td>
                                <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh18-b @if($tkhr>=0) cred @else cblue @endif">{{ $tkhr<>0?phpformatnumber(-1 * $tkhr) .'R':''}}</td>
                                <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh18-b @if($tthb>=0) cred @else cblue @endif">{{ $tthb<>0?phpformatnumber(-1 * $tthb) .'B':''}}</td>
                                @if(config('helper.col_vnd') == 1)
                                <td style="text-align:right;padding:2px;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" class="kh18-b @if($tvnd>=0) cred @else cblue @endif">{{ $tvnd<>0?phpformatnumber(-1 * $tvnd) .'D':''}}</td>
                                @endif


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="" style="">
                @php
                    $weusd=0;
                    $wethb=0;
                    $wekhr=0;
                    $wevnd=0;
                    foreach($befortotalwe as $w){
                        if($w->cur=='USD'){
                            $weusd=$w->total;
                        }else if($w->cur=='THB'){
                            $wethb=$w->total;
                        }else if($w->cur=='KHR'){
                            $wekhr=$w->total;
                        }else if($w->cur=='VND'){
                            $wevnd=$w->total;
                        }
                    }

                    $theyusd=0;
                    $theythb=0;
                    $theykhr=0;
                    $theyvnd=0;
                    foreach($befortotalthey as $they){
                        if($they->cur=='USD'){
                            $theyusd=$they->total;
                        }else if($they->cur=='THB'){
                            $theythb=$they->total;
                        }else if($they->cur=='KHR'){
                            $theykhr=$they->total;
                        }else if($they->cur=='VND'){
                            $theyvnd=$they->total;
                        }
                    }
                @endphp
                @php
                    $usd1=0;
                    $thb1=0;
                    $khr1=0;
                    $vnd1=0;
                    $usd2=0;
                    $thb2=0;
                    $khr2=0;
                    $vnd2=0;
                    foreach($aftertotal as $a){
                        if($a->cur=='USD'){
                            if($a->total>0){
                                $usd2=$a->total;
                            }else{
                                $usd1=$a->total;
                            }

                        }else if($a->cur=='THB'){
                            if($a->total>0){
                                $thb2=$a->total;
                            }else{
                                $thb1=$a->total;
                            }
                        }else if($a->cur=='KHR'){
                            if($a->total>0){
                                $khr2=$a->total;
                            }else{
                                $khr1=$a->total;
                            }
                        }else if($a->cur=='VND'){
                            if($a->total>0){
                                $vnd2=$a->total;
                            }else{
                                $vnd1=$a->total;
                            }
                        }
                    }
                @endphp
                <table class="table" style="padding:0px;margin:0px;">
                    <tr>
                        <td style="width:50%;border-style:none;">
                            <table id="tbl_before" class="table">
                                <tr>
                                    <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">មុនទូទាត់</td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:center;width:50%;">បើកនៅ {{ $logo->name }}</td>
                                    <td class="kh18-b" style="text-align:center;width:50%;">បើកនៅ {{ $partnername }}</td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($weusd)) . '$' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($theyusd)) . '$' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($wethb)) . 'B' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($theythb)) . 'B' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($wekhr)) . 'R' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($theykhr)) . 'R' }}
                                    </td>
                                </tr>
                                @if(config('helper.col_vnd') == 1)
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;color:blue;">
                                            {{ phpformatnumber(abs($wevnd)) . 'D' }}
                                        </td>
                                        <td class="kh16-b" style="text-align:right;color:red;">
                                            {{ phpformatnumber(abs($theyvnd)) . 'D' }}
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                        <td style="width:50%;border-style:none;">
                            <table id="tbl_after" class="table">
                                <tr>
                                    <td colspan=2 style="font-family:khmer os muol light;text-align:center;font-size:16px;padding:2px;">ក្រោយទូទាត់</td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:center;width:50%;">នៅខ្វះ {{ $logo->name }}</td>
                                    <td class="kh18-b" style="text-align:center;width:50%;">នៅខ្វះ {{ $partnername }}</td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($usd1)) . '$' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($usd2)) . '$' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($thb1)) . 'B' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($thb2)) . 'B' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh18-b" style="text-align:right;color:blue;">
                                        {{ phpformatnumber(abs($khr1)) . 'R' }}
                                    </td>
                                    <td class="kh18-b" style="text-align:right;color:red;">
                                        {{ phpformatnumber(abs($khr2)) . 'R' }}
                                    </td>
                                </tr>
                                @if(config('helper.col_vnd') == 1)
                                    <tr>
                                        <td class="kh16-b" style="text-align:right;color:blue;">
                                            {{ phpformatnumber(abs($vnd1)) . 'D' }}
                                        </td>
                                        <td class="kh16-b" style="text-align:right;color:red;">
                                            {{ phpformatnumber(abs($vnd2)) . 'D' }}
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
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
