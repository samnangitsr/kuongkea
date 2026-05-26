@extends('master')
@section('title') ទូទាត់កម្រៃជើងសារ @endsection
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
        .en16{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
        }
        .en16-b{
            font-family: Arial, Helvetica, sans-serif;
            font-size:16px;
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
        .tableFixHead{ overflow: auto;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }


        .tableFixHead1{ overflow: auto;border:1px dotted black;height:400px;}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist td{
          word-wrap: break-word !important;
          padding:2px 5px 0px 5px;
        }
        .tbl_transferlist .clickedrow td,
        .tbl_transferlist .clickedrow a,
        .tbl_transferlist .clickedrow input
        {
            background-color: rgb(187, 255, 0);
            color:black !important;
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
            padding:0px 5px;
            font-weight:bold;
            height:25px;
        }
        .mybtn:hover{
            background-color:#8fe9c8;
        }
        .c_orange{
            background-color:orange;
        }
        .c_yellow{
            background-color:yellow;
        }
        .c_red{
            background-color:red;
            color:white;
        }
        .tbl_transferlist td{
            border:1px solid black;
        }
        .tbl0 td{
            border-style:none;
            padding:0px;
        }
        .dropdown-menu li a:hover {
            background-color: blue !important;
            border: 1px solid black;
            border-radius: 2px; /* optional: makes it look better */
            color: white !important; /* optional: improves visibility on red */
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
    <div class="table-responsive" style="margin-top:-10px;margin-bottom:10px;">
        <table id="tbl0" class="tbl0" style="margin:0px;padding:0px;">
            <tr>
                <td class="kh16-b" style="">
                    <label class="form-check-label kh16-b" style="color:red;">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckremoved" id="ckremoved" style="display:inline;">Item Removed
                    </label>
                </td>
                <td class="kh16-b" style="padding-left:5px;">
                    <label class="form-check-label kh16-b">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckalldate" id="ckalldate" style="display:inline;"> ALL Date
                    </label>
                </td>

                <td class="kh16-b" style="width:160px;padding-left:5px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>

                <td class="kh16-b" style="width:160px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td class="kh16-b" style="padding-left:5px;">អ្នកលក់</td>
                <td style="padding-left:5px;">
                    <select name="selsaler" id="selsaler" class="kh16-b" style="height:30px;">
                        <option value="">ទាំងអស់</option>
                        @foreach ($salers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                </td>
                <td class="kh16-b" style="padding-left:5px;">

                    <select class="form-select kh16-b" name="selblock" id="selblock" style="width:200px;">
                        <option value="">all block</option>
                        @foreach ($groups as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td style="width:150px;">
                    <select class="form-select kh16-b" name="sel_property" id="sel_property" style="width:150px;">
                        <option value="">all property</option>
                        @foreach ($allproperty as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>

                <td style="padding:0px 10px;">
                    <button id="btnsearch" class="mybtn kh12-b">Search</button>
                    <button id="btnprintall" class="mybtn kh12-b">Print</button>
                </td>
                <td style="">
                    <input type="text" class="kh16" id="tableSearch" style="width:200px;"  placeholder="Search What You Want..." title="Type what you khnow">
                </td>
            </tr>
        </table>

   </div>
   <div id="commissionlist">
    <div class="row" style="margin-top:0px;">
        <div class="tableFixHead1" style="padding:0px;">
            <table id="" class="table table-bordered table-hover kh14-b tbl_transferlist" style="table-layout:fixed;">
                <thead style="text-align:center;" class="kh14">
                    <th style="width:70px;">No</th>
                    <th style="width:100px;">ID</th>
                    <th style="width:150px;">អ្នកលក់</th>
                    <th style="width:150px;">អតិថិជន</th>
                    <th style="width:100px;">អចលនទ្រព្យ</th>
                    <th style="width:120px;">ទឹកប្រាក់លក់</th>
                    <th style="width:120px;">សរុបលុយកក់</th>
                    <th style="width:120px;">ទឹកប្រាក់នៅសល់</th>
                    <th style="width:100px;">កក់ចុងក្រោយ</th>
                    <th style="width:100px;">បង់ខែ</th>
                    <th style="width:120px;">កក់ចំនួន</th>
                    <th style="width:120px;">កម្រៃជើងសារ</th>
                    <th style="width:120px;">បានទូទាត់រួច</th>
                    <th style="width:120px;">នៅខ្វះ</th>
                </thead>
                <tbody id="body_transaction">
                    @php
                        $j=0;
                    @endphp
                    @foreach ($transfers->whereNull('ispaytosaler') as $key => $t)
                        @php
                            $j+=1;
                        @endphp
                       <tr>
                            <td style="text-align:center;padding:0px;" >
                                <div class="dropdown" style="border-style:none;">
                                    <button style="width:100%;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $j }}</button>
                                    <ul class="dropdown-menu">
                                        <li class="li_code16" title="code:1.6"><a href="#" class="dropdown-item kh16-b btnpayment" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-salerid="{{ $t->parrent_id }}" data-salername="{{ $t->partner->name }}" data-commission="{{ $t->commission }}" data-deposited="{{ $t->commission_paid }}" data-balance="{{ abs($t->commission)-abs($t->commission_paid) }}" data-curname="{{ $t->currency->shortcut }}" data-curid="{{ $t->currency_id }}"><i class="fa fa-money"></i> ទូទាត់កំរៃជើងសារ</a></li>
                                        <li class="li_code161" title="code:1.6.1"><a href="#" class="dropdown-item kh16-b btnremovecommission" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}" data-status="{{ $t->status }}"><i class="fa fa-minus" style=""></i> ដកចេញ</a></li>
                                        <li class="li_code162" title="code:1.6.2"><a href="#" class="dropdown-item kh16-b btnfixerrorinfo" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}" data-status="{{ $t->status }}"><i class="fa fa-info" style=""></i> Fix Info Error</a></li>

                                    </ul>
                                </div>
                            </td>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->partner->name }}</td>
                            <td>{{ $t->customername }}</td>
                            <td>{{ $t->propertyname }}</td>
                            <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)) . '$'}}</td>
                            <td class="" style="text-align:right;">
                                <a href="{{ route('realestate.showdeposit',['id'=>$t->main_id,'customer_id'=>$t->main_parrent_id,'customertype'=>$t->main_customertype,'term'=>$t->main_term,'rate'=>$t->main_interest_rate,'startdate'=>$t->main_startdate,'enddate'=>$t->main_enddate,'curid'=>$t->currency_id,'cursk'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'payinmonth'=>$t->main_payinmonth,'sendername'=>$t->propertyname]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;">{{ phpformatnumber($t->sumdeposit) . $t->currency->sk . '(' . $t->countrow . ')' }}</a>
                            </td>
                            <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)-abs($t->sumdeposit)) . '$' }}</td>

                            <td>{{ date('d-m-Y',strtotime($t->deposit_date)) }}</td>
                            <td>{{ date('d-m-Y',strtotime($t->payformonth)) }}</td>

                            <td style="text-align:right;color:red;">{{ phpformatnumber($t->deposit_amount) . $t->currency->sk}}</td>

                            <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                            <td style="text-align:right;">
                                <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class="kh16-b " target="_blank" style="margin:0px;padding:2px;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                            </td>
                            <td style="text-align:right;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                       </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <table id="" class="table table-bordered table-hover kh14-b tbl_transferlist" style="">
            <thead style="text-align:center;" class="kh14">
                <th style="width:70px;">No</th>
                <th style="width:100px;">ID</th>
                <th style="width:150px;">អ្នកលក់</th>
                <th style="width:150px;">ថ្ងៃទូទាត់</th>
                <th style="width:80px;">ចំនួនទូទាត់</th>
                <th style="width:200px;">ទូទាត់តាម</th>
                <th style="width:80px;">អចល</th>
                <th style="width:120px;">កម្រៃជើងសារ</th>
                <th style="width:120px;">បានទូទាត់រួច</th>
                <th style="width:120px;">នៅខ្វះ</th>
            </thead>
            <tbody id="body_transaction">
                @php
                    $i=0;
                @endphp
                @foreach ($transfers->where('ispaytosaler',1) as $key => $t)
                    @php
                        $i+=1;
                    @endphp
                    <tr>
                        <td style="text-align:center;padding:0px;" >
                            <div class="dropdown" style="border-style:none;">
                                <button style="width:100%;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}"><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>
                                    <li class="li_code161" title="code:1.6.1"><a href="#" class="dropdown-item kh16-b btndelete" data-id="{{ $t->id }}" data-payonid="{{ $t->payonid }}" data-groupid="{{ $t->ref_group_id }}"><i class="fa fa-trash" style="color:red;"></i> លុប</a></li>
                                    @if(Auth::user()->role->name=='Admin')
                                        <li>
                                            <a href="{{ route('realestate.showcommissionlink',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id,'group_id' => $t->ref_group_id]) }}" class="dropdown-item kh16-b " target="_blank" style=""><i class="fa fa-pencil"></i> LinkGroup</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->partner->name }}</td>
                        <td>{{ date('d-m-Y',strtotime($t->dd)) . ' ' . $t->tt }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->amount) . $t->currency->sk}}</td>
                        <td>
                            <a href="#c{{ $t->id }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse">{{ $t->deposit_via }}</a>
                        </td>
                        <td>{{ $t->propertyname }}</td>
                        <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class="mybtn kh16-b " target="_blank" style="margin:0px;padding:2px;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                        </td>
                        <td style="text-align:right;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                    </tr>
                    <tr id="c{{ $t->id }}" class="collapse borderset2" style="">
                        <td colspan=5 style="">
                            <table class="" style="margin:0px 0px 2px 0px;">
                                <thead style="text-align:center;">
                                    <th style="border:1px solid black;">ID</th>
                                    <th style="border:1px solid black;">ថ្ងៃទី</th>
                                    <th style="border:1px solid black;">ប្រតិបត្តិការណ៏</th>
                                    <th style="border:1px solid black;">ឈ្មោះដៃគូ</th>
                                    <th style="border:1px solid black;">ចំនួនទឹកប្រាក់</th>
                                </thead>
                                <tbody>
                                    @foreach (App\PartnerTransfer::showbyrefgroupid8($t->id,$t->ref_group_id)[1] as $trf)
                                        <tr>
                                            <td>{{ $trf->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($trf->dd)) . ' ' . $trf->tt }}</td>
                                            <td>{{ $trf->tranname }}</td>
                                            <td>{{ $trf->partner->name }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($trf->amount) . $trf->currency->sk }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </td>
                        <td colspan=5>
                            <table class="" style="margin:0px 0px 2px 0px;">
                                <thead style="text-align:center;">
                                    <th style="border:1px solid black;">ID</th>
                                    <th style="border:1px solid black;">ថ្ងៃបើក</th>
                                    <th style="border:1px solid black;">អ្នកកត់ត្រា</th>
                                    <th style="border:1px solid black;">ចំនួនទឹកប្រាក់</th>

                                </thead>
                                <tbody>
                                    @foreach (App\PartnerTransfer::showbyrefgroupid8($t->id,$t->ref_group_id)[0] as $cd)
                                        <tr>
                                            <td>{{ $cd->id }}</td>
                                            <td>{{ date('d-m-Y',strtotime($cd->opdate)) . ' ' . $cd->optime }}</td>
                                            <td>{{ $cd->user->name }}</td>
                                            <td style="text-align:right;">{{ phpformatnumber($cd->amount) . $cd->currency->sk }}</td>
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
    @include('realestates.paycommissionmodal');
