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

   <div class="">
        <table>
            <tr>
                <td>
                     <div class="input-group" style="width:160px;">
                        <input type="text" name="showdate" id="showdate" class="form-control" style="width:100px;background-color:silver;font-size:16px;font-weight:bold;height:35px;">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td>
                    <select id="seluser" multiple name="seluser" class="select" style="width:200px;" placeholder="Select User" data-search="false" data-silent-initial-value-set="true">
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button id="btnshow" class="btn btn-warning btn-sm kh14-b">បង្ហាញ</button>
                    <button id="btnsave" class="btn btn-info btn-sm kh14-b">រក្សាទុក</button>
                    <button id="btnsetrate" class="btn btn-primary btn-sm kh14-b">កំណត់អត្រាបិទបញ្ជី</button>
                </td>
            </tr>
        </table>
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
   @include('closelists.setratemodal')

@endsection
@section('script')
<script src="{{ config('helper.asset_path') }}/js/virtual-select.min.js"></script>
    <script type="text/javascript">
    $('#h1_title').text('បិទបញ្ជីប្រចាំថ្ងៃ');
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
            $('.buy').toArray().forEach(function(field){
                new Cleave(field, {
                    numeral: true,
                    numeralDecimalScale: 6,
                    numeralThousandsGroupStyle: 'thousand'
                });
            })
            $('.sale').toArray().forEach(function(field){
                new Cleave(field, {
                    numeral: true,
                    numeralDecimalScale: 6,
                    numeralThousandsGroupStyle: 'thousand'
                });
            })
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-220;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
            $(window).resize(function() {
                var windowWidth = $(window).width();
                var windowHeight = $(window).height();

                var divheight=windowHeight-220;

                var tableFixHead=document.getElementsByClassName('tableFixHead');
                for(i=0; i<tableFixHead.length; i++) {
                    tableFixHead[i].style.height=divheight+'px';
                }
            });
           //Highlight clicked row
         $(document).on('click','.tbl_list td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','.tbl_list1 td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
          $(document).on('click','#btnshow',function(e){
              e.preventDefault();
              getoldlist(getnewlist);
          })
          function getnewlist()
          {
            $('body').addClass("wait");
              var showdate=$('#showdate').val();
              var seluser=$('#seluser').val();
              $('#txtclosedate').val(showdate);
              var url="{{ route('closelist.search') }}";
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
                    //getoldlist();
                    var pl=0;
                    var totalinusd1=0;
                    if ($('#total_inusd1').val() == null || $('#total_inusd1').val() === 'undefined') {
                        totalinusd1=0;

                    }else{
                        totalinusd1=$('#total_inusd1').val();
                    }


                    var newlist=$('#newlist').val().replace(/,/g, '').replace(/\$/g,'');
                    var expanse=$('#expanse').val().replace(/,/g, '').replace(/\$/g,'');
                    var income=$('#income').val().replace(/,/g, '').replace(/\$/g,'');
                    if(totalinusd1==0){
                        $('#tdolddate').text(moment(today).format("DD-MM-YYYY"));
                        var oldlist=0;
                    }else{
                        $('#tdolddate').text($('#txtolddate').val());
                        var oldlist=totalinusd1.replace(/,/g, '').replace(/\$/g,'');
                    }
                    $('#oldlist').val(totalinusd1);
                    pl=parseFloat(newlist)-parseFloat(oldlist)+parseFloat(expanse)+parseFloat(income);
                    $('#pl').val(jsformatNumber(pl.toFixed(2))+'$');
                    if(pl>0){
                        $('#pl').css('color','blue');
                        $('#plhead').text('ចំណេញ');
                    }else{
                        $('#pl').css('color','red');
                        $('#plhead').text('ខាត');
                    }
                    $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Read Error.')
                        $('body').removeClass("wait");
                    }
                })
          }
           function getoldlist(callback)
           {
                var showdate=$('#showdate').val();
                var seluser=$('#seluser').val();
                $('#txtclosedate').val(showdate);
                var url="{{ route('closelist.searchold') }}";
                // $.get(url,{showdate:showdate,seluser:seluser},function(data){
                //     $('#tbl_closelist1').empty().html(data);
                // })
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {showdate:showdate,seluser:seluser},
                complete: function () {

                },
                success: function (data) {
                  $('#tbl_closelist1').empty().html(data);
                  callback();
                  //$('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Error.')
                    callback();
                }
            })
           }
           $(document).on('click','#btnsetrate',function(e){
            e.preventDefault();
            $('#setratemodal').modal('show');
           })
           $(document).on('click','#btnsaverate',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmsetratecloselist);
                var url="{{ route('currency.setratecloselist') }}";
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
                                $('body').removeClass("wait");
                                $('#setratemodal').modal('hide');
                            }else{
                                    alert(data.error)
                            }
                        },
                        error: function () {
                            alert('Save Error')

                        }

                    })
           })

           $(document).on('click','#btnsave,#btnsave1',function(e){
                e.preventDefault();
                var table = document.getElementById("tbl_list");
                var totalRowCount = table.rows.length; // 5
                var tbodyRowCount = table.tBodies[0].rows.length; // 3
                if(tbodyRowCount==0){
                    alert('no data save')
                    return;
                }
                $('body').addClass("wait");
                var formdata = new FormData(frmcloselist);
                 //formdata.append("receiver",receiver);
                var url="{{ route('closelist.store') }}";
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
                            //location.reload();
                            Swal.fire('List have been save successfully');
                       }else{
                            alert(data.error)
                       }
                       $('body').removeClass("wait");
                    },
                    error: function () {
                        alert('Save Error')
                        $('body').removeClass("wait");
                    }

                })
           })

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
