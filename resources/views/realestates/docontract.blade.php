<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ធ្វើកុងត្រាថ្មី</title>
    {{-- <link rel="icon" href="{{ asset('public/admin') }}/assets/images/usdkhr.jpg" type="image/jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
    <link href="{{ asset('public/css') }}/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="{{ asset('public/css') }}/toastr.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;700&family=Noto+Sans+Khmer:wght@100..900&display=swap" rel="stylesheet"> --}}


    <link rel="icon" href="{{ asset('public/logo') }}/myapplogo.png" type="image/jpg" />
	<!--favicon-->
	<link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">

	<!--plugins-->
	<link href="{{ asset('public/admin') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{ asset('public/admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
	{{-- select2 --}}
	<link href="{{ asset('public/admin') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ asset('public/admin') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('public/admin') }}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
	<!-- loader-->
	<link href="{{ asset('public/admin') }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('public/admin') }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('public/admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('public/admin') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('public/admin') }}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('public/admin') }}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{ asset('public/admin') }}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{ asset('public/admin') }}/assets/css/header-colors.css" />
	{{-- toar --}}
	<link href="{{ asset('public/css') }}/toastr.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@300;400;700&family=Noto+Sans+Khmer:wght@100..900&display=swap" rel="stylesheet">

	{{-- datepicker --}}
	<link href="{{ asset('public/css') }}/jquery.datetimepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"/>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="{{ asset('public/admin') }}/assets/plugins/datetimepicker/js/picker.js"></script>
	<script src="{{ asset('public/admin') }}/assets/plugins/datetimepicker/js/picker.time.js"></script>
	<script src="{{ asset('public/admin') }}/assets/plugins/datetimepicker/js/picker.date.js"></script>
	<script src="{{ asset('public/admin') }}/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="{{ asset('public/admin') }}/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
	<script src="{{ asset('public/js') }}/jquery.datetimepicker.full.js"></script>
	<script src="{{ asset('public/js') }}/moment.js"></script>
    <script src="{{ asset('public/js') }}/toastr.min.js"></script>
    <script src="{{ asset('public/js') }}/cleave.js"></script>
	<script src="{{ asset('public/js') }}/cleave-phone.i18n.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
</head>
<style type="text/css">
     body.wait *{
			cursor: wait !important;
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
         .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;

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
        #tbl_before td{
            padding:2px;
        }
         #tbl_after td{
            padding:2px;
        }
        #tblmain td{
            padding:0px;
            border-style:none;
        }
        .buttonstyle:hover{
            background-color:aqua;
        }
        .buttonstyle{
            border:1px solid gray;
        }
        td.mainrow:hover{
            background-color:rgb(238, 255, 0);

        }
        .cblue{
            color:blue;
        }
        .cred{
            color:red;
        }
        #tbl_partner_list .clickedrow td{
            background-color:lightblue;
        }
        #tbl_before .clickedrow td{
            background-color:lightblue;
        }
        #tbl_after .clickedrow td{
            background-color:lightblue;
        }
        #tbl_a td{
            padding:5px;
            border-style:none;
        }
        .ui-autocomplete {
            position: fixed;
            z-index: 1511;
            font-size:18px;
            font-weight:bold;
            font-family:'Noto Sans Khmer', sans-serif;
        }
        .ui-autocomplete-input{
            border: none;
            margin-bottom: 5px;
            border:1px solid #c8c6c6 !important;
            z-index:1511;
            font-family:'Noto Sans Khmer', sans-serif;
        }
        .select2-container--default .select2-results>.select2-results__options{max-height: 350px !important;}
        .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:40px;}
        #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:36px;background-color:whitesmoke;}
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
        #sel_property + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:36px;background-color:whitesmoke;font-weight:bold;}
		#select2-sel_property-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}


        #sel_province1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;font-weight: bold;}
		/* Each result */
		#select2-sel_province1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight: bold;}

        #sel_district1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_commune1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_commune1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_village1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_village1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

         #sel_province2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;font-weight: bold;}
		/* Each result */
		#select2-sel_province2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight: bold;}

        #sel_district2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_commune2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_commune2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_village2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_village2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_province22 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;font-weight: bold;}
		/* Each result */
		#select2-sel_province22-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight: bold;}

        #sel_district22 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_district22-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_commune22 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_commune22-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

        #sel_village22 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;}
		/* Each result */
		#select2-sel_village22-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}


        #sel_province3 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;height:40px;font-weight: bold;}
		/* Each result */
		#select2-sel_province3-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight: bold;}
        .battambang-light {
            font-family: "Battambang", serif;
            font-weight: 300;
            font-style: normal;
            font-size:22px;
        }

        .battambang-regular {
            font-family: "Battambang", serif;
            /* font-weight: 400; */
            font-style: normal;
            font-size:16px;
        }

        .battambang-bold {
            font-family: "Battambang", serif;
            font-weight: 700;
            font-style: normal;
        }
        .mybtn{
            border:1px solid blue;
            background-color:skyblue;
            padding:2px 8px;

        }
        .mybtn:hover{
            background-color:blue;
            color:white;
        }
        .mybtn1{
            border:1px solid grey;
            background-color:skyblue;
            padding:2px 8px;

        }
        .mybtn1:hover{
            background-color:rgb(125, 240, 154);
            color:white;
        }
        .tbl_a td{
            padding:0px 5px 0px 10px;
        }
        input{
            border-top:none;
            border-left:none;
            border-right:none;
            border-bottom:1px dotted black;

        }

        .tbl_b td{
            padding:0px 5px 0px 5px;
        }
        .tbl_agreement td{
            padding:0px 5px 10px 5px;
        }
        .tbl_agreement td:last-child{
            padding:10px 5px 0px 5px;
        }
        .tbl_deposit td{
            padding:0px 5px 10px 5px;
        }
        .tbl_deposit td:last-child{
            padding:10px 5px 0px 5px;
        }
        .tbllist td{
            padding:3px;
        }
        .tbllist th{
            padding:3px 0px;
        }
        .tbllist .clickedrow td{
            background-color: #caaf8f;
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
    <div class="row" style="margin:10px;">
        <div class="col-lg-12">
            <h1 class="" style="font-family:khmer os muol light;font-size:22px;text-align:center;color:blue;">កិច្ចសន្យាកក់ប្រាក់ថ្លៃទិញដីល្វែង {{ $logo->name }}</h1>

        </div>
    </div>
    <div class="row" style="margin:5px;">

            <form id="frmkongtra" action="">
                {{ csrf_field() }}
                <input type="hidden" name="ctid" id="ctid">
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td class="kh22-b" style="text-align:center;padding:0px;">ភាគី​ ក</td>
                        </table>
                    </div>
                    <div class="card-body">
                        <table id="tbl_a">
                            <tr>
                                <td class="kh14-b" >
                                    ឈ្មោះ
                                </td>
                                <td>
                                    <select name="name1" id="name1" class="kh16-b" style="width:400px;height:30px;">
                                        @foreach ($companies as $com)
                                            <option value="{{ $com->id }}" sex="{{ $com->sex }}" age="{{ $com->age }}" nation="{{ $com->nation }}" idcard="{{ $com->idcard }}" address="{{ $com->boss_address }}">{{ $com->bossname }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="kh16-b" id="name1" name="name1" style="width:400px;height:30px;" value="{{ $logo->bossname }}" readonly> --}}
                                </td>
                               <td class="kh14-b">
                                    ភេទ
                                </td>
                                <td>

                                    <select name="sex1" id="sex1" class="kh16-b" style="width:100px;height:30px;">
                                        <option value="1" {{ $logo->sex==1?'selected':'' }}>ប្រុស</option>
                                        <option value="0" {{ $logo->sex==0?'selected':'' }}>ស្រី</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អាយុ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="age1" name="age1" style="width:100px;" value="{{ $logo->age }}" readonly>
                                </td>
                                <td class="kh14-b" >
                                    សញ្ជាតិ
                                </td>
                                <td>
                                    <select name="nation1" id="nation1" class=" kh16-b" style="width:100px;height:30px;">
                                        <option value="khr" {{ $logo->nation=='khr'?'selected':'' }}>ខ្មែរ</option>
                                        <option value="thb" {{ $logo->nation=='thb'?'selected':'' }}>ថៃ</option>
                                        <option value="vnd" {{ $logo->nation=='vnd'?'selected':'' }}>វៀតណាម</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អត្តសញ្ញាណប័ណ្ណ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="id1" name="id1" style="width:250px;" value="{{ $logo->idcard }}" readonly>
                                </td>
                            </tr>
                             <tr>
                                <td class="kh14-b">អាសយ័ដ្ឋាន</td>
                                <td colspan=9 style="padding:0px;">
                                    <input type="text" class="kh16-b" id="address1" name="address1" style="width:900px;" value="{{ $logo->boss_address }}" readonly>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td style="width:30%;padding:0px;">
                                <input type="text" class="kh14-b" style="background-color:pink;" name="customer_id" id="customer_id" readonly>
                                <button class="mybtn kh14-b" id="btnnew_customerid">អតិថិជន ថ្មី</button>
                                <label class="form-check-label kh14-b">
                                    <input class="form-check-input kh14-b" type="checkbox" name="ckbuymulti" id="ckbuymulti" value="1"> ទិញច្រើនល្វែង
                                </label>
                            </td>
                            <td class="kh22-b" style="text-align:center;padding:0px;width:40%;">ភាគី​ ខ(១)</td>
                            <td style="width:30%;padding:0px;"></td>
                        </table>
                    </div>
                    <div class="card-body" style="">
                        <table class="tbl_b" style="">
                            <tr>
                                <td class="kh14-b" >
                                    ឈ្មោះ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="name2" name="name2" style="width:400px;height:30px;">
                                </td>
                               <td class="kh14-b" >
                                    ភេទ
                                </td>
                                <td>

                                    <select name="sex2" id="sex2" class="kh16-b" style="width:100px;height:30px;">
                                        <option value=""></option>
                                        <option value="1">ប្រុស</option>
                                        <option value="0">ស្រី</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អាយុ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="age2" name="age2" style="width:100px;">
                                </td>
                                <td class="kh14-b" >
                                    សញ្ជាតិ
                                </td>
                                <td>
                                    <select name="nation2" id="nation2" class=" kh16-b" style="width:100px;height:30px;">
                                        <option value="khr">ខ្មែរ</option>
                                        <option value="thb">ថៃ</option>
                                        <option value="vnd">វៀតណាម</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អត្តសញ្ញាណប័ណ្ណ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="id2" name="id2" style="width:250px;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan=10 style="padding:20px 0px 0px 0px;">
                                    <table>
                                        <td class="kh14-b">
                                            ខេត្ត
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="height:30px;width:200px;" name="sel_province2" id="sel_province2">
                                                <option value=""></option>
                                                @foreach ($provinces as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ស្រុក/ក្រុង
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_district2" id="sel_district2">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ឃុំ/សង្កាត់
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_commune2" id="sel_commune2" >

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ភូមិ
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_village2" id="sel_village2">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            Tel:
                                        </td>
                                        <td>
                                            <input type="text" id="tel2" name="tel2" style="width:200px;" class="kh14-b">
                                        </td>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td class="kh22-b" style="text-align:center;padding:0px;">ភាគី​ ខ(២)</td>
                        </table>
                    </div>
                    <div class="card-body" style="">
                        <table class="tbl_b" style="">
                            <tr>
                                <td class="kh14-b" >
                                    ឈ្មោះ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="name22" name="name22" style="width:400px;height:30px;">
                                </td>
                               <td class="kh14-b" >
                                    ភេទ
                                </td>
                                <td>

                                    <select name="sex22" id="sex22" class="kh16-b" style="width:100px;height:30px;">
                                        <option value=""></option>
                                        <option value="1">ប្រុស</option>
                                        <option value="0">ស្រី</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អាយុ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="age22" name="age22" style="width:100px;">
                                </td>
                                <td class="kh14-b" >
                                    សញ្ជាតិ
                                </td>
                                <td>
                                    <select name="nation22" id="nation22" class=" kh16-b" style="width:100px;height:30px;">
                                        <option value="khr">ខ្មែរ</option>
                                        <option value="thb">ថៃ</option>
                                        <option value="vnd">វៀតណាម</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អត្តសញ្ញាណប័ណ្ណ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="id22" name="id22" style="width:250px;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan=10 style="padding:20px 0px 0px 0px;">
                                    <table>
                                        <td class="kh14-b">
                                            ខេត្ត
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="height:30px;width:200px;" name="sel_province22" id="sel_province22">
                                                <option value=""></option>
                                                @foreach ($provinces as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ស្រុក/ក្រុង
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_district22" id="sel_district22">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ឃុំ/សង្កាត់
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_commune22" id="sel_commune22" >

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ភូមិ
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_village22" id="sel_village22">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            Tel:
                                        </td>
                                        <td>
                                            <input type="text" id="tel22" name="tel22" style="width:200px;" class="kh14-b">
                                        </td>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td style="width:30%;padding:0px;">
                                <input type="text" class="kh14-b" style="background-color:pink;" name="saler_id" id="saler_id" readonly>
                                <button class="mybtn kh14-b" id="btnnew_salerid">អ្នកលក់ ថ្មី</button>
                            </td>

                            <td class="kh22-b" style="text-align:center;padding:0px;width:40%;">អ្នកលក់គំរោង</td>
                            <td style="width:30%;padding:0px;"></td>
                        </table>
                    </div>
                    <div class="card-body" style="">
                        <table class="tbl_b" style="">
                            <tr>
                                <td class="kh14-b" >
                                    ឈ្មោះ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="name3" name="name3" style="width:400px;height:30px;">
                                </td>
                               <td class="kh14-b" >
                                    ភេទ
                                </td>
                                <td>

                                    <select name="sex3" id="sex3" class="kh16-b" style="width:100px;height:30px;">
                                        <option value="1">ប្រុស</option>
                                        <option value="0">ស្រី</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អាយុ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="age3" name="age3" style="width:100px;">
                                </td>
                                <td class="kh14-b" >
                                    សញ្ជាតិ
                                </td>
                                <td>
                                    <select name="nation3" id="nation3" class=" kh16-b" style="width:100px;height:30px;">
                                        <option value="khr">ខ្មែរ</option>
                                        <option value="thb">ថៃ</option>
                                        <option value="vnd">វៀតណាម</option>
                                    </select>
                                </td>
                                <td class="kh14-b" >
                                    អត្តសញ្ញាណប័ណ្ណ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="id3" name="id3" style="width:250px;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan=10 style="padding:20px 0px 0px 0px;">
                                    <table>
                                        <td class="kh14-b">
                                            ខេត្ត
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="height:30px;width:200px;" name="sel_province3" id="sel_province3">
                                                <option value=""></option>
                                                @foreach ($provinces as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ស្រុក/ក្រុង
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_district3" id="sel_district3">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ឃុំ/សង្កាត់
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_commune3" id="sel_commune3" >

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            ភូមិ
                                        </td>
                                        <td>
                                            <select class="kh16-b" style="width:200px;height:30px;" name="sel_village3" id="sel_village3">

                                            </select>
                                        </td>
                                        <td class="kh14-b">
                                            Tel:
                                        </td>
                                        <td>
                                            <input type="text" id="tel3" name="tel3" style="width:200px;" class="kh14-b">
                                        </td>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td class="kh22-b" style="text-align:center;padding:0px;">ភាគីទាំងពីរបានព្រមព្រាងគ្នា</td>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="tbl_agreement">
                            <tr>
                                <td class="kh14-b">
                                    លក់ដីល្វែងលេខ
                                </td>
                                <td style="">
                                    <select class="kh16" name="sel_property" id="sel_property" style="width:200px;">
                                        <option value=""></option>
                                        @foreach ($myproperty as $p)
                                            <option value="{{ $p['pid'] }}" size="{{ $p['size'] }}" size1="{{ $p['size1'] }}" north="{{ $p['north'] }}" south="{{ $p['south'] }}" east="{{ $p['east'] }}" west="{{ $p['west'] }}"  price="{{ $p['price'] }}" cur="{{ $p['currency_shortcut'] }}" curid="{{ $p['currency_id'] }}" com_payoff="{{ $p['com_payoff'] }}" com_payloan="{{ $p['com_payloan'] }}" com_address="{{ $p['address'] }}" groupname="{{ $p['groupname'] }}">{{ $p['pname'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="kh14-b">
                                    ទំហំ
                                </td>
                                <td>
                                    <div id="size1" style="border-bottom:1px dotted black;" class="kh16-b" contenteditable="true"></div>
                                    {{-- <input type="text" class="kh16-b" id="size" name="size" style="width:100px;" readonly> --}}
                                </td>
                                <td class="kh14-b">
                                    តំលៃ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="price" name="price" style="width:150px;text-align:right;" readonly>
                                    <span class="kh16-b" id="curname">USD</span>
                                </td>
                                <td class="kh14-b">
                                    ជាអក្សរ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="price_text" name="price_text" style="width:350px;" readonly>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                               <td class="kh14-b">
                                    ប្លុក
                                </td>
                                <td style="">
                                    <input type="text" class="kh16-b" id="blocname" name="blocname" style="" readonly>
                                </td>
                                <td class="kh14-b">
                                    បញ្ចុះតំលៃ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="discount" name="discount" style="width:150px;text-align:right;" value="0">
                                    <span class="kh16-b" id="curname">
                                        <select class="kh16-b" name="disc_by" id="disc_by">
                                            <option value="$">USD</option>
                                            <option value="%">%</option>
                                        </select>
                                    </span>
                                </td>
                                <td class="kh14-b">
                                    តំលៃលក់
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="pricediscount" name="pricediscount" style="width:150px;text-align:right;" readonly>
                                    <span class="kh16-b" id="curname1">
                                        USD
                                    </span>
                                </td>
                                <td class="kh14-b">
                                    ជាអក្សរ
                                </td>
                                <td>
                                    <input type="text" class="kh16-b" id="price_text1" name="price_text1" style="width:350px;" readonly>
                                </td>
                                <td></td>
                            </tr>
                            <tr >
                                <td class="kh14-b" >
                                    អាស័យដ្ឋានដី
                                </td>
                                <td colspan=7>
                                    <input type="text" class="kh16-b" id="property_address" name="property_address" style="width:800px;">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan=8>
                                    <table>
                                        <tr>
                                            <td class="kh14-b">ខាងជើងទល់នឹង</td>
                                            <td>
                                                <input type="text" class="kh16-b" id="north" name="north" readonly>
                                            </td>
                                            <td class="kh14-b">ខាងត្បូងទល់នឹង</td>
                                            <td>
                                                <input type="text" class="kh16-b" id="south" name="south" readonly>
                                            </td>
                                            <td class="kh14-b">ខាងកើតទល់នឹង</td>
                                            <td>
                                                <input type="text" class="kh16-b" id="east" name="east" readonly>
                                            </td>
                                            <td class="kh14-b">ខាងលិចទល់នឹង</td>
                                            <td>
                                                <input type="text" class="kh16-b" id="west" name="west" readonly>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>

                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="padding:0px;background-color:bisque;">
                        <table class="table" style="padding:0px;margin:0px;">
                            <td class="kh22-b" style="text-align:center;padding:0px;">កក់ប្រាក់</td>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="tbl_deposit">
                            <tr>
                                <td class="kh14-b">
                                    ថ្ងៃកត់ត្រា
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="dd" id="dd" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </td>
                                <td class="kh14-b">កក់ប្រាក់ចំនួន</td>
                                <td>
                                    <input type="text" class="kh16-b" id="deposit" name="deposit"> <span class="kh16-b">USD</span>
                                </td>
                                 <td class="kh14-b">ជាអក្សរ</td>
                                <td>
                                    <input type="text" class="kh16-b" id="deposit_text" name="deposit_text" style="width:300px;">
                                </td>

                                <td class="kh14-b">នៅថ្ងៃទី</td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" name="paiddate" id="paiddate" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td colspan=8 style="padding:0px;">
                                    <table class="table">
                                        <tr>
                                            <td class="kh14-b">ប្រគល់ចំនួនថ្លៃដីសរុប</td>
                                            <td>
                                                <input type="radio" class="form-check-input kh16-b" id="optpaycash" name="paytype" value="1" checked>
                                                <label class="form-check-label kh16-b" for="optpaycash">លុយសុទ្ធ</label>

                                                <input type="radio" class="form-check-input kh16-b" id="optromlos" name="paytype" value="2">
                                                <label class="form-check-label kh16-b" for="optromlos">បង់រំលស់</label>
                                            </td>
                                            <td class="kh14-b">នៅថ្ងៃទី</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" name="paiddatelast" id="paiddatelast" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td style="text-align:right;padding:0px;">

                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan=8 style="border-style:none;padding:10px 0px 0px 0px;">
                                                <table style="padding:0px;">
                                                    <tr>
                                                        <td class="kh14-b">ធ្វើនៅ</td>
                                                        <td>
                                                            <input type="text" class="kh16-b" id="doat" name="doat">
                                                        </td>
                                                        <td class="kh14-b">ថ្ងៃទី</td>
                                                        <td>
                                                            <input type="text" class="kh16-b" id="dodate" name="dodate" value="{{ convertlatintokhmernumber($d1) }}">
                                                        </td>
                                                        <td class="kh14-b">ខែ</td>
                                                        <td>
                                                            <input type="text" class="kh16-b" id="domonth" name="domonth" value="{{ $m1 }}">
                                                        </td>
                                                        <td class="kh14-b">ឆ្នាំ</td>
                                                        <td>
                                                            <input type="text" class="kh16-b" id="doyear" name="doyear" value="{{ convertlatintokhmernumber($y1) }}">
                                                        </td>
                                                        <td style="text-align:right;">
                                                            <button class="mybtn kh14-b" id="btnsave" style="">រក្សាទុក</button>
                                                            <button class="mybtn kh14-b" id="btnprint" style="">រក្សាទុកព្រីន</button>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                    </table>

                                </td>



                            </tr>

                        </table>
                    </div>
                </div>

            </form>

    </div>
    <div class="row" style="margin:10px;">
        <div style='margin:0px 0px 10px 0px;'>
            <table class="kh16-b">
                <tr>
                    <td class="kh22-b">
                        តារាងកុងត្រា
                    </td>
                    <td style="border-style:none;padding-left:30px;" class="kh16-b">
                        <label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="checkbox" name="ckcreated_at" id="ckcreated_at" value="1" checked> ថ្ងៃកត់ត្រា
                        </label>
                    </td>
                    <td class="kh16-b" style="padding-left:10px;">គិតពី</td>
                    <td class="kh16-b">
                        <div class="input-group">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td class="kh16-b">ដល់</td>
                    <td class="kh16-b">
                        <div class="input-group">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td>
                        <select name="filteruser" id="filteruser" style="height:30px;" class="kh14-b">
                            <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                        <button class="mybtn kh14-b" id="btnshow">បង្ហាញ</button>
                        <button class="mybtn kh14-b" id="btnnew" style="">សំអាត</button>
                        <button class="mybtn kh14-b"  data-bs-toggle="collapse" data-bs-target="#searchmore">...</button>
                    </td>
                    <td style="padding:0px 10px;width:250px;">
                        <input type="text" class="kh16" id="tableSearch" style="width:250px;"  placeholder="Search What You Want..." title="Type what you khnow">
                    </td>
                </tr>
            </table>
        </div>
        <div id="searchmore" class="collapse">
            <table>
                <tr>
                    <td class="kh12-b">SearchBy</td>
                    <td>
                        <select class="kh12-b" name="selsearchby" id="selsearchby">
                            <option value="pn">Property Name</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="kh12-b" style="border:1px solid black;" id="txtsearch">
                        <button class="mybtn kh12-b" id="btnsearchmore">Search</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table id="tbllist" class="table table-bordered table-hover table-striped tbllist kh14-b" style="table-layout:fixed;">
                <thead style="text-align:center;background-color:aqua" class="kh14-b">
                    <th style="width:60px;">No</th>
                    <th style="width:100px;">ថ្ងៃកុងត្រា</th>
                    <th style="width:150px;">អ្នកកត់ត្រា</th>
                    <th style="width:150px;">ឈ្មោះអតិថិជន</th>
                    <th style="width:150px;">ឈ្មោះអ្នកលក់</th>
                    <th style="width:150px;">អចលនទ្រព្យ</th>
                    <th style="width:80px;">ទំហំ</th>
                    <th style="width:100px;">តំលៃ</th>
                    <th style="width:100px;">បញ្ចុះតំលៃ</th>
                    <th style="width:100px;">សរុប</th>
                    <th style="width:100px;">ប្រាក់កក់</th>
                    <th style="width:100px;">ថ្ងៃកក់</th>
                    <th style="width:100px;">ប្រភេទទូទាត់</th>
                    <th style="width:100px;">Action</th>
                    <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                </thead>
                <tbody id="bodycontract">
                    @foreach ($contracts as $key =>$ct)
                        <tr>
                            <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
                            <td class="kh14">{{ date('d-m-Y',strtotime($ct->reg_date)) }}</td>
                            <td class="kh14">{{ $ct->user->name ?? '' }}</td>
                            <td class="kh14" title="{{ $ct->customer_id }}">{{ $ct->name_b }}</td>
                            <td class="kh14" title="{{ $ct->saler_id }}">{{ $ct->name_c }}</td>
                            <td class="kh14" title="{{ $ct->property_id }}">{{ $ct->propertyname }}</td>
                            <td class="kh14">{{ $ct->size }}</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->price) }}$</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->discount ?? 0) }} {{ $ct->disc_by ?? '' }}</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->priceafterdiscount) }}$</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($ct->pay) }}$</td>
                            <td class="kh14" style="text-align:center;">{{ $ct->d . ' ' . $ct->m . ' ' . $ct->y }}</td>
                            <td class="kh14">{{ $ct->paytype==1?'បង់ផ្តាច់':'រំលស់' }}</td>

                            <td style="text-align:center;">
                                <a href="{{ route('realestate.printcontract',['id'=>$ct->id]) }}" class="mybtn1" target="_blank"><i class="fa fa-print" style="color:black;"></i></a>
                                @if (Auth::user()->role->name<>'Admin')
                                    @if (App\User::checkpermission(Auth::id(),'1.8.2'))
                                        <a href="" class="btndel mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
                                    @endif
                                    @if (App\User::checkpermission(Auth::id(),'1.8.1'))
                                        <a href="" class="btnedit mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-pencil" style="color:green;"></i></a>
                                    @endif
                                @else
                                    <a href="" class="btndel mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
                                    <a href="" class="btnedit mybtn1" data-id="{{ $ct->id }}"><i class="fa fa-pencil" style="color:green;"></i></a>
                                @endif

                            </td>
                            <td class="kh14">{{ date('d-m-Y',strtotime($ct->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




</body>
@include('includes.amount_to_letter_script')
@include('realestates.docontractscript')
</html>
