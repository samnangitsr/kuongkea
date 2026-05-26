<!-- Modal -->
  <div class="modal" id="changepwd_modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="" id="frmchangepwd">
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="is_remotepwd" id="is_remotepwd">

                <label for="newpwd">New Password</label>
                <input type="password" name="newpassword" id="newpassword" class="form-control">
                <label for="confnewpwd">Confirm Password</label>
                <input type="password" name="newpassword-confirm" id="newpassword-confirm" class="form-control">
              </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btncancelresetpwd">Close</button>
          <button type="button" class="btn btn-primary" id="btnresetpwd">Save new password</button>

        </div>

      </div>
    </div>
  </div>
