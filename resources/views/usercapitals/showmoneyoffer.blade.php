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
@foreach ($moneyoffers as $key =>$m)
    <tr>
        <td style="text-align:center;">{{ ++$key }}</td>
        <td>{{ $m->offer_time }}</td>
        <td>{{ $m->offerby->name }}</td>
        <td>{{ $m->offerto->name }}</td>
        <td>{{ $m->offer_type }}</td>
        <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($m->amount) . $m->currency->sk }}</td>
        <td style="text-align:right;" class="kh16-b">{{ phpformatnumber($m->amount1) . $m->currency1->sk }}</td>
        <td class="kh16" style="text-align:center;">{{ $m->ref_number }}</td>
        <td>{{ $m->accept_note }}</td>
        <td style="text-align:center;">
             @if(Auth::user()->role->name=='Admin')
                @if($m->status==1)
                    @if($m->isaccept==0)
                        @if($m->offer_to_user_id==Auth::id())
                            <a href="#" class="btn-3d btn-ok" data-offer_id="{{ $m->id }}"
                            data-usercashin_id="{{ $m->offer_by_user_id }}" data-usercashin="{{ $m->offerby->name }}"
                            data-usercashout_id="{{ $m->offer_to_user_id }}" data-usercashout="{{ $m->offerto->name }}" data-offertype1="{{ $m->offer_type1 }}"
                            data-amount3="{{ $m->amount }}" data-selcur3="{{ $m->currency_id }}" data-customer_id="{{ $m->customer_id }}" data-customer_id1="{{ $m->customer_id1 }}"
                            data-amount4="{{ $m->amount1 }}" data-selcur4="{{ $m->currency_id1 }}" data-offertype="{{ $m->offer_type }}">យល់ព្រម</a>
                        @endif
                            <a href="#" class="btn-3d btn-3d-warning btn-continue" data-offer_id="{{ $m->id }}" data-usercashin_id="{{ $m->offer_by_user_id }}"
                            data-usercashin="{{ $m->offerby->name }}" data-usercashout_id="{{ $m->offer_to_user_id }}"
                            data-usercashout="{{ $m->offerto->name }}">បន្តបុគ្គលិក</a>
                            <a href="#" class="btn-3d btn-3d-danger btn-reject" data-offer_id="{{ $m->id }}">លុបសំណើរ</a>
                    @else
                        <a href="#" class="btn-3d btn-3d-danger btn-ko" data-offer_id="{{ $m->id }}">លុបការយល់ព្រម</a>
                    @endif
                @else
                    <a href="#" class="btn-3d btn-3d-primary btn-restore" data-offer_id="{{ $m->id }}">យកវិញ</a>
                @endif
             @else
                @if($m->offer_to_user_id==Auth::id())
                    @if($m->status==1)
                        @if($m->isaccept==0)
                            <a href="#" class="btn-3d btn-ok" data-offer_id="{{ $m->id }}"
                            data-usercashin_id="{{ $m->offer_by_user_id }}" data-usercashin="{{ $m->offerby->name }}"
                            data-usercashout_id="{{ $m->offer_to_user_id }}" data-usercashout="{{ $m->offerto->name }}" data-offertype1="{{ $m->offer_type1 }}"
                            data-amount3="{{ $m->amount }}" data-selcur3="{{ $m->currency_id }}" data-customer_id="{{ $m->customer_id }}" data-customer_id1="{{ $m->customer_id1 }}"
                            data-amount4="{{ $m->amount1 }}" data-selcur4="{{ $m->currency_id1 }}" data-offertype="{{ $m->offer_type }}">យល់ព្រម</a>
                            <a id="2.4.5" href="#" class="btn-3d btn-3d-warning btn-continue" data-offer_id="{{ $m->id }}" data-usercashin_id="{{ $m->offer_by_user_id }}"
                            data-usercashin="{{ $m->offerby->name }}" data-usercashout_id="{{ $m->offer_to_user_id }}"
                            data-usercashout="{{ $m->offerto->name }}">បន្តបុគ្គលិក</a>
                        @else
                            {{-- <a href="#" class="btn-3d btn-3d-danger btn-ko" data-offer_id="{{ $m->id }}">លុបការយល់ព្រម</a> --}}
                        @endif
                    @else
                        {{-- <a href="#" class="btn-3d btn-3d-primary btn-restore" data-offer_id="{{ $m->id }}">យកវិញ</a> --}}
                    @endif
                @endif
             @endif
        </td>
    </tr>
@endforeach
