@extends('master')
@section('title') ThaiAccountRegister @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
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
        .kh30-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:30px;
            font-weight:bold;
            }
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
            }
        label{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            color:blue;
        }
        td{
            padding:0px;
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
    .tableFixHead{ overflow: auto;border:1px groove silver;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }

    .ui-autocomplete {
        position: fixed;
        z-index: 1511;
        font-size:22px;
    }
    .ui-autocomplete-input{
      border: none;
      margin-bottom: 5px;
      border:1px solid #c8c6c6 !important;
      z-index:1511;
    }
       .tblacc .clickedrow td{
        background-color: #caaf8f;
       }
       .tblacc th{
        padding:3px;
       }
       .tblacc td{
        padding:3px;
       }


       #tbl_accreg td{
        padding:3px;
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
        <div class="col-lg-4">
            <form id="frmthaiaccount" action="">
                <input type="hidden" id="acc_id" name="acc_id">
                <table id="tbl_accreg" class="table">
                    <tr>
                        <td class="kh14-b" style="border-style:none;">លេខរៀង</td>
                        <td style="border-style:none;">
                            <input type="number" class="form-control kh16-b" id="no" name="no">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b" style="border-style:none;">ធនាគា</td>
                        <td style="border-style:none;">
                            <select name="selbank" id="selbank" class="form-select kh16-b">
                                <option value=""></option>
                                @foreach ($banks as $b)
                                    <option value="{{ $b->name }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b" style="border-style:none;">លេខបញ្ជីតាមសារ</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16-b" id="smslist" name="smslist">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b" style="border-style:none;">លេខបញ្ជីពិត</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16-b" id="fulllist" name="fulllist">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b" style="border-style:none;">ឈ្មោះបញ្ជី</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16-b" id="listname" name="listname">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-style:none;" class="kh14-b">កម្មសិទ្ធ</td>
                        <td style="border-style:none;">
                            <select name="showincloselist" id="showincloselist" class="form-select kh16-b">
                                <option value="1">បញ្ជីយើង</option>
                                <option value="0">ខ្ចីបញ្ជីគេប្រើ</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-style:none;">

                        </td>
                        <td style="float:right;border-style:none;">
                            <input type="button" class="btn-3d" id="btnnew" value="New">
                            &nbsp;&nbsp;
                            <input type="button" class="btn-3d btn-3d-primary" id="btnsave" value="Save">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-lg-8">
            <table>
                <tr>
                    <td>
                        <select name="selbank1" id="selbank1" class="form-select kh16-b">
                            <option value="">ធនាគាទាំងអស់</option>
                            @foreach ($banks as $b)
                                <option value="{{ $b->name }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="selstatus" id="selstatus" class="form-select kh16-b">
                            <option value="1">Active List</option>
                            <option value="0">បញ្ជីលុប</option>
                            <option value="2">ទាំងអស់</option>
                        </select>
                    </td>
                    <td style="padding-left:10px;">
                        <button class="btn-3d" id="btnrefresh">Refresh</button>
                    </td>
                </tr>
            </table>

            <div class="tableFixHead">
                <table id="tblacc" class="table table-bordered tblacc table-hover kh16">
                    <thead style="text-align:center;">
                        <th>លរ</th>
                        <th>លំដាប់</th>
                        <th>ឈ្មោះធនាគា</th>
                        <th>លេខបញ្ជីតាមសារ</th>
                        <th>លេខបញ្ជីពិត</th>
                        <th>ឈ្មោះបញ្ជី</th>
                        <th>កម្មសិទ្ធបញ្ជី</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="bodyaccount">
                        @foreach ($accounts as $key => $a)
                            <tr class="rowclick" style="@if($a->status==0) color:red;text-decoration:line-through; @endif">
                                <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $a->no }}</td>
                                <td class="kh16-b">{{ $a->bankname }}</td>
                                <td class="kh16-b">{{ $a->accno }}</td>
                                <td class="kh16">{{ $a->fullaccno }}</td>
                                <td class="kh16">{{ $a->accname }}</td>
                                <td class="kh16-b" style="@if($a->showinlist==0) color:red; @endif">{{ $a->showinlist==1?'បញ្ជីយើង':'បញ្ជីគេ' }}</td>
                                <td style="text-align:right;">
                                    @if($a->status==1)
                                        <a href="#" style="padding-right:3px;" class="btn btn-sm btn-warning btn_edit" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-fullaccno="{{ $a->fullaccno }}" data-accname="{{ $a->accname }}" data-selbank="{{ $a->bankname }}"  data-no="{{ $a->no }}" data-showinlist="{{ $a->showinlist }}" ><i class="fa fa-pencil" style="color:green"></i></a>
                                    @else
                                        <a href="#" style="padding-right:3px;color:green;" class="btn btn-sm btn-warning btn_restore" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-status="{{ $a->status }}" data-action="restore"><i class="fa fa-repeat"></i></a>
                                    @endif
                                    <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-status="{{ $a->status }}" data-action="delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('បង្កើតលេខបញ្ជីថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-180;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-180;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });


        $(document).ready(function () {
            $(document).on('click','.tblacc td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
            function getmaxno(){
                var url="{{ route('thaiaccount.getmaxno') }}";
                $.get(url,{},function(data){
                    $('#no').val(data['maxno']);
                })
            }
            getmaxno();
            $(document).on('click','.btn_edit',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var accno=$(this).data('accno');
                var fullaccno=$(this).data('fullaccno');
                var name=$(this).data('accname');
                var selbank=$(this).data('selbank');
                var no=$(this).data('no');
                var bel=$(this).data('showinlist');
                $('#acc_id').val(id);
                $('#no').val(no);
                $('#smslist').val(accno);
                $('#fulllist').val(fullaccno);
                $('#listname').val(name);
                $('#selbank').val(selbank);
                $('#showincloselist').val(bel);
                $('#btnsave').val('Update');

            })
            // $(document).on('click','.rowclick',function(data){
            //     var row = $(this).closest('tr');
            //     var id=row.find("td:eq(6)").text();
            //     var no=row.find("td:eq(1)").text();
            //     var accno=row.find("td:eq(3)").text();
            //     var fullaccno=row.find("td:eq(4)").text();
            //     var name=row.find("td:eq(5)").text();
            //     var selbank=row.find("td:eq(2)").text();

            //     $('#acc_id').val(id);
            //     $('#no').val(no);
            //     $('#smslist').val(accno);
            //     $('#fulllist').val(fullaccno);
            //     $('#listname').val(name);
            //     $('#selbank').val(selbank);
            //     $('#btnsave').val('Update');
            // })
            $(document).on('click','#btnnew',function(e){
                e.preventDefault();
                cleartext();

            })
            $(document).on('change','#selbank1,#selstatus,#btnrefresh',function(e){
                e.preventDefault();
                //getaccountlistbybank($(this).val());
                getaccountlist();
            })
            function getaccountlistbybank(bankname)
            {
                $('body').addClass("wait");

                var url="{{ route('thaisms.getaccountlistbybank') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {bankname:bankname},
                    success: function (data) {
                        console.log(data)
                        if($.isEmptyObject(data.error)){
                            var output='';
                            for(let i=0;i<data['acclist'].length;i++){

                                output +=`
                                    <tr class="rowclick">
                                        <td class="kh14" style="text-align:center;">${i+1}</td>
                                        <td class="kh14-b" style="text-align:center;">${data['acclist'][i].no}</td>
                                        <td class="kh14-b">${data['acclist'][i].bankname}</td>
                                        <td class="kh14-b">${data['acclist'][i].accno}</td>
                                        <td class="kh14">${data['acclist'][i].fullaccno}</td>
                                        <td class="kh14">${data['acclist'][i].accname}</td>
                                        <td style="display:none;">${data['acclist'][i].id}</td>
                                        <td style="text-align:right;">
                                            <a href="#" style="padding-right:3px;" class="btn btn-sm btn-warning btn_edit" data-id="${data['acclist'][i].id}" data-accno="${data['acclist'][i].accno}" data-fullaccno="${data['acclist'][i].fullaccno}" data-accname="${data['acclist'][i].accname}" data-selbank="${data['acclist'][i].bankname}"  data-no="${data['acclist'][i].no}" ><i class="fa fa-pencil" style="color:green"></i></a>
                                            <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="${data['acclist'][i].id}" data-accno="${data['acclist'][i].accno}"><i class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                `;
                            }
                            $('#bodyaccount').empty().html(output);

                            $('body').removeClass("wait");
                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Error.')
                    }

                })

            }
            $(document).on('click','#btnsave',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmthaiaccount);
                // var cus_id=$('#customer_id').text();
                 //formdata.append("cur1",cur1);
                var btntext=$(this).val();
                var url="{{ route('thaiaccount.store') }}";
                $.ajax({
                    async: true,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url: url,
                    data: formdata,
                    success: function (data) {
                       console.log(data)
                       if($.isEmptyObject(data.error)){
                            //location.reload();
                            toastr.success('Save Thai Account Successfully');
                            getaccountlist();
                            if(btntext=='Save'){
                                cleartext();
                            }else{
                                //$('#frmthaiaccount').trigger('reset');

                            }
                            $('body').removeClass("wait");
                       }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                       }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Save Error')

                    }

                })
            })
            $(document).on('click','.btn_delete,.btn_restore',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var accno=$(this).data('accno');
                var status=$(this).data('status');
                let action = $(this).data('action');
                let title_text='';
                let confirmbutton_text='';
                let success_text='';
                if(action=='restore'){
                    title_text="Are you sure to restore Account:";
                    confirmbutton_text="Yes, restore it!";
                    success_text="Restore!";
                }else{
                    title_text="Are you sure to delete Account:";
                    confirmbutton_text="Yes, delete it!";
                    success_text="Deleted!";
                }
                Swal.fire({
                    title: title_text + accno + '?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmbutton_text
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            async: true,
                            type: 'GET',
                            dataType:'JSON',
                            contentType: 'application/json;charset=utf-8',
                            url: "{{ route('thaiaccount.deleteaccount') }}",
                            data: { id:id,status:status,action:action },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    getaccountlist();
                                    Swal.fire(
                                        success_text,
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
            function cleartext()
            {
                $('#smslist').val('');
                $('#fulllist').val('');
                $('#listname').val('');
                $('#btnsave').val('Save');
                $('#acc_id').val('');
                getmaxno();
            }
            function getaccountlist()
            {
                //debugger;
                $('body').addClass("wait");
                var selbank=$('#selbank1').val();
                var status=$('#selstatus').val();
                var url="{{ route('thaiaccount.getaccountlist') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {selbank:selbank,status:status},
                    success: function (data) {
                        //console.log(data)
                        if($.isEmptyObject(data.error)){
                            $('#bodyaccount').empty().html(data);
                            $('body').removeClass("wait");
                        }else{
                            $('body').removeClass("wait");
                            alert(data.error)
                        }
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Error.')
                    }

                })
            }

        })
        function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
