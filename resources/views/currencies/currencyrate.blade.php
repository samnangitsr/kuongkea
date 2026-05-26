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
    <td style="text-align:center;padding-top:8px;width:60px;">{{ ++$key }}</td>
    <td class="input">
        <input name="curno[]" type="text" class="form-control curno canenter kh22" style="width:75px;" value="{{ $c->no }}" readonly>
    </td>
    <td class="input">
        <input name="curid[]" type="text" class="form-control curid canenter kh22" style="width:80px;" value="{{ $c->id }}" readonly>
    </td>
    <td class="input">
        <input name="curname[]" type="text" class="form-control curname canenter kh22" value="{{ $c->curname }}" readonly>
    </td>
    <td class="input">
        <input name="shortcut[]" type="text" style="width:120px;" class="form-control shortcut canenter kh22" value="{{ $c->shortcut }}" readonly>    
    </td>
    <td class="input">
        <input name="ispandp[]" type="text" style="width:60px;" class="form-control ispandp canenter kh22" value="{{ $c->ispandp }}" readonly>    
    </td>
    <td class="input">
        <input name="optsign[]" type="text" style="width:60px;" class="form-control optsign canenter kh22" value="{{ $c->optsign }}" readonly>
    </td>
    <td class="input">
        <input name="buy[]" type="text" style="text-align:right;" class="form-control buy canenter kh22" value="{{ phpformatnumber($c->buy) }}">     
    </td>
    <td class="input">
        <input name="sale[]" type="text" style="text-align:right;" class="form-control sale canenter kh22" value="{{ phpformatnumber($c->sale) }}">
    </td>
    <td class="input">
        <input name="ratio[]" style="width:120px;text-align:center;" type="text" class="form-control ratio canenter kh22" value="{{ $c->ratio }}" readonly>
    </td>
    <td class="input">
        <input name="ratebuy[]" type="text" style="text-align:right;" class="form-control ratebuy canenter kh22" value="{{ phpformatnumber($c->ratebuy) }}" readonly>   
    </td>
    <td class="input">
        <input name="ratesale[]" type="text" style="text-align:right;" class="form-control ratesale canenter kh22" value="{{ phpformatnumber($c->ratesale) }}" readonly>
    </td>
    {{-- <td class="input">
        <input name="txtchk[]" type="hidden" class="form-control txtchk" value="false">
        <input class="form-check-input chk" type="checkbox">
        <a href="#" class="btn btn-warning btnedit">Edit</a>
    </td> --}}
</tr>
@endforeach
