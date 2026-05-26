@extends('master')
@section('title') ThaiAccountRegister @endsection
@section('css')
    <style type="text/css">
      body.wait *{
			cursor: wait !important;
		}
        .select2-container--default .select2-results>.select2-results__options{max-height: 360px !important;}
         /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:azure}
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
            background-color:rgb(230, 245, 240);
        }
        .select2-selection__arrow {
            height: 35px !important;
        }
        #selaccount + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;font-weight:bold;background-color:whitesmoke;}
	    #select2-selaccount-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

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

    .tableFixHead{ overflow: auto;border:1px solid blue;}
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

       #tblacc td{
        padding:3px;
       }
       #tblcloselist td{
        padding:5px;
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
            <form id="frmthaicloselist" action="">

                <table id="tblcloselist" class="table">
                    <tr>
                        <td class="kh16" style="border-style:none;">ថ្ងៃបិទបញ្ជី</td>
                        <td colspan=2 style="border-style:none;">
                            <div class="input-group" style="">
                                <input type="text" name="closedate" id="closedate" class="form-control kh16-b" style="background-color:silver;">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh16" style="border-style:none;">ឈ្មោះបញ្ជី</td>
                        <td colspan=2 style="border-style:none;">
                            <select name="selaccount" id="selaccount" class="form-select" style="width:100%;">
                                <option value=""></option>
                                @foreach ($accounts as $ac)
                                    <option value="{{ $ac->id }}"  bankname="{{ $ac->bankname }}">{{ $ac->accno }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh16" style="border-style:none;">សមតុល្យ</td>
                        <td style="border-style:none;">
                             <div class="input-group">
                                <input type="text" class="form-control kh16-b" style="text-align:right;" name="balance" id="balance">
                                <input type="button" class="input-group kh16-b" id="btnbrowseson" value="THB" style="width:60px;border:1px solid grey;">
                            <div>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh16" style="border-style:none;">SMSID</td>
                        <td style="border-style:none;">
                            <input type="text" class="form-control kh16" name="smsid" id="smsid" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td style="border-style:none;">

                        </td>
                        <td style="float:right;border-style:none;">
                            <input type="button" class="btn btn-info" id="btnnew" value="New">
                            &nbsp;&nbsp;
                            <input type="button" class="btn btn-primary" id="btnsave" value="Save">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-lg-8">
            <div class="tableFixHead">
                <table id="tblacc" class="table table-bordered table-hover tblacc" style="table-layout:fixed;">
                    <thead style="text-align:center;" class="kh14-b">
                        <th style="width:50px;">No</th>
                        <th style="width:80px;display:none;">ID</th>
                        <th style="width:80px;">Close Date</th>
                        <th style="width:80px;">Close Time</th>
                        <th style="width:100px;">អ្នកកត់ត្រា</th>
                        <th style="width:100px;">AccountNo</th>
                        <th style="width:100px;">សមតុល្យ</th>
                        <th style="width:80px;">SMSID</th>
                        <th style="width:50px;">Action</th>
                    </thead>
                    <tbody id="bodyaccount">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('បិទបញ្ជីថៃ');
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-140;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
      $(window).resize(function() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();

        var divheight=windowHeight-140;

        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
        }
      });


        $(document).ready(function () {
            $('#selaccount').select2({
            templateResult: formatOption
        });
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var $option = $(
                '<div class="select2-option">' +
                '<div class="select2-option-main">' + option.text + '</div>' +
                '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('bankname') : option.element.getAttribute('bankname')) + '</div>' +
                '</div>'
            );
            return $option;
            }
            var today=new Date();
                $('#closedate').datetimepicker({
                    timepicker:false,
                    datepicker:true,
                    value:today,
                    format:'d-m-Y',
                    autoclose:true,
                    todayBtn:true,
                    startDate:today,
                });
            $(document).on('click','.tblacc td',function(e){
                // Remove previous highlight class

                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
                // add highlight to the parent tr of the clicked td
                $(this).parent('tr').addClass("clickedrow");
            })
            var cleave = new Cleave('#balance', {
                numeral: true,
                numeralPositiveOnly: true,
                numeralThousandsGroupStyle: 'thousand'
            });
           $(document).on('change','#selaccount',function(e){
                e.preventDefault();
                var account=$('#selaccount').val();
                var accountname=$('#selaccount option:selected').text();
                getbalance(account,accountname);
                getaccountcloselist(account,accountname);

           })
           function getbalance(account,accountname)
           {
            $('body').addClass("wait");
            var url="{{ route('thaiaccount.getaccountbalance') }}";
            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {account:account,accountname:accountname},
                success: function (data) {
                    console.log(data)
                    if($.isEmptyObject(data.error)){
                        $('#balance').val(formatNumber(data['bal']));
                        $('#smsid').val(data['lastsmsid']);
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
           function getaccountcloselist(account,accountname)
            {
                //debugger;
                var url="{{ route('thaiaccount.getaccountcloselist') }}";

                $('body').addClass("wait");

            $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {account:account,accountname:accountname},
                success: function (data) {
                    console.log(data)
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
            $(document).on('click','#btnsave',function(e){
                e.preventDefault();
                $('body').addClass("wait");
                var formdata = new FormData(frmthaicloselist);

                 var accountname=$('#selaccount option:selected').text();
                 formdata.append("accountname",accountname);

                var btntext=$(this).val();
                var url="{{ route('thaiaccount.closelist') }}";
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
                            toastr.success('CloseList Successfully');
                            getaccountcloselist($('#selaccount').val(),accountname);
                            if(btntext=='Save'){
                                //cleartext();
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
            $(document).on('click','#btnnew',function(e){
                e.preventDefault();
                cleartext();
            })
            $(document).on('click','.btn_delete',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var accno=$(this).data('accno');
                var accid=$(this).data('account_id')
                Swal.fire({
                    title: 'Are you sure to delete ACC: ' + accno + '?',
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
                            url: "{{ route('thaiaccount.deletecloselist') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    getaccountcloselist(accid,accno);
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
            function cleartext()
            {
                $('#selaccount').val('');
                $('#balance').val('');
                $('#smsid').val('');

            }
            function getaccountlist()
            {
                //debugger;
                var url="{{ route('thaiaccount.getaccountlist') }}";
                $.get(url,{},function(data){
                    console.log(data)
                    $('#bodyaccount').empty().html(data);
                })
            }

        })
        function isEmpty(val){return (val === undefined || val == null || val.length <= 0) ? true : false;}
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    </script>
@endsection
