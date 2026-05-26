<div class="modal fade" id="addgroupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Property Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <form id="frmpropertygroup" action="">
                <input type="hidden" id="groupid" name="groupid">
                <table id="tbl_form_group" class="table kh16">
                    <tr>
                        <td style="" class="kh16">Bloc Name</td>
                        <td style=""><input id="groupname" name="groupname" type="text" class="form-control kh16-b" ></td>
                        <td style="" class="kh16">Type</td>
                        <td style=""><input id="grouptype" name="grouptype" type="text" class="form-control kh16-b" ></td>
                    </tr>
                     <tr>
                        <td class="kh16">Status</td>
                        <td>
                            <select class="kh16" name="group_status" id="group_status" style="width:100%;height:30px;">
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </td>
                         <td>Processing</td>
                        <td>
                            <select class="kh16" name="group_close" id="group_close" style="width:100%;height:30px;">
                                <option value="0">បើកលក់</option>
                                <option value="1">បិទទាន់បើកលក់</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="" class="kh16">Address</td>
                        <td colspan=3>
                            <textarea name="groupaddress" id="groupaddress" style="width:100%;" class="kh16"  rows="2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="" class="kh16">Address Heading</td>
                        <td colspan=3>
                            <textarea name="addrhead" id="addrhead" style="width:100%;" class="kh16"  rows="2"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4 style="text-align:right;">
                            <button id="btnrefreshgroup" class="mybtn" style="float:left;">Refresh</button>
                            <button id="btnnewgroup"  class="mybtn" style="float:left;">New Group</button>

                            <button id="btnsavegroup"  class="mybtn">Save</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <select style="float:left;" class="form-select kh16-b" name="selgroupstatus" id="selgroupstatus">
                                <option value="1">ប្លុកទូទៅ</option>
                                <option value="0">ប្លុកលុប</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover tbl_group" style="table-layout:fixed;">
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
                </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