@endsection
@section('script')
    <script type="text/javascript">
        $('#h1_title').text('តារាងទូទាត់កម្រៃជើងសារ');
        // refreshtableFixHead(570);
        // $(window).resize(function() {
        //     refreshtableFixHead(570);
        // });
        function refreshtableFixHead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        }
        function hasPermission(userId, code) {
            let permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
            return permusers.some(item => item.userid == userId && item.code == code);
        }

        var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
        if (!isAdmin) {
            if (!hasPermission('{{Auth::id()}}', '1.6')) {
                $('.li_code16').css('display', 'none');
            }
            if (!hasPermission('{{Auth::id()}}', '1.6.1')) {
                $('.li_code114').css('display', 'none');
            }
        }
        $(document).ready(function () {
            $('#sel_property').select2();
            $('#selblock').select2();
            $('#selbank').select2();

            var today=new Date();
            $('#invdate,#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,
            });
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                getcomissionlist();

            })
            $(document).on('click','#btnprintall',function(e){
                e.preventDefault();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var saler=$('#selsaler').val();
                var salername=$('#selsaler option:selected').text();
                var redirectWindow = window.open('{{ url('/') }}'+'/realestate/getcommissionlist/print?saler='+saler+'&d1='+d1+'&d2='+d2+'&isprint='+1+'&salername='+salername , '_blank');
                redirectWindow.location;

            })
            var cleave = new Cleave('#deposit', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#payamt', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            $(document).on('click','.tbl_transferlist td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btnpayment',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var payonid=$(this).data('payonid');
                var salerid=$(this).data('salerid');
                var saler=$(this).data('salername');
                var commission=$(this).data('commission');
                var deposited=$(this).data('deposited');
                var balance=$(this).data('balance');
                var curname=$(this).data('curname');
                var curid=$(this).data('curid');
                $('#deposit').val('');
                $('#id').val(id);
                $('#payonid').val(payonid);
                $('#saler').val(saler);
                $('#saler').attr('title',salerid);
                $('#commission').val(formatNumber(commission));
                $('#deposited').val(formatNumber(deposited));
                $('#balance').val(formatNumber(balance));
                $('#balance1').val(formatNumber(balance));
                $('.cur').val(curname);
                $('#curid').attr('title',curid);
                $('#paycommissionmodal').modal('show');

            })
        })
        $(document).on('change','#deposit',function(e){
            e.preventDefault();
            dodeposit();
        })
        function dodeposit(){
            var deposit=$('#deposit').val().replace(/,/g,'');
            var balance=$('#balance').val().replace(/,/g,'');
            var balance1=parseFloat(balance)-parseFloat(deposit);
            $('#balance1').val(formatNumber(balance1));
            $('#payamt').val(formatNumber(deposit));

        }
        $(document).on('click','#btnsavepayment,#btnsavepaymentprint',function(e){
            e.preventDefault();
            var balance=$('#balance1').val().replace(/,/g,'');
            var deposit=$('#deposit').val().replace(/,/g,'');
            if(parseFloat(balance)<0){
                alert('commission balance can not be negative')
                return;
            }
             var payamt=$('#payamt').val().replace(/,/g,'');
               if(parseFloat(payamt)>parseFloat(deposit)){
                alert('paid amount can not bigger than deposit amount');
                return;
            }
            if($('#selbank').val()=='cash'){
                if(parseFloat(payamt)!==parseFloat(deposit)){
                    alert('paid amount must be the same to deposit amount');
                    return;
                }
            }
            var elid=$(this).attr('id');
            if(elid=='btnsavepayment'){
                //savedeposit(0,$(this),$(this).text());
                savedeposit(0,$(this),$(this).text(),$('#btnsavepaymentprint'));

            }else{
                savedeposit(1,$(this),$(this).text(),$('#btnsavepayment'));
            }
        })
        function savedeposit(isprint,el,btntext,el1)
      {
            $('body').addClass("wait");
            $(el).attr('disabled', true).text("Processing");
            $(el1).attr('disabled', true);
            var formdata=new FormData(frmpayment);
            var curid=$('#curid').attr('title');

            var invdate=$('#invdate').val();
            var payby=$('#selbank option:selected').text();
            var partner_id=$('#saler').attr('title');

            formdata.append('partner_id',partner_id);
            formdata.append('invdate',invdate);
            formdata.append('curid',curid);
            formdata.append('payby',payby);

            var url="{{ route('realestate.savedepositcommission') }}";
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
                        printdeposit(data.id,data.groupid,'បង្កាន់ទូទាត់កម្រៃជើងសារ');
                    }
                      toastr.success("Save deposit Successfully");
                      $(el).removeAttr('disabled').html(btntext);
                      $(el1).removeAttr('disabled');
                      $('#paycommissionmodal').modal('hide');
                      $('body').removeClass("wait");
                      getcomissionlist();
                  }else{
                    $(el).removeAttr('disabled').html(btntext);
                    $(el1).removeAttr('disabled');
                      $('body').removeClass("wait");
                      alert(data.error)

                  }
              },
              error: function () {
                $(el).removeAttr('disabled').html(btntext);
                $(el1).removeAttr('disabled');
                  $('body').removeClass("wait");
                  alert('Save Error.')

              }

          })

      }
       $(document).on('click','.btnfixerrorinfo',function(e){
            e.preventDefault();
            var el=$(this).attr('id');
            var id=$(this).data('id');
            var status=$(this).data('status');
            var groupid=$(this).data('groupid');
            let successtext='';
            let confirmtext='';

            successtext='Fixed';
            confirmtext='Yes, Fix it!';

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmtext
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        async: true,
                        type: 'GET',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.updateinfo') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                getcomissionlist();

                                Swal.fire(
                                    successtext,
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
       $(document).on('click','.btnremovecommission',function(e){
            e.preventDefault();
            var el=$(this).attr('id');
            var id=$(this).data('id');
            var status=$(this).data('status');
            var groupid=$(this).data('groupid');
            let successtext='';
            let confirmtext='';
            if(status==1){
                successtext='delete';
                confirmtext='Yes, delete it!';
            }else{
                confirmtext='Yes, restore it!';
                successtext='restore';
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmtext
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        async: true,
                        type: 'GET',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.removecommission') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                getcomissionlist();

                                Swal.fire(
                                    successtext,
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
        $(document).on('click','.btndelete',function(e){
            e.preventDefault();
            var el=$(this).attr('id');
            var id=$(this).data('id');
            var groupid=$(this).data('groupid');
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
                        type: 'GET',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.deletepaidcommission') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                getcomissionlist();

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
      $(document).on('click','.btnprint',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        var groupid=$(this).data('groupid');
        printdeposit(id,groupid,'បង្កាន់ដៃទូទាត់កម្រៃជើងសារ(ព្រីនឡើងវិញ)')
      })
      function printdeposit(id,groupid,rpttitle){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint1?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle , '_blank');
          redirectWindow.location;
        }
        function getcomissionlist()
        {
            $('body').addClass("wait");
            var location_id=8;
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var saler=$('#selsaler').val();
            var block=$('#selblock').val();
            var pid=$('#sel_property').val();
            var alldate = document.getElementById("ckalldate").checked;
            var removed = document.getElementById("ckremoved").checked;

            var url="{{ route('realestate.getcommissionlist') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {alldate:alldate,removed:removed,d1:d1,d2:d2,location_id:location_id,saler:saler,block:block,pid:pid},

                complete: function () {},
                success: function (data) {
                    console.log(data)

                    $('#commissionlist').empty().html(data);
                    $('body').removeClass("wait");
                    refreshtableFixHead(570);
                    if (!isAdmin) {
                        if (!hasPermission('{{Auth::id()}}', '1.6')) {
                            $('.li_code16').css('display', 'none');
                        }
                        if (!hasPermission('{{Auth::id()}}', '1.6.1')) {
                            $('.li_code161').css('display', 'none');
                        }
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $(".tbl_transferlist tr").each(function(index) {
                if (index !== 0) {
                    $row = $(this);

                    $row.find('td').each (function() {
                        var id = $(this).text();
                        if (id.toUpperCase().search(value) < 0) {
                            $row.hide();
                        }
                        else {
                            $row.show();
                            return false;
                        }
                    });

                }
            });
        });

    </script>


@endsection
