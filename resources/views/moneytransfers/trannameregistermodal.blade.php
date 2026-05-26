<div class="modal fade" id="trannameregistermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modalheader" class="modal-title kh22-b">ចុះឈ្មោះប្រតិបត្តិការណ៏វេរ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <form id="frmtranname" action="">

                            <div class="row" style="">
                                <input type="hidden" name="tranname_id" id="tranname_id">
                                <div class="table-responsive">
                                    <table id="tbl_tranname_register" class="table table-bordered">
                                        <tr style="border-style:none;">
                                            <td class="kh16-b">ប្រភេទអាជីវកម្ម</td>

                                            <td style="border-style:none;padding:0px;">
                                                <select name="selagenttype1" id="selagenttype1" class="form-select kh16-b" style="">
                                                    <option value=""></option>
                                                    @foreach ($agenttypes as $t)
                                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border-style:none;">
                                            <td class="kh16-b">លរ</td>

                                            <td><input type="number" id='no' name="no" class="form-control"></td>
                                        </tr>

                                        <tr style="border-style:none;">
                                            <td class="kh16-b" style="width:100px;">ឈ្មោះប្រតិបត្តិការណ៏
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="isfav" id="isfav">
                                                    <label class="form-check-label" for="isfav">ពេញនិយម</label>

                                                </div>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control kh16-b" id="tranname" name="tranname">
                                            </td>
                                        </tr>
                                        <tr style="border-style:none;">
                                            <td class="kh16-b">សមតុល្យ</td>
                                            <td>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radbal_updown" id="radbalup" value="-1">
                                                <label class="form-check-label kh16-b" for="radbalup">កើន</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radbal_updown" id="radbaldown" value="1" checked>
                                                <label class="form-check-label kh16-b" for="radbaldown">ថយ</label>
                                            </td>
                                        </tr>
                                        <tr style="border-style:none;">
                                            <td class="kh16-b">បញ្ជីដៃគូ</td>
                                            <td>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radlist" id="radaffect" value="1">
                                                <label class="form-check-label kh16-b" for="radaffect">ពាក់ព័ន្ធ</label>
                                                <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radlist" id="radnotaffect" value="0" checked>
                                                <label class="form-check-label kh16-b" for="radnotaffect">មិនពាក់ព័ន្ធ</label>
                                            </td>
                                        </tr>
                                        <tr style="border-style:none;">

                                            <td colspan=2>
                                               <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="istransfer" id="istransfer">
                                                    <label class="form-check-label kh16-b" style="color:red;" for="istransfer">ជាប្រតិបត្តិការណ៏វេរដក</label>

                                                </div>

                                            </td>
                                        </tr>
                                        <tr style="border-style:none;">
                                            <td colspan=2 style="text-align:right;padding-top:20px;">
                                                <button id="btnnewtranname" class="btn btn-sm btn-info kh16" style="float:left;">សំអាត</button>
                                                <button id="btndeltranname" class="btn btn-sm btn-danger kh16" style="display:none;">លុប</button>
                                                <button id="btnsavetranname" class="btn btn-sm btn-info kh16">រក្សាទុក</button>
                                            </td>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <table id='tbl_tranname' class="table">
                            <thead class="kh16">
                                <th>No</th>
                                <th>លរ</th>
                                <th>ភ្នាក់ងារ</th>
                                <th>បរិយាយ</th>
                                <th>មេគុណ</th>
                                <th>ពេញនិយម</th>
                                <th>is_tc</th>
                                <th>សក</th>
                            </thead>
                            <tbody id="body_tranname">

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
