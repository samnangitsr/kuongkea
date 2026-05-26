@extends('master')
@section('title') បិទបញ្ជីអចល @endsection
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
        #tbl_total td{
            padding:3px 5px;
            border:1px solid black;
            text-align:right;
        }
        #tbl_total th{
            padding:3px;
            border:1px solid black;
        }
        .clicktd{
            background-color:aqua !important;
        }
        #tbl_total td:hover{
            background-color:aquamarine !important;
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
    <div class="row" style="margin-top:-10px;">
        <table class="" style="margin:0px;padding:0px;">
            <tr>
                <td class="kh16-b" style="width:60px;padding:0px;border-style:none;">សំរាប់ខែ</td>
                <td class="kh16-b" style="width:120px;border-style:none;padding:0px;">
                    <select name="selmonth" id="selmonth" class="" style="width:120px;">
                        <option value=""></option>
                        @for($n=1;$n<=12;$n++)
                            <option value="{{ $n }}" @if($m==$n) selected @endif>{{ dokhmermonth($n) }}</option>
                        @endfor
                    </select>
                </td>
                <td class="kh16-b" style="width:30px;padding:0px 0px 0px 10px;border-style:none;">ឆ្នាំ</td>
                <td class="kh16-b" style="width:100px;padding:0px;border-style:none;">
                    <select name="selyear" id="selyear" class="" style="width:100px;">
                      @for($i=2020;$i<2225;$i++)
                            <option value="{{ $i }}" @if($y==$i) selected @endif>{{ $i }}</option>
                      @endfor

                    </select>
                </td>
                <td class="kh16-b" style="padding:0px 0px 0px 5px;width:40px;border-style:none;">ប្លុក</td>
                <td class="kh16-b" style="padding:0px;border-style:none;">
                    <select multiple class="select" name="selblock" id="selblock" style="width:200px;">
                        @foreach ($groups as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="kh16-b" style="padding:0px 0px 0px 10px;border-style:none;width:150px;">
                     <select name="selproperty" id="selproperty" style="width:150px;height:30px;">
                        <option value="">អចលនទ្រព្យ</option>
                        @foreach ($properties->where('status',1) as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="kh16-b" style="padding:0px 10px 0px 10px;border-style:none;width:150px;">
                     <select name="selpaymenttype" id="selpaymenttype" style="width:150px;height:30px;">
                        <option value="2">បង់រំលស់</option>
                        <option value="1">បង់ផ្តាច់</option>

                    </select>
                </td>
                <td style="padding:0px;border-style:none;">
                    <button id="btnsearch" class="mybtn kh16-b">Search</button>
                    <button id="btnprint" class="mybtn kh16-b">Print</button>
                    <button id="btnfixpayment" class="mybtn kh16-b">fixpayment</button>
                </td>
                <td style="padding:0px;border-style:none;">
                    <input type="text" class="kh16" id="tableSearch" style="width:100%;"  placeholder="Search What You Want..." title="Type what you khnow">
                </td>
            </tr>
        </table>

   </div>
   <div id="rowdisplay">
       <div class="row" style="margin-top:5px;">
           <div class="tableFixHead" style="padding:0px;">
               <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                   <thead style="text-align:center;" class="kh16">
                       <th style="width:70px;">No</th>
                       <th style="width:100px;">វិក័យប័ត្រ</th>
                       <th style="width:100px;">ថ្ងៃលក់</th>
                       <th style="width:200px;">ឈ្មោះអចលនទ្រព្យ</th>
                       <th id="th_customer" style="width:200px;">ឈ្មោះអតិថិជន</th>
                       <th style="width:100px;">ខែទូទាត់</th>
                       <th style="width:100px;">ចំនួន</th>
                       <th style="width:100px;">សរុបបង់</th>
                       <th style="width:100px;">សំរាប់ខែ</th>
                       <th style="width:100px;">ខែបន្ទាប់</th>

                       <th style="width:150px;">តំលៃលក់</th>
                       <th style="width:150px;">បានទូទាត់រួច</th>
                       <th style="width:150px;">នៅខ្វះ</th>
                       <th id="th_saler" style="width:150px;">អ្នកលក់គំរោង</th>
                       <th style="width:100px;">កំរៃជើងសារ</th>
                       <th style="width:130px;">អ្នកកត់ត្រា</th>
                       <th style="width:300px;">ផ្សេងៗ</th>
                       <th style="width:300px;">លេខទូរស័ព្ទ</th>
                       <th style="width:300px;">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                       <th style="width:150px;">ប្រភេទទូទាត់</th>
                       <th style="width:150px;">តាមរយះ</th>

                   </thead>
                   <tbody id="body_closelist">
                       {{-- @php
                            $i=0;
                            $totalpay=0;
                            $paybycash=0;
                            $paybybank=0;
                            $total_cuscharge;
                            $total_discount;
                            $totalsale=0;
                            $totaldeposit=0;
                            $qtypay=0;
                       @endphp --}}
                       {{-- @foreach ($transfers as $k => $tr)
                           @php
                               $i+=1;
                               $totalpay +=floatval($tr->amt_pay);
                               if($tr->deposit_via_id=='cash'){
                                   $paybycash +=floatval($tr->amt_pay);
                               }
                               if($tr->count_pay>0){
                                   $qtypay+=1;
                               }
                               $totalsale +=$tr->main_amount;
                               $totaldeposit +=$tr->deposited;
                           @endphp
                           <tr class="@if(floatval($tr->count_pay)<=0) c_red @endif">
                               <td style="text-align:center;padding:0px;" class="kh14-b">
                                   <div class="dropdown">
                                       <button style="width:70px;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ $i }}</button>
                                       <ul class="dropdown-menu">
                                           @if (Auth::user()->role->name<>'Admin')
                                               @if (App\User::checkpermission(Auth::id(),'1.1.5'))
                                                   <li>
                                                       <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->mian_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
                                                   </li>
                                                   <li><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-id="{{ $tr->main_id }}" ><i class="fa fa-money"></i> កក់ប្រាក់បន្ថែម</a></li>
                                               @endif
                                           @else
                                               <li>
                                                   <a class="dropdown-item kh16-b" href="{{ route('realestate.showromloslist',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype,'term'=>$tr->main_term,'rate'=>$tr->main_interest_rate,'startdate'=>$tr->main_startdate,'enddate'=>$tr->mian_enddate,'curid'=>$tr->currency_id,'cursk'=>$tr->currency->sk,'curname'=>$tr->currency->shortcut,'payinmonth'=>$tr->main_payinmonth,'ispayromlos'=>1,'sendername'=>$tr->main_property]) }}" target="_blank"><i class="fa fa-building"></i> តារាងបង់រំលស់</a>
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
                               <td class="kh16-b" style="text-align:center;">{{ dokhmermonth($tr->inmonth)}}</td>
                               <td class="kh16" style="text-align:center;">{{ $tr->count_pay . ' ដង' }}</td>
                               <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amt_pay) .$tr->currency->sk }}</td>
                               <td class="en16">{{ $tr->payformonth?date('d-m-Y',strtotime($tr->payformonth)):''}}</td>
                               <td class="en16">{{ date('d-m-Y',strtotime($tr->nextpayment))}}</td>

                               <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)) .$tr->currency->sk }}</td>
                               <td class="kh16-b" style="text-align:right;">
                                   <a href="{{ route('realestate.showdeposit',['id'=>$tr->main_id,'customer_id'=>$tr->main_parrent_id,'customertype'=>$tr->main_customertype]) }}" class="mybtn kh16-b " target="_blank" style="margin:0px;padding:2px;@if(floatval($tr->count_pay)<=0) color:white; @endif">{{ phpformatnumber(abs($tr->deposited)) .$tr->currency->sk }}</a>
                               </td>
                               <td class="kh16-b" style="text-align:right;">{{ phpformatnumber(abs($tr->main_amount)-abs($tr->deposited)) .$tr->currency->sk }}</td>

                               <td class="kh16">{{ $tr->saler }}</td>
                               <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->main_cuscharge) .$tr->currency->sk }}</td>
                               <td class="kh16">{{ $tr->main_saveby }}</td>
                               <td class="kh16">{{ $tr->main_note }}</td>
                               <td class="kh16">{{ $tr->main_tel }}</td>
                               <td class="kh16">{{ $tr->main_idcard }}</td>
                               <td class="kh16">{{ $tr->deposit_via_id }}</td>
                               <td class="kh16">{{ $tr->deposit_via }}</td>
                           </tr>
                       @endforeach --}}
                   </tbody>

               </table>
             </div>
       </div>
       <div class="row" style="">
           {{-- <table id="tbl_total" class="table table-bordered kh16-b" style='margin:0px;'>
               <tr style="text-align:center;">
                   <th>សរុបអតិ</th>
                   <th>បង់រួច</th>
                   <th>មិនបានបង់</th>
                   <th>សរុបបង់</th>
                   <th>ប្រាក់ពិនិ័យ</th>
                   <th>ប្រាក់លើកលែង</th>
                   <th>ជាសាច់ប្រាក់</th>
                   <th>ធនាគា</th>
                   <th>សរុបលក់</th>
                   <th>បានសង</th>
                   <th>នៅខ្វះ</th>

               </tr>
               <tr>
                   <td style="text-align:center;">{{ $i . ' នាក់' }}</td>
                   <td style="text-align:center;">{{ $qtypay . ' នាក់'}}</td>
                   <td style="text-align:center;">{{ $i-$qtypay . ' នាក់'}}</td>
                   <td>{{ phpformatnumber($totalpay) . '$' }}</td>
                   <td>{{ phpformatnumber($total_cuscharge) . '$' }}</td>
                   <td>{{ phpformatnumber($total_discount) . '$' }}</td>

                   <td>{{ phpformatnumber($paybycash) . '$' }}</td>
                   <td>{{ phpformatnumber($paybybank) . '$' }}</td>
                   <td>{{ phpformatnumber(abs($totalsale)) . '$' }}</td>
                   <td>{{ phpformatnumber($totaldeposit) . '$' }}</td>
                   <td>{{ phpformatnumber(abs($totalsale)-$totaldeposit) . '$' }}</td>

               </tr>
           </table> --}}
       </div>
   </div>
    @include('realestates.paymentmodal');
