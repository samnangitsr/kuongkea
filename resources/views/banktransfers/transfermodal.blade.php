<div class="modal fade" id="transfermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh16-b">ផ្ទេរប្រាក់</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">ថ្ងៃទី</td>
                                    <td style="padding:5px;" colspan=2>
                                        <div class="input-group">
                                            <input type="text" name="trdate" id="trdate" class="form-control" style="background-color:silver"> 
                                            <span class="input-group-text" style=""><i class="bx bx-calendar"></i></span>
                                        </div>
                                        
                                    </td>
                                    <td style="padding:0px;">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">ផ្ទេរពី</td>
                                    <td style="padding:5px;" colspan=3>
                                        <select name="sel_from" id="sel_from" class="form-select" style="width:100%;background-color:aquamarine;">
                                            <option value=""></option>
                                            @foreach ($banks as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">ផ្ទេរទៅ</td>
                                    <td style="padding:5px;" colspan=3>
                                        <select name="sel_to" id="sel_to" class="form-select" style="width:100%;background-color:aqua">
                                            <option value=""></option>
                                            @foreach ($banks as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">ចំនួនទឹកប្រាក់</td>
                                    <td style="padding:5px;" colspan=2;>
                                        <input type="text" class="form-control" id="amount1" name="amount1" style="width:100%;text-align:right;font-size:22px;">
                                    </td>
                                    <td style="width:200px;padding:5px;">
                                        <select name="sel_cur1" id="sel_cur1" class="form-select" style="width:250px;font-size:22px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">កាត់ជាលុយ</td>
                                    <td style="padding:5px;">
                                        <select name="sel_cur2" id="sel_cur2" class="form-select" style="width:100%;font-size:22px;">
                                            <option value=""></option>
                                            @foreach ($currencies as $c)
                                                <option value="{{ $c->id }}" data-opsign="{{ $c->optsign }}" data-ratebuy="{{ $c->ratebuy }}" data-ratesale="{{ $c->ratesale }}">{{ $c->shortcut }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="kh16" style="width:100px;padding:10px;text-align:right;">អត្រា</td>
                                    <td style="padding:5px;">
                                        <input type="text" class="form-control" id="rate" name="rate" style="width:100%;font-size:22px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="kh16" style="width:100px;padding:10px;">ស្មើចំនួន</td>
                                    <td style="padding:5px;" colspan=2>
                                        <input type="text" class="form-control" id="amount2" name="amount2" style="width:100%;text-align:right;font-size:22px;">
                                    </td>
                                    <td style="padding:5px;">
                                        <input type="text" class="form-control" id="amtcur2" name="amtcur2" style="font-size:22px;">
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                   
                </div>
               
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="btnsavetransfer">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>