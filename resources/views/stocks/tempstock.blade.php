@php
    function phpformatnumber($num){
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen($fp)-1;
            if($dc>4){
                $dc=4;
            }
        }

        return number_format($num,$dc,'.',',');
    }
    function phpformatnumber1($num){

        $num=number_format($num,6);
        $num=(float)str_replace(',','',$num);
        $dc=0;
        $p=strpos((float)$num,'.');
        if($p>0){
            $fp=substr($num,$p,strlen($num)-$p);
            $dc=strlen($fp)-1;
            if($dc>4){
                $dc=4;
            }

        }

        return number_format($num,$dc,'.',',');
    }
@endphp
@php
    $k=0;
    $total_usd=0;
@endphp
@foreach ($stock as $key=>$s)
    @php
        $k=$k+1;
        $total_usd+=$s->amount;
    @endphp
    <tr class="kh22">
        <td style="text-align:center;width:60px;">
            <div class="form-check">
                <input class="form-check-input cknum kh22" type="checkbox" value="" id="ck{{ $k }}">
                <label class="form-check-label kh22" for="ck{{ $k }}">
                    {{ $k }}
                </label>
              </div>

        </td>
        <td style="display:none;">
            <input type="hidden" name="curid[]" value="{{ $s->currency_id }}">
        </td>
        <td style="text-align:right;">{{ $s->goldwater }}</td>

        <td style="">{{ $s->currency->curname }}</td>
        <td style="text-align:right;">
            {{ phpformatnumber($s->stock) }}
        </td>
        <td style="width:100px;">
            {{ $s->currency->shortcut }}
        </td>
        <td style="text-align:right;">
            {{ phpformatnumber($s->amount) . ' USD' }}
        </td>
        <td style="text-align:right;">
            @if($s->stock<>0)
                {{-- @if($s->currency->optsign=='/')
                    {{ phpformatnumber1( $s->stock / $s->amount ) }}
                @else
                    {{ phpformatnumber1(  ($s->amount / $s->stock) ) }}
                @endif --}}
                {{phpformatnumber1($s->rate)}}
            @endif
        </td>
    </tr>
@endforeach
<tr style="background-color:aqua;">
    <td colspan=5 style="font-size:22px;">Total Amount</td>
    <td style="font-size:22px;text-align:right;">{{ phpformatnumber($total_usd) }} USD</td>
    <td></td>
</tr>
