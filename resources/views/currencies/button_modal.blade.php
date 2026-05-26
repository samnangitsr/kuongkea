<div class="modal fade" id="buttonmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">កំណត់ប៊ូតុង</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmsetbutton" class="row g-3" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-3">
                        <div class="col-lg-12">
                            <label for="button_no" class="kh">លរ</label>
                            <input type="number" name="button_no" id="button_no" class="form-control">
                        </div>
                        <div class="col-lg-12">
                              <label for="selcur8" class="kh">រូបិយប័ណ្ណ</label>
                              <select name="selcur8" id="selcur8" class="form-select kh16-b">
                                <option value="">Select Currency</option>
                                @foreach ($currencies->where('ispandp',0) as $c1)
                                    <option value="{{ $c1->id }}">{{ $c1->curname }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="selcur9" class="kh">រូបិយប័ណ្ណ</label>
                            <select name="selcur9" id="selcur9" class="form-select kh16-b">
                              <option value="">Select Currency</option>
                              @foreach ($currencies->where('ispandp',0) as $c2)
                                  <option value="{{ $c2->id }}">{{ $c2->curname }}</option>
                              @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="tbl_curbutton" class="table table-bordered tbl_curbutton">
                                    <thead class="table-dark">
                                        <tr style="text-align:center;">
                                            <th scope="col">No</th>
                                            <th scope="col">NUM</th>

                                            <th scope="col">Button-ID</th>

                                            <th scope="col">Currency</th>

                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="buttonlist">
                                        @foreach ($buttonlists as $key => $item)
                                            <tr>
                                                <td class="kh16-b" style="text-align:center;">
                                                    {{ ++$key }}
                                                </td>
                                                <td class="kh16-b" style="width:80px;">
                                                    <input type="text" value="{{ $item->no }}" class="kh16-b bnum tdcanenter" style="border-style:none;width:80px;text-align:center;border:1px solid black;">
                                                </td>
                                                <td class="kh16-b" style="text-align:center;">
                                                    {{ $item->id12 }}
                                                </td>
                                                <td class="kh16-b" style="text-align:center;">
                                                    {{ $item->btnname }}
                                                </td>
                                                <td class="kh16-b" style="text-align:center;">
                                                    <a href="" class="mybtn btndelbutton" style="color:red;" data-id="{{ $item->id }}">លុប</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary kh16" id="newbutton">New Button</button>
                        <button type="button" class="btn btn-primary kh16" id="btnsavebutton">រក្សាទុក</button>
                        <button type="button" class="btn btn-secondary me-auto" type="button" id="btnrefreshbutton">Refresh</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
