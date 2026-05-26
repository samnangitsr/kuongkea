<div class="modal fade" id="addlandmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin-left:0;">
      <div class="modal-content" style="">
        <div class="modal-header" style="padding:10px;">
          <h5 class="modal-title">Land Register</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="margin:0px;padding-bottom:0px;">

          <div class="row">
            <form id="frmproperty" action="">
                <input type="hidden" id="landid" name="landid">
                <table id="tblfrmland" class="table">
                    <tr>
                        <td class="kh14">ប្លុក:</td>
                        <td>
                            <select name="selbloc" id="selbloc" style="width:100%;height:30px;">
                                <option value=""></option>
                                @foreach ($groups as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14">ឈ្មោះ:</td>
                        <td>
                            <input type="text" class="canenter" name="landname" id="landname" style="width:100%;height:30px;" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14">ទំហំ:</td>
                        <td>
                            <input class="kh14-b canenter" type="text" name="size" id="size" style="width:100%;height:30px;" autocomplete="off">
                            <div id="size1" contenteditable="true"></div>

                        </td>
                    </tr>
                    <tr>
                        <td class="kh14">តំលៃ:</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control kh14-b canenter" id="price" name="price" style="text-align:right;height:30px;">
                                <select name="selcur" id="selcur" class="input-group kh14-b" style="width:60px;padding-top:4px;">
                                    <option value=""></option>
                                    @foreach ($currencies as $c)
                                        <option value="{{ $c->id }}" {{ $c->shortcut=='USD'?'selected':'' }}>{{ $c->shortcut }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 class="kh14-b" style="background-color:bisque;">ព្រំដី</td>
                    </tr>
                    <tr>
                        <td class="kh14-b">ជើងទល់</td>
                        <td class="kh14-b">
                            <input type="text" class="canenter" name="north" id="north" style="width:100%;height:30px;">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b">ត្បូងទល់</td>
                        <td class="kh14-b">
                            <input type="text" class="canenter" name="south" id="south" style="width:100%;height:30px;">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b">កើតទល់</td>
                        <td class="kh14-b">
                            <input type="text" class="canenter" name="east" id="east" style="width:100%;height:30px;">
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14-b">លិចទល់</td>
                        <td class="kh14-b">
                            <input type="text" class="canenter" name="west" id="west" style="width:100%;height:30px;">
                        </td>
                    </tr>

                    <tr>
                        <td colspan=2 class="kh14-b" style="background-color:bisque;">កម្រៃជើងសារ</td>
                    </tr>
                    <tr>
                        <td class="kh14">បង់ផ្តាច់:</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control kh14-b canenter" id="com_payoff" name="com_payoff" style="text-align:right;height:30px;">
                                <input type="text" class="input-group kh14-b cur" style="width:60px;height:30px;padding-left:3px;" value="USD">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="kh14">រំលស់:</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control kh14-b canenter" id="com_payloan" name="com_payloan" style="text-align:right;height:30px;">
                                <input type="text" class="input-group kh14-b cur" style="width:60px;height:30px;padding-left:3px;" value="USD">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select class="" name="selstatus" id="selstatus" style="width:100%;height:30px;">
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Close</td>
                        <td>
                            <select class="" name="isclose" id="isclose" style="width:100%;height:30px;">
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 class="kh14">Description</td>

                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea name="desr" id="desr" style="width:100%;" class="kh16"  rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <button id="btnsaveland" class="mybtn" style="float:right;">Save</button>
                        </td>
                    </tr>
                </table>
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
