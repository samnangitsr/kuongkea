<div class="modal fade" id="modalproductrate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">កំណត់អត្រាទំនិញដូរទំនិញ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmproductrate" class="row g-3" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                              <label for="date" class="kh">កាលបរិច្ឆេទ</label>
                              <div class="input-group" style="">
                                  <input type="text" name="invdate1" id="invdate1" class="form-control" style="">
                                  <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                              <label for="selcur1" class="kh">រូបិយប័ណ្ណ</label>
                              <select name="selcur1" id="selcur1" class="form-select">
                                <option value="">Select Currency</option>
                                @foreach ($currencies->where('ispandp',0) as $c1)
                                    <option value="{{ $c1->shortcut }}">{{ $c1->shortcut }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="selcur2" class="kh">រូបិយប័ណ្ណ</label>
                            <select name="selcur2" id="selcur2" class="form-select">
                              <option value="">Select Currency</option>
                              @foreach ($currencies->where('ispandp',0) as $c2)
                                  <option value="{{ $c2->shortcut }}">{{ $c2->shortcut }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="pprate" class="kh">អត្រា</label>
                            <input type="text" name="p_rate" id="p_rate" class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <label for="ppsign" class="kh">ប្រមាណវិធី</label>
                            <select name="ppsign" id="ppsign" class="form-select" aria-label="Default select example">
                              <option value="/">/</option>
                              <option value="*">*</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" style="display:none;">ID</th>
                                            <th scope="col">Currency</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Sign</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="productlists">
                                        @foreach ($pls as $key => $item)
                                            <tr>
                                                <td style="padding:5px;">
                                                    <input type="text" value="{{ ++$key }}" class="form-control" style="border-style:none;width:80px;" readonly>

                                                </td>
                                                <td style="padding:5px;display:none;">
                                                    <input type="text" name="productid[]" value="{{ $item->id }}" class="form-control" style="border-style:none;" readonly>
                                                </td>
                                                <td style="padding:5px;">
                                                    <input type="text" name="ppshortcut[]" value="{{ $item->pshortcut }}" class="form-control" style="border-style:none;" readonly>
                                                </td>
                                                <td style="padding:5px;">
                                                    <input type="text" name="pprate[]" value="{{ $item->rate }}" class="form-control crate canenter" style="border-style:none;">
                                                </td>
                                                <td style="padding:5px;width:100px;">
                                                    <select class="form-select coperator" name="ppoperator[]">
                                                        <option value="*" {{ $item->operator=='*'?'selected':'' }}>*</option>
                                                        <option value="/" {{ $item->operator=='/'?'selected':'' }}>/</option>
                                                    </select>
                                                    {{-- <input type="text" value="{{ $item->operator }}" class="form-control" style="border-style:none;"> --}}
                                                </td>
                                                <td style="padding:5px 0px 5px 15px;">
                                                    <a href="" class="btn btn-warning btnpedit kh16" data-id="{{ $item->id }}">កែ</a>
                                                    <a href="" class="btn btn-danger btnpdel kh16" data-id="{{ $item->id }}">លុប</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary kh16" id="btnsavepp">រក្សាទុក</button>
                        <button type="button" class="btn btn-secondary me-auto" type="button" id="btnrefreshpp">Refresh</button>
                        <button type="button" class="btn btn-primary kh16" id="btnupdateall">កែប្រែអត្រា</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
