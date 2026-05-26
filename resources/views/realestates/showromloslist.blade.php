@extends('master')
@section('title')តារាងបង់រំលស់ @endsection
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
    #selproperty50 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:80px;}
		/* Each result */
		#select2-selproperty50-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:aquamarine;}
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
          border:1px solid black;
        }


        .tableFixHead1{ overflow: auto;background-color:rgb(237, 240, 48);}
        .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tbl_checkamt td{
          word-wrap: break-word;
          padding:2px 5px 2px 5px;
        }
        .tblinv .clickedrow td{
            background-color: pink;
        }
        .tblinv .clickedrow input{
            background-color: pink;
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
            /* border:1px solid black; */
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
        .clickedrow{
            background-color:pink;
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
    <div style="margin:-15px 0px 0px -13px;padding:0px;">
        <table class="" style="margin:0px 0px 5px 0px;padding:0px;">
            <tr>
                <td style="">
                    <select name="selcustype" id="selcustype" class="kh16-b" style="height:30px;width:200px;">
                        <option value=""></option>
                        <option value="BUYER" @if($customertype=='BUYER') selected @endif>អ្នកទិញ</option>
                        {{-- <option value="SALER" @if($customertype=='SALER') selected @endif>អ្នកលក់</option> --}}
                    </select>
                </td>
                <td style="padding:0px;">
                    <select name="selpartner" id="selpartner" class="kh16-b" style="height:30px;width:250px;">
                        <option value=""></option>
                         @foreach ($partners->where('customertype',$customertype) as $p)
                             <option value="{{ $p->id }}" @if($cid==$p->id) selected @endif>{{ $p->name }}</option>
                         @endforeach
                     </select>

                </td>
                <td>
                    <button class="mybtn kh12-b" id="btnshow">Show</button>
                    <button class="mybtn kh12-b" id="btnprint">Print</button>
                    <button class="mybtn kh12-b" id="btnprintforcustomer">C Print</button>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>លេខបង្កាន់ដៃ<span id="invid" class="badge bg-secondary">{{ $invid }}</span></p>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>រយះពេល<span id="term" title="{{ $sendername }}" class="badge bg-secondary">{{ $term }} ខែ</span></p>
                </td>
                <td class="kh16-b">
                    <p>ការប្រាក់<span id="rate" class="badge bg-secondary">{{ $rate . ' % /m'}} </span></p>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>គិតពី<span id="startdate" class="badge bg-secondary" title="{{ $property_group }}">{{ date('d-m-Y',strtotime($startdate)) }}</span></p>
                </td>
                <td class="kh16-b">
                    <p>ដល់<span id="enddate" class="badge bg-secondary" title="{{ $property_id }}">{{ date('d-m-Y',strtotime($enddate)) }}</span></p>
                </td>
                <td style="display:none;">
                    <input type="text" id="ispayromlos" value="{{ $ispayromlos }}">
                </td>

            </tr>
        </table>

   </div>
    <div class="row" style="margin-top:0px;">
        <div class="col-lg-4">
            <div class="table-responsive">
                <table id="tblinv" class="table table-bordered table-hover tblinv">
                    <thead style="text-align:center;">
                        <th>Inv#</th>
                        <th>Date</th>
                        <th>Property</th>
                        <th>Amount</th>
                    </thead>
                    <tbody id="body_inv">
                        @foreach ($saleinv as $i)
                            <tr class="row_inv @if($invid==$i->id) clickedrow @endif" >
                                <td class="kh14-b">
                                    {{ $i->id }}
                                </td>
                                <td class="kh14-b">{{ date('d-m-Y',strtotime($i->dd))}}
                                    <br>
                                    <a href="#" data-id="{{ $i->id }}" data-cid="{{ $i->parrent_id }}" data-customertype="{{ $i->partner->customertype }}" data-term="{{ $i->term }}" data-rate="{{ $i->interest_rate }}" data-startdate="{{ $i->startdate }}" data-enddate="{{ $i->enddate }}" data-curid="{{ $i->currency_id }}" data-cursk="{{ $i->currency->sk }}" data-curname="{{ $i->currency->shortcut }}" data-payinmonth="{{ $i->payinmonth }}" data-sendername="{{ $i->sendername }}" data-property_group="{{ $i->property_group }}" data-property_id="{{ $i->property_id }}" class="mybtn kh16-b btnrefresh">Refresh</a>
                                </td>
                                <td class="kh14-b">{{ $i->sendername }}</td>
                                <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($i->amount) . $i->currency->sk }}
                                    <br>{{ phpformatnumber($i->deposited) . $i->currency->sk }}
                                    <br>{{ phpformatnumber($i->amount+$i->deposited) . $i->currency->sk }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tableFixHead" style="padding:0px;">
                <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                    <thead style="text-align:center;" class="kh16">
                        <th style="width:70px;">No</th>
                        <th style="width:100px;">លេខវិក័យបត្រ</th>
                        <th style="width:100px;">ថ្ងៃទី</th>
                        <th style="width:250px;">ប្រតិបត្តិការណ៏</th>
                        <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                        <th style="width:150px;">សមតុល្យ</th>
                        <th style="width:120px;">អ្នកកត់ត្រា</th>
                        <th style="width:120px;">ថ្ងៃទូទាត់</th>
                        <th style="width:120px;">ម៉ោង</th>
                    </thead>

                    <tbody id="body_transaction">
                        @php
                            $balance=0;
                        @endphp
                        @foreach ($myc as $k => $tr)
                            @php
                                $balance += floatval($tr['amount']);
                            @endphp
                            <tr>
                                <td style="text-align:center;padding:0px;border-left:none;" class="kh14-b">
                                    @if($tr['action']=='p')
                                        <div class="dropdown">
                                            <button style="width:70px;background-color:aquamarine;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                                            <ul class="dropdown-menu">
                                                <li class="li_code131" title="code:1.3.1"><a class="dropdown-item kh16-b btnpayment" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-payformonth="{{ $tr['dd'] }}" data-payamt="{{ $tr['amount'] }}" data-curid="{{ $tr['curid'] }}" ><i class="fa fa-money"></i> បង់ខែនេះ</a></li>
                                            </ul>
                                        </div>
                                    @elseif($tr['action']=='d')
                                        <div class="dropdown">
                                            <button style="width:70px;color:red;background-color:yellow;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                                            <ul class="dropdown-menu">
                                                <li class="li_code135" title="code:1.3.5"><a class="dropdown-item kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i> លុបចោល</a></li>
                                                <li class="li_code136" title="code:1.3.6"><a class="dropdown-item kh16-b btnreprint" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-payformonth="{{ $tr['payformonth']??'' }}"  data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>

                                            </ul>
                                        </div>
                                    @else
                                        {{ ++$k }}
                                    @endif

                                </td>
                                <td class="kh16">
                                    <a href="#inv{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ $tr['id']?sprintf("%04d",$tr['id']):'' }}</a>
                                </td>


                                <td class="kh16">
                                    {{ date('d-m-Y',strtotime($tr['dd'])) }}
                                </td>

                                <td class="kh16">{{ $tr['tranname'] }}</td>

                                <td class="kh16-b" style="text-align:right;@if($tr['amount']>0) color:blue; @else color:red; @endif">{{ $tr['amount']>0?'+':'' }} {{ phpformatnumber($tr['amount']) .$tr['currency'] }}</td>

                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($balance) .$tr['currency'] }}</td>
                                <td class="kh16">{{ $tr['usersave'] }}</td>
                                <td class="kh16">
                                    {{ $tr['trandate']? date('d-m-Y',strtotime($tr['trandate'])):'' }}
                                </td>
                                <td class="kh16">{{ $tr['tt'] }}</td>
                            </tr>
                            <tr id="inv{{ $tr['id'] }}" class="collapse borderset2" style="">
                                <td colspan=9 style="">
                                    <table class="table table-bordered" style="margin:0px;">
                                        <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach (App\PartnerTransfer::showbygroup($tr['id'],$tr['groupid']) as $item)
                                                @php
                                                    $i=$i+1;
                                                @endphp
                                                @if($i==1)
                                                    <tr class="kh12-b" style="text-align:center;border-top:none;background-color:antiquewhite">
                                                        <td style="width:100px;">ID</td>
                                                        <td style="width:100px;">ថ្ងៃទូទាត់</td>
                                                        <td style="width:80px;">Time</td>
                                                        <td style="width:90px;">បង់ខែ</td>
                                                        <td style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                                        <td style="width:150px;">ដៃគូ</td>
                                                        <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                                        <td style="width:80px;">ពិន័យ</td>
                                                        <td style="width:80px;">លើកលែង</td>
                                                        <td style="width:100px;">អ្នកកត់ត្រា</td>
                                                        <td style="width:100px;">ថ្ងៃកត់ត្រា</td>
                                                        <td style="width:200px;">ផ្សេងៗ</td>

                                                    </tr>
                                                @endif
                                                <tr class="kh12-b" style="">
                                                    <td style="text-align:center;">{{ $item->id }}
                                                        @if($item->id==explode('-',$item->ref_group_id)[1])
                                                            @if($i==1)
                                                                <br>
                                                                <a href="" class="mybtn btnupdatepayment" data-id="{{$item->id}}" data-group_id="{{$item->ref_group_id}}" style="color:purple;border-style:none;">Fix Paid</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y',strtotime($item->dd))}}
                                                         @if($item->id==explode('-',$item->ref_group_id)[1])
                                                            @if($i==1)
                                                                <br>
                                                                <a class="mybtn btnreprint" style="color:rgb(57, 54, 233);border-style:none;" href="#" data-id="{{ $item->id }}" data-payformonth="{{ $item->payformonth??'' }}"  data-groupid="{{ $item->ref_group_id }}">ព្រីនឡើងវិញ</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->tt }}</td>
                                                    <td>{{ $item->payformonth?date('d-m-Y',strtotime($item->payformonth)):''}}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                                    <td style="text-align:right;">{{ phpformatnumber($item->trancode==-8?0:$item->cuscharge) . ' ' . $item->cuschargecur->sk }}</td>
                                                    <td style="text-align:right;">{{ phpformatnumber($item->discount_amount) . ' ' . $item->cuschargecur->sk }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($item->created_at))}}</td>
                                                    <td>{{ $item->note }}</td>

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
    @include('realestates.paymentmodal');
