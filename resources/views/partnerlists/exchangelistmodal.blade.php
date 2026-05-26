<div class="modal fade" id="exchangelistmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
          <div class="modal-header">
              <p id="modalheader" class="modal-title kh30-b">កាត់កងបញ្ជី</p>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row" style="margin-top:-20px;">
              <div class="table-responsive">
                  <table class="table">
                      <tr class="kh22">
                          <th style="border-style:none;">ថ្ងៃកាត់កង</th>
                          <th style="border-style:none;">ប្រភេទអតិថិជន</th>
                          <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                          <th style="border-style:none;"></th>

                          <th style="border-style:none;">អត្រាគោល</th>
                          <th style="border-style:none;">អត្រាព្រមព្រាង</th>

                      </tr>
                      <tr>

                          <td style="padding:0px;border-style:none;width:250px;">
                              <div class="input-group" style="width:250px;">
                                  <input type="text" name="exchangedate" id="exchangedate" class="form-control" style="width:170px;background-color:silver;font-size:22px;">
                                  <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                              </div>

                          </td>
                          <td style="padding:0px;border-style:none;width:310px;">
                              <select name="seltype" id="seltype" class="form-select kh22">
                                  <option value="all">ទាំងអស់</option>
                                  <option value="BANK">BANK</option>
                                  @if(Auth::user()->role->name=='Admin')
                                    <option value="CUSTOMER">CUSTOMER</option>
                                  @endif
                                  <option value="PARTNER">PARTNER</option>
                                  <option value="AGENT">AGENT</option>

                              </select>
                          </td>
                          <td style="padding:0px;border-style:none;width:310px;">
                              <select name="selcustomer" id="selcustomer" style="width:300px;margin-top:-60px;" class="form-select kh22" required>
                                  <option value=""></option>
                                  @foreach ($partners as $p)
                                      <option value="{{ $p->id }}">{{ $p->name }}</option>
                                  @endforeach
                                  @if(Auth::user()->role->name=='Admin')
                                      @foreach ($customers as $c)
                                          <option value="{{ $c->id }}">{{ $c->name }}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </td>
                          <td style="padding:0px;border-style:none;">
                              <button class="btn btn-primary btn-md kh22" id="btnsearch">សរុបបញ្ជី</button>
                              <a href="{{ route('exchangelist.delkatkong') }}" class="btn btn-info kh22" target="_blank">លុបកាត់កង</a>
                          </td>
                          <td style="padding:0px;border-style:none;width:150px;">
                              <input type="text" class="form-control kh22" id="txtrate1" style="width:150px;" readonly>
                              <input type="hidden" id="txtsign" value="+">
                          </td>
                          <td style="padding:0px;border-style:none;width:150px;">
                              <input type="text" class="form-control kh22" id="txtrate" style="width:150px;">
                          </td>
                      </tr>
                      <tr>
                          <td style="border-style:none;padding-top:20px;width:200px;">
                              <div class="form-check" style="margin-left:20px;">
                                  <input type="radio" class="form-check-input kh22" id="radio1" name="optkatkong" value="-1" checked>
                                  <label class="form-check-label kh22" for="radio1" style="color:red;">លក់ចេញ</label>
                             </div>
                          </td>
                          <td style="border-style:none;padding-top:20px;width:150px;">
                              <div class="form-check">
                                  <input type="radio" class="form-check-input kh22" id="radio2" name="optkatkong" value="1">
                                  <label class="form-check-label kh22" for="radio2" style="color:blue">ទិញចូល</label>
                                </div>
                          </td>
                          <td style="border-style:none;padding-top:20px;width:150px;">
                              <input type="text" class="form-control kh22-b" id="buysaleid" readonly>

                          </td>
                          <td colspan=3 style="border-style:none;padding-top:20px;width:150px;">

                            <input type="text" class="form-control kh22-b" id="txtdesr" readonly>
                        </td>
                      </tr>
                  </table>
              </div>
          </div>

          <div id="total_list" class="row" style="margin-top:20px;">


          </div>

          <div class="row">
              <div class="col-lg-6">
                  <table class="table table-bordered" style="background-color:azure">
                      <tr style="background-color:rgb(164, 232, 240)">
                          <td class="kh22-b" style="text-align:center;" colspan=3>{{ 'លុយ '.$logo->name }}</td>
                      </tr>

                      <tr>
                          <td colspan=2 style="padding:0px;">
                              <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txtwecash" value="0">
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="txtwecur" value="">
                          </td>
                      </tr>
                      <tr>
                          <td style="width:120px;padding:0px;">
                              <input type="text" style="text-align:center;width:120px;background-color:azure" class="form-control kh22-b" id="txtsignwe" name="txtsignwe" value="លក់ចេញ" readonly>
                          </td>
                          <td style="padding:0px;">
                              <input type="text" style="text-align:right;width:100%;background-color:azure" class="form-control kh22-b" id="txtsale" name="txtsale" value="" placeholder="កាត់ចំនួន" autocomplete="off" readonly>
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="lblsale" value="" readonly>
                          </td>
                      </tr>
                      <tr>
                          <td colspan=2 style="padding:0px;">
                              <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txtwebal" value="">
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="txtwecur1" value="">
                          </td>
                      </tr>

                  </table>
              </div>
              <div class="col-lg-6">
                  <table class="table table-bordered" style="background-color:azure">
                      <tr style="background-color:rgb(164, 232, 240)">
                          <td class="kh22-b" style="text-align:center;" colspan=3><span id="r_right1">{{ 'លុយគេ' }}</span></td>
                      </tr>

                      <tr>
                          <td colspan=2 style="padding:0px;">
                              <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txttheircash" value="0">
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="txttheircur" value="">
                          </td>
                      </tr>
                      <tr>
                          <td style="width:120px;padding:0px;">
                              <input type="text" style="text-align:center;width:120px;background-color:azure" class="form-control kh22-b" id="txtsignthey" name="txtsignthey" value="ទិញចូល" readonly>
                          </td>
                          <td style="padding:0px;">
                              <input type="text" style="text-align:right;width:100%;background-color:azure" class="form-control kh22-b" id="txtbuy" name="txtbuy" value="" placeholder="កាត់ចំនួន" autocomplete="off" readonly>
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="lblbuy" value="" readonly>
                          </td>
                      </tr>
                      <tr>
                          <td colspan=2 style="padding:0px;">
                              <input type="button" style="text-align:right;width:100%" class="btn kh22-b" id="txttheirbal" value="">
                          </td>
                          <td style="padding:0px;width:100px;">
                              <input style="width:100px;" type="button" class="btn kh22-b" id="txttheircur1" value="">
                          </td>
                      </tr>

                  </table>
              </div>
          </div>

         <div class="row">
              <button id="btnsavelist" class="btn btn-warning kh22">រក្សាទុកកាត់កង</button>
         </div>



          </div>

      </div>
  </div>
</div>
