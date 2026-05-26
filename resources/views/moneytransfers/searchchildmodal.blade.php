<div class="modal fade" id="searchchildmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ស្វែងរកកូនសាខា</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="table-responsive">
                        <table id="tbl_child" class="table">
                            <tr>

                                <td class="kh22">មេសាខា</td>
                                <td class="kh22">ខេត្ត</td>
                                <td class="kh22">ស្រុក</td>
                            </tr>
                            <tr>
                                <td style="width:300px;">
                                    <select class="form-select kh22" id="sel_customer_search" style="width:300px;">
                                        <option value="">ទាំងអស់</option>
                                        @foreach ($partners->where('customertype','PARTNER') as $cus)
                                            <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:300px;">
                                    <select class="form-select kh22" name="sel_province_search" id="sel_province_search" style="width:300px;">
                                        <option value="">ខេត្តទាំំងអស់</option>
                                        @foreach ($provinces as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width:300px;">
                                    <select class="form-select kh22" name="sel_district_search" id="sel_district_search" style="width:300px;">

                                    </select>
                                </td>


                                <td style="text-align:right">
                                    <button class="btn btn-info" id="btnsearchchild" style="margin-top:5px;">Search</button>

                                </td>
                            </tr>
                        </table>
                    </div>
               </div>
               <div class="row">
                    <div class="table-responsive">
                        <table id="tblchildren" class="table table-bordered tbl_customer kh22">
                            <thead style="text-align:center;">
                                <th>N <sup>o</sup></th>
                                <th>កូនសាខា</th>
                                <th>មេសាខា</th>
                                <th>អាស័យដ្ឋាន</th>
                                <th style="display:none;">ID</th>
                                <th>សកម្មភាព</th>
                            </thead>
                            <tbody id="tbl_children">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
