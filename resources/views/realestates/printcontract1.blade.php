<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ព្រីនកុងត្រា</title>
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
    .en12{
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
    }
    .khm22{
            font-family:'Khmer os muol light', sans-serif;
            font-size:22px;
            }
    .khm20{
            font-family:'Khmer os muol light', sans-serif;
            font-size:20px;
            }
    .khm16{
            font-family:'Khmer os muol light', sans-serif;
            font-size:16px;
            }
    .khm14{
            font-family:'Khmer os muol light', sans-serif;
            font-size:14px;
            }
            .khm12{
            font-family:'Khmer os muol light', sans-serif;
            font-size:12px;
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
        .tbl_a td{
            padding:0px;
            border-style:none;
        }
        #tblcontra td span{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        #tblcontra td span.bold{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        #tblcontra td span.muol{
            font-family:'Khmer os muol light', sans-serif;
            font-size:16px;
            font-weight:bold;
        }
        #tblcontra td {
            border-style:none;
            padding:0px;
            color:blue;
        }
        .brakacontent{
            padding-left:30px;
        }
        .brakacontent1{
            padding-left:102px;
        }
        .brakacontent2{
            padding-left:200px;
        }
        .footerdate{
            padding-left:350px;
        }
        span.dot{
            text-decoration-line: underline;text-decoration-style: dotted;
        }
</style>
@php

    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
        // $fp=substr($num,$p,strlen($num)-$p);
        // $dc=strlen((float)$fp)-2;
            $dc=2;
        }
        return number_format($num,$dc,'.',',');
    }
    function convertlatintokhmernumber($number)
    {
        $khmernum='';
        $digits = str_split((string)$number);

       foreach($digits as $n)
       {
        if($n==0 || $n=='០') $khmernum .='០';
        if($n==1 || $n=='១') $khmernum .='១';
        if($n==2 || $n=='២') $khmernum .='២';
        if($n==3 || $n=='៣') $khmernum .='៣';
        if($n==4 || $n=='៤') $khmernum .='៤';
        if($n==5 || $n=='៥') $khmernum .='៥';
        if($n==6 || $n=='៦') $khmernum .='៦';
        if($n==7 || $n=='៧') $khmernum .='៧';
        if($n==8 || $n=='៨') $khmernum .='៨';
        if($n==9 || $n=='៩') $khmernum .='៩';
        }
       return $khmernum;
    }
