@extends('master')
@section('title') Invoice List @endsection
@section('css')
    <style type="text/css">
         #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;} 
		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
       .tbl_inv .clickedrow td{
        background-color: #caaf8f;
    }
    .blue{
        color:blue;
    }
    .red{
        color:red;
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
            <table class="table">
                <tr class="kh22">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                    <th style="border-style:none;">អតិថិជន</th>
                    <th style="border-style:none;">បុគ្គលិក</th>
                </tr>
                <tr>
                    
                    <td style="padding:0px;border-style:none;"> 
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="fromdate" id="fromdate" class="form-control" style="width:170px;background-color:silver;font-size:22px;"> 
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;"> 
                        <div class="input-group" style="width:250px;">
                            <input type="text" name="todate" id="todate" class="form-control" style="width:150px;background-color:silver;font-size:22px;"> 
                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;" class="form-select kh22" required>
                            <option value="">ជ្រើសរើសអតិថិជន</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                    <td style="border-style:none;padding:0px;">
                        <select class="form-select kh22" name="seluser" id="seluser" style="width:250px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                   <td style="padding:0px;border-style:none;">
                        <button class="btn btn-info kh22" id="btnsearch">Search</button>
                   </td>
                </tr>
                
            </table>
        </div>
   </div>
   <div class="row">
        <div class="table-responsive" style="height:500px;">
            <table class="table tbl_inv kh22">
                <thead class="">
                    <th>លរ</th>
                    <th>INV#</th>
                    <th>ថ្ងៃទី</th>
                    <th>ម៉ោង</th>
                    <th>អ្នកកត់ត្រា</th>
                    <th>អតិថិជន</th>
                    <th>សរុបទម្ងន់</th>
                    <th>សរុបទឹកប្រាក់</th>
                    <th>បានទូទាត់</th>
                    <th>នៅខ្វះ</th>
                    <th>សកម្មភាព</th>
                </thead>
                <tbody id="invlist">
                    @foreach ($invlist as $key => $inv)
                        <tr  class="@if($inv->totalweight>0) blue  @else red @endif kh22">
                            <td>{{ ++$key }}</td>
                            <td>
                                <a href="{{ route('invoice.invoicedetail',['invid'=>$inv->id]) }}" target="_blank" class="@if($inv->totalweight>0) blue  @else red @endif">
                                    {{ sprintf("%04d",$inv->id) }}
                                    
                                </a>
                            </td>
                            <td>
                                {{ date('d-m-Y',strtotime($inv->invdate)) }}
                            </td>
                            <td>
                                {{ $inv->invtime }}
                            </td>
                            <td>
                                {{ $inv->user->name }}
                            </td>
                            <td>
                                {{ $inv->customer->name }}
                            </td>
                            <td>
                                {{ phpformatnumber($inv->totalweight) . 'លី' }}
                            </td>
                            <td>
                                {{ phpformatnumber($inv->total) . $inv->cur }}
                            </td>
                            <td>
                                {{ phpformatnumber($inv->deposit) . $inv->cur }}
                            </td>
                            <td>
                                {{ phpformatnumber($inv->total-$inv->deposit) . $inv->cur }}
                            </td>
                            <td>
                                @if($inv->deposit==0)
                                    <a href="#" class="btn btn-sm btn-danger btndelinv" data-id="{{ $inv->id }}" data-deposit="{{ $inv->deposit }}">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
   
@endsection
@section('script')
    <script type="text/javascript">
       $(document).ready(function () {
        $('#selcustomer').select2();
        var today=new Date();
            $('#fromdate,#todate').datetimepicker({
                timepicker:false,
                datepicker:true,
                value:today,
                format:'d-m-Y',
                autoclose:true,
                todayBtn:true,
                startDate:today,

            });
            $(document).on('click','.tbl_inv td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            $(document).on('click','#btnsearch',function(e){
                e.preventDefault();
                var fdate=$('#fromdate').val();
                var tdate=$('#todate').val();
                var selcustomer=$('#selcustomer').val();
                var seluser=$('#seluser').val();
                var url="{{ route('invoice.search') }}";
                $.get(url,{fdate:fdate,tdate:tdate,selcustomer:selcustomer,seluser:seluser},function(data){
                    $('#invlist').empty().html(data);
                })
            })
            $(document).on('click','.btndelinv',function(e){
                e.preventDefault();
                var invid=$(this).data('id');
                var deposit=$(this).data('deposit');
               
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
                            url: "{{ route('invoice.delete') }}",
                            data: { id:invid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    $('#btnsearch').click();
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
       })
    </script>
@endsection