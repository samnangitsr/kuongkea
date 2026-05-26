<div class="modal fade" id="partnerlistmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span id="mhd" class="modal-title kh16-b">ចូលបញ្ជីដៃគូ</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="tableFixHead10" style="margin:0px;padding:0px;">
                        <table id="tbl_searchthailistintransfer" class="table table-bordered table-hover tbl_searchthailistintransfer" style="table-layout:fixed;">
                            <thead style="text-align:center;">
                                <th style="width:40px;" class="kh12-b">លរ</th>
                                <th style="width:50px;" class="kh12-b">A</th>

                                <th style="width:100px;" class="kh12-b">ថ្ងៃទី</th>
                                <th style="width:80px;" class="kh12-b">ម៉ោង</th>
                                <th style="width:120px;" class="kh12-b">ប្រតិបត្តិការណ៏</th>
                                <th style="width:200px;" class="kh12-b">ឈ្មោះដៃគូ</th>
                                <th style="width:150px;" class="kh12-b">ចំនួនទឹកប្រាក់</th>
                                <th style="width:200px;" class="kh12-b">លេខអ្នកទទួល</th>
                                <th style="width:200px;" class="kh12-b">ឈ្មោះអ្នកទទួល</th>
                                <th style="width:150px;" class="kh12-b">អ្នកកត់ត្រា</th>
                                <th style="width:100px;" class="kh12-b">ID</th>
                                <th style="width:60px;" class="kh12-b">TCode</th>
                                <th style="width:60px;" class="kh12-b">មេគុណ</th>
                            </thead>
                            <tbody id="body_searchthailistintransfer">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <form id="frmtransfer" action="">
                        <input type="hidden" id="smsid" name="smsid">
                        <input type="hidden" id="mekun" name="mekun">
                        <input type="hidden" id="thai_list" name="thai_list">
                        <input type="hidden" id="location_id" name="location_id" value="6">

                        <div class="table-responsive" style="">
                            <table id="tbl_partner" class="table" style="table-layout:fixed;">

                                <tr>
                                    <td style="padding:0px;border-style:none;width:200px;">
                                        <div class="input-group" style="width:200px;">
                                            <input type="text" name="listdate" id="listdate" class="kh14-b" style="width:140px;background-color:silver;">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>

                                    </td>

                                    <td colspan=2 style="text-align:right;">
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radall" value="all" checked>
                                        <label class="form-check-label kh16-b" for="radall">ទាំងអស់</label>
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radpartner" value="PARTNER">
                                        <label class="form-check-label kh16-b" for="radpartner">ដៃគូ</label>
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radbank" value="BANK">
                                        <label class="form-check-label kh16-b" for="radbank">ធនាគា</label>
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radcustomer" value="CUSTOMER">
                                        <label class="form-check-label kh16-b" for="radcustomer">អតិថិជន</label>
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radagent" value="AGENT">
                                        <label class="form-check-label kh16-b" for="radagent">ភ្នាក់ងារ</label>
                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype" id="radnolist" value="NOLIST">
                                        <label class="form-check-label kh16-b" for="radnolist">ជំនួយ</label>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="width:150px;"><label for="selpartner" class="kh16" style="">ជ្រើសរើសដៃគូ(<span id="lblpartner" class="kh16">PARTNER</span>)</label></td>
                                    <td colspan=2>
                                        <select class="form-select select2-option kh16" name="selpartner" id="selpartner" style="width:100%">
                                            <option value=""></option>
                                            {{-- <optgroup label="ដៃគូ"> --}}
                                                @foreach ($partners as $p)
                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" userconnect="{{ $p->user_connect }}" thai_list="{{ $p->thai_list }}" countrycode="{{ $p->tel }}">{{ $p->name }}</option>
                                                @endforeach
                                            {{-- </optgroup> --}}

                                        </select>
                                    </td>
                                </tr>
                                <tr id="rowbalance1" style="background-color:whitesmoke;border:1px solid black;">
                                    <td class="kh16-b">សមតុល្យ</td>
                                    <td style="padding:0px;" colspan=2>
                                        <input type="text" id="balance1" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:red;width:49%;display:inline;" readonly>
                                        <input type="text" id="balancenext1" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:blue;width:50%;display:inline;" readonly>
                                    </td>

                                </tr>
                                <tr id="row_son">
                                    <td style=""><label for="son" class="kh16" style="">បន្តទៅកូនសាខា</label></td>
                                    <td colspan=2>
                                        <div class="input-group">
                                            <input type="text" id="son" name="son" class="form-control kh16" style="height:30px;">
                                            <input type="button" class="input-group" id="btnbrowseson" value="..." style="width:30px;border:1px solid black;">

                                        <div>
                                    </td>
                                </tr>
                                {{-- <tr id="rowitem">
                                    <td><label class="kh16">កុងធនាគា</label></td>
                                    <td colspan=2>
                                        <select class="form-select kh16" name="selitem" id="selitem" style="width:100%;height:30px;">

                                        </select>
                                    </td>
                                </tr> --}}

                                <tr>
                                    <td>
                                        <i class="fa fa-volume-control-phone"></i>
                                        <label for="sendertel" class="kh16" style="width:120px;">លេខអ្នកផ្ញើ</label>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control kh16 canenter" id="sendertel" name="sendertel" style="height:30px;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control kh16 canenter" id="sendername" name="sendername" style="height:30px;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <i class="fa fa-volume-control-phone"></i>
                                        <label for="rectel" class="kh16" style="width:120px;">លេខអ្នកទទួល</label>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control kh16 canenter" id="rectel" name="rectel" style="height:30px;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control kh16 canenter" id="recname" name="recname" style="height:30px;">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="kh16" style="">វេរចំនួន</td>
                                    <td style="" colspan=2>
                                        <div class="input-group ">

                                            <input type="text" class="form-control kh16-b canenter" id="amountlist" name="amountlist" style="text-align:right;height:30px;border:2px solid green;" autocomplete="off">
                                            <select name="selcur" id="selcur" class="input-group kh16-b" style="width:80px;" title="{{ $cur_id }}">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </td>

                                </tr>
                                <tr id="row_cuscharge">
                                    <td class="kh16">
                                        <span id="spanseva">សេវ៉ាវេរ</span>
                                        <span id="divckwater" style="float:right;">
                                            <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                            <label for="ckwater" class="form-check-label kh16">ដកទឹក</label>
                                        </span>
                                    </td>
                                    <td colspan=2>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b canenter" id="cuscharge" name="cuscharge" style="text-align:right;height:30px;" value="0">
                                            <select name="selcur1" id="selcur1" class="input-group kh16-b" style="width:80px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                </tr>
                                <tr id="row_totalcash">
                                    <td class="kh16">សរុបទឹកប្រាក់</td>
                                    <td colspan=2>
                                        <div class="input-group">
                                            <input type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="text-align:right;height:30px;" readonly>
                                            <input type="text" class="input-group kh16-b" id="txtcurtotal" style="width:80px;height:30px;" value="" readonly>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="kh16">សេវ៉ាដៃគូ</td>
                                    <td colspan=2>
                                        <div class="input-group">
                                            <input type="text" class="kh16-b canenter" id="feeps" name="feeps" style="text-align:right;height:30px;width:100px;" value="0">
                                            <input type="text" class="input-group kh16-b" value="%" style="width:30px;border:1px solid black;text-align:center;">
                                            <input type="text" class="form-control kh16-b canenter" id="fee" name="fee" style="text-align:right;height:30px;" value="0">
                                            <select name="txtcur1" id="txtcur1" class="input-group kh16-b" style="width:80px;">
                                                <option value=""></option>
                                                @foreach ($currencies as $c)
                                                    <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>

                                </tr>


                                <tr>
                                    <td colspan=3 style="padding-top:20px;">
                                        <button class="mybtn kh14-b" style="float:right;" id="btnsavelist">រក្សាទុក</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
