<div class="modal fade" id="smsnote_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span id="mhd" class="modal-title kh16-b">កំណត់សំគាល់សារថៃ</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmnote" action="">

                    <table class="table table-bordered table-hover kh16-b">
                        <tr>
                            <td>លេខកូតសារ</td>
                            <td>
                                <input type="text" class="form-control" id="txtsmsid" name="txtsmsid" readonly>
                                <input type="hidden" id="txtrowind" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>ឈ្មោះអ្នកមកបើក</td>
                            <td>
                                <input type="text" class="form-control" id="txtopname" name="txtopname">
                            </td>
                        </tr>

                        <tr>
                            <td>លេខទូរស័ព្ទ</td>
                            <td>
                                <input type="text" class="form-control" style="font-family: Arial, Helvetica, sans-serif;font-size:16px;font-weight:bold;" id="txtoptel" name="txtoptel">
                            </td>
                        </tr>
                        <tr>
                            <td>ផ្សេងៗ</td>
                            <td>
                                <textarea class="form-control" name="txtopdesr" id="txtopdesr" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2 style="text-align:right;">
                                <button class="btn btn-primary btn-md" id="btnsavenote">Save</button>
                            </td>
                        </tr>
                    </table>
                </form>


            </div>

        </div>
    </div>
</div>
