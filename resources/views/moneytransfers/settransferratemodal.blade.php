<div class="modal fade" id="settransferratemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modalheader" class="modal-title kh22-b">កំណត់អត្រាវេរលុយ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmsetrate" action="">
                    <div class="row" style="margin-top:-10px;">
                        <div class="table-responsive">
                            <table class="">
                                <tr class="kh16">
                                  <th style="border-style:none;">កាលបរិច្ឆេទ</th>
                                  <th style="border-style:none;">ប្រភេទអាជីវកម្ម</th>
                                  <th style="border-style:none;">ប្រតិបត្តិការណ៏</th>
                                  <th style="border-style:none;">រូបិយប័ណ្ណ</th>
                                  <th style="border-style:none;">Apply For</th>
                                  <th style="border-style:none;">អត្រា</th>

                                </tr>
                                <tr>
                                    <td style="padding:0px;border-style:none;width:200px;">
                                        <div class="input-group" style="width:200px;">
                                            <input type="text" name="d1" id="d1" class="form-control kh16-b" style="width:150px;background-color:silver;">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>

                                    </td>
                                    <td style="border-style:none;padding:0px;">
                                       <select name="selagenttype" id="selagenttype" class="form-select kh16-b" style="width:150px;">
                                            <option value=""></option>
                                            @foreach ($agenttypes as $t)
                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                            @endforeach
                                       </select>
                                    </td>
                                    <td style="border-style:none;padding:0px;">
                                        <select multiple="multiple" class="kh16-b seltranname" name="seltranname[]" id="seltranname" style="width:500px;">

                                        </select>
                                    </td>
                                    <td>
                                        <select name="selcur" id="selcur" class="form-select kh16-b">
                                            <option value="USD">USD</option>
                                            <option value="KHR">KHR</option>
                                            <option value="THB">THB</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="applycur" id="applycur" class="form-select kh16-b">
                                            <option value=""></option>
                                            <option value="USD">USD</option>
                                            <option value="KHR">KHR</option>
                                            <option value="THB">THB</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" id="txtrate" name="txtrate" style="width:80px;" class="form-control kh16-b" value="">
                                    </td>
                                    <td style="padding:0px 0px 0px 5px;border-style:none;">
                                        <button class="btn btn-info btn-md kh16-b" id="btnaddrow">AddRow</button>
                                    </td>
                                    <td style="padding:0px 0px 0px 5px;border-style:none;">
                                        <button class="btn btn-info btn-md kh16-b" id="btnsetrate">Set Rate</button>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top:20px;">
                            <div class="table-responsive">
                                <table id="tbl_setrate" class="table table-bordered kh16">
                                    <thead class="">
                                        <th>លរ</th>
                                        <th>ទឹកប្រាក់ចាប់ពី</th>
                                        <th>រហូតដល់</th>
                                        <th>ភ្នាក់ងារវេរ</th>
                                        <th>ភ្នាក់ងារដក</th>
                                        <th>សេវ៉ាវេរ</th>
                                        <th>សកម្មភាព</th>
                                    </thead>

                                    <tbody id="bodysetrate">


                                    </tbody>
                                </table>
                            </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
