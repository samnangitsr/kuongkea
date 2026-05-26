
<div class="modal fade" id="offerformmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title kh22-b" id="modaltitle">
                    ការស្នើរប្រាក់របស់បុគ្គលិក
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-bottom:0px;">
                <form action="" id="frmoffer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tbl_offer_modal" class="table kh22">
                                        <tr>
                                            <td style="width:200px;">ថ្ងៃទី</td>

                                            <td  style="">
                                                <div class="input-group" style="">
                                                    <input type="text" name="offerdate" id="offerdate" class="form-control" style="background-color:silver;font-size:22px;" readonly>
                                                    <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                                </div>
                                            </td>

                                            <td>
                                                <input type="text" id="txtrate" name="txtrate" class="form-control kh22" placeholder="អត្រា">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="user1">ស្នើដោយ</td>

                                            <td colspan=2>
                                                <input type="hidden" id="useroffer_id" name="useroffer_id" value="{{ Auth::id() }}">
                                                <input type="text" class="form-control kh22" id="useroffer" name="useroffer" value="{{ Auth::user()->name }}" readonly>
                                            </td>
                                        </tr>

                                        <tr class="truser">
                                                <td id="user2">ស្នើទៅ</td>
                                                <td colspan=2>
                                                    <select class="form-select kh22" name="seluser" id="seluser" style="width:100%;">
                                                        <option value=""></option>
                                                        @foreach ($users as $u)
                                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>


                                        </tr>
                                        <tr>
                                            <td>
                                                ប្រភេទស្នើ
                                            </td>
                                            <td colspan=2>
                                                <select name="seltype" id="seltype" class="form-select kh22">
                                                    @foreach ($agenttypes as $item)
                                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                ឈ្មោះគណនេយ្យ
                                            </td>
                                            <td colspan=2>
                                                <select name="sel_customer_id" id="sel_customer_id" class="form-select kh22">

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ស្នើចំនួន</td>

                                            <td>
                                                <input type="text" class="form-control kh22" name="amount1" id="amount1" style="text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </td>
                                            <td style="width:150px;">
                                                <select class="form-select kh22" name="selcur1" id="selcur1" style="width:150px;">
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label kh22">
                                                        <input class="form-check-input" type="checkbox" name="ckkatkong" id="ckkatkong"> កាត់កង
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" id="amount2" name="amount2" class="form-control kh22" style="text-align:right;" readonly>
                                            </td>
                                            <td>
                                                <select class="form-select kh22" name="selcurkatkong" id="selcurkatkong" style="" disabled>
                                                    <option value=""></option>
                                                    @foreach ($currencies as $cur)
                                                        <option value="{{ $cur->id }}">{{ $cur->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ប្រភេទកាត់កង
                                            </td>
                                            <td colspan=2>
                                                <select name="seltype1" id="seltype1" class="form-select kh22">
                                                    @foreach ($agenttypes as $item)
                                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                ឈ្មោះគណនេយ្យ
                                            </td>
                                            <td colspan=2>
                                                <select name="sel_customer_id1" id="sel_customer_id1" class="form-select kh22">

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
                <button class="btn btn-info kh22" id="btnsaveuseroffer">Save</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger kh22" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
