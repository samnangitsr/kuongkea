
<div class="modal fade" id="offercontinue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title kh22-b" id="modaltitle">
                    បន្តការស្នើរបស់បុគ្គលិក
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">
                <form action="" id="frmoffer_continue">
                    <input type="hidden" id="offer_continue_id" name="offer_continue_id">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tbl_offer_accept_modal" class="table kh22">

                                        <tr>
                                            <td id="user1">បុគ្គលិកស្នើ</td>

                                            <td>

                                                <input type="text" class="kh22" id="offerfrom" name="offerfrom" style="width:100%;" readonly>
                                            </td>

                                        </tr>

                                        <tr>
                                                <td id="user2">ស្នើទៅបុគ្គលិក</td>
                                                <td>

                                                    <input type="text" class="kh22" id="offerto" name="offerto" style="width:100%;" readonly>
                                                </td>

                                        </tr>

                                          <tr class="truser">
                                                <td>បន្តទៅបុគ្គលិក</td>
                                                <td>
                                                    <select class="kh22" name="seluser_continue" id="seluser_continue" style="width:100%;">
                                                        <option value=""></option>
                                                        @foreach ($users as $u)
                                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>


                                        </tr>





                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info kh22" id="btnupdatecontinue">Save</button>
                <button type="button" id="btnclosemodal3" class="btn btn-danger kh22" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
