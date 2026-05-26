@extends('master')
@section('title') Thai Transfer Stock @endsection
@section('css')
    <style type="text/css">
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
    .tableFixHead          { overflow: auto;border:1px solid black;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    td{
      word-wrap: break-word;
    }
    #tbl_partner_transfer td{
        padding:2px;
    }
    #tbl_partner_transfer th{
        padding:2px;
    }
    .btndelete{
        padding:0px 5px;
        background-color:red;
        color:white;
        border:1px solid black;
    }
    .btndelete:hover{
        background-color:pink;
        color:red;
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
    <div class="row" style="margin-top:-20px;z-index:1">
        <div class="table-responsive">
            <table class="table">
                <tr class="kh14-b">
                    <th style="border-style:none;">គិតត្រឹមថ្ងៃ</th>
                    <th style="border-style:none;">ជ្រើសរើសលេខបញ្ជី</th>

                </tr>
                <tr>

                    <td style="border-style:none;padding:0px;width:160px;">
                      <div class="input-group" style="width:160px;">
                          <input type="text" name="d1" id="d1" class="form-control" style="width:100px;height:40px;background-color:silver;font-size:16px;" readonly>
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                  </td>

                    <td style="padding:0px;border-style:none;width:310px;">
                        <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select kh16-b" required>
                          <option value="">ទាំងអស់</option>
                          @foreach ($partners as $p)
                                <option value="{{ $p->accno }}">{{ $p->accno }}</option>
                            @endforeach

                        </select>
                    </td>


                    <td style="padding:0px 0px 0px 5px;border-style:none;">
                        <button class="btn btn-info btn-md kh16-b" id="btnsearch">Search</button>
                        <button class="btn btn-info btn-md kh16-b" id="btnprint">Print</button>
                        <button class="btn btn-warning btn-md kh16-b" id="btnremovefromlist">Remove Selected</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="row" style="margin-top:0px;">
            {{-- <div class="table-responsive"> --}}
              <div class="tableFixHead" style="padding:0px;">
                <table id="tbl_partner_transfer" class="table table-bordered table-hover table-striped kh14" style="table-layout:fixed;">
                    <thead class="kh14-b" style="text-align:center;">
                        <th style="width:60px;">លរ</th>
                        <th style="width:100px;text-align:left;">
                            <input class="form-check-input" type="checkbox" name="ckidall" value="" id="ckidall" />
                            <label class="form-check-label" for="ckidall">ALL</label>
                        </th>
                        <th style="width:50px;">សក</th>
                        <th style="width:100px;">ថ្ងៃទី</th>
                         <th style="width:80px;">ម៉ោង</th>
                        <th style="width:150px;">អ្នកកត់ត្រា</th>
                        <th style="width:150px;">លេខបញ្ជី</th>
                        <th style="width:150px;">ចំនួនទឹកប្រាក់</th>
                        <th style="">សារ</th>
                    </thead>
                    <tbody id="bodytransfer">
                        @foreach ($data as $key => $d)
                            <tr class="rowclick">
                                <td style="text-align:center;">{{ ++$key }}</td>
                                <td>
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ckid" value="{{ $d->id }}" id="ckid{{ $d->id }}" />
                                    <label class="form-check-label" for="ckid{{ $d->id }}"> {{ $d->id }}</label>
                                    </div>
                                </td>
                                <td style="text-align:center;padding-top:3px;">
                                    <a href="#" class="btndelete" data-id="{{ $d->id }}"><i class="fa fa-trash"></i></a>
                                </td>
                                <td>{{ date('d-m-Y',strtotime($d->smsdate))}}</td>
                                <td>{{ $d->smstime=='0'?'':$d->smstime }}</td>
                                <td>{{ $d->smsby }}</td>

                                <td>{{$d->accno}}</td>

                                <td class="kh14-b" style="text-align:right;">
                                    {{ phpformatnumber($d->amount)  . ' ' .  $d->cur }}
                                </td>
                                <td style="padding-left:10px;">{{ $d->smstext }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
            {{-- </div> --}}
    </div>

@endsection
@section('script')

    <script type="text/javascript">
        $('#h1_title').text('ស្តុកលុយថៃ');
        tablefixhead(210);
        $(window).resize(function() {
            tablefixhead(210);
        });
        function tablefixhead(h)
        {
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var divheight=windowHeight-h;
            var tableFixHead=document.getElementsByClassName('tableFixHead');
            for(i=0; i<tableFixHead.length; i++) {
                tableFixHead[i].style.height=divheight+'px';
            }
        }
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
        $('#selcustomer').select2();
        $('#seluser').select2();

        var today=new Date();
            $('#d1').datetimepicker({
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


      $(document).on('change','#ckidall',function(e){
          e.preventDefault();
           $('input[name="ckid"').not(this).prop('checked', this.checked);
      })
      $(document).on('click','#btnremovefromlist',function(e){
         e.preventDefault();
         var data=[];
         $("table tbody").find('input[name="ckid"]').each(function(){
              if($(this).is(":checked")){
                  data.push($(this).val());
                }
          });
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
                            url: "{{ route('thaicashdraw.setiscashdrawtrue') }}",
                            data: { id:data },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    SearchTransfer();

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
            SearchTransfer();
        })
        $(document).on('click','#btnprint',function(e){
            e.preventDefault()
            prints();
        })
        $(document).on('change','#selcustomer,#selcur,#seluser',function(e){
            e.preventDefault()
            SearchTransfer();
        })

        function SearchTransfer()
        {
            var d1=$('#d1').val();
            var partner=$('#selcustomer').val();
            var url="{{ route('thaicashdraw.searchnotyetcashdraw') }}";
             $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: { d1:d1,partner:partner },
                success: function (data) {
                    console.log(data);
                    if ($.isEmptyObject(data.error)) {
                        $('#bodytransfer').empty().html(data);
                        $('body').removeClass("wait");
                    } else {
                        $('body').removeClass("wait");
                        alert(data.error);
                    }
                },
                error: function () {
                    $('body').removeClass("wait");
                    alert('Read Error.');
                }
            });

        }
        function prints(){
            var d1=$('#d1').val();
            var partner=$('#selcustomer').val();
            var redirectWindow = window.open('{{ url('/') }}'+'/thaicashdraw/notyetcashdrawreport/print?dd='+d1+'&partner='+partner, '_blank');
            redirectWindow.location;
        }

        $(document).on('click','.btndelete',function(e){
                e.preventDefault();
                var id=[];
                var invid=$(this).data('id');
                id.push(invid);
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
                            url: "{{ route('thaicashdraw.setiscashdrawtrue') }}",
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    SearchTransfer();

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
