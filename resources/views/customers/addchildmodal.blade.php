<div class="modal fade" id="addchildmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ចុះឈ្មោះកូនសាខា</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="child_id" name="child_id">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table kh22">
                                <tr>
                                    <td style="border-style:none;">
                                        លរ
                                    </td>
                                    <td style="border-style:none;">
                                        <input type="number" name="no" id="no" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ជ្រើសរើសសាខាមេ
                                    </td>
                                    <td style="border-style:none;">
                                        <select name="selcustomer" id="selcustomer" class="form-select kh22">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $cus)
                                                <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ឈ្មោះសាខាកូន
                                    </td>
                                    <td style="border-style:none;">
                                        <input type="text" class="form-control kh22" name="childname" id="childname">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        លេខទូរស័ព្ទ
                                    </td>
                                    <td style="border-style:none;">
                                        <input type="text" class="form-control kh22" name="tel" id="tel">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ខេត្ត/ក្រុង
                                    </td>
                                    <td style="border-style:none;">
                                        <select class="form-select" name="sel_province1" id="sel_province1">
                                            <option value="">ជ្រើសរើសខេត្ត</option>
                                            @foreach ($provinces as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ស្រុក/ខ័ណ្ឌ
                                    </td>
                                    <td style="border-style:none;">
                                        <select class="form-select" name="sel_district1" id="sel_district1">
                                           
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ឃុំ/សង្កាត់
                                    </td>
                                    <td style="border-style:none;">
                                        <select class="form-select" name="sel_commune1" id="sel_commune1">
                                           
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-style:none;">
                                        ភូមិ/ក្រុម
                                    </td>
                                    <td style="border-style:none;">
                                        <select class="form-select" name="sel_village1" id="sel_village1">
                                           
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                   
                </div>
               
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="btnsavecustomer">Save</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>