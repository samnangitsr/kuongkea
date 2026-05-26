<div class="modal fade" id="cashdrawcodemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" style="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modalheader" class="modal-title kh30-b">ដកកូត</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row" style="margin:10px;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="text-align:center;">
                                <th class="kh16-b" style="width:150px;">លុយថៃ</th>
                                <th class="kh16-b" style="width:100px;">អត្រា</th>
                                <th class="kh16-b" style="width:150px;">ចំនួនទឺកប្រាក់</th>
                                <th class="kh16-b" style="width:60px;">រូបិយ</th>
                                <th class="kh16-b">លេខគណនេយ្យ</th>
                                <th class="kh16-b" style="width:150px;">Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:0px;">
                                        <input type="hidden" id="tid0_out">
                                        <input type="text" class="form-control kh16-b" id="thaiamt_out" style="text-align:right;width:150px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="exchangerate_out" style="width:100px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="wingamount_out" style="text-align:right;width:150px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="wingcur_out" style="display:inline;width:60px;" readonly>
                                        <input type="hidden" class="form-control kh22" id="wingcurid_out" style="" readonly>
                                    </td>
                                    <td class="kh16-b"><span id="bankname_out"></span></td>
                                    <td style="padding:0px;">
                                        <input type="button" class="btn btn-info kh16-b" value="Generate Code" id="btngeneratecode_out" style="width:150px;">
                                        <input type="hidden" class="form-control kh16-b" id="wingmaxamt_out" readonly>
                                        <input type="hidden" class="form-control" id="customerid_out">
                                        <input type="hidden" class="form-control" id="customername_out">
                                        <input type="hidden" class="form-control kh16-b" id="wingmaxfee_out" readonly>
                                        <input type="hidden" class="form-control kh16-b" id="agenttype_out" readonly>
                                        <input type="hidden" class="form-control kh16-b" id="rowind_out" readonly>

                                        <input type="hidden" class="form-control kh16-b" id="docodeby_out" value="{{ Auth::id() }}" readonly>
                                        <input type="hidden" class="form-control kh16-b" id="docodebyname_out" value="{{ Auth::user()->name }}" readonly>
                                        <input type="hidden" id="txtmoneycode_out">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-12">
                        <table class="">
                            <tr>
                                <td style="padding:0px 5px 0px 0px;" class="kh16-b">លេខអ្នកទទួល:</td>
                                <td style="padding:0px 25px 0px 0px;" class="kh16-b" id="rectel_out"></td>
                                <td style="padding:0px 5px 0px 0px;" class="kh16-b">ឈ្មោះអ្នកទទួល:</td>
                                <td style="padding:0px 5px 0px 0px;" class="kh16-b" id="recname_out"></td>

                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin:10px;">
                    <table id="tblcashdrawcodelist" class="table table-bordered">
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
            <div class="modal-footer">
                <button id="btncashdrawcode" class="btn btn-primary kh16-b" style="">ដកកូត</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
