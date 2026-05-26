
<div class="modal fade" id="accept_offerform_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title kh22-b" id="modaltitle">
                    យល់ព្រមការស្នើរបស់បុគ្គលិក
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">
                <form action="" id="frmoffer_accept">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tbl_offer_accept_modal" class="table kh22">
                                        <tr>
                                            <td>កាលបរិច្ឆេទ</td>

                                            <td style="">
                                                    <input type="hidden" id="offer_id" name="offer_id">
                                                    <div class="input-group" style="">
                                                        <input type="text" name="offerdate_accept" id="offerdate_accept" class=" style="background-color:silver;font-size:22px;" readonly>
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                            </td>
                                            <td>
                                                ប្រភេទស្នើ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="user1">បុគ្គលិកស្នើ</td>

                                            <td>
                                                <input type="hidden" id="usercashin_id" name="usercashin_id">
                                                <input type="text" class="kh22" id="usercashin" name="usercashin" style="width:100%;" readonly>
                                            </td>
                                             <td>
                                                <input type="text" class="kh22" style="width:100%;" id="offertype" name="offertype">
                                            </td>
                                        </tr>

                                        <tr>
                                                <td id="user2">ស្នើទៅបុគ្គលិក</td>
                                                <td colspan=2>
                                                    <input type="hidden" id="usercashout_id" name="usercashout_id">
                                                    <input type="text" class="kh22" id="usercashout" name="usercashout" style="width:100%;" readonly>
                                                </td>

                                        </tr>
                                         <tr>
                                            <td style="padding:5px;"></td>
                                        </tr>
                                        <tr style="background-color:aqua;border:1px solid black;">
                                            <td>ចំនួនទឹកប្រាក់</td>
                                            <td>
                                                <input type="text" class="kh22" name="amount3" id="amount3" style="text-align:right;width:100%;font-weight:bold;" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </td>
                                            <td style="width:150px;">
                                                <select class="kh22" name="selcur3" id="selcur3" style="width:150px;" disabled>
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr style="border:1px solid black;border-top:none;background-color:aqua">
                                            <td colspan=3 style="">
                                                <table class="table" style="margin:0px;">
                                                    <tr>
                                                        <td id="user2">ដកពី</td>
                                                        <td>
                                                            <select class="kh22" name="selusercashout" id="selusercashout" style="width:100%;color:red;">
                                                                <option value=""></option>
                                                                @foreach ($users as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="kh22" name="sellistout" id="sellistout" style="width:100%;color:red;">
                                                                <option value="" customertype="cash">cash</option>
                                                                @foreach ($banks as $item)
                                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="">
                                                        <td>ដាក់ចូល</td>
                                                        <td>
                                                            <input type="text" class="kh22" id="userreceive" style="width:100%;color:blue;" name="userreceive" readonly>
                                                        </td>
                                                        <td>
                                                            <select class="kh22" name="sellistin" id="sellistin" style="width:100%;color:blue;">
                                                                <option value="" customertype="cash">cash</option>
                                                                @foreach ($banks as $item)
                                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="padding:5px;"></td>
                                        </tr>
                                        <tr class="rowkatkong" style="background-color:aquamarine;border:1px solid black;">
                                            <td>ចំនួនកាត់កង</td>
                                            <td>
                                                <input type="text" id="amount4" name="amount4" class="kh22" style="text-align:right;width:100%;font-weight:bold;" readonly>
                                            </td>
                                            <td>
                                                <select class="kh22" name="selcur4" id="selcur4" style="width:150px;" disabled>
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                         <tr class="rowkatkong" style="border:1px solid black;border-top:none;background-color:aquamarine">
                                            <td colspan=3 style="">
                                                <table class="table" style="margin:0px;">
                                                    <tr>
                                                        <td id="user2">ដាក់ចូល</td>
                                                        <td>
                                                            <select class="kh22" name="selusercashin1" id="selusercashin1" style="width:100%;color:blue;">
                                                                <option value=""></option>
                                                                @foreach ($users as $u)
                                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="kh22" name="sellistin1" id="sellistin1" style="width:100%;color:blue;">
                                                                <option value="" customertype="cash">cash</option>
                                                                @foreach ($banks as $item)
                                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr style="">
                                                        <td>ដកពី</td>
                                                        <td>
                                                            <input type="text" class="kh22" id="usercashout1" style="width:100%;color:red;" name="usercashout1" readonly>
                                                        </td>
                                                        <td>
                                                            <select class="kh22" name="sellistout1" id="sellistout1" style="width:100%;color:red;">
                                                                <option value="" customertype="cash">cash</option>
                                                                @foreach ($banks as $item)
                                                                    <option value="{{$item->id}}" customertype="{{$item->customertype}}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>

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
                <button class="btn btn-info kh22" id="btnsaveuserofferaccept">Save</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger kh22" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
