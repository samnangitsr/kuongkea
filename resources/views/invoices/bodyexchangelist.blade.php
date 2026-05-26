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
@foreach ($exchangelists as $key=>$e)
<tr id="tr_object_id_{{ $e->id }}">
    <td style="text-align:center;">{{ ++$key }}</td>
    <td>{{ date('d-m-Y',strtotime($e->dd)) }}</td>
    <td>{{ $e->tt }}</td>
    <td>{{ $e->user->name }}</td>
    
    <td style="text-align:center;">{{ $e->maincur . '-' . $e->pcur }}</td>
    <td style="text-align:right;">{{ phpformatnumber($e->amount) . $e->maincur }}</td>
    <td style="text-align:center;">{{ phpformatnumber($e->rate) }}</td>
    <td style="text-align:right;">{{ phpformatnumber($e->product) . $e->pcur }}</td>
    <td>{{ $e->othercode }}</td>
</tr>
@endforeach