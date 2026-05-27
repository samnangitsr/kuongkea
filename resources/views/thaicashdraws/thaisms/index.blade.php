@extends('master')
@section('title') សារលុយថៃ @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
		}
    .select2-container--default .select2-results>.select2-results__options{max-height: 360px !important;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
    #selthaiacc + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:whitesmoke;}
	#select2-selacclist-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
    #selacclist + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:whitesmoke;}
	#select2-selacclist-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

     #selthaicus + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold}
	#select2-selthaicus-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;}
      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 30px !important;
            background-color:rgb(230, 245, 240);
        }
        .select2-selection__arrow {
            height: 30px !important;
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
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
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
            }
        .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        .divaction .ulmenu a:hover{
            color:greenyellow;
        }

       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .txtexchangefix{
        padding:2px;
        font-weight:bold;
        font-size:16px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       .photo > input[type='file']{
			/* display:none; */
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		}
        .modalleft{
            margin-left:0;
            margin-top:0;
        }
        .modalright{
            margin-top:0;
            margin-right:0;
        }
        tr.borderset2{
            border-bottom:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;
        }
    .tableFixHead0{ overflow: auto;height:200px;border:1px solid green;}
    .tableFixHead10{ overflow: auto;height:160px;border:1px solid green;}
    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tableFixHead1{ overflow: auto;height:250px;border:1px solid red;}
    .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tableFixHead2{ overflow: auto;height:200px;border:1px solid blue;}
    .tableFixHead2 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tableFixHead3{ overflow: auto;height:500px;border:1px solid blue;}
    .tableFixHead3 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    #tbl_searchthailistintransfer th{
        padding:2px;
    }
    #tbl_searchthailistintransfer td{
        padding:2px;

    }

    #tblsearchmore td{
        border-style:none;
    }
    #tbl_bankpayment0 td{
        word-wrap:break-word;
    }
    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:22px;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }

       #tbl_checkamt .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_checkamt td{
        padding:3px;
       }
       #tbl_checkamt th{
        padding:3px;
       }
       tr.borderset1{
            border-top:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;

        }
        tr.borderset2{

            border-bottom:2px solid gray;
            border-left:2px solid gray;
            border-right:2px solid gray;
        }

       #divfooter{
        /* margin-right:50px; */
        color:white;
        padding:5px;
        position: fixed;
        bottom: 0;
        width: 100%;
        min-height: 50px;
        max-height: 50px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 50px;
        overflow:auto;
        clear: both;
        }

        .mybtn:hover {
            background-color: #8fe9c8 !important;
            color: rgb(19, 57, 230);
        }
        .mybtn{
            padding:3px 5px;
            border:1px solid green;
        }
        #tbl_acclist th{
            padding:3px;
        }
        #tblaction th{
            padding:2px;
        }
        #tblaction td{
            padding:0px;
        }
        #tbl_acclist td{
            padding:2px;
        }
        .tbl_acclist .clickedrow td{
        background-color: #caaf8f;
       }
       .tbl_searchthailistintransfer .clickedrow td{
        background-color: #caaf8f;
       }
       .tbl_smsinserted .clickedrow td{
        background-color: #caaf8f;
       }

       .tblsmslist .clickedrow td{
        background-color: #caaf8f;
       }
       .tbl_transfertothai .clickedrow td{
        background-color: #caaf8f;
       }
       .tbl_transfertothai1 .clickedrow td{
        background-color: #caaf8f;
       }
       .tbl_transfertothai td{
        padding:3px;
       }
       .tbl_transfertothai th{
        padding:3px;
       }
       #tbl_addsms td{
        border-style:none;
        padding:3px;
       }
       .tbl_transfertothai1 td{
        padding:3px;
       }
       .tbl_transfertothai1 th{
        padding:3px;
       }

       #tbl_smsinserted th{
        padding:3px;
       }
       #tbl_smsinserted td{
        padding:3px;
       }
       #tblsmslist td{
        padding:3px;
       }
       #tblsmslist th{
        padding:3px;
       }
       .dropdown a:hover{
            background-color:aquamarine;
       }
       #tbl_partner td{
        border-style:none;
        padding:2px;
       }
       .tbl88 td{
        border:1px solid black;
       }
       #tblaction2 th{
        padding:2px;
       }
       #tblaction2 td{
        /* border-style:none; */
        padding:2px;
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
    <div class="row" style="margin-top:-20px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="col-lg-5">
            <div class="row" style="margin-top:0px;">

                <div class="tableFixHead0" id="" style="padding:0px;margin:0px;">

                        <table class="table" style="margin-bottom:10px;">
                            <tr>
                                <td style="width:80px;">
                                    <div class="dropdown" style="display:inline">
                                        <button type="button" class="dropdown-toggle kh16" style="border:1px solid black;" data-bs-toggle="dropdown">
                                          Menu
                                        </button>
                                        <ul class="dropdown-menu ulsms">
                                            @if (Auth::user()->role->name<>'Admin')
                                                @if (App\User::checkpermission(Auth::id(),'3.1.6'))
                                                    <li><a class="dropdown-item kh16-b" href="{{ route('thaicashdraw.closelist') }}" target="_blank">បិទបញ្ជី</a></li>
                                                @endif
                                            @else
                                                {{-- <li><a class="dropdown-item kh16-b btnaccountregister" href="#">ចុះលេខបញ្ជី</a></li> --}}
                                                <li><a class="dropdown-item kh16-b" href="{{ route('thaicashdraw.closelist') }}" target="_blank">បិទបញ្ជី</a></li>
                                                <li><a class="dropdown-item kh16-b btnshowtransferthai" href="#">ប្រតិបត្តិការណ៏វេរទៅថៃ</a></li>
                                            @endif
                                        </ul>
                                      </div>
                                </td>
                                <td style="width:80px;">
                                    <button id="btnaddsms" class="mybtn kh14-b">បញ្ចូលសារ</button>
                                </td>
                                <td style="width:80px;">
                                    <button id="btnreload" class="mybtn kh14-b">Reload</button>
                                </td>

                                <td>
                                    <select name="selbysms" id="selbysms" style="width:150px;height:30px;" class="kh14-b">
                                        <option value="">All Transaction</option>
                                        <option value="1">លុយបាញ់ចូល</option>
                                        <option value="2">លុយបាញ់ចេញ</option>
                                        <option value="3">សារទូទាត់រួច</option>
                                        <option value="4">សារមិនទាន់ទូទាត់</option>

                                    </select>
                                </td>
                                <td style="text-align:right;">
                                    <button id="btnrefreshlist" class="mybtn kh14-b">Refresh</button>
                                </td>
                            </tr>
                        </table>

                    <table id="tblaction" class="table" style="table-layout:fixed;padding:0px;margin:0px;">
                        <tr class="kh14-b">
                            <th style="border-style:none;width:100px;">គិតពី</th>
                            <th style="border-style:none;width:100px;">ដល់</th>
                            <th style="border-style:none;width:140px;">ធនាគា</th>
                            <th style="border-style:none;width:140px;">លេខបញ្ជី</th>
                            <th style="border-style:none;width:100px;"> </th>
                        </tr>
                        <tr>
                            <td style="padding:0px;border-style:none;width:100px;">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" name="d1" id="d1" class="kh14-b" style="width:100px;background-color:silver;">
                                    {{-- <span class="input-group-text" style=""><i class="fa fa-calendar"></i></span> --}}
                                </div>

                            </td>
                            <td style="padding:0px;border-style:none;width:100px;">
                                <div class="input-group" style="width:100px;">
                                    <input type="text" name="d2" id="d2" class="kh14-b" style="width:100px;background-color:silver;">
                                    {{-- <span class="input-group-text" style=""><i class="fa fa-calendar"></i></span> --}}
                                </div>
                            </td>

                            <td style="padding:0px;border-style:none;width:140px;">
                                <select name="selbankname1" id="selbankname1" class="" style="font-family:Arial, Helvetica, sans-serif,font-size:14px;font-weight:bold;height:30px;width:140px;">
                                    <option value="">All</option>
                                    @foreach ($banknames as $bn)
                                        <option value="{{ $bn->bankname }}">{{ $bn->bankname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="padding:0px;border-style:none;width:140px;">
                                <select class="kh14-b" name="selthaiacc" id="selthaiacc" style="width:140px;height:30px;">
                                    <option value="" >all Account</option>
                                    @foreach ($thai_acc as $item)
                                        <option value="{{ $item->accno }}" bankname="{{ $item->bankname }}">{{ $item->accno }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="padding:0px 0px 0px 5px;border-style:none;width:100">
                                <button class="mybtn kh14-b" id="btnsearch">Search</button>
                                <button class="mybtn kh14-b" id="btnsearchmore" style="" data-bs-toggle="collapse" data-bs-target="#searchmore">...</button>
                            </td>
                        </tr>

                    </table>
                    <div id="searchmore" class="collapse show" style="margin-top:0px;margin:0px;padding:0px;">
                        <div class="row" style="margin:10px 0px;padding:0px;">
                            <div class="col-lg-3" style="padding:0px;">
                                <select name="selsearchby" id="selsearchby" class="kh14-b" style="height:30px;width:120px;">
                                    <option value="time">ម៉ោង</option>
                                    <option value="tel">លេខទូរស័ព្ទ</option>
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if (App\User::checkpermission(Auth::id(),'4.1.3'))
                                            <option value="amt">ចំនួនទឹកប្រាក់</option>
                                        @endif
                                    @else
                                        <option value="amt">ចំនួនទឹកប្រាក់</option>
                                    @endif

                                </select>
                            </div>
                            <div class="col-lg-9" style="padding-right:0px;">
                                <input type="text" id="txtsearchbytime" class="kh14-b" style="height:30px;width:120px;" title="Time" placeholder="input Time">
                                <input type="text" id="txtsearchbytel" class="kh14-b" style="height:30px;width:120px;display:none;" title="Telephone" placeholder="input Tel">
                                <input type="text" id="txtsearchbyamt1" class="kh14-b" style="height:30px;width:120px;display:none" title="Amount1" placeholder="From Amount">
                                <input type="text" id="txtsearchbyamt2" class="kh14-b" style="height:30px;width:120px;display:none" title="Amount2" placeholder="To Amount">
                                <button id="btnsearch2" class="mybtn kh14-b" style="">Search2</button>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="tableFixHead2" id="" style="padding:0px;margin:0px;">
                    <table id="tbl_acclist" class="table table-bordered table-hover kh12-b tbl_acclist" style="table-layout:fixed;">
                        <thead style="text-align:center;">
                            <th style="width:40px;">No</th>
                            <th style="width:80px;">លេខបញ្ជី</th>
                            <th style="width:100px;">លុយចាប់ផ្តើម</th>
                            <th style="width:100px;">ចេញចូល</th>
                            <th style="width:100px;">សមតុល្យ</th>
                            <th style="width:100px;">សាច់ប្រាក់</th>
                            <th style="width:100px;">ដៃគូជំពាក់</th>
                            <th style="width:100px;">ជំពាក់ដៃគូ</th>
                        </thead>
                        <tbody id="body_acclist">
                            @foreach ($myc as $k => $c)
                                @php
                                    $bal=$c['startbal'] + $c['balin'] + $c['balout'];
                                    $lomeangdork=$c['balout']-$c['baloutlist']+$c['cashin'];
                                    $lomeangbok=$c['receiveamt']-$c['balinlist'];

                                @endphp
                                <tr>
                                    <td style="text-align:center;">{{ ++$k }}</td>
                                    <td>{{ $c['accno'] }}</td>
                                    <td style="text-align:right;">{{ phpformatnumber($c['startbal'])  }}B</td>
                                    <td style="text-align:right;">
                                        <span style="color:blue;">+{{ phpformatnumber($c['balin']) }}B</span><br>
                                        <span style="color:red;">{{ phpformatnumber($c['balout']) }}B</span>
                                    </td>
                                    <td style="text-align:right;">{{ phpformatnumber($bal) }}B</td>
                                    <td style="text-align:right;color:darkgreen;">{{ phpformatnumber($c['cashin']) }}B</td>
                                    <td style="text-align:right;color:darkgreen;">
                                        {{ phpformatnumber($c['baloutlist']) }}B
                                        <br><span style="@if($lomeangdork>=0)color:blue;@else color:red; @endif">{{ phpformatnumber($lomeangdork) }}B</span>
                                    </td>
                                    <td style="text-align:right;color:darkgreen;">
                                        {{ phpformatnumber($c['balinlist']) }}B
                                        <br><span style="@if($lomeangbok>=0)color:red;@else color:blue; @endif">{{ phpformatnumber($lomeangbok) }}B</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tableFixHead" style="padding:0px;margin:0px;">
            <table id="tblsmslist" class="table table-bordered table-hover kh12 tblsmslist" style="table-layout:fixed;padding:0px;margin:0px;">
                <thead class="" style="text-align:center;">
                    <th style="width:60px;">លរ</th>
                    <th style="width:100px;">SMSID</th>
                    <th style="width:220px;">ថ្ងៃវេរចូល</th>
                    <th style="width:120px;">វេរមកពី</th>
                    <th style="width:100px;">លេខបញ្ជី</th>
                    <th style="width:120px;">ចំនួនទឹកប្រាក់</th>
                    <th style="width:200px;">ស្ថានភាព</th>
                    <th style="width:80px;">ប្រភេទទូទាត់</th>
                    <th style="width:150px;">អ្នកដាក់លុយ</th>
                    <th style="text-align:left;width:1500px;">សារ</th>
                </thead>
                <tbody id="bodysmslist">
                    @foreach ($sms as $key => $s)
                        <tr style="@if($s->amount>0)color:blue; @else color:red;@endif">
                            <td class="kh12-b" style="text-align:center;">{{ ++$key }}</td>
                            <td style="text-align:center;padding:0px;" class="kh14-b">
                                @if($s->transfer_id || $s->isopen==1)
                                    <a href="#c{{ $s->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $s->id }}</a>
                                @else
                                    <div class="dropdown">
                                        <button style="width:100px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                        {{ $s->id }}
                                        </button>
                                        <ul class="dropdown-menu" style="padding:0px;margin:0px;">
                                            <li style="background-color:rgb(137, 203, 230)"><a href="#" class="dropdown-item kh14-b btntolist" data-id="{{ $s->id }}" data-accno="{{ $s->accno }}" data-frombank="{{ $s->sendfrom }}" data-mekun="{{ $s->amount>0?'1':'-1' }}" data-amount="{{ $s->amount }}">ចូលបញ្ជី</a></li>
                                            <li style="background-color:pink"><a href="#" class="dropdown-item kh14-b btndelsms1" data-id="{{ $s->id }}">លុប</a></li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                            <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($s->smsdate)) . "(" . $s->smstime . ")"}}</td>
                            <td class="kh12-b" style="">{{ $s->sendfrom }}</td>
                            <td class="kh12-b" style="">{{ $s->accno }}</td>
                            <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($s->amount) . ' B' }}</td>
                            @if($s->opmethod=='Cash')
                                <td class="kh12-b" style="text-align:center;">{{ $s->isopen==1?$s->opname?$s->opname:'បើករួច':'' }}</td>
                            @else
                                @if($s->transfer_id)
                                    <td>
                                        <div class="dropdown">
                                            <button style="width:200px;" type="button" class="mybtn dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                                                {{ $s->opname }}
                                            </button>
                                            <ul class="dropdown-menu" style="padding:0px;margin:0px;">
                                                <li style="background-color:pink"><a href="#" class="dropdown-item kh14-b btndeltolist" data-id="{{ $s->id }}" data-transfer_id="{{ $s->transfer_id }}">លុបចូលបញ្ជី</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                @else
                                    <td style="text-align:center;">
                                        {{ $s->opmethod=='List'?'ពាក់ព័ន្ធបញ្ជីផ្សេងៗ':'' }}
                                    </td>
                                @endif

                            @endif
                            <td class="kh12-b" style="">{{ $s->opmethod }}</td>
                            <td class="kh12-b" style="">{{ $s->customer->name??'' }}</td>

                            <td class="kh12-b" style="">{{ $s->smstext . '(' . $s->smsby . ')' }}{{ $s->mix_from_id?' ID:' . $s->mix_from_id:'' }}</td>

                        </tr>

                        <tr id="c{{ $s->id }}" class="collapse borderset2" style="">
                            <td colspan=9 style="">
                                <table class="tbl88" style="margin:0px;border:1px solid blue;">
                                    <tbody>
                                        @php
                                            $i=0;
                                        @endphp
                                        @if($s->opmethod=='Cash')
                                            <tr class="kh12-b" style="text-align:center;border-top:none;">
                                                <td style="width:100px;border:1px solid black;">ID</td>
                                                <td style="width:100px;">ថ្ងៃបើក</td>
                                                <td style="width:80px;">ម៉ោង</td>
                                                <td style="width:150px;">លុយថៃ</td>
                                                <td style="width:100px;">កាត់សេវ៉ា</td>
                                                <td style="width:150px;">ចំនួនបើក</td>
                                                <td style="width:100px;">ការទូទាត់</td>
                                                <td style="width:200px;">លេខអ្នកទទួល</td>
                                                <td style="width:200px;">ឈ្មោះអ្នកទទួល</td>
                                                <td style="width:120px;">GroupID</td>
                                                <td style="width:120px;">TransferID</td>
                                                <td style="width:120px;">ExchangeID</td>


                                            </tr>
                                            @foreach(App\Models\SmsProcess::getsmsprocessbysmsid($s->id) as $p)
                                                <tr class="kh12" style="">
                                                    <td style="text-align:center;">{{ $p->id }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($p->opdate))}}</td>
                                                    <td>{{ $p->optime }}</td>

                                                    <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->thai_amount) . $p->currency->sk }}</td>
                                                    <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->cut_seva) . $p->currency->sk }}</td>
                                                    <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($p->amount) . $p->currency->sk }}</td>
                                                    <td>{{ $p->paymethod }}</td>
                                                    <td>{{ $p->rectel }}</td>
                                                    <td>{{ $p->recname }}</td>
                                                    <td>{{ $p->group_id }}</td>
                                                    <td>{{ $p->transfer_id }}</td>
                                                    <td>{{ $p->exchange_id }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach (App\Models\SmsProcess::gettransferbyid($s->transfer_id,$s->id) as $item)
                                                @php
                                                    $i=$i+1;
                                                @endphp
                                                @if($i==1)

                                                    <tr class="kh12-b" style="text-align:center;border-top:none;">
                                                        <td style="width:100px;border:1px solid black;">ID</td>
                                                        <td style="width:100px;">Date</td>
                                                        <td style="width:80px;">Time</td>
                                                        <td style="width:200px;">ដៃគូ</td>
                                                        <td style="width:150px;">ចំនួនទឹកប្រាក់</td>
                                                        <td style="width:120px;">សេវ៉ាដៃគូ</td>
                                                        <td style="width:180px;">លេខអ្នកទទួល</td>
                                                        <td style="width:200px;">ឈ្មោះអ្នកទទួល</td>
                                                        <td style="width:300px;">ផ្សេងៗ</td>
                                                    </tr>
                                                @endif
                                                <tr class="kh12" style="">
                                                    <td style="text-align:center;">{{ $item->id }}</td>
                                                    <td>
                                                        {{ date('d-m-Y',strtotime($item->dd))}}
                                                    </td>
                                                    <td>
                                                        {{ $item->tt }}
                                                    </td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>
                                                    <td class="kh12-b" style="text-align:right;">{{ phpformatnumber($item->fee) . $item->feecurrency->sk }}</td>
                                                    <td>{{ $item->rectel }}</td>
                                                    <td>{{ $item->recname }}</td>
                                                    <td>{{ $item->note }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('thaicashdraws.thaisms.addsmsmodal')
    @include('thaicashdraws.thaisms.sameamtmodal')
    @include('thaicashdraws.thaisms.partnerlistmodal')
    @include('moneytransfers.searchchildmodal')
    @include('thaicashdraws.thaisms.transferthailistmodal')
    @include('thaicashdraws.thaisms.thaiaccountmodal')
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('សារលុយថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-320;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }

        $('#selacclist').select2({
            dropdownParent: $("#addsmsmodal"),
            templateResult: formatOption
        });
        $('#selpartner').select2({
            dropdownParent: $("#partnerlistmodal"),
        });
        $('#selthaicus').select2({
            dropdownParent: $("#addsmsmodal"),
        });
        $('#selthaiacc').select2({
            templateResult: formatOption
        });

      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-263;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }

      });
      function formatOption(option) {
          if (!option.id) {
            return option.text;
          }
          // Use a <div> to display the main text and a second line
          // option.element.value is get value from select
          var $option = $(
            '<div class="select2-option">' +
              '<div class="select2-option-main">' + option.text + '</div>' +
              '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('bankname') : option.element.getAttribute('bankname')) + '</div>' +
            '</div>'
          );
          return $option;
        }

        window.addEventListener("storage", function(event) {
            if (event.key === "pageAItemAdded") {
                // Handle the event when a new item is added on Page A
                refreshContents();
            }
        });
        function refreshContents() {
            var items = JSON.parse(localStorage.getItem("items")) || [];
            location.href = location.href;
            localStorage.removeItem("pageAItemAdded");
            localStorage.removeItem("items");
        }
        $(document).ready(function () {
            $(document).keydown(function (event) {

                if (event.keyCode == 27) { // Prevent ESC
                    $('#sameamtmodal').modal('hide');
                    return false;
                }

            });
            var today=new Date();
            $('#smsdate,#listdate,#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,
            });

            var cleave = new Cleave('#txtsearchbyamt1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#feeps', {
                numeral: true,
                numeralDecimalScale: 2,
            });
            var cleave = new Cleave('#txtsearchbyamt2', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbytel', {
                blocks: [0, 3, 3, 4, 10],
                //delimiters: ['(', ') ', '-', ' '],
                numericOnly: true
            });
            var cleave = new Cleave('#amount', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#balance', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#amountlist', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#cuscharge', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#fee', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('click','#btnbrowseson',function(e){
                e.preventDefault();
                $('#searchchildmodal').modal('show');
                var selpartner=$('#selpartner').val();
                $('#sel_customer_search').val(selpartner);
                $('#sel_customer_search').trigger('change');
            })
            $(document).on('click','.btn_select',function(e){
                e.preventDefault();
                var row = $(this).closest('tr');
                var rowind=row.find("td:eq(0)").text();
                childname=row.find("td:eq(1)").text();
                addr=row.find("td:eq(3)").text();
                child_id=row.find("td:eq(4)").text();
                $('#child_id').val(child_id);
                $('#son').val(childname + '(' + addr + ')');
                $('#searchchildmodal').modal('hide');

            })
            $('#tblchildren').on('dblclick', '.rowclick', function(event) {

                var ind=$(this).index();
                var row=$(this).closest('tr');
                childname=row.find("td:eq(1)").text();
                addr=row.find("td:eq(3)").text();
                child_id=row.find("td:eq(4)").text();
                $('#son').val(childname + '(' + addr + ')');
                $('#child_id').val(child_id);
                $('#searchchildmodal').modal('hide');

            });
            function getcurrencybykeylocalstorage(key,el)
            {
                var currencylist;
                if(localStorage.getItem("currencylist")==null){
                    currencylist=[];
                }else{
                    currencylist=JSON.parse(localStorage.getItem("currencylist"));
                }
                currencylist.forEach(function(c){
                    if(c.skey==key){
                        $(el).val(c.id);
                    }
                })
            }
            function cutwater(isamtkeyup)
            {
                if(isamtkeyup!=1){
                    var ck = document.getElementById("ckwater").checked;
                    var amt=$('#amountlist').attr('title').replace(/,/g, '');
                    var cuscharge=$('#cuscharge').val().replace(/,/g, '');
                    if(ck==true){
                        var cur=$('#selcur option:selected').text();
                        var cur1=$('#selcur1 option:selected').text();
                        if(cur==cur1){
                            amt=amt-cuscharge;
                        }
                        $('#amountlist').val(formatNumber(amt));
                    }else{
                        amt=$('#amountlist').attr('title').replace(/,/g, '');
                        $('#amountlist').val(formatNumber(amt));
                    }
                }
                totalcash();
                if($('#selpartner').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amountlist').val(),$('#fee').val());
                }
                if($('#trancode1').val()==3){
                    if($('#selcustomer').val()!==''){
                        fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountlist').val(),$('#cuscharge').val());
                    }
                }

            }
            function totalcash()
            {
                var totalcash=0;
                var amt=$('#amountlist').val().replace(/,/g, '');
                var cur=$('#selcur option:selected').text();
                var cuscharge=$('#cuscharge').val().replace(/,/g, '');
                if(cuscharge=='') cuscharge=0;
                if(amt=='') amt=0;
                var cur1=$('#selcur1 option:selected').text();
                if(cur==cur1){
                    totalcash=parseFloat(amt)+parseFloat(cuscharge);
                }else{
                    totalcash=amt;
                }
                $('#totalcash').val(formatNumber(parseFloat(totalcash)));
            }
            $(document).on('change','#ckwater,#selcur1',function(e){
                cutwater(0);
            })
            $(document).on('change','#selcur',function(e){
                var curid=$(this).val();
                var cur=$('#selcur option:selected').text();
                $('#txtcur1').val(curid);
                $('#selcur1').val(curid);
                $('#txtcurtotal').val(cur);
                if($('#selpartner').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amountlist').val(),$('#fee').val());
                }

            })
            $(document).on('change','#cuscharge',function(e){
                cutwater(0);
                if($('#trancode1').val()==3){
                    if($('#selcustomer').val()!==''){
                        fillnextbalance('#balance3','#balancenext3',$('#selcur option:selected').text(),-1 * parseFloat($('#mekun').val()),$('#amountlist').val(),$('#cuscharge').val());
                    }
                }
            })
            $(document).on('change','#amountlist',function(e){
                cutwater(1);
                $('#amountlist').attr('title',$(this).val());
                if($('#selpartner').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amountlist').val(),$('#fee').val());
                }
            })
            $(document).on('change','#fee',function(e){
                var amt=$('#amountlist').val().replace(/,/g,'');
                var fee=$('#fee').val().replace(/,/g,'');
                var fp=0;
                fp=(parseFloat(fee)/parseFloat(amt))*100;
                $('#feeps').val(formatNumber(fp));
                if($('#selpartner').val()!==''){
                    fillnextbalance('#balance1','#balancenext1',$('#selcur option:selected').text(),$('#mekun').val(),$('#amountlist').val(),$('#fee').val());
                }
            })
            $(document).on('change','#feeps',function(e){
                e.preventDefault();
                var amt=$('#amountlist').val().replace(/,/g,'');
                var fp=$('#feeps').val().replace(/,/g,'');
                var fee=0;
                fee=(parseFloat(fp)*parseFloat(amt))/100;
                $('#fee').val(formatNumber(fee));
            })
            $(document).on('keyup','#cuscharge',function(e){
                const C = e.key;
                if (C === "Backspace"){
                    return;
                }
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage(C,'#selcur1');
                    totalcash();
                }
            })
            $(document).on('keyup','#fee',function(e){
                const C = e.key;
                if (C === "Backspace"){
                    return;
                }
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage(C,'#txtcur1');
                }
            })
            $(document).on('keyup','#amountlist',function(e){
                const C = e.key;
                if (C === "Backspace"){
                    return;
                }
                if(isNumber(C)==false){
                    getcurrencybykeylocalstorage(C,'#selcur');
                    var cur=$('#selcur option:selected').text();
                    $('#txtcurtotal').val(cur);
                    $('#txtcur1').val($('#selcur').val());
                    $('#selcur1').val($('#selcur').val());
                }
            })
            $(document).on('keydown', '.canenter', function (e)
            {
                if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id == 'amount') {
                        $('#smstime').focus();
                    } else if(id == 'smstime'){
                        $('#balance').focus();
                    } else if (id == 'balance'){
                        $('#btnsavesms').focus();
                    }else if (id == 'amountlist'){
                        $('#cuscharge').focus();
                    }else if (id == 'cuscharge'){
                        $('#fee').focus();
                    }else if (id == 'fee'){
                        $('#btnsavelist').focus();
                    }else if (id == 'rectel'){
                        $('#recname').focus();
                    }else if (id == 'recname'){
                        $('#amountlist').focus();
                    }else if (id == 'sendertel'){
                        $('#sendername').focus();
                    }else if (id == 'sendername'){
                        $('#rectel').focus();
                    }

                    e.preventDefault();
                }
            })
            function autocomplereceiver(){
                var sources=JSON.parse(localStorage.getItem("recphonelist"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist"));
                $( "#rectel" ).autocomplete({
                    source:sources,
                    select: function( event, ui ) {
                        $( "#rectel" ).val( ui.item.value );
                        $( "#recname" ).val( ui.item.recname );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#recname" ).autocomplete({
                    source:sources1,
                    select: function( event, ui ) {
                        $( "#recname" ).val( ui.item.value );
                        $( "#rectel" ).val( ui.item.rectel );
                        return false;
                    }

                });
               }
            function savephonetolocalstorage(callback)
            {
                localStorage.removeItem("recphonelist");
                localStorage.removeItem("sendphonelist");
                localStorage.removeItem("recnamelist");
                var url="{{ route('phonenumberlocalstorage') }}";
                $.get(url,{},function(data){
                //console.log(data);
                var recphonelist;
                var sendphonelist;
                var recnamelist;
                if(localStorage.getItem("recphonelist")==null){
                    recphonelist=[];
                }else{
                    recphonelist=JSON.parse(localStorage.getItem("recphonelist"));
                }
                if(localStorage.getItem("recnamelist")==null){
                    recnamelist=[];
                }else{
                    recnamelist=JSON.parse(localStorage.getItem("recnamelist"));
                }
                $.each(data['recphonelist'],function(i,item){
                    recphonelist.push({
                        value:item.rectel,
                        label:item.rectel,
                        recname:item.recname,
                    })
                    recnamelist.push({
                        value:item.recname,
                        label:item.recname,
                        rectel:item.rectel,
                    })
                });

                localStorage.setItem("recphonelist",JSON.stringify(recphonelist));
                localStorage.setItem("recnamelist",JSON.stringify(recnamelist));

                // sender phone
                if(localStorage.getItem("sendphonelist")==null){
                    sendphonelist=[];
                }else{
                    sendphonelist=JSON.parse(localStorage.getItem("sendphonelist"));
                }
                $.each(data['sendphonelist'],function(i,item){
                    sendphonelist.push({
                        sendertel:item.sendertel,
                        sendername:item.sendername,
                    })
                });
                localStorage.setItem("sendphonelist",JSON.stringify(sendphonelist));
                callback();
                })
            }
            function fillnextbalance(elbal,elnext,cur,sign,amt,fee)
            {
                //debugger;
                var mekun= sign;
                var amt1=amt.toString().replace(/,/g,'');
                var fee1=fee.toString().replace(/,/g,'');
                var amount=parseFloat(amt1)+parseFloat(fee1);
                //var amt2=$('#amount2').val().replace(/,/g,'');
                var i=0;
                var baltitle=$(elbal).attr('title');
                var balusd=baltitle.split(";")[0];
                var balkhr=baltitle.split(";")[1];
                var balthb=baltitle.split(";")[2];
                var balnext=0;
                var bal=0;
                var cur1='';

                if(cur=='USD'){
                        balnext=-1 * (parseFloat(balusd)+ parseFloat(mekun * amount));
                        bal=-1 * parseFloat(balusd);
                        cur1=' USD';
                    }else if(cur=='KHR'){
                        balnext=-1 * (parseFloat(balkhr)+ parseFloat(mekun * amount));
                        bal=-1 * parseFloat(balkhr);
                        cur1=' KHR';
                    }else if(cur=='THB'){
                        balnext=-1 * (parseFloat(balthb)+ parseFloat(mekun * amount));
                        bal=-1 * parseFloat(balthb);
                        cur1=' THB';
                    }

                $(elnext).val(formatNumber(balnext) + cur1);
                $(elbal).val(formatNumber(bal) + cur1);
                if(bal>0){
                    $(elbal).css('color','blue');
                }else{
                    $(elbal).css('color','red');
                }
                if(balnext>0){
                    $(elnext).css('color','blue');
                }else{
                    $(elnext).css('color','red');
                }
            }
            function getwingbalance(cid,cur,elem,elnext,sign,amt,fee,callback)
            {
                $('body').addClass("wait");

                    var total=0;
                    var d2=$('#h1_date').text();
                    var op='<=';
                    var url="{{ route('closelist.summarypartnerlist') }}";

                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {cid:cid,showdate:d2,op:op},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $(elem).attr('title',data.usd+';'+data.khr+';'+data.thb);

                            callback(elem,elnext,cur,sign,amt,fee);
                            $('body').removeClass("wait");
                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Error.')
                    }

                })
            }
            $(document).on('change','#selpartner',function(e){
                e.preventDefault();
                if($(this).val()!==''){
                    getwingbalance($(this).val(),$('#selcur option:selected').text(),'#balance1','#balancenext1',$('#mekun').val(),$('#amountlist').val(),$('#fee').val(),fillnextbalance);
                }
            })
            function getpartner(type,el)
            {
                var url="{{ route('getpartnerbytype') }}";
                $(el).empty();

                $.get(url,{type:type},function(data){
                    $(el).append($("<option/>",{
                                value:'',
                                text:''
                            }))
                    $.each(data,function(i,item){
                        $(el).append($("<option/>",{
                                value:item.id,
                                text:item.name,
                                customertype:item.customertype,
                                userconnect:item.user_connect

                            }))
                        //console.log(item)
                    });
                    $(el).select2('open');

                })
            }

            $('input[type=radio][name=radcustype]').change(function() {
                getpartner(this.value,'#selpartner');
            });
            $(document).on('click','.btntolist',function(e){
                e.preventDefault();
                var amount=$(this).data('amount');
                var curid=$('#selcur').attr('title');
                $('#frmtransfer').trigger('reset');
                $('#selpartner').trigger('change');
                $('#smsid').val($(this).data('id'));
                $('#mekun').val($(this).data('mekun'));
                $('#thai_list').val($(this).data('accno'));
                $('#thai_list').attr('title',$(this).data('frombank'));
                $('#amountlist').val(formatNumber(Math.abs(amount)));
                $('#selcur').val(curid);
                $('#selcur').trigger('change');
                $('#partnerlistmodal').modal('show');

                if($(this).data('mekun')==1){
                    $('#mhd').text('ផ្ញើ');
                    $('#mekun').attr('title','ផ្ញើ');
                }else{
                    $('#mhd').text('ទទួល');
                    $('#mekun').attr('title','ទទួល');
                }
                savephonetolocalstorage(autocomplereceiver);
                var today=new Date();
                $('#listdate').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                checkthailistintransfer();

            })
            $(document).on('click','.btnshowtransferthai,#btnshowoptlist',function(e){
                e.preventDefault();
                $('#transferthailistmodal').modal('show');
                transactiontransfertothai();
            })
            $(document).on('click','.btnaccountregister',function(e){
                e.preventDefault();
                $('#thaiaccountmodal').modal('show');
            })
            $(document).on('change','input[name="optlist"]',function(e){
                e.preventDefault()
                transactiontransfertothai();
            })
            function transactiontransfertothai()
            {

                $('body').addClass("wait");
                var url="{{ route('moneytransfer.transactiontransfertothai') }}";
                var op='';
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var seelist=document.querySelector('input[name="optlist"]:checked').value;


                $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: { d1:d1,d2:d2,op:op,seelist:seelist},
                        complete: function () {

                        },
                        success: function (data) {
                        //console.log(data);
                        var k=0;
                        var output='';
                        for(var i=0;i<data['thai_transfer'].length;i++){
                                k+=1;
                                output +=
                                `<tr class="${data['thai_transfer'][i].thai_sms_id?'cgr':''}">
                                    <td style="text-align:center;width:40px;" class="kh14">${ k }</td>

                                    <td class="kh14">${ moment(data['thai_transfer'][i].dd).format("DD-MM-YYYY") }</td>
                                    <td class="kh14">${data['thai_transfer'][i].tt}</td>

                                    <td class="kh14">${data['thai_transfer'][i].tranname}</td>
                                    <td class="kh14">${data['thai_transfer'][i].partner.name}</td>
                                    <td class="kh14-b" style="text-align:right;">${formatNumber(data['thai_transfer'][i].amount) } B</td>
                                    <td class="kh14" style="text-align:right;">${data['thai_transfer'][i].rectel??'' }</td>
                                    <td class="kh14" style="text-align:right;">${data['thai_transfer'][i].recname??''}</td>
                                    <td class="kh14">${data['thai_transfer'][i].thai_sms_id??''}</td>

                                    <td class="kh14">${data['thai_transfer'][i].user.name}</td>
                                    <td class="kh14">${data['thai_transfer'][i].id}</td>
                                    <td class="kh14">${data['thai_transfer'][i].trancode}</td>
                                    <td class="kh14">${data['thai_transfer'][i].mekun}</td>
                                </tr>`;
                            }
                            $('#body_transfertothai').empty().html(output);
                            k=0;
                            var output1='';
                            for(var i=0;i<data['smsout'].length;i++){
                                k+=1;
                                output1 +=
                                `<tr style="color:red;">
                                    <td style="text-align:center;width:40px;" class="kh14">${ k }</td>

                                    <td class="kh14">${ moment(data['smsout'][i].smsdate).format("DD-MM-YYYY hh:mm:ss") }</td>


                                    <td class="kh14">${data['smsout'][i].accno}</td>

                                    <td class="kh14-b" style="text-align:right;">${formatNumber(data['smsout'][i].amount) } B</td>

                                    <td class="kh14">${data['smsout'][i].smsby}</td>

                                </tr>`;
                            }
                            $('#body_transfertothai1').empty().html(output1);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Thai Transfer Error')
                        }
                })
            }
            $(document).on('click','#btnsavelist',function(e){
                e.preventDefault();
                func_savetransfer(0);
            })
            function func_savetransfer(isprint)
            {
                $('body').addClass("wait");
                var formdata=new FormData(frmtransfer);

                var sp = document.querySelector("#selpartner");
                var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
                var thai_list_partner=sp.options[sp.selectedIndex].getAttribute('thai_list');
                var partner1=$('#selpartner option:selected').text();
                var partnerid1=$('#selpartner').val();

                var cur_transfer=$('#selcur option:selected').text();
                var cur_cuscharge=$('#selcur1 option:selected').text();
                var cur_fee=$('#txtcur1 option:selected').text();
                var bankname=$('#thai_list').attr('title');
                var tranname=$('#mhd').text();
                formdata.append('bankname',bankname);
                formdata.append('tranname',tranname);
                formdata.append('cur_transfer',cur_transfer);
                formdata.append('cur_cuscharge',cur_cuscharge);
                formdata.append('cur_fee',cur_fee);
                formdata.append("invdate",$('#listdate').val());
                formdata.append("customertype", customertype);
                formdata.append("partner1", partner1);
                formdata.append("partnerid1", partnerid1);
                formdata.append("thai_list_partner", thai_list_partner);
                if($('#mekun').val()=='1'){
                    formdata.append("trancode", 4);
                }else{
                    formdata.append("trancode", -4);
                }
                var url="{{ route('moneytransfer.thailist_store') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    complete: function () {

                    },
                    success: function (data) {

                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            if(isprint==1){
                                //printtransfers(data.id,hasexchange,hasbankpayment);
                            }
                            $('#partnerlistmodal').modal('hide');
                            toastr.success("Save Transfer Successfully");
                            searchsms(userclicksearch);
                            $('body').removeClass("wait");

                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)

                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error.')

                    }

                })

            }
            $(document).on('change','#amount',function(e){
                e.preventDefault();
                checkthesameamount($(this).val());

            })
            $(document).on('change','#selacclist',function(e){
                e.preventDefault();
                if($('#sms_id').val()==''){
                    checkthesameamount($('#amount').val());
                }
            })

            $('#selacclist').on('select2:close', function (e)
            {
                $('#amount').focus();
            });
            $(document).on('change','#selsearchby',function(e){
                e.preventDefault();
                var searchby=$(this).val();
                if(searchby=='tel'){
                    $('#txtsearchbytel').css('display','inline');
                    $('#txtsearchbytime').css('display','none');
                    $('#txtsearchbyamt1').css('display','none');
                    $('#txtsearchbyamt2').css('display','none');
                }else if(searchby=='amt'){
                    $('#txtsearchbytel').css('display','none');
                    $('#txtsearchbytime').css('display','none');
                    $('#txtsearchbyamt1').css('display','inline');
                    $('#txtsearchbyamt2').css('display','inline');

                }else if(searchby=='time'){
                    $('#txtsearchbytel').css('display','none');
                    $('#txtsearchbytime').css('display','inline');
                    $('#txtsearchbyamt1').css('display','none');
                    $('#txtsearchbyamt2').css('display','none');
                }
            })
            var userclicksearch=0;
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                userclicksearch=0;
                searchsms(0);

            })

            $(document).on('change','#selbysms',function(e){
                e.preventDefault();
                userclicksearch=0;
                searchsms(0);
            })

            $(document).on('click','#btnsearch2',function(e){
                e.preventDefault();
                userclicksearch=1;
                searchsms(1);
            })

            function searchsms(searchmore)
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var accno=$('#selthaiacc').val();
            var tt=$('#txtsearchbytime').val();
            var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
            var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
            var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
            var searchby=$('#selsearchby').val();
            var selbysms=$('#selbysms').val();
            var url="{{ route('thaicashdraw.getthaisms') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,accno:accno,searchby:searchby,tel:tel,time:tt,amt1:amt1,amt2:amt2,searchmore:searchmore,selbysms:selbysms},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#bodysmslist').empty().html(data);
                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }

            })


        }

        function checkthailistintransfer()
        {

            $('body').addClass("wait");
            var url="{{ route('moneytransfer.checkthailistintransfer') }}";
            var op='';
            var smsid=$('#smsid').val();
            var d1=$('#d1').val();
            var d2=$('#d2').val();

            if($('#mekun').val()==1){
                op='>';
            }else{
                op='<';
            }
            $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { d1:d1,d2:d2,op:op,smsid:smsid},
                    complete: function () {

                    },
                    success: function (data) {
                    //console.log(data);
                    var k=0;
                    var output='';
                    for(var i=0;i<data['thai_transfer'].length;i++){
                            k+=1;
                            output +=
                            `<tr>
                                <td style="text-align:center;width:40px;" class="kh14">${ k }</td>
                                <td style="text-align:center;padding:0px;" class="kh12-b">
                                    <button class="mybtn btnmatch" data-id="${data['thai_transfer'][i].id}" style="height:25px;padding:2px;">Match</button>

                                </td>
                                <td class="kh14">${ moment(data['thai_transfer'][i].dd).format("DD-MM-YYYY") }</td>
                                <td class="kh14">${data['thai_transfer'][i].tt}</td>

                                <td class="kh14">${data['thai_transfer'][i].tranname}</td>
                                <td class="kh14">${data['thai_transfer'][i].partner.name}</td>
                                <td class="kh14-b" style="text-align:right;">${formatNumber(data['thai_transfer'][i].amount) } B</td>
                                <td class="kh14" style="text-align:right;">${data['thai_transfer'][i].rectel??'' }</td>
                                <td class="kh14" style="text-align:right;">${data['thai_transfer'][i].recname??''}</td>
                                <td class="kh14">${data['thai_transfer'][i].user.name}</td>
                                <td class="kh14">${data['thai_transfer'][i].id}</td>
                                <td class="kh14">${data['thai_transfer'][i].trancode}</td>
                                <td class="kh14">${data['thai_transfer'][i].mekun}</td>
                            </tr>`;
                        }
                        $('#body_searchthailistintransfer').empty().html(output);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Amount or Tel Checker Error.')
                    }
            })
        }
            $(document).on('click','.btndeltolist',function(e){
            e.preventDefault();
            var transfer_id=$(this).data('transfer_id');
            var sms_id=$(this).data('id');

            Swal.fire({
                    title: 'Are you sure?',
                    text: "តើលោកអ្នកចង់លុបចោលការចូលបញ្ជីដៃគូមែនទេ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('thaisms.delmatchsmsidtotransfer') }}",
                            data: { sms_id:sms_id,transfer_id:transfer_id},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {

                                    searchsms(userclicksearch);
                                    Swal.fire(
                                        'Updated!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Update Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
        })
        $(document).on('click','.btnmatch',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var thai_list=$('#thai_list').val();
            var smsid=$('#smsid').val();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "តើលោកអ្នកចង់ភ្ជាប់សារនេះទៅបញ្ជីមួយនេះមែនទេ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('thaisms.matchsmsidtotransfer') }}",
                            data: { id:id,thai_list:thai_list,smsid:smsid},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    checkthailistintransfer();
                                    searchsms(userclicksearch);
                                    Swal.fire(
                                        'Updated!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Update Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })
        })
        $(document).on('change','input[name="radinout"]',function(e){
            e.preventDefault();
            var value=$(this).val();
            if(value==1){
                $('#amount').css('color','blue');
                $('#txtcur').css('color','blue');

            }else{
                $('#amount').css('color','red');
                $('#txtcur').css('color','red');
            }
        })
        function checkthesameamount(amt){
            if(amt=='') return;
            $('body').addClass("wait");
            var url="{{ route('thaicashdraws.checkthesameamount') }}";
            var accno=$('#selacclist').val();
            var dd=$('#smsdate').val();
            var sign=$('input[name="radinout"]:checked').val();
            $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { amt:amt,accno:accno,sign:sign,smsdate:dd},
                    complete: function () {

                    },
                    success: function (data) {
                    console.log(data);
                    var k=0;
                    var output='';
                    for(var i=0;i<data['sms'].length;i++){
                            k+=1;
                            output +=
                            `<tr>
                                <td style="text-align:center;" class="kh14">${ k }</td>
                                <td class="kh14">${ moment(data['sms'][i].smsdate).format("DD-MM-YYYY") }</td>
                                <td class="kh14">${data['sms'][i].smstime}</td>
                                <td class="kh14">${data['sms'][i].accno}</td>
                                <td class="kh14">${data['sms'][i].sendfrom}</td>
                                <td class="kh14-b" style="text-align:right;">${formatNumber(data['sms'][i].amount) } B</td>
                                <td class="kh14-b" style="text-align:right;">${formatNumber(data['sms'][i].balance) } B</td>
                                <td class="kh14" style="">${data['sms'][i].smstext}</td>
                                <td class="kh14">${data['sms'][i].smsby}</td>
                            </tr>`;
                        }
                        $('#body_divsearchamount').empty().html(output);
                        if(k>0){
                            $('#sameamtmodal').modal('show');
                            $('#mo_dialog').removeClass('modalright').addClass('modalleft');
                        }else{
                            $('#sameamtmodal').modal('hide');
                        }
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Amount or Tel Checker Error.')
                    }
                })
        }

        function getsmsinsert()
        {
            $('body').addClass("wait");
            var d1=$('#smsdate').val();
            var d2=$('#smsdate').val();
            var user=$('#seluserrecord option:selected').text();
            var url="{{ route('thaisms.getsmsuserinsert') }}";

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,user:user},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        var output='';
                        // for(let i=0;i<data['smsinserts'].length;i++){
                        //     output +=`
                        //          <tr class="smsinsertrow" style="${data['smsinserts'][i].amount>0?'color:blue':'color:red'}">
                        //                    <td style="text-align:center;">${i+1}</td>
                        //                    <td>${data['smsinserts'][i].sendfrom}</td>
                        //                    <td>${data['smsinserts'][i].accno}</td>
                        //                    <td>${moment(data['smsinserts'][i].smsdate).format('DD-MM-YYYY') }</td>
                        //                    <td>${data['smsinserts'][i].smstime}</td>
                        //                    <td style="text-align:right;">${formatNumber(data['smsinserts'][i].amount)} B</td>
                        //                    <td style="text-align:right;">${formatNumber(data['smsinserts'][i].balance)} B</td>
                        //                    <td>
                        //                         <a href="" class="btndelsms mybtn" style="${data['smsinserts'][i].isopen==1?'display:none;':''}" data-id="${data['smsinserts'][i].id}" data-user_insert="${data['smsinserts'][i].user_insert}"><i class="fa fa-trash" style="color:red;font-size:16px;"></i></a>
                        //                         <a href="" class="btneditsms mybtn" style="${data['smsinserts'][i].isopen==1?'display:none;':''}" data-id="${data['smsinserts'][i].id}" data-smsdate="${data['smsinserts'][i].smsdate}" data-isopen="${data['smsinserts'][i].isopen}" data-smstime="${data['smsinserts'][i].smstime}" data-bankname="${data['smsinserts'][i].sendfrom}" data-accno="${data['smsinserts'][i].accno}" data-amount="${data['smsinserts'][i].amount}" data-balance="${data['smsinserts'][i].balance}" data-smstext="${data['smsinserts'][i].smstext}" data-smsnote="${data['smsinserts'][i].smsnote}" data-smsby="${data['smsinserts'][i].smsby}"><i class="fa fa-pencil" style="color:rgb(68, 68, 3);font-size:16px;"></i></a>
                        //                    </td>
                        //                    <td>${data['smsinserts'][i].smsnote??''}</td>
                        //                    <td>${data['smsinserts'][i].smsby}</td>
                        //                    <td>${data['smsinserts']['customer'][i].name}</td>
                        //                 </tr>
                        //     `;
                        // }
                        for (let i = 0; i < data['smsinserts'].length; i++) {
                            const sms = data['smsinserts'][i];
                            output += `
                                <tr class="smsinsertrow" style="${sms.amount > 0 ? 'color:blue' : 'color:red'}">
                                    <td style="text-align:center;">${i + 1}</td>
                                    <td>${sms.sendfrom}</td>
                                    <td>${sms.accno}</td>
                                    <td>${moment(sms.smsdate).format('DD-MM-YYYY')}</td>
                                    <td>${sms.smstime}</td>
                                    <td style="text-align:right;">${formatNumber(sms.amount)} B</td>
                                    <td style="text-align:right;">${formatNumber(sms.balance)} B</td>
                                    <td>
                                        <a href="" class="btndelsms mybtn" style="${sms.isopen == 1 ? 'display:none;' : ''}" data-id="${sms.id}" data-user_insert="${sms.user_insert}">
                                            <i class="fa fa-trash" style="color:red;font-size:16px;"></i>
                                        </a>
                                        <a href="" class="btneditsms mybtn" style="${sms.isopen == 1 ? 'display:none;' : ''}"
                                            data-id="${sms.id}" data-smsdate="${sms.smsdate}" data-isopen="${sms.isopen}"
                                            data-smstime="${sms.smstime}" data-bankname="${sms.sendfrom}" data-accno="${sms.accno}"
                                            data-amount="${sms.amount}" data-balance="${sms.balance}" data-smstext="${sms.smstext}"
                                            data-smsnote="${sms.smsnote}" data-smsby="${sms.smsby}">
                                            <i class="fa fa-pencil" style="color:rgb(68,68,3);font-size:16px;"></i>
                                        </a>
                                    </td>
                                    <td>${sms.smsnote ?? ''}</td>
                                    <td>${sms.smsby}</td>
                                    <td>${sms.customer ? sms.customer.name : ''}</td>
                                </tr>
                            `;
                        }

                        $('#body_smsinsert').empty().html(output);

                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }

            })

        }
        function refreshacclist()
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var url="{{ route('thaisms.refreshacclist') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        var output='';
                        for(let i=0;i<data['acclist'].length;i++){
                            let bal=parseFloat(data['acclist'][i].startbal) + parseFloat(data['acclist'][i].balin) + parseFloat(data['acclist'][i].balout);
                            let lomeangdork=parseFloat(data['acclist'][i].balout) - parseFloat(data['acclist'][i].baloutlist) + parseFloat(data['acclist'][i].cashin);
                            let lomeangbok=parseFloat(data['acclist'][i].receiveamt) - parseFloat(data['acclist'][i].balinlist);
                            output +=`
                                <tr>
                                <td style="text-align:center;">${i+1}</td>
                                <td>${ data['acclist'][i].accno }</td>
                                <td style="text-align:right;">${ formatNumber(data['acclist'][i].startbal) }B</td>
                                <td style="text-align:right;">
                                    <span style="color:blue;">+${ formatNumber(data['acclist'][i].balin) }B</span><br>
                                    <span style="color:red;">${ formatNumber(data['acclist'][i].balout) }B</span>
                                </td>
                                <td style="text-align:right;">${ formatNumber(bal)}B</td>
                                <td style="text-align:right;color:darkgreen;">${ formatNumber(data['acclist'][i].cashin) }B</td>
                                <td style="text-align:right;color:darkgreen;">
                                    ${ formatNumber(data['acclist'][i].baloutlist) }B
                                    <br><span style="${lomeangdork>=0?'color:blue;':'color:red;'}">${formatNumber(lomeangdork)}B</span>
                                </td>
                                 <td style="text-align:right;color:darkgreen;">
                                    ${ formatNumber(data['acclist'][i].balinlist) }B
                                    <br><span style="${lomeangbok>=0?'color:red;':'color:blue'}">${formatNumber(lomeangbok)}B</span>
                                </td>

                            </tr>
                            `;
                        }
                        $('#body_acclist').empty().html(output);

                        $('body').removeClass("wait");
                    }else{
                        $('body').removeClass("wait");
                        alert(data.error)
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.')
                }

            })

        }
        $(document).on('click','.btndelsms,.btndelsms1',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var user_insert=$(this).data('user_insert');
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'POST',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('thaisms.smsdelete') }}",
                            data: { id:id,isuserinsert:user_insert},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    getsmsinsert();
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                            }

                        })

                    }
                })

        })
        $(document).on('dblclick','.smsinsertrow',function(e){
            e.preventDefault();

            var rowind=$(this).closest('tr').index();
            triggeredit(rowind)
        })
        $(document).on('click','.btneditsms',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            triggeredit(rowind)
        })
        function triggeredit(rowind)
        {
            var isopen=$('.btneditsms').eq(rowind).data('isopen');
            if(isopen==1) return;
            var id=$('.btneditsms').eq(rowind).data('id');
            var dd=$('.btneditsms').eq(rowind).data('smsdate');
            var tt=$('.btneditsms').eq(rowind).data('smstime');
            var bankname=$('.btneditsms').eq(rowind).data('bankname');
            var accno=$('.btneditsms').eq(rowind).data('accno');
            var amount=$('.btneditsms').eq(rowind).data('amount');
            var balance=$('.btneditsms').eq(rowind).data('balance');
            var smstext=$('.btneditsms').eq(rowind).data('smstext');
            var smsnote=$('.btneditsms').eq(rowind).data('smsnote');
            var smsby=$('.btneditsms').eq(rowind).data('smsby');
            $('#sms_id').val(id);
            $('#smsdate').val(moment(dd).format("DD-MM-YYYY"));
            $('#smstime').val(tt);
            $('#selbankname').val(bankname);
            $('#selacclist').val(accno);
            $('#selacclist').trigger('change');
            $('#amount').val(formatNumber(Math.abs(amount)));
            $('#balance').val(formatNumber(balance));
            $('#smstext').val(smstext);
            $('#smsnote').val(smsnote);
            if(amount>=0){
                radiobtn = document.getElementById("radcashin");
                radiobtn.checked = true;
            }else{
                radiobtn = document.getElementById("radcashout");
                radiobtn.checked = true;
            }
            $('#btnsavesms').text('Update');
        }
        $(document).on('click','#btnnew',function(e){
            e.preventDefault();
           $('#frmaddsms').trigger('reset');
           $('#sms_id').val('');
           //$('#smsdate').val(moment(new Date).format("DD-MM-YYYY"))
            $('#selbankname').trigger('change');
            $('#selacclist').trigger('change');
            $('#btnsavesms').text('Save');
            var today=new Date();
                $('#smsdate').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });

        })

            $(document).on('change','#selbankname',function(e){
              e.preventDefault();
              getacclist($(this).val(),'#selacclist');

            })
            $(document).on('change','#selbankname1',function(e){
              e.preventDefault();
              getacclist($(this).val(),'#selthaiacc');

            })
            function getacclist(bankname,el)
            {
                $(el).empty();
                var url="{{ route('thaisms.getacclistbybank') }}";
                $.get(url,{bankname:bankname},function(data){
                    //console.log(data);
                    $(el).append($("<option/>",{
                                value:'',
                                text:'',
                                bankname:''
                            }))
                    $.each(data['acclist'],function(i,item){
                        $(el).append($("<option/>",{
                            value:item.accno,
                            text:item.accno,
                            bankname:item.bankname
                        }))
                    });

                })
            }
            $(document).on('click','#btnreload',function(e){
                e.preventDefault();
                location.reload();
            })
            $(document).on('click','#btnrefreshlist',function(e){
                e.preventDefault();
                refreshacclist();
                searchsms(userclicksearch);
            })
                $(document).on('click','#btnaddsms',function(e){
                    e.preventDefault();
                    $('#addsmsmodal').modal('show');
                    getsmsinsert();
                    $('#btnnew').click();
                })
                $(document).on('click','.tbl_searchthailistintransfer td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tbl_acclist td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tbl_smsinserted td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tblsmslist td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tbl_transfertothai1 td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tbl_transfertothai td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','.tbl_checkamt td',function(e){
                    // Remove previous highlight class
                    $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                    // add highlight to the parent tr of the clicked td
                    $(this).parent('tr').addClass("clickedrow");
                })
                $(document).on('click','#btnsavesms',function(e){
                    e.preventDefault();
                    $('body').addClass("wait");
                    var sp = document.querySelector("#selacclist");
                    var bankname=sp.options[sp.selectedIndex].getAttribute('bankname');
                    var accno=$('#selacclist option:selected').text();
                    var formdata=new FormData(frmaddsms);
                    formdata.append('bankname',bankname);
                    formdata.append('accno',accno);

                    var url="{{ route('thaiaccount.savesms') }}"
                    $.ajax({
                        async: true,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formdata,
                        success: function (data) {
                            //console.log(data)
                            if($.isEmptyObject(data.error)){
                                getsmsinsert();
                                $('#amount').val('');
                                $('#balance').val('');
                                $('#smstime').val('');
                                $('#smstext').val('');
                                $('#smsnote').val('');
                                $('#amount').focus();
                                $('#sameamtmodal').modal('hide');
                                $('body').removeClass("wait");

                            }else{
                                $('body').removeClass("wait");
                                alert(data.error)
                            }
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Save Error.')

                        }

                    })
                })
                $(document).on('click','#btnsaveaccount',function(e){
                    e.preventDefault();
                    $('body').addClass("wait");

                    var formdata=new FormData(frmthaiaccount);


                    var url="{{ route('thaiaccount.store') }}"
                    $.ajax({
                        async: true,
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formdata,
                        success: function (data) {
                            //console.log(data)
                            if($.isEmptyObject(data.error)){

                                $('body').removeClass("wait");

                            }else{
                                $('body').removeClass("wait");
                                alert(data.error)
                            }
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Save Error.')

                        }

                    })
                })

    })
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }

    </script>
@endsection
