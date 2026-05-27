@extends('master')
@section('title') Transfer List @endsection
@section('css')
    <style type="text/css">
          body.wait, body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;font-weight:bold;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:white;font-weight:bold;}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;font-weight:bold;}
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
       .txtexchange{
        font-weight:bold;
        font-size:22px;
        text-align:right;
       }
       .cgr{
        background-color:aquamarine;
       }
       /* td{
        border-style:none;
       } */
       #tbl_transferlist .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_transferlist td{
        padding:0px 5px;
    }
    #tbl_transferlist th{
        padding:3px;
    }
    #tblsearchmore td{
        border-style:none;
    }
    .delrecord{
        color:red;
    }
    .mybtn{
        border:1px solid black;
        padding:0px 8px;
    }
    .mybtn:hover{
        background-color:gold;
    }
    .dropdown-menu li > a:hover{
        background-color:rgb(21, 40, 214);
        color:white;
    }
    .dropdown-menu li{
        padding:0px;
    }
    .tableFixHead{ overflow: auto;border:1px dotted green;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
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
    <div class="row" style="background-color:gainsboro;margin-top:-20px;">

        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="table">
                    <tr class="kh16">
                        <th colspan=2 style="border-style:none;">
                          <div class="form-check">
                            <label class="form-check-label kh16">
                              <input class="form-check-input kh16" type="checkbox" name="ckinputdate" id="ckinputdate">Created Date
                            </label>
                          </div>
                        </th>

                        <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                        <th style="border-style:none;">បុគ្គលិក</th>
                        <th style="border-style:none;">រូបិយប័ណ្ណ</th>
                        <th style="border-style:none;">ប្រតិបត្តិការណ៏</th>
                        <th colspan=2 style="border-style:none;">
                          <div class="form-check">
                            <label class="form-check-label kh16">
                              <input class="form-check-input kh16" type="checkbox" name="ckisbank" id="ckisbank">ធនាគា
                            </label>
                          </div>
                        </th>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-style:none;width:120px;">
                            <div class="input-group" style="width:120px;">
                                <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:120px;height:35px;background-color:silver;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:120px;">
                            <div class="input-group" style="width:120px;">
                                <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:120px;height:35px;background-color:silver;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:300px;">
                            <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;height:35px;" class="form-select kh16-b" required>
                                <option value="">ទាំងអស់</option>
                                @foreach ($partners as $p)
                                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                                @if(Auth::user()->role->name=='Admin')
                                  @foreach ($customers as $c)
                                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                                  @endforeach
                                @endif
                            </select>
                        </td>
                        <td style="border-style:none;padding:0px;width:200px;">
                            <select class="form-select kh16-b" name="seluser" id="seluser" style="width:200px;height:35px;">
                                <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id??'' }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;padding:0px;width:80px;">
                            <select class="form-select kh16-b" name="selcur" id="selcur" style="width:80px;height:35px;">
                                <option value="">All</option>
                                @foreach ($currencies as $c)
                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;padding:0px;width:100px;">
                            <select class="form-select kh16-b" name="seltran" id="seltran" style="width:100px;height:35px;">
                                <option value="2">All</option>
                                <option value="1">ផ្ញើ</option>
                                <option value="-1">ទទួល</option>
                                <option value="0" style="color:red;">បានលុប</option>
                            </select>
                        </td>
                        <td style="padding:0px 0px 0px 5px;border-style:none;">
                            <button class="mybtn kh12-b" style="height:30px;" id="btnsearch">Search</button>
                            <button class="mybtn kh12-b" style="height:30px;" id="btnprintreport">Print</button>

                            <button class="mybtn kh12-b" style="height:30px;" id="btnsearchmore" data-bs-toggle="collapse" data-bs-target="#searchmore">More</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="searchmore" class="collapse" style="margin-top:-15px;margin-bottom:10px;">
            <div class="row">
                <div class="col-lg-3">
                    <label class="kh16-b" for="searchby">ស្វែងរកតាម</label>
                    <select name="selsearchby" id="selsearchby" class="form-select kh16-b" style="height:35px;width:100%;">
                        <option value="tel">លេខទូរស័ព្ទ</option>
                        <option value="amt">ចំនួនទឹកប្រាក់</option>
                    </select>
                </div>
                <div class="col-lg-3" id="col2">
                    <label class="kh16-b" for="stel">លេខទូរស័ព្ទ</label>
                    <input type="text" id="txtsearchbytel" class="form-control kh16-b" style="width:100%;height:35px;">
                </div>
                <div class="col-lg-3" id="col3" style="display:none;">
                    <label class="kh16-b" for="samt1">ពីចំនួន</label>
                    <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:35px;">
                </div>
                <div class="col-lg-3" id="col4" style="display:none;">
                    <label class="kh16-b" for="samt2">ដល់ចំនួន</label>
                    <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:35px;">
                </div>
                <div class="col-lg-3">

                  <button id="btnsearch2" class="btn btn-info kh16-b" style="margin-top:25px;height:35px;">Search</button>
                </div>
            </div>

        </div>
    </div>
    <div class="row">

        <div class="tableFixHead" style="padding:0px;margin:0px;">
            <table id="tbl_transferlist" class="table table-bordered table-hover tbl_transferlist" style="table-layout:fixed;">
                <thead style="text-align:center;" class="kh16">
                    <th style="width:60px;">No</th>
                    <th style="width:150px;">TID</th>
                    <th style="width:100px;">ថ្ងៃទី</th>
                    <th style="width:100px;">ម៉ោង</th>
                    <th style="width:280px;">ដៃគូពាក់ព័ន្ធ</th>
                    <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                    <th style="width:100px;">សេវ៉ាវេរ</th>
                    <th style="width:100px;">សេវ៉ាដៃគូ</th>
                    <th style="width:130px;">អ្នកកត់ត្រា</th>
                    <th style="width:200px;">លេខអ្នកទទួល</th>
                    <th style="width:200px;">ឈ្មោះអ្នកទទួល</th>
                    <th style="width:200px;">លេខអ្នកផ្ញើ</th>
                    <th style="width:200px;">ឈ្មោះអ្នកផ្ញើ</th>
                    <th style="width:700px;">ផ្សេងៗ</th>
                </thead>
                <tbody id="body_transaction" style="">
                    @foreach ($transfers as $k => $tr)
                        <tr>
                            <td style="text-align:center;padding:0px;" class="kh12"> {{ ++$k }}</td>
                            <td style="text-align:center;padding:0px;" class="kh12">
                                <div class="dropdown">
                                    <button style="width:150px;@if(str_contains($tr->action,'u')) background-color:green;color:white; @endif" type="button" class="mybtn dropdown-toggle kh12" data-bs-toggle="dropdown">
                                    {{ $tr->id }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-cashdraw_id="{{ $tr->cashdraw_id }}">Print</a></li>
                                        @if(str_contains($tr->action,'u'))
                                            <li><a href="{{ route('usercapital.updatetransactiongroup',['id'=>$tr->id,'ref_group_id'=>$tr->ref_group_id,'user_id'=>$tr->user_id]) }}" class="dropdown-item kh16-b btnupdate" target="_blank">Edit</a></li>
                                        @endif
                                        @if(!$tr->ref_group_id)
                                            @if(str_contains($tr->action,'d'))
                                                <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                                            @endif
                                        @endif
                                        @if($tr->ref_group_id)
                                            <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                            <td class="kh16">{{ date('d-m-y',strtotime($tr->dd)) }}</td>
                            <td class="kh16" style="padding:0px;">
                                <input type="text" style="border-style:none;width:100px;text-align:center;background-color:inherit;" readonly value="{{ $tr->tt }}">
                            </td>

                            <td class="kh16">
                                @if($tr->ref_group_id)
                                    <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id,'showdelbuton'=>false]) }}" target="_blank" style="@if($tr->trancode==1) background-color:blue;color:white; @endif">{{ $tr->tranname  . ' ' . $tr->partner->name }}</a>
                                @else
                                    <span style="@if($tr->trancode==1 && $tr->cuscharge<=0) background-color:red;color:white; @elseif($tr->trancode==1 && $tr->cuscharge>0) background-color:yellow; @endif">
                                        {{ $tr->tranname  . ' ' . $tr->partner->name }}
                                    </span>
                                @endif
                            </td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
                            <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->fee) .$tr->feecurrency->sk }}</td>
                            <td class="kh16">{{ $tr->user->name }}</td>
                            <td class="kh16" style="text-align:right;">{{ $tr->rectel }}</td>
                            <td class="kh16">{{ $tr->recname }}</td>
                            <td class="kh16" style="text-align:right;">{{ $tr->sendertel }}</td>
                            <td class="kh16">{{ $tr->sendername }}</td>
                            <td class="kh16">{{ $tr->note }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

   @include('moneytransfers.showrelatemodal')
@endsection
@section('script')

    <script type="text/javascript">
        setheighttablefixhead(205);
        $(window).resize(function() {
            setheighttablefixhead(205);
        });

        function setheighttablefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
            }
        }
        $('#searchmore').on('hidden.bs.collapse', function () {
            //console.log("Closed")
            setheighttablefixhead(205);
        });
        $('#searchmore').on('shown.bs.collapse', function () {
            //console.log("Closed")
            setheighttablefixhead(260);
        });
    $(document).ready(function () {
        var currentUserId=$('#loginid').val();
        var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
        $('#selcustomer').select2();
        $('#seluser').select2();
        $('#h1_title').text('របាយការណ៏ផ្ទេរប្រាក់');
        var today=new Date();
            $('#d1,#d2').datetimepicker({
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
        var cleave = new Cleave('#txtsearchbyamt2', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#txtsearchbytel', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        $(document).on('click','#tbl_transferlist td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

        //  $('#tbl_transferlist').on('dblclick', '.rowclick', function(event) {
        //     var ind=$(this).index();
        //     var row=$(this).closest('tr');
        //     var id=row.find("td:eq(1)").text();
        //     var refnum=row.find("td:eq(13)").text();
        //     var cashdrawcode=row.find("td:eq(14)").text();
        //     if(refnum!='' || cashdrawcode !=''){
        //         return;
        //     }
        //     var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/edit?id='+id, '_blank');
        //     redirectWindow.location;
		// });
        $(document).on('click','.showrelate',function(e){
            e.preventDefault();
            var refnum=$(this).data('refnum');

            $('#showrelatemodal').modal('show');
            var url="{{ route('moneytransfer.showrelate_refnumber') }}";
            $.get(url,{refnum:refnum},function(data){
                //console.log(data);
                var output='';
                var k=0;
                for(var i=0;i<data['transfers'].length;i++){
                    k+=1;
                    if(data['tablename']=='transfer'){
                      output=`
                              <tr class="kh16-b">
                                  <td>លរ</td>
                                  <td>TID</td>
                                  <td>ថ្ងៃទី</td>
                                  <td>ម៉ោង</td>
                                  <td>អ្នកកត់ត្រា</td>
                                  <td>ប្រតិបត្តិការណ៏</td>
                                  <td>ឈ្មោះដៃគូ</td>
                              </tr>
                              <tr>
                                  <td>${k}</td>
                                  <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                  <td> ${ moment(data['transfers'][i].dd).format("DD-MM-YYYY") }</td>
                                  <td>${data['transfers'][i].tt}</td>
                                  <td>${data['transfers'][i].user.name}</td>
                                  <td>${data['transfers'][i].tranname}</td>
                                  <td>${data['transfers'][i].partner.name}</td>
                              </tr>

                              <tr class="kh16-b">
                                  <td></td>
                                  <td>ចំនួនទឹកប្រាក់</td>
                                  <td>សេវ៉ាវេ</td>
                                  <td>សេវ៉ាដៃគូ</td>
                                  <td colspan=2>ព៌តមានអតិថិជន</td>
                                  <td>ផ្សេងៗ</td>

                              </tr>
                              <tr>
                                  <td></td>
                                  <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                  <td>${formatNumber(data['transfers'][i].cuscharge) + data['transfers'][i].cuschargecur.shortcut}</td>
                                  <td>${formatNumber(data['transfers'][i].fee) + data['transfers'][i].currency.shortcut}</td>
                                  <td colspan=2>${data['transfers'][i].rectel??'' + ' ' + data['transfers'][i].recname??''}</td>
                                  <td>${data['transfers'][i].note??''}</td>
                              </tr>
                              `;

                    }else if(data['tablename']=='cashdraw'){
                      output=`
                            <tr class="kh16-b">
                                <td>លរ</td>
                                <td>ID</td>
                                <td>ថ្ងៃបើក</td>
                                <td>ម៉ោងបើក</td>
                                <td>អ្នកកត់ត្រា</td>
                                <td>ប្រភេទទូទាត់</td>
                                <td>ឈ្មោះដៃគូ</td>
                            </tr>
                            <tr>
                                <td>${k}</td>
                                <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                <td> ${ moment(data['transfers'][i].opdate).format("DD-MM-YYYY") }</td>
                                <td>${data['transfers'][i].optime}</td>
                                <td>${data['transfers'][i].user.name}</td>
                                <td>${data['transfers'][i].paymethod}</td>
                                <td>${data['transfers'][i].frompartner.name}</td>
                            </tr>

                            <tr class="kh16-b">
                                <td></td>
                                <td>ចំនួនទឹកប្រាក់</td>
                                <td>កាត់សេវ៉ា</td>
                                <td colspan=2>ព៌តមានអ្នកបើកវេរ</td>
                                <td colspan=2>ផ្សេងៗ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                <td>${formatNumber(data['transfers'][i].customer_charge) + data['transfers'][i].currency.shortcut}</td>
                                <td colspan=2>${data['transfers'][i].receive_tel + ' ' + data['transfers'][i].receive_name??''}</td>
                                <td colspan=2>${data['transfers'][i].note??'' + ' ' + data['transfers'][i].other??''}</td>
                            </tr>
                            `;
                    }else if(data['tablename']=='usercapital'){
                      output=`
                            <tr class="kh16-b">
                                <td>លរ</td>
                                <td>ID</td>
                                <td>ថ្ងៃទី</td>
                                <td>ម៉ោង</td>
                                <td>អ្នកកត់ត្រា</td>
                                <td>ពាក់ព័ន្ធបុគ្គលិក</td>
                                <td>ប្រតិបត្តិការណ៏</td>
                            </tr>
                            <tr>
                                <td>${k}</td>
                                <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                <td> ${ moment(data['transfers'][i].trandate).format("DD-MM-YYYY") }</td>
                                <td>${data['transfers'][i].trantime}</td>
                                <td>${data['transfers'][i].user.name}</td>
                                <td>${data['transfers'][i].useraffect.name}</td>
                                <td>${data['transfers'][i].tranname}</td>
                            </tr>

                            <tr class="kh16-b">
                                <td></td>
                                <td>ចំនួនទឹកប្រាក់</td>

                                <td colspan=5>ផ្សេងៗ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                <td colspan=2>${data['transfers'][i].note??''}</td>
                            </tr>
                            `;
                    }
                }
                $('#tbody_ref_num').empty().html(output);
            })
        })
        $(document).on('change','#selsearchby',function(e){
            e.preventDefault();
            var searchby=$(this).val();
            if(searchby=='tel'){
                $('#col2').css('display','block');
                $('#col3').css('display','none');
                $('#col4').css('display','none');

            }else if(searchby=='amt'){
                $('#col2').css('display','none');
                $('#col3').css('display','block');
                $('#col4').css('display','block');
            }
        })
        $(document).on('click','.btnprint',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            printtransfers(id)
        })
        function printtransfers(tr_id,hasexchange,hasbankpayment){

                var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/print?tr_id='+tr_id , '_blank');
                redirectWindow.location;
        }
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            searchmore=0;
            SearchTransfer(0);
        })
        $('#btnprintreport').click(function(e){
                e.preventDefault();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var partner=$('#selcustomer').val();
                var user=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var partnername=$('#selcustomer option:selected').text();
                var cur=$('#selcur').val();
                var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
                var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
                var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
                var searchby=$('#selsearchby').val();
                var tran=$('#seltran').val();
                var searchbyinputdate = document.getElementById("ckinputdate").checked;
                var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/search?user='+user+'&d1='+d1+'&d2='+d2+'&partner='+partner+'&cur='+cur+'&isprint='+1+'&username='+username+'&tran='+tran+'&searchby='+searchby+'&tel='+tel+'&amt1='+amt1+'&amt2='+amt2+'&searchmore='+searchmore+'&searchbyinputdate='+searchbyinputdate+'&partnername='+partnername, '_blank');
                redirectWindow.location;
            })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
            searchmore=1;
            SearchTransfer(1);
        })
        $(document).on('change','#selcustomer,#seluser,#selcur,#seltran',function(e){
            e.preventDefault()
            searchmore=0;
            SearchTransfer(0);
        })
        var searchmore=0;
        function SearchTransfer(searchmore)
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var user=$('#seluser').val();
            var cur=$('#selcur').val();
            var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
            var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
            var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
            var searchby=$('#selsearchby').val();
            var tran=$('#seltran').val();
            var searchbyinputdate = document.getElementById("ckinputdate").checked;
            var selbank = document.getElementById("ckisbank").checked;
            var url="{{ route('moneytransfer.search') }}";
            $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {d1:d1,d2:d2,partner:partner,user:user,cur:cur,tran:tran,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,searchmore:searchmore,searchbyinputdate:searchbyinputdate,selbank:selbank},
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#body_transaction').empty().html(data);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })

        }
        $(document).on('click','.btndeltransfer',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            if(!isAdmin){
                if (!hasPermission(currentUserId, '1.3.1')) {
                alert('you have no permission to delete this transaction')
                return;
                }
            }
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
                        url: "{{ route('moneytransfer.delete') }}",
                        data: { id:id },
                        success: function (data) {
                            //console.log(data);
                            if (data.success === true) {
                                //location.reload();
                                SearchTransfer(searchmore);
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
        $(document).on('keydown','#txtsearchbyamt1,#txtsearchbytel,#txtsearchbyamt2',function(e){

            if(e.keyCode==13){
                searchmore=1;
                SearchTransfer(1);
            }
        })
        $(document).on('click','.btndelete',function(e){
                e.preventDefault();
                var invid=$(this).data('id');

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
                            url: "{{ route('moneytransfer.delete') }}",
                            data: { id:invid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    SearchTransfer(searchmore);
                                    //location.reload();
                                    //$('#btnsearch').click();
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
    })



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function hasPermission(userId, code) {
            let permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
            return permusers.some(item => item.userid == userId && item.code == code);
        }

    </script>
@endsection
