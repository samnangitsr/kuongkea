<style>
    td{
        border-style:none;
    }
</style>
<div class="modal fade" id="transferinoutusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <h5 class="modal-title kh16-b" id="modaltitle3">
                    បាញ់ចេញបាញ់ចូល
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">
                <form action="" id="frmusercashinout3">

                    <input type="hidden" id="id3" name="id3">
                    <input type="hidden" id="id4" name="id4">
                    <input type="hidden" id="id5" name="id5">
                    <input type="hidden" id="id6" name="id6">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table kh16-b" id="tbltransferinout">
                                        <tr>
                                            <td></td>
                                            <td colspan=2 style="">
                                                <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout3" id="radcashin3" value="1" checked>
                                                <label class="form-check-label kh22-b" for="radcashin3">លុយបាញ់ចូល</label>
                                                <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout3" id="radcashout3" value="-1">
                                                <label style="color:red;" class="form-check-label kh22-b" for="radcashout3">លុយបាញ់ចេញ</label>
                                            </td>
                                            <td class="kh22-b">ក្រុមហ៊ុន</td>
                                        </tr>
                                        <tr>
                                            <td>ថ្ងៃទី</td>
                                            <td></td>
                                            <td style="width:280px;">
                                                <div class="input-group" style="width:280px;">
                                                    <input type="text" name="trandate3" id="trandate3" class="form-control kh16-b" style="width:200px;height:35px;background-color:silver;" readonly>
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                             <td style="padding:0px;border-style:none;">
                                                <select name="selcompany2" id="selcompany2" class="form-select kh16-b" style="width:100%;">
                                                    {{-- <option value="all">All Company</option> --}}
                                                    @foreach ($companies as $comp)
                                                        <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}} @if(Auth::user()->role->name!='Admin' && $comp->id!=$selcomid) disabled @endif>{{ $comp->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top:20px;">ចំនួនទឹកប្រាក់</td>
                                            <td style="width:60px;padding-top:20px;">
                                                <input type="hidden" class="form-control kh16-b" name="amtsign33" id="amtsign33" style="height:35px;text-align:center;width:60px;" value="+" readonly >
                                            </td>
                                            <td style="padding-top:20px;">
                                                <input type="text" class="form-control kh16-b" autocomplete="off" name="amount33" id="amount33" style="height:35px;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </td>
                                            <td style="padding-top:20px;">
                                                <select class="form-select kh16-b" name="selcur33" id="selcur33" style="height:35px;;">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}" isgold="{{$cur->isgold}}" tuochek="{{$cur->tuochek}}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="row_water33" style="display:none;">
                                            <td>ទឹកមាស</td>
                                            <td></td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16-b canenter" name="goldwater33" id="goldwater33" style="background-color:gold;">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan=4><br></td>
                                        </tr>
                                        <tr>
                                            <td id="user33">អ្នកទទួល</td>
                                            <td style="width:60px;">
                                                <input type="text" class="form-control kh16-b" name="sign33" id="sign33" style="height:35px;text-align:center;width:60px;" value="+" readonly>
                                            </td>
                                            <td colspan=2>
                                                <select class="kh16-b" name="seluser33" id="seluser33" style="width:100%;height:35px;background-color:blue;color:white;">

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

                                        <tr class="">
                                                {{-- <td style="" id="userlist33"></td> --}}
                                                <td></td>
                                                <td style="width:60px;">
                                                    <input type="hidden" class="form-control kh16-b" name="signlist33" id="signlist33" style="height:35px;text-align:center;width:60px;" value="+" readonly>
                                                </td>
                                                <td colspan=2>
                                                    <select class="kh22" name="sellist33" id="sellist33" style="width:100%;height:35px;">
                                                        {{-- <option value="">please select bank</option>
                                                        @foreach ($banks as $b)
                                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                        @endforeach --}}

                                                    </select>
                                                </td>
                                        </tr>
                                        <tr id="rowbal1" style="background-color:aquamarine;display:none;">
                                            <td colspan=2 class="kh16-b">សមតុល្យ</td>
                                            <td colspan=2>
                                                <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:aquamarine;text-align:right;color:blue;">
                                                <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:aquamarine;text-align:right;color:red;">
                                            </td>

                                        </tr>
                                        <tr style="">
                                            <td style="padding-top:20px;" id="userout33">អ្នកប្រគល់</td>
                                            <td style="width:60px;padding-top:20px;">
                                                <input type="text" class="form-control kh16-b" name="signout33" id="signout33" style="height:35px;text-align:center;width:60px;" value="-" readonly>
                                            </td>
                                            <td style="padding-top:20px;" colspan=2>
                                                <select class="kh16-b" name="seluserout33" id="seluserout33" style="width:100%;height:35px;background-color:red;color:white;">

                                                    {{-- @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" @if($u->id==Auth::id()) selected @endif>{{ $u->name }}</option>
                                                    @endforeach --}}

                                                    {{-- <option value="" {{ Auth::user()->role->name!='Admin'?'disabled':'' }}></option>
                                                    @foreach ($users as $u)
                                                        <option value="{{ $u->id }}" @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                                    @endforeach --}}

                                                    <option value=""></option>
                                                    @foreach ($users as $u)
                                                        {{-- <option value="{{ $u->id }}" @if(Auth::id()==$u->id) disabled @endif>{{ $u->name }}</option> --}}
                                                        <option value="{{ $u->id }}" @if(Auth::user()->role->name!='Admin' && Auth::id()!=$u->id) disabled @endif>{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr class="">

                                                <td>
                                                   {{-- <select name="seltype44" id="seltype44" class="form-select kh16-b" style="height:35px;">
                                                        <option value="BANK">Bank</option>
                                                        <option value="PARTNER">Partner</option>
                                                        <option value="AGENT">Agent</option>
                                                        <option value="NOLIST">No List</option>
                                                        @if(Auth::user()->role->name=='Admin')
                                                          <option value="CUSTOMER">Customer</option>
                                                        @endif
                                                   </select> --}}
                                                </td>
                                                <td style="width:60px;">
                                                    <input type="hidden" class="form-control kh16-b" name="sign44" id="sign44" style="height:35px;text-align:center;width:60px;" value="-" readonly>
                                                </td>
                                                <td colspan=2>
                                                    <select class="form-select kh16-b" name="selbank44" id="selbank44" style="width:100%;height:35px;">
                                                        {{-- <option value="">please select bank</option>
                                                        @foreach ($banks as $b)
                                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                        @endforeach --}}

                                                    </select>
                                                </td>
                                        </tr>
                                        <tr id="rowbal2" style="background-color:aquamarine;display:none;">
                                            <td colspan=2 class="kh16-b">សមតុល្យ</td>
                                            <td colspan=2>
                                                <input type="text" id="balance2" class="form-control kh16-b" style="border-style:none;background-color:aquamarine;text-align:right;color:blue;">
                                                <input type="text" id="balancenext2" class="form-control kh16-b" style="border-style:none;background-color:aquamarine;text-align:right;color:red;">
                                            </td>

                                        </tr>

                                        {{-- <tr>
                                            <td>លេខគណនី</td>
                                            <td colspan=3>
                                                <input type="text" class="form-control" style="height:35px;" id="txtaccountnumber44" name="txtaccountnumber44" autocomplete="off">
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>ឈ្មោះគណនី</td>
                                            <td colspan=3>
                                                <input type="text" class="form-control" style="height:35px;" id="txtaccountname44" name="txtaccountname44" autocomplete="off">
                                            </td>
                                        </tr> --}}
                                        <tr>
                                          <td>បរិយាយ</td>
                                          <td colspan=3>
                                              <textarea class="form-control kh16-b" rows="2" id="note33" name="note33"></textarea>
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
                <button class="btn btn-info btn-sm kh16-b" id="btnsaveusertransferinout">Save</button>
                <button type="button" id="btnclosemodal33" class="btn btn-danger btn-sm kh16-b" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
