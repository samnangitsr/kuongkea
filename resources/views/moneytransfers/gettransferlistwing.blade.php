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
@foreach ($transfers as $k => $tr)
<tr>
    <td style="text-align:center;padding:0px;" class="kh16">
      {{-- <input style="width:60px;text-align:center;" type="button" readonly value="{{ ++$k }}"> --}}
      <div class="dropdown">
        <button style="width:70px;" type="button" class="dropdown-toggle kh12-b" data-bs-toggle="dropdown">
          {{ ++$k }}
        </button>
        <ul class="dropdown-menu">
          <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}">Print</a></li>
          @if(str_contains($tr->action,'u'))
            <li><a href="#" data-id="{{ $tr->id }}" data-groupid="{{ $tr->ref_group_id }}" class="dropdown-item kh16-b btnedit" target="_blank">Edit</a></li>
          @endif
          @if(!$tr->ref_group_id)
            @if(str_contains($tr->action,'d'))
                <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
            @endif
          @endif
          @if($tr->ref_group_id)
            <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>

          @endif

        </ul>
      </div>
    </td>
    <td class="kh12-b" style="padding:5px;">
        {{ $tr->tt }}
      {{-- <input type="text" style="border-style:none;width:100px;text-align:center;background-color:inherit;" readonly value="{{ $tr->tt }}"> --}}
    </td>
    {{-- <td class="kh14">{{ $tr->tranname . ' ' . $tr->partner->name }}</td> --}}
    <td class="kh14">{{ $tr->tranname . '(' . $tr->note . ')'}}</td>

    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
    <td class="kh14-b" style="text-align:right;">{{ phpformatnumber($tr->fee) .$tr->feecurrency->sk }}</td>
    <td class="kh14">{{ $tr->user->name }}</td>
    <td class="kh14" style="text-align:right;">{{ $tr->rectel }}</td>
    <td class="kh14">{{ $tr->recname }}</td>
    {{-- <td class="kh16" style="text-align:right;">{{ $tr->sendertel }}</td>
    <td class="kh16">{{ $tr->sendername }}</td> --}}
    <td class="kh14">{{ $tr->note }}</td>
</tr>
@endforeach
