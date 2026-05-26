@foreach ($agenttypes as $key => $item)
    <tr>
        <td style="text-align:center;" class="kh16-b">{{ ++$key }}</td>
        <td class="kh16-b">{{ $item->name }}</td>
        <td>
            <img src="{{ $item->logo <> '' ? asset('public/logo/'. $item->logo):asset('public/logo/angkor.png') }}" alt="" style="width:60px;height:60px;">
        </td>
        <td>
            MTR:{{  $item->transfer_amount  }} <br> CUS:{{ $item->customer_fee }}
        </td>
        <td>
            WWL:{{ $item->transfer_fee }} <br> CONW:{{ $item->cashdraw_fee }}
        </td>
        <td>
            <a href="#" class="btn btn-warning btn-sm row-edit" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-logo="{{ $item->logo }}"
                 data-transfer_amount="{{ $item->transfer_amount }}"  data-customer_fee="{{ $item->customer_fee }}"
                 data-transfer_fee="{{ $item->transfer_fee }}" data-cashdraw_fee="{{ $item->cashdraw_fee }}">Edit</a>
             <br>
            <a href="#" class="btn btn-danger btn-sm row-delete" data-id="{{ $item->id }}" data-logo="{{ $item->logo }}">Delete</a>
        </td>
    </tr>

@endforeach
