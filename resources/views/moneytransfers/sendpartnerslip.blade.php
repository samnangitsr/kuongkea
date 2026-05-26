@extends('master')
@section('title') send partner slip @endsection
@section('css')
    <style type="text/css">
        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:whitesmoke;border:1px dotted black;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white}

        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;background-color:white;border:1px dotted black;}
		/* Each result */
		#select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:35px;}
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
       #tblsend .clickedrow td{
        background-color: #caaf8f;
    }
    #tblsent .clickedrow td{
        background-color: #6ae6e6;
    }
    #tblsearchmore td{
        border-style:none;
    }
    #tblsend td{
        padding:3px;
    }
    #tblsend th{
        padding:3px;
    }
    #tblsent td{
        padding:3px;
    }
    #tblsent th{
        padding:3px;
    }
    .mybtn{
        padding:0px 5px;
        border:1px dotted black;
    }
    .mybtn:hover{
        background-color:green;
        color:white;
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

    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
    <div class="row" style="margin-top:-20px;">
        <div class="table-responsive">
            <table class="table">
                <tr class="kh16">
                    <th style="border-style:none;">គិតពី</th>
                    <th style="border-style:none;">ដល់</th>
                    <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                    <th style="border-style:none;">បុគ្គលិក</th>

                </tr>
                <tr>

                    <td style="padding:0px;border-style:none;width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d1" id="d1" class="form-control" style="width:110px;height:35px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                    </td>
                    <td style="padding:0px;border-style:none;width:160px;">
                        <div class="input-group" style="width:160px;">
                            <input type="text" name="d2" id="d2" class="form-control" style="width:100px;height:35px;background-color:silver;font-size:16px;">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </td>
                    <td style="padding:0px;border-style:none;width:310px;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select kh16" required>
                            <option value="">ទាំងអស់</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="border-style:none;padding:0px;width:260px;">
                        <select class="form-select kh22" name="seluser" id="seluser" style="width:250px;">
                            <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </td>
                <td style="padding:0px;border-style:none;">
                        <button class="btn btn-info btn-sm kh16" id="btnsearch">Search</button>
                        <button class="btn btn-primary btn-sm kh16" id="btnsearchmore" data-bs-toggle="collapse" data-bs-target="#searchmore">Search more</button>
                </td>
                </tr>

            </table>
        </div>
    </div>
    <div id="searchmore" class="collapse">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-3">
                <label class="kh16-b" for="searchby">ស្វែងរកតាម</label>
                <select name="selsearchby" id="selsearchby" class="form-select kh16-b" style="height:35px;width:100%;padding-top:0px;">
                    <option value="tel">លេខទូរស័ព្ទ</option>
                    <option value="amt">ចំនួនទឹកប្រាក់</option>
                </select>
            </div>
            <div class="col-lg-3" id="col2">
                <label class="kh16-b" for="stel">លេខទូរស័ព្ទ</label>
                <input type="text" id="txtsearchbytel" class="form-control kh16-b" style="width:100%;height:35px;">
            </div>
            <div class="col-lg-3" id="col3" style="display:none;">
                <label class="kh16-b" for="samt1">ពីចំនួន</label>
                <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:35px;">
            </div>
            <div class="col-lg-3" id="col4" style="display:none;">
                <label class="kh16-b" for="samt2">ដល់ចំនួន</label>
                <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:35px;">
            </div>
            <div class="col-lg-3">

               <button id="btnsearch2" class="btn btn-info btn-sm kh16-b" style="margin-top:25px;">Search</button>
            </div>
        </div>
    </div>
    <div id="sendtopartner">
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <td class="kh16-b" style="color:blue">
                        ប្រតិបត្តិការណ៏មិនទាន់បានផ្ញើ
                        <button id="btnsendselected" class="mybtn kh16">Send Selected Invoice</button>
                    </td>

                </tr>
               </table>
        </div>
        <div class="row" style="margin-top:0px;">


                    <table id="tblsend" class="table table-bordered table-hover kh16 tblsend">

                        <thead style="text-align:center;">
                            <th>លរ</th>
                            <th>TID</th>
                            <th>ថ្ងៃទី</th>
                            <th>ម៉ោង</th>
                            <th>អ្នកកត់ត្រា</th>
                            <th>ប្រតិបត្តិការណ៏</th>
                            <th>ឈ្មោះដៃគូ</th>
                            <th>អតិថិជន</th>
                            <th>ចំនួនទឹកប្រាក់</th>
                            <th>សេវ៉ាវេរ</th>
                            <th>សេវ៉ាដៃគូ</th>
                            <th>ពត៌មានអតិថិជន</th>
                            <th>ផ្សេងៗ</th>
                            <th>លេខយោង</th>
                            <th>កូតបើកវេរ</th>
                            <th>សកម្មភាព</th>
                        </thead>
                        <tbody id="bodytransfer">
                        @foreach ($notyetsent as $key => $d)
                                <tr class="rowclick">
                                    <td style="text-align:center;">
                                        <div class="form-check">
                                            <label class="form-check-label kh16">
                                              <input class="form-check-input ckno1" type="checkbox" name="ckno1"> {{ ++$key }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $d->id }}</td>
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
                                    <td>{{ $d->customer->name }}</td>
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
                                    <td>{{ $d->ref_number }}</td>
                                    <td>{{ $d->cashdraw_id }}</td>
                                    @if(is_null($d->ref_number) && is_null($d->cashdraw_id))
                                        <td style="text-align:center;">
                                            {{-- <a href="{{ route('moneytransfer.sendslip',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">Slip</a> --}}
                                            <button id="btnsendslip" class="mybtn" >Send</button>
                                        </td>


                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

        </div>
        <div class="row">
           <table class="table table-bordered">
            <tr>
                <td class="kh16-b" style="color:green">
                    ប្រតិបត្តិការណ៏បានផ្ញើរួច
                    <button id="btnresentselected" class="mybtn kh16">ReSend Selected Item</button>
                </td>

            </tr>
           </table>
        </div>
        <div class="row" style="margin-top:0px;">

                <table id="tblsent" class="table table-bordered table-hover kh16">
                    <thead style="text-align:center;">
                        <th>លរ</th>
                        <th>TID</th>
                        <th>ថ្ងៃទី</th>
                        <th>ម៉ោង</th>
                        <th>អ្នកកត់ត្រា</th>
                        <th>ប្រតិបត្តិការណ៏</th>
                        <th>ឈ្មោះដៃគូ</th>
                        <th>អតិថិជន</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>សេវ៉ាវេរ</th>
                        <th>សេវ៉ាដៃគូ</th>
                        <th>ពត៌មានអតិថិជន</th>
                        <th>ផ្សេងៗ</th>
                        <th>លេខយោង</th>
                        <th>កូតបើកវេរ</th>
                        <th>សកម្មភាព</th>
                    </thead>
                    <tbody id="bodytransfer">
                    @foreach ($sent as $key => $d)
                            <tr class="rowclick">
                                <td style="text-align:center;">
                                    <div class="form-check">
                                        <label class="form-check-label kh16">
                                          <input class="form-check-input ckno" type="checkbox" name="ckno"> {{ ++$key }}
                                        </label>
                                      </div>
                                </td>
                                <td>{{ $d->id }}</td>
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
                                <td>{{ $d->customer->name }}</td>
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
                                <td>{{ $d->ref_number }}</td>
                                <td>{{ $d->cashdraw_id }}</td>
                                @if(is_null($d->ref_number) && is_null($d->cashdraw_id))
                                    <td style="text-align:center;">
                                        {{-- <a href="{{ route('moneytransfer.sendslip',['id'=>$d->id]) }}" class="btn btn-warning btn-sm" target="_blank">Slip</a> --}}
                                        <button id="btnsentslip" class="mybtn" >ReSent</button>
                                    </td>


                                @endif
                            </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
    $('#h1_title').text('ផ្ញើអោយដៃគូ');
    $(document).ready(function () {
        $('#selcustomer').select2();
        $('#seluser').select2();
        checkright();
        function checkright()
        {
            var role=$('#txtrole').val();
            if(role!='Admin'){
                //$('#invdate').datetimepicker("destroy");
                $('#seluser').prop('disabled',true);
            }
        }
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
        var cleave = new Cleave('#txtsearchbyamt1', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#txtsearchbyamt2', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#txtsearchbytel', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        $(document).on('click','#tblsend td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         $(document).on('click','#tblsent td',function(e){
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
        $(document).on('click','#btnsendslip',function(e){
            e.preventDefault();
            var ind=$(this).index();
            var row=$(this).closest('tr');
            id=row.find("td:eq(1)").text();
            var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/sendslip?id='+id, '_blank');
            redirectWindow.location;
            //$('#btnsearch').click();
            location.reload();
            //location.href='{{ url('/') }}'+'/moneytransfer/sendpartnerslip'
            // if(searchmore==0){
            //     $('#btnsearch').click();
            // }else{
            //     $('#btnsearch2').click();
            // }


        })
        $(document).on('click','#btnsendselected',function(e){
            e.preventDefault();
            var selid=[];
            var i=0;
            $("#tblsend input[type=checkbox]:checked").each(function (){
                i++;
                var row = $(this).closest("tr");
	            var tid=row.find("td:eq(1)").text();
                selid.push(tid);
            })

                var ind=$(this).index();
                var row=$(this).closest('tr');
                id=row.find("td:eq(1)").text();
                var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/sendslip?id='+selid, '_blank');
                redirectWindow.location;
                location.reload();

        })
        $(document).on('click','#btnresentselected',function(e){
            e.preventDefault();
            var selid=[];
            var i=0;
            $("#tblsent input[type=checkbox]:checked").each(function (){
                i++;
                var row = $(this).closest("tr");
	            var tid=row.find("td:eq(1)").text();
                selid.push(tid);
            })
            let text = "Do you want to send slip to partner again?.";
            if (confirm(text) == true) {
                var ind=$(this).index();
                            var row=$(this).closest('tr');
                            id=row.find("td:eq(1)").text();
                            var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/sendslip?id='+selid, '_blank');
                            redirectWindow.location;

            }
        })
        $(document).on('click','#btnsentslip',function(e){
            e.preventDefault();
            let text = "Do you want to send slip to partner again?.";
            if (confirm(text) == true) {
                var ind=$(this).index();
                            var row=$(this).closest('tr');
                            id=row.find("td:eq(1)").text();
                            var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/sendslip?id='+id, '_blank');
                            redirectWindow.location;
            } else {

            }

        })
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
        $(document).on('change','#selcustomer,#seluser',function(e){
            e.preventDefault()
            searchmore=0;
            SearchTransfer(0);
        })
        var searchmore=0;
        function SearchTransfer(searchmore)
        {

            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var user=$('#seluser').val();
            var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
            var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
            var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
            var searchby=$('#selsearchby').val();
            var url="{{ route('moneytransfer.searchsendpartnerslip') }}";
            $.get(url,{d1:d1,d2:d2,partner:partner,user:user,searchby:searchby,tel:tel,amt1:amt1,amt2:amt2,searchmore:searchmore},function(data){
                //console.log(data);

                $('#sendtopartner').empty().html(data);
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
