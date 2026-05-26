@extends('master')
@section('title') Real Estate @endsection
@section('css')

    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}


    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selsaler + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selsaler-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_property + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-sel_property-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selbank + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selbank-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 30px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 30px !important;
        }
        .en12{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            }
        .en12-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            font-weight:bold;
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
            font-weight:bold;
            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;

            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .modalleft{
            margin-left:0;
            margin-top:0;
        }
        .modalright{
            margin-top:0;
            margin-right:0;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
        }
        #tbl_partner td{
            padding:2px;
            border-style:none;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }

       th{
        word-wrap: break-word;
       }
       hr.new2 {
        border-top: 1px dashed brown;
        margin:5px;
        }

        /* Dotted red border */
        hr.new3 {
        border-top: 1px dotted brown;
        margin:5px;
        }
       #divfooter{
        /* margin:0px; */
        color:white;
        padding:0px 20px 0px 0px;
        position: fixed;
        bottom: 0;
        width: 84.5%;
        min-height: 98px;
        max-height: 98px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 98px;
        overflow:auto;
        clear: both;
        }
        .tableFixHead{ overflow: auto;border:1px solid blue;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_transferlist td{
          word-wrap: break-word !important;
          padding:2px 5px 2px 5px;
        }

        .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist .clickedrow td{
            background-color: pink;
        }
        .tbl_transferlist .clickedrow input{
            background-color: pink;
        }
        .tbl_transferlist th{
            padding:2px;
            background-color:silver;
        }
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);

            }
        .button1{
            border:none;
            background-color:inherit;
            padding:2px 5px;
            border:1px solid gray;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
            }
        #tablemultiexchange th{
            padding:3px;
        }
        #tbl_partner td{
            padding:3px 0px;
        }

        #tablemultiexchange td{
            padding:3px;
        }
        .mybtn{
            border:1px solid black;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        #tbl_sale_detail td{
            border:1px solid blue;
            padding:4px 5px;
        }
        #tbl_sale_detail th{
            border:1px solid blue;
            padding:4px;
            background-color:aquamarine;
        }
        .btnremoveitem:hover{
            background-color:yellow;
        }
        .btnremoveitem{

            padding:5px 10px;
            border:1px solid black;
        }
        ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
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

       #row_contract {
            /* margin-bottom: 10px; */
            margin-top:-20px;

        }
    </style>
