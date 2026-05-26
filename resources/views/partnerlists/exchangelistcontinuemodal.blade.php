<div class="modal fade" id="exchangelistcontinuemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="modalheader" class="modal-title kh22-b">ទទួលបន្តកាត់កង</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form id="frmtransfer" action="">
              <div class="row">
                  <div class="col-lg-6">
                      <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                      <div class="card">
                          <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;">
                              <h1 id="partner_title" class="kh22-b">ដៃគូទទួល</h1>
                          </div>
                          <div class="card-body">
                              <div class="row mb-3">
                                  <div class="table-responsive">
                                      <table id="tbl_partner" class="table">
                                        <input type="hidden" id="main_exchange_id" name="main_exchange_id">
                                          <tr>
                                              <td>
                                                  <label for="date" class="kh22" style="width:120px;">កាលបរិច្ឆេទ</label>
                                              </td>
                                              <td>
                                                  <input type="text" name="invdate" id="invdate" class="form-control" style="background-color:white;font-size:22px;" readonly>
                                              </td>
                                              <td style="width:60px;">
                                                  <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td><label for="date" class="kh22" style="width:120px;">ជ្រើសរើសដៃគូ</label></td>
                                          </tr>
                                          <tr>
                                            <td colspan=3>
                                              <select class="form-select kh22" name="selpartner" id="selpartner" style="width:100%">
                                                  <option value=""></option>
                                                  @foreach ($partners as $p)
                                                      <option value="{{ $p->id }}" customertype="{{ $p->customertype }}">{{ $p->name }}</option>
                                                  @endforeach
                                              </select>
                                          </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <i class="fa fa-volume-control-phone fa-2x"></i>
                                                  <label for="rectel" class="kh22" style="width:120px;">លេខអ្នកទទួល</label>
                                              </td>

                                          </tr>
                                          <tr>
                                            <td colspan=3>
                                              <input type="text" class="form-control kh22 canenter" id="rectel" name="rectel">
                                          </td>
                                          </tr>
                                          <tr>
                                              <td><label for="recname" class="kh22" style="width:120px;">ឈ្មោះអ្នកទទួល</label></td>

                                          </tr>
                                          <tr>
                                            <td colspan=3>
                                              <input type="text" class="form-control kh22 canenter" id="recname" name="recname">
                                          </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <i class="fa fa-volume-control-phone fa-2x"></i>
                                                  <label for="sendertel" class="kh22" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                              </td>

                                          </tr>
                                          <tr>
                                            <td colspan=3>
                                              <input type="text" class="form-control kh22 canenter" id="sendertel" name="sendertel">
                                          </td>
                                          </tr>
                                          <tr>
                                              <td><label for="sendername" class="kh22" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label></td>

                                          </tr>
                                          <tr>
                                            <td colspan=3>
                                              <input type="text" class="form-control kh22 canenter" id="sendername" name="sendername">
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
                              <h1 id="transfer_title" class="kh22-b" style="text-align:center;">ចំនួនទឹកប្រាក់</h1>
                          </div>
                          <div class="card-body" id="tblexchangemultiple">
                              <div class="table-responsive">
                                  <table id="tbl_amount" class="table kh22">
                                      <tr>
                                          <td>ចំនួនទឹកប្រាក់វេរ</td>
                                      </tr>
                                      <tr>
                                        <td colspan=2>
                                          <input type="text" class="form-control kh22 canenter" id="amount" name="amount" style="width:100%;text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:150px;">
                                          <select name="selcur0" id="selcur0" class="form-select kh22" style="width:150px;">
                                              <option value=""></option>
                                              @foreach ($currencies as $c)
                                                  <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                      </tr>
                                      <tr>
                                          <td>សេវ៉ាដៃគូទទួល</td>
                                      </tr>
                                      <tr>
                                        <td colspan=2>
                                            <input type="text" class="form-control kh22 canenter" id="fee" name="fee" style="width:100%;text-align:right;" value="0">
                                        </td>
                                        <td style="width:150px;">
                                            {{-- <input type="text" class="form-control kh22" id="txtcur1" style="width:150px;"> --}}
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
                      <div id="divcontinue" style="">
                          <div class="card" id="continuecard" >
                              <div class="card-header" style="text-align:center;">
                                  <h1 class="kh22-b" style="display:inline">ដៃគូបន្ត</h1>
                              </div>
                              <div class="card-body">
                                  <div class="row mb-3">
                                      <div class="table-responsive">
                                          <table id="tbl_continue_partner" class="table">
                                              <input type="hidden" id="main_exchange_id2" name="main_exchange_id2">
                                              <tr>
                                                  <td><label for="date" class="kh22" style="width:120px;">ជ្រើសរើសដៃគូ</label></td>

                                              </tr>
                                              <tr>
                                                <td colspan=3>
                                                  <select class="form-select kh22" name="selpartner2" id="selpartner2" style="width:100%">
                                                      <option value="">សូមជ្រើសរើសដៃគូ</option>
                                                      @foreach ($partners as $p)
                                                          <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                      @endforeach
                                                  </select>
                                              </td>
                                              </tr>
                                              <tr>
                                                  <td colspan=3 class="kh22">សេវ៉ាដៃគូ</td>
                                              </tr>
                                              <tr>
                                                  <td colspan=2>
                                                      <input type="text" class="form-control kh22 canenter" id="fee2" name="fee2" style="width:100%;text-align:right;" value="0">
                                                  </td>
                                                  <td style="width:150px;">
                                                      {{-- <input type="text" class="form-control kh22" id="txtcur2" style="width:150px;"> --}}
                                                      <select name="txtcur2" id="txtcur2" class="form-select kh22" style="width:150px;">
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
                          </div>
                      </div>
                      <div class="row" style="margin:0px 5px 0px 5px;">
                        <button id="btnsaveinout" class="btn btn-info">Save</button>
                      </div>
                  </div>
              </div>
            </form>
          </div>

      </div>
  </div>
</div>
