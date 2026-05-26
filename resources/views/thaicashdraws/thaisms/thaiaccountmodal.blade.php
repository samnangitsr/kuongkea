<div class="modal fade" id="thaiaccountmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thai Account Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-4">
                <form id="frmthaiaccount" action="">
                    <input type="hidden" id="acc_id" name="acc_id">
                    <table id="tbl_thaiaccount" class="kh16">
                        <tr>
                            <td style="" class="kh16">No</td>
                            <td style=""><input id="no" name="no" type="number" class="form-control kh16-b" ></td>
                        </tr>
                        <tr>
                            <td style="" class="kh16">BankName</td>
                            <td style="">
                                <select name="selbank" id="selbank" class="form-select">
                                    <option value=""></option>
                                     @foreach ($banknames as $bn)
                                        <option value="{{ $bn->name }}">{{ $bn->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="" class="kh16">Account</td>
                            <td style=""><input id="accno" name="accno" type="text" class="form-control kh16-b" ></td>
                        </tr>
                        <tr>
                            <td style="" class="kh16">FullAcc</td>
                            <td style=""><input id="fullaccno" name="fullaccno" type="text" class="form-control kh16-b" ></td>
                        </tr>
                        <tr>
                            <td style="" class="kh16">AccName</td>
                            <td style=""><input id="accname" name="accname" type="text" class="form-control kh16-b" ></td>
                        </tr>

                        <tr>
                            <td style="" class="kh16">កម្មសិទ្ធ</td>
                            <td style="">
                                <select name="showincloselist" id="showincloselist" class="form-select">
                                    <option value="1">បញ្ជីយើង</option>
                                    <option value="0">ខ្ចីបញ្ជីគេប្រើ</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn-3d" id="btnsaveaccount">Save</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-lg-8">

            </div>

          </div>
          <div class="row">
            <div class="col-lg-12">
                {{-- <table class="table table-bordered table-hover tbl_group" style="table-layout:fixed;">
                  <thead style="text-align:center;">
                    <th style="width:50px;">No</th>
                    <th style="width:100px;">Date</th>
                    <th style="width:200px;">Bloc Name</th>
                    <th style="width:100px;">Type</th>
                    <th>Address</th>
                    <th>Head Adress</th>
                    <th>Processing</th>
                    <th style="width:75px;">Action</th>
                  </thead>
                  <tbody id="body_group">
                    @foreach ($groups as $key =>$g)
                        <tr style="@if($g->status==0) background-color:pink; @endif">
                            <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
                            <td class="kh14">{{ date('d-m-Y',strtotime($g->created_at)) }}</td>
                            <td class="kh14">{{ $g->name }}</td>
                            <td class="kh14">{{ $g->type }}</td>
                            <td class="kh14">{{ $g->address }}</td>
                            <td class="kh14">{{ $g->addrhead }}</td>
                            <td class="kh14">{{ $g->isclose==0?'បើកលក់':'មិនទាន់បើកលក់' }}</td>
                            <td class="kh14" style="text-align:center;">
                                @if($g->status==1)
                                    <a href="" class="mybtn_edit btnedit_group" data-id="{{ $g->id }}" data-name="{{ $g->name }}" data-type="{{ $g->type }}" data-address="{{ $g->address }}" data-addrhead="{{ $g->addrhead }}" data-status="{{ $g->status }}" data-isclose="{{ $g->isclose }}"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="mybtn_delete btndel_group" data-id="{{ $g->id }}" data-status="{{ $g->status }}"><i class="fa fa-trash" style="color:red;"></i></a>
                                @else
                                     <a href="" class="mybtn_delete btndel_group" data-id="{{ $g->id }}" data-status="{{ $g->status }}"><i class="fa fa-repeat" style=""></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table> --}}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
