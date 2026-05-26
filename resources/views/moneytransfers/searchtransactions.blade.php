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

@foreach ($data as $k => $tr)
<tr class="rowclick {{ $tr->status==0?'delrecord':'' }}">
    <td style="text-align:center;padding:0px;" class="kh12"> {{ ++$k }}</td>
    <td style="text-align:center;padding:0px;" class="kh12">
        <div class="dropdown">
            <button style="width:150px;@if(str_contains($tr->action,'u')) background-color:green;color:white; @endif" type="button" class="mybtn dropdown-toggle kh12" data-bs-toggle="dropdown">
                {{ $tr->id }}
            </button>
            <ul class="dropdown-menu">
                @if($tr->status==1)
                    <li><a href="#" class="dropdown-item kh16-b btnprint" data-id="{{ $tr->id }}" data-cashdraw_id="{{ $tr->cashdraw_id }}">Print</a></li>
                    @if(str_contains($tr->action,'u'))
                        <li><a href="{{ route('usercapital.updatetransactiongroup',['id'=>$tr->id,'ref_group_id'=>$tr->ref_group_id,'user_id'=>$tr->user_id]) }}" class="dropdown-item kh16-b btnupdate" target="_blank">Edit</a></li>
                    @endif
                    @if(!$tr->ref_group_id)
                        @if(str_contains($tr->action,'d'))
                            <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-status="{{$tr->status}}" data-refgroupid="{{ $tr->ref_group_id }}">Delete by ID</a></li>
                        @endif
                    @endif
                    @if($tr->ref_group_id)
                        <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id,'status'=>$tr->status]) }}" class="dropdown-item kh16-b" target="_blank" style="">Delete by Group</a></li>
                    @endif
                @else
                    @if(!$tr->ref_group_id)
                        @if(str_contains($tr->action,'d'))
                            <li><a class="dropdown-item kh16-b btndeltransfer" href="#" data-id="{{ $tr->id }}" data-ref_number="{{ $tr->ref_number }}" data-status="{{$tr->status}}" data-refgroupid="{{ $tr->ref_group_id }}">Restore by ID</a></li>
                        @endif
                    @endif
                    @if($tr->ref_group_id)
                        <li><a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id,'status'=>$tr->status]) }}" class="dropdown-item kh16-b" target="_blank" style="">Restore by Group</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </td>
    <td class="kh16">{{ date('d-m-y',strtotime($tr->dd)) }}</td>
    <td class="kh16" style="padding:0px;">
        {{ $tr->tt }}
    </td>
    <td class="kh16">
        @if($tr->ref_group_id)
            <a href="{{ route('usercapital.showrefgroupid',['group_id'=>$tr->ref_group_id,'showdelbuton'=>false]) }}" target="_blank" style="@if($tr->trancode==1) background-color:blue;color:white; @endif">{{ $tr->tranname  . ' ' . $tr->partner->name }}</a>
        @else
            <span style="@if($tr->trancode==1 && $tr->cuscharge<=0) background-color:red;color:white; @elseif($tr->trancode==1 && $tr->cuscharge>0) background-color:yellow; @endif">
                {{ $tr->tranname  . ' ' . $tr->partner->name }}
            </span>
        @endif
    </td>
    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->amount) .$tr->currency->sk }}</td>
    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->cuscharge) .$tr->cuschargecur->sk }}</td>
    <td class="kh16-b" style="text-align:right;">{{ phpformatnumber($tr->fee) .$tr->feecurrency->sk }}</td>
    <td class="kh16">{{ $tr->user->name }}</td>
    <td class="kh16" style="text-align:right;">{{ $tr->rectel }}</td>
    <td class="kh16">{{ $tr->recname }}</td>
    <td class="kh16" style="text-align:right;">{{ $tr->sendertel }}</td>
    <td class="kh16">{{ $tr->sendername }}</td>
    <td class="kh16">{{ $tr->note }}</td>
</tr>
@endforeach
