<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoldGroup</title>
    <link rel="icon" href="{{ config('helper.asset_path') }}/admin/assets/images/usdkhr.jpg" type="image/jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
	<link href="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
    <link href="{{ config('helper.asset_path') }}/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/js/jquery.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/legacy.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.time.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/datetimepicker/js/picker.date.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/jquery.datetimepicker.full.js"></script>
	<script src="{{ config('helper.asset_path') }}/js/moment.js"></script>
</head>
<style type="text/css">
     body.wait *{
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
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
            }
         .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;

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
        .kh10-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:10px;
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
        .kh30{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            font-weight:bold;
            }

        #tbl_exchange .clickedrow td{
            background-color: rgb(22, 18, 228);
            color:white !important;
        }
        #tbl_transfer .clickedrow td{
            background-color: rgb(20, 58, 6);
            color:white !important;
        }


</style>
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
<body>
    <input type="hidden" id="txtgroupid" value="{{$groupid}}">
    <input type="hidden" id="txtexid" value="{{$exid}}">

    <h1>Exchange Gold Group</h1>
    <table id="tbl_exchange" class="table table-bordered kh16-b">
        <thead style="background-color:aquamarine;text-align:center;">
            <th>ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Product</th>
            <th>Water</th>
            <th>Rate</th>
            <th>Amount</th>

        </thead>
        <tbody>
            @foreach ($exchanges as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ date('d-m-Y',strtotime($item->dd)) }}</td>
                    <td>{{ $item->tt }}</td>
                    <td style="@if($item->product>0) color:blue; @else color:red; @endif text-align:right;">{{ phpformatnumber($item->product) }} {{ $item->currency->shortcut }}</td>
                    <td style="text-align:center;">{{ $item->goldwater }}</td>
                    <td style="text-align:center;">{{ $item->rate }}</td>
                    <td style="@if($item->amount>0) color:blue; @else color:red; @endif text-align:right;">{{ phpformatnumber($item->amount) }} USD</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Gold List Group By Date</h1>
    <table id="tbl_transfer" class="table table-bordered kh16">
        <thead>
            <tr style="text-align:center;background-color:aqua;">
                <th>ID</th>
                <th>Customer Name</th>
                <th>Tranname</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Trancode</th>

            </tr>
        </thead>

        <tbody>
            @foreach($transfers as $date => $items)
                <!-- Group Header Row -->
                <tr style="background:#f2f2f2;font-weight:bold;font-size:22px;">
                    <td colspan="5">{{ date('d-m-Y', strtotime($date)) }}</td>

                    <td>
                        @if($loop->last)
                            <!-- Only show for last date group -->
                            <a href="#" class="btn btn-danger btn-delete" data-dd="{{ $date }}">Delete</a>
                        @endif
                    </td>
                </tr>

                @foreach($items as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->partner->name }}</td>
                        <td>{{ $t->tranname }}</td>
                        <td style="text-align:right;font-weight:bold;@if($t->amount>0) color:red @else color:blue; @endif">{{ phpformatnumber($t->amount) }}</td>
                        <td style="font-weight:bold;@if($t->amount>0) color:red @else color:blue; @endif">{{ $t->currency->shortcut }}</td>
                        <td>{{ $t->trancode }}</td>
                    </tr>
                @endforeach

            @endforeach

        </tbody>
    </table>



</body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">


    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

         $(document).on('click','#tbl_exchange td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','#tbl_transfer td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
               // add highlight to the parent tr of the clicked td
               $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btn-delete',function(e){
                e.preventDefault();
                var groupid=$('#txtgroupid').val();
                var exid=$('#txtexid').val();
                var dd=$(this).data('dd');
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
                            url: "{{ route('exchangegold.deletelistgroup') }}",
                            data: { groupid:groupid,dd:dd,exid:exid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    location.reload();

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
</html>
