

<div class="modal fade" id="discountmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px;">
                <h5 id="modalheader" class="modal-title kh22-b">
                    <span id="mtitle">កែប្រែការពិន័យ</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">

                <form id="frmdiscount" action="">
                    <input type="hidden" id="id" name="id">

                    <div class="row" style="padding:20px;">
                        <div class="col-lg-12">
                            <table class="table tbl1 kh16-b" style="">
                                <tr>
                                    <td>ឈ្មោះអតិថិជន</td>
                                    <td><input type="text" class="kh16-b" id="cusname" name="cusname" style="width:100%;" readonly></td>
                                </tr>
                                <tr>
                                    <td>ប្រតិបត្តិការណ៏</td>
                                    <td><input type="text" class="kh16-b" id="tranname" name="tranname" style="width:100%;" readonly></td>
                                </tr>
                                <tr>
                                    <td>ចំនួនទឹកប្រាក់</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="amount" name="amount" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b cur" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>លើសថ្ងៃ</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="overday" name="overday" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b" value="ថ្ងៃ" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>ប្រាក់ពិន័យ/ថ្ងៃ</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="overprice" name="overprice" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b cur" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>សរុបប្រាក់ពិន័យ</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="overamount" name="overamount" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b cur" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>លើកលែងពិន័យ</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="discount_amount" name="discount_amount" style="text-align:right;height:30px;">
                                            <input type="text" class="input-group kh16-b cur" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>នៅសល់</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="balance" name="balance" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b cur" value="USD" style="width:80px;height:30px;border:1px solid gray" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>


                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-info kh14-b" id="btnupdatediscount">កែប្រែ</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger kh12-b" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
