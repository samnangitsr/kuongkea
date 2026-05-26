@extends('master')
@section('title') ExchangeListsnew @endsection
@section('css')
<link href="{{ asset('public/admin') }} /assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" />
    <style type="text/css">
      body.wait, body.wait *{
			cursor: wait !important;
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
            .kh12{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
       .tableFixHead{ overflow: auto;background-color:lightgray;}
       .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
        .tableFixHead1{ overflow: auto;background-color:rgb(209, 224, 125);}
       .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:rgb(185, 238, 124) }
    .tblexchangelist .clickedrow td{
        background-color: #caaf8f;
    }
    .tblexchangelist .clickedrow td input{
        background-color: #caaf8f;
    }
    .tblexchangelist td{
        padding:2px;
    }
    .tblexchangelist th{
        padding:2px;
    }
    .tbl_mainlist .clickedrow td{
        background-color: #6DD8B4FF;
    }
    .tbl_mainlist .clickedrow td input{
        background-color: #6DD8B4FF;
    }
    .tbl_mainlist td{
        padding:2px;
    }
    .tbl_mainlist th{
        padding:2px;
    }
    .bgred{
        background-color:red;
    }
    .mybtn{
        border:1px solid black;
        color:blue;
        padding:0px 5px;
    }
    .mybtn:hover{
        background-color:blue;
        color:white;
    }
     .dropdown-menu li > a:hover{
        background-color:rgb(21, 40, 214);
        color:white;
    }
    .dropdown-menu li{
        padding:0px;
        border-bottom:1px dotted black;
    }
    #tblgolddeposit td{
        border-style:none;
    }
     .buttonstyle{
        border-style:none;
     }
    .buttonstyle:hover{
        background-color:rgb(239, 241, 97);
    }
    </style>

@endsection
@php
    function phpformatnumber($num)
    {
        if (!is_numeric($num)) {
            return $num;
        }

        $num = (string)$num;
        $dc = 0;

        if (strpos($num, '.') !== false) {
            $decimals = explode('.', $num)[1];
            // Count actual meaningful decimals (but max 4)
            $dc = min(strlen(rtrim($decimals, '0')), 4);
        }

        return number_format((float)$num, $dc, '.', ',');
    }


