@extends('master')
@section('title') Update Transaction Group @endsection
@section('css')
    <style type="text/css">
        body.wait, body.wait *{
			cursor: wait !important;
		}

    #selpartner + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selcustomer + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selcustomer-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #selpartner2 + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-selpartner2-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_customer_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_customer_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_province_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_province_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    #sel_district_search + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}
		/* Each result */
		#select2-sel_district_search-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

    .bankid + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;}

		/* Search field */
		.select2-search input {font-family: 'Noto Sans Khmer', sans-serif;font-size:16px;background-color:azure}
        .select2-selection__rendered {
            line-height: 30px !important;
        }
        .select2-container .select2-selection--single {
            height: 30px !important;
            background-color:aquamarine;
        }
        .select2-selection__arrow {
            height: 30px !important;
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
        .kh18-b{
            font-family:'Noto Sans Khmer', sans-serif;
            font-size:18px;
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
       #tbl_checkamt .clickedrow td{
        background-color: #caaf8f;
       }

       #divfooter{
        /* margin:0px; */
        color:white;
        padding:0px 20px 0px 0px;
        position: fixed;
        bottom: 0;
        width: 84.5%;
        min-height: 98px;
        max-height: 98px;
        /* background-color: inherit; */
        background-color:rgb(201, 214, 218);
        color: white;
        height : 98px;
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

    <form id="frmtransfer" action="">
        <div class="row">
            <div class="col-lg-6">
                <input type="hidden" id="autocashdraw" name="autocashdraw" value="{{ $transfer->iscashdraw }}">
                <input type="hidden" id="ref_group_id" name="ref_group_id" value="{{ $transfer->ref_group_id }}">
                <input type="hidden" id="update_transfer_id" name="update_transfer_id" value="{{ $transfer->id }}">
                <input type="hidden" id="hasmultitransfer" name="hasmultitransfer" value='{{ $hasmultitransfer }}'>
                <input type="hidden" id="hasexchange" name="hasexchange" value='{{ $hasexchange }}'>
                <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='{{ $hasbankpayment }}'>
                <input type="hidden" id="tranname" name="tranname" value="@if($transfer->trancode==1)ផ្ញើ@elseif($transfer->trancode==-1)ទទួល@elseif($transfer->trancode==-4)ទទួល @elseif($transfer->trancode==3)វេរបំណុល @endif">
                <input type="hidden" id="trancode1" name="trancode1" value="{{ $transfer->trancode }}">
                <input type="hidden" id="trancode2" name="trancode2" value="{{ $transfer1->trancode??'' }}">
                <input type="hidden" id="id1" name="id1" value="{{ $transfer->id }}">
                <input type="hidden" id="id2" name="id2" value="{{ $transfer1->id??'' }}">
                <input type="hidden" id="child_id" name="child_id">
                <input type="hidden" id="location_id" name="location_id" value="{{ $transfer->location_id }}">

                <input type="hidden" id="mekun" name="mekun" value="{{ $transfer->mekun }}">
                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                <input id="usersaved" name="usersaved" type="hidden" value="{{ $transfer->user_id }}">
                <div class="card">
                    <div id="cardpartner"  class="card-header" style="text-align:center;background-color:skyblue;height:35px;padding:0px;">
                      <table class="table" style="margin:0px;">
                        <tr>
                          <td style="width:20%;border-style:none;padding:0px;">
                            {{-- <div id="divcklockdata" class="form-check kh16">
                              <input class="form-check-input" type="checkbox" id="cklockdata" name="cklockdata" value="" >
                              <label style="color:white;" for="cklockdata" class="form-check-label kh16-b">ចងចាំទិន្ន័យ</label>
                            </div> --}}
                          </td>
                          <td style="border-style:none;padding:0px;width:60%">
                            <h1 id="partner_title" class="kh16-b" style="margin-top:8px;">ដៃគូពាក់ព័ន្ធ</h1>
                          </td>
                          <td style="width:20%;border-style:none;padding:0px;text-align:right;">
                            <div class="dropdown" style="display:inline;padding:0px;">
                              <button type="button" class="btn btn-primary btn-sm dropdown-toggle kh16" style="" data-bs-toggle="dropdown">
                                ផ្សេងៗ
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item kh16 btnchangedate" href="#">ផ្លាស់ប្តូរថ្ងៃទី</a></li>
                              </ul>
                          </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="card-body" style="padding-bottom:0px;">
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table id="tbl_partner" class="table">
                                    <tr>
                                        <td>
                                            <label for="date" class="kh16-b" style="width:120px;">កាលបរិច្ឆេទ</label>
                                        </td>
                                        <td colspan=2>
                                            <input type="text" name="invdate" id="invdate" class="form-control" style="background-color:white;font-size:16px;width:50%;display:inline;height:30px;" value="{{ date('d-m-Y',strtotime($transfer->dd)) }}" readonly>
                                            <input type="text" name="invtime" id="invtime" class="form-control" style="background-color:white;font-size:16px;width:50%;display:inline;height:30px;" value="{{ $transfer->tt }}" readonly>
                                        </td>


                                    </tr>

                                    <tr>
                                        <td><label for="selpartner" class="kh16-b" style="width:120px;">វេរតាម(<span id="lblpartner" class="kh12-b">{{ $transfer->partner->customertype }}</span>)</label></td>
                                        <td colspan=2>
                                            <select class="form-select select2-option kh22" name="selpartner" id="selpartner" style="width:100%">
                                                <option value=""></option>
                                                <optgroup label="ដៃគូ">
                                                    @foreach ($partners->where('customertype','PARTNER') as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $p->id==$transfer->parrent_id?'selected':'' }}>{{ $p->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="ធនាគា">
                                                  @foreach ($partners->where('customertype','BANK') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $p->id==$transfer->parrent_id?'selected':'' }}>{{ $p->name }}</option>
                                                  @endforeach
                                                </optgroup>
                                                <optgroup label="ភ្នាក់ងារ">
                                                  @foreach ($partners->where('customertype','AGENT') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $p->id==$transfer->parrent_id?'selected':'' }}>{{ $p->name }}</option>
                                                  @endforeach
                                                </optgroup>
                                                @if (Auth::user()->role->name=='Admin')
                                                  <optgroup label="អតិថិជន">
                                                    @foreach ($customers as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" {{ $p->id==$transfer->parrent_id?'selected':'' }}>{{ $p->name }}</option>
                                                    @endforeach
                                                  </optgroup>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="row_son">
                                        <td><label for="son" class="kh16-b" style="width:120px;">បន្តទៅកូនសាខា</label></td>
                                        <td colspan=2>
                                            <div class="input-group">
                                                <input type="text" id="son" name="son" class="form-control kh16" style="height:30px;" value="{{ $transfer->child??'' }}">
                                                <input type="button" class="input-group" id="btnbrowseson" value="..." style="width:30px;border:1px solid black;">

                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="rowseluseraffect1" style="display:none">
                                      <td class="kh16-b" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                      <td colspan=2>
                                          <select class="form-select kh16" name="seluseraffect1" id="seluseraffect1" style="width:100%">
                                              <option value="{{ $transfer->user_affect }}">{{ $transfer->useraffect->name }}</option>
                                          </select>
                                      </td>
                                    </tr>

                                    <tr id="rowcustomer" style="@if($transfer->trancode==3) display:table-row; @else display:none; @endif">
                                        <td><label for="date" class="kh16-b" style="width:120px;">ជ្រើសរើសអតិថិជន</label></td>
                                        <td colspan=2>
                                            <select class="form-select select2-option kh16" name="selcustomer" id="selcustomer" style="width:100%">
                                                <option value=""></option>
                                                @foreach ($customers as $c)
                                                    <option value="{{ $c->id }}" customertype="{{ $p->customertype }}" {{ $c->id==$transfer->customer_id?'selected':'' }}>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <i class="fa fa-volume-control-phone fa-2x"></i>
                                            <label for="rectel" class="kh16-b" style="width:120px;">លេខអ្នកទទួល</label>
                                        </td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh16 canenter" style="height:30px;" id="rectel" name="rectel" value="{{ $transfer->rectel }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="recname" class="kh16-b" style="width:120px;">ឈ្មោះអ្នកទទួល</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh16 canenter" style="height:30px;" id="recname" name="recname" value="{{ $transfer->recname }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i class="fa fa-volume-control-phone fa-2x"></i>
                                            <label for="sendertel" class="kh16-b" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                        </td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh16 canenter" style="height:30px;" id="sendertel" name="sendertel" value="{{ $transfer->sendertel }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sendername" class="kh16-b" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh16 canenter" style="height:30px;" id="sendername" name="sendername" value="{{ $transfer->sendername }}">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-lg-6">

                <div class="card">
                    <div id="cardamount" class="card-header" style="background-color:rgb(219, 235, 76);height:35px;">
                        <h1 id="transfer_title" class="kh16-b" style="text-align:center;">Update User Transaction</h1>
                    </div>
                    <div class="card-body" id="tblexchangemultiple">
                        <div class="table-responsive">
                            <table id="tbl_amount" class="table kh16-b">
                                <tr>
                                    <td>ចំនួនទឹកប្រាក់វេរ</td>
                                    <td>
                                        <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" title="{{ $transfer->amount }}" style="width:100%;text-align:right;height:30px;" value="{{ abs($transfer->amount) }}" autocomplete="off">
                                    </td>
                                    <td style="width:80px;">
                                        <select name="selcur" id="selcur" class="kh16-b" style="width:80px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" {{ $c->id==$transfer->currency_id?'selected':'' }}>{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr id="row_cuscharge" style="@if($transfer->trancode<0) display:none; @endif">
                                    <td class="kh16">
                                        <span id="spanseva">សេវ៉ាវេរ</span>
                                        @if($transfer->trancode>0)
                                        <span id="divckwater" style="float:right;">
                                            <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                            <label for="ckwater" class="form-check-label kh16">ដកទឹក</label>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" class="form-control kh16-b canenter" id="cuscharge" name="cuscharge" style="width:100%;text-align:right;height:30px;" value="{{ phpformatnumber($transfer->cuscharge) }}">
                                    </td>
                                    <td style="width:80px;">
                                        <select name="selcur1" id="selcur1" class="kh16-b" style="width:80px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" {{ $c->id==$transfer->cuscharge_currency_id?'selected':'' }}>{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr id="row_totalcash" style="@if($transfer->trancode<0) display:none; @endif">
                                    <td>សរុបទឹកប្រាក់</td>
                                    <td>
                                        <input readonly type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="width:100%;text-align:right;height:30px;" value="@if($transfer->currency_id==$transfer->cuscharge_currency_id) {{ phpformatnumber($transfer->amount+$transfer->cuscharge) }} @else {{ phpformatnumber($transfer->amount) }} @endif">
                                    </td>
                                    <td style="width:80px;">
                                        <input type="text" class="form-control kh16-b" id="txtcur" style="width:80px;padding:0px;height:30px;" value="{{ $transfer->currency->shortcut }}" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>សេវ៉ាដៃគូ</td>
                                    <td>
                                        <input type="text" class="form-control kh16-b canenter" id="fee" name="fee" style="width:100%;text-align:right;height:30px;" title="{{ $transfer->fee }}" value="{{ phpformatnumber(abs($transfer->fee)) }}">
                                    </td>
                                    <td style="width:80px;">
                                        {{-- <input type="text" class="form-control kh22" id="txtcur1" style="width:150px;"> --}}
                                        <select name="txtcur1" id="txtcur1" class="kh16-b" style="width:80px;">
                                          <option value=""></option>
                                          @foreach ($currencies as $c)
                                              <option value="{{ $c->id }}" {{ $c->id==$transfer->fee_currency_id?'selected':'' }}>{{ $c->shortcut }}</option>
                                          @endforeach
                                      </select>
                                    </td>
                                </tr>
                                <tr id="row_kabrak1" style="@if($transfer->partner->customertype<>'CUSTOMER') display:none; @endif ">
                                    <td>ការប្រាក់</td>
                                    <td>
                                        <input type="text" class="form-control kh16-b" id="interest1" name="interest1" style="width:100%;text-align:right;height:30px;" value="{{ $transfer->interest }}">
                                    </td>
                                    <td style="width:80px;">
                                        <input type="text" class="form-control kh16-b" id="txtcur_rate1" style="width:80px;padding:0px;height:30px;" value="{{ $transfer->currency->shortcut }}" readonly>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            @if($transfer->trancode==1)
                              <div class="col-lg-12">
                                <button class="btn btn-primary" id="btnaddtransferlist">ADD TO TRANSFER LIST</button>
                              </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="divcontinue" style="@if($transfer1 && $transfer1->count()>0 && $transfer1->trancode==4) @else display:none; @endif">
                  <div class="card" id="continuecard" >
                      <div class="card-header" style="text-align:center;height:35px;">
                          <h1 class="kh16-b" style="display:inline">ដៃគូបន្ត</h1>
                          <span style="float:right;font-size:16px;margin-top:-6px;"><button id="btnclosedivcontinue" style="display:none;" class="btn btn-danger btn-sm">X</button></span>

                      </div>
                      <div class="card-body" style="padding-bottom:0px;">
                          <div class="row mb-3">
                              <div class="table-responsive">
                                  <table id="tbl_continue_partner" class="table">

                                      <tr>
                                          <td>
                                            <label for="date" class="kh16-b" style="width:120px;">ជ្រើសរើសដៃគូ ( <span id="lblpartner2" class="kh16-b">PARTNER</span>)</label>
                                          </td>
                                          <td colspan=2>
                                              <select class="form-select select2-option kh16-b" name="selpartner2" id="selpartner2" style="width:100%">
                                                <option value=""></option>
                                                <optgroup label="ដៃគូ">
                                                    @foreach ($partners->where('customertype','PARTNER') as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->parrent_id==$p->id?'selected':'' }} @endif>{{ $p->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="ធនាគា">
                                                  @foreach ($partners->where('customertype','BANK') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->parrent_id==$p->id?'selected':'' }} @endif>{{ $p->name }}</option>
                                                  @endforeach
                                                </optgroup>
                                                <optgroup label="ភ្នាក់ងារ">
                                                  @foreach ($partners->where('customertype','AGENT') as $p)
                                                    <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->parrent_id==$p->id?'selected':'' }} @endif>{{ $p->name }}</option>
                                                  @endforeach
                                                </optgroup>
                                                @if (Auth::user()->role->name=='Admin')
                                                  <optgroup label="អតិថិជន">
                                                    @foreach ($customers as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->parrent_id==$p->id?'selected':'' }} @endif>{{ $p->name }}</option>
                                                    @endforeach
                                                  </optgroup>
                                                @endif
                                              </select>
                                          </td>
                                      </tr>
                                      <tr id="rowseluseraffect2" style="display:none;">
                                        <td class="kh16" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                        <td colspan=2>
                                            <select class="form-select kh16-b" name="seluseraffect2" id="seluseraffect2" style="width:100%">
                                                @if($transfer1 && $transfer1->count()>0)
                                                  <option value=" {{ $transfer1->user_affect }}">{{ $transfer1->useraffect->name }}</option>
                                                @endif
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="kh16-b">ចំនួនទឹកប្រាក់វេរ</td>
                                        <td>
                                            <input type="text" class="form-control kh16-b canenter" id="amountcontinue" name="amountcontinue" title="{{ $transfer1->amount??'0' }}" style="width:100%;text-align:right;height:30px;" value="{{ phpformatnumber($transfer1->amount??'0') }}" autocomplete="off">
                                        </td>
                                        <td style="width:80px;">
                                            <select name="selcurcontinue" id="selcurcontinue" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->currency_id==$c->id?'selected':'' }} @endif>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="kh16-b">សេវ៉ាបន្ត
                                          <span id="divckwater2" style="float:right;">
                                            <input class="form-check-input" type="checkbox" id="ckwater2" name="ckwater2" value=""  style="">
                                            <label for="ckwater2" class="form-check-label kh16-b">ដកទឹក</label>
                                        </span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control kh16-b canenter" id="cuscharge2" name="cuscharge2" style="width:100%;text-align:right;height:30px;" value="{{ phpformatnumber($transfer1->cuscharge??'0') }}" autocomplete="off">
                                        </td>
                                        <td style="width:80px;">
                                            <select name="selcuschargecontinuecur" id="selcuschargecontinuecur" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->cuscharge_currency_id==$c->id?'selected':'' }} @endif>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                      </tr>
                                      <tr id="row_totalcash2" style="">
                                        <td class="kh16-b">សរុបទឹកប្រាក់</td>
                                        <td>
                                            <input readonly type="text" class="form-control kh16-b" id="totalcash2" name="totalcash2" style="width:100%;text-align:right;height:30px;" value="@if($transfer1 && $transfer1->count()>0) @if($transfer1->currency_id==$transfer1->cuscharge_currency_id) {{ phpformatnumber($transfer1->amount+$transfer1->cuscharge) }} @else {{ phpformatnumber($transfer1->amount) }} @endif @endif">
                                        </td>
                                        <td style="width:80px;">
                                            <input type="text" class="form-control kh16-b" id="txtcur3" style="width:80px;height:30px;padding:0px;" value="@if($transfer1 && $transfer1->count()>0) {{ $transfer1->currency->shortcut }} @endif" readonly>
                                        </td>
                                    </tr>
                                      <tr>
                                          <td class="kh16-b">សេវ៉ាដៃគូ</td>
                                          <td>
                                              <input type="text" class="form-control kh16-b canenter" id="fee2" name="fee2" style="width:100%;text-align:right;height:30px;" value="{{ phpformatnumber($transfer1->fee??'0') }}">
                                          </td>
                                          <td style="width:80px;">
                                              {{-- <input type="text" class="form-control kh22" id="txtcur2" style="width:150px;"> --}}
                                              <select name="txtcur2" id="txtcur2" class="kh16-b" style="width:80px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" @if($transfer1 && $transfer1->count()>0) {{ $transfer1->fee_currency_id==$c->id?'selected':'' }} @endif>{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                          </td>
                                      </tr>
                                      <tr id="row_kabrak2" style="display:none;">
                                        <td class="kh16-b">ការប្រាក់</td>
                                        <td>
                                            <input type="text" class="form-control kh16-b" id="interest2" name="interest2" style="width:100%;text-align:right;height:30px;" value="{{ phpformatnumber($transfer1->interest??'0') }}">
                                        </td>
                                        <td style="width:80px;">
                                            <input type="text" class="form-control kh16-b" id="txtcur_rate2" style="width:150px;height:30px;" value="{{ $transfer1->currency->shortcut??'' }}" readonly>
                                        </td>
                                    </tr>
                                  </table>
                              </div>
                          </div>

                      </div>


                  </div>
                </div>

                <div id="divexchangecard" style="display:none;margin-top:-10px;">
                    <div class="card" style="">
                        <div class="card-header" style="text-align:center;height:35px;">
                            <h1 class="kh16-b" style="display:inline">Exchange</h1>
                            <span style="float:right;font-size:16px;"><button id="btnclosedivexchangecard" style="margin-top:-6px;" class="btn btn-danger btn-sm">X</button></span>

                        </div>
                        <div class="card-body" style="padding-bottom:0px;">
                            <div class="row mb-3">
                                <div class="table-responsive">

                                        <table id="tbl_exchange" class="table kh22">
                                            <tr>
                                                <td><input type="text" name="txtsign" id="txtsign" value="+" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtbuy" id="txtbuy" class="form-control txtexchange canenter" style="color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                <td><input type="text" name="lblbuy" id="lblbuy" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                            </tr>

                                            <tr>
                                                <td><input type="text" value="Rate" id="lblrate" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" style=""></td>
                                                <td><input type="button" id="btnaddlist" value="ADD" class="btn btn-info txtexchange" style="width:100px;text-align:center;" readonly></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" id="txtsign1" value="-" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtsale" id="txtsale" class="form-control txtexchange" style="color:red;" readonly></td>
                                                <td><input type="text" name="lblsale" id="lblsale" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                            </tr>
                                        </table>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div id="divexchangelist" style="@if($hasexchange>0) @else display:none; @endif">
                    <div  class="card">
                        <div class="card-header" style="height:35px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="kh16-b">Multi Exchange</p>
                                </div>
                                <div class="col-lg-6">
                                    <span style="float:right;font-size:16px;margin-left:20px;margin-top:-6px;"><button id="btnclosedivexchangelist" class="btn btn-danger btn-sm">X</button></span>
                                    <button id="btnclearlist" class="btn btn-info btn-sm" style="float:right;margin-top:-6px;">Clear List</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding-bottom:0px;" id="multiexchangecard">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="tablemultiexchange" class="table table-bordered">
                                        <thead style="text-align:center;">
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Buy</th>
                                            <th>Cur</th>
                                            <th style="display:none;">Buyinfo</th>
                                            <th>Rate</th>
                                            <th style="display:none;">Rateinfo</th>
                                            <th>Sale</th>
                                            <th>Cur</th>
                                            <th style="display:none;">Saleinfo</th>
                                            <th style="display:none;">Drate</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="multiexlist">
                                            @foreach ($mex as $key => $m)
                                                <tr>
                                                    <td style="text-align:center;padding:5px 0px;">{{ ++$key }}</td>
                                                    <td style="padding:0px;">
                                                      <input type="text" name="txtexids[]" class="form-control" style="width:100px;border-style:none;text-align:right;height:30px;" value="{{ $m->id }}">
                                                    </td>
                                                    <td style="padding:0px;">
                                                        <input type="text" name="txtbuys[]" class="form-control kh16-b" style="width:100%;border-style:none;text-align:right;height:30px;" value="{{ phpformatnumber($m->buy) }}">
                                                    </td>
                                                    <td style="padding:0px;">
                                                        <input type="text" name="txtcurbuys[]" class="form-control" style="width:50px;border-style:none;text-align:center;height:30px;padding:0px;" value="{{ $m->curbuy }}">
                                                    </td>
                                                    <td style="display:none;padding:0px;">
                                                        <input type="text" name="txtbuyinfoes[]" class="form-control" style="width:50px;border-style:none;height:30px;" value="{{ $m->buyinfo }}">
                                                    </td>
                                                    <td style="padding:0px;">
                                                        <input type="text" name="txtrates[]" class="form-control" style="width:80px;border-style:none;text-align:center;height:30px;" value="{{ phpformatnumber($m->rate) }}">
                                                    </td>
                                                    <td style="display:none;padding:0px;">
                                                        <input type="text" name="txtrateinfoes[]" class="form-control" style="width:50px;border-style:none;padding:0px;height:30px;" value="{{ $m->rateinfo }}">
                                                    </td>
                                                    <td style="padding:0px;">
                                                        <input type="text" name="txtsales[]" class="form-control kh16-b" style="width:100%;border-style:none;text-align:right;height:30px;" value="{{ phpformatnumber($m->sale) }}">
                                                    </td>
                                                    <td style="padding:0px;">
                                                        <input type="text" name="txtcursales[]" class="form-control" style="width:50px;border-style:none;text-align:center;height:30px;padding:0px;" value="{{ $m->cursale }}">
                                                    </td>
                                                    <td style="display:none;padding:0px;">
                                                        <input type="text" name="txtsaleinfoes[]" class="form-control" style="width:50px;border-style:none;height:30px;" value="{{ $m->saleinfo }}">
                                                    </td>
                                                    <td style="display:none;padding:0px;">
                                                        <input type="text" name="txtdrates[]" class="form-control" style="width:50px;border-style:none;height:30px;" value="{{ $m->drate }}">
                                                    </td>
                                                    <td style="text-align:center;padding:0px;">
                                                        <a data-mapcode="{{ $m->mapcode }}" data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Del</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="kh16">
                                                <th>សរុបទឹកប្រាក់ទទួល</th>

                                            </thead>
                                            <tbody>

                                                @foreach ($cashin as $ci)
                                                <tr>
                                                    <td style="font-size:22px;color:blue;text-align:right;">{{ phpformatnumber($ci['value']) }} &nbsp; {{ $ci['cur'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="kh16">
                                                <th>សរុបទឹកប្រាក់ប្រគល់</th>

                                            </thead>
                                            <tbody>

                                                @foreach ($cashout as $co)
                                                    <tr>
                                                        <td style="font-size:22px;color:red;text-align:right;">{{ phpformatnumber($co['value']) }} &nbsp; {{ $co['cur'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="divbankpayment" style="@if($hasbankpayment==1) @else display:none; @endif margin-bottom:30px;margin-top:0px;">
                    <div class="card">
                        <div class="card-header" style="height:40px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="kh16-b">Bank Payment</p>
                                </div>
                                <div class="col-lg-6">
                                    <span style="float:right;font-size:16px;margin-left:20px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-sm" style="margin-top:-5px;">X</button></span>
                                    <button id="btnaddrow" class="btn btn-info btn-sm" style="float:right;margin-top:-5px;">add row</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding-bottom:0px;padding:0px;">
                            <div class="table-responsive">
                                <table id="tbl_bankpayment" class="table table-bordered">
                                    <thead style="text-align:center;">
                                        <th style="">No</th>
                                        <th>Bank ID</th>
                                        <th style="display:none;">Bank Name</th>
                                        <th>Amount</th>
                                        <th>Cur</th>
                                        <th>Action</th>
                                        <th>Fee</th>
                                        <th>Charge</th>

                                    </thead>
                                    <tbody id="body_bankpayment">
                                        @foreach ($banktransfers as $key=> $item)
                                        <tr>
                                          <td style="text-align:center;padding:3px 0px;" class="no kh16">{{ ++$key }}</td>
                                          <td style="width:250px;padding:0px;">
                                              <select name="bankid[]" class="form-select select2-option1 bankid"  style="width:250px;">
                                                  <option value=""></option>
                                                  @foreach ($partners as $b)
                                                    <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" {{ $item->parrent_id==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                                  @endforeach
                                              </select>
                                          </td>
                                          <td style="padding:0px;display:none;">
                                              <input type="text" class="form-control bankname kh16" style="height:30px;" name="bankname[]" value="{{ $item->partner->name }}">
                                          </td>
                                          <td style="padding:0px;">
                                              <input type="text" class="form-control tdcanenter bankamt kh16-b" style="text-align:right;height:30px;" name="bankamt[]" value="@if($transfer->trancode==-1) {{ phpformatnumber(floatval($item->mekun) * floatval(abs($item->amount))) }} @else {{ phpformatnumber(-1 * floatval($item->mekun) * floatval(abs($item->amount))) }} @endif">
                                          </td>
                                          <td style="width:100px;padding:0px;">
                                              <select name="bankcur[]" class="bankcur kh16-b" id="" style="width:100px;height:30px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" {{ $item->currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                                                @endforeach
                                              </select>
                                          </td>

                                          <td style="text-align:center;padding:0px;">
                                              <a href="#" class="btn btn-danger btn-sm remove" style="border-radius:15px;"><i class="fa fa-minus"></i></a>
                                          </td>
                                          <td style="padding:0px;">
                                            <input type="text" class="form-control tdcanenter bankpartnerfee kh16-b" style="text-align:right;height:30px;" name="bankpartnerfee[]" value="@if($transfer->trancode==-1) {{ phpformatnumber(floatval($item->mekun) * floatval(abs($item->fee))) }} @else {{ phpformatnumber(-1 * floatval($item->mekun) * floatval(abs($item->fee))) }} @endif">
                                        </td>
                                        <td style="padding:0px;">
                                            <input type="text" class="form-control tdcanenter bankcuscharge kh16-b" style="text-align:right;height:30px;" name="bankcuscharge[]" value="{{phpformatnumber($item->cuscharge)}}">
                                        </td>
                                      </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row" style="margin-bottom:60px;">
          <div id="divtransferlist" style="@if($transfermultis && $transfermultis->count()>0) @else display:none; @endif">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="kh22-b">តារាងផ្ទេរប្រាក់ច្រើនតួ</h3>
                        </div>
                        <div class="col-lg-6">
                            <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-md">X</button></span>
                            <span style="font-size:22px;margin-left:20px;"><button id="btncleartransferlist" class="btn btn-warning btn-md kh16-b">សំអាត</button></span>

                          </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl_tranferlist" class="table table-bordered">
                            <thead style="text-align:center;" class="kh16">
                                <th>No</th>
                                <th>ថ្ងៃទី</th>
                                <th>អ្នកកត់ត្រា</th>
                                <th>ដៃគូពាក់ព័ន្ធ</th>
                                <th>ប្រតិបត្តិការណ៏</th>
                                <th style="display:none;">Trancode</th>
                                <th style="display:none;">Mekun</th>
                                <th>ចំនួនទឹកប្រាក់</th>
                                <th>រូបិយ</th>
                                <th>សេវ៉ាវេរ</th>
                                <th>រូបិយ</th>
                                <th>សេវ៉ាដៃគូ</th>
                                <th>រូបិយ</th>
                                <th>លេខទទួល</th>
                                <th>ឈ្មោះទទួល</th>
                                <th>លេខផ្ញើ</th>
                                <th>ឈ្មោះផ្ញើ</th>
                                <th>បុ.ពាក់ព័ន្ធ</th>
                                <th>សកម្មភាព</th>
                                <th>No</th>
                            </thead>
                            <tbody id="body_divtransferlist">
                                @foreach ($transfertemplists as $key => $mtr)
                                  <tr>
                                    <td style="text-align:center;" class="kh16">{{ ++$key }}</td>
                                    <td class="kh16-b">
                                        {{ date('d-m-Y',strtotime($mtr->dd)) }}
                                    </td>
                                    <td class="kh16-b">{{ $mtr->user->name }}</td>

                                    <td class="kh16-b" style="padding:0px;width:200px;">
                                      <select name="list_partnername[]" class="form-select select2-option1 list_partnername"  style="width:250px;">
                                        <option value=""></option>
                                        @foreach ($partners as $b)
                                          @if($mtr->user_affect>0)
                                            @if($mtr->parrent_id==$b->id)
                                              <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" {{ $mtr->parrent_id==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                            @endif
                                          @else
                                            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" {{ $mtr->parrent_id==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                          @endif

                                        @endforeach
                                      </select>
                                    </td>

                                    <td class="kh16-b" style="padding:0px;">
                                      <input type="text" class="kh16-b list_tranname" value="@if($mtr->trancode==1)ផ្ញើ@elseif($mtr->trancode==-1)ទទួល@else @endif"  name="list_tranname[]" style="width:150px;" autocomplete="off" readonly>
                                    </td>
                                    <td class="kh16-b" style="padding:0px;display:none;">
                                      <input type="text" class="form-control kh22 list_trancode" value="{{ $mtr->trancode }}"  name="list_trancode[]" style="" autocomplete="off">
                                    </td>
                                    <td class="kh16-b" style="padding:0px;display:none;">
                                      <input type="text" class="form-control kh22 list_mekun" value="{{ $mtr->mekun }}"  name="list_mekun[]" style="" autocomplete="off">
                                    </td>

                                    <td class="kh16-b" style="padding:0px;">
                                      <input type="text" class="kh16-b list_amount" value="{{ phpformatnumber($mtr->amount) }}"  name="list_amount[]" style="width:200px;text-align:right;" autocomplete="off">
                                    </td>
                                    <td class="kh16-b" style="padding:0px;">
                                      <select name="list_curid[]" class="list_curid kh16-b" id="" style="width:120px;height:30px;">
                                          <option value=""></option>
                                          @foreach ($currencies as $c)
                                              <option value="{{ $c->id }}" {{ $mtr->currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                                          @endforeach
                                      </select>
                                    </td>

                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_cuscharge" style="text-align:right;width:150px;" name="list_cuscharge[]" value="{{ phpformatnumber($mtr->cuscharge) }}">
                                    </td>
                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <select name="list_curcharge_id[]" class="list_curcharge_id kh16-b" id="" style="width:120px;height:30px;">
                                          <option value=""></option>
                                          @foreach ($currencies as $c)
                                              <option value="{{ $c->id }}" {{ $mtr->cuscharge_currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                                          @endforeach
                                      </select>
                                    </td>


                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_fee" style="text-align:right;width:150px;" name="list_fee[]" value="{{ phpformatnumber($mtr->fee) }}">
                                    </td>
                                    <td class="kh16-b" style="text-align:right;padding:0px;">

                                      <select name="list_curfee_id[]" class="list_curfee_id kh16-b" id="" style="width:120px;height:30px;">
                                        <option value=""></option>
                                        @foreach ($currencies as $c)
                                            <option value="{{ $c->id }}" {{ $mtr->fee_currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                                        @endforeach
                                      </select>
                                    </td>

                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_rectel" style="width:250px;" name="list_rectel[]" value="{{ $mtr->rectel }}">
                                    </td>

                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_recname" style="width:250px;" name="list_recname[]" value="{{ $mtr->recname }}">
                                    </td>

                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_sendertel" style="width:250px;" name="list_sendertel[]" value="{{ $mtr->sendertel }}">
                                    </td>

                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_sendername" style="width:250px;" name="list_sendername[]" value="{{ $mtr->sendername }}">
                                    </td>
                                    <td class="kh16-b" style="text-align:right;padding:0px;">
                                      <input type="text" class="kh16-b list_user_affect" style="width:100px;" name="list_user_affect[]" value="{{ $mtr->user_affect }}" readonly>
                                    </td>
                                    <td class="kh16-b" style="text-align:center;padding-top:2px;">
                                      <a href="#" class="btndeltransfertemp" data-id="{{ $mtr->id }}" style="color:red;" data-idfromtransfer="1">លុប</a>
                                    </td>
                                    <td style="text-align:center;padding:0px;" class="kh16">{{ $key }}</td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <select name="selbank" id="selbank" class="form-select kh22" style="display:none;">
            <option value="">Select Bank</option>
            @foreach ($banks as $b)
                <option value="{{ $b->id }}">{{ $b->name }}</option>
            @endforeach
        </select>
        <div id="divfooter">
            <div class="row" style="">
                <div class="col-lg-8">
                    <div style="margin-top:8px;margin-left:5px;">
                        {{-- <button id="btnnew" class="btn btn-primary kh16-b">សំអាតថ្មី</button> --}}
                        {{-- <button id="btnshowtemplist" class="btn btn-primary kh16-b">ShowTempList</button> --}}
                        @if($transfer->trancode==-1)
                          <button id="btncontinue" class="btn btn-primary kh16-b" >បន្តទៅ</button>
                        @endif
                        @if($transfer->trancode==1)
                          <button id="btnexchange" class="btn btn-primary kh16-b">ប្តូរប្រាក់</button>
                          <button id="btnbankpayment" class="btn btn-primary kh16-b">ទូទាត់តាមធនាគា</button>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div style="float:right;margin-top:8px;">
                        <button id="btnsavetransfer" class="btn btn-warning kh16-b" style="width:100px;">UPDATE</button>
                        <button id="btnsavetransferprint" class="btn btn-warning kh16-b" style="margin-right:10px;">UPDATE PRINT</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
    {{-- @include('moneytransfers.searchchildmodal') --}}
@endsection
@section('script')

    {{-- @include('moneytransfers.searchchildscript') --}}
    @include('moneytransfers.transferscriptupdate')

@endsection
