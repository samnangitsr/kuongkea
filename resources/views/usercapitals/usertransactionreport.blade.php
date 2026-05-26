@extends('master')
@section('title') ប្រតិបត្តិការណ៏បុគ្គលិក @endsection
@section('css')
    <style type="text/css">
    body.wait, body.wait *{
            cursor: wait !important;
          }
        .select2-container--default .select2-results>.select2-results__options{max-height: 330px !important;}
        #seluser + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;font-weight:bold;;background-color:white}
        /* Each result */
        #select2-seluser-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:white;font-weight:bold;}
        .select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;height:38px;font-weight:bold;}
        .en12{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            }
        .en12-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            font-weight:bold;
            text-align:right;
            }
        .en16-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            font-weight:bold;
            text-align:right;
            }
        .en16{
            font-family:Arial, Helvetica, sans-serif;
            font-size:16px;
            text-align:right;
            }
        .en14-b{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
            font-weight:bold;
            }
        .en14{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;

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

    td.amt{
        text-align:right;
        font-weight:bold;
        font-size:16px;
    }
    .amt12{
      text-align:right;
      font-weight:bold;
      font-size:12px;
      color:gray;
    }
    td.total{
        text-align:right;
        font-weight:bold;
        font-size:16px;
    }
    .tbl_usertransaction .clickedrow td{
        background-color: yellow;
    }
    .tbl_usertransaction .clickedrow td input{
        background-color: yellow;
    }
    .blue{
      color:blue;
    }
    .red{
      color:red;
    }
    .mybtn:hover{
        background-color:aqua;
    }
    .mybtn{
        border:1px solid black;
        background-color:inherit;
    }
    .linethrough{
      text-decoration: line-through;
    }
    .tableFixHead{ overflow: auto;}
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1;background-color:aqua }
    .tbl_usertransaction td{
      word-wrap: break-word;
      padding:2px 5px 2px 5px;
    }
    .tbl_sub{
      padding:0px;margin:0px;
      table-layout:fixed;
      width:100%;
      border:1px solid black;
    }
    .tbl_sub thead{
      text-align:center;
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:14px;
      font-weight:bold;
      border:1px solid black;
    }
    .tbl_sub tr{
      font-family:'Noto Sans Khmer', sans-serif;
      font-size:14px;
      font-weight:bold;
    }
    .tbl_sub thead th{
      padding:0px;background-color:inherit;
      border:1px solid black;
    }
    .tbl_sub td{
      padding:5px;
      border:1px solid black;
      /* border-style:none; */
    }
    .subtdamt{
      text-align:right;
    }
    .tbl_usertransaction thead th{
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

   <div class="row" style="margin-top:-20px;z-index:1;background-color:silver;padding:10px 0px;">
      {{-- <div class="row" style="margin-top:10px;">
            <h1 class="kh22-b">ប្រតិបត្តិការណ៏បុគ្គលិក</h1>
      </div> --}}
      <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
      <input id="viewby" type="hidden" value="{{ Auth::user()->name }}">

      <div class="table-responsive">
          <table class="">
              <tr>
                <td style="border-style:none;" class="kh16-b">ថ្ងៃខែ
                  <label class="form-check-label kh16-b">
                  <input class="form-check-input kh16-b" type="checkbox" name="ckinputdate" id="ckinputdate"> កត់ត្រា</label>
                </td>
                <td style="border-style:none;" class="kh16-b">ដល់</td>
                @if(Auth::user()->role->name=='Admin')
                    <td style="border-style:none;" class="kh16-b">ក្រុមហ៊ុន</td>
                @endif
                <td style="border-style:none;" class="kh16-b">បុគ្គលិក</td>
                <td style="border-style:none;" class="kh16-b">ច្រោះយកតែ
                    <label class="form-check-label kh16-b">
                    <input class="form-check-input kh16-b" type="checkbox" name="ckcash" id="ckcash"> សាច់ប្រាក់</label>
                </td>
                {{-- <td style="border-style:none;width:220px;" class="kh22">រូបិយប័ណ្ណ</td> --}}
                <td colspan=2 style="border-style:none;">
                    <label class="form-check-label kh16-b">
                        <input class="form-check-input kh16-b" type="checkbox" name="ckhidenotsum" id="ckhidenotsum">ដកប្រតិបត្តិការណ៏មិនប៉ះពាល់ដើមទុនបុគ្គលិក
                    </label>
                    <button id="btnrefresh" class="mybtn kh16-b" style="border-style:none;">Refresh</button>
                </td>
              </tr>
              <tr>
                  <td style="border-style:none;padding:0px;">
                      <div class="input-group" style="width:160px;">
                          <input type="text" name="stockdate" id="stockdate" class="form-control" style="width:110px;height:30px;background-color:silver;font-size:16px;font-weight:bold;" readonly>
                          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      </div>
                  </td>
                  <td style="border-style:none;padding:0px;">
                    <div class="input-group" style="width:160px;">
                        <input type="text" name="stockdate2" id="stockdate2" class="form-control" style="width:110px;height:30px;background-color:silver;font-size:16px;font-weight:bold;" readonly>
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                </td>
                <td style="padding:0px;border-style:none;width:180px;">
                    @if(Auth::user()->role->name=='Admin')
                        <select name="selcompany" id="selcompany" class="kh16-b" style="width:100%;height:30px;">
                            @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </td>

                  <td style="border-style:none;padding:0px;">
                      <select class="form-select kh16-b" name="seluser" id="seluser" style="height:30px;padding:0px 5px;width:150px;">
                          {{-- <option value="0" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}>All Users</option> --}}
                          @foreach ($users as $u)
                              <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                          @endforeach
                      </select>
                  </td>
                  <td style="border-style:none;padding:0px;">
                    <select class="form-select kh16-b" name="filterby" id="filterby" style="height:30px;padding:0px 5px;width:200px;">
                        <option value="">ប្រតិបត្តិការណ៏ទាំងអស់</option>
                        <option value="exchanges">exchanges</option>
                        <option value="partner_transfers">partner_transfers</option>
                        <option value="cashdraws">cashdraws</option>
                        <option value="user_capitals">user_capitals</option>

                    </select>
                </td>
                  {{-- <td style="border-style:none;padding:0px;">
                      <select class="form-select kh22" name="selcur" id="selcur" style="height:45px;">
                          <option value="0">All Currency</option>
                          @foreach ($currencies as $cur)
                              <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                          @endforeach
                      </select>
                  </td> --}}
                  <td style="border-style:none;padding:0px;">

                      <button id="btnshow" class="mybtn kh16-b" style="margin-left:10px;">បង្ហាញលំអិត</button>
                      <button id="btnshowsummary" class="mybtn kh16-b" style="margin-left:5px;">សង្ខេបប្រតិបត្តិការណ៏</button>

                      <button id="btnprint" class="mybtn kh16-b" style="margin-left:5px;width:80px;">ព្រីន</button>
                      <button id="find" class="mybtn kh16-b" style="margin-left:5px;width:100px;" data-bs-toggle="collapse" data-bs-target="#searchmore">ស្វែងរកតាម</button>

                  </td>

              </tr>

          </table>
      </div>
   </div>

   <div class="row" style="background-color:silver;">

      <div id="searchmore" class="collapse" style="margin-bottom:10px;">
        <div class="row">
          <div class="col-lg-12">
            <table class="">
              <tr>
                <td>
                  <div class="input-group" style="width:160x;">
                    <input type="text" name="d1" id="d1" class="form-control" style="width:110px;background-color:silver;font-size:16px;font-weight:bold;height:30px;">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                </td>
                <td>
                  <div class="input-group" style="width:160px;">
                    <input type="text" name="d2" id="d2" class="form-control" style="width:110px;background-color:silver;font-size:16px;font-weight:bold;height:30px;">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                </td>
                <td style="padding-left:30px;">
                  <div class="form-check">
                    <input class="form-check-input kh16-b" type="checkbox" name="ckalldate" value="" id="ckalldate" />
                    <label class="form-check-label kh16-b" for="ckalldate">ALL DATE</label>
                  </div>
                </td>
                <td style="padding-left:25px;">
                  <select class="form-select kh16-b" name="selcur" id="selcur" style="width:150px;height:30px;padding:0px 5px;">
                    <option value="">All Currency</option>
                    @foreach ($currencies as $c)
                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                    @endforeach
                </select>
                </td>
              </tr>
            </table>
          </div>

        </div>
          <div class="row">
              <div class="col-lg-3">
                  <label class="kh16-b" for="searchby">ស្វែងរកតាម</label>
                  <select name="selsearchby" id="selsearchby" class="form-select kh16-b" style="height:30px;width:100%;padding:0px 5px;">
                      <option value="tel">លេខទូរស័ព្ទ</option>
                      <option value="amt">ចំនួនទឹកប្រាក់</option>
                  </select>
              </div>
              <div class="col-lg-3" id="col2">
                  <label class="kh16-b" for="stel">លេខទូរស័ព្ទ</label>
                  {{-- <input type="text" id="numtelsearch" value="{{ App\User::permissiongetamt(Auth::id(),'4.3.2') }}"> --}}
                  <input type="text" id="txtsearchbytel" class="form-control kh16-b" style="width:100%;height:30px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.4') }}">
              </div>
              <div class="col-lg-3" id="col3" style="display:none;">
                  <label class="kh16-b" for="samt1">ពីចំនួន</label>
                  <input type="text" id="txtsearchbyamt1" class="form-control kh16-b" style="width:100%;height:30px;" title="{{ App\User::permissiongetamt(Auth::id(),'4.1.1') }}">
              </div>
              <div class="col-lg-3" id="col4" style="display:none;">
                  <label class="kh16-b" for="samt2">ដល់ចំនួន</label>
                  <input type="text" id="txtsearchbyamt2" class="form-control kh16-b" style="width:100%;height:30px;">
              </div>
              <div class="col-lg-3">
                <button id="btnsearch2" class="mybtn kh16-b" style="margin-top:25px;">ស្វែងរក</button>
              </div>
          </div>

      </div>

  </div>
  <div class="row" style="">
    {{-- <form id="frmstockreport" action=""> --}}
        <div class="tableFixHead" id="userreport1" style="padding:0px;margin:0px;">

        </div>
    {{-- </form> --}}
  </div>

