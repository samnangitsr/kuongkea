<div class="modal fade" id="addcustomermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="width:px;">
                <h5 id="modalheader" class="modal-title kh22-b">ចុះឈ្មោះអតិថិជន</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="frmcustomer">
                    <div class="row">
                        <input type="hidden" id="txtcusid" name="txtcusid">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table kh16-b">
                                    <tr style="">
                                        <td style="border-style:none;">
                                            ដៃគូក្រុមហ៊ុន
                                        </td>
                                        <td colspan=2 style="border-style:none;">
                                            <select name="company" id="company" class="form-select kh16-b">
                                                @foreach ($companies as $comp)
                                                    <option value="{{ $comp->id }}" {{$comp->id==$selcomid?'selected':''}}>{{ $comp->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;width:200px;">
                                            ប្រភេទអតិថិជន
                                        </td>
                                        <td style="border-style:none;">
                                            ប្រភេទភ្នាក់ងារ
                                        </td>
                                        <td style="border-style:none;width:130px;">
                                            លរ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;width:200px;">
                                            <select name="seltype" id="seltype" class="form-select kh16-b" style="">
                                                <option value=""></option>
                                                <option value="BANK">BANK</option>
                                                <option value="CUSTOMER">CUSTOMER</option>
                                                <option value="PARTNER">PARTNER</option>
                                                <option value="AGENT">AGENT</option>
                                                <option value="NOLIST">NOLIST</option>
                                                <option value="BUYER">BUYER</option>
                                                <option value="SALER">SALER</option>

                                            </select>
                                        </td>
                                        <td style="border-style:none;">
                                            <select name="selagenttype" id="selagenttype" class="form-select kh16-b" style="width:160px;">
                                                <option value=""></option>
                                                {{-- <option value="Wing">វីង</option>
                                                <option value="TrueMoney">ទ្រូម៉ាន់នី</option>
                                                <option value="Emoney">អ៊ីម៉ាន់នី</option>
                                                <option value="Lyhour">លីហួរ</option>
                                                <option value="Cash">សាច់ប្រាក់</option> --}}
                                                @foreach ($agenttypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="border-style:none;">
                                            <input type="number" name="no" id="no" class="form-control kh16-b" style="float:right;width:100%;">
                                        </td>
                                    </tr>

                                    <tr style="">
                                        <td colspan=3 style="border-style:none;">
                                            ឈ្មោះអតិថិជន/Customer Name
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <td colspan=3 style="border-style:none;">
                                            <input type="text" class="form-control kh16-b" name="cusname" id="cusname">
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <td style="border-style:none;">
                                            ភេទ/Sex
                                        </td>
                                        <td colspan=2 style="padding:0px;border-style:none;">
                                            <table class="table">
                                                <tr>
                                                    <td style="border-style:none;">
                                                        <input class="form-check-input" style="font-size:16px;" type="radio" name="radsex" id="radmale" value="1" checked>
                                                        <label class="form-check-label kh16-b" for="radmale">ប្រុស</label>

                                                    </td>
                                                    <td style="border-style:none;">
                                                        <input class="form-check-input" style="font-size:16px;" type="radio" name="radsex" id="radfemale" value="0" checked>
                                                        <label class="form-check-label kh16-b" style="color:red;" for="radfemale">ស្រី</label>
                                                    </td>
                                                    <td style="border-style:none;">
                                                        <input class="form-check-input" style="font-size:16px;" type="radio" name="radsex" id="radnosex" value="2" checked>
                                                        <label class="form-check-label kh16-b" style="color:green;" for="radnosex">គ្មាន</label>
                                                    </td>

                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    <tr style="">
                                        <td style="border-style:none;">
                                            លេខអត្តសញ្ញាណប័ណ្ណ/ID CARD
                                        </td>
                                        <td colspan=2 style="border-style:none;">
                                            <input type="text" class="form-control kh16-b" name="idcard" id="idcard">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="border-style:none;">
                                            ភ្ជាប់ទៅបុគ្គលិក/Connect to User
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=3 style="border-style:none;">

                                            <select multiple="multiple" class="kh16-b seluserconnect" name="seluserconnect[]" id="seluserconnect" style="width:100%;">
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table kh16-b">


                                    <tr>
                                        <td style="border-style:none;">
                                            លេខទូរស័ព្ទ
                                        </td>
                                        <td style="border-style:none;">
                                            <input type="text" class="form-control kh16-b" name="tel" id="tel">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ខេត្ត/ក្រុង
                                        </td>
                                        <td style="border-style:none;">
                                            <select class="form-select" name="sel_province1" id="sel_province1">
                                                <option value=""></option>
                                                @foreach ($provinces as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ស្រុក/ខ័ណ្ឌ
                                        </td>
                                        <td style="border-style:none;">
                                            <select class="form-select" name="sel_district1" id="sel_district1">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ឃុំ/សង្កាត់
                                        </td>
                                        <td style="border-style:none;">
                                            <select class="form-select" name="sel_commune1" id="sel_commune1">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ភូមិ/ក្រុម
                                        </td>
                                        <td style="border-style:none;">
                                            <select class="form-select" name="sel_village1" id="sel_village1">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ទីតាំងបើកប្រាក់
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan=2 style="border-style:none;">
                                            <textarea class="form-control kh16-b" id="addr" name="addr" placeholder="Open Address..." rows="3"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-style:none;">
                                            ភ្ជាប់ទៅលេខបញ្ជីថៃ <br> Thai Account
                                        </td>
                                        <td colspan=2 style="border-style:none;">
                                            {{-- <input type="text" class="form-control kh16-b" name="thai_account" id="thai_account"> --}}
                                            <select class="form-select" name="thai_account" id="thai_account">
                                                <option value=""></option>
                                                @foreach ($thaiacc as $item)
                                                <option value="{{ $item->accno }}"
                                                        style="color: {{ $item->showinlist == 1 ? 'blue' : 'red' }};">
                                                        {{ $item->accno . ' [' . $item->bankname . ']' }}
                                                        {{ $item->showinlist == 1 ? 'បញ្ជីយើង' : 'បញ្ជីគេ' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td style="border-style:none;">
                                            <div class="form-check-danger form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="showinlist" name="showinlist" checked>
                                                <label class="form-check-label kh16-b" for="showinlist">បង្ហាញពេលបិទបញ្ជី</label>
                                            </div>
                                        </td>
                                        <td colspan=2 style="border-style:none;">
                                            <div class="form-check-danger form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_gold_list" name="is_gold_list">
                                                <label class="form-check-label kh16-b" for="is_gold_list">បញ្ជីកក់មាស</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="btnsavecustomer">Save</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
