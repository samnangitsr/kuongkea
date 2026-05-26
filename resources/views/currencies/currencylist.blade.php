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
@foreach ($currencies as $key => $c)
    <tr>
        <td style="text-align:center;">{{ ++$key }}</td>
        <td style="border-style:none;padding:0px 0px 0px 20px;">
            <input type="text" class="rotate-input kh14-b" style="width:105px" value="{{$c->company->name??''}}" readonly>
            <input type="text" class="form-control txtno kh22" style="text-align:center;width:75px;" value="{{ $c->no }}" data-id="{{ $c->id }}">
        </td>
        <td style="padding:0px;">
            <div class="circular--landscape">
                <img style=" width: auto; height: 100%; margin-left:{{ $c->imglocation . 'px' }};"
                    src="{{ asset('public/myimages') . '/' . $c->imgpath }}" />
            </div>
        </td>
        <td class="kh16" style="text-align:center;">
             {{ $c->curname }} <br>
            <span style="font-size:12px;">{{  $c->shortcut . '(' . $c->sk . ')' }}</span> <br>
            <span style="font-size:12px;">{{  $c->id . $c->skey  }}</span>
        </td>

        <td class="kh16" style="text-align:center;">{{ phpformatnumber($c->buy) }}</td>
        <td class="kh16" style="text-align:center;">{{ phpformatnumber($c->sale) }}</td>
        <td class="kh16" style="text-align:center;">{{ $c->ratio }}</td>
        <td class="kh16" style="text-align:center;">{{ phpformatnumber($c->ratebuy) }}</td>
        <td class="kh16" style="text-align:center;">{{ phpformatnumber($c->ratesale) }}</td>
        <td>
            OP: {{ $c->optsign }} <br>
            Col:{{ $c->lmr }} <br>
            តួចែក:{{ $c->tuochek??1 }}
         </td>
         <td>
             Main:{{ $c->ismain }} <br>
             Fn:{{ $c->isfn }} <br>
             PP:{{ $c->ispandp }}
         </td>
        <td>
            Pcur:{{ $c->partner_cur }} <br>
            CD: {{ $c->iscustomerdisplay }} <br>
            isGold:{{ $c->isgold??0 }}
        </td>
        <td>
            ImgL:{{ phpformatnumber($c->imglocation) }} <br>
            ក្បៀស:{{ $c->decpoint }} <br>
            លំអៀង:{{ phpformatnumber($c->lomeang) }}
        </td>
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
        <td>
            @if($active==1)
            <a href="" class="btn btn-warning btnedit kh16" data-id="{{ $c->id }}" style="width:60px;margin-bottom:5px;">កែ</a> <br>
            <a href="" class="btn btn-danger btndel kh16" data-id="{{ $c->id }}" data-status="{{$c->active}}" style="width:60px;">លុប</a>
            @else
                <a href="" class="btn btn-warning btnrestore kh14-b" data-id="{{ $c->id }}" style="width:80px;">យកវិញ</a>
                <a href="" class="btn btn-danger btndel kh14-b" data-id="{{ $c->id }}" data-status="{{$c->active}}" style="width:80px;">លុប</a>
            @endif
        </td>
    </tr>
@endforeach