@endsection
@section('script')
<script type="text/javascript">
     $('#h1_title').text('តារាងបង់រំលស់');

     var windowWidth = $(window).width();
    var windowHeight = $(window).height();
    var divheight=windowHeight-170;
    var tableFixHead=document.getElementsByClassName('tableFixHead');
    for(i=0; i<tableFixHead.length; i++) {
        tableFixHead[i].style.height=divheight+'px';
    }
    $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-170;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
    });
    function getUserPermissions(userId) {
        const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
        return permusers
            .filter(item => item.userid == userId)
            .map(item => item.code);
    }
    var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
    const userId = "{{ Auth::id() }}";
    const userPerms = new Set(getUserPermissions(userId));
    if (!isAdmin) {
        if (!userPerms.has('1.3.1')) {
            $('.li_code131').hide(); // Shorter way to hide
        }
        if (!userPerms.has('1.3.5')) {
            $('.li_code135').hide();
        }
        if (!userPerms.has('1.3.6')) {
            $('.li_code136').hide();
        }

         if (!userPerms.has('1.3.7')) {
            $('#row_nopunish').hide();
        }
         if (!userPerms.has('1.3.8')) {
            $('#btncomplete').hide();
        }
        if (!userPerms.has('1.3.4')) {
             $('#qty').prop('disabled', true);
        }
        if (!userPerms.has('1.3.9')) {
            $('#deposit').attr('readonly',true);
        }

    }
    $(document).ready(function () {
        var indextitle= findindexrowbyvalue($('#invid').text());
        $('#invid').attr('title',indextitle);
        var today=new Date();
      $('#invdate').datetimepicker({
          timepicker:false,
          datepicker:true,
          value:today,
          format:'d-m-Y',
          autoclose:true,
          todayBtn:true,
          startDate:today,

      });
       var cleavepayamt = new Cleave('#payamt', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
    var cleavepaycommission = new Cleave('#paycommission', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleaveoverprice = new Cleave('#overprice', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleavediscountamt = new Cleave('#discount_amount', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var cleaveoverday = new Cleave('#overday', {
          numeral: true,
          numeralPositiveOnly: true,
      });
      var cleavepaypunish = new Cleave('#paypunish_amount', {
          numeral: true,
          numeralPositiveOnly: true,
          numeralThousandsGroupStyle: 'thousand'
      });
      var rolename="{{ Auth::user()->role->name }}";
      if(rolename!=='Admin'){
          $('#invdate').datetimepicker("destroy");
      }
        function findindexrowbyvalue(RName)
        {
            //var val = $('#body_inv tr td:contains(' + RName + ')').index();//catch td index
            var rowind = $('#body_inv tr td:contains(' + RName + ')').closest("tr").index();
            //var checkname=$('#body_inv tr > td:contains('+ pname +')').length;//check table cell has value
            return rowind;
        }
        $('#selpartner').select2();
        $(document).on('click','.tbl_transferlist td',function(e){
            // Remove previous highlight class
            $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
        })
        $(document).on('click','.tblinv td',function(e){
            // Remove previous highlight class
            $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
        })
        $(document).on('change','#selcustype',function(e){
            e.preventDefault();
            getpartner($(this).val(),'#selpartner');
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
        function setnextmonth(setdate,el,qty){
            var arr_date=setdate.split('-');
            const dd = new Date(arr_date[2] + '-' + arr_date[1] + '-' + arr_date[0]);
            var paydate=addMonths(qty, dd);
            $(el).val(moment(paydate).format("DD-MM-YYYY"));
        }

      function addMonths(numOfMonths, date = new Date()) {
            date.setMonth(date.getMonth() + numOfMonths);
            return date;
        }
        function dateDiff(startDate, endDate) {
            // Convert both dates to milliseconds
            let start = new Date(startDate);
            let end = new Date(endDate);

            // Calculate the difference in milliseconds
            let diff = end - start;

            // Convert milliseconds to days
            return Math.floor(diff / (1000 * 60 * 60 * 24));
        }
        $(document).on('click','.btnreprint',function(e){
            e.preventDefault();
            var isromlos=1;
            var id=$(this).data('id');
            var groupid=$(this).data('groupid');
            var propertyname=$('#term').attr('title');
            var payformonth=$(this).data('payformonth');
            if(payformonth==''){
                isromlos=0;
            }
            printdeposit(id,groupid,'បង្កាន់ដៃបង់ប្រាក់(ព្រីនឡើងវិញ)',propertyname,isromlos)

        })
        function printdeposit(id,groupid,rpttitle,propertyname,isromlos){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname+'&ispayromlos='+isromlos , '_blank');
          redirectWindow.location;
        }
        $(document).on('change','#invdate',function(e){
            e.preventDefault();
            getoverday();

        })
         $(document).on('change', '#ckpaypunish', function (e) {
            e.preventDefault();
            var ischeck = document.getElementById('ckpaypunish').checked;
            if (ischeck) {
                $('#paypunish_amount').removeAttr('readonly');
            } else {
                var olddebt=$('#old_cuscharge_debt').val().replace(/,/g, '');
                var ovamt=$('#overamount').val().replace(/,/g, '');
                $('#paypunish_amount').val(formatNumber(parseFloat(ovamt)+parseFloat(olddebt)));
                $('#paypunish_amount').attr('readonly', 'readonly');
            }
            $('#paypunish_amount').trigger('change');
        });
        $(document).on('change', '#cknopunish', function (e) {
            e.preventDefault();
            var ischeck = document.getElementById('cknopunish').checked;
            if (ischeck) {
                var olddebt=$('#old_cuscharge_debt').val().replace(/,/g, '');
                var ovamt=$('#overamount').val().replace(/,/g, '');
                $('#discount_amount').val(formatNumber(parseFloat(ovamt)+parseFloat(olddebt)));
                $('#discount_amount').removeAttr('readonly');
            } else {
                $('#discount_amount').val(0);
                $('#discount_amount').attr('readonly', 'readonly');
            }
            $('#discount_amount').trigger('change');
        });

        $(document).on('change','#overprice,#overday',function(e){
            e.preventDefault();
            let overday=$('#overday').val().replace(/,/g,'');
            let buyqty=$('#qtybuy').val().replace(/,/g,'');
            let ovprice=$('#overprice').val().replace(/,/g,'');
            let totalmoney=parseFloat(ovprice)* parseFloat(overday)* parseFloat(buyqty);
            $('#overamount').val(formatNumber(totalmoney));
            $('#overamount').trigger('change');

        })
        function getoverday_old()
        {
            let invdate=$('#invdate').val().split('-');
            let payformonth=$('#payformonth').val().split('-');
            let payfornextmonth=$('#payfornextmonth').val().split('-');
            //debugger;
            let startDate =payformonth[2]+'-'+payformonth[1]+'-'+payformonth[0];
            let endDate = invdate[2]+'-'+invdate[1]+'-'+invdate[0]
            let startDate1 =payfornextmonth[2]+'-'+payfornextmonth[1]+'-'+payfornextmonth[0];
            let qty1=dateDiff(startDate1, endDate);
            let qty0=dateDiff(startDate, endDate);
            qty0=parseFloat(qty0)-9;
            let qty=0;
            let overday=0;
            if(qty1>0){
                qty=dateDiff(startDate, startDate1);
                if(qty0-9>30){
                    overday=parseFloat(qty);
                }else{
                    overday=parseFloat(qty0)-9;
                }
            }else{
                qty=dateDiff(startDate, endDate);
                overday=parseFloat(qty)-9;
            }
            if(overday<0) overday=0;
            $('#overday').val(overday);
            $('#overday').attr('title',overday);
            $('#overprice').val(5);
            $('#overprice').attr('title',5);
            let qtybuy=$('#qtybuy').val().replace(/,/g,'');
            let ovprice=$('#overprice').val().replace(/,/g,'');
            let totalmoney=parseFloat(ovprice)* parseFloat(overday)* parseFloat(qtybuy);
            $('#overamount').val(formatNumber(totalmoney));
            $('#overamount').trigger('change');
            if(overday>0){
                $('#qty').attr('readonly',true);
            }else{
                $('#qty').attr('readonly',false);
            }
        }
          function getoverday()
        {
            let invdate=$('#invdate').val().split('-');
            let payformonth=$('#payformonth').val().split('-');
            let payfornextmonth=$('#payfornextmonth').val().split('-');
            //debugger;
            let startDate =payformonth[2]+'-'+payformonth[1]+'-'+payformonth[0];
            let endDate = invdate[2]+'-'+invdate[1]+'-'+invdate[0]
            let startDate1 =payfornextmonth[2]+'-'+payfornextmonth[1]+'-'+payfornextmonth[0];
            let qty1=dateDiff(startDate1, endDate);
            let qty0=dateDiff(startDate, endDate);
            qty0=parseFloat(qty0)-9;
            let qty=0;
            let overday=0;
            // if(qty1>0){
            //     qty=dateDiff(startDate, startDate1);
            //     if(qty0-9>30){
            //         overday=parseFloat(qty);
            //     }else{
            //         overday=parseFloat(qty0)-9;
            //     }
            // }else{
            //     qty=dateDiff(startDate, endDate);
            //     overday=parseFloat(qty)-9;
            // }
            qty=dateDiff(startDate, endDate);
            overday=parseFloat(qty)-9;
            if(overday<0) overday=0;
            $('#overday').val(overday);
            $('#overday').attr('title',overday);
            $('#overprice').val(5);
            $('#overprice').attr('title',5);
            let qtybuy=$('#qtybuy').val().replace(/,/g,'');
            let ovprice=$('#overprice').val().replace(/,/g,'');
            let totalmoney=parseFloat(ovprice)* parseFloat(overday)* parseFloat(qtybuy);
            $('#overamount').val(formatNumber(totalmoney));
            $('#overamount').trigger('change');
            if(overday>0){
                $('#qty').attr('readonly',true);
            }else{
                $('#qty').attr('readonly',false);
            }
        }

        $(document).on('click','.btnpayment',function(e){
            e.preventDefault();
            $('#paymentmodal').modal('show');
            //$('#deposit').attr('readonly',true);
            var id=$(this).data('payonid');
            var payformonth=$(this).data('payformonth');
            var deposit=$(this).data('payamt');
            var url="{{ route('realestate.payment') }}";
            $.get(url,{id:id},function(data){
                //console.log(data)
                if(data.success){
                    $('#old_cuscharge_debt').val(formatNumber(data['cusdebt'].cuscharge_debt??0));
                    $('#m_title').text('បង់ប្រាក់');
                    $('#id1').val(data['transfers']['id']);
                    $('#id2').val(data['transfers']['map_id']);
                    $('#trancode').val(data['transfers']['trancode']);
                    $('#invdate').val(moment(new Date()).format("DD-MM-YYYY"));
                    $('#payformonth').val(moment(payformonth).format("DD-MM-YYYY"));
                    setnextmonth($('#payformonth').val(),$('#payfornextmonth'),1);
                    if(data['transfers']['trancode']==-8){
                        $('#labelname').text("អតិថិជន");
                    }else{
                        $('#labelname').text("អ្នកលក់គំរោង");
                    }
                    $('#txtname').val(data['transfers'].partner.name);
                    $('#txtname').attr('title',data['transfers']['parrent_id']);

                    $('#amount').val(formatNumber(Math.abs(data['transfers']['amount'])));
                    $('#txtcur').val(data['transfers']['currency'].shortcut);
                    $('#txtcur').attr('title',data['transfers'].currency_id);
                    $('#row_deposited').css('display','table-row');
                    $('#row_balance').css('display','table-row');
                    $('#row_qty').css('display','table-row');
                    $('#row_payformonth').css('display','table-row');
                    $('#row_payfornextmonth').css('display','table-row');
                    $('#qty').val(1);
                    $('#deposited').val(formatNumber(data['totalpayment']));
                    $('.cur').val(data['transfers']['currency'].shortcut);
                    $('#balance').val(formatNumber(parseFloat(Math.abs(data['transfers']['amount']) - parseFloat(Math.abs(data['totalpayment'])) )));
                    $('#deposit').val(formatNumber(deposit));
                    $('#deposit').attr('title',deposit);
                    $('#deposit').trigger('change');
                    $('#btnsavesale').css('display','none');
                    $('#btnsavesaleprint').css('display','none');
                    $('#btndelete').css('display','none');
                    $('#btnsavedeposit').css('display','table-row');
                    $('#btnsavedepositprint').css('display','table-row');
                    var propertyname='';
                    var row='';
                    var qtybuy=0;
                    $('#selproperty50').empty();
                    $('#selproperty50').append($('<option>', {
                        value: "",
                        text: ""
                    }));
                    for(let i=0;i<data['saledetails'].length;i++){
                        qtybuy +=1;
                        if(i==0){
                            propertyname=data['saledetails'][i].property.name;
                        }else{
                            propertyname+=','+ data['saledetails'][i].property.name;
                        }
                        row +=`
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
                    $('#qtybuy').val(qtybuy);
                    getoverday();
                    $('#haction').css('display','none');
                    $('#body_sale_detail').empty().append(row);

                    $('#amount').attr('title',propertyname);
                    $('#deposited').attr('title',$('#startdate').attr('title'));
                    $('#balance').attr('title',$('#enddate').attr('title'));
                    $('#selproperty50').select2();
                    $('#commission_left').val(formatNumber(data['commissionleft']));
                    if(data['commissionleft']<=0){
                        $('#paycommission').val(0);
                    }
                }else{
                    alert('Load data error')
                }
            })
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault();
            var el=$(this).attr('id');
            var invid=$('#invid').text();
            var rowind=$('#invid').attr('title');
            var id=$('.btnrefresh').eq(rowind).data('id');
            var cid=$('.btnrefresh').eq(rowind).data('cid');
            var cname=$('#selpartner option:selected').text();
            var customertype=$('.btnrefresh').eq(rowind).data('customertype');
            var term=$('.btnrefresh').eq(rowind).data('term');
            var rate=$('.btnrefresh').eq(rowind).data('rate');
            var startdate=$('.btnrefresh').eq(rowind).data('startdate');
            var enddate=$('.btnrefresh').eq(rowind).data('enddate');
            var sendername=$('.btnrefresh').eq(rowind).data('sendername');
            var curid=$('.btnrefresh').eq(rowind).data('curid');
            var cursk=$('.btnrefresh').eq(rowind).data('cursk');
            var payinmonth=$('.btnrefresh').eq(rowind).data('payinmonth');
            var ispayromlos=$('#ispayromlos').val();
            var redirectWindow = window.open('{{ url('/') }}'+'/realestate/searchromlos?id='+invid+'&cid='+cid+'&customertype='+customertype+'&term='+term+'&rate='+rate+'&startdate='+startdate+'&enddate='+enddate+'&curid='+curid+'&cursk='+cursk+'&payinmonth='+payinmonth+'&ispayromlos='+ispayromlos+'&cname='+cname+'&isprint='+1+'&propertyname='+sendername , '_blank');
            redirectWindow.location;
        })
        $(document).on('click','#btnshow',function(e){
            e.preventDefault();
            var cid=$('#selpartner').val();
            refreshinvsold(cid);
        })
        $(document).on('click','.btndel',function(e){
            e.preventDefault();
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
                        url: "{{ route('realestate.deletepayment') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                refreshinvsold($('#selpartner').val());
                                searchromlos($('#invid').attr('title'));
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
        $(document).on('change','#deposit',function(e){
            e.preventDefault();
            var bal=$('#balance').val().replace(/,/g, '');
            var dep=$('#deposit').val().replace(/,/g, '');
            var bal1=parseFloat(bal)-parseFloat(dep);
            var ovamt=$('#overamount').val().replace(/,/g, '');
            $('#balance1').val(formatNumber(bal1));
            //$('#payamt').val(formatNumber(parseFloat(dep)+parseFloat(ovamt)));
            calcupayment();
        })
          $(document).on('change','#overamount',function(e){
            e.preventDefault();
            var olddebt=$('#old_cuscharge_debt').val().replace(/,/g, '');
            var ovamt=$('#overamount').val().replace(/,/g, '');
            $('#total_after_discount').val(formatNumber(parseFloat(olddebt)+parseFloat(ovamt)));
            $('#paypunish_amount').val(formatNumber(parseFloat(olddebt)+parseFloat(ovamt)));
            $('#discount_amount').val(0);
            $('#cuscharge_debt').val(0);
            calcupayment();
            // var ovamt=$('#overamount').val().replace(/,/g, '');
            // var dep=$('#deposit').val().replace(/,/g, '');
            // $('#payamt').val(formatNumber(parseFloat(dep)+parseFloat(ovamt)));
        })

         $(document).on('change','#discount_amount,#paypunish_amount',function(e){
            e.preventDefault();
           calcupayment();
        })
        function calcupayment()
        {
            var ovamt=$('#overamount').val().replace(/,/g, '');
            var olddebt=$('#old_cuscharge_debt').val().replace(/,/g, '');
            var ovdebt=parseFloat(ovamt) + parseFloat(olddebt);
            var paypunish=$('#paypunish_amount').val().replace(/,/g,'');
            var discount=$('#discount_amount').val().replace(/,/g,'');
            var dep=$('#deposit').val().replace(/,/g, '');
            if(parseFloat(discount)>parseFloat(ovdebt)){
                $('#discount_amount').val(ovdebt);
            }
            discount=$('#discount_amount').val().replace(/,/g,'');
            var totalafterdiscount=parseFloat(ovdebt)-parseFloat(discount);
             if(parseFloat(paypunish)>parseFloat(totalafterdiscount)){
                $('#paypunish_amount').val(totalafterdiscount);
            }
            paypunish=$('#paypunish_amount').val().replace(/,/g,'');
            var cuscharge_debt=parseFloat(totalafterdiscount)-parseFloat(paypunish);
            $('#total_after_discount').val(formatNumber(totalafterdiscount))
             $('#cuscharge_debt').val(formatNumber(cuscharge_debt))
            $('#payamt').val(formatNumber(parseFloat(dep)+parseFloat(paypunish)));
        }
        $(document).on('change','#qty',function(e){
            e.preventDefault();
            var amt=$('#deposit').attr('title');
            var qty=$(this).val();
            var totalamt=parseFloat(amt)*parseFloat(qty);
            $('#deposit').val(formatNumber(totalamt));
            $('#deposit').trigger('change');
            setnextmonth($('#payformonth').val(),$('#payfornextmonth'),parseFloat(qty));
        })
        $(document).on('change','#selpartner',function(e){
            e.preventDefault();
            var cid=$(this).val();
            refreshinvsold(cid);

        })
        function refreshinvsold(cid)
        {
            $('body').addClass("wait");
            var customertype=$('#selcustype').val();
            var invid=$('#invid').text();
            var url="{{ route('realestate.showinvbycustomer') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {cid:cid,customertype:customertype},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    var row='';
                    for(let i=0;i<data['saleinv'].length;i++){
                        row +=`
                            <tr class="row_inv ${invid==data['saleinv'][i].id?'clickedrow':''}">
                                <td class="kh14-b">
                                    ${data['saleinv'][i].id} <br>
                                </td>
                                <td class="kh14-b">${moment(data['saleinv'][i].dd).format("DD-MM-YYYY") }
                                     <br>

                                    <a href="#" data-id="${data['saleinv'][i].id}" data-cid="${data['saleinv'][i].parrent_id}" data-customertype="${data['saleinv'][i].partner.customertype}" data-term="${data['saleinv'][i].term}" data-rate="${data['saleinv'][i].interest_rate}" data-startdate="${data['saleinv'][i].startdate}" data-enddate="${data['saleinv'][i].enddate}" data-curid="${data['saleinv'][i].currency_id}" data-cursk="${data['saleinv'][i].currency.sk}" data-curname="${data['saleinv'][i].currency.shortcut}" data-payinmonth="${data['saleinv'][i].payinmonth}" data-sendername="${data['saleinv'][i].sendername}" class="mybtn kh16-b btnrefresh">Refresh</a>
                                </td>
                                <td class="kh14-b">${data['saleinv'][i].sendername}</td>
                                <td class="kh14-b" style="text-align:right;">${formatNumber(data['saleinv'][i].amount) + data['saleinv'][i].currency.sk }
                                    <br>  ${formatNumber(data['saleinv'][i].deposited) + data['saleinv'][i].currency.sk }
                                    <br>  ${formatNumber(parseFloat(data['saleinv'][i].amount)+parseFloat(data['saleinv'][i].deposited)) + data['saleinv'][i].currency.sk }
                                </td>

                            </tr>
                        `;
                    }
                    $('#body_inv').empty().append(row);
                    $('#body_transaction').empty();
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $(document).on('click','.row_inv',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            searchromlos(rowind);
        })
        $(document).on('click','.btnrefresh',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            searchromlos(rowind);
        })

        function searchromlos(rowind)
        {

            var id=$('.btnrefresh').eq(rowind).data('id');
            var cid=$('.btnrefresh').eq(rowind).data('cid');
            var customertype=$('.btnrefresh').eq(rowind).data('customertype');
            var term=$('.btnrefresh').eq(rowind).data('term');
            var rate=$('.btnrefresh').eq(rowind).data('rate');
            var startdate=$('.btnrefresh').eq(rowind).data('startdate');
            var enddate=$('.btnrefresh').eq(rowind).data('enddate');
            var sendername=$('.btnrefresh').eq(rowind).data('sendername');
            var curid=$('.btnrefresh').eq(rowind).data('curid');
            var cursk=$('.btnrefresh').eq(rowind).data('cursk');
            var payinmonth=$('.btnrefresh').eq(rowind).data('payinmonth');
            var pgroup=$('.btnrefresh').eq(rowind).data('property_group');
            var pid=$('.btnrefresh').eq(rowind).data('property_id');

            var ispayromlos=$('#ispayromlos').val();
            $('#invid').text(id);
            $('#invid').attr('title',rowind);
            $('#term').text(term + ' ខែ');
            $('#term').attr('title',sendername);
            $('#rate').text(rate + ' % /m');
            $('#startdate').text(moment(startdate).format("DD-MM-YYYY"));
            $('#enddate').text(moment(enddate).format("DD-MM-YYYY"));
            $('#startdate').attr('title',pgroup);
            $('#enddate').attr('title',pid);

            var url="{{ route('realestate.searchromlos') }}";
            $('body').addClass("wait");
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {id:id,cid:cid,customertype:customertype,term:term,rate:rate,startdate:startdate,enddate:enddate,curid:curid,cursk:cursk,payinmonth:payinmonth,ispayromlos:ispayromlos},

                complete: function () {},
                success: function (data) {
                    //console.log(data)

                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                    if (!isAdmin) {
                        if (!userPerms.has('1.3.1')) {
                            $('.li_code131').hide(); // Shorter way to hide
                        }
                        if (!userPerms.has('1.3.5')) {
                            $('.li_code135').hide();
                        }
                            if (!userPerms.has('1.3.6')) {
                            $('.li_code136').hide();
                        }
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
        $(document).on('click', '.btnupdatepayment', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var group_id = $(this).data('group_id');
            var url = "{{ route('realestate.fixpaymentbyid') }}";

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to fix this payment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, fix it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('body').addClass("wait");
                    $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: { id: id, group_id: group_id },

                        complete: function () {},
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                toastr.success("Fixed");
                                $('body').removeClass("wait");
                            } else {
                                $('body').removeClass("wait");
                                alert(data.error);
                            }
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.');
                        }
                    });
                }
            });
        });

        $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
            e.preventDefault();
            var table = document.getElementById("tbl_sale_detail");
            var tbodyRowCount = table.tBodies[0].rows.length;
            if(tbodyRowCount==0){
                alert('save not allow')
                return;
            }
            var commissionleft = $('#commission_left').val().replace(/,/g, '').trim();
            var paycommission = $('#paycommission').val().replace(/,/g, '').trim();

            // Convert to numbers
            var commissionLeftNum = parseFloat(commissionleft) || 0;
            var payCommissionNum = parseFloat(paycommission) || 0;

            // Compare
            if (payCommissionNum > commissionLeftNum) {
                alert('Pay commission cannot be greater than commission left.');
                return false;
            }

            var deposit=$('#deposit').val().replace(/,/g,'');
            // var overamount=$('#overamount').val().replace(/,/g,'');
            // var discount=$('#discount_amount').val().replace(/,/g,'');
            //var paythismonth=parseFloat(deposit)+parseFloat(overamount)-parseFloat(discount);
            var totalafterdis=$('#total_after_discount').val().replace(/,/g,'');
            var cuscharge_debt=$('#cuscharge_debt').val().replace(/,/g,'');
            var paythismonth=parseFloat(deposit)+parseFloat(totalafterdis)-parseFloat(cuscharge_debt);
            var payamt=$('#payamt').val().replace(/,/g,'');
            if(parseFloat(deposit)<0){
                alert('deposit amount must be positive')
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
            var property_group=$('#deposited').attr('title');
            var property_id=$('#balance').attr('title');
            var payby=$('#selbank option:selected').text();
            var partner_id=$('#txtname').attr('title');
            var nopunish=document.getElementById('cknopunish').checked;
            var property=$('#amount').attr('title');
            formdata.append('qty',$('#qty').val());
            formdata.append('property',property);
            formdata.append('nopunish',nopunish);
            formdata.append('isromlos',1);
            formdata.append('payby',payby);
            formdata.append('curid',curid);
            formdata.append('partner_id',partner_id);
            formdata.append('property_group',property_group);
            formdata.append('property_id',property_id);
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
                            printdeposit(data.id,data.groupid,'បង្កាន់ដៃបង់ប្រាក់',$('#amount').attr('title'),1);
                        }
                        toastr.success("Save Sale Successfully");
                        //location.reload();
                        searchromlos($('#invid').attr('title'));
                        refreshinvsold($('#selpartner').val());
                        $(el).removeAttr('disabled').html(btntext);
                        $('#frmdeposit').trigger('reset');
                        $('#body_sale_detail').empty();
                        $('#selbank').trigger('change');
                        $('#paymentmodal').modal('hide');
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

    })//end document

</script>
@endsection
