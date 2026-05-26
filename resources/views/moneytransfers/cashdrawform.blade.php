@extends('master')
@section('title') Cashdraw Money @endsection
@section('css')
    <style type="text/css">
        #selpartner_continue + .select2 .select2-selection__rendered {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
		/* Each result */
		#select2-selpartner_continue-results {font-family: 'Noto Sans Khmer', sans-serif;font-size:22px;}
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

    <form id="frmcashdraw" action="">
        <div class="row">
            <div class="col-lg-6">
                <input type="text" id="tranfer_id" name="transfer_id" value="{{ $ptransfer->id }}">
                <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                <input type="text" id="hasexchange" name="hasexchange" value='0'>
                <input type="text" id="hascontinue" name="hascontinue" value='0'>
                <div class="card">
                    <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;">
                        <h1 id="partner_title" class="kh22-b">ព៌តមានវេរ</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="table-responsive">
                                <table id="tbl_partner" class="table">
                                    <tr>
                                        <td>
                                            <label for="date" class="kh22" style="width:120px;">ថ្ងៃវេរ</label>
                                        </td>
                                        <td>
                                            <input type="text" name="invdate" id="invdate" class="form-control" value="{{ date('d-m-Y',strtotime($ptransfer->dd)) }}" style="background-color:white;font-size:22px;" readonly>
                                        </td>
                                        <td style="width:60px;">
                                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="date" class="kh22" style="width:120px;">វេរមកពីដៃគូ</label></td>
                                        <td colspan=2>
                                            <input type="hidden" id="from_partner_id" name="from_partner_id" class="form-control kh22" value="{{ $ptransfer->parrent_id }}">
                                            <input type="text" id="from_partner" name="from_partner" class="form-control kh22" value="{{ $ptransfer->partner->name }}">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td><label for="rectel" class="kh22" style="width:120px;">លេខអ្នកទទួល</label></td>
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
                                        <td><label for="sendertel" class="kh22" style="width:120px;">លេខអ្នកផ្ញើ</label></td>
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
                <div class="card">
                    <div id="cardamount" class="card-header" style="background-color:silver;">
                        <h1 id="transfer_title" class="kh22-b" style="text-align:center;">បើកវេរ</h1>
                    </div>
                    <div class="card-body" id="">
                        <div class="table-responsive">
                            <table id="tbl_amount" class="table kh22">
                                <tr>
                                    <td>ចំនួនទឹកប្រាក់វេរ</td>
                                    <td>
                                        <input type="text" class="form-control kh22 canenter" id="amount" name="amount" value="{{ phpformatnumber($ptransfer->amount * $ptransfer->mekun) }}" style="width:100%;text-align:right;" autocomplete="off" readonly>
                                    </td>
                                    <td style="width:150px;">
                                        <select name="selcur" id="selcur" class="form-select kh22" style="width:150px;" disabled>
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" {{ $ptransfer->currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>កាត់សេវ៉ា</td>
                                    <td>
                                        <input type="text" class="form-control kh22 canenter" id="cuscharge" name="cuscharge" value="0" style="text-align:right;">
                                    </td>
                                    <td style="width:150px;">
                                        <input type="text" class="form-control kh22" id="txtcur_cutseva" value="{{ $ptransfer->currency->shortcut }}" style="width:150px;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>លុយត្រូវបើក</td>
                                    <td>
                                        <input type="text" class="form-control kh22 canenter" id="openamt" name="openamt" value="{{ phpformatnumber($ptransfer->amount * $ptransfer->mekun) }}" style="text-align:right;">
                                    </td>
                                    <td style="width:150px;">
                                        <input type="text" class="form-control kh22" id="txtcur_open" value="{{ $ptransfer->currency->shortcut }}" style="width:150px;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកមកបើក</td>
                                    <td colspan=2>
                                        <input type="text" class="form-control kh22 canenter" id="rec_tel" name="rec_tel" value="" style="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>ឈ្មោះ</td>
                                    <td colspan=2>
                                        <input type="text" class="form-control kh22 canenter" id="rec_name" name="rec_name" value="" style="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>ផ្សេងៗ</td>
                                    <td colspan=2>
                                        <textarea name="txtother" id="txtother" style="width:100%" rows="2"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="date" class="kh22" style="width:120px;">ថ្ងៃបើកវេរ</label>
                                    </td>
                                    <td>
                                        <input type="text" name="opdate" id="opdate" class="form-control" value="" style="background-color:white;font-size:22px;" readonly>
                                    </td>
                                    <td style="width:60px;">
                                        <span class="input-group-text" style="background-color:inherit;border:none;"><i class="fa fa-calendar fa-2x"></i></span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button id="btncontinue" class="btn btn-default" >Continue To</button>
                        <button id="btnexchange" class="btn btn-default">Exchange</button>
                        <div style="float:right">
                            <button id="btnsavecashdraw" class="btn btn-info kh22">រក្សាទុក</button>
                            <button id="btnsavecashdrawprint" class="btn btn-primary kh22">រក្សាទុកព្រីន</button>
                        </div>
                    </div>

                </div>

                <div id="divexchangecard" style="display:none;">
                    <div class="card">
                        <div class="card-header" style="text-align:center;">
                            <h1 class="kh22-b" style="display:inline">Exchange</h1>
                            <span style="float:right;font-size:22px;"><button id="btnclosedivexchangecard" class="btn btn-danger btn-md">X</button></span>

                        </div>
                        <div class="card-body">
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
                                                <td><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" style="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
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
                        <div class="card-footer">
                            <button id="btncontinue1" class="btn btn-default" >Continue To</button>
                            <div style="float:right">
                                <button id="btnsavecashdraw1" class="btn btn-info kh22">រក្សាទុក</button>
                                <button id="btnsavecashdrawprint1" class="btn btn-primary kh22">រក្សាទុកព្រីន</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divexchangelist" style="display:none;">
                    <div  class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Multi Exchange</h3>
                                </div>
                                <div class="col-lg-6">
                                    <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivexchangelist" class="btn btn-danger btn-md">X</button></span>
                                    <button id="btnclearlist" class="btn btn-info" style="float:right;">Clear List</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="multiexchangecard">

                            <div class="row">
                                <div class="table-responsive">
                                    <table id="tablemultiexchange" class="table table-bordered">
                                        <thead style="text-align:center;">
                                            <th>No</th>
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
                                                    <td style="text-align:center;">{{ ++$key }}</td>
                                                    <td>
                                                        <input type="text" name="txtbuys[]" class="form-control txtbuys" style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->buy) }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="txtcurbuys[]" class="form-control txtcurbuys" style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->curbuy }}">
                                                    </td>
                                                    <td style="display:none;">
                                                        <input type="text" name="txtbuyinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->buyinfo }}">
                                                    </td>
                                                    <td style="">
                                                        <input type="text" name="txtrates[]" class="form-control" style="width:80px;border-style:none;padding:5px;text-align:center;" value="{{ phpformatnumber($m->rate) }}">
                                                    </td>
                                                    <td style="display:none;">
                                                        <input type="text" name="txtrateinfoes[]" class="form-control" style="width:50px;border-style:none;padding:0px;" value="{{ $m->rateinfo }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="txtsales[]" class="form-control" style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->sale) }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="txtcursales[]" class="form-control" style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->cursale }}">
                                                    </td>
                                                    <td style="display:none;">
                                                        <input type="text" name="txtsaleinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->saleinfo }}">
                                                    </td>
                                                    <td style="display:none;">
                                                        <input type="text" name="txtdrates[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->drate }}">
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Del</a>
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
                        <div class="card-footer">
                            <button id="btncontinue2" class="btn btn-default" >Continue To</button>
                            <div style="float:right">
                                <button id="btnsavecashdraw2" class="btn btn-info kh22">រក្សាទុក</button>
                                <button id="btnsavecashdrawprint2" class="btn btn-primary kh22">រក្សាទុកព្រីន</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divcontinue" style="display:none;">
                    <div class="card" id="continuecard" >
                        <div class="card-header" style="text-align:center;">
                            <h1 class="kh22-b" style="display:inline">ដៃគូបន្ត</h1>
                            <span style="float:right;font-size:22px;"><button id="btnclosedivcontinue" class="btn btn-danger btn-md">X</button></span>

                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="table-responsive">
                                    <table id="tbl_continue_partner" class="table kh22">

                                    <tr>
                                        <td><label for="date" class="kh22" style="width:150px;">ជ្រើសរើសដៃគូ</label></td>
                                        <td colspan=2>
                                            <select class="form-select kh22" name="selpartner_continue" id="selpartner_continue" style="width:100%">
                                                <option value=""></option>
                                                @foreach ($customers->whereIn('customertype',['BANK','PARTNER']) as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="row_son">
                                        <td><label for="son" class="kh22" style="width:150px;">បន្តទៅកូនសាខា</label></td>
                                        <td colspan=2>
                                            <input type="text" id="son" name="son" class="form-control kh16" style="width:88%;height:48px;display:inline;">
                                            <button id="btnbrowseson" style="width:60px;display:inline;" class="btn btn-info btn-lg">...</button>
                                        </td>

                                        {{-- <td style="width:60px;text-align:right;">
                                            <button id="btnbrowseson" class="btn btn-info btn-lg">...</button>
                                        </td> --}}

                                    </tr>

                                    <tr>
                                        <td><label for="rectel" class="kh22" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកទទួល</label></td>
                                        <td colspan=2>

                                            <input type="text" class="form-control kh22 typeautosearch canenter" id="rectel_continue" name="rectel_continue">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="recname" class="kh22" style="width:150px;">ឈ្មោះអ្នកទទួល</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="recname_continue" name="recname_continue">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sendertel" class="kh22" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកផ្ញើ</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="sendertel_continue" name="sendertel_continue">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="sendername" class="kh22" style="width:150px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="sendername_continue" name="sendername_continue">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ចំនួនទឹកប្រាក់វេរ</td>
                                        <td>
                                            <input type="text" class="form-control kh22 canenter" id="amount_continue" name="amount_continue" style="width:100%;text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:150px;">
                                            <select name="selcur_continue" id="selcur_continue" class="form-select kh22" style="width:150px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="row_cuscharge">
                                        <td>សេវ៉ាវេរ</td>
                                        <td>
                                            <input type="text" class="form-control kh22 canenter" id="cuscharge_continue" name="cuscharge_continue" style="width:100%;text-align:right;">
                                        </td>
                                        <td style="width:150px;">
                                          <select name="txtcur2" id="txtcur2" class="form-select kh22" style="width:150px;">
                                              <option value=""></option>
                                              @foreach ($currencies as $c)
                                                  <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                    </tr>
                                    <tr id="row_totalcash">
                                        <td>សរុបទឹកប្រាក់</td>
                                        <td>
                                            <input type="text" class="form-control kh22" id="totalcash" name="totalcash" style="width:100%;text-align:right;">
                                        </td>
                                        <td style="width:150px;">
                                            <input type="text" class="form-control kh22" id="txtcur" style="width:150px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>សេវ៉ាដៃគូ</td>
                                        <td>
                                            <input type="text" class="form-control kh22 canenter" id="fee_continue" name="fee_continue" style="width:100%;text-align:right;">
                                        </td>
                                        <td style="width:150px;">
                                          <select name="txtcur1" id="txtcur1" class="form-select kh22" style="width:150px;">
                                              <option value=""></option>
                                              @foreach ($currencies as $c)
                                                  <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                              @endforeach
                                          </select>
                                        </td>
                                    </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div id="divckwater" class="form-check kh22">
                                        <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value="" >
                                        <label for="ckwater" class="form-check-label kh22">ដកទឹក</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div style="float:right">
                                        <button id="btnsavecashdraw3" class="btn btn-info kh22">រក្សាទុក</button>
                                        <button id="btnsavecashdrawprint3" class="btn btn-primary kh22">រក្សាទុកព្រីន</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    @include('moneytransfers.searchchildmodal')
@endsection
@section('script')
    @include('moneytransfers.searchchildscript')
    @include('moneytransfers.exchangescript');
   <script>
    $(document).ready(function () {

        var today=new Date();
       $('#opdate').datetimepicker({
           timepicker:false,
           datepicker:true,
           value:today,
           format:'d-m-Y',
           autoclose:true,
           todayBtn:true,
           startDate:today,

       });

       var cleave = new Cleave('#rectel', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        var cleave = new Cleave('#sendertel', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        var cleave = new Cleave('#rec_tel', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        var cleave = new Cleave('#rectel_continue', {
            blocks: [0, 3, 3, 4, 10],
            //delimiters: ['(', ') ', '-', ' '],
            numericOnly: true
        });
        var cleave = new Cleave('#cuscharge', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#amount_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#cuscharge_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('#fee_continue', {
            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand'
        });
        $('#selpartner').select2();
        $("#selpartner_continue").select2({
            dropdownParent: $("#cashdrawmodal")
        });
        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
			$(this).closest(".select2-container").siblings('select:enabled').select2('open');
		});

        $(document).on('click','#btnexchange',function(e){
            e.preventDefault();

            disablebutton($(this).attr('id'));
            $('#divexchangecard').css('display','block');
            //$('#divexchangelist').css('display','block');
            $('#hasexchange').val(1);
            var buy=0;
            var curid=$('#selcur').val();
            buy=$('#openamt').val().replace(/,/g, '');
            $('#txtbuy').val(formatNumber(buy));
            $('#lblrate').attr('title',1);
            getcurrencybyid(curid,'#lblbuy');
            getcurrencybykey('d','#lblsale')
            //getrate();
            $('#txtbuy').css('color','blue');
            $('#txtsale').css('color','red');
            $('#txtsign').val('+');
            $('#txtsign1').val('-');
            window.scrollTo(0, document.body.scrollHeight);


        })
        $(document).on('click','#btncontinue,#btncontinue1,#btncontinue2',function(e){
            e.preventDefault();
            disablebutton($(this).attr('id'));
            $('#hascontinue').val(1);
            $('#divcontinue').css('display','block');
            $('#selpartner').focus();
            var hasexchange=$('#hasexchange').val();
            var amt_continue=0;
            var lblsale='';
            var cur_continue='';
            if(hasexchange==1){
                amt_continue=$('#txtsale').val();
                lblsale=$('#lblsale').attr('title').split(";");
                cur_continue=lblsale[0];
            }else{
                amt_continue=$('#openamt').val();
                cur_continue=$('#selcur').val();
            }
            $('#amount_continue').val(amt_continue);
            $('#selcur_continue').val(cur_continue);
            $('#amount_continue').attr('title',amt_continue);
            filltxtcur();
            window.scrollTo(0, document.body.scrollHeight);
        })
        $(document).on('change','#selcur_continue',function(e){
            filltxtcur();
        })
        function filltxtcur()
        {
            var seltext=$('#selcur_continue option:selected').text();
            $('#txtcur').val(seltext);
            $('#txtcur1').val(seltext);
            $('#txtcur2').val(seltext);
        }
        $(document).on('click','#btnclosedivcontinue',function(e){
            e.preventDefault();
            $('#hascontinue').val(0);
            $('#divcontinue').css('display','none');
            buttonclose($(this).attr('id'));

        })
        $(document).on('click','#btnclosedivexchangecard',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));

            $('#divexchangecard').css('display','none');
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(0)
        })
        $(document).on('click','#btnclosedivexchangelist',function(e){
            e.preventDefault();
            buttonclose($(this).attr('id'));
            $('#divexchangelist').css('display','none');
            $('#hasexchange').val(1)
        })
        $(document).on('keydown', '.canenter', function (e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("id");
                if (id == 'txtbuy') {
                    $('#txtrate').focus();
                } else if(id == 'txtrate'){
                   $('#btnsavecashdraw1').focus();
                } else if (id == 'cuscharge'){
                    $('#rec_tel').focus();
                }else if (id == 'rec_tel') {
                    $('#rec_name').focus();
                }else if (id == 'rec_name') {
                    $('#txtother').focus();
                }else if(id=='amount_continue'){
                    $('#cuscharge_continue').focus();
                }else if(id=='cuscharge_continue'){
                    $('#fee_continue').focus();
                }else if(id=='fee_continue'){
                    $('#btnsavecashdraw3').focus();
                }else if(id=='rectel_continue'){
                    $('#recname_continue').focus();
                }else if(id=='recname_continue'){
                    $('#sendertel_continue').focus();
                }else if(id=='sendertel_continue'){
                    $('#sendername_continue').focus();
                }else if(id=='sendername_continue'){
                    $('#amount_continue').focus();
                }
                e.preventDefault();
            }
        })
        var url1 = "{{ route('rectel.autocomplete') }}";
        $( "#rectel_continue" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: url1,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term.replace(/\s+/g, '')
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
            console.log(ui.item);
           $('#rectel_continue').val(ui.item.label);
           $('#recname_continue').val(ui.item.recname);
           var cleave = new Cleave('#rectel_continue', {
                blocks: [0, 3, 3, 4, 10],
                numericOnly: true
            });
           return false;
        }
      });
      var url3 = "{{ route('cashdrawrectel.autocomplete') }}";
        $( "#rec_tel" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: url1,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term.replace(/\s+/g, '')
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
            console.log(ui.item);
           $('#rec_tel').val(ui.item.label);
           $('#rec_name').val(ui.item.recname);
           var cleave = new Cleave('#rec_tel', {
                blocks: [0, 3, 3, 4, 10],
                numericOnly: true
            });
           return false;
        }
      });

      var url2 = "{{ route('sendertel.autocomplete') }}";
        $( "#sendertel_continue" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: url2,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term.replace(/\s+/g, '')
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
            console.log(ui.item);
           $('#sendertel_continue').val(ui.item.label);
           $('#sendername_continue').val(ui.item.sendername);
           var cleave = new Cleave('#sendertel', {
                blocks: [0, 3, 3, 4, 10],
                numericOnly: true
            });
           return false;
        }
      });

        $(document).on('keyup', '#txtbuy', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }else if(C==="+"){
                e.preventDefault();
                $('#txtbuy').css('color','blue');
                $('#txtsale').css('color','red');
                $('#txtsign').val('+');
                $('#txtsign1').val('-');
                getrate();


                return;
            }else if(C==="-"){
                e.preventDefault();
                $('#txtbuy').css('color','red');
                $('#txtsale').css('color','blue');
                $('#txtsign').val('-');
                $('#txtsign1').val('+');
                getrate();

                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblbuy')
            }
        })
        $(document).on('keyup', '#txtrate', function (e) {
            //debugger
            //alert(e.key)
            if(isNumber(e.key)){
                calcuexchange();
                return;
            }
            //alert('not a number')
            const C = e.key;
            if (C === "Backspace") {
                calcuexchange();
                return;
            }
            if(isNumber(C)==false){
                getcurrencybykey(C,'#lblsale')
            }
        })

        $(document).on('keyup','#cuscharge',function(e){
            const C = e.key;
            openamount();
        })
        function openamount()
        {

            var openamt=0;
            var amt=$('#amount').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge').val().replace(/,/g, '');
            openamt=parseFloat(amt)-parseFloat(cuscharge);
            if(isNaN(openamt)){
                openamt=amt;
            }
            $('#openamt').val(formatNumber(parseFloat(openamt)));

        }
        $(document).on('click','#btnsavecashdraw,#btnsavecashdraw1,#btnsavecashdraw2,#btnsavecashdraw3',function(e){
            e.preventDefault();
            var curid=$('#selcur').val();
            var formdata=new FormData(frmcashdraw);
            formdata.append('curid',curid);

            var hasexchange=$('#hasexchange').val();
            //append exchange
            if(hasexchange==1){
                //var cashreceive=$('#txtcashreceive').val() + $('#lblcashin').val();
                // var cashreturn=$('#txtcashreturn').val();
                var m1 = $('#lblbuy').attr('title').split(";");
                var m2 = $('#lblsale').attr('title').split(";");
                var pid = 0;
                var mcur = '';
                var pcur = '';
                var luy = 0;
                var product = 0;
                var mekun = 1;
                var item1 = 0;
                var item2 = 0;
                var rate1b = 0;
                var rate1s = 0;
                var rate2b = 0;
                var rate2s = 0;
                var curid1 = 0;
                var curid2 = 0;
                var pcur1 = '';
                var pcur2 = '';
                var buy='0';
                var sale='0';
                var curbuy='';
                var cursale='';
                var receipt2='0';

                if ($('#txtsign').val() == '+') {
                    mekun = 1;
                    buy=$('#txtbuy').val();
                    sale=$('#txtsale').val();
                    curbuy=$('#lblbuy').val();
                    cursale=$('#lblsale').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtbuy').val() + curbuy;
                    //     cashreturn=$('#txtsale').val() + cursale;
                    // }

                } else {
                    mekun = -1;
                    buy=$('#txtsale').val();
                    sale=$('#txtbuy').val();
                    curbuy=$('#lblsale').val();
                    cursale=$('#lblbuy').val();
                    // if($('#txtcashreceive').val()==''){
                    //     cashreceive=$('#txtsale').val() + cursale;
                    //     cashreturn=$('#txtbuy').val()+curbuy;
                    // }
                }
                if (m1[4] == '1') {
                    mcur = m1[6];
                    pid = m2[0];
                    pcur = m2[6];
                    luy = mekun * $('#txtbuy').val().replace(/,/g, '');
                    product = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else if (m2[4] == '1') {
                    mcur = m2[6];
                    pid = m1[0];
                    pcur = m1[6];
                    product = mekun * $('#txtbuy').val().replace(/,/g, '');
                    luy = -1 * mekun * $('#txtsale').val().replace(/,/g, '');
                } else {
                    receipt2='1';
                    item1 = $('#txtbuy').val();
                    item2 = $('#txtsale').val();
                    rate1b = m1[1];
                    rate1s = m1[2];
                    rate2b = m2[1];
                    rate2s = m2[2];
                    curid1 = m1[0];
                    curid2 = m2[0];
                    pcur1 = m1[6];
                    pcur2 = m2[6];
                    //url = "{{ route('saveexchangeproduct') }}"
                }

                formdata.append("product_id", pid);
                formdata.append("product_cur", pcur);
                formdata.append("exchange_amount", luy);
                formdata.append("maincur", mcur);
                formdata.append("product", product);
                formdata.append("exchange_rate", $('#txtrate').val());
                formdata.append("origin_rate", $('#lblrate').attr('title'));

                formdata.append("exsign", $('#txtsign').val());
                formdata.append("item1", item1);
                formdata.append("item2", item2);
                formdata.append("rate1buy", rate1b);
                formdata.append("rate1sale", rate1s);
                formdata.append("rate2buy", rate2b);
                formdata.append("rate2sale", rate2s);
                formdata.append("curid1", curid1);
                formdata.append("curid2", curid2);
                formdata.append("pcur1", pcur1);
                formdata.append("pcur2", pcur2);
                formdata.append("buy",buy);
                formdata.append("sale", sale);
                formdata.append("curbuy", curbuy);
                formdata.append("cursale", cursale);

            }

            var url="{{ route('moneytransfer.savecashdraw') }}"

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
        $(document).on('keyup','#amount_continue',function(e){
            const C = e.key;
            cutwater(1);
        })
        $(document).on('keyup','#cuscharge_continue',function(e){
            const C = e.key;
            cutwater(0);
        })
        $(document).on('change','#amount_continue',function(e){
            $('#amount_continue').attr('title',$(this).val());
        })
        $(document).on('change','#ckwater',function(e){
           cutwater(0);
        })
        function cutwater(isamtkeyup)
        {
            if(isamtkeyup!=1){
                var ck = document.getElementById("ckwater").checked;
                var amt=$('#amount_continue').attr('title').replace(/,/g, '');
                var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
                if(ck==true){
                    amt=amt-cuscharge;
                    $('#amount_continue').val(formatNumber(amt));
                }else{
                    $('#amount_continue').val(formatNumber(amt));
                }
            }

            totalcash();
        }
        function totalcash()
        {
            var totalcash=0;
            var amt=$('#amount_continue').val().replace(/,/g, '');
            var cuscharge=$('#cuscharge_continue').val().replace(/,/g, '');
            totalcash=parseFloat(amt)+parseFloat(cuscharge);
            $('#totalcash').val(formatNumber(parseFloat(totalcash)));

        }

    })


   </script>
@endsection
