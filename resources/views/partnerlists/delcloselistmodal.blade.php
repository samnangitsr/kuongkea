<div class="modal fade" id="delcloselistmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">លុបបិទបញ្ជីដៃគូ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmcloselist1" action="">
                <div class="modal-body">
                    <div class="row" style="">
                        <div class="table-responsive">
                            <table class="table">
                                <tr class="kh16">

                                    <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                                    <th style="border-style:none;"></th>

                                </tr>
                                <tr>

                                    <td style="padding:0px;border-style:none;width:350px;">
                                        <select name="selcustomer2" id="selcustomer2" style="width:350px;margin-top:-60px;" class="form-select" required>
                                            <option value="">ទាំងអស់</option>
                                            @foreach ($partners as $p)
                                              <option value="{{ $p->id }}" >{{ $p->name }}</option>
                                            @endforeach
                                            @if(Auth::user()->role->name=='Admin')
                                              @foreach ($customers as $c)
                                                <option value="{{ $c->id }}" >{{ $c->name }}</option>
                                              @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td style="padding:0px 0px 0px 20px;border-style:none;">
                                        <button class="btn btn-primary btn-sm kh16" id="btnshowcloselist">បង្ហាញ</button>

                                    </td>

                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tbl_delcloselist1" class="table table-bordered table-hover kh16">
                                <thead style="text-align:center;" class="kh16">
                                    <th style="width:60px;">លរ</th>
                                    <th style="width:120px;">ថ្ងៃទី</th>
                                    <th style="width:100px;">ម៉ោង</th>
                                    <th style="width:200px;">អ្នកកត់ត្រា</th>
                                    <th>ដុល្លា</th>
                                    <th>បាត</th>
                                    <th>រៀល</th>
                                    <th>ដុង</th>
                                    <th>Transfer_ID</th>
                                    <th>Exchange_ID</th>
                                    <th>SMS_ID</th>

                                    <th style="width:60px;">សកម្មភាព</th>

                                </thead>
                                <tbody id="closelistbody">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
