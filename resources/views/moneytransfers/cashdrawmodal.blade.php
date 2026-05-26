<div class="modal fade" id="cashdrawmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="height:40px;">
                <p id="modalheader" class="modal-title kh22-b">បើកវេរ</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmcashdraw" action="">
                    <input type="hidden" id="transfer_id" name="transfer_id" value="">
                    <input id="txtrole" type="hidden" value="{{ Auth::user()->role->name }}">
                    <input type="hidden" id="hasexchange" name="hasexchange" value='0' title="hasexchange">
                    <input type="hidden" id="hasexchangefix" name="hasexchangefix" value='0' title="hasexchangefix">
                    <input type="hidden" id="hascontinue" name="hascontinue" value='0' title="hascontinue">
                    <input type="hidden" id="hasbankpayment" name="hasbankpayment" value='0' title="hasbankpayment">
                    <input type="hidden" id="hasmulticashdraw" name="hasmulticashdraw" value='0' title="hasmulticashdraw">
                    <input type="hidden" id="trancode1" name="trancode1" value='-1'>
                    <div id="diva" class="row" style="display:none;">

                    </div>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-6" style="">
                        <div class="row">
                            <div id="divm1" class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table" style="table-layout:fixed;width:100%">
                                <thead style="text-align:center;">
                                    <th colspan=2 style="width:200px;" class="kh16-b">សរុបទឹកប្រាក់បើក</th>
                                    <th class="kh16-b">សកម្មភាព</th>
                                </thead>
                                <tbody id="tbl_total_cashdraw">

                                </tbody>

                                </table>

                            </div>
                            </div>
                            <div id="divm2" class="col-lg-6">
                            <div class="table-repsonsive">
                            <table class="table" style="table-layout:fixed;width:100%">
                                <tr>

                                <td style="padding:0px;border-style:none;">
                                    <input type="text" name="opdates" id="opdates" class="form-control" value="" style="background-color:white;font-size:16px;height:30px;" readonly>
                                </td>
                                <td style="padding:0px;border-style:none;width:60px;">
                                    <span class="input-group-text" style="background-color:inherit;border:none;width:60px;"><i class="fa fa-calendar"></i></span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=2 style="padding:0px;border-style:none;">
                                    <textarea class="form-control kh16" name="txtnotes" id="txtnotes" style="width:100%" rows="2" placeholder="កំណត់សំគាល់"></textarea>
                                </td>
                            </tr>

                            </table>
                            </div>

                            </div>

                        </div>

                        <div id="divb">
                            <div class="card">
                                <div id="cardpartner"  class="card-header" style="text-align:center;background-color:silver;height:35px;">
                                    <h1 id="partner_title" class="kh16-b">ព៌តមានវេរ</h1>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;">
                                    <div class="row mb-3">
                                        <div class="table-responsive">
                                            <table id="tbl_partner" class="table">
                                                <tr>
                                                    <td>
                                                        <label for="date" class="kh16" style="width:120px;">ថ្ងៃវេរ</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="invdate" id="invdate" class="form-control" value="" style="background-color:white;font-size:16px;height:30px;" readonly>
                                                    </td>
                                                    <td style="width:30px;">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="date" class="kh16" style="width:120px;">វេរមកពីដៃគូ</label></td>
                                                    <td colspan=2>
                                                        <input type="hidden" id="from_partner_id" name="from_partner_id" class="form-control kh16" value="">
                                                        <input type="text" id="from_partner" name="from_partner" class="form-control kh16" style="height:30px;" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="rectel" class="kh16" style="width:120px;">លេខអ្នកទទួល</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" style="height:30px;" id="rectel" name="rectel" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="recname" class="kh16" style="width:120px;">ឈ្មោះអ្នកទទួល</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" style="height:30px;" id="recname" name="recname" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="sendertel" class="kh16" style="width:120px;">លេខអ្នកផ្ញើ</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" style="height:30px;" id="sendertel" name="sendertel" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="sendername" class="kh16" style="width:120px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" style="height:30px;" id="sendername" name="sendername" value="">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div id="divc" class="card">
                            <div id="cardamount" class="card-header" style="background-color:silver;height:35px;">
                                <h1 id="transfer_title" class="kh16-b" style="text-align:center;">បើកវេរ</h1>
                            </div>
                            <div class="card-body" id="">
                                <div class="table-responsive">
                                    <table id="tbl_amount" class="table kh16">
                                        <tr>
                                            <td>ចំនួនទឹកប្រាក់វេរ</td>
                                            <td>
                                                <input type="text" class="form-control kh16-b canenter" id="amount" name="amount" value="" style="width:100%;text-align:right;height:30px;" autocomplete="off" readonly>
                                            </td>
                                            <td style="width:80px;">
                                                <select name="selcur" id="selcur" class="form-select kh16-b" style="width:80px;height:30px;padding:0px 0px 0px 10px" disabled>
                                                    <option value=""></option>
                                                    @foreach ($currencies as $c)
                                                        <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>កាត់សេវ៉ា</td>
                                            <td>
                                                <input type="text" class="form-control kh16-b canenter" id="cuscharge" name="cuscharge" value="0" style="text-align:right;height:30px;">
                                            </td>
                                            <td style="width:80px;">
                                                <input type="text" class="form-control kh16-b" id="txtcur_cutseva" value="" style="width:80px;height:30px;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>លុយត្រូវបើក</td>
                                            <td>
                                                <input type="text" class="form-control kh16-b canenter" id="openamt" name="openamt" value="" style="text-align:right;height:30px;">
                                            </td>
                                            <td style="width:80px;">
                                                <input type="text" class="form-control kh16-b" id="txtcur_open" value="" style="width:80px;height:30px;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកមកបើក</td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16 canenter" id="rec_tel" name="rec_tel" value="" style="height:30px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ឈ្មោះអ្នកមកបើក</td>
                                            <td colspan=2>
                                                <input type="text" class="form-control kh16 canenter" id="rec_name" name="rec_name" value="" style="height:30px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>កំណត់សំគាល់</td>
                                            <td colspan=2>
                                                <textarea name="txtnote" id="txtnote" style="width:100%" rows="2"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="date" class="kh16" style="width:120px;">ថ្ងៃបើកវេរ</label>
                                            </td>
                                            <td>
                                                <input type="text" name="opdate" id="opdate" class="form-control" value="" style="background-color:white;font-size:16px;height:30px;" readonly>
                                            </td>
                                            <td style="width:60px;">
                                                <span class="input-group-text" style="background-color:inherit;border:none;"><i class="fa fa-calendar"></i></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>



                        </div>

                        <div id="divexchangecard" style="display:none;">
                            <div class="card">
                                <div class="card-header" style="text-align:center;">
                                    <h1 class="kh22-b" style="display:inline">Exchange</h1>
                                    <span style="float:right;font-size:22px;"><button id="btnclosedivexchangecard" class="btn btn-danger btn-md">X</button></span>

                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="table-responsive">

                                                <table id="tbl_exchange" class="table kh22" style="margin:0px;">
                                                    <tr>
                                                        <td><input type="text" name="txtsign" id="txtsign" value="+" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtbuy" id="txtbuy" class="form-control txtexchange canenter" style="color:blue;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                        <td><input type="text" name="lblbuy" id="lblbuy" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>

                                                    <tr>
                                                        <td><input type="text" value="Rate" id="lblrate" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtrate" id="txtrate" class="form-control txtexchange canenter" style="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                        <td><input type="button" id="btnaddlist" value="ADD" class="btn btn-info txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="txtsign1" value="-" class="form-control txtexchange" style="width:80px;text-align:center;" readonly></td>
                                                        <td><input type="text" name="txtsale" id="txtsale" class="form-control txtexchange" style="color:red;" readonly></td>
                                                        <td><input type="text" name="lblsale" id="lblsale" value="" class="form-control txtexchange" style="width:100px;text-align:center;" readonly></td>
                                                    </tr>
                                                </table>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div id="divexchangefix" style="display:none;">
                            <div class="card" style="">
                                <div class="card-header" style="text-align:center;">
                                    <h1 class="kh22-b" style="display:inline">ប្តូប្រាក់២</h1>
                                    <span style="float:right;font-size:22px;"><button id="btnclosedivexchangefix" class="btn btn-danger btn-md">X</button></span>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;padding:10px;">
                                    <div class="row" style="">
                                    <div class="table-responsive">

                                            <table id="tbl_exchange2" class="" style="margin:0px;padding:0px;">
                                                <thead class="kh16-b" style="text-align:center;">
                                                <th>លរ</th>
                                                <th colspan=3>លក់ចេញ</th>
                                                <th>អត្រា</th>
                                                <th colspan=3>ទិញចូល</th>
                                                <th>Rate</th>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">1</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>

                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">2</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtexchangefix" style="text-align:center;padding-top:2px;width:40px;">3</td>
                                                    <td><input type="text" id="txtsign1fix[]" value="-" class="form-control tdcanenter2 txtexchangefix txtsign1fix" style="color:red;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtsalefix[]" class="form-control tdcanenter2 txtexchangefix txtsalefix" style="color:red;text-align:right;"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblsalefix[]" value="" class="form-control tdcanenter2 txtexchangefix lblsalefix" style="color:red;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtratefix[]" class="form-control txtexchangefix tdcanenter2 txtratefix" style="text-align:center;width:120px;"></td>
                                                    <td style="padding-left:10px;"><input type="text" name="txtsignfix[]" value="+" class="form-control tdcanenter2 txtexchangefix txtsignfix" style="color:blue;width:50px;text-align:center;" readonly></td>
                                                    <td><input type="text" name="txtbuyfix[]" class="form-control txtexchangefix tdcanenter2 txtbuyfix" style="color:blue;text-align:right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                                                    <td style="padding-right:10px;"><input type="text" name="lblbuyfix[]" value="" class="form-control tdcanenter2 txtexchangefix lblbuyfix" style="color:blue;width:60px;text-align:center;" readonly></td>
                                                    <td><input type="text" value="Rate" class="form-control tdcanenter2 txtexchangefix lblratefix" style="width:80px;text-align:center;" readonly></td>
                                                </tr>

                                                <tr><td colspan=8></td></tr>
                                                <tr><td colspan=8></td></tr>
                                                <tr><td colspan=8></td></tr>

                                                <tr style="background-color:blueviolet;margin-top:20px;">
                                                    <td style="display:none;"><input type="text" id="txtmainamt"  class="form-control txtexchangefix" style="color:blue;" readonly></td>
                                                    <td colspan=5 class="kh16-b" style="text-align:right;color:white;">លុយវេរនៅសល់</td>
                                                    <td colspan=2><input type="text" id="txtleftamt"  class="form-control txtexchangefix" style="color:white;background-color:blueviolet;text-align:right;" readonly></td>
                                                    <td><input type="text" id="txtleftcur" value="" class="form-control txtexchangefix" style="width:60px;text-align:center;color:white;background-color:blueviolet" readonly></td>
                                                    <td style="text-align:center;background-color:grey"><input type="button" style="" class="" id="btnaddexchange2" value="Add List"></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divexchangelist" style="display:none;">
                            <div  class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3>Multi Exchange</h3>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivexchangelist" class="btn btn-danger btn-md">X</button></span>
                                            <button id="btnclearlist" class="btn btn-info" style="float:right;">Clear List</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="multiexchangecard">

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="tablemultiexchange" class="table table-bordered">
                                                <thead style="text-align:center;">
                                                    <th>No</th>
                                                    <th>Buy</th>
                                                    <th>Cur</th>
                                                    <th style="display:none;">Buyinfo</th>
                                                    <th>Rate</th>
                                                    <th style="display:none;">Rateinfo</th>
                                                    <th>Sale</th>
                                                    <th>Cur</th>
                                                    <th style="display:none;">Saleinfo</th>
                                                    <th style="display:none;">Drate</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody id="multiexlist">
                                                    {{-- @foreach ($mex as $key => $m)
                                                        <tr>
                                                            <td style="text-align:center;">{{ ++$key }}</td>
                                                            <td>
                                                                <input type="text" name="txtbuys[]" class="form-control txtbuys" style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->buy) }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtcurbuys[]" class="form-control txtcurbuys" style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->curbuy }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtbuyinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->buyinfo }}">
                                                            </td>
                                                            <td style="">
                                                                <input type="text" name="txtrates[]" class="form-control" style="width:80px;border-style:none;padding:5px;text-align:center;" value="{{ phpformatnumber($m->rate) }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtrateinfoes[]" class="form-control" style="width:50px;border-style:none;padding:0px;" value="{{ $m->rateinfo }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtsales[]" class="form-control" style="width:100%;border-style:none;padding:5px;text-align:right;" value="{{ phpformatnumber($m->sale) }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="txtcursales[]" class="form-control" style="width:50px;border-style:none;padding:5px;text-align:center;" value="{{ $m->cursale }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtsaleinfoes[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->saleinfo }}">
                                                            </td>
                                                            <td style="display:none;">
                                                                <input type="text" name="txtdrates[]" class="form-control" style="width:50px;border-style:none;padding:5px;" value="{{ $m->drate }}">
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <a data-id="{{ $m->id }}" class="btn btn-danger btn-sm btndelmxlist" href="">Del</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="kh16">
                                                        <th>សរុបទឹកប្រាក់ទទួល</th>

                                                    </thead>
                                                    <tbody id="t_cashin">

                                                        {{-- @foreach ($cashin as $ci)
                                                            <tr>
                                                                <td style="font-size:22px;color:blue;text-align:right;">{{ phpformatnumber($ci['value']) }} &nbsp; {{ $ci['cur'] }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="kh16">
                                                        <th>សរុបទឹកប្រាក់ប្រគល់</th>

                                                    </thead>
                                                    <tbody id="t_cashout">

                                                        {{-- @foreach ($cashout as $co)
                                                            <tr>
                                                                <td style="font-size:22px;color:red;text-align:right;">{{ phpformatnumber($co['value']) }} &nbsp; {{ $co['cur'] }}</td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="divbankpayment" style="display:none;margin-top:0px;">
                            <div class="card">
                                <div class="card-header" style="height:35px;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6>Bank Payment</h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <span style="float:right;font-size:16px;margin-left:20px;margin-top:-5px;"><button id="btnclosedivbankpayment" class="mybtn" style="color:red;">X</button></span>
                                            <button id="btnaddrow" class="mybtn" style="float:right;margin-top:-2px;">add row</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-bottom:0px;">
                                    <div class="table-responsive">
                                        <table id="tbl_bankpayment" class="table table-bordered">
                                            <thead style="text-align:center;">
                                                <th style="display:none;">No</th>
                                                <th>Bank ID</th>
                                                <th style="display:none;">Bank Name</th>
                                                <th>Amount</th>
                                                <th>Cur</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="body_bankpayment">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <select name="selbank" id="selbank" class="form-select kh16" style="display:none;">
                            <option value="">Select Bank</option>
                            @foreach ($partners as $b)
                                <option value="{{ $b->id }}" customertype="{{ $b->customertype }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <div id="divcontinue" style="display:none;">
                            <div class="card" id="continuecard" >
                                <div class="card-header" style="text-align:center;height:35px;">
                                    <h1 class="kh16-b" style="display:inline">ដៃគូបន្ត</h1>
                                    <span style="float:right;font-size:16px;margin-top:-5px;"><button id="btnclosedivcontinue" class="mybtn" style="color:red;">X</button></span>

                                </div>
                                <div class="card-body" style="padding-bottom:0px;">
                                    <div class="row mb-3">
                                        <div class="table-responsive">
                                            <table id="tbl_continue_partner" class="table kh16">
                                                 <tr>
                                                    <td colspan=3 style="text-align:right;">
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radall2" value="all" checked>
                                                        <label class="form-check-label kh16-b" for="radall2">ទាំងអស់</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radpartner2" value="PARTNER">
                                                        <label class="form-check-label kh16-b" for="radpartner2">ដៃគូ</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radbank2" value="BANK">
                                                        <label class="form-check-label kh16-b" for="radbank2">ធនាគា</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radcustomer2" value="CUSTOMER">
                                                        <label class="form-check-label kh16-b" for="radcustomer2">អតិថិជន</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radagent2" value="AGENT">
                                                        <label class="form-check-label kh16-b" for="radagent2">ភ្នាក់ងារ</label>
                                                        <input class="form-check-input" style="margin-top:5px;font-size:16px;" type="radio" name="radcustype2" id="radnolist2" value="NOLIST">
                                                        <label class="form-check-label kh16-b" for="radnolist2">ជំនួយ</label>
                                                    </td>
                                                </tr>
                                                <tr style="margin-bottom:20px;">
                                                    <td><label for="date" class="kh16" style="width:150px;">ជ្រើសរើសដៃគូ</label></td>
                                                    <td colspan=2 style="">
                                                        <select class="form-select select2-option kh16" name="selpartner_continue" id="selpartner_continue" style="width:100%">
                                                            <option value=""></option>
                                                            @foreach ($partners as $p)
                                                                <option value="{{ $p->id }}" customertype="{{ $p->customertype }}" userconnect="{{ $p->user_connect }}" thai_list="{{ $p->thai_list }}" countrycode="{{ $p->tel }}" agenttype="{{ $p->agent_type_id }}" maxtransfer="{{ $p->agenttype->transfer_amount }}" maxcuscharge="{{ $p->agenttype->customer_fee }}" maxfee="{{ $p->agenttype->cashdraw_fee }}" maxtransferfee="{{ $p->agenttype->transfer_fee }}">{{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="row_son">
                                                    <td><label for="son" class="kh16" style="width:150px;">បន្តទៅកូនសាខា</label></td>
                                                    <td>
                                                        <input type="text" id="son" name="son" class="form-control kh16" style="display:inline;">

                                                    </td>
                                                    <td style="width:80px;">
                                                        <button id="btnbrowseson" style="width:80px;height:37px;display:inline;" class="mybtn">...</button>
                                                    </td>

                                                    {{-- <td style="width:60px;text-align:right;">
                                                        <button id="btnbrowseson" class="btn btn-info btn-lg">...</button>
                                                    </td> --}}

                                                </tr>
                                                 <tr id="row_wing_tranname1" style="display:none;">
                                                    <td class="kh16" style="width:150px;">ប្រតិបត្តិការណ៏</td>
                                                    <td colspan=2>
                                                        <select class="form-select select2-option kh16-b" name="seltranname1" id="seltranname1" style="width:100%;height:35px;">

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="rowbalance2" style="background-color:whitesmoke;border:1px solid black;">
                                                    <td class="kh16-b">សមតុល្យ</td>
                                                    <td style="padding:0px;" colspan=2>
                                                        <input type="text" id="balance2" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:red;width:49%;display:inline;" readonly>
                                                        <input type="text" id="balancenext2" class="form-control kh16-b" style="border-style:none;background-color:whitesmoke;text-align:right;color:blue;width:50%;display:inline;" readonly>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>ចំនួនទឹកប្រាក់វេរ</td>
                                                    <td>
                                                        <input type="text" class="form-control kh16-b canenter" id="amount_continue" name="amount_continue" style="text-align:right;" autocomplete="off">
                                                    </td>
                                                    <td style="width:80px;">
                                                        <select name="selcur_continue" id="selcur_continue" class="form-select kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="row_cuscharge">
                                                    <td>សេវ៉ាវេរ
                                                            <span id="divckwater" style="float:right;">
                                                                <input class="form-check-input" type="checkbox" id="ckwater" name="ckwater" value=""  style="">
                                                                <label for="ckwater" class="form-check-label kh16">ដកទឹក</label>
                                                            </span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control kh16-b canenter" id="cuscharge_continue" name="cuscharge_continue" style="text-align:right;" value="0">
                                                    </td>
                                                    <td style="width:80px;">
                                                        <select name="txtcur2" id="txtcur2" class="form-select kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr id="row_totalcash">
                                                    <td>សរុបទឹកប្រាក់</td>
                                                    <td>
                                                        <input type="text" class="form-control kh16-b" id="totalcash" name="totalcash" style="text-align:right;">
                                                    </td>
                                                    <td style="width:80px;">
                                                        <input type="text" class="form-control kh16-b" id="txtcur" style="width:80px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>សេវ៉ាដៃគូ</td>
                                                    <td>
                                                        <input type="text" class="form-control kh16-b canenter" id="fee_continue" name="fee_continue" style="width:100%;text-align:right;" value="0">
                                                    </td>
                                                    <td style="width:80px;">
                                                        <select name="txtcur1" id="txtcur1" class="form-select kh16-b" style="width:80px;">
                                                            <option value=""></option>
                                                            @foreach ($currencies as $c)
                                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="rectel" class="kh16" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកទទួល</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 typeautosearch canenter" id="rectel_continue" name="rectel_continue">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="recname" class="kh16" style="width:150px;">ឈ្មោះអ្នកទទួល</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" id="recname_continue" name="recname_continue">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="sendertel" class="kh16" style="width:150px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> លេខអ្នកផ្ញើ</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" id="sendertel_continue" name="sendertel_continue">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="sendername" class="kh16" style="width:150px;">ឈ្មោះអ្នកផ្ញើ</label></td>
                                                    <td colspan=2>
                                                        <input type="text" class="form-control kh16 canenter" id="sendername_continue" name="sendername_continue">
                                                    </td>
                                                </tr>


                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        </div>
                    </div>
                    <div id="divphoto" class="row" style="border:1px dotted black;padding:10px 0px;">
                        <div class="col-lg-3">
                            <div class="contentarea">

                                <div class="camera">
                                    <video id="video">Video stream not available.</video>
                                </div>
                                <div><button id="startbutton" data-dismiss="modal">Take photo</button></div>
                                {{-- <canvas id="canvas"></canvas>
                                <div class="output">
                                    <img id="photo" alt="The screen capture will appear in this box.">
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group form-group-login">
                                <table style="margin:0 auto;">
                                    <tbody>
                                    <tr>
                                        <td colspan=3 class="photo">
                                        <canvas id="canvas"></canvas>
                                        <img src="{{ config('helper.asset_path')}}/logo/NoPicture.jpg" alt="" class="student-photo" id="showPhoto">
                                        <input type="file" name="image2" id="image2" accept="image/x-png,image/png,image/jpg,image/jpeg,image/webp" style="display:none;">
                                        <input type="hidden" name="photopath" id="photopath" value="">
                                        <input type="hidden" name="clickcapture2" id="clickcapture2" value="0">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <button type="button" name="browse_file2" id="browse_file2" class="btn btn-info " value="Browse" style="width:100%;">Browse</button>
                                        </td>
                                        <td>
                                        <button type="button" name="btnaddimgtolist" id="btnaddimgtolist" class="btn btn-primary " value="Capture" style="width:100%;">ADDLIST</button>
                                        {{-- <button type="button" name="btnsavemultiimage" id="btnsavemultiimage" class="btn btn-primary " value="Capture" style="width:100%;">SaveImage</button> --}}

                                    </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table id="tbl_image">
                                    <thead id="thead_img">

                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div id="divfooter" style="">
                        <div class="row" style="margin-right:20px;">
                            <div class="col-lg-8">
                                <div style="">

                                    <button id="btncontinue" class="btn btn-primary kh16-b" >បន្តទៅ</button>
                                    <button id="btnexchange" class="btn btn-primary kh16-b" title="CTRL+1">ប្តូរប្រាក់១</button>
                                    <button id="btnexchange2" class="btn btn-primary kh16-b" title="CTRL+2">ប្តូរប្រាក់២</button>
                                    <button id="btnbankpayment" class="btn btn-primary kh16-b" title="CTRL+3">ទូទាត់តាមធនាគា</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div style="float:right;">
                                    <button id="btnsave" class="btn btn-info kh16-b" style="width:150px;">រក្សាទុក</button>
                                    <button id="btnsaveprint" class="btn btn-primary kh16-b" style="width:150px;">រក្សាទុកព្រីន</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>



            </div>

        </div>
    </div>
</div>
