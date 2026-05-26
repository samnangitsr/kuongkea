<div class="modal fade" id="addagenttypemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">AGENT TYPE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="frmagenttype" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <input type="hidden" name="typeid" id="typeid">
                <input type="hidden" name="old_image" id="old_image">

                <div class="row">
                    <div class="col-lg-9">
                        <table class="table">
                            <tr>
                                <td colspan=2 style="border-style:none;" class="kh16-b">
                                    <table style="table-layout:fixed;">
                                        <td style="width:120px;"> ប្រភេទភ្នាក់ងារ</td>
                                        <td style="width:20px;">:</td>
                                        <td style="">
                                            <input id="txtitemtype" name="txtitemtype" type="text" class="form-control kh16-b" style="width:300px;">
                                        </td>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:none;" class="kh16-b">ចំនួនអាចវេរបានអតិបរិមា(USD/KHR/THB)</td>
                                <td style="border-style:none;" class="kh16-b">យកពីអតិថិជន(USD/KHR/THB)</td>
                            </tr>
                            <tr style=" background-color:lightpink">
                                <td  style="border-style:none;">
                                    <input type="text" style="" class="form-control kh16-b" name="transfer_amount" id="transfer_amount">
                                </td>
                                <td style="border-style:none;">
                                    <input type="text" style="" class="form-control kh16-b" name="customer_fee" id="customer_fee">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:none;" class="kh16-b"> កំរៃជើងសារភ្នាក់ងារវេរ(USD/KHR/THB)</td>
                                <td style="border-style:none;" class="kh16-b">កំរៃជើងសារភ្នាក់ងារដក(USD/KHR/THB)</td>
                            </tr>
                            <tr style=" background-color:lightpink">
                                <td  style="border-style:none;">
                                    <input type="text" style="" class="form-control kh16-b" name="transfer_fee" id="transfer_fee">
                                </td>
                                <td colspan=2  style="border-style:none;">
                                    <input type="text" style="" class="form-control kh16-b" name="cashdraw_fee" id="cashdraw_fee">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style:none;"><button id="btnnewagenttype" class="btn btn-primary btn-md">New</button></td>
                                <td style="border-style:none;float:right;"><input type="submit" class="btn btn-info btn-md" id="btnsaveagenttype" value="Save"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <table>
                            <tr>
                                <td>
                                    <img src="{{ config('helper.asset_path') }}/logo/angkor.png" alt="" class="student-photo" id="showPhoto" style="width:100px;height:100px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="image"  id="image" style="width:90px;" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp">
                                </td>
                            </tr>
                        </table>
                    </div>


                </div>
            </form>
          <div class="row">
            <table id="tbl_agenttype" class="table table-bordered table-hover tbl_agenttype">
              <thead style="text-align:center;">
                <th>No</th>
                <th>Name</th>
                <th>Logo</th>
                <th colspan=2>Other</th>
                <th>Action</th>
              </thead>
              <tbody id="body_mainitemtypelist">

              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
