<div class="modal fade" id="cashdrawmodal0" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="height:50px;">
                <p id="modalheader0" class="modal-title kh22-b">កែប្រែទិន្ន័យលុយថៃ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmcashdraw0" action="">
                  <input type="hidden" id="transfer_id0" name="transfer_id0" value="">
                  <input type="hidden" id="groupid0" name="groupid0" value="">

                  <input id="txtrole0" type="hidden" value="{{ Auth::user()->role->name }}">
                  <input id="usercheckid0" type="hidden" value="{{ Auth::id() }}">
                  <input type="hidden" id="hasbankpayment0" name="hasbankpayment0" value='0' title="hasbankpayment0">
                  <input type="hidden" id="trancode0" name="trancode0" value='-1'>
                    <div class="row">
                        <select name="selbank0" id="selbank0" class="form-select kh22" style="display:none;">
                            <option value="">Select Bank</option>
                            @foreach ($partners as $b)
                                <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" agenttype="{{ $b->agenttype->name }}" maxtransfer="{{ $b->max_transfer }}" maxfee="{{ $b->max_fee }}">{{ $b->name }}</option>
                            @endforeach
                          </select>
                          <select name="selcur_continue0" id="selcur_continue0" class="form-select kh22" style="width:150px;display:none;">
                            <option value=""></option>
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                        <select name="selcurthai0" id="selcurthai0" class="form-select kh22" style="width:150px;display:none;">
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}" @if($c->shortcut<>'THB') disabled @endif>{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="row">
                    <div id="divbankpayment0" style="margin-top:0px;padding:0px;">
                        <div class="card">
                            <div class="card-header" style="height:50px;">
                                <div class="row">

                                        <table class="">
                                            <tr>
                                                <td class="kh16-b" style="width:100px;text-align:right;padding-right:5px;">លុយត្រូវបើក</td>
                                                <td class="kh16-b" style="width:200px;padding:0px;">

                                                    <div class="input-group" style="width:200px;">
                                                        <input type="text" class="form-control kh16-b canenter" id="openamt0" name="openamt0" value="" style="text-align:right;width:140px;">
                                                        <input type="text" class="input-group-text kh16-b" id="txtcur_open0" value="THB" style="width:60px;" readonly>
                                                    </div>
                                                </td>
                                                <td class="kh16-b" style="text-align:right;width:100px;padding-right:5px;">បើកបាន</td>
                                                <td class="kh16-b" style="width:200px;padding:0px;">

                                                    <div class="input-group" style="width:200px;">
                                                        <input type="text" class="form-control kh16-b canenter" id="useamt0" name="useamt0" value="" style="text-align:right;width:140px;">
                                                        <input type="text" class="input-group-text kh16-b" id="txtcur_open10" value="THB" style="width:60px;" readonly>
                                                    </div>
                                                </td>
                                                <td class="kh16-b" style="text-align:right;width:100px;padding-right:5px;">លុយនៅសល់</td>
                                                <td style="width:200px;padding:0px;">
                                                    <div class="input-group" style="width:200px;">
                                                        <input type="text" class="form-control kh16-b canenter" id="leftamt0" name="leftamt0" value="" style="text-align:right;width:140px;">
                                                        <input type="text" class="input-group-text kh16-b" id="txtcur_open20" value="THB" style="width:60px;" readonly>
                                                    </div>

                                                </td>
                                                <td  style="text-align:right;padding:0px;">
                                                    <button id="btnaddrow0" class="btn btn-info btn-sm" style="float:right;">add row</button>
                                                </td>
                                                <td style="text-align:right;padding:0px;">
                                                    <button id="btnresetexchange0" class="btn btn-info btn-md" style="float:right;">Reset Exchange</button>
                                                </td>
                                            </tr>
                                        </table>
                                </div>
                            </div>
                            <div class="card-body" style="padding-bottom:0px;">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="tbl_bankpayment0" class="table table-bordered" style="margin:0px;">
                                            <thead style="text-align:center;">
                                                <th style="display:none;">No</th>
                                                <th style="display:none;">TID</th>
                                                <th class="kh16" style="width:200px;">ជ្រើសរើសធនាគា</th>
                                                <th class="kh16" style="display:none;">customer type</th>
                                                <th class="kh16" style="display:none;">agent type</th>
                                                <th class="kh16" style="display:none;">ForUserID</th>
                                                <th class="kh16" style="width:130px;">ចំនួនទឹកប្រាក់</th>
                                                <th class="kh16" style="width:100px;">រូបិយ</th>
                                                <th class="kh16" style="width:150px;">លេខអ្នកទទួល</th>
                                                <th class="kh16" style="width:150px;">ឈ្មោះអ្នកទទួល</th>
                                                <th class="kh16" style="width:100px;">កាត់ជាលុយ</th>
                                                <th class="kh16" style="width:100px;">អត្រា</th>
                                                <th class="kh16" style="width:130px;">ស្មើចំនួន</th>
                                                <th class="kh16" style="width:70px;">រូបិយ</th>
                                                <th class="kh16" style="width:100px;">ថ្លៃវេរ</th>
                                                <th class="kh16" style="width:130px;">សរុប</th>
                                                <th class="kh16" style="display:none">រូបិយទិញ</th>
                                                <th class="kh16" style="display:none">buyinfo</th>
                                                <th class="kh16" style="display:none">saleinfo</th>
                                                <th class="kh16" style="display:none">rateinfo</th>
                                                <th class="kh16" style="display:none;">WingCodeInfo</th>
                                                <th style="width:120px;">Action</th>
                                                <th class="kh16">WingCodeInfo</th>
                                                <th style="display:none;" class="kh16">ធ្វើកូតដោយ</th>
                                                <th class="kh16" style="width:80px;">សេវ៉ាដៃគូ</th>
                                            </thead>
                                            <tbody id="body_bankpayment0">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="display:none;">
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table id="tbl_exchangedata0" class="table table-bordered">
                                                <thead style="text-align:center;">
                                                    <th style="display:none;">No</th>
                                                    <th>ID</th>
                                                    <th class="kh16">ថ្ងៃទី</th>
                                                    <th class="kh16">ម៉ោង</th>
                                                    <th class="kh16">លុយប្តូរ</th>
                                                    <th class="kh16">ប្តូរបាន</th>
                                                    <th class="kh16">អត្រា</th>
                                                </thead>
                                                <tbody id="body_exchangedata0">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div id="divfooter" style="">
                    <div class="row" style="margin-right:20px;">
                        <div class="col-lg-8">

                        </div>
                        <div class="col-lg-4">
                            <div style="float:right;">

                                <button id="btnupdate" class="btn btn-warning kh16-b" style="width:150px;">កែប្រែ</button>



                            </div>
                        </div>
                    </div>

                </div>

                </form>



            </div>

        </div>
    </div>
</div>
