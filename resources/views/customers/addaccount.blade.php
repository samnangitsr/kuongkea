<div class="modal fade" id="addaccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
          <div class="modal-header">
              <h5 id="modalheader" class="modal-title kh22-b">បង្កើតលេខគណនីដៃគូ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" id="frm_partner_account">
                <div class="row" style="">
                    <table class="table table-bordered" style="table-layout:fixed;width:100%;margin:0px;padding:0px;overflow:scroll;">
                    <tr style="text-align:center;">
                        <td class="kh16-b">លេខកូតដៃគូ</td>
                        <td class="kh16-b">ឈ្មោះដៃគូ</td>

                        <td class="kh16-b">ឈ្មោះធនាគា</td>

                        <td class="kh16-b">ទីតាំង</td>
                        <td class="kh16-b">សកម្មភាព</td>


                    </tr>
                    <tr>
                        <td style="width:100px;padding:0px;">
                        <input type="text" id="acc_partner_id" name="acc_partner_id" class="form-control kh22" readonly>
                        </td>
                        <td style="width:100px;padding:0px;">
                        <input type="text" id="acc_partner_name" name="acc_partner_name" class="form-control kh22" readonly>
                        </td>
                        <td style="width:100px;padding:0px;">
                        {{-- <input type="text" id="item" name="item" class="form-control kh22" list="itemlist"> --}}
                        <div class="input-group mb-3">
                            <select name="selitem" id="selitem" class="form-select kh22"></select>

                        </div>


                        </td>

                        <datalist id="locationlist">
                        <option value="HTML">
                        <option value="CSS">
                        <option value="JavaScript">
                        <option value="Bootstrap">
                    </datalist>
                        <td style="width:100px;padding:0px;">
                        <input type="text" id="location" name="location" class="form-control kh22" list="locationlist">
                        </td>
                        <td colspan=2 style="padding:0px;">
                        <button id="btnsave_account" class="btn btn-info kh22">រក្សាទុក</button>
                        <button id="btnnew_account" class="btn btn-info kh22">សំអាត</button>

                        <input type="hidden" id="account_id" name="account_id">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 class="kh22" style="text-align:center;background-color:rgb(197, 238, 170)">ប្រាក់រៀល</td>
                        <td colspan=2 class="kh22" style="text-align:center;background-color:rgb(234, 235, 177)">ប្រាក់ដុល្លា</td>
                        <td colspan=2 class="kh22" style="text-align:center;background-color:rgb(189, 236, 222)">ប្រាក់បាត</td>

                    </tr>
                    <tr>

                        <td style="width:200px;background-color:rgb(197, 238, 170);text-align:center;" class="kh16-b">ឈ្មោះគណនី</td>
                        <td style="width:200px;background-color:rgb(197, 238, 170);text-align:center;" class="kh16-b">លេខគណនី</td>
                        <td style="width:200px;background-color:rgb(234, 235, 177);text-align:center;" class="kh16-b">ឈ្មោះគណនី</td>
                        <td style="width:200px;background-color:rgb(234, 235, 177);text-align:center;" class="kh16-b">លេខគណនី</td>
                        <td style="width:200px;background-color:rgb(189, 236, 222);text-align:center;" class="kh16-b">ឈ្មោះគណនី</td>
                        <td style="width:200px;background-color:rgb(189, 236, 222);text-align:center;" class="kh16-b">លេខគណនី</td>
                    </tr>
                    <tr>
                        <td style="width:200px;background-color:rgb(197, 238, 170);padding:0px;">
                        <input style="background-color:rgb(197, 238, 170)" type="text" id="ac_name_r" name="ac_name_r" class="form-control kh22">
                        </td>
                        <td style="width:200px;background-color:rgb(197, 238, 170);padding:0px;">
                        <input style="background-color:rgb(197, 238, 170)" type="text" id="ac_r" name="ac_r" class="form-control kh22">
                        </td>
                        <td style="width:200px;background-color:rgb(234, 235, 177);padding:0px;">
                        <input style="background-color:rgb(234, 235, 177)" type="text" id="ac_name_d" name="ac_name_d" class="form-control kh22">
                        </td>
                        <td style="width:200px;background-color:rgb(234, 235, 177);padding:0px;">
                        <input style="background-color:rgb(234, 235, 177)" type="text" id="ac_d" name="ac_d" class="form-control kh22">
                        </td>
                        <td style="width:200px;background-color:rgb(189, 236, 222);padding:0px;">
                        <input style="background-color:rgb(189, 236, 222)" type="text" id="ac_name_b" name="ac_name_b" class="form-control kh22">
                        </td>
                        <td style="width:200px;background-color:rgb(189, 236, 222);padding:0px;">
                        <input style="background-color:rgb(189, 236, 222)" type="text" id="ac_b" name="ac_b" class="form-control kh22">
                        </td>

                    </tr>
                    <tr>

                    </tr>
                    </table>
                </div>
                <div class="row">
                    <table id="tbl_partner_account" class="table table-bordered tbl_partner_account">
                    <tr class="kh16" style="text-align:center;">
                        <td rowspan=2>លរ</td>
                        <td rowspan=2>ឈ្មោះដៃគូ</td>
                        <td rowspan=2>ឈ្មោះធនាគា</td>
                        <td rowspan=2>ទីតាំង</td>
                        <td colspan=2>ប្រាក់រៀល</td>
                        <td colspan=2>ប្រាក់ដុល្លា</td>
                        <td colspan=2>ប្រាក់បាត</td>
                        <td rowspan=2>ចុះឈ្មោះដោយ</td>
                        <td rowspan=2>ថ្ងៃចុះឈ្មោះ</td>
                        <td rowspan=2>សកម្មភាព</td>
                    </tr>
                    <tr class="kh16" style="text-align:center;">
                        <td>ឈ្មោះគណនេយ្យ</td>
                        <td>លេខគណនេយ្យ</td>
                        <td>ឈ្មោះគណនេយ្យ</td>
                        <td>លេខគណនេយ្យ</td>
                        <td>ឈ្មោះគណនេយ្យ</td>
                        <td>លេខគណនេយ្យ</td>

                    </tr>
                    <tbody id="body_account">

                    </tbody>
                    </table>
                </div>
            </form>
          </div>

      </div>
  </div>
</div>
