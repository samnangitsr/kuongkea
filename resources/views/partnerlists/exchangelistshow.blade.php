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
@foreach ($exchangelists as $key => $el)
<tr style="@if($el->status==0) background-color:pink; @endif">
    <td style="text-align:center;">{{ ++$key }}</td>
    <td>{{ $el->partner->name }}</td>
    <td>{{ date('d-m-Y',strtotime($el->ex_date)) }}</td>
    <td>{{ $el->ex_time }}</td>
    <td>{{ $el->user->name }}</td>
    <td style="color:blue;text-align:right;">+{{ phpformatnumber($el->buy) . ' ' . $el->curbuy }}</td>
    <td style="color:red;text-align:right;">-{{ phpformatnumber($el->sale) . ' ' . $el->cursale }}</td>
    <td style="text-align:center;">{{ phpformatnumber($el->main_rate) }}</td>
    <td style="text-align:center;">{{ phpformatnumber($el->agree_rate) }}</td>
    <td style="text-align:center;">
        <a href="#" class="btndelete" data-id="{{ $el->id }}" data-status="{{ $el->status }}"><i class="@if($el->status==1) fa fa-trash @else fa fa-recycle  @endif"></i></a>
    </td>
</tr>
@endforeach
