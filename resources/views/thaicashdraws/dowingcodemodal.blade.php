<div class="modal fade" id="dowingcodemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" style="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color:aqua">
                <p id="modalheader" class="modal-title kh30-b">ធ្វើលេខកូត</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color:rgb(146, 230, 241);">

                <div class="row" style="margin:10px;">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table id="tbl_modalwingcode" class="">

                                <tbody>
                                    <tr>
                                        <td class="kh16-b">លុយថៃ</td>
                                        <td>:</td>
                                        <td style="padding:0px;">
                                            <input type="text" class="kh22-b" id="thaiamt" style="border-style:none;" readonly>
                                        </td>
                                        <td>
                                            <select name="seltranname" id="seltranname" class="kh16-b" style=""></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b">អត្រា</td>
                                        <td>:</td>
                                        <td colspan=2 style="padding:0px;">
                                            <input type="text" class="kh22-b" id="exchangerate" style="border-style:none;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b">លុយប្តូរបាន</td>
                                        <td>:</td>
                                        <td style="padding:0px;">
                                            <input type="hidden" class="kh22-b" id="wingamount" style="border-style:none;" readonly>
                                            <input type="text" class="kh22-b" id="wingamountdisplay" style="border-style:none;" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="kh22-b input-group" id="wingcur" style="display:none;width:60px;border-style:none;" readonly>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="kh16-b">ទូទាត់តាម</td>
                                        <td>:</td>
                                        <td colspan=2 class="kh22-b"><span id="bankname"></span></td>

                                    </tr>
                                    <tr>
                                        <td class="kh16-b" id="tdaccnumber">លេខអ្នកទទួល</td>
                                        <td>:</td>
                                        <td colspan=2 style="padding:0px;background-color:yellow;" class="kh22-b" id="accnumber"></td>
                                    </tr>
                                    <tr>
                                        <td class="kh16-b" id="tdaccname">ឈ្មោះអ្នកទទួល</td>
                                        <td>:</td>
                                        <td colspan=2 style="padding:0px;" class="kh16-b" id="accname"></td>
                                    </tr>

                                    <tr>
                                        <td colspan=2 style="padding:10px 0px;">
                                            <input type="button" class="btn btn-info btn-sm kh16-b" value="Generate Code" id="btngeneratecode" style="width:150px;">
                                            <button  id="btnwingbal" class="btn btn-sm btn-primary">Bal</button>
                                            <input type="hidden" class="form-control kh16-b" id="wingmaxamt" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="wingmaxcuscharge" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="wingmaxtransferfee" readonly>

                                            <input type="hidden" id="wingrecname" class="form-control kh16-b">
                                            <input type="hidden" id="wingrectel" class="form-control kh16-b">
                                            <input type="hidden" class="form-control kh16-b" id="agenttype" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="rowind" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="docodeby" value="{{ Auth::id() }}" readonly>
                                            <input type="hidden" class="form-control kh16-b" id="docodebyname" value="{{ Auth::user()->name }}" readonly>
                                            <input type="hidden" id="txtmoneycode">
                                        </td>

                                        <td colspan=2 style="padding:0px;text-align:right;">
                                            <input type="text" id="wingbalance" name="wingbalance" class="kh16-b" style="padding:5px;color:blue;border-style:none;text-align:right;" readonly>
                                            <input type="text" id="wingbalancenext" name="wingbalancenext" class="kh16-b" style="padding:5px;color:red;border-style:none;text-align:right;" readonly>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div id="divqr" class="row" style="text-align:center;">
                            <img src="{{ asset(config('helper.asset_path').'/logo/noqr.png') }}" alt="" class="student-photo" id="qrcode_image" style="width:300px;">
                        </div>
                    </div>
                </div>

                <div id="divcodelist" class="row" style="margin:10px;">
                    <table id="tblcodelist" class="table table-bordered">
                        <thead>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Money Code</th>
                            <th>Fee</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="background-color:aqua">

                <button id="btnsavecode" class="btn btn-primary kh16-b" style="">Save Code</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="btncancelcode" class="btn btn-warning kh16-b" style="">Cancel Code</button>
            </div>
        </div>
    </div>
</div>