@endsection
@section('script')
    <script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏បង់ប្រាក់');
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
        refreshtableFixHead(225);
        $(window).resize(function() {
            refreshtableFixHead(225);
        });
        $(document).ready(function () {
            VirtualSelect.init({
                ele: '#selblock' ,
            });
            $('#selproperty').select2();
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
            var cleave = new Cleave('#deposit', {
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
            })
        $(document).on('click','#tbl_total td',function(e){
            $(this).closest('table').find('td').removeClass("clicktd");
            $(this).toggleClass("clicktd");
         })
        $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
            e.preventDefault();
            var table = document.getElementById("tbl_sale_detail");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
                alert('save not allow')
                return;
            }
            var elid=$(this).attr('id');
            if(elid=='btnsavedeposit'){
                savedeposit(0,$(this),$(this).text());
            }else{
                savedeposit(1,$(this),$(this).text());
            }

        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault();
            let m=$('#selmonth').val();
            let y=$('#selyear').val();
            printcloselist(m,y);
        })
        function printcloselist(m,y){
            var selgroup=$('#selblock').val();
            const selblock = document.querySelector('#selblock');
            const selectedOptions = selblock.virtualSelect.getSelectedOptions();
// To get just the labels (text)
            const labels = selectedOptions.map(opt => opt.label);
//console.log(labels); // ["Group A", "Group B"]

            // if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
            //     selgroup="all";
            // }
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/searchcloselist?m='+m+'&y='+y+'&isprint='+1+'&selgroup='+selgroup+'&blockname='+labels , '_blank');
          redirectWindow.location;
        }
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

                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        if(isprint==1){
                            printdeposit(data.id,data.groupid,'បង្កាន់ដៃកក់ប្រាក់',$('#amount').attr('title'));
                        }
                        toastr.success("Save Sale Successfully");
                        location.reload();
                        // $(el).removeAttr('disabled').html(btntext);
                        //     $('#frmdeposit').trigger('reset');
                        //     $('#body_sale_detail').empty();
                        //     $('#selbank').trigger('change');
                        //     $('#paymentmodal').modal('hide');
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
        $(document).on('click','#btnfixpayment',function(e){
            e.preventDefault();
            $('body').addClass("wait");
            var m=$('#selmonth').val();
            var y=$('#selyear').val();
            var selgroup=$('#selblock').val();
            if(selgroup.includes('all')==true || selgroup=='' || selgroup.length==0){
                selgroup="all";
            }
            var url="{{ route('realestate.fixpayment') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {m:m,y:y,selgroup:selgroup},

                complete: function () {},
                success: function (data) {
                    alert('fix payment completed')
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault();
            getsearch();
        })
        function getsearch()
        {
            $('body').addClass("wait");
            var m=$('#selmonth').val();
            var y=$('#selyear').val();
            var selgroup=$('#selblock').val();
            var property=$('#selproperty').val();
            var selpaymenttype=$('#selpaymenttype').val();
            // if(selgroup.includes('all')){
            //     selgroup="all";
            // }
            var url="{{ route('realestate.searchpaymentreport') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {m:m,y:y,selgroup:selgroup,property:property,selpaymenttype:selpaymenttype},

                complete: function () {},
                success: function (data) {
                    console.log(data)
                    $('#rowdisplay').empty().html(data);
                    refreshtableFixHead(225);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
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
                        $('#balance').val(formatNumber(parseFloat(Math.abs(data['transfers']['amount']) - parseFloat(Math.abs(data['totalpayment'])) )));

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

                        }
                        $('#haction').css('display','none');
                        $('#body_sale_detail').empty().append(row);
                    }else{

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
