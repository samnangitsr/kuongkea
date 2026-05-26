<div class="modal fade" id="transferthailistmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span id="mhd" class="modal-title kh16-b">ប្រតិបត្តិការណ៏វេរទៅថៃ</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="margin:-10px 0px 10px 0px;">
                        <div class="col-lg-6">
                            <div class="row">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="radio" class="form-check-input kh16-b" id="optall" name="optlist" value="2" checked>
                                            <label class="form-check-label kh16-b" for="optall">ទាំងអស់</label>

                                            <input type="radio" class="form-check-input kh16-b" id="optnotyetmatch" name="optlist" value="0">
                                            <label class="form-check-label kh16-b" for="optnotyetmatch">មិនទាន់ភ្ជាប់</label>

                                            <input type="radio" class="form-check-input kh16-b" id="optmatched" name="optlist" value="1">
                                            <label class="form-check-label kh16-b" for="optmatched">ភ្ជាប់រួច</label>

                                            <button class="mybtn" id="btnshowoptlist">Show</button>
                                        </td>


                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="tableFixHead" style="margin:0px;padding:0px;">
                                    <table id="tbl_transfertothai" class="table table-bordered table-hover tbl_transfertothai" style="table-layout:fixed;">
                                        <thead style="text-align:center;">
                                            <th style="width:40px;" class="kh12-b">លរ</th>
                                            <th style="width:100px;" class="kh12-b">ថ្ងៃទី</th>
                                            <th style="width:80px;" class="kh12-b">ម៉ោង</th>
                                            <th style="width:100px;" class="kh12-b">ប្រតិបត្តិការណ៏</th>
                                            <th style="width:180px;" class="kh12-b">ឈ្មោះដៃគូ</th>
                                            <th style="width:130px;" class="kh12-b">ចំនួនទឹកប្រាក់</th>
                                            <th style="width:200px;" class="kh12-b">លេខអ្នកទទួល</th>
                                            <th style="width:200px;" class="kh12-b">ឈ្មោះអ្នកទទួល</th>
                                            <th style="width:100px;" class="kh12-b">SMSID</th>

                                            <th style="width:150px;" class="kh12-b">អ្នកកត់ត្រា</th>
                                            <th style="width:100px;" class="kh12-b">ID</th>
                                            <th style="width:60px;" class="kh12-b">TCode</th>
                                            <th style="width:60px;" class="kh12-b">មេគុណ</th>
                                        </thead>
                                        <tbody id="body_transfertothai">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="row" style="margin-bottom:5px;">
                                <table>
                                    <tr>
                                        <td class="kh16-b">
                                            សារបាញ់ចេញដែលមិនទាន់ទូទាំត់
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="tableFixHead" style="margin:0px;padding:0px;">
                                    <table id="tbl_transfertothai1" class="table table-bordered table-hover tbl_transfertothai1" style="table-layout:fixed;">
                                        <thead style="text-align:center;">
                                            <th style="width:40px;" class="kh12-b">លរ</th>
                                            <th style="width:160px;" class="kh12-b">ថ្ងៃទី</th>

                                            <th style="width:100px;" class="kh12-b">លេខបញ្ជី</th>
                                            <th style="width:130px;" class="kh12-b">ចំនួនទឹកប្រាក់</th>
                                            <th style="width:130px;" class="kh12-b">អ្នកកត់ត្រា</th>
                                        </thead>
                                        <tbody id="body_transfertothai1">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                </div>


            </div>

        </div>
    </div>
</div>
