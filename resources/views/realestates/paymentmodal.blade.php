<style>
    td{
        border-style:none;
    }
</style>

<div class="modal fade" id="paymentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px;">
                <h5 id="modalheader" class="modal-title kh16-b">
                    <span id="mtitle">ទូទាត់</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">

                <form id="frmdeposit" action="">
                    <input type="hidden" id="id1" name="id1">
                    <input type="hidden" id="id2" name="id2">
                    <input type="hidden" id="trancode" name="trancode">
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">

                                <div class="table-responsive" style="margin:10px 0px 0px 10px;">
                                    <table id="tbl_partner" class="table" style="table-layout:fixed;">
                                        <tr>
                                            <td style="width:150px;"><label for="invdate" class="kh16" style="">ថ្ងៃបង់ប្រាក់</label></td>
                                            <td colspan=2 style="padding:0px;">
                                                <div class="input-group">
                                                    <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:30px;" readonly>
                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_payformonth" style="display:none;">
                                            <td style="width:150px;"><label for="payformonth" class="kh16" style="">បង់សំរាប់ខែ</label></td>
                                            <td colspan=2 style="padding:0px;">
                                                <div class="input-group">
                                                    <input type="text" name="payformonth" id="payformonth" class="form-control kh16-b" style="background-color:white;height:30px;" readonly>
                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr id="row_txtname">
                                            <td style="width:150px;"><label id="labelname" for="txtname" class="kh16" style="">ឈ្មោះអតិថិជន</label></td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16-b" id="txtname" name="txtname">
                                            </td>
                                        </tr>

                                        <tr id="row_amount">
                                            <td class="kh16">សរុបទឹកប្រាក់</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="amount" name="amount" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b" id="txtcur" name="txtcur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_deposited" style="">
                                            <td class="kh16">បានទូទាត់រួច</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="deposited" name="deposited" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_balance" style="">
                                            <td class="kh16">សមតុល្យ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="balance" name="balance" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_qty" style="display:none;">
                                            <td class="kh16-b">បង់ចំនួន</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="number" class="form-control kh16-b" id="qty" name="qty" style="text-align:right;height:30px;" value="1">
                                                    <input type="text" class="input-group kh16-b" value="ខែ" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_deposit" style="">
                                            <td class="kh16-b">សរុបបង់</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh22-b" id="deposit" name="deposit" style="text-align:right;height:30px;color:red;">
                                                    <input type="text" name="depositcur" class="input-group kh22-b cur" style="width:80px;height:30px;border:1px solid gray;color:red;" readonly>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr id="row_balance1" style="">
                                            <td class="kh16">សមតុល្យ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="balance1" name="balance1" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_overday" style="">
                                            <td class="kh16">លើសថ្ងៃ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="overday" name="overday" value="0" style="text-align:right;height:30px;" {{ strtoupper(Auth::user()->role->name)<>'ADMIN'?'readonly':'' }}>
                                                    {{-- <input type="text" class="form-control kh16-b" id="overday" name="overday" value="0" style="text-align:right;height:30px;"> --}}

                                                    <input type="text" class="input-group kh16-b" value="ថ្ងៃ" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_overmoney" style="">
                                            <td class="kh16">ពិន័យ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="overprice" name="overprice" value="5" title="5" style="text-align:right;height:30px;" {{ strtoupper(Auth::user()->role->name)<>'ADMIN'?'readonly':'' }}>
                                                    <input type="text" class="input-group kh16-b" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_qtybuy" style="">
                                            <td class="kh16">ចំនួនល្វែង</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="qtybuy" name="qtybuy" value="" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b" value="P" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_overmoney" style="">
                                            <td class="kh16">សរុបពិន័យ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="overamount" name="overamount" value="0" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_cuscharge_debt" style="">
                                            <td class="kh16">ជំពាក់ពិន័យ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh16-b" id="old_cuscharge_debt" name="old_cuscharge_debt" value="0" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh16-b" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_payfornextmonth" style="display:none;">
                                            <td style="width:150px;"><label for="payfornextmonth" class="kh16" style="">បង់ខែបន្ទាប់</label></td>
                                            <td colspan=2 style="padding:0px;">
                                                <div class="input-group">
                                                    <input type="text" name="payfornextmonth" id="payfornextmonth" class="form-control kh16-b" style="background-color:white;height:30px;" readonly>
                                                    <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_paycommissionleft" style="">
                                            <td class="kh16-b">ជើងសារនៅសល់</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh22-b" id="commission_left" name="commission_left" style="text-align:right;height:30px;" readonly>
                                                    <input type="text" class="input-group kh22-b cur" style="width:80px;height:30px;border:1px solid gray;" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="row_paycommission" style="">
                                            <td class="kh16-b">បង់កម្រៃជើងសារ</td>
                                            <td colspan=2>
                                                <div class="input-group">
                                                    <input type="text" class="form-control kh22-b" id="paycommission" name="paycommission" style="text-align:right;height:30px;">
                                                    <input type="text" class="input-group kh22-b cur" style="width:80px;height:30px;border:1px solid gray;" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive" style="margin:10px 10px 0px 0px;">
                                <table>
                                    <tr id="row_tbl_sale_detail">
                                        <td colspan=3>
                                            <table id="tbl_sale_detail" class="table table-bordered table-hover" style="table-layout:fixed;">
                                                <thead style="text-align:center;" class="kh12">
                                                    <th style="width:40px;">No</th>
                                                    <th style="width:80px;display:none;">PID</th>
                                                    <th style="width:150px;">Name</th>
                                                    <th style="width:100px;">Size</th>
                                                    <th style="">Price</th>
                                                    <th style="width:100px;display:none;">Curid</th>
                                                    <th id="haction" style="width:40px;">Act</th>
                                                </thead>
                                                <tbody id='body_sale_detail'>

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                                <table class="table">
                                    <tr id="row_nopunish">
                                        <td style="border-style:none;padding:3px 0px;" class="kh16-b">
                                            <label class="form-check-label kh16-b" title="Code:1.3.7">
                                                <input class="form-check-input kh16-b" type="checkbox" name="cknopunish" id="cknopunish"> លើកលែងការពិន័យ
                                            </label>
                                        </td>
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            <input type="text" id="discount_amount" name="discount_amount" class="kh16-b" style="width:100px;" value="0" readonly>
                                        </td>
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            សរុបក្រោយលើកលែង
                                        </td>
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            <input type="text" id="total_after_discount" name="total_after_discount" class="kh16-b" style="width:100px;" value="0" readonly>
                                        </td>

                                    </tr>
                                    <tr id="row_paypunish">
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            <label class="form-check-label kh16-b" title="Code:1.3.10">
                                                <input class="form-check-input kh16-b" type="checkbox" name="ckpaypunish" id="ckpaypunish"> កែបង់ពិន័យ
                                            </label>
                                        </td>
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            <input type="text" id="paypunish_amount" name="paypunish_amount" class="kh16-b" style="width:100px;" value="0" readonly>
                                        </td>
                                        <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            ជំពាក់ពិន័យ
                                        </td>
                                         <td style="border-style:none;padding:3px 0px" class="kh16-b">
                                            <input type="text" id="cuscharge_debt" name="cuscharge_debt" class="kh16-b" style="width:100px;" value="0" readonly>
                                        </td>
                                    </tr>
                                    <tr id="row_note">
                                        <td colspan=4>
                                            <textarea name="note" id="note" class="kh16-b" style="width:100%;" rows="5" placeholder="កំណត់សំគាល់"></textarea>
                                        </td>
                                    </tr>
                                    <tr id="row_selbank" style="">
                                        <td colspan=4>
                                            <table class="table">
                                                <tr>
                                                    <td class="kh16" style="width:100px;">ទូទាត់តាម</td>
                                                    <td>
                                                        <select name="selbank" id="selbank" class="form-select kh16-b" style="">
                                                            <option value="cash">សាច់ប្រាក់</option>
                                                            @foreach ($partners->where('customertype','BANK') as $b)
                                                                <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" thai_list="{{ $b->thai_list }}">{{ $b->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="kh16-b">ចំនួនទូទាត់</td>
                                                    <td colspan=2>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control kh22-b" id="payamt" name="payamt" style="text-align:right;height:30px;">
                                                            <input type="text" name="payamtcur" class="input-group kh22-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="kh16">បង់ផ្តាច់ល្វែង</td>
                                                    <td colspan=2>
                                                        <select multiple="multiple" class="selproperty50" name="selproperty50[]" id="selproperty50" style="width:100%;">

                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <table class="table">
                    <tr>
                        <td style="text-align:right;">
                            <button class="btn btn-info kh14-b" id="btncomplete" style="float:left;" title="Code:1.3.8">ការទូទាត់រួចរាល់</button>
                            <button class="btn btn-info kh14-b" id="btnsavedeposit">រក្សាទុក</button>
                            <button class="btn btn-info kh14-b" id="btnsavedepositprint">រក្សាទុកព្រីន</button>
                            <button type="button" id="btnclosemodal" class="btn btn-danger kh12-b" data-bs-dismiss="modal">Close</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
