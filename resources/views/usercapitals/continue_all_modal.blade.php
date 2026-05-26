<div class="modal fade" id="continue_all_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">
                    បន្តថ្ងៃស្អែកបុគ្គលិកទាំងអស់
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmcontinuealluser" method="POST" action="/submit-selected-users">
                    <table>
                        <thead class="kh16" style="background-color:aqua" id="headermymoney"></thead>
                        <tbody id="bodycontinueall"></tbody>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                 <button class="mybtn kh16-b" style="padding:5px;width:100px;" id="btnsavecontinueall">Save</button>
                  <button class="mybtn kh16-b" style="color:red;padding:5px;width:100px;" id="btndeletecontinueall">Delete</button>
                <button type="button" class="mybtn kh16-b" style="padding:5px;width:60px;" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
