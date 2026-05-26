@foreach ($companies as $key => $com)
	<tr>
        <td>
            @if($com->status==1)
                <a href="#" class="btn btn-warning row-edit" style="width:100px;" data-id="{{ $com->id }}">{{ $com->status==1?'Edit':'Restore' }}</a> <br>
            @else
                <a href="#" class="btn btn-warning row-restore" style="width:100px;" data-status="{{ $com->status }}" data-id="{{ $com->id }}" data-logo="{{ $com->logo }}">Restore</a><br>
            @endif
            <a href="#" class="btn btn-danger row-delete" style="width:100px;" data-status="{{ $com->status }}" data-id="{{ $com->id }}" data-logo="{{ $com->logo }}">Delete</a>
        </td>
		<td style="text-align:center;">{{ ++$key }}</td>
        <td style="text-align:center;">{{ $com->id }}</td>
        <td>{{ $com->name }} <br> {{ $com->subname }} <br> {{ $com->tel }}</td>
        <td>{{ $com->name1 }}</td>

        <td>{{ $com->email }}</td>
        <td>{{ $com->website }} <br> {!! str_replace('/', '<br>', $com->public_ip) !!}</td>
        <td>{{ $com->address }}</td>
        <td><img src="{{ $com->logo <> '' ? asset('public/logo/'. $com->logo):'' }}" alt="" style="width:128px;height:128px;"></td>
        <td><img src="{{ $com->qrlogo <> '' ? asset('public/logo/'. $com->qrlogo):'' }}" alt="" style="width:128px;height:128px;"></td>
        <td>{{ $com->note_text }}</td>
	</tr>
@endforeach
