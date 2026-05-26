<div class="modal fade" id="dowingcodemodalnew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" style="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <p id="modalheader" class="modal-title kh22-b">ធ្វើលេខកូត</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding:0px;">
                <form id="frmopenedit" action="">
                    <input type="hidden" id="transferid3" name="transferid3">
                    <input type="hidden" id="groupid3" name="groupid3">
                    <input type="hidden" id="cashdrawcodeid3" name="cashdrawcodeid3">
                    <input type="hidden" id="rowind3">
                    <input type="hidden" id="thai_cut_seva" name="thai_cut_seva">
                    <input type="hidden" id="smsamt3">
                    <input type="hidden" id="sumtransferthai3">

                    <div class="row" style="margin:10px 0px;">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table tbldocodenew">
                                    <tr>
                                        <td style="" class="kh14">លុយថៃ</td>

                                        <td style="width:100%;">
                                            <input type="text" class="kh16-b" id="thaiamt3" name="thaiamt3" style="text-align:right;width:100%;" readonly>
                                        </td>
                                        <td style="width:60px;">
                                            <input type="text" class="kh16-b" id="thaicur3" style="display:inline;width:60px;" value="THB" readonly>
                                            <input type="hidden" id="thaicurid3" name="thaicurid3" style="width:60px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">កាត់ជាលុយ</td>

                                        <td colspan=2 style="">
                                            <table class="">
                                                <tr>
                                                    <td style="padding-right:20px;">
                                                        <select name="selcurwing3" id="selcurwing3"  class="kh16-b" style="width:100px;height:30px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td style="padding-right:10px;" class="kh14">អត្រា</td>

                                                    <td style="">
                                                        <input type="text" class="kh16-b" id="exchangerate3" name="exchangerate3" style="width:150px;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
                                                        <input type="hidden" class="kh16-b" id="exchangerateinfo3" name="exchangerateinfo3" style="width:100px;" readonly>

                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="" class="kh14">ស្មើចំនួន</td>

                                        <td style="width:100%;">
                                            <input type="text" class="kh16-b" id="exchangeamount3" name="exchangeamount3" style="text-align:right;width:100%;" readonly>
                                        </td>
                                        <td style="width:60px;">
                                            <input type="text" class="kh16-b" id="exchangecur3" style="display:inline;width:60px;" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="exchangesaleinfo3" name="exchangesaleinfo3" style="display:inline;width:60px;" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="mekun3" name="mekun3" style="display:inline;width:60px;" readonly>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">
                                            សេវ៉ាវេរ
                                            <div class="form-check" style="margin-top:0px;">
                                                <label class="form-check-label kh14-b" style="">
                                                    <input class="form-check-input" type="checkbox" name="ckdorktek3" id="ckdorktek3" style="">ដកទឹក
                                                </label>
                                            </div>
                                        </td>

                                        <td style="width:100%;">
                                            <input type="text" class="kh16-b tdcanenter" id="cuscharge3" name="cuscharge3" style="text-align:right;width:100%;">
                                        </td>
                                        <td style="width:60px;">
                                            <input type="text" class="kh16-b" id="cuschargecur3" style="display:inline;width:60px;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">សរុបទឹកប្រាក់</td>

                                        <td style="width:100%;">
                                            <input type="text" class="kh16-b tdcanenter" id="totalamt3" name="totalamt3" style="text-align:right;width:100%;" readonly>
                                        </td>
                                        <td style="width:60px;">
                                            <input type="text" class="kh16-b" id="totalcur3" style="display:inline;width:60px;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">ទូទាត់តាម</td>

                                        <td colspan=2 style="">
                                            <select name="selbankname3" id="selbankname3" class="kh16-b" style="width:100%;height:30px;">
                                                @foreach ($userpartners as $cus)
                                                    <option value="{{ $cus->id }}" customertype="{{ $cus->customertype }}" agenttype="{{ $cus->agenttype->name }}" agenttypeid="{{ $cus->agent_type_id }}" maxtransfer="{{ $cus->agenttype->transfer_amount }}" maxfee="{{ $cus->agenttype->transfer_fee }}" maxcashdrawfee="{{ $cus->agenttype->cashdraw_fee }}" maxcuscharge="{{ $cus->agenttype->customer_fee }}"  userconnect="{{ $cus->user_connect }}">{{ $cus->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">ប្រតិបត្តិការណ៏</td>

                                        <td colspan=2 style="">
                                            <select name="seltranname" id="seltranname" class="kh16-b" style="width:100%;height:30px;">

                                            </select>
                                        </td>

                                    </tr>
                                     <tr style="">
                                            <td style="padding:0px;"><input type="button" id="btnwingbal" class="kh12-b button1" value="Balance"></td>
                                            <td style="padding:0px;" colspan=2>
                                                <table class="table">
                                                    <tr>
                                                        <td style="padding:0px;text-align:center;width:50%">
                                                            <input type="text" id="wingbalance" name="wingbalance" class="kh16-b" style="width:100%;padding:0px;border-style:none;" readonly>
                                                        </td>
                                                        <td style="padding:0px;text-align:center;width:50%">
                                                            <input type="text" id="wingbalancenext" name="wingbalancenext" class="kh16-b" style="width:100%;padding:0px;border-style:none;text-align:right;" readonly>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                    <tr>
                                        <td style="" class="kh14">លេខអ្នកទទួល</td>

                                        <td colspan=2 style="">
                                            <input type="text" class="kh22-b" id="wingrectel3" name="wingrectel3" style="width:100%;background-color:yellow;" >
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="" class="kh14">ឈ្មោះអ្នកទទួល</td>

                                        <td colspan=2 style="">
                                            <input type="text" class="kh16-b" id="wingrecname3" name="wingrecname3" style="width:100%;" >
                                        </td>

                                    </tr>
                                    <tr id="rowqr" style="">
                                        <td style="" class="kh14">QRCODE <br> <button id="btnshowfullqr">SHOW 100%</button></td>
                                        <td colspan=3 style="text-align:center;">
                                            <img src="{{ config('helper.asset_path')}}/logo/noqr.png')" alt="" class="student-photo" id="qrcode_image" style="width:120px;">
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div id="divcodelist" class="row" style="margin:0px;">

                                        <table id="tblcodelist" class="table table-bordered" style="table-layout:fixed;">
                                            <thead style="text-align:center;">
                                                <th style="">Amount</th>
                                                <th style="width:60px;">Cur</th>
                                                <th style="width:160px;">Money Code</th>
                                                <th style="width:100px;">Fee</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table" style="">
                                        <tr  style="">
                                            <td style="padding:0px;width:100px;" class="kh14">MoneyCode</td>
                                            <td style="padding:0px;text-align:center;width:100%;">
                                                <input type="text" class="kh12-b" id="txtmoneycode3" style="width:100%;" readonly>
                                            </td>
                                        </tr>
                                        <tr style="">
                                            <td style="padding:0px;" class="kh14">Docodeby</td>
                                            <td style="padding:0px;text-align:center;width:100%">
                                                <input type="text" id="docodeby3" name="docodeby3" class="kh12-b" style="width:100%;" readonly>
                                            </td>
                                        </tr>



                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
            <div class="" style="padding:5px;">


                <button id="btnupdate3" class="kh16-b mybtn-info" style="float:right;margin:5px;width:80px;">Update</button>
                <button id="btndorkcode3" type="button" class="mybtn-danger kh16-b" style="float:right;margin:5px;width:80px;">ដកកូត</button>
                <button id="btnviewcode3" type="button" class="mybtn-success kh16-b" style="float:right;margin:5px;width:80px;">ព្រីនប័ណ្ណ</button>
                <button id="btngeneratecode3" type="button" class="mybtn-info kh16-b" style="float:right;margin:5px;">ធ្វើកូត</button>
                <button type="button" class="mybtn-danger kh16-b" data-bs-dismiss="modal">Close</button>
                <button id="btnready3" class="mybtn-success kh16-b" style="">រួចរាល់</button>
                <button id="btnnotready3" class="mybtn-info kh16-b" style="">មិនទាន់រួចរាល់</button>

                <input type="hidden" id="agenttype3">
                <input type="hidden" id="customertype3">

                <input type="hidden" id="wingmaxamt3">
                <input type="hidden" id="wingmaxcuscharge3">
                <input type="hidden" id="wingmaxtransferfee3">
                <input type="hidden" id="wingmaxfee3">


            </div>
        </div>
    </div>
</div>
