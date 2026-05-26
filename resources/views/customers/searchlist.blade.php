@foreach ($customers as $key => $c)
    @php
    $addr='';
    if($c->province_id){
        $addr=$c->province->name;
    }
    if($c->district_id){
        $addr .=' ' .$c->district->name;
    }
    if($c->commune_id){
        $addr .=' ' .$c->commune->name;
    }
    if($c->village_id){
        $addr .=' ' .$c->village->name;
    }
    @endphp
    <tr>
        <td style="text-align:center;">{{ ++$key }}</td>
        <td style="text-align:center;padding:0px;">
          <input type="text" class="form-control txtno" style="width:70px;text-align:center;" value="{{ $c->no }}" data-id="{{ $c->id }}">
        </td>
        <td style="width:250px;" title="id={{$c->id}}">
            {{ $c->name }} @if($c->customertype!=='AGENT' && $c->customertype!=='BANK') @if($c->sex==1) (ប្រុស) @elseif($c->sex==0) (ស្រី) @else @endif @endif<br>
            <span style="font-size:8px;color:gray">
                {{ $c->customertype . '(' . $c->agenttype->name . ')' }}
            </span>

        </td>

        <td>{{ $c->tel }} <br> {{ 'ID:' . $c->idcard }}</td>
        <td>{{ $addr }}</td>
        <td>{{ $c->openaddress }} <br> {{ $c->company->name }}</td>
        <td style="width:120px;">
          {{ date('d-m-Y',strtotime($c->created_at)) }} <br> {{ $c->user->name }}
        </td>
        <td style="width:120px;">
            {{ $c->thai_list }} <br> <span>List:{{ $c->showinlist }}</span> <span>Gold:{{ $c->is_gold_list }}</span>
        </td>
        {{-- <td style="width:120px;">
            {{ App\Customer::separate_userconnect($c->user_connect) }}
        </td> --}}
         @php
            $userconnectData = App\Customer::separate_userconnect($c->user_connect, 2, true);
        @endphp

        <td class="td_userconnect">
            <span class="short-text">{!! $userconnectData['html'] !!}</span>
            <span class="full-text d-none">{!! App\Customer::separate_userconnect($c->user_connect) !!}</span>

            @if($userconnectData['has_more'])
                <a href="javascript:void(0)" class="toggle-text kh14" style="color:blue;">more</a>
            @endif
        </td>
        <td style="width:120px;text-align:center;">
          <a href="#" style="padding:0px;" class="btn btn-sm btn_account" data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-customertype="{{ $c->customertype }}" ><i class="fa fa-address-book-o"></i></a>
          <a href="#" style="padding:0px;" class="btn btn-sm btn_edit" data-id="{{ $c->id }}" data-company="{{ $c->company_id }}" data-name="{{ $c->name }}" data-sex="{{ $c->sex }}" data-userconnect="{{ $c->user_connect }}" data-idcard="{{ $c->idcard }}" data-tel="{{ $c->tel }}" data-openaddr="{{ $c->openaddress }}" data-customertype="{{ $c->customertype }}" data-no="{{ $c->no }}" data-province="{{ $c->province_id }}" data-district="{{ $c->district_id }}" data-commune="{{ $c->commune_id }}" data-village="{{ $c->village_id }}" data-agent_type="{{ $c->agent_type_id }}"  data-thailist="{{ $c->thai_list }}" data-showinlist="{{ $c->showinlist }}" data-isgoldlist="{{ $c->is_gold_list }}"><i class="fa fa-pencil" style="color:green"></i></a>
          <a href="#" style="padding:0px;" class="btn btn-sm btn_remove" data-id="{{ $c->id }}"><i class="fa fa-trash" style="color:red;"></i></a>
        </td>
    </tr>
@endforeach
