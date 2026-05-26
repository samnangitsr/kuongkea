<div class="modal fade" id="cashdrawmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="height:50px;">
                <p id="modalheader" class="modal-title kh22-b">បើកវេរលុយថៃ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmcashdraw" action="" enctype="multipart/form-data" autocomplete="off">
                  {{ csrf_field() }}
                  <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                  <input type="hidden" id="hasexchange" name="hasexchange" value='0' title="hasexchange">
                  <input type="hidden" id="hasexchangefix" name="hasexchangefix" value='0' title="hasexchangefix">
                  <input type="hidden" id="hascontinue" name="hascontinue" value='0' title="hascontinue">
                  <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0' title="hasbankpayment">
                  <input type="hidden" id="hasmulticashdraw" name="hasmulticashdraw" value='0' title="hasmulticashdraw">
                  <input type="hidden" id="trancode1" name="trancode1" value='-1'>
                  <input type="hidden" id="clickfrom">
                  <input id="usercheckid" type="hidden" value="{{ Auth::id() }}">
                    <div id="diva" class="row" style="display:none;">

                    </div>
                    <div class="row">
                        <div id="divm1" class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table" style="table-layout:fixed;width:100%">
                                    <thead style="text-align:center;">
                                    <th colspan=2 style="width:200px;" class="kh16-b">សរុបទឹកប្រាក់បើក</th>
                                    <th style="width:150px;" class="kh16-b">កាត់សេវ៉ា</th>
                                    <th colspan=2 style="width:200px;" class="kh16-b">លុយត្រូវប្រាក់បើក</th>
                                    <th style="width:200px;" class="kh16-b">លេខអ្នកទទួល</th>
                                    <th style="width:200px;" class="kh16-b">ឈ្មោះអ្នកទទួល</th>

                                    <th class="kh16-b">សកម្មភាព</th>
                                    </thead>
                                    <tbody id="tbl_total_cashdraw">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="divm2" class="col-lg-12">
                            <div class="table-repsonsive">
                                <table class="table" style="table-layout:fixed;width:100%">
                                    <tr>
                                        <td style="padding:0px;border-style:none;">
                                            <input type="text" name="opdates" id="opdates" class="form-control" value="" style="background-color:white;font-size:22px;" readonly>
                                        </td>
                                        <td style="padding:0px;border-style:none;width:60px;">
                                            <span class="input-group-text" style="background-color:inherit;border:none;"><i class="fa fa-calendar fa-2x"></i></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=2 style="padding:0px;border-style:none;">
                                            <textarea class="form-control kh22" name="txtnotes" id="txtnotes" style="width:100%" rows="2" placeholder="កំណត់សំគាល់"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="divb">
                                <div class="table-responsive">
                                    <table id="tbl_partner" class="" style="">
                                        <tr class="kh16-b">
                                            <td style="width:100px;">SMSID</td>
                                            <td style="width:130px;">ថ្ងៃវេរ</td>
                                            <td style="width:250px;">វេរមកពីដៃគូ</td>
                                            <td colspan=2 style="width:220px;">ចំនួនទឹកប្រាក់</td>
                                            <td colspan=2 style="width:180px;">កាត់សេវ៉ា</td>
                                            <td colspan=2 style="width:180px;">លុយត្រូវបើក</td>
                                            <td colspan=2 style="width:180px;">លុយប្រើអស់</td>
                                            <td colspan=2 style="width:180px;">លុយនៅសល់</td>
                                        </tr>
                                        <tr>
                                            <td style="width:100px;"><input type="text" style="width:100px;" class="kh16-b" id="transfer_id" name="transfer_id" value="" readonly></td>
                                            <td style="width:130px;"><input type="text" name="invdate" id="invdate" class="kh16-b" value="" style="background-color:white;width:130px;" readonly></td>
                                            <td style="width:250px;">
                                                <input type="hidden" id="from_partner_id" name="from_partner_id" class="kh22" value="">
                                                <input type="text" style="width:250px;" id="from_partner" name="from_partner" class="kh16-b" value="">
                                            </td>

                                            <td style="width:120px;">
                                                <input type="text" class="kh16-b canenter" id="amount" name="amount" value="" style="width:180px;text-align:right;" autocomplete="off" readonly>
                                            </td>
                                            <td style="width:100px;">
                                                <select name="selcur" id="selcur" class="kh16-b" style="width:100px;height:30px;">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $c)
                                                        <option value="{{ $c->id }}" @if($c->shortcut<>'THB') disabled @endif>{{ $c->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td style="width:120px;">
                                                <input type="text" class="kh16-b canenter" id="cuscharge" name="cuscharge" value="0" style="text-align:right;width:120px;">
                                            </td>
                                            <td style="width:60px;">
                                                <input type="text" class="kh16-b" id="txtcur_cutseva" value="" style="width:60px;" readonly>
                                            </td>

                                            <td colspan=2 style="width:180px;">
                                                <div class="input-group" style="width:180px;">
                                                    <input type="text" class="kh16-b canenter" id="openamt" name="openamt" value="" style="text-align:right;width:120px;height:30px;" readonly>
                                                    <input type="text" class="input-group-text kh16-b" id="txtcur_open" value="" style="width:60px;height:30px;" readonly>
                                                </div>
                                            </td>
                                            <td colspan=2 style="width:180px;">
                                                <div class="input-group" style="width:180px;">
                                                    <input type="text" class="kh16-b canenter" id="useamt" name="useamt" value="" style="text-align:right;width:120px;height:30px;" readonly>
                                                    <input type="text" class="input-group-text kh16-b" id="txtcur_open1" value="" style="width:60px;height:30px;" readonly>
                                                </div>
                                            </td>
                                            <td colspan=2 style="width:180px;">
                                                <div class="input-group" style="width:180px;">
                                                    <input type="text" class="kh16-b canenter" id="leftamt" name="leftamt" value="" style="text-align:right;width:120px;height:30px;" readonly>
                                                    <input type="text" class="input-group-text kh16-b" id="txtcur_open2" value="" style="width:60px;height:30px;" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="kh16-b">
                                            <td style="width:170px;"> ថ្ងៃបើកវេរ</td>
                                            <td colspan=2><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកមកបើក</td>
                                            <td colspan=2>ឈ្មោះអតិថិជន</td>
                                            <td colspan=7>កំណត់សំគាល់</td>

                                        </tr>
                                        <tr>
                                            <td style="width:170px;">
                                                <div class="input-group" style="width:170px;">
                                                    <input type="text" name="opdate" id="opdate" class="form-control kh16-b" value="" style="background-color:white;width:120px;" readonly>
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16-b canenter" id="rec_tel" name="rec_tel" value="" style="">
                                            </td>

                                            <td colspan=2>
                                                <input type="text" class="form-control kh16-b canenter" id="rec_name" name="rec_name" value="" style="">
                                            </td>
                                            <td colspan=7>
                                                <textarea name="txtnote" id="txtnote" style="width:100%;height:40px;" rows="1"></textarea>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divphoto" class="row" style="border:1px dotted black;padding:10px 0px;">
                        <div class="col-lg-3">
                            <div class="contentarea">

                                <div class="camera">
                                    <video id="video">Video stream not available.</video>
                                </div>
                                <div><button id="startbutton" data-dismiss="modal">Take photo</button></div>
                                {{-- <canvas id="canvas"></canvas>
                                <div class="output">
                                    <img id="photo" alt="The screen capture will appear in this box.">
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group form-group-login">
                                <table style="margin:0 auto;">
                                    <tbody>
                                    <tr>
                                        <td colspan=3 class="photo">
                                        <canvas id="canvas"></canvas>
                                        <img src="{{ config('helper.asset_path')}}/logo/NoPicture.jpg" alt="" class="student-photo" id="showPhoto">
                                        <input type="file" name="image2" id="image2" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp" style="display:none;">
                                        <input type="hidden" name="photopath" id="photopath" value="">
                                        <input type="hidden" name="clickcapture2" id="clickcapture2" value="0">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <button type="button" name="browse_file2" id="browse_file2" class="btn btn-info " value="Browse" style="width:100%;">Browse</button>
                                        </td>
                                        <td>
                                        <button type="button" name="btnaddimgtolist" id="btnaddimgtolist" class="btn btn-primary " value="Capture" style="width:100%;">ADDLIST</button>
                                        {{-- <button type="button" name="btnsavemultiimage" id="btnsavemultiimage" class="btn btn-primary " value="Capture" style="width:100%;">SaveImage</button> --}}

                                    </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table id="tbl_image">
                                    <thead id="thead_img">

                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                  <div class="row" style="margin-bottom:10px;">

                    <div class="col-lg-6">
                      <select name="selbank" id="selbank" class="form-select kh16-b" style="display:none;">
                        <option value="">Select Bank</option>
                        @foreach ($userpartners as $b)
                            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" agenttype="{{ $b->agent_type_id }}" agenttypename="{{ $b->agenttype->name }}" transfer_amount="{{ $b->agenttype->transfer_amount }}" customer_fee="{{ $b->agenttype->customer_fee }}" cashdraw_fee="{{ $b->agenttype->cashdraw_fee }}" transfer_fee="{{ $b->agenttype->transfer_fee }}" userconnect="{{ $b->user_connect }}">{{ $b->name }}</option>
                        @endforeach
                      </select>
                      <div id="divcontinue" style="display:none;margin-top:10px;margin-bottom:20px;">
                          <div class="card" id="continuecard" style="padding:0px;">
                              <div class="card-header" style="text-align:center;height:40px;">
                                  <h1 class="kh16-b" style="display:inline;">បន្តដៃគូ</h1>
                                  <span style="float:right;font-size:16px;"><button id="btnclosedivcontinue" style="margin-top:-5px;" class="btn btn-danger btn-sm">X</button></span>

                              </div>
                              <div class="card-body" style="">
                                  <div class="row mb-3">
                                      <div class="table-responsive">
                                          <table id="tbl_continue_partner" class="table kh16-b" style="margin:0px;padding:0px;">
                                            <tr>

                                                <td colspan=3 style="text-align:right;">
                                                    {{-- <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radall" value="all" >
                                                    <label class="form-check-label kh16-b" for="radall">ទាំងអស់</label> --}}
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radpartner" value="PARTNER" checked>
                                                    <label class="form-check-label kh16-b" for="radpartner">ដៃគូ</label>
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radbank" value="BANK">
                                                    <label class="form-check-label kh16-b" for="radbank">ធនាគា</label>
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radcustomer" value="CUSTOMER">
                                                    <label class="form-check-label kh16-b" for="radcustomer">អតិថិជន</label>
                                                    <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radnolist" value="NOLIST">
                                                    <label class="form-check-label kh16-b" for="radnolist">ជំនួយ</label>
                                                </td>

                                            </tr>

                                            <tr style="padding:0px;margin:0px;">
                                                <td><label for="date" class="kh16-b" style="width:150px;">ជ្រើសរើសដៃគូ</label></td>
                                                <td colspan=2 style="height:40px;">
                                                    <select class="select2-option kh16-b" name="selpartner_continue" id="selpartner_continue" style="width:100%">
                                                        <option value=""></option>
                                                        @foreach ($partners->where('customertype','PARTNER') as $p)
                                                            <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="rowbalance1" style="background-color:whitesmoke;border:1px solid gray">
                                                <td class="kh16-b" style="padding:5px;">សមតុល្យ</td>
                                                <td style="padding:0px;" colspan=2>
                                                    <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:red;width:49%;display:inline;" readonly>
                                                    <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:blue;width:50%;display:inline;" readonly>
                                                </td>
                                            </tr>
                                            <tr id="row_son">
                                                <td><label for="son" class="kh16-b" style="width:150px;">បន្តទៅកូនសាខា</label></td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" id="son" name="son" class="form-control kh16-b" style="display:inline;height:30px;">
                                                        <span class="input-group-text" style="padding:0px;"><button id="btnbrowseson" style="width:30px;display:inline;" class="btn btn-sm">...</button></span>
                                                    </div>

                                                </td>

                                                {{-- <td style="width:60px;text-align:right;">
                                                    <button id="btnbrowseson" class="btn btn-info btn-lg">...</button>
                                                </td> --}}

                                            </tr>

                                            <tr>
                                                <td><label for="rectel" class="kh16-b" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកទទួល</label></td>
                                                <td colspan=2>

                                                    <input type="text" class="form-control kh16-b canenter" style="height:30px;" id="rectel_continue" name="rectel_continue">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="recname" class="kh16-b" style="width:150px;">ឈ្មោះអ្នកទទួល</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16-b canenter" style="height:30px;" id="recname_continue" name="recname_continue">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sendertel" class="kh16-b" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកផ្ញើ</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16-b canenter" style="height:30px;" id="sendertel_continue" name="sendertel_continue">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sendername" class="kh16-b" style="width:150px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh16-b canenter" style="height:30px;" id="sendername_continue" name="sendername_continue">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ចំនួនទឹកប្រាក់វេរ</td>
                                                <td colspan=2>
                                                    <div class="input-group">

                                                        <input type="text" class="form-control kh16-b canenter" id="amount_continue" name="amount_continue" style="text-align:right;height:30px;" autocomplete="off">
                                                        <select name="selcur_continue" id="selcur_continue" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select name="selcurthai" id="selcurthai" class="kh16-b" style="width:80px;display:none;">
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}" @if($c->shortcut<>'THB') disabled @endif>{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr id="row_cuscharge">
                                                <td>សេវ៉ាវេរ
                                                    <span>
                                                        <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value="" >
                                                        <label for="ckwater" class="form-check-label kh16-b">ដកទឹក</label>
                                                    </span>
                                                </td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b canenter" id="cuscharge_continue" name="cuscharge_continue" style="text-align:right;height:30px;" value="0">
                                                        <select name="txtcur2" id="txtcur2" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr id="row_totalcash">
                                                <td>សរុបទឹកប្រាក់</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="text-align:right;height:30px;">
                                                        <input type="text" class="input-group kh16-b" id="txtcur" style="width:80px;">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>សេវ៉ាដៃគូ</td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" class="kh16-b canenter" id="feeps" name="feeps" style="text-align:right;height:30px;width:100px;" value="0">
                                                        <input type="text" class="input-group kh16-b" value="%" style="width:30px;border:1px solid black;text-align:center;">
                                                        <input type="text" class="form-control kh16-b canenter" id="fee_continue" name="fee_continue" style="text-align:right;height:30px;" value="0">

                                                        <select name="txtcur1" id="txtcur1" class="input-group kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                          </table>
                                      </div>
                                  </div>

                              </div>

                          </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="divexchangecard" style="display:none;margin-top:10px;">
                          <div class="card">
                              <div class="card-header" style="text-align:center;height:40px;">
                                  <h1 class="kh16-b" style="display:inline">Exchange</h1>
                                  <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivexchangecard" class="btn btn-danger btn-sm">X</button></span>

                              </div>
                              <div class="card-body">
                                  <div class="row mb-3">
                                      <div class="table-responsive">

                                              <table id="tbl_exchange" class="table kh22" style="margin:0px;">
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

                          </div>
                      </div>
                      <div id="divexchangefix" style="display:none;margin-top:10px;">
                        <div class="card" style="">
                            <div class="card-header" style="text-align:center;height:40px;">
                                <h1 class="kh16-b" style="display:inline">ប្តូប្រាក់២</h1>
                                <span style="float:right;font-size:16px;"><button id="btnclosedivexchangefix" class="btn btn-danger btn-sm">X</button></span>
                            </div>
                            <div class="card-body" style="padding-bottom:0px;padding:10px;">
                                <div class="row" style="">
                                  <div class="table-responsive">

                                        <table id="tbl_exchange2" class="" style="margin:0px;padding:0px;">
                                            <thead class="kh16-b" style="text-align:center;">
                                              <th>លរ</th>
                                              <th colspan=3>លក់ចេញ</th>
                                              <th>អត្រា</th>
                                              <th colspan=3>ទិញចូល</th>
                                              <th>Rate</th>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">1</td>
                                                <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                              </tr>

                                              <tr>
                                                <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">2</td>
                                                <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                              </tr>
                                              <tr>
                                                <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">3</td>
                                                <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                              </tr>

                                              <tr><td colspan=8></td></tr>
                                              <tr><td colspan=8></td></tr>
                                              <tr><td colspan=8></td></tr>

                                              <tr style="background-color:blueviolet;margin-top:20px;">
                                                <td style="display:none;"><input type="text" id="txtmainamt"  class="form-control txtexchangefix" style="color:blue;" readonly></td>
                                                <td colspan=5 class="kh16-b" style="text-align:right;color:white;">លុយវេរនៅសល់</td>
                                                <td colspan=2><input type="text" id="txtleftamt"  class="form-control txtexchangefix" style="color:white;background-color:blueviolet;text-align:right;" readonly></td>
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
                      <div id="divexchangelist" style="display:none;margin-top:10px;">
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
                                                  {{-- @foreach ($mex as $key => $m)
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
                                                  @endforeach --}}
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
                                                  <tbody id="t_cashin">

                                                      {{-- @foreach ($cashin as $ci)
                                                          <tr>
                                                              <td style="font-size:22px;color:blue;text-align:right;">{{ phpformatnumber($ci['value']) }} &nbsp; {{ $ci['cur'] }}</td>
                                                          </tr>
                                                      @endforeach --}}
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
                                                  <tbody id="t_cashout">

                                                      {{-- @foreach ($cashout as $co)
                                                          <tr>
                                                              <td style="font-size:22px;color:red;text-align:right;">{{ phpformatnumber($co['value']) }} &nbsp; {{ $co['cur'] }}</td>
                                                          </tr>
                                                      @endforeach --}}
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:10px;">
                    <div id="divbankpayment" style="display:none;margin-top:10px;margin-bottom:20px;">
                        <div class="card">
                            <div class="card-header" style="height:40px;">
                                <div class="row" style="margin-top:-5px;">
                                    <div class="col-lg-6">
                                        <p class="kh22-b">Bank Payment</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="float:right;font-size:16px;margin-left:20px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-sm btn-md">X</button></span>
                                        <button id="btnaddrow" class="btn btn-info btn-sm" style="float:right;">add row</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding-bottom:0px;">
                                <div class="table-responsive">
                                    <table id="tbl_bankpayment" class="table table-bordered">
                                        <thead style="text-align:center;color:black;" class="kh14-b">
                                            <th style="display:none;">No</th>

                                            <th style="display:none;">Bank Name</th>
                                            <th style="display:none;" class="" style="">ប្រភេទ</th>
                                            <th style="display:none;" class="" style="">មុខងារ</th>
                                            <th style="display:none" class="">foruserid</th>

                                            <th style="width:120px;" class="">ចំនួនទឹកប្រាក់</th>
                                            <th style="width:100px;" class="">រូបិយ</th>

                                            <th style="width:180px;" class="">លេខអ្នកទទួល</th>
                                            <th style="width:50px;" class=""></th>

                                            <th style="width:180px;" class="">ឈ្មោះអ្នកទទួល</th>
                                            <th style="width:100px;" class="">កាត់ជាលុយ</th>
                                            <th style="width:80px;" class="">អត្រា</th>
                                            <th style="width:150px;" class="">ស្មើចំនួន</th>
                                            <th style="width:80px;" class="">រូបិយលក់</th>
                                            <th style="display:none;" class="">រូបិយទិញ</th>
                                            <th style="display:none;" class="">buyinfo</th>
                                            <th style="display:none;" class="">saleinfo</th>
                                            <th style="display:none;" class="">rateinfo</th>
                                            <th class="">ជ្រើសរើសឈ្មោះដៃគូ</th>
                                            <th style="width:150px;">Action</th>
                                            <th class="" style="display:none;">Code</th>
                                            <th class="">WingCodeInfo</th>
                                            <th style="display:none;" class="">ធ្វើកូតដោយ</th>
                                            <th style="width:80px;" class="">សេវ៉ាដៃគូ</th>
                                        </thead>
                                        <tbody id="body_bankpayment">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div id="divfooter" style="display:none;">
                    <div class="row" style="margin-right:20px;">
                        <div class="col-lg-6">
                            <div style="">

                                <button id="btncontinue" class="btn btn-primary kh16-b" >បន្តទៅ</button>
                                <button id="btnexchange" class="btn btn-primary kh16-b" title="CTRL+1">ប្តូរប្រាក់១</button>
                                <button id="btnexchange2" class="btn btn-primary kh16-b" title="CTRL+2">ប្តូរប្រាក់២</button>
                                <button id="btnbankpayment" class="btn btn-primary kh16-b" title="CTRL+3">អតិថិជនយកតាម</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div style="float:right;">
                                {{-- <button id="btnsavestep2" class="btn btn-info kh16-b" style="width:150px;display:none;">បន្តទៅផ្នែកទី២</button> --}}
                                {{-- <button id="btnsavestep3" class="btn btn-info kh16-b" style="width:150px;display:none;">បន្តទៅផ្នែកទី៣</button> --}}

                                <button id="btnsave" class="btn btn-info kh16-b" style="width:150px;">រក្សាទុក</button>
                                <button id="btnsaveprintcash" class="btn btn-primary kh16-b" style="">រក្សាទុក+ព្រីន</button>
                                <button id="btnsaveprint" class="btn btn-primary kh16-b" style="">រក្សាទុក+រួចរាល់</button>
                                {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}

                            </div>
                        </div>
                    </div>

                </div>

                </form>



            </div>

        </div>
    </div>
</div>
