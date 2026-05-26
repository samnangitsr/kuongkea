<!-- Modal -->

  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="create_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:10000;">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id="h4modal">Add User</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger print-error-msg" style="display:none">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <ul></ul>
                </div>
                <form action="" method="POST" id="frm_add_user" enctype="multipart/form-data" autocomplete="off">
                  {{ csrf_field() }}
                    <input type="hidden" id="userid" name="userid">
                    <label for="company">Work For</label>
                    <select name="company" id="company" class="form-select kh16-b">
                        <option value="">All Company</option>
                        @foreach ($companies as $comp)
                            <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                        @endforeach
                    </select>
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" class="form-control" required>
                      <label for="loginname">Login Name</label>
                      <input type="text" name="username" id="username" class="form-control"  required>
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                      <label for="role">Role</label>
                      <select name="role" id="role" class="form-select">
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>

                      <label for="password">Password</label>
                      <input type="password" id="password" class="form-control" required="" name="password">
                      <label for="password">Confirm Password</label>
                      <input type="password" id="password-confirm" class="form-control" required="" name="password_confirmation">
                      <label for="active">Active</label>
                      <select name="active" id="active" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Disactive</option>
                      </select>
                      <label for="active">Connect to Account</label>
                      <select multiple="multiple" class="kh16 selcustomerconnect" name="selcustomerconnect[]" id="selcustomerconnect" style="width:100%;">
                        @foreach ($customers as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                     <label for="active">Connect to Property Group</label>
                      <select multiple="multiple" class="kh16 selpropertygroup" name="selpropertygroup[]" id="selpropertygroup" style="width:100%;">
                        @foreach ($pgroups as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </form>
              </div>
            </div>

        </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-default" data-bs-dismiss="modal" id="closemodalsave">Close</button>
              <button class="btn btn-primary" id="btnsubmit">Save</button>
          </div>
      </div>

    </div>
  </div>
