@extends('master')
@section('title') តារាងលក់អចលនទ្រព្យ @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
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
        .tbl_transferlist .clickedrow td,
        .tbl_transferlist .clickedrow input,
        .tbl_transferlist .clickedrow td > a
        {
            background-color: blue;
            color:white !important;
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
        .mybtn{
            border:1px solid black;
            padding:2px 5px;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        #tbl_summary td{
            padding:0px;
        }
        #mytable td,#mytable th{
            border:1px solid black;
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
    <div class="row" style="margin-top:-10px;margin-bottom:10px;">
        <table class="" style="margin:0px;padding:0px;">
            <tr>
                <td style="padding:0px;">
                    <select name="seltrancode" id="seltrancode" class="kh16-b" style="height:30px;">
                        <option value="-8">អតិថិជន</option>
                        {{-- <option value="8">អ្នកលក់គំរោង</option> --}}

                    </select>
                    <input type="radio" class="form-check-input kh16-b" style="margin-top:8px;" id="optall" name="optlist" value="0" checked>
                    <label class="form-check-label kh16-b" for="optall">ទាំងអស់</label>

                    <input type="radio" class="form-check-input kh16-b" style="margin-top:8px;" id="optpayoff" name="optlist" value="1">
                    <label class="form-check-label kh16-b" for="optpayoff">បង់ផ្តាច់</label>

                    <input type="radio" class="form-check-input kh16-b" style="margin-top:8px;" id="optromlos" name="optlist" value="2">
                    <label class="form-check-label kh16-b" for="optromlos">បង់រំលស់</label>

                </td>
                <td class="kh16-b" style="padding:0px 10px 0px 0px;border-style:none;width:220px;">
                    <select multiple class="select" name="selblock" id="selblock" style="width:200px;">
                        @foreach ($groups as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="padding:0px;border-style:none;width:210px;">
                    <select class="form-select kh16-b" name="search_property" id="search_property">
                        <option value="">all Property</option>
                        @foreach ($allproperty as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="padding:0px;">
                    <button id="btnsearch" class="mybtn kh16-b">Search</button>
                </td>
                <td style="padding:0px;">
                    <input type="text" class="kh16" id="tableSearch" style="width:100%;"  placeholder="Search What You Want..." title="Type what you khnow">
                </td>
            </tr>

        </table>

   </div>
    <div id="row_display" class="row" style="margin-top:0px;">
        <div class="tableFixHead" style="padding:0px;">
            <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                <thead style="text-align:center;" class="kh16">
                    <th style="width:70px;">No</th>
                    <th style="width:100px;">វិក័យប័ត្រ</th>
                    <th style="width:100px;">ថ្ងៃលក់</th>
                    <th id="th_customer" style="width:200px;">ឈ្មោះអតិថិជន</th>
                    <th id="th_saler" style="width:200px;">អ្នកលក់គំរោង</th>
                    <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                    <th style="width:150px;">បានទូទាត់រួច</th>
                    <th style="width:150px;">នៅខ្វះ</th>
                    <th style="width:100px;">ប្រភេទទូទាត់</th>
                    <th style="width:100px;">កំរៃជើងសារ</th>
                    <th style="width:180px;">ប្រតិបត្តិការណ៏</th>
                    <th style="width:160px;">អ្នកកត់ត្រា</th>
                    <th style="width:100px;">ថ្ងៃកត់ត្រា</th>

                    <th style="width:300px;">ផ្សេងៗ</th>
                    <th style="width:300px;">លេខទូរស័ព្ទ</th>
                    <th style="width:300px;">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                    <th style="width:100px;">ប្រភេទទូទាត់</th>
                    <th style="width:80px;">រយះពេល</th>
                    <th style="width:80px;">អត្រា</th>
                    <th style="width:120px;">បង់ប្រចាំខែ</th>
                    <th style="width:120px;">គិតពី</th>
                    <th style="width:120px;">ដល់</th>
                </thead>
                <tbody id="body_transaction">
                    {{-- @php
                        $totalamount=0;
                        $totaldeposited=0;

                    @endphp
                    @foreach ($transfers as $k => $tr)
                        @php
                            $totalamount +=$tr->amount;
                            $totaldeposited +=$tr->deposited;

                        @endphp
                        <tr>
                            <td style="text-align:center;padding:0px;" class="kh14-b">
                                <div class="dropdown">
                                    <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                                    <ul class="dropdown-menu">

                                        @if($tr->trancode==-8)
                                            @if (Auth::user()->role->name<>'Admin')
                                                @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                                    <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                    <li>
                                                        <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                                    </li>
                                                @endif
                                            @else
                                                <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                <li>
                                                    <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                                </li>
                                            @endif

                                        @endif
                                        @if($tr->trancode==8)
                                            @if (Auth::user()->role->name<>'Admin')
                                                @if (App\User::checkpermission(Auth::id(),'1.6'))
                                                    <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                    <li>
                                                        <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                                    </li>
                                                @endif
                                            @else
                                                <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->id }}" data-map_id="{{ $tr->map_id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}" data-sendername="{{ $tr->sendername }}"><i class="fa fa-money"></i> កក់ប្រាក់</a></li>
                                                <li>
                                                    <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype,'term'=>$tr->term,'rate'=>$tr->interest_rate,'startdate'=>$tr->startdate,'enddate'=>$tr->enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->payinmonth,'ispayromlos'=>1,'sendername'=>$tr->sendername]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </td>
                            <td class="kh16">{{ sprintf("%04d",$tr->id) }}</td>
                            <td class="kh16">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                            <td class="kh16">{{ $tr->partner->name }}</td>
                            <td class="kh16">{{ $tr->customer->name }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)) .$tr->currency->sk }}</td>
                            <td class="kh16-b" style="text-align:right;">
                                <a href="{{ route('realestate.showdeposit',['id'=>$tr->id,'group_id'=>$tr->ref_group_id,'customer_id'=>$tr->parrent_id,'customertype'=>$tr->partner->customertype]) }}" class="kh16-b" target="_blank" style="margin:0px;padding:2px;text-decoration:underline;">{{ phpformatnumber(abs($tr->deposited)) .$tr->currency->sk }}</a>
                            </td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->amount)-abs($tr->deposited)) .$tr->currency->sk }}</td>
                            <td class="kh16" style="text-align:right;">{{ $tr->paymenttype==1?'បង់ផ្តាច់':'បង់រំលស់' }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
                            <td class="kh16">{{ $tr->tranname }}</td>
                            <td class="kh16">{{ $tr->user->name }}</td>
                            <td class="kh16">{{ date('d-m-Y',strtotime($tr->created_at)) }}</td>
                            <td class="kh16">{{ $tr->note }}</td>
                            <td class="kh16">{{ $tr->partner->tel }}</td>
                            <td class="kh16">{{ $tr->partner->idcard }}</td>

                        </tr>
                    @endforeach --}}
                </tbody>

            </table>
        </div>
        <div class="">
            {{-- <table id="tbl_summary" class="table kh22-b" style="margin:0px;">
                <tbody>
                    <tr>
                        <td style="width:140px;">សរុបទឹកប្រាក់ :</td> <td>{{ phpformatnumber(abs($totalamount)) . ' USD'}}</td>
                        <td style="width:100px;">ទូទាត់រួច :</td><td>{{ phpformatnumber(abs($totaldeposited)) . ' USD'}}</td>
                        <td style="width:100px;">សមតុល្យ :</td><td>{{ phpformatnumber(abs($totalamount)-abs($totaldeposited)) . ' USD'}}</td>
                    </tr>
                </tbody>
            </table> --}}
        </div>
    </div>
    @include('realestates.paymentmodal');
@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
@include('realestates.soldproperty_script')


@endsection
