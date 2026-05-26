@extends('master')
@section('title') DelpropertySold @endsection
@section('css')
    <style type="text/css">
         body.wait, body.wait *{
			cursor: wait !important;
		}
        .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
        #selproperty + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
            /* Each result */
        #select2-selproperty-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

        #selproperty1 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
            /* Each result */
        #select2-selproperty1-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
        /* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
            background-color:white;
        }
        .select2-selection__arrow {
            height: 35px !important;
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
        .kh12-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:12px;
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
       .csold{
        background-color:yellow;
        color:blue;
       }

       #myInput {
        /* background-image: url("{{ asset('public/logo') }}/search-icon.jpg"); */
        /* background-image: url('/logo/search-icon.jpg'); */
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
      .tbl_customer td{
      word-wrap: break-word;
      /* padding:2px 5px 2px 5px; */
    }
    .tbl1 .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl2 .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl3 .clickedrow td{
        background-color: #caaf8f;
    }
    .tbl_group td{
        padding:3px;
    }
    .tbl_group th{
        padding:3px;
    }

    .tblproperty td{
        padding:3px;
    }
    .tblproperty th{
        padding:3px;
    }
    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }

    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:16px;
        font-family:'Noto Sans Khmer', sans-serif;

    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
    #myTable td{
      padding:5px;
    }
    /* .photo > input[type='file']{
			display:none;
		}
		.photo{
			width:30px;
			height:30px;
			border-radius:100%;
		} */
    #tbl_form_group td{
        border-style:none;
        padding:3px;
    }
    .mybtn{
        border:1px solid black;
        padding:5px 10px;
    }
    .mybtn:hover{
        background-color:aquamarine;
    }
    .mybtn_edit{
        border:1px solid black;
        padding:0px 4px;
        background-color:yellow;
    }
    .mybtn_edit:hover{
        background-color:aquamarine;
    }
    .mybtn_delete{
        border:1px solid black;
        background-color:pink;
        padding:0px 4px;
    }
    .mybtn_delete:hover{
        background-color:aquamarine;
    }
    #tblfrmland td{
        padding:5px;
        border-style:none;
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
    <div>
        <table>
            <tr>
                <td>
                    <select name="selproperty" id="selproperty" style="width:250px;">
                        <option value="">អចលនទ្រព្យ</option>
                        @foreach ($properties->where('status',1) as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button class="mybtn" id="btnsearch">Search</button>
                </td>

                <td>
                    <select name="selproperty1" id="selproperty1" style="width:250px;">
                        <option value="">អចលនទ្រព្យលុប</option>
                        @foreach ($properties->where('status',0) as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button class="mybtn" id="btnsearch1" style="background-color:red;color:white;">Search Delete</button>
                </td>
            </tr>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover tbl1" style="padding:0px;">
                    <thead style="text-align:center;">
                        <th>SaleID</th>
                        <th>PropertyName</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody id='bodysaledetail'>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="table-responsive">
                <table class="table table-bordered table-hover tbl2">
                    <thead style="text-align:center;">
                        <th>No</th>
                        <th>ID</th>
                        <th>GroupID</th>
                        <th>Date</th>
                        <th>Tranname</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Property</th>
                        <th>Act</th>
                        <th>CreatedAt</th>
                    </thead>
                    <tbody id="bodytransfer">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="payonidrow" class="row">

    </div>

@endsection
@section('script')
    <script type="text/javascript">
         $('#h1_title').text('លុបអចលនទ្រព្យលក់រួច');
         $(document).ready(function () {
            $('#selproperty').select2();
            $('#selproperty1').select2();
            $(document).on('click','.tbl1 td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tbl2 td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.tbl3 td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                $(this).parent('tr').addClass("clickedrow");
            })
            $(document).on('click','.btncheck',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                    var saleid=$(this).data('saleid');
                    var url="{{ route('checkpropertysold') }}";
                    $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {saleid:saleid},

                        complete: function () {},
                        success: function (data) {
                            console.log(data)
                            var output='';
                            $('#bodytransfer').empty();
                            if(data['groupsolds']){
                                for(let i = 0; i < data['groupsolds'].length; i++) {
                                    let item = data['groupsolds'][i];
                                    output += `
                                        <tr>
                                            <td style="text-align:center;width:50px;">${i + 1}</td>
                                            <td>${item.id}</td>
                                            <td>${item.ref_group_id}</td>
                                            <td>${moment(item.dd).format("DD-MM-YYYY")}</td>
                                            <td class="kh14-b" title="${item.trancode}">${item.tranname}</td>
                                            <td class="kh14-b">${item.partner.name}</td>
                                            <td class="kh16-b" style="text-align:right;">${formatNumber(item.amount) + item.currency.sk}</td>

                                            <td>${item.sendername}</td>
                                            <td style="width:100px;text-align:center;">
                                                ${(item.trancode == -8) ? `
                                                    <a href="#" style="padding:0px;" class="btn btn-sm btncheck1" data-id="${item.id}" data-ref_group_id="${item.ref_group_id}">
                                                        <i class="fa fa-list" style="color:green"></i>
                                                    </a>
                                                    <a href="#" style="padding:0px;" class="btn btn-sm btn_remove1" data-id="${item.id}" data-ref_group_id="${item.ref_group_id}">
                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                    </a>
                                                ` : ''}
                                            </td>
                                             <td>${moment(item.created_at).format("DD-MM-YYYY")}</td>
                                        </tr>
                                    `;
                                }
                            }

                            $('#bodytransfer').append(output);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.')
                        }
                    })
            })
            $(document).on('click','.btncheck1',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                    var id=$(this).data('id');
                    var groupid=$(this).data('ref_group_id')
                    var url="{{ route('checkpropertysoldbypayonid') }}";
                    $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {id:id,groupid:groupid},

                        complete: function () {},
                        success: function (data) {
                            //console.log(data)

                            $('#payonidrow').empty().html(data);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.')
                        }
                    })
            })
            $(document).on('click','#btnsearch,#btnsearch1',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                $('#bodytransfer').empty();
                $('#payonidrow').empty();
                var id=$(this).attr('id');
                if(id=='btnsearch'){
                    var pid=$('#selproperty').val();
                }else if(id=='btnsearch1'){
                    var pid=$('#selproperty1').val();
                }

                    var url="{{ route('getpropertysoldlink') }}";
                    $.ajax({
                        async:true,
                        type: 'GET',
                        url: url,
                        data: {pid:pid},

                        complete: function () {},
                        success: function (data) {
                            console.log(data)
                            var output='';
                            $('#bodysaledetail').empty();
                            for(let i=0;i<data['saledetails'].length;i++){
                                output +=`
                                    <tr >
                                        <td class="kh12-b">${data['saledetails'][i].sale_id} </td>
                                        <td class="kh12-b">${data['saledetails'][i]['property'].name}</td>
                                        <td>${data['saledetails'][i].status} </td>
                                        <td style="width:100px;text-align:center;">
                                            <a href="#" style="padding:0px;" class="btn btn-sm btncheck" data-id="${data['saledetails'][i].id}" data-saleid="${data['saledetails'][i].sale_id}"><i class="fa fa-list" style="color:green"></i></a>
                                            <a href="#" style="padding:0px;" class="btn btn-sm btn_remove" data-id="${data['saledetails'][i].id}" data-property_id="${data['saledetails'][i].property_id}" data-sale_id="${data['saledetails'][i].sale_id}"><i class="fa fa-trash" style="color:red;"></i></a>
                                        </td>

                                    </tr>
                                `;
                            }
                            $('#bodysaledetail').append(output);
                            $('body').removeClass("wait");
                        },
                        error: function () {
                            $('body').removeClass("wait");
                            alert('Read Data Error.')
                        }
                    })
            })
            $(document).on('click','.btn_remove1',function(e){
                e.preventDefault();
                var groupid=$(this).data('ref_group_id');
                var id=$(this).data('id');
                var row = $(this).closest('tr'); // Store reference to the row
                var url="{{ route('removegrouppayment') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: "to remove this property!",
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
                                url: url,
                                data: { groupid:groupid,id:id},
                                success: function (data) {

                                    if (data.success === true) {
                                        row.remove();
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
            $(document).on('click','.btnremovegroup',function(e){
                e.preventDefault();
                var groupid=$(this).data('ref_group_id');
                var row = $(this).closest('tr'); // Store reference to the row
                var url="{{ route('removegrouppayment1') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: "to remove this property!",
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
                                url: url,
                                data: { groupid:groupid},
                                success: function (data) {

                                    if (data.success === true) {
                                        row.remove();
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
            $(document).on('click','.btn_remove',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var pid=$(this).data('property_id');
                var sid=$(this).data('sale_id');

                var row = $(this).closest('tr'); // Store reference to the row
                var url="{{ route('removesaledetail') }}";
                Swal.fire({
                        title: 'Are you sure?',
                        text: "to remove this property!",
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
                                url: url,
                                data: { id:id,pid:pid,sid:sid},
                                success: function (data) {

                                    if (data.success === true) {
                                        row.remove();
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
        function searchmyTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tblproperty");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                } else {
                tr[i].style.display = "none";
                }
            }
            }
        }
    </script>
@endsection
