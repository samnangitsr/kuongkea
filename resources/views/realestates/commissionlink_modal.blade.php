<style>
    td{
        border-style:none;
    }
</style>

<div class="modal fade" id="commissionlink_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-slide-up">
        <div class="modal-content">
            <div class="modal-header cursor-move" style="padding:10px;">
                <h5 id="modalheader" class="modal-title kh16-b">
                    <span id="mtitle">កែប្រែព៌តមានខ្លះៗ</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="">

                <form id="frm_commission_link" action="">

                    <table id="">
                        <tr>
                            <td class="kh16-b">TID</td>
                            <td style="padding-left:10px;">
                                <input type="text" name="tid" id="tid" class="form-control" readonly>
                            </td>

                        </tr>
                         <tr>
                            <td class="kh16-b">អតិថិជន</td>
                            <td style="padding-left:10px;">
                               <select name="selpartner" id="selpartner" class="form-select kh16-b">
                                    @foreach ($partners as $c)
                                        <option value="{{$c->id}}">{{ $c->name }}</option>
                                    @endforeach
                               </select>
                            </td>

                        </tr>
                        <tr>
                            <td class="kh16-b">ចំនួនទឹកប្រាក់</td>
                            <td style="padding-left:10px;">
                                <div class="input-group">
                                    <input type="text" class="form-control kh16-b" id="amount" name="amount" style="text-align:right;height:30px;">
                                    <input type="text" class="input-group kh16-b"  id="cur" style="width:80px;height:30px;border:1px solid gray" readonly>
                                </div>

                            </td>

                        </tr>
                        <tr>
                            <td class="kh16-b">មេគុណ</td>
                            <td style="padding-left:10px;">
                                <input type="text" name="mekun" id="mekun" class="form-control" readonly>
                            </td>

                        </tr>
                         <tr>
                            <td class="kh16-b">MAPID</td>
                            <td style="padding-left:10px;">
                                <input type="text" name="mapid" id="mapid" class="form-control kh16-b">
                            </td>

                        </tr>
                    </table>

                </form>

            </div>
            <div class="modal-footer">
                <table class="kh16-b">
                    <tr>
                        <td style="text-align:right;">
                            <button class="btn btn-info kh14-b" id="btnupdate">កែប្រែ</button>
                            <button type="button" id="btnclosemodal" class="btn btn-danger kh12-b" data-bs-dismiss="modal">Close</button>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
