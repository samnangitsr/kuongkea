@extends('master')
@section('title') Exchange Profit Report @endsection
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
       .cgr{
        background-color:aquamarine;
       }
       .tbl_stockreport .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_stockreport .clickedrow td input{
        background-color: #caaf8f;
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

      <table class="table">
          <tr>
              <td style="border-style:none;width:170px;" class="kh16-b">កាលបរិច្ឆេទ</td>
              <td style="border-style:none;" class="kh16-b">បុគ្គលិក</td>
              <td style="border-style:none;"></td>
              <td style="border-style:none;"></td>

          </tr>
          <tr>
              <td style="border-style:none;padding:0px;width:170px;">
                  <div class="input-group" style="width:170px;">
                      <input type="text" name="stockdate" id="stockdate" class="form-control" style="width:120px;height:35px;background-color:silver;font-size:16px;font-weight:bold;">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
              </td>
              <td style="border-style:none;padding:0px;width:220px;">
                  <select class="form-select kh16-b" name="seluser" id="seluser" style="height:35px;width:200px;">
                      <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                      @foreach ($users as $u)
                          <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                      @endforeach
                  </select>
              </td>
              <td style="border-style:none;padding:0px;">
                  <button id="btnshow" class="btn btn-info kh16-b" style="width:100px;">បង្ហាញ</button>
                  <button id="btnprint" class="btn btn-primary kh16-b" style="width:100px;">ព្រីន</button>
              </td>

          </tr>
      </table>

   </div>
   <div class="row">
    <div class="table-responsive">
        <form id="frmstockreport" action="">

        </form>
    </div>
</div>

@endsection
@section('script')

    <script type="text/javascript">
         $('#h1_title').text('ប្រាក់ចំណេញប្តូរប្រាក់');
       $(document).ready(function () {
            var today=new Date();
            $('#stockdate').datetimepicker({
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
                var d=$('#stockdate').val();
                var user=$('#seluser').val();
                var url="{{ route('stock.showstockreport') }}";
                $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: { viewdate:d,todate:d,user:user},
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                        $('#frmstockreport').empty().html(data);
                        $('#btnsavestock').prop('disabled',false);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
            })
            $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var username=$('#seluser option:selected').text();
                var dd=$('#stockdate').val();
                var redirectWindow = window.open('{{ url('/') }}'+'/stockexchangecurall/print?username='+username  + '&dd='+dd, '_blank');
                redirectWindow.location;
            })

            $(document).on('click','#btnsavestock',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var formdata = new FormData(frmstockreport);
                formdata.append('stockdate',d);
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
