@foreach ($trannames as $key => $item)
    <tr>
        <td style="padding:0px;" class="kh16-b">{{ ++$key }}</td>
        <td style="padding:0px;" class="kh16-b">
            <input type="text" class="form-control" value="{{ $item->num }}" style="width:50px;padding:0px;text-align:center;">
        </td>
        <td style="padding:0px;" class="kh16-b">{{ $item->agenttype->name }}</td>
        <td style="padding:0px;" class="kh16-b">{{ $item->name }}</td>
        <td style="padding:0px;text-align:center;" class="kh16-b">{{ $item->sign }}</td>
        <td style="padding:0px;text-align:center;" class="kh16-b">{{ $item->popular }}</td>
        <td style="padding:0px;text-align:center;" class="kh16-b">{{ $item->is_tc }}</td>
        <td style="padding:0px;text-align:right;">
            <a href="#" class="btn btn-sm btn-warning btnedit_tranname" data-id="{{ $item->id }}" data-agenttypeid="{{ $item->agent_type_id }}" data-tranname="{{ $item->name }}" data-sign="{{ $item->sign }}" data-num="{{ $item->num }}" data-popular="{{ $item->popular }}" data-istc="{{ $item->is_tc }}">Edit</a>
            {{-- <a href="#" class="btn btn-sm btn-danger btndelete_tranname" data-id="{{ $item->id }}">Del</a> --}}

        </td>
    </tr>

@endforeach
