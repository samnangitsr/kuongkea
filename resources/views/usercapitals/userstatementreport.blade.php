@extends('master')
@section('title') UserStatementReport @endsection
@section('css')
    <style type="text/css">
    .en16{
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            }
            .en16-b{
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
       .red{
        color:red;
       }
       .blue{
        color:blue;
       }
    td.amt{
        text-align:right;
        font-weight:bold;
    }
    td.total{
        text-align:right;
        font-weight:bold;
        font-size:22px;
    }
    .tbl_usertransaction .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_usertransaction .clickedrow td input{
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
<div class="row">
    <div class="col-lg-12">
        <h1 class="kh22-b">របាយការណ៏បុគ្គលិក/User Statement Report</h1>
    </div>
</div>
   <div class="row">
    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-style:none;width:220px;" class="kh22">កាលបរិច្ឆេទ</td>
                    <td style="border-style:none;width:220px;" class="kh22">បុគ្គលិក</td>
                    <td style="border-style:none;width:220px;" class="kh22">រូបិយប័ណ្ណ</td>
                    <td style="border-style:none;"></td>
                    <td style="border-style:none;"></td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="stockdate" id="stockdate" class="form-control" style="width:170px;height:45px;background-color:silver;font-size:22px;" readonly>
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select class="form-select kh22" name="seluser" id="seluser" style="height:45px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select class="form-select kh22" name="selcur" id="selcur" style="height:45px;">
                            <option value="">All Currency</option>
                            @foreach ($currencies as $cur)
                                <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <button id="btnshow" class="btn btn-info kh22" style="margin-left:20px;">បង្ហាញ</button>
                        <button id="btnprint" class="btn btn-info kh22" style="margin-left:20px;width:100px;">ព្រីន</button>
                    </td>

                </tr>
            </table>
        </div>
   </div>
   <div class="row">
    <div class="table-responsive">
        <div id="userstatementreport">

        </div>
    </div>
</div>

@endsection
@section('script')

    <script type="text/javascript">
        function checkright()
        {
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#stockdate').datetimepicker("destroy");

            }
        }
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
          //checkright();
            //Highlight clicked row
         $(document).on('click','.tbl_userreport td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var userid=$('#seluser').val();
                var cur=$('#selcur').val();
                if(cur==''){
                  var url="{{ route('usercapital.dousertransactionreport') }}";
                }else{
                  var url="{{ route('usercapital.douserstatementreport') }}";
                }
                $.get(url,{trandate:d,userid:userid,cur:cur},function(data){
                    //console.log(data)
                    $('#userstatementreport').empty().html(data);

                })
            })
            $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var userid=$('#seluser').val();
                var cur=$('#selcur').val();
                var curname=$('#selcur option:selected').text();
                var username=$('#seluser option:selected').text();
                if(cur==''){
                  var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/printusertransaction?username='+username+'&userid='+ userid +'&date='+d, '_blank');
                }else{
                  var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/printuserstatementreport?username='+username+'&curname='+curname+'&userid='+ userid+'&cur='+cur +'&date='+d, '_blank');
                }
                redirectWindow.location;
            })
           // Remove previous highlight class
           $(document).on('click','.tbl_usertransaction td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
            })

        })
    </script>
@endsection
