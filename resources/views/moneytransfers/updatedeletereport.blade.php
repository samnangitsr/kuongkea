@extends('master')
@section('title') UpdateDeleteReport @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;font-weight:bold;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:white;font-weight:bold;}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;font-weight:bold;}
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
        /* #tbl_partner_transfer .clickedrow td,
        #tbl_partner_transfer .clickedrow td a {
            background-color: blue !important;
            color: white !important;
        } */
       #tbl_partner_transfer .clickedrow td{
        background-color: blue !important;
        color:white !important;
    }
    #tbl_partner_transfer .clickedrow td a {
        color: inherit !important;
    }

    #tblsearchmore td{
        border-style:none;
    }
    .delrecord{
        background-color:pink;
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

    <div class="row" style="margin-top:-10px;">
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16">
                  <th style="border-style:none;">គិតពី</th>
                  <th style="border-style:none;">ដល់</th>
                  <th style="border-style:none;">អតិថិជន</th>
                  <th style="border-style:none;">បុគ្គលិក</th>
                  <th style="border-style:none;">ប្រតិបត្តិការណ៏</th>
                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:120px;">
                        <div class="input-group" style="width:120px;">
                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:100px;background-color:silver;">
                            {{-- <span class="input-group-text"><i class="fa fa-calendar"></i></span> --}}
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:120px;">
                        <div class="input-group" style="width:120px;">
                            <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:100px;background-color:silver;">
                            {{-- <span class="input-group-text"><i class="fa fa-calendar"></i></span> --}}
                        </div>
                    </td>
                    <td style="padding:0px 5px;border-style:none;width:300px;">
                            <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;height:35px;" class="form-select kh16-b" required>
                                <option value="">ទាំងអស់</option>
                                @foreach ($customers as $p)
                                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach

                            </select>
                        </td>
                    <td style="border-style:none;padding:0px 5px;width:200px;">
                        <select class="form-select kh16-b" name="seluser" id="seluser" style="width:200px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px 5px;width:100px;" class="kh16-b">
                        <select name="seltran" id="seltran" style="height:30px;width:100px;">
                            <option value="2">កែលុប</option>
                            <option value="0">លុប</option>

                        </select>
                    </td>
                    <td style="padding:0px 0px 0px 5px;border-style:none;">
                        <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search</button>

                    </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="row" style="margin-top:20px;">
            <div class="table-responsive">
                <table id="tbl_partner_transfer" class="table table-bordered kh16">
                    <thead class="" style="text-align:center;">
                        <th>លរ</th>
                        <th>ក្រុម</th>
                        <th>ថ្ងៃទី</th>
                        <th>ម៉ោង</th>
                        <th>អ្នកកត់ត្រា</th>
                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ឈ្មោះដៃគូ</th>

                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>សេវ៉ាវេរ</th>
                        <th>សេវ៉ាដៃគូ</th>
                        <th>ពត៌មានអតិថិជន</th>
                        <th>ផ្សេងៗ</th>
                        <th>លុបដោយ</th>
                        <th>UpdatedAt</th>
                    </thead>
                    <tbody id="bodytransfer">
                        @php
                            $i=0;
                        @endphp
                        @foreach ($data as $key => $item)
                          @php
                              $i+=1;
                          @endphp
                          @foreach ($item as $n => $d)
                              <tr style="background-color: {{ $i % 2 == 1 ? 'rgb(245, 243, 241)' : 'azure' }}">
                                <td style="text-align:center;@if($d->status==0) background-color:red;color:white; @endif">{{ $i }}</td>
                                <td>
                                   <a href="#group{{ $key }}" class="kh14" style="text-decoration:underline;" data-bs-toggle="collapse"> {{ $key }}</a>
                                </td>
                                <td>{{ date('d-m-Y',strtotime($d->dd)) }}</td>
                                  <td>{{ $d->tt }}</td>
                                  <td>{{ $d->user->name }}</td>
                                  <td>{{ $d->tranname }}</td>
                                  <td>
                                      @if($d->child)
                                          {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
                                      @else
                                          {{ $d->partner->name }}
                                      @endif
                                  </td>

                                  <td class="kh18" style="text-align:right;">
                                      {{ phpformatnumber($d->amount)  . $d->currency->sk }}
                                  </td>
                                  <td class="kh18" style="text-align:right;">
                                      {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->sk }}
                                  </td>
                                  <td class="kh18" style="text-align:right;">
                                      {{ phpformatnumber($d->fee) . $d->feecurrency->sk }}
                                  </td>
                                  <td>
                                      @php
                                          $info1='';
                                          $info2='';
                                          if($d->recname){
                                              $info1='អ្នកទទួល:' . $d->recname;
                                          }
                                          if($d->rectel){
                                              if($info1==''){
                                                  $info1='អ្នកទទួល' . $d->rectel;
                                              }else{
                                                  $info1=$info1 . ' ' . $d->rectel;
                                              }
                                          }
                                          if($d->sendername){
                                              $info2='អ្នកផ្ញើ:' . $d->sendername;
                                          }
                                          if($d->sendertel){
                                              if($info2==''){
                                                  $info2='អ្នកផ្ញើ' . $d->sendertel;
                                              }else{
                                                  $info2=$info2 . ' ' . $d->sendertel;
                                              }
                                          }
                                      @endphp

                                    {{ $info1 }} <br> {{ $info2 }}
                                  </td>
                                  <td>{{ $d->note }}</td>
                                  <td></td>
                                  <td>{{ date('d-m-Y H:i:s',strtotime($d->updated_at)) }}</td>
                              </tr>

                          @endforeach
                             @php

                                    $countdata=0;
                                    $datarefs=App\PartnerTransfer::showByIdAndGroup($key);
                                @endphp


                            @foreach ($datarefs ?? [] as $trf)
                                 @php
                                    $info1='';
                                    $info2='';
                                    if($trf->recname){
                                        $info1='អ្នកទទួល:' . $trf->recname;
                                    }
                                    if($d->rectel){
                                        if($info1==''){
                                            $info1='អ្នកទទួល' . $trf->rectel;
                                        }else{
                                            $info1=$info1 . ' ' . $trf->rectel;
                                        }
                                    }
                                    if($trf->sendername){
                                        $info2='អ្នកផ្ញើ:' . $trf->sendername;
                                    }
                                    if($trf->sendertel){
                                        if($info2==''){
                                            $info2='អ្នកផ្ញើ' . $trf->sendertel;
                                        }else{
                                            $info2=$info2 . ' ' . $trf->sendertel;
                                        }
                                    }
                                @endphp
                                <tr id="group{{ $key }}" class="collapse show kh16" style="background-color: {{ $i % 2 == 1 ? 'rgb(245, 243, 241)' : 'azure' }}">
                                    <td style="text-align:center;@if($trf->status==0) background-color:red;color:white; @endif">{{ $i }}</td>
                                    <td>{{ sprintf("%04d",$trf->id) }}</td>
                                    <td>
                                        {{ date('d-m-Y',strtotime($trf->dd)) }}
                                    </td>
                                     <td>
                                        {{ $trf->tt }}
                                    </td>
                                    <td>{{ $trf->user->name }}</td>
                                    <td>{{ $trf->tranname . '(' . $trf->trancode . ')'}}</td>
                                    <td>{{ $trf->partner->name }}</td>
                                    <td style="text-align:right;font-size:18px;">{{ phpformatnumber($trf->amount) . $trf->currency->sk }}</td>
                                    <td style="text-align:right;font-size:18px;">{{ phpformatnumber($trf->cuscharge) . $trf->cuschargecur->sk }}</td>
                                    <td style="text-align:right;font-size:18px;">
                                        @if($trf->fee && $trf->fee<>0)
                                        {{ phpformatnumber($trf->fee) . $trf->feecurrency->sk }}
                                        @endif
                                        @if($trf->interest && $trf->interest<>0)
                                        {{ phpformatnumber($trf->interest) . $trf->currency->sk }}
                                        @endif
                                    </td>
                                    <td> {{ $info1 }} <br> {{ $info2 }}</td>
                                    <td>{{ $trf->note }}</td>
                                    <td style="@if($trf->status==0) color:red; @endif">{{ $trf->status==0?$trf->userdelete->name:'' }}</td>
                                     <td>{{ date('d-m-Y H:i:s',strtotime($trf->updated_at)) }}</td>
                                </tr>
                            @endforeach


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
        $('#seluser').select2();
        $('#h1_title').text('របាយការណ៏កែលុប');
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

        $(document).on('click','#tbl_partner_transfer td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })

         $('#tbl_partner_transfer').on('dblclick', '.rowclick', function(event) {
            var ind=$(this).index();
            var row=$(this).closest('tr');
            var id=row.find("td:eq(1)").text();
            var refnum=row.find("td:eq(13)").text();
            var cashdrawcode=row.find("td:eq(14)").text();
            if(refnum!='' || cashdrawcode !=''){
                //alert(refnum + ',' + cashdrawcode)
                return;
            }
            var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/edit?id='+id, '_blank');
            redirectWindow.location;
		});
        $(document).on('click','.showrelate',function(e){
            e.preventDefault();
            var refnum=$(this).data('refnum');

            $('#showrelatemodal').modal('show');
            var url="{{ route('moneytransfer.showrelate_refnumber') }}";
            $.get(url,{refnum:refnum},function(data){
                //console.log(data);
                var output='';
                var k=0;
                for(var i=0;i<data['transfers'].length;i++){
                    k+=1;
                    if(data['tablename']=='transfer'){
                      output=`
                              <tr class="kh16-b">
                                  <td>លរ</td>
                                  <td>TID</td>
                                  <td>ថ្ងៃទី</td>
                                  <td>ម៉ោង</td>
                                  <td>អ្នកកត់ត្រា</td>
                                  <td>ប្រតិបត្តិការណ៏</td>
                                  <td>ឈ្មោះដៃគូ</td>
                              </tr>
                              <tr>
                                  <td>${k}</td>
                                  <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                  <td> ${ moment(data['transfers'][i].dd).format("DD-MM-YYYY") }</td>
                                  <td>${data['transfers'][i].tt}</td>
                                  <td>${data['transfers'][i].user.name}</td>
                                  <td>${data['transfers'][i].tranname}</td>
                                  <td>${data['transfers'][i].partner.name}</td>
                              </tr>

                              <tr class="kh16-b">
                                  <td></td>
                                  <td>ចំនួនទឹកប្រាក់</td>
                                  <td>សេវ៉ាវេ</td>
                                  <td>សេវ៉ាដៃគូ</td>
                                  <td colspan=2>ព៌តមានអតិថិជន</td>
                                  <td>ផ្សេងៗ</td>

                              </tr>
                              <tr>
                                  <td></td>
                                  <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                  <td>${formatNumber(data['transfers'][i].cuscharge) + data['transfers'][i].cuschargecur.shortcut}</td>
                                  <td>${formatNumber(data['transfers'][i].fee) + data['transfers'][i].currency.shortcut}</td>
                                  <td colspan=2>${data['transfers'][i].rectel??'' + ' ' + data['transfers'][i].recname??''}</td>
                                  <td>${data['transfers'][i].note??''}</td>
                              </tr>
                              `;

                    }else if(data['tablename']=='cashdraw'){
                      output=`
                            <tr class="kh16-b">
                                <td>លរ</td>
                                <td>ID</td>
                                <td>ថ្ងៃបើក</td>
                                <td>ម៉ោងបើក</td>
                                <td>អ្នកកត់ត្រា</td>
                                <td>ប្រភេទទូទាត់</td>
                                <td>ឈ្មោះដៃគូ</td>
                            </tr>
                            <tr>
                                <td>${k}</td>
                                <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                <td> ${ moment(data['transfers'][i].opdate).format("DD-MM-YYYY") }</td>
                                <td>${data['transfers'][i].optime}</td>
                                <td>${data['transfers'][i].user.name}</td>
                                <td>${data['transfers'][i].paymethod}</td>
                                <td>${data['transfers'][i].frompartner.name}</td>
                            </tr>

                            <tr class="kh16-b">
                                <td></td>
                                <td>ចំនួនទឹកប្រាក់</td>
                                <td>កាត់សេវ៉ា</td>
                                <td colspan=2>ព៌តមានអ្នកបើកវេរ</td>
                                <td colspan=2>ផ្សេងៗ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                <td>${formatNumber(data['transfers'][i].customer_charge) + data['transfers'][i].currency.shortcut}</td>
                                <td colspan=2>${data['transfers'][i].receive_tel + ' ' + data['transfers'][i].receive_name??''}</td>
                                <td colspan=2>${data['transfers'][i].note??'' + ' ' + data['transfers'][i].other??''}</td>
                            </tr>
                            `;
                    }else if(data['tablename']=='usercapital'){
                      output=`
                            <tr class="kh16-b">
                                <td>លរ</td>
                                <td>ID</td>
                                <td>ថ្ងៃទី</td>
                                <td>ម៉ោង</td>
                                <td>អ្នកកត់ត្រា</td>
                                <td>ពាក់ព័ន្ធបុគ្គលិក</td>
                                <td>ប្រតិបត្តិការណ៏</td>
                            </tr>
                            <tr>
                                <td>${k}</td>
                                <td>${String(data['transfers'][i].id).padStart(4,'0')}</td>
                                <td> ${ moment(data['transfers'][i].trandate).format("DD-MM-YYYY") }</td>
                                <td>${data['transfers'][i].trantime}</td>
                                <td>${data['transfers'][i].user.name}</td>
                                <td>${data['transfers'][i].useraffect.name}</td>
                                <td>${data['transfers'][i].tranname}</td>
                            </tr>

                            <tr class="kh16-b">
                                <td></td>
                                <td>ចំនួនទឹកប្រាក់</td>

                                <td colspan=5>ផ្សេងៗ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>${formatNumber(data['transfers'][i].amount) + data['transfers'][i].currency.shortcut}</td>
                                <td colspan=2>${data['transfers'][i].note??''}</td>
                            </tr>
                            `;
                    }
                }
                $('#tbody_ref_num').empty().html(output);
            })
        })
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
        $(document).on('click','.btnprint',function(e){
            e.preventDefault()
            var id=$(this).data('id');
            printtransfers(id)
        })
        function printtransfers(tr_id,hasexchange,hasbankpayment){

                var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/print?tr_id='+tr_id , '_blank');
                redirectWindow.location;
        }
        $(document).on('click','#btnsearch',function(e){
            e.preventDefault()
            searchmore=0;
            SearchTransfer(0);
        })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
            searchmore=1;
            SearchTransfer(1);
        })
        $(document).on('change','#selcustomer,#seluser,#selcur,#seltran',function(e){
            e.preventDefault()
            searchmore=0;
            SearchTransfer(0);
        })
        var searchmore=0;
        function SearchTransfer(searchmore)
        {
            $('body').addClass("wait");
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var user=$('#seluser').val();
            var customer=$('#selcustomer').val();
            var seltran=$('#seltran').val();
            var url="{{ route('moneytransfer.search_update_delete_record') }}";
             $.ajax({
                    async:true,
                    type: 'GET',
                    url: url,
                    data: {d1:d1,d2:d2,user:user,customer:customer,seltran:seltran},
                    complete: function () {},
                    success: function (data) {
                        //console.log(data)
                       $('#bodytransfer').empty().html(data);
                        $('body').removeClass("wait");
                    },
                    error: function () {
                        $('body').removeClass("wait");
                        alert('Read Data Error.')
                    }
                })
        }

        $(document).on('keydown','#txtsearchbyamt1,#txtsearchbytel,#txtsearchbyamt2',function(e){

            if(e.keyCode==13){
                searchmore=1;
                SearchTransfer(1);
            }
        })
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
