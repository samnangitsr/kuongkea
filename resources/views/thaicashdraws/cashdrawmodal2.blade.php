<div class="modal fade" id="cashdrawmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="height:50px;">
                <p id="modalheader" class="modal-title kh22-b">ការងារធ្វើលេខកូត</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmcashdraw" action="">
                  <input type="hidden" id="transfer_id" name="transfer_id" value="">
                  <input type="hidden" id="groupid" name="groupid" value="">

                  <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                  <input id="usercheckid" type="hidden" value="{{ Auth::id() }}">
                  <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0' title="hasbankpayment">
                  <input type="hidden" id="trancode1" name="trancode1" value='-1'>
                    <div class="row">
                        <select name="selbank" id="selbank" class="form-select kh22" style="display:none;">
                            <option value="">Select Bank</option>
                            @foreach ($partners as $b)
                                <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" agenttype="{{ $b->agent_type }}" maxtransfer="{{ $b->max_transfer }}" maxfee="{{ $b->max_fee }}" userconnect="{{ $b->user_connect }}">{{ $b->name }}</option>
                            @endforeach
                          </select>
                          <select name="selcur_continue" id="selcur_continue" class="form-select kh22" style="width:150px;display:none;">
                            <option value=""></option>
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                        <select name="selcurthai" id="selcurthai" class="form-select kh22" style="width:150px;display:none;">
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}" @if($c->shortcut<>'THB') disabled @endif>{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="row">
                    <div id="divbankpayment" style="margin-top:0px;">
                        <div class="card">
                            <div class="card-header" style="height:50px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>Bank Payment</h3>
                                    </div>
                                    <div class="col-lg-6">
                                        {{-- <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivbankpayment" class="btn btn-danger btn-md">X</button></span> --}}
                                        {{-- <button id="btnresetexchange" class="btn btn-info btn-md" style="float:right;">Reset Exchange</button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding-bottom:0px;">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="tbl_bankpayment" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th style="display:none;">No</th>
                                                <th style="display:none;">TID</th>
                                                <th class="kh16" style="width:250px;">ជ្រើសរើសធនាគា</th>
                                                <th class="kh16" style="display:none;">ដៃគូ</th>
                                                <th class="kh16" style="width:250px;display:none;">ប្រភេទអតិថិជន</th>
                                                <th class="kh16" style="width:250px;display:none;">ប្រភេទភ្នាក់ងារ</th>
                                                <th class="kh16" style="display:none;">ForUserID</th>
                                                <th class="kh16" style="width:150px;">ចំនួនទឹកប្រាក់</th>
                                                <th class="kh16" style="width:100px;">រូបិយ</th>
                                                <th class="kh16" style="width:180px;">លេខអ្នកទទួល</th>
                                                <th class="kh16" style="width:180px;">ឈ្មោះអ្នកទទួល</th>
                                                <th class="kh16" style="width:100px;">កាត់ជាលុយ</th>
                                                <th class="kh16" style="width:80px;">អត្រា</th>
                                                <th class="kh16" style="width:180px;">ស្មើចំនួន</th>
                                                <th class="kh16" style="width:80px;">រូបិយ</th>
                                                <th class="kh16" style="display:none">រូបិយទិញ</th>
                                                <th class="kh16" style="display:none">buyinfo</th>
                                                <th class="kh16" style="display:none">saleinfo</th>
                                                <th class="kh16" style="display:none">rateinfo</th>
                                                <th class="kh16" style="display:none;">WingCodeInfo</th>
                                                <th style="width:150px;">Action</th>
                                                <th class="kh16">WingCodeInfo</th>
                                                <th class="kh16" style="display:none;">ធ្វើកូតដោយ</th>
                                                <th class="kh16" style="width:100px;">សេវ៉ាដៃគូ</th>
                                            </thead>
                                            <tbody id="body_bankpayment">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="display:none;">
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table id="tbl_exchangedata" class="table table-bordered">
                                                <thead style="text-align:center;">
                                                    <th style="display:none;">No</th>
                                                    <th>ID</th>
                                                    <th class="kh16">ថ្ងៃទី</th>
                                                    <th class="kh16">ម៉ោង</th>
                                                    <th class="kh16">លុយប្តូរ</th>
                                                    <th class="kh16">ប្តូរបាន</th>
                                                    <th class="kh16">អត្រា</th>
                                                </thead>
                                                <tbody id="body_exchangedata">

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

                                <button id="btnsave" class="btn btn-info kh16-b" style="width:150px;">រួចរាល់</button>
                                <button id="btnupdate" class="btn btn-warning kh16-b" style="width:150px;">រក្សាទុក</button>
                                <button id="btnsavestep2" class="btn btn-warning kh16-b" style="width:150px;">ត្រលប់ផ្នែកទី២</button>

                            </div>
                        </div>
                    </div>

                </div>

                </form>



            </div>

        </div>
    </div>
</div>
