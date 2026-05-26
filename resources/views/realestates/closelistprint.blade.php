<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depsit Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
   @page {
    size: A4 landscape; /* Set A4 size in landscape mode */

    }

    @media print {
        html, body {
            width: 297mm; /* A4 landscape width */
            height: 210mm; /* A4 landscape height */
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh28{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:28px;
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
        #tbl_exchange td{
          padding:2px;
          border-style:none;
        }

        #tbl_exchange th{
          padding:2px;
          border-style:none;
        }
        #tbl_exchange tr{
          border-style:none;
        }
        td{
            color:black;
        }
        #tbldetail td{
            border:1px solid black;
        }
        #tbldetail th{
            border:1px solid black;
        }
        #tblsummary td{
            padding:2px 5px;
        }
        #mytable td{
            padding:0px 3px;
        }
        #mytable th{
            padding:3px;
        }
        #tblsum td{
            padding:3px;
        }
        #tblsum th{
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
function dokhmermonth($m)
{
    if($m==1) return 'មករា';
    if($m==2) return 'គុម្ភះ';
    if($m==3) return 'មិនា';
    if($m==4) return 'មេសា';
    if($m==5) return 'ឧសភា';
    if($m==6) return 'មិថុនា';
    if($m==7) return 'កក្កដា';
    if($m==8) return 'សីហា';
    if($m==9) return 'កញ្ញា';
    if($m==10) return 'តុលា';
    if($m==11) return 'វិច្ចិកា';
    if($m==12) return 'ធ្នូ';
}
@endphp
<body>
    <div id="invoice-pos" style="">
        {{-- <div class="row" style="margin-top:40px;">
            <div class="table-responsive">
                <table class="" style="width:100%;overflow:hidden">
                    <tr>
                        <td style="width:20%;text-align:center;padding:0px;">
                            <img src="{{ asset('public/logo/' . $logo->logo) }}" alt="" style="width:128px;">
                        </td>
                        <td style="width:60%;text-align:center;font-family:khmer os muol light;font-size:32px;padding:0px;">
                            ខេអេសរេស៊ីដិន
                        </td>
                        <td style="width:20%;text-align:center;padding:0px;">
                        </td>
                    </tr>
                </table>
            </div>
        </div> --}}

        <div class="row" style="">

                <table class="table" style="">
                    <tr>
                        <td class="kh22-b" style="text-align:center;border-style:none;"><abbr title="">{{ $rpttitle }}</abbr> </td>
                    </tr>

                </table>

        </div>



        <div class="row" style="margin:0px 10px;">

                <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="">
                    <thead style="text-align:center;" class="kh12">
                        <th style="width:60px;" class="kh12">No</th>

                        <th style="width:100px;">ថ្ងៃលក់</th>
                        <th style="width:150px;">ឈ្មោះអចល</th>
                        <th id="th_customer" style="width:150px;">ឈ្មោះអតិថិជន</th>

                        <th style="width:100px;">ចំនួន</th>
                        <th style="width:100px;">សរុបបង់</th>
                        <th style="width:100px;">សំរាប់ខែ</th>
                        <th style="width:100px;">ខែបន្ទាប់</th>
                         <th style="width:100px;">សាច់ប្រាក់</th>
                        <th style="width:100px;">ធនាគា</th>
                        <th style="width:100px;">ពិន័យ</th>
                        <th style="width:100px;">លើកលែង</th>

                        <th style="width:150px;">តំលៃលក់</th>
                        <th style="width:150px;">បានទូទាត់រួច</th>
                        <th style="width:150px;">នៅខ្វះ</th>


                    </thead>
                    <tbody id="body_closelist">
                        @php
                            $i=0;
                            $totalpay=0;
                            $paybycash=0;
                            $paybybank=0;
                            $cuscharge=0;
                            $discount=0;
                            $totalsale=0;
                            $totaldeposit=0;
                            $skip_qty=0;
                            $qtypay=0;
                            $total_amount=0;
                            $total_cash=0;
                            $total_bank=0;
                        @endphp
                        @foreach ($transfers as $k => $tr)
                             @php
                                $i+=1;
                                $total_amount=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_cash_over)+floatval($tr->amt_bank_over);
                                $total_cash=floatval($tr->amt_cash) + floatval($tr->more_cash)+floatval($tr->amt_cash_over);
                                $total_bank=floatval($tr->amt_bank) + floatval($tr->more_bank)+floatval($tr->amt_bank_over);
                                $totalpay +=$total_amount;
                                $paybycash +=$total_cash;
                                $paybybank +=$total_bank;
                                if($tr->trancode<>-8 && $tr->qtyleftday>=0 && floatval($tr->count_pay + $tr->count_moredeposit +$tr->count_pay_over)>0){
                                    $cuscharge +=floatval($tr->cuscharge_new);
                                    $discount +=floatval($tr->discount_new);
                                }
                                // if($tr->deposit_via_id=='cash'){
                                //     $paybycash +=floatval($tr->amt_pay);
                                // }
                                if($tr->count_pay >0 || $tr->count_pay_over>0 || $tr->count_moredeposit>0){
                                    $qtypay+=1;
                                }
                                if(floatval($tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over)==0 && $tr->qtyleftday>=0){
                                    $skip_qty +=1;
                                }
                                $totalsale +=$tr->main_amount;
                                $totaldeposit +=$tr->deposited;
                            @endphp
                             <tr class="@if(floatval($tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over)<=0 && $tr->qtyleftday<0) c_red @endif">
                                <td style="text-align:center;" class="kh12-b">{{ $i }}</td>

                                <td class="kh12-b">{{ date('d-m-y',strtotime($tr->main_dd)) }}</td>

                                <td class="kh12-b">{{ $tr->main_property }}</td>
                                <td class="kh12-b">{{ $tr->buyer }}</td>

                               <td class="kh16" style="text-align:center;">{{ $tr->count_pay + $tr->count_moredeposit + $tr->count_pay_over . ' ដង'}}</td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($total_amount) .$tr->currency->sk }}</td>
                                <td class="kh12-b" style="text-align:center;">{{ $tr->payformonth?date('d-m-y',strtotime($tr->payformonth)):''}}</td>
                                <td class="kh12-b" style="text-align:center;">{{ date('d-m-y',strtotime($tr->nextpayment))}}</td>
                                <td class="kh12-b" style="text-align:right;" >{{ phpformatnumber($total_cash) .$tr->currency->sk }}</td>
                                <td class="kh12-b" style="text-align:right;" >{{ phpformatnumber($total_bank) .$tr->currency->sk }}</td>
                                <td class="kh12-b" style="text-align:right;" >{{ phpformatnumber($tr->trancode==-8?0:$tr->cuscharge) .$tr->currency->sk }}</td>
                                <td class="kh12-b" style="text-align:right;" >{{ phpformatnumber($tr->discount_amount) .$tr->currency->sk }}</td>

                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)) .$tr->currency->sk }}</td>
                                <td class="kh12-b" style="text-align:right;">
                                    {{ phpformatnumber(abs($tr->deposited)) .$tr->currency->sk }}
                                </td>
                                <td class="kh12-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)-abs($tr->deposited)) .$tr->currency->sk }}</td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

        </div>
        <div class="row" style="margin:0px 10px;">
            <table id="tblsum" class="table table-bordered kh14-b" style='margin:0px;'>
                <tr style="text-align:center;" class="kh14">
                     <th>សរុបអតិ</th>
                    <th>បង់រួច</th>
                    <th>មិនដល់បង់</th>
                    <th>មិនបានបង់</th>
                    <th>សរុបបង់</th>
                    <th>ប្រាក់ពិន័យ</th>
                    <th>លើកលែង</th>
                    <th>ជាសាច់ប្រាក់</th>
                    <th>ធនាគា</th>
                    <th>សរុបលក់</th>
                    <th>បានសង</th>
                    <th>នៅខ្វះ</th>

                </tr>
                <tr class="kh14-b">
                    <td style="text-align:center;">{{ $i . ' នាក់' }}</td>
                    <td style="text-align:center;">{{ $qtypay . ' នាក់'}}</td>
                    <td style="text-align:center;">{{ $skip_qty . ' នាក់'}}</td>
                    <td style="text-align:center;">{{ $i-$qtypay-$skip_qty . ' នាក់'}}</td>
                    <td>{{ phpformatnumber($totalpay) . '$' }}</td>
                    <td>{{ phpformatnumber($cuscharge) . '$' }}</td>
                    <td>{{ phpformatnumber($discount) . '$' }}</td>
                    <td>{{ phpformatnumber($paybycash) . '$' }}</td>
                    <td>{{ phpformatnumber($paybybank) . '$' }}</td>
                    <td>{{ phpformatnumber(abs($totalsale)) . '$' }}</td>
                    <td>{{ phpformatnumber($totaldeposit) . '$' }}</td>
                    <td>{{ phpformatnumber(abs($totalsale)-$totaldeposit) . '$' }}</td>
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
