@php
function phpformatnumber($num){
    $dc=0;
    $p=strpos((float)$num,'.');
    if($p>0){
    $fp=substr($num,$p,strlen($num)-$p);
    $dc=strlen((float)$fp)-2;

    }
    return number_format($num,$dc,'.',',');
}
@endphp
@foreach ($transfertemplists as $key => $mtr)
  <tr>
    <td style="text-align:center;padding-top:5px;" class="kh12-b">{{ ++$key }}</td>
    <td class="kh12-b" style="text-align:center;padding-top:5px;">
        <a href="#" class="mybtn btndeltransfertemp" style="color:red;border:1px solid black;padding:3px;" data-id="{{ $mtr->id }}" data-idfromtransfer="1">លុប</a>
    </td>
    <td class="kh12-b" style="padding-top:5px;">{{ date('d-m-Y',strtotime($mtr->dd)) }}</td>
    <td class="kh12-b" style="padding-top:5px;">{{ $mtr->user->name }}</td>

    <td class="kh12-b" style="padding:0px;width:200px;">
      <select name="list_partnername[]" class="select2-option1 list_partnername"  style="width:200px;">
        <option value=""></option>
        @foreach ($partners as $b)
          @if($mtr->user_affect>0)
            @if($mtr->parrent_id==$b->id)
              <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" {{ $mtr->parrent_id==$b->id?'selected':'' }}>{{ $b->name }}</option>
            @endif
          @else
            <option value="{{ $b->id }}" customertype="{{ $b->customertype }}" {{ $mtr->parrent_id==$b->id?'selected':'' }}>{{ $b->name }}</option>
          @endif
        @endforeach
      </select>
    </td>

    <td class="kh12-b" style="padding:0px;">
      <input type="text" class="kh12-b list_tranname" value="@if($mtr->trancode==1)ផ្ញើ@elseif($mtr->trancode==-1)ទទួល@else @endif"  name="list_tranname[]" style="width:100px;height:29px;" autocomplete="off" readonly>
    </td>
    <td class="kh12-b" style="padding:0px;display:none;">
      <input type="text" class="kh12-b list_trancode" value="{{ $mtr->trancode }}"  name="list_trancode[]" style="" autocomplete="off">
    </td>
    <td class="kh12-b" style="padding:0px;display:none;">
      <input type="text" class="kh12-b list_mekun" value="{{ $mtr->mekun }}"  name="list_mekun[]" style="" autocomplete="off">
    </td>

    <td class="kh12-b" style="padding:0px;">
      <input type="text" class="kh12-b list_amount" value="{{ phpformatnumber($mtr->amount) }}"  name="list_amount[]" style="width:100px;height:29px;text-align:right;" autocomplete="off">
    </td>
    <td class="kh12-b" style="padding:0px;">
      <select name="list_curid[]" class="list_curid kh12-b" id="" style="width:60px;height:29px;">
          <option value=""></option>
          @foreach ($currencies as $c)
              <option value="{{ $c->id }}" {{ $mtr->currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
          @endforeach
      </select>
    </td>

    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_cuscharge" style="text-align:right;width:80px;height:29px;" name="list_cuscharge[]" value="{{ phpformatnumber($mtr->cuscharge) }}">
    </td>
    <td class="kh12-b" style="text-align:right;padding:0px;">
      <select name="list_curcharge_id[]" class="list_curcharge_id kh12-b" id="" style="width:60px;height:29px;">
          <option value=""></option>
          @foreach ($currencies as $c)
              <option value="{{ $c->id }}" {{ $mtr->cuscharge_currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
          @endforeach
      </select>
    </td>


    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_fee" style="text-align:right;width:80px;height:29px;" name="list_fee[]" value="{{ phpformatnumber($mtr->fee) }}">
    </td>
    <td class="kh12-b" style="text-align:right;padding:0px;">

      <select name="list_curfee_id[]" class="list_curfee_id kh12-b" id="" style="width:60px;height:29px;">
        <option value=""></option>
        @foreach ($currencies as $c)
            <option value="{{ $c->id }}" {{ $mtr->fee_currency_id==$c->id?'selected':'' }}>{{ $c->shortcut }}</option>
        @endforeach
      </select>
    </td>

    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_rectel" style="width:150px;height:29px;" name="list_rectel[]" value="{{ $mtr->rectel }}">
    </td>

    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_recname" style="width:150px;height:29px;" name="list_recname[]" value="{{ $mtr->recname }}">
    </td>

    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_sendertel" style="width:150px;height:29px;" name="list_sendertel[]" value="{{ $mtr->sendertel }}">
    </td>

    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_sendername" style="width:150px;height:29px;" name="list_sendername[]" value="{{ $mtr->sendername }}">
    </td>
    <td class="kh12-b" style="text-align:right;padding:0px;">
      <input type="text" class="kh12-b list_user_affect" style="width:100px;height:29px;" name="list_user_affect[]" value="{{ $mtr->user_affect }}" readonly>
    </td>

    <td style="text-align:center;padding-top:5px;" class="kh12-b">{{ $key }}</td>
  </tr>
@endforeach
