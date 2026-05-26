@extends('master')
@section('title') ក្រុមបញ្ជីលុយថៃ @endsection
@section('css')
    <style type="text/css">
    .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}
    #selpartner_continue_2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:whitesmoke;}
		/* Each result */
		#select2-selpartner_continue_2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;background-color:white}

    #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;height:47px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:white;}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:20px;}
    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
      /* Search field */
      .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;background-color:azure}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
            background-color:aquamarine;
        }
        .select2-selection__arrow {
            height: 34px !important;
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

       .cgr{
        background-color:aquamarine;
       }
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    #tbltransfer td,th{
      word-wrap: break-word;
      /* padding:2px 5px 2px 5px; */
    }
    #tblsearchmore td{
        border-style:none;
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

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }

       #tbl_cashdraw .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_notyetcashdraw .clickedrow td{
        background-color: #caaf8f;
       }
       #tbl_bankcashdraw .clickedrow td{
        background-color: #caaf8f;
       }
       #tblclearclick .clickedrow td{
        background-color: #caaf8f;
       }
       #divfooter{
        /* margin-right:50px; */
        color:white;
        padding:5px;
        position: fixed;
        bottom: 0;
        width: 100%;
        min-height: 50px;
        max-height: 50px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 50px;
        overflow:auto;
        clear: both;
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
    @php
        $allowdelete=1;
        $found_smsp=0;
    @endphp
    <div class="row">
        <h1 class="kh22-b">តារាងបើកវេរលុយថៃបន្តដៃគូ</h1>
        <div class="table-responsive">
            <table id="tbltransfer" class="table table-bordered table-hover" style="">
                <thead>
                    <thead style="text-align:center;">
                        <th style="width:60px;">No</th>
                        <th style="width:100px;">TID</th>
                        <th class="kh16" style="width:100px;">ប្រតិបត្តិការណ៏</th>
                        <th class="kh16" style="width:250px;">ដៃគូពាក់ព័ន្ធ</th>
                        <th class="kh16" style="width:150px;">ចំនួនទឹកប្រាក់</th>
                        <th class="kh16" style="width:120px;">សេវ៉ាដៃគូ</th>
                        <th class="kh16" style="width:100px;">លុយប្តូរ</th>
                        <th class="kh16" style="width:120px;">អត្រា</th>
                        <th class="kh16" style="width:180px;">លេខអ្នកទទួល</th>
                        <th class="kh16" style="width:180px;">ឈ្មោះអ្នកទទួល</th>
                        <th class="kh16">WingCodeInfo</th>
                        <th class="kh16">GroupID</th>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $key => $t)
                            @php
                                if($t->cashdraw_id>0){
                                    $allowdelete=0;
                                }
                                if($t->docodeby && !$t->cashdraw_codeid && $t->trancode==1){
                                    $allowdelete=0;
                                }
                            @endphp
                            <tr>
                                <td class="kh16-b" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $t->id }}</td>
                                <td class="kh16-b">{{ $t->tranname }}</td>
                                <td class="kh16-b">{{ $t->partner->name }}</td>
                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($t->amount) . $t->currency->shortcut }}</td>
                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($t->fee)}} {{ $t->feecurrency->shortcut }}</td>
                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($t->thai_amt) . 'THB' }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ floatval($t->th_rate)??'' }}</td>
                                <td class="kh16-b">{{ $t->rectel }}</td>
                                <td class="kh16-b">{{ $t->recname }}</td>
                                <td class="kh16-b">{!! $t->moneycode !!}</td>
                                <td>{{ $t->ref_group_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <h1 class="kh22-b">តារាងបើកវេរលុយថៃ</h1>
        <div class="table-responsive">
            <table id="tblsmsprocess" class="table table-bordered table-hover" style="">
                <thead>
                    <thead style="text-align:center;">
                        <th style="width:60px;">No</th>
                        <th style="width:100px;">ID</th>
                        <th class="kh16" style="width:100px">SMSID</th>
                        <th style="width:100px;">Opdate</th>
                        <th style="width:100px;">Optime</th>
                        <th style="width:100px;">Thai Amount</th>
                        <th style="width:100px;">Cus Charge</th>
                        <th class="kh16" style="width:250px;">ចំនួនទឹកប្រាក់</th>
                        <th class="kh16" style="width:250px;">Action</th>

                    </thead>
                    <tbody>
                        @foreach ($smsprocess as $key => $p)
                            @php
                                $found_smsp=1;
                            @endphp
                            <tr>
                                <td class="kh16-b" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $p->id }}</td>
                                <td class="kh16-b">{{ $p->sms_id }}</td>
                                <td class="kh16-b">{{ date('d-m-Y',strtotime($p->opdate)) }}</td>
                                <td class="kh16-b">{{ $p->optime }}</td>
                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($p->thai_amount) . " THB" }}</td>
                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($p->cut_seva) . " THB" }}</td>

                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($p->amount) . " THB" }}</td>
                                <td style="text-align:center;">
                                    @if($allowdelete==1)
                                        <a href="#" class="btn btn-danger btndeltrangroup" data-id="{{ $p->id }}" data-groupid="{{ $p->group_id }}" data-smsid="{{ $p->sms_id }}" data-paymethod="{{ $p->paymethod }}" data-opdate="{{ $p->opdate }}" style="">Delete</a>
                                    @else
                                        <h1 class="kh22" style="color:red;">
                                            លោកអ្នកមិនអាចលុបបានទេ ព្រោះពាក់ព័ន្ធនិងបញ្ជីផ្សេងៗ
                                        </h1>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    <div class="row">
        <h1 class="kh22-b">តួលុយថៃ</h1>
        <div class="table-responsive">
            <table id="tblsms" class="table table-bordered table-hover" style="">
                <thead>
                    <thead style="text-align:center;">
                        <th style="width:60px;">No</th>
                        <th style="width:100px;">ID</th>
                        <th style="width:100px;">SMS DATE</th>
                        <th style="width:100px;">SMS TIME</th>
                        <th style="width:100px;">Send from</th>
                        <th style="width:100px;">AccountNo</th>
                        <th style="width:100px;">Thai Amount</th>
                        <th class="kh16" style="width:150px;">Action</th>
                        <th class="kh16" style="">SMS Text</th>

                    </thead>
                    <tbody>
                        @foreach ($sms as $key =>$s)

                            <tr>
                                <td class="kh16-b" style="text-align:center;">{{ ++$key }}</td>
                                <td class="kh16-b" style="text-align:center;">{{ $s->id }}</td>
                                <td class="kh16-b">{{ date('d-m-Y',strtotime($s->smsdate))}}</td>
                                <td class="kh16-b">{{ $s->smstime }}</td>
                                <td class="kh16-b">{{ $s->sendfrom }}</td>
                                <td class="kh16-b">{{ $s->accno }}</td>

                                <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($s->amount) . " THB" }}</td>

                                <td style="text-align:center;">
                                    @if($allowdelete==1 && $found_smsp==0)
                                        <a href="#" class="btn btn-danger btndeltrangroup" data-smsid="{{ $s->id }}" data-id="{{ $s->id }}" style="">Restore</a>

                                    @endif
                                </td>
                                <td class="kh14-b">{{ $s->smstext }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('ក្រុមបញ្ជីពាក់ព័ន្ធនិងការបើកវេរលុយថៃ');
        $(document).ready(function () {
            $(document).on('click','.btndeltrangroup',function(e){
                e.preventDefault();
                var btntext=$(this).text();
                var groupid=$(this).data('groupid');
                var smsid=$(this).data('smsid');
                var id=$(this).data('id');
                var opdate=$(this).data('opdate');
                var paymethod=$(this).data('paymethod');
                var url="{{ route('thaicashdraw.deletegroupid') }}";

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
                            url: url,
                            data: { id:id,groupid:groupid,smsid:smsid,paymethod:paymethod,btntext:btntext,opdate:opdate },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        data.message,
                                        'success'
                                    )
                                    var newItem = "refreshpagethai " + new Date().toLocaleString();
                                    addItemToStorage(newItem);
                                    window.close();
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
        function addItemToStorage(item) {
            // Add the new item to localStorage
            var items = JSON.parse(localStorage.getItem("items")) || [];
            items.push(item);
            localStorage.setItem("items", JSON.stringify(items));
            // Trigger an event to notify Page B
            localStorage.setItem("pageAItemAdded", "true");
        }


    </script>
@endsection
