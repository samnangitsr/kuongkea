<div class="modal fade" id="paymentmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">ទូទាត់ជាមួយអតិថិជន <span id="customer"></span>
                    <input type="hidden" id="customerid" name="customerid">
                    <input type="hidden" id="customername" name="customername">
                    <input type="hidden" id="currency_id" name="currency_id" value="{{ $maincur->id }}">
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="paymentlist_table" class="table-bordered kh22">
                            <thead class="" style="text-align:center;">
                                <th>លរ</th>
                                <th>លេខវិក័យបត្រ</th>
                                <th colspan=2>សរុបទឹកប្រាក់</th>
                                <th colspan=2>ចំនួនទូទាត់</th>
                                <th colspan=2>នៅខ្វះ</th>
                                <th>សកម្មភាព</th> 
                            </thead>
                            <tbody id="invselectpayment">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-top:25px;">
                    <div class="table-responsive">
                        <table class="table table-bordered kh22">
                            <thead class="" style="text-align:center;background-color:rgb(114, 177, 177)">
                                <th>ថ្ងៃទូទាត់</th>
                                <th colspan=2>សរុបទឹកប្រាក់ទាំងអស់</th>
                                <th colspan=2>ទឹកប្រាក់ត្រូវទូទាត់</th>
                                <th colspan=2>សមតុល្យ</th>
                                <th>ចំនួនបានទូទាត់</th>
                                <th>ចំនួននៅសល់</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:0px;width:220px;text-align:center;"> 
                                        <div class="input-group" style="width:250px;">
                                            <input type="text" name="paiddate" id="paiddate" class="form-control kh22" style="width:170px;height:45px;background-color:silver" readonly> 
                                            <span class="input-group-text"><i class="fa fa-calendar fa-2x"></i></span>
                                        </div>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:300px;" class="form-control" id="invtotal" name="invtotal" value="0" readonly> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="invtotalcur" name="invtotalcur" value="USD" readonly>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:300px;" class="form-control" id="paiddepositall" name="paiddepositall" value="0" readonly> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="paidcurall1" name="paidcurall1" value="USD" readonly>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:300px;" class="form-control" id="paidbalanceall" name="paidbalanceall" value="0" readonly> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="paidcurall2" name="paidcurall2" value="USD" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;" class="form-control" id="deposit" name="deposit" value="0" readonly>
                                        <input type="hidden" id="deposited">
                                        {{-- <input type="hidden" id="balance"> --}}
                                        
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;" class="form-control" id="balance" name="balance" value="0" readonly>
                                        
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" id="rowinmoney">
                    <div class="table-responsive">
                        <table class="table table-bordered kh22">
                            <thead class="" style="text-align:center;background-color:rgb(114, 177, 177)">
                                <th>គិតជាលុយ</th>
                                <th colspan=2>សរុបទម្ងន់</th>
                                <th colspan=2>ទឹក</th>
                                <th colspan=2>តំលៃ</th>
                                <th>សរុបទឹកប្រាក់</th>
                                <th>បានទូទាត់</th>
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:150px;text-align:center;"> 
                                        <div class="input-group" style="width:150;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="ckpayinmoney" name="ckpayinmoney">
                                                <label class="form-check-label" for="ckpayinmoney">ទូទាត់ជាសាច់ប្រាក់</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:200px;" class="form-control" id="weight" name="weight" value="0" readonly> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="" name="" value="LI" readonly>
                                    </td>
                                    <td style="padding:0px;width:150px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:150px;" class="form-control" id="water" name="water" value="0"> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="watercur" name="watercur" value="/100" readonly>
                                    </td>
                                    <td style="padding:0px;width:150px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:150px;" class="form-control" id="price" name="price" value="0"> 
                                    </td>
                                    <td style="padding:0px;width:70px;">
                                        <input type="text" style="font-size:22px;color:blue;border-style:none;text-align:left;width:70px;" class="form-control" id="pricecur" name="pricecur" value="USD" readonly>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;width:200px;" class="form-control" id="totalamount" name="totalamount" value="0" readonly>
                                    </td>
                                    <td style="padding:0px;">
                                        <input type="text" style="font-size:22px;border-style:none;text-align:right;" class="form-control" id="hasdeposit" name="hasdeposit" value="0" readonly>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">  
                    <div class="table-responsive">
                        <table class="table table-bordered kh22">
                            <thead style="text-align:center;">
                                <th>ទូទាត់តាម</th>
                                <th>ជ្រើសរើសធនាគា</th>
                                <th colspan=2>ចំនួនទឹកប្រាក់</th>
                                <th>កាត់ជាលុយ</th>
                                <th>អត្រា</th>
                                <th colspan=2>ស្មើរចំនួន</th>
                                <th>សកម្មភាព</th>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td style="padding:0px;width:150px;">
                                        <select name="paymethod" id="paymethod" calss="form-select" style="height:45px;width:150px;font-size:22px;">
                                            <option value=""></option>
                                            <option value="cash">Cash</option>
                                            <option value="bank">Bank</option>
                                        </select>
                                    </td>
                                    <td style="padding:0px;width:250px;" id="rowselbank">
                                        <select name="selbank" id="selbank" calss="form-select" style="height:45px;width:250px;font-size:22px;" disabled>
                                            <option value=""></option>
                                            @foreach ($banks as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" id="payamount" name="payamount" class="form-control canenter" style="font-size:22px;color:blue;border-style:none;text-align:right;width:200px;" value="0"> 
                                    </td>
                                    <td style="padding:0px;width:80px;">
                                        <input type="text" id="paycur" name="paycur" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:80px;" readonly>
                                    </td>
                                    <td style="padding:0px;width:140px;">
                                        <select name="selexchangecur" id="selexchangecur" calss="form-select" style="width:140px;border-style:none;font-size:22px;height:45px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" data-opsign="{{ $c->optsign }}" data-ratebuy="{{ $c->ratebuy }}" data-ratesale="{{ $c->ratesale }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="padding:0px;width:140px;">
                                        <input type="text" id="rate" name="rate" class="form-control canenter" style="font-size:22px;color:blue;border-style:none;text-align:right;width:140px;" value="0"> 
                                            <input type="hidden" id="rateset" name="rateset">
                                    </td>
                                    <td style="padding:0px;width:200px;">
                                        <input type="text" id="exchangeamount" name="exchangeamount" class="form-control" style="font-size:22px;color:blue;border-style:none;text-align:right;width:200px;" value="0"> 
                                    </td>
                                    <td style="padding:0px;width:80px;">
                                        <input type="text" id="exchangecur" name="exchangecur" class="form-control" value="USD" style="font-size:22px;color:blue;border-style:none;text-align:left;width:80px;" readonly>
                                    </td>
                                    <td style="border-style:none;float:right;padding:0px;width:100%;">
                                        <button id="btnaddpaymentlist" class="btn btn-info" style="height:45px;width:100%;">Add List</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
               <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="paymenttable" class="table table-bordered kh22">
                                <thead style="text-align:center;">
                                    <th>លរ</th>
                                    <th>ទូទាត់តាម</th>
                                    <th colspan=2>ចំនួនទឹកប្រាក់</th>
                                    
                                    <th colspan=2>ស្មើរចំនួន</th>
                                    
                                    <th style="display:none;">CurID</th>
                                    <th style="display:none;">អត្រា</th>
                                    <th style="display:none;">អត្រាកំណត់</th>
                                    <th>ធនាគា</th>
                                    <th>សកម្មភាព</th>
                                </thead>
                                <tbody id="bodypayment">
    
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="btnsavepayment">Save</button>
                <button class="btn btn-info" id="btnsavepaymentprint">SavePrint</button>
                <button type="button" id="btnclosemodal" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>