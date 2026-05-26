<div class="modal fade" id="depositgold_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">ទូទាត់មាស</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="" id="frmgolddeposit">
                            <input type="hidden" id="txtex_id" name="txtex_id">
                            <input type="hidden" id="txtex_group" name="txtex_group">
                             <input type="hidden" id="examount" name="examount">
                           <div class="table-responsive">
                                <table id="tblgolddeposit" class="table kh16-b">
                                    <tr>
                                        <td class="kh16-b" style="">កាលបរិច្ឆេទ</td>
                                        <td class="kh16-b" style="">
                                            <div class="input-group">
                                                <input type="text" name="deposit_date" id="deposit_date" class="form-control kh16-b" style="background-color:white;" readonly>
                                                <span class="input-group-text" style="margin-top:0px;"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ចូលបញ្ជី</td>
                                        <td colspan=2>
                                            <select name="selcustomergold" id="selcustomergold" class="form-select kh16-b" style="background-color:#d9ee64;">
                                                @foreach ($partners->where('is_gold_list',1) as $item)
                                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ទឹកប្រាក់ត្រូវទូទាត់</td>
                                        <td style="">
                                            <input type="text" name="txtdebt" id="txtdebt" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off" readonly>
                                        </td>
                                        <td style="width:100px;">
                                            <select name="selcur" id="selcur" class="form-select kh16-b" style="width:100px;font-weight:bold;">

                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ទូទាត់ចំនួន</td>
                                        <td style="">
                                            <input type="text" name="txtdeposit" id="txtdeposit" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:100px;">
                                            <input type="text" value="USD" style="width:100px;" class="form-control kh16-b" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>សមតុល្យ</td>
                                        <td style="">
                                            <input type="text" name="txtbalance" id="txtbalance" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off" readonly>
                                        </td>
                                        <td style="width:100px;">
                                            <input type="text" value="USD" style="width:100px;" class="form-control kh16-b" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ទូទាត់តាម</td>
                                        <td colspan=2>
                                            <select name="selbankdeposit" id="selbankdeposit" class="form-select kh16-b">
                                                <option value="" customertype="">Cash</option>
                                                @foreach ($partners->where('customertype','BANK') as $item)
                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                        <tr>
                                        <td>ចំនួនទូទាត់</td>
                                        <td style="">
                                            <input type="text" name="txtdeposit1" id="txtdeposit1" class="form-control canenter kh16-b" style="text-align:right;" autocomplete="off">
                                        </td>
                                        <td style="width:100px;">
                                            <select name="selcurdeposit1" id="selcurdeposit1" class="form-select kh16-b" style="width:100px;font-weight:bold;">

                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}" lomeang="{{ $c->lomeang }}" isgold="{{ $c->isgold }}" tuochek="{{ $c->tuochek }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ឈ្មោះអតិថិជន</td>
                                        <td colspan=2>
                                            <input type="text" class="form-control canenter kh16-b" id="client_name" name="client_name" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>លេខទូរស័ព្ទ</td>
                                        <td colspan=2>
                                            <input type="text" class="form-control canenter kh16-b" id="client_tel" name="client_tel" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 style="text-align:right;">
                                            <button id="btnsavedeposit" class="buttonstyle kh14-b">រក្សាទុក</button>
                                            <button id="btnsavedepositprint" class="buttonstyle kh14-b">រក្សាទុកព្រីន</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
