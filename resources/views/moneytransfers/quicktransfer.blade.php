@extends('master')
@section('title') Quick Transfer @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}

    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
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
        }
       .txtexchange{
        padding:2px;
        /* font-weight:bold; */
        font-size:22px;
        text-align:right;
       }
       .txtexchangefix{
        padding:2px;
        font-weight:bold;
        font-size:16px;
        text-align:right;
       }
       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }
      #tbl_amount td{
        padding:2px;
        border-style:none;
       }
       #tbl_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_exchange td{
        padding:2px;
        border-style:none;
       }
       #tbl_continue_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_checkamt .clickedrow td{
        background-color: #caaf8f;
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
          word-wrap: break-word;
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
            padding:5px 10px 5px 10px;
            background-color:silver;
        }
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);

            }
        .button1{
            border:none;
            background-color:inherit;
            padding:5px;
            border:1px solid gray;
        }
        #tbl_partner input[type='text']:focus {
            background-color: yellow;
            }
        #tblbutton td{
            padding:0px;
        }
        .dropdown-menu li > a:hover{
            background-color:rgb(52, 26, 197);
            color:white;
        }
        .dropdown-menu li{
            padding:0px;
        }
        .btn-3d {
            background: #3498db;
            color: white;
            margin:0px 2px;
            padding: 2px 10px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
            font-weight: bold;
            }
        .btn-3d-primary{
            background: #344ddd;
            color: white;
        }
        .btn-3d-danger{
             background: #f3260b;
             color: white;
        }
         .btn-3d-warning{
             background: #c9a506;
             color: white;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 1px 0 #2980b9;
            }
        .btn-3d:hover{
            background-color:green !important;
            color:white !important;
        }
        .input-3d {
            margin:0px 2px;
            padding: 0px 2px;
            border-radius: 6px;
            background: white;

            font-size: 16px;

            outline: none;
            border:1px solid black;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;

            }

        .input-3d:focus {
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.15),
                        inset -2px -2px 4px rgba(255, 255, 255, 0.7);
            background: #e4f311 !important;
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
     <div class="row" style="margin-bottom:10px;margin-top:-20px;">
        <div class="col-lg-6">
            <table>
                <tr>
                    <td style="border-style:none;">

                        @if (Auth::user()->role->name<>'Admin')
                            <button class="btn-3d kh16-b" id="btntransfer" title="ភ្ញៀវយកលុយក្នុងកុង">បាញ់ចេញ</button>
                            <button class="btn-3d kh16-b" id="btnreceive" title="ភ្ញៀវយកលុយក្រៅ">បាញ់ចូល</button>
                            <button class="btn-3d kh16-b-b" id="btntransferdebt" style="display:none;">វេរបំណុល</button>
                            <div class="dropdown" style="display:inline">
                              <button type="button" class="btn btn-primary dropdown-toggle kh16" data-bs-toggle="dropdown">
                                ផ្សេងៗ
                              </button>
                              <ul class="dropdown-menu">
                                @if (Auth::user()->role->name<>'Admin')
                                  @if (App\User::checkpermission(Auth::id(),'3.1.6'))
                                    <li><a class="dropdown-item kh16-b btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                  @endif
                                @else
                                  <li><a class="dropdown-item kh16-b btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                @endif
                              </ul>
                            </div>
                        @else
                            <button class="btn-3d kh16-b" id="btntransfer" title="ភ្ញៀវយកលុយក្នុងកុង">បាញ់ចេញ</button>
                            <button class="btn-3d kh16-b" id="btnreceive" title="ភ្ញៀវយកលុយក្រៅ">បាញ់ចូល</button>
                            <button class="btn-3d kh16-b" id="btntransferdebt" style="display:none;">វេរបំណុល</button>
                            {{-- <button class="btn btn-default kh22-b" id="btnchangedate">ផ្លាស់ប្តូរថ្ងៃទី</button> --}}
                            <div class="dropdown" style="display:inline;">
                                <button type="button" class="buttonstyle dropdown-toggle kh16" data-bs-toggle="dropdown">
                                  ផ្សេងៗ
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item kh16 btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                                </ul>
                            </div>
                        @endif
                    </td>
                    <td style="padding:0px;">
                        <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:-5px;" readonly>
                    </td>
                    <td style="padding:0px;">
                        <span class="input-group-text" style="width:40px;height:30px;margin-top:-5px;"><i class="fa fa-calendar"></i></span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
          <table class="table">
            <tr>
              {{-- <td style="border-style:none;" class="kh22">ដៃគូ=<span class="kh22" id="precord">{{ $partner_records }} Records</span></td>
              <td style="border-style:none;" class="kh22">&nbsp;&nbsp;&nbsp; ធនាគា=<span class="kh22" id="brecord">{{ $bank_records }} Records</span></td> --}}
              <td style="text-align:right;border-style:none;">
                <select name="filteruser" id="filteruser" style="height:30px;" class="kh16-b">
                    <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                    @endforeach
                </select>
                <button class="btn-3d kh16-b"  id="btnrefresh">Refresh Data</button>
              </td>
            </tr>
          </table>
        </div>
    </div>
    <div class="row" style="margin-top:-30px;">
        <form id="frmtransfer" action="">
            <div class="row">
                <div id="myDiv1">
                        <div class="row" style="">
                            <div class="col-lg-12">
                                <input type="hidden" id="location_id" name="location_id" value='-1'>
                                <input type="hidden" id="hasmultitransfer" name="hasmultitransfer" value='0'>
                                <input type="hidden" id="hasexchange" name="hasexchange" value='0'>
                                <input type="hidden" id="hasexchangefix" name="hasexchangefix" value='0'>
                                <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0'>
                                <input type="hidden" id="tranname" name="tranname" value=''>
                                <input type="hidden" id="trancode1" name="trancode1">
                                <input type="hidden" id="trancode2" name="trancode2">
                                <input type="hidden" id="child_id" name="child_id">
                                <input type="hidden" id="mekun" name="mekun" value="0">
                                <input type="hidden" id="countrycode" name="countrycode" value="0">
                                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">

                                <div class="row">

                                    <div class="table-responsive" style="">
                                        <table id="tbl_partner" class="table" style="table-layout:fixed;">
                                            <tr id="row_title" style="background-color:rgb(184, 14, 133);">

                                                <td colspan=3 style="padding:7px;text-align:center;">
                                                    <span id="m_title" class="kh18-b" style="color:white;"></span>


                                                    <label style="color:white;margin-top:-3px;float:right;" for="cklockdata" class="form-check-label kh16">ចងចាំទិន្ន័យ</label>
                                                    <input class="form-check-input" style="float:right;color:black;" type="checkbox" id="cklockdata" name="cklockdata" value="">

                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="kh16" style="">វេរចំនួន</td>
                                                <td style="" colspan=2>
                                                    <div class="input-group ">

                                                        <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" style="text-align:right;height:30px;border:2px solid green;" autocomplete="off" readonly>
                                                        <select name="selcur" id="selcur" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </td>

                                            </tr>
                                            <tr id="row_cuscharge">
                                                <td class="kh16">
                                                    <span id="spanseva">សេវ៉ាវេរ</span>
                                                    <span id="divckwater" style="float:right;">
                                                        <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                                        <label for="ckwater" class="form-check-label kh16">ដកទឹក</label>
                                                    </span>
                                                </td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="cuscharge" name="cuscharge" style="text-align:right;height:30px;" value="0">
                                                        <select name="selcur1" id="selcur1" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr id="row_totalcash">
                                                <td class="kh16">សរុបទឹកប្រាក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="text-align:right;height:30px;" readonly>
                                                        <input type="text" class="input-group kh16-b" id="txtcur" style="width:80px;height:30px;" readonly>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="kh16">សេវ៉ាដៃគូ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="fee" name="fee" style="text-align:right;height:30px;" value="0">
                                                        <select name="txtcur1" id="txtcur1" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                            </tr>

                                            <tr id="row_kabrak1" style="display:none;">
                                                <td class="kh16">ការប្រាក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="interest1" name="interest1" style="width:100%;text-align:right;height:40px;" value="0">
                                                        <input type="text" class="input-group kh16-b" id="txtcur_rate1" style="width:80px;height:40px;" readonly>

                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>

                                                <td colspan=3 style="text-align:right;">
                                                    {{-- <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radall" value="all">
                                                    <label class="form-check-label kh16-b" for="radall">ទាំងអស់</label>
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radpartner" value="PARTNER">
                                                    <label class="form-check-label kh16-b" for="radpartner">ដៃគូ</label> --}}
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radbank" value="BANK" checked>
                                                    <label class="form-check-label kh16-b" for="radbank">ធនាគា</label>
                                                    {{-- <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radcustomer" value="CUSTOMER">
                                                    <label class="form-check-label kh16-b" for="radcustomer">អតិថិជន</label> --}}
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radagent" value="AGENT">
                                                    <label class="form-check-label kh16-b" for="radagent">ភ្នាក់ងារ</label>
                                                    {{-- <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radnolist" value="NOLIST">
                                                    <label class="form-check-label kh16-b" for="radnolist">ជំនួយ</label> --}}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="width:150px;"><label for="selpartner" class="kh16" style="">ជ្រើសរើសដៃគូ(<span id="lblpartner" class="kh16">BANK</span>)</label></td>
                                                <td colspan=2>
                                                    <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%;">
                                                        <option value=""></option>
                                                        @foreach ($partners->where('customertype','BANK') as $p)
                                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}" userconnect="{{ $p->user_connect }}">{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="rowbalance1" style="background-color:aliceblue;">
                                                <td class="kh16-b">សមតុល្យ</td>
                                                <td style="padding:0px;" colspan=2>
                                                    <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:red;width:49%;display:inline;" readonly>
                                                    <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:aliceblue;text-align:right;color:blue;width:50%;display:inline;" readonly>
                                                </td>

                                            </tr>
                                            <tr id="row_son_hide" style="display:none;">
                                                <td style=""><label for="son" class="kh16" style="">បន្តទៅកូនសាខា</label></td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" id="son" name="son" class="form-control kh16" style="height:30px;">
                                                        <input type="button" class="input-group" id="btnbrowseson" value="..." style="width:30px;border:1px solid black;">

                                                    <div>
                                                </td>
                                            </tr>
                                            <tr id="rowseluseraffect1" style="display:none;">
                                                <td class="kh16" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                                <td colspan=2>
                                                    <select class="kh16" name="seluseraffect1" id="seluseraffect1" style="width:100%;">
                                                        <option value=""></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="rowcustomer_hide" style="display:none;">
                                                <td><label class="kh16">ជ្រើសរើសអតិថិជន</label></td>
                                                <td colspan=2>
                                                    <select class="form-select kh16" name="selcustomer" id="selcustomer" style="width:100%">
                                                        <option value=""></option>
                                                        @foreach ($customers as $c)
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="rowitem_hide" style="display:none;">
                                                <td><label class="kh16">កុងធនាគា</label></td>
                                                <td colspan=2>
                                                    <select class="form-select kh16" name="selitem" id="selitem" style="width:100%;height:30px;">

                                                    </select>
                                                </td>
                                            </tr>

                                            {{-- <tr>
                                                <td>
                                                    <i class="fa fa-volume-control-phone"></i>
                                                    <label for="sendertel" class="kh16" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                                </td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16 canenter" id="sendertel" name="sendertel" style="height:30px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-address-book-o"></i>
                                                    <label for="sendername" class="kh16" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label>
                                                </td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16 canenter" id="sendername" name="sendername" style="height:30px;">
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td>
                                                    <i class="fa fa-volume-control-phone"></i>
                                                    <label for="rectel" class="kh16" style="width:120px;">លេខអ្នកទទួល</label>
                                                </td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16 canenter" id="rectel" name="rectel" style="height:30px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-address-book-o"></i>
                                                    <label for="recname" class="kh16" style="width:120px;">ឈ្មោះអ្នកទទួល</label>
                                                </td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16 canenter" id="recname" name="recname" style="height:30px;">
                                                </td>
                                            </tr>

                                            <tr style="display:none;">
                                                <td colspan=3>
                                                    <button id="btnshowtemplist" class="button1 kh16-b">ShowTempList</button>
                                                    <button class="button1" style="float:right;font-weight:bold;" id="btnaddtransferlist">ADD TO TRANSFER LIST</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:30px;position: sticky; bottom: 0; z-index: 1;">
                            <div id="divtransferlist" style="display:none">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="kh22-b">តារាងផ្ទេរប្រាក់ច្រើនតួ</h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-md">X</button></span>
                                            <span style="font-size:22px;margin-left:20px;"><button id="btncleartransferlist" class="btn btn-warning btn-md kh16-b">សំអាត</button></span>

                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tbl_tranferlist" class="table table-bordered">
                                            <thead style="text-align:center;" class="kh16">
                                                <th>No</th>
                                                <th>ថ្ងៃទី</th>
                                                <th>អ្នកកត់ត្រា</th>
                                                <th>ដៃគូពាក់ព័ន្ធ</th>
                                                <th>ប្រតិបត្តិការណ៏</th>
                                                <th style="display:none;">Trancode</th>
                                                <th style="display:none;">Mekun</th>
                                                <th>ចំនួនទឹកប្រាក់</th>
                                                <th>រូបិយ</th>
                                                <th>សេវ៉ាវេរ</th>
                                                <th>រូបិយ</th>
                                                <th>សេវ៉ាដៃគូ</th>
                                                <th>រូបិយ</th>
                                                <th>លេខទទួល</th>
                                                <th>ឈ្មោះទទួល</th>
                                                <th>លេខផ្ញើ</th>
                                                <th>ឈ្មោះផ្ញើ</th>
                                                <th>បុ.ពាក់ព័ន្ធ</th>
                                                <th>សកម្មភាព</th>
                                                <th>No</th>
                                            </thead>
                                            <tbody id="body_divtransferlist">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <select name="selbank" id="selbank" class="form-select kh22" style="display:none;">
                            <option value="">Select Bank</option>
                            @foreach ($banks as $b)
                                <option value="{{ $b->id }}" customertype="{{ $b->customertype }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <div id="divbtnphone" class="row" style="margin-bottom:50px;margin-top:-30px;display:none;">
                            <div class="tableFixFooter">
                                <table id="tblbutton" class="" style="margin:0px;padding:0px;display:none;">
                                    <tr>
                                        <td>
                                            <button id="btnnew_phone" class="button1 kh16-b btnnew" style="width:100px;">សំអាតថ្មី</button>
                                        </td>
                                        <td>
                                            {{-- <button id="btnexchange" class="btn btn-primary kh16-b btnexchange" title="CTRL+1">ប្តូរប្រាក់១</button> --}}
                                            <button id="btnexchange2_phone" class="button1 kh16-b btnexchange2" title="Ctrl + E" style="width:100px;" >ប្តូរប្រាក់</button>
                                        </td>
                                        <td>
                                            <button id="btncontinue_phone" class="button1 kh16-b btncontinue" title="Ctrl + G" style="width:100px;">បន្តទៅ</button>
                                        </td>
                                        <td>
                                            <button id="btnbankpayment_phone" class="button1 kh16-b btnbankpayment" title="CTRL+B" style="width:120px;">ទូទាត់តាមធនាគា</button>
                                        </td>

                                        <td>
                                            <button id="btnsavetransfer_phone" class="button1 kh16-b btnsavetransfer" style="width:100px;">រក្សាទុក</button>
                                        </td>
                                        <td>
                                            <button id="btnsavetransferprint_phone" class="button1 kh16-b btnsavetransferprint" style="width:100px;">រក្សាទុកព្រីន</button>
                                        </td>
                                        <td>
                                            <button id="btnsavewithcashdraw_phone" class="button1 kh16-b btnsavewithcashdraw" style="width:100px;">បើកវេរ</button>
                                        </td>
                                        <td>
                                            <button id="btnsavewithcashdrawprint_phone" class="button1 kh16-b btnsavewithcashdrawprint" style="width:100px;">បើកវេរព្រីន</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
                <div id="myDiv2" style="">
                    <div class="row">
                        <div id="divcontinue" style="display:none;">
                            <div class="card" id="continuecard" >
                                <div class="card-header" style="text-align:center;height:40px;">
                                    <h1 class="kh16-b" style="display:inline">ដៃគូបន្ត</h1>
                                    <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivcontinue" class="btn btn-danger btn-sm">X</button></span>
                                </div>
                                <div class="card-body" style="padding:0px 10px 0px 10px;">
                                    <div class="row mb-3">
                                        <div class="table-responsive">
                                            <table id="tbl_continue_partner" class="table">
                                                <tr>
                                                    <td colspan=3 style="text-align:right;">
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radall2" value="all" checked>
                                                        <label class="form-check-label kh16-b" for="radall2">ទាំងអស់</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radpartner2" value="PARTNER">
                                                        <label class="form-check-label kh16-b" for="radpartner2">ដៃគូ</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radbank2" value="BANK">
                                                        <label class="form-check-label kh16-b" for="radbank2">ធនាគា</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radcustomer2" value="CUSTOMER">
                                                        <label class="form-check-label kh16-b" for="radcustomer2">អតិថិជន</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radagent2" value="AGENT">
                                                        <label class="form-check-label kh16-b" for="radagent2">ភ្នាក់ងារ</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="date" class="kh16" style="width:120px;">ជ្រើសរើសដៃគូ  <span id="lblpartner2" class="kh14-b">PARTNER</span></label>
                                                    </td>
                                                    <td colspan=2>
                                                        <select class="form-select kh16" name="selpartner2" id="selpartner2" style="width:100%">
                                                            <option value=""></option>
                                                            {{-- <optgroup label="ដៃគូ"> --}}
                                                                @foreach ($partners->where('customertype','PARTNER') as $p)
                                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                @endforeach
                                                            {{-- </optgroup> --}}
                                                            {{-- <optgroup label="ធនាគា"> --}}
                                                                @foreach ($partners->where('customertype','BANK') as $p)
                                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                @endforeach
                                                            {{-- </optgroup> --}}
                                                            {{-- <optgroup label="ភ្នាក់ងារ"> --}}
                                                                @foreach ($partners->where('customertype','AGENT') as $p)
                                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                @endforeach
                                                            {{-- </optgroup> --}}
                                                            @if (Auth::user()->role->name=='Admin')
                                                            {{-- <optgroup label="អតិថិជន"> --}}
                                                                @foreach ($customers as $p)
                                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                @endforeach
                                                            {{-- </optgroup> --}}
                                                            @endif
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="rowseluseraffect2" style="display:none;">
                                                    <td class="kh16" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                                    <td colspan=2>
                                                        <select class="kh16" name="seluseraffect2" id="seluseraffect2" style="width:100%;height:30px;">
                                                            <option value=""></option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="kh16">ចំនួនទឹកប្រាក់វេរ</td>
                                                    <td colspan=2>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh16-b canenter" id="amountcontinue" name="amountcontinue" style="text-align:right;height:30px;" autocomplete="off">
                                                            <select name="selcurcontinue" id="selcurcontinue" class="input-group kh16-b" style="width:80px;height:30px;">
                                                                <option value=""></option>
                                                                @foreach ($currencies as $c)
                                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="kh16">សេវ៉ាបន្ត
                                                        <span id="divckwater2" style="float:right;">
                                                            <input class="form-check-input" type="checkbox" id="ckwater2" name="ckwater2" value=""  style="">
                                                            <label for="ckwater2" class="form-check-label kh16">ដកទឹក</label>
                                                        </span>
                                                    </td>
                                                    <td colspan=2>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh16-b canenter" id="cuscharge2" name="cuscharge2" style="text-align:right;height:30px;" autocomplete="off">
                                                            <select name="selcuschargecontinuecur" id="selcuschargecontinuecur" class="input-group kh16-b" style="width:80px;height:30px;">
                                                                <option value=""></option>
                                                                @foreach ($currencies as $c)
                                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr id="row_totalcash2">
                                                    <td class="kh16">សរុបទឹកប្រាក់</td>
                                                    <td colspan=2>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh16-b" id="totalcash2" name="totalcash2" style="text-align:right;height:30px;" readonly>
                                                            <input type="text" class="input-group kh16-b" id="txtcur3" style="width:80px;height:30px;" readonly>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="kh16">សេវ៉ាដៃគូ</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh16-b canenter" id="fee2" name="fee2" style="text-align:right;height:30px;">
                                                            <select name="txtcur2" id="txtcur2" class="input-group kh16-b" style="width:80px;height:30px;">
                                                                <option value=""></option>
                                                                @foreach ($currencies as $c)
                                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr id="row_kabrak2" style="display:none;">
                                                    <td class="kh16">ការប្រាក់</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh16" id="interest2" name="interest2" style="text-align:right;height:30px;" value="0">
                                                            <input type="text" class="input-group kh16" id="txtcur_rate2" style="width:150px;height:30px;" readonly>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="divexchangefix" style="display:none;">
                            <div class="card" style="">
                                <div class="card-header" style="text-align:center;height:40px;background-color:#caaf8f">
                                    <h1 class="kh18-b" style="display:inline">ប្តូរប្រាក់កំណត់</h1>
                                    <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivexchangefix" class="btn btn-danger btn-sm">X</button></span>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;padding:0px;">
                                    <div class="row" style="">
                                    <div class="table-responsive">

                                            <table id="tbl_exchange2" class="" style="margin:0px;padding:0px;">
                                                <thead class="kh16-b" style="text-align:center;">
                                                <th>លរ</th>
                                                <th id="thbuy" colspan=3>ទិញចូល</th>
                                                <th>អត្រា</th>
                                                <th id='thsale' colspan=3>លក់ចេញ</th>
                                                <th>Rate</th>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">1</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:blue;" autocomplete="off"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:red;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">2</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" autocomplete="off" style="color:blue;"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:red;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">3</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" autocomplete="off" style="color:blue;"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" autocomplete="off" style="color:red;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>

                                                <tr><td colspan=8></td></tr>
                                                <tr><td colspan=8></td></tr>
                                                <tr><td colspan=8></td></tr>

                                                <tr style="background-color:blueviolet;margin-top:20px;">
                                                    <td style="display:none;"><input type="text" id="txtmainamt"  class="form-control txtexchangefix" style="color:blue;" readonly></td>
                                                    <td colspan=4 style="text-align:center;background-color:grey"><input type="button" style="" class="" id="btnexchangemore" value="More Exchange"></td>
                                                    <td colspan=1 class="kh16-b" style="text-align:right;color:white;">លុយវេរនៅសល់</td>
                                                    <td colspan=2><input type="text" id="txtleftamt"  class="form-control txtexchangefix" style="color:white;background-color:blueviolet" readonly></td>
                                                    <td><input type="text" id="txtleftcur" value="" class="form-control txtexchangefix" style="width:60px;text-align:center;color:white;background-color:blueviolet" readonly></td>
                                                    <td style="text-align:center;background-color:grey"><input type="button" style="" class="" id="btnaddexchange2" value="Add List"></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="divexchangecard" style="display:none;margin-top:-5px;">
                            <div class="card" style="">
                                <div class="card-header" style="text-align:center;height:40px;">
                                    <h1 class="kh18-b" style="display:inline">ប្តូរប្រាក់ចំរុះ</h1>
                                    <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivexchangecard" class="btn btn-danger btn-sm">X</button></span>

                                </div>
                                <div class="card-body" style="padding-bottom:0px;">
                                    <div class="row mb-3">
                                        <div class="table-responsive">

                                                <table id="tbl_exchange" class="table kh22">
                                                    <tr>
                                                        <td><input type="text" name="txtsign" id="txtsign" value="+" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtbuy" id="txtbuy" class="form-control txtexchange canenter" autocomplete="off" style="color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                        <td><input type="text" name="lblbuy" id="lblbuy" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" value="Rate" id="lblrate" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" autocomplete="off" style=""></td>
                                                        <td><input type="button" id="btnaddlist" value="ADD" class="btn btn-info txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="txtsign1" value="-" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtsale" id="txtsale" class="form-control txtexchange" style="color:red;"></td>
                                                        <td><input type="text" name="lblsale" id="lblsale" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>
                                                </table>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="divexchangelist" style="display:none;margin-bottom:5px;margin-top:-5px;">
                            <div  class="card">
                                <div class="card-header" style="height:40px;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="kh18-b">Multi Exchange</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:16px;margin-left:20px;"><button id="btnclosedivexchangelist" class="btn btn-danger btn-sm">X</button></span>
                                            <button id="btnclearlist" class="btn btn-info btn-sm" style="float:right;">Clear List</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;" id="multiexchangecard">

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="tablemultiexchange" class="table table-bordered">
                                                <thead style="text-align:center;">
                                                    <th>No</th>
                                                    <th>Buy</th>
                                                    <th>Cur</th>
                                                    <th style="display:none;">Buyinfo</th>
                                                    <th>Rate</th>
                                                    <th style="display:none;">Rateinfo</th>
                                                    <th>Sale</th>
                                                    <th>Cur</th>
                                                    <th style="display:none;">Saleinfo</th>
                                                    <th style="display:none;">Drate</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="multiexlist">
                                                    @foreach ($mex as $key => $m)
                                                        <tr>
                                                            <td style="text-align:center;">{{ ++$key }}</td>
                                                            <td>
                                                                <input type="text" name="txtbuys[]" class="form-control" readonly style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->buy) }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtcurbuys[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->curbuy }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtbuyinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->buyinfo }}">
                                                            </td>
                                                            <td style="">
                                                                <input type="text" name="txtrates[]" class="form-control" readonly style="width:80px;border-style:none;padding:5px;text-align:center;" value="{{ phpformatnumber($m->rate) }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtrateinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:0px;" value="{{ $m->rateinfo }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtsales[]" class="form-control" readonly style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->sale) }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtcursales[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->cursale }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtsaleinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->saleinfo }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtdrates[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->drate }}">
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Del</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="kh16">
                                                        <th>សរុបទឹកប្រាក់ទទួល</th>

                                                    </thead>
                                                    <tbody>

                                                        @foreach ($cashin as $ci)
                                                        <tr>
                                                            <td style="font-size:22px;color:blue;text-align:right;">{{ phpformatnumber($ci['value']) }} &nbsp; {{ $ci['cur'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="kh16">
                                                        <th>សរុបទឹកប្រាក់ប្រគល់</th>

                                                    </thead>
                                                    <tbody>

                                                        @foreach ($cashout as $co)
                                                            <tr>
                                                                <td style="font-size:22px;color:red;text-align:right;">{{ phpformatnumber($co['value']) }} &nbsp; {{ $co['cur'] }}</td>
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
                    <div class="row">
                        <div id="divbankpayment" style="display:none;margin-top:-5px;">
                            <div class="card">
                                <div class="card-header" style="height:40px;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="kh18-b">Bank Payment</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:16px;margin-left:20px;margin-top:-5px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-sm">X</button></span>
                                            <button id="btnaddrow" class="btn btn-info btn-sm" style="float:right;margin-top:-5px;">add row</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;">
                                    <div class="table-responsive">
                                        <table id="tbl_bankpayment" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th style="display:none;">No</th>
                                                <th>Bank ID</th>
                                                <th style="display:none;">Bank Name</th>
                                                <th>Amount</th>
                                                <th>Cur</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="body_bankpayment">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="position: relative;z-index: 1;">
                        <div id="divgettransaction" style="">
                            {{-- <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="kh18-b">តារាងផ្ទេរប្រាក់រួចរាល់</h3>
                                </div>
                                <div class="col-lg-6">
                                    <span style="float:right;font-size:16px;margin-left:20px;margin-top:-5px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-sm">X</button></span>
                                </div>
                            </div> --}}
                            <div class="tableFixHead">
                                <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                                    <thead style="text-align:center;" class="kh16" style="">
                                        <th style="width:70px;">No</th>
                                        <th style="width:100px;">ម៉ោង</th>
                                        <th style="width:280px;">ដៃគូពាក់ព័ន្ធ</th>
                                        <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                                        <th style="width:100px;">សេវ៉ាវេរ</th>
                                        <th style="width:100px;">សេវ៉ាដៃគូ</th>
                                        <th style="width:130px;">អ្នកកត់ត្រា</th>
                                        <th style="width:200px;">លេខអ្នកទទួល</th>
                                        <th style="width:200px;">ឈ្មោះអ្នកទទួល</th>
                                        <th style="width:200px;">លេខអ្នកផ្ញើ</th>
                                        <th style="width:200px;">ឈ្មោះអ្នកផ្ញើ</th>
                                        <th style="width:250px;">ផ្សេងៗ</th>
                                    </thead>
                                    <tbody id="body_transaction" style="">
                                        @foreach ($transfers as $k => $tr)
                                        <tr>
                                            <td style="text-align:center;padding:0px;" class="kh12">
                                            {{-- <div class="dropdown">
                                                <button style="width:70px;" type="button" class="btn btn-primary dropdown-toggle kh12" data-bs-toggle="dropdown">
                                                {{ ++$k }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-cashdraw_id="{{ $tr->cashdraw_id }}">Print</a></li>
                                                    @if(str_contains($tr->action,'u'))
                                                        <li><a href="{{ route('usercapital.updatetransactiongroup',['id'=>$tr->id,'ref_group_id'=>$tr->ref_group_id,'user_id'=>$tr->user_id]) }}" class="dropdown-item kh16-b btnupdate" target="_blank">Edit</a></li>
                                                    @endif
                                                    @if(!$tr->ref_group_id)
                                                        @if(str_contains($tr->action,'d'))
                                                        @if (Auth::user()->role->name<>'Admin')
                                                            @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                            <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                            @endif
                                                        @else
                                                            <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                        @endif
                                                        @endif
                                                    @endif
                                                    @if($tr->ref_group_id)
                                                        <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>
                                                    @endif
                                                </ul>
                                            </div> --}}
                                            <div class="dropdown">
                                                <button style="width:70px;@if(str_contains($tr->action,'u')) background-color:yellow; @endif" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                                {{ ++$k }}
                                                </button>
                                                <ul class="dropdown-menu">
                                                <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-cashdraw_id="{{ $tr->cashdraw_id }}">Print</a></li>
                                                @if(str_contains($tr->action,'u'))
                                                    <li><a href="{{ route('usercapital.updatetransactiongroup',['id'=>$tr->id,'ref_group_id'=>$tr->ref_group_id,'user_id'=>$tr->user_id]) }}" class="dropdown-item kh16-b btnupdate" target="_blank">Edit</a></li>
                                                @endif
                                                @if(!$tr->ref_group_id)
                                                    @if(str_contains($tr->action,'d'))
                                                    @if (Auth::user()->role->name<>'Admin')
                                                        @if (App\User::checkpermission(Auth::id(),'1.3.1'))
                                                        <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                        @endif
                                                    @else
                                                        <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                                    @endif
                                                    @endif
                                                @endif
                                                @if($tr->ref_group_id)
                                                    <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>

                                                @endif

                                                </ul>
                                            </div>
                                            </td>
                                            <td class="kh16" style="padding:0px;">
                                            <input type="text" style="border-style:none;width:100px;text-align:center;background-color:inherit;" readonly value="{{ $tr->tt }}">
                                            </td>
                                            <td class="kh16">{{ $tr->tranname . ' ' . $tr->partner->name }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
                                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->fee) .$tr->feecurrency->sk }}</td>
                                            <td class="kh16">{{ $tr->user->name }}</td>
                                            <td class="kh16" style="text-align:right;">{{ $tr->rectel }}</td>
                                            <td class="kh16">{{ $tr->recname }}</td>
                                            <td class="kh16" style="text-align:right;">{{ $tr->sendertel }}</td>
                                            <td class="kh16">{{ $tr->sendername }}</td>
                                            <td class="kh16">{{ $tr->note }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <footer class="page-footer" style="height:30px;margin-bottom:35px;padding:0px;background-color:inherit;border-style:none;z-index:0;">
        <div class="row" style="margin-top:-20px;display:none;width:100%;" id="divaction">
            <div class="table-responsive">
                <table id='tblbutton' style="margin-left:5px;">
                    <tr>
                        <td>
                            <button id="btnnew" class="button1 btnnew kh16-b" style="width:100px;">សំអាតថ្មី</button>
                        </td>

                        <td>
                            <button id="btncontinue" class="button1 btncontinue kh16-b" title="Ctrl + G" style="width:100px;">បន្តទៅ</button>
                        </td>
                        <td>
                            {{-- <button id="btnexchange" class="btn btn-primary kh16-b" title="CTRL+1">ប្តូរប្រាក់១</button> --}}
                            <button id="btnexchange2" class="button1 btnexchange2 kh16-b" title="Ctrl + E" style="width:100px;" > ប្តូរប្រាក់ </button>
                        </td>
                        <td>
                            <button id="btnbankpayment" class="button1 btnbankpayment kh16-b" title="CTRL+B" style="display:none;">ទូទាត់តាមធនាគា</button>
                        </td>

                        <td>
                            <button id="btnsavetransfer" class="button1 btnsavetransfer kh16-b" style="width:100px;">រក្សាទុក</button>
                        </td>
                        <td>
                            <button id="btnsavetransferprint" class="button1 btnsavetransferprint kh16-b" style="width:100px;">រក្សាទុកព្រីន</button>
                        </td>
                        <td>
                            <button id="btnsavewithcashdraw" class="button1 btnsavewithcashdraw kh16-b" style="width:120px;">រក្សាទុកបើកវេរ</button>
                        </td>
                        <td>
                            <button id="btnsavewithcashdrawprint" class="button1 kh16-b btnsavewithcashdrawprint" style="margin-right:10px;width:100px;">បើកវេរព្រីន</button>
                        </td>
                    </tr>
                </table>

            </div>
        </div>


    </footer>

    @include('moneytransfers.searchchildmodal')
    {{-- @include('moneytransfers.formtransfermodal') --}}
    @include('moneytransfers.showreadyinputamtandtel_modal')
@endsection
@section('script')
    @include('moneytransfers.searchchildscript')
    @include('moneytransfers.transferscript')
@endsection
