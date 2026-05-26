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
    $dd='';
    $created_at='';
@endphp

@foreach ($exchangelists as $key=>$e)
    @php
        $dd=date('Y-m-d',strtotime($e->dd));
        $created_at=date('Y-m-d',strtotime($e->created_at));
    @endphp
    <tr id="tr_object_id_{{ $e->mapcode }}">
        <td style="text-align:center;padding:0px;">
            <div class="dropdown">
                <button style="width:70px;" type="button" class=" dropdown-toggle kh12-b" data-bs-toggle="dropdown">
                    {{ ++$key }}
                </button>
                <ul class="dropdown-menu" style="padding:0px;">
                    @if($e->status==1)
                        @if($e->isexchangelist==0)

                            @if(str_contains($e->action,'d'))
                                <li style=""><a data-id="{{ $e->mapcode }}" class="btndel dropdown-item kh16-b"  href="">Delete</a></li>
                            @endif
                            <li style=""><a data-id="{{ $e->mapcode }}" class="btnprint dropdown-item kh16-b"  href="">Print</a></li>

                        @endif
                    @else
                        {{ $e->userdel }}
                    @endif
                </ul>
            </div>
        </td>
        <td style="padding:2px;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->dd)) }}</td>
        <td style="padding:2px;">{{ $e->tt }}</td>

        <td style="text-align:center;padding:2px;">{{ $e->curbuy . '-' . $e->cursale }}</td>
        <td style="text-align:right;color:blue;padding:2px;">+{{ phpformatnumber($e->buy) . ' ' . $e->curbuy }}</td>

        <td style="text-align:right;padding:2px;{{ $e->rate<>$e->drate?'background-color:yellow;':'' }}">
            {{ $e->rate<>$e->drate ? floatval($e->rate) . '(' . floatval($e->drate) . ')' : floatval($e->rate) }}
        </td>
        <td style="text-align:right;padding:2px;">{{ ($e->goldwater ?? 0) == 0 ? '' : $e->goldwater }}</td>

        <td style="text-align:right;color:red;padding:2px;">-{{ phpformatnumber($e->sale) . ' ' . $e->cursale }}</td>
        <td style="padding:0px;"><input type="text" class="kh12-b" style="width:100%;border-style:none;background-color:inherit;" value="{{ $e->user->name }}" readonly></td>
        <td style="padding:2px;@if($dd<>$created_at)background-color:brown;color:white; @endif">{{ date('d-m-Y',strtotime($e->created_at)) }}</td>
        <td style="text-align:center;padding:2px;">{{ $e->ref_group_id }}</td>
        <td style="text-align:center;padding:2px;">{{ $e->note }}</td>
    </tr>
@endforeach

