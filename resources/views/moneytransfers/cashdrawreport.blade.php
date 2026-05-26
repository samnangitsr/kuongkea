@extends('master')
@section('title') Cashdraw List @endsection
@section('css')
    <style type="text/css">
        body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;font-weight:bold;border:1px solid black;height:33px;background-color:whitesmoke;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;font-weight:bold;border:1px solid black;height:33px;background-color:white}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:14px;height:30px;}
         .kh16{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
            }
            .kh16-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
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
        .kh18{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
       /* td{
        border-style:none;
       } */
    #tbl_partner_transfer .clickedrow td{
        background-color: #caaf8f;
    }
    #tbl_partner_transfer td{
        padding:3px;
    }
    #tbl_partner_transfer th{
        padding:3px;
    }
    #tbl_summary .clickedrow td{
        background-color: #c0e98d;
    }
    #tblsearchmore td{
        border-style:none;
    }
    .tblsearch td{
        padding:0px 5px;
        border-style:none;
    }
    .mybtn{
        border:1px solid black;
        height:33px;
        width:80px;
    }
    .mybtn:hover{
        background-color:blue;
        color:white;
    }
    .tableFixHead{ overflow: auto;border:1px solid blue;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbldetail td{
        border:1px solid black;
    }
    .tbldetail th{
        border:1px solid black;
    }
    .tbl_summary td{
        border:1px solid blue;
        border-collapse: collapse;
        padding:0px 5px;
    }
    .tbl_summary th{
        border:1px solid blue;
        border-collapse: collapse;
        padding:0px 5px;
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
    <div class="row" style="margin-top:-20px;">
        <div class="table-responsive" style="padding:0px;">
            <table class="table tblsearch">
                <tr class="kh14-b">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                    <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                    <th style="border-style:none;">បុគ្គលិក</th>
                    <th style="border-style:none;">រូបិយប័ណ្ណ</th>
                </tr>
                <tr>

                    <td style="width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d1" id="d1" class="form-control kh14-b" style="width:100px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d2" id="d2" class="form-control kh14-b" style="width:100px;background-color:silver;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="width:250px;">
                        <select name="selcustomer" id="selcustomer" style="width:250px;margin-top:-60px;" class="form-select kh14-b" required>
                          <option value="">ទាំងអស់</option>
                          @foreach ($partners as $p)
                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                            @endforeach
                          @if(Auth::user()->role->name=='Admin')
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}" customertype="{{ $p->customertype }}">{{ $c->name }}</option>
                            @endforeach
                          @endif
                        </select>
                    </td>
                    <td style="width:200px;">
                        <select class="form-select kh14-b" name="seluser" id="seluser" style="width:200px;">
                            <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="width:100px;">
                        <select class="form-select kh14-b" name="selcur" id="selcur" style="width:100px;">
                            <option value="">All</option>
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="">
                        <button class="mybtn kh14-b" id="btnsearch">Search</button>
                        <button class="mybtn kh14-b" id="btnprint">Print</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    <div id="divdata">
        <div class="row" style="margin-top:0px;">
                <div class="tableFixHead" style="padding:0px;">
                    <table id="tbl_partner_transfer" class="table table-bordered table-hover kh14" style="table-layout:fixed;">
                        <thead style="text-align:center;">
                            <th style="width:60px;">លរ</th>
                            <th style="width:150px;">ថ្ងៃបើកវេរ</th>
                            <th style="width:120px;">អ្នកបើក</th>
                            <th style="width:120px;">ចំនួនទឹកប្រាក់</th>
                            <th style="width:100px;">កាត់សេវ៉ា</th>
                            <th style="width:120px;">លុយបើក</th>
                            <th style="width:200px;">ពត៌មានអ្នកបើកវេរ</th>
                            <th style="width:100px;">ប្រភេទទូទាត់</th>
                            <th style="width:100px;">Action</th>

                            <th style="width:150px;">ថ្ងៃវេរ</th>
                            <th style="width:120px;">អ្នកកត់ត្រា</th>
                            <th style="width:120px;">វេរមកពី</th>
                            <th style="width:2000px;">ផ្សេងៗ</th>

                        </thead>

                        <tbody id="bodytransfer">
                            @foreach ($data as $key => $d)

                                    <tr class="rowclick">
                                        <td style="text-align:center;">{{ ++$key }}</td>

                                        <td>{{ date('d-m-y',strtotime($d->opdate)) . ' ' . $d->optime }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount) .  $d->currency->sk }}</td>
                                        <td class="kh14-b" style="text-align:right;@if($d->customer_charge<=0)color:red;@endif">{{ phpformatnumber($d->customer_charge) .  $d->currency->sk }}</td>
                                        <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($d->amount-$d->customer_charge) .  $d->currency->sk }}</td>
                                        <td>{{ $d->receive_tel . ' ' . $d->receive_name }}</td>
                                        <td>{{ $d->paymethod }}</td>
                                        <td style="">
                                          @if(str_contains($d->action,'d'))
                                            <a href="#" class="mybtn btndelcashdraw" style="color:red;padding:0px 5px;" data-id="{{ $d->id }}" data-transfer_id="{{ $d->transfer_id }}"><i class="fa fa-trash" style=""></i></a>
                                          @endif
                                          <a href="#ref{{ $d->id }}" class="mybtn kh14-b" style="padding:0px 5px;@if($d->have_exchange==true) background-color:blue;color:white; @elseif($d->have_exchange==false && $d->customer_charge>0) background-color:yellow;color:black; @elseif($d->have_exchange==false && $d->customer_charge<=0) background-color:red;color:white; @endif" data-bs-toggle="collapse" >{{ $d->id }}</a>
                                        </td>
                                         <td>{{ date('d-m-y',strtotime($d->partnertransfer->dd)) . ' ' .  $d->partnertransfer->tt }}</td>
                                        <td>{{ $d->partnertransfer->user->name }}</td>
                                        <td>{{ $d->partnertransfer->partner->name }}</td>
                                        <td>{{ $d->other }}</td>
                                    </tr>
                                  @php

                                    $datarefs=App\Cashdraw::showlinkgroup_new($d->ref_group_id,$d->transfer_id);
                                  @endphp
                                  @if($datarefs['transfers'] && !$datarefs['transfers']->isEmpty())
                                    <tr id="ref{{ $d->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                        <td colspan=14>
                                            <table class="tbldetail">
                                                <thead style="text-align:center;">
                                                    <th>TID</th>
                                                    <th>ថ្ងៃទី</th>
                                                    <th>អ្នកកត់ត្រា</th>
                                                    <th>ដៃគូ</th>
                                                    <th>ប្រតិបត្តិការណ៏</th>
                                                    <th>សរុបទឹកប្រាក់</th>
                                                    <th>សេវ៉ាដៃគូ</th>
                                                    <th>សេវ៉ាអតិថិជន</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>ផ្សេងៗ</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($datarefs['transfers'] as $key => $item)
                                                    <tr class="kh16" style="">
                                                        <td>{{ sprintf("%04d",$item->id) }}</td>
                                                        <td>
                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td>{{ $item->partner->name }}</td>
                                                        <td>{{ $item->tranname }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->amount) . $item->currency->sk }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->fee) . $item->currency->sk }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->cuscharge) . $item->cuschargecur->sk }}</td>
                                                        <td>{{ $item->sendertel . ' ' . $item->senername }}</td>
                                                        <td>{{ $item->rectel . ' ' . $item->recname }}</td>
                                                        <td>{{ $item->note }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                  @endif

                                 @if($datarefs['exchanges'] && !$datarefs['exchanges']->isEmpty())

                                    <tr id="ref{{ $d->id }}" class="collapse" style="background-color:rgb(206, 240, 229);">
                                      <td colspan=14>
                                          <table class="tbldetail">
                                              <thead style="text-align:center;">
                                                  <th>ID</th>
                                                  <th>ថ្ងៃទី</th>
                                                  <th>អ្នកកត់ត្រា</th>
                                                  <th>ទិញចូល</th>
                                                  <th>លក់ចេញ</th>
                                                  <th>អត្រា</th>
                                                  <th>ផ្សេងៗ</th>
                                              </thead>
                                              <tbody>
                                                 @foreach ($datarefs['exchanges'] as $item)
                                                    <tr class="kh16" style="text-align:center;">
                                                        <td>{{ sprintf("%04d",$item->mapcode) }}</td>
                                                        <td>
                                                            {{ date('d-m-Y',strtotime($item->dd))  . ' ' . $item->tt }}
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->buy) . ' ' . $item->curbuy }}</td>
                                                        <td style="text-align:right;">{{ phpformatnumber($item->sale) . ' ' . $item->cursale }}</td>
                                                        <td>{{ phpformatnumber($item->rate)}}</td>
                                                        <td>{{ $item->note }}</td>
                                                    </tr>
                                                 @endforeach
                                              </tbody>
                                          </table>
                                      </td>
                                    </tr>

                                @endif
                            @endforeach
                            <tr>
                                <td colspan=13>
                                    <table id="tbl_summary" class="kh16-b tbl_summary">
                                        <thead>
                                            <th>ប្រភេទទូទាត់</th>
                                            <th>សរុបលុយវេរ</th>
                                            <th>សរុបសេវ៉ា</th>
                                            <th>សរុបលុយបើក</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($summary as $s)
                                            <tr class="rowclick">
                                                <td>{{ $s->paymethod }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tamt) .  $s->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tcharge) . $s->currency->sk }}</td>
                                                <td style="text-align:right;">{{ phpformatnumber($s->tamt-$s->tcharge) . $s->currency->sk }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>

    </div>
@endsection
@section('script')

    <script type="text/javascript">
     $('#h1_title').text('របាយការណ៏បើកវេរក្នុងស្រុក');
     function formatOption(option) {
          if (!option.id) {
            return option.text;
          }
          // Use a <div> to display the main text and a second line
          // option.element.value is get value from select
          var $option = $(
            '<div class="select2-option">' +
              '<div class="select2-option-main">' + option.text + '</div>' +
              '<div class="select2-option-sub" style="font-size:12px;color:red">' + (option.selected ? option.element.getAttribute('customertype') : option.element.getAttribute('customertype')) + '</div>' +
            '</div>'
          );
          return $option;
        }
    $(document).ready(function () {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var divheight=windowHeight-200;
        var tableFixHead=document.getElementsByClassName('tableFixHead');
        for(i=0; i<tableFixHead.length; i++) {
          tableFixHead[i].style.height=divheight+'px';
        }
        $(window).resize(function() {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-200;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        });
        $('#selcustomer').select2({templateResult: formatOption});
        $('#seluser').select2();
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
            $(document).on('click','.btndelcashdraw',function(e){
                e.preventDefault();
                var id=$(this).data('id');
                var transfer_id=$(this).data('transfer_id');
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
                            url: "{{ route('cashdraw.delete') }}",
                            data: { id:transfer_id,cashdraw_id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    SearchCashdraw(0);

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
        $(document).on('click','#tbl_partner_transfer td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tbl_summary td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $('#tbl_partner_transfer').on('dblclick', '.rowclick', function(event) {
            var ind=$(this).index();
            var row=$(this).closest('tr');
            id=row.find("td:eq(1)").text();
            var htp=window.location.protocol;
            var htn=window.location.hostname;
            var redirectWindow = window.open(htp+'//'+htn+'/chaybros.com/moneytransfer/edit?id='+id, '_blank');
            redirectWindow.location;
		});
        $(document).on('change','#selsearchby',function(e){
            e.preventDefault();
            var searchby=$(this).val();
            if(searchby=='tel'){
                $('#col2').css('display','block');
                $('#col3').css('display','none');
                $('#col4').css('display','none');

            }else if(searchby=='amt'){
                $('#col2').css('display','none');
                $('#col3').css('display','block');
                $('#col4').css('display','block');
            }
        })
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            SearchCashdraw(0);
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault()
            SearchCashdraw(1);
        })
        $(document).on('change','#selcustomer,#seluser,#selcur',function(e){
            e.preventDefault()
            SearchCashdraw(0);
        })

        function SearchCashdraw(isprint)
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var user=$('#seluser').val();
            var username=$('#seluser option:selected').text();
            var datestr='';
            if(d1==d2){
              datestr='ថ្ងៃទី ' + $('#d1').val();
            }else{
              datestr='គិតពី ' + $('#d1').val() + ' ដល់ '+$('#d2').val();
            }

            var cur=$('#selcur').val();
            var url="{{ route('moneytransfer.cashdrawsearch') }}";
            if(isprint==1){
              var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/cashdrawsearch?partner='+partner +'&d1='+d1+'&d2='+d2+'&user='+user+'&cur='+cur+'&isprint='+isprint+'&username='+username+'&datestr='+datestr, '_blank');
              redirectWindow.location;
              $('body').removeClass("wait");
            }else{
              $.get(url,{d1:d1,d2:d2,partner:partner,user:user,cur:cur,isprint:isprint},function(data){
                  //console.log(data);
                  $.ajax({
                        async: true,
                        type: 'GET',
                        url: url,
                        data: {d1:d1,d2:d2,partner:partner,user:user,cur:cur,isprint:isprint},
                        success: function (data) {
                            //console.log(data)
                            if($.isEmptyObject(data.error)){
                                $('#divdata').empty().html(data);
                                var tableFixHead=document.getElementsByClassName('tableFixHead');
                                for(i=0; i<tableFixHead.length; i++) {
                                    tableFixHead[i].style.height=divheight+'px';
                                }
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

              })

            }
        }


        $(document).on('click','.btndelete',function(e){
                e.preventDefault();
                var invid=$(this).data('id');
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
                            url: "{{ route('moneytransfer.delete') }}",
                            data: { id:invid },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    SearchTransfer(searchmore);
                                    //location.reload();
                                    //$('#btnsearch').click();
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



    function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }


    </script>
@endsection
