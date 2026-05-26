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
                <input type="hidden" id="cid" name="cid">
                <table id="tbl_accreg" class="table">
                    <tr>
                        <td class="kh16-b" style="border-style:none;">ឈ្មោះអតិថិជន</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16-b" id="cname" name="cname">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh16-b" style="border-style:none;">ភេទ</td>
                        <td style="border-style:none;">
                            <select class="form-select kh16-b" name="sex" id="sex">
                                <option value="1">ប្រុស</option>
                                <option value="0">ស្រី</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh16-b" style="border-style:none;">លេខទូរស័ព្ទ</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16-b" id="tel" name="tel">
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
            <div style="margin:-10px 0px 10px 0px;">
                <label style="margin-left:15px;color:blue" class="kh16-b">
                    <input type="radio" name="status" value="1" checked> តារាងឈ្មោះអតិថិជន
                </label>
                <label style="color:red;margin-left:25px;" class="kh16-b">
                    <input type="radio" name="status" value="0"> ឈ្មោះលុប
                </label>
            </div>


            <div class="tableFixHead">
                <table id="tblacc" class="table table-bordered tblacc table-hover kh16">
                    <thead style="text-align:center;">
                        <th>លរ</th>
                        <th>ID</th>
                        <th>ឈ្មោះ</th>
                        <th>ភេទ</th>
                        <th>លេខទូរស័ព្ទ</th>
                        <th>អ្នកកត់ត្រា</th>

                        <th>Action</th>
                    </thead>
                    <tbody id="bodyaccount">
                        @foreach ($customers as $key => $a)
                            <tr class="rowclick" style="@if($a->status==0) color:red;text-decoration:line-through; @endif">
                                <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $a->id }}</td>
                                <td class="kh16-b">{{ $a->name }}</td>
                                <td class="kh16-b">{{ $a->sex==1?'ប្រុស':'ស្រី' }}</td>
                                <td class="kh16">{{ $a->tel }}</td>
                                <td class="kh16">{{ $a->user->name }}</td>

                                <td style="text-align:right;">
                                    @if($a->status==1)
                                        <a href="#" style="padding-right:3px;" class="btn btn-sm btn-warning btn_edit" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-sex="{{ $a->sex }}" data-tel="{{ $a->tel }}" ><i class="fa fa-pencil" style="color:green"></i></a>
                                    @else
                                        <a href="#" style="padding-right:3px;color:green;" class="btn btn-sm btn-warning btn_restore" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-status="{{ $a->status }}" data-action="restore"><i class="fa fa-repeat"></i></a>
                                    @endif
                                    <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="{{ $a->id }}" data-name="{{ $a->name }}" data-status="{{ $a->status }}" data-action="delete"><i class="fa fa-trash"></i></a>
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
        $('#h1_title').text('ចុះឈ្មោះអតិថិជនថៃ');
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
                var name=$(this).data('name');
                var sex=$(this).data('sex');
                var tel=$(this).data('tel');

                $('#cid').val(id);
                $('#cname').val(name);
                $('#sex').val(sex);
                $('#tel').val(tel);
                $('#btnsave').val('Update');

            })

            $(document).on('click','#btnnew',function(e){
                e.preventDefault();
                cleartext();

            })
            $(document).on('change','#selbank1,#selstatus,#btnrefresh',function(e){
                e.preventDefault();
                //getaccountlistbybank($(this).val());
                getaccountlist();
            })

            $(document).on('click','#btnsave',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmthaiaccount);
                // var cus_id=$('#customer_id').text();
                 //formdata.append("cur1",cur1);
                var btntext=$(this).val();
                var url="{{ route('thaicustomer.store') }}";
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
                var name=$(this).data('name');
                var status=$(this).data('status');
                let action = $(this).data('action');
                let title_text='';
                let confirmbutton_text='';
                let success_text='';
                if(action=='restore'){
                    title_text="Are you sure to restore customer:";
                    confirmbutton_text="Yes, restore it!";
                    success_text="Restore!";
                }else{
                    title_text="Are you sure to delete customer:";
                    confirmbutton_text="Yes, delete it!";
                    success_text="Deleted!";
                }
                Swal.fire({
                    title: title_text + name + '?',
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
                            url: "{{ route('thaicustomer.deletecustomer') }}",
                            data: { id:id,status:status,action:action },
                            success: function (data) {
                                //console.log(data);
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
                $('#cname').val('');
                $('#tel').val('');
                $('#listname').val('');
                $('#btnsave').val('Save');
                $('#cid').val('');

            }
          $(document).on('change','input[name="status"]', function(e){
                e.preventDefault();
                getaccountlist();
            });

            function getaccountlist()
            {
                //debugger;
                $('body').addClass("wait");
                let status = $('input[name="status"]:checked').val();
                var url="{{ route('thaicustomer.read') }}";
                $.ajax({
                    async: true,
                    type: 'GET',
                    url: url,
                    data: {status:status},
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
