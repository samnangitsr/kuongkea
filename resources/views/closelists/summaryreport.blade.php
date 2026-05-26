@extends('master')
@section('title') របាយការណ៏បិទបញ្ជីប្រចាំថ្ងៃសង្ខេប @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/virtual-select.min.css">


    <style type="text/css">
         body.wait, body.wait *{
            cursor: wait !important;
          }
          .en16{
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
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
       .cgr{
        background-color:aquamarine;
       }
       .hiddenrow{
        display:none;
       }
        td.new{
            /* background-color:aquamarine; */
            text-align:right;
        }
        td.old{
            /* background-color:aqua; */
            text-align:right;
        }
        .tbl_list .clickedrow td{
            background-color: #caaf8f;
        }
        .tbl_list .clickedrow td input{
            background-color: #caaf8f;
        }
        .tbl_list td{
            padding:0px 5px;
        }
        .tbl_list th{
            padding:3px;
        }
        .cblue{
            color:blue;
        }
        .cred{
            color:red;
        }

        .tableFixHead{ overflow: auto;border:1px solid blue;}
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

   <div class="">
        <table>
            <tr>
                <td>
                    <div class="input-group" style="width:180px;">
                        <input type="text" name="fromdate" id="fromdate" class="form-control kh16-b" style="width:120px;background-color:silver">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    </div>
                </td>
                <td>
                    <div class="input-group" style="width:180px;">
                        <input type="text" name="todate" id="todate" class="form-control kh16-b" style="width:120px;background-color:silver">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    </div>
                </td>
                <td>
                    <button id="btnshow" class="btn btn-warning btn-sm kh16-b">បង្ហាញ</button>
                </td>
            </tr>
        </table>

   </div>
   <div class="row" style="margin-top:20px;">
    <form action="" id="frmcloselist">
        <table>
            <tr>
                <td ><h3 class="kh16-b" style="margin-top:7px;">តារាងបិទបញ្ជីសង្ខេប</h3></td>
            </tr>
        </table>

        <div class="tableFixHead">
            <table id="tbl_list" class="table table-bordered table-hover tbl_list" style="table-layout:fixed;">
                <thead class="kh14" style="text-align:center;">
                    <tr>
                        <th  rowspan=2 style="width:65px;">លរ</th>
                        <th  rowspan=2 style="width:120px;">អ្នកបិទបញ្ជី</th>
                        <th  rowspan=2 style="width:120px;">ថ្ងៃបិទបញ្ជី</th>
                        <th rowspan=2 style="width:120px;">ថ្ងៃបិទចាស់</th>
                        <th  rowspan=2 style="width:150px;">ដើមគ្រាដុល្លា</th>

                        <th  rowspan=2 style="width:150px;">ចុងគ្រាដុល្លា</th>
                        <th  rowspan=2 style="width:100px;">ចំណាយ</th>
                        <th  rowspan=2 style="width:100px;">ចំណូល</th>
                        <th  rowspan=2 style="width:150px;">ប្រាក់ចំណេញ</th>

                        <th colspan=3 style="width:450px;">លុយដើមគ្រា</th>
                        <th colspan=3 style="width:450px;">លុយចុងគ្រា</th>
                        <th colspan=2 style="width:300px;">អត្រា</th>
                    </tr>
                    <tr>
                        <th style="width:150px;">ដុល្លា</th>
                        <th style="width:150px;">បាត</th>
                        <th style="width:150px;">រៀល</th>
                        {{-- <th style="width:200px;">ដុង</th> --}}

                        <th style="width:150px;">ដុល្លា</th>
                        <th style="width:150px;">បាត</th>
                        <th style="width:150px;">រៀល</th>
                        {{-- <th style="width:200px;">ដុង</th> --}}
                        <th style="width:150px;">អត្រាបាត</th>
                        <th style="width:150px;">អត្រារៀល</th>
                        {{-- <th style="width:150px;">អត្រាដុង</th> --}}
                    </tr>

                </thead>

                <tbody id="tbl_closelist">

                </tbody>

            </table>
        </div>



    </form>
   </div>


@endsection
@section('script')
<script src="{{ asset('public/js') }}/virtual-select.min.js"></script>
    <script type="text/javascript">
        $('#h1_title').text('សង្ខេបរបាយការណ៏បិទបញ្ជី');
       $(document).ready(function () {
                VirtualSelect.init({
            ele: '#seluser'
        });
            var today=new Date();
            $('#fromdate,#todate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-230;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
            $(window).resize(function() {
                var windowWidth = $(window).width();
                var windowHeight = $(window).height();

                var divheight=windowHeight-230;

                var tableFixHead=document.getElementsByClassName('tableFixHead');
                for(i=0; i<tableFixHead.length; i++) {
                    tableFixHead[i].style.height=divheight+'px';
                }
            })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var fdate=$('#fromdate').val();
                var tdate=$('#todate').val();

                var url="{{ route('closelist.showsummaryreport') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {fdate:fdate,tdate:tdate},
                    complete: function () {

                    },
                    success: function (data) {
                    //console.log(data);
                        $('#tbl_closelist').empty().html(data);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Read Error.')
                        $('body').removeClass("wait");
                    }
                })


            })

            $(document).on('click','.tbl_list td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })





        })
    </script>
@endsection
