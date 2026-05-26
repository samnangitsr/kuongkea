@extends('master')
@section('title') Check Customer Close List @endsection
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
      .inputamt{
        width:200px;height:45px;text-align:right;font-size:22px;background-color:white;border-style:none;
      }
      .inputcur{
        width:100px;height:45px;text-align:center;font-size:22px;background-color:white;border-style:none;
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
            <h1 class="kh22-b">មើលបញ្ជីដែលបិទរួច</h1>
        </div>
    </div>
   <div class="row">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-style:none;width:220px;" class="kh22">កាលបរិច្ឆេទ</td>
                    <td style="border-style:none;" class="kh22">ប្រភេទអតិថិជន</td>
                    <td style="border-style:none;"></td>
                    <td style="border-style:none;"></td>
                    
                </tr>
                <tr>
                    <td style="border-style:none;padding:0px;">
                        <div class="input-group" style="width:220px;">
                            <input type="text" name="listdate" id="listdate" class="form-control kh22" style="width:170px;height:45px;background-color:silver"> 
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
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
                        <button id="btndellist" class="btn btn-danger kh22">លុបបញ្ជី</button>
                    </td>
                </tr>
            </table>
        </div>
   </div>
   <div class="row">
    <div class="table-responsive">
        <form id="frmcustomerlist" action="">
            <table class="table table-bordered kh22">
               <thead class="" style="text-align:center;">
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
                show();
            })
            function show(){
                var d=$('#listdate').val();
                var customertype=$('#seltype').val();
                var url="{{ route('customer.getcloselist') }}";
                $.get(url,{listdate:d,customertype:customertype},function(data){
                    $('#customercloselist').empty().html(data); 
                })
            }
           $(document).on('change','#seltype',function(e){
                e.preventDefault();
                show();
           })
            $(document).on('click','#btndellist',function(e){
                e.preventDefault();
                var d=$('#listdate').val();
                var customertype=$('#seltype').val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('customer.deletecloselist') }}",
                            data: { dd:d,customertype:customertype },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    $('#btnshow').click();
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    )
                                }    
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'Delete Error.',
                                    'Error'
                                )
                            }

                        })
                       
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