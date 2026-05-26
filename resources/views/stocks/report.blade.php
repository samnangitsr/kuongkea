@extends('master')
@section('title') Stock Report @endsection
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
       .tbl_stockreport .clickedrow td{
        background-color: #caaf8f;
        }
        .tbl_stockreport .clickedrow td input{
            background-color: #caaf8f;
        }
      .tableFixHead{ overflow: auto;background-color:rgb(178, 228, 236); }
      .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
      .tbl_stockreport td{
        font-family:Arial;
          font-size:16px;
          word-wrap: break-word;
          padding:6px 5px 5px 5px;
          text-align:right;
          font-weight:bold;
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
        <div class="table-responsive">
            <table id="tbl5">
                <tr class="kh16-b">
                    <td><label class="form-check-label kh16-b">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckalldate" id="ckalldate"> All Date</label>
                    </td>

                    <td class="kh22" style="width:40px;padding-left:5px;">គិតពី</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="stockdate" id="stockdate" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>

                    <td class="kh22" style="width:40px;padding-left:5px;">ដល់</td>
                    <td class="kh16-b" style="width:160px;">
                        <div class="input-group">
                            <input type="text" name="enddate" id="enddate" class="form-control kh16-b" style="background-color:white;height:30px;width:100px;margin-top:0px;" readonly>
                            <span class="input-group-text" style="height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td>
                        <select name="selgold" id="selgold" class="kh16-b">
                            <option value="2">លុយ+មាស</option>
                            <option value="0">លុយ</option>
                            <option value="1">មាស</option>

                        </select>
                    </td>
                     {{-- <td style="border-style:none;padding:0px;">
                        <select name="seluser" id="seluser" class="form-select kh22">
                            <option value="all">All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td> --}}
                    <td style="padding-left:10px;">
                        <button id="btnshow" class="btn-3d">បង្ហាញ</button>
                    </td>
                    <td style="padding-left:10px;">
                        <button id="btnsavestock" class="btn-3d btn-3d-primary">រក្សាទុកស្តុក</button>
                    </td>
                </tr>
            </table>

        </div>
   </div>
   <div class="row">
     <form id="frmstockreport" action="">
        <div class="tableFixHead" id="divstockreport" style="padding:0px;margin:10px 0px;">

        </div>
      </form>
  </div>

@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏ស្តុកលុយ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-200;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-200;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });
       $(document).ready(function () {
            var today=new Date();
            $('#stockdate,#enddate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            //Highlight clicked row
         $(document).on('click','.tbl_stockreport td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
           $(document).on('change','#selgold',function(e){
                 e.preventDefault();
                 $('#btnshow').click();
           })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var d=$('#stockdate').val();
                var d2=$('#enddate').val();
                var selgold=$('#selgold').val();
                var alldate = document.getElementById("ckalldate").checked;
                //var user=$('#seluser').val();
                var url="{{ route('stock.showstockreport') }}";
                // $.get(url,{viewdate:d,user:'stock'},function(data){
                //     $('#divstockreport').empty().html(data);
                //     $('#btnsavestock').prop('disabled',false);
                // })
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: { viewdate:d,todate:d2,user:'stock',alldate:alldate,selgold:selgold},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#divstockreport').empty().html(data);
                        $('#btnsavestock').prop('disabled',false);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            })
            $(document).on('click','#btnsavestock',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var selgold=$('#selgold').val();
                var formdata = new FormData(frmstockreport);
                formdata.append('stockdate',d);
                formdata.append('isgold',selgold);
                var url="{{ route('stock.store') }}";
                $.ajax({
                    async: false,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            alert('all product stock have been saved')

                       }else{
                            alert(data.error)
                       }


                    },
                    error: function () {
                        alert('Save Error')

                    }

                })
            })
            $(document).on('change','#stockdate',function(e){
                e.preventDefault();
                $('#btnsavestock').prop('disabled',true);
            })
        })
    </script>
@endsection
