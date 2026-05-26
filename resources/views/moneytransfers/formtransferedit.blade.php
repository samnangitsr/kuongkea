@extends('master')
@section('title') Transfer Edit @endsection
@section('css')
    <style type="text/css">
         #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}

        .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
        .select2-selection__rendered {
            line-height: 31px !important;
        }
        .select2-container .select2-selection--single {
            height: 47px !important;
        }
        .select2-selection__arrow {
            height: 34px !important;
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
        .kh22{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            }
        .kh22-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:22px;
            font-weight:bold;
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

       input.blue{
        color:blue;
       }
       input.red{
        color:red;
       }
      #tbl_amount td{
        padding:2px;
        border-style:none;
       }
       #tbl_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_exchange td{
        padding:2px;
        border-style:none;
       }
       #tbl_continue_partner td{
        padding:2px;
        border-style:none;
       }
       #tbl_child td{
        border-style:none;
       }
       #tblchildren .clickedrow td{
        background-color: #caaf8f;
       }
       .hiderow{
        display:none;
       }
       ul.ui-autocomplete {
            z-index: 1100;
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:16px;
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

    <form id="frmtransfer" action="">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" id="id1" name="id1" value="{{ $ptransfer->id }}">
                <input type="hidden" id="id2" name="id2" value='{{ $ptransfer->map_id??'' }}'>
                <input type="hidden" id="trancode" name="trancode" value="{{ $ptransfer->trancode }}">
                <input type="hidden" id="mekun" name="mekun" value="{{ $ptransfer->mekun }}">
                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">

                <div class="card">
                    <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;">
                        <h1 id="partner_title" class="kh22-b">ដៃគូពាក់ព័ន្ធ</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table id="tbl_partner" class="table">
                                    <tr>
                                        <td>
                                            <label for="date" class="kh22" style="width:120px;">កាលបរិច្ឆេទ</label>
                                        </td>
                                        <td>
                                            <input type="text" name="invdate" id="invdate" class="form-control" value="{{ date('d-m-Y',strtotime($ptransfer->dd)) }}" style="background-color:white;font-size:22px;" readonly>
                                        </td>
                                        <td style="width:60px;">
                                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="date" class="kh22" style="width:120px;">ជ្រើសរើសដៃគូ</label></td>
                                        <td colspan=2>
                                            <select class="form-select kh22" name="selpartner" id="selpartner" style="width:100%">
                                                <option value="">សូមជ្រើសរើសដៃគូ</option>
                                                @foreach ($partners as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $ptransfer->parrent_id==$p->id?'selected':'' }} >{{ $p->name }}</option>
                                                @endforeach
                                                @if (Auth::user()->role->name=='Admin')
                                                  @foreach ($customers as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $ptransfer->parrent_id==$p->id?'selected':'' }}>{{ $p->name }}</option>
                                                  @endforeach
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="row_son">
                                        <td><label for="son" class="kh22" style="width:120px;">បន្តទៅកូនសាខា</label></td>
                                        <td>
                                            <input type="text" id="son" name="son" class="form-control kh16" style="height:48px;" value="{{ $ptransfer->child }}">
                                        </td>

                                        <td style="width:60px;text-align:right;">
                                            <button id="btnbrowseson" class="btn btn-info btn-lg">...</button>
                                        </td>

                                    </tr>
                                    @if($ptransfer->customer_id)
                                        <tr id="rowcustomer">
                                            <td><label for="date" class="kh22" style="width:120px;">ជ្រើសរើសអតិថិជន</label></td>
                                            <td colspan=2>
                                                <select class="form-select kh22" name="selcustomer" id="selcustomer" style="width:100%">
                                                    <option value="">សូមជ្រើសរើសអតិថិជន</option>
                                                    @foreach ($customers as $c)
                                                        <option value="{{ $c->id }}" {{ $ptransfer->customer_id==$c->id?'selected':'' }}>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                          <i class="fa fa-volume-control-phone fa-2x"></i>
                                          <label for="rectel" class="kh22" style="width:120px;">លេខអ្នកទទួល</label>
                                        </td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="rectel" name="rectel" value="{{ $ptransfer->rectel }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="recname" class="kh22" style="width:120px;">ឈ្មោះអ្នកទទួល</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="recname" name="recname" value="{{ $ptransfer->recname }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <i class="fa fa-volume-control-phone fa-2x"></i>
                                          <label for="sendertel" class="kh22" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                        </td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="sendertel" name="sendertel" value="{{ $ptransfer->sendertel }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sendername" class="kh22" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="sendername" name="sendername" value="{{ $ptransfer->sendername }}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
              <input type="hidden" id="refgroupid" value="{{ $ptransfer->ref_group_id }}">
              <input type="hidden" id="mapid" value="{{ $ptransfer->map_id }}">

                <div class="card">
                    <div id="cardamount" class="card-header" style="background-color:silver;">
                        <h1 id="transfer_title" class="kh22-b" style="text-align:center;">{{ $ptransfer->tranname }} - UPDATE</h1>
                    </div>
                    <div class="card-body" id="tblexchangemultiple">
                        <div class="table-responsive">
                            <table id="tbl_amount" class="table kh22">
                                <tr>
                                    <td>ចំនួនទឹកប្រាក់វេរ</td>
                                    <td>
                                        <input type="text" class="form-control kh22 canenter" id="amount" name="amount" value="{{ phpformatnumber($ptransfer->amount * $ptransfer->mekun) }}" style="width:100%;text-align:right;" autocomplete="off" @if($ptransfer->ref_group_id) @if(is_null($ptransfer->map_id)) readonly @endif @endif>
                                    </td>
                                    <td style="width:150px;">
                                        <select name="selcur" id="selcur" class="form-select kh22" style="width:150px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" {{ $ptransfer->currency_id==$c->id?'selected':'' }} @if($ptransfer->ref_group_id) @if(is_null($ptransfer->map_id)) @if($ptransfer->currency_id!=$c->id) disabled @endif @endif @endif>{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                    <tr id="row_cuscharge" class="@if($ptransfer->trancode==1 || $ptransfer->trancode==3) @else hiderow @endif">
                                        <td>សេវ៉ាវេរ</td>
                                        <td>
                                            <input type="text" class="form-control kh22 canenter" id="cuscharge" name="cuscharge" value="{{ phpformatnumber($ptransfer->cuscharge) }}" style="width:100%;text-align:right;" {{ $ptransfer->ref_group_id?'readonly':'' }}>
                                        </td>
                                        <td style="width:150px;">
                                            <select name="selcur1" id="selcur1" class="form-select kh22" style="width:150px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" {{ $ptransfer->cuscharge_currency_id==$c->id?'selected':'' }} @if($ptransfer->ref_group_id) @if(is_null($ptransfer->map_id)) @if($ptransfer->cuscharge_currency_id!=$c->id) disabled @endif @endif @endif>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="row_totalcash" class="@if($ptransfer->trancode==1 || $ptransfer->trancode==3) @else hiderow @endif">
                                        <td>សរុបទឹកប្រាក់</td>
                                        <td>
                                            <input type="text" class="form-control kh22" id="totalcash" name="totalcash" style="width:100%;text-align:right;"
                                            value="{{ $ptransfer->currency_id==$ptransfer->cuscharge_currency_id?phpformatnumber($ptransfer->mekun * $ptransfer->amount+$ptransfer->cuscharge):phpformatnumber($ptransfer->mekun * $ptransfer->amount) }}" readonly>
                                        </td>
                                        <td style="width:150px;">
                                            <input type="text" class="form-control kh22" id="txtcur" value="{{ $ptransfer->currency->shortcut }}" style="width:150px;" disabled>
                                        </td>
                                    </tr>

                                <tr>
                                    <td>សេវ៉ាដៃគូ</td>
                                    <td>
                                        <input type="text" class="form-control kh22 canenter" id="fee" name="fee" value="{{ phpformatnumber($ptransfer->fee * $ptransfer->mekun)}}" style="width:100%;text-align:right;">
                                    </td>
                                    <td style="width:150px;">
                                        <select name="txtcur1" id="txtcur1" class="form-select kh22" style="width:150px;">
                                          <option value=""></option>
                                          @foreach ($currencies as $c)
                                              <option value="{{ $c->id }}" {{ $ptransfer->fee_currency_id==$c->id?'selected':'' }} @if($ptransfer->ref_group_id) @if(is_null($ptransfer->map_id)) @if($ptransfer->fee_currency_id!=$c->id) disabled @endif @endif @endif>{{ $c->shortcut }}</option>
                                          @endforeach
                                      </select>
                                    </td>
                                </tr>
                                <tr id="row_kabrak1" class="@if($ptransfer->partner->customertype!='CUSTOMER') hiderow @endif">
                                  <td>ការប្រាក់</td>
                                  <td>
                                      <input type="text" class="form-control kh22" id="interest1" name="interest1" style="width:100%;text-align:right;" value="{{ phpformatnumber(abs($ptransfer->interest)) }}">
                                  </td>
                                  <td style="width:150px;">
                                      <input type="text" class="form-control kh22" id="txtcur_rate1" style="width:150px;" value="{{ $ptransfer->currency->shortcut }}" readonly>
                                  </td>
                              </tr>
                            </table>
                        </div>
                    </div>
                    @if($ptransfer->trancode<>'-4')
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- @if($ptransfer->trancode==1 || $ptransfer->trancode==3)
                                        <div id="divckwater" class="form-check kh22">
                                            <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value="" >
                                            <label for="ckwater" class="form-check-label kh22">ដកទឹក</label>
                                        </div>
                                    @endif --}}
                                </div>
                                <div class="col-lg-8">
                                    <div style="float:right">
                                        <button id="btnupdatetransfer" class="btn btn-info">Update</button>
                                        {{-- <button id="btnupdatetransferprint" class="btn btn-primary">Update Print</button> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
                @if($ptransfer->trancode=='-4')
                <div id="divcontinue" style="">
                    <div class="card" id="continuecard" >
                        <div class="card-header" style="text-align:center;">
                            <h1 class="kh22-b" style="display:inline">ដៃគូបន្ត</h1>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="table-responsive">
                                    <table id="tbl_continue_partner" class="table">

                                        <tr>
                                            <td><label for="date" class="kh22" style="width:120px;">ជ្រើសរើសដៃគូ</label></td>
                                            <td colspan=2>
                                                <select class="form-select kh22" name="selpartner2" id="selpartner2" style="width:100%">
                                                    <option value="">សូមជ្រើសរើសដៃគូ</option>
                                                    @foreach ($partners as $p)
                                                        <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($ptransfer1->parrent_id==$p->id) selected @endif>{{ $p->name }}</option>
                                                    @endforeach
                                                    @if (Auth::user()->role->name=='Admin')
                                                      @foreach ($customers as $p)
                                                          <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($ptransfer1->parrent_id==$p->id) selected @endif>{{ $p->name }}</option>
                                                      @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh22">ចំនួនទឹកប្រាក់វេរ</td>
                                            <td>
                                                <input type="text" class="form-control kh22 canenter" id="amountcontinue" name="amountcontinue" style="width:100%;text-align:right;" value="{{ phpformatnumber($ptransfer1->amount) }}" autocomplete="off">
                                            </td>
                                            <td style="width:150px;">
                                                <select name="selcurcontinue" id="selcurcontinue" class="form-select kh22" style="width:150px;">
                                                  <option value=""></option>
                                                  @foreach ($currencies as $c)
                                                      <option value="{{ $c->id }}" {{ $ptransfer1->fee_currency_id==$c->id?'selected':'' }} @if($ptransfer1->ref_group_id) @if(is_null($ptransfer1->map_id)) @if($ptransfer1->fee_currency_id!=$c->id) disabled @endif @endif @endif>{{ $c->shortcut }}</option>
                                                  @endforeach
                                              </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="kh22">សេវ៉ាដៃគូ</td>
                                            <td>
                                                <input type="text" class="form-control kh22 canenter" id="fee2" name="fee2" style="width:100%;text-align:right;" value="{{ phpformatnumber($ptransfer1->fee) }}">
                                            </td>
                                            <td style="width:150px;">
                                                <select name="txtcur2" id="txtcur2" class="form-select kh22" style="width:150px;">
                                                  <option value=""></option>
                                                  @foreach ($currencies as $c)
                                                      <option value="{{ $c->id }}" {{ $ptransfer1->fee_currency_id==$c->id?'selected':'' }} @if($ptransfer1->ref_group_id) @if(is_null($ptransfer1->map_id)) @if($ptransfer1->fee_currency_id!=$c->id) disabled @endif @endif @endif>{{ $c->shortcut }}</option>
                                                  @endforeach
                                              </select>
                                              </td>
                                        </tr>
                                        <tr id="row_kabrak2" class="@if($ptransfer1->partner->customertype!='CUSTOMER') hiderow @endif">
                                          <td class="kh22">ការប្រាក់</td>
                                          <td>
                                              <input type="text" class="form-control kh22" id="interest2" name="interest2" style="width:100%;text-align:right;" value="{{ phpformatnumber(abs($ptransfer1->interest)) }}">
                                          </td>
                                          <td style="width:150px;">
                                              <input type="text" class="form-control kh22" id="txtcur_rate2" style="width:150px;" value="{{ $ptransfer1->currency->shortcut }}" readonly>
                                          </td>
                                      </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div style="float:right">

                                <button id="btnupdatetransfercontinue" class="btn btn-info">Update</button>
                                {{-- <button id="btnupdatetransfercontinueprint" class="btn btn-primary">Update Print</button> --}}
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            </div>
        </div>

    </form>
    @include('moneytransfers.searchchildmodal')
@endsection
@section('script')
    @include('moneytransfers.searchchildscript')
   <script>
    $(document).ready(function () {
        $('#selpartner').select2();
        $('#selpartner2').select2();
        $('#selcustomer').select2();
        $("#sel_province_search").select2({
            dropdownParent: $("#searchchildmodal")
        });
        $("#sel_district_search").select2({
            dropdownParent: $("#searchchildmodal")
        });
        $("#sel_customer_search").select2({
            dropdownParent: $("#searchchildmodal")
        });
        var today=new Date();
       $('#invdate').datetimepicker({
           timepicker:false,
           datepicker:true,
           //value:today,
           format:'d-m-Y',
           autoclose:true,
           todayBtn:true,
           startDate:today,
       });
       checkupdatedate();
       function checkupdatedate()
       {
          var refgroupid=$('#refgroupid').val();
          var mapid=$('#mapid').val();
          if(refgroupid!=''){
            if(mapid==''){
              $('#invdate').datetimepicker("destroy");
            }
          }
       }
       $(document).on('change','#selpartner',function(e){
          e.preventDefault();
          var sp = document.querySelector("#selpartner");
          var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
          if(customertype=='CUSTOMER'){
              $('#row_kabrak1').css('display','table-row');
              var cur=$('#selcur option:selected').text();
              $('#txtcur_rate1').val(cur);
          }else{
              $('#row_kabrak1').css('display','none');
          }
        })
      $(document).on('change','#selpartner2',function(e){
        e.preventDefault();
        var sp = document.querySelector("#selpartner2");
        var customertype=sp.options[sp.selectedIndex].getAttribute('customertype');
        if(customertype=='CUSTOMER'){
          var cur=$('#selcur option:selected').text();
          $('#txtcur_rate2').val(cur);
          $('#row_kabrak2').css('display','table-row');
        }else{
            $('#row_kabrak2').css('display','none');
        }
      })


        $(document).on('keydown', '.canenter', function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("id");
                if (id == 'txtbuy') {
                    $('#txtrate').focus();
                } else if(id == 'txtrate'){

                } else if (id == 'amount'){
                    if($('#mekun').val()==1){
                        $('#cuscharge').focus();
                    }else{
                        $('#fee').focus();
                    }
                }else if (id == 'cuscharge') {
                    $('#fee').focus();
                }else if (id == 'fee') {
                    $('#btnsavetransfer').focus();
                }else if(id=='rectel'){
                    $('#recname').focus();
                }else if(id=='recname'){
                    $('#sendertel').focus();
                }else if(id=='sendertel'){
                    $('#sendername').focus();
                }else if(id=='sendername'){
                    $('#amount').focus();
                }
                e.preventDefault();
            }
        })
        autocomplereceiver();
        function autocomplereceiver(){
                var sources=JSON.parse(localStorage.getItem("recphonelist"));
                var sources1=JSON.parse(localStorage.getItem("recnamelist"));
                $( "#rectel" ).autocomplete({
                    source:sources,
                    select: function( event, ui ) {
                        $( "#rectel" ).val( ui.item.value );
                        $( "#recname" ).val( ui.item.recname );
                        return false;
                    }
                    //    select : showResult,
                    //     focus : showResult,
                    //     change :showResult
                });
                $( "#recname" ).autocomplete({
                    source:sources1,
                    select: function( event, ui ) {
                        $( "#recname" ).val( ui.item.value );
                        $( "#rectel" ).val( ui.item.rectel );
                        return false;
                    }

                });
            }
       $(document).on('click','#btnbrowseson',function(e){
            e.preventDefault();
            $('#searchchildmodal').modal('show');
            var selpartner=$('#selpartner').val();
            $('#sel_customer_search').val(selpartner);
            $('#sel_customer_search').trigger('change');
        })
        $(document).on('click','.btn_select',function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var rowind=row.find("td:eq(0)").text();
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            $('#son').val(childname + '(' + addr + ')');
            $('#searchchildmodal').modal('hide');

        })
        $('#tblchildren').on('dblclick', '.rowclick', function(event) {

            var ind=$(this).index();
            var row=$(this).closest('tr');
            childname=row.find("td:eq(1)").text();
            addr=row.find("td:eq(3)").text();
            $('#son').val(childname + '(' + addr + ')');
            $('#searchchildmodal').modal('hide');
		});
        $(document).on('click','#btnupdatetransfer,#btnupdatetransfercontinue',function(e){
            e.preventDefault();
            var mekun=0;
            mekun=$('#mekun').val();
            // var idclick=$(this).attr('id');
            // var isprint=0;
            // if(idclick=='btnupdatetransferprint'){
            //     isprint=1;
            // }
            if(mekun==0){
                alert('Save without title not allow');
                return;
            }
            if(mekun==1){
                var cuscharge=$('#cuscharge').val();
                var curcharge=$('#selcur1').val();
                if(cuscharge=='' || curcharge==''){
                    alert('Please input customer charge')
                    return;
                }
            }
            //var formdata=$('#frmtransfer').serializeArray();
            var formdata=new FormData(frmtransfer);
            var partner=$('#selpartner option:selected').text();
            var partner2=$('#selpartner2 option:selected').text();
            formdata.append('partner',partner);
            formdata.append('partner2',partner2);
            var url="{{ route('moneytransfer.update') }}"

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
                        // if(isprint==1){
                        //     printtransfers(data.id,hasexchange,hasbankpayment);
                        // }
                      window.close();

                    }else{
                        alert(data.error)
                    }
                },
                error: function () {
                    alert('Save Error.')
                }

            })

        })
        function printtransfers(tr_id,hasexchange,hasbankpayment){

                var redirectWindow = window.open('{{ url('/') }}'+'/moneytransfer/print?tr_id='+tr_id  + '&hasexchange='+hasexchange+ '&hasbankpayment='+hasbankpayment, '_blank');
                redirectWindow.location;
        }
        $(document).on('change','#selcur',function(e){
          e.preventDefault();
          var curname=$('#selcur option:selected').text();
          $('#selcur1').val($(this).val());
          $('#txtcur').val(curname);
          $('#txtcur1').val($(this).val());
          $('#txtcur2').val($(this).val());
          $('#txtcur_rate1').val(cur);
          $('#txtcur_rate2').val(cur);
        })
        var cleave = new Cleave('#amount', {
            numeral: true,
            numeralPositiveOnly: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        // var cleave = new Cleave('#amountcontinue', {
        //     numeral: true,
        //     numeralPositiveOnly: true,
        //     numeralThousandsGroupStyle: 'thousand'
        // });
        var cleave = new Cleave('#cuscharge', {
            numeral: true,
            numeralPositiveOnly: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#fee', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#interest1', {
          numeral: true,
          numeralDecimalScale: 6,
          numeralThousandsGroupStyle: 'thousand'
      });
    //   var cleave = new Cleave('#interest2', {
    //       numeral: true,
    //       numeralDecimalScale: 6,
    //       numeralThousandsGroupStyle: 'thousand'
    //   });


        $(document).on('keyup','#amount',function(e){
            const C = e.key;
            if (C === "Backspace"){
                totalcash();
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey1(C,'#selcur')
                var cur=$('#selcur option:selected').text();
                $('#txtcur').val(cur);
                $('#txtcur1').val(cur);
                $('#txtcur2').val(cur);
                $('#selcur1').val($('#selcur').val());
                $('#txtcur_rate1').val(cur);
                $('#txtcur_rate2').val(cur);
            }
            totalcash();
        })
        $(document).on('keyup','#cuscharge',function(e){
            const C = e.key;

            if (C === "Backspace"){
                totalcash();
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey1(C,'#selcur1')
            }
            totalcash();
        })
        function totalcash()
        {
            var totalcash=0;
            var amt=$('#amount').val().replace(/,/g, '');
            var cur=$('#selcur option:selected').text();
            var cuscharge=$('#cuscharge').val().replace(/,/g, '');
            var cur1=$('#selcur1 option:selected').text();
            if(cur==cur1){

                totalcash=parseFloat(amt)+parseFloat(cuscharge);
            }else{
                totalcash=amt;
            }
            $('#totalcash').val(formatNumber(parseFloat(totalcash)));

        }
        function isNumber(n) { return !isNaN(parseFloat(n)) && !isNaN(n - 0) }
    function getcurrencybykey1(key,el)
        {
            var url="{{ route('getcurrencybykey') }}";
            $.get(url,{key:key},function(data){
                //console.log(data)
                    if(data['c']!=null){
                        $(el).val(data['c']['id']);
                        //$(el).attr('title', data['c']['id'] + ';' + data['c']['ratebuy'] + ';' + data['c']['ratesale'] + ';' + data['c']['optsign'] + ';' + data['c']['ismain'] + ';' + data['c']['isfn'] + ';' + data['c']['shortcut']);
                    }
            })
        }
    })
   </script>
@endsection
