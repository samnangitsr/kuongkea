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
        <td>{{ date('d-m-Y',strtotime($d->smsdate))}}</td>
        <td>{{ $d->smstime=='0'?'':$d->smstime }}</td>
        <td>{{ $d->smsby }}</td>

        <td>{{$d->accno}}</td>

        <td class="kh14-b" style="text-align:right;">
            {{ phpformatnumber($d->amount)  . ' ' .  $d->cur }}
        </td>
        <td style="padding-left:10px;">{{ $d->smstext }}</td>
    </tr>
@endforeach
