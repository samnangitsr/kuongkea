@extends('master')
@section('title') ExchangeLists @endsection
@section('css')
<link href="{{ assetUrl() }} /assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" crossorigin="anonymous" />    
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
       .tblexchangelist .clickedrow td{
        background-color: #caaf8f;
    }
    .tblexchangelist .clickedrow td input{
        background-color: #caaf8f;
    }
    </style>    

@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3>Invoice Exchange List</h3>
                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                <input id="txtuserid" type="hidden" value="{{ Auth::id() }}">
            </div>
            <div class="card-body" id="tblexchangemultiple">
                <div class="row" style="margin-top:-10px;margin-bottom:10px;">
                  <div class="col-lg-6">
                    <div class="input-group" style="">
                        <input type="text" name="d1" id="d1" class="form-control kh22" style="" readonly>
                        <input type="text" name="d2" id="d2" class="form-control kh22" style="" readonly>
                        <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <table class="table kh22">
                        <tr>
                            <td style="border-style:none;padding:0px;">អ្នកកត់ត្រា</td>
                            <td style="border-style:none;padding:0px;">
                                <select name="seluser" id="seluser" class="form-select kh22" style="width:250px;">
                                    <option value="">ទាំងអស់</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="text-align:right;border-style:none;padding:0px;">
                                <button id="btnsearch" class="btn btn-info" style="height:45px;font-size:22px;">Search</button>
                            </td>
                        </tr>
                    </table>
                  </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="tblexchangelist" class="table table-bordered tblexchangelist kh22">
                            <thead style="text-align:center;">
                                <th>លរ</th>
                                <th>ថ្ងៃទី</th>
                                <th>ម៉ោង</th>
                                <th>អ្នកកត់ត្រា</th>
                                <th>ប្តូរប្រាក់</th>
                                <th>ទិញចូល</th>
                                <th>អត្រា</th>
                                <th>លក់ចេញ</th>
                                <th>កូតបង់ប្រាក់</th>
                                
                            </thead>
                            <tbody id="bodyexchangelist">
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
                                @foreach ($exchangelists as $key=>$e)
                                    <tr id="tr_object_id_{{ $e->id }}">
                                        <td style="text-align:center;">{{ ++$key }}</td>
                                        <td>{{ date('d-m-Y',strtotime($e->dd)) }}</td>
                                        <td>{{ $e->tt }}</td>
                                        <td>{{ $e->user->name }}</td>
                                        
                                        <td style="text-align:center;">{{ $e->maincur . '-' . $e->pcur }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($e->amount) . $e->maincur }}</td>
                                        <td style="text-align:center;">{{ phpformatnumber($e->rate) }}</td>
                                        <td style="text-align:right;">{{ phpformatnumber($e->product) . $e->pcur }}</td>
                                        <td>{{ $e->othercode }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>
    <script src="{{ assetUrl() }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ assetUrl() }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
         function checkright()
        {
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#d1').datetimepicker("destroy");
                $('#d2').datetimepicker("destroy");
                $('#seluser').attr('disabled',true);
                $('#seluser').val($('#txtuserid').val());
            }
        }
		$(document).ready(function() {
            
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
            checkright();
             // Remove previous highlight class
             $(document).on('click','.tblexchangelist td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            // var table = $('#tblexchangelist').DataTable( {
			// 	serverSide:true,
            //     processing:true,
            //     columnsResize: true,
            //     ajax:"route('getexchangelist')",
            //     columns:[
            //         {data:'DT_RowIndex',name:'DT_RowIndex'},
            //         {data:'dd',name:'dd'},
            //         {data:'buy',name:'buy',textalign: 'right',
            //             render:function(data){
            //                 return formatNumber(data);
            //             },
            //         },
            //         {data:'sale',name:'sale',
            //             // render:function(data){
            //             //     return formatNumber(data);
            //             // },
            //         },
            //         {data:'action',name:'action'},
            //     ]
			// } );
           
            // var table = $('#tblexchangelist').DataTable( {
			// 	lengthChange: false,
			// 	buttons: [ 'copy', 'excel', 'pdf', 'print']
			// } );
		 
			// table.buttons().container()
			// 	.appendTo( '#tblexchangelist_wrapper .col-md-6:eq(0)' );
           
          
        });
	
        $(document).ready(function () {
            $('#btnsearch').click(function(e){
                e.preventDefault();
                refreshexchangelist();
            })
            $(document).on('click','.btnprint',function(e){
                e.preventDefault();
                var mapid=$(this).data('id');
                //alert(mapid)
                prints(mapid)
            })
           
            $(document).on('click','.btndel',function(e){
                e.preventDefault();
                //debugger
                Swal.fire({
                    title: 'Are you sure to remove this exchange?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var mapid=$(this).data('id');
                       
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('deleteexchange') }}",
                            data: { id: mapid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //$("tbody #tr_object_id_" + mapid).remove();
                                    refreshexchangelist();
                                    //location.reload();
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
        function prints(mapid){
            var htp=window.location.protocol;
            var htn=window.location.hostname;
            var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/exchange/prints?mapid='+mapid, '_blank');
            redirectWindow.location;
        }
        function refreshexchangelist(){
            var userid=$('#seluser').val();
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var url="{{ route('getinvoiceexchangelist') }}";
            $.get(url,{userid:userid,d1:d1,d2:d2},function(data){
                $('#bodyexchangelist').empty().html(data);
            })
        }
    </script>
   
@endsection