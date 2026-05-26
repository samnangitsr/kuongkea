<div class="modal fade" id="addaddressmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ចុះឈ្មោះខេត្តក្រុង</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="address_id">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table id="address_form" class="table kh16-b">
                                <tr>
                                    <td>
                                        ខេត្ត
                                    </td>
                                    <td style="width:300px;">
                                        <select class="form-select" name="sel_province" id="sel_province" style="width:300px;">
                                            <option value="">ជ្រើសរើសខេត្ត</option>
                                            @foreach ($provinces as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="province" id="province" class="form-control kh16-b">
                                    </td>
                                    <td>
                                        <button id="btnsaveprovince" class="mybtn" style="">
                                            SAVE
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ស្រុក
                                    </td>
                                    <td style="width:300px;">
                                        <select class="form-select" name="sel_district" id="sel_district" style="width:300px;">

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="district" id="district" class="form-control kh16-b">
                                    </td>
                                    <td>
                                        <button id="btnsavedistrict" class="mybtn" style="">
                                            SAVE
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ឃុំ
                                    </td>
                                    <td style="width:300px;">
                                        <select class="form-select" name="sel_commune" id="sel_commune" style="width:300px;">

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="commune" id="commune" class="form-control kh16-b">
                                    </td>
                                    <td>
                                        <button id="btnsavecommune" class="mybtn" style="">
                                            SAVE
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ភូមិ
                                    </td>
                                    <td style="width:300px;">
                                        <select class="form-select" name="sel_village" id="sel_village" style="width:300px;">

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="village" id="village" class="form-control kh16-b">
                                    </td>
                                    <td>
                                        <button id="btnsavevillage" class="mybtn" style="">
                                            SAVE
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
