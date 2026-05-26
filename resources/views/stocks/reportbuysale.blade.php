@extends('master')
@section('title') Buy Sale Report @endsection
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
      .tableFixHead{ overflow: auto; }
      .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
      .tbl_stockreport td{
        font-family:Arial;
          font-size:16px;
          word-wrap: break-word;
          padding:6px 5px 5px 5px;
          text-align:right;
          font-weight:bold;
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

   <div class="row" style="margin-top:-25px;">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-style:none;width:220px;" class="kh22">គិតពី</td>
                    <td style="border-style:none;width:220px;" class="kh22">ដល់</td>
                    {{-- <td style="border-style:none;" class="kh22">បុគ្គលិក</td> --}}
                    <td style="border-style:none;"></td>

                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="startdate" id="startdate" class="form-control" style="width:170px;height:45px;background-color:silver;font-size:22px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="enddate" id="enddate" class="form-control" style="width:170px;height:45px;background-color:silver;font-size:22px;">
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    {{-- <td style="border-style:none;padding:0px;">
                        <select name="seluser" id="seluser" class="form-select kh22">
                            <option value="all">All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td> --}}
                    <td style="border-style:none;padding:0px;">
                        <button id="btnshow" class="btn btn-info kh22">បង្ហាញ</button>
                    </td>

                </tr>
            </table>
        </div>
   </div>
   <div class="row">
     <form id="frmstockreport" action="">
        <div class="tableFixHead" id="divstockreport" style="padding:0px;margin:0px;">

        </div>
      </form>
  </div>

@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('របាយការណ៏ទិញលក់');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-280;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-280;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });
       $(document).ready(function () {
            var today=new Date();
            $('#startdate,#enddate').datetimepicker({
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
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var d1=$('#startdate').val();
                var d2=$('#enddate').val();
                var user=$('#seluser').val();
                var url="{{ route('stock.showstockreport1') }}";
                // $.get(url,{d1:d1,d2:d2,user:'stock'},function(data){
                //     $('#divstockreport').empty().html(data);
                //     $('#btnsavestock').prop('disabled',false);
                // })
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: { d1:d1,d2:d2,user:'stock'},
                    //contentType: 'text/plain',
                    //contentType: false,
                    //processData: true,
                    //cache: false,
                    complete: function () {},
                    success: function (data) {
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

        })
    </script>
@endsection
