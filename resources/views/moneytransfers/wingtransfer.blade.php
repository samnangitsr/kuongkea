@extends('master')
@section('title') Wing Transfer @endsection
@section('css')
    <style type="text/css">
        body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;}
	/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;}

    #seltranname + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;background-color:aqua;}
	/* Each result */
	#select2-seltranname-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;background-color:yellow;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;font-weight:bold;background-color:yellow;}

    #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:18px;}

    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
        .en14{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
            }
        .en14-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
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
        .tableFixHead{ overflow: auto;height:400px;background-color:white;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_transferlist td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tableFixHead1{ overflow: auto;height:260px;background-color:white;}
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
        /* #tbl_transferlist tr:hover {background-color:rgb(231, 173, 248) !important;} */
        /* #tbl_transferlist td:hover {background-color:rgb(231, 173, 248) !important;} */
        .button1:hover {
                background-color: #8fe9c8;
                color: rgb(19, 57, 230);
            }
        .button1{
            border:1px solid gray;
            padding:5px;
        }
        .mybtn:hover {
                background-color: #8fe9c8;
                color: rgb(230, 19, 142);
            }
        .mybtn{
            border:1px solid rgb(128, 128, 128);
            padding:5px;
        }
        .bkaqua{
            background-color:aqua
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
            <table id="tbl_tranname" class="">
                <tr id="row_tranname">
                       {{-- @foreach ($trannames->where('popular',1) as $t)
                        <td>
                            <button class="mybtn kh16-b  btntranname" id="{{ $t->id }}" onClick="reply_click(this,this.id)">{{ $t->name }}</button>
                        </td>
                        @endforeach --}}
                   </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="table-responsive">
                    <table>
                      <tr>
                          <td style="padding:0px;width:120px;">
                              <label for="date" class="kh16" style="">ថ្ងៃទី</label>
                          </td>
                          <td style="padding:0px 0px 0px 5px;">
                              <label for="date" class="kh16" style="">អ្នកកត់ត្រា</label>
                          </td>
                          <td style="padding:0px">
                              <label for="date" class="kh16" style="">ឈ្មោះគណនេយ្យ</label>
                          </td>

                      </tr>
                      <tr>
                        {{-- <td style="border-style:none;" class="kh22">ដៃគូ=<span class="kh22" id="precord">Records</span></td>
                        <td style="border-style:none;" class="kh22">&nbsp;&nbsp;&nbsp; ធនាគា=<span class="kh22" id="brecord">Records</span></td> --}}

                        <td style="padding:0px">
                            <input type="text" name="invdate1" id="invdate1" class="form-control kh14-b" style="width:110px;background-color:white;height:35px;">
                        </td>

                        <td style="padding:0px 0px 0px 5px;">
                            <select name="seluser" id="seluser" class="form-select kh14-b" style="width:180px;">
                                <option value="all">បុគ្គលិកទាំងអស់</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="padding:0px">
                            <select class="form-select select2-option kh14-b" name="selaccount" id="selaccount" style="width:250px;">
                                {{-- <option value=""></option> --}}
                                @foreach ($partners as $p)
                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" agenttype="{{ $p->agent_type_id }}" countrycode="{{ $p->tel }}" maxtransfer="{{ $p->max_transfer }}" maxcuscharge="{{ $p->max_fee }}" maxfee="{{ $p->cashdraw_agentfee }}" @if(Auth::id()==$p->user_connect) selected @endif>{{ $p->name }}</option>
                                @endforeach

                            </select>
                        </td>
                        <td>
                            <button class="button1" id="btnsearch">Search</button>
                        </td>
                        <td>
                            <input type="text" class="kh16" id="tableSearch" style="width:200px;"  placeholder="Search here ..." title="Type what you khnow">
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-6">
                <form id="frmtransfer" action="">
                    <input type="hidden" class=" form-control" id="id1">
                    <input type="hidden" class=" form-control" id="id2">
                    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                    <div class="row" style="margin-right:10px;">

                        {{-- <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;height:40px;">
                            <table class="table" style="margin:0px;">
                            <tr>
                                <td style="width:15%;border-style:none;padding:0px;">
                                <div id="divcklockdata" class="form-check kh16">
                                    <input class="form-check-input" type="checkbox" id="cklockdata" name="cklockdata" value="" >
                                    <label style="color:white;margin-top:-5px;" for="cklockdata" class="form-check-label kh18">ចងចាំទិន្ន័យ</label>
                                </div>
                                </td>
                                <td style="border-style:none;padding:0px;width:70%">
                                <h1 id="partner_title" class="kh18-b" style="display:inline">ជ្រើសរើសដៃគូ</h1>
                                </td>
                                <td style="width:15%;border-style:none;padding:0px;">

                                </td>
                            </tr>
                            </table>
                        </div> --}}

                        <table id="tbl_partner" class="table table-bordered;" style="table-layout:fixed;">
                            <tr>
                                <td style="width:200px;">
                                    <label for="date" class="kh14-b" style="width:150px;">កាលបរិច្ឆេទ</label>
                                </td>
                                <td>
                                    <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:40px;" readonly>
                                </td>
                                <td style="width:40px;">
                                    <span class="input-group-text" style="width:40px;height:40px;"><i class="fa fa-calendar"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="kh14-b" style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                <td colspan=2>
                                    <select class="form-select select2-option kh16-b" id="seltranname1" style="width:100%;display:none;">
                                        {{-- <option value=""></option>
                                        @foreach ($trannames as $trn)
                                            <option value="{{ $trn->id }}" sign="{{ $trn->sign }}">{{ $trn->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    <select class="form-select select2-option kh16-b" name="seltranname" id="seltranname" style="width:100%;">
                                        {{-- <option value=""></option>
                                        @foreach ($trannames as $trn)
                                            <option value="{{ $trn->id }}" sign="{{ $trn->sign }}">{{ $trn->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=3 style="text-align:right;">
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype1" id="radbank1" value="BANK">
                                    <label class="form-check-label kh16-b" for="radbank1">ធនាគា</label>

                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype1" id="radagent1" value="AGENT" checked>
                                    <label class="form-check-label kh16-b" for="radagent1">ភ្នាក់ងារ</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="kh14-b"><span>ACCOUNT1</span>
                                <span style="float:right;">
                                    <input id="s_acc1" type="text" class="form-control kh16-b" style="width:60px;text-align:center" value="+" readonly>
                                </span>
                                </td>
                                <td colspan=2>
                                    <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%">
                                        {{-- <option value=""></option> --}}
                                        @foreach ($partners as $p)
                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" agenttype="{{ $p->agent_type_id }}" countrycode="{{ $p->tel }}" maxtransfer="{{ $p->agenttype->transfer_amount }}" maxcuscharge="{{ $p->agenttype->customer_fee }}" maxfee="{{ $p->agenttype->cashdraw_fee }}" maxtransferfee="{{ $p->agenttype->transfer_fee }}" @if(Auth::id()==$p->user_connect) selected @endif>{{ $p->name }}</option>
                                        @endforeach

                                    </select>
                                </td>
                            </tr>

                            <tr id="rowseltype" style="display:none;background-color:yellow;">
                                <td>
                                    <input type="button" class="btn btn-danger btn-sm" style="display:none;" id="btnclosecontinue" value="close">
                                </td>
                                <td colspan=2>
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radall" value="all" checked>
                                    <label class="form-check-label kh16-b" for="radall">ទាំងអស់</label>
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radpartner" value="PARTNER">
                                    <label class="form-check-label kh16-b" for="radpartner">ដៃគូ</label>
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radbank" value="BANK">
                                    <label class="form-check-label kh16-b" for="radbank">ធនាគា</label>
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radcustomer" value="CUSTOMER">
                                    <label class="form-check-label kh16-b" for="radcustomer">អតិថិជន</label>
                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radagent" value="AGENT">
                                    <label class="form-check-label kh16-b" for="radagent">ភ្នាក់ងារ</label>
                                    @if(Auth::user()->role->name=='Admin')
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radnolist" value="NOLIST">
                                        <label class="form-check-label kh16-b" for="radnolist">ជំនួយ</label>
                                    @endif
                                </td>
                            </tr>

                            <tr id="rowacc2" style="display:none;background-color:yellow;">
                                <td class="kh14-b"><span>ACCOUNT2</span>
                                <span style="float:right;">
                                    <input id="s_acc2" type="text" class="form-control kh16-b" style="width:60px;text-align:center" value="-" readonly>
                                </span>
                                </td>
                                <td colspan=2>
                                    <select class="form-select select2-option kh16" name="selpartner2" id="selpartner2" style="width:100%;background-color:yellow;">
                                        <option value=""></option>
                                        @foreach ($partner2s as $p)
                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                        @endforeach
                                        {{-- <div id="opt_agent" style="display:none;">
                                            @foreach ($partner2s->where('customertype','AGENT') as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                            @endforeach
                                        </div>
                                        <div id="opt_partner" style="display:none;">
                                            @foreach ($partner2s->where('customertype','PARTNER') as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                            @endforeach
                                        </div>
                                        <div id="opt_bank" style="display:none;">
                                            @foreach ($partner2s->where('customertype','BANK') as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                            @endforeach
                                        </div>
                                        <div id="opt_customer" style="display:none;">
                                            @foreach ($partner2s->where('customertype','CUSTOMER') as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                            @endforeach
                                        </div> --}}
                                    </select>
                                </td>
                            </tr>
                            <tr id="rowseluseraffect2" style="display:none;">
                                <td class="kh14-b" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                <td colspan=2>
                                    <select class="form-select kh16-b" name="seluseraffect2" id="seluseraffect2" style="width:100%">
                                        <option value=""></option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="row_amount_continue" style="display:none;background-color:yellow;">
                                <td  class="kh14-b">ទឹកប្រាក់បន្ត</td>
                                <td colspan=2 style="padding-bottom:20px;">
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="amount_continue" name="amount_continue" style="text-align:right;height:30px;border:2px solid green;background-color:yellow;" autocomplete="off">
                                        <select name="selcur_continue" id="selcur_continue" class="input-group kh16-b" style="width:80px;height:30px;background-color:yellow;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>


                            {{-- <tr>
                                <td>
                                    <i class="fa fa-volume-control-phone"></i>
                                    <label for="sendertel" class="kh18" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                </td>
                                <td colspan=2>
                                    <input type="text" class="form-control kh16 canenter" id="sendertel" name="sendertel" style="height:40px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <i class="fa fa-address-book-o"></i>
                                <label for="sendername" class="kh18" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label>
                                </td>
                                <td colspan=2>
                                    <input type="text" class="form-control kh16 canenter" id="sendername" name="sendername" style="height:40px;">
                                </td>
                            </tr> --}}

                            <tr>
                                <td  class="kh14-b">ចំនួនទឹកប្រាក់វេរ</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" style="text-align:right;height:30px;border:2px solid green;" autocomplete="off" readonly>
                                        <select name="selcur" id="selcur" class="input-group kh16-b" style="width:80px;height:30px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_cuscharge">
                                <td><span id="spanseva" class="kh14-b">សេវ៉ាវេរ</span>
                                    <span id="divckwater" style="float:right;">
                                        <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                        <label for="ckwater" class="form-check-label kh14-b">ដកទឹក</label>
                                    </span>
                                </td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="cuscharge" name="cuscharge" style="text-align:right;height:30px;" value="0" autocomplete="off">
                                        <select name="selcur1" id="selcur1" class="input-group kh16-b" style="width:80px;height:30px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_totalcash">
                                <td class="kh14-b">សរុបទឹកប្រាក់</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="text-align:right;height:30px;" readonly>
                                        <input type="text" class="input-group kh16-b" id="txtcur2" style="width:80px;height:30px;" readonly>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="kh14-b">កម្រៃជើងសារ</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="fee" name="fee" style="text-align:right;height:30px;" value="0">
                                        <input type="text" class="input-group kh16-b" id="txtcur3" style="width:80px;height:30px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="rowpartnerfee" style="display:none;">
                                <td class="kh14-b">សេវ៉ាដៃគូ</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="partnerfee" name="partnerfee" style="text-align:right;height:30px;" value="0">
                                        <input type="text" class="input-group kh16-b" id="txtcur5" style="width:80px;height:30px;" readonly>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="kh14-b"><span>សមតុល្យ</span>
                                    <span style="float:right;">
                                        <input type="button" class="button1" id="btnshowbal" style="padding:2px;" value="Balance">
                                    </span>
                                </td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh18-b canenter" id="balance" name="balance" style="text-align:right;height:30px;background-color:bisque" value="0" readonly>
                                        <input type="text" class="input-group kh16-b" id="txtcur4" style="width:80px;height:30px;" readonly>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td class="kh14-b">សមតុល្យបន្ទាប់</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh18-b canenter" id="balancenext" name="balancenext" style="text-align:right;height:30px;background-color:bisque" value="0" readonly>
                                        <input type="text" class="input-group kh16-b" id="txtcur6" style="width:80px;height:30px;" readonly>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-volume-control-phone"></i>
                                    <label for="rectel" class="kh14-b" style="width:120px;">លេខអ្នកទទួល</label>
                                </td>
                                <td colspan=2>
                                    <input type="text" class="kh16 canenter" id="rectel" name="rectel" style="height:30px;width:100%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-address-book-o"></i>
                                    <label for="recname" class="kh14-b" style="width:120px;">ឈ្មោះអ្នកទទួល</label>
                                </td>
                                <td colspan=2>
                                    <input type="text" class="kh16 canenter" id="recname" name="recname" style="height:30px;width:100%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:20px 0px 0px 0px;"><button id="btncontinue" class="button1 kh16-b" style="float:left;width:100px;display:none;"> បន្តទៅ </button></td>
                                <td colspan=2 style="padding:20px 0px 0px 0px;text-align:right;">
                                    <button id="btnnew" class="button1 kh16-b" style="float:left;width:100px;"> ធ្វើថ្មី </button>
                                    <button id="btnsavetransfer" class="button1 kh16-b" style="width:100px;">រក្សាទុក</button>
                                </td>

                            </tr>
                        </table>
                    </div>

                </form>
            </div>
            <div class="col-lg-6">
                <div class="row" style="margin-top:0px;margin-bottom:0px;">
                    <div id="divgettransaction" style="padding:0px;margin:0px;">
                      <div class="card" style="padding:0px;margin:0px;">

                          <div class="card-body" style="padding:0px;margin:0px;">
                            <div class="tableFixHead">
                              <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                                  <thead style="text-align:center;" class="kh14">
                                      <th style="width:70px;padding:5px;">No</th>
                                      <th style="width:100px;padding:5px;">ម៉ោង</th>
                                      <th style="width:280px;padding:5px;">ដៃគូពាក់ព័ន្ធ</th>
                                      <th style="width:150px;padding:5px;">ចំនួនទឹកប្រាក់</th>
                                      <th style="width:100px;padding:5px;">សេវ៉ាវេរ</th>
                                      <th style="width:100px;padding:5px;">សេវ៉ាដៃគូ</th>
                                      <th style="width:130px;padding:5px;">អ្នកកត់ត្រា</th>
                                      <th style="width:200px;padding:5px;">លេខអ្នកទទួល</th>
                                      <th style="width:200px;padding:5px;">ឈ្មោះអ្នកទទួល</th>
                                      {{-- <th style="width:200px;">លេខអ្នកផ្ញើ</th>
                                      <th style="width:200px;">ឈ្មោះអ្នកផ្ញើ</th> --}}
                                      <th style="padding:5px;width:300px;">ផ្សេងៗ</th>

                                  </thead>
                                  <tbody id="body_transaction">

                                  </tbody>

                              </table>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    @include('moneytransfers.transferscript2')


@endsection
