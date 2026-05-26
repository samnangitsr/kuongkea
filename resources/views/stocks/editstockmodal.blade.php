<div class="modal fade" id="editstockmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 id="modalheader" class="modal-title kh22-b">
                    កែស្តុក
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="frmeditstock">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered kh18">
                                        <thead style="text-align:center;background-color:silver;">
                                            <th>លរ</th>
                                            <th>លេខកូត</th>
                                            <th style="display:none;">OPsing</th>
                                            <th>រូបិយប័ណ្ណ</th>
                                            <th>ShortCut</th>


                                            <th>ចំនូននៅសល់</th>
                                            <th>អត្រា</th>
                                            <th>គិតជាលុយ</th>
                                            <th>រូបិយប័ណ្ណ</th>
                                        </thead>
                                        <tbody id="bodyeditstock">

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <table class="">
                    <tr>
                        <td class="kh22" style="border-style:none;">កាលបរិច្ឆេទ</td>
                        <td style="border-style:none;padding-right:20px;">
                            <div class="input-group" style="width:220px;">
                                <input type="text" name="savedate" id="savedate" class="form-control" style="width:160px;height:45px;background-color:silver;font-size:22px;">
                                <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                            </div>
                        </td>
                        <td style="text-align:right;border-style:none;padding-right:20px;">
                            <button type="button" id="btnclosemodal" class="btn btn-danger" style="" data-bs-dismiss="modal">Close</button>
                        </td>
                        <td style="text-align:right;border-style:none;">
                            <button class="btn btn-info" id="btnsavestockedit">Save Stock</button>
                        </td>

                    </tr>
                </table>


            </div>
        </div>
    </div>
</div>
