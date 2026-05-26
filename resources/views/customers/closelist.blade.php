@extends('master')
@section('title') Customer Close List @endsection
@section('css')
    <style type="text/css">
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
            <h1 class="kh22-b">បិទបញ្ជីអតិថិជន</h1>
        </div>
    </div>
   <div class="row">
        <div class="table-responsive">
            <table class="table kh22">
                <tr>
                    <td style="border-style:none;width:220px;">កាលបរិច្ឆេទ</td>
                    <td style="border-style:none;">ប្រភេទអតិថិជន</td>
                    <td style="border-style:none;"></td>
                    
                    <td style="border-style:none;"></td>
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="listdate" id="listdate" class="form-control" style="width:170px;height:45px;background-color:silver;font-size:22px;"> 
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="border-style:none;padding:0px 10px 0px 10px;width:250px;">
                        <select class="form-select kh22" name="seltype" id="seltype" style="width:250px;">
                            <option value="all">All</option>
                            <option value="customer">Customer</option>
                            <option value="bank">Bank</option>
                            
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;" class="kh22">
                        <button id="btnshow" class="btn btn-info kh22">បង្ហាញ</button>
                    </td>
                    <td style="border-style:none;padding:0px;" class="kh22">
                        <button id="btnsavelist" class="btn btn-info kh22">រក្សាទុកបញ្ជី</button>
                    </td>
                </tr>
            </table>
        </div>
   </div>
   <div class="row">
    <div class="table-responsive">
        <form id="frmcustomerlist" action="">
            <table class="table table-bordered">
               <thead class="kh22" style="text-align:center;">
                    <th>លរ</th>
                    <th style="display:none;">លេខកូដអតិថិជន</th>
                    <th>ឈ្មោះអតិថិជន</th>
                    <th colspan=2>ដុល្លា</th>
                    <th colspan=2>រៀល</th>
                    <th colspan=2>បាត</th>
               </thead>
               
                   <tbody id="customercloselist">
                        
                   </tbody>
               
            </table>
        </form>
    </div>
</div>
   
@endsection
@section('script')
  
    <script type="text/javascript">
       $(document).ready(function () {
        $('.colusd').toArray().forEach(function(field){
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
            var today=new Date();
            $('#listdate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                var d=$('#listdate').val();
                var custype=$('#seltype').val();
                var url="{{ route('customer.showlist') }}";
                $.get(url,{listdate:d,custype:custype},function(data){
                    $('#customercloselist').empty().html(data);
                   
                })
            })
           
            $(document).on('click','#btnsavelist',function(e){
                e.preventDefault();
                var d=$('#listdate').val();
                var formdata = new FormData(frmcustomerlist);
                formdata.append('listdate',d);
                var url="{{ route('customer.savecloselist') }}";
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
                            alert('all customer list have been saved')
                       
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