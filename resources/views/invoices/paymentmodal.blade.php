<div class="modal fade" id="paymentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ទូទាត់</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <input type="hidden" name="invoice_id" id="invoice_id">
                        <input type="hidden" name="currency_id" id="currency_id" value="{{ $maincur->id }}">
                        <table class="table table-bordered">
                            <tr>
                                <td style="padding:0px;" class="kh16">
                                    អតិថិជន
                                </td>
                                <td style="padding:0px;"> 
                                    <input type="text" class="form-control kh16" id="customername" name="customername">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">
                                    សរុបទឹកប្រាក់
                                </td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" id="invtotal" name="invtotal" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0"> 
                                        <input type="text" id="invcur1" name="invcur1" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">
                                    កក់រួច
                                </td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" id="deposited" name="deposited" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0" readonly> 
                                        <input type="text" id="invcur3" name="invcur3" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">
                                    ប្រាក់កក់
                                </td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" id="deposit" name="deposit" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0" readonly> 
                                        <input type="text" id="invcur2" name="invcur2" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">នៅខ្វះ</td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" id="balance" name="balance" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0"> 
                                        <input type="text" id="invcur4" name="invcur4" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">ថ្ងៃទូទាត់</td>
                                <td style="padding:0px;"> 
                                    <div class="input-group">
                                        <input type="text" name="paiddate" id="paiddate" class="form-control kh22" style="width:150px;background-color:silver;" readonly> 
                                        <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <td style="padding:0px;" class="kh16">ទូទាត់តាម</td>
                                <td style="padding:0px;">
                                    <select name="paymethod" id="paymethod" calss="form-select" style="height:40px;width:100%;font-size:20px;">
                                        <option value=""></option>
                                        <option value="cash">Cash</option>
                                        <option value="bank">Bank</option>
                                    </select>
                                </td>
                            </tr>
                           
                                <tr id="rowselbank">
                                    <td style="padding:0px;" class="kh16">ជ្រើសរើសធនាគា</td>
                                    <td style="padding:0px;">
                                        <select name="selbank" id="selbank" calss="form-select" style="height:40px;width:100%;font-size:20px;" disabled>
                                            <option value=""></option>
                                            @foreach ($banks as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                           

                            <tr>
                                <td style="padding:0px;" class="kh16">ចំនួនទឹកប្រាក់</td>
                                <td style="padding:0px;">
                                   
                                    <div class="input-group">
                                        <input type="text" id="payamount" name="payamount" class="form-control canenter" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0"> 
                                        <input type="text" id="paycur" name="paycur" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">កាត់ជាលុយ</td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <select name="selexchangecur" id="selexchangecur" calss="form-select" style="width:100px;border-style:none;font-size:22px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" data-opsign="{{ $c->optsign }}" data-ratebuy="{{ $c->ratebuy }}" data-ratesale="{{ $c->ratesale }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" id="rate" name="rate" class="form-control canenter" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0"> 
                                        <input type="hidden" id="rateset" name="rateset">
                                    </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px;" class="kh16">ស្មើរចំនួន</td>
                                <td style="padding:0px;">
                                    <div class="input-group">
                                        <input type="text" id="exchangeamount" name="exchangeamount" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:150px;" value="0"> 
                                        <input type="text" id="exchangecur" name="exchangecur" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:50px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0px; border-style:none;">
                                    <button id="btnaddpaymentlist" class="btn btn-info">Add List</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
               <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="paymenttable" class="table">
                                <th class="kh16">លរ</th>
                                <th class="kh16">ទូទាត់តាម</th>
                                <th class="kh16" style="text-align:right;">ចំនួនទឹកប្រាក់</th>
                                <th class="kh16">រូបិយ</th>
                                <th class="kh16" style="text-align:right;">ស្មើរចំនួន</th>
                                <th class="kh16">រូបិយ</th>
                                <th class="kh16" style="display:none;">CurID</th>
                                <th class="kh16" style="display:none;">អត្រា</th>
                                <th class="kh16" style="display:none;">អត្រាកំណត់</th>
                                <th class="kh16">ធនាគា</th>
                                <th style="display:none;" class="kh16">BankID</th>
                                <th class="kh16">សកម្មភាព</th>
                                <tbody id="bodypayment">
    
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="btnsavepayment">Save</button>
                <button class="btn btn-primary" id="btnsavepaymentprint">SavePrint</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>