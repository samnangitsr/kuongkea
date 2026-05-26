<div class="modal fade" id="enddingbalance_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">
                    ដកលុយបុគ្គលិកចុងគ្រាសរុប
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="frmcashoutendbalance">
                    <div class="container">

                        <div class="row" style="padding:0px;margin:0px;">
                            <div class="col-lg-6">
                                <table id="tblmymoney" class="table table-bordered table-hover" style="table-layout:fixed;width:100%;overflow:auto;">
                                    <tbody id="bodymymoney">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table id="tblmymoney1" class="table table-bordered table-hover" style="table-layout:fixed;width:100%;overflow:auto;">
                                    <tbody id="bodymymoney1">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="rowmix" class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered kh16">
                                        <thead style="text-align:center;">
                                            <th style="width:80px;">លរ</th>
                                            <th style="width:100px;">CurID</th>
                                            <th style="width:120px;">រូបិយប័ណ្ណ</th>
                                            <th>ចំនូនត្រូវដកសរុប</th>
                                            <th style="width:120px;">រូបិយប័ណ្ណ</th>

                                        </thead>
                                        <tbody id="bodyendbalance">

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <table class="">
                    <tr>
                        <td class="tdcontinue" style="border-style:none;width:300px;">
                            <table>
                                <tr>
                                    <td style="border-style:none;width:100px;">
                                        <label class="form-check-label kh16-b">
                                            <input class="form-check-input kh16-b" type="checkbox" name="ckcontinue" id="ckcontinue" style="display:inline;" checked> បន្តថ្ងៃស្អែក
                                        </label>
                                    </td>
                                    <td style="border-style:none;width:200px;">
                                        <select class="form-select kh16" name="selusercontinue" id="selusercontinue" style="height:35px;width:180px;">
                                            <option value=""></option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>

                        </td>

                        <td style="border-style:none;width:100px;">
                            <button type="button" id="btnclosemodal" class="btn btn-danger kh14-b" data-bs-dismiss="modal">Close</button>
                        </td>

                        <td style="text-align:right;border-style:none;">
                            <button class="btn btn-info kh14-b" id="btnsavecashdrawall">រក្សាទុក(ដកចុងគ្រាសរុប)</button>
                            <button id="btnsavecontinue" class="btn btn-primary kh14-b">រក្សាទុក(បន្តថ្ងៃស្អែក)</button>
                        </td>

                    </tr>
                </table>


            </div>

        </div>
    </div>
</div>