@endsection
@section('script')
  {{-- @include('includes.mainscript') --}}
    <script type="text/javascript">
        $('#h1_title').text('ប្រតិបត្តិការណ៏បុគ្គលិក');
        setheighttablefixhead(190);
      $(window).resize(function() {
        setheighttablefixhead(190);
      });

    $('#searchmore').on('shown.bs.collapse', function () {
        //console.log("Opened")
        setheighttablefixhead(285);

    });
    $(document).on('change','#selcompany',function(e){
        e.preventDefault();
        getuserbycompany('#seluser');
    })
    function getuserbycompany(el)
    {
        $(el).empty();
        var selcompany=$('#selcompany').val();
        $('body').addClass("wait");
        var url="{{ route('company.getuser') }}";
        $.ajax({
            async:true,
            type: 'GET',
            url: url,
            data: {company_id:selcompany},

            complete: function () {},
            success: function (data) {
                //console.log(data)
                $.each(data['users'],function(i,item){
                    $(el).append($("<option/>",{
                            value:item.id,
                            text:item.name,
                    }))
                });
                $('body').removeClass("wait");
            },
            error: function () {
                $('body').removeClass("wait");
                alert('Read Data Error.')
            }
        })
    }
    $('#searchmore').on('hidden.bs.collapse', function () {
        //console.log("Closed")
        setheighttablefixhead(190);
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
        function checkright()
        {
            var role=$('#txtrole').val();
            if(role!='Admin'){
                $('#stockdate').datetimepicker("destroy");

            }
        }
       $(document).ready(function () {
          //$('#seluser').select2();
            var today=new Date();
            $('#stockdate,#stockdate2,#d1,#d2').datetimepicker({
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
           // checkright();
            //Highlight clicked row
         $(document).on('click','.tbl_userreport td',function(e){
             // Remove previous highlight class
             $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
         })
         var clicksearch=0;
            $(document).on('click','#btnshow',function(e){
                e.preventDefault();
                showusertransactiondata(0,0);
            })
            $(document).on('click','#btnrefresh',function(e){
                e.preventDefault();
                showusertransactiondata(0,1);
            })
            $(document).on('click','#btnshowsummary',function(e){
                e.preventDefault();
                showusertransactiondata(1,0);
            })
            $(document).on('keydown','#txtsearchbyamt1,#txtsearchbytel,#txtsearchbyamt2',function(e){
              if(e.keyCode==13){
                var el=$(this).attr('id');

                if(el=='txtsearchbyamt1'){
                    var amt2=$('#txtsearchbyamt2').val();
                    var amt1=$('#txtsearchbyamt1').val();
                    if(amt2==''){
                        $('#txtsearchbyamt2').val(amt1)
                    }
                    $('#txtsearchbyamt2').focus();
                }
                  searchtransaction();
              }
            })
            $(document).on('change','#selcur',function(e){
              e.preventDefault();
              searchtransaction();
            })
            $(document).on('click','#btnsearch2',function(e){
                e.preventDefault()
                searchtransaction();
            })
            function searchtransaction()
            {
                $('body').addClass("wait");
                clicksearch=2;
                var d1=$('#d1').val();
                var d2=$('#d2').val();
                var selcur=$('#selcur').val();
                var alldate=document.getElementById("ckalldate").checked;
                var tel=$('#txtsearchbytel').val().replace(/\s+/g, '');
                var amt1=$('#txtsearchbyamt1').val().replace(/,/g, '');
                var amt2=$('#txtsearchbyamt2').val().replace(/,/g, '');
                var searchby=$('#selsearchby').val();
                var userid=$('#seluser').val();
                var url="{{ route('usercapital.searchusertransactionreport') }}";

                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {d1:d1,d2:d2,alldate:alldate,userid:userid,tel:tel,amt1:amt1,amt2:amt2,searchby:searchby,selcur:selcur},
                complete: function () {

                },
                success: function (data) {
                  //console.log(data)
                  $('#userreport1').empty().html(data);
                  $('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Error.')
                    $('body').removeClass("wait");
                }
              })
            }
            function showusertransactiondata(issummary,showfast)
            {
              $('body').addClass("wait");
              clicksearch=1;
              var d=$('#stockdate').val();
              var d2=$('#stockdate2').val();

              var isinputdate = document.getElementById("ckinputdate").checked;
              var hidenotsum = document.getElementById("ckhidenotsum").checked;
              var ckcash = document.getElementById("ckcash").checked;
              var userid=$('#seluser').val();
              var viewby=$('#viewby').val();
              if(issummary==1){
                var url="{{ route('usercapital.doallusertransactionreportsummary') }}";
              }else{
                  var url="{{ route('usercapital.doallusertransactionreport') }}";
              }
                // $.get(url,{trandate:d,userid:userid},function(data){
                //     //console.log(data)
                //     $('#userreport1').empty().html(data);

                // })
                $.ajax({
                async: true,
                type: 'GET',
                url: url,
                data: {viewby:viewby,trandate:d,todate:d2,userid:userid,isinputdate:isinputdate,hidenotsum:hidenotsum,ckcash:ckcash,showfast:showfast},
                complete: function () {

                },
                success: function (data) {
                    //console.log(data)
                  $('#userreport1').empty().html(data);
                  $('body').removeClass("wait");
                },
                error: function () {
                    alert('Read Error.')
                    $('body').removeClass("wait");
                }
              })
            }
            $(document).on('click','.btnseesummarydetail',function(e){
                e.preventDefault();
                var d1=$('#stockdate').val();
                var d2=$('#stockdate2').val();
                var tablename=$(this).data('tablename');
                var tranname=$(this).data('tranname');
                var userid=$(this).data('userid');
                var gold=$(this).data('gold');
                var usd=$(this).data('usd');
                var thb=$(this).data('thb');
                var khr=$(this).data('khr');
                var vnd=$(this).data('vnd');
                var fn=$(this).data('fn');
                var shortcut=$(this).data('shortcut');
                var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/showsummarydetail?tablename='+tablename+'&userid='+ userid +'&tranname='+tranname+'&gold='+gold+'&usd='+usd+'&thb='+thb+'&khr='+khr+'&vnd='+vnd+'&fn='+fn+'&shortcut='+shortcut+'&d1='+d1+'&d2='+d2, '_blank');
                redirectWindow.location;
            })
            $(document).on('click','#btnprint',function(e){
                e.preventDefault();
                var d=$('#stockdate').val();
                var userid=$('#seluser').val();
                var username=$('#seluser option:selected').text();
                var redirectWindow = window.open('{{ url('/') }}'+'/usercapital/printusertransaction?username='+username+'&userid='+ userid +'&date='+d+'&alltran='+'1', '_blank');
                redirectWindow.location;
            })
           // Remove previous highlight class
           $(document).on('click','.tbl_usertransaction td',function(e){
                $(this).closest('table').find('tr.clickedrow').removeClass('clickedrow');
            // add highlight to the parent tr of the clicked td
            $(this).parent('tr').addClass("clickedrow");
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
            $(document).on('click','.btndeltransfer',function(e){
              e.preventDefault();
              var id=$(this).data('id');
              //var ref_num=$(this).data('ref_number');
              //var fromid=ref_num.split('-')[1];

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
                            data: { id:id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    if(clicksearch==1){
                                      showusertransactiondata(0,0);
                                    }else if(clicksearch==2){
                                      searchtransaction();
                                    }

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
                            url: "{{ route('cashdraw.delete1') }}",
                            data: { id:id,transfer_id:transfer_id },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showusertransactiondata(0,0);
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
            $(document).on('click','.btndelexchangelist',function(e){
              e.preventDefault();
              var id=$(this).data('id');
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
                            url: "{{ route('exchangelist.delete') }}",
                            data: { id:id},
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showusertransactiondata(0,0);
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
            $(document).on('click','.btndelusercapital',function(e){
              e.preventDefault();
              var id=$(this).data('id');
              var refnumber=$(this).data('refnumber');
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
                            url: "{{ route('usercapital.delete') }}",
                            data: { id:id,refnumber:refnumber },
                            success: function (data) {
                                console.log(data);
                                if (data.success === true) {
                                    //location.reload();
                                    showusertransactiondata(0,0);
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
    </script>
@endsection
