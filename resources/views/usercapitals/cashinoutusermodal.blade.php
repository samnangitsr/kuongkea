<style>
    td{
        border-style:none;
    }
</style>
<div class="modal fade" id="cashinoutusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title kh16-b" id="modaltitle">

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">
                <form action="" id="frmusercashinout">
                    {{-- <input type="hidden" id="mode" name="mode"> --}}
                    <input type="hidden" id="id1" name="id1">
                    <input type="hidden" id="id2" name="id2">
                    <input type="hidden" id="transfer_id" name="transfer_id">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tblcashinout" class="table kh16-b">
                                        <tr>
                                            <td></td>
                                            <td colspan=2 style="">
                                                <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashin" value="1" checked>
                                                <label class="form-check-label kh22-b" for="radcashin">លុយដាក់ចូល</label>
                                                <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashout" value="-1">
                                                <label style="color:red;" class="form-check-label kh22-b" for="radcashout">លុយដកចេញ</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ថ្ងៃទី</td>
                                            <td></td>
                                            <td colspan=2 style="width:280px;">
                                                <div class="input-group" style="width:280px;">
                                                    <input type="text" name="trandate1" id="trandate1" class="form-control" style="width:200px;background-color:silver;font-size:16px;" readonly>
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="user1">ដាក់ចូល</td>
                                            <td style="width:60px;">
                                                <input type="text" class="form-control kh16-b" name="sign2" id="sign2" style="text-align:center;width:60px;" value="+" readonly>
                                            </td>
                                            <td colspan=2>
                                                <select class="form-select kh16-b" name="seluser1" id="seluser1" style="width:100%;background-color:blue;color:white;">

                                                    {{-- @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                                                    @endforeach --}}

                                                    <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                                    @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" {{ Auth::id()==$u->id?'selected':'' }} @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="truser">
                                                <td id="user2">ដកចេញ</td>
                                                <td style="width:60px;">
                                                    <input type="text" class="form-control kh16-b" name="sign3" id="sign3" style="text-align:center;width:60px;" value="-" readonly>
                                                </td>
                                                <td colspan=2>
                                                    <select class="form-select kh16-b" name="seluser2" id="seluser2" style="width:100%;background-color:red;color:white;">
                                                        <option value="">please select user name</option>
                                                        @foreach ($users as $u)
                                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                        </tr>
                                        <tr class="trbank">
                                                <td class="kh16-b">
                                                   {{-- <select name="seltype" id="seltype" class="form-select kh16-b">
                                                        <option value="BANK">Bank</option>
                                                        <option value="PARTNER">Partner</option>
                                                        <option value="AGENT">Agent</option>
                                                        <option value="NOLIST">No List</option>
                                                        @if(Auth::user()->role->name=='Admin')
                                                          <option value="CUSTOMER">Customer</option>
                                                        @endif
                                                   </select> --}}
                                                   ទូទាត់តាម
                                                </td>
                                                <td style="width:60px;">
                                                    <input type="text" class="form-control kh16-b" name="sign4" id="sign4" style="text-align:center;width:60px;" value="-" readonly>
                                                </td>
                                                <td colspan=2>
                                                    <select class="form-select kh16-b" name="selbank" id="selbank" style="width:100%;">
                                                        {{-- <option value="">please select bank</option>
                                                        @foreach ($banks as $b)
                                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                        @endforeach --}}

                                                    </select>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td>ចំនួនទឹកប្រាក់</td>
                                            <td style="width:60px;">
                                                <input type="text" class="form-control kh16-b" name="sign1" id="sign1" style="text-align:center;width:60px;" value="+" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control kh16-b" name="amount1" id="amount1" style="text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </td>
                                            <td>
                                                <select class="form-select kh16-b" name="selcur1" id="selcur1" style="">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td>បរិយាយ</td>
                                          <td colspan=3>
                                              <textarea class="form-control kh16-b" rows="2" id="noteu2" name="noteu2"></textarea>
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
                <button class="btn btn-info kh12-b" id="btnsaveusercashinout">Save</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger kh12-b" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