@endsection
@section('content')
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
    <div id="row_contract" style="">
        <table class="table table-bordered table-hover table-striped tbllist kh14-b" style="table-layout:fixed;display:none;padding-bottom:10px;">
            <thead style="text-align:center;background-color:aqua" class="kh14-b">
                <th style="width:60px;">No</th>
                <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                <th style="width:150px;">ឈ្មោះអតិថិជន</th>
                <th style="width:150px;">ឈ្មោះអ្នកលក់</th>
                <th style="width:100px;">អចលនទ្រព្យ</th>
                <th style="width:80px;">ទំហំ</th>
                <th style="width:100px;">តំលៃ</th>
                <th style="width:100px;">បញ្ចុះតំលៃ</th>
                <th style="width:100px;">សរុប</th>
                <th style="width:100px;">ប្រាក់កក់</th>
                <th style="width:100px;">ថ្ងៃកក់</th>
                <th style="width:100px;">ប្រភេទទូទាត់</th>
            </thead>
            <tbody id="bodycontract">

            </tbody>
        </table>
    </div>
     <div class="row" style="margin-bottom:10px;margin-top:-20px;">
        <div class="col-lg-6">
            <table>
                <tr>
                    <td style="border-style:none;">
                        <div class="dropdown" style="display:inline;">
                            <button type="button" class="mybtn dropdown-toggle kh16" data-bs-toggle="dropdown">
                                ផ្សេងៗ
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item kh16 btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button id="btnfindcontract" class="mybtn kh16-b">មើលកុងត្រា</button>
                    </td>
                    <td>
                        <button id="btnclosecontract" class="mybtn kh16-b" style="display:none;">Close Contract</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
          <table class="">
            <tr>
                <td style="border-style:none;" class="kh16-b">
                    <label class="form-check-label kh16-b">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckcreated_at" id="ckcreated_at" value="1" checked> ថ្ងៃកត់ត្រា
                    </label>
                </td>
                <td style="padding:0px;">
                    <input type="text"  id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                </td>
                <td style="padding:0px;">
                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                </td>
                <td style="padding:0px;">
                    <input type="text"  id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                </td>
                <td style="padding:0px;">
                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                </td>
              <td style="text-align:right;border-style:none;">
                <select name="filteruser" id="filteruser" style="height:30px;" class="kh14-b">
                    <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                    @endforeach
                </select>
                <button class="mybtn kh16-b" style=""  id="btnshow">Show</button>
                <button class="mybtn kh16-b" style="color:red;"  id="btntrash">ទិន្ន័យលុប</button>
              </td>
            </tr>
          </table>
        </div>
    </div>
    <div class="row" style="margin-top:0px;">
        <form id="frmsaleland" action="">
            <input type="hidden" id="id1" name="id1">
            <input type="hidden" id="id2" name="id2">
            <input type="hidden" id="id3" name="id3">
            <input type="hidden" id="id4" name="id4">
            <input type="hidden" id="trancode" name="trancode">
            <div class="row">
                <div class="col-lg-6">
                        <div class="row" style="">
                            <div class="col-lg-12">

                                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">

                                <div class="row">

                                    <div class="table-responsive" style="">
                                        <table id="tbl_partner" class="table" style="table-layout:fixed;">
                                            <tr id="row_title" style="background-color:rgb(184, 14, 133);">

                                                <td colspan=3 style="padding:7px;text-align:center;">
                                                    <span id="m_title" class="kh18-b" style="color:white;">
                                                        ផ្នែកលក់
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr id="row_date" style="">
                                                <td style="width:150px;"><label for="invdate" class="kh16" style="">កាលបរិច្ឆេទ</label></td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                                                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr id="row_txtname" style="display:none;">
                                                <td style="width:150px;"><label id="labelname" for="txtname" class="kh16" style="">ឈ្មោះអតិថិជន</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16-b" id="txtname" name="txtname">
                                                </td>
                                            </tr>
                                            <tr id="row_selpartner">
                                                <td style="width:150px;"><label for="selpartner" class="kh16" style="">លក់ជូន</label></td>
                                                <td colspan=2>
                                                    <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%">
                                                        <option value=""></option>
                                                        @foreach ($partners->where('customertype','BUYER') as $p)
                                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" idcard="{{ $p->idcard }}" sex="{{ $p->sex==1?'ប្រុស': ($p->sex==0?'ស្រី':'') }}" age="{{ $p->age }}" tel="{{ $p->tel }}">{{ $p->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="row_partnerinfo" style="">
                                                <td style="width:150px;">ID CARD/AGE</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="idcard" name="idcard" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b" id="age" name="age" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr id="row_partnerinfo" style="">
                                                <td style="width:150px;">TEL/SEX</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="tel" name="tel" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b" id="sex" name="sex" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr id="row_selsaler" style="">
                                                <td><label id="lblsaler" class="kh16">អ្នកលក់គំរោង</label></td>
                                                <td colspan=2>
                                                    <select class="form-select kh16" name="selsaler" id="selsaler" style="width:100%">
                                                        <option value=""></option>
                                                        @foreach ($partners->where('customertype','SALER') as $c)
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="row_selproject" style="">
                                                <td><label class="kh16">ជ្រើសរើសប្លុក</label></td>
                                                <td colspan=2>
                                                    <select class="form-select kh16" name="selproject" id="selproject" style="width:100%;height:30px;padding:0px 10px;">
                                                        <option value=""></option>
                                                        @foreach ($projects as $pj)
                                                            <option value="{{ $pj->id }}">{{ $pj->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr id="row_sel_property" style="">
                                                <td><label class="kh16">ឈ្មោះអចលនទ្រព្យ</label></td>
                                                <td colspan=2 style="padding:0px;">
                                                    <div class="input-group">
                                                        <select class="form-select kh16-b" name="sel_property" id="sel_property">
                                                            <option value=""></option>
                                                            @foreach ($myproperty as $p)
                                                                <option value="{{ $p['pid'] }}" size="{{ $p['size'] }}" size1="{{ $p['size1'] }}" price="{{ $p['price'] }}" cur="{{ $p['currency_shortcut'] }}" curid="{{ $p['currency_id'] }}" com_payoff="{{ $p['com_payoff'] }}" com_payloan="{{ $p['com_payloan'] }}" property_group="{{ $p['pgroupid'] }}">{{ $p['pname'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input id="btnaddlist" type="button" class="input-group mybtn" style="width:80px;" value="ADD LIST">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_tbl_sale_detail">
                                                <td colspan=3>
                                                    <div class="table-responsive">
                                                        <table id="tbl_sale_detail" class="table table-bordered table-hover" style="table-layout:fixed;">
                                                            <thead style="text-align:center;" class="kh12">
                                                                <th style="width:40px;">No</th>
                                                                <th style="width:80px;display:none;">PID</th>
                                                                <th style="width:150px;">Name</th>
                                                                <th style="width:100px;">Size</th>
                                                                <th style="width:200px;">Price</th>
                                                                <th style="width:100px;display:none;">Curid</th>
                                                                <th style="width:100px;">%PayOff</th>
                                                                <th style="width:100px;">%PayLoan</th>
                                                                <th id="haction" style="width:40px;">Act</th>
                                                                <th style="width:100px;display:none;">gid</th>
                                                            </thead>
                                                            <tbody id='body_sale_detail'>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr id="row_amount">
                                                <td class="kh16">សរុបទឹកប្រាក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b" id="txtcur" name="txtcur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_discount">
                                                <td class="kh16">បញ្ចុះតំលៃ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="discount" name="discount" style="text-align:right;height:30px;" value="0">
                                                        <select name="disc_by" id="disc_by" class="kh16-b" style="width:80px;">
                                                            <option value="$">USD</option>
                                                            <option value="%">%</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_amountdiscount">
                                                <td class="kh16">សរុបទឹកប្រាក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="amountdiscount" name="amountdiscount" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b" id="txtcur1" name="txtcur1" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_deposited" style="display:none;">
                                                <td class="kh16">បានទូទាត់រួច</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="deposited" name="deposited" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_balance" style="display:none;">
                                                <td class="kh16">ទឹកប្រាក់នៅសល់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="balance" name="balance" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_deposit" style="">
                                                <td class="kh16">ប្រាក់កក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="deposit" name="deposit" style="text-align:right;height:30px;" value="0">
                                                        <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_balabce" style="">
                                                <td class="kh16">សមតុល្យ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="balance1" name="balance1" style="text-align:right;height:30px;" value="0" readonly>
                                                        <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_paymenttype">
                                                <td>
                                                    <label for="recname" class="kh16" style="width:120px;">ប្រភេទទូទាត់</label>
                                                </td>
                                                <td colspan=2>
                                                   <select name="paymenttype" id="paymenttype" class="form-select kh16-b canenter" style="height:30px;padding:0px 10px;">
                                                        <option value=""></option>
                                                        <option value="1">បង់ផ្តាច់</option>
                                                        <option value="2">បង់រំលស់</option>
                                                   </select>
                                                </td>
                                            </tr>
                                            <tr id="row_term" style="display:none;">
                                                <td class="kh16">រយះពេល</td>
                                                <td colspan=2 class="kh16">
                                                    <table class="table" style="padding:0px;margin:0px;">
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control kh16-b" id="term" name="term" style="text-align:right;height:30px;" >
                                                                    <span class="input-group kh16" style="width:40px;padding:2px 5px;">​ខែ</span>
                                                                </div>
                                                            </td>
                                                            <td>អត្រា</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control kh16-b" id="interest_rate" name="interest_rate" style="text-align:right;height:30px;" value="0">
                                                                    <span class="input-group kh16" style="width:40px;padding:2px 5px;">%</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>

                                            </tr>
                                            <tr id="row_payinmonth" style="display:none;">
                                                <td class="kh16">បង់ប្រចាំខែ</td>
                                                <td style="padding:0px;" colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="payinmonth" name="payinmonth" style="text-align:right;height:30px;">
                                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_duration" style="display:none;">
                                                <td class="kh16">គិតចាប់ពី</td>
                                                <td colspan=2 class="kh16">
                                                    <table class="table" style="padding:0px;margin:0px;">
                                                        <tr>
                                                            <td style="padding:0px 10px 0px 0px;">
                                                                <div class="input-group">
                                                                    <input type="text"  id="startdate" name="startdate" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;" readonly>
                                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </td>
                                                            <td style="padding:0px">ដល់</td>
                                                            <td style="padding:0px;">
                                                                <div class="input-group" style="">
                                                                    <input type="text"  id="enddate" name="enddate" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;" readonly>
                                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>

                                            </tr>
                                            <tr id="row_commission">
                                                <td class="kh16">កំរៃជើងសារ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="commission" name="commission" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_paycommission">
                                                <td class="kh16">បង់កំរៃជើងសារ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="paycommission" name="paycommission" style="text-align:right;height:30px;">
                                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_selbank" style="">
                                                <td class="kh16">អតិថិជនទូទាត់តាម</td>
                                                <td colspan=2>
                                                    <select name="selbank" id="selbank" class="form-select kh16-b" style="">
                                                        <option value="cash">សាច់ប្រាក់</option>
                                                        @foreach ($partners->where('customertype','BANK') as $b)
                                                            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" thai_list="{{ $b->thai_list }}">{{ $b->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                            </tr>
                                            <tr id="row_bankamt">
                                                <td class="kh16">ចំនួនទូទាត់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="bankamt" name="bankamt" style="text-align:right;height:30px;">
                                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row_note">
                                                <td colspan=3>
                                                    <textarea name="note" id="note" class="kh16-b" style="width:100%;" rows="3" placeholder="កំណត់សំគាល់"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=3 style="text-align:right;">
                                                    <button id="btnnew" class="button1 kh16-b" style="width:100px;">សំអាតថ្មី</button>
                                                    <button id="btndelete" class="button1 kh16-b" style="width:100px;color:red;display:none;">លុប</button>
                                                    <button id="btnsavesale" class="button1 kh16-b" style="width:100px;">រក្សាទុក</button>
                                                    <button id="btnsavesaleprint" class="button1 kh16-b" style="width:100px;">រក្សាទុកព្រីន</button>

                                                    <button id="btnsavedeposit" class="button1 kh16-b" style="width:100px;display:none;">ទូទាត់</button>
                                                    <button id="btnsavedepositprint" class="button1 kh16-b" style="width:100px;display:none;">ទូទាត់ព្រីន</button>
                                                </td>


                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                </div>
                <div class="col-lg-6">
                    <div class="row">
                      <div id="divgettransaction" style="margin-bottom:0px;">
                        <div class="card" style="">
                            <div id="cardheader" class="card-header" style="height:40px;background-color:lightgreen;">
                                <div class="row">
                                    <table>
                                        <tr>
                                            <td>
                                                <h3 id="title_list" class="kh18-b">ទិន្ន័យលក់</h3>
                                            </td>
                                            <td>
                                                <div class="input-group" style="margin-top:-5px;">
                                                    <select class="form-select kh16-b" name="search_property" id="search_property">
                                                        <option value="">Select Property</option>
                                                        @foreach ($allproperty as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input id="btnsearchproperty" type="button" class="input-group mybtn" style="width:80px;" value="SEARCH">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="kh16" id="tableSearch" style="width:100%;background-color:lightgreen;border-style:none;margin-top:-5px;"  placeholder="Search What You Want..." title="Type what you khnow">
                                                {{-- <span style="float:right;font-size:16px;margin-left:20px;margin-top:-5px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-sm">X</button></span> --}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body" style="padding:0px;margin:0px;">
                              <div class="tableFixHead">
                                <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                                    <thead style="text-align:center;" class="kh16">
                                        <th style="width:70px;">No</th>
                                        <th style="width:100px;">ថ្ងៃលក់</th>
                                        <th style="width:100px;">លេខកូត</th>
                                        <th style="width:200px;">ប្រតិបត្តិការណ៏</th>
                                        <th style="width:150px;">អតិថិជន</th>
                                        <th style="width:120px;">ចំនួនទឹកប្រាក់</th>
                                        <th style="width:100px;">បញ្ចុះតំលៃ</th>
                                        <th style="width:100px;">ប្រភេទទូទាត់</th>
                                        <th style="width:150px;">អ្នកលក់គំរោង</th>
                                        <th style="width:100px;">កំរៃជើងសារ</th>
                                        <th style="width:130px;">អ្នកកត់ត្រា</th>
                                        <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                                        <th style="width:100px;">ម៉ោង</th>
                                        <th style="width:250px;">លេខក្រុម</th>
                                        <th style="width:500px;">ផ្សេងៗ</th>

                                    </thead>
                                    <tbody id="body_transaction">
                                        @foreach ($transfers as $k => $tr)
                                            <tr>
                                                <td style="text-align:center;padding:0px;" class="kh14-b">
                                                    <div class="dropdown">
                                                        <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" data-trancode="{{ $tr->trancode }}" data-sendername="{{ $tr->sendername }}" data-sendertel="{{ $tr->sendertel }}"><i class="fa fa-print"></i> Print</a></li>
                                                            @if($tr->trancode==-8)
                                                                @if(str_contains($tr->action,'u'))
                                                                    <li class="li_code111" title="code:1.1.1"><a href="#" class="dropdown-item kh16-b btnedit" style="color:green;" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                                                @endif
                                                                @if($tr->term && $tr->term>0)
                                                                    <li class="li_code113" title="code:1.1.3">
                                                                        <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            @if(str_contains($tr->action,'d'))
                                                                <li class="li_code112" title="code:1.1.2">
                                                                    <a class="dropdown-item kh16-b btndeltransfer" style="color:red;" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}"><i class="fa fa-trash"></i> Delete</a>
                                                                </li>
                                                            @endif
                                                            {{-- @if($tr->trancode==-8)
                                                                @if (Auth::user()->role->name<>'Admin')
                                                                    @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                                                        <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                                    @endif
                                                                @else
                                                                    <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                                @endif
                                                            @endif --}}
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="kh16">
                                                    {{ date('d-m-Y',strtotime($tr->dd)) }}
                                                </td>
                                                <td class="kh16">
                                                    <a href="#inv{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ sprintf("%04d",$tr->id) }}</a>
                                                </td>
                                                <td class="kh16">{{ $tr->tranname }}</td>
                                                <td class="kh16">{{ $tr->partner->name }}</td>
                                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->discount) .$tr->disc_by }}</td>
                                                <td class="kh16" style="text-align:right;">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
                                                <td class="kh16">{{ $tr->customer->name }}</td>
                                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
                                                <td class="kh16">{{ $tr->user->name }}</td>
                                                <td class="kh16">{{ date('d-m-Y',strtotime($tr->created_at)) }}</td>
                                                <td class="kh16">{{ $tr->tt }}</td>
                                                <td class="kh16">{{ $tr->ref_group_id }}</td>
                                                <td class="kh16">{{ $tr->note }}</td>
                                            </tr>
                                            <tr id="inv{{ $tr->id }}" class="collapse borderset2" style="">
                                                <td colspan=13 style="">
                                                    <table class="table table-bordered" style="margin:0px;">
                                                        <tbody>
                                                            @php
                                                                $i=0;
                                                            @endphp
                                                            @foreach (App\PartnerTransfer::showbygroupsale($tr->id,$tr->ref_group_id) as $item)
                                                                @php
                                                                    $i=$i+1;
                                                                @endphp
                                                                @if($i==1)
                                                                    <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                                        <td style="width:100px;">ID</td>
                                                                        <td style="width:90px;">Date</td>
                                                                        <td style="width:80px;">Time</td>
                                                                        <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                                                        <td style="width:150px;">ដៃគូ</td>
                                                                        <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                                                        <td style="width:80px;">សេវ៉ាដៃគូ</td>
                                                                        <td style="width:100px;">អ្នកកត់ត្រា</td>
                                                                        <td style="">ផ្សេងៗ</td>
                                                                    </tr>
                                                                @endif
                                                                <tr class="kh12-b" style="">
                                                                    <td style="text-align:center;">{{ $item->id }}</td>
                                                                    <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                                                    <td>{{ $item->tt }}</td>
                                                                    <td>{{ $item->tranname }}</td>
                                                                    <td>{{ $item->partner->name }}</td>
                                                                    <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                                                    <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                                                                    <td>{{ $item->user->name }}</td>
                                                                    <td{{ $item->note }}</td>

                                                                </tr>
                                                            @endforeach

                                                        </tbody>

                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </form>
    </div>




@endsection
@section('script')
@include('realestates.realestate_script')


@endsection
