<div class="modal fade" id="expansetype_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Expanse Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <form id="frmexpansetype" action="">
                <input type="hidden" id="exptype_id" name="exptype_id">
                <table class="kh16">
                    <tr>
                        <td>ប្រភេទ</td>
                        <td>
                            <select name="group_id" id="group_id">
                                <option value="-1">ចំណាយ</option>
                                <option value="1">ចំណូល</option>
                            </select>
                        </td>
                        <td style="padding-left:10px;">
                            <input type="text" id="type_name" name="type_name">
                        </td>
                        <td style="padding-left:10px;">
                            <button id='btnsavetype' class="btn btn-info btn-sm">Save</button>
                        </td>
                        <td style="padding-left:10px;">
                            <button id='btnnewtype' class="btn btn-info btn-sm">New</button>
                        </td>
                         <td style="padding-left:10px;">
                            <button id='btnrefreshtype' class="btn btn-primary btn-sm">Refresh</button>
                        </td>
                    </tr>
                </table>
            </form>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <table id="tbl_group" class="table table-bordered table-hover tbl_group" style="table-layout:fixed;">
                  <thead style="text-align:center;">
                    <th style="width:50px;">No</th>
                    <th style="width:120px;">Create Date</th>
                    <th style="width:100px;">Group</th>
                    <th style="">Description</th>
                    <th style="width:150px;">Action</th>
                  </thead>
                  <tbody id="body_group">
                    @foreach ($expansetypes as $key =>$e)
                        <tr>
                            <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
                            <td class="kh16">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
                            <td class="kh16">{{ $e->group_id==1?'ចំណូល':'ចំណាយ' }}</td>
                            <td class="kh16">{{ $e->name }}</td>
                            <td class="kh16" style="text-align:center;">
                                <a href="" class="btn btn-warning btn-sm btnedit_type" data-id="{{ $e->id }}" data-group_id="{{$e->group_id}}" data-name="{{$e->name}}"><i class="fa fa-pencil"></i></a>
                                <a href="" class="btn btn-danger btn-sm btndel_type" data-id="{{ $e->id }}"><i class="fa fa-trash"></i></a>
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
