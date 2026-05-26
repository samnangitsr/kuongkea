@extends('master')
@section('title') ទំនាក់ទំនងអតិថិជន @endsection
@section('css')
    <style type="text/css">
    body.wait *{
        cursor: wait !important;
    }
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
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

        .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
        .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            font-weight:bold;
            }
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
        .tbl_sub td{
            padding:0px 5px 0px 5px;
        }
        tr.borderset1{
            border-top:1px solid gray;border-left:1px solid gray;border-right:1px solid gray;
        }
        tr.borderset2{
            border-bottom:1px solid gray;border-left:1px solid gray;border-right:1px solid gray;
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

       #tbl_notyetcomplete td{
        padding:3px;
       }
       #tbl_notyetcomplete th{
        padding:5px;
        text-align:center;
        background-color:rgb(1, 20, 20);
        color:white;
       }

       #tbl_complete td{
        padding:3px;
       }
       #tbl_complete th{
        padding:5px;
        text-align:center;
        background-color:rgb(1, 20, 20);
        color:white;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color:lightgray;
       }

       #tbl_notyetcomplete .clickedrow td{
        /* background-color:lightgray; */
        border:3px solid blue;
       }
       #tbl_complete .clickedrow td{
        background-color:rgb(154, 196, 245);
        /* border:3px solid blue; */
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color:lightgray;
       }
       #tblclearclick .clickedrow td{
        background-color:lightgray;
       }
       .cgreen{
        background-color:greenyellow;
        color:red;
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
        .webutton {
            background-color: #7bd9e6; /* Green */
            border: none;
            border-radius: 4px;
            color: black;
            padding: 8px 15px 7px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin:5px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button1:hover {
            background-color: #8fe9c8;
            color: rgb(19, 57, 230);
        }
        /* #tbl_notyetcomplete tr:hover {background-color:rgb(231, 173, 248) !important;}
        #tbl_complete tr:hover {background-color:rgb(247, 170, 247) !important;}
        #tbl_notyetcomplete td:hover {background-color:rgb(231, 173, 248) !important;}
        #tbl_complete td:hover {background-color:rgb(247, 170, 247) !important;} */
        .tbldocodenew td{
            border-style:none;
            padding:2px;
        }
        #tblxx td{
            border-style:none;
            padding:0px;
        }
        .mybtn-success{
            background-color:#6be64c;
            border:1px solid black;
        }
        .mybtn-success:hover{
            background-color:#322fe4 !important;
            color:white;
        }
        .mybtn-info{
            background-color:#40dfeb;
            border:1px solid black;
        }
        .mybtn-info:hover{
            color:white;
            background-color:#1126e4 !important;
        }
        .mybtn-danger{
            background-color:red;
            color:white;
            border:1px solid black;
        }
        .mybtn-danger:hover{
            color:white;
            background-color:#0b0fda !important;
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
            <table id="tblxx" class="table">
                <tr class="kh16-b">
                    <td style="">គិតពី</td>
                    <td style="">ដល់
                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="checkbox" name="ckupdatedate" id="ckupdatedate" value="0" >
                        <label class="form-check-label kh16-b" for="ckupdatedate">Update Date</label>
                    </td>
                    <td colspan=2 style="">
                        <table>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radf" id="radnotyet" value="0" checked>
                                        <label class="form-check-label kh16-b" for="radnotyet">មិនទាន់រួចរាល់</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radf" id="radready" value="1" >
                                        <label class="form-check-label kh16-b" for="radready">ការងាររួចរាល់</label>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </td>

                </tr>
                <tr>

                    <td style="width:200px;">
                        <div class="input-group" style="width:200px;">
                            <input type="text" name="d1" id="d1" class="form-control" style="width:100px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="width:200px;">
                        <div class="input-group" style="width:200px;">
                            <input type="text" name="d2" id="d2" class="form-control" style="width:100px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="">
                        <table>
                            <tr>
                                <td>
                                    @if (Auth::user()->role->name<>'Admin')
                                        @if (App\User::checkpermission(Auth::id(),'4.3.1'))
                                            <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search by Date</button>
                                        @endif
                                    @else
                                        <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search by Date</button>
                                        <button class="btn btn-primary btn-md kh16-b" id="btnclearclick" style="">Clear User Action</button>
                                        {{-- <button class="btn btn-primary btn-md kh16-b" id="btnclearinterval" style="">Start Timer</button> --}}
                                        <button class="btn btn-primary btn-md kh16-b" id="btnclearrefresh" style="">Clear Refresh Action</button>
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td style="">
                        <input type="text" class="kh14-b" id="tableSearch" style="width:100%;padding:5px;"  placeholder="Search What You Want..." title="Type what you khnow">
                    </td>
                </tr>

            </table>
        </div>
    </div>
    <div id="searchmore" class="collapse show">
        <div class="row">
            <div class="col-lg-3">
                <label class="kh16-b" for="searchby">ស្វែងរកតាម</label>
                <select name="selsearchby" id="selsearchby" class="form-select kh16-b" style="height:38px;width:100%;">
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
            <div class="col-lg-3" id="col1">
                <label id="lbltime" class="kh16-b" for="stel">ស្វែងរកតាមម៉ោង</label>

                <input type="text" id="txtsearchbytime" class="form-control kh16-b" style="width:100%;height:38px;" title="">
            </div>
            <div class="col-lg-3" id="col2" style="display:none;">
                <label id="lbltel" class="kh16" for="stel">ស្វែងរកតាមលេខទូរស័ព្ទ</label>

                <input type="text" id="txtsearchbytel" class="form-control kh16" style="width:100%;height:38px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.4') }}">
            </div>
            <div class="col-lg-3" id="col3" style="display:none;">
                <label class="kh16" for="samt1">ពីចំនួន</label>
                <input type="checkbox" id="ckthaiamt" name="ckthaiamt" value="1">
                <label for="ckthaiamt">Thai Amount</label>
                <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:38px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.1') }}">
            </div>
            <div class="col-lg-3" id="col4" style="display:none;">
                <label class="kh16" for="samt2">ដល់ចំនួន</label>
                <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:38px;">
            </div>
            <div class="col-lg-3">
               <button id="btnsearch2" class="btn btn-info kh16" style="margin-top:25px;">Search</button>
            </div>
        </div>
    </div>

    <div class="tableFixHead" id="cashdrawandnotyet" style="padding:0px;margin:0px;">

    </div>
    @include('thaicashdraws.cashdrawmodal1')
    @include('moneytransfers.clearuseractionmodal')
    @include('thaicashdraws.dowingcodemodalnew')
    @include('thaicashdraws.cashdrawcodemodal')
    @include('thaicashdraws.showqrcodemodal')
@endsection
@section('script')
{{-- @include('moneytransfers.exchangescript'); --}}
    <script type="text/javascript">

        $('#h1_title').text('ផ្នែកទំនាក់ទំនងអតិថិជន');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-255;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-255;

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
            var countsmsrefresh=0;
            function refreshpage()
            {
                var url="{{ route('thaicashdraw.countsmsrefresh') }}";
                $.get(url,{step:2},function(data){
                    //console.log(data)
                    if(countsmsrefresh!=data['countrow']){
                        countsmsrefresh=data['countrow'];
                        search_cashdraw(moresearch);
                    }
                })
            }
            getreceivetel();

            //refreshpage();
            //starttimer();
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

        window.addEventListener("storage", function(event) {
            //debugger;
            if (event.key === "pageprintcode") {
                // Handle the event when a new item is added on Page A
                $('#dowingcodemodalnew').modal('hide');
                var transfer_id=$('#transferid3').val();
                var url="{{ route('thaicashdraw1.delcashdrawaction2') }}";
                $.post(url,{id:transfer_id},function(data){})
                search_cashdraw(moresearch);
            }
        });

        $(document).on('click','#btnclearrefresh',function(e){
            var url="{{ route('thaicashdraw.clearrefreshaction') }}";
            $.get(url,{},function(data){
                alert('Refresh Action Deleted');
            })
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
                search_cashdraw(0);
        //     $(document).on('dblclick', '.tblnotyetcashdrawrowclick', function(event) {

        //         var ind=$(this).index();
        //         var row=$(this).closest('tr');
        //         id=row.find("td:eq(1)").text();
        //         opencashdraw(id);

        // });
        var cleave = new Cleave('#cuscharge3', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbyamt1', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
            var cleave = new Cleave('#txtsearchbyamt2', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });

        var cleave = new Cleave('#thaiamt3', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
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
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var update = document.getElementById("ckupdatedate").checked;
            var mscp=$('input[name="radf"]:checked').val();
            var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
            var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
            var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
            var time=$('#txtsearchbytime').val();
            var searchby=$('#selsearchby').val();
            var checkbox = $("#ckthaiamt");
            var isthaiamt=0;
            if (checkbox.is(":checked")) {
                isthaiamt=1;
            }
            var url="{{ route('thaicashdraw1.searchcashdraw1') }}";

            // $.get(url,{d1:d1,d2:d2,mscp:mscp,searchmore:searchmore,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,time:time,update:update},function(data){
            //     $('#cashdrawandnotyet').empty().html(data);
            //     if(mscp==0){
            //         $('#tbl_title').text('មិនទាន់រួចរាល់');
            //     }else if(mscp==1){
            //         $('#tbl_title').text('ការងាររួចរាល់');
            //     }
            // })

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,mscp:mscp,searchmore:searchmore,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,isthaiamt:isthaiamt,time:time,update:update},
                success: function (data) {
                    //console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#cashdrawandnotyet').empty().html(data);
                        if(mscp==0){
                            $('#tbl_title').text('មិនទាន់រួចរាល់');
                        }else if(mscp==1){
                            $('#tbl_title').text('ការងាររួចរាល់');
                        }
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
         $(document).on('click','#tbl_notyetcomplete td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_complete td',function(e){
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
                var transfer_id=$('#smsprocess_id').val();
                del_userselectcashdraw(transfer_id);
            }
        });
        $("#dowingcodemodalnew").on("hidden.bs.modal", function () {
            if(closemodalfrom!=='saved'){
                var transfer_id=$('#transferid3').val();
                del_userselectcashdraw2(transfer_id);
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
                            <td>${data['useractions'][i].transfer_id}</td>
                            <td>${data['useractions'][i].transfer.dd}</td>
                            <td>${formatNumber(Math.abs(data['useractions'][i].transfer.thai_amt))} THB</td>
                            <td>${data['useractions'][i].user.name}</td>
                            <td>${moment(data['useractions'][i].created_at).format("DD-MM-YYYY")}</td>
                            <td style="text-align:right;"> <a href="#" class="btn btn-danger btndelactionuser" data-id="${ data['useractions'][i].id }" data-transferid="${ data['useractions'][i].transfer_id }">Remove</a></td>
                        </tr>
                    `
                }
                $('#tblclearclick').empty().html(output);
            })
       })
       $(document).on('click','.btnclearselect',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            var rowind=$(this).data('rowind');
            var url="{{ route('thaicashdraw1.delcashdrawaction2') }}";
            $.post(url,{id:id},function(data){

                $('.btnclearselect').eq(rowind).css('display','none');
                $('.btnopencashdraw').eq(rowind).text('ពិនិត្យ');
                //$('.btncontinue3').eq(rowind).css('display','inline');
                //$('.btnready').eq(rowind).css('display','inline');
            })
       })
       $(document).on('click','.btndelactionuser',function(e){
            e.preventDefault()
            var id=$(this).data('transferid');
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
        $(document).on('change','#thaiamt3',function(e){
            e.preventDefault();
            var smsamt=$('#smsamt3').val();
            var sumthaitransfer=$('#sumtransferthai3').val();
            var amt=$(this).val().replace(/,/g,'');
            var total=parseFloat(sumthaitransfer)+parseFloat(amt);
            $('#tblcodelist').find('tbody').empty();
            if(total>smsamt){
                alert('Transfer amount is bigger than sms amount');
                document.getElementById("btngeneratecode3").setAttribute("disabled", "disabled");
                document.getElementById("btnupdate3").setAttribute("disabled", "disabled");
                $("#btngeneratecode3").removeClass('button1');
                $("#btnupdate3").removeClass('button1');
            }else{
                document.getElementById("btngeneratecode3").removeAttribute('disabled');
                document.getElementById("btnupdate3").removeAttribute('disabled');
                $("#btngeneratecode3").addClass('button1');
                $("#btnupdate3").addClass('button1');
            }

        })
        $(document).on('keyup','#exchangerate3,#thaiamt3',function(e){
            //debugger;
            // if(isNumber(e.key)){
            //   calcuexchange3(calcuwater);
            //   return;
            // }

            // const C = e.key;
            // if (C === "Backspace") {
            //     calcuexchange3(calcuwater);
            //     return;
            // }

            if (isNumber(e.key) || e.key === "Backspace") {
                calcuexchange3(calcuwater);
            }
        })
        $(document).on('change','#exchangerate3',function(e){
            e.preventDefault();
            $('#tblcodelist').find('tbody').empty();
        })
        function calcuwater()
        {
            var amttitle=$('#exchangeamount3').attr('title').replace(/,/g, '');
            var cuscharge=$('#cuscharge3').val().replace(/,/g, '');
            var ck = document.getElementById("ckdorktek3").checked;
            var amount=0;
            var totalamt=0;
            if(ck==true){
                amount=parseFloat(amttitle)-parseFloat(cuscharge);
            }else{
                amount=amttitle;
            }

            $('#exchangeamount3').val(formatNumber(amount));
            $('#totalamt3').val(formatNumber(parseFloat(amount)+parseFloat(cuscharge)));
        }
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
    //   $(document).on('click','#btnbankpayment',function(e){
    //       e.preventDefault();
    //       $('#divbankpayment').css('display','block');
    //       $('#hasbankpayment').val(1);
    //       var table = document.getElementById("tbl_bankpayment");
    //       var tbodyRowCount = table.tBodies[0].rows.length;
    //       if(tbodyRowCount==0){
    //         addrow();
    //       }
    //   })
    //   $(document).on('click','#btnaddrow',function(e){
    //       e.preventDefault();
    //       addrow();
    //   })
       $(document).on('click','.remove',function(e){
           e.preventDefault();
           //$(this).parent().parent().remove();
           $(this).closest("tr").remove();
           //ResetNo();
       });
      $(document).on('click','#btncashdrawcode',function(e) {
        e.preventDefault();
        //debugger;
        $('body').addClass("wait");
        var totalfee=0;
        for(i=0; i<$('.txtwingfee_out').length; i++) {
            fee = $('.txtwingfee_out').eq(i).val().replace(/,/g,'');
            totalfee += parseFloat(fee);
        }
        var formdata=new FormData();
        formdata.append('refgroupid',$('#groupid3').val());
        formdata.append('smsprocess_id',$('#smsprocess_id').val());
        formdata.append('wingamount_out',$('#wingamount_out').val());
        formdata.append('wingcurid_out',$('#wingcurid_out').val());
        formdata.append('wingfee_out',totalfee);
        formdata.append('customerid_out',$('#customerid_out').val());
        formdata.append('customername_out',$('#customername_out').val());
        formdata.append('tranid',$('#tid0_out').val());
        formdata.append('thaiamt',$('#thaiamt_out').val().replace(/THB/g,''));
        var url="{{ route('thaicashdraw.savecashdrawwingcode') }}"
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
                        $('#cashdrawcodemodal').modal('hide');
                        //$('#cashdrawmodal').modal('hide');
                        // var transfer_id=$('#smsprocess_id').val();
                        // del_userselectcashdraw(transfer_id);
                        search_cashdraw(moresearch);
                        var transfer_id=$('#transferid3').val();
                        del_userselectcashdraw2(transfer_id);
                        // $('.btnopencashdraw').eq($('#rowind3').val()).click();
                        openedit(data['id'],$('#agenttype3').val(),-1,$('#groupid3').val());
                        $('#btnwingbal').click();
                        $('body').removeClass("wait");
                        sendMessage();
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
      $(document).on('click','#btndorkcode3',function(e){
          e.preventDefault();
          //debugger;

          var tranid=$('#transferid3').val();
          var bankname=$('#selbankname3 option:selected').text();
          var thaiamt=$('#thaiamt3').val();
          var ex_rate=$('#exchangerate3').val();
          var moneycode=$('#txtmoneycode3').val();
          var rectel=$('#wingrectel3').val();
          var recname=$('#wingrecname3').val();


          $('#tblcashdrawcodelist').find('tbody').empty();
          //debugger;
          $('#cashdrawcodemodal').modal('show');
          var customerid=$('#selbankname3').val();
          var customerid_title=$('#selbankname3').attr('title');
          if(customerid != customerid_title){
            alert('invalid cashdraw code bank name');
            return;
          }
          var customertype=$('#customertype3').val();
          var agenttype=$('#agenttype3').attr('title');
          var agenttypename=$('#agenttype3').val();
          var customername=$('#selbankname3 option:selected').text();
          var maxtransfer=$('#wingmaxamt3').val();
          var maxfee=$('#wingmaxfee3').val();

          var amt1=$('#thaiamt3').val();
          var curid1=$('#thaicurid3').val();
          var cur1=$('#thaicur3').val();
          var amt2=$('#exchangeamount3').val();
          var cur2=$('#selcurwing3 option:selected').text();
          var curid2=$('#selcurwing3').val();
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
          $('#customerid_out').val(customerid);
          $('#customername_out').val(customername);
          $('#txtmoneycode_out').val(moneycode);
          $('#thaiamt_out').val(thaiamt + ' THB');
          $('#exchangerate_out').val(ex_rate);
          $('#bankname_out').text(bankname + '(' + agenttypename + ')')
          $('#rectel_out').text(rectel);
          $('#recname_out').text(recname);

          $('#btngeneratecode_out').click();

      });
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
          var ex_rate=$('.bankrate').eq(rowind).val();
          var moneycode=$(this).data('moneycode');
          var rectel=$('.bankrectel').eq(rowind).val();
          var recname=$('.bankrecname').eq(rowind).val();
          if(!userconnect.includes(usercheckid)){
            alert(bankname + ' is not for you.')
            return;
          }

          $('#tblcashdrawcodelist').find('tbody').empty();
          //debugger;
          $('#cashdrawcodemodal').modal('show');
          var sp = document.querySelector("#bankid"+rowind);
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttypeid');
          var agenttypename=sp.options[sp.selectedIndex].getAttribute('agenttype');

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
          $('#txtmoneycode_out').val(moneycode);
          $('#thaiamt_out').val(thaiamt + ' THB');
          $('#exchangerate_out').val(ex_rate);
          $('#bankname_out').text(bankname + '(' + agenttypename + ')')
          $('#rectel_out').text(rectel);
          $('#recname_out').text(recname);

          $('#btngeneratecode_out').click();

      });
      $(document).on('click','#btngeneratecode_out',function(e){
        e.preventDefault();
        $('#tblcashdrawcodelist').find('tbody').empty();
        var agenttype=$('#agenttype_out').val();
        var maxamtstr=$('#wingmaxamt_out').val().replace(/,/g,'');
        var maxfeestr=$('#wingmaxfee_out').val().replace(/,/g,'');
        var moneycode=$('#txtmoneycode_out').val().split('<br>');
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
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(amount)}" readonly></td>
                    <td class="kh22">${wingcur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter" readonly></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="0" readonly></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item_out">
                    <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(maxamt)}" readonly></td>
                    <td class="kh22">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter" readonly></td>
                    <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(maxfee)}" readonly></td>
                </tr>
            `;
            $('#tblcashdrawcodelist').find('tbody').append(data);
        }
        if(somnal!==0){
             //var sp = document.querySelector("#seltranname");
            //var sign=sp.options[sp.selectedIndex].getAttribute('sign');
            sign=-1;
              var response = findRates(agenttype, somnal,$('#seltranname').val(), cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge = cuscharge;
                        totalfee = parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee = cashdraw;

                    }
                }
                 var data=`
                    <tr class="item_out">
                        <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
                        <td class="kh22">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter" readonly></td>
                        <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(totalfee)}" readonly></td>
                    </tr>
                `;
                 $('#tblcashdrawcodelist').find('tbody').append(data);
            //var url="{{ route('thaicashdraw.getwingfee') }}";
            // $.get(url,{agenttype:agenttype,amount:somnal,cur:cur},function(data){
            //     console.log(data)
            //     var data=`
            //         <tr class="item_out">
            //             <td style="padding:0px;" class="kh22"><input type="text" class="form-control txtwingamt_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
            //             <td class="kh22">${cur}</td>
            //             <td style="padding:0px;"><input type="text" class="form-control txtwingcode_out kh22 tdcanenter" readonly></td>
            //             <td style="padding:0px;"><input type="text" class="form-control txtwingfee_out kh22 tdcanenter" style="text-align:right;" value="${formatNumber(data['wingfee'].cashdraw_rate)}" readonly></td>
            //         </tr>
            //     `;
            //     $('#tblcashdrawcodelist').find('tbody').append(data);
            // })
        }
        var i=0;
        $("tr.item_out").each(function() {
            $(this).find("input.txtwingcode_out").val(moneycode[i].split('=')[1]);
            i+=1
        });

      })

      $(document).on('click','.btndowingcode,.qrimg',function(e){
          e.preventDefault();
          //debugger;
          var btntext=$(this).text();
          var rowind = $(this).closest('tr').index();
          var userconnect=$('.userconnect').eq(rowind).val().toString().split(',');
          var usercheckid=$('#usercheckid').val();
          var bankname=$('.bankname').eq(rowind).val();
          var rectel=$('.bankrectel').eq(rowind).val();
          var recname=$('.bankrecname').eq(rowind).val();
          var imagepath=$('.imagepath').eq(rowind).val();
          var customertype=$('.customertype').eq(rowind).val();
          if(btntext=='កែកូត'){

          }else{
              if(!userconnect.includes(usercheckid)){
                alert(bankname + ' is not for you.')
                return;
              }
              var docodeby=$(this).data('docodeby');
              var cashdrawcode=$(this).data('cashdrawcode');

              if(docodeby!='' && docodeby!=null){
                if(cashdrawcode=='' || cashdrawcode==null){
                    alert('this transaction already do code.');
                    return;
                }
              }
          }

          $('#tblcodelist').find('tbody').empty();
          $('#divqr').css('display','none');
          $('#divrectel').css('display','none');

          //$('#divcodelist').css('display','none');
          $('#dowingcodemodal').modal('show');
          if(customertype=='BANK'){
            //$('#qrcode_image').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
            $('#qrcode_image').attr('src','{{ asset(config('helper.asset_path'))}}' + '/qrcode/' + imagepath);
            $('#divqr').css('display','block');

          }else{
            //$('#divcodelist').css('display','block');
            $('#divrectel').css('display','block');

          }

          $('#accnumber').text(rectel);
          $('#accname').text(recname);
          $('#rectel1').text(rectel);
          $('#recname1').text(recname);

          var maxtransfer=$(this).data('maxtransfer');
          var maxfee=$(this).data('maxfee');
          var agenttype=$(this).data('agenttype');
          if(agenttype==undefined){
            agenttype=customertype;
          }
          var moneycode=$(this).data('moneycode');
          var amt1=$('.bankamt').eq(rowind).val();
          var cur1=$('.bankcur option:selected').eq(rowind).text();
          var amt2=$('.bankamtexchange').eq(rowind).val();
          var cur2=$('.bankcursale').eq(rowind).val();
          var ex_rate=$('.bankrate').eq(rowind).val();
          var bankname=$('.bankid option:selected').eq(rowind).text();
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
          $('#thaiamt').val(amt1 + ' THB');
          $('#exchangerate').val(ex_rate);
          $('#bankname').text(bankname + '(' + agenttype + ')');
          $('#txtmoneycode').val(moneycode);
          $('#btngeneratecode').click();

      });
      $(document).on('click','#btngeneratecode3',function(e){
        e.preventDefault();
        //debugger;
        var thaiamt3=$('#thaiamt3').val().replace(/,/g,'');
        var exchangeamount3=$('#exchangeamount3').attr('title').replace(/,/g,'');
        var exchangerate3=$('#exchangerate3').val().replace(/,/g,'');
        if(parseFloat(thaiamt3)>parseFloat(exchangeamount3)){
            var exchangeamt3=bongkotchomnuen((parseFloat(thaiamt3)/parseFloat(exchangerate3)).toFixed(2),$('#selcurwing3 option:selected').text());
        }else{
            var exchangeamt3=bongkotchomnuen((parseFloat(thaiamt3)*parseFloat(exchangerate3)).toFixed(2),$('#selcurwing3 option:selected').text());
        }

        if(parseFloat(exchangeamount3)>parseFloat(exchangeamt3)){
            alert('Please check exchange amount again');
            return;
        }
        if($('#selbankname3 option:selected').text()==''){
            alert('please select account')
            return;
        }
        $('#tblcodelist').find('tbody').empty();
        // var sp = document.querySelector("#selbankname3");
        // var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        // var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
        // var agenttypeid=sp.options[sp.selectedIndex].getAttribute('agenttypeid');

        var agenttype_id=$('#agenttype3').attr('title');
        var maxamtstr=$('#wingmaxamt3').val().replace(/,/g,'');
        var maxfeestr=$('#wingmaxfee3').val().replace(/,/g,'');
        var maxtransferfeestr=$('#wingmaxtransferfee3').val().replace(/,/g,'');
        var maxcuschargestr=$('#wingmaxcuscharge3').val().replace(/,/g,'');
        var moneycode=$('#txtmoneycode3').val().split('<br>');
        var maxamtby=maxamtstr.split('/');
        var maxfeeby=maxfeestr.split('/');
        var maxtransferfeeby=maxfeestr.split('/');
        var maxcuschargeby=maxcuschargestr.split('/');
        var maxamt=maxamtby[0];
        var maxfee=parseFloat(maxcuschargeby[0])-parseFloat(maxtransferfeeby[0]);
        var cur="USD";
        if($('#exchangecur3').val()=='KHR'){
            maxamt=maxamtby[1];
            maxfee=parseFloat(maxcuschargeby[1])-parseFloat(maxtransferfeeby[1]);
            cur="KHR";
        }
        if($('#exchangecur3').val()=='THB'){
            maxamt=maxamtby[2];
            maxfee=parseFloat(maxcuschargeby[2])-parseFloat(maxtransferfeeby[2]);
            cur="THB";
        }
        var amount=$('#exchangeamount3').val().replace(/,/g, '');
        //var wingcur=$('#exchangecur').val();
        var result=Math.floor(amount / maxamt);
        var somnal=amount % maxamt;
        if(maxamt==0 || maxamt===undefined || maxamt===null){
            //alert('we can not generate code with transfer max amount zero.')
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh16-b"><input type="text" class="txtwingamt kh22-b tdcanenter" style="text-align:right;color:red;width:100%;background-color:yellow;" value="${formatNumber(amount)}" readonly></td>
                    <td class="kh22-b" style="padding:3px 0px 0px 2px;background-color:yellow;">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="txtwingcode kh22-b tdcanenter" style="width:160px;"></td>
                    <td style="padding:0px;"><input type="text" class="txtwingfee kh22-b tdcanenter" style="text-align:right;width:100px;" value="0"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
            fillbalance(amount,'-');
            return;
        }
        for(let i=0;i<result;i++){
            var data=`
                <tr class="item">
                    <td style="padding:0px;" class="kh22-b"><input type="text" class="txtwingamt kh22-b tdcanenter" style="text-align:right;color:red;width:100%;background-color:yellow;" value="${formatNumber(maxamt)}" readonly></td>
                    <td class="kh22-b" style="padding:3px 0px 0px 2px;background-color:yellow;">${cur}</td>
                    <td style="padding:0px;"><input type="text" class="txtwingcode kh22-b tdcanenter" style="width:160px;"></td>
                    <td style="padding:0px;"><input type="text" class="txtwingfee kh22-b tdcanenter" style="text-align:right;width:100px;" value="${formatNumber(maxfee)}"></td>
                </tr>
            `;
            $('#tblcodelist').find('tbody').append(data);
        }

        if(somnal!==0){
            //debugger;
            var sp = document.querySelector("#seltranname");
            var sign=sp.options[sp.selectedIndex].getAttribute('sign');
              var response = findRates(agenttype_id, somnal,$('#seltranname').val(), cur);
                if (response.length > 0) {
                    if (sign == 1) {
                        let customerRate = response[0]['customer_rate'];
                        let transferRate = response[0]['transfer_rate'];

                        // declare variables outside
                        let cuscharge = 0;
                        let transfer = 0;

                        // ✅ Handle customerRate
                        if (typeof customerRate === "string" && customerRate.includes("%")) {
                            customerRate = customerRate.replace("%", "").trim();
                            cuscharge = (parseFloat(customerRate) * parseFloat(somnal)) / 100;
                        } else {
                            cuscharge = parseFloat(customerRate);
                        }

                        // ✅ Handle transferRate
                        if (typeof transferRate === "string" && transferRate.includes("%")) {
                            transferRate = transferRate.replace("%", "").trim();
                            transfer = (parseFloat(transferRate) * parseFloat(somnal)) / 100;
                        } else {
                            transfer = parseFloat(transferRate);
                        }

                        totalcuscharge = cuscharge;
                        totalfee = parseFloat(cuscharge) - parseFloat(transfer);

                    } else if (sign == -1) {
                        let cashdrawRate = response[0]['cashdraw_rate'];

                        let cashdraw = 0;

                        // ✅ Handle cashdrawRate
                        if (typeof cashdrawRate === "string" && cashdrawRate.includes("%")) {
                            cashdrawRate = cashdrawRate.replace("%", "").trim();
                            cashdraw = (parseFloat(cashdrawRate) * parseFloat(somnal)) / 100;
                        } else {
                            cashdraw = parseFloat(cashdrawRate);
                        }

                        totalfee = cashdraw;

                    }
                }
                 var data=`
                    <tr class="item">
                        <td style="padding:0px;" class="kh22"><input type="text" class="txtwingamt kh22-b tdcanenter" style="text-align:right;color:red;width:100%;background-color:yellow;" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
                        <td class="kh22-b" style="padding:3px 0px 0px 2px;background-color:yellow;">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="txtwingcode kh22-b tdcanenter" style="width:160px;"></td>
                        <td style="padding:0px;"><input type="text" class="txtwingfee kh22-b tdcanenter" style="text-align:right;width:100%;" value="${formatNumber(totalfee)}"></td>
                    </tr>
                `;

                $('#tblcodelist').find('tbody').append(data);
            // var url="{{ route('thaicashdraw.getwingfee') }}";
            // $.get(url,{agenttype:agenttype_id,amount:somnal,cur:cur},function(data){
            //     var data=`
            //         <tr class="item">
            //             <td style="padding:0px;" class="kh22-b"><input type="text" class="txtwingamt kh22-b tdcanenter" style="text-align:right;color:red;width:100%;background-color:yellow;" value="${formatNumber(somnal.toFixed(2))}" readonly></td>
            //             <td class="kh22-b" style="padding:3px 0px 0px 2px;background-color:yellow;">${cur}</td>
            //             <td style="padding:0px;"><input type="text" class="txtwingcode kh22-b tdcanenter" style="width:160px;"></td>
            //             <td style="padding:0px;"><input type="text" class="txtwingfee kh22-b tdcanenter" style="text-align:right;width:100px;" value="${formatNumber(parseFloat(data['wingfee'].customer_rate)-parseFloat(data['wingfee'].transfer_rate))}"></td>
            //         </tr>
            //     `;
            //     $('#tblcodelist').find('tbody').append(data);
            // })
        }
        var total=0;
        $("tr.item").each(function() {
            total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
        });
        fillbalance(total,'-');
        $('.txtwingamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
        $('.txtwingfee').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })

      })
       function findRates(agentTypeId, amount, tranNameId, cur) {
            let data = [];

            if (cur === 'USD') {
                data = JSON.parse(localStorage.getItem("wingrate_usd") || "[]");
            } else if (cur === 'KHR') {
                data = JSON.parse(localStorage.getItem("wingrate_khr") || "[]");
            }

            return data.filter(row =>
                Number(row.agenttype_id) === Number(agentTypeId) &&
                Number(amount) >= Number(row.amt1) &&
                Number(amount) <= Number(row.amt2) &&
                row.tranname_id.split(",").map(x => x.trim()).includes(String(tranNameId)) &&
                row.currency === cur
            ).map(row => ({
                customer_rate: row.customer_rate,
                transfer_rate: row.transfer_rate,
                cashdraw_rate: row.cashdraw_rate
            }));
        }
      $(document).on('change','.txtwingfee',function(e){
        e.preventDefault();
        var total=0;
        $("tr.item").each(function() {
            total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
        });
        fillbalance(total,'-');
      })
    //   function fillwingbalancenext()
    //   {

    //     var i=0;
    //     var baltitle=$('#wingbalance').attr('title');
    //     var curwing=$('#selcurwing3 option:selected').text();
    //     var balusd=baltitle.split(";")[0];
    //     var balkhr=baltitle.split(";")[1];
    //     var balthb=baltitle.split(";")[2];
    //     var totalwingcutamount=0;
    //     $("tr.item").each(function() {
    //         //$(this).find("input.txtwingcode").val(moneycode[i].split('=')[1]);
    //         i+=1
    //         totalwingcutamount +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
    //     });

    //     if(curwing=='USD'){
    //         $('#wingbalancenext').val(formatNumber(parseFloat(balusd)- parseFloat(totalwingcutamount)) + ' USD');
    //     }else if(curwing=='KHR'){
    //         $('#wingbalancenext').val(formatNumber(parseFloat(balkhr)- parseFloat(totalwingcutamount)) + ' KHR');
    //     }else if(curwing=='THB'){
    //         $('#wingbalancenext').val(formatNumber(parseFloat(balthb)- parseFloat(totalwingcutamount)) + ' THB');
    //     }
    //   }
      function fillmoneycode(moneycode){

        if(moneycode=='') return;
        var code='';
        var money='';
        var fee='';
        var amt='';
        var cur='';

        var mcodes=moneycode.split('<br>');
        for(let i=0;i<mcodes.length;i++){
            money=mcodes[i].split('=')[0];
            amt=money.split(' ')[0];
            cur=money.split(' ')[1];
            code=mcodes[i].split('=')[1];
            fee=mcodes[i].split('=')[2];

            var data=`
                    <tr class="item">
                        <td style="padding:0px;" class="kh16-b"><input type="text" class="txtwingamt kh16-b tdcanenter" style="text-align:right;width:100%;" value="${amt}"></td>
                        <td class="kh16-b" style="padding:3px 0px 0px 2px;">${cur}</td>
                        <td style="padding:0px;"><input type="text" class="txtwingcode kh16-b tdcanenter" style="width:160px;" value="${code}"></td>
                        <td style="padding:0px;"><input type="text" class="txtwingfee kh16-b tdcanenter" style="text-align:right;width:100px;" value="${fee}"></td>
                    </tr>
                `;
            $('#tblcodelist').find('tbody').append(data);
        }
        $('.txtwingamt').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
        $('.txtwingfee').toArray().forEach(function(field){
              new Cleave(field, {
                  numeral: true,
                  numeralPositiveOnly: true,
                  numeralThousandsGroupStyle: 'thousand'
              });
            })
      }
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
            // if(wingcur=='USD'){
            //     wingcur='ដុល្លា';
            // }else if(wingcur=='KHR'){
            //     wingcur='រៀល';
            // }else if(wingcur=='THB'){
            //     wingcur='បាត';
            // }
            if(wingcode==''){
                wingcode=$('#bankname').text();
            }
            var wingfee=$(this).find("input.txtwingfee").val().replace(/,/g,'');
            totalfee += parseFloat(wingfee);
            if(codestr==''){
                codestr = wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;

            }else{
                codestr +='<br>' + wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;
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
        $('.btndowingcode').eq(rowind).attr('title',$('#usercheckid').val());
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
        $(document).on('change','input',function(e){
            $('#btnready3').css('display','none');
        })
        $(document).on('change','select',function(e){
            $('#btnready3').css('display','none');
        })
        $(document).on('change','#selcurwing3',function(e){
            e.preventDefault();
            $('#tblcodelist').find('tbody').empty();

            var cursale=$('#selcurwing3 option:selected').text();
            $('#exchangecur3').val(cursale);
            $('#cuschargecur3').val(cursale);
            $('#totalcur3').val(cursale);
            $('#exchangerate3').val('');
            $('#exchangeamount3').val('');
            $('#exchangeamount3').attr('title','');
            $('#totalamt3').val('');
            $('#exchangesaleinfo3').val('');
            $('#exchangerateinfo3').val('');
            getcurrencybyidlocalstorage3($(this).val(),$(this),$('#exchangesaleinfo3'),calcuwater)
            refreshwingbalance();
        })
        function refreshwingbalance()
        {
            $('#wingbalancenext').val('');
            var baltitle=$('#wingbalance').attr('title');
            var curwing=$('#selcurwing3 option:selected').text();
            var balusd=baltitle.split(";")[0];
            var balkhr=baltitle.split(";")[1];
            var balthb=baltitle.split(";")[2];
            if(curwing=='USD'){
                $('#wingbalance').val(formatNumber(balusd) + ' USD');
            }else if(curwing=='KHR'){
                $('#wingbalance').val(formatNumber(balkhr) + ' KHR');
            }else if(curwing=='THB'){
                $('#wingbalance').val(formatNumber(balthb) + ' THB');
            }
        }

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
            //debugger;
            var problem=$(this).data('problem')
            if(problem==1){
                alert('this transaction have problem please contact to Admon')
                return;
            }
            var rowind=$(this).closest('tr').index();
            var userconnect=$('.userconnect').eq(rowind).val().toString().split(',');
            var id=$(this).data('id');
            //var smsid=$(this).data('smsid');
            var groupid=$(this).data('groupid');
            var thbuyinfo=$(this).data('thbuyinfo');
            //var transferamt=$(this).data('transferamt');
            //var openamt=$(this).data('openamt');
            //opencashdraw(id,groupid,transferamt,openamt);
            var agenttype=$(this).data('agenttype');
            var agenttypeid=$(this).data('agenttypeid');
            var customertype=$(this).data('customertype');
            var bankname=$(this).data('bankname');
            openedit(id,agenttype,rowind,groupid);
        })
        $(document).on('change','.cuscharge,.ckcuscharge',function(e){
            e.preventDefault();
            //debugger;
            var row = $(this).closest('tr');
            var index=row.find("td:eq(0)").text();
            var amttitle=$('.bankamtexchange').eq(index).attr('title').replace(/,/g, '');
            var cuscharge=$('.cuscharge').eq(index).val().replace(/,/g, '');
            var ck = document.getElementById("ckcuscharge"+index).checked;
            var amount=0;
            var totalamt=0;
            if(ck==true){
                amount=parseFloat(amttitle)-parseFloat(cuscharge);
            }else{
                amount=amttitle;
            }

            $('.bankamtexchange').eq(index).val(formatNumber(amount));
            $('.totalamt').eq(index).val(formatNumber(parseFloat(amount)+parseFloat(cuscharge)));

        })
        $(document).on('change','#cuscharge3,#ckdorktek3',function(e){
            e.preventDefault();
            var amttitle=$('#exchangeamount3').attr('title').replace(/,/g, '');
            var cuscharge=$('#cuscharge3').val().replace(/,/g, '');
            var ck = document.getElementById("ckdorktek3").checked;
            var amount=0;
            var totalamt=0;
            if(ck==true){
                amount=parseFloat(amttitle)-parseFloat(cuscharge);
            }else{
                amount=amttitle;
            }
            $('#tblcodelist').find('tbody').empty();
            $('#exchangeamount3').val(formatNumber(amount));
            $('#totalamt3').val(formatNumber(parseFloat(amount)+parseFloat(cuscharge)));

        })
        // $(document).on('click','.btnselectcashdraw',function(e){
        //     e.preventDefault();

        //     var id=$(this).data('id');
        //     var smscode=$(this).data('code');
        //     var text=$(this).text();
        //     if(text=='unselect'){
        //       unselect(id,$(this));
        //     }else{
        //       opencashdraw(id,smscode,1,$(this));
        //     }
        // })
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
        // $(document).on('keydown','.bankamt',function(e){
        //     if(e.keyCode==13){
        //         //debugger;
        //         var table = document.getElementById("tbl_bankpayment");
        //         var tbodyRowCount = table.tBodies[0].rows.length;
        //         var rowind=$(this).closest('tr').index();

        //         if(rowind==tbodyRowCount-1){
        //             addrow();
        //         }
        //     }
        // })
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
    //   $(document).on('keyup','.txtbuyfix,.txtsalefix',function(e){
    //       var row = $(this).closest('tr');
    //       var rowind=row.find("td:eq(0)").text();

    //       var clickfrom=$(this).attr('class');
    //       if(isNumber(e.key)){
    //           if(clickfrom.includes('txtsalefix')==true){
    //             calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
    //           }else{
    //             calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
    //           }
    //           return;
    //       }
    //       //alert('not a number')

    //       const C = e.key;
    //       if (C === "Backspace") {
    //         if(clickfrom.includes('txtsalefix')==true){
    //             calcuexchange3($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
    //           }else{
    //             calcuexchange2($('.lblbuyfix').eq(rowind-1),$('.txtbuyfix').eq(rowind-1),$('.txtratefix').eq(rowind-1),$('.lblsalefix').eq(rowind-1),$('.txtsalefix').eq(rowind-1),$('.txtsignfix').eq(rowind-1),$('.lblratefix').eq(rowind-1));
    //           }
    //           return;
    //       }

    //   })
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
        function totaluseamt(){
            var totalamt=0;
            var openamt=$('#openamt').val().replace(/,/g, '');
            $('.bankamt').each(function(i,e){
                //debugger;
                if($('.bankamt').eq(i).val()!==''){
                    totalamt +=parseFloat($('.bankamt').eq(i).val().replace(/,/g, ''));
                }
            })
            $('#useamt').val(formatNumber(totalamt));
            $('#leftamt').val(formatNumber(parseFloat(openamt)-parseFloat(totalamt)));
        }
        function openedit(id,agenttype,rowind,groupid){
            //debugger;
            var loginid=$('#loginid').val();
            var loginname=$('#loginname').val();

            // if(!userpartner.includes(loginid)){
            //     alert(bankname + ' is not for you.')
            //     return;
            //   }
            try{
                var url="{{ route('thaicashdraw1.opencashdraw1new') }}";
                $.get(url,{id:id,groupid:groupid},function(data){
                //console.log(data)
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                $('#dowingcodemodalnew').modal('show');
                $('#transferid3').val(id);
                $('#rowind3').val(rowind);

                if(data['transfer'].length>0){
                    $('#groupid3').val(data['transfer'][0].ref_group_id);
                    $('#thaicur3').attr('title',data['transfer'][0].th_buyinfo);
                    $('#thaiamt3').val(formatNumber(data['transfer'][0].thai_amt));
                    $('#thai_cut_seva').val(data['transfer'][0].thai_seva);
                    $('#selcurwing3').val(data['transfer'][0].currency_id);
                    $('#selcurwing3').attr('title',data['transfer'][0].th_saleinfo);
                    $('#exchangesaleinfo3').val(data['transfer'][0].th_saleinfo);
                    $('#cashdrawcodeid3').val(data['transfer'][0].cashdraw_codeid);
                    //$('#selcurwing').trigger('change');
                    $('#thaicurid3').val(data['transfer'][0].thai_cur)
                    $('#mekun3').val(data['transfer'][0].mekun);
                    $('#exchangerate3').val(data['transfer'][0].th_rate);
                    $('#exchangerate3').attr('title',data['transfer'][0].th_rateinfo);
                    $('#exchangerateinfo3').val(data['transfer'][0].th_rateinfo);
                    $('#exchangeamount3').val(formatNumber(data['transfer'][0].amount));
                    $('#exchangeamount3').attr('title',formatNumber(data['transfer'][0].amount));
                    $('#cuscharge3').val(formatNumber(data['transfer'][0].cuscharge));
                    $('#cuschargecur3').val(data['transfer'][0].currency.shortcut);
                    $('#exchangecur3').val(data['transfer'][0].currency.shortcut);
                    $('#totalamt3').val(formatNumber(parseFloat(data['transfer'][0].amount)+parseFloat(data['transfer'][0].cuscharge)));
                    $('#totalcur3').val(data['transfer'][0].currency.shortcut);
                    $('#wingrecname3').val(data['transfer'][0].recname);
                    $('#wingrectel3').val(data['transfer'][0].rectel);
                    $('#docodeby3').val(data['transfer'][0].usercode.name);
                    $('#docodeby3').attr('title',data['transfer'][0].docodeby);

                    //search select option
                    let found=0;
                    document.querySelectorAll("#selbankname3 option").forEach(opt => {
                        if (parseFloat(opt.value) == parseFloat(data['transfer'][0].parrent_id)) {
                            found=1;
                        }
                    });

                    if(found==0){
                        $('#selbankname3').append($("<option/>",{
                            value:data['transfer'][0].parrent_id,
                            text:data['transfer'][0].partner.name,
                            customertype:data['transfer'][0].partner.customertype,
                            agenttype:data['transfer'][0].partner.agenttype.name,
                            agenttypeid:data['transfer'][0].partner.agent_type_id,
                            maxtransfer:data['transfer'][0].partner.agenttype.transfer_amount,
                            maxfee:data['transfer'][0].partner.agenttype.transfer_fee,
                            maxcashdrawfee:data['transfer'][0].partner.agenttype.cashdraw_fee,
                            maxcuscharge:data['transfer'][0].partner.agenttype.customer_fee,
                            userconnect:data['transfer'][0].partner.user_connect,
                        }))
                    }

                    document.getElementById("thaiamt3").setAttribute('readonly',true);
                    if(data['transfer'][0].docodeby=='' || data['transfer'][0].docodeby==null){
                        $('#docodeby3').val(loginname);
                        $('#docodeby3').attr('title',loginid);
                        $('#btnviewcode3').css('display','none');
                        $('#btnready3').css('display','none');
                        $('#btndorkcode3').css('display','none');
                        $('#btngeneratecode3').css('display','inline');
                        document.getElementById("thaiamt3").removeAttribute('readonly');
                        document.getElementById("exchangerate3").removeAttribute('readonly');
                        document.getElementById("cuscharge3").removeAttribute('readonly');
                        document.getElementById("wingrectel3").removeAttribute('readonly');
                        document.getElementById("wingrecname3").removeAttribute('readonly');
                        document.getElementById("selcurwing3").disabled = false;
                        document.getElementById("selbankname3").disabled = false;
                    }else{
                        $('#btnviewcode3').css('display','inline');
                        $('#btnready3').css('display','inline');
                        $('#btndorkcode3').css('display','inline');
                        $('#btngeneratecode3').css('display','none');
                        document.getElementById("exchangerate3").setAttribute('readonly',true);
                        document.getElementById("cuscharge3").setAttribute('readonly',true);
                        document.getElementById("wingrectel3").setAttribute('readonly',true);
                        document.getElementById("wingrecname3").setAttribute('readonly',true);
                        document.getElementById("selcurwing3").disabled = true;
                        document.getElementById("selbankname3").disabled = true;

                    }
                    if(data['transfer'][0].cashdraw_codeid){
                        $('#btndorkcode3').css('display','none');
                        $('#txtmoneycode3').val('');
                        $('#docodeby3').val(loginname);
                        $('#docodeby3').attr('title',loginid);
                        $('#btnviewcode3').css('display','none');
                        $('#btnready3').css('display','none');
                        $('#btndorkcode3').css('display','none');
                        $('#btngeneratecode3').css('display','inline');
                        document.getElementById("thaiamt3").removeAttribute('readonly');
                        document.getElementById("exchangerate3").removeAttribute('readonly');
                        document.getElementById("cuscharge3").removeAttribute('readonly');
                        document.getElementById("wingrectel3").removeAttribute('readonly');
                        document.getElementById("wingrecname3").removeAttribute('readonly');
                        document.getElementById("selcurwing3").disabled = false;
                        document.getElementById("selbankname3").disabled = false;
                    }else{
                        $('#txtmoneycode3').val(data['transfer'][0].moneycode);
                        if(data['transfer'][0].docodeby){
                            $('#btndorkcode3').css('display','inline');
                        }else{
                            $('#btndorkcode3').css('display','none');
                        }
                    }

                    if(data['transfer'][0].mission_complete==1){
                        $('#exchangerate3').attr('readonly','true');
                        document.getElementById("selcurwing3").setAttribute("disabled", "disabled");
                        document.getElementById("selbankname3").setAttribute("disabled", "disabled");
                        $('#btnready3').css('display','none');
                        $('#btnnotready3').css('display','inline');
                    }else{
                        // document.getElementById("exchangerate3").removeAttribute('readonly');
                        // document.getElementById("selcurwing3").removeAttribute("disabled");
                        // document.getElementById("selbankname3").removeAttribute("disabled");
                        // //$('#btnready3').css('display','inline');
                        $('#btnnotready3').css('display','none');

                    }

                        // $('#agenttype3').val(agenttype);
                        // $('#agenttype3').attr('title',data['transfer'][0].partner.agent_type_id);
                        // $('#customertype3').val(data['transfer'][0].partner.customertype);
                        // $('#wingmaxamt3').val(data['transfer'][0].partner.agenttype.transfer_amount);
                        // $('#wingmaxcuscharge3').val(data['transfer'][0].partner.agenttype.customer_fee);
                        // $('#wingmaxfee3').val(data['transfer'][0].partner.agenttype.cashdraw_fee);
                        // $('#wingmaxtransferfee3').val(data['transfer'][0].partner.agenttype.transfer_fee);
                        var imagepath=data['transfer'][0].qrcode;
                        $('#rowqr').css('display','none');
                        if(data['transfer'][0].partner.customertype=='BANK'){
                            // $('#qrcode_image').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
                            // $('#fullqrcode').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
                            $('#qrcode_image').attr('src','{{ asset(config('helper.asset_path'))}}' + '/qrcode/' + imagepath);
                            $('#fullqrcode').attr('src','{{ asset(config('helper.asset_path'))}}' + '/qrcode/' + imagepath);
                            $('#rowqr').css('display','table-row');
                        }else{

                        }
                        if(data['transfer'][0].cashdraw_codeid){
                            $('#btnupdate3').text('រក្សាទុក');
                        }else{
                            $('#btnupdate3').text('កែប្រែ');
                        }
                        $('#tblcodelist').find('tbody').empty();
                        if($('#txtmoneycode3').val()!==''){
                            fillmoneycode($('#txtmoneycode3').val());
                        }
                        $('#selbankname3').val(data['transfer'][0].parrent_id);
                        $('#selbankname3').attr('title',data['transfer'][0].parrent_id);
                        $('#selbankname3').trigger('change');

                        //disable option select
                        if($('#txtrole').val().toLowerCase()!=='admin'){
                            document.querySelectorAll("#selbankname3 option").forEach(opt => {
                                if (parseFloat(opt.value) !== parseFloat(data['transfer'][0].parrent_id)) {
                                    opt.disabled = true;
                                }
                            });
                        }

                    }
                    $('#smsamt3').val(data['smsamt']);
                    $('#sumtransferthai3').val(data['sumtransfer']);
                    //$('#btnwingbal').click();

                })
            }catch{

            }
        }
        $("#showqrcodemodal .modal-dialog").draggable({
            handle: ".modal-header"
        });
        $(document).on('click','#btnshowfullqr',function(e){
            e.preventDefault();
            $('#showqrcodemodal').modal('show');
        })
        function opencashdraw(id,groupid,transferamt,openamt)
        {
            closemodalfrom='';
            $('#frmcashdraw').trigger('reset');
            $("#tbl_bankpayment tbody tr").remove();
            $('#body_bankpayment').empty();
            $('#body_exchangedata').empty();
            $('#smsprocess_id').val(id);
            $('#groupid').val(groupid);
            $('#openamt').val(formatNumber(openamt));

            var url="{{ route('thaicashdraw1.opencashdraw1') }}";
            $.get(url,{id:id,groupid:groupid},function(data){
               console.log(data)
                //debugger;
                if(data.error==true){//if return view
                    alert('You can not open this money.\n' + data.errorsms);
                    return;
                }
                $('#cashdrawmodal').modal('show');
                $('#banktitle').text(groupid);
                var row='';
                for(var i=0;i<data['transfers'].length;i++){
                    row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${i}</td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control banktid kh16" style="width:100px;" name="banktid[]" value="${data['transfers'][i].id}" readonly>
                        </td>
                        <td style="padding:0px;width:250px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid kh16-b" id="bankid${i}"  style="width:250px;" ${data['transfers'][i].docodeby ? data['transfers'][i].cashdraw_codeid?'':'disabled' : ''} ></select>
                        </td>
                        <td style="width:250px;padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh22" style="width:250px;"  name="bankname[]" value="${data['transfers'][i].partner.name}" readonly>
                        </td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype kh22" style="" name="customertype[]" value="${data['transfers'][i].partner.customertype??''}">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype kh22" style="" name="agenttype[]" value="${data['transfers'][i].partner.agent_type_id??''}">
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
                            <input type="text" class="form-control tdcanenter bankrectel kh16-b" style="width:180px;height:38px;padding:5px;" name="bankrectel[]" value="${data['transfers'][i].rectel??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname kh16-b" style="width:180px;height:38px;padding:5px;" name="bankrecname[]" value="${data['transfers'][i].recname??''}">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange[]" class="form-select bankcurexchange kh16-b" id="bankcurexchange${i}" style="width:100px;" ${data['transfers'][i].cashdraw_codeid?'':'disabled'}></select>

                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate kh16-b" style="width:80px;" name="bankrate[]" value="${data['transfers'][i].th_rate??''}" readonly title="${data['transfers'][i].th_rateinfo??''}">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange kh16-b" style="width:180px;text-align:right;" name="bankamtexchange[]" title="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" value="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale kh16-b" style="width:80px;" name="bankcursale[]" id="bankcursale${i}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="tdcanenter cuscharge kh12-b" style="width:100px;text-align:right;" name="cuscharge[]" value="${data['transfers'][i].cuscharge}" >
                            <div class="form-check" style="margin-top:-3px;">
                                <label class="form-check-label kh14-b" style="">
                                    <input class="form-check-input ckcuscharge" type="checkbox" name="ckcuscharge" id="ckcuscharge${i}" style="">ដកទឹក
                                </label>
                            </div>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter totalamt kh16-b" style="width:130px;text-align:right;" name="totalamt[]" value="${data['transfers'][i].th_rate?formatNumber(data['transfers'][i].amount):''}" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurexchange_txt kh16-b" style="width:180px;height:38px;padding:5px;" name="bankcurexchange_txt[]" value="${data['transfers'][i].cashdraw_codeid?data['transfers'][i].currency_id:'0'}">
                            <input type="text" class="form-control tdcanenter bankid_txt kh16-b" style="width:180px;height:38px;padding:5px;" name="bankid_txt[]" value="${data['transfers'][i].cashdraw_codeid?data['transfers'][i].parrent_id:'0'}">

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
                            <input type="text" class="form-control tdcanenter cashdrawcodeid kh22" style="" name="cashdrawcodeid[]" value="${data['transfers'][i].cashdraw_codeid??''}">
                        </td>

                         <td style="text-align:center;padding:5px 2px;width:150px;">
                            <a href="#" class="btn btn-danger btn-sm row_remove" style="border-radius:15px;${data['transfers'][i].cashdraw_codeid?data['transfers'][i].docodeby?'display:none;':'':'display:none;'}"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btndowingcode kh14-b" style="border-radius:15px;width:60px;${data['transfers'][i].qrcode?'display:none;':''}" data-docodeby="${data['transfers'][i].docodeby}" data-cashdrawcode="${data['transfers'][i].cashdraw_codeid}" data-moneycode="${data['transfers'][i].moneycode}" data-customertype="${data['transfers'][i].partner.customertype}" title="${data['transfers'][i].docodeby}" data-customertype="${data['transfers'][i].partner.customertype??''}" data-agenttype="${data['transfers'][i].partner.agent_type_id??''}" data-maxtransfer="${data['transfers'][i].partner.max_transfer??''}" data-maxfee="${data['transfers'][i].partner.max_fee??''}" data-foruserdo="${data['transfers'][i].partner.user_connect}">${data['transfers'][i].docodeby?data['transfers'][i].cashdraw_codeid?'ធ្វើកូត':'កែកូត':'ធ្វើកូត'}</a>

                            <a href="#" class="btn btn-warning btncashoutcode kh14-b" style="border-radius:15px;width:60px;${data['transfers'][i].docodeby?data['transfers'][i].cashdraw_codeid?'display:none;':'':'display:none;'}" data-docodeby="${data['transfers'][i].docodeby}" data-moneycode="${data['transfers'][i].moneycode}" data-hascashdrawcode="${data['transfers'][i].cashdraw_codeid}" data-refgroupid="${data['transfers'][i].ref_group_id}">${data['transfers'][i].docodeby?'ដកកូត':''} </a>
                            <img src="{{ asset('public/qrcode')}}/${data['transfers'][i].qrcode}"  alt="" class="qrimg" title="${data['transfers'][i].qrcode}" style="width:35px;height:35px;${data['transfers'][i].qrcode?'':'display:none;'}">

                        </td>
                        <td class="wingcodeinfotd kh14-b" style="padding:3px;">
                            ${data['transfers'][i].moneycode?data['transfers'][i].moneycode + '(' + data['transfers'][i].usercode.name + ')' :''}
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfoby kh22" style="" name="wingcodeinfoby[]" value="${data['transfers'][i].docodeby??''}">
                            <input type="text" class="form-control tdcanenter imagepath kh16-b" style="" name="imagepath[]" value="${data['transfers'][i].qrcode??''}">
                        </td>
                        <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankseva kh16-b" style="text-align:right;width:100px;" name="bankseva[]" value="${formatNumber(data['transfers'][i].fee)}">
                        </td>


                    </tr>`;
                    $('#btnaddrow').attr('title',i);
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
                totaluseamt();
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
        $(document).on('click','#btnaddrow',function(e){
            e.preventDefault();
            addrow0();
        })
        function addrow0(){
            //var nn=$('#tbl_bankpayment tr').length+1;
            //debugger;
            var table = document.getElementById("tbl_bankpayment");
            var i=parseFloat($('#btnaddrow').attr('title'))+1;
            $('#btnaddrow').attr('title',i);
            let tst = Math.round(Date.now() / 1000)+i;
            row=`<tr>
                        <td style="text-align:center;display:none;" class="no kh16">${i}</td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control banktid kh16" style="width:100px;" name="banktid[]" value="" readonly>
                        </td>
                        <td style="padding:0px;width:250px;">
                            <select name="bankid[]" class="form-select select2-option1 bankid kh16-b" id="bankid${i}"  style="width:250px;"></select>
                        </td>
                        <td style="width:250px;padding:0px;display:none;">
                            <input type="text" class="form-control bankname kh22" style="width:250px;"  name="bankname[]" value="" readonly>
                        </td>
                         <td style="padding:0px;display:none;">
                            <input type="text" class="form-control customertype kh22" style="" name="customertype[]" value="">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control agenttype kh22" style="" name="agenttype[]" value="">
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control userconnect kh22" style="" name="userconnect[]" value="">
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;width:150px;" name="bankamt[]" value="">
                        </td>
                        <td style="width:100px;padding:0px;">
                            <select name="bankcur[]" class="form-select bankcur kh16-b" id="bankcur${i}" style="width:100px;" title=""></select>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrectel kh16-b" style="width:180px;height:38px;padding:5px;" name="bankrectel[]" value="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrecname kh16-b" style="width:180px;height:38px;padding:5px;" name="bankrecname[]" value="">
                        </td>
                         <td style="width:100px;padding:0px;">
                            <select name="bankcurexchange[]" class="form-select bankcurexchange kh16-b" id="bankcurexchange${i}" style="width:100px;"></select>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankrate kh16-b" style="width:80px;" name="bankrate[]" value="" readonly title="">
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankamtexchange kh16-b" style="width:180px;text-align:right;" name="bankamtexchange[]" title="" value="" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter bankcursale kh16-b" style="width:80px;" name="bankcursale[]" id="bankcursale${i}" readonly>
                        </td>
                        <td style="padding:0px;">
                            <input type="text" class="tdcanenter cuscharge kh12-b" style="width:100px;text-align:right;" name="cuscharge[]" value="" >
                            <div class="form-check" style="margin-top:-3px;">
                                <label class="form-check-label kh14-b" style="">
                                    <input class="form-check-input ckcuscharge" type="checkbox" name="ckcuscharge" id="ckcuscharge${i}" style="">ដកទឹក
                                </label>
                            </div>
                        </td>

                        <td style="padding:0px;">
                            <input type="text" class="form-control tdcanenter totalamt kh16-b" style="width:130px;text-align:right;" name="totalamt[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankcurbuy kh22" style="" name="bankcurbuy[]" id="bankcurbuy${i}" readonly>
                        </td>

                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankbuyinfo kh22" style="" name="bankbuyinfo[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter banksaleinfo kh22" style="" name="banksaleinfo[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter bankrateinfo kh22" style="" name="bankrateinfo[]" value="" readonly>
                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfo kh22" style="" name="wingcodeinfo[]" value="">
                             <input type="text" class="form-control tdcanenter cashdrawcodeid kh22" style="" name="cashdrawcodeid[]" value="">
                        </td>
                        <td style="text-align:center;padding:5px 2px;width:150px;">
                            <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                            <a href="#" class="btn btn-info btndowingcode kh14-b" style="border-radius:15px;width:60px;"  title="">ធ្វើកូត</a>
                        </td>
                        <td class="wingcodeinfotd kh14-b" style="padding:3px;">

                        </td>
                        <td style="padding:0px;display:none;">
                            <input type="text" class="form-control tdcanenter wingcodeinfoby kh22" style="" name="wingcodeinfoby[]" value="">
                        </td>
                        <td style="padding:0px;width:100px;">
                            <input type="text" class="form-control tdcanenter bankseva kh16-b" style="text-align:right;width:100px;" name="bankseva[]" value="">
                        </td>


                    </tr>`;

                $('#body_bankpayment').append(row);

                //$('.unit option').remove();

                $('#selcurthai option').clone().appendTo('#bankcur'+i);
                $('#selcur_continue option').clone().appendTo('#bankcurexchange'+i);

                 $('#selbank option').clone().appendTo('#bankid'+i);

                $('#bankid'+i).select2({
                  dropdownParent: $("#cashdrawmodal0"),
                  templateResult: formatOption1
                });
                $('.bankamt').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })
                $('.cuscharge').toArray().forEach(function(field){
                    new Cleave(field, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                })

                getphonenumber($('.bankrectel'),$('.bankrecname'));
                getreceivename($('.bankrectel'),$('.bankrecname'));
                $('#bankamt'+ i).focus();
                //filltitlebankcur($('#bankcur' + i).val(),$('#bankcur' + i));
                //window.scrollTo(0, document.body.scrollHeight);


        }
        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
          $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });
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
        $(document).on('click','.btncontinue3,.btnready',function(e){
            e.preventDefault();
            var elem=$(this).text();
            var step=2;
            var mscp=0;
            if(elem=='រួចរាល់'){
                var q = confirm("Do you want to complete transaction?");
                if (!q) return;
                mscp=1;
            }else if(elem=='Goto Step3'){
                var q = confirm("Do you send to step3?");
                if (!q) return;
                step=3;
            }
            var id=$(this).data('id');
            var groupid=$(this).data('groupid');
            var url="{{ route('thaicashdraw.updatestep') }}";
            $.get(url,{step:step,mscp:mscp,id:id,groupid:groupid},function(data){
                if(data.error==false){
                    search_cashdraw(0);
                }else{
                    alert('you can not finish this transaction with empty money code');
                }
            })

        })
        $(document).on('change','#selbankname3',async function(e){
            e.preventDefault();
            //$('#btnwingbal').click();
            var cur=$('#exchangecur3').val();
            getbalwing($(this).val(),0,cur,fillbalance);
            var imagepath='';
            var sp = document.querySelector("#selbankname3");
            var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            var agenttypeid=sp.options[sp.selectedIndex].getAttribute('agenttypeid');
            var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');
            var maxamttransfer=sp.options[sp.selectedIndex].getAttribute('maxtransfer');
            var maxcuscharge=sp.options[sp.selectedIndex].getAttribute('maxcuscharge');
            var maxcashdraw=sp.options[sp.selectedIndex].getAttribute('maxcashdrawfee');
            var maxtransfer=sp.options[sp.selectedIndex].getAttribute('maxfee');

            $('#agenttype3').val(agenttype);
            $('#agenttype3').attr('title',agenttypeid);
            $('#customertype3').val(customertype);
            $('#wingmaxamt3').val(maxamttransfer);
            $('#wingmaxcuscharge3').val(maxcuscharge);
            $('#wingmaxfee3').val(maxcashdraw);
            $('#wingmaxtransferfee3').val(maxtransfer);

            if(customertype=='BANK'){
                // $('#qrcode_image').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
                // $('#fullqrcode').attr('src','{{ asset('public/qrcode') }}'+ '/' + imagepath);
                $('#rowqr').css('display','table-row');
            }else{
                await gettranname('#seltranname',agenttypeid)
                var sp = document.querySelector("#seltranname");
                var sign=sp.options[sp.selectedIndex].getAttribute('sign');
                var agent_logo=sp.options[sp.selectedIndex].getAttribute('logo');
                // get value from <option logo="xxx.png">
                var agent_logo = sp.options[sp.selectedIndex].getAttribute('logo');
                // check if logo exists
                if (agent_logo && agent_logo !== '') {
                    // build full path dynamically
                    document.getElementById('qrcode_image').src = "{{ asset(config('helper.asset_path').'/logo') }}/" + agent_logo;
                } else {
                    // fallback to default
                    document.getElementById('qrcode_image').src = "{{ asset(config('helper.asset_path').'/logo/noqr.png') }}";
                }
                $('#rowqr').css('display','table-row');
                //$('#rowqr').css('display','none');
            }
        })
         function gettranname(el,agenttype) {
            return new Promise((resolve, reject) => {
                $('body').addClass("wait");
                var url = "{{ route('thaicashdraw.getagenttranname') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: { agenttype: agenttype },
                    success: function (data) {
                        console.log(data)
                        if ($.isEmptyObject(data.error)) {
                            $(el).empty();

                            // $(el).append($("<option/>",{
                            //     value:'',
                            //     text:''
                            // }))

                            $.each(data['trannames'],function(i,item){
                                $(el).append($("<option/>",{
                                        value:item.id,
                                        text:item.name,
                                        sign:item.sign,
                                        is_tc:item.is_tc??0,
                                        logo: item.agenttype?.logo ?? ''
                                    }))

                            });

                            $('body').removeClass("wait");
                            resolve(data); // ✅ resolve when done
                        } else {
                            $('body').removeClass("wait");
                            alert(data.error);
                            reject(data.error);
                        }
                    },
                    error: function (xhr) {
                        $('body').removeClass("wait");
                        alert('Read Error.');
                        reject(xhr);
                    }
                });
            });
        }
        function getbalwing(cid,total,cur,callback)
      {
        //debugger;
        $('body').addClass("wait");
        $('#wingbalance').attr('title','');
                var d2=moment(new Date).format("YYYY-MMM-DD");
                var op='<=';
                var url="{{ route('closelist.summarypartnerlist') }}";
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {cid:cid,showdate:d2,op:op},
                success: function (data) {

                    if($.isEmptyObject(data.error)){
                        $('#wingbalance').attr('title',data.usd+';'+data.khr+';'+data.thb);
                        callback(total,'-');
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
      function fillbalance(total,sign)
      {
        //debugger;

        try{

            var bal=$('#wingbalance').attr('title').replace(/,/g, '');
            var balance=bal.split(';');
            var cur=$('#exchangecur3').val();
            var balnext=0;
            var balstart=0;
            var cur1='';
            if(sign=='+'){
                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balance[0])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balance[1])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balance[2])- parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }

            }else{
                if(cur=='USD'){
                    balnext=-1 * (parseFloat(balance[0])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[0]);
                    cur1=' USD';
                }else if(cur=='KHR'){
                    balnext=-1 * (parseFloat(balance[1])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[1]);
                    cur1=' KHR';
                }else if(cur=='THB'){
                    balnext=-1 * (parseFloat(balance[2])+ parseFloat(total));
                    balstart=-1 * parseFloat(balance[2]);
                    cur1=' THB';
                }
            }
            $('#wingbalancenext').val(formatNumber(balnext) + cur1);
            $('#wingbalance').val(formatNumber(balstart) + cur1);
            //if(balstart>0){
            //     $('#wingbalance').css('color','blue');
            // }else{
            //     $('#wingbalance').css('color','red');
            // }
            // if(balnext>0){
            //     $('#wingbalancenext').css('color','blue');
            // }else{
            //     $('#wingbalancenext').css('color','red');
            // }
        }catch{

        }

      }

        $(document).on('click','#btnwingbal',function(e){
                e.preventDefault();
                var total=0;
                if($('#txtmoneycode3').val()==''){
                    $("tr.item").each(function() {
                        total +=parseFloat($(this).find("input.txtwingamt").val().replace(/,/g, ''))+parseFloat($(this).find("input.txtwingfee").val().replace(/,/g, ''))
                    });
                }
                var cur=$('#exchangecur3').val();
                getbalwing($('#selbankname3').val(),total,cur,fillbalance);
        })
        $(document).on('click','#btnupdate3',function(e) {

            //var table = document.getElementById("tblcodelist");
            //var tbodyRowCount = table.tBodies[0].rows.length;
            // if(tbodyRowCount>0){
            //     var bankname=$('#selbankname3 option:selected').text();
            //     var sp = document.querySelector("#selbankname3");
            //     var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
            //     var agenttype=sp.options[sp.selectedIndex].getAttribute('agenttype');
            //     var userconnect=sp.options[sp.selectedIndex].getAttribute('userconnect');
            //     var userconnect3=userconnect.toString().split(',');
            //     if(!userconnect3.includes(docodeby)){
            //         alert(bankname + ' is not for you.')
            //         return;
            //     }
            // }
            var docodeby=$('#docodeby3').attr('title');
            $('body').addClass("wait");
            var totalfee=0;
            var codestr='';
            var foundwingcodeempty=false;
            var buyinfo=$('#thaicur3').attr('title');
            var btnsavetext=$(this).text();
            $("tr.item").each(function() {
                //debugger;
                var wingamt = $(this).find("input.txtwingamt").val();
                var wingcode= $(this).find("input.txtwingcode").val();
                var wingcur=$(this).find("td:eq(1)").text();
                var wingfee=$(this).find("input.txtwingfee").val().replace(/,/g,'');
                if(wingcode==''){
                    foundwingcodeempty=true;
                }
                totalfee+=parseFloat(wingfee);
                if(codestr==''){
                    codestr = wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;
                }else{
                    codestr +='<br>' + wingamt + ' ' + wingcur + '=' + wingcode + '=' + wingfee;
                }
            });
            if(foundwingcodeempty==true){
                $('body').removeClass("wait");
                alert('save not allow please check wing code again')
                return;
            }
            var formdata=new FormData(frmopenedit);
            formdata.append('moneycode3',codestr);
            formdata.append('partnerfee3',totalfee);
            formdata.append('partnerfee3',totalfee);
            formdata.append('buyinfo3',buyinfo);
            formdata.append('docodebyid3',docodeby);
            formdata.append('btnsavetext',btnsavetext);
            formdata.append('thaicur3',$('#thaicur3').val());
            formdata.append('exchangecur3',$('#selcurwing3 option:selected').text());
            formdata.append('exchangebuyinfo3',$('#thaicur3').attr('title'));
            var url="{{ route('thaicashdraw1.updatetransferinfo') }}"
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
                        var transfer_id=$('#transferid3').val();
                        del_userselectcashdraw2(transfer_id);
                        search_cashdraw(moresearch);
                        openedit(data['id'],$('#agenttype3').val(),-1,$('#groupid3').val());
                        // if(codestr!=''){
                        //     $('#btnwingbal').click();
                        // }

                        sendMessage();
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

        var ably = new Ably.Realtime('ij19Fw.YrH3Cg:H-ZTKXRF_d8UvWh7bwfd_cXfpTGvpu1_3TltUpz55cA'); //remember to pass your ably API key
        var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
        channel.subscribe('messageEvent', function(message) { // message this is message from channel
            // Handle incoming messages (create a message body div tag)
            console.log(message)
            const currentUser = "{{ Auth::user()->name }}"; // Server renders this per user
            const domainnameis="{{ config('helper.transfer_option') }}";
            if (message.data.sender !== currentUser) {
                if(message.data.customername==domainnameis){
                    console.log('run search_cashdraw function')
                    search_cashdraw(0);
                }
            }
        });
        async function sendMessage() {
            //var ably = new Ably.Realtime('oM-FXA.0iCetQ:XLfafSYaOaTfVjkISU703q3TDqU52ZjdZyxl_Xzf-LA'); //remember to pass your ably API key
            //var channel = ably.channels.get('chatting'); // here i create a channel or initialize the existing channel
            var message ='update thai info'; //get the message from input
            var name = 'thaidocode'; //get the sender name from input
            var sender = "{{ Auth::user()->name }}";
            var customername="{{ config('helper.transfer_option') }}";
            if (message !== '') { //if input message is not empty publish a message
                // Publish the message to the chat channel
                channel.publish('messageEvent', { name: name, text: message, sender: sender,customername:customername });
            }
        }
        $(document).on('click','#btnviewcode3',function(e){
            e.preventDefault();
            var id=$('#transferid3').val();
            var transferid3=$('#transferid3').val();
            var thaicurid3=$('#thaicurid3').val();
            var thaiamt3=$('#thaiamt3').val();
            var exchangeamount3=$('#exchangeamount3').val();
            var thaicur3=$('#thaicur3').val();
            var exchangecur3=$('#selcurwing3 option:selected').text();
            var exchangerate3=$('#exchangerate3').val();
            var exchangerateinfo3=$('#exchangerateinfo3').val();
            var exchangebuyinfo3=$('#thaicur3').attr('title');
            var exchangesaleinfo3=$('#exchangesaleinfo3').val();
            var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw1/printcode?id='+id+'&transferid3='+transferid3+'&thaicurid3='+thaicurid3+
            '&thaiamt3='+thaiamt3+'&exchangeamount3='+exchangeamount3+'&thaicur3='+thaicur3+'&exchangecur3='+exchangecur3+'&exchangerate3='+exchangerate3+
            '&exchangerateinfo3='+exchangerateinfo3+'&exchangebuyinfo3='+exchangebuyinfo3+'&exchangesaleinfo3='+exchangesaleinfo3, '_blank');
                redirectWindow.location;
        })
        $(document).on('click','#btnnotready3',function(e){
            var q = confirm("Do you want to reset transaction?");
            if (!q) return;
            var url="{{ route('thaicashdraw1.notyetready') }}";
            var id=$('#transferid3').val();
            var groupid=$('#groupid3').val();
            var formdata=new FormData();
            formdata.append('id',id);
            formdata.append('groupid',groupid);

            $.ajax({
                async: true,
                type: 'POST',
                contentType: false,
                processData: false,
                url: url,
                data:formdata,
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#dowingcodemodalnew').modal('hide');
                        del_userselectcashdraw2(id);
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
        })

        function del_userselectcashdraw2(transfer_id){
            var url="{{ route('thaicashdraw1.delcashdrawaction2') }}";
            $.post(url,{id:transfer_id},function(data){})
        }
        $(document).on('click','#btnready3',function(e){
            // var id=$('#transferid3').val();
            // var groupid=$('#groupid3').val();
            if($('#txtmoneycode3').val()==''){
                alert('mission not yet completed \n moneycode not yet fill please check!')
                return;
            }
            var buyinfo=$('#thaicur3').attr('title');
            var formdata=new FormData(frmopenedit);
            formdata.append('buyinfo3',buyinfo);
            formdata.append('thaicur3',$('#thaicur3').val());
            formdata.append('exchangecur3',$('#selcurwing3 option:selected').text());
            formdata.append('exchangebuyinfo3',$('#thaicur3').attr('title'));
            var url="{{ route('thaicashdraw1.updatetransferready') }}";
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
                        $('#dowingcodemodalnew').modal('hide');
                        var transfer_id=$('#transferid3').val();
                        del_userselectcashdraw2(transfer_id);
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

        })

        $(document).on('click','#btnsave,#btnsavestep3,#btnupdate',function(e){
            e.preventDefault();
            var leftamt=$('#leftamt').val().replace(/,/g, '');
            if(leftamt!=0){
                alert('លុយបើកនៅសល់សូមត្រួតពិនិត្យឡើងវិញ។')
                return;
            }
            var elem=$(this).attr('id');
            func_savecashdraw(elem);

        })
        function func_savecashdraw(elem)
        {
            var isgetcode=1;
            for(i=0; i<$('.bankid').length; i++) {
                var userdocode=$('.btndowingcode').eq(i).attr('title');
                var userconnect=$('.userconnect').eq(i).val().split(',');
                if(userdocode!='' && userdocode!='null'){
                    if(!userconnect.includes(userdocode)){
                        alert('selected bank not match the user generate code')
                        return;
                    }
                }else{
                    isgetcode=0;
                }
            }


            var mscp=0;
            var step=2;
            if(elem=="btnsave"){
                mscp=1;
            }else if(elem=="btnsavestep3"){
                step=3;
            }else if(elem=="btnupdate"){

            }

            if(mscp==1){

                    var found=0;
                    var custype='';
                    var agenttype='';
                    $('.wingcodeinfoby').each(function(i,e){
                        //debugger;
                        custype=$('.customertype').eq(i).val();
                        agenttype=$('.agenttype').eq(i).val();
                        if(custype=='BANK'){
                            if($(this).val()==''){
                                found=1;
                            }
                        }else if(custype=='AGENT'){
                            if(agenttype!='Cash'){
                                if($(this).val()==''){
                                    found=1;
                                }
                            }
                        }

                    })
                    if(found==1){
                        $('body').removeClass("wait");
                        alert('you can not finish this transacton with empty money code.');
                        return;
                    }

            }
            $('body').addClass("wait");
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
            formdata.append('isgetcode',isgetcode);
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
                        var transfer_id=$('#smsprocess_id').val();
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
        $(document).on('dblclick', '#body_notyetcomplete tr.rowclick', function(e){
            e.preventDefault();
            var rowind=$(this).index();
            var row=$(this).closest('tr');
            id=row.find("td:eq(1)").text();
            groupid=row.find("td:eq(3)").text();
            agenttype=row.find("td:eq(14)").text();
            problem=row.find("td:eq(5)").attr('title');
            if(problem=='1'){
                alert('this transaction have problem please contact to Administrator.')
                return;
             }
            openedit(id,agenttype,rowind,groupid);

        })
        $(document).on('dblclick', '#body_complete tr.rowclick', function(e){
            e.preventDefault();
            var rowind=$(this).index();
            var row=$(this).closest('tr');
            id=row.find("td:eq(1)").text();
            groupid=row.find("td:eq(3)").text();
            agenttype=row.find("td:eq(14)").text();
            openedit(id,agenttype,rowind,groupid);
        })

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
        // function calcuexchange3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate) {
        //     var luy = $(txtsale).val().replace(/,/g, '');
        //     var r = $(txtrate).val().replace(/,/g, '');
        //     var m1 = $(lblsale).attr('title').split(";");
        //     var m2 = $(lblbuy).attr('title').split(";");
        //     if (m1[4] == '1') { //if maincur=true
        //         if (m2[3] == '/') {//if operator=/
        //             $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
        //         } else {
        //             $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
        //         }
        //     } else {
        //         if (m2[4] == '1') {
        //             if (m1[3] == '/') {
        //                 $(txtbuy).val(formatNumber(parseFloat(luy / r).toFixed(2)));
        //             } else {
        //                 $(txtbuy).val(formatNumber(parseFloat(luy * r).toFixed(2)));
        //             }
        //         } else {
        //             calcuexchangeproduct3(lblbuy,txtbuy,txtrate,lblsale,txtsale,txtsign,lblrate);
        //         }
        //     }
        // }
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
        //*****show rate by id*****
        function getcurrencybyidlocalstorage3(id,el,el1,callback)
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
                    //debugger;
                    $(el).val(c.id);
                    $(el).attr('title', c.id + ';' + parseFloat(c.buy_thai) + ';' + parseFloat(c.sale_thai) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    $(el1).val( c.id + ';' + parseFloat(c.buy_thai) + ';' + parseFloat(c.sale_thai) + ';' + c.optsign + ';' + c.ismain + ';' + c.isfn + ';' + c.shortcut);
                    getrate3(callback);
                }
            })
        }
        function getrate3(callback) {
            //debugger;
            $('#exchangerate3').val('');
            $('#exchangeamount3').val('');
            $('#exchangerate3').attr('title', '');
            $('#exchangerateinfo3').val('');

            var m = $('#thaicur3').attr('title').split(";");
            var p = $('#selcurwing3').attr('title').split(";");
            if(m=='' || p==''){
                return;
            }
            //check if the save curname
            //debugger
            if (m[6] == p[6]) {
                $('#exchangerate3').val(1);
                calcuexchange3(callback);
                return;
            }
            //check if product exchange product
            if (m[4] == '0') {
                if (p[4] == '0') {
                    runproductrate3fast($('#thaicur3').val(),$('#exchangecur3').val(),callback);
                    return;
                }
            }

            if (m[4] == '1') {//if maincur=true
                $('#exchangerate3').val(formatNumber(parseFloat(p[2])));//get rate p sale
            } else {
                //$('#exchangerate3').val(formatNumber(parseFloat(m[1])));//get rate m buy
                $('#exchangerate3').val(formatNumber(parseFloat(p[1])));//get rate m buy
            }
            $('#exchangerate3').attr('title',$('#exchangerate3').val());
            $('#exchangerateinfo3').val($('#exchangerate3').val());
            calcuexchange3(callback);
        }
        function calcuexchangeproduct3(callback) {
            //debugger;
            var luy = $('#thaiamt3').val().replace(/,/g, '');
            var r = $('#exchangerate3').val().replace(/,/g, '');
            var rs = $('#exchangerate3').attr('title').split(";");

            if (rs[2] == '*') {
                //$('#exchangeamount3').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('#selcurwing3 option:selected').text());
            } else {
                //$('#exchangeamount3').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('#selcurwing3 option:selected').text());
            }
            $('#exchangeamount3').val(formatNumber(examt));
            $('#exchangeamount3').attr('title', $('#exchangeamount3').val());
            $('#totalamt3').val($('#exchangeamount3').val());
            callback();
        }
        function calcuexchange3(callback) {
            //debugger;
            var luy = $('#thaiamt3').val().replace(/,/g, '');
            var r = $('#exchangerate3').val().replace(/,/g, '');
            var m1 = $('#thaicur3').attr('title').split(";");
            var m2 = $('#selcurwing3').attr('title').split(";");
            if (m1[4] == '1') { //if maincur=true
                if (m2[3] == '/') {//if operator=/
                    //$('#exchangeamount3').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                    examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('#selcurwing3 option:selected').text());
                } else {
                    //$('#exchangeamount3').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                    examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('#selcurwing3 option:selected').text());
                }
                $('#exchangeamount3').val(formatNumber(examt));
                $('#exchangeamount3').attr('title', $('#exchangeamount3').val());
                $('#totalamt3').val($('#exchangeamount3').val());
                callback();
            } else {
                if (m2[4] == '1') {
                    if (m1[3] == '/') {
                        //$('#exchangeamount3').val(formatNumber(parseFloat(luy / r).toFixed(2)));
                        examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('#selcurwing3 option:selected').text());
                    } else {
                        //$('#exchangeamount3').val(formatNumber(parseFloat(luy * r).toFixed(2)));
                        examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('#selcurwing3 option:selected').text());
                    }
                    $('#exchangeamount3').val(formatNumber(examt));
                    $('#exchangeamount3').attr('title', $('#exchangeamount3').val());
                    $('#totalamt3').val($('#exchangeamount3').val());
                    callback();
                } else {
                    calcuexchangeproduct3(callback);
                }
            }

        }
        // function runproductrate3(buycur,salecur) {
        //     //debugger
        //     var url="{{ route('getproductrate') }}";
        //     var curname = '';
        //     curname = buycur + '-' + salecur;
        //     $.get(url,{curname:curname},function(data){
        //         if(data.success){
        //             //debugger;
        //             $('#exchangerate3').val(formatNumber(parseFloat(data['pr']['rate'])));
        //             $('#exchangerate3').attr('title', data['pr']['pshortcut'] + ';' +  data['pr']['rate'] + ';' +  data['pr']['operator']);
        //             calcuexchangeproduct3();
        //         }else{
        //             $('#exchangerate3').val('');
        //             $('#exchangerate3').attr('title','');
        //         }

        //     })

        //     $('#exchangerateinfo3').val($('#exchangerate3').attr('title'));

        // }
        function runproductrate3fast(buycur,salecur,callback)
        {
            var curname = '';
            curname = buycur + '-' + salecur;
            var currencyproductlist;
            if(localStorage.getItem("currencyproductlist")==null){
            currencyproductlist=[];
            }else{
            currencyproductlist=JSON.parse(localStorage.getItem("currencyproductlist"));
            }
            $('#exchangerate3').val('');
            $('#exchangerate3').attr('title','');
            currencyproductlist.forEach(function(c){
            //debugger;
            if(c.pshortcut==curname){
                $('#exchangerate3').val(formatNumber(parseFloat(c.thai_rate)));
                    $('#exchangerate3').attr('title', c.pshortcut + ';' +  c.thai_rate + ';' +  c.operator);
                    calcuexchangeproduct3(callback);
                }
            })
            $('#exchangerateinfo3').val($('#exchangerate3').attr('title'));
        }
        //*****end show rate by id*****
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
    function bongkotchomnuen(amt,cur)
    {
        //debugger;
        var newamt=0;
        if(cur=='KHR'){
            let amt1=amt/100;
            let arramt1=amt1.toString().split(".");
            let intamt=arramt1[0];
             newamt=parseFloat(intamt)*100;

        }else if(cur=='USD'){
            let arramt1=amt.toString().split(".");
            let intamt=arramt1[0];
            //let float_amt=arramt1[1];
            let float_amt = arramt1[1] ? arramt1[1].padEnd(2, '0').slice(0, 2) : "00"; // Ensures two digits
            if(float_amt<=60){
                 newamt=intamt;
            }else{
                 newamt=parseFloat(intamt)+1;
            }
        }
        return newamt;
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
        $('.bankamtexchange').eq(ind).attr('title', $('.bankamtexchange').eq(ind).val());
      }
    function calcuexchange(ind) {

        //debugger;
          var luy = $('.bankamt').eq(ind).val().replace(/,/g, '');
          var r = $('.bankrate').eq(ind).val().replace(/,/g, '');
          var m1 = $('.bankcur').eq(ind).attr('title').split(";");
          var m2 = $('.bankcurexchange').eq(ind).attr('title').split(";");
          if (m1[4] == '1') { //if maincur=true
              if (m2[3] == '/') {//if operator=/
                  //$('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                  examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('#selcurwing3 option:selected').text());
              } else {
                  //$('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                  examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('#selcurwing3 option:selected').text());
              }
              $('.bankamtexchange').eq(ind).val(formatNumber(examt));
          } else {
              if (m2[4] == '1') {
                  if (m1[3] == '/') {
                      //$('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy / r).toFixed(2)));
                      examt=bongkotchomnuen(parseFloat(luy / r).toFixed(2),$('#selcurwing3 option:selected').text());
                  } else {
                      //$('.bankamtexchange').eq(ind).val(formatNumber(parseFloat(luy * r).toFixed(2)));
                      examt=bongkotchomnuen(parseFloat(luy * r).toFixed(2),$('#selcurwing3 option:selected').text());
                  }
                  $('.bankamtexchange').eq(ind).val(formatNumber(examt));
              } else {
                  calcuexchangeproduct(ind);
              }
          }
          $('.bankamtexchange').eq(ind).attr('title', $('.bankamtexchange').eq(ind).val());
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
      $("#tableSearch").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#tbl_complete tr").each(function(index) {
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
            $("#tbl_notyetcomplete tr").each(function(index) {
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

    })
    function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }

    </script>
@endsection
