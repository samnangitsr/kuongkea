<div class="modal fade" id="cashdrawcontinuemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modalheader" class="modal-title kh30-b">ចូលបញ្ជីដៃគូ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="divcontinue" style="">
                    <div class="card" id="continuecard" >
                        <form action="" id="frm_continue">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="table-responsive">
                                        <input type="hidden" id="receive_id" name="receive_id">
                                        <input type="hidden" id="receive_name" name="receive_name">

                                        <table id="tbl_continue_partner" class="table kh22">
                                            <tr>
                                                <td>
                                                    <label for="date" class="kh22" style="width:120px;">ថ្ងៃចូលបញ្ជី</label>
                                                </td>
                                                <td colspan=2>
                                                    <div class="input-group">

                                                        <input type="text" name="datecontinue" id="datecontinue" class="form-control" value="" style="background-color:white;font-size:22px;" readonly>

                                                        <span style="width:60px;" class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr style="margin-bottom:20px;">
                                                <td><label for="selpartner_continue_2" class="kh22" style="width:150px;">ជ្រើសរើសដៃគូ</label></td>
                                                <td colspan=2 style="height:50px;">
                                                    <select class="form-select kh22" name="selpartner_continue_2" id="selpartner_continue_2" style="width:100%">
                                                      <option value=""></option>
                                                      @foreach ($partners as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                        @endforeach
                                                      @if(Auth::user()->role->name=='Admin')
                                                        @foreach ($customers as $c)
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                      @endif
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="row_son">
                                                <td><label for="son_2" class="kh22" style="width:150px;">បន្តទៅកូនសាខា</label></td>
                                                <td colspan=2>
                                                    <div class="input-group">
                                                        <input type="text" id="son_2" name="son_2" class="form-control kh16" style="height:48px;display:inline;">
                                                        <button id="btnbrowseson_2" style="width:60px;display:inline;" class="btn btn-info btn-lg">...</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="rectel" class="kh22" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកទទួល</label></td>
                                                <td colspan=2>

                                                    <input type="text" class="form-control kh22 typeautosearch canenter" id="rectel_continue_2" name="rectel_continue_2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="recname" class="kh22" style="width:150px;">ឈ្មោះអ្នកទទួល</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh22 canenter" id="recname_continue_2" name="recname_continue_2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sendertel" class="kh22" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកផ្ញើ</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh22 canenter" id="sendertel_continue_2" name="sendertel_continue_2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="sendername" class="kh22" style="width:150px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                                <td colspan=2>
                                                    <input type="text" class="form-control kh22 canenter" id="sendername_continue_2" name="sendername_continue_2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ចំនួនទឹកប្រាក់វេរ</td>
                                                <td>
                                                    <input type="text" class="form-control kh22 canenter" id="amount_continue_2" name="amount_continue_2" style="width:100%;text-align:right;" autocomplete="off">
                                                </td>
                                                <td style="width:150px;">
                                                    <select name="selcur_continue_2" id="selcur_continue_2" class="form-select kh22" style="width:150px;">
                                                        <option value=""></option>
                                                        @foreach ($currencies as $c)
                                                            <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="row_cuscharge">
                                                <td>សេវ៉ាវេរ</td>
                                                <td>
                                                    <input type="text" class="form-control kh22 canenter" id="cuscharge_continue_2" name="cuscharge_continue_2" style="width:100%;text-align:right;" value="0">
                                                </td>
                                                <td style="width:150px;">
                                                    <input type="text" class="form-control kh22" id="txtcur2_2" style="width:150px;" readonly>
                                                </td>
                                            </tr>
                                            <tr id="row_totalcash">
                                                <td>សរុបទឹកប្រាក់</td>
                                                <td>
                                                    <input type="text" class="form-control kh22" id="totalcash_2" name="totalcash_2" style="width:100%;text-align:right;">
                                                </td>
                                                <td style="width:150px;">
                                                    <input type="text" class="form-control kh22" id="txtcur_2" style="width:150px;" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>សេវ៉ាដៃគូ</td>
                                                <td>
                                                    <input type="text" class="form-control kh22 canenter" id="fee_continue_2" name="fee_continue_2" style="width:100%;text-align:right;" value="0">
                                                </td>
                                                <td style="width:150px;">
                                                    <input type="text" class="form-control kh22" id="txtcur1_2" style="width:150px;" readonly>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div id="divckwater" class="form-check kh22">
                                        <input class="form-check-input" type="checkbox" id="ckwater_2" name="ckwater_2" value="" >
                                        <label for="ckwater_2" class="form-check-label kh22">ដកទឹក</label>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div style="float:right">
                                        <button id="btnsavecontinue" class="btn btn-info kh22">រក្សាទុក</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>









