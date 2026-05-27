@extends('master')
@section('title') ExchangeLists @endsection
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
                    <td><label class="form-check-label kh16-b">
                            <input class="form-check-input kh16-b" type="checkbox" name="ckinputdate" id="ckinputdate"> ថ្ងៃកត់ត្រា</label></td>
                    <td class="kh16-b" style="width:85px;padding-left:10px;">អ្នកកត់ត្រា</td>
                    <td style="border-style:none;padding:0px;width:200px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="width:200px;">
                            <option value="">ទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width:120px;">
                        <select name="selstatus" id="selstatus" class="kh16-b">
                            <option value="2">ទិន្ន័យប្តូរប្រាក់ទាំំងអស់</option>
                            <option value="1">ទិន្ន័យប្តូរប្រាក់មុខផ្ទះ</option>
                            <option value="-1">ទិន្ន័យកាត់កងបញ្ជី</option>
                            <option value="0" style="color:red;">ទិន្ន័យលុប</option>

                        </select>
                    </td>
                    <td style="">
                        <button id="btnsearch" class="mybtn kh14-b" style="height:25px;">Search</button>
                        <button id="btnprintreport" class="mybtn kh14-b" style="height:25px;">Print Report</button>

                    </td>
                </tr>
            </table>
        </div>
        <div class="row" id="row_display" style="margin:0px;padding:0px;">
            <div class="col-lg-3" style="margin:0px;padding:0px;">
                <div class="tableFixHead" style="padding:0px;margin:0px 5px 0px 0px;">
                    <table class="table table-bordered table-hover kh14-b tbl_mainlist" style="table-layout: fixed">
                        <thead style="text-align:center;">
                            <th style="width:40px;">N <sup>o</sup></th>
                            <th>រូបិយប័ណ្ណ</th>
                            <th style="width:60px;">ចំនួន</th>

                        </thead>
                        <tbody>
                            @php
                                $allqty=0;
                            @endphp
                            @foreach ($sumexchangelist as $k =>$item)
                                @php
                                    $allqty+=$item->qty;
                                @endphp
                                <tr class="item">
                                    <td style="text-align:center;">{{ ++$k }}</td>
                                    <td style="text-align:center;">{{ $item->curstr }}</td>
                                    <td style="text-align:center;" class="tdqty">{{ $item->qty }}</td>

                                </tr>
                            @endforeach
                            <tr style="background-color:gold;" class="item">
                                <td style="border:1px solid black"></td>
                                <td style="text-align:center;border:1px solid black">Total</td>
                                <td style="text-align:center;border:1px solid black;" class="tdqty">{{ $allqty }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-9" style="margin:0px;padding:0px;">
                <div class="tableFixHead" style="padding:0px;margin:0px;">
                    <table id="tblexchangelist" class="table table-bordered table-hover tblexchangelist kh14-b" style="table-layout: fixed;">
                        <thead style="text-align:center;">
                            <th style="width:65px;">លរ</th>
                            <th style="width:100px;">ប្តូរប្រាក់</th>
                            <th style="width:170px;">ទិញចូល</th>
                            <th style="width:150px;">អត្រា</th>
                            <th style="width:170px;">លក់ចេញ</th>
                            <th style="width:150px;">សកម្មភាព</th>
                            <th style="width:100px;">ថ្ងៃទី</th>
                            <th style="width:80px;">ម៉ោង</th>
                            <th style="width:150px;">អ្នកកត់ត្រា</th>
                            <th style="width:100px;">ថ្ងៃកត់ត្រា</th>
                            <th style="width:500px;">សំគាល់</th>

                        </thead>
                        <tbody id="bodyexchangelist">
                            @php
                                $dd='';
                                $created_at='';
                            @endphp
                            @foreach ($exchangelists as $key=>$e)
                                @php
                                    $dd=date('Y-m-d',strtotime($e->dd));
                                    $created_at=date('Y-m-d',strtotime($e->created_at));
                                @endphp
                                <tr id="tr_object_id_{{ $e->mapcode }}">
                                    <td class="kh14" style="text-align:center;">{{ ++$key }}</td>

                                    <td style="text-align:center;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ $e->curbuy . '-' . $e->cursale }}</td>
                                    <td style="text-align:right;color:blue;">+{{ phpformatnumber($e->buy) . ' ' . $e->curbuy }}</td>
                                    <td style="text-align:right;{{ $e->rate<>$e->drate?'background-color:yellow':'' }}">
                                        @if($e->rate <> $e->drate)
                                            {{ $e->rate . '(' . $e->drate . ')' }}
                                        @else
                                            {{ $e->rate }}
                                        @endif
                                    </td>
                                    <td style="text-align:right;color:red">-{{ phpformatnumber($e->sale) . ' ' . $e->cursale }}</td>
                                    <td style="text-align:center;">
                                        @if($e->status==1)
                                            @if($e->isexchangelist==0)
                                                @if(str_contains($e->action,'d'))
                                                <a data-id="{{ $e->mapcode }}" class="mybtn btndel" href="">Delete</a>
                                                @endif
                                                <a data-id="{{ $e->mapcode }}" class="mybtn btnprint" href="">Print</a>
                                            @endif
                                        @else
                                            {{ $e->userdel }}
                                        @endif
                                    </td>
                                    <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                    <td>{{ $e->tt }}</td>
                                    <td>{{ $e->user->name }}</td>
                                    <td style="@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                                    <td style="text-align:center;">{{ $e->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
         $('#h1_title').text('របាយការណ៏ប្តូរប្រាក់');
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
            $(document).on('click','.btnprint',function(e){
                e.preventDefault();
                var mapid=$(this).data('id');
                //alert(mapid)
                prints(mapid)
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
                            type: 'POST',
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
                var status=$('#selstatus').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var url="{{ route('getexchangelist') }}";
                var isinputdate = document.getElementById("ckinputdate").checked;
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {userid:userid,d1:d1,d2:d2,status:status,location:2,isinputdate:isinputdate},
                    complete: function () {},
                    success: function (data) {
                        console.log(data)
                        $('#row_display').empty().html(data);
                        var tableFixHead=document.getElementsByClassName('tableFixHead');
                        for(i=0; i<tableFixHead.length; i++) {
                            tableFixHead[i].style.height=divheight+'px';
                        }
                        var curstr=$('#btnsearch').attr('title');

                        $("tr.item").each(function() {
                            curs=$(this).find("td").eq(1).text();
                            if(curs==curstr){
                                $(this).removeClass('clickedrow').addClass('clickedrow');
                                searchtblexchangelist(curstr);
                            }
                        })
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
            function prints(mapid){

                var redirectWindow = window.open('{{ url('/') }}'+'/exchange/prints?mapid='+mapid, '_blank');
                redirectWindow.location;
            }
        })//end document
          function searchtblexchangelist(input) {
            var filter, table, tr, td, i, txtValue;
            if (input == 'Total') input = '';
            filter = input.toString().toUpperCase();
            table = document.getElementById("tblexchangelist");
            tr = table.getElementsByTagName("tr");

            // Hide/show rows based on search
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
            var visibleIndex = 1;
            for (i = 0; i < tr.length; i++) {
                if (tr[i].style.display !== "none") {
                    var tdNo = tr[i].getElementsByTagName("td")[0];
                    if (tdNo) {
                        tdNo.textContent = visibleIndex++;
                    }
                }
            }
        }

    </script>

@endsection
