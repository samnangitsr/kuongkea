<div class="modal fade" id="qrcodemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" style="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modalheader_qr" class="modal-title kh30-b">QR CODE</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row" style="margin:10px;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="text-align:center;">
                                <th class="kh16-b" style="width:150px;">លុយថៃ</th>
                                <th class="kh16-b" style="width:100px;">អត្រា</th>
                                <th class="kh16-b" style="width:150px;">ចំនួនទឺកប្រាក់</th>
                                <th class="kh16-b" style="width:60px;">រូបិយ</th>
                                <th class="kh16-b">លេខគណនេយ្យ</th>

                                <th class="kh16-b" style="width:150px;">Action</th>


                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="thaiamt_qr" style="text-align:right;width:150px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="exchangerate_qr" style="width:100px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="wingamount_qr" style="text-align:right;width:150px;" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" class="form-control kh16-b" id="wingcur_qr" style="display:inline;width:60px;" readonly>

                                    </td>
                                    <td class="kh16-b"><span id="bankname_qr"></span></td>
                                    <td style="padding:0px;">
                                        <input type="button" class="btn btn-info kh16-b" value="Generate Code" id="btngeneratecode_qr" style="width:150px;">


                                        <input type="hidden" class="form-control kh16-b" id="rowind_qr" readonly>
                                        <input type="hidden" class="form-control kh16-b" id="docodeby_qr" value="{{ Auth::id() }}" readonly>
                                        <input type="hidden" class="form-control kh16-b" id="docodebyname_qr" value="{{ Auth::user()->name }}" readonly>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin:10px;">
                    <div class="form-group form-group-login">
                        <table style="margin:0 auto;">
                          <thead>
                            <tr>
                              <th style="text-align:center;">Logo</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="photo">
                                {{-- {!! Html::image('logo/nologo.jpg',null,['class'=>'student-photo','id'=>'showPhoto']) !!} --}}
                                <img src="{{ asset('public/logo/logo.jpg') }}" alt="" class="student-photo" id="showPhoto" style="width:200px;">
                                <input type="file" name="image" id="image" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp">
                              </td>
                            </tr>
                            <tr>
                              <td style="text-align:center;background:#ddd;">
                                <button type="button" name="browse_file" id="browse_file" class="btn btn-info btn-browse en" value="Browse" style="width:100%;color:blue;">Browse</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnsavecode_qr" class="btn btn-primary kh16-b" style="">Save Code</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button id="btncancelcode" class="btn btn-warning kh16-b" style="">Cancel Code</button>
            </div>
        </div>
    </div>
</div>
