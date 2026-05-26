<style>
    td{
        border-style:none;
    }
</style>

<div class="modal fade" id="userstartcapitalmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:silver;padding:5px 20px;">
                <h5 id="modalheader" class="modal-title kh22-b" >
                    <span id="mtitle">ដាក់ដើមទុនបុគ្គលិក</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-bottom:0px;">
                <form action="" id="frmusercapital">
                    <input type="hidden" id="trmode" name="trmode">
                    <input type="hidden" id="tranname" name="tranname">
                    <input type="hidden" id="trid" name="trid">
                    <div class="container">
                        <div class="row" style="">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table kh16-b" id="tbl_addusercapital" style="">
                                         <tr>
                                            <td>ក្រុមហ៊ុន</td>
                                            <td colspan=2 style="padding:0px;border-style:none;">
                                                <select name="selcompany1" id="selcompany1" class="form-select kh16-b" style="width:100%;">
                                                    {{-- <option value="all">All Company</option> --}}
                                                    @foreach ($companies as $comp)
                                                        <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}} @if(Auth::user()->role->name!='Admin') disabled @endif>{{ $comp->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ថ្ងៃទី</td>
                                            <td colspan=2>
                                                <div class="input-group" style="">
                                                    <input type="text" name="trandate" id="trandate" class="form-control kh16-b" style="background-color:rgb(239, 229, 229);" readonly>
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span id="tdreceiver">អ្នកទទួលប្រាក់</span>
                                            </td>
                                            <td colspan=2>
                                                <select class="form-select kh16-b" name="seluserreceive" id="seluserreceive" style="width:100%;background-color:yellow;">
                                                    {{-- <option value="">please select user name</option> --}}
                                                    {{-- @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" @if(Auth::id()==$u->id) selected @endif>{{ $u->name }}</option>
                                                    @endforeach --}}

                                                    <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                                    @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td>ប្រភេទ</td>
                                          <td colspan=2>
                                            <select class="form-select kh16-b" name="cashtype" id="cashtype">
                                              <option value="cash">លុយក្រៅ</option>
                                              <option value="agent">លុយក្នុងកុង</option>
                                            </select>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>លេខគណនេយ្យ</td>
                                          <td colspan=2>
                                            <select class="form-select kh16-b" name="useraccount" id="useraccount">

                                            </select>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>ប្រាក់ដុល្លា</td>
                                          <td>
                                              <input type="text" class="form-control kh16-b canenter" name="usd_amount" id="usd_amount" style="text-align:right;">
                                          </td>
                                          <td>
                                              <select class="form-select kh16-b" name="selcurusd" id="selcurusd" style="" disabled=true>
                                                  <option value=""></option>
                                                  @foreach ($currencies as $cur)
                                                      <option value="{{ $cur->id }}" @if($cur->shortcut=='USD') selected @endif>{{ $cur->shortcut }}</option>
                                                  @endforeach
                                              </select>
                                          </td>
                                      </tr>
                                      <tr>
                                        <td>ប្រាក់រៀល</td>
                                        <td>
                                            <input type="text" class="form-control kh16-b canenter" name="khr_amount" id="khr_amount" style="text-align:right;">
                                        </td>
                                        <td>
                                            <select class="form-select kh16-b" name="selcurkhr" id="selcurkhr" style="" disabled=true>
                                                <option value=""></option>
                                                @foreach ($currencies as $cur)
                                                    <option value="{{ $cur->id }}" @if($cur->shortcut=='KHR') selected @endif>{{ $cur->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td>ប្រាក់បាត</td>
                                      <td>
                                          <input type="text" class="form-control kh16-b canenter" name="thb_amount" id="thb_amount" style="text-align:right;">
                                      </td>
                                      <td>
                                          <select class="form-select kh16-b" name="selcurthb" id="selcurthb" style="" disabled=true>
                                              <option value=""></option>
                                              @foreach ($currencies as $cur)
                                                  <option value="{{ $cur->id }}" @if($cur->shortcut=='THB') selected @endif>{{ $cur->shortcut }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  </tr>
                                        <tr>
                                            <td>ចំនួនទឹកប្រាក់</td>
                                            <td>
                                                <input type="text" class="form-control kh16-b canenter" name="amount" id="amount" style="text-align:right;">
                                            </td>
                                            <td>
                                                <select class="form-select kh16-b" name="selcur" id="selcur" style="">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}" isgold="{{$cur->isgold}}" tuochek="{{$cur->tuochek}}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                         <tr id="row_water" style="display:none;">
                                            <td>ទឹកមាស</td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16-b canenter" name="goldwater" id="goldwater" style="background-color:gold;">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>បរិយាយ</td>
                                            <td colspan=2>
                                                <textarea class="form-control kh16-b" rows="2" id="note" name="note"></textarea>
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-info kh12-b" id="btnsavecapital">Save</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger kh12-b" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
