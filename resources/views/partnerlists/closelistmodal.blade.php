<div class="modal fade" id="closelistmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">បិទបញ្ជីដៃគូ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmcloselist" action="">
                <div class="modal-body">
                    <div class="row" style="">
                        <div class="table-responsive">
                            <table class="table">
                                <tr class="kh16-b">
                                    <th style="border-style:none;">ថ្ងៃបិទបញ្ជី</th>
                                    <th style="border-style:none;">ជ្រើសរើសដៃគូ</th>
                                    <th style="border-style:none;"></th>
                                    <th style="border-style:none;">*សំគាល់</th>

                                </tr>
                                <tr>

                                    <td style="padding:0px;border-style:none;width:180px;">
                                        <div class="input-group" style="width:180px;">
                                            <input type="text" name="closedate" id="closedate" class="form-control" style="width:120px;background-color:silver;font-size:16px;font-weight:bold;height:30px;">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>

                                    </td>

                                    <td style="padding:0px;border-style:none;width:300px;">
                                        <select name="selcustomer1" id="selcustomer1" style="width:300px;margin-top:-60px;" class="" required>
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
                                        <button class="btn btn-primary btn-sm kh16" id="btnsummarylist">សរុបបញ្ជី</button>
                                    </td>

                                    <td class="kh22" style="padding:0px 0px 0px 20px;border-style:none;">
                                        (-) = គេខ្វះយើង  (+) = យើងខ្វះគេ ។

                                    </td>

                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tbl_closelist" class="table table-bordered kh22-b">

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">

                        </div>
                        <div class="col-lg-3">
                            <button class="btn btn-primary btn-md kh22" id="btnsavelist" style="float:right;">រក្សាទុកបញ្ជី</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
