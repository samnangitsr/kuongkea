@extends('master')
@section('title')តារាងបង់ប្រាក់ @endsection
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
                        <option value="SALER" @if($customertype=='SALER') selected @endif>អ្នកលក់</option>
                    </select>
                </td>
                <td style="padding:0px;">
                    <select name="selpartner" id="selpartner" class="kh16-b" style="height:30px;width:250px;">
                        <option value=""></option>
                         @foreach ($partners->whereIn('customertype',['BUYER','SALER']) as $p)
                             <option value="{{ $p->id }}" @if($cid==$p->id) selected @endif>{{ $p->name }}</option>
                         @endforeach
                     </select>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>លេខបង្កាន់ដៃ<span id="invid" class="badge bg-secondary" title="0">{{ $invid }}</span></p>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>រយះពេល<span id="term" title="{{ $sendername }}" class="badge bg-secondary">{{ $term }} ខែ</span></p>
                </td>
                <td class="kh16-b">
                    <p>ការប្រាក់<span id="rate" class="badge bg-secondary">{{ $rate . ' % /m'}} </span></p>
                </td>
                <td style="padding:0px 5px 0px 5px;" class="kh16-b">
                    <p>គិតពី<span id="startdate" class="badge bg-secondary">{{ date('d-m-Y',strtotime($startdate)) }}</span></p>
                </td>
                <td class="kh16-b">
                    <p>ដល់<span id="enddate" class="badge bg-secondary">{{ date('d-m-Y',strtotime($enddate)) }}</span></p>
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
                            <tr class="row_inv @if($invid==$i->id) clickedrow @endif">
                                <td class="kh14-b">
                                    {{ $i->id }}

                                </td>
                                <td class="kh14-b">{{ date('d-m-Y',strtotime($i->dd))}}
                                    <br>
                                    <a href="#" data-id="{{ $i->id }}" data-cid="{{ $i->parrent_id }}" data-customertype="{{ $i->partner->customertype }}" data-term="{{ $i->term }}" data-rate="{{ $i->interest_rate }}" data-startdate="{{ $i->startdate }}" data-enddate="{{ $i->enddate }}" data-curid="{{ $i->currency_id }}" data-cursk="{{ $i->currency->sk }}" data-curname="{{ $i->currency->shortcut }}" data-payinmonth="{{ $i->payinmonth }}" data-sendername="{{ $i->sendername }}" class="mybtn kh16-b btnrefresh">Refresh</a>
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
                <table id="mytable" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                    <thead style="text-align:center;" class="kh16">
                        <th style="width:70px;">No</th>
                        <th style="width:100px;">លេខវិក័យបត្រ</th>
                        <th style="width:100px;">បង់សំរាប់ខែ</th>
                        <th style="width:250px;">ប្រតិបត្តិការណ៏</th>
                        <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                        <th style="width:150px;">សមតុល្យ</th>
                        <th style="width:150px;">អ្នកកត់ត្រា</th>
                        <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                        <th style="width:100px;">ម៉ោង</th>
                        @if(Auth::user()->role->name=='Admin')
                            <th  style="width:50px;">សក</th>
                        @endif
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
                                <td style="text-align:center;padding:3px 0px;" class="kh14-b">
                                    @if($tr['action']=='d')
                                    <div class="dropdown">
                                        <button style="width:70px;color:red;background-color:yellow;border-style:none;" type="button" class="mybtn dropdown-toggle kh14-b" data-bs-toggle="dropdown">{{ ++$k }}</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i> លុបចោល</a></li>
                                            <li><a class="dropdown-item kh16-b btnreprint" style="" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-print"></i> ព្រីនឡើងវិញ</a></li>

                                        </ul>
                                    </div>
                                    @else
                                        {{ ++$k }}
                                    @endif
                                </td>
                                <td class="kh16">
                                    <a href="#inv{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" class="kh14-b" style="text-decoration:underline;" data-bs-toggle="collapse" >{{ sprintf("%04d",$tr['id']) }}</a>
                                </td>

                                <td class="kh16">
                                    {{ date('d-m-Y',strtotime($tr['payformonth']??$tr['trandate'])) }}
                                </td>

                                <td class="kh16">{{ $tr['tranname'] }} {{ $tr['trancode']<>-8?$tr['sendername']:'' }}</td>

                                <td class="kh16-b" style="text-align:right;@if($tr['amount']>0) color:blue; @else color:red; @endif">{{ $tr['amount']>0?'+':'' }} {{ phpformatnumber($tr['amount']) .$tr['currency'] }}</td>

                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($balance) .$tr['currency'] }}</td>
                                <td class="kh16">
                                    {{ $tr['usersave'] }}
                                </td>
                                <td class="kh16">
                                    {{ $tr['trandate']? date('d-m-Y',strtotime($tr['trandate'])):'' }}
                                </td>
                                <td class="kh16">
                                    {{ $tr['tt'] }}
                                </td>
                                @if(Auth::user()->role->name=='Admin')
                                    @if(str_contains($tr['main_action'],'d') && $tr['trancode']<>8 && $tr['trancode']<>-8)
                                        <td style="text-align:center;">
                                            <a class="kh16-b btndel" style="color:red;" href="#" data-payonid="{{ $tr['payonid'] }}" data-id="{{ $tr['id'] }}" data-groupid="{{ $tr['groupid'] }}" ><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                @endif
                            </tr>
                            <tr id="inv{{ $tr['id'] }}" class="collapse borderset2" style="">
                                <td colspan=8 style="">
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
                                                        <td style="width:90px;">Date</td>
                                                        <td style="width:80px;">Time</td>
                                                        <td style="width:100px;">ប្រតិបត្តិការណ៏</td>
                                                        <td style="width:150px;">ដៃគូ</td>
                                                        <td style="width:120px;">ចំនួនទឹកប្រាក់</td>
                                                        <td style="width:80px;">សេវ៉ាដៃគូ</td>
                                                        <td style="width:100px;">អ្នកកត់ត្រា</td>
                                                        <td style="">ផ្សេងៗ</td>
                                                    </tr>
                                                @endif
                                                <tr class="kh12-b" style="">
                                                    <td style="text-align:center;">{{ $item->id }}
                                                         @if(Auth::user()->role->name=='Admin')
                                                            @if($item->trancode==1 || $item->trancode==4)
                                                                @if($i==1)
                                                                    <br>
                                                                    <a href="" class="mybtn btnaddcommission" data-id="{{$item->id}}" data-group_id="{{$item->ref_group_id}}" style="color:purple;border-style:none;">Fix Comm</a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                                    <td>{{ $item->tt }}</td>
                                                    <td>{{ $item->tranname }}</td>
                                                    <td>{{ $item->partner->name }}</td>
                                                    <td style="text-align:right;">{{ phpformatnumber($item->amount) . ' ' . $item->currency->sk }}</td>
                                                    <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->sk }}</td>
                                                    <td>{{ $item->user->name }}</td>
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

