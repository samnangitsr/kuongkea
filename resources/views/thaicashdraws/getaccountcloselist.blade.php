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
@foreach ($accounts as $key => $a)
<tr class="rowclick">
    <td class="kh14" style="text-align:center;">{{ ++$key }}</td>
    <td class="kh14-b" style="text-align:center;display:none;">{{ $a->id }}</td>
    <td class="kh14-b">{{ $a->closedate }}</td>
    <td class="kh14-b">{{ $a->closetime }}</td>
    <td class="kh14-b">{{ $a->user->name }}</td>
    <td class="kh14-b" style="">{{ $a->account->accno }}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($a->balance)}} B</td>
    <td class="kh16-b" style="text-align:center;">{{ $a->lastsmsid }}</td>

    <td style="text-align:right;">
        <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="{{ $a->id }}" data-account_id="{{ $a->thai_account_id }}" data-accno="{{ $a->account->accno }}"><i class="fa fa-trash"></i></a>
    </td>
</tr>
@endforeach
