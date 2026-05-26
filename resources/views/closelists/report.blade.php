@extends('master')
@section('title') closelist report @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ asset('public') }}/css/virtual-select.min.css">


    <style type="text/css">
         body.wait, body.wait *{
            cursor: wait !important;
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

   <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="input-group" style="width:200px;">
                <input type="text" name="showdate" id="showdate" class="form-control kh16-b" style="width:150px;background-color:silver">
                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
            <button id="btnshow" class="btn btn-warning btn-sm kh16-b">បង្ហាញ</button>
        </div>

   </div>
   <div class="row" style="margin-top:10px;">
    <form action="" id="frmcloselist">
        <table>
            <tr>
                <td ><h3 class="kh22-b" style="margin-top:7px;">តារាងបញ្ជីលុយសំរាប់ថ្ងៃទី</h3></td>
                <td><input type="text" id="txtclosedate" name="txtclosedate" class="kh22-b" style="background-color:transparent;border-style:none;" readonly></td>
            </tr>
        </table>



        <div class="tableFixHead">
            <table id="tbl_list" class="table table-bordered tbl_list">
                <thead class="kh16-b" style="text-align:center;">
                    <th>លរ</th>

                    <th>បរិយាយ</th>
                    <th>ដុល្លា</th>
                    <th>បាត</th>
                    <th>រៀល</th>
                    <th>ដុង</th>
                    <th>គិតជាដុល្លា</th>
                    <th style="display:none;">Model</th>
                    <th>សក</th>

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
         $('#h1_title').text('របាយការណ៏បិទបញ្ជី');
       $(document).ready(function () {
                VirtualSelect.init({
            ele: '#seluser'
        });
            var today=new Date();
            $('#trandate,#showdate,#trandate1').datetimepicker({
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
                var showdate=$('#showdate').val();
                var seluser=$('#seluser').val();
                $('#txtclosedate').val(showdate);
                var url="{{ route('closelist.showreport') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {showdate:showdate,seluser:seluser},
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
