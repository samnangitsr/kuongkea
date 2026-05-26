<div class="modal fade" id="setratemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalheader" class="modal-title kh22-b">កំណត់អត្រាបិទបញ្ជីប្រចាំថ្ងៃ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" id="frmsetratecloselist">
                    <div id="maincol" class="row" style="">

                            <table id="curleft" class="table table-bordered">
                                <thead class="kh16-b" style="text-align:center;background-color:gold">
                                    <th style="width:80px;">ID</th>
                                    <th style="">Currency</th>
                                    <th style="">Buy</th>
                                    <th style="">Sale</th>
                                </thead>

                                <tbody>
                                    @foreach ($curthree as $key => $c1)
                                        <tr>
                                            <td class="input" style="padding:0px;width:80px;">
                                                <input name="curid_closelist[]" type="text" class="form-control curid_closelist canenter kh22-b" style="width:80px;text-align:center;" value="{{ $c1->id }}" readonly>
                                            </td>
                                            <td  class="kh22-b" style="@if($c1->shortcut=='KHR-THB' || $c1->shortcut=='THB-KHR' || $c1->shortcut=='KHR-VND' || $c1->shortcut=='VND-KHR') padding:25px 0px 0px 5px; @else padding:5px; @endif">
                                                {{ $c1->shortcut }}
                                            </td>

                                            <td class="input" style="text-align:right;padding:0px;">

                                                <input name="buy_closelist[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;height:45px;" class="form-control buy_closelist canenter kh22-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->buy) }}"  autocomplete="off">
                                            </td>
                                            <td class="input" style="text-align:right;padding:0px;">

                                                <input name="sale_closelist[]" type="text" style="text-align:right;padding:0px 5px 0px 0px;border-style:none;height:45px;" class="form-control sale_closelist canenter kh22-b" title="{{ $c1->decpoint }}" value="{{ phpformatnumber($c1->sale) }}"  autocomplete="off">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary kh22" id="btnsaverate">រក្សាទុក</button>


            </div>
        </div>
    </div>
</div>
