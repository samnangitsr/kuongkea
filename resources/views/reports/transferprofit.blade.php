@extends('master')
@section('title') ផ្ទេរប្រាក់ចំណេញ @endsection
@section('css')
    <style type="text/css">
     body.wait *{
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
        .kh14{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            }
        .kh14-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:14px;
            font-weight:bold;
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
    #tblsearchmore td{
        border-style:none;
    }
    .delrecord{
        background-color:red;
    }
    #tbl_partner_transfer td{
        padding:5px;
    }
    #tbl_partner_transfer th{
        padding:5px;
    }

    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    td {
  white-space: normal;
  word-wrap: break-word; /* for older browsers */
  overflow-wrap: break-word; /* modern standard */
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
    <div class="row" style="margin-top:0px;position:fixed;top:60px;z-index:1;background-color:silver;width:100%;">

        <div class="row" style="margin-top:0px;">
            <div class="table-responsive">
                <table class="table">
                    <tr class="kh16">
                        <th style="border-style:none;">គិតពី</th>
                        <th style="border-style:none;">ដល់</th>
                        <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                        <th style="border-style:none;">រូបិយប័ណ្ណ</th>
                        <th style="border-style:none;">បុគ្គលិក</th>

                    </tr>
                    <tr>
                        <td style="padding:0px;border-style:none;width:150px;">
                            <div class="input-group" style="width:150px;">
                                <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:170px;background-color:silver;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:150px;">
                            <div class="input-group" style="width:150px;">
                                <input type="text" name="d2" id="d2" class="form-control kh16-b" style="width:150px;background-color:silver;">
                            </div>
                        </td>
                        <td style="padding:0px;border-style:none;width:300px;">
                            <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select kh16-b" required>
                                <option value="">ទាំងអស់</option>
                                @foreach ($partners as $p)
                                  <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                @endforeach

                            </select>
                        </td>

                        <td style="border-style:none;padding:0px;width:150px;">
                            <select class="form-select kh16-b" name="selcur" id="selcur" style="width:150px;">
                                <option value="">All</option>
                                @foreach ($currencies as $c)
                                    <option value="{{ $c->id }}" sk="{{ $c->sk }}">{{ $c->shortcut }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="border-style:none;padding:0px;width:200px;">
                            <select class="form-select kh16-b" name="seluser" id="seluser" style="width:200px;">
                                <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="padding:0px 0px 0px 5px;border-style:none;">
                            <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search</button>
                            <button class="btn btn-info btn-md kh16-b" id="btnprintreport">Print</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <div id="displayprofit" class="tableFixHead" style="margin-top:80px;">


    </div>

@endsection
@section('script')

    <script type="text/javascript">

    $(document).ready(function () {
        $('#selcustomer').select2();
        $('#seluser').select2();
        $('#h1_title').text('របាយការណ៏ប្រាក់ចំណេញផ្ទេរប្រាក់');
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
        setheighttablefixhead(210);
        $(window).resize(function() {
            setheighttablefixhead(210);
        });
        function setheighttablefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
            tableFixHead[i].style.height=divheight+'px';
            }
        }

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
        $(document).on('click','#btnprintreport',function(e){
                e.preventDefault();
                var sp = document.querySelector("#selcur");
                var cursk=sp.options[sp.selectedIndex].getAttribute('sk');
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var partner=$('#selcustomer').val();
                var partnername=$('#selcustomer option:selected').text();
                var user=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var cur=$('#selcur').val();
                var curname=$('#selcur option:selected').text();
                if(partner!=='' && cur!==''){
                    var redirectWindow = window.open('{{ url('/') }}'+'/report/printtransferprofitwithlist?d1='+d1+'&d2='+ d2 +'&partner='+partner+'&user='+user+'&curname='+curname+'&cur='+cur+'&cursk='+cursk+'&isprint='+1+'&partnername='+partnername+'&username='+username, '_blank');
                }else{
                    var redirectWindow = window.open('{{ url('/') }}'+'/report/printtransferprofit?d1='+d1+'&d2='+ d2 +'&partner='+partner+'&user='+user+'&curname='+curname+'&cur='+cur+'&cursk='+cursk+'&isprint='+1+'&partnername='+partnername+'&username='+username, '_blank');
                }
                redirectWindow.location;

            })
        $(document).on('click','#btnsearch2',function(e){
            e.preventDefault()
            searchmore=1;
            SearchTransfer(1);
        })
        $(document).on('change','#selcustomer,#seluser,#selcur,#seltran',function(e){
            e.preventDefault()
            searchmore=0;
            //SearchTransfer(0);
        })
        var searchmore=0;
        function SearchTransfer(searchmore)
        {
            $('body').addClass("wait");
            var sp = document.querySelector("#selcur");
            var cursk=sp.options[sp.selectedIndex].getAttribute('sk');
            var d1=$('#d1').val();
            var d2=$('#d2').val();
            var partner=$('#selcustomer').val();
            var user=$('#seluser').val();
            var cur=$('#selcur').val();
            var curname=$('#selcur option:selected').text();
            if(partner!=='' && cur!==''){
                var url="{{ route('report.gettransferprofitwithlist') }}";
            }else{
                var url="{{ route('report.gettransferprofit') }}";
            }
            $.ajax({
                async:true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,partner:partner,user:user,cur:cur,curname:curname,cursk:cursk},
                complete: function () {},
                success: function (data) {
                    //console.log(data)
                    $('#displayprofit').empty().html(data);
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
