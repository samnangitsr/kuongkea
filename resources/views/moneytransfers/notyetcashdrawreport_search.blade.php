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
@foreach ($data as $key => $d)
    <tr class="rowclick">
        <td style="text-align:center;">{{ ++$key }}</td>
        <td>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="ckid" value="{{ $d->id }}" id="ckid{{ $d->id }}" />
            <label class="form-check-label" for="ckid{{ $d->id }}"> {{ $d->id }}</label>
            </div>
        </td>
        <td style="text-align:center;padding-top:3px;">
            <a href="#" class="btndelete" data-id="{{ $d->id }}"><i class="fa fa-trash"></i></a>
        </td>
        <td>{{ date('d-m-Y',strtotime($d->dd)) . ' ' . $d->tt }}</td>

        <td>{{ $d->user->name }}</td>
        {{-- <td>{{ $d->tranname }}</td> --}}
        <td>
            @if($d->child)
                {{ $d->partner->name }} <br> {{ 'បន្តទៅ' . $d->child }}
            @else
                {{ $d->partner->name }}
            @endif

        </td>
        {{-- <td>{{ $d->customer->name }}</td> --}}
        <td class="" style="text-align:right;">
            {{ phpformatnumber($d->amount)  . $d->currency->shortcut }}
        </td>
        <td class="" style="text-align:right;">
            {{ phpformatnumber($d->cuscharge) . $d->cuschargecur->shortcut }}
        </td>
        <td class="" style="text-align:right;">
            {{ phpformatnumber($d->fee) . $d->feecurrency->shortcut }}
        </td>
        <td>
            @php
                $info1='';
                $info2='';
                if($d->recname){
                    $info1='អ្នកទទួល:' . $d->recname;
                }
                if($d->rectel){
                    if($info1==''){
                        $info1='អ្នកទទួល:' . $d->rectel;
                    }else{
                        $info1=$info1 . ' ' . $d->rectel;
                    }
                }
                if($d->sendername){
                    $info2='អ្នកផ្ញើ:' . $d->sendername;
                }
                if($d->sendertel){
                    if($info2==''){
                        $info2='អ្នកផ្ញើ:' . $d->sendertel;
                    }else{
                        $info2=$info2 . ' ' . $d->sendertel;
                    }
                }
            @endphp

        {{ $info1 }}  {{ $info2 }}
        </td>
        <td>{{ $d->note }}</td>
    </tr>
@endforeach
