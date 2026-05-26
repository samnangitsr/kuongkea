@extends('master')
@section('title') ឈ្មោះអ្នកទិញបង់រំលស់ @endsection
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
     #selproperty50 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:80px;}
		/* Each result */
		#select2-selproperty50-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}
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
        .tableFixHead{ overflow: auto;border:1px solid blue;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }


        .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist td{
          word-wrap: break-word !important;
          padding:2px 5px 2px 5px;
        }
        .tbl_transferlist .clickedrow td,
        .tbl_transferlist .clickedrow input,
        .tbl_transferlist .clickedrow td > a
        {
            background-color: blue;
            color:white !important;
        }
        .tbl_newpay_list .clickedrow td{
            background-color: #caaf8f;
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
        .tbl_newpay_list td{
            border:1px solid black;
        }
        .tbl_newpay_list th{
            border:1px solid black;
        }
        .mybtn{
            border:1px solid black;
            height:30px;
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
         .dropdown-menu li a:hover {
            background-color: blue !important;
            border: 1px solid black;
            border-radius: 2px; /* optional: makes it look better */
            color: white !important; /* optional: improves visibility on red */
        }

        .mybtn_edit{
            border:1px solid black;
            padding:4px 6px;
            background-color:yellow;
        }
        .mybtn_edit:hover{
            background-color:aquamarine;
        }
        .mybtn_delete{
            border:1px solid black;
            background-color:pink;
            padding:4px 6px;
        }
        .mybtn_delete:hover{
            background-color:aquamarine;
        }
        #mytable td{
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
    <div class="row" style="margin-top:-10px;">
        <table class="" style="margin:0px;padding:0px;">
            <tr>
                <td class="kh16-b" style="padding:0px;width:30px;border-style:none;">ប្លុក</td>
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
                <td style="padding:0px;border-style:none;width:100px;">
                    <button id="btnsearch" class="mybtn kh16-b">Search</button>
                </td>
                <td style="padding:0px;border-style:none;text-align:right;">
                    <input type="text" class="kh16" id="tableSearch" style="width:100%;"  placeholder="Search What You Want from table below..." title="Type what you khnow">
                </td>
            </tr>
        </table>

   </div>
    <div class="row" style="margin-top:0px;">
        <div class="tableFixHead" style="padding:0px;">
            <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                <thead style="text-align:center;" class="kh16">
                    <th style="width:70px;">No</th>
                    <th style="width:100px;">វិក័យប័ត្រ</th>
                    <th style="width:100px;">ថ្ងៃលក់</th>
                    <th style="width:200px;">ឈ្មោះអចលនទ្រព្យ</th>
                    <th id="th_customer" style="width:200px;">ឈ្មោះអតិថិជន</th>
                    <th style="width:100px;">ថ្ងៃកំណត់បង់</th>

                    <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                    <th style="width:150px;">បានទូទាត់រួច</th>
                    <th style="width:150px;">នៅខ្វះ</th>
                    <th id="th_saler" style="width:150px;">អ្នកលក់គំរោង</th>
                    <th style="width:100px;">កំរៃជើងសារ</th>
                    <th style="width:130px;">អ្នកកត់ត្រា</th>
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
                        $i=0;
                    @endphp
                    @foreach ($transfers as $k => $tr)
                        @php
                            $i+=1;
                        @endphp
                        <tr class="@if(floatval($tr->qtyleftday)<=0 && floatval($tr->qtyleftday+10)>=0) c_orange @elseif(floatval($tr->qtyleftday)<0 && floatval($tr->qtyleftday+10)<0) c_red @endif">
                            <td style="text-align:center;padding:0px;" class="kh14-b">
                                <div class="dropdown">
                                    <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->role->name<>'Admin')
                                            @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                                <li>
                                                    <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->mian_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                                </li>
                                                <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}" ><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                            @endif
                                        @else
                                            <li>
                                                <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->mian_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> បង់រំលស់</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item kh16-b" href="{{ route('realestate.printromloslistforcustomer',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->mian_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-print"></i> ព្រីនតារាងបង់ប្រាក់</a>
                                            </li>
                                            <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}"><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                        @endif

                                    </ul>
                                </div>
                            </td>
                            <td class="en16">{{ sprintf("%04d",$tr->main_id) . $tr->qtyleftday }}</td>
                            <td class="en16">{{ date('d-m-Y',strtotime($tr->main_dd)) }}</td>

                            <td class="kh16">{{ $tr->main_property }}</td>
                            <td class="kh16">{{ $tr->buyer }}</td>
                            <td class="en16">{{ date('d-m-Y',strtotime($tr->nextpayment))}}</td>

                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)) .$tr->currency->sk }}</td>
                            <td class="kh16-b" style="text-align:right;">
                                <a href="{{ route('realestate.showdeposit',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype]) }}" class="mybtn kh16-b " target="_blank" style="margin:0px;padding:2px;@if(floatval($tr->qtyleftday)<=0 && floatval($tr->qtyleftday+10)>=0) color:black; @elseif(floatval($tr->qtyleftday)<0 && floatval($tr->qtyleftday+10)<0) color:white; @endif">{{ phpformatnumber(abs($tr->deposited)) .$tr->currency->sk }}</a>
                            </td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)-abs($tr->deposited)) .$tr->currency->sk }}</td>

                            <td class="kh16">{{ $tr->saler }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->main_cuscharge) .$tr->currency->sk }}</td>
                            <td class="kh16">{{ $tr->main_saveby }}</td>
                            <td class="kh16">{{ $tr->main_note }}</td>
                            <td class="kh16">{{ $tr->main_tel }}</td>
                            <td class="kh16">{{ $tr->main_idcard }}</td>

                        </tr>
                    @endforeach --}}
                </tbody>

            </table>
          </div>
    </div>
    @include('realestates.paymentmodal');
    @include('realestates.newpayromlos_modal');

