@extends('master')
@section('title') បិទបញ្ជីប្រចាំថ្ងៃ @endsection
@section('css')
<link rel="stylesheet" tyle="text/css" href="{{ config('helper.asset_path') }}/css/virtual-select.min.css">
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
      td input{
        height:45px;
        font-size:22px;
      }
      .tbl_list .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_list .clickedrow td input{
        background-color: #caaf8f;
    }
    .tbl_list1 .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_list1 .clickedrow td input{
        background-color: #caaf8f;
    }
    .inputrow{
        border-style:1px solid green;
      font-size:14px;
      font-weight:bold;
      padding:0px;
      text-align:right;
        height:30px;
      font-family: Arial, Helvetica, sans-serif;
    }
    .inputrow1{
      font-weight:bold;
      border:1px solid green;
      font-size:16px;
      padding:0px;
      height:30px;
      text-align:right;
      font-family: Arial, Helvetica, sans-serif;
    }

    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    #tbl_list th{
        padding:3px;
        border:1px solid black;
    }
    #tbl_list td{
        padding:0px;
        border:1px solid black;
    }

    .tableFixHead1{ overflow: auto;border:1px solid blue;}
    .tableFixHead1 thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    #tbl_list1 th{
        padding:3px;
        border:1px solid black;
    }
    #tbl_list1 td{
        padding:0px;
        border:1px solid black;
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

   <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="input-group" style="width:160px;">
                <input type="text" name="showdate" id="showdate" class="form-control" style="width:100px;background-color:silver;font-size:12px;font-weight:bold;">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <select id="seluser" multiple name="seluser" class="select" style="width:200px;" placeholder="Select User" data-search="false" data-silent-initial-value-set="true">
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach

            </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <button id="btnshow" class="btn btn-warning btn-sm kh14-b">បង្ហាញ</button>
            <button id="btnsave" class="btn btn-info btn-sm kh14-b">រក្សាទុក</button>
            <button id="btnsetrate" class="btn btn-primary btn-sm kh14-b">កំណត់អត្រាបិទបញ្ជី</button>
        </div>

   </div>
   <div class="row" style="margin-top:0px;">
    <form action="" id="frmcloselist">
        <div>
            <table>
                <tr>
                    <td ><h3 class="kh22" style="margin-top:7px;">តារាងបញ្ជីលុយសំរាប់ថ្ងៃទី</h3></td>
                    <td><input type="text" id="txtclosedate" name="txtclosedate" class="kh22" style="background-color:transparent;border-style:none;" readonly></td>
                </tr>
            </table>
        </div>
        <div>
            <div class="tableFixHead">
                <table id="tbl_list" class="table tbl_list kh14" style="table-layout:fixed;">
                    <thead style="text-align:center;">
                        <th style=width:60px;>លរ</th>
                        <th style="display:none;">CustomerID</th>
                        <th style="">បរិយាយ</th>
                        <th style="width:150px;">ដុល្លា</th>
                        <th style="width:150px;">បាត</th>
                        <th style="width:180px;">រៀល</th>
                        <th style="width:200px;{{ config('helper.col_vnd')==0?'display:none':'' }}">ដុង</th>
                        <th style="width:160px;">គិតជាដុល្លា</th>
                        <th style="display:none;">Model</th>
                        <th style="width:60px;">សក</th>

                    </thead>

                        <tbody id="tbl_closelist">

                        </tbody>

                </table>
            </div>
        </div>

        <div class="row" id="tbl_closelist1">

        </div>
    </form>
   </div>


@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
    $('#h1_title').text('បិទបញ្ជីបុគ្គលិកលក់អចលនទ្រព្យ');
       $(document).ready(function () {
            VirtualSelect.init({
                ele: '#seluser' ,
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


            function jsformatNumber(num)
            {
                num=parseFloat(num);
                var k=String(num).split('.');
                if(k.length==2){
                    var fnum=k[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                    var snum=k[1];
                    return fnum + '.' + snum;
                    //return num.toFixed(2);
                }else{
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                }
            }



        })
    </script>
@endsection
