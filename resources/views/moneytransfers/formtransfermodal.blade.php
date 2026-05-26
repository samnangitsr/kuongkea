<div class="modal fade" id="formtransfermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 id="modalheader" class="modal-title kh22-b">ផ្ទេរប្រាក់</h5> --}}
                <span id="m_title" class="kh22-b">ផ្ទេរប្រាក់</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="frmtransfer" action="">
                    <div class="row" style="margin-top:-10px;">
                        <div class="col-lg-6">
                            <input type="hidden" id="hasmultitransfer" name="hasmultitransfer" value='0'>
                            <input type="hidden" id="hasexchange" name="hasexchange" value='0'>
                            <input type="hidden" id="hasexchangefix" name="hasexchangefix" value='0'>
                            <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0'>
                            <input type="hidden" id="tranname" name="tranname" value=''>
                            <input type="hidden" id="trancode1" name="trancode1">
                            <input type="hidden" id="trancode2" name="trancode2">
                            <input type="hidden" id="child_id" name="child_id">
                            <input type="hidden" id="mekun" name="mekun" value="0">
                            <input type="hidden" id="countrycode" name="countrycode" value="0">
                            <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">

                            <div class="row">
                              <div class="card" style="background-color:inherit;">
                                  <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;height:40px;">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group input-group-sm mb-3">
                                                <div id="divcklockdata" class="form-check kh16">
                                                    <input class="form-check-input" type="checkbox" id="cklockdata" name="cklockdata" value="" >
                                                    <label style="color:white;margin-top:-5px;" for="cklockdata" class="form-check-label kh18">ចងចាំទិន្ន័យ</label>
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <h1 id="partner_title" class="kh18-b" style="display:inline">ជ្រើសរើសដៃគូ</h1>
                                        </div>
                                        <div class="col-lg-3">

                                        </div>
                                    </div>

                                  </div>
                                  <div class="card-body" style="padding-bottom:0px;">
                                      <table id="tbl_partner" class="table" style="table-layout:fixed;">
                                          <tr>
                                              <td style="width:250px;">
                                                  <label for="date" class="kh18" style="width:120px;">កាលបរិច្ឆេទ</label>
                                              </td>
                                              <td>
                                                  <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:40px;" readonly>
                                              </td>
                                              <td style="width:40px;">
                                                  <span class="input-group-text" style="width:40px;height:40px;"><i class="fa fa-calendar"></i></span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="width:150px;"><label for="selpartner" class="kh18" style="">ជ្រើសរើសដៃគូ(<span id="lblpartner" class="kh16">PARTNER</span>)</label></td>
                                              <td colspan=2>
                                                  <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%">
                                                      <option value=""></option>
                                                      <optgroup label="ដៃគូ">
                                                          @foreach ($partners->where('customertype','PARTNER') as $p)
                                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                          @endforeach
                                                      </optgroup>
                                                      <optgroup label="ធនាគា">
                                                        @foreach ($partners->where('customertype','BANK') as $p)
                                                          <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                        @endforeach
                                                      </optgroup>
                                                      <optgroup label="ភ្នាក់ងារ">
                                                        @foreach ($partners->where('customertype','AGENT') as $p)
                                                          <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                        @endforeach
                                                      </optgroup>
                                                      @if (Auth::user()->role->name=='Admin')
                                                        <optgroup label="អតិថិជន">
                                                          @foreach ($customers as $p)
                                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                          @endforeach
                                                        </optgroup>
                                                      @endif
                                                  </select>
                                              </td>
                                          </tr>
                                          <tr id="row_son">
                                              <td style=""><label for="son" class="kh18" style="">បន្តទៅកូនសាខា</label></td>
                                              <td style="">
                                                  <input type="text" id="son" name="son" class="form-control kh16" style="height:40px;width:100%;">
                                              </td>

                                              <td style="width:60px;text-align:right;">
                                                  <button id="btnbrowseson" class="btn btn-info btn-md">...</button>
                                              </td>

                                          </tr>
                                          <tr id="rowseluseraffect1" style="display:none;">
                                            <td class="kh18" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                            <td colspan=2>
                                                <select class="form-select kh18" name="seluseraffect1" id="seluseraffect1" style="width:100%">
                                                    <option value=""></option>
                                                </select>
                                            </td>
                                          </tr>
                                          <tr id="rowcustomer">
                                              <td><label class="kh18" style="width:120px;">ជ្រើសរើសអតិថិជន</label></td>
                                              <td colspan=2>
                                                  <select class="form-select kh18" name="selcustomer" id="selcustomer" style="width:100%">
                                                      <option value=""></option>
                                                      @foreach ($customers as $c)
                                                          <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                          </tr>
                                          <tr id="rowitem">
                                            <td><label class="kh18" style="width:120px;">កុងធនាគា</label></td>
                                            <td colspan=2>
                                                <select class="form-select kh18" name="selitem" id="selitem" style="width:100%">

                                                </select>
                                            </td>
                                        </tr>

                                          <tr>
                                            <td>
                                                <i class="fa fa-volume-control-phone"></i>
                                                <label for="sendertel" class="kh18" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                            </td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16 canenter" id="sendertel" name="sendertel" style="height:40px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <i class="fa fa-address-book-o"></i>
                                              <label for="sendername" class="kh18" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label>
                                            </td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16 canenter" id="sendername" name="sendername" style="height:40px;">
                                            </td>
                                        </tr>
                                          <tr>
                                              <td>
                                                  <i class="fa fa-volume-control-phone"></i>
                                                  <label for="rectel" class="kh18" style="width:120px;">លេខអ្នកទទួល</label>
                                              </td>
                                              <td colspan=2>
                                                  <input type="text" class="form-control kh16 canenter" id="rectel" name="rectel" style="height:40px;">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                <i class="fa fa-address-book-o"></i>
                                                <label for="recname" class="kh18" style="width:120px;">ឈ្មោះអ្នកទទួល</label>
                                              </td>
                                              <td colspan=2>
                                                  <input type="text" class="form-control kh16 canenter" id="recname" name="recname" style="height:40px;">
                                              </td>
                                          </tr>
                                      </table>
                                  </div>
                              </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="row" style="">
                                <div class="card" style="background-color:inherit;">
                                  <div id="cardamount" class="card-header" style="background-color:silver;height:40px;">
                                      <h1 id="transfer_title" class="kh18-b" style="text-align:center;">NO TITLE</h1>
                                  </div>
                                  <div class="card-body" id="tblexchangemultiple">

                                      <table id="tbl_amount" class="table kh18" style="table-layout:fixed">
                                          <tr>
                                              <td style="width:250px;">ចំនួនទឹកប្រាក់វេរ</td>
                                              <td>
                                                  <input type="text" class="form-control kh22 canenter" id="amount" name="amount" style="width:100%;text-align:right;height:40px;" autocomplete="off">
                                              </td>
                                              <td style="width:150px;">
                                                  <select name="selcur" id="selcur" class="form-select kh16-b" style="width:150px;height:40px;">
                                                      <option value=""></option>
                                                      @foreach ($currencies as $c)
                                                          <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                          </tr>
                                          <tr id="row_cuscharge">
                                              <td><span id="spanseva">សេវ៉ាវេរ</span>
                                                <span id="divckwater" style="float:right;">
                                                    <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                                    <label for="ckwater" class="form-check-label kh18">ដកទឹក</label>
                                                </span>
                                              </td>
                                              <td>
                                                  <input type="text" class="form-control kh22 canenter" id="cuscharge" name="cuscharge" style="width:100%;text-align:right;height:40px;" value="0">
                                              </td>
                                              <td style="width:150px;">
                                                  <select name="selcur1" id="selcur1" class="form-select kh16-b" style="width:150px;height:40px;">
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
                                                  <input type="text" class="form-control kh22" id="totalcash" name="totalcash" style="width:100%;text-align:right;height:40px;" readonly>
                                              </td>
                                              <td style="width:150px;">
                                                  <input type="text" class="form-control kh16-b" id="txtcur" style="width:150px;height:40px;" readonly>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>សេវ៉ាដៃគូ</td>
                                              <td>
                                                  <input type="text" class="form-control kh22 canenter" id="fee" name="fee" style="width:100%;text-align:right;height:40px;" value="0">
                                              </td>
                                              <td style="width:150px;">
                                                  {{-- <input type="text" class="form-control kh22" id="txtcur1" style="width:150px;"> --}}
                                                  <select name="txtcur1" id="txtcur1" class="form-select kh16-b" style="width:150px;height:40px;">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $c)
                                                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                              </td>
                                          </tr>

                                          <tr id="row_kabrak1" style="display:none;">
                                              <td>ការប្រាក់</td>
                                              <td>
                                                  <input type="text" class="form-control kh22" id="interest1" name="interest1" style="width:100%;text-align:right;height:40px;" value="0">
                                              </td>
                                              <td style="width:150px;">
                                                  <input type="text" class="form-control kh22" id="txtcur_rate1" style="width:150px;height:40px;" readonly>
                                              </td>
                                          </tr>
                                      </table>

                                      <div class="row">
                                          <div class="col-lg-6">

                                          </div>
                                          <div class="col-lg-6">
                                            <button class="btn btn-primary" style="float:right;" id="btnaddtransferlist">ADD TO TRANSFER LIST</button>
                                          </div>
                                      </div>
                                  </div>

                                </div>
                            </div>

                            <div class="row">
                                <div id="divcontinue" style="display:none;margin-bottom:5px;">
                                    <div class="card" id="continuecard" >
                                        <div class="card-header" style="text-align:center;height:40px;">
                                            <h1 class="kh16-b" style="display:inline">ដៃគូបន្ត</h1>
                                            <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivcontinue" class="btn btn-danger btn-sm">X</button></span>

                                        </div>
                                        <div class="card-body" style="padding-bottom:0px;">
                                            <div class="row mb-3">
                                                <div class="table-responsive">
                                                    <table id="tbl_continue_partner" class="table">

                                                        <tr>
                                                            <td>
                                                                <label for="date" class="kh16" style="width:120px;">ជ្រើសរើសដៃគូ <br> <span id="lblpartner2" class="kh16-b">PARTNER</span></label>
                                                            </td>
                                                            <td colspan=2>
                                                                <select class="form-select kh16" name="selpartner2" id="selpartner2" style="width:100%">
                                                                    <option value=""></option>
                                                                    <optgroup label="ដៃគូ">
                                                                        @foreach ($partners->where('customertype','PARTNER') as $p)
                                                                        <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="ធនាគា">
                                                                    @foreach ($partners->where('customertype','BANK') as $p)
                                                                        <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                    @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="ភ្នាក់ងារ">
                                                                    @foreach ($partners->where('customertype','AGENT') as $p)
                                                                        <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                    @endforeach
                                                                    </optgroup>
                                                                    @if (Auth::user()->role->name=='Admin')
                                                                    <optgroup label="អតិថិជន">
                                                                        @foreach ($customers as $p)
                                                                        <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    @endif
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr id="rowseluseraffect2" style="display:none;">
                                                            <td class="kh18" style="color:blue;">បុគ្គលិកពាក់ព័ន្ធ</td>
                                                            <td colspan=2>
                                                                <select class="form-select kh18" name="seluseraffect2" id="seluseraffect2" style="width:100%">
                                                                    <option value=""></option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kh16">ចំនួនទឹកប្រាក់វេរ</td>
                                                            <td>
                                                                <input type="text" class="form-control kh22 canenter" id="amountcontinue" name="amountcontinue" style="width:100%;text-align:right;height:40px;" autocomplete="off">
                                                            </td>
                                                            <td style="width:150px;">
                                                                <select name="selcurcontinue" id="selcurcontinue" class="form-select kh16-b" style="width:150px;height:40px;">
                                                                    <option value=""></option>
                                                                    @foreach ($currencies as $c)
                                                                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kh16">សេវ៉ាបន្ត
                                                            <span id="divckwater2" style="float:right;">
                                                                <input class="form-check-input" type="checkbox" id="ckwater2" name="ckwater2" value=""  style="">
                                                                <label for="ckwater2" class="form-check-label kh18">ដកទឹក</label>
                                                            </span>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control kh22 canenter" id="cuscharge2" name="cuscharge2" style="width:100%;text-align:right;height:40px;" autocomplete="off">
                                                            </td>
                                                            <td style="width:150px;">
                                                                <select name="selcuschargecontinuecur" id="selcuschargecontinuecur" class="form-select kh16-b" style="width:150px;height:40px;">
                                                                    <option value=""></option>
                                                                    @foreach ($currencies as $c)
                                                                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr id="row_totalcash2">
                                                            <td class="kh16">សរុបទឹកប្រាក់</td>
                                                            <td>
                                                                <input type="text" class="form-control kh22" id="totalcash2" name="totalcash2" style="width:100%;text-align:right;height:40px;" readonly>
                                                            </td>
                                                            <td style="width:150px;">
                                                                <input type="text" class="form-control kh16-b" id="txtcur3" style="width:150px;height:40px;" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="kh16">សេវ៉ាដៃគូ</td>
                                                            <td>
                                                                <input type="text" class="form-control kh22 canenter" id="fee2" name="fee2" style="width:100%;text-align:right;height:40px;">
                                                            </td>
                                                            <td style="width:150px;">
                                                                {{-- <input type="text" class="form-control kh22" id="txtcur2" style="width:150px;"> --}}
                                                                <select name="txtcur2" id="txtcur2" class="form-select kh16-b" style="width:150px;height:40px;">
                                                                    <option value=""></option>
                                                                    @foreach ($currencies as $c)
                                                                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr id="row_kabrak2" style="display:none;">
                                                            <td class="kh16">ការប្រាក់</td>
                                                            <td>
                                                                <input type="text" class="form-control kh22" id="interest2" name="interest2" style="width:100%;text-align:right;height:40px;" value="0">
                                                            </td>
                                                            <td style="width:150px;">
                                                                <input type="text" class="form-control kh22" id="txtcur_rate2" style="width:150px;height:40px;" readonly>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="divexchangefix" style="display:none;margin-bottom:5px;">
                                    <div class="card" style="">
                                        <div class="card-header" style="text-align:center;height:40px;background-color:#caaf8f">
                                            <h1 class="kh18-b" style="display:inline">ប្តូរប្រាក់កំណត់</h1>
                                            <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivexchangefix" class="btn btn-danger btn-sm">X</button></span>
                                        </div>
                                        <div class="card-body" style="padding-bottom:0px;padding:0px;">
                                            <div class="row" style="">
                                            <div class="table-responsive">

                                                    <table id="tbl_exchange2" class="" style="margin:0px;padding:0px;">
                                                        <thead class="kh16-b" style="text-align:center;">
                                                        <th>លរ</th>
                                                        <th id="thbuy" colspan=3>ទិញចូល</th>
                                                        <th>អត្រា</th>
                                                        <th id='thsale' colspan=3>លក់ចេញ</th>
                                                        <th>Rate</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">1</td>
                                                            <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:blue;" autocomplete="off"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                            <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:red;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">2</td>
                                                            <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" autocomplete="off" style="color:blue;"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                            <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:red;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">3</td>
                                                            <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:blue;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" autocomplete="off" style="color:blue;"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" autocomplete="off" style="text-align:center;width:120px;"></td>
                                                            <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:red;width:30px;text-align:center;" readonly></td>
                                                            <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" autocomplete="off" style="color:red;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                            <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                            <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                        </tr>

                                                        <tr><td colspan=8></td></tr>
                                                        <tr><td colspan=8></td></tr>
                                                        <tr><td colspan=8></td></tr>

                                                        <tr style="background-color:blueviolet;margin-top:20px;">
                                                            <td style="display:none;"><input type="text" id="txtmainamt"  class="form-control txtexchangefix" style="color:blue;" readonly></td>
                                                            <td colspan=4 style="text-align:center;background-color:grey"><input type="button" style="" class="" id="btnexchangemore" value="More Exchange"></td>
                                                            <td colspan=1 class="kh16-b" style="text-align:right;color:white;">លុយវេរនៅសល់</td>
                                                            <td colspan=2><input type="text" id="txtleftamt"  class="form-control txtexchangefix" style="color:white;background-color:blueviolet" readonly></td>
                                                            <td><input type="text" id="txtleftcur" value="" class="form-control txtexchangefix" style="width:60px;text-align:center;color:white;background-color:blueviolet" readonly></td>
                                                            <td style="text-align:center;background-color:grey"><input type="button" style="" class="" id="btnaddexchange2" value="Add List"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="divexchangecard" style="display:none;margin-bottom:5px;margin-top:-5px;">
                                    <div class="card" style="">
                                        <div class="card-header" style="text-align:center;height:40px;">
                                            <h1 class="kh18-b" style="display:inline">ប្តូរប្រាក់ចំរុះ</h1>
                                            <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivexchangecard" class="btn btn-danger btn-sm">X</button></span>

                                        </div>
                                        <div class="card-body" style="padding-bottom:0px;">
                                            <div class="row mb-3">
                                                <div class="table-responsive">

                                                        <table id="tbl_exchange" class="table kh22">
                                                            <tr>
                                                                <td><input type="text" name="txtsign" id="txtsign" value="+" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                                <td><input type="text" name="txtbuy" id="txtbuy" class="form-control txtexchange canenter" autocomplete="off" style="color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                                <td><input type="text" name="lblbuy" id="lblbuy" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" value="Rate" id="lblrate" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                                <td><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" autocomplete="off" style=""></td>
                                                                <td><input type="button" id="btnaddlist" value="ADD" class="btn btn-info txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" id="txtsign1" value="-" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                                <td><input type="text" name="txtsale" id="txtsale" class="form-control txtexchange" style="color:red;"></td>
                                                                <td><input type="text" name="lblsale" id="lblsale" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                            </tr>
                                                        </table>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="divexchangelist" style="display:none;margin-bottom:5px;margin-top:-5px;">
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
                                        <div class="card-body" style="padding-bottom:0px;" id="multiexchangecard">

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
                                                                        <input type="text" name="txtbuys[]" class="form-control" readonly style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->buy) }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="txtcurbuys[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->curbuy }}">
                                                                    </td>
                                                                    <td style="display:none;">
                                                                        <input type="text" name="txtbuyinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->buyinfo }}">
                                                                    </td>
                                                                    <td style="">
                                                                        <input type="text" name="txtrates[]" class="form-control" readonly style="width:80px;border-style:none;padding:5px;text-align:center;" value="{{ phpformatnumber($m->rate) }}">
                                                                    </td>
                                                                    <td style="display:none;">
                                                                        <input type="text" name="txtrateinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:0px;" value="{{ $m->rateinfo }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="txtsales[]" class="form-control" readonly style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->sale) }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="txtcursales[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->cursale }}">
                                                                    </td>
                                                                    <td style="display:none;">
                                                                        <input type="text" name="txtsaleinfoes[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->saleinfo }}">
                                                                    </td>
                                                                    <td style="display:none;">
                                                                        <input type="text" name="txtdrates[]" class="form-control" readonly style="width:50px;border-style:none;padding:5px;" value="{{ $m->drate }}">
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

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="divbankpayment" style="display:none;margin-bottom:5px;margin-top:-5px;">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3>Bank Payment</h3>
                                                </div>
                                                <div class="col-lg-6">
                                                    <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-md">X</button></span>
                                                    <button id="btnaddrow" class="btn btn-info btn-md" style="float:right;">add row</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" style="padding-bottom:0px;">
                                            <div class="table-responsive">
                                                <table id="tbl_bankpayment" class="table table-bordered">
                                                    <thead style="text-align:center;">
                                                        <th style="display:none;">No</th>
                                                        <th>Bank ID</th>
                                                        <th style="display:none;">Bank Name</th>
                                                        <th>Amount</th>
                                                        <th>Cur</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="body_bankpayment">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:30px;position: sticky; bottom: 0; z-index: 1;">
                      <div id="divtransferlist" style="display:none">
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
                          <option value="{{ $b->id }}" customertype="{{ $b->customertype }}">{{ $b->name }}</option>
                      @endforeach
                    </select>

                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <div>
                    <button id="btnnew" class="btn btn-info kh16-b">សំអាតថ្មី</button>
                    <button id="btnshowtemplist" class="btn btn-primary kh16-b">ShowTempList</button>
                    <button id="btncontinue" class="btn btn-primary kh16-b" title="Ctrl + G">បន្តទៅ</button>
                    {{-- <button id="btnexchange" class="btn btn-primary kh16-b" title="CTRL+1">ប្តូរប្រាក់១</button> --}}
                    <button id="btnexchange2" class="btn btn-info kh16-b" title="Ctrl + E" >ប្តូរប្រាក់</button>
                    <button id="btnbankpayment" class="btn btn-primary kh16-b" title="CTRL+B">ទូទាត់តាមធនាគា</button>

                </div>

                <div>

                    <button id="btnsavetransfer" class="btn btn-info kh16-b" style="width:100px;">រក្សាទុក</button>
                    <button id="btnsavetransferprint" class="btn btn-primary kh16-b" style="">រក្សាទុកព្រីន</button>
                    <button id="btnsavewithcashdraw" class="btn btn-primary kh16-b" style="margin-right:10px;">រក្សាទុកបើកវេរ</button>
                </div>
            </div>
        </div>
    </div>
</div>
