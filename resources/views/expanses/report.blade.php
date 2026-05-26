@extends('master')
@section('title') របាយការណ៏ចំណាយ @endsection
@section('css')
    <style type="text/css">
     body.wait *{
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
       #tbl_report .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_report td{
       padding:2px 5px;
    }
    .delrecord{
        background-color:red;
    }
    #tbl_partner_transfer td{
        padding:5px;
    }
    #tbl_partner_transfer th{
        padding:5px;
    }

    .tableFixHead{ overflow: auto;}
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
    <div class="row" style="margin-top:0px;position:fixed;top:60px;z-index:1;background-color:silver;width:100%;">

        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="table">
                    <tr class="kh16">
                        <th style="border-style:none;">គិតពី</th>
                        <th style="border-style:none;">ដល់</th>
                        <th style="border-style:none;">បុគ្គលិក</th>
                        <th style="border-style:none;">ប្រភេទ</th>
                    </tr>
                    <tr>
                        <td style="padding:0px;border-style:none;width:150px;">
                            <div class="input-group" style="width:150px;">
                                <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:170px;background-color:silver;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:150px;">
                            <div class="input-group" style="width:150px;">
                                <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:150px;background-color:silver;">
                            </div>
                        </td>

                        <td style="border-style:none;padding:0px;width:200px;">
                            <select class="form-select kh16-b" name="seluser" id="seluser" style="width:200px;">
                                <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;padding:0px;width:150px;">
                            <select class="form-select kh16-b" name="seltype" id="seltype">
                                <option value="0">ទាំងអស់</option>
                                <option value="-1">ចំណាយ</option>
                                <option value="1">ចំណូល</option>
                            </select>
                        </td>
                        <td style="padding:0px 0px 0px 5px;border-style:none;">
                            <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search</button>
                            <button class="btn btn-info btn-md kh16-b" id="btnprintreport">Print</button>
                        </td>

                    </tr>
                </table>
            </div>
        </div>

    </div>
    <div id="displayreport" class="tableFixHead" style="margin-top:80px;">
        <table id="tbl_report" class="table table-bordered table-hover tbl_report" style="margin:0px;padding:0px;table-layout:fixed;">
            <thead style="text-align:center;" class="kh16">
                <th style="width:70px;padding:3px;">No</th>
                <th style="width:100px;padding:3px;">ថ្ងៃកត់ត្រា</th>
                <th style="width:200px;padding:3px;">ប្រភេទចំណាយ</th>
                <th style="width:180px;padding:3px;">បរិយាយ</th>
                <th style="width:250px;padding:3px;">ធនាគា</th>
                <th style="width:150px;padding:3px;">ចំនួនទឹកប្រាក់</th>
                <th style="width:100px;padding:3px;">គិតជាដុល្លា</th>
                <th style="width:100px;padding:3px;">អត្រា</th>
                <th style="width:100px;padding:3px;">អ្នកកត់ត្រា</th>
                <th style="width:100px;padding:3px;">ម៉ោង</th>
                <th style="width:100px;padding:3px;">បុ.ពាក់ព័ន្ធ</th>
            </thead>
            <tbody id="body_report">
                @php

                @endphp
                @foreach ($expanses as $k => $tr)
                    <tr>
                        <td style="text-align:center;padding:0px;" class="kh16">{{ ++$k }}</td>
                        <td class="kh16" style="">{{ date('d-m-Y',strtotime($tr->dd)) }}</td>
                        <td class="kh16">{{ $tr->type }}</td>
                        <td class="kh16">{{ $tr->desr }}</td>
                        <td class="kh16">{{ $tr->customer->name }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->inusd) . '$' }}</td>
                        <td class="kh16-b" style="text-align:right;">{{ floatval($tr->rate) }}</td>
                        <td class="kh16">{{ $tr->userrecord->name }}</td>
                        <td class="kh16" style="">{{ $tr->tt }}</td>
                        <td class="kh16">{{ $tr->user->name }}</td>
                    </tr>
                @endforeach
                <table>
                    <thead>
                        <th style="border:1px solid black;padding:5px;">Total</th>
                        @foreach ($total as $t)
                            <th style="border:1px solid black;padding:5px;@if($t->total<0) color:red; @else color:blue; @endif">{{ phpformatnumber($t->total) . ' ' . $t->currency->shortcut}}</th>
                        @endforeach
                    </thead>
                </table>
            </tbody>

        </table>

    </div>

@endsection
@section('script')

    <script type="text/javascript">

    $(document).ready(function () {
        $('#selcustomer').select2();
        $('#seluser').select2();
        $('#h1_title').text('របាយការណ៏ចំណូលចំណាយ');
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
        setheighttablefixhead(210);
        $(window).resize(function() {
            setheighttablefixhead(210);
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

        $(document).on('click','#tbl_report td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })



        $(document).on('click','#btnprintreport',function(e){
            e.preventDefault()
            printexpanse()
        })
        function printexpanse(){
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var type=$('#seltype').val();
            var user=$('#seluser').val();
            var username=$('#seluser option:selected').text();
            var typename=$('#seltype option:selected').text();

            var redirectWindow = window.open('{{ url('/') }}'+'/report/getexpansereport?d1='+d1+'&d2='+d2+'&type='+type+'&user='+user+'&username='+username+'&typename='+typename+'&print='+1 , '_blank');
            redirectWindow.location;
        }
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            Searchexpanse();
        })

        function Searchexpanse()
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var type=$('#seltype').val();
            var user=$('#seluser').val();

            var url="{{ route('report.getexpansereport') }}";

            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,type:type,user:user},
                complete: function () {},
                success: function (data) {
                    $('#displayreport').empty().html(data);
                    $('body').removeClass("wait");

                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Data Error.')
                }
            })

        }



    })



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }


    </script>
@endsection