@endphp
<body>
    <div id="invoice-pos">
        <div class="row" style="padding:0px;margin:25px 0px;" >
            <table id="tbl_a" class="table tbl_a">
                <tr>
                    <td style="width:20%;"></td>
                    <td style="text-align:center; font-family:khmer os muol light;font-size:22px;width:60%;color:blue;">ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត្រ</td>
                    <td  style="width:20%;text-align:center;">
                        {{-- <table>
                            <tr>
                                <td style="text-align:center;padding-top:20px;" class="kh16-b">លេខទូរសព័្ទអ្នកលក់</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;" class="kh16-b">TEl:012 35 93 50</td>
                            </tr>
                        </table> --}}
                    </td>
                </tr>
                <tr>
                    <td colspan=3 style="text-align:center; font-family:khmer os muol light;font-size:15px;color:blue;padding-top:20px;">
                        កិច្ចសន្យាកក់ប្រាក់ថ្លៃទិញដីល្វែង ភូមិផ្សារកណ្តាល សង្កាត់ផ្សារកណ្តាល ក្រុងប៉ោយប៉ែត ខេត្តបន្ទាយមានជ័យ <br> រវាង
                    </td>
                </tr>
            </table>
        </div>

        <div class="row" style="padding:0px;margin:-30px 0px;">
            <table id="tblcontra" class="table">
                <tr>
                    <td style="padding-left:50px;">
                        <span>{{ $ct->company->sex==1?'ខ្ញុំបាទឈ្មោះ ':'នាងខ្ញុំឈ្មោះ ' }}</span>
                        <span class="muol dot">{{ $ct->company->bossname }}</span>
                        <span style="padding-left:10px;">ភេទ {{ $ct->company->sex==1?' ប្រុស':' ស្រី' }}</span>
                        <span>អាយុ {{ $ct->company->age . ' ឆ្នាំ' }} </span>
                        <span>សញ្ជាតិ @if($ct->company->nation=='khr')ខ្មែរ @elseif($ct->company->nation=='thb')ថៃ @elseif($ct->company->nation=='vnd')វៀតណាម @endif </span>
                        <span>កាន់អត្តសញ្ញាណប័ណ្ណលេខ {{ $ct->company->idcard }} </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>មានទីលំនៅបច្ចុប្បន្ន</span>
                        <span>{{ $ct->company->boss_address }}</span>
                        <span style="padding-left:10px;">(អ្នកលក់ដី) ហៅថា ភាគី(ក)។</span>
                    </td>
                </tr>
                <tr>
                    <td class="khm16" style="text-align:center;padding-top:5px;">និង</td>
                </tr>
                <tr>
                    <td>
                        <span style="padding-left:50px;">@if($ct->sex_b==0) នាងខ្ញុំឈ្មោះ @elseif($ct->sex_b==1) ខ្ញុំបាទឈ្មោះ @else ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ @endif</span>
                        <span class="muol dot">{{ $ct->name_b }}</span>

                        <span style="padding-left:10px;">អាយុ {{ $ct->age_b . ' ឆ្នាំ' }} </span>
                        <span>សញ្ជាតិ @if($ct->nation_b=='khr')ខ្មែរ @elseif($ct->nation_ab=='thb')ថៃ @elseif($ct->nation_b=='vnd')វៀតណាម @endif </span>
                        <span>កាន់អត្តសញ្ញាណប័ណ្ណលេខ {{ $ct->id_b }} </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>មានទីលំនៅបច្ចុប្បន្ន</span>
                        <span>{{ $ct->address_b }}</span>
                        <span style="padding-left:10px;">(អ្នកទិញ) ហៅភាគី(ខ)។</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="padding-left:50px;"> @if($ct->sex_bb==0) នាងខ្ញុំឈ្មោះ @elseif($ct->sex_bb==1) ខ្ញុំបាទឈ្មោះ @else ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ @endif</span>
                        <span class="muol dot">{{ $ct->name_bb }}</span>

                        <span style="padding-left:10px;">អាយុ {{ $ct->age_bb . ' ឆ្នាំ' }} </span>
                        <span>សញ្ជាតិ @if($ct->nation_bb=='khr')ខ្មែរ @elseif($ct->nation_bb=='thb')ថៃ @elseif($ct->nation_bb=='vnd')វៀតណាម @endif </span>
                        <span>កាន់អត្តសញ្ញាណប័ណ្ណលេខ {{ $ct->id_bb }} </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>មានទីលំនៅបច្ចុប្បន្ន</span>
                        <span>{{ $ct->address_bb }}</span>
                        <span style="padding-left:10px;">(អ្នកទិញ) ហៅភាគី(ខ)។</span>
                    </td>
                </tr>
                <tr>
                    <td class="khm16" style="text-align:center;padding:10px;">ភាគីទាំងពីរបានព្រមព្រាងគ្នាដូចប្រការខាងក្រោម៖</td>
                </tr>
                <tr>
                    <td>
                        <span class="muol">ប្រការ១៖</span>
                        <span class="brakacontent">ភាគី(ក)យល់ព្រមលក់ដីល្វែងលេខ:</span>
                        <span>{{ $ct->propertyname }}</span>
                        <span style="padding-left:20px;">ទំហំ</span>
                        <span style="padding-left:10px;">{!! $ct->size !!}</span>
                        <span style="padding-left:30px;">ដែលមានព្រំប្រទល់:</span>
                    </td>
                </tr>
                <tr>
                    <td style="">
                        <table>
                            <tr>
                                <td>
                                    <span class="">-ខាងជើងទល់នឹង</span>
                                    <span style="padding-left:5px;">{{ $ct->north }}</span>
                                </td>
                                <td>
                                    <span class="" style="padding-left:5px;">ខាងត្បូងទល់នឹង</span>
                                    <span style="padding-left:5px;">{{ $ct->south }}</span>
                                </td>
                                <td>
                                    <span class="" style="padding-left:5px;">ខាងកើតទល់នឹង</span>
                                    <span style="padding-left:5px;">{{ $ct->east }}</span>
                                </td>
                                <td>
                                    <span class="" style="padding-left:5px;">ខាងលិចទល់នឹង</span>
                                    <span style="padding-left:5px;">{{ $ct->west }}</span>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <span class="brakacontent1">ស្ថិតនៅ</span>
                        <span>{{ $ct->company->address }}។</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">ក្នុងតំលៃសរុបចំនួន</span>
                        <span class="dot muol" style="padding-left:15px;">{{ phpformatnumber($ct->priceafterdiscount) . ' USD' }}</span>
                        <span style="font-size:18px;padding-left:20px;">{{ '(ជាអក្សរ ' . $ct->price_text1 . ')' }}</span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <span class="muol">ប្រការ២៖</span>
                        <span class="brakacontent">ភាគី (ខ) យល់ព្រមទិញដីពី ភាគី (ក) ក្នុងប្រការ១ ហើយយល់ព្រមកក់ រឺបង់ប្រាក់ចំនួន <span class="dot muol">{{ phpformatnumber($ct->pay) . ' USD' }}</span></span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">{{ '(' . $ct->pay_text . ')' }}   ឲ្យទៅ ភាគី (ក) នៅថ្ងៃទី {{ $ct->d }} ខែ {{ $ct->m }} ឆ្នាំ {{ $ct->y }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">ហើយប្រគល់ចំនួនថ្លៃដីសរុប &nbsp;&nbsp;<input type="checkbox" {{ $ct->paytype==1?'checked':'' }}> លុយសុទ្ធ &nbsp;&nbsp;<input type="checkbox" {{ $ct->paytype==2?'checked':'' }}> បង់រំលស់  &nbsp;&nbsp;&nbsp; នៅថ្ងៃទី {{ $ct->dd }} ខែ {{ $ct->mm }} ឆ្នាំ {{ $ct->yy }} ជាកំហិត។</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                            ដល់ពេលកំណត់ហើយបើ ភាគី (ខ) មិនបានយកប្រាក់មកប្រគល់គ្រប់ចំនួនទេនោះប្រាក់កក់ ត្រូវទុកជាអសាបង់
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                            ហើយ ភាគី (ក) មានសិទ្ធយកដីល្វែងដែលបានលក់អោយ ភាគី (ខ) យកទៅលក់អោយអតិថិជនផ្សេងទៀតបាន
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                            ដោយគ្មានការតវ៉ាអ្វីឡើយ។
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                            ចំពោះអតិថិជនបង់រំលស់ ក្រោយពីអតិថិជនកក់ប្រាក់ថ្លៃដីរួច រយះពេលពី ៧ ទៅ ១០ថ្ងៃ បើសិនអតិថិជនមិនបាន
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           មកធ្វើតារាងបង់រំលស់ទេ ក្រុមហ៊ុនមានសិទ្ធលក់បន្តអោយអ្នកផ្សេងទៀត ហើយលុយកក់ទុកជាមោឃៈ ករណី ភាគី
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           (ខ) មានការបង់ប្រាក់យឺតយ៉ាវរយះពេល ៣ខែជាប់គ្នា នោះ ភាគី (ក) មានសិទ្ធដកហូតដី ល្វែងដែលបានលក់ឲ្យ
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           ភាគី (ខ) ដោយគ្មានការតវ៉ាអ្វីឡើយ ។​ បើសិនអតិថិជនមានការបង់ប្រាក់រំលស់ ប្រចាំខែយឺតយ៉ាវ ក្រុមហ៊ុននិងធ្វើ
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           ផាកពិន័យ១ថ្ងៃ ៥$ (រំលស់រៀងរាល់ថ្ងៃទី១ ដល់ថ្ងៃទី១០ ក្នុងខែនីមួយៗ) ។
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="muol">ប្រការ៣៖</span>
                        <span class="brakacontent" style="padding-left:25px;">ប្រសិនបើ ភាគី (ក) ប្រែក្រឡាស់ថាមិនលក់ដីវិញនេាះ ភាគី (ក) ត្រូវសងប្រាក់ទ្វេរជាពីរនៃតំលៃប្រាក់កក់ ឲ្យទៅ</span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           ភាគី (ខ) តែបើ ភាគី (ខ) ប្រែក្រឡាស់ថាមិនទិញដីវិញនោះ ប្រាក់ដែលកក់ត្រូវទុកជាអសាបង់។
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="muol">ប្រការ៤៖</span>
                        <span class="brakacontent">ភាគីទាំំងពីរបានព្រមព្រាងគ្នា ដូចប្រការខាងលើដោយគ្មានការ បង្ខិតបង្ខំពីអជ្ញាធរមានសមត្ថកិច្ចឡើយ</span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           បើភាគីណាមួយមិនគោរពតាមកិច្ចព្រមព្រាង ដូចខាងលើនេះ ភាគីនោះនិងទទួលខុសត្រូវចំពោះមុខច្បាប់។
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="muol">ប្រការ៥៖</span>
                        <span class="brakacontent">ភាគីទាំំងពីរព្រមទាំងសាក្សីបានអាន  និង  ស្តាប់ការអានហើយយល់ច្បាស់ខ្លឹមសារព្រមផ្តិតមេដៃស្តាំ</span>

                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="brakacontent1">
                           ដើម្បីធានាដល់សុក្រិតភាពនៃកិច្ចសន្យានេះ និងសម្រាប់ទុកជាភស្តុតាងក្នុងការទទួលខុសត្រូវចំពោះមុខច្បាប់។
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px 10px 0px 0px;text-align:right;">
                        <span class="footerdate bold">

                           ធ្វើនៅ <span class="dot" style="padding:0px 5px;">{{ $ct->doat }}</span>
                           ថ្ងៃទី <span class="dot" style="padding:0px 5px;">{{ $ct->dodate }}</span>
                           ខែ <span class="dot" style="padding:0px 5px;">{{ $ct->domonth }}</span>
                           ឆ្នាំ <span class="dot" style="padding:0px 5px;">{{ $ct->doyear }}</span>
                        </span>
                    </span>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:10px;">
                        <span class="bold" style="padding-left:170px;">
                           ស្នាមមេដៃស្តាំ
                        </span>
                        <span class="bold" style="padding-left:250px;">
                           ស្នាមមេដៃស្តាំ
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="">
                        <span class="bold" style="padding-left:90px;">
                           សាក្សីទី១
                        </span>
                        <span class="bold" style="padding-left:120px;">
                           សាក្សីទី២
                        </span>
                        <span class="bold" style="padding-left:100px;">
                            ភាគី (ក)
                         </span>
                         <span class="bold" style="padding-left:130px;">
                            ភាគី (ខ)
                         </span>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:90px;">
                        <span class="dot bold" style="padding-left:520px;">
                           លេខទូរស័ព្ទ &nbsp;&nbsp; {{ $ct->buyer->tel }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span>

                    </td>
                </tr>
                <tr>
                    <td style="">
                        <span style="padding-left:10px;">
                           កិច្ចសន្យាប្រាក់កក់ថ្លៃទិញដី
                        </span>
                        <span style="padding-left:280px;">
                            ឯកសារនេះពិតជាសុក្រិតត្រឹមត្រូវតាមគតិយុត្តិនៃច្បាប់
                         </span>
                    </td>
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
