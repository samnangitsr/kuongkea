@foreach ($accounts as $key => $a)
    <tr class="rowclick" style="@if($a->status==0) color:red;text-decoration:line-through; @endif">
        <td class="kh16" style="text-align:center;">{{ ++$key }}</td>
        <td class="kh16-b" style="text-align:center;">{{ $a->no }}</td>
        <td class="kh16-b">{{ $a->bankname }}</td>
        <td class="kh16-b">{{ $a->accno }}</td>
        <td class="kh16">{{ $a->fullaccno }}</td>
        <td class="kh16">{{ $a->accname }}</td>
        <td class="kh16-b" style="@if($a->showinlist==0) color:red; @endif">{{ $a->showinlist==1?'បញ្ជីយើង':'បញ្ជីគេ' }}</td>
        <td style="text-align:right;">
            @if($a->status==1)
                <a href="#" style="padding-right:3px;" class="btn btn-sm btn-warning btn_edit" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-fullaccno="{{ $a->fullaccno }}" data-accname="{{ $a->accname }}" data-selbank="{{ $a->bankname }}"  data-no="{{ $a->no }}" data-showinlist="{{ $a->showinlist }}" ><i class="fa fa-pencil" style="color:green"></i></a>
            @else
                <a href="#" style="padding-right:3px;color:green;" class="btn btn-sm btn-warning btn_restore" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-status="{{ $a->status }}" data-action="restore"><i class="fa fa-repeat"></i></a>
            @endif
            <a href="#" style="padding-right:3px;" class="btn btn-sm btn-danger btn_delete" data-id="{{ $a->id }}" data-accno="{{ $a->accno }}" data-status="{{ $a->status }}" data-action="delete"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach
