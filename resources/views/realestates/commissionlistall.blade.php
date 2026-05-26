@extends('master')
@section('title') ទូទាត់កម្រៃជើងសារសរុប @endsection
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
        .tableFixHead{ overflow: auto;}
        .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

        .tableFixHead2{ overflow: auto;border:1px dotted black;}
        .tableFixHead1{ overflow: auto;border:1px dotted black;}
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
        /* .tbl_transferlist .clickedrow input, */
        .tbl_transferlist .clickedrow div,
        .tbl_transferlist .clickedrow label
        {
            background-color: blue !important;
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
        .td_selblock {
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px;
            }
        .d-none { display: none; }
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
    <div class="" style="margin:-15px 0px 10px -10px;">
          <table id="tbl0" class="tbl0" style="margin:0px;padding:0px;">
              <tr>

                  <td class="kh16-b" style="padding-left:5px;display:none;">
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
                  <td style="padding-left:5px;width:200px;">
                      <select name="selsaler" id="selsaler" class="kh16-b" style="height:30px;width:200px;">
                          <option value="">ទាំងអស់</option>
                          @foreach ($salers as $item)
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                      </select>

                  </td>
                  <td class="kh16-b" style="padding-left:5px;width:220px;">

                      <select multiple class="select" name="selblock" id="selblock" style="width:200px;">
                          {{-- <option value="">all block</option> --}}
                          @foreach ($groups as $b)
                              <option value="{{ $b->id }}">{{ $b->name }}</option>
                          @endforeach
                      </select>
                  </td>
                  <td style="width:150px;padding-left:10px;">
                      <select class="kh16-b" name="sel_property" id="sel_property" style="width:150px;">
                          <option value="">all property</option>
                          @foreach ($allproperty as $p)
                              <option value="{{ $p->id }}">{{ $p->name }}</option>
                          @endforeach
                      </select>
                  </td>
                  <td style="width:150px;padding-left:10px;">
                      <select class="kh16-b" name="sel_data" id="sel_data" style="width:150px;">
                          <option value="0">មិនទាន់ទូទាត់</option>
                          <option value="1">ទូទាត់រួចរាល់</option>
                          <option value="2">ទាំងអស់</option>

                      </select>
                  </td>
                  <td style="padding:0px 10px;width:200px;">
                      <button id="btnsearch" class="mybtn kh12-b">Search</button>
                      <button id="btnprintall" class="mybtn kh12-b">Print</button>


                    </td>


                  <td style="display:none;">
                      <input type="text" class="kh16" id="tableSearch" style="width:200px;"  placeholder="Search What You Want..." title="Type what you khnow">
                  </td>
              </tr>
          </table>
    </div>


    <div id="" class="row" style="margin-top:-10px;">
        <div class="tableFixHead1" style="padding:0px;">
            <div id="submitedlist" style="display:none;">

            </div>
            <div id="commissionlist">
                <table id="tbl_commission_list" class="table table-bordered table-hover kh14-b tbl_transferlist" style="table-layout:fixed;">
                    <thead style="text-align:center;" class="kh14">
                        <th style="width:70px;">No</th>
                        <th style="width:100px;text-align:left;padding-left:5px;">
                            <input class="form-check-input" type="checkbox" name="ckidall" value="" id="ckidall" />
                            <label class="form-check-label" for="ckidall">ALL</label>
                        </th>
                        <th style="width:100px;">
                            <button id="btnsortproperty" class="mybtn kh12-b">Sort A->Z</button>
                        </th>
                        <th style="width:150px;">អ្នកលក់</th>
                        <th style="width:150px;">អតិថិជន</th>
                        <th style="width:100px;">បង់ខែ</th>
                        <th style="width:120px;">កក់ចំនួន</th>
                        <th style="width:120px;">បង់ជើងសារ</th>
                        <th style="width:120px;">កម្រៃជើងសារ</th>
                        <th style="width:120px;">បានទូទាត់រួច</th>
                        <th style="width:120px;">នៅខ្វះ</th>
                        <th style="width:120px;">ទឹកប្រាក់លក់</th>
                        <th style="width:120px;">សរុបលុយកក់</th>
                        <th style="width:120px;">ទឹកប្រាក់នៅសល់</th>
                        <th style="width:100px;">កក់ចុងក្រោយ</th>
                        <th style="width:100px;">Action</th>

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
                                    {{ $j }}
                                </td>
                                <td>
                                    @if($t->over_pay==0)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="ckid" value="{{ $t->id }}" id="ckid{{ $t->id }}" />
                                            <label class="form-check-label" for="ckid{{ $t->id }}"> {{ $t->id }}</label>
                                        </div>
                                    @else
                                         {{ $t->id }}
                                    @endif
                                </td>
                                <td>{{ $t->propertyname }}</td>
                                <td>{{ $t->partner->name }}</td>
                                <td>{{ $t->customername }}</td>

                                <td>{{ $t->payformonth?date('d-m-Y',strtotime($t->payformonth)) : '' }}</td>

                                <td style="text-align:right;color:red;">{{ phpformatnumber($t->deposit_amount) . $t->currency->sk}}</td>
                                <td style="padding:0px;">
                                    <input type="text" style="text-align:right;width:100%;background-color:yellow;height:100%;" class="kh16-b tdcanenter txtcommission"  data-default="{{ phpformatnumber($t->getcommission) }}" value="{{ phpformatnumber($t->getcommission) }}">
                                </td>
                                <td style="text-align:right;">{{ phpformatnumber($t->commission) . $t->currency->sk}}</td>
                                <td style="text-align:right;">
                                    <a href="{{ route('realestate.showcommissionpaid_detail',['payonid'=>$t->payonid,'customer_id'=>$t->parrent_id,'id'=>$t->id]) }}" class="" target="_blank" style="margin:0px;padding:2px;text-decoration:underline;"> {{ phpformatnumber($t->commission_paid) . $t->currency->sk}}{{ '(' . $t->countpay_commission . ')'}}</a>
                                </td>
                                <td style="text-align:right;background-color:yellow;">{{ phpformatnumber(abs($t->commission)-abs($t->commission_paid)) . $t->currency->sk}}</td>
                                <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)) . '$'}}</td>
                                <td class="" style="text-align:right;">
                                    <a href="{{ route('realestate.showdeposit',['id'=>$t->main_id,'customer_id'=>$t->main_parrent_id,'customertype'=>$t->main_customertype,'term'=>$t->main_term,'rate'=>$t->main_interest_rate,'startdate'=>$t->main_startdate,'enddate'=>$t->main_enddate,'curid'=>$t->currency_id,'cursk'=>$t->currency->sk,'curname'=>$t->currency->shortcut,'payinmonth'=>$t->main_payinmonth,'sendername'=>$t->propertyname]) }}" class="" target="_blank" style="margin:0px;padding:2px;text-decoration:underline;">{{ phpformatnumber($t->sumdeposit) . $t->currency->sk . '(' . $t->countrow . ')' }}</a>
                                </td>
                                <td style="text-align:right;">{{ phpformatnumber(abs($t->sold_amount)-abs($t->sumdeposit)) . '$' }}</td>

                                <td>{{ date('d-m-Y',strtotime($t->deposit_date)) }}</td>
                                <td style="text-align:center;">
                                    <a href="" class="btnupdatecommission" data-id="{{ $t->id }}" style="color:red;">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="table-responsive" style="padding:5px 0px; margin-left:-10px;">
        <table>
            <tr>
                <td class="kh22">សរុប កម្រៃជើងសារ </td>
                <td class="kh22-b" id="total_commission" style="padding-left:10px;">0</td>
                <td class="kh22-b" id="" style="padding-left:10px;">USD</td>
                <td class="kh22" style="padding-left:20px;">ទូទាត់តាម</td>
                <td style="padding-left:10px;">
                    <select name="selbank" id="selbank" class="form-select kh22-b" style="">
                        <option value="cash">សាច់ប្រាក់</option>
                        @foreach ($partners->where('customertype','BANK') as $b)
                            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" thai_list="{{ $b->thai_list }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="kh22" style="padding-left:10px;">ថ្ងៃទូទាត់ </td>
                <td class="kh16-b" style="width:160px;padding-left:10px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="dd" id="dd" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td style="padding-left:10px;">
                    <button class="mybtn btnsubmit">Submit</button>
                </td>
                <td style="padding-left:10px;">
                    <button class="mybtn btnpaidlist">PaidList</button>
                    <button class="mybtn btnclosepaidlist">Close</button>

                </td>
            </tr>
        </table>
    </div>

    @include('realestates.paycommissionmodal');
@endsection
@section('script')
    <script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('តារាងទូទាត់កម្រៃជើងសារសរុប');

         refreshtableFixHead(220);
        $(window).resize(function() {
            refreshtableFixHead(220);
        });
        function refreshtableFixHead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead1');
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
            //$('#selblock').select2();
            $('#selbank').select2();
            VirtualSelect.init({
                ele: '#selblock' ,
                 multiple: true,
            });


            var today=new Date();
            $('#dd,#d1,#d2').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,
            });

             $('.txtcommission').toArray().forEach(function(field){
                new Cleave(field, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            })

            $(document).on('click', '.toggle-text', function() {
                const $td = $(this).closest('td');
                const $short = $td.find('.short-text');
                const $full = $td.find('.full-text');

                if ($full.hasClass('d-none')) {
                    $short.addClass('d-none');
                    $full.removeClass('d-none');
                    $(this).text('less');
                } else {
                    $short.removeClass('d-none');
                    $full.addClass('d-none');
                    $(this).text('more');
                }
            });

            $(document).on('click', '.btnupdatecommission', function(e) {
                e.preventDefault(); // prevent page reload

                // get the current row
                var row = $(this).closest('tr');
                // find the input inside that row
                var commissionValue = row.find('.txtcommission').val();
                // get the id from data-id
                var id = $(this).data('id');
                // you can now send it by AJAX if needed
                 var url="{{ route('realestate.updatetempcommission') }}";
                $.post(url, {id: id, commission: commissionValue}, function(data){
                    //console.log(data)
                    alert('Commission Updated!');
                });

            });


            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                $('#submitedlist').css('display','none');
                $('#commissionlist').css('display','block');
                $('.btnsubmit').css('display','block');
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

        })
        $(document).on('keydown','.tdcanenter',function(e){
            if (e.keyCode == 13) {
                var $this = $(this),
                index = $this.closest('td').index();
                $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
                e.preventDefault();
            }
        })
        $(document).on('change','.txtcommission',function(e){
          e.preventDefault();
           calculateSum();
        })
        $(document).on('change','#ckidall',function(e){
          e.preventDefault();
           $('input[name="ckid"').not(this).prop('checked', this.checked);
           calculateSum();
        })
        // ✅ Also re-calculate when any individual checkbox changes
        $(document).on('change', 'input[name="ckid"]', function() {
            calculateSum();
        });
        // function calculateSum() {
        //     let sum = 0;
        //     $('input[name="ckid"]:checked').each(function() {
        //         // Find the row containing this checkbox
        //         let row = $(this).closest('tr');
        //         let value = parseFloat(row.find('td:eq(7) input').val().replace(/,/g, '')) || 0;
        //         sum += value;
        //     });

        //     // ✅ Show result (for example, in a div or input)
        //     $('#total_commission').text(sum.toLocaleString());
        // }
        function calculateSum() {
            let sum = 0;
            let groups = {};

            // 🩵 Step 1: Collect all group data (raw user inputs)
            $('input[name="ckid"]:checked').each(function() {
                //debugger;
                let row = $(this).closest('tr');
                let group = row.find('td:eq(1)').text().trim();
                let inputEl = row.find('td:eq(7) input');
                let amount = parseFloat(inputEl.val().replace(/,/g, '')) || 0;
                let comleftText = row.find('td:eq(10)').text().trim();
                let comleftNum = parseFloat(comleftText.replace(/[,R$B]/g, '')) || 0;

                if (!groups[group]) {
                    groups[group] = { sum: 0, limit: comleftNum, rows: [] };
                }

                groups[group].sum += amount;
                groups[group].rows.push({ row, inputEl, amount });
            });

            // 🩵 Step 2: Check limits and fix if needed
            $.each(groups, function(group, data) {
                if (data.sum > data.limit) {
                    alert(`Group ${group}: total (${data.sum}) exceeds limit (${data.limit})`);

                    // Reset inputs to default
                    data.rows.forEach(({ row, inputEl }) => {
                        let defaultVal = inputEl.data('default') || '0';
                        inputEl.val(defaultVal);
                        row.css('background-color', 'pink');
                    });

                    // Recalculate sum for this group after reset
                    let correctedSum = 0;
                    data.rows.forEach(({ inputEl }) => {
                        let v = parseFloat((inputEl.val() || '0').replace(/,/g, '')) || 0;
                        correctedSum += v;
                    });
                    data.sum = correctedSum;
                } else {
                    data.rows.forEach(({ row }) => row.css('background-color', ''));
                }

                // Add group total to global sum
                sum += data.sum;
            });

            // 🩵 Step 3: Show correct total
            $('#total_commission').text(sum.toLocaleString());
        }



         $(document).on('click','.btnpaidlist',function(e){
            e.preventDefault();
            getsubmitlist();
            $('#commissionlist').css('display','none');
            $('#submitedlist').css('display','block');
            $('.btnsubmit').css('display','none');

         })
        $(document).on('click','.btnclosepaidlist',function(e){
            e.preventDefault();

            $('#submitedlist').css('display','none');
            $('#commissionlist').css('display','block');
              $('.btnsubmit').css('display','block');

         })
         // this code when we sort by property column No not sort
        //  $(document).on('click', '#btnsortproperty', function (e) {
        //     e.preventDefault();

        //     const table = document.getElementById('tbl_commission_list');
        //     if (!table) return;

        //     const tbody = table.querySelector('tbody');
        //     if (!tbody) return;

        //     const rows = Array.from(tbody.querySelectorAll('tr'));

        //     // --- Natural Alphanumeric Sort Helper ---
        //     function parseCode(text) {
        //         if (!text) return { prefix: '', num: 0 };

        //         // clean all spaces and line breaks
        //         text = text.replace(/\s+/g, '').trim();

        //         // if multiple codes: A172,A173,A174 -> take smallest numeric
        //         const parts = text.split(',').map(t => t.trim()).filter(Boolean);

        //         // map each to {prefix, num}
        //         const mapped = parts.map(code => {
        //             const prefix = code.match(/^[A-Za-z]+/) ? code.match(/^[A-Za-z]+/)[0] : '';
        //             const num = parseInt(code.match(/\d+/)) || 0;
        //             return { prefix, num };
        //         });

        //         // sort inside cell to get smallest
        //         mapped.sort((a, b) => {
        //             if (a.prefix !== b.prefix)
        //                 return a.prefix.localeCompare(b.prefix);
        //             return a.num - b.num;
        //         });

        //         return mapped[0];
        //     }

        //     rows.sort((rowA, rowB) => {
        //         // ✅ Find the correct column (try by header text if you’re unsure)
        //         const valA = $(rowA).find('td').eq(2).text().trim(); // try 2 or 3 if your “A10” column is elsewhere
        //         const valB = $(rowB).find('td').eq(2).text().trim();

        //         const a = parseCode(valA);
        //         const b = parseCode(valB);

        //         if (a.prefix !== b.prefix)
        //             return a.prefix.localeCompare(b.prefix);

        //         return a.num - b.num;
        //     });

        //     // reinsert sorted rows
        //     rows.forEach(row => tbody.appendChild(row));
        // });//
        $(document).on('click', '#btnsortproperty', function (e) {
            e.preventDefault();
            const table = document.getElementById('tbl_commission_list');
            if (!table) return;

            const tbody = table.querySelector('tbody');
            if (!tbody) return;

            const rows = Array.from(tbody.querySelectorAll('tr'));

            // --- Helper to extract letter + smallest number ---
            function parseCode(text) {
                if (!text) return { prefix: '', num: 0 };

                text = text.replace(/\s+/g, '').trim();

                const parts = text.split(',').map(t => t.trim()).filter(Boolean);

                const mapped = parts.map(code => {
                    const prefix = code.match(/^[A-Za-z]+/) ? code.match(/^[A-Za-z]+/)[0] : '';
                    const num = parseInt(code.match(/\d+/)) || 0;
                    return { prefix, num };
                });

                mapped.sort((a, b) => {
                    if (a.prefix !== b.prefix)
                        return a.prefix.localeCompare(b.prefix);
                    return a.num - b.num;
                });

                return mapped[0];
            }

            // --- Sort rows by property code (A10, A11...) ---
            rows.sort((rowA, rowB) => {
                const valA = $(rowA).find('td').eq(2).text().trim(); // ✅ adjust column index if needed
                const valB = $(rowB).find('td').eq(2).text().trim();

                const a = parseCode(valA);
                const b = parseCode(valB);

                if (a.prefix !== b.prefix)
                    return a.prefix.localeCompare(b.prefix);

                return a.num - b.num;
            });

            // --- Reinsert sorted rows ---
            rows.forEach((row, index) => {
                // reset the "No" column (index 0)
                $(row).find('td').eq(0).text(index + 1);
                tbody.appendChild(row);
            });
        });

        $(document).on('click','.btnsubmit',function(e){
            e.preventDefault();
            let selbank = $('#selbank').val();
            let selbanktext = $('#selbank option:selected').text();
            let dd = $('#dd').val();
            let d1 = $('#d1').val();
            let d2 = $('#d2').val();
            let saler=$('#selsaler option:selected').text();
            let totalcom=$('#total_commission').text();

            // ✅ Works on both old and new VirtualSelect versions
            let selblockEl = document.querySelector('#selblock');
            // Get values
            let selblockValues = selblockEl.value; // array of selected values
            // Get texts
            let selblockTexts = [];
            if (selblock.getSelectedOptions) {
                selblockTexts = selblock.getSelectedOptions().map(o => o.label);
            } else {
            // fallback if function not available
                selblockTexts = Array.from(selblock.selectedOptions || []).map(o => o.text);
            }
            let selblockTextStr = selblockTexts.join(', ');
            //  $("table tbody").find('input[name="ckid"]').each(function(){
            //       if($(this).is(":checked")){
            //           data.push($(this).val());
            //         }
            //   });
            // Loop through all checked ckid checkboxes
            var items=[];
            var founderr=0;
            // $('table tbody input[name="ckid"]:checked').each(function() {
            //     let row = $(this).closest('tr');
            //     // Get ID from checkbox value
            //     let id = $(this).val();
            //     // Get value from column 7 input (td:eq(4))
            //     let amount = row.find('td:eq(7) input').val() || '';
            //     let comleft=row.find('td:eq(10)').text();
            //     // Optional: clean or convert to number
            //     amount = amount.replace(/,/g, '');
            //     // Push to array as an object
            //     items.push({
            //         id: id,
            //         amount: amount,
            //     });
            // });

            $('table tbody input[name="ckid"]:checked').each(function() {
                let row = $(this).closest('tr');
                let id = $(this).val();

                // get and clean amount
                let amount = row.find('td:eq(7) input').val() || '';
                amount = amount.replace(/,/g, '').trim(); // remove commas
                let amountNum = parseFloat(amount) || 0;  // convert to number

                // get and clean comleft
                let comleft = row.find('td:eq(10)').text().trim(); // e.g. "1,000$" or "2,000,000R"
                comleft = comleft.replace(/[,R$B]/g, ''); // remove commas and currency symbols
                let comleftNum = parseFloat(comleft) || 0;

                // 🔥 Compare
                if (amountNum > comleftNum) {
                    founderr=1;
                    alert(`❌ ID ${id}: amount (${amountNum}) is greater than comleft (${comleftNum})`);
                    return false;//exit for loop
                }

                items.push({
                    id: id,
                    amount: amountNum,
                });
            });

            if(founderr==1){
                //alert('submit commission not allow');
                return false;
            }

            // ✅ Build the final payload
            let payload = {
                selbank: selbank,
                selbanktext: selbanktext,
                dd: dd,
                d1:d1,
                d2:d2,
                saler:saler,
                selblock:selblockTextStr,
                totalcom:totalcom,
                items: items
            };
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Paid Commission All!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('realestate.paidcommissionlistall') }}",
                            data: payload,
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    getcomissionlist();
                                    Swal.fire(
                                        'Paid!',
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
                                    'Submit Error.',
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
                        url: "{{ route('realestate.deletepaidcommissionall') }}",
                        data: { id:id},
                        success: function (data) {
                            console.log(data);
                            if (data.success === true) {
                                getsubmitlist();

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
            //var block=$('#selblock').val();
            var pid=$('#sel_property').val();
            var seldata=$('#sel_data').val();
            var alldate = document.getElementById("ckalldate").checked;
            var selgroup=$('#selblock').val();
            if(selgroup.includes('all')){
                selgroup="all";
            }

            var url="{{ route('realestate.getcommissionlistall') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {alldate:alldate,d1:d1,d2:d2,location_id:location_id,saler:saler,selgroup:selgroup,pid:pid,seldata:seldata},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#commissionlist').empty().html(data);
                    $('body').removeClass("wait");
                    refreshtableFixHead(220);
                    $('.txtcommission').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralPositiveOnly: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
         function getsubmitlist()
        {
            $('body').addClass("wait");

            var d1=$('#d1').val();
            var d2=$('#d2').val();


            var url="{{ route('realestate.getpaidcommission') }}";
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2},

                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#submitedlist').empty().html(data);
                    $('body').removeClass("wait");


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
