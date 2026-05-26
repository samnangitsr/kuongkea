<div class="modal fade" id="addsmsmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="1200" aria-hidden="true" style="">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="padding:0px 15px 0px 15px;">
                <p id="modalheader" class="modal-title kh30-b">បញ្ជូលសារ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding:10px;">
                <form id="frmaddsms" action="">
                    <input type="hidden" name="sms_id" id="sms_id">
                    <div class="row">
                        <div class="col-lg-4">
                            <table class="table" id="tbl_addsms" style="table-layout:fixed; tbl_addsms">
                                <tr>
                                    <td class="kh14-b" style="width:120px;border-style:none;">
                                        កាលបរិច្ឆេទ
                                    </td>
                                    <td style="">
                                        <div class="input-group" style="">
                                            <input type="text" name="smsdate" id="smsdate" class="kh16-b form-control" style="background-color:silver;height:30px;">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>

                                    </td>

                                </tr>
                                <tr>
                                    <td class="kh14-b">
                                        អ្នកកត់ត្រា
                                    </td>
                                    <td>
                                        <select name="seluserrecord" id="seluserrecord" class="kh14-b" style="height:30px;width:100%;">
                                            <option value="">All</option>
                                            @foreach ($users as $u)
                                                @if (!is_null($u->id))
                                                    <option value="{{ $u->id }}"
                                                        @if ($u->id == Auth::id()) selected @endif>
                                                        {{ $u->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh14-b">
                                        ប្រភេទធនាគា
                                    </td>
                                    <td>
                                        <select name="selbankname" id="selbankname" class="" style="font-family:Arial, Helvetica, sans-serif,font-size:14px;font-weight:bold;height:30px;width:100%;">
                                            <option value="">All</option>
                                            @foreach ($banknames as $bn)
                                                <option value="{{ $bn->name }}">{{ $bn->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                 <tr>
                                    <td colspan=2 style="">
                                        <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashin" value="1" checked>
                                        <label class="form-check-label kh22-b" for="radcashin">លុយដាក់ចូល</label>
                                        <input class="form-check-input" style="margin-top:10px;font-size:16px;" type="radio" name="radinout" id="radcashout" value="-1">
                                        <label style="color:red;" class="form-check-label kh22-b" for="radcashout">លុយដកចេញ</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh14-b">
                                        លេខបញ្ជី
                                    </td>
                                    <td>
                                        <select name="selacclist" id="selacclist" class="form-select" style="font-family:Arial, Helvetica, sans-serif,font-size:14px;font-weight:bold;height:30px;">
                                            <option value=""></option>
                                            @foreach ($thai_acc as $ac)
                                                <option value="{{ $ac->accno }}" bankname="{{ $ac->bankname }}">{{ $ac->accno }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="kh14-b">ចំនួនទឹកប្រាក់</td>

                                    <td style="">
                                        <div class="input-group">
                                            <input type="text" class="kh16-b canenter form-control" id="amount" name="amount" style="text-align:right;height:30px;color:blue;" autocomplete="off">
                                            <input type="text" class="input-group kh16-b" id="txtcur" style="width:60px;height:30px;text-align:center;color:blue;border:1px solid grey" value="THB" readonly>
                                        </div>

                                    </td>

                                </tr>
                                <tr>
                                    <td class="kh14-b">
                                        ម៉ោងសារចូល
                                    </td>
                                    <td>
                                        <input type="text" class="kh16-b canenter form-control" id="smstime" name="smstime" style="text-align:right;height:30px;">

                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh14-b">សមតុល្យតាមសារ</td>

                                    <td style="">
                                        <div class="input-group">
                                            <input type="text" class="kh16-b canenter form-control" id="balance" name="balance" style="text-align:right;height:30px;">
                                            <input type="text" class="input-group kh16-b" id="txtcur2" style="width:60px;height:30px;text-align:center;border:1px solid grey;" value="THB" readonly>
                                        </div>

                                    </td>

                                </tr>
                                 <tr>
                                    <td class="kh14-b">
                                        អតិថិជន
                                    </td>
                                    <td>
                                        <select name="selthaicus" id="selthaicus" class="form-select kh16-b" style="font-family:Arial, Helvetica, sans-serif,font-size:14px;font-weight:bold;height:30px;">
                                            <option value=""></option>
                                            @foreach ($thaicus as $c)

                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh14-b">កំណត់សំគាល់</td>
                                    <td>
                                        <textarea class="form-control kh12-b" rows="5" id="smsnote" name="smsnote"></textarea>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="kh14-b">ទំរង់សារ</td>
                                    <td>
                                        <textarea class="form-control kh12-b" rows="5" id="smstext" name="smstext" readonly></textarea>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan=2 style="text-align:right;">
                                        <button id="btnnew" class="mybtn" style="font-weight:bold;float:left;background-color:rgb(229, 231, 219);">New</button>
                                        <button id="btnsavesms" class="mybtn" style="font-weight:bold;background-color:skyblue">Save</button>
                                    </td>
                                </tr>

                            </table>

                        </div>
                        <div class="col-lg-8">
                            <div class="tableFixHead3" id="" style="padding:0px;margin:0px;">
                                <table id="tbl_smsinserted" class="table table-bordered table-hover kh12-b tbl_smsinserted" style="table-layout:fixed;">
                                    <thead style="text-align:center;">
                                        <th style="width:60px;">No</th>
                                        <th style="width:120px;">ឈ្មោះធនាគា</th>
                                        <th style="width:120px;">លេខបញ្ជី</th>
                                        <th style="width:90px;">កាលបរិច្ឆេទ</th>
                                        <th style="width:70px;">ម៉ោងសារ</th>
                                        <th style="width:100px;">ចំនួនទឹកប្រាក់</th>
                                        <th style="width:100px;">សមតុល្យ</th>
                                        <th style="width:80px;">Action</th>
                                        <th style="width:200px;">កំណត់សំគាល់</th>
                                        <th style="width:120px;">អ្នកកត់ត្រា</th>
                                        <th style="width:120px;">អតិថិជន</th>
                                    </thead>
                                    <tbody id="body_smsinsert">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                </form>

            </div>

        </div>
    </div>
</div>
