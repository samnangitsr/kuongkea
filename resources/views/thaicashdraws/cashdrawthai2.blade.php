@extends('master')
@section('title') Thai Cashdraw3 @endsection
@section('css')
    <style type="text/css">
      body.wait *{
        cursor: wait !important;
    }
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
	#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:white}
		/* Each result */
	#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
	#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;}

      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            background-color:aquamarine;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
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
        td{
            padding:0px;
        }
        tr.borderset1{
            border-top:2px solid gray;border-left:2px solid gray;border-right:2px solid gray;
        }
        tr.borderset2{
            border-bottom:2px solid gray;border-left:2px solid gray;border-right:2px solid gray;
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
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:white }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    #tblsearchmore td{
        border-style:none;
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
       #tbl_notyetcashdraw{
        table-layout:fixed;
       }
       #tbl_notyetcashdraw td,th{
        padding:5px;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color:yellowgreen;
       }
       #tbl_cashdraw .clickedrow td{
        background-color:yellowgreen;
       }
       #tbl_notyetcashdraw .clickedrow td{
        background-color:yellowgreen;
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color:yellowgreen;
       }
       #tblclearclick .clickedrow td{
        background-color:yellowgreen;
       }
       .tbl_sub td{
            padding:0px 5px 0px 5px;
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
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16-b">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>


                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:200px;">
                        <div class="input-group" style="width:200px;">
                            <input type="text" name="d1" id="d1" class="form-control" style="width:140px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:200px;">
                        <div class="input-group" style="width:200px;">
                            <input type="text" name="d2" id="d2" class="form-control" style="width:140px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>


                <td style="padding:0px;border-style:none;">
                    @if (Auth::user()->role->name<>'Admin')
                        @if (App\User::checkpermission(Auth::id(),'4.3.1'))
                            <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search by Date</button>
                        @endif
                    @else
                        <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search by Date</button>
                        <button class="btn btn-primary btn-md kh16-b" id="btnclearclick" style="">Clear User Action</button>
                        <button class="btn btn-primary btn-md kh16-b" id="btnclearinterval" style="">Stop Timer</button>
                    @endif

                </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="tableFixHead" id="cashdrawandnotyet" style="padding:0px;margin:0px;">
        <div class="row" style="margin:10px 5px 5px 5px;">
            <h1 id="table_title" style="color:red;margin-left:-10px;" class="kh22-b">តារាងទិន្ន័យ</h1>
            <table id="tbl_notyetcashdraw" class="kh12-b" style="">
                <thead class="" style="padding:5px;">
                    <th style="width:50px;background-color:aquamarine">លរ</th>
                    <th style=" width:100px;background-color:aquamarine">ID</th>
                    <th style="width:100px;background-color:aquamarine">អ្នកកត់ត្រា</th>
                    <th style="width:80px;background-color:aquamarine">ថ្ងៃកត់ត្រា</th>
                    <th style="width:70px;background-color:aquamarine">ម៉ោង</th>
                    <th style="width:150px;background-color:aquamarine">ចំនួនទឹកប្រាក់</th>
                    <th style="width:60px;background-color:aquamarine">ជំហាន</th>
                    <th style="width:80px;background-color:aquamarine">ថ្ងៃប្រតិបត្តិ</th>
                    <th style="width:150px;background-color:aquamarine">ផ្សេងៗ</th>
                    <th style="background-color:aquamarine;text-align:center;">Action</th>
                </thead>

                <tbody id="bodytransfer">
                    @foreach ($data as $key => $d)
                            <tr class="rowclick kh12-b borderset1" style="background-color:lightgrey;">
                                <td class="kh12-b" style="padding:5px;width:60px;">{{ ++$key }}</td>
                                <td class="kh12-b"  style="padding:5px;width:100px;">
                                    <a href="#c{{ $d->id }}" class="kh12-b" style="text-decoration:underline;" data-bs-toggle="collapse">{{ $d->id }}</a>
                                </td>
                                <td class="kh12-b" style="">{{ $d->user->name }}</td>
                                <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->opdate))}}</td>
                                <td class="kh12-b"  style="">{{ $d->optime }}</td>
                                <td class="kh12-b" style="padding:5px;">{{ phpformatnumber($d->amount) . ' ' . $d->currency->shortcut }}</td>
                                <td class="kh12-b" style="">{{ $d->step }}</td>
                                <td class="kh12-b" style="">{{ date('d-m-Y',strtotime($d->updated_at))}}</td>

                                <td  style="">{{ $d->note }}</td>
                                <td style="text-align:right;">
                                    @if($d->step==3)
                                        <a href="#" class="btncontinue2 kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">Goto Step2 |</a>
                                        <a href="#" class="btnopencashdraw kh12-b" data-id="{{ $d->id }}" data-smsid="{{ $d->sms_id }}" data-groupid="{{ $d->group_id }}">{{ App\Models\SmsProcess::checkselect2($d->id)==true?'កំពុងធ្វើលេខកូត...':'ធ្វើលេខកូត' }}</a>
                                    @endif
                                </td>
                            </tr>

                                <tr id="c{{ $d->id }}" class="collapse show borderset2" style="">
                                    <td colspan=10 style="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered tbl_sub kh12-b" style="margin:0px;">
                                                <tr style="font-weight:bold;text-align:center;">
                                                    <td style="width:80px;">ID</td>
                                                    <td style="width:80px;">Date</td>
                                                    <td style="width:200px;">ដៃគូ</td>
                                                    <td style="width:150px;">ចំនួនទឹកប្រាក់</td>
                                                    <td style="width:120px;">សេវ៉ាដៃគូ</td>
                                                    <td style="width:150px;">លេខអ្នកទទួល</td>
                                                    <td style="width:150px;">ឈ្មោះអ្នកទទួល</td>
                                                    <td style="width:150px;">ប្តូរជាលុយ</td>
                                                    <td style="width:100px;">អត្រា</td>
                                                    <td> CODE</td>

                                                </tr>
                                                <tbody>
                                                    @foreach (App\Models\SmsProcess::gettransfer($d->id) as $item)
                                                    <tr class="kh12-b">
                                                        <td style="text-align:center;">{{ $item->id }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->dd))}}</td>
                                                        <td>{{ $item->partner->name }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->thai_amt) . ' THB' }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->fee) . ' ' . $item->feecurrency->shortcut }}</td>
                                                        <td>{{ $item->rectel }}</td>
                                                        <td>{{ $item->recname }}</td>
                                                        <td style="text-align:right;">{{ $item->th_rate?phpformatnumber($item->amount) . ' ' . $item->currency->shortcut:'' }}</td>
                                                        <td style="text-align:right;">{{ $item->th_rate }}</td>
                                                        <td>{{ str_replace('<br>',' ',$item->moneycode) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </td>

                                </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
    @include('thaicashdraws.cashdrawmodal2')
    @include('moneytransfers.clearuseractionmodal')
    @include('thaicashdraws.dowingcodemodal')
    @include('thaicashdraws.cashdrawcodemodal')
@endsection
@section('script')
{{-- @include('moneytransfers.exchangescript'); --}}
    <script type="text/javascript">
        $('#h1_title').text('ផ្នែកធ្វើលេខកូត');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-240;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-330;

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
              '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
            '</div>'
          );
          return $option;
        }
        function formatOption1(option) {
				if (!option.id) {
					return option.text;
				}
				// Use a <div> to display the main text and a second line
         // option.element.value is get value from select

				var $option = $(
					'<div class="select2-option1">' +
						'<div class="select2-option-main">' + option.text + '</div>' +
						'<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
					'</div>'
				);
				return $option;
			}
        $(document).ready(function () {
            getreceivetel();
            var countsmsrefresh=0;
            function refreshpage()
            {
                var url="{{ route('thaicashdraw.countsmsrefresh') }}";
                $.get(url,{step:3},function(data){
                    //console.log(data)
                    if(countsmsrefresh!=data['countrow']){
                        countsmsrefresh=data['countrow'];
                        search_cashdraw(moresearch);
                    }
                })
            }
            starttimer();
            function starttimer()
            {
             myInterval =setInterval(refreshpage, 1000);
            }
            $(document).on('click','#btnclearinterval',function(e){
            e.preventDefault();
            var textbtn=$(this).text();
            if(textbtn=='Stop Timer'){
                clearInterval(myInterval);
                $(this).text('Start Time');
            }else{
                starttimer();
                $(this).text('Stop Timer');
            }
        })



            $('#selcustomer').select2({templateResult: formatOption});
            $('#seluser').select2();
            $("#selpartner_continue_2").select2({
                dropdownParent: $("#cashdrawcontinuemodal"),
                templateResult: formatOption
            });
            $('#selpartner').select2({templateResult: formatOption});
            $("#selpartner_continue").select2({
              dropdownParent: $("#cashdrawmodal"),
              templateResult: formatOption
            });

            var today=new Date();
                $('#d1,#d2,#opdate,#invdate,#opdates,#datecontinue').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,

                });
                $('#opdate').datetimepicker("destroy");
                $('#invdate').datetimepicker("destroy");
                $('#datecontinue').datetimepicker("destroy");



            $(document).on('dblclick', '.tblnotyetcashdrawrowclick', function(event) {

                var ind=$(this).index();
                var row=$(this).closest('tr');
                id=row.find("td:eq(1)").text();
                opencashdraw(id);

        });
        $(document).on('keydown','.tdcanenter',function(e){
        if (e.keyCode == 13) {
            var $this = $(this),
            index = $this.closest('td').index();
            $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
            e.preventDefault();
          }
      })
        $(document).on('change','#selsearchby',function(e){
            e.preventDefault();
            var searchby=$(this).val();
            if(searchby=='tel'){
                $('#col2').css('display','block');
                $('#col3').css('display','none');
                $('#col4').css('display','none');
                $('#col1').css('display','none');
            }else if(searchby=='amt'){
                $('#col2').css('display','none');
                $('#col3').css('display','block');
                $('#col4').css('display','block');
                 $('#col1').css('display','none');
            }else if(searchby=='time'){
                $('#col2').css('display','none');
                $('#col3').css('display','none');
                $('#col4').css('display','none');
                $('#col1').css('display','block');
            }
        })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            moresearch=0;
            search_cashdraw(0);
        })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
           var searchby=$('#selsearchby').val();
           if(searchby=='tel'){
               var lennum=$('#txtsearchbytel').attr('title');
               var tellen = $('#txtsearchbytel').val().replace(/ /g, '');
               if(lennum>tellen.length){
                    alert('please input phone number')
                    $('#txtsearchbytel').focus();
                    return;
                }
           }
            moresearch=1;
            search_cashdraw(1);
        })
        $(document).on('change','#selcustomer,#seluser',function(e){
            e.preventDefault()
            moresearch=0;
            search_cashdraw(0);
        })
        var moresearch=0;
        function search_cashdraw(searchmore)
        {

            var d1=$('#d1').val();
            var d2=$('#d2').val();
            //var user=$('#seluser').val();
            var url="{{ route('thaicashdraw2.searchcashdraw2') }}";
            $.get(url,{d1:d1,d2:d2},function(data){
                //console.log(data);
                $('#cashdrawandnotyet').empty().html(data);
            })
        }
        function getcurrencybykeylocalstorage(key,el)
        {
            var currencylist;
            if(localStorage.getItem("currencylist")==null){
            currencylist=[];
            }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
            }
            currencylist.forEach(function(c){
            //debugger;
            if(c.skey==key){
                //$(el).val(c.shortcut);
                $(el).val(c.id);

            }
            })
        }
        $(document).on('keydown','#txtsearchbyamt1,#txtsearchbytel,#txtsearchbyamt2',function(e){

            if(e.keyCode==13){
                //debugger;
                var el=$(this).attr('id');
                var lennum=$('#txtsearchbytel').attr('title');
                //alert(lennum)
                var tellen = $('#txtsearchbytel').val().replace(/ /g, '');
                //alert(tellen.length)
                if(el=='txtsearchbytel'){
                    if(lennum>tellen.length){
                        return;
                    }
                }else if(el=='txtsearchbyamt1'){
                    var amt2=$('#txtsearchbyamt2').val();
                    var amt1=$('#txtsearchbyamt1').val();
                    if(amt2==''){
                        $('#txtsearchbyamt2').val(amt1)
                    }
                    $('#txtsearchbyamt2').focus();
                }
                moresearch=1;
                search_cashdraw(1);
            }
        })
        $(document).on('click','.btndelcashdraw',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var cashdraw_id=$(this).data('cashdraw_id');
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
                            url: "{{ route('cashdraw.delete') }}",
                            data: { id:id,cashdraw_id:cashdraw_id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    del_userselectcashdraw(id);
                                    search_cashdraw(moresearch);
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
            $(document).on('click','.btndelcashdrawbankcontinue',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var fromid=$(this).data('fromid');
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
                            url: "{{ route('cashdraw.deletebankcontinue') }}",
                            data: { id:id,fromid:fromid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    del_userselectcashdraw(id);
                                    search_cashdraw(moresearch);
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
        //cash draw part
        $(document).on('click','#tbl_cashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_notyetcashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_bankcashdraw td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tblclearclick td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
        var closemodalfrom='';
        $("#cashdrawmodal").on("hidden.bs.modal", function () {
            if(closemodalfrom!=='saved'){
                var transfer_id=$('#transfer_id').val();
                del_userselectcashdraw(transfer_id);
            }
        });
        function del_userselectcashdraw(transfer_id){
            var url="{{ route('thaicashdraw1.delcashdrawaction1') }}";
            $.post(url,{id:transfer_id},function(data){})
        }
        function checkright()
        {
            //$('#seluser').val($('#txtuserid').val());
            var role=$('#txtrole').val();
            if(role!='Admin'){
                //$('#showdate').datetimepicker("destroy");
                $('#opdate').datetimepicker("destroy");
                //$('#seluser_record').attr('disabled',true);

            }
        }

       $(document).on('click','#btnclearclick',function(e){
            e.preventDefault();
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            $('#clearactionmodal').modal('show');
            var url="{{ route('thaicashdraw1.clearclick1') }}";
            var output='';
            var k=0;
            $.get(url,{d1:d1,d2:d2},function(data){
                console.log(data);
                for(var i=0;i<data['useractions'].length;i++){
                    k+=1;
                    output +=`
                        <tr>
                            <td class="no1">${k}</td>
                            <td>${data['useractions'][i].sms_process_id}</td>
                            <td>${data['useractions'][i].smsprocess.opdate}</td>
                            <td>${formatNumber(Math.abs(data['useractions'][i].smsprocess.amount))} THB</td>
                            <td>${data['useractions'][i].user.name}</td>
                            <td>${moment(data['useractions'][i].created_at).format("DD-MM-YYYY")}</td>
                            <td style="text-align:right;"> <a href="#" class="btn btn-danger btndelactionuser" data-id="${ data['useractions'][i].id }" data-smsprocessid="${ data['useractions'][i].sms_process_id }">Remove</a></td>
                        </tr>
                    `
                }
                $('#tblclearclick').empty().html(output);
            })
       })
       $(document).on('click','.btnclearselect',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            var rowind = $(this).closest('tr').index();

            var url="{{ route('thaideleteuseraction1') }}";
            $.get(url,{id:id},function(data){
               $('.btnopencashdraw').eq(rowind).text('ធ្វើលេខកូត');
               $('.btncontinue2').eq(rowind).css('display','inline');
               $('.btnclearselect').eq(rowind).css('display','none');
            })
       })
       $(document).on('click','.btndelactionuser',function(e){
            e.preventDefault()
            var id=$(this).data('smsprocessid');
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            var url="{{ route('thaideleteuseraction1') }}";
            $.get(url,{id:id},function(data){
                document.getElementById("tableclearclick").deleteRow(rowind);
                ResetNo1();
            })
       })
       function ResetNo1(){
            $('.no1').each(function(i,e){
                $(this).text(i+1);
            })
        }
       function ResetNo(){
            $('.no').each(function(i,e){
                $(this).text(i+1);
            })
        }
        $(document).on('keyup','.bankrate',function(e){
            var rowind = $(this).closest('tr').index();
            if(isNumber(e.key)){
              calcuexchange(rowind);
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {
              calcuexchange(rowind);
              return;
          }
        })
        $(document).on('keyup','.bankamt',function(e){
            //debugger;
          var rowind = $(this).closest('tr').index();
          const C = e.key;
          if(isNumber(e.key)){
              calcuexchange(rowind);
              return;
          }
          if (C === "Backspace"){
            calcuexchange(rowind);
            return;
          }

          if(isNumber(C)==false){
            if(C==="Enter"){

            }else{
                //getcurrencybykey1(C,$('.bankcur').eq(rowind));
            }
          }
      })
      $(document).on('click','#btnbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','block');
          $('#hasbankpayment').val(1);
          var table = document.getElementById("tbl_bankpayment");
          var tbodyRowCount = table.tBodies[0].rows.length;
          if(tbodyRowCount==0){
            addrow();

          }
      })
      $(document).on('click','#btnaddrow',function(e){
          e.preventDefault();
          addrow();
      })
      $(document).on('click','.remove',function(e){
          e.preventDefault();
          //$(this).parent().parent().remove();
          $(this).closest("tr").remove();
          ResetNo();
      });
      $(document).on('click','.btndowingcode',function(e){
        e.preventDefault();
          //debugger;
          var rowind = $(this).closest('tr').index();
          //var foruserdo=$(this).data('foruserdo').toString().split(',');
          var userconnect=$('.userconnect').eq(rowind).val().toString().split(',');
          var usercheckid=$('#usercheckid').val();
          var bankname=$('.bankname').eq(rowind).val();
          if(!userconnect.includes(usercheckid)){
            alert(bankname + ' is not for you.')
            return;
          }
          var docodeby=$(this).data('docodeby');
          if(docodeby!='' && docodeby!=null){
            alert('this transaction already do code.');
            return;
          }
          $('#tblcodelist').find('tbody').empty();

          $('#dowingcodemodal').modal('show');
          var maxtransfer=$(this).data('maxtransfer');
          var maxfee=$(this).data('maxfee');
          var agenttype=$(this).data('agenttype');

          var amt1=$('.bankamt').eq(rowind).val();
          var cur1=$('.bankcur option:selected').eq(rowind).text();
          var amt2=$('.bankamtexchange').eq(rowind).val();
          var cur2=$('.bankcursale').eq(rowind).val();

          if(amt2!==''){
            $('#wingamount').val(amt2);
            $('#wingcur').val(cur2);
          }else{
              $('#wingamount').val(amt1);
              $('#wingcur').val(cur1);
          }
          $('#wingmaxamt').val(maxtransfer);
          $('#wingmaxfee').val(maxfee);
          $('#agenttype').val(agenttype);
          $('#rowind').val(rowind);
          $('#btngeneratecode').click();
      });
      $(document).on('click','#btngeneratecode',function(e){
        e.preventDefault();
        //debugger;
        $('#tblcodelist').find('tbody').empty();
        var agenttype=$('#agenttype').val();
        var maxamtstr=$('#wingmaxamt').val().replace(/,/g,'');
        var maxfeestr=$('#wingmaxfee').val().replace(/,/g,'');

        var maxamtby=maxamtstr.split('/');
        var maxfeeby=maxfeestr.split('/');

        var maxamt=maxamtby[0];
        var maxfee=maxfeeby[0];
        var cur="USD";
        if($('#wingcur').val()=='KHR'){
            maxamt=maxamtby[1];
            maxfee=maxfeeby[1];
            cur="KHR";
        }
        if($('#wingcur').val()=='THB'){
            maxamt=maxamtby[2];
            maxfee=maxfeeby[2];
            cur="THB";
        }
        var amount=$('#wingamount').val().replace(/,/g, '');
        var wingcur=$('#wingcur').val();
        var result=Math.floor(amount / maxamt);
        var somnal=amount % maxamt;
        if(maxamt==0 || maxamt===undefined || maxamt===null){
            //alert('we can not generate code with transfer max amount zero.')
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" style="text-align:right;" value="${formatNumber(amount)}"></td>
                    <td class="kh22">${wingcur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" style="text-align:right;" value="0"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" value="${formatNumber(maxamt)}"></td>
                    <td class="kh22">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" value="${formatNumber(maxfee)}"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
        }
        if(somnal!==0){
            var url="{{ route('thaicashdraw.getwingfee') }}";
            $.get(url,{agenttype:agenttype,amount:somnal,cur:cur},function(data){
                console.log(data)
                var data=`
                    <tr class="item">
                        <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt kh22 tdcanenter" value="${formatNumber(somnal.toFixed(2))}"></td>
                        <td class="kh22">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingcode kh22 tdcanenter"></td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingfee kh22 tdcanenter" value="${formatNumber(data['wingfee'].cashdraw_rate)}"></td>
                    </tr>
                `;
                $('#tblcodelist').find('tbody').append(data);
            })
        }

      })
      $(document).on('click','#btncashdrawcode',function(e){
        e.preventDefault();
        //debugger;
        $('body').addClass("wait");
        var totalfee=0;
        for(i=0; i<$('.txtwingfee_out').length; i++) {
            fee = $('.txtwingfee_out').eq(i).val().replace(/,/g,'');
            totalfee += parseFloat(fee);
        }
        var formdata=new FormData();
        formdata.append('wingamount_out',$('#wingamount_out').val());
        formdata.append('wingcurid_out',$('#wingcurid_out').val());
        formdata.append('wingfee_out',totalfee);
        formdata.append('customerid_out',$('#customerid_out').val());
        formdata.append('customername_out',$('#customername_out').val());
        formdata.append('tranid',$('#tid0_out').val());
        formdata.append('thaiamt',$('#thaiamt_out').val());


        var url="{{ route('thaicashdraw.savecashdrawwingcode') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#cashdrawcodemodal').modal('hide');
                        $('#cashdrawmodal').modal('hide');
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
      $(document).on('click','#btngeneratecode_out',function(e){
        e.preventDefault();
        //debugger;
        $('#tblcashdrawcodelist').find('tbody').empty();
        var agenttype=$('#agenttype_out').val();
        var maxamtstr=$('#wingmaxamt_out').val().replace(/,/g,'');
        var maxfeestr=$('#wingmaxfee_out').val().replace(/,/g,'');

        var maxamtby=maxamtstr.split('/');
        var maxfeeby=maxfeestr.split('/');

        var maxamt=maxamtby[0];
        var maxfee=maxfeeby[0];
        var cur="USD";
        if($('#wingcur_out').val()=='KHR'){
            maxamt=maxamtby[1];
            maxfee=maxfeeby[1];
            cur="KHR";
        }
        if($('#wingcur_out').val()=='THB'){
            maxamt=maxamtby[2];
            maxfee=maxfeeby[2];
            cur="THB";
        }
        var amount=$('#wingamount_out').val().replace(/,/g, '');
        var wingcur=$('#wingcur_out').val();
        var result=Math.floor(amount / maxamt);
        var somnal=amount % maxamt;
        if(maxamt==0 || maxamt===undefined || maxamt===null){
            //alert('we can not generate code with transfer max amount zero.')
            var data=`
                <tr class="item_out">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(amount)}"></td>
                    <td class="kh22">${wingcur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="0"></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item_out">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" value="${formatNumber(maxamt)}"></td>
                    <td class="kh22">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" value="${formatNumber(maxfee)}"></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
        }
        if(somnal!==0){
            var url="{{ route('thaicashdraw.getwingfee') }}";
            $.get(url,{agenttype:agenttype,amount:somnal,cur:cur},function(data){
                console.log(data)
                var data=`
                    <tr class="item_out">
                        <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" value="${formatNumber(somnal.toFixed(2))}"></td>
                        <td class="kh22">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter"></td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" value="${formatNumber(data['wingfee'].cashdraw_rate)}"></td>
                    </tr>
                `;
                $('#tblcashdrawcodelist').find('tbody').append(data);
            })
        }

      })
      $(document).on('click','.btncashoutcode',function(e){
          e.preventDefault();
          //debugger;
          var hascashdrawcode=$(this).data('hascashdrawcode');
          if(hascashdrawcode>0){
            alert('already cashdraw code')
            return;
          }
          var rowind = $(this).closest('tr').index();
          var userconnect=$('.userconnect').eq(rowind).val().toString().split(',');
          var usercheckid=$('#usercheckid').val();
          var tranid=$('.banktid').eq(rowind).val();
          var bankname=$('.bankid option:selected').eq(rowind).text();
          var thaiamt=$('.bankamt').eq(rowind).val();

          if(!userconnect.includes(usercheckid)){
            alert(bankname + ' is not for you.')
            return;
          }

          $('#tblcashdrawcodelist').find('tbody').empty();
          //debugger;
          $('#cashdrawcodemodal').modal('show');
          var sp = document.querySelector("#bankid"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var customername=$('.bankid option:selected').eq(rowind).text();
          var customerid=$('#bankid'+rowind).val();
          var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
          var maxfee=sp.options[sp.selectedIndex].getAttribute('maxfeedork');

          var amt1=$('.bankamt').eq(rowind).val();
          var curid1=$('.bankcur').eq(rowind).val();
          var cur1=$('.bankcur option:selected').eq(rowind).text();
          var amt2=$('.bankamtexchange').eq(rowind).val();
          var cur2=$('.bankcursale').eq(rowind).val();
          var curid2=$('.bankcurexchange').eq(rowind).val();
          if(amt2!==''){
            $('#wingamount_out').val(amt2);
            $('#wingcur_out').val(cur2);
            $('#wingcurid_out').val(curid2);

          }else{
              $('#wingamount_out').val(amt1);
              $('#wingcur_out').val(cur1);
              $('#wingcurid_out').val(curid1);

          }
          $('#tid0_out').val(tranid);
          $('#wingmaxamt_out').val(maxtransfer);
          $('#wingmaxfee_out').val(maxfee);
          $('#agenttype_out').val(agenttype);
          $('#rowind_out').val(rowind);
          $('#customerid_out').val(customerid);
          $('#customername_out').val(customername);
          $('#thaiamt_out').val(thaiamt);
          $('#btngeneratecode_out').click();

      });
      $(document).on('click','#btncancelcode',function(e){
            var rowind=$('#rowind').val();
            $('.wingcodeinfo').eq(rowind).val('');
            $('.wingcodeinfotd').eq(rowind).html('');
            $('.wingcodeinfoby').eq(rowind).val('');
            $('.bankseva').eq(rowind).val(0);
            $('.btndowingcode').eq(rowind).attr('title','');
            $('#dowingcodemodal').modal('hide');
      })
      $(document).on('click','#btnsavecode',function(e){
        var totalfee=0;
        var codestr='';
        var rowind=$('#rowind').val();
        $("tr.item").each(function() {
            //debugger;
            var wingamt = $(this).find("input.txtwingamt").val();
            var wingcode= $(this).find("input.txtwingcode").val();
            var wingcur=$(this).find("td:eq(1)").text();
            if(wingcur=='USD'){
                wingcur='ដុល្លា';
            }else if(wingcur=='KHR'){
                wingcur='រៀល';
            }else if(wingcur=='THB'){
                wingcur='បាត';
            }
            var wingfee=$(this).find("input.txtwingfee").val().replace(/,/g,'');
            totalfee += parseFloat(wingfee);
            if(codestr==''){
                codestr = wingamt + ' ' + wingcur + '=' + wingcode;

            }else{
                codestr +='<br>' + wingamt + ' ' + wingcur + '=' + wingcode;
            }

        });
        if(codestr==''){
            alert('no item code found');
            return;
        }else{
            //codestr +='<br>' + $('#docodebyname').val();
        }
        $('.wingcodeinfo').eq(rowind).val(codestr);
        $('.wingcodeinfotd').eq(rowind).html(codestr);
        $('.wingcodeinfoby').eq(rowind).val($('#docodeby').val());
        $('.bankseva').eq(rowind).val(formatNumber(totalfee));
        $('.btndowingcode').eq(rowind).attr('title',$('.bankid').eq(rowind).val());
        $('#dowingcodemodal').modal('hide');
      })

      function addrow(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            var table = document.getElementById("tbl_bankpayment");
            var nn=table.tBodies[0].rows.length+1;
            let tst = Math.round(Date.now() / 1000)+nn;
            var row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${nn}</td>
                         <td style="padding:0px;">
                            <input type="text" class="form-control banktid kh16" style="" name="banktid[]">
                        </td>
                        <td style="width:250px;padding:0px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid" id="bankid${nn}"  style="width:250px;"></select>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh22" style="" name="bankname[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh22" style="text-align:right;" name="bankamt[]">
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="form-select bankcur kh22" id="bankcur${nn}" style="width:130px;" title=""></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankseva kh22" style="text-align:right;" name="bankseva[]">
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel kh22" style="" name="bankrectel[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname kh22" style="" name="bankrecname[]">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange[]" class="form-select bankcurexchange kh22" id="bankcurexchange${nn}" style="width:130px;"></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate kh22" style="" name="bankrate[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange kh22" style="" name="bankamtexchange[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale kh22" style="" name="bankcursale[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcurbuy kh22" style="" name="bankcurbuy[]">
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo kh22" style="" name="bankbuyinfo[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter banksaleinfo kh22" style="" name="banksaleinfo[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrateinfo kh22" style="" name="bankrateinfo[]">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo kh22" style="" name="wingcodeinfo[]">
                        </td>
                        <td style="padding:0px;">

                        </td>
                        <td style="text-align:center;padding:5px 0px 0px 0px;">
                            <a href="#" class="btn btn-danger remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btndowingcode" style="border-radius:15px;">WingCode</a>
                        </td>
                    </tr>`;
                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcur_continue option').clone().appendTo('#bankcur'+nn);
                $('#selcur_continue option').clone().appendTo('#bankcurexchange'+nn);

                $('#selbank option').clone().appendTo('#bankid'+nn);

                $('#bankid'+nn).select2({
                  dropdownParent: $("#cashdrawmodal"),
                  templateResult: formatOption1
                });
                $('.bankamt').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })

                getphonenumber();

                autofillbankamt();

                //number('.barcode',true);
                window.scrollTo(0, document.body.scrollHeight);

        }

        $(document).on('change','.bankcurexchange',function(e){
            e.preventDefault();
            //debugger;
            var rowind=$(this).closest('tr').index();
            var cursale=$('.bankcurexchange option:selected').eq(rowind).text();
            $('.bankcursale').eq(rowind).val(cursale);
            $('.bankrate').eq(rowind).val('');
            $('.bankamtexchange').eq(rowind).val('');
             $('.banksaleinfo').eq(rowind).val('');
              $('.bankrateinfo').eq(rowind).val('');

            getcurrencybyidlocalstorage($(this).val(),$(this),$('.banksaleinfo').eq(rowind),rowind)
        })

        $(document).on('change','.bankcur',function(e){
            e.preventDefault();
            var rowind=$(this).closest('tr').index();
             var curbuy=$('.bankcur option:selected').eq(rowind).text();
            $('.bankcurbuy').eq(rowind).val(curbuy);
            getcurrencybyidlocalstorage($(this).val(),$(this),$('.bankbuyinfo').eq(rowind),rowind)
        })
        $(document).on('click','.btntolist',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var amt=Math.abs($(this).data('amount'));
            var curid=$(this).data('curid');
            //check if already add to partner list
            var partnername=$(this).data('partnername');
            refid='transfer-'+ id;
            var url1="{{ route('moneytransfer.check_reference_id') }}";
            $.get(url1,{refid:refid},function(data){
                console.log(data)
                if(data.see==true){
                    alert('this transaction already add to partner list')
                }else{
                    var url="{{ route('saveuseraction') }}";
                    $.post(url,{id:id},function(data){
                        if(data.error==true){//if return view
                            alert('You can not open this money.\n' + data.errorsms);
                        }else{
                            $('#receive_id').val(id);
                            $('#receive_name').val(partnername);
                            $('#amount_continue_2').val(formatNumber(amt));
                            $('#amount_continue_2').attr('title',parseFloat(amt));
                            $('#selcur_continue_2').val(curid);
                            var curname=$('#selcur_continue_2 option:selected').text();
                            $('#txtcur2_2').val(curname);
                            $('#txtcur_2').val(curname);
                            $('#txtcur1_2').val(curname);
                            totalcash2();
                            $('#cashdrawcontinuemodal').modal('show');
                        }
                    })
                }
            });

        })
        $("#cashdrawcontinuemodal").on("hidden.bs.modal", function () {
            var url="{{ route('deleteuseractionbytransferid') }}";
            var id=$('#receive_id').val();

            $.get(url,{id:id},function(data){
                console.log(data);
            })
        });

        $(document).on('click','.btnopencashdraw',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            var smsid=$(this).data('smsid');
            var groupid=$(this).data('groupid');
            opencashdraw(id,groupid,0,'');
        })
        $(document).on('click','.btnselectcashdraw',function(e){
            e.preventDefault();
            //debugger;
            var id=$(this).data('id');
            var smscode=$(this).data('code');
            var text=$(this).text();
            if(text=='unselect'){
              unselect(id,$(this));
            }else{
              opencashdraw(id,smscode,1,$(this));
            }
        })
        $(document).on('click','.btnclearmixsms',function(e){
            var id=$(this).data('id');
            var mixid=$(this).data('mixfromid');
            var url="{{ route('thaicashdraw.clearmixsms') }}";
            // $.get(url,{id:id,mixid:mixid},function(data){
            //     search_cashdraw(moresearch);
            // })


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
                            url: url,
                            data: { id:id,mixid:mixid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    search_cashdraw(moresearch);
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
        $(document).on('click','#btnclosedivbankpayment',function(e){
          e.preventDefault();
          $('#divbankpayment').css('display','none');
          $('#hasbankpayment').val(0);
      })
        $(document).on('click','#btnopenmulticashdraw',function(e){
            e.preventDefault();
            $('#btnclosedivexchangecard').click();
            $('#btnclosedivcontinue').click();
            $('#cashdrawmodal').modal('show');
            $('#diva').css('display','block');
            $('#divm1').css('display','block');
            $('#divm2').css('display','block');

            $('#divb').css('display','none');
            $('#divc').css('display','none');

            $('#hasmulticashdraw').val(1);
            opencashdrawmulti(sumcashdraw);
        })
        function opencashdrawmulti(callback)
        {
          var url="{{ route('thaicashdraw.getmulticashdraw') }}";
            $.get(url,{},function(data){
              $('#diva').empty().html(data);
             callback();

            })
        }
        $(document).on('click','.btndeltransfertemp',function(e){
          var id=$(this).data('transferid');
          var url="{{ route('thaicashdraw.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){
              //console.log(data)
              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('click','#btncleartransferlist',function(e){
          var url="{{ route('thaicashdraw.clearcashdrawselect') }}";
            $.get(url,{},function(data){
              //console.log(data)
              opencashdrawmulti(sumcashdraw);
            })
        })
        $(document).on('click','#btnmixsms',function(e){
            //debugger;
            e.preventDefault();
            var formdata=new FormData(frmcashdraw);
            //formdata.append('curid',curid);
          var url="{{ route('thaicashdraw.mixsms') }}";
          $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        search_cashdraw(moresearch);
                        alert(data.message);
                        $('#cashdrawmodal').modal('hide');
                    }else{
                        alert(data.error)
                    }
                },
                error: function () {
                    alert('Save Error.')
                }

            })

        })
        $(document).on('keydown','.bankamt',function(e){
            if(e.keyCode==13){
                //debugger;
                var table = document.getElementById("tbl_bankpayment");
                var tbodyRowCount = table.tBodies[0].rows.length;
                var rowind=$(this).closest('tr').index();

                if(rowind==tbodyRowCount-1){
                    addrow();
                }
            }
        })
        $(document).on('keydown','.tdcanenter2',function(e){
          if (e.keyCode == 13) {
              sumcashdraw();
              var $this = $(this),
              index = $this.closest('td').index();
              $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
              e.preventDefault();
          }
        })
        $(document).on('keyup', '.txtratefix', function (e) {
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          if(isNumber(e.key)){
            calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              return;
          }
          //alert('not a number')
          const C = e.key;
          if (C === "Backspace") {
            calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              return;
          }

      })
      $(document).on('keyup','.txtbuyfix,.txtsalefix',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();

          var clickfrom=$(this).attr('class');
          if(isNumber(e.key)){
              if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }
              return;
          }
          //alert('not a number')

          const C = e.key;
          if (C === "Backspace") {
            if(clickfrom.includes('txtsalefix')==true){
                calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }else{
                calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
              }
              return;
          }

      })
      $(document).on('click','#btnexchange2',function(e){
          e.preventDefault();
          var sale=$('#openamt').val().replace(/,/g, '');
          var curid=$('#selcur').val();
          var cur=$('#selcur option:selected').text();
          getcurrencybyid(curid,'#lblbuy');
          doexchange2(sale,cur)
        })

        $(document).on('click','.td_btnexchange2',function(e){
          e.preventDefault();
          var cur=$(this).data('cur');
          var sale=$(this).data('amount');
          getcurrencybyshortcut(cur,'#lblbuy');
          //var curname=$('#selcur option:selected').text();
          doexchange2(sale,cur)
        })
      function doexchange2(sale,cur)
      {
          var arr_cur=['USD','THB','KHR','VND'];
          var arr_key=['d','b','r','v']
          let j=0;
          let curind=0;
          $('.lblbuyfix').each(function(i,e){
              //debugger;
                if(i==0){
                    $('.txtbuyfix').eq(i).val(formatNumber(sale));
                }else{
                    $('.txtbuyfix').eq(i).val('');
                    $('.txtsalefix').eq(i).val('');
                }
                j=j+1;
                $(this).attr('title',$('#lblbuy').attr('title'));
                $(this).val($('#lblbuy').val());
                if(arr_cur[i]==$(this).val()){
                    j+=1;
                    curind=i;
                }

                $('.txtsignfix').eq(i).val('+');
                $('.txtsign1fix').eq(i).val('-');
                $('.txtbuyfix').eq(i).css('color','blue');
                $('.lblbuyfix').eq(i).css('color','blue');
                $('.txtsalefix').eq(i).css('color','red');
                $('.lblsalefix').eq(i).css('color','red');

                if(isEmpty(arr_key[j-1])==true){
                  getcurrencybykey2(arr_key[curind],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }else{
                  getcurrencybykey2(arr_key[j-1],$('.lblsalefix').eq(i),$('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
                }

          })
          $('#divexchangefix').css('display','block');
          $('#hasexchangefix').val(1);
          $('#txtleftamt').val(0);
          $('#txtmainamt').val(formatNumber(sale));
          $('#txtleftcur').val(cur);
          $('#btnaddexchange2').focus();
      }

      $(document).on('keydown','.tdcanenter2',function(e){
        if (e.keyCode == 13) {
            totalamtleft();
            var $this = $(this),
            index = $this.closest('td').index();
            $this.closest('tr').next().find('td').eq(index).find('input').focus().select();
            e.preventDefault();
          }
      })
      function totalamtleft()
      {
        let j=0;
        var bamt=0;
        var total=0;
        var leftamt=0;
        var mainamt=$('#txtmainamt').val().replace(/,/g, '');
        $('.txtbuyfix').each(function(i,e){
          bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
          if(isNumber(bamt)){
            total+=parseFloat($('.txtbuyfix').eq(i).val().replace(/,/g, ''));
            leftamt=parseFloat(mainamt)-parseFloat(total);
            $('#txtleftamt').val(formatNumber(leftamt.toFixed(2)));
          }else{
            j=j+1;
            if(j==1){
              leftamt=parseFloat(mainamt)-parseFloat(total);
               $('.txtbuyfix').eq(i).val(formatNumber(leftamt.toFixed(2)));
               calcuexchange2($('.lblbuyfix').eq(i),$('.txtbuyfix').eq(i),$('.txtratefix').eq(i),$('.lblsalefix').eq(i),$('.txtsalefix').eq(i),$('.txtsignfix').eq(i),$('.lblratefix').eq(i));
               $('#txtleftamt').val(formatNumber(0));
            }
          }
        })
      }
        $(document).on('click','.td_btnexchange',function(e){
          e.preventDefault();
          var cur=$(this).data('cur');
          var amt=$(this).data('amount');
          doexchange1(amt,cur);

        })
        function doexchange1(amt,cur)
        {
          $('#divexchangecard').css('display','block');
          $('#hasexchange').val(1);
          $('#txtbuy').val(formatNumber(amt));
          $('#lblrate').attr('title',1);
          getcurrencybyshortcut(cur,'#lblbuy');
            if(cur!='USD'){
                getcurrencybykey('d','#lblsale')
            }else{
                getcurrencybykey('r','#lblsale')
            }
            $('#txtbuy').css('color','blue');
            $('#txtsale').css('color','red');
            $('#txtsign').val('+');
            $('#txtsign1').val('-');
            $('#txtsale').focus();
        }
        $(document).on('click','#btnexchange',function(e){
          e.preventDefault();
          var sale=$('#openamt').val().replace(/,/g, '');
          var curid=$('#selcur').val();
          var cur=$('#selcur option:selected').text();
          doexchange1(sale,cur);

        })
        $(document).on('keyup','.list_cuscharge',function(e){
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          calcuamtopen(rowind);
        })
        $(document).on('change','.list_curcharge_id',function(e){
          e.preventDefault();
          var row = $(this).closest('tr');
          var rowind=row.find("td:eq(0)").text();
          calcuamtopen(rowind);

        })
        $(document).on('click','#btnaddexchange2',function(e){
          e.preventDefault();
          saveexchange2('',0,0,0);
          //window.scrollTo(0, document.body.scrollHeight);
      })
      function saveexchange2(func,elem,isclear)
      {
        $('#divexchangelist').css('display','block');
          var formdata=new FormData;
          $('.txtbuyfix').each(function(i,e){
            bamt=$('.txtbuyfix').eq(i).val().replace(/,/g, '');
            if(isNumber(bamt) && bamt!=0){
              formdata.append("curbuy[]",$('.lblbuyfix').eq(i).val());
              formdata.append("buy[]",$('.txtbuyfix').eq(i).val());
              formdata.append("sale[]",$('.txtsalefix').eq(i).val());
              formdata.append("cursale[]",$('.lblsalefix').eq(i).val());
              formdata.append("buyinfo[]",$('.lblbuyfix').eq(i).attr('title'));
              formdata.append("saleinfo[]",$('.lblsalefix').eq(i).attr('title'));
              formdata.append("rateinfo[]",$('.txtratefix').eq(i).attr('title'));
              formdata.append('rate[]',$('.txtratefix').eq(i).val());
              formdata.append('drate[]',$('.lblratefix').eq(i).attr('title'));
            }
          })
              formdata.append('dd',$('#invdate').val());
              formdata.append('isclear',isclear);
          $.ajax({
              async: true,
              type: 'POST',
              contentType: false,
              processData: false,
              url: "{{ route('saveaddlistmulti') }}",
              data: formdata,
              success: function (data) {
                $('#hasexchange').val(2);
                getmultiexchangelist();
                func(elem);
              },
              error: function () {
                  alert('Save Exchange2 Error.')
              }

          })
      }
        function calcuamtopen(rowind)
        {
          var amt=$('.list_amount').eq(rowind-1).val().replace(/,/g, '');
          var seva=$('.list_cuscharge').eq(rowind-1).val();
          var cur1=$('.list_cur').eq(rowind-1).attr('title');
          var cur2=$('.list_curcharge_id').eq(rowind-1).val();
          if(cur1==cur2){
            var amt1=parseFloat(amt)-parseFloat(seva);
          }else{
            var amt1=parseFloat(amt);
          }
          $('.list_amount_open').eq(rowind-1).val(formatNumber(amt1));
        }
        function sumcashdraw()
        {
          var idusd='';
          var idthb='';
          var idkhr='';
          var idvnd='';
          var usd=0;
          var thb=0;
          var khr=0;
          var vnd=0;
          var cur='';
          var curid='';
          var amt=0;
          var rectel='';
          var recname='';
          $('.list_amount_open').each(function(i,e){
            cur=$('.list_cur_open').eq(i).val();
            curid=$('.list_currencyid').eq(i).val();
            amt=$('.list_amount_open').eq(i).val().replace(/,/g, '');
            if(cur=='USD'){
              usd += parseFloat(amt);
              idusd=curid;
            }else if(cur=='THB'){
              thb += parseFloat(amt);
              idthb=curid;
            }else if(cur=='KHR'){
              khr += parseFloat(amt);
              idkhr=curid;
            }else if(cur=='VND'){
              vnd += parseFloat(amt);
              idvnd=curid;
            }
          })
          var td='';
          var tr='';
          if(usd!=0){
            tr=`
                <tr>
                  <td colspan=2 style="padding:0px; border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(usd)} USD" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="USD" data-cur="USD" data-amount="${ usd }" data-curid="${idusd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          if(thb!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(thb)} THB" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="THB" data-cur="THB" data-amount="${ thb }" data-curid="${idthb}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          if(khr!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(khr)} KHR" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="KHR" data-cur="KHR" data-amount="${ khr }" data-curid="${idkhr}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                    </td>
                  </tr>
                `
          }
          if(vnd!=0){
            tr+=`
                <tr>
                  <td colspan=2 style="padding:0px;border-style:none;"><input type="text" style="text-align:right;width:200px;" class="form-control kh16-b td_txtamt" value="${formatNumber(vnd)} VND" readonly></td>
                  <td style="padding:2px 0px 0px 0px;text-align:center;">
                    <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange" value="Exchange1">
                    <input type="button" title="VND" data-cur="VND" data-amount="${ vnd }" data-curid="${idvnd}" style="width:100px;border-style:none;" class="btn btn-sm kh16 td_btnexchange2" value="Exchange2">
                  </td>
                  </tr>
                `
          }
          $('#tbl_total_cashdraw').empty().html(tr);

        }
        function unselect(id,el)
        {
          var url="{{ route('thaicashdraw.unselectcashdraw') }}";
            $.get(url,{id:id},function(data){
              if(data.del2==1){
                el.text('select');
              }
            })
        }
        $(document).on('click','#btnresetexchange',function(e){
            e.preventDefault();
            var q = confirm("Do you want to reset exchange record?");
            if (!q) return;
            $('#body_exchangedata').empty();
            var groupid=$('#groupid').val();
            var url="{{ route('thaicashdraw1.resetexchange') }}";
            $.get(url,{groupid:groupid},function(data){
                console.log(data)

                for(var i=0;i<data['exchanges'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh22">${i+1}</td>
                        <td class="kh16" style="padding:0px;width:150px;">
                           ${data['exchanges'][i].id}
                        </td>
                        <td class="kh16" style="padding:0px;width:150px;">
                             ${moment(data['exchanges'][i].dd).format("DD-MM-YYYY")}
                        </td>
                        <td class="kh16" style="width:150px;padding:0px;">
                            ${data['exchanges'][i].tt}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].product)}
                            ${data['exchanges'][i].pcur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                             ${formatNumber(data['exchanges'][i].amount)}
                             ${ data['exchanges'][i].maincur}
                        </td>
                         <td class="kh22" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].rate)}
                        </td>

                    </tr>`;

                    $('#body_exchangedata').append(row);

                }
                var table = document.getElementById("tbl_exchangedata");
                //var totalRowCount = table.rows.length; // 5
                var tbodyRowCount = table.tBodies[0].rows.length; // 3
                if(tbodyRowCount==0){
                    $('.bankcurexchange').each(function(i,e){
                        $(this).attr('disabled',false);
                        $('.bankrate').eq(i).attr('readonly',false);
                    })
                }
            })

        })
        function opencashdraw(id,groupid)
        {
            closemodalfrom='';
            $('#frmcashdraw').trigger('reset');
            $("#tbl_bankpayment tbody tr").remove();
            $('#body_bankpayment').empty();
            $('#body_exchangedata').empty();
            $('#transfer_id').val(id);
            $('#groupid').val(groupid);

            var url="{{ route('thaicashdraw1.opencashdraw1') }}";
            $.get(url,{id:id,groupid:groupid},function(data){
               console.log(data)
                //debugger;
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                $('#cashdrawmodal').modal('show');

                var row='';
                for(var i=0;i<data['transfers'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${i+1}</td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control banktid kh16" style="width:100px;" name="banktid[]" value="${data['transfers'][i].id}" readonly>
                        </td>
                        <td style="padding:0px;width:250px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid kh16-b" id="bankid${i}"  style="width:250px;" ${data['transfers'][i].docodeby ? 'disabled' : ''} ></select>
                        </td>
                        <td style="width:250px;padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh22" style="width:250px;"  name="bankname[]" value="${data['transfers'][i].partner.name}" readonly>
                        </td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype kh22" style="" name="customertype[]" value="${data['transfers'][i].partner.customertype??''}">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype kh22" style="" name="agenttype[]" value="${data['transfers'][i].partner.agent_type??''}">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control userconnect kh22" style="" name="userconnect[]" value="${data['transfers'][i].partner.user_connect??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;width:150px;" name="bankamt[]" value="${formatNumber(data['transfers'][i].thai_amt)}" readonly>
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="form-select bankcur kh16-b" id="bankcur${i}" style="width:100px;" title="${data['transfers'][i].th_buyinfo}"></select>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel kh16-b" style="width:180px;height:38px;" name="bankrectel[]" value="${data['transfers'][i].rectel??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname kh16-b" style="width:180px;height:38px;padding:8px 5px 5px 5px;" name="bankrecname[]" value="${data['transfers'][i].recname??''}">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange[]" class="form-select bankcurexchange kh16-b" id="bankcurexchange${i}" style="width:100px;" disabled></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate kh16-b" style="width:80px;" name="bankrate[]" value="${data['transfers'][i].th_rate??''}" readonly title="${data['transfers'][i].th_rateinfo??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange kh16-b" style="width:180px;text-align:right;" name="bankamtexchange[]" value="${formatNumber(data['transfers'][i].amount)}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale kh16-b" style="width:80px;" name="bankcursale[]" id="bankcursale${i}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurbuy kh22" style="" name="bankcurbuy[]" id="bankcurbuy${i}" readonly>
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo kh22" style="" name="bankbuyinfo[]" value="${data['transfers'][i].th_buyinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter banksaleinfo kh22" style="" name="banksaleinfo[]" value="${data['transfers'][i].th_saleinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankrateinfo kh22" style="" name="bankrateinfo[]" value="${data['transfers'][i].th_rateinfo??''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo kh22" style="" name="wingcodeinfo[]" value="${data['transfers'][i].moneycode??''}">

                        </td>
                        <td style="text-align:center;padding:5px 0px 0px 0px;" style="width:150px;">
                            <a href="#" class="btn btn-info btndowingcode kh12-b" style="border-radius:15px;padding:3px;" data-docodeby="${data['transfers'][i].docodeby??''}" data-customertype="${data['transfers'][i].partner.customertype??''}" data-agenttype="${data['transfers'][i].partner.agent_type??''}" data-maxtransfer="${data['transfers'][i].partner.max_transfer??''}" data-maxfee="${data['transfers'][i].partner.max_fee??''}">WingCode</a>
                            <a href="#" class="btn btn-warning btncashoutcode kh12-b" style="border-radius:15px;padding:5px;width:60px;${data['transfers'][i].docodeby?'':'display:none;'}" data-docodeby="${data['transfers'][i].docodeby}" data-hascashdrawcode="${data['transfers'][i].cashdraw_codeid}">${data['transfers'][i].docodeby?'ដកកូត':''} </a>
                            </td>
                        <td class="wingcodeinfotd kh12-b" style="padding:3px;">
                            ${data['transfers'][i].moneycode??''}
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfoby kh22" style="" name="wingcodeinfoby[]" value="${data['transfers'][i].docodeby??''}">
                            <input type="text" class="form-control tdcanenter cashdrawcodeid kh22" style="" name="cashdrawcodeid[]" value="${data['transfers'][i].cashdraw_codeid??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankseva kh16-b" style="text-align:right;width:100px;" name="bankseva[]" value="${formatNumber(data['transfers'][i].fee)}">
                        </td>

                    </tr>`;

                    $('#body_bankpayment').append(row);
                    $('#selcurthai option').clone().appendTo('#bankcur'+i);
                    $('#selcur_continue option').clone().appendTo('#bankcurexchange'+i);
                    $('#bankcur'+i).val(data['transfers'][i].thai_cur);
                    if(data['transfers'][i].th_rate!=='' && data['transfers'][i].th_rate!==null){
                        $('#bankcurexchange'+i).val(data['transfers'][i].currency_id);
                        $('#bankcurexchange'+i).attr('title',data['transfers'][i].th_saleinfo);
                    }

                    var cursale=$('#bankcurexchange' + i +' option:selected' ).text();
                    var curbuy=$('#bankcur' + i +  ' option:selected').text();
                    $('#bankcursale'+i).val(cursale);
                    $('#bankcurbuy'+i).val(curbuy);
                    $('#selbank option').clone().appendTo('#bankid'+i);
                    $('#bankid'+i).val(data['transfers'][i].parrent_id);
                    //$('#bankid'+i).tirgger('change');
                    $('#bankid'+i).select2({
                    dropdownParent: $("#cashdrawmodal"),
                    templateResult: formatOption1
                    });

                }

                for(var i=0;i<data['exchanges'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh22">${i+1}</td>
                        <td class="kh16" style="padding:0px;width:150px;">
                           ${data['exchanges'][i].id}
                        </td>
                        <td class="kh16" style="padding:0px;width:150px;">
                             ${moment(data['exchanges'][i].dd).format("DD-MM-YYYY")}
                        </td>
                        <td class="kh16" style="width:150px;padding:0px;">
                            ${data['exchanges'][i].tt}
                        </td>
                         <td class="kh16-b" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].product)}
                            ${data['exchanges'][i].pcur}
                        </td>
                         <td class="kh16-b" style="width:200px;padding:0px;text-align:right;">
                             ${formatNumber(data['exchanges'][i].amount)}
                             ${ data['exchanges'][i].maincur}
                        </td>
                         <td class="kh16-b" style="width:200px;padding:0px;text-align:right;">
                            ${formatNumber(data['exchanges'][i].rate)}
                        </td>

                    </tr>`;

                    $('#body_exchangedata').append(row);




                }
                var table = document.getElementById("tbl_exchangedata");
                //var totalRowCount = table.rows.length; // 5
                var tbodyRowCount = table.tBodies[0].rows.length; // 3
                if(tbodyRowCount==0){
                    $('.bankcurexchange').each(function(i,e){
                        $(this).attr('disabled',false);
                        $('.bankrate').eq(i).attr('readonly',false);
                    })
                }
                $('.bankamt').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
                $('.bankseva').toArray().forEach(function(field){
                        new Cleave(field, {
                            numeral: true,
                            numeralThousandsGroupStyle: 'thousand'
                        });
                    })
            })
            getphonenumber();
        }
        $(document).on('change','.bankid',function(e){
          e.preventDefault();
          //debugger;
          var rowind = $(this).closest('tr').index();
          var bankname=$('.bankid option:selected').eq(rowind).text();
          var sp = document.querySelector("#bankid"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
          var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');

          $('.customertype').eq(rowind).val(customertype);
          $('.agenttype').eq(rowind).val(agenttype);
          $('.userconnect').eq(rowind).val(userconnect);

          $('.bankname').eq(rowind).val(bankname);
      })
        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
          $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });

        $('#selpartner_continue').on("select2:select", function(e) {
            //console.log($(this).val());
            $('#btnsave').focus();
        });
        $(document).on('click','#btncontinue',function(e){
            e.preventDefault();
            //disablebutton($(this).attr('id'));
            $('#hascontinue').val(1);
            $('#divcontinue').css('display','block');
            $('#selpartner').focus();
            var hasexchange=$('#hasexchange').val();
            var amt_continue=0;
            var lblsale='';
            var cur_continue='';
            if(hasexchange==1){
                amt_continue=$('#txtsale').val();
                lblsale=$('#lblsale').attr('title').split(";");
                cur_continue=lblsale[0];
            }else{
                amt_continue=$('#openamt').val();
                cur_continue=$('#selcur').val();
            }
            $('#amount_continue').val(amt_continue);
            totalcash();
            $('#selcur_continue').val(cur_continue);
            $('#amount_continue').attr('title',amt_continue);
            filltxtcur();
            //window.scrollTo(0, document.body.scrollHeight);
            $('#selpartner_continue').focus();
        })
        $(document).on('change','#selcur_continue',function(e){
            filltxtcur();
        })
        function filltxtcur()
        {
            var curid=$('#selcur_continue').val();
            var seltext=$('#selcur_continue option:selected').text();
            $('#txtcur').val(seltext);
            $('#txtcur1').val(curid);
            $('#txtcur2').val(curid);
        }
        $(document).on('change','#selcur_continue_2',function(e){
            filltxtcur2();
        })
        function filltxtcur2()
        {
            var seltext=$('#selcur_continue_2 option:selected').text();
            $('#txtcur_2').val(seltext);
            $('#txtcur1_2').val(seltext);
            $('#txtcur2_2').val(seltext);
        }
        $(document).on('click','#btnclosedivcontinue',function(e){
            e.preventDefault();
            $('#hascontinue').val(0);
            $('#divcontinue').css('display','none');
            buttonclose($(this).attr('id'));

        })
        $(document).on('click','#btnclosedivexchangecard',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));

            $('#divexchangecard').css('display','none');
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(0)
        })
        $(document).on('click','#btnclosedivexchangelist',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(1)
        })
        $(document).on('keydown', '.canenter', function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("id");
                if (id == 'txtbuy') {
                    $('#txtrate').focus();
                } else if(id == 'txtrate'){
                   $('#btnsave').focus();
                } else if (id == 'cuscharge'){
                    $('#rec_tel').focus();
                }else if (id == 'rec_tel') {
                    $('#rec_name').focus();
                }else if (id == 'rec_name') {
                    $('#txtother').focus();
                }else if(id=='amount_continue'){
                    $('#cuscharge_continue').focus();
                }else if(id=='cuscharge_continue'){
                    $('#fee_continue').focus();
                }else if(id=='fee_continue'){
                    $('#btnsave').focus();
                }else if(id=='rectel_continue'){
                    $('#recname_continue').focus();
                }else if(id=='recname_continue'){
                    $('#sendertel_continue').focus();
                }else if(id=='sendertel_continue'){
                    $('#sendername_continue').focus();
                }else if(id=='sendername_continue'){
                    $('#amount_continue').focus();
                }
                e.preventDefault();
            }
        })

      function getphonenumber()
    {

      $.ajax({
                async: true,
                type: 'GET',
                url: "{{ route('rectel.autocomplete') }}",
                data: {},
                complete: function () {

                },
                success: function (data) {
                  console.log(data);
                  $(".bankrectel").autocomplete({

                      source: function (request, response) { // use a function so you can trim the request and ignore ""
                          var term = $.trim(request.term).replace(/\s+/g, '')
                          var reg = new RegExp($.ui.autocomplete.escapeRegex(term), "i")
                          if (term !== "") response($.grep(data, function (tag) {
                              //return tag.value.match(reg)
                              return tag.value.match(reg)

                          }))
                      },

                      select: function (e, ui) {
                          //location.href = ui.item.the_link;
                          //console.log(ui.item.recname);
                          var bankrowind=$(this).closest('tr').index();
                          $('.bankrecname').eq(bankrowind).val(ui.item.recname);
                      }

                  });
                },
                error: function () {
                    alert('Read Phone Number Error.')
                }
            })
    }
      function getreceivetel()
    {
      $.ajax({
                async: true,
                type: 'GET',
                url: "{{ route('cashdrawrectel.autocomplete') }}",
                data: {},
                complete: function () {

                },
                success: function (data) {
                  console.log(data);
                  $("#rec_tel").autocomplete({
                      source: function (request, response) { // use a function so you can trim the request and ignore ""
                          var term = $.trim(request.term).replace(/\s+/g, '')
                          var reg = new RegExp($.ui.autocomplete.escapeRegex(term), "i")
                          if (term !== "") response($.grep(data, function (tag) {
                              //return tag.value.match(reg)
                              return tag.value.match(reg)

                          }))
                      },
                      select: function (e, ui) {
                          //location.href = ui.item.the_link;
                          //console.log(ui.item.recname);
                          $('#recname').val(ui.item.recname);
                      }
                  });
                },
                error: function () {
                    alert('Read Error.')
                }
            })
    }




        $(document).on('keyup', '#txtbuy', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }else if(C==="+"){
                e.preventDefault();
                $('#txtbuy').css('color','blue');
                $('#txtsale').css('color','red');
                $('#txtsign').val('+');
                $('#txtsign1').val('-');
                getrate();


                return;
            }else if(C==="-"){
                e.preventDefault();
                $('#txtbuy').css('color','red');
                $('#txtsale').css('color','blue');
                $('#txtsign').val('-');
                $('#txtsign1').val('+');
                getrate();

                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblbuy')
            }
        })
        $(document).on('keyup', '#txtrate', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblsale')
            }
        })

        $(document).on('keyup','#cuscharge',function(e){
            const C = e.key;
            openamount();
        })
        function openamount()
        {

            var openamt=0;
            var amt=$('#amount').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge').val().replace(/,/g, '');
            openamt=parseFloat(amt)-parseFloat(cuscharge);
            if(isNaN(openamt)){
                openamt=amt;
            }
            $('#openamt').val(formatNumber(parseFloat(openamt)));

        }
        // $(document).on('click','#btnsavecontinue',function(e){
        //     e.preventDefault();
        //     var formdata=new FormData(frm_continue);
        //     var partnername=$('#selpartner_continue_2 option:selected').text();
        //     formdata.append('partnername',partnername);
        //     var url="{{ route('moneytransfer.savebankcontinue') }}"
        //     $.ajax({
        //         async: true,
        //         type: 'POST',
        //         contentType: false,
        //         processData: false,
        //         url: url,
        //         data: formdata,
        //         success: function (data) {
        //             console.log(data)
        //             if($.isEmptyObject(data.error)){
        //                 $('#cashdrawcontinuemodal').modal('hide');
        //                 search_cashdraw(moresearch);
        //             }else{
        //                 alert(data.error)
        //             }
        //         },
        //         error: function () {
        //             alert('Save Error.')
        //         }

        //     })
        // })
        $(document).on('click','#btnclosedivexchangefix',function(e){
          e.preventDefault();
          $('#divexchangefix').css('display','none');
          $('#hasexchangefix').val(0)
        })
        function autofillbankamt()
        {

            var table = document.getElementById("tbl_bankpayment");
            var bankpaymentrow = table.tBodies[0].rows.length;
            let j=0;
            var lbl_title='';
            var transferamt='0';
            var curid='';
            var curname='';
            var lastind=0;
            if($('#hasmulticashdraw').val()==1){
               transferamt=$('.td_btnexchange').eq(0).data('amount');
               curid=$('.td_btnexchange').eq(0).data('curid');
            }else{
               transferamt=$('#openamt').val().replace(/,/g, '');
               curid=$('#selcur').val();
               curname=$('#selcur option:selected').text();
            }

            var hasexchange=$('#hasexchange').val();
            var hasexchange2=$('#hasexchangefix').val();
            if(hasexchange2==1){
              $('.txtsalefix').each(function(i,e){
                lastind=i;
                bamt=$('.txtsalefix').eq(i).val().replace(/,/g, '');
                if(isNumber(bamt) && bamt!=0){
                  transferamt=bamt;
                  lbl_title=$('.lblsalefix').eq(i).attr('title');
                  curid=lbl_title.split(';')[0];
                  if($('.bankamt').eq(j).val()==0 || $('.bankamt').eq(j).val()==''){
                    $('.bankamt').eq(j).val(formatNumber(bamt));
                    $('.bankcur').eq(j).val(curid);

                  }
                  j+=1;
                }else{

                }
              })
              $('.bankamt').eq(bankpaymentrow-1).focus();
              return;
            }else{
              if(hasexchange==1){
                if($('#txtsign').val()=='+'){
                  transferamt=$('#txtsale').val().replace(/,/g, '');
                  curid=$('#lblsale').attr('title').split(';')[0];
                }else{
                  transferamt=$('#txtbuy').val().replace(/,/g, '');
                  curid=$('#lblbuy').attr('title').split(';')[0];
                }
              }else if(hasexchange==2){

              }
            }
            var getamt=0;
            var fillamt=0;
            $('.bankamt').each(function(i,e){
                //debugger;
                lastind=i;
                fillamt=transferamt-getamt;
                if($('.bankamt').eq(i).val()==''){
                    $('.bankamt').eq(i).val(formatNumber(fillamt));
                }else{
                    getamt +=parseFloat($('.bankamt').eq(i).val().replace(/,/g, ''));
                }
              $('.bankcur').eq(i).val(curid);
              $('.bankcurbuy').eq(i).val(curname);
            })
            $('.bankamt').eq(bankpaymentrow-1).focus();
            getcurrencybyidlocalstorage(curid,$('.bankcur').eq(lastind),$('.bankbuyinfo').eq(lastind),lastind);

        }
        $(document).on('click','.btncontinue2',function(e){
            e.preventDefault();
            var q = confirm("Do you send to step2?");
            if (!q) return;
            var id=$(this).data('id');
            var url="{{ route('thaicashdraw.updatestep') }}";
            $.get(url,{step:2,mscp:0,id:id},function(data){
                search_cashdraw(0);
            })

        })
        $(document).on('click','#btnsave,#btnsavestep2,#btnupdate',function(e){
            e.preventDefault();
            var elem=$(this).attr('id');
            func_savecashdraw(elem);

        })
        function func_savecashdraw(elem)
        {
            for(i=0; i<$('.bankid').length; i++) {
                var bankid=$('.bankid').eq(i).val();
                var bankid1=$('.btndowingcode').eq(i).attr('title');
                if(bankid1!=undefined && bankid1!=''){
                    if(bankid1!=bankid){
                        alert('selected bank not match the generate code')
                        return;
                    }
                }
            }
            $('body').addClass("wait");
            var mscp=0;
            var step=2;
            if(elem=="btnsave"){
                mscp=1;
            }else if(elem=="btnsavestep2"){
                step=2;
            }else if(elem=="btnupdate"){

            }
            var curid=$('#selcur').val();
            var topartner=$('#selpartner_continue option:selected').text();
            var frompartner=$('#from_partner').val();
            var formdata=new FormData(frmcashdraw);
            formdata.append('curid',curid);
            formdata.append('topartner',topartner);
            formdata.append('frompartner',frompartner);
            formdata.append('groupid',$('#groupid').val());
            formdata.append('mscp',mscp);
            formdata.append('step',step);
            formdata.append('updatefromstep3',1);
            var hasexchange=$('#hasexchange').val();
            //append exchange
            if(hasexchange==1){
                //var cashreceive=$('#txtcashreceive').val() + $('#lblcashin').val();
                // var cashreturn=$('#txtcashreturn').val();
                var m1 = $('#lblbuy').attr('title').split(";");
                var m2 = $('#lblsale').attr('title').split(";");
                var buyinfo='';
                var saleinfo='';
                var pid = 0;
                var mcur = '';
                var pcur = '';
                var luy = 0;
                var product = 0;
                var mekun = 1;
                var item1 = 0;
                var item2 = 0;
                var rate1b = 0;
                var rate1s = 0;
                var rate2b = 0;
                var rate2s = 0;
                var curid1 = 0;
                var curid2 = 0;
                var pcur1 = '';
                var pcur2 = '';
                var buy='0';
                var sale='0';
                var curbuy='';
                var cursale='';
                var receipt2='0';

                if ($('#txtsign').val() == '+') {
                    mekun = 1;
                    buy=$('#txtbuy').val();
                    sale=$('#txtsale').val();
                    curbuy=$('#lblbuy').val();
                    cursale=$('#lblsale').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtbuy').val() + curbuy;
                    //     cashreturn=$('#txtsale').val() + cursale;
                    // }
                    buyinfo=$('#lblbuy').attr('title');
                    saleinfo=$('#lblsale').attr('title');

                } else {
                    mekun = -1;
                    buy=$('#txtsale').val();
                    sale=$('#txtbuy').val();
                    curbuy=$('#lblsale').val();
                    cursale=$('#lblbuy').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtsale').val() + cursale;
                    //     cashreturn=$('#txtbuy').val()+curbuy;
                    // }
                    saleinfo=$('#lblbuy').attr('title');
                    buyinfo=$('#lblsale').attr('title');
                }
                if (m1[4] == '1') {
                    mcur = m1[6];
                    pid = m2[0];
                    pcur = m2[6];
                    luy = mekun * $('#txtbuy').val().replace(/,/g, '');
                    product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else if (m2[4] == '1') {
                    mcur = m2[6];
                    pid = m1[0];
                    pcur = m1[6];
                    product = mekun * $('#txtbuy').val().replace(/,/g, '');
                    luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else {
                    receipt2='1';
                    item1 = $('#txtbuy').val();
                    item2 = $('#txtsale').val();
                    rate1b = m1[1];
                    rate1s = m1[2];
                    rate2b = m2[1];
                    rate2s = m2[2];
                    curid1 = m1[0];
                    curid2 = m2[0];
                    pcur1 = m1[6];
                    pcur2 = m2[6];
                    //url = "{{ route('saveexchangeproduct') }}"
                }
                var curshortcut=$('#txtcur_open').val();
                formdata.append("curshortcut",curshortcut);
                formdata.append("buyinfo", buyinfo);
                formdata.append("saleinfo", saleinfo);
                formdata.append("product_id", pid);
                formdata.append("product_cur", pcur);
                formdata.append("exchange_amount", luy);
                formdata.append("maincur", mcur);
                formdata.append("product", product);
                formdata.append("exchange_rate", $('#txtrate').val());
                formdata.append("origin_rate", $('#lblrate').attr('title'));

                formdata.append("exsign", $('#txtsign').val());
                formdata.append("item1", item1);
                formdata.append("item2", item2);
                formdata.append("rate1buy", rate1b);
                formdata.append("rate1sale", rate1s);
                formdata.append("rate2buy", rate2b);
                formdata.append("rate2sale", rate2s);
                formdata.append("curid1", curid1);
                formdata.append("curid2", curid2);
                formdata.append("pcur1", pcur1);
                formdata.append("pcur2", pcur2);
                formdata.append("buy",buy);
                formdata.append("sale", sale);
                formdata.append("curbuy", curbuy);
                formdata.append("cursale", cursale);

            }

            var url="{{ route('thaicashdraw1.updatetransfer') }}"
            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data: formdata,
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        closemodalfrom='saved';
                        $('#cashdrawmodal').modal('hide');
                        var transfer_id=$('#transfer_id').val();
                        del_userselectcashdraw(transfer_id);
                        if(elem=='btnsaveprint'){
                            prints(data.cashdrawid);
                        }
                        search_cashdraw(moresearch);
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
        function prints(ref_number){
                var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw/prints?ref_number='+ref_number, '_blank');
                redirectWindow.location;
            }
        var clickson='';
        $(document).on('click','#btnbrowseson',function(e){
            e.preventDefault();
            clickson=1;
            $('#searchchildmodal').modal('show');
            var selpartner=$('#selpartner').val();
            $('#sel_customer_search').val(selpartner);
            $('#sel_customer_search').trigger('change');
        })
        $(document).on('click','#btnbrowseson_2',function(e){
            e.preventDefault();
            clickson=2;
            $('#searchchildmodal').modal('show');
            var selpartner=$('#selpartner_continue_2').val();
            $('#sel_customer_search').val(selpartner);
            $('#sel_customer_search').trigger('change');
        })
        $(document).on('click','.btn_select',function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            if(clickson==1){
                $('#son').val(childname + '(' + addr + ')');
            }else if(clickson==2){
                $('#son_2').val(childname + '(' + addr + ')');
            }
            $('#searchchildmodal').modal('hide');

        })
        $('#tblchildren').on('dblclick', '.rowclick', function(event) {

            var ind=$(this).index();
            var row=$(this).closest('tr');
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            if(clickson==1){
                $('#son').val(childname + '(' + addr + ')');
            }else if(clickson==2){
                $('#son_2').val(childname + '(' + addr + ')');
            }
            $('#searchchildmodal').modal('hide');

		});
        $(document).on('keyup','#amount_continue',function(e){
            const C = e.key;
            cutwater(1);
            if(isNumber(C)==false){
              getcurrencybykeylocalstorage(C,'#selcur_continue');
              var cur=$('#selcur_continue option:selected').text();
              $('#selcur_continue').trigger('change');
          }
        })
        $(document).on('keyup','#cuscharge_continue',function(e){
            const C = e.key;
            cutwater(0);
        })
        $(document).on('change','#txtcur2',function(e){
          cutwater(0);
      })
        $(document).on('change','#amount_continue',function(e){
            $('#amount_continue').attr('title',$(this).val());
        })

        $(document).on('keyup','#amount_continue_2',function(e){
            const C = e.key;
            cutwater2(1);
        })
        $(document).on('keyup','#cuscharge_continue_2',function(e){
            const C = e.key;
            cutwater2(0);
        })
        $(document).on('change','#amount_continue_2',function(e){
            $('#amount_continue_2').attr('title',$(this).val());
        })

        $(document).on('change','#ckwater',function(e){
           cutwater(0);
        })
        $(document).on('change','#ckwater_2',function(e){
           cutwater2(0);
        })
        function cutwater(isamtkeyup)
        {

            if(isamtkeyup!=1){
                var ck = document.getElementById("ckwater").checked;
                var amt=$('#amount_continue').attr('title').replace(/,/g, '');
                var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
                if(ck==true){
                    amt=amt-cuscharge;
                    $('#amount_continue').val(formatNumber(amt));
                }else{
                    $('#amount_continue').val(formatNumber(amt));
                }
            }

            totalcash();
        }
        function totalcash()
        {
            var totalcash=0;
            var amt=$('#amount_continue').val().replace(/,/g, '');
            var cur=$('#selcur_continue option:selected').text();
            var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
            var cur1=$('#txtcur2 option:selected').text();
            if(cur==cur1){
              totalcash=parseFloat(amt)+parseFloat(cuscharge);
            }else{
                totalcash=amt;
            }
            $('#totalcash').val(formatNumber(parseFloat(totalcash)));

        }

        function cutwater2(isamtkeyup)
        {
            if(isamtkeyup!=1){
                var ck = document.getElementById("ckwater_2").checked;
                var amt=$('#amount_continue_2').attr('title').replace(/,/g, '');
                var cuscharge=$('#cuscharge_continue_2').val().replace(/,/g, '');
                if(ck==true){
                    amt=amt-cuscharge;
                    $('#amount_continue_2').val(formatNumber(amt));
                }else{
                    $('#amount_continue_2').val(formatNumber(amt));
                }
            }

            totalcash2();
        }
        function totalcash2()
        {
            var totalcash=0;
            var amt=$('#amount_continue_2').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge_continue_2').val().replace(/,/g, '');
            totalcash=parseFloat(amt)+parseFloat(cuscharge);
            $('#totalcash_2').val(formatNumber(parseFloat(totalcash)));

        }
        function getcurrencybykey2(key,el,lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
        //debugger;
        var url="{{ route('getcurrencybykey') }}";
        $.get(url,{key:key},function(data){
            //console.log(data)
                if(data['c']!=null){
                    $(el).val(data['c']['shortcut']);
                    $(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
        })
    }
    function getrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            $(txtrate).attr('title', '');
            var m = $(lblbuy).attr('title').split(";");
            var p = $(lblsale).attr('title').split(";");
            if(m=='' || p==''){
                //alert('can not save')
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $(txtrate).val(1);
                if(txtbuy.val()!='' || txtsale.val()!=''){
                    calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    return;
                }
            }
            if ($(txtsign).val() == '+') {
                if (m[4] == '1') {//if maincur=true
                    $(txtrate).val(formatNumber(parseFloat(p[2])));//get rate p sale
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[1])));//get rate m buy
                }

            } else {
                if (m[4] == '1') {
                    $(txtrate).val(formatNumber(parseFloat(p[1])));
                } else {
                    $(txtrate).val(formatNumber(parseFloat(m[2])));
                }

            }
            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            if(txtbuy.val()!='' || txtsale.val()!=''){
                calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
            }
            //dolabelcico();
        }
        function runproductrate2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate)
    {
            var url="{{ route('getproductrate') }}";
            var buycur = $(lblbuy).val();
            var salecur = $(lblsale).val();
            var curname = '';
            if ($(txtsign).val() == '+') {
                curname = buycur + '-' + salecur;
            } else {
                curname = salecur + '-' + buycur;
            }
            //alert(curname)
            $.get(url,{curname:curname},function(data){
                if(data.success){


                    if($('#countrycode').val()=='+66'){
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['thai_rate'])));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['thai_rate'] + ';' +  data['pr']['operator']);
                    }else{
                      $(txtrate).val(formatNumber(parseFloat(data['pr']['rate'])));
                      $(txtrate).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                    }
                    if(txtbuy.val()!='' || txtsale.val()!=''){
                        calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                    }
                }else{
                    $(txtrate).val('');
                    $(txtrate).attr('title','');
                }
                console.log(data)
            })

            $(lblrate).attr('title',$(txtrate).val());
            $(lblrate).val($(txtrate).val());
            //dolabelcico();
    }
        function calcuexchange2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblbuy).attr('title').split(";");
            var m2 = $(lblsale).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchange3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger
            // $('#txtcashreceive').val('');
            // $('#txtcashreturn').val('');
            var luy = $(txtsale).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var m1 = $(lblsale).attr('title').split(";");
            var m2 = $(lblbuy).attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    } else {
                        $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    }
                } else {
                    calcuexchangeproduct3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
                }
            }
        }
        function calcuexchangeproduct2(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
            //debugger;
            var luy = $(txtbuy).val().replace(/,/g, '');
            var r = $(txtrate).val().replace(/,/g, '');
            var rs = $(txtrate).attr('title').split(";");
            if ($(txtsign).val() == '+') {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                }
            } else {
                if (rs[2] == '*') {
                    $(txtsale).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                } else {
                    $(txtsale).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                }
            }
        }
        function getcurrencybyidlocalstorage(id,el,el1,ind)
        {
            //debugger;
            var currencylist;
            if(localStorage.getItem("currencylist")==null){
            currencylist=[];
            }else{
            currencylist=JSON.parse(localStorage.getItem("currencylist"));
            }
            currencylist.forEach(function(c){
            //debugger;
            if(c.id==id){
                    //$(el).val(c.shortcut);
                    $(el).val(c.id);
                    $(el).attr('title', c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    $(el1).val( c.id + ';' + parseFloat(c.ratebuy) + ';' + parseFloat(c.ratesale) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    getrate(ind);
                }
            })
        }
        function getrate(ind) {
        //debugger;
        $('.bankrate').eq(ind).val('');
        $('.bankamtexchange').eq(ind).val('');
        $('.bankrate').eq(ind).attr('title', '');
        $('.bankrateinfo').eq(ind).val('');

        var m = $('.bankcur').eq(ind).attr('title').split(";");
        var p = $('.bankcurexchange').eq(ind).attr('title').split(";");
        if(m=='' || p==''){
            //alert('can not save')
            return;
        }
        //check if the save curname
        //debugger
        if (m[6] == p[6]) {
            $('.bankrate').eq(ind).val(1);
            calcuexchange(ind);
            return;
        }
        //check if product exchange product
        if (m[4] == '0') {
            if (p[4] == '0') {

                runproductrate(ind,$('.bankcur option:selected').eq(ind).text(),$('.bankcurexchange option:selected').eq(ind).text());
                return;
            }
        }

        if (m[4] == '1') {//if maincur=true
            $('.bankrate').eq(ind).val(formatNumber(parseFloat(p[2])));//get rate p sale
        } else {
            $('.bankrate').eq(ind).val(formatNumber(parseFloat(m[1])));//get rate m buy
        }


        $('.bankrate').eq(ind).attr('title',$('.bankrate').eq(ind).val());
        $('.bankrateinfo').eq(ind).val($('.bankrate').eq(ind).val());

        calcuexchange(ind);
        //dolabelcico();
    }
    function calcuexchangeproduct(ind) {
          //debugger;
          var luy = $('.bankamt').eq(ind).val().replace(/,/g, '');
          var r = $('.bankrate').eq(ind).val().replace(/,/g, '');
          var rs = $('.bankrate').eq(ind).attr('title').split(";");

        if (rs[2] == '*') {
            $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
        } else {
            $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
        }

      }
    function calcuexchange(ind) {

        //debugger;
          var luy = $('.bankamt').eq(ind).val().replace(/,/g, '');
          var r = $('.bankrate').eq(ind).val().replace(/,/g, '');
          var m1 = $('.bankcur').eq(ind).attr('title').split(";");
          var m2 = $('.bankcurexchange').eq(ind).attr('title').split(";");
          if (m1[4] == '1') { //if maincur=true
              if (m2[3] == '/') {//if operator=/
                  $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
              } else {
                  $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
              }
          } else {
              if (m2[4] == '1') {
                  if (m1[3] == '/') {
                      $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                  } else {
                      $('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                  }
              } else {
                  calcuexchangeproduct(ind);
              }
          }
      }
    function runproductrate(ind,buycur,salecur) {
          //debugger
          var url="{{ route('getproductrate') }}";
          var curname = '';

        curname = buycur + '-' + salecur;

          //alert(curname)
          $.get(url,{curname:curname},function(data){
              if(data.success){
                    //debugger;
                  $('.bankrate').eq(ind).val(formatNumber(parseFloat(data['pr']['rate'])));
                  $('.bankrate').eq(ind).attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
                  calcuexchangeproduct(ind);
              }else{
                  $('.bankrate').eq(ind).val('');
                  $('.bankrate').eq(ind).attr('title','');
              }
              console.log(data)

          })

          //$('.bankrate').eq(ind).attr('title',$('.bankrate').eq(ind).val());
          //$('.bankrateinfo').eq(ind).val($('.bankrate').eq(ind).val());
          $('.bankrateinfo').eq(ind).val($('.bankrate').eq(ind).attr('title'));
          //dolabelcico();
      }

    })
    function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
