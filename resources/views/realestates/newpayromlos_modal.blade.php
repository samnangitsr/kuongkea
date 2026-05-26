<div class="modal fade" id="newpayromlos_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Pay</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form id="frmnewpayment" action="">
          <div class="row">
                <input type="hidden" id="newpayid" name="newpayid">
                <input type="hidden" id="txtstatus" name="txtstatus" value="1">

                <div class="col-lg-6">
                    <table id="tbl_newpay" class="table kh16">
                    <tr>
                        <td style="" class="kh16">កាលបរិច្ឆេទ</td>
                        <td style="">
                            <input type="text"  id="dd" name="dd" class="form-control kh16-b" style="background-color:white;margin-top:0px;" readonly>
                        </td>
                        <td style="">

                        </td>
                    </tr>
                    <tr>
                        <td style="" class="kh16">គិតពី</td>
                        <td style="">
                            <input type="text"  id="d1" name="d1" class="form-control kh16-b" style="background-color:white;margin-top:0px;" readonly>
                        </td>
                        <td style="">

                        </td>
                    </tr>
                    <tr>
                        <td style="" class="kh16">រហូតដល់</td>
                        <td style="">
                            <input type="text"  id="d2" name="d2" class="form-control kh16-b" style="background-color:white;margin-top:0px;" readonly>
                        </td>
                        <td style="">

                        </td>
                    </tr>

                    <tr>
                        <td>បង់ចំនួន</td>
                        <td>
                            <input type="text" class="form-control kh16-b" style="text-align:right;" id="payamtnew" name="payamtnew">
                        </td>
                        <td>
                            <select class="form-select" name="selcur_paynew" id="selcur_paynew">
                                <option value=""></option>
                                @foreach ($currencies as $c)
                                    <option value="{{$c->id}}">{{ $c->shortcut }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                     <tr>
                            <td style="" class="kh16">Note</td>
                            <td colspan=2>
                                <textarea name="note_newpay" id="note_newpay" style="width:100%;" class="kh16"  rows="2"></textarea>
                            </td>
                        </tr>
                    <tr>
                        <td colspan=4 style="">
                             <div class="dropdown" style="display:inline">
                                  <button type="button" class="mybtn dropdown-toggle kh16" data-bs-toggle="dropdown">
                                    Refresh
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li id="li_data"><a class="dropdown-item kh16-b refresh_list" data-status=1 href="#">ទិន្ន័យ</a></li>
                                       <li id="li_data_del"><a class="dropdown-item kh16-b refresh_list" data-status=0 href="#">ទិន្ន័យបានលុប</a></li>
                                       <li id="li_both"><a class="dropdown-item kh16-b refresh_list" data-status=2 href="#">ទិន្ន័យទាំងពីរ</a></li>
                                  </ul>

                                </div>

                            <button id="btnnewpay"  class="mybtn" style="padding-left:5px;width:100px;">New</button>
                            <button id="btnsavenewpay" style="padding-left:5px;width:100px;"  class="mybtn">Save</button>
                        </td>
                    </tr>

                </table>
                <!-- Example split danger button -->

                </div>
                <div class="col-lg-6">
                    <table class="table kh16">
                        <tr>
                            <td>ID</td>
                            <td><input type="text" class="form-control" id="saleid_newpay" name="saleid_newpay" readonly></td>
                            <td colspan=2>
                                <button id="btnupdateterm" class="btn btn-warning btn-sm">Update Term</button>
                            </td>
                        </tr>
                        <tr>

                            <td>ល្វែង</td>
                            <td colspan=3><input type="text" class="form-control" id="property_newpay" name="property_newpay" readonly></td>
                        </tr>
                        <tr>
                            <td>បង់ប្រចាំខែ</td>
                            <td><input type="text" class="form-control kh16-b" style="text-align:right;" id="payinmonth_newpay" name="payinmonth_newpay" readonly></td>
                            <td>រយះពេល</td>
                            <td>
                                 <div class="input-group">
                                    <input type="number" class="form-control kh16-b" id="term_newpay" name="term_newpay">
                                     <input type="text" class="input-group kh16-b" id="" name="" value="ខែ" style="width:50px;border:1px solid gray;text-align:center;" readonly>

                                </div>

                            </td>

                        </tr>
                        <tr>
                            <td>គិតពី</td>
                            <td><input type="text" class="form-control" id="start_date_newpay" name="start_date_newpay" readonly></td>
                             <td>ដល់</td>
                            <td><input type="text" class="form-control" id="end_date_newpay" name="end_date_newpay" readonly></td>
                        </tr>
                        <tr>
                            <td>ខែបន្ទាប់</td>
                            <td><input type="text" class="form-control" id="nextpayment_newpay" name="nextpayment_newpay" readonly></td>
                        </tr>




                    </table>
                </div>

            </div>
        </form>

          <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover tbl_newpay_list" style="table-layout:fixed;">
                  <thead style="text-align:center;">
                    <th style="width:50px;">No</th>

                    <th style="width:120px;">Start Date</th>
                    <th style="width:120px;">End Date</th>
                    <th style="width:120px;">Payment</th>
                    <th>Note</th>
                    <th style="width:100px;">Save Date</th>
                    <th style="width:100px;">Saveby</th>
                    <th style="width:100px;">Action</th>
                  </thead>
                  <tbody id="body_newpay">
                    {{-- @foreach ($newpay as $key =>$g)
                        <tr>
                            <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
                            <td class="kh14">{{ date('d-m-Y',strtotime($g->dd)) }}</td>
                            <td class="kh14">{{ $g->amount }}</td>
                            <td class="kh14">{{ $g->start_date }}</td>
                            <td class="kh14">{{ $g->end_date }}</td>
                            <td class="kh14">{{ $g->note }}</td>

                            <td class="kh14" style="text-align:center;">

                                    <a href="" class="mybtn_edit btnedit_newpay" data-id="{{ $g->id }}" data-amount="{{ $g->amount }}" data-start_date="{{ $g->start_date }}" data-end_date="{{ $g->end_date }}" data-note="{{ $g->note }}"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="mybtn_delete btndel_newpay" data-id="{{ $g->id }}"><i class="fa fa-trash" style="color:red;"></i></a>

                            </td>
                        </tr>
                    @endforeach --}}
                  </tbody>
                </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
