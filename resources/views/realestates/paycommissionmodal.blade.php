<div class="modal fade" id="paycommissionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <p id="modalheader" class="modal-title kh22-b">បង់កម្រៃជើងសារ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="frmpayment">
                    <div class="row" style="padding:0px 20px;">
                        <input type="hidden" id="payonid" name="payonid">
                        <input type="hidden" id="id" name="id">

                        <table>
                            <tr id="row_date" style="">
                                <td style="width:150px;"><label for="invdate" class="kh16" style="">កាលបរិច្ឆេទ</label></td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" name="invdate" id="invdate" class="form-control kh16-b" style="background-color:white;height:30px;width:120px;margin-top:0px;" readonly>
                                        <span class="input-group-text" style="width:40px;height:30px;margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                    </div>

                                </td>
                            </tr>
                            <tr>

                                <td class="kh16">អ្នកលក់</td>
                                <td colspan=2>
                                    <input type="text" class="form-control kh16-b" id="saler" name="saler" style="height:30px;" readonly>
                                </td>

                            </tr>
                            <tr id="row_commission" style="">
                                <td class="kh16">កម្រៃជើងសារ</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b" id="commission" name="commission" style="text-align:right;height:30px;" readonly>
                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_deposited" style="">
                                <td class="kh16">ទូទាត់រួច</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b" id="deposited" name="deposited" style="text-align:right;height:30px;" readonly>
                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_balance" style="">
                                <td class="kh16">លុយនៅសល់</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b" id="balance" name="balance" style="text-align:right;height:30px;" readonly>
                                        <input type="text" class="input-group kh16-b cur"  style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_deposit" style="">
                                <td class="kh16">ប្រាក់ទូទាត់</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="deposit" name="deposit" style="text-align:right;height:30px;" value="0">
                                        <input type="text" id="curid" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_balabce" style="">
                                <td class="kh16">សមតុល្យ</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b canenter" id="balance1" name="balance1" style="text-align:right;height:30px;" value="0" readonly>
                                        <input type="text" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td class="kh16">ទូទាត់តាម</td>
                                <td colspan=2>
                                    <select name="selbank" id="selbank" class="form-select kh16-b" style="">
                                        <option value="cash">សាច់ប្រាក់</option>
                                        @foreach ($partners->where('customertype','BANK') as $b)
                                            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" thai_list="{{ $b->thai_list }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="kh16">ចំនួនទូទាត់</td>
                                <td colspan=2>
                                    <div class="input-group">
                                        <input type="text" class="form-control kh16-b" id="payamt" name="payamt" style="text-align:right;height:30px;">
                                        <input type="text" name="payamtcur" class="input-group kh16-b cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr id="row_note">
                                <td colspan=3 style="padding-top:10px;">
                                    <textarea name="note" id="note" class="kh16-b" style="width:100%;" rows="3" placeholder="កំណត់សំគាល់"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button id="btnsavepayment" class="btn btn-primary kh16-b" style="">Save</button>
                <button id="btnsavepaymentprint" class="btn btn-primary kh16-b" style="">Save Print</button>

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