@endsection
@section('script')
<script type="text/javascript">
     $('#h1_title').text('តារាងបង់ប្រាក់');
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
        $(document).on('click', '.btnaddcommission', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var group_id = $(this).data('group_id');
            var url = "{{ route('realestate.addcommission') }}";

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

        $(document).on('click','.btnreprint',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var groupid=$(this).data('groupid');

            printdeposit(id,groupid,'បង្កាន់ដៃកក់ប្រាក់(ព្រីនឡើងវិញ)','');
        })
      function printdeposit(id,groupid,rpttitle,propertyname){
          var redirectWindow = window.open('{{ url('/') }}'+'/realestate/depositprint?id='+id+'&groupid='+groupid+'&rpttitle='+rpttitle+'&propertyname='+propertyname , '_blank');
          redirectWindow.location;
        }
        $(document).on('click','.btndel',function(e){
            e.preventDefault();
            var rowind=$('#invid').attr('title');
            var id=$(this).data('id');

            var payonid=$(this).data('payonid')
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
                        type: 'POST',
                        dataType:'JSON',
                        contentType: 'application/json;charset=utf-8',
                        url: "{{ route('realestate.deletepayment') }}",
                        data: { id:id,groupid:groupid },
                        success: function (data) {
                            //console.log(data);
                            if (data.success === true) {
                                //$('#selpartner').trigger('change');
                                searchdeposit(rowind,$('#selcustype').val());
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
        $(document).on('change','#selpartner',function(e){
            e.preventDefault();
            var cid=$(this).val();
            var customertype=$('#selcustype').val();
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
                            <tr class="row_inv">
                                <td class="kh14-b">
                                    ${data['saleinv'][i].id} <br>
                                </td>
                                <td class="kh14-b">${moment(data['saleinv'][i].dd).format("DD-MM-YYYY") }
                                     <br>
                                    <a href="#" data-id="${data['saleinv'][i].id}" class="mybtn kh16-b btnrefresh">Refresh</a>
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

        })
        $(document).on('click','.row_inv',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            searchdeposit(rowind,$('#selcustype').val());
        })
        $(document).on('click','.btnrefresh',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
            searchdeposit(rowind,$('#selcustype').val());
        })

        function searchdeposit(rowind,custype)
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
            $('#invid').text(id);
            $('#invid').attr('title',rowind);
            $('#term').text(term + ' ខែ');
            $('#term').attr('title',sendername);
            $('#rate').text(rate + ' % /m');
            $('#startdate').text(moment(startdate).format("DD-MM-YYYY"));
            $('#enddate').text(moment(enddate).format("DD-MM-YYYY"));
            var url="{{ route('realestate.searchdeposit') }}";
            $('body').addClass("wait");
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {id:id,cid:cid,customertype:custype},

                complete: function () {},
                success: function (data) {
                    console.log(data)

                    $('#body_transaction').empty().html(data);
                    $('body').removeClass("wait");
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })
        }
    })

</script>
@endsection
