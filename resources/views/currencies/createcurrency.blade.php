<div class="modal fade" id="modalcurrency" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="modalheader" class="modal-title kh16-b">បង្កើតរូបិយប័ណ្ណ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="frmcurrency" class="row g-3" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="row">
                            <div class="form-group">
                              <label for="date" class="kh">កាលបរិច្ឆេទ</label>
                              <div class="input-group" style="">
                                  <input type="text" name="invdate" id="invdate" class="form-control" style="">
                                  <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                              <label for="no" class="kh">លរ</label>
                              <input type="number" name="no" id="no" class="form-control">
                            </div>
                            <div class="col-lg-8">
                              <label for="curname">រូបិយប័ណ្ណ</label>
                              <input type="text" name="curname" id="curname" class="form-control kh16">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <label for="skey" class="kh">ក្តាចុច</label>
                            <input type="text" name="skey" id="skey" class="form-control">
                          </div>
                          <div class="col-lg-4">
                            <label for="shortcut">អក្សរកាត់</label>
                            <input type="text" name="shortcut" id="shortcut" class="form-control">
                          </div>
                          <div class="col-lg-4">
                            <label for="shortcut">មួយអក្សរ</label>
                            <input type="text" name="shortcut1" id="shortcut1" class="form-control">
                          </div>
                      </div>
                      <div class="row mt-1">
                        <div class="col-lg-4">

                              <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="ismaincur" name="ismaincur">
                                <label class="form-check-label" for="ismaincur">រូបិយគោល</label>
                              </div>

                        </div>
                        <div class="col-lg-4">
                          <div class="row">
                            <div class="form-check-danger form-check form-switch">
                              <input class="form-check-input" type="checkbox" name="isfn" id="isfn">
                              <label class="form-check-label" for="isfn">រូបិយបរទេស</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                              <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isactive" name="isactive" checked="">
                                <label class="form-check-label" for="isactive">Active</label>
                              </div>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="">
                              <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isgold" name="isgold">
                                <label class="form-check-label" for="isgold">Gold</label>
                              </div>
                            </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="row">
                          <div class="col-lg-4">
                            <label for="optsign" class="kh">ប្រមាណវិធី</label>
                            <select name="optsign" id="optsign" class="form-select" aria-label="Default select example">
                              <option value="/">/</option>
                              <option value="*">*</option>
                            </select>
                          </div>
                          <div class="col-lg-4">
                            <label for="ratio">ផលធៀប</label>
                            <input type="text" name="ratio" id="ratio" class="form-control">
                          </div>
                          <div class="col-lg-4">
                            <label for="tuechek">តួចែកមាស</label>
                            <input type="text" name="tuochek" id="tuochek" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="buy" class="kh">ទិញ</label>
                            <input type="text" name="buy" id="buy" class="form-control">
                          </div>
                          <div class="col-lg-6">
                            <label for="sale">លក់</label>
                            <input type="text" name="sale" id="sale" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <label for="ratebuy" class="kh">អត្រាទិញ</label>
                            <input type="text" name="ratebuy" id="ratebuy" class="form-control">
                          </div>
                          <div class="col-lg-6">
                            <label for="ratesale">អត្រាលក់</label>
                            <input type="text" name="ratesale" id="ratesale" class="form-control">
                          </div>
                      </div>

                        <div class="row" style="margin-top:5px;">
                          <div class="col-lg-12">
                            <div class="form-check-danger form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="ispandp" name="ispandp">
                              <label class="form-check-label" for="ispandp">Product Exchange Product</label>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                          <div class="col-lg-6">
                            <div class="form-check-danger form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="ispartnercurrency" name="ispartnercurrency">
                              <label class="form-check-label" for="ispartnercurrency">Partner Currency</label>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-check-danger form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="iscustomerdisplay" name="iscustomerdisplay">
                              <label class="form-check-label" for="iscustomerdisplay">Customer Display</label>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group form-group-login">
                            <table style="margin:0 auto;">
                              <thead>
                                <tr class="info">
                                  <th class="student-id">ID:<input type="text" name="curid" id="curid" readonly style="text-align:center;"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="photo">

                                    <canvas id="canvas"></canvas>

                                    <img src="{{ config('helper.asset_path')}}/logo/NoPicture.jpg" alt="" class="student-photo" id="showPhoto">
                                    <input type="file" name="image" id="image" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp">
                                    <input type="hidden" name="valphotocapture" id="valphotocapture" value="">
                                    <input type="hidden" name="clickcapture" id="clickcapture" value="0">
                                    <input type="hidden" name="old_image" id="old_image">
                                  </td>
                                </tr>

                                <tr>
                                  <td >
                                    <button type="button" name="browse_file" id="browse_file" class="btn btn-info " value="Browse" style="width:100%;">Browse</button>
                                    <button type="button" name="capture" id="capture" class="btn btn-primary " value="Capture" style="width:100%;">Photo</button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-lg-4">
                      <fieldset>
                        <legend>Display Rate Show Location</legend>
                        <table class="table">
                          <tr>
                            <td style="padding:0px 0px 10px 0px;">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="lmr" id="loc_left" value="l" checked>
                                <label class="form-check-label" for="loc_left">Left</label>
                              </div>
                            </td>
                            <td style="padding:0px 0px 10px 0px;">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="lmr" id="loc_middle" value="m">
                                <label class="form-check-label" for="loc_middle">Middle</label>
                              </div>
                            </td>
                            <td style="padding:0px 0px 10px 0px;">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="lmr" id="loc_right" value="r">
                                <label class="form-check-label" for="loc_right">Right</label>
                              </div>
                            </td>
                          </tr>
                        </table>
                       </fieldset>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="row">
                          <div class="col-lg-4">
                            <label for="circleleft" class="kh" style="margin-bottom:10px;">ទីតាំងខាងឆ្វេងរូប</label>
                            <input type="text" class="form-control" id="circleleft" name="circleleft">
                          </div>
                          <div class="col-lg-4">
                            <label for="decpoint" style="margin-bottom:10px;">ក្រោយក្បៀស</label>
                            <input type="number" class="form-control" id="decpoint" name="decpoint" value="0">
                          </div>
                           <div class="col-lg-4">
                            <label for="lomeang" style="margin-bottom:10px;">ចាប់លំអៀង</label>
                            <input type="text" class="form-control" id="lomeang" name="lomeang" value="0">
                          </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4" style="background-color:aqua">
                        <div class="circular--landscape" style="margin-left:120px;">
                          <img id="imgcircle" class="circular--landscape-img"  src="{{ config('helper.asset_path') }}/logo/usd.png" />
                        </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top:-20px;">
                    <div class="col-lg-12">
                        <label for="decpoint" style="margin-bottom:10px;">មិនផ្តល់អោយបុគ្គលិក</label>
                        <select multiple="multiple" class="kh22 seluserconnect" name="seluserconnect[]" id="seluserconnect" style="width:100%;">
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                <div class="row" style="">
                    <div class="col-lg-12">
                        <label for="company" style="margin-bottom:10px;">ឈ្មោះក្រុមហ៊ុន</label>
                        <select name="company" id="company" class="form-select kh16-b">
                            @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}" {{$selcomid==$comp->id?'selected':''}}>{{ $comp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary me-auto" type="button" id="btnrefreshcustomer">Refresh</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary kh16" id="btnsave">រក្សាទុក</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
