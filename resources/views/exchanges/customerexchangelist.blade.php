@extends('master')
@section('title') CustomerExchangeLists @endsection
@section('css')

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
    .btn-3d {
            background: #3498db;
            color: white;
            margin:0px 2px;
            padding: 2px 10px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
            font-weight: bold;
            }
        .btn-3d-primary{
            background: #344ddd;
            color: white;
        }
        .btn-3d-danger{
             background: #f3260b;
             color: white;
        }
         .btn-3d-warning{
             background: #c9a506;
             color: white;
        }

        .btn-3d:active {
            transform: translateY(4px);
            box-shadow: 0 1px 0 #2980b9;
            }
        .btn-3d:hover{
            background-color:green !important;
            color:white !important;
        }
        .input-3d {
            margin:0px 2px;
            padding: 0px 2px;
            border-radius: 6px;
            background: white;

            font-size: 16px;

            outline: none;
            border:1px solid black;
            box-shadow: 0 5px 0 #011d30;
            cursor: pointer;
            transition: all 0.1s ease-in-out;

            }

        .input-3d:focus {
            box-shadow: inset 2px 2px 4px rgba(0, 0, 0, 0.15),
                        inset -2px -2px 4px rgba(255, 255, 255, 0.7);
            background: #e4f311 !important;
            }
        #tblk td{
            padding:0px 3px;
            border-style:none;
        }
    </style>

@endsection
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
@section('content')
    <div class="row" style="padding:0px;margin-top:-10px;">
        <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
        <div class="table-responsive" style="margin-bottom:10px;">
            <table id="tblk" class="table">
                <tr>
                    <td class="kh16-b" style="width:40px;">គិតពី</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td class="kh16-b" style="width:40px;padding-left:10px;">ដល់</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td class="kh16-b" style="width:40px;">ម៉ោង</td>
                    <td class="kh16-b" style="width:100px;">
                        <div class="input-group">
                            <input type="text" name="t1" id="t1" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" placeholder="06:00:00">

                        </div>
                    </td>
                    <td class="kh16-b" style="width:40px;padding-left:10px;">ដល់</td>
                    <td class="kh16-b" style="width:100px;">
                        <div class="input-group">
                            <input type="text" name="t2" id="t2" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" placeholder="18:59:59">

                        </div>
                    </td>
                    <td class="kh16-b" style="width:85px;padding-left:10px;">អ្នកកត់ត្រា</td>
                    <td style="border-style:none;width:200px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="width:200px;">
                            <option value="">ទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="kh16-b" style="width:85px;padding-left:10px;">រយះពេល</td>
                    <td style="border-style:none;padding:0px;width:200px;">
                        <select name="seloperator" id="seloperator" style="height:25px;width:60px;">
                            <option value="">all</option>
                            <option value=">">></option>
                            <option value="<"><</option>
                            <option value="=">=</option>

                        </select>
                       <input type="text" id="stand_time" style="width:100px;height:25px;" placeholder="Wait/Second">
                    </td>
                    <td style="">
                        <button id="btncustomerexchange" class="btn-3d kh14-b" style="height:25px;">បង្ហាញ</button>
                    </td>
                    <td style="">
                        <button id="btndelalldata" class="btn-3d btn-3d-warning kh14-b" style="height:25px;">លុបទិន្ន័យចោលទាំងអស់</button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row" id="row_display" style="margin:0px;padding:0px;">
            <div class="col-lg-8">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
@endsection

@section('script')


    <script type="text/javascript">
         $('#h1_title').text('រូបអតិថិជនប្តូរប្រាក់');
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


            }
             // Remove previous highlight class
             $(document).on('click','.tblexchangelist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
             $(document).on('click','.btndel',function(e){
                e.preventDefault();
                var id=$(this).data('id');
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
                            url: "{{ route('customerexchangecapture.delete') }}",
                            data: { id:id },
                            success: function (data) {
                                //console.log(data);
                                if (data.success === true) {
                                    getcustomerexchangelist(0);
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
                $(document).on('click','#btndelalldata',function(e){
                e.preventDefault();

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
                            url: "{{ route('customerexchangecapture.deleteall') }}",
                            data: {},
                            success: function (data) {
                                //console.log(data);
                                if (data.success === true) {
                                    getcustomerexchangelist(0);
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
            $(document).on('click','#btn_del_all',function(e){
                e.preventDefault();
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
                        getcustomerexchangelist(1);
                    }
                })
            })
            $('#btncustomerexchange').click(function(e){
                e.preventDefault();
                getcustomerexchangelist(0);
            })
            $(document).on('change','#seluser,#selstatus',function(e){
                e.preventDefault();
                getcustomerexchangelist(0);
            })
             function getcustomerexchangelist(isdelete)
            {
                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var stand_time=$('#stand_time').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var t1 = $('#t1').val().replace(/\./g, ':');
                var t2 = $('#t2').val().replace(/\./g, ':');
                var selop=$('#seloperator').val();
                var url="{{ route('getcustomerexchangelist') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {userid:userid,d1:d1,d2:d2,stand_time:stand_time,selop:selop,t1:t1,t2:t2,isdelete:isdelete},
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#row_display').empty().html(data);
                        var tableFixHead=document.getElementsByClassName('tableFixHead');
                        for(i=0; i<tableFixHead.length; i++) {
                            tableFixHead[i].style.height=divheight+'px';
                        }
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            }


        })//end document
        function showImage(img) {
            const modal = document.getElementById("imgModal");
            const modalImg = document.getElementById("modalImg");
            modal.style.display = "flex";
            modalImg.src = img.src;
        }

        function closeModal() {
            document.getElementById("imgModal").style.display = "none";
        }
        function searchtblexchangelist(input) {
            var  filter, table, tr, td, i, txtValue;
            if(input=='Total') input='';
            filter = input.toString().toUpperCase();
            table = document.getElementById("tblexchangelist");
            tr = table.getElementsByTagName("tr");
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
        }

    </script>

@endsection
