@extends('master')
@section('title') PageTime @endsection
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

                    <td class="kh16-b" style="width:85px;padding-left:10px;">បុគ្គលិក</td>
                    <td style="border-style:none;padding:0px;width:200px;">
                        <select name="seluser" id="seluser" class="kh16-b" style="width:200px;">
                            <option value="">ទាំងអស់</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td style="">

                        <button id="btncustomerexchange" class="mybtn kh14-b" style="height:25px;">បង្ហាញ</button>

                    </td>
                </tr>
            </table>
        </div>
        <div class="row" id="row_display" style="margin:0px;padding:0px;">

        </div>

    </div>
@endsection

@section('script')


    <script type="text/javascript">
         $('#h1_title').text('Exchange Page Time');
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


            $('#btncustomerexchange').click(function(e){
                e.preventDefault();
                getcustomerexchangelist();
            })
            $(document).on('change','#seluser,#selstatus',function(e){
                e.preventDefault();
                getcustomerexchangelist();
            })
             function getcustomerexchangelist()
            {
                $('body').addClass("wait");
                var userid=$('#seluser').val();
                var stand_time=$('#stand_time').val();
                var d1=$('#d1').val();
                var d2=$('#d2').val();

                var url="{{ route('getexchangepagetime') }}";

                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {userid:userid,d1:d1,d2:d2},
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