@endphp
@section('content')
    <div class="row" style="padding:0px;margin-top:-10px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
        <div style="margin-bottom:10px;">
            <table>
                <tr>
                    <td class="kh16-b" style="width:40px;">គិតពី</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td class="kh16-b" style="width:40px;padding-left:10px;">ដល់</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>

                    <td class="kh16-b" style="width:85px;padding-left:10px;">អ្នកកត់ត្រា</td>
                    <td style="border-style:none;padding:0px;width:200px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="width:200px;">
                            <option value="">ទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td style="">
                        <button id="btnsearch" class="mybtn kh14-b" style="height:25px;">Search</button>

                    </td>

                </tr>
            </table>
        </div>
        <div id="row_display">
            <div class="row" style="margin:0px;padding:0px;">
                <div class="col-lg-12" style="margin:0px;padding:0px;">
                    <div class="tableFixHead" style="padding:0px;margin:0px;">
                        <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
                            <thead style="text-align:center;">
                                <th style="width:65px;">លរ</th>
                                <th style="width:100px;">អតិថិជន</th>
                                <th style="width:120px;">លេខទូរស័ព្ទ</th>
                                <th style="width:100px;">ថ្ងៃទិញលក់</th>
                                <th style="width:80px;">ម៉ោង</th>
                                <th style="width:100px;">រូបិយប័ណ្ណ</th>
                                <th style="width:150px;">ទំនិញ</th>
                                <th style="width:80px;">ទឹក</th>
                                <th style="width:150px;">មាសល្អ</th>
                                <th style="width:100px;">អត្រា</th>
                                <th style="width:150px;">ទឹកប្រាក់</th>


                                <th style="width:150px;">អ្នកកត់ត្រា</th>

                                <th style="width:180px;">GroupId</th>
                                <th style="width:500px;">សំគាល់</th>

                            </thead>
                            <tbody id="bodyexchangelist">
                                @php

                                    $total_product=0;
                                    $total_gold=0;
                                    $total_amount=0;



                                    $total_product2=0;
                                    $total_gold2=0;
                                    $total_amount2=0;

                                @endphp
                                @foreach ($exchanges->where('product','>',0) as $key=>$e)
                                    @php

                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_gold +=  ($e->product*$e->goldwater)/100;

                                    @endphp
                                    <tr>

                                        <td style="text-align:center;padding:0px" class="kh14">
                                            {{ ++$key }}
                                        </td>
                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                        <td>{{ $e->tt }}</td>
                                        <td style="@if($e->product>0) color:blue; @else color:red; @endif">
                                            @if($e->product>0)
                                                +{{ $e->currency->curname }}
                                            @else
                                                -{{ $e->currency->curname }}
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->product) . ' ' . $e->currency->sk }}</td>
                                        <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber(($e->product*$e->goldwater)/100) . ' ' . $e->currency->sk }}</td>

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:pink':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>

                                        <td>{{ $e->user->name }}</td>

                                        <td style="">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;color:blue;">សរុបទិញ</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                        {{ $total_gold > 0 ? phpformatnumber(abs(($total_amount / $total_gold) * 100)) : 0 }}
                                    </td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                        ទឹក {{ $total_product > 0 ? phpformatnumber(($total_gold / $total_product) * 100) : 0 }}
                                    </td>
                                </tr>
                                {{-- ផ្នែកលក់ --}}
                                    @foreach ($exchanges->where('product','<',0) as $key=>$e)
                                    @php

                                        $total_product += $e->product;
                                        $total_amount += $e->amount;
                                        $total_gold +=  ($e->product*$e->goldwater)/100;

                                        $total_product2 += $e->product;
                                        $total_amount2 += $e->amount;
                                        $total_gold2 +=  ($e->product*$e->goldwater)/100;

                                    @endphp
                                    <tr>

                                        <td style="text-align:center;padding:0px" class="kh14">
                                            {{ ++$key }}
                                        </td>
                                        <td>{{ $e->client }}</td>
                                        <td>{{ $e->phone }}</td>
                                        <td style="">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                        <td>{{ $e->tt }}</td>
                                        <td style="@if($e->product>0) color:blue; @else color:red; @endif">
                                            @if($e->product>0)
                                                +{{ $e->currency->curname }}
                                            @else
                                                -{{ $e->currency->curname }}
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->product) . ' ' . $e->currency->sk }}</td>
                                        <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>
                                        <td style="text-align:right;@if($e->product>0) color:blue; @else color:red; @endif">{{ phpformatnumber(($e->product*$e->goldwater)/100) . ' ' . $e->currency->sk }}</td>

                                        <td style="text-align:right;padding:0px;{{ $e->rate<>$e->drate?'background-color:pink':'' }}">
                                            @if($e->rate==$e->drate)
                                                {{ phpformatnumber($e->rate) }}
                                            @else
                                                {{ phpformatnumber($e->rate) }} <br> <span style="font-size:12px;color:green;position: relative;top:-5px">{{ phpformatnumber($e->drate) }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align:right;@if($e->amount>0) color:blue; @else color:red; @endif">{{ phpformatnumber($e->amount) . '$' }}</td>

                                        <td>{{ $e->user->name }}</td>

                                        <td style="">{{ $e->ref_group_id }}</td>
                                        <td style="text-align:center;">{{ $e->note }}</td>
                                    </tr>
                                @endforeach
                                <tr style="background-color:aqua;border:3px solid green;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:yellow;color:red;">សរុបលក់</td>
                                    <td class="kh16-b" style="text-align:right;@if($total_product2>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_product2) }} Li</td>
                                    <td style="background-color:yellow;"></td>
                                    <td class="kh16-b" style="text-align:right;@if($total_gold2>0) color:blue; @else color:red; @endif background-color:yellow;" >{{ phpformatnumber($total_gold2) }} Li</td>
                                    <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                        {{ $total_gold2 <> 0 ? phpformatnumber(abs(($total_amount2 / $total_gold2) * 100)) : 0 }}
                                    </td>
                                    <td class="kh16-b" style="text-align:right;@if($total_amount2>0) color:blue; @else color:red; @endif background-color:yellow;">{{ phpformatnumber($total_amount2) }}$</td>
                                    <td class="kh16-b" style="background-color:yellow;text-align:right;">
                                        ទឺក {{ $total_product2 <> 0 ? phpformatnumber(($total_gold2 / $total_product2) * 100) : 0 }}
                                    </td>
                                </tr>

                                <tr style="background-color:aqua;border:3px solid;">
                                    <td colspan=6 class="kh16-b" style="text-align:center;background-color:green;color:white">សរុបទិញលក់</td>
                                    <td class="kh16-b" style="text-align:right;background-color:green;color:white;" >{{ phpformatnumber($total_product) }} Li</td>
                                    <td style="background-color:green;"></td>
                                    <td class="kh16-b" style="text-align:right;background-color:green;color:white" >{{ phpformatnumber($total_gold) }} Li</td>
                                    <td class="kh16-b" style="background-color:green;text-align:right;color:white;">
                                        {{ $total_gold <> 0 ? phpformatnumber(abs(($total_amount / $total_gold) * 100)) : 0 }}
                                    </td>
                                    <td class="kh16-b" style="text-align:right;background-color:green;color:white;">{{ phpformatnumber($total_amount) }}$</td>
                                    <td class="kh16-b" style="background-color:green;text-align:right;color:white;">
                                        ទឹក {{ $total_product <> 0 ? phpformatnumber(($total_gold / $total_product) * 100) : 0 }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/admin') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏ទិញលក់មាស');
        resizefixhead(170);
        $(window).resize(function() {
           resizefixhead(170);
        });

        function resizefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        }
        $(document).ready(function () {

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
            //hilightrow_thesamegroup();
            function hilightrow_thesamegroup(){
                let colors = ["#ffe5e5", "#e5ffe5", "#e5e5ff", "#fff5cc", "#f0e5ff", "#e5f7ff"];
                let groupCounts = {};
                let groupColorMap = {};
                let colorIndex = 0;
                // 1️⃣ Count group occurrences
                $("#tblexchangelist tbody tr").each(function(){
                    let groupId = $(this).find("td:nth-child(19)").text().trim();
                    groupCounts[groupId] = (groupCounts[groupId] || 0) + 1;
                });

                // 2️⃣ Apply highlight only to groups appearing more than once
                $("#tblexchangelist tbody tr").each(function(){
                    let groupId = $(this).find("td:nth-child(19)").text().trim();

                    if(groupCounts[groupId] > 1) {
                        // Assign color if not mapped yet
                        if(!groupColorMap[groupId]){
                            groupColorMap[groupId] = colors[colorIndex % colors.length];
                            colorIndex++;
                        }
                        $(this).css("background-color", groupColorMap[groupId]);
                    } else {
                        $(this).css("background-color", ""); // No highlight
                    }
                });
            }

            function getUserPermissions(userId) {
                const permusers = JSON.parse(localStorage.getItem("permusers") || "[]");
                return permusers
                    .filter(item => item.userid == userId)
                    .map(item => item.code);
            }
            var isAdmin = "{{ Auth::user()->role->name }}" === "Admin"; // Check admin in JS
            const userId = "{{ Auth::id() }}";
            const userPerms = new Set(getUserPermissions(userId));
            if (!isAdmin)
            {
                $('#d1').datetimepicker("destroy");
                $('#d2').datetimepicker("destroy");
                $('#seluser').attr('disabled',true);
                $('#seluser').val($('#txtuserid').val());
                if (!userPerms.has('3.1.3')) {
                    $('.btndel').hide();
                }
                if (!userPerms.has('3.1.4')) {
                    $('.btnprint').hide();
                }
            }
             // Remove previous highlight class
             $(document).on('click','.tblexchangelist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tbl_mainlist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.item',function(e){
                e.preventDefault();
                var rowind=$(this).closest('tr').index();
                var row=$(this).closest('tr');
                var curname=row.find("td:eq(1)").text();
                $('#btnsearch').attr('title',curname);
                searchtblexchangelist(curname);

            })
            $(document).on('change','#txtdeposit',function(e){
                e.preventDefault();

                let dep=$(this).val().replace(/,/g,'');
                let debt=$('#txtdebt').val().replace(/,/g,'');
                let bal=parseFloat(debt)-parseFloat(dep);
                $('#txtbalance').val(formatNumber(bal));
                $('#txtdeposit1').val(formatNumber(dep));
            })
             $(document).on('keydown', '.canenter', function (e) {
                 if (e.keyCode == 13) {
                    var id = $(this).attr("id");
                    if (id=='txtdeposit'){
                        $('#txtdeposit1').focus();
                    }else if (id=='txtdeposit1'){
                        $('#btnsavedeposit').focus();
                    }
                    e.preventDefault();
                 }
             })
             $(document).on('click','#btnsavedeposit,#btnsavedepositprint',function(e){
                e.preventDefault();

                var btnid=$(this).attr('id');
                let deposit = parseFloat($('#txtdeposit').val().replace(/,/g, '')) || 0;
                let depositBank = parseFloat($('#txtdeposit1').val().replace(/,/g, '')) || 0;
                let payvia = $('#selbankdeposit').val();

                if (deposit <= 0 || depositBank <= 0) {
                    alert('Invalid deposit amount.');
                    return;
                }

                if (payvia == '') {
                    bank_amount=0;
                    cash_amount=deposit;
                    if (deposit !== depositBank) {
                        alert('Deposit amount must match exactly for cash payment.');
                        return;
                    }
                } else {
                    bank_amount=depositBank;
                    cash_amount=deposit - depositBank;
                    if (deposit < depositBank) {
                        alert('Bank deposit amount cannot be greater than customer deposit.');
                        return;
                    }
                }
                $('body').addClass("wait");
                customertype = $('#selbankdeposit').find(':selected').attr('customertype');

                var formdata=new FormData(frmgolddeposit);
                formdata.append("customertype_deposit",customertype);
                formdata.append("bank_amount",bank_amount);
                formdata.append("cash_amount",cash_amount);
                formdata.append('deposit_via',$('#selbankdeposit option:selected').text());
                var url="{{ route('exchange.savedepositgold') }}";
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
                            toastr.success("Saved");
                            if(btnid=='btnsavedepositprint'){
                              prints($('#txtex_id').val(),$('#txtex_group').val(),0);
                          }
                            $('#depositgold_modal').modal('hide');
                            $('body').removeClass("wait");
                            getexchangelist();

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
            function prints(ex_id,group_id,reprint){
                var redirectWindow = window.open('{{ url('/') }}'+'/exchangegold/prints?ex_id='+ex_id+'&group_id='+group_id+'&reprint='+reprint, '_blank');
                redirectWindow.location;
            }
            $(document).on('click','.btnpayment',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var groupid=$(this).data('groupid');
                var balance=$(this).data('balance');
                var client=$(this).data('client');
                var phone=$(this).data('phone');
                var examount=$(this).data('examount');

                $('#txtex_id').val(id);
                $('#txtex_group').val(groupid);
                $('#client_name').val(client);
                $('#client_tel').val(phone);
                $('#txtdeposit').val('');
                $('#txtdeposit1').val('');

                $('#txtdebt').val(formatNumber(Math.abs(balance)));
                $('#txtbalance').val(formatNumber(Math.abs(balance)));
                $('#depositgold_modal').modal('show');
                $('#examount').val(examount);

            })
            // ✅ Focus after modal fully visible
            $('#depositgold_modal').on('shown.bs.modal', function () {
                $('#txtdeposit').trigger('focus');
            });
            $('#btnprintreport').click(function(e){
                e.preventDefault();
                var userid=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var status=$('#selstatus').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var redirectWindow = window.open('{{ url('/') }}'+'/getexchangelist?userid='+userid+'&d1='+d1+'&d2='+d2+'&status='+status+'&location='+2+'&isprint='+1+'&username='+username, '_blank');
                redirectWindow.location;
            })
            $('#btnsearch').click(function(e){
                e.preventDefault();
                getexchangelist();
            })

            $(document).on('change','#seluser,#selstatus',function(e){
                e.preventDefault();
                getexchangelist();
            })


            $(document).on('click','.btndel',function(e){
                e.preventDefault();
                //debugger
                //var rowind=$(this).closest('tr').index();
                Swal.fire({
                    title: 'Are you sure to remove this exchange?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var mapid=$(this).data('id');

                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('deleteexchange') }}",
                            data: { id: mapid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //document.getElementById("tblexchangelist").deleteRow(rowind);
                                    getexchangelist();
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

            function getexchangelist()
            {
                $('body').addClass("wait");
                var userid=$('#seluser').val();

                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var url="{{ route('stock.getbuysalegoldreport') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {userid:userid,d1:d1,d2:d2},
                    complete: function () {},
                    success: function (data) {
                        console.log(data)
                        $('#row_display').empty().html(data);

                         resizefixhead(170);
                        //hilightrow_thesamegroup();
                        $('body').removeClass("wait");
                        if (!isAdmin)
                        {

                            if (!userPerms.has('3.1.3')) {
                                $('.btndel').hide();
                            }
                            if (!userPerms.has('3.1.4')) {
                                $('.btnprint').hide();
                            }
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }

        })//end document
        function searchtblexchangelist() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblexchangelist");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    } else {
                    tr[i].style.display = "none";
                    }
                }
            }
            // ✅ Renumber visible rows
            // var visibleIndex = 1;
            // for (i = 0; i < tr.length; i++) {
            //     if (tr[i].style.display !== "none") {
            //         var tdNo = tr[i].getElementsByTagName("td")[0];
            //         if (tdNo) {
            //             tdNo.textContent = visibleIndex++;
            //         }
            //     }
            // }
        }



    </script>

@endsection
