@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
      $fp=substr($num,$p,strlen($num)-$p);
      //$dc=strlen((float)$fp)-2;
      $dc=2;
    }
    return number_format($num,$dc,'.',',');
}
@endphp
<div class="card">
  <div class="card-header">
      <div class="row">
          <div class="col-lg-6">
              <h3 class="kh22-b">តារាងបើកវេរច្រើនតួ</h3>
          </div>
          <div class="col-lg-6">
              {{-- <span style="float:right;font-size:22px;margin-left:20px;"><button id="btnclosedivtransferlist" class="btn btn-danger btn-md">X</button></span> --}}
              <span style="font-size:22px;margin-left:20px;"><button id="btncleartransferlist" class="btn btn-warning btn-md kh16-b">សំអាតតារាងបើកវេរច្រើនតួ</button></span>
            </div>
      </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
          <table id="tbl_tranferlist" class="table table-bordered">
              <thead style="text-align:center;" class="kh16">
                  <th>No</th>
                  <th style="display:none;">ID</th>
                  <th>ថ្ងៃវេរ</th>
                  <th style="display:none;">PartnerID</th>
                  <th>ដៃគូពាក់ព័ន្ធ</th>
                  <th>ចំនួនទឹកប្រាក់</th>
                  <th>រូបិយ</th>
                  <th style="display:none;">CURID</th>
                  <th>កាត់សេវ៉ា</th>
                  <th>រូបិយ</th>
                  <th>លុយត្រូវបើក</th>
                  <th>រូបិយ</th>
                  <th>លេខទទួល</th>
                  <th>ឈ្មោះទទួល</th>
                  <th>លេខផ្ញើ</th>
                  <th>ឈ្មោះផ្ញើ</th>
                  <th>សកម្មភាព</th>
              </thead>
              <tbody id="">
                  @foreach ($multicashdraws as $key => $mtr)
                    <tr>
                      <td style="text-align:center;" class="kh16">{{ ++$key }}</td>
                      <td class="kh16-b" style="padding:0px;display:none;">
                        <input type="text" class="form-control kh16-b list_transferid tdcanenter2" value="{{ $mtr->transfer_id }}"  name="list_transferid[]" style="width:100px;height:40px;" autocomplete="off" readonly>
                      </td>
                      <td class="kh16-b" style="">
                          {{ date('d-m-Y',strtotime($mtr->transfer_date)) }}
                      </td>
                      <td class="kh16-b" style="padding:0px;display:none;">
                        <input type="text" class="form-control kh16-b list_partnerid tdcanenter2" value="{{ $mtr->partner_id }}"  name="list_partnerid[]" style="width:200px;height:40px;" autocomplete="off" readonly>
                      </td>
                      <td class="kh16-b" style="padding:0px;">
                        <input type="text" class="form-control kh16-b list_partnername tdcanenter2" value="{{ $mtr->partner->name }}"  name="list_partnername[]" style="width:200px;height:40px;" autocomplete="off" readonly>
                      </td>

                      <td class="kh16-b" style="padding:0px;">
                        <input type="text" class="form-control kh16-b list_amount tdcanenter2" value="{{ phpformatnumber(abs($mtr->amount)) }}"  name="list_amount[]" style="width:200px;text-align:right;height:40px;" readonly autocomplete="off">
                      </td>
                      <td class="kh16-b" style="padding:0px;">
                        <input type="text" class="form-control kh16-b list_cur" value="{{ $mtr->currency->shortcut }}" title="{{ $mtr->currency_id }}"  name="list_cur[]" style="width:60px;text-align:right;height:40px;" readonly autocomplete="off">
                      </td>
                      <td class="kh16-b" style="padding:0px;display:none;">
                        <input type="text" class="form-control kh16-b list_currencyid" value="{{ $mtr->currency_id }}" title="{{ $mtr->currency_id }}"  name="list_currencyid[]" style="width:60px;text-align:right;height:40px;" readonly autocomplete="off">
                      </td>
                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <input type="text" class="form-control kh16-b list_cuscharge tdcanenter2" style="text-align:right;width:120px;height:40px;" name="list_cuscharge[]" value="{{ phpformatnumber($mtr->cuscharge) }}" readonly>
                      </td>
                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <select name="list_curcharge_id[]" class="form-select list_curcharge_id kh16-b" id="" style="width:120px;height:40px;" readonly>
                            <option value=""></option>
                            @foreach ($currencies as $c)
                                <option value="{{ $c->id }}" {{ $mtr->currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
                            @endforeach
                        </select>
                      </td>
                      <td class="kh16-b" style="padding:0px;">
                        <input type="text" class="form-control kh16-b list_amount_open tdcanenter2" value="{{ phpformatnumber(abs($mtr->amount)) }}"  name="list_amount_open[]" style="width:200px;text-align:right;height:40px;" autocomplete="off" readonly>
                      </td>
                      <td class="kh16-b" style="padding:0px;">
                        <input type="text" class="form-control kh16-b list_cur_open" value="{{ $mtr->currency->shortcut }}"  name="list_cur_open[]" style="width:60px;text-align:right;height:40px;" autocomplete="off" readonly>
                      </td>
                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <input type="text" class="form-control kh16-b list_rectel" style="width:250px;height:40px;" name="list_rectel[]" value="{{ $mtr->rec_tel }}">
                      </td>

                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <input type="text" class="form-control kh16-b list_recname" style="width:250px;height:40px;" name="list_recname[]" value="{{ $mtr->rec_name }}">
                      </td>

                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <input type="text" class="form-control kh16-b list_sendertel" style="width:250px;height:40px;" name="list_sendertel[]" value="{{ $mtr->sender_tel }}">
                      </td>

                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <input type="text" class="form-control kh16-b list_sendername" style="width:250px;height:40px;" name="list_sendername[]" value="{{ $mtr->sender_name }}">
                      </td>
                      <td class="kh16-b" style="text-align:right;padding:0px;">
                        <a href="#" class="btn btn-danger btn-md btndeltransfertemp" data-id="{{ $mtr->id }}" data-transferid="{{ $mtr->transfer_id }}" data-idfromtransfer="1">លុប</a>
                      </td>

                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