@endsection
@section('script')
    @include('realestates.setupnewromlos_script');
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('ឈ្មោះអតិថិជនទិញបង់រំលស់');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-160;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
        $(window).resize(function() {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();

            var divheight=windowHeight-160;

            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        });
        $(document).ready(function () {
            var today=new Date();
            $('#invdate,#dd,#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,
            });
            VirtualSelect.init({
                ele: '#selblock' ,
            });
            $('#search_property').select2();
            var cleave = new Cleave('#deposit', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave_amtnew = new Cleave('#payamtnew', {
                numeral: true,
                numeralDecimalScale: 6,
                numeralThousandsGroupStyle: 'thousand'
            });
            $('#selbank').select2();
            $(document).on('change','#deposit',function(e){
                e.preventDefault();
                var bal=$('#balance').val().replace(/,/g, '');
                var dep=$('#deposit').val().replace(/,/g, '');
                var bal1=parseFloat(bal)-parseFloat(dep);
                $('#balance1').val(formatNumber(bal1));
                $('#payamt').val(formatNumber(dep));
            })

        $(document).on('click','#btnsearch',function(e){
            e.preventDefault();
            getsearch();
        })
        // function hasPermission(userId, code) {
        //     let permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
        //     return permusers.some(item => item.userid == userId && item.code == code);
        // }
        function getUserPermissions(userId) {
            const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
            return permusers
                .filter(item => item.userid == userId)
                .map(item => item.code);
        }
        var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
        const userId = "{{ Auth::id() }}";
        const userPerms = new Set(getUserPermissions(userId));
        function getsearch()
        {
            $('body').addClass("wait");
            var property_id=$('#search_property').val();
            var selgroup=$('#selblock').val();
            if(selgroup.includes('all')){
                selgroup="all";
            }
            var url="{{ route('realestate.searchcustomerpayromlos') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {selgroup:selgroup,property_id:property_id},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#body_transaction').empty().html(data);
                    //refreshtableFixHead(225);
                    $("#tableSearch").keyup();
                    $('body').removeClass("wait");

                    if (!isAdmin) {
                        if (!userPerms.has('1.3.1')) {
                            $('.li_code131').hide(); // Shorter way to hide
                        }
                        if (!userPerms.has('1.3.2')) {
                            $('.li_code132').hide();
                        }
                          if (!userPerms.has('1.3.3')) {
                            $('.li_code133').hide();
                        }
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }

        $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
            e.preventDefault();
            var table = document.getElementById("tbl_sale_detail");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
                alert('save not allow')
                return;
            }

            var deposit=$('#deposit').val().replace(/,/g,'');
            var overamount=$('#overamount').val().replace(/,/g,'');
            var discount=$('#discount_amount').val().replace(/,/g,'');
            var paythismonth=parseFloat(deposit)+parseFloat(overamount)-parseFloat(discount);
            var payamt=$('#payamt').val().replace(/,/g,'');
            if(parseFloat(deposit)<=0){
                alert('no deposit amount')
                return;
            }
            if(parseFloat(payamt)>parseFloat(paythismonth)){
                alert('receive amount can not bigger than month payment amount');
                return;
            }
            if($('#selbank').val()=='cash'){
                if(parseFloat(payamt)!==parseFloat(paythismonth)){
                    alert('receive amount must be the same to payment amount');
                    return;
                }
            }

            var elid=$(this).attr('id');
            if(elid=='btnsavedeposit'){
                savedeposit(0,$(this),$(this).text());
            }else{
                savedeposit(1,$(this),$(this).text());
            }

        })
        function savedeposit(isprint,el,btntext)
        {
            $('body').addClass("wait");
            $(el).attr('disabled', true).text("Processing");
            var formdata=new FormData(frmdeposit);
            var curid=$('#txtcur').attr('title');
            var payby=$('#selbank option:selected').text();
            var partner_id=$('#txtname').attr('title');
            formdata.append('payby',payby);
            formdata.append('curid',curid);
            formdata.append('partner_id',partner_id);
            formdata.append('property_group',$('#deposited').attr('title'));
            formdata.append('property_id',$('#balance').attr('title'));
            formdata.append('property',$('#amount').attr('title'));

            var url="{{ route('realestate.savedeposit') }}";
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

                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        if(isprint==1){
                            printdeposit(data.id,data.groupid,'បង្កាន់ដៃកក់ប្រាក់',$('#amount').attr('title'));
                        }
                        toastr.success("Save Sale Successfully");
                        //location.reload();
                        $(el).removeAttr('disabled').html(btntext);
                        $('#frmdeposit').trigger('reset');
                        $('#body_sale_detail').empty();
                        $('#selbank').trigger('change');
                        $('#paymentmodal').modal('hide');
                        // $('#invdate').datetimepicker({
                        //     timepicker:false,
                        //     datepicker:true,
                        //     value:today,
                        //     format:'d-m-Y',
                        //     autoclose:true,
                        //     todayBtn:true,
                        //     startDate:today,
                        // });
                        getsearch();
                        $('body').removeClass("wait");

                    }else{
                        $(el).removeAttr('disabled').html(btntext);
                        $('body').removeClass("wait");
                        alert(data.error)

                    }
                },
                error: function () {
                    $(el).removeAttr('disabled').html(btntext);
                    $('body').removeClass("wait");
                    alert('Save Error.')

                }

            })

        }

        function printdeposit(id,groupid,rpttitle,propertyname){
            var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname , '_blank');
            redirectWindow.location;
        }


            $(document).on('click','.tbl_transferlist td',function(e){
                // Remove previous highlight class
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btnpayment',function(e){
                e.preventDefault();
                $('#paymentmodal').modal('show');
                var id=$(this).data('id');
                var url="{{ route('realestate.payment') }}";
                $.get(url,{id:id},function(data){

                    if(data.success){
                        $('#m_title').text('បង់ប្រាក់');
                        $('#id1').val(data['transfers']['id']);
                        $('#id2').val(data['transfers']['map_id']);
                        $('#trancode').val(data['transfers']['trancode']);
                        $('#invdate').val(moment(new Date()).format("DD-MM-YYYY"));
                        if(data['transfers']['trancode']==-8){
                            $('#labelname').text("អតិថិជន");
                        }else{
                            $('#labelname').text("អ្នកលក់គំរោង");
                        }
                        $('#txtname').val(data['transfers'].partner.name);
                        $('#txtname').attr('title',data['transfers']['parrent_id']);
                        $('#amount').attr('title',data['transfers']['sendername']);
                        $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                        $('#txtcur').val(data['transfers']['currency'].shortcut);
                        $('#txtcur').attr('title',data['transfers'].currency_id);
                        $('#row_deposited').css('display','table-row');
                        $('#row_balance').css('display','table-row');
                        $('#deposited').val(formatNumber(data['totalpayment']));

                        $('.cur').val(data['transfers']['currency'].shortcut);
                        var balance=parseFloat(Math.abs(data['transfers']['amount'])) - parseFloat(Math.abs(data['totalpayment']));
                        $('#balance').val(formatNumber(balance));
                        $('#deposited').attr('title',data['transfers']['property_group']);
                        $('#balance').attr('title',data['transfers']['property_id']);
                        if(balance==0){
                            $('#btncomplete').css('display','block');
                        }else{
                            $('#btncomplete').css('display','none');
                        }
                        $('#selproperty50').empty();
                        $('#selproperty50').append($('<option>', {
                            value: "",
                            text: ""
                        }));

                        for(let i=0;i<data['saledetails'].length;i++){
                            row=`
                                <tr class="item">
                                    <td class="kh14 no" style="text-align:center;">${i+1}</td>
                                    <td style="display:none;">
                                        <input type="text" class="input-group pid kh14-b" name="pid[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].property_id}" readonly>
                                    </td>
                                    <td class="kh14-b pname" name="pname[]">${data['saledetails'][i].property.name}</td>
                                    <td class="kh14-b psize" name="psize[]">${data['saledetails'][i].property.size}</td>
                                    <td class="kh14-b" style="padding:0px;">
                                        <div class="input-group">
                                            <input type="text" class="form-control p_price kh14-b" name="p_price[]" style="text-align:right;padding:4px 5px;background-color:transparent;" value="${formatNumber(data['saledetails'][i].price)}">
                                            <input type="text" class="input-group p_cur kh14-b" name="p_cur[]" style="width:60px;padding:0px 5px;border-style:none;height:25px;margin-top:3px;background-color:transparent;" value="${data['saledetails'][i].currency.shortcut}" readonly>
                                        </div>
                                    </td>

                                    <td style="display:none;">
                                        <input type="text" class="input-group p_cur_id kh14-b" name="p_cur_id[]" style="width:60px;padding:0px 5px;" value="${data['saledetails'][i].currency_id}" readonly>
                                    </td>
                                    <td style="text-align:center;padding:5px 0px;display:none;">
                                        <a href="" class="btnremoveitem"><i class="fa fa-trash" style="color:red;"></i></a>
                                    </td>
                                </tr>
                            `;
                            $('#selproperty50').append($('<option>', {
                                value: data['saledetails'][i].property_id,
                                text: data['saledetails'][i].property.name
                            }));
                        }
                        $('#qtybuy').val(i);
                        $('#haction').css('display','none');
                        $('#body_sale_detail').empty().append(row);
                        $('#selproperty50').select2();
                        $('#commission_left').val(formatNumber(data['commissionleft']));
                        if(data['commissionleft']<=0){
                            $('#paycommission').val(0);
                        }
                    }else{

                    }
                })
            })
            $(document).on('click','#btncomplete',function(e){
                e.preventDefault();
                var bal=$('#balance').val();
                if(parseFloat(bal)!==0){
                    alert('you can not set loan complete with balance bigger than zero')
                    return;
                }
                var id=$('#id1').val();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Payment Complete!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('realestate.buypaymentcompleted') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                $('#paymentmodal').modal('hide');
                                    Swal.fire(
                                        'Update!',
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
            $(document).on('click','.btnready',function(e){
                e.preventDefault();

                var id=$(this).data('id');
                var bal=$(this).data('balance');
                if(parseFloat(bal)!==0){
                    alert('you can not set loan complete with balance bigger than zero')
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Payment Complete!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('realestate.buypaymentcompleted') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                $('#paymentmodal').modal('hide');
                                    Swal.fire(
                                        'Update!',
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
        })
        $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#mytable tr").each(function(index) {
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
